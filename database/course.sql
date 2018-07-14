/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : train_company

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-07-14 21:11:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `course`
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_instrument` text COLLATE utf8mb4_unicode_ci,
  `student_work` text COLLATE utf8mb4_unicode_ci,
  `start_time` date DEFAULT NULL,
  `complete_time` date DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0',
  `teacher_duration` int(11) DEFAULT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('10', '15', '13', '二医院', '更好糊涂', '2018-07-14', '2018-07-14', '2018-07-14 20:56:05', '2018-07-14 20:56:05', '1', '5', '测试');
INSERT INTO `course` VALUES ('11', '15', '16', '不干胶很快就', '就好好机会', '2018-07-25', '2018-07-26', '2018-07-14 20:55:49', '2018-07-14 20:55:49', '0', '5', '赵六指导钱二');
