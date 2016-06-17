<?php
namespace App\Controllers\Test;


use App\Controllers\BaseController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as DB;

class SqlController extends BaseController
{
    public function testSql()
    {
        DB::table('categories')->insert(
            [
//                ['name' => '动画', 'parent' =>0],
//                ['name' => '番剧', 'parent' =>0],
//                ['name' => '音乐', 'parent' =>0],
//                ['name' => '舞蹈', 'parent' =>0],
//                ['name' => '游戏', 'parent' =>0],
//                ['name' => '科技', 'parent' =>0],
//                ['name' => '生活', 'parent' =>0],
//                ['name' => '鬼畜', 'parent' =>0],
//                ['name' => '时尚', 'parent' =>0],
//                ['name' => '娱乐', 'parent' =>0],
//                ['name' => '影视', 'parent' =>0],
//                ['name' => 'MAD·AMV', 'parent' =>1],
//                ['name' => 'MMD·3D', 'parent' =>1],
//                ['name' => '短片·手书·配音', 'parent' =>1],
//                ['name' => '综合', 'parent' =>1],
//                ['name' => '连载动画', 'parent' =>2],
//                ['name' => '完结动画', 'parent' =>2],
//                ['name' => '资讯', 'parent' =>2],
//                ['name' => '官方延伸', 'parent' =>2],
//                ['name' => '国产动画', 'parent' =>2],
//                ['name' => '新番Index', 'parent' =>2],
//                ['name' => '翻唱', 'parent' =>3],
//                ['name' => 'VOCALOID·UTAU', 'parent' =>3],
//                ['name' => '演奏', 'parent' =>3],
//                ['name' => '三次元音乐', 'parent' =>3],
//                ['name' => '同人音乐', 'parent' =>3],
//                ['name' => '音乐选集', 'parent' =>3],
//                ['name' => 'OP/ED/OST', 'parent' =>3],
//                ['name' => '宅舞', 'parent' =>4],
//                ['name' => '三次元舞蹈', 'parent' =>4],
//                ['name' => '舞蹈教程', 'parent' =>4],
//                ['name' => '单机联机', 'parent' =>5],
//                ['name' => '网游·电竞', 'parent' =>5],
//                ['name' => '音游', 'parent' =>5],
//                ['name' => 'Mugen', 'parent' =>5],
//                ['name' => 'GMV', 'parent' =>5],
//                ['name' => '纪录片', 'parent' =>6],
//                ['name' => '趣味科普人文', 'parent' =>6],
//                ['name' => '野生技术协会', 'parent' =>6],
//                ['name' => '演讲·公开课', 'parent' =>6],
//                ['name' => '星海', 'parent' =>6],
//                ['name' => '数码', 'parent' =>6],
//                ['name' => '机械', 'parent' =>6],
//                ['name' => '搞笑', 'parent' =>7],
//                ['name' => '日常', 'parent' =>7],
//                ['name' => '美食圈', 'parent' =>7],
//                ['name' => '动物圈', 'parent' =>7],
//                ['name' => '鬼畜调教', 'parent' =>8],
//                ['name' => '音MAD', 'parent' =>8],
//                ['name' => '人力VOCALOID', 'parent' =>8],
//                ['name' => '教程演示', 'parent' =>8],
//                ['name' => '美妆健身', 'parent' =>9],
//                ['name' => '服饰', 'parent' =>9],
//                ['name' => '资讯', 'parent' =>9],
//                ['name' => '综艺', 'parent' =>10],
//                ['name' => '明星', 'parent' =>10],
//                ['name' => 'Korea相关', 'parent' =>10]

            ]
         );

    }
}