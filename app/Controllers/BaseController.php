<?php
namespace App\Controllers;
class BaseController
{
    public function __construct()
    {
    }
    public function httpNotFound()
    {
        header('HTTP/1.0 404 Not Found');
        print_r('Im 404 not found');
    }

    public function getIp($data = false)
    {
        $str = json_decode($this->httpRequest('http://test.ip138.com/query/'), true);
        return $data===false ? $str['ip'] : $str;
    }

    public function send_sms($mobile,$content,$token,$type,$uid)
    {
        $message['status'] = 0 ;
        $user_sms          = DB::table('user_sms');
        $count             = $user_sms->where('mobile',$mobile)->whereBetween('created_at',[Carbon::now()->subMinutes(30),Carbon::now()])->orderBY('created_at','DESC')->count();
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

    /**
     * 验证手机号是否正确
     * @author donghaichen
     * @param INT $mobile
     * 移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
     * 联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
     * 电信：133、153、180、181、189 、177(4G)；
     * 卫星通信：1349
     * 虚拟运营商：170
     */
    public function is_mobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }


//    public function getIp()
//    {
//        if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
//            $ip = getenv ( "HTTP_CLIENT_IP" );
//        else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
//            $ip = getenv ( "HTTP_X_FORWARDED_FOR" );
//        else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
//            $ip = getenv ( "REMOTE_ADDR" );
//        else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
//            $ip = $_SERVER ['REMOTE_ADDR'];
//        else
//            $ip = "unknown";
//        return ($ip);
//    }
    public function hideStr($type,$str,$auth=false)
    {
        switch($type)
        {
            case 'mobile';
                return $auth ? substr_replace($str, '****',3,4) : substr_replace($mobile,'*******',-7);
                break;
            case 'idCard';
                return strlen($str)==18?substr_replace($str,'**************',0,14):substr_replace($str,'***********',0,11);
                break;
            case 'name';
                return '*'.mb_substr($str,1,'3','utf-8');
                break;
            case 'bankcard';
                return '**** **** **** '.substr($str, -4);
                break;
        }
    }

    //HTTP请求（支持HTTP/HTTPS，支持GET/POST）

    public function httpRequest($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function isIdCard($idCard)
    {
        if (!eregi("^[1-9]([0-9a-zA-Z]{17}|[0-9a-zA-Z]{14})$", $idCard)) {
            $flag = 0;
        } else {
            if (strlen($idCard) == 18) {
                $tyear = intval(substr($idCard, 6, 4));
                $tmonth = intval(substr($idCard, 10, 2));
                $tday = intval(substr($idCard, 12, 2));
                if ($tyear > date("Y") || $tyear < (date("Y") - 100)) {
                    $flag = 0;
                }
                elseif ($tmonth < 0 || $tmonth > 12) {
                    $flag = 0;
                }
                elseif ($tday < 0 || $tday > 31) {
                    $flag = 0;
                } else {
                    if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) < 18 * 365 * 24 * 60 * 60) {
                        $flag = 0;
                    } else {
                        $flag = 1;
                    }
                }

            }
            elseif (strlen($idCard) == 15) {
                $tyear = intval("19" . substr($idCard, 6, 2));
                $tmonth = intval(substr($idCard, 8, 2));
                $tday = intval(substr($idCard, 10, 2));
                if ($tyear > date("Y") || $tyear < (date("Y") - 100)) {
                    $flag = 0;
                }
                elseif ($tmonth < 0 || $tmonth > 12) {
                    $flag = 0;
                }
                elseif ($tday < 0 || $tday > 31) {
                    $flag = 0;
                } else {
                    $tdate = $tyear . "-" . $tmonth . "-" . $tday . " 00:00:00";
                    if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) < 18 * 365 * 24 * 60 * 60) {
                        $flag = 0;
                    } else {
                        $flag = 1;
                    }
                }
            }
        }
        return $flag == 1 ? true : false ;
    }

}