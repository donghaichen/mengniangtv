<?php
/**
 * APP启动器
 * User: donghai
 * Date: 16/2/17
 * Time: 下午10:02
 */

//定义常量
define('APP_VERSION', '1.0.1');
define('APP_PATH', __DIR__);
define('CONF_PATH', __DIR__ . '/config');
define('RESOURCES_PATH', __DIR__ . '/resources');
define('STORAGE_PATH', RESOURCES_PATH . '/storage');
define('THEME_PATH', RESOURCES_PATH . '/views/themes');
define('THEME', 'default');
define('APP_START_TIME', microtime(true));
define('APP_START_MEM', memory_get_usage());
define('DS', DIRECTORY_SEPARATOR);

//载入自定义函数
require __DIR__ . '/functions.php';

//注册自动加载
require __DIR__ . '/vendor/autoload.php';

// 加载环境变量配置
$env = parse_ini_file(APP_PATH . '/.env', true);
foreach ($env as $key => $val) {
    $name = strtoupper($key);
    if (is_array($val)) {
        foreach ($val as $k => $v) {
            $item = $name . '_' . strtoupper($k);
            putenv("$item=$v");
        }
    } else {
        putenv("$name=$val");
    }
}

//加载APP配置
use Illuminate\Clover\Config as Config;
$config   = Config::get('app');
$database = Config::get('database');

//配置APP
date_default_timezone_set($config['timezone']);

//Eloquent ORM
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();

// whoops 错误提示
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();