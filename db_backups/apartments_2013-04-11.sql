# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: apartments
# Generation Time: 2013-04-11 18:57:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table alerts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `alerts`;

CREATE TABLE `alerts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `count` int(11) NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `search` varchar(200) DEFAULT NULL,
  `from` varchar(11) DEFAULT NULL,
  `to` varchar(11) DEFAULT NULL,
  `lat` varchar(80) DEFAULT NULL,
  `lng` varchar(80) DEFAULT NULL,
  `type_id` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `alerts` WRITE;
/*!40000 ALTER TABLE `alerts` DISABLE KEYS */;

INSERT INTO `alerts` (`id`, `user_id`, `count`, `title`, `search`, `from`, `to`, `lat`, `lng`, `type_id`)
VALUES
	(3,6,1,'123','Calgary, AB, Canada','','','51.0453246','-114.05810120000001','[\"2\",\"4\",\"5\"]'),
	(4,6,3,'Calgary','Calgary, AB, Canada','','','51.0453246','-114.05810120000001','');

/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
