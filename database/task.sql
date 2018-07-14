/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : train_company

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-07-14 21:10:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `task`
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
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '任务状态：0：已创建，1-完成',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES ('1', '1', '2', '4.00', '一组执行任务的语句都可以视为一个函数，一个可调用对象。在程序设计的过程中，我们习惯于把那些具有复用性的一组语句抽象为函数，把变化的部分抽象为函数的参数。', '函数的使用能够极大的极少代码重复率，提高代码的灵活性。\r\n\r\nC++中具有函数这种行为的方式有很多。就函数调用方式而言', '2018-04-30', '2018-04-30', '1', '2018-04-30 15:23:52', '2018-07-13 16:35:06');
INSERT INTO `task` VALUES ('2', '1', '3', '4.00', 'ttsdfsd儿童尔尔', 'sdfsdf儿童团', '2018-04-30', '2018-04-30', '0', '2018-04-30 18:17:27', '2018-07-12 00:49:29');
INSERT INTO `task` VALUES ('4', '1', '3', '5.00', '测试', '接受测试', '2018-07-11', '2018-07-11', '1', '2018-07-11 20:06:11', '2018-07-13 16:35:10');
INSERT INTO `task` VALUES ('10', '15', '13', '0.00', '您已经开启新的指导项目，请为学员新增任务！', '', null, null, '1', '2018-07-14 20:19:03', '2018-07-14 20:56:05');
INSERT INTO `task` VALUES ('11', '15', '16', '0.00', '您已经开启新的指导项目，请为学员新增任务！', '', null, null, '0', '2018-07-14 20:40:51', '2018-07-14 20:40:51');
