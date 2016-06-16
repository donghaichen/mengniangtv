<?php
return [
    //Supported: "file", "database", "memcached", "redis"
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('/session'),
    'connection' => null,
    'table' => 'sessions',
    'lottery' => [2, 100],
    'cookie' => 'clover_session',
    'path' => '/',
    'domain' => null,
    //HTTPS Only Cookies
    'secure' => false,
];
