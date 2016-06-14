##SQL
                SET FOREIGN_KEY_CHECKS = 0;
                
                DROP TABLE IF EXISTS  `mn_admin`;
                CREATE TABLE `mn_admin` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `nickname` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `wechat_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `qq_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `avatar_status` smallint(6) NOT NULL,
                  `group_id` smallint(6) NOT NULL,
                  `status` smallint(6) NOT NULL,
                  `reg_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `reg_source` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `admin_mobile_unique` (`mobile`),
                  UNIQUE KEY `admin_wechat_token_unique` (`wechat_token`),
                  UNIQUE KEY `admin_qq_token_unique` (`qq_token`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_categorys`;
                CREATE TABLE `mn_categorys` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `parent` bigint(20) NOT NULL,
                  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `count` bigint(20) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_comments`;
                CREATE TABLE `mn_comments` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `post_id` bigint(20) NOT NULL,
                  `uid` bigint(20) NOT NULL,
                  `is_anonymous` smallint(6) NOT NULL,
                  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status` smallint(6) NOT NULL,
                  `parent` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `comments_post_id_index` (`post_id`),
                  KEY `comments_uid_index` (`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_danmas`;
                CREATE TABLE `mn_danmas` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `video_id` bigint(20) NOT NULL,
                  `time` int(11) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `size` smallint(6) NOT NULL,
                  `color` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `add_time` int(11) NOT NULL,
                  `pool` smallint(6) NOT NULL,
                  `uid` bigint(20) NOT NULL,
                  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `danmas_video_id_index` (`video_id`),
                  KEY `danmas_uid_index` (`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_options`;
                CREATE TABLE `mn_options` (
                  `key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status` smallint(6) NOT NULL,
                  PRIMARY KEY (`key`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_orders`;
                CREATE TABLE `mn_orders` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `action_id` bigint(20) NOT NULL,
                  `order_sn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `order_status` smallint(6) NOT NULL,
                  `pay_status` smallint(6) NOT NULL,
                  `goods_amount` decimal(12,2) NOT NULL,
                  `charge_money` decimal(12,2) NOT NULL,
                  `pay_money` decimal(12,2) NOT NULL,
                  `reward_moeny` decimal(12,2) NOT NULL,
                  `pay_id` smallint(6) NOT NULL,
                  `confirm_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `orders_uid_index` (`uid`),
                  KEY `orders_action_id_index` (`action_id`),
                  KEY `orders_order_sn_index` (`order_sn`),
                  KEY `orders_pay_id_index` (`pay_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_posts`;
                CREATE TABLE `mn_posts` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` int(11) NOT NULL,
                  `is_anonymous` tinyint(1) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status` smallint(6) NOT NULL,
                  `admin_status` smallint(6) NOT NULL,
                  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `views` bigint(20) NOT NULL,
                  `favorites` bigint(20) NOT NULL,
                  `reward` bigint(20) NOT NULL,
                  `like` bigint(20) NOT NULL,
                  `hate` bigint(20) NOT NULL,
                  `comment_status` smallint(6) NOT NULL,
                  `comment` bigint(20) NOT NULL,
                  `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `posts_uid_index` (`uid`),
                  KEY `posts_title_index` (`title`(191))
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_relationships`;
                CREATE TABLE `mn_relationships` (
                  `object_id` bigint(20) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `taxonomy_id` bigint(20) NOT NULL,
                  KEY `relationships_object_id_index` (`object_id`),
                  KEY `relationships_taxonomy_id_index` (`taxonomy_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_reports`;
                CREATE TABLE `mn_reports` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `progress` smallint(6) NOT NULL,
                  `relation_id` bigint(20) NOT NULL,
                  `reported_uid` bigint(20) NOT NULL,
                  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `reports_uid_index` (`uid`),
                  KEY `reports_reported_uid_index` (`reported_uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_send_sms`;
                CREATE TABLE `mn_send_sms` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `send_sms_uid_index` (`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_tags`;
                CREATE TABLE `mn_tags` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `count` bigint(20) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_account`;
                CREATE TABLE `mn_user_account` (
                  `uid` bigint(20) NOT NULL,
                  `action` smallint(6) NOT NULL,
                  `video` bigint(20) NOT NULL,
                  `post` bigint(20) NOT NULL,
                  `weibo` bigint(20) NOT NULL,
                  `danma` bigint(20) NOT NULL,
                  `comment` bigint(20) NOT NULL,
                  `follow` bigint(20) NOT NULL,
                  `fan` bigint(20) NOT NULL,
                  `score` bigint(20) NOT NULL,
                  `sign` int(11) NOT NULL,
                  `favorite` bigint(20) NOT NULL,
                  `level` int(11) NOT NULL,
                  `like` bigint(20) NOT NULL,
                  `zan` bigint(20) NOT NULL,
                  `reward` bigint(20) NOT NULL,
                  `charge_money` decimal(15,6) NOT NULL,
                  `frozen_money` decimal(15,6) NOT NULL,
                  `reward_money` decimal(15,6) NOT NULL,
                  PRIMARY KEY (`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_groups`;
                CREATE TABLE `mn_user_groups` (
                  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `img` smallint(6) NOT NULL,
                  `score` int(11) NOT NULL,
                  PRIMARY KEY (`gid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_log_action`;
                CREATE TABLE `mn_user_log_action` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `action` smallint(6) NOT NULL,
                  `relation_id` bigint(20) NOT NULL,
                  `reported_uid` bigint(20) NOT NULL,
                  `affect_money` decimal(8,2) NOT NULL,
                  `affect_score` decimal(8,2) NOT NULL,
                  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_log_action_uid_index` (`uid`),
                  KEY `user_log_action_action_index` (`action`),
                  KEY `user_log_action_relation_id_index` (`relation_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_log_admin`;
                CREATE TABLE `mn_user_log_admin` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `action` smallint(6) NOT NULL,
                  `relation_id` bigint(20) NOT NULL,
                  `affect_money` decimal(8,2) NOT NULL,
                  `affect_score` decimal(8,2) NOT NULL,
                  `reported_uid` bigint(20) NOT NULL,
                  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_log_admin_uid_index` (`uid`),
                  KEY `user_log_admin_action_index` (`action`),
                  KEY `user_log_admin_relation_id_index` (`relation_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_log_moeny`;
                CREATE TABLE `mn_user_log_moeny` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `billno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `affect_money` decimal(15,6) NOT NULL,
                  `charge_money` decimal(15,6) NOT NULL,
                  `frozen_money` decimal(15,6) NOT NULL,
                  `reward_money` decimal(15,6) NOT NULL,
                  `relation_id` bigint(20) NOT NULL,
                  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  KEY `user_log_moeny_uid_index` (`uid`),
                  KEY `user_log_moeny_billno_index` (`billno`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_pay`;
                CREATE TABLE `mn_user_pay` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `status` smallint(6) NOT NULL,
                  `billno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `tran_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `money` decimal(15,6) NOT NULL,
                  `notify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `source` smallint(6) NOT NULL,
                  `off_type` smallint(6) NOT NULL,
                  `off_certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_pay_uid_index` (`uid`),
                  KEY `user_pay_billno_index` (`billno`),
                  KEY `user_pay_tran_id_index` (`tran_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_permission_groups`;
                CREATE TABLE `mn_user_permission_groups` (
                  `gid` int(11) NOT NULL,
                  `rkey` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `rtype` enum('basic','system') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `rvalue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `vtype` enum('string','array') COLLATE utf8mb4_unicode_ci NOT NULL,
                  PRIMARY KEY (`gid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_user_profile`;
                CREATE TABLE `mn_user_profile` (
                  `uid` bigint(20) NOT NULL,
                  `gender` smallint(6) NOT NULL,
                  `birthday` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `idcard_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `idcard` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `affective_status` smallint(6) NOT NULL,
                  `occupation` smallint(6) NOT NULL,
                  `birth_province` smallint(6) NOT NULL,
                  `birth_city` smallint(6) NOT NULL,
                  `reside_city` smallint(6) NOT NULL,
                  `birth_dist` smallint(6) NOT NULL,
                  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `site` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  PRIMARY KEY (`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_users`;
                CREATE TABLE `mn_users` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `recommend_id` int(11) NOT NULL,
                  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `nickname` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `signature` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `wechat_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `qq_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `weibo_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `avatar_status` smallint(6) NOT NULL,
                  `group_id` smallint(6) NOT NULL,
                  `status` smallint(6) NOT NULL,
                  `reg_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `vip` int(11) NOT NULL,
                  `vip_due_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `reg_source` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `users_username_unique` (`username`),
                  UNIQUE KEY `users_mobile_unique` (`mobile`),
                  UNIQUE KEY `users_wechat_token_unique` (`wechat_token`),
                  UNIQUE KEY `users_qq_token_unique` (`qq_token`),
                  UNIQUE KEY `users_weibo_token_unique` (`weibo_token`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                DROP TABLE IF EXISTS  `mn_videos`;
                CREATE TABLE `mn_videos` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` int(11) NOT NULL,
                  `is_anonymous` tinyint(1) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status` smallint(6) NOT NULL,
                  `admin_status` smallint(6) NOT NULL,
                  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `coin` bigint(20) NOT NULL,
                  `views` bigint(20) NOT NULL,
                  `favorites` bigint(20) NOT NULL,
                  `danma` bigint(20) NOT NULL,
                  `reward` bigint(20) NOT NULL,
                  `like` bigint(20) NOT NULL,
                  `hate` bigint(20) NOT NULL,
                  `comment_status` smallint(6) NOT NULL,
                  `comment` bigint(20) NOT NULL,
                  `agent` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `videos_uid_index` (`uid`),
                  KEY `videos_title_index` (`title`(191))
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                SET FOREIGN_KEY_CHECKS = 1;
                

                
                
                
                
               DROP TABLE `mn_videos`;
               DROP TABLE `mn_users`;
               DROP TABLE `mn_user_profile`;
               DROP TABLE `mn_user_permission_groups`;
               DROP TABLE `mn_user_pay`;
               DROP TABLE `mn_user_log_moeny`;
               DROP TABLE `mn_user_log_admin`;
               DROP TABLE `mn_user_log_action`;
               DROP TABLE `mn_user_groups`;
               DROP TABLE `mn_user_account`;
               DROP TABLE `mn_tags`;
               DROP TABLE `mn_send_sms`;
               DROP TABLE `mn_reports`;
               DROP TABLE `mn_relationships`;
               DROP TABLE `mn_posts`;
               DROP TABLE `mn_orders`;
               DROP TABLE `mn_options`;
               DROP TABLE `mn_danmas`;
               DROP TABLE `mn_comments`;
               DROP TABLE `mn_categorys`;
               DROP TABLE `mn_admin`;

                
##PHP

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
                    $table->string('wechat_token', 150)->unique();
                    $table->string('qq_token', 150)->unique();
                    $table->string('weibo_token', 150)->unique();
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
                DB::schema()->create('admin', function(Blueprint $table)
                {
                    $table->increments('id');
                    $table->string('mobile', 11)->unique();
                    $table->string('nickname', 40);
                    $table->string('password', 60);
                    $table->string('wechat_token', 150)->unique();
                    $table->string('qq_token', 150)->unique();
                    $table->smallInteger('avatar_status');
                    $table->smallInteger('group_id');
                    $table->smallInteger('status');//用户状态 0正常 1禁言 2黑名单
                    $table->ipAddress('reg_ip');
                    $table->ipAddress('reg_source');
                    $table->rememberToken();
                    $table->timestamps();
                });
                DB::schema()->create('user_groups', function(Blueprint $table)
                {
                    $table->increments('gid');
                    $table->string('name', 40);
                    $table->smallInteger('type');
                    $table->smallInteger('img');
                    $table->integer('score');//需要积分数
                });
                DB::schema()->create('user_permission_groups', function(Blueprint $table)
                {
                    $table->integer('gid')->primary();//用户组ID
                    $table->string('rkey', 60);//权限点
                    $table->enum('rtype', ['basic','system']);//权限类型
                    $table->text('rvalue');//权限值
                    $table->enum('vtype', ['string','array']);//权限值类型
                });
                DB::schema()->create('user_profile', function(Blueprint $table)
                {
                    $table->bigInteger('uid')->primary();
                    $table->smallInteger('gender');
                    $table->timestamp('birthday');
                    $table->string('idcard_type');
                    $table->string('idcard');
                    $table->string('address');
                    $table->smallInteger('affective_status');//情感状态
                    $table->smallInteger('occupation'); //职业
                    $table->smallInteger('birth_province');
                    $table->smallInteger('birth_city');
                    $table->smallInteger('reside_city');
                    $table->smallInteger('birth_dist');
                    $table->string('location', 100); //用户地理位置纬度`经度`精度
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
                    $table->integer('sign'); //签到
                    $table->bigInteger('favorite');
                    $table->integer('level');
                    $table->bigInteger('like');
                    $table->bigInteger('zan');
                    $table->bigInteger('reward');
                    $table->decimal('charge_money', 15, 6);
                    $table->decimal('frozen_money', 15, 6);//冻结资金
                    $table->decimal('reward_money', 15, 6);
                });
                DB::schema()->create('user_log_action', function(Blueprint $table)
                {
                    $table->bigIncrements('id');
                    $table->bigInteger('uid')->index();
                    $table->smallInteger('action')->index(); //follow,fan,favorite_video,like_video,reward_video charge
                    $table->bigInteger('relation_id')->index();
                    $table->bigInteger('reported_uid');
                    $table->decimal('affect_money'); //萌娘币
                    $table->decimal('affect_score'); //积分
                    $table->text('content'); //积分
                    $table->string('source');//来源
                    $table->string('uuid', 100);  //客户端唯一标识
                    $table->string('agent', 200);
                    $table->ipAddress('ip');
                    $table->timestamps();
                });
                DB::schema()->create('user_log_admin', function(Blueprint $table)
                {
                    $table->bigIncrements('id');
                    $table->bigInteger('uid')->index();
                    $table->smallInteger('action')->index(); //follow,fan,favorite_video,like_video,reward_video charge
                    $table->bigInteger('relation_id')->index();
                    $table->decimal('affect_money'); //萌娘币
                    $table->decimal('affect_score'); //积分
                    $table->bigInteger('reported_uid');
                    $table->text('content'); //积分
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
                //<d p="时间,模式,字体大小,颜色,时间戳,弹幕池,用户ID的CRC32b加密,弹幕ID">内容</d>
                DB::schema()->create('danmas', function(Blueprint $table)
                {
                    $table->bigIncrements('id');
                    $table->bigInteger('video_id')->index();
                    $table->integer('time');
                    $table->smallInteger('type');
                    $table->smallInteger('size');
                    $table->string('color', 8);
                    $table->integer('add_time');
                    $table->smallInteger('pool');
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
                    $table->bigIncrements('id');
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
                    $table->bigInteger('reported_uid')->index();
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
                
##### Thanks