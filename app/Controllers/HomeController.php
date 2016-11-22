<?php
namespace App\Controllers;
use App\Video;
use App\Category;
use Clovers\Session\Session;
use Clovers\Session\Storage\File;
use Illuminate\Clover\Config;
use Illuminate\Clover\Env;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as DB;
use App\User;
class HomeController extends BaseController
{
    public function index()
    {
//        $users = User::find(1);
//                var_dump($users);
//        var_dump(Config::get());
//        exit();
//        $users = DB::table('users')->get();
//        var_dump($users);
//        exit();
//      self::log([
//            'name' => 'donghai',
//            'age' => '18',
//            'address' => 'Shanghai, China',
//            'mobile' => '+86 13917338888',
//            'mail' => 'chendonghai888@gmail.com'
//        ],'userinfo','error');

//        $users =  [
//            "username"=> "donghaichen182",
//            "mobile"=> "John5007"
//        ];



//        $users = User::find(2);
//        $users = User::all();

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
//        $this->viewCompact();
//        $this->view();
        $this->testJson();

    }

    private function testJson()
    {
        $data = ['name'=>'thinkphp','url'=>'thinkphp.cn'];
        return json(['data'=>$data,'code'=>1,'message'=>'操作完成']);
    }

    private function viewCompact()
    {
        $title = 'test title';
        $users = User::find(1);
        return view('home.index', compact('title', 'users'));
    }

    private function view()
    {
        $data['title'] = 'test title';
        $data['users'] = User::find(1);
        return view('home.index', $data);
    }





}