# Host: localhost  (Version: 5.5.38)
# Date: 2015-07-23 22:42:56
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS msg;
USE msg;
#
# Structure for table "msgs"
#

DROP TABLE IF EXISTS `msgs`;
CREATE TABLE `msgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '留言标题',
  `body` varchar(20000) COMMENT '留言内容',
  `userid` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

#
# Data for table "msgs"
#

/*!40000 ALTER TABLE `msgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `msgs` ENABLE KEYS */;

#
# Structure for table "rmsgs"
#

DROP TABLE IF EXISTS `rmsgs`;
CREATE TABLE `rmsgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `msgid` int(11) NOT NULL COMMENT "被回复的留言的id",
  `body` VARCHAR(10000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

#
# Data for table "rmsgs"
#

/*!40000 ALTER TABLE `rmsgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `rmsgs` ENABLE KEYS */;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `regtime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
