<?php

namespace yiithings\i18n;

use Yii;

class I18N extends \yii\i18n\I18N
{
    const EVENT_BEFORE_RECOGNIZE = 'beforeRecognize';
    const EVENT_AFTER_RECOGNIZE = 'afterRecognize';
    /**
     * @var string
     */
    public static $defaultCategory = '';
    /**
     * @var string|array
     */
    public $basePath = ['@app/messages'];

    public function init()
    {
        parent::init();

        if ( ! isset($this->translations[static::$defaultCategory]) &&
            ! isset($this->translations[static::$defaultCategory . '*'])) {
            $this->translations[static::$defaultCategory] = [
                'class'          => 'yiithings\i18n\GettextMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath'       => $this->basePath,
            ];
        }
    }

    /**
     * Translates a message to the specified language.
     *
     * @param string $category
     * @param string $message
     * @param array  $params
     * @param string $language
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function translate($category, $message, $params, $language)
    {
        $messageSource = $this->getMessageSource($category);
        $translation = $messageSource->translate($category, $message, $language);
        if ($translation === false) {
            return $this->format($message, $params, $messageSource->sourceLanguage);
        } else {
            return $this->format($translation, $params, $language);
        }
    }

    /**
     * Get a translated message without category.
     *
     * @param string $message
     * @param array  $params
     * @param string $language
     * @return string
     */
    public static function __($message, $params = [], $language = null)
    {
        return Yii::t(static::$defaultCategory, $message, $params, $language);
    }

    /**
     * Print a translated message without category.
     *
     * @param string $message
     * @param array  $params
     * @param string $language
     */
    public static function _e($message, $params = [], $language = null)
    {
        echo Yii::t(static::$defaultCategory, $message, $params, $language);
    }

    /**
     * Get a translated message with category.
     *
     * @param string $message
     * @param string $category
     * @param array  $params
     * @param string $language
     * @return string
     */
    public static function _x($message, $category, $params = [], $language = null)
    {
        return Yii::t($category, $message, $params, $language);
    }

    /**
     * Print a translated message with category.
     *
     * @param string $message
     * @param string $category
     * @param array  $params
     * @param string $language
     */
    public static function _xe($message, $category, $params = [], $language = null)
    {
        echo Yii::t($category, $message, $params, $language);
    }
}

