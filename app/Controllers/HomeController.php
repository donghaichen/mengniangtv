<?php
namespace App\Controllers;
use App\Video;
use Clovers\Session\Session;
use Clovers\Session\Storage\File;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as DB;
use Clovers\View\View;

class HomeController extends BaseController
{
    public function index()
    {
      self::log([
            'name' => 'donghai',
            'age' => '18',
            'address' => 'Shanghai, China',
            'mobile' => '+86 13917338888',
            'mail' => 'chendonghai888@gmail.com'
        ],'userinfo','error');

        $this->view = View::make('home.index')->with('video',Video::all())

            ->withTitle('HI MENGNIANG TV')

            ->withStatus('OK!');
//        $users = User::find(2);
//        $users = User::all();
//        $user = new User;
//        $user->username = 'someone';
//        $user->email = 'some@overtrue.me';
//        $user->save();
//        $session = new Session(new File(STORAGE_PATH . '/session'));
//        $session->set("age",json_encode($this->test()));
//        $name = $session->get('age');
//        var_dump($_SESSION);
        // 查询id为2的
//        $video = Video::all();
//        var_dump($video);
//        var_dump(Video::all());
//
//// 查询全部
//        $users = User::all();
//
//// 创建数据
//        $user = new User;
//        $user->username = 'someone';
//        $user->email = 'some@overtrue.me';
//        $user->save();

    }
    private function test()
    {
        return [
            'app_key'   =>"test2222key",
            'app_secret'=>"testsercret",
            'images'    =>[
                'file'  =>'@/Users/donghai/Desktop/clover500.png'
            ]
        ];
    }




}