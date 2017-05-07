-- MySQL dump 10.13  Distrib 5.6.35, for FreeBSD11.0 (amd64)
--
-- Host: localhost    Database: netvis
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `host`
--

DROP TABLE IF EXISTS `host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mac` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `hostname` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host`
--

LOCK TABLES `host` WRITE;
/*!40000 ALTER TABLE `host` DISABLE KEYS */;
INSERT INTO `host` VALUES (1,NULL,'192.168.75.5','bernice.ascot.khubla.lan'),(2,NULL,'192.168.75.1','gateway-ascot.khubla.lan'),(3,NULL,'162.157.164.209','gateway-ascot.khubla.lan'),(4,NULL,'68.146.222.103','gateway-spring.khubla.lan'),(5,NULL,'192.168.77.1','gateway-spring.khubla.lan'),(6,NULL,'192.168.72.1','gateway-ascot.khubla.lan'),(7,NULL,'192.168.72.2','gateway-spring.khubla.lan');
/*!40000 ALTER TABLE `host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip`
--

DROP TABLE IF EXISTS `ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip` (
  `ip` varchar(15) NOT NULL,
  `lastseen` datetime NOT NULL,
  `ping` float NOT NULL,
  `laststatus` int(11) NOT NULL,
  `hostname` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip`
--

LOCK TABLES `ip` WRITE;
/*!40000 ALTER TABLE `ip` DISABLE KEYS */;
INSERT INTO `ip` VALUES ('192.168.75.1','2017-05-07 22:39:12',0.000264168,1,'gateway.ascot.khubla.lan'),('192.168.75.130','2017-05-07 22:15:57',0.00411987,1,NULL),('192.168.75.136','2017-05-07 22:16:02',0.0026598,1,NULL),('192.168.75.139','2017-05-07 22:16:04',0.00545502,1,NULL),('192.168.75.142','2017-05-07 22:16:07',0.0679588,1,NULL),('192.168.75.144','2017-05-07 22:16:08',0.000571966,1,NULL),('192.168.75.145','2017-05-07 22:16:08',0.0213881,1,NULL),('192.168.75.148','2017-05-07 22:16:10',0.00237799,1,NULL),('192.168.75.149','2017-05-07 22:16:10',0.00826097,1,NULL),('192.168.75.153','2017-05-07 22:16:13',0.00519681,1,NULL),('192.168.75.5','2017-05-07 22:39:15',0.0000991821,1,'bernice.ascot.khubla.lan'),('192.168.75.71','2017-05-07 22:15:04',0.0000841618,1,NULL),('192.168.75.72','2017-05-07 22:15:04',0.0000700951,1,NULL),('192.168.75.73','2017-05-07 22:15:04',0.0000500679,1,NULL),('192.168.75.74','2017-05-07 22:15:04',0.0000481606,1,NULL),('192.168.75.75','2017-05-07 22:15:04',0.0000479221,1,NULL),('192.168.75.96','2017-05-07 22:15:24',0.00885916,1,NULL),('192.168.77.1','2017-05-07 22:17:56',0.0135951,1,NULL),('192.168.77.143','2017-05-07 22:20:18',0.121632,1,NULL),('192.168.77.148','2017-05-07 22:20:22',0.0620289,1,NULL),('192.168.77.149','2017-05-07 22:20:22',0.0149901,1,NULL),('192.168.77.150','2017-05-07 22:20:22',0.013644,1,NULL),('192.168.77.168','2017-05-07 22:20:40',0.0495682,1,NULL),('192.168.77.174','2017-05-07 22:20:45',0.0175979,1,NULL),('192.168.77.188','2017-05-07 22:20:58',0.017298,1,NULL),('192.168.77.98','2017-05-07 22:19:33',0.0212591,1,NULL);
/*!40000 ALTER TABLE `ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mac`
--

DROP TABLE IF EXISTS `mac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mac` (
  `mac` varchar(17) NOT NULL,
  `lastseen` datetime DEFAULT NULL,
  `lastip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`mac`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mac`
--

LOCK TABLES `mac` WRITE;
/*!40000 ALTER TABLE `mac` DISABLE KEYS */;
/*!40000 ALTER TABLE `mac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `networks`
--

DROP TABLE IF EXISTS `networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `network` varchar(45) NOT NULL,
  `mask` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `networks`
--

LOCK TABLES `networks` WRITE;
/*!40000 ALTER TABLE `networks` DISABLE KEYS */;
INSERT INTO `networks` VALUES (1,'192.168.75.0',24),(2,'192.168.77.0',24);
/*!40000 ALTER TABLE `networks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-07 22:39:58
