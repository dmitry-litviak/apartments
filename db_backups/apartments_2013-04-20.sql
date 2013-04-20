# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: apartments
# Generation Time: 2013-04-20 07:28:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table applications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `applications`;

CREATE TABLE `applications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `phone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `sin` varchar(200) DEFAULT NULL,
  `ref_name_1` varchar(200) DEFAULT NULL,
  `ref_rel_1` varchar(200) DEFAULT NULL,
  `ref_phone_1` varchar(200) DEFAULT NULL,
  `ref_email_1` varchar(200) DEFAULT NULL,
  `ref_name_2` varchar(200) DEFAULT NULL,
  `ref_rel_2` varchar(200) DEFAULT NULL,
  `ref_phone_2` varchar(200) DEFAULT NULL,
  `ref_email_2` varchar(200) DEFAULT NULL,
  `ref_name_3` varchar(200) DEFAULT NULL,
  `ref_rel_3` varchar(200) DEFAULT NULL,
  `ref_phone_3` varchar(200) DEFAULT NULL,
  `ref_email_3` varchar(200) DEFAULT NULL,
  `cur_addr` varchar(200) DEFAULT NULL,
  `cur_city_prov` varchar(200) DEFAULT NULL,
  `cur_post` varchar(200) DEFAULT NULL,
  `cur_time` varchar(200) DEFAULT NULL,
  `prev_addr` varchar(200) DEFAULT NULL,
  `prev_city_prov` varchar(200) DEFAULT NULL,
  `prev_post` varchar(200) DEFAULT NULL,
  `prev_time` varchar(200) DEFAULT NULL,
  `pets` varchar(200) DEFAULT NULL,
  `parking` varchar(200) NOT NULL DEFAULT '',
  `co_app` varchar(200) DEFAULT NULL,
  `add_app` varchar(200) DEFAULT NULL,
  `source` varchar(200) DEFAULT NULL,
  `missed` varchar(200) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table sends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sends`;

CREATE TABLE `sends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
