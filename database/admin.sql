/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50629
Source Host           : localhost:3306
Source Database       : admin

Target Server Type    : MYSQL
Target Server Version : 50629
File Encoding         : 65001

Date: 2018-01-17 14:50:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` int(10) NOT NULL COMMENT 'MagicInstall平台appid',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '游戏名称',
  `platform` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0 android 1 IOS',
  `release_key` varchar(50) NOT NULL DEFAULT '' COMMENT '游戏Release key(兼容现有的乐逗游戏)',
  `release_secret` varchar(50) NOT NULL DEFAULT '' COMMENT 'Release secret',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '游戏说明',
  `icon` varchar(150) NOT NULL DEFAULT '' COMMENT '游戏的icon地址',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11829 DEFAULT CHARSET=utf8 COMMENT='游戏主表';

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES ('11828', '203', '梦幻花园 ', '0', 'a991b96c4a8f53ae7d53', '727b61e524dcd0404f22', '', 'http://www.idreamsky.com/files/image/20171219162934_c8bf0.png', '2018-01-02 16:35:09', '2018-01-04 11:01:33');

-- ----------------------------
-- Table structure for link_backend
-- ----------------------------
DROP TABLE IF EXISTS `link_backend`;
CREATE TABLE `link_backend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `mi_link_id` int(10) unsigned NOT NULL COMMENT 'MagicInstall中的link_id',
  `link_name` varchar(100) DEFAULT NULL COMMENT '链接名称',
  `create_id` int(10) unsigned DEFAULT NULL COMMENT '创建链接的用户id',
  `game_id` int(10) DEFAULT NULL COMMENT '游戏唯一标识（安卓和iOS不一致）',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `appid` int(10) DEFAULT NULL COMMENT '游戏或应用的唯一标识',
  `action_name` varchar(50) DEFAULT NULL COMMENT '活动名称',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '链接所属个人id',
  `short_url` varchar(50) DEFAULT NULL COMMENT '第三方生成的短连接',
  `source_url` varchar(255) DEFAULT NULL COMMENT '落地页面链接',
  `scheme` varchar(255) DEFAULT NULL COMMENT 'scheme协议地址，如果没有指定则使用默认配置的',
  `extend` varchar(255) DEFAULT NULL COMMENT '自有扩展参数',
  `transport` varchar(255) DEFAULT NULL COMMENT '三方应用透传参数',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_backend_mi_link_id` (`mi_link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='后台生成的短链映射表';

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------

-- ----------------------------
-- Table structure for operation_log
-- ----------------------------
DROP TABLE IF EXISTS `operation_log`;
CREATE TABLE `operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限名称',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限描述',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission
-- ----------------------------

-- ----------------------------
-- Table structure for player_pay
-- ----------------------------
DROP TABLE IF EXISTS `player_pay`;
CREATE TABLE `player_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL COMMENT '链接id',
  `player_id` bigint(10) unsigned NOT NULL COMMENT '玩家 player_id',
  `game_id` int(10) unsigned NOT NULL COMMENT '游戏id',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `pay` decimal(10,2) DEFAULT NULL COMMENT '当前支付总金额',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`),
  KEY `index_player_pay_link_id` (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='游戏玩家支付信息表';

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色描述',
  `level` tinyint(4) DEFAULT NULL COMMENT '级别，用于标识可访问角色',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_role_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'admin', '管理员', '1', '2017-08-27 16:42:42', '2018-01-10 17:25:27');
INSERT INTO `role` VALUES ('2', 'company_admin', '地推公司管理者', '2', '2018-01-01 17:41:18', '2018-01-10 17:25:27');
INSERT INTO `role` VALUES ('3', 'company', '地推公司', '3', '2018-01-01 17:40:35', '2018-01-10 17:25:28');
INSERT INTO `role` VALUES ('4', 'agent', '地推代理', '4', '2018-01-10 16:30:49', '2018-01-10 17:25:28');
INSERT INTO `role` VALUES ('5', 'person', '地推人员', '5', '2018-01-10 16:30:55', '2018-01-10 17:25:30');

-- ----------------------------
-- Table structure for role_menu
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_menu
-- ----------------------------

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_permission
-- ----------------------------

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `index_role_user_role_id_user_id_index` (`role_id`,`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '2018-01-05 13:45:09', '2018-01-17 14:49:38');
INSERT INTO `role_user` VALUES ('2', '2', '2018-01-05 13:45:09', '2018-01-17 14:49:38');
INSERT INTO `role_user` VALUES ('3', '3', '2018-01-05 13:45:09', '2018-01-17 14:49:38');
INSERT INTO `role_user` VALUES ('3', '4', '2018-01-05 21:19:45', '2018-01-05 21:19:45');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '该用户所属公司',
  `team` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '该用户所属团队',
  `status` tinyint(4) DEFAULT '1' COMMENT '用户状态',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT '该用户的创建者id',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`),
  KEY `index_user_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'rumi.zhao@idreamsky.com', '$2y$10$SMfKhOsX3u92AmrdK9YvieSYXMg6MM1tLlF8vh6fVLhxj./2EwXH.', 'http://dl.uu.cc/plugin/user/rumi.jpg', 'idreamsky', null, '1', '0', '3Ph567ESWBMSrnI338XdAtYuKitos6DhI06UVk3HDKLak1wY4SVHUBPtzv2v', '2017-08-27 16:42:42', '2018-01-05 11:35:00');
INSERT INTO `user` VALUES ('2', 'idreamsky', 'idreamsky@idreamsky.com', '$2y$10$bk0cVPXvSRMBwEPhYQxvXeBVlh34j/epfEx/eJ8ZL2U0.5DKV2JL6', 'http://pics.sc.chinaz.com/files/pic/pic9/201801/bpic5212.jpg', '哈哈哈哈哈', '', '1', '1', '4v5iLciletzkbvYU9I6nMyYsAqLB7m9FHgwUMJS3W14ZumdnjQcf2YqZkL5T', '2017-08-27 16:42:42', '2018-01-17 14:44:41');
INSERT INTO `user` VALUES ('3', 'changsha', 'changshang@sd.dom', '$2y$10$O8TsVnZYtNV/p.s9xKCKkezWCqHzsnbJoASaORaR03J2koJ5N4iYC', 'http://dl.uu.cc/plugin/user/ledou.jpg', 'changshang', null, '1', '2', 'vgacmx0l2HFA0cJBXWkwBx80irMinD67vFim68K7zLd15VODp7rQVfpNMe3s', '2018-01-05 13:45:09', '2018-01-17 14:48:35');
INSERT INTO `user` VALUES ('4', 'tsh', 'tsh@tsh.com', '$2y$10$M59tPFWF.FgPS2jc1GNLjekHEkpSy440cI71aLxc1kp0rjj9UysDm', 'http://dl.uu.cc/plugin/user/rumi.jpg', 'tsh', null, '1', '2', null, null, null);

-- ----------------------------
-- Table structure for user_game
-- ----------------------------
DROP TABLE IF EXISTS `user_game`;
CREATE TABLE `user_game` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `game_id` int(10) unsigned NOT NULL COMMENT '游戏id',
  `appid` int(11) NOT NULL COMMENT 'MagicInstall 分配的appid',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `a_ratio` tinyint(8) unsigned DEFAULT '0' COMMENT 'A系数比例，新增分成，值为1-100',
  `s_ratio` tinyint(8) unsigned DEFAULT '0' COMMENT 'S系数比例，充值分成，值为1-100',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='用户游戏表';

-- ----------------------------
-- Records of user_game
-- ----------------------------
INSERT INTO `user_game` VALUES ('1', '1', '11828', '203', '0', 'DP0S0N00000', '0', '0', '2018-01-02 16:37:39', '2018-01-05 15:19:11');
INSERT INTO `user_game` VALUES ('2', '2', '11828', '203', '0', 'DP0S0N00000', '0', '0', '2018-01-02 17:01:25', '2018-01-05 15:19:13');
INSERT INTO `user_game` VALUES ('3', '3', '11828', '203', '0', 'DP0S0N00000', '0', '0', '2018-01-05 13:45:09', '2018-01-05 13:47:30');
INSERT INTO `user_game` VALUES ('4', '4', '11828', '203', '0', 'DP0S0N00000', '0', '0', '2018-01-05 21:19:45', '2018-01-05 21:19:45');