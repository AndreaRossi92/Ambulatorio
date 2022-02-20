-- Progettazione Web 
DROP DATABASE if exists ambulatorio; 
CREATE DATABASE ambulatorio; 
USE ambulatorio; 
-- MySQL dump 10.13  Distrib 5.7.28, for Win64 (x86_64)
--
-- Host: localhost    Database: ambulatorio
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `datebloccate`
--

DROP TABLE IF EXISTS `datebloccate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datebloccate` (
  `id_esame` int(11) NOT NULL,
  `data` date NOT NULL,
  UNIQUE KEY `id_esame` (`id_esame`,`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datebloccate`
--

LOCK TABLES `datebloccate` WRITE;
/*!40000 ALTER TABLE `datebloccate` DISABLE KEYS */;
/*!40000 ALTER TABLE `datebloccate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `esami`
--

DROP TABLE IF EXISTS `esami`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esami` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `esame` varchar(50) NOT NULL,
  `durata` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `esami`
--

LOCK TABLES `esami` WRITE;
/*!40000 ALTER TABLE `esami` DISABLE KEYS */;
INSERT INTO `esami` VALUES (1,'Elettrocardiogramma',10),(2,'Prelievo',5),(3,'Elettroencefalogramma',30),(4,'Gastroscopia',20),(5,'Mammografia',15);
/*!40000 ALTER TABLE `esami` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_visita` int(11) NOT NULL,
  `orario` varchar(50) NOT NULL,
  `luogo` varchar(50) NOT NULL,
  `procedura` varchar(50) NOT NULL,
  `personale` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,1,'In anticipo','Facile','Si','Si'),(2,2,'In orario','Difficile','Si','No'),(3,3,'Molto in ritardo','Facile','Si','Si'),(4,4,'Molto in ritardo','Ne facile ne difficile','No','No'),(5,7,'In ritardo','Ne facile ne difficile','Si','Si');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codFiscale` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (1,'ADMIN','admin@admin.it','000','admin','21232f297a57a5a743894a0e4a801fc3'),(2,'AAAAAA00A00A000A','a@a','1','a','0cc175b9c0f1b6a831c399e269772661'),(3,'BBBBBB00B00B000B','b@b','2','b','92eb5ffee6ae2fec3ad71c777531578f');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visite`
--

DROP TABLE IF EXISTS `visite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codFiscale` varchar(16) NOT NULL,
  `esame` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` varchar(5) NOT NULL,
  `giorno` int(1) NOT NULL,
  `feedback` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `esame` (`esame`,`data`,`ora`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visite`
--

LOCK TABLES `visite` WRITE;
/*!40000 ALTER TABLE `visite` DISABLE KEYS */;
INSERT INTO `visite` VALUES (1,'AAAAAA00A00A000A',1,'2021-11-01','9:00',1,1),(2,'AAAAAA00A00A000A',1,'2021-11-02','9:00',2,1),(3,'AAAAAA00A00A000A',2,'2021-11-03','9:00',3,1),(4,'AAAAAA00A00A000A',2,'2021-11-04','9:00',4,1),(5,'AAAAAA00A00A000A',1,'2021-11-05','9:00',5,0),(6,'BBBBBB00B00B000B',1,'2021-11-01','10:00',1,0),(7,'BBBBBB00B00B000B',3,'2021-11-02','9:00',2,1),(8,'BBBBBB00B00B000B',4,'2021-11-03','11:00',3,0);
/*!40000 ALTER TABLE `visite` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-14 21:17:46
