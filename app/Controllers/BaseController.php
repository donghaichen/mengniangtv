<?php
namespace App\Controllers;
use Exception;
use Clovers\View\View;
use Clovers\Log\Log;
class BaseController
{
    protected $view;
    public function __construct()
    {
    }
    public function httpNotFound()
    {
        header('HTTP/1.0 404 Not Found');
        throw new Exception('Im 404 not found');
    }

    public function __destruct()
    {

        $view = $this->view;
        if ( $view instanceof View )
        {
            extract($view->data);
            require $view->view;
        }
        self::log('系统sql记录', 'sql');
    }

    /**
     * 公用日志方法　第二个参数为日志类型，第三个参数为日志等级　　
     * @access public
     * @param string　array
     * @param string
     * @param string
     * @return bool
     */
    public static function log($log, $type = '', $level = 'debug' )
    {
        Log::init([
            'file_size'   => 10, //单位字节
            'driver'  =>  'File',
            'path'  =>  STORAGE_PATH . '/logs/'
        ]);
        Log::$level($type, $log);
    }

}