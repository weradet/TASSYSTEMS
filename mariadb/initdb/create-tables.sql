-- MySQL dump 10.19  Distrib 10.3.28-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_cluster_demo
-- ------------------------------------------------------
-- Server version	10.3.28-MariaDB-1:10.3.28+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `SE_CAMP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SE_CAMP` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SE_CAMP`
--

LOCK TABLES `SE_CAMP` WRITE;
/*!40000 ALTER TABLE `SE_CAMP` DISABLE KEYS */;
/*!40000 ALTER TABLE `SE_CAMP` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titanic`
--

DROP TABLE IF EXISTS `titanic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titanic` (
  `index` bigint(20) DEFAULT NULL,
  `PassengerId` bigint(20) DEFAULT NULL,
  `Survived` bigint(20) DEFAULT NULL,
  `Pclass` bigint(20) DEFAULT NULL,
  `Name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Age` double DEFAULT NULL,
  `SibSp` bigint(20) DEFAULT NULL,
  `Parch` bigint(20) DEFAULT NULL,
  `Ticket` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fare` double DEFAULT NULL,
  `Cabin` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Embarked` text COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `ix_titanic_index` (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titanic`
--

LOCK TABLES `titanic` WRITE;
/*!40000 ALTER TABLE `titanic` DISABLE KEYS */;
INSERT INTO `titanic` VALUES (0,1,0,3,'Braund, Mr. Owen Harris','male',22,1,0,'A/5 21171',7.25,NULL,'S'),(1,2,1,1,'Cumings, Mrs. John Bradley (Florence Briggs Thayer)','female',38,1,0,'PC 17599',71.2833,'C85','C'),(2,3,1,3,'Heikkinen, Miss. Laina','female',26,0,0,'STON/O2. 3101282',7.925,NULL,'S'),(3,4,1,1,'Futrelle, Mrs. Jacques Heath (Lily May Peel)','female',35,1,0,'113803',53.1,'C123','S'),(4,5,0,3,'Allen, Mr. William Henry','male',35,0,0,'373450',8.05,NULL,'S'),(5,6,0,3,'Moran, Mr. James','male',NULL,0,0,'330877',8.4583,NULL,'Q'),(6,7,0,1,'McCarthy, Mr. Timothy J','male',54,0,0,'17463',51.8625,'E46','S'),(7,8,0,3,'Palsson, Master. Gosta Leonard','male',2,3,1,'349909',21.075,NULL,'S'),(8,9,1,3,'Johnson, Mrs. Oscar W (Elisabeth Vilhelmina Berg)','female',27,0,2,'347742',11.1333,NULL,'S'),(9,10,1,2,'Nasser, Mrs. Nicholas (Adele Achem)','female',14,1,0,'237736',30.0708,NULL,'C'),(10,11,1,3,'Sandstrom, Miss. Marguerite Rut','female',4,1,1,'PP 9549',16.7,'G6','S');
/*!40000 ALTER TABLE `titanic` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-01 11:10:49

DROP TABLE IF EXISTS `SE_CAMP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
 CREATE TABLE IF NOT EXISTS tas_employee(
     emp_id INTEGER(10) AUTO_INCREMENT PRIMARY KEY ,
     emp_code VARCHAR(6) NOT NULL,
     emp_firstname VARCHAR(50) not NULL,
     emp_lastname VARCHAR (50) NOT NULL,
     emp_type INTEGER (1) DEFAULT 0 COMMENT '0 not delete, 1 is deleted ' ,
     emp_username VARCHAR(50),
     emp_password VARCHAR (50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS tas_timestamp(
     tsm_id INTEGER(30) AUTO_INCREMENT PRIMARY KEY ,
     tsm_date DATE  NOT NULL,
     tsm_timestamp TIME ,
     tsm_timestamp_out TIME  ,
     tsm_status_del INTEGER (1) DEFAULT 0 COMMENT '0 not delete, 1 is deleted ',
     tsm_edit_status INTEGER (1) DEFAULT 0 COMMENT '0 not edited, 1 is edited ',
     emp_id INTEGER (10),
      FOREIGN KEY (emp_id) REFERENCES tas_employee(emp_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tas_old_timestamp(
     ots_id INTEGER(30) AUTO_INCREMENT PRIMARY KEY ,
     ots_old_timestamp TIME ,
     ots_old_time_out TIME ,
     ots_admin_note VARCHAR (255),
     ots_admin_sig VARCHAR (255),
     tsm_id INTEGER  (30),
     FOREIGN KEY (tsm_id) REFERENCES tas_timestamp(tsm_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `tas_employee`(`emp_code`, `emp_firstname`, `emp_lastname`) VALUES ("621601","Weradet","Nopsombun");
INSERT INTO `tas_employee`(`emp_code`, `emp_firstname`, `emp_lastname`) VALUES ("621600","Wachiravit","Peamjit");
INSERT INTO `tas_employee`(`emp_code`, `emp_firstname`, `emp_lastname`) VALUES ("621615","Thanisorn","Intasorn");
INSERT INTO `tas_employee`(`emp_code`, `emp_firstname`, `emp_lastname`) VALUES ("621608","Natdanai","Thumasaowanit");
INSERT INTO `tas_employee`(`emp_code`, `emp_firstname`, `emp_lastname`, `emp_username`, `emp_password`) VALUES ("621612", "Narisara", "Boophuk", "A221", "e3afed0047b08059d0fada10f400c1e5");
INSERT INTO `tas_employee` VALUES (7,'123456','weradet ','kongbantee',0,NULL,NULL);


INSERT INTO `tas_timestamp` VALUES (1,'2021-04-11','14:37:00',NULL,0,0,1),(3,'2021-04-11','10:37:00','21:37:00',0,1,2),(4,'2021-05-01','01:40:38','02:12:15',0,0,1),(5,'2021-04-17','08:13:55',NULL,0,0,1),(6,'2021-04-18','08:13:55',NULL,0,0,2),(35,'2021-05-01','02:04:00','04:12:00',0,1,2),(37,'2021-05-01','02:04:53',NULL,0,0,4),(41,'2021-05-01','02:14:10',NULL,0,0,5),(138,'2021-05-04','00:00:00','23:37:00',0,1,1),(139,'2021-05-04','07:00:00','23:29:00',0,1,3),(140,'2021-05-04','09:00:00','23:29:00',0,1,2),(141,'2021-05-04',NULL,'23:36:00',0,0,4),(142,'2021-05-04','07:00:00','23:37:00',0,1,5),(143,'2021-05-05','14:40:00','21:51:00',0,1,1),(144,'2021-05-06','14:22:00','22:04:00',0,0,1),(145,'2021-05-06',NULL,'22:04:00',1,0,2),(146,'2021-05-06',NULL,'22:04:00',1,0,3),(147,'2021-05-06',NULL,'22:17:00',0,0,5),(149,'2021-05-08','31:00:00','40:00:00',0,1,2),(169,'2021-05-08',NULL,'23:58:00',0,0,5),(170,'2021-05-08',NULL,'23:58:00',0,0,3),(176,'2021-05-09','08:01:00','23:02:00',0,0,1),(177,'2021-05-09','07:34:00','23:06:00',0,0,2),(178,'2021-05-09','07:07:00',NULL,0,0,5),(179,'2021-05-09','07:48:00','07:50:00',0,0,3),(180,'2021-05-09',NULL,'23:04:00',0,0,4),(181,'2021-05-10','11:31:00',NULL,0,0,1),(182,'2021-05-10','10:55:00','15:13:00',0,0,2),(183,'2021-05-10','10:23:00','15:11:00',0,0,3),(185,'2021-05-10','10:50:00','15:13:00',0,0,5),(186,'2021-05-10','10:51:00',NULL,0,0,4),(187,'2021-05-10',NULL,'21:20:00',0,0,7);