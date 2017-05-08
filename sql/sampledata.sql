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
  `sysname` varchar(256) NOT NULL DEFAULT '',
  `sysdesc` varchar(256) NOT NULL,
  `lastseen` datetime NOT NULL,
  PRIMARY KEY (`sysname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host`
--

LOCK TABLES `host` WRITE;
/*!40000 ALTER TABLE `host` DISABLE KEYS */;
INSERT INTO `host` VALUES ('','','2017-05-08 00:54:15'),('STRING:','STRING: GS108Tv2','2017-05-08 00:52:01'),('STRING: bernice.ascot.khubla.lan','STRING: FreeBSD bernice.ascot.khubla.lan 11.0-RELEASE-p9 FreeBSD 11.0-RELEASE-p9 #0: Tue Apr 11 08:48:40 UTC 2017     root@amd64-builder.daemonology.net:/usr/obj/usr/src/sys/GENERIC amd64','2017-05-08 00:52:13'),('STRING: gateway.ascot.khubla.lan','STRING: pfSense gateway.ascot.khubla.lan 2.3.3-RELEASE nanobsd FreeBSD 10.3-RELEASE-p16 i386','2017-05-08 01:17:12'),('STRING: gateway.spring.khubla.lan','STRING: pfSense gateway.spring.khubla.lan 2.4.0-BETA pfSense FreeBSD 11.0-RELEASE-p8 arm','2017-05-08 00:52:25');
/*!40000 ALTER TABLE `host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interface`
--

DROP TABLE IF EXISTS `interface`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(256) NOT NULL,
  `name` varchar(45) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `mask` varchar(45) NOT NULL,
  `index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interface`
--

LOCK TABLES `interface` WRITE;
/*!40000 ALTER TABLE `interface` DISABLE KEYS */;
/*!40000 ALTER TABLE `interface` ENABLE KEYS */;
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
INSERT INTO `ip` VALUES ('192.168.75.1','2017-05-08 00:48:51',0.00028801,1,'gateway.ascot.khubla.lan'),('192.168.75.130','2017-05-07 22:42:30',0.00417995,1,'elsleepo.ascot.khubla.lan'),('192.168.75.136','2017-05-07 22:42:35',0.113057,1,'panther.ascot.khubla.lan'),('192.168.75.139','2017-05-07 22:42:37',0.00554585,1,'elrelaxo.ascot.khubla.lan'),('192.168.75.142','2017-05-07 22:42:39',0.284226,1,'Soundtouch237.ascot.khubla.lan'),('192.168.75.144','2017-05-07 22:42:41',0.000445127,1,'192.168.75.144'),('192.168.75.145','2017-05-07 22:42:41',0.0157349,1,'oscar-3.ascot.khubla.lan'),('192.168.75.148','2017-05-07 22:42:43',0.00130796,1,'localhost.ascot.khubla.lan'),('192.168.75.149','2017-05-07 22:42:43',0.00692701,1,'192.168.75.149'),('192.168.75.153','2017-05-07 22:42:46',0.00502896,1,'192.168.75.153'),('192.168.75.5','2017-05-08 00:29:45',0.0000741482,1,'bernice.ascot.khubla.lan'),('192.168.75.71','2017-05-07 22:41:36',0.00012207,1,'sandbox.ascot.khubla.lan'),('192.168.75.72','2017-05-07 22:41:36',0.0000760555,1,'git.ascot.khubla.lan'),('192.168.75.73','2017-05-07 22:41:36',0.0000510216,1,'192.168.75.73'),('192.168.75.74','2017-05-07 22:41:36',0.0000500679,1,'minecraft.ascot.khubla.lan'),('192.168.75.75','2017-05-07 22:41:36',0.0000629425,1,'192.168.75.75'),('192.168.75.96','2017-05-07 22:41:56',0.00448179,1,'wifi4.ascot.khubla.lan'),('192.168.77.1','2017-05-07 22:44:29',0.0173268,1,'gateway.spring.khubla.lan'),('192.168.77.143','2017-05-07 22:46:51',0.104271,1,'192.168.77.143'),('192.168.77.148','2017-05-07 22:46:55',0.014889,1,'192.168.77.148'),('192.168.77.149','2017-05-07 22:46:55',0.0173261,1,'192.168.77.149'),('192.168.77.150','2017-05-07 22:46:55',0.0156021,1,'192.168.77.150'),('192.168.77.168','2017-05-07 22:47:13',0.087965,1,'192.168.77.168'),('192.168.77.174','2017-05-07 22:47:18',0.020268,1,'192.168.77.174'),('192.168.77.179','2017-05-07 22:47:22',0.076407,1,'192.168.77.179'),('192.168.77.188','2017-05-07 22:47:30',0.0191929,1,'192.168.77.188'),('192.168.77.98','2017-05-07 22:46:06',0.013397,1,'wifi2.spring.khubla.lan');
/*!40000 ALTER TABLE `ip` ENABLE KEYS */;
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

-- Dump completed on 2017-05-08  1:17:33
