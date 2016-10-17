<?php
return [
        'driver'    => env('DB_DRIVER', 'mysql'),
        'host'      => env('DB_HOST', '127.0.0.1'),
        'database'  => env('DB_DATABASE', 'clover'),
        'username'  => env('DB_USERNAME', 'clover'),
        'password'  => env('DB_PASSWORD', ''),
        'hostport'  => env('DB_PORT', 3306),
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix'    => 'mn_',
];
