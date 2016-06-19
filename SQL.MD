                ##SQL
                # ************************************************************
                # Sequel Pro SQL dump
                # Version 4541
                #
                # http://www.sequelpro.com/
                # https://github.com/sequelpro/sequelpro
                #
                # Host: 127.0.0.1 (MySQL 5.7.11)
                # Database: mengniang
                # Generation Time: 2016-06-18 14:44:21 +0000
                # ************************************************************
                
                
                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8 */;
                /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
                /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
                /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
                
                
                # Dump of table mn_admin
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_admin`;
                
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
                
                
                
                # Dump of table mn_categories
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_categories`;
                
                CREATE TABLE `mn_categories` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `type` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `parent` bigint(20) NOT NULL DEFAULT '0',
                  `description` text COLLATE utf8mb4_unicode_ci,
                  `count` bigint(20) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_comments
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_comments`;
                
                CREATE TABLE `mn_comments` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `post_id` bigint(20) NOT NULL,
                  `uid` bigint(20) NOT NULL,
                  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
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
                
                
                
                # Dump of table mn_danmas
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_danmas`;
                
                CREATE TABLE `mn_danmas` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `video_id` bigint(20) NOT NULL,
                  `time` int(11) NOT NULL DEFAULT '3',
                  `type` enum('1','2','3','4','5','6','7','8') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `size` enum('18','25') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `color` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '16777215',
                  `pool` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `uid` bigint(20) NOT NULL,
                  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `danmas_video_id_index` (`video_id`),
                  KEY `danmas_uid_index` (`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_options
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_options`;
                
                CREATE TABLE `mn_options` (
                  `key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status` tinyint(1) NOT NULL DEFAULT '1',
                  PRIMARY KEY (`key`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_orders
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_orders`;
                
                CREATE TABLE `mn_orders` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `action_id` bigint(20) NOT NULL,
                  `order_sn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `order_status` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `pay_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `goods_amount` decimal(12,2) NOT NULL,
                  `charge_money` decimal(12,2) NOT NULL DEFAULT '0.00',
                  `pay_money` decimal(12,2) NOT NULL DEFAULT '0.00',
                  `reward_moeny` decimal(12,2) NOT NULL DEFAULT '0.00',
                  `pay_id` smallint(6) NOT NULL,
                  `complate_time` timestamp NULL DEFAULT NULL,
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
                
                
                
                # Dump of table mn_posts
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_posts`;
                
                CREATE TABLE `mn_posts` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` int(11) NOT NULL,
                  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
                  `type` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status` enum('pending','publish','private','draft') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `admin_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `views` bigint(20) NOT NULL DEFAULT '0',
                  `favorites` bigint(20) NOT NULL DEFAULT '0',
                  `reward` bigint(20) NOT NULL DEFAULT '0',
                  `like` bigint(20) NOT NULL DEFAULT '0',
                  `hate` bigint(20) NOT NULL DEFAULT '0',
                  `comment_status` tinyint(1) NOT NULL DEFAULT '1',
                  `comment` bigint(20) NOT NULL DEFAULT '0',
                  `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `posts_uid_index` (`uid`),
                  KEY `posts_title_index` (`title`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_relationships
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_relationships`;
                
                CREATE TABLE `mn_relationships` (
                  `object_id` bigint(20) NOT NULL,
                  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `taxonomy_id` bigint(20) NOT NULL,
                  KEY `relationships_object_id_index` (`object_id`),
                  KEY `relationships_taxonomy_id_index` (`taxonomy_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_reports
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_reports`;
                
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
                
                
                
                # Dump of table mn_send_sms
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_send_sms`;
                
                CREATE TABLE `mn_send_sms` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `type` smallint(6) NOT NULL DEFAULT '0',
                  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `send_sms_uid_index` (`uid`),
                  KEY `send_sms_mobile_index` (`mobile`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_tags
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_tags`;
                
                CREATE TABLE `mn_tags` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `description` text COLLATE utf8mb4_unicode_ci,
                  `count` bigint(20) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_user_account
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_account`;
                
                CREATE TABLE `mn_user_account` (
                  `uid` bigint(20) NOT NULL,
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
                
                
                
                # Dump of table mn_user_groups
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_groups`;
                
                CREATE TABLE `mn_user_groups` (
                  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `type` enum('default','member','system','special','vip') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `img` tinyint(1) NOT NULL DEFAULT '0',
                  `score` int(11) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`gid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_user_log_action
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_log_action`;
                
                CREATE TABLE `mn_user_log_action` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `action` smallint(6) NOT NULL,
                  `relation_id` bigint(20) NOT NULL,
                  `reported_uid` bigint(20) NOT NULL DEFAULT '0',
                  `affect_money` decimal(8,2) NOT NULL DEFAULT '0.00',
                  `affect_score` decimal(8,2) NOT NULL DEFAULT '0.00',
                  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_log_action_uid_index` (`uid`),
                  KEY `user_log_action_action_index` (`action`),
                  KEY `user_log_action_relation_id_index` (`relation_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_user_log_admin
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_log_admin`;
                
                CREATE TABLE `mn_user_log_admin` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `action` smallint(6) NOT NULL,
                  `relation_id` bigint(20) NOT NULL,
                  `affect_money` decimal(8,2) NOT NULL DEFAULT '0.00',
                  `affect_score` decimal(8,2) NOT NULL DEFAULT '0.00',
                  `affect_uid` bigint(20) NOT NULL DEFAULT '0',
                  `content` text COLLATE utf8mb4_unicode_ci,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_log_admin_uid_index` (`uid`),
                  KEY `user_log_admin_action_index` (`action`),
                  KEY `user_log_admin_relation_id_index` (`relation_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_user_log_moeny
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_log_moeny`;
                
                CREATE TABLE `mn_user_log_moeny` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` bigint(20) NOT NULL,
                  `type` smallint(6) NOT NULL,
                  `billno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `affect_money` decimal(15,6) NOT NULL,
                  `charge_money` decimal(15,6) DEFAULT '0.000000',
                  `frozen_money` decimal(15,6) DEFAULT '0.000000',
                  `reward_money` decimal(15,6) DEFAULT '0.000000',
                  `relation_id` bigint(20) NOT NULL DEFAULT '0',
                  `relation_uid` bigint(20) NOT NULL DEFAULT '0',
                  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `user_log_moeny_uid_index` (`uid`),
                  KEY `user_log_moeny_billno_index` (`billno`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_user_pay
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_pay`;
                
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
                
                
                
                # Dump of table mn_user_permission_groups
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_permission_groups`;
                
                CREATE TABLE `mn_user_permission_groups` (
                  `gid` int(11) NOT NULL,
                  `rkey` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `rtype` enum('basic','system') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `rvalue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
                  `vtype` enum('string','array') COLLATE utf8mb4_unicode_ci NOT NULL,
                  PRIMARY KEY (`gid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_user_profile
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_user_profile`;
                
                CREATE TABLE `mn_user_profile` (
                  `uid` int(11) NOT NULL,
                  `gender` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `vip` int(11) NOT NULL DEFAULT '0',
                  `vip_due_time` timestamp NULL DEFAULT NULL,
                  `birthday` timestamp NULL DEFAULT NULL,
                  `idcard` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `affective_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `occupation` enum('家里蹲','学生汪','挨踢汪','手艺汪','内务汪','商务汪','销售汪','公务猿','搬砖汗') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `birth_province` smallint(6) NOT NULL DEFAULT '0',
                  `birth_city` smallint(6) NOT NULL DEFAULT '0',
                  `location` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `location_status` tinyint(1) NOT NULL DEFAULT '0',
                  `site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  PRIMARY KEY (`uid`),
                  UNIQUE KEY `user_profile_idcard_unique` (`idcard`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                # Dump of table mn_users
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_users`;
                
                CREATE TABLE `mn_users` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `recommend_id` int(11) NOT NULL DEFAULT '0',
                  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `nickname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `wechat_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `qq_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `weibo_token` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `avatar_status` enum('0','1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `group_id` smallint(6) NOT NULL DEFAULT '0',
                  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `status_due_time` timestamp NULL DEFAULT NULL,
                  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `reg_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `reg_source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
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
                
                
                
                # Dump of table mn_videos
                # ------------------------------------------------------------
                
                DROP TABLE IF EXISTS `mn_videos`;
                
                CREATE TABLE `mn_videos` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `uid` int(11) NOT NULL,
                  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
                  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                  `src` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `time` int(11) NOT NULL DEFAULT '120',
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
                  `comment_status` tinyint(1) NOT NULL DEFAULT '1',
                  `comment` bigint(20) NOT NULL DEFAULT '0',
                  `source` enum('PC','HTML5','微信','iOS','Android') COLLATE utf8mb4_unicode_ci NOT NULL,
                  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `videos_uid_index` (`uid`),
                  KEY `videos_title_index` (`title`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                
                
                
                
                /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
                /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
                /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                
                                
                ```sql
                
                
                 
                                
                ##### Thanks