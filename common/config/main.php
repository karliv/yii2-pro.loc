<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'language' => 'ru-RU',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'emailService' => [
            'class' => \common\services\EmailService::class
        ],
        'projectService' => [
            'class' => \common\services\ProjectService::class,
        ],
        'taskService' => [
            'class' => \common\services\TaskService::class,
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
                // ...
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'GMT+3',
            //'dateFormat' => 'd MMMM yyyy',
            //'datetimeFormat' => 'd-M-Y H:i:s',
            //'timeFormat' => 'H:i:s',
        ],
    ],
    'modules' => [
        'chat' => [
            'class' => 'common\modules\chat\Module',
        ],
        'comment' => [
            'class' => 'yii2mod\comments\Module',
        ],
    ],
];
