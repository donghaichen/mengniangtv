<?php
/**
 * APP启动器
 * User: donghai
 * Date: 16/2/17
 * Time: 下午10:02
 */

//注册自动加载
require __DIR__ . '/vendor/autoload.php';

//载入自定义函数
require __DIR__ . '/functions.php';

//定义目录
define('APP_PATH', __DIR__);
define('CONF_PATH', __DIR__ . '/config');
define('RESOURCES_PATH', __DIR__ . '/resources');
define('STORAGE_PATH', RESOURCES_PATH . '/storage');
define('THEME_PATH', RESOURCES_PATH . '/views/themes');
define('THEME', 'default');

//加载配置
$database = require CONF_PATH . '/database.php';

//其他配置
date_default_timezone_set("PRC");

//Eloquent ORM
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();

//日志
$monolog = new \Monolog\Logger('system');
$monolog->pushHandler(new \Monolog\Handler\StreamHandler(STORAGE_PATH . '/log/app.log', \Monolog\Logger::ERROR));

// whoops 错误提示
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();