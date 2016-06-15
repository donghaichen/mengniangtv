##SQL
               SET FOREIGN_KEY_CHECKS = 0;
               
               DROP TABLE IF EXISTS  `mn_admin`;
               CREATE TABLE `mn_admin` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `nickname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `wechat_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `qq_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `avatar_status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `group_id` smallint(6) NOT NULL DEFAULT '0',
                 `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `reg_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
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
                 `img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `type` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `parent` bigint(20) NOT NULL DEFAULT '0',
                 `description` text COLLATE utf8mb4_unicode_ci,
                 `count` bigint(20) NOT NULL DEFAULT '0',
                 PRIMARY KEY (`id`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_comments`;
               CREATE TABLE `mn_comments` (
                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                 `post_id` bigint(20) NOT NULL,
                 `uid` bigint(20) NOT NULL,
                 `is_anonymous` tinyint(1) NOT NULL,
                 `content` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `admin_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `parent` int(11) NOT NULL DEFAULT '0',
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
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
                 `time` int(11) NOT NULL DEFAULT '0',
                 `type` enum('1','2','3','4','5','6','7','8') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `size` enum('18','25') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `color` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `pool` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
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
                 `order_status` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `pay_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `goods_amount` decimal(12,2) NOT NULL,
                 `charge_money` decimal(12,2) DEFAULT NULL,
                 `pay_money` decimal(12,2) DEFAULT NULL,
                 `reward_moeny` decimal(12,2) DEFAULT NULL,
                 `pay_id` smallint(6) NOT NULL,
                 `confirm_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
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
                 `type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                 `status` enum('pending','publish','private','draft') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `admin_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `views` bigint(20) NOT NULL DEFAULT '0',
                 `favorites` bigint(20) NOT NULL DEFAULT '0',
                 `reward` bigint(20) NOT NULL DEFAULT '0',
                 `like` bigint(20) NOT NULL DEFAULT '0',
                 `hate` bigint(20) NOT NULL DEFAULT '0',
                 `comment_status` tinyint(1) NOT NULL,
                 `comment` bigint(20) NOT NULL DEFAULT '0',
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
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
                 `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `taxonomy_id` bigint(20) NOT NULL,
                 KEY `relationships_object_id_index` (`object_id`),
                 KEY `relationships_taxonomy_id_index` (`taxonomy_id`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_reports`;
               CREATE TABLE `mn_reports` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `uid` bigint(20) NOT NULL,
                 `type` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `progress` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `relation_id` bigint(20) NOT NULL DEFAULT '0',
                 `reported_uid` bigint(20) DEFAULT NULL,
                 `info` text COLLATE utf8mb4_unicode_ci,
                 `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `created_at` timestamp NULL DEFAULT NULL,
                 `updated_at` timestamp NULL DEFAULT NULL,
                 PRIMARY KEY (`id`),
                 KEY `reports_uid_index` (`uid`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_send_sms`;
               CREATE TABLE `mn_send_sms` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `uid` bigint(20) NOT NULL,
                 `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `type` smallint(6) NOT NULL DEFAULT '0',
                 `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `created_at` timestamp NULL DEFAULT NULL,
                 `updated_at` timestamp NULL DEFAULT NULL,
                 PRIMARY KEY (`id`),
                 KEY `send_sms_uid_index` (`uid`),
                 KEY `send_sms_mobile_index` (`mobile`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_tags`;
               CREATE TABLE `mn_tags` (
                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                 `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `description` text COLLATE utf8mb4_unicode_ci,
                 `count` bigint(20) NOT NULL DEFAULT '0',
                 PRIMARY KEY (`id`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_user_account`;
               CREATE TABLE `mn_user_account` (
                 `uid` bigint(20) NOT NULL,
                 `action` smallint(6) NOT NULL,
                 `video` bigint(20) NOT NULL DEFAULT '0',
                 `post` bigint(20) NOT NULL DEFAULT '0',
                 `weibo` bigint(20) NOT NULL DEFAULT '0',
                 `danma` bigint(20) NOT NULL DEFAULT '0',
                 `comment` bigint(20) NOT NULL DEFAULT '0',
                 `follow` bigint(20) NOT NULL DEFAULT '0',
                 `fan` bigint(20) NOT NULL DEFAULT '0',
                 `score` bigint(20) NOT NULL DEFAULT '0',
                 `sign` int(11) NOT NULL DEFAULT '0',
                 `favorite` bigint(20) NOT NULL DEFAULT '0',
                 `level` int(11) NOT NULL DEFAULT '0',
                 `like` bigint(20) NOT NULL DEFAULT '0',
                 `zan` bigint(20) NOT NULL DEFAULT '0',
                 `reward` bigint(20) NOT NULL DEFAULT '0',
                 `charge_money` decimal(15,6) NOT NULL DEFAULT '0.000000',
                 `frozen_money` decimal(15,6) NOT NULL DEFAULT '0.000000',
                 `reward_money` decimal(15,6) NOT NULL DEFAULT '0.000000',
                 PRIMARY KEY (`uid`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_user_groups`;
               CREATE TABLE `mn_user_groups` (
                 `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `type` enum('default','member','system','special','vip') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `img` tinyint(1) NOT NULL,
                 `score` int(11) NOT NULL DEFAULT '0',
                 PRIMARY KEY (`gid`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_user_log_action`;
               CREATE TABLE `mn_user_log_action` (
                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                 `uid` bigint(20) NOT NULL,
                 `action` smallint(6) NOT NULL,
                 `relation_id` bigint(20) NOT NULL,
                 `reported_uid` bigint(20) NOT NULL DEFAULT '0',
                 `affect_money` decimal(8,2) NOT NULL DEFAULT '0.00',
                 `affect_score` decimal(8,2) NOT NULL DEFAULT '0.00',
                 `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `uuid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
                 `affect_money` decimal(8,2) NOT NULL DEFAULT '0.00',
                 `affect_score` decimal(8,2) NOT NULL DEFAULT '0.00',
                 `affect_uid` bigint(20) NOT NULL DEFAULT '0',
                 `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
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
                 `charge_money` decimal(15,6) DEFAULT NULL,
                 `frozen_money` decimal(15,6) DEFAULT NULL,
                 `reward_money` decimal(15,6) DEFAULT NULL,
                 `relation_id` bigint(20) NOT NULL DEFAULT '0',
                 `relation_uid` bigint(20) NOT NULL DEFAULT '0',
                 `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `created_at` timestamp NULL DEFAULT NULL,
                 `updated_at` timestamp NULL DEFAULT NULL,
                 PRIMARY KEY (`id`),
                 KEY `user_log_moeny_uid_index` (`uid`),
                 KEY `user_log_moeny_billno_index` (`billno`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_user_pay`;
               CREATE TABLE `mn_user_pay` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `uid` bigint(20) NOT NULL,
                 `status` smallint(6) NOT NULL DEFAULT '0',
                 `billno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `tran_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `money` decimal(15,6) NOT NULL,
                 `notify_time` timestamp NULL DEFAULT NULL,
                 `off_type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `off_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `created_at` timestamp NULL DEFAULT NULL,
                 `updated_at` timestamp NULL DEFAULT NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY `user_pay_billno_unique` (`billno`),
                 UNIQUE KEY `user_pay_tran_id_unique` (`tran_id`),
                 KEY `user_pay_uid_index` (`uid`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_user_permission_groups`;
               CREATE TABLE `mn_user_permission_groups` (
                 `gid` int(11) NOT NULL,
                 `rkey` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `rtype` enum('basic','system') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `rvalue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
                 `vtype` enum('string','array') COLLATE utf8mb4_unicode_ci NOT NULL,
                 PRIMARY KEY (`gid`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_user_profile`;
               CREATE TABLE `mn_user_profile` (
                 `uid` int(11) NOT NULL,
                 `gender` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `vip_due_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                 `vip` int(11) NOT NULL DEFAULT '0',
                 `birthday` timestamp NULL DEFAULT NULL,
                 `idcard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `affective_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `occupation` enum('学生汪','挨踢汪','手艺汪','内务汪','商务汪','销售汪','公务猿','搬砖汗','家里蹲') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `birth_province` smallint(6) NOT NULL DEFAULT '0',
                 `birth_city` smallint(6) NOT NULL DEFAULT '0',
                 `reside_city` smallint(6) NOT NULL DEFAULT '0',
                 `birth_dist` smallint(6) NOT NULL DEFAULT '0',
                 `location` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 PRIMARY KEY (`uid`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_users`;
               CREATE TABLE `mn_users` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `recommend_id` int(11) NOT NULL DEFAULT '0',
                 `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `nickname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `wechat_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `qq_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `weibo_token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `avatar_status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `group_id` smallint(6) NOT NULL DEFAULT '0',
                 `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `status_due_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                 `uuid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `reg_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `reg_source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                 `created_at` timestamp NULL DEFAULT NULL,
                 `updated_at` timestamp NULL DEFAULT NULL,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY `users_username_unique` (`username`),
                 UNIQUE KEY `users_wechat_token_unique` (`wechat_token`),
                 UNIQUE KEY `users_qq_token_unique` (`qq_token`),
                 UNIQUE KEY `users_weibo_token_unique` (`weibo_token`),
                 UNIQUE KEY `users_mobile_unique` (`mobile`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
               
               DROP TABLE IF EXISTS  `mn_videos`;
               CREATE TABLE `mn_videos` (
                 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                 `uid` int(11) NOT NULL,
                 `is_anonymous` tinyint(1) NOT NULL,
                 `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                 `src` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `time` int(11) NOT NULL DEFAULT '0',
                 `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                 `status` enum('pending','publish','draft') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `admin_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                 `coin` bigint(20) NOT NULL DEFAULT '0',
                 `views` bigint(20) NOT NULL DEFAULT '0',
                 `favorites` bigint(20) NOT NULL DEFAULT '0',
                 `danma` bigint(20) NOT NULL DEFAULT '0',
                 `reward` bigint(20) NOT NULL DEFAULT '0',
                 `like` bigint(20) NOT NULL DEFAULT '0',
                 `hate` bigint(20) NOT NULL DEFAULT '0',
                 `comment_status` tinyint(1) NOT NULL,
                 `comment` bigint(20) NOT NULL DEFAULT '0',
                 `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
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
                    $table->integer('recommend_id')->default(0);
                    $table->string('username', 40)->unique();
                    $table->string('mobile', 11)->unique()->nullable();
                    $table->string('nickname', 40)->nullable();
                    $table->string('signature', 100)->nullable();
                    $table->string('password', 60)->nullable();
                    $table->string('wechat_token', 150)->unique()->nullable;
                    $table->string('qq_token', 150)->unique()->nullable;
                    $table->string('weibo_token', 150)->unique()->nullable;
                    $table->enum('avatar_status', [0, 1, 2, 3, 4]);
                    $table->smallInteger('group_id')->default(0);
                    $table->enum('status', [0, 1, 2]);//用户状态 0正常 1禁言 2黑名单
                    $table->timestamp('status_due_time');
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
                    $table->enum('type', ['default','member','system','special','vip']);//用户组类型
                    $table->boolean('img');
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
                    $table->timestamp('vip_due_time');
                    $table->integer('vip')->default(0);
                    $table->timestamp('birthday')->nullable();
                    $table->string('idcard')->nullable();
                    $table->string('address')->nullable();
                    $table->enum('affective_status', [0, 1, 2, 3]);//情感状态 保密 单身 恋爱中 已婚
                    $table->enum('occupation', [
                        '学生汪',
                        '挨踢汪',
                        '手艺汪',
                        '内务汪',
                        '商务汪',
                        '销售汪',
                        '公务猿',
                        '搬砖汗',
                        '家里蹲'
                    ]);
                    $table->smallInteger('birth_province')->default(0);
                    $table->smallInteger('birth_city')->default(0);
                    $table->smallInteger('reside_city')->default(0);
                    $table->smallInteger('birth_dist')->default(0);
                    $table->string('location', 64)->nullable; //用户地理位置纬度`经度`精度
                    $table->string('site', 100)->nullable();
                });
                DB::schema()->create('user_account', function(Blueprint $table)
                {
                    $table->bigInteger('uid')->primary();
                    $table->smallInteger('action');
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
                    $table->string('content'); //详情
                    $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
                    $table->string('uuid', 100)->nullable();  //客户端唯一标识
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
                    $table->decimal('affect_money')->default(0.000000); //萌娘币
                    $table->decimal('affect_score')->default(0); //积分
                    $table->bigInteger('affect_uid')->default(0);
                    $table->text('content'); // 详情
                    $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
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
                    $table->enum('type', ['0', '1']); //视频  番剧
                    $table->string('title', 200)->index();
                    $table->text('content');
                    $table->string('src', 200);
                    $table->integer('time')->default(0);
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
                    $table->boolean('comment_status');
                    $table->bigInteger('comment')->default(0);
                    $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
                    $table->ipAddress('ip');
                    $table->timestamps();
                });
                DB::schema()->create('posts', function(Blueprint $table)
                {
                    $table->increments('id');
                    $table->integer('uid')->index();
                    $table->boolean('is_anonymous'); //匿名
                    $table->enum('type', [0, 1, 2]);//动态 文章 分享
                    $table->string('title', 200)->index()->nullable; //如果是动态 title 为内容 没有标题
                    $table->longText('content');
                    $table->enum('status', ['pending', 'publish', 'private', 'draft']); //新增仅自己可见
                    $table->enum('admin_status', [0, 1, 2]);//正常 驳回 处理中
                    $table->string('password', 60)->nullable(); //告知部分好友密码 代替部分好友可见功能
                    $table->bigInteger('views')->default(0);
                    $table->bigInteger('favorites')->default(0);
                    $table->bigInteger('reward')->default(0);
                    $table->bigInteger('like')->default(0);
                    $table->bigInteger('hate')->default(0);
                    $table->boolean('comment_status');
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
                    $table->integer('time')->default(0);
                    $table->enum('type', [1, 2, 3, 4, 5, 6, 7, 8]);//1：滚动4：底部5：顶部
                    $table->enum('size', [18, 25]);
                    $table->string('color', 12);
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
                    $table->boolean('is_anonymous'); //匿名
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
                DB::schema()->create('categorys', function(Blueprint $table)
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
                    $table->enum('type', [0 , 1]);//0 tag 1 category
                    $table->bigInteger('taxonomy_id')->index(); //关系ID  即post_id
                });
                
                DB::schema()->create('send_sms', function(Blueprint $table)
                {
                    $table->increments('id');
                    $table->bigInteger('uid')->index();
                    $table->string('mobile', 11)->index();
                    $table->smallInteger('type')->default(0);
                    $table->string('info');
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
                    $table->smallInteger('status');
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
                    $table->decimal('charge_money', 15, 6)->nullable();//充值可用金额
                    $table->decimal('frozen_money', 15, 6)->nullable();//冻结资金
                    $table->decimal('reward_money', 15, 6)->nullable();//奖励金额
                    $table->bigInteger('relation_id')->default(0);
                    $table->bigInteger('relation_uid')->default(0);//0为平台
                    $table->string('info');
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
                    $table->decimal('charge_money', 12, 2)->nullable();//订单使用充值资金池金额
                    $table->decimal('pay_money', 12, 2)->nullable();//订单支付金额
                    $table->decimal('reward_moeny', 12, 2)->nullable();//订单使用奖励金额
                    $table->smallInteger('pay_id')->index(); //支付单号user_pay表的ID
                    $table->timestamp('confirm_time'); //订单确认时间
                    $table->enum('source', ['PC', 'HTML5', '微信', 'iOS', 'Android']);//来源
                    $table->string('location', 60);
                    $table->ipAddress('ip');
                    $table->timestamps();
                });
                
##### Thanks