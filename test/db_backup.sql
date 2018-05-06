-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `appointmentTime` datetime NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `hour` smallint(6) NOT NULL DEFAULT '0',
  `min` smallint(6) NOT NULL DEFAULT '20',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_user_id_foreign` (`user_id`),
  CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,6,5,'2017-09-14 08:48:37',1,2,27,NULL,NULL),(2,6,3,'2018-05-14 14:30:42',1,2,42,NULL,NULL),(3,6,9,'2017-10-19 22:52:15',1,1,48,NULL,NULL),(4,5,5,'2018-05-05 04:44:37',1,2,42,NULL,NULL),(5,9,2,'2017-07-19 07:16:10',1,0,55,NULL,NULL),(6,3,1,'2018-02-10 06:50:13',1,1,20,NULL,NULL),(7,7,8,'2017-11-14 14:12:42',1,0,34,NULL,NULL),(8,9,8,'2018-04-07 10:40:28',1,1,36,NULL,NULL),(9,3,4,'2018-03-11 07:38:21',1,0,44,NULL,NULL),(10,2,3,'2017-06-19 05:14:46',1,2,20,NULL,NULL),(11,8,3,'2017-12-20 21:41:19',1,2,28,NULL,NULL),(12,2,7,'2018-05-17 20:10:27',1,0,49,NULL,NULL),(13,9,3,'2017-09-14 13:58:25',1,1,25,NULL,NULL),(14,6,1,'2018-02-25 06:26:37',1,0,50,NULL,NULL),(15,10,5,'2017-11-11 04:38:04',1,2,54,NULL,NULL),(16,2,1,'2017-06-10 17:05:52',1,2,46,NULL,NULL),(17,7,7,'2018-01-31 19:16:26',1,2,46,NULL,NULL),(18,3,6,'2017-11-28 02:58:55',1,2,38,NULL,NULL),(19,9,1,'2017-10-12 20:10:15',1,1,55,NULL,NULL),(20,2,1,'2018-01-28 01:31:18',1,0,23,NULL,NULL),(21,7,4,'2018-01-26 13:24:26',1,2,59,NULL,NULL),(22,7,9,'2017-12-10 18:07:32',1,0,54,NULL,NULL),(23,9,6,'2017-12-05 23:11:09',1,1,22,NULL,NULL),(24,3,7,'2018-01-17 09:11:06',1,0,32,NULL,NULL),(25,9,9,'2017-05-28 17:54:13',1,0,57,NULL,NULL),(26,1,1,'2017-10-02 20:02:01',1,1,20,NULL,NULL),(27,3,5,'2018-01-18 23:29:35',1,1,44,NULL,NULL),(28,3,2,'2017-11-18 11:41:48',1,0,32,NULL,NULL),(29,1,2,'2018-02-24 23:40:32',1,2,23,NULL,NULL),(30,9,7,'2017-09-04 02:06:57',1,0,32,NULL,NULL),(31,4,2,'2018-01-29 19:31:22',1,2,29,NULL,NULL),(32,2,4,'2018-01-05 07:58:16',1,2,21,NULL,NULL),(33,4,4,'2018-05-17 18:34:35',1,0,49,NULL,NULL),(34,4,6,'2017-10-25 02:20:12',1,1,52,NULL,NULL),(35,7,2,'2017-09-08 12:22:08',1,2,36,NULL,NULL),(36,5,9,'2017-12-14 12:24:14',1,1,47,NULL,NULL),(37,1,8,'2017-10-31 12:57:59',1,1,31,NULL,NULL),(38,8,1,'2017-07-08 13:14:56',1,1,41,NULL,NULL),(39,4,8,'2018-01-17 22:25:38',1,0,28,NULL,NULL),(40,3,8,'2018-04-12 15:15:01',1,2,50,NULL,NULL),(41,9,5,'2017-08-15 10:25:42',1,0,41,NULL,NULL),(42,4,4,'2017-05-13 13:21:25',1,1,51,NULL,NULL),(43,6,8,'2018-04-03 18:30:37',1,1,46,NULL,NULL),(44,9,10,'2017-12-12 08:22:59',1,2,40,NULL,NULL),(45,3,9,'2018-02-16 16:31:48',1,1,59,NULL,NULL),(46,10,2,'2018-02-18 15:33:31',1,2,56,NULL,NULL),(47,3,8,'2017-12-28 14:45:36',1,2,29,NULL,NULL),(48,9,5,'2017-10-14 11:15:39',1,0,20,NULL,NULL),(49,9,6,'2017-08-06 20:06:04',1,0,25,NULL,NULL),(50,1,7,'2017-05-10 04:35:14',1,0,54,NULL,NULL),(51,3,2,'2018-03-18 12:31:43',1,2,59,NULL,NULL),(52,5,5,'2018-05-18 02:50:39',1,2,49,NULL,NULL),(53,9,3,'2017-12-13 21:06:37',1,1,21,NULL,NULL),(54,3,1,'2018-01-27 16:02:14',1,1,57,NULL,NULL),(55,5,3,'2018-03-04 07:44:27',1,0,24,NULL,NULL),(56,1,10,'2017-11-06 02:45:56',1,0,20,NULL,NULL),(57,2,2,'2017-08-27 18:00:26',1,1,41,NULL,NULL),(58,3,8,'2017-12-05 16:31:15',1,0,42,NULL,NULL),(59,4,8,'2017-05-19 20:46:42',1,1,39,NULL,NULL),(60,2,4,'2018-05-18 04:24:48',1,0,31,NULL,NULL),(61,6,2,'2017-10-28 05:21:53',1,2,37,NULL,NULL),(62,7,10,'2018-02-07 13:56:00',1,0,42,NULL,NULL),(63,5,3,'2017-10-26 14:49:30',1,2,24,NULL,NULL),(64,1,10,'2017-08-27 15:12:00',1,1,59,NULL,NULL),(65,6,9,'2018-04-08 17:33:40',1,1,52,NULL,NULL),(66,10,3,'2018-05-31 19:00:00',1,0,49,NULL,'2018-05-05 20:37:32'),(67,5,1,'2018-01-28 06:51:24',1,0,27,NULL,NULL),(68,9,2,'2017-08-09 18:07:09',1,1,21,NULL,NULL),(69,2,2,'2018-01-16 17:50:48',1,1,58,NULL,NULL),(70,6,7,'2017-12-26 18:16:00',1,2,25,NULL,NULL),(71,3,4,'2018-01-03 03:34:02',1,2,37,NULL,NULL),(72,1,4,'2017-07-27 02:14:11',1,1,42,NULL,NULL),(73,2,1,'2018-05-30 06:40:52',1,2,45,NULL,NULL),(74,4,9,'2017-05-20 13:01:21',1,2,32,NULL,NULL),(75,1,8,'2017-11-24 14:22:34',1,1,40,NULL,NULL),(76,2,7,'2018-04-22 11:49:51',1,0,56,NULL,NULL),(77,9,7,'2018-03-05 09:17:37',1,1,57,NULL,NULL),(78,4,8,'2018-01-31 15:30:04',1,0,45,NULL,NULL),(79,2,6,'2017-08-17 06:33:05',1,1,47,NULL,NULL),(80,1,1,'2017-10-18 16:20:05',1,0,26,NULL,NULL),(81,6,7,'2017-12-02 03:45:25',1,2,23,NULL,NULL),(82,9,4,'2017-12-14 21:54:26',1,2,34,NULL,NULL),(83,9,9,'2017-08-30 09:12:56',1,2,21,NULL,NULL),(84,2,3,'2018-01-11 23:06:29',1,0,22,NULL,NULL),(85,3,10,'2017-11-17 20:58:57',1,2,43,NULL,NULL),(86,1,8,'2017-12-18 21:04:03',1,0,24,NULL,NULL),(87,4,7,'2018-01-17 18:05:51',1,0,57,NULL,NULL),(88,8,8,'2018-03-07 00:20:40',1,1,43,NULL,NULL),(89,4,10,'2017-09-03 03:12:52',1,0,32,NULL,NULL),(90,7,8,'2017-11-10 22:29:37',1,1,36,NULL,NULL),(91,5,3,'2017-12-18 13:59:46',1,0,27,NULL,NULL),(92,7,1,'2017-12-31 05:42:45',1,2,43,NULL,NULL),(93,2,9,'2017-12-31 12:29:35',1,1,38,NULL,NULL),(94,1,6,'2017-11-10 01:42:26',1,2,32,NULL,NULL),(95,2,8,'2017-11-26 14:00:16',1,2,53,NULL,NULL),(96,8,3,'2018-05-20 03:32:01',1,2,36,NULL,NULL),(97,4,5,'2018-04-29 01:07:31',1,0,51,NULL,NULL),(98,2,5,'2018-03-15 12:56:05',1,0,33,NULL,NULL),(99,2,10,'2018-02-25 02:17:48',1,0,48,NULL,NULL),(100,6,8,'2017-12-24 20:13:06',1,1,21,NULL,NULL);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educations`
--

DROP TABLE IF EXISTS `educations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `educations_user_id_foreign` (`user_id`),
  CONSTRAINT `educations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educations`
--

LOCK TABLES `educations` WRITE;
/*!40000 ALTER TABLE `educations` DISABLE KEYS */;
INSERT INTO `educations` VALUES (1,8,'University of Dhaka','Biology','SSC',1,NULL,NULL),(2,3,'Dhaka Medical College Hospital','Biology','BSC',0,NULL,NULL),(3,8,'Dhaka Medical College Hospital','Management','HSC',0,NULL,NULL),(4,9,'BUET','Biology','BSC',1,NULL,NULL),(5,9,'University of Dhaka','Management','HSC',1,NULL,NULL),(6,9,'BUET','Management','BSC',1,NULL,NULL),(7,6,'BUET','Biology','SSC',1,NULL,NULL),(8,6,'Dhaka Medical College Hospital','CSE','HSC',1,NULL,NULL),(9,9,'University of Dhaka','Biology','BSC',1,NULL,NULL),(10,3,'BUET','Management','SSC',0,NULL,NULL),(11,3,'University of Dhaka','Biology','HSC',0,NULL,NULL),(12,3,'University of Dhaka','Biology','BSC',1,NULL,NULL),(13,1,'University of Dhaka','Biology','SSC',1,NULL,NULL),(14,5,'BUET','Biology','HSC',1,NULL,NULL),(15,5,'Dhaka Medical College Hospital','Management','BSC',1,NULL,NULL),(16,3,'BUET','Biology','BSC',0,NULL,NULL),(17,2,'University of Dhaka','Management','HSC',1,NULL,NULL),(18,1,'Dhaka Medical College Hospital','CSE','SSC',1,NULL,NULL),(19,8,'University of Dhaka','Management','SSC',0,NULL,NULL),(20,2,'University of Dhaka','Biology','HSC',1,NULL,NULL),(21,2,'Dhaka Medical College Hospital','Management','SSC',0,NULL,NULL),(22,4,'BUET','Biology','BSC',0,NULL,NULL),(23,8,'Dhaka Medical College Hospital','CSE','BSC',0,NULL,NULL),(24,9,'BUET','CSE','BSC',1,NULL,NULL),(25,9,'BUET','Biology','HSC',0,NULL,NULL),(26,7,'BUET','Biology','SSC',1,NULL,NULL),(27,6,'University of Dhaka','CSE','BSC',1,NULL,NULL),(28,1,'University of Dhaka','CSE','HSC',1,NULL,NULL),(29,8,'Dhaka Medical College Hospital','Biology','SSC',0,NULL,NULL),(30,1,'BUET','CSE','HSC',1,NULL,NULL);
/*!40000 ALTER TABLE `educations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `work_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_user_id_foreign` (`user_id`),
  CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (1,2,'University of Dhaka','Manager',1,NULL,NULL),(2,1,'University of Dhaka','Boss',1,NULL,NULL),(3,2,'Dhaka City Corporation','Manager',1,NULL,NULL),(4,9,'Dhaka Medical College Hospital','Secretary',1,NULL,NULL),(5,2,'Dhaka City Corporation','Manager',1,NULL,NULL),(6,5,'Dhaka City Corporation','Boss',1,NULL,NULL),(7,7,'Dhaka Medical College Hospital','Secretary',0,NULL,NULL),(8,10,'University of Dhaka','Secretary',1,NULL,NULL),(9,5,'University of Dhaka','Secretary',1,NULL,NULL),(10,5,'Dhaka Medical College Hospital','Boss',0,NULL,NULL),(11,10,'Dhaka Medical College Hospital','Secretary',1,NULL,NULL),(12,1,'Dhaka City Corporation','Boss',1,NULL,NULL),(13,1,'Dhaka Medical College Hospital','Manager',1,NULL,NULL),(14,5,'University of Dhaka','Boss',0,NULL,NULL),(15,2,'Dhaka City Corporation','Boss',1,NULL,NULL),(16,5,'Dhaka City Corporation','Boss',0,NULL,NULL),(17,10,'Dhaka City Corporation','Manager',1,NULL,NULL),(18,7,'Dhaka City Corporation','Secretary',0,NULL,NULL),(19,9,'Dhaka City Corporation','Manager',0,NULL,NULL),(20,8,'Dhaka Medical College Hospital','Boss',0,NULL,NULL),(21,1,'Dhaka Medical College Hospital','Boss',0,NULL,NULL),(22,9,'Dhaka Medical College Hospital','Manager',0,NULL,NULL),(23,9,'Dhaka City Corporation','Secretary',0,NULL,NULL),(24,4,'Dhaka City Corporation','Boss',0,NULL,NULL),(25,1,'Dhaka City Corporation','Manager',1,NULL,NULL),(26,1,'University of Dhaka','Manager',0,NULL,NULL),(27,3,'Dhaka Medical College Hospital','Manager',1,NULL,NULL),(28,1,'University of Dhaka','Manager',0,NULL,NULL),(29,1,'University of Dhaka','Manager',0,NULL,NULL),(30,4,'University of Dhaka','Manager',0,NULL,NULL);
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (115,'2018_03_27_212036_create_users',1),(116,'2018_03_27_214859_create_clients',1),(117,'2018_03_27_215135_create_appointment',1),(118,'2018_04_23_090632_create_priorities_table',1),(119,'2018_04_26_210029_create_notifications_table',1),(120,'2018_05_01_094429_create_experience',1),(121,'2018_05_01_095944_create_education',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('8db368b7-bb7d-4622-b2b4-dd0e8a40bff8','App\\Notifications\\AppointmentUpdate','App\\User',3,'{\"notificationTime\":{\"date\":\"2018-05-05 20:37:32.815931\",\"timezone_type\":3,\"timezone\":\"Asia\\/Dhaka\"},\"appointment\":{\"id\":66,\"user_id\":\"10\",\"client_id\":\"3\",\"appointmentTime\":\"2018-05-31T19:00\",\"approved\":1,\"hour\":0,\"min\":49,\"created_at\":null,\"updated_at\":\"2018-05-05 20:37:32\"},\"user\":{\"id\":3,\"name\":\"Ariful Islam\",\"profession\":\"Service Holder\",\"phone\":\"01521204662\",\"email\":\"ariful.foysal@gmail.com\",\"avatar\":null,\"rating\":0,\"rates\":0,\"workStart\":\"22:00:00\",\"workStop\":\"01:00:00\",\"created_at\":\"2018-05-05 20:08:15\",\"updated_at\":\"2018-05-05 20:08:15\"}}',NULL,'2018-05-05 20:37:32','2018-05-05 20:37:32'),('bff9db2f-c77e-4545-a57f-223135292140','App\\Notifications\\AppointmentUpdate','App\\User',3,'{\"notificationTime\":{\"date\":\"2018-05-05 20:36:47.382826\",\"timezone_type\":3,\"timezone\":\"Asia\\/Dhaka\"},\"appointment\":{\"id\":66,\"user_id\":\"10\",\"client_id\":\"3\",\"appointmentTime\":\"2018-05-30T19:00\",\"approved\":1,\"hour\":0,\"min\":49,\"created_at\":null,\"updated_at\":\"2018-05-05 20:36:47\"},\"user\":{\"id\":3,\"name\":\"Ariful Islam\",\"profession\":\"Service Holder\",\"phone\":\"01521204662\",\"email\":\"ariful.foysal@gmail.com\",\"avatar\":null,\"rating\":0,\"rates\":0,\"workStart\":\"22:00:00\",\"workStop\":\"01:00:00\",\"created_at\":\"2018-05-05 20:08:15\",\"updated_at\":\"2018-05-05 20:08:15\"}}',NULL,'2018-05-05 20:36:47','2018-05-05 20:36:47');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priorities`
--

DROP TABLE IF EXISTS `priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '0',
  `rating` double(2,1) NOT NULL DEFAULT '0.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priorities`
--

LOCK TABLES `priorities` WRITE;
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;
INSERT INTO `priorities` VALUES (1,1,1,43,1.0,NULL,NULL),(2,3,10,24,4.0,NULL,NULL),(3,1,7,87,1.2,NULL,NULL),(4,5,2,2,0.5,NULL,NULL),(5,8,1,33,0.9,NULL,NULL),(6,6,1,15,0.5,NULL,NULL),(7,9,1,24,2.5,NULL,NULL),(8,5,7,23,3.7,NULL,NULL),(9,8,10,31,2.8,NULL,NULL),(10,3,8,8,0.9,NULL,NULL),(11,1,9,57,3.6,NULL,NULL),(12,10,9,69,4.4,NULL,NULL),(13,6,7,22,2.4,NULL,NULL),(14,3,6,1,4.5,NULL,NULL),(15,6,7,93,1.3,NULL,NULL),(16,4,10,21,4.0,NULL,NULL),(17,8,8,73,4.3,NULL,NULL),(18,8,2,91,1.1,NULL,NULL),(19,7,2,96,4.7,NULL,NULL),(20,4,4,75,1.5,NULL,NULL),(21,8,6,3,0.9,NULL,NULL),(22,8,7,79,1.5,NULL,NULL),(23,1,8,40,3.8,NULL,NULL),(24,9,5,26,0.8,NULL,NULL),(25,5,7,98,3.1,NULL,NULL),(26,8,6,3,1.8,NULL,NULL),(27,5,8,100,2.7,NULL,NULL),(28,2,9,49,4.7,NULL,NULL),(29,6,9,64,3.0,NULL,NULL),(30,3,4,29,1.7,NULL,NULL);
/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double(2,1) NOT NULL DEFAULT '0.0',
  `rates` int(11) NOT NULL DEFAULT '0',
  `workStart` time NOT NULL DEFAULT '08:00:00',
  `workStop` time NOT NULL DEFAULT '13:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Fariha Hossain','Service Holder','01521204661','noboni5199@gmail.com','$2y$10$n9ylrLP8jD5yuXqJxA6Q4e9Crur0E0/bhr55CUcarDxIQDRgZP7B2',NULL,'a0fexeRWmH0b9qKObryJiFZzQRAXqv7QVDSMs3jWOmmygshQtMJY6eBzkllB',0.0,0,'13:00:00','18:00:00','2018-05-05 20:04:13','2018-05-05 20:04:13'),(2,'Sakib Anwar','Doctor','01521204662','sakibanwar1149095@gmail.com','$2y$10$C84MKnQG3jwQbTEiMwj4m.YUdqWzDePU3kcoiIvUMmJgFy5Io/IAi',NULL,'sLrPOazGY2qHyYik2ZnYcBgAObkicwCeTCeyq0yYt87eLl1885ASfqlcGaj5',0.0,0,'10:00:00','05:00:00','2018-05-05 20:06:03','2018-05-05 20:06:03'),(3,'Ariful Islam','Service Holder','01521204662','ariful.foysal@gmail.com','$2y$10$NY1qYn2Ejq6AYwynegg6yeePgrvul/ajMJhaYsVl0y/uIC5GNyNvm',NULL,'jlxbqNpTQPm1SDayopvIVo841tygRd10ph6K64cWxVXrEmI6LZtwrSSPc2iy',0.0,0,'22:00:00','01:00:00','2018-05-05 20:08:15','2018-05-05 20:08:15'),(4,'Ashraful Islam','Doctor','01682302682','ashraful.nitol@gmail.com','$2y$10$L2lKUNW7NtVThUUi5rkLWeEeg8ynUVniwtpIOVppULh7CDQAlhgGm',NULL,'ijfr26Wgi7LvZe2ynw4Md2bDj3bjUVLQmeIYnNukzBP6IUhMPCpDpNiFp4Rz',0.0,0,'01:00:00','17:00:00','2018-05-05 20:09:49','2018-05-05 20:09:49'),(5,'M M Abid Naziri','Service Holder','01682302682','sakib@gmail.com','$2y$10$0YGYH2BjTuLMOxSlC29cUOpfXVy6htsGiygO0fyjYrH0JBDDolOXm',NULL,'MUVNTpmrOLwAH9WyJgLx0ontY4XpbNBi8GJXI5f6wnjcB9mxY9BAXBudQZQG',0.0,0,'01:00:00','05:00:00','2018-05-05 20:11:59','2018-05-05 20:11:59'),(6,'Nahian Ashraf','Engineer','01521209661','nahian@gmail.com','$2y$10$wGUIMg5/GyU/a7OH2VLoPeAddO8EM44dMFkx1QSLGBr.kDuYR8mWS',NULL,'Sq2XsCMQWjPM4SnICs6H7YOx1666gEuhTBYIjdaHhWeWCm1FBqWMBwbGim4q',0.0,0,'04:00:00','17:00:00','2018-05-05 20:13:28','2018-05-05 20:13:28'),(7,'Shahadat Hossain','Engineer','01682302682','shahadat@gmail.com','$2y$10$2jXG29lBKkjydHO6wx9rsuXI87navrqKPuSYJXN3/8aN5XPRbL4X2',NULL,'48htcP5S1lh7Vi7HAlGbd6YTgmtwE9LfJs0dXJA3Z17wZz1bJyilNGfY8fDd',0.0,0,'00:01:00','04:00:00','2018-05-05 20:15:32','2018-05-05 20:15:32'),(8,'Maria Hossain','Doctor','01683429087','mariahossain058@gmail.com','$2y$10$BaCJGt3lBPS47KVaY1md2.VI/fn2mm7SQDOB25gFCwM3PVIXwOeAu',NULL,'gswbjQg2qY6EFpykRd1ibHkkWmr0dIcoDTCFmcsnB6HQF3Z94JwsbendkCrt',0.0,0,'13:00:00','18:00:00','2018-05-05 20:16:35','2018-05-05 20:16:35'),(9,'Sadia Hossain','Service Holder','01682302682','sadia@gmail.com','$2y$10$9bz68sfzTz3S98o28iBT7u7zk41d8CXAjs6veEDQv4UG9SsGinv.2',NULL,'pNgdyi6lm843ailcaM24VMTXA2lxv3LCFPiHvpid6Gm0hR074UKMldL4qBzU',0.0,0,'22:00:00','01:00:00','2018-05-05 20:17:42','2018-05-05 20:17:42'),(10,'Fariha Noboni','Engineer','01682392682','farihanoboni@ieee.org','$2y$10$1tTUIv54vBoVtXP7XgTNjuVkbolcxbREYRM5zj4iJAiL0NzgM7Ode',NULL,NULL,0.0,0,'18:00:00','22:00:00','2018-05-05 20:19:12','2018-05-05 20:19:12');
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

-- Dump completed on 2018-05-05 15:00:53
