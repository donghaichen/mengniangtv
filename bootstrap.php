<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/2/17
 * Time: 下午10:02
 */
//注册自动加载
require __DIR__ . '/vendor/autoload.php';

//定义目录
define('APP_PATH', __DIR__);
define('CONF_PATH', __DIR__ . '/config');
define('STORAGE_PATH', __DIR__ . '/resources/storage');

//加载配置
require APP_PATH . '/config/routes.php';
$database = require CONF_PATH . '/database.php';

//其他配置
date_default_timezone_set("PRC");

//加载Eloquent  创建链接 | 设置全局静态可访问 | 启动Eloquent
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();
use Illuminate\Database\Schema\Blueprint;


DB::schema()->create('users', function(Blueprint $table)
{
    $table->increments('id');
    $table->integer('recommend_id');
    $table->string('username', 40)->unique();
    $table->string('mobile', 11)->unique();
    $table->string('nickname', 40);
    $table->string('signature', 100);
    $table->string('password', 60);
    $table->string('wechat_token', 200)->unique();
    $table->string('qq_token', 200)->unique();
    $table->string('weibo_token', 200)->unique();
    $table->smallInteger('avatar_status');
    $table->smallInteger('group_id');
    $table->smallInteger('status');//用户状态 0正常 1禁言 2黑名单
    $table->ipAddress('reg_ip');
    $table->integer('vip');
    $table->timestamp('vip_due_time');
    $table->ipAddress('reg_source');
    $table->rememberToken();
    $table->timestamps();
});
DB::schema()->create('user_profile', function(Blueprint $table)
{
    $table->bigInteger('uid')->primary();
    $table->smallInteger('gender');
    $table->timestamp('birthday');
    $table->string('idcard_type');
    $table->string('idcard');
    $table->string('address');
    $table->string('affective_status', 5);//情感状态
    $table->smallInteger('occupation'); //职业
    $table->smallInteger('birth_province');
    $table->smallInteger('birth_city');
    $table->smallInteger('reside_city');
    $table->smallInteger('birth_dist');
    $table->json('location'); //用户地理位置纬度`经度`精度
    $table->string('site', 100);
});
DB::schema()->create('user_account', function(Blueprint $table)
{
    $table->bigInteger('uid')->primary();
    $table->smallInteger('action');
    $table->bigInteger('video');
    $table->bigInteger('post');//文章
    $table->bigInteger('weibo');
    $table->bigInteger('danma');
    $table->bigInteger('comment');
    $table->bigInteger('follow');
    $table->bigInteger('fan');
    $table->bigInteger('score');//积分可用给UP主转让 积分转人民币之后再做
    $table->bigInteger('favorite');
    $table->integer('level');
    $table->bigInteger('like');
    $table->bigInteger('hate');
    $table->bigInteger('reward');
    $table->decimal('charge_money', 15, 6);
    $table->decimal('frozen_money', 15, 6);//冻结资金
    $table->decimal('reward_money', 15, 6);
});
DB::schema()->create('user_log_action', function(Blueprint $table)
{
    $table->bigInteger('uid')->primary();
    $table->smallInteger('action')->index(); //follow,fan,favorite_video,like_video,hate_video,reward_video charge
    $table->bigInteger('relation_id')->index();
    $table->decimal('affect_money'); //萌娘币
    $table->string('source');//来源
    $table->string('uuid', 100);  //客户端唯一标识
    $table->string('agent', 200);
    $table->ipAddress('ip');
    $table->timestamps();
});
DB::schema()->create('videos', function(Blueprint $table)
{
    $table->increments('id');
    $table->integer('uid')->index();
    $table->boolean('is_anonymous'); //匿名
    $table->smallInteger('type');
    $table->string('title', 200)->index();
    $table->longText('content');
    $table->string('url', 200);
    $table->string('time', 10);
    $table->string('img', 100);
    $table->smallInteger('status');
    $table->smallInteger('admin_status');
    $table->string('password', 60);
    $table->bigInteger('coin');
    $table->bigInteger('views');
    $table->bigInteger('favorites');
    $table->bigInteger('danma');
    $table->bigInteger('reward');
    $table->bigInteger('like');
    $table->bigInteger('hate');
    $table->smallInteger('comment_status');
    $table->bigInteger('comment');
    $table->string('agent', 200);
    $table->ipAddress('ip');
    $table->timestamps();
});
DB::schema()->create('posts', function(Blueprint $table)
{
    $table->increments('id');
    $table->integer('uid')->index();
    $table->boolean('is_anonymous'); //匿名
    $table->smallInteger('type');
    $table->string('title', 200)->index();
    $table->longText('content');
    $table->string('img', 100);
    $table->smallInteger('status');
    $table->smallInteger('admin_status');
    $table->string('password', 60);
    $table->bigInteger('views');
    $table->bigInteger('favorites');
    $table->bigInteger('reward');
    $table->bigInteger('like');
    $table->bigInteger('hate');
    $table->smallInteger('comment_status');
    $table->bigInteger('comment');
    $table->string('location', 60);
    $table->string('agent', 200);
    $table->ipAddress('ip');
    $table->timestamps();
});
//<d p="85.449,1,25,16777215,1465810497,0,0d6a600c,1955497795">陈东海888</d>
//出现时间,模式,字号,猜测为用户ID经过变态的计算,发送时间,0=弹幕池,颜色,ID
DB::schema()->create('danmas', function(Blueprint $table)
{
    $table->bigIncrements('id');
    $table->bigInteger('video_id')->index();
    $table->integer('time');
    $table->smallInteger('type');
    $table->smallInteger('size');
    $table->integer('add_time');
    $table->smallInteger('pool');
    $table->string('color', 8);
    $table->bigInteger('uid')->index();
    $table->text('content', 100);
    $table->timestamps();
});
DB::schema()->create('comments', function(Blueprint $table)
{
    $table->bigIncrements('id');
    $table->bigInteger('post_id')->index();
    $table->bigInteger('uid')->index();
    $table->smallInteger('is_anonymous'); //匿名
    $table->text('text');
    $table->smallInteger('status');
    $table->longText('parent');
    $table->smallInteger('type');
    $table->string('agent', 200);
    $table->ipAddress('ip');
    $table->timestamps();
});
DB::schema()->create('tags', function(Blueprint $table)
{
    $table->increments('id');
    $table->string('name', 60);
    $table->string('img', 100);
    $table->text('description');
    $table->bigInteger('count');
});
DB::schema()->create('categorys', function(Blueprint $table)
{
    $table->increments('id');
    $table->string('name', 100);
    $table->string('img', 100);
    $table->smallInteger('type');//视频分类 /文章分类 /话题分类 /群组分类
    $table->bigInteger('parent');
    $table->text('description');
    $table->bigInteger('count');
});
DB::schema()->create('relationships', function(Blueprint $table)
{
    $table->bigInteger('object_id')->index();//对象ID
    $table->smallInteger('type');//0 tag 1 category
    $table->bigInteger('taxonomy_id')->index(); //关系ID  即post_id
});

DB::schema()->create('send_sms', function(Blueprint $table)
{
    $table->increments('id');
    $table->bigInteger('uid')->index();
    $table->string('mobile', 11);
    $table->string('email', 40);
    $table->string('info');
    $table->string('source');
    $table->string('agent', 200);
    $table->ipAddress('ip');
    $table->timestamps();
});
DB::schema()->create('reports', function(Blueprint $table)
{
    $table->increments('id');
    $table->bigInteger('uid')->index();
    $table->smallInteger('type');
    $table->smallInteger('progress');
    $table->bigInteger('relation_id');
    $table->bigInteger('reported_uid');
    $table->string('info');
    $table->ipAddress('ip');
    $table->timestamps();
});
DB::schema()->create('options', function(Blueprint $table)
{
    $table->string('key', 32)->primary();
    $table->string('value');
    $table->smallInteger('status');
});
DB::schema()->create('user_pay', function(Blueprint $table)
{
    $table->increments('id');
    $table->bigInteger('uid')->index();
    $table->smallInteger('status');//支付状态  0|未支付，1|充值成功，2|签名不正确，3|充值失败
    $table->string('billno', 50)->index();
    $table->string('tran_id', 50)->index();
    $table->decimal('money', 15,6);
    $table->timestamp('notify_time');
    $table->smallInteger('source');
    $table->smallInteger('off_type'); //0|前台充值，1|后台补单
    $table->string('off_certificate'); //补单凭证
    $table->string('info');
    $table->ipAddress('ip');
    $table->string('uuid', 100);  //客户端唯一标识
    $table->timestamps();
});
DB::schema()->create('user_log_moeny', function(Blueprint $table)
{
    $table->bigIncrements('id');
    $table->bigInteger('uid')->index();
    $table->smallInteger('type');
    $table->string('billno', 50)->index();
    $table->decimal('affect_money', 15, 6);//影响资金
    $table->decimal('charge_money', 15, 6);//充值可用金额
    $table->decimal('frozen_money', 15, 6);//冻结资金
    $table->decimal('reward_money', 15, 6);//奖励金额
    $table->bigInteger('relation_id');
    $table->string('info');
    $table->ipAddress('ip');
    $table->string('uuid', 100);  //客户端唯一标识
    $table->timestamp('create_time');
});
DB::schema()->create('orders', function(Blueprint $table)
{
    $table->bigIncrements('id');
    $table->bigInteger('uid')->index();
    $table->bigInteger('action_id')->index();
    $table->string('order_sn', 20)->index();
    $table->smallInteger('order_status'); //订单状态。0，未确认；1，已确认；2，已取消；3，无效；4，退货；5，已完成；
    $table->smallInteger('pay_status');//支付状态；0，未付款；1，付款中；2，已付款',
    $table->decimal('goods_amount', 12, 2);//订单金额
    $table->decimal('charge_money', 12, 2);//订单使用充值资金池金额
    $table->decimal('pay_money', 12, 2);//订单支付金额
    $table->decimal('reward_moeny', 12, 2);//订单使用奖励金额
    $table->smallInteger('pay_id')->index(); //支付单号user_pay表的ID
    $table->timestamp('confirm_time'); //订单确认时间
    $table->string('uuid', 100);  //客户端唯一标识
    $table->string('agent', 200);
    $table->ipAddress('ip');
    $table->timestamps();
});
//drop table mn_categorys,mn_comments,mn_danmas,mn_options,mn_orders,mn_posts,mn_relationships,mn_reports,mn_send_sms,
//mn_tags,mn_user_account,mn_user_log_action,mn_user_log_moeny,mn_user_pay,mn_user_profile,mn_users,mn_videos;
