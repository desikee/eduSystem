/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50629
Source Host           : localhost:3306
Source Database       : uu_magic_install

Target Server Type    : MYSQL
Target Server Version : 50629
File Encoding         : 65001

Date: 2018-01-17 16:58:36
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
  PRIMARY KEY (`id`),
  KEY `index_action_union_moto` (`link_id`,`game_id`,`channel_id`,`action`,`date`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='上报事件';

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
  UNIQUE KEY `uk_device_link` (`link_id`,`device_id`) COMMENT '设备和访问页面唯一性',
  KEY `index_device_link_id` (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='浏览器记录';

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='IOS深链相关配置表';

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
  PRIMARY KEY (`id`),
  KEY ` index_device_public_ip` (`public_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='设备信息表';

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
  PRIMARY KEY (`id`),
  KEY `link_player_id_index` (`player_id`) COMMENT 'player_id索引',
  KEY `index_link_union_link_creat_param` (`player_id`,`gameid`,`appid`,`action`,`creator`,`transport`),
  KEY `index_link_union_player_appid` (`player_id`,`appid`) COMMENT '玩家和应用的索引',
  KEY `index_link_union_player_gameid` (`player_id`,`gameid`) COMMENT '玩家和游戏id索引'
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='短链映射表';

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
  UNIQUE KEY `uk_relation_player_invite` (`player_id`,`invite_player_id`) USING BTREE,
  KEY `index_relation_link_id` (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COMMENT='玩家链接对应关系';
