<?php
/**
 * 测试数据库创建和写入
 * 待解决问题(Call to a member function connection() on null in /Users/donghai/mengniangtv/vendor/illuminate/database/
 * Capsule/Manager.php:97 Stack trace: #0 )
 * User: donghai
 * Date: 16/6/12
 * Time: 10:13
 */

namespace App\Controllers\Test;


use App\Controllers\BaseController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as BD;

class SqlController extends BaseController
{
    public function test()
    {

    }
}