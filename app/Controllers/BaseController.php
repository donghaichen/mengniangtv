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
    }


    public function send_sms($mobile,$content,$token,$type,$uid)
    {
        $message['status'] = 0 ;
        $user_sms          = DB::table('user_sms');
        $count             = $user_sms->where('mobile',$mobile)->whereBetween('created_at',[Carbon::now()
            ->subMinutes(30),Carbon::now()])->orderBY('created_at','DESC')->count();
        $time              = $user_sms->where('mobile',$mobile)->orderBy('id', 'desc')->value('created_at');
        $time = time()-strtotime($time);

        if($token !==csrf_token()){
            $message['message'] = '如果您不是机器人，请联系我们的客服！';
        }else if($count >5){
            $message['message'] = '短信发送次数过多，请30分钟后再试！';
        }else if($time < 60){
            $message['message'] = '短信获取太快，请60秒后再试！';
        }
        else{
            $config = config('app.sms');
            $data = array
            (
                'account'=>$config['user'],
                'password'=>$config['pass'],
                'mobile'=>$mobile,
                'content'=>$content.$config['sign'],
            );
            $result = http_request($config['url'],$data);
            $xml = (array)simplexml_load_string($result);
            $status = $xml['returnstatus'];
            $message['message'] = $xml['message'];
            if($status ==  'Success'){
                $message['status'] = 1 ;
                $data = array(
                    'uid'     => $uid,
                    'type'    => $type,
                    'mobile'  => $mobile,
                    'content' => $content,
                    'created_at'=>Carbon::now(),
                );
                $user_sms->insert($data);
            }
        }

        return($message);
    }

}