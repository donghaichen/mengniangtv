<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16-10-14
 * Time: 下午2:30
 */

namespace App\Controllers;


use Illuminate\Clover\Config;

class ApiController extends BaseController
{
    public function sendSms()
    {
        $sms_config = Config::get('app.sms');

        $flag = 0;
        $params='';//要post的数据
        $verify = 8325;//获取随机验证码

        $mobile='13884562000';//手机号
        $argv = [
            'name'    => $sms_config['name'],
            'pwd'     => $sms_config['pwd'],
            'content' => '您的验证码是:'.$verify .'仅用于微信登录',
            'mobile'  => $mobile,
            'stime'   => '',   //可选参数。发送时间
            'sign'    => $sms_config['sign'],    //必填参数。用户签名。
            'type'    => 'pt',  //必填参数。固定值 pt
        ];


        //构造要post的字符串
        foreach ($argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";
                $flag = 1;
            }
            $params.= $key."="; $params.= urlencode($value);// urlencode($value);
            $flag = 1;
        }

        $url = $sms_config['url'] . $params; //提交的url地址
        var_dump( $url);
        exit();
        $res = explode(',', http_request($url));

        $con= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态

        if($con == '0'){
            echo "<script>alert('发送成功!');</script>";
        }else{
            echo "<script>alert('发送失败!');history.back();</script>";
        }
    }

}