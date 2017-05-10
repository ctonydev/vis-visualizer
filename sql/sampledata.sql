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
INSERT INTO `host` VALUES ('bernice.ascot.khubla.lan','FreeBSD bernice.ascot.khubla.lan 11.0-RELEASE-p9 FreeBSD 11.0-RELEASE-p9 #0: Tue Apr 11 08:48:40 UTC 2017     root@amd64-builder.daemonology.net:/usr/obj/usr/src/sys/GENERIC amd64','2017-05-09 19:35:10'),('gateway.ascot.khubla.lan','pfSense gateway.ascot.khubla.lan 2.3.3-RELEASE nanobsd FreeBSD 10.3-RELEASE-p16 i386','2017-05-09 19:34:35'),('gateway.spring.khubla.lan','pfSense gateway.spring.khubla.lan 2.4.0-BETA pfSense FreeBSD 11.0-RELEASE-p8 arm','2017-05-09 19:35:17');
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
  PRIMARY KEY (`id`),
  KEY `host_idx` (`host`),
  CONSTRAINT `host_fk` FOREIGN KEY (`host`) REFERENCES `host` (`sysname`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interface`
--

LOCK TABLES `interface` WRITE;
/*!40000 ALTER TABLE `interface` DISABLE KEYS */;
INSERT INTO `interface` VALUES (45,'gateway.ascot.khubla.lan','vr1','192.168.75.1','255.255.255.0',NULL),(46,'gateway.ascot.khubla.lan','vr2','162.157.164.209','255.255.248.0',NULL),(47,'gateway.ascot.khubla.lan','ovpns1','192.168.72.1','255.255.255.255',NULL),(58,'bernice.ascot.khubla.lan','igb0','192.168.75.75','255.255.255.255',NULL),(59,'bernice.ascot.khubla.lan','lo1','172.16.75.75','255.255.255.255',NULL),(60,'gateway.spring.khubla.lan','cpsw0','68.146.222.103','255.255.252.0',NULL),(61,'gateway.spring.khubla.lan','cpsw1','192.168.77.1','255.255.255.0',NULL),(62,'gateway.spring.khubla.lan','ovpnc1','192.168.72.2','255.255.255.255',NULL);
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
  `source` varchar(10) NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip`
--

LOCK TABLES `ip` WRITE;
/*!40000 ALTER TABLE `ip` DISABLE KEYS */;
INSERT INTO `ip` VALUES ('192.168.75.1','2017-05-10 01:07:00',0.000267029,1,'gateway.ascot.khubla.lan','icmp'),('192.168.75.130','2017-05-10 01:07:00',0.00334883,1,'elsleepo.ascot.khubla.lan','icmp'),('192.168.75.139','2017-05-10 01:07:00',0.000672102,1,'elrelaxo.ascot.khubla.lan','icmp'),('192.168.75.142','2017-05-10 01:07:00',0.0531251,1,'Soundtouch237.ascot.khubla.lan','icmp'),('192.168.75.144','2017-05-10 01:07:00',0.000545025,1,'192.168.75.144','icmp'),('192.168.75.145','2017-05-10 01:07:00',0.00224495,1,'oscar-3.ascot.khubla.lan','icmp'),('192.168.75.149','2017-05-10 01:07:00',0.00176716,1,'192.168.75.149','icmp'),('192.168.75.153','2017-05-10 01:07:00',0.00303102,1,'192.168.75.153','icmp'),('192.168.75.5','2017-05-10 01:07:00',0.0000622272,1,'bernice.ascot.khubla.lan','icmp'),('192.168.75.71','2017-05-10 01:07:00',0.0000391006,1,'sandbox.ascot.khubla.lan','icmp'),('192.168.75.72','2017-05-10 01:07:00',0.0000989437,1,'git.ascot.khubla.lan','icmp'),('192.168.75.73','2017-05-10 01:07:00',0.0000858307,1,'192.168.75.73','icmp'),('192.168.75.74','2017-05-10 01:07:00',0.0000879765,1,'minecraft.ascot.khubla.lan','icmp'),('192.168.75.75','2017-05-10 01:07:00',0.0000650883,1,'192.168.75.75','icmp'),('192.168.75.96','2017-05-10 01:07:00',0.000591993,1,'wifi4.ascot.khubla.lan','icmp'),('192.168.77.1','2017-05-10 01:07:00',0.0311241,1,'gateway.spring.khubla.lan',''),('192.168.77.143','2017-05-10 01:07:00',0.053483,1,'barbie.spring.khubla.lan',''),('192.168.77.148','2017-05-10 01:07:00',0.0127392,1,'officejet8600.spring.khubla.lan',''),('192.168.77.149','2017-05-10 01:07:00',0.016166,1,'192.168.77.149',''),('192.168.77.150','2017-05-10 01:07:00',0.018574,1,'192.168.77.150',''),('192.168.77.174','2017-05-10 01:07:00',0.094074,1,'GreatRomAppleTV.spring.khubla.lan',''),('192.168.77.188','2017-05-10 01:07:00',0.0146592,1,'Living-Room.spring.khubla.lan',''),('192.168.77.98','2017-05-10 01:07:00',0.0116451,1,'wifi2.spring.khubla.lan','');
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

-- Dump completed on 2017-05-10  1:07:07
