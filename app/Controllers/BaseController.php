<?php
namespace App\Controllers;
use Exception;
use Clovers\View\View;
use Clovers\Log\Log;
use Illuminate\Database\Capsule\Manager as DB;
class BaseController
{
    protected $view;
    /*
     * 构造方法
     * 多用于初始化任务（比如对变量进行初始化赋值）
     */
    public function __construct()
    {
    }
    /*
     * 公用404方法
     * ＠ access public
     * @ return string
     */
    public function httpNotFound()
    {
        header('HTTP/1.0 404 Not Found');
        throw new Exception('Im 404 not found');
    }
    /*
     * 析构方法用于在销毁控制器类前完成试图加载功能
     * ＠access public
     * @return bool
     */
    public function __destruct()
    {
        $view = $this->view;
        if ( $view instanceof View )
        {
            extract($view->data);
            require $view->view;
        }
        self::log(log_sql(DB::getQueryLog()),'debug', 'sql');
        self::log('测试日志信息，这是错误级别', 'error');[]
        self::log('测试日志信息，这是紧急级别', 'emergency');
    }

    /**
     * 公用日志方法　第二个参数为日志类型，第三个参数为日志等级　　
     * @access public
     * @param string　array
     * @param string
     * @param string
     * @return bool
     */
    public static function log($log, $level = 'debug', $type = '')
    {
        Log::init([
            'driver'  =>  'File',
            'path'  =>  LOG_PATH
        ]);
        Log::$level($type, $log);
    }

}