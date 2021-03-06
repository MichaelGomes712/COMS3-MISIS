CREATE DATABASE  IF NOT EXISTS `coms3-misis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `coms3-misis`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: coms3-misis
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `unitCode` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `courseID` int DEFAULT NULL,
  `courseName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  UNIQUE KEY `unitCode_UNIQUE` (`unitCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES ('COMS1015A',1,NULL),('COMS1017A',2,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `studentNo` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `unitCode` varchar(45) NOT NULL,
  `session` varchar(3) NOT NULL,
  `classSection` varchar(1) NOT NULL,
  `expiryDate` datetime NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
INSERT INTO `enrollments` VALUES (2,1885981,'Troy',' Ingram','COMS','COMS3003A','SM1','B','2020-06-30 00:00:00','ENROLLED'),(3,1965854,'Michael','Gonzales','COMS','COMS1018A','SM1','C','2020-06-30 00:00:00','ENROLLED'),(4,1835635,'Sam','Gomez','COMS','COMS4004A','SM1','D','2020-06-30 00:00:00','ENROLLED'),(5,2000000,'Paul','Kruger','COMS','COMS1015A','SM1','E','2020-06-30 00:00:00','ENROLLED'),(6,2015010,'Pieter','Tharatt','COMS','COMS1015A','SM1','A','2020-06-30 00:00:00','ENROLLED'),(7,985748,'Xolani','Zulu','COMS','COMS3003A','SM1','B','2020-06-30 00:00:00','ENROLLED'),(8,1654789,'Sarah','May','COMS','COMS1018A','SM1','C','2020-06-30 00:00:00','ENROLLED'),(9,653235,'Steve','James','COMS','COMS4004A','SM1','D','2020-06-30 00:00:00','ENROLLED'),(11,1325875,'Praveshi','Moodley','COMS','COMS1015A','SM2','B','2020-06-30 00:00:00','ENROLLED'),(12,895623,'Ritesh','Naaidoo','COMS','COMS3003A','SM1','B','2020-06-30 00:00:00','ENROLLED'),(13,898562,'Benji','Franklin','COMS','COMS1018A','SM1','C','2020-06-30 00:00:00','ENROLLED'),(15,1458754,'Tumi','Ramphele','COMS','COMS1015A','SM1','E','2020-06-30 00:00:00','ENROLLED'),(16,1686869,'Saul','Nigurez','COMS','COMS1015A','SM1','A','2020-06-30 00:00:00','ENROLLED'),(17,658956,'Mitchel','Messi','COMS','COMS3003A','SM1','B','2020-06-30 00:00:00','ENROLLED'),(18,989986,'Tristen','Ronaldo','COMS','COMS1018A','SM1','C','2020-06-30 00:00:00','ENROLLED'),(19,1835713,'Tom','Wetton','COMS','COMS2013A','SM1','A','2020-06-30 00:00:00','ENROLLED');
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','$2y$10$n6NlWtHmEWH04fN6JqAA5eDKVwA8MAFHNGYVN45GVqdU82kmeKt9e','admin'),('steve','$2y$10$n6NlWtHmEWH04fN6JqAA5eDKVwA8MAFHNGYVN45GVqdU82kmeKt9e','user'),('test','test','test');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-26 18:20:16
