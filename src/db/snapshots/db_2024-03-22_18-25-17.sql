# ************************************************************
# Antares - SQL Client
# Version 0.7.22
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: 127.0.0.1 (mariadb.org binary distribution 10.4.32)
# Database: db
# Generation time: 2024-03-22T18:25:55+01:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(25) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `title`, `content`) VALUES
	(1, "Home page", "this content is comming from the database"),
	(2, "About page", "This is a web app that does not do much, just teaches me php mvc. </br> Explore at your own risk :)"),
	(3, "Already submitted", "Go outside and have some fresh air."),
	(4, "Thank you", "We reply in two buisness days."),
	(5, "dfsgsdf", "sdfgsdf");

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table routes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `url` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `entity_id` int(10) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_QC16` (`entity_id`),
  CONSTRAINT `FK_QC16` FOREIGN KEY (`entity_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;

INSERT INTO `routes` (`id`, `url`, `module`, `entity_id`, `action`) VALUES
	(1, "/about-us", "page", 2, "default"),
	(2, "/home", "page", 1, "default"),
	(3, "/contact-us", "contact", NULL, "default");

/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `username`, `password`, `password_hash`) VALUES
	(1, "admin", "admin", "9d87a835c94d88748238b2a2b67ef86d", "d2f8dc70842b9f5219aabe7633e3bc9a"),
	(2, "admin", "admin@example.com", "9d87a835c94d88748238b2a2b67ef86d", "d2f8dc70842b9f5219aabe7633e3bc9a");

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors
CREATE TABLE `page_summaries`(
   `id` INT(11)   NOT NULL  ,
	`title` CHAR(25)   NOT NULL  COLLATE utf8mb4_general_ci,
	`content` MEDIUMTEXT   NULL  COLLATE utf8mb4_general_ci
);

DROP TABLE IF EXISTS `page_summaries`;
CREATE ALGORITHM=UNDEFINED DEFINER=`db`@`%` SQL SECURITY DEFINER VIEW `page_summaries` AS select `pages`.`id` AS `id`,`pages`.`title` AS `title`,case when octet_length(`pages`.`content`) > 25 then concat(substr(`pages`.`content`,1,25),'...') else `pages`.`content` end AS `content` from `pages`;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2024-03-22T18:25:55+01:00
