<?php

$config = [
    'id' => 'yii2-devkit',
    'name' => 'Yii2 DevKit',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(dirname(__DIR__))) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'i18n' => [
            'class' => 'yiithings\i18n\I18N'
        ]
    ],
];

return $config;
