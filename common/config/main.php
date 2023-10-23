<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        /*
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        */
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'currencyCode' => 'Ft', // Replace with your desired currency code
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
        ],
    ],
];
