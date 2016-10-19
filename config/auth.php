<?php
/**
 * 身份认证密钥与盐。
 * User: donghai
 * Date: 2016/10/18
 * Time: 01:47
 */
return[
    'key' =>[
        'AUTH'          => env('KEY_AUTH'),
        'SECURE_AUTH'   => env('KEY_SECURE_AUTH'),
        'LOGGED_IN'     => env('KEY_LOGGED_IN'),
        'NONCE'         => env('KEY_NONCE')
    ],
    'salt' =>[
        'AUTH'          => env('SALT_KEY_AUTH'),
        'SECURE_AUTH'   => env('SALT_SECURE_AUTH'),
        'LOGGED_IN'     => env('SALT_LOGGED_IN'),
        'NONCE'         => env('SALT_NONCE')
    ]
];
