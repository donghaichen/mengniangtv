<?php
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
