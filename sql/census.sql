-- MySQL dump 10.11
--
-- Host: localhost    Database: censo
-- ------------------------------------------------------
-- Server version	5.0.32-Debian_7etch1-log

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
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `COD_USUARIO` bigint(20) NOT NULL default '0',
  `NOMBRE` varchar(100) default NULL,
  `CLAVE` varchar(100) default NULL,
  `TIPO` tinyint(1) default NULL,
  PRIMARY KEY  (`COD_USUARIO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `census`
--

DROP TABLE IF EXISTS `census`;
CREATE TABLE `census` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `NOMBRE` varchar(255) NOT NULL default '',
  `APELLIDOS` varchar(255) NOT NULL default '',
  `RAMA` smallint(5) unsigned NOT NULL default '0',
  `DIRECCION` varchar(255) NOT NULL default '',
  `PUEBLO` varchar(20) NOT NULL default 'Sestao',
  `DNI` varchar(255) default NULL,
  `AMA` varchar(255) default NULL,
  `DNI_AMA` varchar(10) default NULL,
  `AITA` varchar(255) default NULL,
  `DNI_AITA` varchar(10) default NULL,
  `TELEFONO` varchar(10) NOT NULL default '',
  `MOVIL` varchar(10) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `census`
--

LOCK TABLES `census` WRITE;
/*!40000 ALTER TABLE `census` DISABLE KEYS */;
/*!40000 ALTER TABLE `census` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2007-05-12  8:46:49
