<?php

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;

class DefaultController extends Controller
{
    public function actionTest()
    {
       \Yii::$app->language = 'zh-CN';
       $this->renderMessage('User', __('User'));
    }

    private function renderMessage($message, $translate)
    {
        $this->stdout("translate: ");
        $this->stdout("$message", Console::FG_YELLOW);
        $this->stdout(" > ");
        $this->stdout("$translate\n", Console::FG_GREEN);
    }
}