<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/2/17
 * Time: 下午9:57
 */
return [
    'theme'              => 'default',
    'debug'              => env('APP_DEBUG', false),
    'url'                => env('APP_URL', 'http://localhost'),
    'timezone'           => 'PRC',
    'locale'             => 'en',
    'key'                => '',
    'cipher'             => 'AES-256-CBC',
    'log'                => 'sigle',
    'sms'                => [
        'url'            => env('SMS_URL'),
        'name'           => env('SMS_NAME'),
        'pwd'            => env('SMS_PWD'),
        'sign'           => env('SMS_SIGN'),    //必填参数。用户签名。
    ]
];