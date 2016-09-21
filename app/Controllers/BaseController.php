<?php
namespace App\Controllers;
use Exception;
use Clovers\View\View;
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
//        $this->log('sql', '系统sql记录', [3]);
    }

//    public function log($type, $info, array $context = array())
//    {
//        $monolog = new \Monolog\Logger(strtoupper($type));
//        $file     =  STORAGE_PATH . '/logs/' . $type . date('/Y/m/') . $type . date('-Y-m-d'). ".log";
//        $monolog -> pushHandler(new \Monolog\Handler\StreamHandler($file, \Monolog\Logger::DEBUG));
//        $monolog->addInfo($info, $context);
//    }

}