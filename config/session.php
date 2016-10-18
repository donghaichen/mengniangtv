<?php
/**
 * 会话配置
 * User: donghai
 * Date: 16/2/17
 * Time: 下午9:57
 */
return [
    //Supported: "file", "database", "memcached", "redis"
    'driver' => env('DRIVER_SESSION', 'file'),
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '',
    'connection' => null,
    'table' => 'sessions',
    'lottery' => [2, 100],
    'cookie' => 'clover_session',
    'path' => '/',
    'domain' => null,
    //HTTPS Only Cookies
    'secure' => false,
];
