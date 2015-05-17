<?php

return [
    'fetch'       => PDO::FETCH_CLASS,
    'default'     => 'mysql',
    'connections' => [
        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => storage_path() . '/database.sqlite',
            'prefix'   => '',
        ],
        'mysql'  => [
            'driver'    => 'mysql',
            'host'      => env( 'DB_HOST', 'localhost' ),
            'database'  => env( 'DB_DATABASE', 'grubworm' ),
            'username'  => env( 'DB_USERNAME', 'grubworm' ),
            'password'  => env( 'DB_PASSWORD', 'grubworm' ),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
    ],
    'migrations'  => 'migrations',
    'redis'       => [
        'cluster' => false,
        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'database' => 0,
        ],
    ],
];
