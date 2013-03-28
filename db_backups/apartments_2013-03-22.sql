# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: apartments
# Generation Time: 2013-03-22 17:58:21 +0000
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
	(43,'Calgary','gdfvdfvdfvdfv',100,'51.10430960000001','-114.11599960000001','1908 48 Avenue Northwest, Calgary, AB T2K 1J7, Canada','9a25f2a0ba6e3625fbad95677298e32d.png',6,3,1,'2013-03-13 15:33:44'),
	(46,'Good Apartment','ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iur',123,'51.02044069999999','-114.12119359999997','2633 Hochwald Avenue Southwest, Calgary, AB T3E 7K2, Canada','0e9845e95d343b1dd9c3e4ceba28a51a.jpg',8,1,1,'2013-03-22 18:52:16'),
	(47,'dwfsd','svdsdvsdv',100,'51.1211579','-114.12740710000003','Unnamed Road, Calgary, AB T3B 6A8, Canada',NULL,8,1,1,'2013-03-22 19:06:41'),
	(48,'Dream Apartment','сывсывсыс',1233,'52.9418231','-119.71477319999997','Fraser-Fort George H, BC, Canada',NULL,6,1,0,'2013-03-22 19:07:09');

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

LOCK TABLES `apartments_users` WRITE;
/*!40000 ALTER TABLE `apartments_users` DISABLE KEYS */;

INSERT INTO `apartments_users` (`id`, `user_id`, `apartment_id`)
VALUES
	(8,7,43),
	(10,7,46),
	(13,6,46);

/*!40000 ALTER TABLE `apartments_users` ENABLE KEYS */;
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
	(6,2);

/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;
UNLOCK TABLES;


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
	(6,'dmitry@bizonapps.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',16,1363963919,'Dmitry','Litviak','0ed6013bfb8e0d1b8ed5a4ff469b3f3c.png'),
	(7,'abot@mol.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',21,1363351740,'Zahar','Pecherin',NULL),
	(8,'alex@pushkin.ru','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',22,1363351518,'Alexander','Pushkin',NULL),
	(9,'rivardjon@gmail.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1363178462,'Jonathan','Rivard',NULL),
	(10,'bob@kelso.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1363193707,'Bob','Kelso',NULL),
	(11,'alex_m@gmail.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1363960969,'Aleksandr','Medvedev','a43a8dccbe47d93bfcea6ffa7b821491.png');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
