<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/2/17
 * Time: 下午10:02
 */
//注册自动加载
require __DIR__ . '/vendor/autoload.php';

//定义目录
define('APP_PATH', __DIR__);
define('CONF_PATH', __DIR__ . '/config');
define('STORAGE_PATH', __DIR__ . '/resources/storage');

//加载配置
require APP_PATH . '/config/routes.php';
$database = require CONF_PATH . '/database.php';

//其他配置
date_default_timezone_set("PRC");

//加载Eloquent  创建链接 | 设置全局静态可访问 | 启动Eloquent
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();