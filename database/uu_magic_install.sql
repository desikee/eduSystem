/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50629
Source Host           : localhost:3306
Source Database       : uu_magic_install

Target Server Type    : MYSQL
Target Server Version : 50629
File Encoding         : 65001

Date: 2017-12-31 23:19:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for action
-- ----------------------------
DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL COMMENT '邀请链接id',
  `game_id` int(10) unsigned NOT NULL COMMENT '游戏id',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `action` varchar(50) DEFAULT NULL COMMENT '操作',
  `times` bigint(10) unsigned DEFAULT NULL COMMENT '访问次数',
  `date` date DEFAULT NULL COMMENT '访问日期',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='上报事件';

-- ----------------------------
-- Records of action
-- ----------------------------
INSERT INTO `action` VALUES ('1', '0', '0', '', 'come', '14', '2017-12-05', '2017-12-05 17:26:35');
INSERT INTO `action` VALUES ('2', '1', '10389', 'LE00000101', 'share', '16', '2017-12-21', '2017-12-21 10:41:23');
INSERT INTO `action` VALUES ('3', '1', '10389', 'DP0S0N00000', 'browse visit', '13', '2017-12-21', '2017-12-21 10:41:23');
INSERT INTO `action` VALUES ('4', '0', '0', '', 'come', '26', '2017-12-21', '2017-12-21 10:41:23');
INSERT INTO `action` VALUES ('5', '2', '10389', 'LE00000101', 'share', '10', '2017-12-21', '2017-12-21 19:29:14');
INSERT INTO `action` VALUES ('6', '2', '10389', 'DP0S0N00000', 'browse visit', '9', '2017-12-21', '2017-12-21 19:30:13');
INSERT INTO `action` VALUES ('7', '3', '10389', 'OP0S0N02002', 'share', '1', '2017-12-28', '2017-12-28 14:25:51');
INSERT INTO `action` VALUES ('8', '3', '10389', 'OP0S0N02002', 'browse visit', '1', '2017-12-28', '2017-12-28 14:25:52');
INSERT INTO `action` VALUES ('9', '0', '0', '', 'come', '1', '2017-12-28', '2017-12-28 14:25:52');

-- ----------------------------
-- Table structure for browser
-- ----------------------------
DROP TABLE IF EXISTS `browser`;
CREATE TABLE `browser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL COMMENT '邀请链接id',
  `game_id` int(10) unsigned NOT NULL COMMENT '游戏id',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `player_id` bigint(10) unsigned DEFAULT NULL COMMENT '创建连接的玩家id',
  `invite_player_id` bigint(10) unsigned DEFAULT NULL COMMENT '点击分享连接的玩家id',
  `device_id` int(10) DEFAULT NULL COMMENT '被邀请的用户的设备表id',
  `action` varchar(50) DEFAULT NULL COMMENT '操作',
  `browse` varchar(255) DEFAULT NULL COMMENT '访问浏览器类型',
  `visited` int(10) unsigned DEFAULT '0' COMMENT '记录访问次数',
  `used` int(10) unsigned DEFAULT '0' COMMENT '使用次数',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '配置创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_device_link` (`link_id`,`device_id`) COMMENT '设备和访问页面唯一性'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='浏览器记录';

-- ----------------------------
-- Records of browser
-- ----------------------------
INSERT INTO `browser` VALUES ('1', '0', '0', '', '0', null, '1', null, null, '14', '4', '2017-12-05 17:26:35');
INSERT INTO `browser` VALUES ('2', '1', '10389', 'DP0S0N00000', '15298653', null, '2', null, null, '9', '16', '2017-12-21 10:41:23');
INSERT INTO `browser` VALUES ('3', '0', '0', '', '0', null, '2', null, null, '3', '1', '2017-12-21 14:58:00');
INSERT INTO `browser` VALUES ('4', '1', '10389', 'DP0S0N00000', '15298653', null, '3', null, null, '4', '0', '2017-12-21 19:22:50');
INSERT INTO `browser` VALUES ('5', '0', '0', '', '0', null, '3', null, null, '1', '0', '2017-12-21 19:29:14');
INSERT INTO `browser` VALUES ('6', '2', '10389', 'DP0S0N00000', '152985653', null, '3', null, null, '9', '0', '2017-12-21 19:30:13');
INSERT INTO `browser` VALUES ('7', '3', '10389', 'OP0S0N02002', '15298635', null, '3', null, null, '1', '0', '2017-12-28 14:25:52');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` int(10) NOT NULL COMMENT '兼容安卓和iOS的游戏唯一标识',
  `game_id` int(10) NOT NULL COMMENT '游戏id',
  `channel_id` varchar(20) NOT NULL COMMENT '渠道id',
  `game_name` varchar(255) DEFAULT NULL COMMENT '游戏名',
  `channel_name` varchar(50) DEFAULT NULL COMMENT '渠道名称',
  `package_name` varchar(255) DEFAULT NULL COMMENT '游戏包名',
  `link_host` varchar(255) DEFAULT NULL COMMENT '分享页面地址',
  `platform` varchar(10) DEFAULT NULL COMMENT '平台：android，ios',
  `scheme` varchar(50) DEFAULT NULL COMMENT '系统的scheme（由后台配置）',
  `scheme_host` varchar(50) DEFAULT NULL COMMENT 'scheme的域，区分游戏',
  `market` varchar(255) DEFAULT NULL COMMENT 'market协议，应用商城下载',
  `apple_app_site_url` varchar(255) DEFAULT '' COMMENT 'ios通用链接地址',
  `download_url` varchar(255) DEFAULT NULL COMMENT '该app的下载地址',
  `is_default` tinyint(4) unsigned DEFAULT '0' COMMENT '是否默认渠道',
  `status` tinyint(4) unsigned DEFAULT '1' COMMENT '当前配置转态是否可用 1表示可用',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '配置更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_config_game_channel` (`game_id`,`channel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='IOS深链相关配置表';

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('2', '200', '10667', 'LE00000101', '地铁跑酷（iOS）', '苹果', null, 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'ios', 'magicinstall', 'dt.idreamsky.com', 'market://search?q=地铁跑酷', '', 'https://itunes.apple.com/cn/app/id995122577', '1', '1', '2017-12-01 10:05:31');
INSERT INTO `config` VALUES ('4', '200', '10389', 'DP0S0N00000', '地铁跑酷（Android）', '官网', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'android', 'magicinstall', 'dt.idreamsky.com', 'market://search?q=地铁跑酷', '', 'http://app.uu.cc/casual-games/subwaysurfers/GW/SubwaySurf-Free_GW.apk', '1', '1', '2017-12-01 10:05:12');
INSERT INTO `config` VALUES ('5', '200', '10389', 'OP0S0N02002', '地铁跑酷（Android）', 'OPPO', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'android', 'magicinstall', 'dt.idreamsky.com', 'market://search?q=地铁跑酷', '', 'http://app.uu.cc/casual-games/subwaysurfers/OPPO/SubwaySurf-Free_OPPO.apk', '0', '1', '2017-12-01 10:05:13');
INSERT INTO `config` VALUES ('6', '200', '10389', 'HW0S0N00018', '地铁跑酷（Android）', '华为', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'android', 'magicinstall', 'dt.idreamsky.com', 'market://search?q=地铁跑酷', '', 'http://app.uu.cc/casual-games/subwaysurfers/HW/SubwaySurf-Free_HW.apk', '0', '1', '2017-12-01 10:05:17');
INSERT INTO `config` VALUES ('7', '200', '10389', 'BG0S0N00002', '地铁跑酷（Android）', 'VIVO', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'android', 'magicinstall', 'dt.idreamsky.com', 'market://search?q=地铁跑酷', '', 'http://app.uu.cc/casual-games/subwaysurfers/VIVO/SubwaySurf-Free_VIVO.apk', '0', '1', '2017-12-01 10:05:22');
INSERT INTO `config` VALUES ('8', '200', '10389', 'NT0S0N00002', '地铁跑酷（Android）', '应用宝', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'android', 'magicinstall', 'dt.idreamsky.com', 'market://search?q=地铁跑酷', '', 'http://a.app.qq.com/o/simple.jsp?pkgname=com.kiloo.subwaysurf', '0', '1', '2017-12-01 10:05:27');
INSERT INTO `config` VALUES ('10', '203', '11828', 'DP0S0N00000', '梦幻花园（Android）', '官网', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html', 'android', 'magicinstall', 'mhhy.idreamsky.com', 'market://search?q=梦幻花园', '', 'http://app.uu.cc/casual-games/subwaysurfers/GW/SubwaySurf-Free_GW.apk', '1', '1', '2017-12-01 10:05:12');

-- ----------------------------
-- Table structure for device
-- ----------------------------
DROP TABLE IF EXISTS `device`;
CREATE TABLE `device` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `player_id` bigint(20) unsigned DEFAULT NULL COMMENT '该设备识别的玩家id',
  `local_ip` varchar(20) DEFAULT NULL COMMENT '局域网IP',
  `public_ip` varchar(20) NOT NULL COMMENT '公网IP',
  `address` varchar(50) DEFAULT NULL COMMENT '所在区域：广东省深圳市',
  `device_id` varchar(50) DEFAULT NULL COMMENT '设备唯一标识',
  `platform_id` varchar(50) DEFAULT NULL COMMENT '设备平台唯一标识: android_id',
  `install_id` varchar(50) DEFAULT NULL COMMENT '本地记录唯一标识',
  `platform_name` varchar(10) DEFAULT NULL COMMENT '平台名称，如： Android',
  `platform_version` varchar(10) DEFAULT NULL COMMENT '平台版本号，如安卓的 4.4.2',
  `screen` varchar(50) DEFAULT NULL COMMENT '设备屏幕信息：width,height,colorDepth,devicePixelRatio',
  `brand` varchar(20) DEFAULT NULL COMMENT '设备品牌',
  `model` varchar(20) DEFAULT NULL COMMENT '设备型号',
  `webGL` varchar(255) DEFAULT NULL COMMENT 'GPU信息：vendor,renderer',
  `useragent` varchar(255) DEFAULT NULL COMMENT '浏览器的UserAgent代理',
  `extend` text COMMENT '扩展信息',
  `created` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='设备信息表';

-- ----------------------------
-- Records of device
-- ----------------------------
INSERT INTO `device` VALUES ('2', '15298653', '192.168.121.41', '127.0.0.1', '', '867140031815596', '26c747db9715cc9c', null, 'Android', '7.0', '', 'samsung', 'SM-G9500', '', '', '', '2017-12-21 10:41:23');
INSERT INTO `device` VALUES ('3', null, '192.168.121.45', '127.0.0.1', '', '', '', null, '', '', '', '', '', '', '', '', null);

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `player_id` bigint(10) unsigned DEFAULT NULL COMMENT '生成链接的玩家id',
  `gameid` int(10) DEFAULT NULL COMMENT '游戏唯一标识（安卓和iOS不一致）',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `appid` int(10) DEFAULT NULL COMMENT '游戏或应用的唯一标识',
  `short_url` varchar(50) DEFAULT NULL COMMENT '第三方生成的短连接',
  `source_url` varchar(255) DEFAULT NULL COMMENT '原来的链接',
  `action` varchar(255) DEFAULT '' COMMENT 'scheme协议中的动作（创建短链时指定）',
  `creator` varchar(50) DEFAULT NULL COMMENT '创建者，可为android_adk，ios_sdk，cp，other',
  `extend` varchar(255) DEFAULT NULL COMMENT '自有扩展参数',
  `transport` varchar(255) DEFAULT NULL COMMENT '三方应用透传参数',
  `times` int(10) DEFAULT NULL COMMENT '记录访问次数，便于统计',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='短链映射表';

-- ----------------------------
-- Records of link
-- ----------------------------
INSERT INTO `link` VALUES ('1', '15298653', '10389', 'LE00000101', '200', null, 'http://test.feed.online.ids111.com/share/dtpk/index.html?link_id=1', 'open', 'android_sdk', '', '{\"name\":\"uusama\",\"age\":20}', '14', '2017-12-21 10:41:23', '2017-12-21 10:41:23');
INSERT INTO `link` VALUES ('2', '152985653', '10389', 'LE00000101', '200', null, 'http://test.feed.online.ids111.com/share/dtpk/index.html?link_id=2', 'open', 'android_sdk', '', '{\"name\":\"uusama\",\"age\":20}', '10', '2017-12-21 19:29:14', '2017-12-21 19:29:14');
INSERT INTO `link` VALUES ('3', '15298635', '10389', 'OP0S0N02002', '200', '', 'http://test.feed.online.ids111.com/share/dtpk/index.html?link_id=3', 'open', 'android_sdk', '', '{\"name\":\"uusama\",\"age\":20}', '2', '2017-12-28 14:25:51', '2017-12-28 14:25:51');

-- ----------------------------
-- Table structure for link_backend
-- ----------------------------
DROP TABLE IF EXISTS `link_backend`;
CREATE TABLE `link_backend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `link_code` varchar(50) DEFAULT NULL COMMENT '链接唯一标识字符串',
  `link_name` varchar(255) DEFAULT NULL COMMENT '链接名称',
  `user_id` bigint(10) unsigned DEFAULT NULL COMMENT '生成链接的用户id',
  `gameid` int(10) DEFAULT NULL COMMENT '游戏唯一标识（安卓和iOS不一致）',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `appid` int(10) DEFAULT NULL COMMENT '游戏或应用的唯一标识',
  `action_name` varchar(50) DEFAULT NULL COMMENT '活动名称',
  `company_name` varchar(100) DEFAULT NULL COMMENT '链接所属公司名称',
  `team_name` varchar(100) DEFAULT NULL COMMENT '链接所属团队名称',
  `person_name` varchar(100) DEFAULT NULL COMMENT '链接所属个人名称',
  `short_url` varchar(50) DEFAULT NULL COMMENT '第三方生成的短连接',
  `source_url` varchar(255) DEFAULT NULL COMMENT '落地也链接',
  `scheme` varchar(255) DEFAULT NULL COMMENT 'scheme协议地址，如果没有指定则使用默认配置的',
  `extend` varchar(255) DEFAULT NULL COMMENT '自有扩展参数',
  `transport` varchar(255) DEFAULT NULL COMMENT '三方应用透传参数',
  `times` int(10) DEFAULT NULL COMMENT '记录访问次数，便于统计',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='后台生成的短链映射表';

-- ----------------------------
-- Records of link_backend
-- ----------------------------
INSERT INTO `link_backend` VALUES ('1', 'TGHSE', '梦幻花园中国移动河南团队链接', '1', '11828', 'DP0S0N00000', '203', '2017Christmas', null, null, null, null, null, '', null, '{\"action\":\"addfriend\",transport\":{\"player_id\": \"12563254\"}}', null, '2017-12-28 14:38:26', '2017-12-28 14:40:29');
INSERT INTO `link_backend` VALUES ('2', 'TGDFA', '梦幻花园中国移动广东团队链接', '1', '11828', 'DP0S0N00000', '203', '2017Christmas', null, null, null, null, null, '', null, '{\"action\":\"addfriend\",transport\":{\"player_id\": \"12563254\"}}', null, '2017-12-28 14:40:47', '2017-12-28 14:41:33');

-- ----------------------------
-- Table structure for relation
-- ----------------------------
DROP TABLE IF EXISTS `relation`;
CREATE TABLE `relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL COMMENT '关联链接id',
  `game_id` int(10) unsigned NOT NULL COMMENT '游戏id',
  `channel_id` varchar(20) DEFAULT NULL COMMENT '渠道id',
  `player_id` bigint(10) unsigned DEFAULT NULL COMMENT '创建连接的玩家id',
  `invite_player_id` bigint(10) unsigned DEFAULT NULL COMMENT '点击分享连接的玩家id',
  `action` varchar(50) DEFAULT NULL COMMENT '操作',
  `status` tinyint(4) DEFAULT '0' COMMENT '该条记录状态：初始态-0，通知游戏-1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '关系创建时间',
  PRIMARY KEY (`id`),
  KEY `uk_relation_player_invite` (`player_id`,`invite_player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='玩家链接对应关系';

-- ----------------------------
-- Records of relation
-- ----------------------------
INSERT INTO `relation` VALUES ('8', '1', '10389', 'LE00000101', '15298653', '0', null, '0', '2017-12-21 10:56:47');
INSERT INTO `relation` VALUES ('9', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 10:57:14');
INSERT INTO `relation` VALUES ('10', '0', '0', '', '0', '283923', null, '0', '2017-12-21 14:58:01');
INSERT INTO `relation` VALUES ('11', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 14:59:26');
INSERT INTO `relation` VALUES ('12', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 15:01:35');
INSERT INTO `relation` VALUES ('13', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 15:02:19');
INSERT INTO `relation` VALUES ('14', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 19:21:22');
INSERT INTO `relation` VALUES ('15', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 19:22:01');
INSERT INTO `relation` VALUES ('16', '1', '10389', 'LE00000101', '15298653', '283923', null, '0', '2017-12-21 19:22:28');
INSERT INTO `relation` VALUES ('17', '1', '10389', 'LE00000101', '15298653', '2839523', null, '0', '2017-12-21 19:22:50');
INSERT INTO `relation` VALUES ('18', '1', '10389', 'LE00000101', '15298653', '2839523', null, '0', '2017-12-21 19:23:50');
INSERT INTO `relation` VALUES ('19', '1', '10389', 'LE00000101', '15298653', '2839523', null, '0', '2017-12-21 19:26:52');
INSERT INTO `relation` VALUES ('20', '1', '10389', 'LE00000101', '15298653', '2839523', null, '0', '2017-12-21 19:28:16');
INSERT INTO `relation` VALUES ('21', '1', '10389', 'LE00000101', '15298653', '2839523', null, '0', '2017-12-21 19:30:13');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `role_id` int(10) unsigned DEFAULT '0' COMMENT '用户角色id',
  `username` varchar(50) DEFAULT '' COMMENT '用户名',
  `email` varchar(100) DEFAULT '' COMMENT '用户邮箱',
  `avator` varchar(255) DEFAULT '' COMMENT '用户头像地址',
  `password` varchar(50) DEFAULT '' COMMENT '游戏唯一标识（安卓和iOS不一致）',
  `salt` varchar(10) DEFAULT '' COMMENT '密码加密附加串',
  `company` varchar(100) DEFAULT '' COMMENT '用户公司名称',
  `team` varchar(100) DEFAULT '' COMMENT '用户所属团队',
  `status` tinyint(4) DEFAULT '1' COMMENT '用户当前状态',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '表更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '1', 'rumi.zhao', 'rumi.zhao@idreamsky.com', '', '', 'FRGT', 'idreamsky', 'plugin', '1', '2017-12-28 14:44:40', '2017-12-28 14:44:40');
