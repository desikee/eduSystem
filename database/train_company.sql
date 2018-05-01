/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : train_company

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2018-04-30 23:40:19
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of operation_log
-- ----------------------------
INSERT INTO `operation_log` VALUES ('1', '1', 'admin/home', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('2', '1', 'admin/login', 'POST', '127.0.0.1', '{\"username\":\"admin\",\"password\":\"rumi.zhao\"}', null, null);
INSERT INTO `operation_log` VALUES ('3', '1', 'admin/home', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('4', '1', 'admin/login', 'POST', '127.0.0.1', '{\"username\":\"admin\",\"password\":\"rumi.zhao\"}', null, null);
INSERT INTO `operation_log` VALUES ('5', '1', 'admin/promotion/statistics/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('6', '1', 'admin/promotion/link/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('7', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('8', '1', 'admin/promotion/statistics/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('9', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('10', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('11', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('12', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('13', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('14', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('15', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('16', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('17', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('18', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('19', '1', 'admin/game/config/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('20', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('21', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('22', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('23', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('24', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('25', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('26', '1', 'admin/game/config/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('27', '1', 'admin/game/config/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('28', '1', 'admin/game/config/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('29', '1', 'admin/game/config/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('30', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('31', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('32', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('33', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('34', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('35', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('36', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('37', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('38', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('39', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('40', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('41', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('42', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('43', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('44', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('45', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('46', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('47', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('48', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('49', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('50', '1', 'admin/promotion/link/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('51', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('52', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('53', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('54', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('55', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('56', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('57', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('58', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('59', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('60', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('61', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('62', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('63', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('64', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('65', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('66', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('67', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('68', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('69', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('70', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('71', '1', 'admin/promotion/statistics/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('72', '1', 'admin/profile/password', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('73', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('74', '1', 'admin/promotion/agent/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('75', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('76', '1', 'admin/promotion/statistics/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('77', '1', 'admin/promotion/statistics/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('78', '1', 'admin/promotion/link/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('79', '1', 'admin/promotion/statistics/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('80', '1', 'admin/system/user/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('81', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('82', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('83', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('84', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('85', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('86', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('87', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('88', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('89', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('90', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('91', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('92', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('93', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('94', '1', 'admin/profile/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('95', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('96', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('97', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('98', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('99', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('100', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('101', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('102', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('103', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('104', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('105', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('106', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('107', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('108', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('109', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('110', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('111', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('112', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('113', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('114', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('115', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('116', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('117', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('118', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('119', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('120', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('121', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('122', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('123', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('124', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('125', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('126', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('127', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('128', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('129', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('130', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('131', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('132', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('133', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('134', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('135', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('136', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('137', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('138', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('139', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('140', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('141', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('142', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('143', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('144', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('145', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('146', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('147', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('148', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('149', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('150', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('151', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('152', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('153', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('154', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('155', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('156', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('157', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('158', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('159', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('160', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('161', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('162', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('163', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('164', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('165', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('166', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('167', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('168', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('169', '1', 'admin/student/complete/index', 'GET', '127.0.0.1', '[]', null, null);
INSERT INTO `operation_log` VALUES ('170', '1', 'admin/student/progress/index', 'GET', '127.0.0.1', '[]', null, null);

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
  UNIQUE KEY `admin_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'admin', '管理员', '1', '2017-08-27 16:42:42', '2018-01-10 17:25:27');
INSERT INTO `role` VALUES ('2', 'teacher', '老师', '6', '2018-04-28 14:27:13', '2018-04-28 14:53:06');
INSERT INTO `role` VALUES ('3', 'student', '学生', '7', '2018-04-28 14:27:27', '2018-04-28 14:53:07');

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
INSERT INTO `role_user` VALUES ('3', '9', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('3', '10', '2018-01-05 21:19:45', '2018-01-05 21:19:45');
INSERT INTO `role_user` VALUES ('3', '11', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('4', '12', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('4', '13', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('4', '14', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('4', '20', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('4', '21', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('4', '22', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '15', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '16', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '17', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '18', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '19', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '23', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '24', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '25', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '26', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '27', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '28', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '29', '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `role_user` VALUES ('5', '30', '2018-01-05 13:45:09', '2018-01-05 13:45:09');

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `teacher_id` int(10) unsigned NOT NULL COMMENT '任务老师id',
  `student_id` int(10) unsigned NOT NULL COMMENT '任务所属学生id',
  `take_time` decimal(4,2) NOT NULL DEFAULT '0.00' COMMENT '任务所花时间',
  `teacher_task` text NOT NULL COMMENT '老师任务',
  `student_task` text NOT NULL COMMENT '学生任务',
  `start` date DEFAULT NULL COMMENT '开始日期',
  `deadline` date DEFAULT NULL COMMENT '截止时间',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '任务状态：0：已创建，',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('1', '1', '2', '4.00', '一组执行任务的语句都可以视为一个函数，一个可调用对象。在程序设计的过程中，我们习惯于把那些具有复用性的一组语句抽象为函数，把变化的部分抽象为函数的参数。', '函数的使用能够极大的极少代码重复率，提高代码的灵活性。\r\n\r\nC++中具有函数这种行为的方式有很多。就函数调用方式而言', '2018-04-30', '2018-04-30', '3', '2018-04-30 15:23:52', '2018-04-30 22:14:14');
INSERT INTO `task` VALUES ('2', '1', '3', '4.00', 'ttsdfsd', 'sdfsdf', '2018-04-30', '2018-04-30', '3', '2018-04-30 18:17:27', '2018-04-30 22:14:17');
INSERT INTO `task` VALUES ('3', '1', '4', '10.00', 'aaaa', 'aaaaaaa', '2018-04-30', '2018-04-30', '0', '2018-04-30 18:20:03', '2018-04-30 22:14:20');

-- ----------------------------
-- Table structure for task_record
-- ----------------------------
DROP TABLE IF EXISTS `task_record`;
CREATE TABLE `task_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `task_id` int(10) unsigned NOT NULL COMMENT '任务id',
  `teacher_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改老师id',
  `student_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改学生id',
  `before_status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '修改之前状态',
  `after_status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '修改之后状态',
  `reason` text NOT NULL COMMENT '修改原因',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task_record
-- ----------------------------

-- ----------------------------
-- Table structure for user
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
  `status` tinyint(4) DEFAULT '1' COMMENT '用户状态',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT '该用户的创建者id',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '', '', '', '', '', '', 'rumi.zhao@idreamsky.com', '$2y$10$SMfKhOsX3u92AmrdK9YvieSYXMg6MM1tLlF8vh6fVLhxj./2EwXH.', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '0', 'fp8p5Sqkjzjp6ZZXlK6E0wTIeTw0WrB55hoApJzCwCzCeRwn1W3LYV90zCs1', '2017-08-27 16:42:42', '2018-01-05 11:35:00');
INSERT INTO `user` VALUES ('2', 'idreamsky', '常博文', '', '', '', '', '', 'idreamsky@idreamsky.com', '$2y$10$M59tPFWF.FgPS2jc1GNLjekHEkpSy440cI71aLxc1kp0rjj9UysDm', 'http://dl.uu.cc/plugin/user/ledou.jpg', '1', '1', 'aEQ7vYW8U31WKGRu1uenGwhc8PWWWcCAb5iezqAFL7n07blcRWbdcJvLemJE', '2017-08-27 16:42:42', '2017-08-27 16:42:42');
INSERT INTO `user` VALUES ('3', 'changshang', '林莉莉', '', '', '', '', '', 'changshang@sd.dom', '$2y$10$Pqo6zc4KOxhGWFJPI848ZeFBGwZKNTJSY6jBb/2f40C4otpYAklLm', 'http://dl.uu.cc/plugin/user/ledou.jpg', '1', '2', null, '2018-01-05 13:45:09', '2018-01-05 13:45:09');
INSERT INTO `user` VALUES ('4', 'tb', '肖晓', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '2', null, '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('5', 'tsh', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '2', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('12', 'tsh_agent_1', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '11', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('13', 'tsh_agent_2', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '11', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('14', 'tsh_agent_3', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '11', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('15', 'tsh_person_1', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '12', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('16', 'tsh_person_2', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '12', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('17', 'tsh_person_3', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '12', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('18', 'tsh_person_4', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '13', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('19', 'tsh_person_5', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '14', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('20', 'cs_agent_1', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '9', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('21', 'cs_agent_2', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '9', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('22', 'cs_agent_3', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '9', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('23', 'cs_person_1', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '20', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('24', 'cs_person_2', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '20', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('25', 'cs_person_3', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '20', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('26', 'cs_person_4', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '20', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('27', 'cs_person_5', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '21', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('28', 'cs_person_6', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '22', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('29', 'cs_person_7', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '22', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
INSERT INTO `user` VALUES ('30', 'cs_person_8', '', '', '', '', '', '', 'sd@sd.po', '$2y$10$HnTwAJAKXJWatQ8qlJtsleroemPSwjGGehzArChWCjyqIPiOWHFvS', 'http://dl.uu.cc/plugin/user/rumi.jpg', '1', '22', '', '2018-01-05 21:19:44', '2018-01-05 21:19:44');
