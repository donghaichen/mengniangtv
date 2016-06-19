<?php
namespace App\Controllers\Test;

use App\Controllers\BaseController;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

class SqlController extends BaseController
{
    public function testSql()
    {

        DB::schema()->create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('recommend_id')->default(0);
            $table->string('username', 40)->unique();
            $table->string('mobile', 11)->unique()->nullable();
            $table->string('nickname', 40)->nullable();
            $table->string('signature', 100)->nullable();
            $table->string('password', 60)->nullable();
            $table->string('wechat_token', 150)->unique()->nullable();
            $table->string('qq_token', 150)->unique()->nullable();
            $table->string('weibo_token', 150)->unique()->nullable();
            $table->enum('avatar_status', [0, 1, 2, 3, 4]);
            $table->smallInteger('group_id')->default(0);
            $table->enum('status', [0, 1, 2]);//用户状态 0正常 1禁言 2黑名单
            $table->timestamp('status_due_time')->nullable();
            $table->string('uuid', 100)->nullable();  //客户端唯一标识
            $table->ipAddress('reg_ip');
            $table->enum('reg_source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::schema()->create('admin', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('mobile', 11)->unique();
            $table->string('nickname', 40)->nullable();
            $table->string('password', 60)->nullable();
            $table->string('wechat_token', 150)->unique()->nullable();
            $table->string('qq_token', 150)->unique()->nullable();
            $table->enum('avatar_status', [0, 1, 2, 3, 4]);
            $table->smallInteger('group_id')->default(0);
            $table->enum('status', [0, 1, 2]);//用户状态 0正常 1禁言 2黑名单
            $table->ipAddress('reg_ip');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::schema()->create('user_groups', function(Blueprint $table)
        {
            $table->increments('gid');
            $table->string('name', 40);
            $table->enum('type', ['default', 'member', 'system', 'special', 'vip']);//用户组类型
            $table->boolean('img')->default(false);
            $table->integer('score')->default(0);//需要积分数
        });
        DB::schema()->create('user_permission_groups', function(Blueprint $table)
        {
            $table->integer('gid')->primary();//用户组ID
            $table->string('rkey', 64);//权限点
            $table->enum('rtype', ['basic','system']);//权限类型
            $table->string('rvalue')->default(0);//权限值
            $table->enum('vtype', ['string','array']);//权限值类型
        });
        DB::schema()->create('user_profile', function(Blueprint $table)
        {
            $table->integer('uid')->primary();//用户ID
            $table->enum('gender', [0, 1, 2]);
            $table->integer('vip')->default(0);
            $table->timestamp('vip_due_time')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->string('idcard', 18)->unique()->nullable();
            $table->string('address')->nullable();
            $table->enum('affective_status', [0, 1, 2, 3]);//情感状态 保密 单身 恋爱中 已婚
            $table->enum('occupation', [
                '家里蹲',
                '学生汪',
                '挨踢汪',
                '手艺汪',
                '内务汪',
                '商务汪',
                '销售汪',
                '公务猿',
                '搬砖汗'
            ]);
            $table->smallInteger('birth_province')->default(0);
            $table->smallInteger('birth_city')->default(0);
            $table->string('location', 64)->nullable(); //用户地理位置
            $table->boolean('location_status')->default(false);
            $table->string('site', 100)->nullable();
        });
        DB::schema()->create('user_account', function(Blueprint $table)
        {
            $table->bigInteger('uid')->primary();
            $table->bigInteger('video')->default(0);
            $table->bigInteger('post')->default(0);//文章
            $table->bigInteger('weibo')->default(0);
            $table->bigInteger('danma')->default(0);
            $table->bigInteger('comment')->default(0);
            $table->bigInteger('follow')->default(0);
            $table->bigInteger('fan')->default(0);
            $table->bigInteger('score')->default(0);//积分可用给UP主转让 积分转人民币之后再做
            $table->integer('sign')->default(0); //签到
            $table->bigInteger('favorite')->default(0);
            $table->integer('level')->default(0);
            $table->bigInteger('like')->default(0);
            $table->bigInteger('zan')->default(0);
            $table->bigInteger('reward')->default(0);
            $table->decimal('charge_money', 15, 6)->default(0.000000);
            $table->decimal('frozen_money', 15, 6)->default(0.000000);//冻结资金
            $table->decimal('reward_money', 15, 6)->default(0.000000);
        });
        DB::schema()->create('user_log_action', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('action')->index(); //follow,fan,favorite_video,like_video,reward_video charge
            $table->bigInteger('relation_id')->index();
            $table->bigInteger('reported_uid')->default(0);
            $table->decimal('affect_money')->default(0.000000); //萌娘币
            $table->decimal('affect_score')->default(0); //积分
            $table->string('content')->nullable(); //详情
            $table->string('uuid', 100)->nullable();  //客户端唯一标识
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('user_log_admin', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('action')->index(); //follow,fan,favorite_video,like_video,reward_video charge
            $table->bigInteger('relation_id')->index();
            $table->decimal('affect_money')->default(0.000000); //萌娘币
            $table->decimal('affect_score')->default(0); //积分
            $table->bigInteger('affect_uid')->default(0);
            $table->text('content')->nullable(); // 详情
            $table->string('uuid', 100)->nullable();  //客户端唯一标识
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('videos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('uid')->index();
            $table->boolean('is_anonymous')->default(false); //匿名
            $table->enum('type', ['0', '1']); //视频  番剧
            $table->string('title', 200)->index();
            $table->text('content');
            $table->string('src', 200);
            $table->integer('time')->default(120);
            $table->string('img', 100);
            $table->enum('status', ['pending', 'publish', 'draft']);
            $table->enum('admin_status', [0, 1, 2]);//正常 驳回 处理中
            $table->bigInteger('coin')->default(0);
            $table->bigInteger('views')->default(0);
            $table->bigInteger('favorites')->default(0);
            $table->bigInteger('danma')->default(0);
            $table->bigInteger('reward')->default(0);
            $table->bigInteger('like')->default(0);
            $table->bigInteger('hate')->default(0);
            $table->boolean('comment_status')->default(true);
            $table->bigInteger('comment')->default(0);
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('uid')->index();
            $table->boolean('is_anonymous')->default(false); //匿名
            $table->enum('type', [0, 1, 2]);//动态 文章 分享
            $table->string('title', 200)->index()->nullable(); //如果是动态 title 为内容 没有标题
            $table->longText('content');
            $table->enum('status', ['pending', 'publish', 'private', 'draft']); //新增仅自己可见
            $table->enum('admin_status', [0, 1, 2]);//正常 驳回 处理中
            $table->string('password', 60)->nullable(); //告知部分好友密码 代替部分好友可见功能
            $table->bigInteger('views')->default(0);
            $table->bigInteger('favorites')->default(0);
            $table->bigInteger('reward')->default(0);
            $table->bigInteger('like')->default(0);
            $table->bigInteger('hate')->default(0);
            $table->boolean('comment_status')->default(true);
            $table->bigInteger('comment')->default(0);
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->string('location', 60);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        //<d p="85.449,1,25,16777215,1465810497,0,0d6a600c,1955497795">陈东海888</d>
        //<d p="时间,模式,字体大小,颜色,时间戳,弹幕池,用户ID的CRC32b加密,弹幕ID">内容</d>
        DB::schema()->create('danmas', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('video_id')->index();
            $table->integer('time')->default(3);
            $table->enum('type', [1, 2, 3, 4, 5, 6, 7, 8]);//1：滚动4：底部5：顶部
            $table->enum('size', [18, 25]);
            $table->string('color', 12)->default('16777215');
            $table->enum('pool', [0, 1, 2]); // 0普通池 1字幕池UP保护 2特殊池 【目前特殊池为高级弹幕专用】
            $table->bigInteger('uid')->index();
            $table->text('content', 100);
            $table->timestamps();
        });
        DB::schema()->create('comments', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('post_id')->index();
            $table->bigInteger('uid')->index();
            $table->boolean('is_anonymous')->default(false); //匿名
            $table->string('content', 1000);
            $table->enum('admin_status', [0, 1, 2]);//正常 驳回 处理中
            $table->integer('parent')->default(0);
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->string('location', 60);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('tags', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name', 60);
            $table->string('img', 100)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('count')->default(0);
        });
        DB::schema()->create('categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('img', 100)->nullable();
            $table->enum('type', [0, 1, 2, 3]);//视频分类 /文章分类 /话题分类 /群组分类
            $table->bigInteger('parent')->default(0);
            $table->text('description')->nullable();
            $table->bigInteger('count')->default(0);
        });
        DB::schema()->create('relationships', function(Blueprint $table)
        {
            $table->bigInteger('object_id')->index();//对象ID
            $table->enum('type', [0, 1]);//0 tag 1 category
            $table->bigInteger('taxonomy_id')->index(); //关系ID  即post_id
        });

        DB::schema()->create('send_sms', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->string('mobile', 11)->index();
            $table->smallInteger('type')->default(0);
            $table->string('content');
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->string('location', 60);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('reports', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->enum('type', [0, 1, 2, 3, 4, 5]);//1色情、暴力、反动;2版权;3撞车4骚扰谩骂5广告欺诈0其它
            $table->enum('progress', [0, 1, 2]); //处理中 处理同意 处理驳回
            $table->bigInteger('relation_id')->default(0);
            $table->bigInteger('reported_uid')->nullable();
            $table->text('info', 2000)->nullable();
            $table->string('file')->nullable();
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('options', function(Blueprint $table)
        {
            $table->string('key', 32)->primary();
            $table->string('value');
            $table->boolean('status')->default(true);
        });
        DB::schema()->create('user_pay', function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('status')->default(0);//支付状态  0|未支付，1|充值成功，2|签名不正确，3|充值失败
            $table->string('billno', 50)->unique();
            $table->string('tran_id', 50)->unique()->nullable();
            $table->decimal('money', 15, 6);
            $table->timestamp('notify_time')->nullable();
            $table->enum('off_type', [0, 1, 2]); //0|前台充值，1|后台补单 2|线下充值
            $table->string('off_certificate')->nullable(); //补单凭证
            $table->string('info');
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->string('location', 60);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('user_log_moeny', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('uid')->index();
            $table->smallInteger('type');
            $table->string('billno', 50)->index();
            $table->decimal('affect_money', 15, 6);//影响资金
            $table->decimal('charge_money', 15, 6)->nullable()->default(0.000000);//充值可用金额
            $table->decimal('frozen_money', 15, 6)->nullable()->default(0.000000);//冻结资金
            $table->decimal('reward_money', 15, 6)->nullable()->default(0.000000);//奖励金额
            $table->bigInteger('relation_id')->default(0);
            $table->bigInteger('relation_uid')->default(0);//0为平台
            $table->string('info')->nullable();
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->string('location', 60);
            $table->ipAddress('ip');
            $table->timestamps();
        });
        DB::schema()->create('orders', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('uid')->index();
            $table->bigInteger('action_id')->index();
            $table->string('order_sn', 20)->index();
            $table->enum('order_status', [0, 1, 2, 3, 4, 5]); //订单状态。0，未确认；1，已确认；2，已取消；3，无效；4，退货；5，已完成；
            $table->enum('pay_status', [0, 1 , 2]);//支付状态；0，未付款；1，付款中；2，已付款',
            $table->decimal('goods_amount', 12, 2);//订单金额
            $table->decimal('charge_money', 12, 2)->default(0.000000);//订单使用充值资金池金额
            $table->decimal('pay_money', 12, 2)->default(0.000000);//订单支付金额
            $table->decimal('reward_moeny', 12, 2)->default(0.000000);//订单使用奖励金额
            $table->smallInteger('pay_id')->index(); //支付单号user_pay表的ID
            $table->timestamp('complate_time')->nullable(); //订单结束时间
            $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
            $table->string('location', 60);
            $table->ipAddress('ip');
            $table->timestamps();
        });



        DB::table('categories')->insert(
            [
                ['name' => '动画', 'parent' =>0],
                ['name' => '番剧', 'parent' =>0],
                ['name' => '音乐', 'parent' =>0],
                ['name' => '舞蹈', 'parent' =>0],
                ['name' => '游戏', 'parent' =>0],
                ['name' => '科技', 'parent' =>0],
                ['name' => '生活', 'parent' =>0],
                ['name' => '鬼畜', 'parent' =>0],
                ['name' => '时尚', 'parent' =>0],
                ['name' => '娱乐', 'parent' =>0],
                ['name' => '影视', 'parent' =>0],
                ['name' => 'MAD·AMV', 'parent' =>1],
                ['name' => 'MMD·3D', 'parent' =>1],
                ['name' => '短片·手书·配音', 'parent' =>1],
                ['name' => '综合', 'parent' =>1],
                ['name' => '连载动画', 'parent' =>2],
                ['name' => '完结动画', 'parent' =>2],
                ['name' => '资讯', 'parent' =>2],
                ['name' => '官方延伸', 'parent' =>2],
                ['name' => '国产动画', 'parent' =>2],
                ['name' => '新番Index', 'parent' =>2],
                ['name' => '翻唱', 'parent' =>3],
                ['name' => 'VOCALOID·UTAU', 'parent' =>3],
                ['name' => '演奏', 'parent' =>3],
                ['name' => '三次元音乐', 'parent' =>3],
                ['name' => '同人音乐', 'parent' =>3],
                ['name' => '音乐选集', 'parent' =>3],
                ['name' => 'OP/ED/OST', 'parent' =>3],
                ['name' => '宅舞', 'parent' =>4],
                ['name' => '三次元舞蹈', 'parent' =>4],
                ['name' => '舞蹈教程', 'parent' =>4],
                ['name' => '单机联机', 'parent' =>5],
                ['name' => '网游·电竞', 'parent' =>5],
                ['name' => '音游', 'parent' =>5],
                ['name' => 'Mugen', 'parent' =>5],
                ['name' => 'GMV', 'parent' =>5],
                ['name' => '纪录片', 'parent' =>6],
                ['name' => '趣味科普人文', 'parent' =>6],
                ['name' => '野生技术协会', 'parent' =>6],
                ['name' => '演讲·公开课', 'parent' =>6],
                ['name' => '星海', 'parent' =>6],
                ['name' => '数码', 'parent' =>6],
                ['name' => '机械', 'parent' =>6],
                ['name' => '搞笑', 'parent' =>7],
                ['name' => '日常', 'parent' =>7],
                ['name' => '美食圈', 'parent' =>7],
                ['name' => '动物圈', 'parent' =>7],
                ['name' => '鬼畜调教', 'parent' =>8],
                ['name' => '音MAD', 'parent' =>8],
                ['name' => '人力VOCALOID', 'parent' =>8],
                ['name' => '教程演示', 'parent' =>8],
                ['name' => '美妆健身', 'parent' =>9],
                ['name' => '服饰', 'parent' =>9],
                ['name' => '资讯', 'parent' =>9],
                ['name' => '综艺', 'parent' =>10],
                ['name' => '明星', 'parent' =>10],
                ['name' => 'Korea相关', 'parent' =>10]
            ]
         );
    }
}