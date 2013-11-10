# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: apartments
# Generation Time: 2013-06-11 04:57:51 +0000
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
	(3,6,3,'123','Calgary, AB, Canada','','','51.0453246','-114.05810120000001','[\"2\",\"4\",\"5\"]'),
	(4,6,5,'Calgary','Calgary, AB, Canada','','','51.0453246','-114.05810120000001',''),
	(6,6,5,'Thursday 11th of April 2013 09:01:04 PM','Calgary, AB, Canada','','','51.0453246','-114.05810120000001',''),
	(7,12,5,'Calgary apartments','Calgary, AB, Canada','','','51.0453246','-114.05810120000001','');

/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;
UNLOCK TABLES;


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
  `smoking` int(11) NOT NULL DEFAULT '0',
  `pets` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `apartments` WRITE;
/*!40000 ALTER TABLE `apartments` DISABLE KEYS */;

INSERT INTO `apartments` (`id`, `title`, `descr`, `cost`, `lat`, `lng`, `address`, `img`, `user_id`, `type_id`, `status`, `date`, `smoking`, `pets`)
VALUES
	(60,'Dream Apartment','123',100,'45.68930109999999','126.60707839999998','137号 Tongji Street, Nangang, Haerbin, Heilongjiang, China',NULL,6,1,0,'2013-05-13 07:37:59',1,1),
	(61,'Amazing Apartment','Lol',123,'51.0453738','-114.05660390000003','800 Macleod Trail Southeast, Calgary, AB T2G 5E6, Canada',NULL,6,3,1,'2013-05-13 07:55:54',0,1),
	(62,'Bad Apartment','123123',434,'51.03772069999999','-114.1044948','1909 17 Avenue Southwest, Calgary, AB T2T 0E9, Canada',NULL,6,5,1,'2013-03-28 08:08:40',0,0),
	(63,'Dream Apartment','3123123',3123123,'50.9427134','-114.01644779999998','262-278 Diamond Drive Southeast, Calgary, AB T2J 7C8, Canada',NULL,6,1,1,'2013-03-28 10:16:21',0,0),
	(64,'Thutututu','dsfsdfsdfsdfsdfsdfsdf fdsf sdfsdfsdfsdf',300,'51.0453246','-114.05810120000001','Calgary, AB, Canada',NULL,6,2,1,'2013-04-12 16:54:29',0,0),
	(65,'Quite and peaceful place ','Quite apartment with all you need. Dogs and cats allowed.',300,'50.976251','-114.11480799999998','68 Baycrest Place Southwest, Calgary, AB T2V, Canada',NULL,6,4,1,'2013-04-12 17:15:51',0,0),
	(66,'Fusion','dasdasdads',123,'50.92246859999999','-113.98692449999999','Bow River Pathway, Calgary, AB T2Z 3S1, Canada',NULL,12,3,1,'2013-04-20 08:10:21',0,0);

/*!40000 ALTER TABLE `apartments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table apartments_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `apartments_users`;

CREATE TABLE `apartments_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `apartment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `apartment_id` (`apartment_id`),
  CONSTRAINT `apartments_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartments_users_ibfk_2` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;

INSERT INTO `applications` (`id`, `name`, `phone`, `email`, `sin`, `ref_name_1`, `ref_rel_1`, `ref_phone_1`, `ref_email_1`, `ref_name_2`, `ref_rel_2`, `ref_phone_2`, `ref_email_2`, `ref_name_3`, `ref_rel_3`, `ref_phone_3`, `ref_email_3`, `cur_addr`, `cur_city_prov`, `cur_post`, `cur_time`, `prev_addr`, `prev_city_prov`, `prev_post`, `prev_time`, `pets`, `parking`, `co_app`, `add_app`, `source`, `missed`, `user_id`)
VALUES
	(8,'Dmitry Litviak',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,6);

/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `apartment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;

INSERT INTO `images` (`id`, `name`, `apartment_id`)
VALUES
	(16,'4a103ac5b27a9af1e73fe050454d7b52.jpeg',58),
	(17,'f072336c7181d40ef5e25b169814ca84.jpg',58),
	(19,'7a78fe2043b30fba47c94f1c0ad81ef8.jpg',61),
	(20,'f600bdcab7954d336d33f523838da31e.jpg',61),
	(23,'e6e6ca752c4450096b095afaf7163ce9.jpg',62),
	(25,'60740ebbf083875546cb81ee5fbc28e0.jpg',62),
	(26,'63ab8249cd987b6d6ad6094f7d10b887.png',64),
	(27,'bfef796c7e51ebe1d5d13677a9b0908a.gif',66);

/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `description`)
VALUES
	(1,'login','Login privileges, granted after account confirmation'),
	(2,'admin','Administrative user, has access to everything.');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles_users`;

CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles_users` WRITE;
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;

INSERT INTO `roles_users` (`user_id`, `role_id`)
VALUES
	(6,1),
	(7,1),
	(8,1),
	(9,1),
	(10,1),
	(11,1),
	(12,1),
	(6,2);

/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;
UNLOCK TABLES;


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



# Dump of table types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `title`)
VALUES
	(1,'Studio'),
	(2,'1'),
	(3,'2'),
	(4,'3'),
	(5,'4+');

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_cookies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_cookies`;

CREATE TABLE `user_cookies` (
  `user_id` int(11) unsigned NOT NULL,
  `cookie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_cookies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table user_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_tokens`;

CREATE TABLE `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `logins`, `last_login`, `first_name`, `last_name`, `avatar`)
VALUES
	(6,'dmitry@bizonapps.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',28,1369716823,'Dmitry','Litviak','0ed6013bfb8e0d1b8ed5a4ff469b3f3c.png'),
	(7,'abot@mol.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',21,1363351740,'Zahar','Pecherin',NULL),
	(8,'alex@pushkin.ru','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',22,1363351518,'Alexander','Pushkin',NULL),
	(9,'rivardjon@gmail.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1363178462,'Jonathan','Rivard',NULL),
	(10,'bob@kelso.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1363193707,'Bob','Kelso',NULL),
	(11,'alex_m@gmail.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1363960969,'Aleksandr','Medvedev','a43a8dccbe47d93bfcea6ffa7b821491.png'),
	(12,'dmitry.litviak@gmail.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',2,1366442330,'Dmitry','Litviak',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
