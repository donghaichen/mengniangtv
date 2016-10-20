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
define('LOG_PATH', STORAGE_PATH.'/logs/');
define('THEME_PATH', RESOURCES_PATH . '/views/themes');
define('THEME', 'default');
define('URL_SUFFIX', '.html');
define('VIEW_SUFFIX','.php');
define('APP_START_TIME', microtime(true));
define('APP_START_MEM', memory_get_usage());
define('DS', DIRECTORY_SEPARATOR);

//注册自动加载
require __DIR__ . '/vendor/autoload.php';

//载入助手函数
require __DIR__ . '/helps.php';

// 加载环境变量配置
get_env();

//加载APP配置
use Illuminate\Clover\Config as Config;
$app = new stdClass();
$app->config  = (object) Config::get('app');
$database = Config::get('database');

//配置APP
date_default_timezone_set($app->config->timezone);
$app->config->debug ? debug() : debug(false);

// Routes and Begin processing
require CONF_PATH . '/routes.php';
$app->route = new \Clovers\Route\Route();

//Eloquent ORM
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();
DB::connection()->enableQueryLog();

//启动APP
$app->route->run();
