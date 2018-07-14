/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : train_company

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-07-14 21:10:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '真实姓名',
  `qq` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'qq号',
  `weixin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '微信号',
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号码',
  `school` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '学校',
  `major` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '专业',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '用户角色，0-学生，3-导师，7-管理员',
  `paper` text COLLATE utf8mb4_unicode_ci COMMENT '该用户的创建者id',
  `research` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `advance` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '李老四', '', '', '13212792240', '华科', '计算机', 'rumi.zhao@idreamsky.com', '$2y$10$SMfKhOsX3u92AmrdK9YvieSYXMg6MM1tLlF8vh6fVLhxj./2EwXH.', 'http://dl.uu.cc/plugin/user/rumi.jpg', '7', '0', null, 'LSwERKxjTqHDZFivNiDP4q5BBR70eDSPAngbNzDWgyeG4ftflAI0CygkcJNR', '2018-07-14 21:07:47', '2018-07-14 21:07:47', null);
INSERT INTO `user` VALUES ('2', 'idreamsky', '常博文', '', '', '12345678900', '武大', '金融', 'idreamsky@idreamsky.com', '$2y$10$M59tPFWF.FgPS2jc1GNLjekHEkpSy440cI71aLxc1kp0rjj9UysDm', 'http://dl.uu.cc/plugin/user/ledou.jpg', '0', '1', null, 'aEQ7vYW8U31WKGRu1uenGwhc8PWWWcCAb5iezqAFL7n07blcRWbdcJvLemJE', '2018-07-14 09:44:35', '2018-07-14 09:44:35', null);
INSERT INTO `user` VALUES ('3', 'changshang', '林莉莉', '', '', '13612345678', '北大', '数学', 'changshang@sd.dom', '$2y$10$Pqo6zc4KOxhGWFJPI848ZeFBGwZKNTJSY6jBb/2f40C4otpYAklLm', 'http://dl.uu.cc/plugin/user/ledou.jpg', '0', '2', null, null, '2018-07-14 09:44:15', '2018-07-14 09:44:15', null);
INSERT INTO `user` VALUES ('8', '13212792237', '王五', '', '', '13212792237', '武大', '经济', '13212792237@qq.com', '$2y$10$05hD18cYhOxQJOglyYM3FOfUUGAMTCqGA5PzskAsn2Lk7SpLNXXRi', 'http://dl.uu.cc/plugin/user/rumi.jpg', '7', null, null, 'Ui4m0j7Lb9YA6CRrxxANLX5rsiUnF6D99VzdPdRKAfd9d4tdzhFvFc4nejSG', '2018-07-14 21:08:17', '2018-07-14 21:08:17', null);
INSERT INTO `user` VALUES ('13', '13212792238', '张三', '', '', '', '理工', '化学', '', '$2y$10$dQPo9.izi8jokrgDsgc/eOdv4Gt6qQbKiEvXykrA1bPWHKZtsC6Z2', null, '0', null, null, '491lLgtgycLR1StysJHwLkw9A10xlFAE40Icj1cBy3K29GnhjpPFRuxLrLd7', '2018-07-14 21:08:57', '2018-07-14 21:08:57', null);
INSERT INTO `user` VALUES ('15', '13212792240', '赵六', '', '', '', '', '', '', '$2y$10$2WjVEjhZ7dSnDJRpGtrR..8zGKTEbbu0.aSDGdHU.YkOldxRFCDsO', null, '3', null, null, 'ZjwtmiIZpgStHYnY55e1fGsF0N7dqdVYtzUEU3Mk9G6loXhKgDV6NrKbdwIZ', '2018-07-14 21:08:08', '2018-07-14 21:08:08', null);
INSERT INTO `user` VALUES ('16', '13212792236', '钱二', '', '', '', '', '', '', '$2y$10$TwDqIaqErO4waCIZMoncgeJS7JbiZU3o7kH8oVwlCguy.lyymfW4C', null, '0', null, null, 'fSEOVYNY9MnFUmSj03MR6heaCnzJvbijrYyavewrxi2K5xql4kidALKaO5Lm', '2018-07-14 21:09:09', '2018-07-14 21:09:09', null);
