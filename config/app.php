<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

return [
    'modules' => [
        'hawk' => [
            'class' => \modules\hawk\HAWKModule::class,
            'components' => [
                'emailSupport' => [
                    'class' => 'modules\hawkmodule\services\EmailSupport',
                ],
            ],
        ]
    ],
    'bootstrap' => ['hawk'],
    'components' => [
        'deprecator' => [
            'throwExceptions' => YII_DEBUG,
        ],
        'db' => function() {
            $config = craft\helpers\App::dbConfig();
            $config['enableSchemaCache'] = true;
            $config['schemaCacheDuration'] = 60 * 60 * 24;
            return Craft::createObject($config);
        },
        /* Turn on if using Redis
        'redis' => [
            'class' => yii\redis\Connection::class,
            'hostname' => getenv('REDIS_HOSTNAME'),
            'port' => getenv('REDIS_PORT'),
            'database' => getenv('REDIS_DEFAULT_DB'),
        ],
        'cache' => [
            'class' => yii\redis\Cache::class,
            'redis' => [
                'database' => getenv('REDIS_CRAFT_DB'),
            ],
        ],
        'session' => [
            'class' => \yii\redis\Session::class,
            'as session' => [
                'class' => \craft\behaviors\SessionBehavior::class,
            ],
        ],*/
    ],
];