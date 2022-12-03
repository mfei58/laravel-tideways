<?php

return [
    /*
    |--------------------------------------------------------------------------
    | tideways enable
    |--------------------------------------------------------------------------
    |
    | 开启监控
    |
    */
    'enable' => env('TIDEWAYS_ENABLE', false),
    /*
    |--------------------------------------------------------------------------
    | tideways connection
    |--------------------------------------------------------------------------
    |
    | 存储方式
    |
    */
    'connection' => [
        'mongodb' => [
            'host' => env('TIDEWAYS_MONGO_HOST', 'mongodb://127.0.0.1:27017'),
            'db' => env('TIDEWAYS_MONGO_DB', 'xhprof'),
            'options' => [
                'username' => env("TIDEWAYS_MONGO_USERNAME") ?: null,
                'password' => env("TIDEWAYS_MONGO_PASSWORD") ?: null,
            ]
        ]
    ]
];