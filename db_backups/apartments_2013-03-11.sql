# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: apartments
# Generation Time: 2013-03-11 14:54:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table apartments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `apartments`;

CREATE TABLE `apartments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '',
  `descr` text NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `lat` varchar(80) DEFAULT NULL,
  `lng` varchar(80) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `apartments` WRITE;
/*!40000 ALTER TABLE `apartments` DISABLE KEYS */;

INSERT INTO `apartments` (`id`, `title`, `descr`, `cost`, `lat`, `lng`, `address`, `img`, `user_id`, `type_id`, `status`, `date`)
VALUES
	(25,'Amazing Apartment','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',100,'40.1822838','-108.11066820000002','6453-7399 County Road 142, Meeker, CO 81641, USA','7e9aab26539e3e0751f947182aee4f0b.jpg',1,4,1,'2013-03-09 10:58:26'),
	(26,'Dream Apartment','Students and lonely people welcome! Phone: 555-555-55',100,'37.43901','-108.97924699999999','15997 County Road 10, Pleasant View, CO 81331, USA','edba86e1d2a9cf5a2dba1c9bbb7b048e.jpg',1,3,0,'2013-03-09 10:58:26'),
	(32,'123','123123123',200,'32.406395','-107.58512350000001','Highway 26, Deming, NM 88030, USA','29ebbefb4a114a4d3b63ad83fb44acab.jpg',1,3,0,'2013-03-09 10:58:26'),
	(34,'123123','123123',123123,'51.0378346','-114.0840933','930-940 17 Avenue Southwest, Calgary, AB T2T 0A2, Canada',NULL,1,3,0,'2013-03-10 19:47:39'),
	(35,'asddasdads','adsdadasd',123,'51.0914557','-114.1307607','4223-4243 Brisebois Drive Northwest, Calgary, AB T2L 2G1, Canada',NULL,1,4,0,'2013-03-10 19:48:08'),
	(36,'123123','123132',123123,'','','calgar',NULL,1,1,0,'2013-03-10 19:48:21'),
	(37,'sdaad','asdad',123,'51.12957859999999','-114.08462850000001','3-13 Berwick Hill Northwest, Calgary, AB T3K 1B8, Canada',NULL,1,3,0,'2013-03-10 19:49:16'),
	(38,'Dream Apartment','sgsfsgsgsfsg',100,'51.037748','-114.084044','EB 17 Av@9 St SW, Calgary, AB T2T, Canada','d9cb117becfa0952f9f441776e6178b4.jpg',1,3,0,'2013-03-11 18:21:59'),
	(39,'dasasd','asdasdasd',123,'51.06383839999999','-114.11508830000002','1312-1428 22A Street Northwest, Calgary, AB T2N 2N8, Canada',NULL,1,3,0,'2013-03-11 18:29:04'),
	(40,'czxczxc','zxczxc',1000,'51.02044069999999','-114.12119359999997','2633 Hochwald Avenue Southwest, Calgary, AB T3E 7K2, Canada',NULL,1,4,0,'2013-03-11 18:29:26'),
	(41,'fwefwef','wefwewef',111,'51.0824981','-114.09788000000003','3303-3339 Carol Drive Northwest, Calgary, AB T2L 0A1, Canada',NULL,1,3,0,'2013-03-11 18:32:46');

/*!40000 ALTER TABLE `apartments` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
