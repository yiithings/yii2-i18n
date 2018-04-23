<?php

namespace yiithings\i18n;

use Gettext\Translations;
use Gettext\Translator;
use Yii;
use yii\i18n\MissingTranslationEvent;

class GettextMessageSource extends \yii\i18n\GettextMessageSource
{
    /**
     * @var string|array
     */
    public $basePath;
    /**
     * @var bool Replace path dash character (-) to underline.
     */
    public $replaceDashCharacter = false;
    /**
     * @var bool Enable language directory. If set to true use path $basePath/$language/
     * (e.g @app/messages/en-US/en-US.mo), otherwise use $basePath (e.g. @app/messages/en-US.mo).
     */
    public $enableLanguageDirectory = false;
    /**
     * @var bool Enable category file name. If set to true use path $basePath/$language/$category.mo
     * (e.g @app/messages/en-US/app.mo), otherwise use $basePath (e.g. @app/messages/en-US.mo).
     * Another exception: $enableDirectory is false and $enableCategoryFile is true, use path
     * $basePath/$language_$category.mo
     */
    public $enableCategoryFile = false;
    /**
     * @var bool Disabled category.
     */
    public $disabledCategory = false;
    /**
     * @var \Gettext\Translator
     */
    protected $translator;

    protected function translateMessage($category, $message, $language)
    {
        if ($this->translator === null) {
            $this->translator = $this->loadMessages($category, $language);;
        }
        if ($this->translator === false) {
            return false;
        }

        if ($this->disabledCategory || $category === null || $category === '') {
            $translated = $this->translator->gettext($message);
        } else {
            $translated = $this->translator->dpgettext(null, $category, $message);
        }

        if ($translated == $message &&
            $this->sourceLanguage != $language &&
            $this->hasEventHandlers(self::EVENT_MISSING_TRANSLATION)) {
            $event = new MissingTranslationEvent([
                'category' => $category,
                'message'  => $message,
                'language' => $language,
            ]);
            $this->trigger(self::EVENT_MISSING_TRANSLATION, $event);
            if ($event->translatedMessage !== null) {
                return $event->translatedMessage;
            }
        }

        return $translated;
    }

    protected function loadMessages($category, $language)
    {
        $messageFiles = $this->getMessageFilePaths($category, $language);
        $messages = $this->loadMessagesFromFile($messageFiles, $category);

        if ($messages === false) {
            $fallbackLanguage = substr($language, 0, 2);
            if ($fallbackLanguage !== $language) {
                $messageFiles = $this->getMessageFilePaths($category, $language);
                $messages = $this->loadMessagesFromFile($messageFiles, $category);
            }
        }

        return $messages;
    }

    /**
     * @param array  $messageFiles
     * @param string $category
     * @return bool|Translator
     */
    protected function loadMessagesFromFile($messageFiles, $category)
    {
        $translator = false;
        foreach ($messageFiles as $messageFile) {
            if (is_file($messageFile)) {
                if ($this->useMoFile) {
                    $translations = Translations::fromMoFile($messageFile);
                } else {
                    $translations = Translations::fromPoFile($messageFile);
                }
                if ($translator === false) {
                    $translator = new Translator();
                }
                $translator->loadTranslations($translations);
            }
        }

        return $translator;
    }

    protected function getMessageFilePaths($category, $language)
    {
        $messageFiles = [];
        foreach ((array)$this->basePath as $basePath) {
            $messageFile = $language;
            if ($this->enableCategoryFile && ! $this->enableLanguageDirectory) {
                $messageFile .= '_' . $category;
            } elseif ($this->enableCategoryFile) {
                $messageFile .= '/' . $category;
            } elseif ($this->enableLanguageDirectory) {
                $messageFile .= '/' . $language;
            }
            if ($this->replaceDashCharacter) {
                $messageFile = str_replace('-', '_', $messageFile);
            }
            $messageFile = Yii::getAlias($basePath) . '/' . $messageFile;

            if ($this->useMoFile) {
                $messageFile .= self::MO_FILE_EXT;
            } else {
                $messageFile .= self::PO_FILE_EXT;
            }
            $messageFiles[] = $messageFile;
        }

        return $messageFiles;
    }
}