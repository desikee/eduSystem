/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50629
Source Host           : localhost:3306
Source Database       : admin

Target Server Type    : MYSQL
Target Server Version : 50629
File Encoding         : 65001

Date: 2018-01-05 13:39:43
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
) ENGINE=InnoDB AUTO_INCREMENT=11779 DEFAULT CHARSET=utf8 COMMENT='游戏主表';

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
  `mi_link_id` varchar(50) DEFAULT NULL COMMENT 'MagicInstall中的link_id',
  `link_name` varchar(100) DEFAULT NULL COMMENT '链接名称',
  `user_id` bigint(10) unsigned DEFAULT NULL COMMENT '生成链接的用户id',
  `game_id` int(10) DEFAULT NULL COMMENT '游戏唯一标识（安卓和iOS不一致）',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `appid` int(10) DEFAULT NULL COMMENT '游戏或应用的唯一标识',
  `action_name` varchar(50) DEFAULT NULL COMMENT '活动名称',
  `person_name` varchar(100) DEFAULT NULL COMMENT '链接所属个人名称',
  `short_url` varchar(50) DEFAULT NULL COMMENT '第三方生成的短连接',
  `source_url` varchar(255) DEFAULT NULL COMMENT '落地页面链接',
  `scheme` varchar(255) DEFAULT NULL COMMENT 'scheme协议地址，如果没有指定则使用默认配置的',
  `extend` varchar(255) DEFAULT NULL COMMENT '自有扩展参数',
  `transport` varchar(255) DEFAULT NULL COMMENT '三方应用透传参数',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
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
-- Records of operation_log
-- ----------------------------

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限名称',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限描述',
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission
-- ----------------------------

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色描述',
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'administrator', '管理员', 'administrator', '2017-08-27 16:42:42', '2018-01-01 17:40:09');
INSERT INTO `role` VALUES ('2', 'company_admin', '地推公司管理者', '', '2018-01-01 17:41:18', '2018-01-01 17:41:20');
INSERT INTO `role` VALUES ('3', 'company', '地推公司', '', '2018-01-01 17:40:35', '2018-01-01 17:41:02');

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
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', null, null);
INSERT INTO `role_user` VALUES ('2', '2', null, null);
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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'rumi.zhao@idreamsky.com', '$2y$10$SMfKhOsX3u92AmrdK9YvieSYXMg6MM1tLlF8vh6fVLhxj./2EwXH.', 'http://dl.uu.cc/plugin/user/rumi.jpg', null, null, 'Sykex0mFrALf9LIBgIHjZ7FKwsjf0jhoa1fzvHZtXkH9nv1ad4E2AMdaH843', '2017-08-27 16:42:42', '2018-01-05 11:35:00');
INSERT INTO `user` VALUES ('2', 'idreamsky', 'idreamsky@idreamsky.com', '$2y$10$M59tPFWF.FgPS2jc1GNLjekHEkpSy440cI71aLxc1kp0rjj9UysDm', 'http://dl.uu.cc/plugin/user/ledou.jpg', '', '', 'PNrKuOGGxKl21tPAACQ4V4ALGLUKV0ZmVYdOupHe53zj2NMkJq3j9yXhNwwn', '2017-08-27 16:42:42', '2017-08-27 16:42:42');

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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户游戏表';

-- ----------------------------
-- Records of user_game
-- ----------------------------
INSERT INTO `user_game` VALUES ('1', '1', '11828', '203', '0', 'DP0S0N00000', '2018-01-02 16:37:39', '2018-01-02 17:10:36');
INSERT INTO `user_game` VALUES ('2', '2', '11828', '203', '0', 'DP0S0N00000', '2018-01-02 17:01:25', '2018-01-02 17:10:38');
