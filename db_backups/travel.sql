# SQL Manager 2010 for MySQL 4.5.0.9
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : travel


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `travel`;

CREATE DATABASE `travel`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_unicode_ci';

USE `travel`;

#
# Structure for the `countries` table : 
#

CREATE TABLE `countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of a country',
  `code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `roles` table : 
#

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Structure for the `user_profiles` table : 
#

CREATE TABLE `user_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` timestamp NULL DEFAULT NULL,
  `phone_landline` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hr_manager` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hr_manager_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) unsigned NOT NULL DEFAULT '1',
  `p_country_id` int(11) unsigned NOT NULL DEFAULT '1',
  `nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_issue_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_expiry_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `users` table : 
#

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `user_profile_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_email` (`email`),
  UNIQUE KEY `uniq_profile` (`user_profile_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Structure for the `roles_users` table : 
#

CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `trip_place_destinations` table : 
#

CREATE TABLE `trip_place_destinations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `destination` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of a country',
  `code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `trips` table : 
#

CREATE TABLE `trips` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `whos_trip` (`user_id`),
  CONSTRAINT `whos_trip` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `trip_places` table : 
#

CREATE TABLE `trip_places` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) unsigned DEFAULT NULL,
  `trip_place_destination_id` int(11) unsigned DEFAULT NULL,
  `date_from` varchar(50) DEFAULT NULL,
  `date_to` varchar(50) DEFAULT NULL,
  `duration_of_stay` varchar(50) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `visa_status` varchar(100) DEFAULT NULL,
  `visa_number` varchar(50) DEFAULT NULL,
  `visa_issue_date` varchar(50) DEFAULT NULL,
  `visa_exp_date` varchar(50) DEFAULT NULL,
  `visa_scan` varchar(100) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `whos_place` (`trip_id`),
  CONSTRAINT `whos_place` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Structure for the `user_cookies` table : 
#

CREATE TABLE `user_cookies` (
  `user_id` int(11) unsigned NOT NULL,
  `cookie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_cookies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `user_tokens` table : 
#

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

#
# Data for the `countries` table  (LIMIT 0,500)
#

INSERT INTO `countries` (`id`, `name`, `code`) VALUES 
  (1,'AFGHANISTAN','AF'),
  (2,'ÃLAND ISLANDS','AX'),
  (3,'ALBANIA','AL'),
  (4,'ALGERIA','DZ'),
  (5,'AMERICAN SAMOA','AS'),
  (6,'ANDORRA','AD'),
  (7,'ANGOLA','AO'),
  (8,'ANGUILLA','AI'),
  (9,'ANTARCTICA','AQ'),
  (10,'ANTIGUA AND BARBUDA','AG'),
  (11,'ARGENTINA','AR'),
  (12,'ARMENIA','AM'),
  (13,'ARUBA','AW'),
  (14,'AUSTRALIA','AU'),
  (15,'AUSTRIA','AT'),
  (16,'AZERBAIJAN','AZ'),
  (17,'BAHAMAS','BS'),
  (18,'BAHRAIN','BH'),
  (19,'BANGLADESH','BD'),
  (20,'BARBADOS','BB'),
  (21,'BELARUS','BY'),
  (22,'BELGIUM','BE'),
  (23,'BELIZE','BZ'),
  (24,'BENIN','BJ'),
  (25,'BERMUDA','BM'),
  (26,'BHUTAN','BT'),
  (27,'BOLIVIA, PLURINATIONAL STATE OF','BO'),
  (28,'BONAIRE, SINT EUSTATIUS AND SABA','BQ'),
  (29,'BOSNIA AND HERZEGOVINA','BA'),
  (30,'BOTSWANA','BW'),
  (31,'BOUVET ISLAND','BV'),
  (32,'BRAZIL','BR'),
  (33,'BRITISH INDIAN OCEAN TERRITORY','IO'),
  (34,'BRUNEI DARUSSALAM','BN'),
  (35,'BULGARIA','BG'),
  (36,'BURKINA FASO','BF'),
  (37,'BURUNDI','BI'),
  (38,'CAMBODIA','KH'),
  (39,'CAMEROON','CM'),
  (40,'CANADA','CA'),
  (41,'CAPE VERDE','CV'),
  (42,'CAYMAN ISLANDS','KY'),
  (43,'CENTRAL AFRICAN REPUBLIC','CF'),
  (44,'CHAD','TD'),
  (45,'CHILE','CL'),
  (46,'CHINA','CN'),
  (47,'CHRISTMAS ISLAND','CX'),
  (48,'COCOS (KEELING) ISLANDS','CC'),
  (49,'COLOMBIA','CO'),
  (50,'COMOROS','KM'),
  (51,'CONGO','CG'),
  (52,'CONGO, THE DEMOCRATIC REPUBLIC OF THE','CD'),
  (53,'COOK ISLANDS','CK'),
  (54,'COSTA RICA','CR'),
  (55,'CÔTE D''IVOIRE','CI'),
  (56,'CROATIA','HR'),
  (57,'CUBA','CU'),
  (58,'CURAÇAO','CW'),
  (59,'CYPRUS','CY'),
  (60,'CZECH REPUBLIC','CZ'),
  (61,'DENMARK','DK'),
  (62,'DJIBOUTI','DJ'),
  (63,'DOMINICA','DM'),
  (64,'DOMINICAN REPUBLIC','DO'),
  (65,'ECUADOR','EC'),
  (66,'EGYPT','EG'),
  (67,'EL SALVADOR','SV'),
  (68,'EQUATORIAL GUINEA','GQ'),
  (69,'ERITREA','ER'),
  (70,'ESTONIA','EE'),
  (71,'ETHIOPIA','ET'),
  (72,'FALKLAND ISLANDS (MALVINAS)','FK'),
  (73,'FAROE ISLANDS','FO'),
  (74,'FIJI','FJ'),
  (75,'FINLAND','FI'),
  (76,'FRANCE','FR'),
  (77,'FRENCH GUIANA','GF'),
  (78,'FRENCH POLYNESIA','PF'),
  (79,'FRENCH SOUTHERN TERRITORIES','TF'),
  (80,'GABON','GA'),
  (81,'GAMBIA','GM'),
  (82,'GEORGIA','GE'),
  (83,'GERMANY','DE'),
  (84,'GHANA','GH'),
  (85,'GIBRALTAR','GI'),
  (86,'GREECE','GR'),
  (87,'GREENLAND','GL'),
  (88,'GRENADA','GD'),
  (89,'GUADELOUPE','GP'),
  (90,'GUAM','GU'),
  (91,'GUATEMALA','GT'),
  (92,'GUERNSEY','GG'),
  (93,'GUINEA','GN'),
  (94,'GUINEA-BISSAU','GW'),
  (95,'GUYANA','GY'),
  (96,'HAITI','HT'),
  (97,'HEARD ISLAND AND MCDONALD ISLANDS','HM'),
  (98,'HOLY SEE (VATICAN CITY STATE)','VA'),
  (99,'HONDURAS','HN'),
  (100,'HONG KONG','HK'),
  (101,'HUNGARY','HU'),
  (102,'ICELAND','IS'),
  (103,'INDIA','IN'),
  (104,'INDONESIA','ID'),
  (105,'IRAN, ISLAMIC REPUBLIC OF','IR'),
  (106,'IRAQ','IQ'),
  (107,'IRELAND','IE'),
  (108,'ISLE OF MAN','IM'),
  (109,'ISRAEL','IL'),
  (110,'ITALY','IT'),
  (111,'JAMAICA','JM'),
  (112,'JAPAN','JP'),
  (113,'JERSEY','JE'),
  (114,'JORDAN','JO'),
  (115,'KAZAKHSTAN','KZ'),
  (116,'KENYA','KE'),
  (117,'KIRIBATI','KI'),
  (118,'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF','KP'),
  (119,'KOREA, REPUBLIC OF','KR'),
  (120,'KUWAIT','KW'),
  (121,'KYRGYZSTAN','KG'),
  (122,'LAO PEOPLE''S DEMOCRATIC REPUBLIC','LA'),
  (123,'LATVIA','LV'),
  (124,'LEBANON','LB'),
  (125,'LESOTHO','LS'),
  (126,'LIBERIA','LR'),
  (127,'LIBYA','LY'),
  (128,'LIECHTENSTEIN','LI'),
  (129,'LITHUANIA','LT'),
  (130,'LUXEMBOURG','LU'),
  (131,'MACAO','MO'),
  (132,'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','MK'),
  (133,'MADAGASCAR','MG'),
  (134,'MALAWI','MW'),
  (135,'MALAYSIA','MY'),
  (136,'MALDIVES','MV'),
  (137,'MALI','ML'),
  (138,'MALTA','MT'),
  (139,'MARSHALL ISLANDS','MH'),
  (140,'MARTINIQUE','MQ'),
  (141,'MAURITANIA','MR'),
  (142,'MAURITIUS','MU'),
  (143,'MAYOTTE','YT'),
  (144,'MEXICO','MX'),
  (145,'MICRONESIA, FEDERATED STATES OF','FM'),
  (146,'MOLDOVA, REPUBLIC OF','MD'),
  (147,'MONACO','MC'),
  (148,'MONGOLIA','MN'),
  (149,'MONTENEGRO','ME'),
  (150,'MONTSERRAT','MS'),
  (151,'MOROCCO','MA'),
  (152,'MOZAMBIQUE','MZ'),
  (153,'MYANMAR','MM'),
  (154,'NAMIBIA','NA'),
  (155,'NAURU','NR'),
  (156,'NEPAL','NP'),
  (157,'NETHERLANDS','NL'),
  (158,'NEW CALEDONIA','NC'),
  (159,'NEW ZEALAND','NZ'),
  (160,'NICARAGUA','NI'),
  (161,'NIGER','NE'),
  (162,'NIGERIA','NG'),
  (163,'NIUE','NU'),
  (164,'NORFOLK ISLAND','NF'),
  (165,'NORTHERN MARIANA ISLANDS','MP'),
  (166,'NORWAY','NO'),
  (167,'OMAN','OM'),
  (168,'PAKISTAN','PK'),
  (169,'PALAU','PW'),
  (170,'PALESTINIAN TERRITORY, OCCUPIED','PS'),
  (171,'PANAMA','PA'),
  (172,'PAPUA NEW GUINEA','PG'),
  (173,'PARAGUAY','PY'),
  (174,'PERU','PE'),
  (175,'PHILIPPINES','PH'),
  (176,'PITCAIRN','PN'),
  (177,'POLAND','PL'),
  (178,'PORTUGAL','PT'),
  (179,'PUERTO RICO','PR'),
  (180,'QATAR','QA'),
  (181,'RÉUNION','RE'),
  (182,'ROMANIA','RO'),
  (183,'RUSSIAN FEDERATION','RU'),
  (184,'RWANDA','RW'),
  (185,'SAINT BARTHÉLEMY','BL'),
  (186,'SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA','SH'),
  (187,'SAINT KITTS AND NEVIS','KN'),
  (188,'SAINT LUCIA','LC'),
  (189,'SAINT MARTIN (FRENCH PART)','MF'),
  (190,'SAINT PIERRE AND MIQUELON','PM'),
  (191,'SAINT VINCENT AND THE GRENADINES','VC'),
  (192,'SAMOA','WS'),
  (193,'SAN MARINO','SM'),
  (194,'SAO TOME AND PRINCIPE','ST'),
  (195,'SAUDI ARABIA','SA'),
  (196,'SENEGAL','SN'),
  (197,'SERBIA','RS'),
  (198,'SEYCHELLES','SC'),
  (199,'SIERRA LEONE','SL'),
  (200,'SINGAPORE','SG'),
  (201,'SINT MAARTEN (DUTCH PART)','SX'),
  (202,'SLOVAKIA','SK'),
  (203,'SLOVENIA','SI'),
  (204,'SOLOMON ISLANDS','SB'),
  (205,'SOMALIA','SO'),
  (206,'SOUTH AFRICA','ZA'),
  (207,'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','GS'),
  (208,'SOUTH SUDAN','SS'),
  (209,'SPAIN','ES'),
  (210,'SRI LANKA','LK'),
  (211,'SUDAN','SD'),
  (212,'SURINAME','SR'),
  (213,'SVALBARD AND JAN MAYEN','SJ'),
  (214,'SWAZILAND','SZ'),
  (215,'SWEDEN','SE'),
  (216,'SWITZERLAND','CH'),
  (217,'SYRIAN ARAB REPUBLIC','SY'),
  (218,'TAIWAN, PROVINCE OF CHINA','TW'),
  (219,'TAJIKISTAN','TJ'),
  (220,'TANZANIA, UNITED REPUBLIC OF','TZ'),
  (221,'THAILAND','TH'),
  (222,'TIMOR-LESTE','TL'),
  (223,'TOGO','TG'),
  (224,'TOKELAU','TK'),
  (225,'TONGA','TO'),
  (226,'TRINIDAD AND TOBAGO','TT'),
  (227,'TUNISIA','TN'),
  (228,'TURKEY','TR'),
  (229,'TURKMENISTAN','TM'),
  (230,'TURKS AND CAICOS ISLANDS','TC'),
  (231,'TUVALU','TV'),
  (232,'UGANDA','UG'),
  (233,'UKRAINE','UA'),
  (234,'UNITED ARAB EMIRATES','AE'),
  (235,'UNITED KINGDOM','GB'),
  (236,'UNITED STATES','US'),
  (237,'UNITED STATES MINOR OUTLYING ISLANDS','UM'),
  (238,'URUGUAY','UY'),
  (239,'UZBEKISTAN','UZ'),
  (240,'VANUATU','VU'),
  (241,'VENEZUELA, BOLIVARIAN REPUBLIC OF','VE'),
  (242,'VIET NAM','VN'),
  (243,'VIRGIN ISLANDS, BRITISH','VG'),
  (244,'VIRGIN ISLANDS, U.S.','VI'),
  (245,'WALLIS AND FUTUNA','WF'),
  (246,'WESTERN SAHARA','EH'),
  (247,'YEMEN','YE'),
  (248,'ZAMBIA','ZM'),
  (249,'ZIMBABWE','ZW');
COMMIT;

#
# Data for the `roles` table  (LIMIT 0,500)
#

INSERT INTO `roles` (`id`, `name`, `description`) VALUES 
  (1,'login','Login privileges, granted after account confirmation'),
  (2,'admin','Administrative user, has access to everything.');
COMMIT;

#
# Data for the `user_profiles` table  (LIMIT 0,500)
#

INSERT INTO `user_profiles` (`id`, `employer`, `first_name`, `last_name`, `dob`, `phone_landline`, `phone_mobile`, `address`, `hr_manager`, `hr_manager_email`, `emergency_contact`, `gender`, `country_id`, `p_country_id`, `nationality`, `p_issue_date`, `p_expiry_date`, `job_title`, `avatar`) VALUES 
  (1,NULL,'Dmitry','Litvyak','0000-00-00 00:00:00','','',NULL,NULL,NULL,'','male',4,8,'','1353103200','1353103200','','1353174588.png'),
  (2,NULL,'Alex','Leontev','2011-07-11 14:23:51','','',NULL,NULL,NULL,'','male',5,4,'','1341266400','1362002400','','1353241400.jpg'),
  (3,NULL,'Vitaly',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,1,1,NULL,NULL,NULL,NULL,NULL),
  (4,NULL,'Andrey','Tereshenko',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,1,1,NULL,NULL,NULL,NULL,NULL),
  (5,NULL,'Shane','Holland',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,1,1,NULL,NULL,NULL,NULL,NULL);
COMMIT;

#
# Data for the `users` table  (LIMIT 0,500)
#

INSERT INTO `users` (`id`, `email`, `password`, `logins`, `last_login`, `user_profile_id`) VALUES 
  (1,'dmitry@onfivelab.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',13,1353171650,1),
  (2,'alex@onfivelab.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',26,1353349728,2),
  (3,'vitaly@onfivelab.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',0,NULL,3),
  (4,'andrey@onfivelab.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',1,1352919518,4),
  (5,'myfriendshane@gmail.com','648548a904a3b0b1ff95fe4cfa17d60c87ab96b750d54451ccd79a7d4558d031',6,1353051794,5);
COMMIT;

#
# Data for the `roles_users` table  (LIMIT 0,500)
#

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES 
  (1,1),
  (1,2),
  (2,1),
  (2,2),
  (3,1),
  (3,2),
  (4,1),
  (4,2),
  (5,1),
  (5,2);
COMMIT;

#
# Data for the `trip_place_destinations` table  (LIMIT 0,500)
#

INSERT INTO `trip_place_destinations` (`id`, `destination`, `code`) VALUES 
  (1,'AFGHANISTAN','AF'),
  (2,'ÃLAND ISLANDS','AX'),
  (3,'ALBANIA','AL'),
  (4,'ALGERIA','DZ'),
  (5,'AMERICAN SAMOA','AS'),
  (6,'ANDORRA','AD'),
  (7,'ANGOLA','AO'),
  (8,'ANGUILLA','AI'),
  (9,'ANTARCTICA','AQ'),
  (10,'ANTIGUA AND BARBUDA','AG'),
  (11,'ARGENTINA','AR'),
  (12,'ARMENIA','AM'),
  (13,'ARUBA','AW'),
  (14,'AUSTRALIA','AU'),
  (15,'AUSTRIA','AT'),
  (16,'AZERBAIJAN','AZ'),
  (17,'BAHAMAS','BS'),
  (18,'BAHRAIN','BH'),
  (19,'BANGLADESH','BD'),
  (20,'BARBADOS','BB'),
  (21,'BELARUS','BY'),
  (22,'BELGIUM','BE'),
  (23,'BELIZE','BZ'),
  (24,'BENIN','BJ'),
  (25,'BERMUDA','BM'),
  (26,'BHUTAN','BT'),
  (27,'BOLIVIA, PLURINATIONAL STATE OF','BO'),
  (28,'BONAIRE, SINT EUSTATIUS AND SABA','BQ'),
  (29,'BOSNIA AND HERZEGOVINA','BA'),
  (30,'BOTSWANA','BW'),
  (31,'BOUVET ISLAND','BV'),
  (32,'BRAZIL','BR'),
  (33,'BRITISH INDIAN OCEAN TERRITORY','IO'),
  (34,'BRUNEI DARUSSALAM','BN'),
  (35,'BULGARIA','BG'),
  (36,'BURKINA FASO','BF'),
  (37,'BURUNDI','BI'),
  (38,'CAMBODIA','KH'),
  (39,'CAMEROON','CM'),
  (40,'CANADA','CA'),
  (41,'CAPE VERDE','CV'),
  (42,'CAYMAN ISLANDS','KY'),
  (43,'CENTRAL AFRICAN REPUBLIC','CF'),
  (44,'CHAD','TD'),
  (45,'CHILE','CL'),
  (46,'CHINA','CN'),
  (47,'CHRISTMAS ISLAND','CX'),
  (48,'COCOS (KEELING) ISLANDS','CC'),
  (49,'COLOMBIA','CO'),
  (50,'COMOROS','KM'),
  (51,'CONGO','CG'),
  (52,'CONGO, THE DEMOCRATIC REPUBLIC OF THE','CD'),
  (53,'COOK ISLANDS','CK'),
  (54,'COSTA RICA','CR'),
  (55,'CÔTE D''IVOIRE','CI'),
  (56,'CROATIA','HR'),
  (57,'CUBA','CU'),
  (58,'CURAÇAO','CW'),
  (59,'CYPRUS','CY'),
  (60,'CZECH REPUBLIC','CZ'),
  (61,'DENMARK','DK'),
  (62,'DJIBOUTI','DJ'),
  (63,'DOMINICA','DM'),
  (64,'DOMINICAN REPUBLIC','DO'),
  (65,'ECUADOR','EC'),
  (66,'EGYPT','EG'),
  (67,'EL SALVADOR','SV'),
  (68,'EQUATORIAL GUINEA','GQ'),
  (69,'ERITREA','ER'),
  (70,'ESTONIA','EE'),
  (71,'ETHIOPIA','ET'),
  (72,'FALKLAND ISLANDS (MALVINAS)','FK'),
  (73,'FAROE ISLANDS','FO'),
  (74,'FIJI','FJ'),
  (75,'FINLAND','FI'),
  (76,'FRANCE','FR'),
  (77,'FRENCH GUIANA','GF'),
  (78,'FRENCH POLYNESIA','PF'),
  (79,'FRENCH SOUTHERN TERRITORIES','TF'),
  (80,'GABON','GA'),
  (81,'GAMBIA','GM'),
  (82,'GEORGIA','GE'),
  (83,'GERMANY','DE'),
  (84,'GHANA','GH'),
  (85,'GIBRALTAR','GI'),
  (86,'GREECE','GR'),
  (87,'GREENLAND','GL'),
  (88,'GRENADA','GD'),
  (89,'GUADELOUPE','GP'),
  (90,'GUAM','GU'),
  (91,'GUATEMALA','GT'),
  (92,'GUERNSEY','GG'),
  (93,'GUINEA','GN'),
  (94,'GUINEA-BISSAU','GW'),
  (95,'GUYANA','GY'),
  (96,'HAITI','HT'),
  (97,'HEARD ISLAND AND MCDONALD ISLANDS','HM'),
  (98,'HOLY SEE (VATICAN CITY STATE)','VA'),
  (99,'HONDURAS','HN'),
  (100,'HONG KONG','HK'),
  (101,'HUNGARY','HU'),
  (102,'ICELAND','IS'),
  (103,'INDIA','IN'),
  (104,'INDONESIA','ID'),
  (105,'IRAN, ISLAMIC REPUBLIC OF','IR'),
  (106,'IRAQ','IQ'),
  (107,'IRELAND','IE'),
  (108,'ISLE OF MAN','IM'),
  (109,'ISRAEL','IL'),
  (110,'ITALY','IT'),
  (111,'JAMAICA','JM'),
  (112,'JAPAN','JP'),
  (113,'JERSEY','JE'),
  (114,'JORDAN','JO'),
  (115,'KAZAKHSTAN','KZ'),
  (116,'KENYA','KE'),
  (117,'KIRIBATI','KI'),
  (118,'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF','KP'),
  (119,'KOREA, REPUBLIC OF','KR'),
  (120,'KUWAIT','KW'),
  (121,'KYRGYZSTAN','KG'),
  (122,'LAO PEOPLE''S DEMOCRATIC REPUBLIC','LA'),
  (123,'LATVIA','LV'),
  (124,'LEBANON','LB'),
  (125,'LESOTHO','LS'),
  (126,'LIBERIA','LR'),
  (127,'LIBYA','LY'),
  (128,'LIECHTENSTEIN','LI'),
  (129,'LITHUANIA','LT'),
  (130,'LUXEMBOURG','LU'),
  (131,'MACAO','MO'),
  (132,'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','MK'),
  (133,'MADAGASCAR','MG'),
  (134,'MALAWI','MW'),
  (135,'MALAYSIA','MY'),
  (136,'MALDIVES','MV'),
  (137,'MALI','ML'),
  (138,'MALTA','MT'),
  (139,'MARSHALL ISLANDS','MH'),
  (140,'MARTINIQUE','MQ'),
  (141,'MAURITANIA','MR'),
  (142,'MAURITIUS','MU'),
  (143,'MAYOTTE','YT'),
  (144,'MEXICO','MX'),
  (145,'MICRONESIA, FEDERATED STATES OF','FM'),
  (146,'MOLDOVA, REPUBLIC OF','MD'),
  (147,'MONACO','MC'),
  (148,'MONGOLIA','MN'),
  (149,'MONTENEGRO','ME'),
  (150,'MONTSERRAT','MS'),
  (151,'MOROCCO','MA'),
  (152,'MOZAMBIQUE','MZ'),
  (153,'MYANMAR','MM'),
  (154,'NAMIBIA','NA'),
  (155,'NAURU','NR'),
  (156,'NEPAL','NP'),
  (157,'NETHERLANDS','NL'),
  (158,'NEW CALEDONIA','NC'),
  (159,'NEW ZEALAND','NZ'),
  (160,'NICARAGUA','NI'),
  (161,'NIGER','NE'),
  (162,'NIGERIA','NG'),
  (163,'NIUE','NU'),
  (164,'NORFOLK ISLAND','NF'),
  (165,'NORTHERN MARIANA ISLANDS','MP'),
  (166,'NORWAY','NO'),
  (167,'OMAN','OM'),
  (168,'PAKISTAN','PK'),
  (169,'PALAU','PW'),
  (170,'PALESTINIAN TERRITORY, OCCUPIED','PS'),
  (171,'PANAMA','PA'),
  (172,'PAPUA NEW GUINEA','PG'),
  (173,'PARAGUAY','PY'),
  (174,'PERU','PE'),
  (175,'PHILIPPINES','PH'),
  (176,'PITCAIRN','PN'),
  (177,'POLAND','PL'),
  (178,'PORTUGAL','PT'),
  (179,'PUERTO RICO','PR'),
  (180,'QATAR','QA'),
  (181,'RÉUNION','RE'),
  (182,'ROMANIA','RO'),
  (183,'RUSSIAN FEDERATION','RU'),
  (184,'RWANDA','RW'),
  (185,'SAINT BARTHÉLEMY','BL'),
  (186,'SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA','SH'),
  (187,'SAINT KITTS AND NEVIS','KN'),
  (188,'SAINT LUCIA','LC'),
  (189,'SAINT MARTIN (FRENCH PART)','MF'),
  (190,'SAINT PIERRE AND MIQUELON','PM'),
  (191,'SAINT VINCENT AND THE GRENADINES','VC'),
  (192,'SAMOA','WS'),
  (193,'SAN MARINO','SM'),
  (194,'SAO TOME AND PRINCIPE','ST'),
  (195,'SAUDI ARABIA','SA'),
  (196,'SENEGAL','SN'),
  (197,'SERBIA','RS'),
  (198,'SEYCHELLES','SC'),
  (199,'SIERRA LEONE','SL'),
  (200,'SINGAPORE','SG'),
  (201,'SINT MAARTEN (DUTCH PART)','SX'),
  (202,'SLOVAKIA','SK'),
  (203,'SLOVENIA','SI'),
  (204,'SOLOMON ISLANDS','SB'),
  (205,'SOMALIA','SO'),
  (206,'SOUTH AFRICA','ZA'),
  (207,'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','GS'),
  (208,'SOUTH SUDAN','SS'),
  (209,'SPAIN','ES'),
  (210,'SRI LANKA','LK'),
  (211,'SUDAN','SD'),
  (212,'SURINAME','SR'),
  (213,'SVALBARD AND JAN MAYEN','SJ'),
  (214,'SWAZILAND','SZ'),
  (215,'SWEDEN','SE'),
  (216,'SWITZERLAND','CH'),
  (217,'SYRIAN ARAB REPUBLIC','SY'),
  (218,'TAIWAN, PROVINCE OF CHINA','TW'),
  (219,'TAJIKISTAN','TJ'),
  (220,'TANZANIA, UNITED REPUBLIC OF','TZ'),
  (221,'THAILAND','TH'),
  (222,'TIMOR-LESTE','TL'),
  (223,'TOGO','TG'),
  (224,'TOKELAU','TK'),
  (225,'TONGA','TO'),
  (226,'TRINIDAD AND TOBAGO','TT'),
  (227,'TUNISIA','TN'),
  (228,'TURKEY','TR'),
  (229,'TURKMENISTAN','TM'),
  (230,'TURKS AND CAICOS ISLANDS','TC'),
  (231,'TUVALU','TV'),
  (232,'UGANDA','UG'),
  (233,'UKRAINE','UA'),
  (234,'UNITED ARAB EMIRATES','AE'),
  (235,'UNITED KINGDOM','GB'),
  (236,'UNITED STATES','US'),
  (237,'UNITED STATES MINOR OUTLYING ISLANDS','UM'),
  (238,'URUGUAY','UY'),
  (239,'UZBEKISTAN','UZ'),
  (240,'VANUATU','VU'),
  (241,'VENEZUELA, BOLIVARIAN REPUBLIC OF','VE'),
  (242,'VIET NAM','VN'),
  (243,'VIRGIN ISLANDS, BRITISH','VG'),
  (244,'VIRGIN ISLANDS, U.S.','VI'),
  (245,'WALLIS AND FUTUNA','WF'),
  (246,'WESTERN SAHARA','EH'),
  (247,'YEMEN','YE'),
  (248,'ZAMBIA','ZM'),
  (249,'ZIMBABWE','ZW');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;