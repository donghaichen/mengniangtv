<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/3/8
 * Time: 11:45
 */

namespace App\Controllers;
use App\User;


class UserController extends BaseController
{
    public function show($request)
    {
        $user = new User;

        $user->mobile = 'John' . rand(0 ,10000);
        $user->username = 'donghaichen' . rand(0, 1000);
//        $user->reg_ip = $this->getIp();

        $user->save();
        var_dump($request);
    }

    public function avatar($uid, $size = 'middle', $returnsrc = FALSE, $real = FALSE, $static = FALSE, $ucenterurl = '')
    {
        global $_G;
        static $staticavatar;
        if($staticavatar === null) {
            $staticavatar = $_G['setting']['avatarmethod'];
        }

        $ucenterurl = empty($ucenterurl) ? $_G['setting']['ucenterurl'] : $ucenterurl;
        $size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
        $uid = abs(intval($uid));
        if(!$staticavatar && !$static) {
            return $returnsrc ? $ucenterurl.'/avatar.php?uid='.$uid.'&size='.$size : '<img src="'.$ucenterurl.'/avatar.php?uid='.$uid.'&size='.$size.($real ? '&type=real' : '').'" />';
        } else {
            $uid = sprintf("%09d", $uid);
            $dir1 = substr($uid, 0, 3);
            $dir2 = substr($uid, 3, 2);
            $dir3 = substr($uid, 5, 2);
            $file = $ucenterurl.'/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).($real ? '_real' : '').'_avatar_'.$size.'.jpg';
            return $returnsrc ? $file : '<img src="'.$file.'" onerror="this.onerror=null;this.src=\''.$ucenterurl.'/images/noavatar_'.$size.'.gif\'" />';
        }
    }

}