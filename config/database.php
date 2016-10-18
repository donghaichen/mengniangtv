<?php
/**
 * 数据库配置
 * User: donghai
 * Date: 16/2/17
 * Time: 下午9:57
 */
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
