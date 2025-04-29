-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: learnsyntax
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quiz_id` bigint unsigned NOT NULL,
  `exam_id` bigint unsigned NOT NULL,
  `selected_option` enum('option1','option2','option3','option4') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obtained_marks` int NOT NULL DEFAULT '0',
  `attempt` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_user_id_foreign` (`user_id`),
  KEY `answers_quiz_id_foreign` (`quiz_id`),
  KEY `answers_exam_id_foreign` (`exam_id`),
  CONSTRAINT `answers_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignment_uploads`
--

DROP TABLE IF EXISTS `assignment_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignment_uploads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned DEFAULT NULL,
  `assignment_id` bigint unsigned DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `grade` int DEFAULT NULL,
  `status` enum('submitted','graded','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_uploads_student_id_foreign` (`student_id`),
  KEY `assignment_uploads_assignment_id_foreign` (`assignment_id`),
  CONSTRAINT `assignment_uploads_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assignment_uploads_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_uploads`
--

LOCK TABLES `assignment_uploads` WRITE;
/*!40000 ALTER TABLE `assignment_uploads` DISABLE KEYS */;
INSERT INTO `assignment_uploads` VALUES (1,1,1,'1J8v8oIXA5J2qn0yThuR6fFs4VSzSa6m_','2025-02-06 17:17:34',80,'graded','2025-02-06 17:17:34','2025-02-17 10:12:02'),(2,7,1,'1P2h3fYqUq7RctcthN3JrbNFQ5S4wrwcn','2025-02-18 09:02:32',NULL,'submitted','2025-02-18 09:02:32','2025-02-18 09:02:32'),(3,7,2,'1XPpRKR3VFBuy_lzPMXYMUGEd2QSDCgZM','2025-02-18 09:05:23',10,'graded','2025-02-18 09:05:23','2025-02-19 11:00:12'),(4,21,2,'1GA7DIerkhzGpZ3Nt020uRn_T0UtShcmT','2025-02-19 04:42:24',70,'graded','2025-02-19 04:42:24','2025-02-19 11:00:04'),(5,20,2,'1puzsse83dft8blyMjSw006zIFU6F104I','2025-02-19 04:42:31',80,'graded','2025-02-19 04:42:31','2025-02-19 11:00:57'),(6,16,2,'1Rd8tIqYSIA55gSxCdjUonQmyTQ9cZ1Sd','2025-02-19 18:14:49',65,'graded','2025-02-19 18:14:49','2025-02-21 02:18:14'),(7,19,2,'1VExTCixeF1xzPlTez-6nsFD_OsS4wyBJ','2025-02-21 08:04:09',75,'graded','2025-02-21 08:04:09','2025-02-25 04:59:15'),(8,17,2,'1I4YyYOqsWWJOZsVgVGA9f0mFoLni_GkO','2025-02-26 12:39:22',70,'graded','2025-02-26 12:39:22','2025-03-07 04:31:51'),(9,32,3,'1gHkfba_F_FeYzcTsJ04j-UVi6JVSoEuY','2025-02-27 02:44:40',80,'graded','2025-02-27 02:44:40','2025-03-03 02:44:10'),(10,35,4,'1jrmXfN3x3sd-CXpOCFwU6G7X6FlAEYOV','2025-03-01 05:56:01',85,'graded','2025-03-01 05:56:01','2025-03-03 05:46:27'),(11,30,3,'1PmUngdV-kUlNazzJCOfk-inbAqJh0UIJ','2025-03-01 14:39:03',65,'graded','2025-03-01 14:39:03','2025-03-03 02:44:24'),(12,32,4,'1NdToIbbPuOEUdb8GyAfFtMPiNzNfP2nv','2025-03-02 04:59:59',85,'graded','2025-03-02 04:59:59','2025-03-03 05:47:36'),(13,34,3,'1LPLa0ExQ2o7tH2-K8dz8AZKyqo_HlB3d','2025-03-02 05:08:53',60,'graded','2025-03-02 05:08:53','2025-03-03 02:44:31'),(14,33,4,'1mfP7TMiaNIyYxDYSGsz3KHUpOQV0QUMX','2025-03-02 07:58:34',85,'graded','2025-03-02 07:58:34','2025-03-03 05:48:08'),(15,33,4,'1MWbMzaXEf-gTR71ya1HjKDiqhI9gzMQy','2025-03-02 07:58:38',85,'graded','2025-03-02 07:58:38','2025-04-08 08:16:55'),(16,33,4,'1vMcPFmx1NMvkcrp0ed7QvrcIZnCt1ccW','2025-03-02 07:58:38',NULL,'submitted','2025-03-02 07:58:38','2025-03-02 07:58:38'),(17,30,5,'1als8hberLlRHf0YC7OBe9hc7uMNN7x1f','2025-03-04 01:43:00',75,'graded','2025-03-04 01:43:00','2025-03-07 02:39:48'),(18,36,4,'1ixQ7jq_o5_sPPIzKUUVBWTszM2yZN1q2','2025-03-04 14:43:29',80,'graded','2025-03-04 14:43:29','2025-04-08 08:16:35'),(19,22,2,'11W6g8VQOwxmpNJBytYb8nj1l6eM1q0dx','2025-03-04 17:14:09',80,'graded','2025-03-04 17:14:09','2025-03-07 04:32:57'),(20,32,5,'1T8iYqy5O3mnR0WHDxsXUJFco7kXKz90Y','2025-03-04 18:53:29',80,'graded','2025-03-04 18:53:29','2025-03-07 02:40:08'),(21,37,5,'1Le3vRX-15xlVke9SPDpw-ZqLeMGyxHkW','2025-03-05 14:46:38',70,'graded','2025-03-05 14:46:38','2025-03-07 02:40:46'),(22,44,3,'1D57shTf5I37z81EMTNYnuiA2jBk6Mgj1','2025-03-06 14:57:36',60,'graded','2025-03-06 14:57:36','2025-03-07 02:44:17'),(23,44,5,'1nMC7I0oiU27kpb6ksk5_Ma10Pq95lulR','2025-03-07 01:52:42',80,'graded','2025-03-07 01:52:42','2025-03-07 02:42:19'),(24,34,5,'1e8A5lJW6j88Ynv9K85W_EiwW32B8So96','2025-03-07 02:41:40',80,'graded','2025-03-07 02:41:40','2025-03-07 02:43:35'),(25,31,3,'1usYShJPNdBRFDOLyFwf4T7ChgLkF0xcT','2025-03-08 16:08:27',80,'graded','2025-03-08 16:08:27','2025-03-17 04:00:51'),(26,31,5,'1i6DfgQtlfoByrIYY00xUWjhBofvZUdkB','2025-03-08 16:09:31',80,'graded','2025-03-08 16:09:31','2025-03-17 04:01:21'),(27,31,7,'1Br-mwLkU5wJ2BKlFKSF9n5xXOlm4f37I','2025-03-08 16:24:51',75,'graded','2025-03-08 16:24:51','2025-03-10 02:46:40'),(28,35,9,'1Iq8Nlgy7P0yNJgxBqWth54oHRLZtXDzu','2025-03-09 05:58:09',85,'graded','2025-03-09 05:58:09','2025-04-21 08:07:49'),(29,44,7,'1Mz5cMKxoh7Tlbuh0TBUKZr4Mbfqld_d7','2025-03-09 07:56:57',75,'graded','2025-03-09 07:56:57','2025-03-10 02:47:40'),(30,32,9,'12m57KlJPZVPEP2wsVvnV1BZgmstLG7fg','2025-03-09 15:55:34',83,'graded','2025-03-09 15:55:34','2025-04-21 08:08:00'),(31,32,7,'1FI--i_gVAf-DcYa1gm89urIftU0kBLzT','2025-03-09 18:49:19',80,'graded','2025-03-09 18:49:19','2025-03-10 02:47:57'),(32,36,9,'1Vg5rA6-looeK0uCmn4xsbBG7mQWdnd6v','2025-03-09 19:06:58',85,'graded','2025-03-09 19:06:58','2025-04-21 08:08:04'),(33,45,10,'1yWlBgKnNmCDkYfoUmKsBzB5SkNhQ97zT','2025-03-09 22:40:22',70,'graded','2025-03-09 22:40:22','2025-03-12 10:37:42'),(34,30,7,'1mD_aUUwRISKqiNesvmQfvVElfElkM9tT','2025-03-10 02:44:40',75,'graded','2025-03-10 02:44:40','2025-03-10 02:48:18'),(35,34,7,'1nLnxZM1XVPCc8pHMEiHcwnOkKLKM3QV3','2025-03-10 02:45:14',75,'graded','2025-03-10 02:45:14','2025-03-10 02:48:50'),(36,21,8,'1rhQ7q3K1Dy_p09jd-1PDnYm3pgjZ6rL_','2025-03-10 02:52:38',75,'graded','2025-03-10 02:52:38','2025-04-21 08:08:32'),(37,41,10,'10-BOqTZWMxhGehUU8RUNAYBKhavcXJhE','2025-03-10 04:25:14',70,'graded','2025-03-10 04:25:14','2025-03-12 10:38:31'),(38,33,9,'1DCN0qF7bb02unpsUmzAy-Lj4RSOoH8dU','2025-03-10 04:57:33',85,'graded','2025-03-10 04:57:33','2025-04-21 08:08:07'),(39,37,7,'1fVd-wW1rQCkwydR8oH2lsagOvPCmNov_','2025-03-10 15:22:36',NULL,'submitted','2025-03-10 15:22:36','2025-03-10 15:22:36'),(40,27,4,'1gyiVGAX3zD5HvRUpjQa91BIKTtfx8rTe','2025-03-11 12:54:22',60,'graded','2025-03-11 12:54:22','2025-04-08 08:16:18'),(41,48,10,'11wQiMJS0wozbI9PR7oSrph-OwWTEwYwi','2025-03-11 14:37:26',65,'graded','2025-03-11 14:37:26','2025-03-12 10:39:56'),(42,27,9,'1N3L1gtF_6UwpJ1EXB2WX-ztDn9AxWIBt','2025-03-12 04:04:51',80,'graded','2025-03-12 04:04:51','2025-04-21 08:08:14'),(43,17,10,'1CgxeIcUcpRWV5sMrHElwljDhX3QYPVZK','2025-03-12 06:06:08',70,'graded','2025-03-12 06:06:08','2025-03-12 10:41:22'),(44,47,10,'1julGI0m68OiXn13u0pSGf4CscF6tn-7x','2025-03-12 07:42:18',50,'graded','2025-03-12 07:42:18','2025-03-12 10:42:39'),(46,20,8,'1OApxSb-031mE1B7o3zgAGDyAngGcgHYp','2025-03-15 03:13:28',78,'graded','2025-03-15 03:13:28','2025-04-21 08:08:37'),(51,45,12,'1ws91enuUaro-Uc3q36RyyBbXkf5wZQZs','2025-03-17 08:29:23',75,'graded','2025-03-17 08:29:23','2025-03-17 10:43:59'),(52,41,12,'1bbSdpeiTsg7naHQDdf_617Oe69ORuDXT','2025-03-17 10:42:36',75,'graded','2025-03-17 10:42:36','2025-03-17 10:44:43'),(54,34,10,'1kBK6fAd7UF42fr3BnU5JyZGYZrEwMpis','2025-03-18 09:01:04',NULL,'submitted','2025-03-18 09:01:04','2025-03-18 09:01:04'),(55,47,12,'1nJGbguneR0Ho3BWjPWUWozHAeFhqQkp8','2025-03-18 11:26:44',NULL,'submitted','2025-03-18 11:26:44','2025-03-18 11:26:44'),(57,34,12,'1y3q_V3yROjR41OZkjkXDMH-Hqvojkie8','2025-03-24 16:02:10',NULL,'submitted','2025-03-24 16:02:10','2025-03-24 16:02:10'),(58,34,12,'1qhNxt5dUr2-57AivGW0b05LwpwNPsSBY','2025-03-24 16:02:21',NULL,'submitted','2025-03-24 16:02:21','2025-03-24 16:02:21'),(59,53,10,'16OptW9vKbA_hthvxChPV8vFnGpBiiFRZ','2025-03-27 04:44:46',NULL,'submitted','2025-03-27 04:44:46','2025-03-27 04:44:46'),(60,54,15,'1xmVSA2PkoMola8f5Rnf19nh2WDF9bEmJ','2025-04-07 09:31:41',NULL,'submitted','2025-04-07 09:31:41','2025-04-07 09:31:41'),(61,54,15,'1T_u52kDOdfhEdZ6S9JRC8ht9gR2lqD5Z','2025-04-07 09:32:04',80,'graded','2025-04-07 09:32:04','2025-04-08 08:14:05'),(62,30,15,'14eygrJ7ReIa2VXsV13ShNXsfertmZou3','2025-04-07 10:53:16',NULL,'submitted','2025-04-07 10:53:16','2025-04-07 10:53:16'),(63,30,15,'1WEMhNB_jZdsJGv4s45asKxitKa6wuCfM','2025-04-07 10:53:37',80,'graded','2025-04-07 10:53:37','2025-04-08 08:13:22'),(64,34,15,'1o4FY7WxxpY2ZCizBwEKXiz_XCqOvppfc','2025-04-08 08:12:29',70,'graded','2025-04-08 08:12:29','2025-04-08 08:14:16'),(65,32,15,'1jKfeqOCzXbFgNV9imCe-I63dlskWHnwW','2025-04-08 08:19:52',NULL,'submitted','2025-04-08 08:19:52','2025-04-08 08:19:52'),(66,13,10,'1hSylyGMA42f0VtUNK-LQwd81qSN3Llqh','2025-04-09 07:10:37',NULL,'submitted','2025-04-09 07:10:37','2025-04-09 07:10:37'),(67,48,12,'11fKn7jznoIKK9p4YMzZjsscIL0H6rCZS','2025-04-09 16:29:14',NULL,'submitted','2025-04-09 16:29:14','2025-04-09 16:29:14'),(68,48,12,'17XmtSN8qgJk2fheBjLp_46KZsPam3xws','2025-04-09 16:29:21',NULL,'submitted','2025-04-09 16:29:21','2025-04-09 16:29:21'),(69,7,8,'1KqGR_FzCOjhnO2DvajPdorgzN8XxhKS2','2025-04-10 13:09:12',0,'graded','2025-04-10 13:09:12','2025-04-21 08:08:53'),(70,39,17,'1M90-2cDmMMTH1LGBI-n2d9OmCi0x_dIQ','2025-04-11 14:25:33',NULL,'submitted','2025-04-11 14:25:33','2025-04-11 14:25:33'),(71,26,17,'1da_V2LgHhkJZeeC8KhKGTXvUxuI9teyR','2025-04-11 15:05:48',NULL,'submitted','2025-04-11 15:05:48','2025-04-11 15:05:48'),(72,7,20,'1C3r3MJcEmta1JSVDqYzlZ-0_EPZhZ0zZ','2025-04-13 19:33:57',0,'graded','2025-04-13 19:33:57','2025-04-21 08:12:47'),(73,39,23,'1c3WjtC9YTDUrOHz56Jxf8JcwKb5QfJp2','2025-04-13 20:42:19',70,'graded','2025-04-13 20:42:19','2025-04-13 21:24:50'),(74,20,20,'1ULU7iXOPeskMfTeCsz4yeFc2n9sttLIE','2025-04-13 21:03:02',NULL,'submitted','2025-04-13 21:03:02','2025-04-13 21:03:02'),(75,20,20,'1qLnpyTevlrQFS091sMkMBoLc76D1twqY','2025-04-13 21:03:19',75,'graded','2025-04-13 21:03:19','2025-04-14 09:20:36'),(76,34,21,'1w_kif4UUYFl_re5gyBRquUiuO8FbGvZE','2025-04-13 23:08:48',NULL,'submitted','2025-04-13 23:08:48','2025-04-13 23:08:48'),(77,34,21,'1G570NhH8muZbuaF8MYX_fB7uQZn9QfiX','2025-04-13 23:09:10',85,'graded','2025-04-13 23:09:10','2025-04-21 08:10:26'),(78,32,21,'1pu6ZQxWOeOoZYyb8PqOlPDKkSnrlMkvx','2025-04-13 23:23:33',NULL,'submitted','2025-04-13 23:23:33','2025-04-13 23:23:33'),(79,32,21,'1gK3DGERA3bUTvwe-K5vo5ACm-KmVx9jB','2025-04-13 23:23:56',85,'graded','2025-04-13 23:23:56','2025-04-21 08:10:31'),(80,42,17,'1EeQFFfypZ1G474zD_yXLz0Y7HZ_mlQ3V','2025-04-14 10:45:42',NULL,'submitted','2025-04-14 10:45:42','2025-04-14 10:45:42'),(81,30,21,'1FxhOQM4ulXFv-jadUTJRNkk4lvpYALGd','2025-04-14 10:52:02',NULL,'submitted','2025-04-14 10:52:02','2025-04-14 10:52:02'),(82,30,21,'1uU8poMEVgopLFc1SuB9e_remuKi5nLbz','2025-04-14 10:52:16',85,'graded','2025-04-14 10:52:16','2025-04-21 08:10:37'),(83,42,23,'1QfDpeq1P8zmDcLWdBOMu45tRgWTStaiJ','2025-04-14 10:58:52',NULL,'submitted','2025-04-14 10:58:52','2025-04-14 10:58:52'),(84,21,20,'1g_glOGXFZkuiCUURhCPjjy06q4u8VlUc','2025-04-14 11:27:42',NULL,'submitted','2025-04-14 11:27:42','2025-04-14 11:27:42'),(85,49,22,'1BKthtxr_x3y6WtJY-JpKyODH4jttpSjU','2025-04-14 12:06:42',72,'graded','2025-04-14 12:06:42','2025-04-14 13:58:21'),(86,26,23,'1MH_2flcTwsmZSSMNkDzNUIynlRY5WCcx','2025-04-14 13:53:01',NULL,'submitted','2025-04-14 13:53:01','2025-04-14 13:53:01'),(87,65,19,'1m9BmlL4H-E52UCa22sSVJiXxG0n1TM9j','2025-04-14 23:27:39',NULL,'submitted','2025-04-14 23:27:39','2025-04-14 23:27:39'),(88,65,19,'1Sopj2v8TwUI0BmC-H8HyaO4hN_QEVAKe','2025-04-14 23:28:07',NULL,'submitted','2025-04-14 23:28:07','2025-04-14 23:28:07'),(89,65,19,'1eU-ubLYkIz1fgAb6u2Ze0NDOmzjjKCY0','2025-04-14 23:28:41',65,'graded','2025-04-14 23:28:41','2025-04-16 07:54:48'),(90,69,17,'1mxTnvPrSpRotNBSDXPmvnzRHM7raeNhl','2025-04-15 11:18:21',NULL,'submitted','2025-04-15 11:18:21','2025-04-15 11:18:21'),(91,63,17,'1-o-eOyC2yYixjE_qq4FOGmR2Axtfd_VC','2025-04-15 11:43:31',NULL,'submitted','2025-04-15 11:43:31','2025-04-15 11:43:31'),(92,19,8,'1vhiFU-Ut0ibZzzR4F7vpjl24bxadUW-m','2025-04-15 23:29:07',85,'graded','2025-04-15 23:29:07','2025-04-21 08:09:14'),(93,36,22,'1ALQ4CmSYnfctAX4PK55LCZNG7IuUcQVk','2025-04-16 08:47:05',NULL,'submitted','2025-04-16 08:47:05','2025-04-16 08:47:05'),(94,54,21,'1ypJcH2IM5kAdqbhjHEiQjZHBFlGLMrds','2025-04-17 22:18:10',75,'graded','2025-04-17 22:18:10','2025-04-21 08:10:47'),(95,37,15,'1bcpGgECw6qH75Up5WKDNRGXSTyU9eC-p','2025-04-18 08:33:04',NULL,'submitted','2025-04-18 08:33:04','2025-04-18 08:33:04'),(96,37,21,'1ss7OIUS3Jwwn3JraInwP1mVj0gNwl2F9','2025-04-18 08:34:59',75,'graded','2025-04-18 08:34:59','2025-04-21 08:11:08'),(97,65,25,'194Rl2tihd3YOqMAUnZ1q-WvKB1zdA2xp','2025-04-20 21:30:11',NULL,'submitted','2025-04-20 21:30:11','2025-04-20 21:30:11'),(98,32,28,'1A5Wx2xbhNX5DjjnL_5UuJXQ--ZIPoky2','2025-04-21 20:07:38',NULL,'submitted','2025-04-21 20:07:38','2025-04-21 20:07:38'),(99,34,28,'1ZPEKevAY0u-AqsnwY3UGn-VmTU1stVKG','2025-04-21 20:18:15',NULL,'submitted','2025-04-21 20:18:15','2025-04-21 20:18:15'),(100,30,28,'1oairiadF83UhnCLzgYUiYBGYWyQJEUDs','2025-04-21 20:25:02',NULL,'submitted','2025-04-21 20:25:02','2025-04-21 20:25:02'),(101,54,28,'1_vuIWXnpFIEbnRCi6T37qEk9FNMIXqZY','2025-04-21 22:31:04',NULL,'submitted','2025-04-21 22:31:04','2025-04-21 22:31:04');
/*!40000 ALTER TABLE `assignment_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `due_date` datetime DEFAULT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `batch_id` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignments_course_id_foreign` (`course_id`),
  KEY `assignments_batch_id_foreign` (`batch_id`),
  CONSTRAINT `assignments_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assignments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (2,'Explain Different type of data types in python? and its casting with example','<p>Explain Different type of data types in python? and its casting with example</p>',NULL,1,2,1,'2025-02-14 03:48:00','2025-02-14 03:48:00'),(3,'Create table for timetable','<p>see image for ref : <a href=\"https://programmingtrick.com/upload/1641874727.png\">https://programmingtrick.com/upload/1641874727.png</a>&nbsp;</p>',NULL,5,4,1,'2025-02-25 02:52:29','2025-02-25 02:52:29'),(4,'C++ introduction','<p>explain few things&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>1. keywords &amp; identifier with example&nbsp;</p><p>2. variable &amp; constant with example</p><p>3. basic datatype with its modifiers with example</p><p>4. escape sequences&nbsp;</p>',NULL,4,3,1,'2025-02-27 05:49:24','2025-02-27 05:49:24'),(5,'Create admission Form','<figure class=\"image\"><img src=\"https://files.codingninjas.in/article_images/custom-upload-1682703830.webp\"></figure>',NULL,5,4,1,'2025-03-03 02:47:34','2025-03-03 02:47:34'),(6,'php variable, constant, operator and data type, function explain with example',NULL,NULL,6,5,1,'2025-03-05 10:39:32','2025-03-05 10:39:32'),(7,'Create a portfolio webpage and details about you with your resume',NULL,NULL,5,4,1,'2025-03-07 02:45:34','2025-03-07 02:45:34'),(8,'python 2nd module','<ol><li>operator&nbsp;</li><li>loop</li><li>function</li><li>data types</li><li>list</li><li>tuple</li><li>string</li><li>set</li><li>dict</li></ol>',NULL,1,2,1,'2025-03-07 04:30:52','2025-03-07 04:30:52'),(9,'assignment module 2','<ol><li>if else… else if statement&nbsp;</li><li>switch case statement</li><li>operators</li><li>type casting</li><li>fundamental data types</li><li>loop and its type</li></ol>',NULL,4,3,1,'2025-03-07 05:35:07','2025-03-07 05:35:07'),(10,'Assignment Module 1  - C Programming Basics','<h3><strong>Assignment: C Programming Basics</strong></h3><h4><strong>1. Variables in C</strong></h4><p>Write a C program that declares and initializes three different types of variables: an integer, a float, and a character. Print their values on the screen.</p><h4><strong>2. Keywords in C</strong></h4><p>Explain what keywords are in C programming. List any five keywords and describe their usage with an example.</p><h4><strong>3. Constants in C</strong></h4><p>Write a C program that demonstrates the use of a #define preprocessor directive and the const keyword to declare constants. Show the difference between them using an example.</p><h4><strong>4. Basic Structure of a C Program</strong></h4><p>Write a simple C program that follows the basic structure of a C program, including #include, main(), variable declaration, input/output, and return statement. The program should ask the user to enter their name and then print a greeting message.</p>',NULL,2,6,1,'2025-03-08 05:21:40','2025-03-08 05:21:40'),(12,'Assignment Module 2: C Programming - Operators, Data Types, and Sizes','<h3>&nbsp;</h3><p><strong>Data Types in C</strong><br>Write a C program that declares variables of the following data types: int, float, char, and double. Print their values along with their respective sizes using the sizeof() operator.</p><p><strong>Arithmetic Operators in C</strong><br>Write a C program that takes two integer inputs from the user and performs the following operations: addition, subtraction, multiplication, division, and modulus. Display the results for each operation.</p><p><strong>Relational Operators in C</strong><br>Write a C program that compares two numbers using relational operators (&gt;, &lt;, &gt;=, &lt;=, ==, !=). Display whether each condition is true or false.</p><p><strong>Logical Operators in C</strong><br>Write a C program that asks the user for their age and nationality. Using logical operators (&amp;&amp;, ||, !), determine if the person is eligible to vote (e.g., age ≥ 18 and nationality = Indian).</p>',NULL,2,6,1,'2025-03-16 06:58:52','2025-03-16 06:58:52'),(15,'Invoice Plane web site clone','https://invoiceplane.com/','2025-04-08 07:29:00',5,4,1,'2025-04-07 07:29:13','2025-04-07 07:29:13'),(16,'Module 1 : 4 Days topics','Introduction, variable, compiler, Programming Language Basic\nkeyword & identifer\nVariable & constant, escape sequences, data types\nfundamental data type, specifier, modifier, format specifier, input / output','2025-04-12 12:00:00',8,8,1,'2025-04-10 07:56:51','2025-04-10 07:58:23'),(17,'Create dynamic name route','if we pass name of the student show dynamic details according to name','2025-04-11 15:10:00',10,9,1,'2025-04-10 15:10:35','2025-04-10 15:10:35'),(19,' C Programming - Operators, Arithmetic , Assignment and Logical Operators','1. Basic Arithmetic Operations\nWrite a C program that takes two integers as input and performs all arithmetic operations: addition, subtraction, multiplication, division, and modulus.\n\n2. Logical Operator Check\nWrite a program to input two integers and display:\n\na && b\n\na || b\n\n!a Explain the result in comments.\n\n3. Even or Odd using % Operator\nInput an integer and check if it\'s even or odd using the modulus operator.\n\n4. What is an Operator in C?\n\n5. Arithmetic Operators in C Programming\n','2025-04-14 12:01:00',8,8,1,'2025-04-13 12:01:54','2025-04-13 12:01:54'),(20,'Python Module 3','Q1. Write a Python program that takes a number from the user and prints whether it\'s even or odd.\n\nQ2. Write a Python function that takes a list of numbers and returns the second largest number.(Bonus: Handle cases where the list has duplicate values.)\n\nQ3. Write a Python program to count the frequency of each character in a given string.\n\nQ4. Write a Python program that reads a text file and prints the top 3 most frequent words along with their counts.\n\nQ5. Write a Python program that checks if a given string is a palindrome (ignoring spaces, punctuation, and case).','2025-04-15 12:00:00',1,2,1,'2025-04-13 12:09:19','2025-04-14 23:24:46'),(21,'create clone using HTML CSS','(https://mybillbook.in) This website front page design','2025-04-14 12:00:00',5,4,1,'2025-04-13 12:15:50','2025-04-13 14:05:30'),(22,'Basic Php Modules - 1','1. What is PHP?\nDefine PHP and explain its primary use cases in web development.\n\nDescribe how PHP interacts with HTML to create dynamic web pages.\n\n2. PHP Variables and Data Types\nCreate a PHP script that defines variables of different data types (e.g., string, integer, float, boolean, array) and outputs them using \n\n\n3. PHP Conditional Statements\nWrite a PHP script that checks if a number is positive, negative, or zero using an if-else statement\n\n4. PHP Loops (For and While Loops)\nWrite a PHP script that prints numbers from 1 to 10 using a for loop and then prints the same numbers in reverse order using a while loop.\n\n5. PHP Operators (Arithmetic and Comparison)\nWrite a PHP script that demonstrates the use of arithmetic operators and comparison operators.\n\nArithmetic Operators: +, -, *, /, %\n\nComparison Operators: ==, !=, >, =, ','2025-04-14 12:08:00',6,5,1,'2025-04-13 12:27:37','2025-04-13 12:27:37'),(23,'Laravel basic Module-2','Create a new Laravel project and Create a controller and model ','2025-04-14 12:04:00',10,9,1,'2025-04-13 12:32:09','2025-04-13 12:32:09'),(25,'C programming module 2 ','1: Write a program that displays your name, age, and a short message using escape sequences (e.g., newline, tab). Declare variables for name, age, and message.\n\n\n2. Create a program that takes input for different types of data: integer, float, character, and double. Then print them using the correct format specifiers.\n\n3. Write a program that accepts two numbers from the user and performs addition, subtraction, multiplication, division, and modulus. Then compare the numbers using relational operators.\n\n4. Write a program that demonstrates the use of pre and post increment/decrement. Then take two boolean conditions and apply logical AND (&&) or OR (||).\n\n5. Create a program that checks if a number is even using bitwise AND (&). Also demonstrate the use of bitwise OR (|) and XOR (^) on two integers. Include logical operator conditions as well.\n\n6. Write a program that takes a float input from the user and casts it to an integer (both implicitly and explicitly). Use if-else or else-if ladder to classify the number as positive, negative, or zero.\n\n\n7. divisible by both 2 and 3. If not, use nested if to check which one it is divisible by. Then print numbers from 1 to 10 using both for and while loops.\n\n8. Write a program that calculates the factorial of a number using a for loop and then again using a while loop.','2025-04-20 12:00:00',8,8,1,'2025-04-19 07:43:13','2025-04-19 07:43:13'),(26,'Python module 4','Python start to end','2025-04-22 12:00:00',1,2,1,'2025-04-19 07:46:14','2025-04-21 09:33:42'),(27,'Laravel module 3','1. Describe the steps to install a new Laravel project using Composer.\n\n\n2.  Create a controller named ProductController and implement the following methods:\na) index() – Displays a list of products (use static array or DB)\nb) show($id) – Displays a single product based on dynamic route\nc) Create Blade view files to show the list and product details.\n\n\n3. Create a database named assignment_db and update .env file with DB credentials.\nb) Create a migration for a products table with fields: id, name, description, price.\nc) Create a model for Product and run migration to generate the table.\n\n4.  Build a small CRUD application to manage products.\na) Implement Insert functionality with form validation\nb) Implement Delete functionality\nc) Show all products using GET method and Blade view\nd) Use Laravel’s form validation to validate the inputs\n\n\n5. Create a mini Laravel application that does the following:\n• Display a list of students (name, email, course)\n• Add new students using a form with validation\n• Delete a student from the list\n• Use Laravel MVC structure and database to store data','2025-04-20 12:00:00',10,9,1,'2025-04-19 07:52:04','2025-04-19 07:52:04'),(28,'Create Shopping Cart Page design using tailwindcss ','https://snipboard.io/uegaK0.jpg','2025-04-22 08:18:00',5,4,1,'2025-04-21 08:18:34','2025-04-21 08:18:34');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `batch_id` bigint unsigned NOT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `attendance_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_user_id_foreign` (`user_id`),
  KEY `attendances_course_id_foreign` (`course_id`),
  KEY `attendances_batch_id_foreign` (`batch_id`),
  CONSTRAINT `attendances_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,54,5,4,'2025-03-27 07:10:25','offline','2025-03-27 07:10:25','2025-03-27 07:10:25'),(2,54,5,4,'2025-03-29 09:41:54','offline','2025-03-29 09:41:54','2025-03-29 09:41:54'),(3,13,2,6,'2025-04-06 09:29:15','offline','2025-04-06 09:29:15','2025-04-06 09:29:15'),(5,54,5,4,'2025-04-08 08:22:26','offline','2025-04-08 08:22:26','2025-04-08 08:22:26'),(6,30,5,4,'2025-04-08 08:23:02','offline','2025-04-08 08:23:02','2025-04-08 08:23:02'),(7,37,5,4,'2025-04-08 08:23:21','offline','2025-04-08 08:23:21','2025-04-08 08:23:21'),(8,32,5,4,'2025-04-08 08:24:37','offline','2025-04-08 08:24:37','2025-04-08 08:24:37'),(9,67,5,4,'2025-04-08 08:25:29','offline','2025-04-08 08:25:29','2025-04-08 08:25:29'),(10,34,5,4,'2025-04-08 08:26:23','offline','2025-04-08 08:26:23','2025-04-08 08:26:23'),(11,31,5,4,'2025-04-08 08:31:07','offline','2025-04-08 08:31:07','2025-04-08 08:31:07'),(15,36,6,5,'2025-04-08 11:16:22','offline','2025-04-08 11:16:22','2025-04-08 11:16:22'),(16,49,6,5,'2025-04-08 15:22:05','offline','2025-04-08 15:22:05','2025-04-08 15:22:05'),(17,43,6,5,'2025-04-08 15:32:03','offline','2025-04-08 15:32:03','2025-04-08 15:32:03'),(18,39,10,9,'2025-04-08 15:54:14','offline','2025-04-08 15:54:14','2025-04-08 15:54:14'),(19,17,2,6,'2025-04-08 17:22:40','offline','2025-04-08 17:22:40','2025-04-08 17:22:40'),(20,34,2,6,'2025-04-08 17:23:01','offline','2025-04-08 17:23:01','2025-04-08 17:23:01'),(21,48,2,6,'2025-04-08 17:23:10','offline','2025-04-08 17:23:10','2025-04-08 17:23:10'),(22,45,2,6,'2025-04-08 17:24:01','offline','2025-04-08 17:24:01','2025-04-08 17:24:01'),(23,41,2,6,'2025-04-08 17:24:09','offline','2025-04-08 17:24:09','2025-04-08 17:24:09'),(24,53,2,6,'2025-04-08 17:24:27','offline','2025-04-08 17:24:27','2025-04-08 17:24:27'),(25,54,5,4,'2025-04-09 09:21:16','offline','2025-04-09 09:21:16','2025-04-09 09:21:16'),(26,31,5,4,'2025-04-09 09:21:24','offline','2025-04-09 09:21:24','2025-04-09 09:21:24'),(27,32,5,4,'2025-04-09 09:21:34','offline','2025-04-09 09:21:34','2025-04-09 09:21:34'),(28,34,5,4,'2025-04-09 09:21:42','offline','2025-04-09 09:21:42','2025-04-09 09:21:42'),(29,30,5,4,'2025-04-09 09:21:54','offline','2025-04-09 09:21:54','2025-04-09 09:21:54'),(34,39,10,9,'2025-04-09 14:46:33','offline','2025-04-09 14:46:33','2025-04-09 14:46:33'),(35,43,6,5,'2025-04-09 16:04:38','offline','2025-04-09 16:04:38','2025-04-09 16:04:38'),(36,36,6,5,'2025-04-09 16:04:49','offline','2025-04-09 16:04:49','2025-04-09 16:04:49'),(37,49,6,5,'2025-04-09 16:05:13','offline','2025-04-09 16:05:13','2025-04-09 16:05:13'),(38,38,6,5,'2025-04-09 16:06:32','offline','2025-04-09 16:06:32','2025-04-09 16:06:32'),(39,17,2,6,'2025-04-09 16:37:28','offline','2025-04-09 16:37:28','2025-04-09 16:37:28'),(40,48,2,6,'2025-04-09 16:37:38','offline','2025-04-09 16:37:38','2025-04-09 16:37:38'),(41,34,2,6,'2025-04-09 16:38:22','offline','2025-04-09 16:38:22','2025-04-09 16:38:22'),(42,53,2,6,'2025-04-09 16:38:45','offline','2025-04-09 16:38:45','2025-04-09 16:38:45'),(43,65,8,8,'2025-04-10 13:56:20','offline','2025-04-10 13:56:20','2025-04-10 13:56:20'),(44,39,10,9,'2025-04-10 14:30:40','offline','2025-04-10 14:30:40','2025-04-10 14:30:40'),(45,54,5,4,'2025-04-10 14:31:05','offline','2025-04-10 14:31:05','2025-04-10 14:31:05'),(46,30,5,4,'2025-04-10 14:31:27','offline','2025-04-10 14:31:27','2025-04-10 14:31:27'),(47,45,2,6,'2025-04-10 14:32:08','offline','2025-04-10 14:32:08','2025-04-10 14:32:08'),(48,54,5,4,'2025-04-11 09:28:44','offline','2025-04-11 09:28:44','2025-04-11 09:28:44'),(49,30,5,4,'2025-04-11 09:28:51','offline','2025-04-11 09:28:51','2025-04-11 09:28:51'),(50,32,5,4,'2025-04-11 09:28:58','offline','2025-04-11 09:28:58','2025-04-11 09:28:58'),(51,34,5,4,'2025-04-11 09:29:06','offline','2025-04-11 09:29:06','2025-04-11 09:29:06'),(52,37,5,4,'2025-04-11 09:29:48','offline','2025-04-11 09:29:48','2025-04-11 09:29:48'),(53,31,5,4,'2025-04-11 09:30:44','offline','2025-04-11 09:30:44','2025-04-11 09:30:44'),(57,36,4,3,'2025-04-11 10:33:32','offline','2025-04-11 10:33:32','2025-04-11 10:33:32'),(58,32,4,3,'2025-04-11 10:33:41','offline','2025-04-11 10:33:41','2025-04-11 10:33:41'),(60,39,10,9,'2025-04-11 14:55:18','offline','2025-04-11 14:55:18','2025-04-11 14:55:18'),(61,26,10,9,'2025-04-11 14:58:59','offline','2025-04-11 14:58:59','2025-04-11 14:58:59'),(62,43,6,5,'2025-04-11 15:34:50','offline','2025-04-11 15:34:50','2025-04-11 15:34:50'),(63,38,6,5,'2025-04-11 15:34:54','offline','2025-04-11 15:34:54','2025-04-11 15:34:54'),(64,49,6,5,'2025-04-11 15:34:56','offline','2025-04-11 15:34:56','2025-04-11 15:34:56'),(65,36,6,5,'2025-04-11 15:34:58','offline','2025-04-11 15:34:58','2025-04-11 15:34:58'),(66,17,2,6,'2025-04-11 16:30:34','offline','2025-04-11 16:30:34','2025-04-11 16:30:34'),(67,45,2,6,'2025-04-11 16:31:14','offline','2025-04-11 16:31:14','2025-04-11 16:31:14'),(68,48,2,6,'2025-04-11 16:31:31','offline','2025-04-11 16:31:31','2025-04-11 16:31:31'),(69,40,2,6,'2025-04-11 16:33:43','offline','2025-04-11 16:33:43','2025-04-11 16:33:43'),(70,67,8,8,'2025-04-12 07:45:25','offline','2025-04-12 07:45:25','2025-04-12 07:45:25'),(71,65,8,8,'2025-04-12 18:17:18','offline','2025-04-12 18:17:18','2025-04-12 18:17:18'),(72,65,8,8,'2025-04-13 17:40:59','offline','2025-04-13 17:40:59','2025-04-13 17:40:59'),(73,67,8,8,'2025-04-13 20:57:08','offline','2025-04-13 20:57:08','2025-04-13 20:57:08'),(74,67,8,8,'2025-04-14 08:07:51','offline','2025-04-14 08:07:51','2025-04-14 08:07:51'),(75,54,5,4,'2025-04-14 09:14:42','offline','2025-04-14 09:14:42','2025-04-14 09:14:42'),(76,30,5,4,'2025-04-14 09:14:46','offline','2025-04-14 09:14:46','2025-04-14 09:14:46'),(77,37,5,4,'2025-04-14 09:14:54','offline','2025-04-14 09:14:54','2025-04-14 09:14:54'),(78,32,5,4,'2025-04-14 09:15:01','offline','2025-04-14 09:15:01','2025-04-14 09:15:01'),(79,34,5,4,'2025-04-14 09:15:08','offline','2025-04-14 09:15:08','2025-04-14 09:15:08'),(84,65,8,8,'2025-04-14 14:11:31','offline','2025-04-14 14:11:31','2025-04-14 14:11:31'),(89,20,1,2,'2025-04-14 15:06:23','offline','2025-04-14 15:06:23','2025-04-14 15:06:23'),(90,17,1,2,'2025-04-14 15:06:24','offline','2025-04-14 15:06:24','2025-04-14 15:06:24'),(92,21,1,2,'2025-04-14 15:15:00','offline','2025-04-14 15:15:00','2025-04-14 15:15:00'),(93,19,1,2,'2025-04-14 15:15:04','offline','2025-04-14 15:15:04','2025-04-14 15:15:04'),(94,39,10,9,'2025-04-14 15:35:59','offline','2025-04-14 15:35:59','2025-04-14 15:35:59'),(95,24,10,9,'2025-04-14 15:37:41','offline','2025-04-14 15:37:41','2025-04-14 15:37:41'),(96,42,10,9,'2025-04-14 15:38:22','offline','2025-04-14 15:38:22','2025-04-14 15:38:22'),(97,43,6,5,'2025-04-14 15:38:44','offline','2025-04-14 15:38:44','2025-04-14 15:38:44'),(98,69,10,9,'2025-04-14 15:38:51','offline','2025-04-14 15:38:51','2025-04-14 15:38:51'),(99,63,10,9,'2025-04-14 15:38:55','offline','2025-04-14 15:38:55','2025-04-14 15:38:55'),(100,49,6,5,'2025-04-14 15:39:03','offline','2025-04-14 15:39:03','2025-04-14 15:39:03'),(101,36,6,5,'2025-04-14 15:39:11','offline','2025-04-14 15:39:11','2025-04-14 15:39:11'),(102,30,5,4,'2025-04-15 09:15:22','offline','2025-04-15 09:15:22','2025-04-15 09:15:22'),(103,37,5,4,'2025-04-15 09:15:34','offline','2025-04-15 09:15:34','2025-04-15 09:15:34'),(104,32,5,4,'2025-04-15 09:15:40','offline','2025-04-15 09:15:40','2025-04-15 09:15:40'),(105,54,5,4,'2025-04-15 09:15:44','offline','2025-04-15 09:15:44','2025-04-15 09:15:44'),(106,34,5,4,'2025-04-15 09:15:58','offline','2025-04-15 09:15:58','2025-04-15 09:15:58'),(107,21,1,2,'2025-04-15 09:16:06','offline','2025-04-15 09:16:06','2025-04-15 09:16:06'),(108,20,1,2,'2025-04-15 09:16:35','offline','2025-04-15 09:16:35','2025-04-15 09:16:35'),(109,19,1,2,'2025-04-15 09:27:03','offline','2025-04-15 09:27:03','2025-04-15 09:27:03'),(110,22,1,2,'2025-04-15 09:27:13','offline','2025-04-15 09:27:13','2025-04-15 09:27:13'),(111,7,1,2,'2025-04-15 09:27:20','offline','2025-04-15 09:27:20','2025-04-15 09:27:20'),(112,63,10,9,'2025-04-15 15:08:38','offline','2025-04-15 15:08:38','2025-04-15 15:08:38'),(113,24,10,9,'2025-04-15 15:08:56','offline','2025-04-15 15:08:56','2025-04-15 15:08:56'),(114,39,10,9,'2025-04-15 15:09:04','offline','2025-04-15 15:09:04','2025-04-15 15:09:04'),(115,42,10,9,'2025-04-15 15:09:13','offline','2025-04-15 15:09:13','2025-04-15 15:09:13'),(116,69,10,9,'2025-04-15 15:09:31','offline','2025-04-15 15:09:31','2025-04-15 15:09:31'),(117,26,10,9,'2025-04-15 15:09:33','offline','2025-04-15 15:09:33','2025-04-15 15:09:33'),(118,53,2,6,'2025-04-15 16:25:51','offline','2025-04-15 16:25:51','2025-04-15 16:25:51'),(119,34,2,6,'2025-04-15 16:25:54','offline','2025-04-15 16:25:54','2025-04-15 16:25:54'),(120,17,2,6,'2025-04-15 16:25:55','offline','2025-04-15 16:25:55','2025-04-15 16:25:55'),(121,48,2,6,'2025-04-15 16:25:57','offline','2025-04-15 16:25:57','2025-04-15 16:25:57'),(122,45,2,6,'2025-04-15 16:25:58','offline','2025-04-15 16:25:58','2025-04-15 16:25:58'),(123,41,2,6,'2025-04-15 16:26:00','offline','2025-04-15 16:26:00','2025-04-15 16:26:00'),(124,47,2,6,'2025-04-15 16:26:49','offline','2025-04-15 16:26:49','2025-04-15 16:26:49'),(125,67,8,8,'2025-04-16 07:56:23','offline','2025-04-16 07:56:23','2025-04-16 07:56:23'),(126,65,8,8,'2025-04-16 07:58:11','offline','2025-04-16 07:58:11','2025-04-16 07:58:11'),(127,54,5,4,'2025-04-16 09:20:23','offline','2025-04-16 09:20:23','2025-04-16 09:20:23'),(128,30,5,4,'2025-04-16 09:20:28','offline','2025-04-16 09:20:28','2025-04-16 09:20:28'),(129,31,5,4,'2025-04-16 09:20:38','offline','2025-04-16 09:20:38','2025-04-16 09:20:38'),(130,20,1,2,'2025-04-16 09:20:43','offline','2025-04-16 09:20:43','2025-04-16 09:20:43'),(131,32,5,4,'2025-04-16 09:20:54','offline','2025-04-16 09:20:54','2025-04-16 09:20:54'),(132,34,5,4,'2025-04-16 09:21:12','offline','2025-04-16 09:21:12','2025-04-16 09:21:12'),(133,21,1,2,'2025-04-16 09:22:28','offline','2025-04-16 09:22:28','2025-04-16 09:22:28'),(134,19,1,2,'2025-04-16 09:23:22','offline','2025-04-16 09:23:22','2025-04-16 09:23:22'),(135,22,1,2,'2025-04-16 09:24:08','offline','2025-04-16 09:24:08','2025-04-16 09:24:08'),(136,17,1,2,'2025-04-16 09:24:23','offline','2025-04-16 09:24:23','2025-04-16 09:24:23'),(137,7,1,2,'2025-04-16 09:24:25','offline','2025-04-16 09:24:25','2025-04-16 09:24:25'),(138,42,10,9,'2025-04-16 15:05:27','offline','2025-04-16 15:05:27','2025-04-16 15:05:27'),(139,24,10,9,'2025-04-16 15:05:31','offline','2025-04-16 15:05:31','2025-04-16 15:05:31'),(140,63,10,9,'2025-04-16 15:05:45','offline','2025-04-16 15:05:45','2025-04-16 15:05:45'),(141,39,10,9,'2025-04-16 15:05:56','offline','2025-04-16 15:05:56','2025-04-16 15:05:56'),(142,69,10,9,'2025-04-16 15:06:11','offline','2025-04-16 15:06:11','2025-04-16 15:06:11'),(143,26,10,9,'2025-04-16 15:06:14','offline','2025-04-16 15:06:14','2025-04-16 15:06:14'),(144,43,6,5,'2025-04-16 15:32:37','offline','2025-04-16 15:32:37','2025-04-16 15:32:37'),(145,38,6,5,'2025-04-16 15:32:39','offline','2025-04-16 15:32:39','2025-04-16 15:32:39'),(146,49,6,5,'2025-04-16 15:32:41','offline','2025-04-16 15:32:41','2025-04-16 15:32:41'),(147,36,6,5,'2025-04-16 15:32:43','offline','2025-04-16 15:32:43','2025-04-16 15:32:43'),(148,63,10,9,'2025-04-17 15:13:11','offline','2025-04-17 15:13:11','2025-04-17 15:13:11'),(149,26,10,9,'2025-04-17 15:13:15','offline','2025-04-17 15:13:15','2025-04-17 15:13:15'),(150,42,10,9,'2025-04-17 15:13:17','offline','2025-04-17 15:13:17','2025-04-17 15:13:17'),(151,69,10,9,'2025-04-17 15:13:20','offline','2025-04-17 15:13:20','2025-04-17 15:13:20'),(152,24,10,9,'2025-04-17 15:13:23','offline','2025-04-17 15:13:23','2025-04-17 15:13:23'),(153,36,6,5,'2025-04-17 15:26:23','offline','2025-04-17 15:26:23','2025-04-17 15:26:23'),(154,43,6,5,'2025-04-17 15:26:25','offline','2025-04-17 15:26:25','2025-04-17 15:26:25'),(155,38,6,5,'2025-04-17 15:26:26','offline','2025-04-17 15:26:26','2025-04-17 15:26:26'),(156,49,6,5,'2025-04-17 15:26:29','offline','2025-04-17 15:26:29','2025-04-17 15:26:29'),(157,32,5,4,'2025-04-18 09:24:11','offline','2025-04-18 09:24:11','2025-04-18 09:24:11'),(158,34,5,4,'2025-04-18 09:24:13','offline','2025-04-18 09:24:13','2025-04-18 09:24:13'),(159,31,5,4,'2025-04-18 09:24:18','offline','2025-04-18 09:24:18','2025-04-18 09:24:18'),(160,37,5,4,'2025-04-18 09:24:20','offline','2025-04-18 09:24:20','2025-04-18 09:24:20'),(161,67,5,4,'2025-04-18 09:24:22','offline','2025-04-18 09:24:22','2025-04-18 09:24:22'),(162,20,1,2,'2025-04-18 09:25:30','offline','2025-04-18 09:25:30','2025-04-18 09:25:30'),(163,21,1,2,'2025-04-18 09:25:33','offline','2025-04-18 09:25:33','2025-04-18 09:25:33'),(164,17,1,2,'2025-04-18 09:27:31','offline','2025-04-18 09:27:31','2025-04-18 09:27:31'),(165,39,10,9,'2025-04-18 15:16:56','offline','2025-04-18 15:16:56','2025-04-18 15:16:56'),(166,26,10,9,'2025-04-18 15:17:04','offline','2025-04-18 15:17:04','2025-04-18 15:17:04'),(167,42,10,9,'2025-04-18 15:17:07','offline','2025-04-18 15:17:07','2025-04-18 15:17:07'),(168,69,10,9,'2025-04-18 15:17:09','offline','2025-04-18 15:17:09','2025-04-18 15:17:09'),(169,24,10,9,'2025-04-18 15:17:12','offline','2025-04-18 15:17:12','2025-04-18 15:17:12'),(170,63,10,9,'2025-04-18 15:17:13','offline','2025-04-18 15:17:13','2025-04-18 15:17:13'),(171,43,6,5,'2025-04-18 16:00:25','offline','2025-04-18 16:00:25','2025-04-18 16:00:25'),(172,38,6,5,'2025-04-18 16:00:28','offline','2025-04-18 16:00:28','2025-04-18 16:00:28'),(173,49,6,5,'2025-04-18 16:00:35','offline','2025-04-18 16:00:35','2025-04-18 16:00:35'),(174,36,6,5,'2025-04-18 16:00:43','offline','2025-04-18 16:00:43','2025-04-18 16:00:43'),(175,26,2,13,'2025-04-18 17:22:49','offline','2025-04-18 17:22:49','2025-04-18 17:22:49'),(176,17,2,13,'2025-04-18 17:26:18','offline','2025-04-18 17:26:18','2025-04-18 17:26:18'),(177,47,2,13,'2025-04-18 17:27:59','offline','2025-04-18 17:27:59','2025-04-18 17:27:59'),(178,41,2,13,'2025-04-18 17:31:11','offline','2025-04-18 17:31:11','2025-04-18 17:31:11'),(179,46,6,5,'2025-04-18 17:41:09','offline','2025-04-18 17:41:09','2025-04-18 17:41:09'),(180,65,8,8,'2025-04-18 17:57:13','offline','2025-04-18 17:57:13','2025-04-18 17:57:13'),(181,65,8,8,'2025-04-20 08:52:29','offline','2025-04-20 08:52:29','2025-04-20 08:52:29'),(182,67,8,8,'2025-04-21 08:15:04','offline','2025-04-21 08:15:04','2025-04-21 08:15:04'),(183,32,5,4,'2025-04-21 09:11:52','offline','2025-04-21 09:11:52','2025-04-21 09:11:52'),(184,30,5,4,'2025-04-21 09:11:55','offline','2025-04-21 09:11:55','2025-04-21 09:11:55'),(185,34,5,4,'2025-04-21 09:11:57','offline','2025-04-21 09:11:57','2025-04-21 09:11:57'),(186,31,5,4,'2025-04-21 09:11:58','offline','2025-04-21 09:11:58','2025-04-21 09:11:58'),(187,37,5,4,'2025-04-21 09:11:59','offline','2025-04-21 09:11:59','2025-04-21 09:11:59'),(188,54,5,4,'2025-04-21 09:12:01','offline','2025-04-21 09:12:01','2025-04-21 09:12:01'),(189,67,5,4,'2025-04-21 09:12:04','offline','2025-04-21 09:12:04','2025-04-21 09:12:04'),(190,19,1,2,'2025-04-21 09:20:33','offline','2025-04-21 09:20:33','2025-04-21 09:20:33'),(191,21,1,2,'2025-04-21 09:20:38','offline','2025-04-21 09:20:38','2025-04-21 09:20:38'),(192,20,1,2,'2025-04-21 09:20:41','offline','2025-04-21 09:20:41','2025-04-21 09:20:41'),(193,17,1,2,'2025-04-21 09:20:43','offline','2025-04-21 09:20:43','2025-04-21 09:20:43'),(194,22,1,2,'2025-04-21 09:20:47','offline','2025-04-21 09:20:47','2025-04-21 09:20:47'),(195,7,1,2,'2025-04-21 09:20:50','offline','2025-04-21 09:20:50','2025-04-21 09:20:50'),(196,65,8,8,'2025-04-22 07:05:33','offline','2025-04-22 07:05:33','2025-04-22 07:05:33'),(197,32,5,4,'2025-04-22 08:58:57','offline','2025-04-22 08:58:57','2025-04-22 08:58:57'),(198,30,5,4,'2025-04-22 08:59:00','offline','2025-04-22 08:59:00','2025-04-22 08:59:00'),(199,34,5,4,'2025-04-22 08:59:02','offline','2025-04-22 08:59:02','2025-04-22 08:59:02'),(200,37,5,4,'2025-04-22 08:59:05','offline','2025-04-22 08:59:05','2025-04-22 08:59:05'),(201,54,5,4,'2025-04-22 08:59:06','offline','2025-04-22 08:59:06','2025-04-22 08:59:06'),(202,67,5,4,'2025-04-22 08:59:08','offline','2025-04-22 08:59:08','2025-04-22 08:59:08');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `batches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `batch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `batches_course_id_foreign` (`course_id`),
  CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (2,1,'9 am - 06 feb','2025-02-27','2025-04-24','2025-02-04 11:17:06','2025-02-05 15:44:44'),(3,4,'10:00 AM','2025-02-19','2025-04-02','2025-02-17 17:06:27','2025-02-17 17:06:27'),(4,5,'7 AM to 8 AM','2025-02-25','2025-05-06','2025-02-25 02:50:47','2025-02-25 02:50:47'),(5,6,'3:00 PM to 4:00 PM','2025-03-03','2025-05-12','2025-02-28 16:09:46','2025-02-28 16:09:46'),(6,2,'4 PM to 5 PM','2025-03-04','2025-04-15','2025-03-04 04:43:21','2025-03-04 04:43:21'),(8,8,'7 AM to 8 AM','2025-04-03','2025-05-15','2025-04-01 14:06:38','2025-04-01 14:06:38'),(9,10,'2 PM To 3 PM','2025-04-04','2025-05-16','2025-04-04 11:48:49','2025-04-04 11:48:49'),(11,9,'5PM TO 6 PM ','2025-04-09','2025-05-21','2025-04-09 06:42:30','2025-04-09 06:42:30'),(12,12,'9AM TO 10AM','2025-04-15','2025-05-27','2025-04-14 22:43:50','2025-04-14 22:43:50'),(13,2,'4 PM to 5 PM 2nd Batch','2025-04-16','2025-05-28','2025-04-16 13:35:21','2025-04-16 13:35:21');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('22d200f8670dbdb3e253a90eee5098477c95c23d','i:1;',1745247358),('22d200f8670dbdb3e253a90eee5098477c95c23d:timer','i:1745247358;',1745247358),('2a459380709e2fe4ac2dae5733c73225ff6cfee1','i:1;',1745164864),('2a459380709e2fe4ac2dae5733c73225ff6cfee1:timer','i:1745164864;',1745164864),('2e01e17467891f7c933dbaa00e1459d23db3fe4f','i:1;',1744612658),('2e01e17467891f7c933dbaa00e1459d23db3fe4f:timer','i:1744612658;',1744612658),('472b07b9fcf2c2451e8781e944bf5f77cd8457c8','i:1;',1745161237),('472b07b9fcf2c2451e8781e944bf5f77cd8457c8:timer','i:1745161237;',1745161237),('4d134bc072212ace2df385dae143139da74ec0ef','i:1;',1744694750),('4d134bc072212ace2df385dae143139da74ec0ef:timer','i:1744694750;',1744694750),('4d89d294cd4ca9f2ca57dc24a53ffb3ef5303122','i:1;',1745203810),('4d89d294cd4ca9f2ca57dc24a53ffb3ef5303122:timer','i:1745203810;',1745203810),('64e095fe763fc62418378753f9402623bea9e227','i:1;',1744196409),('64e095fe763fc62418378753f9402623bea9e227:timer','i:1744196409;',1744196409),('7b52009b64fd0a2a49e6d8a939753077792b0554','i:1;',1744650950),('7b52009b64fd0a2a49e6d8a939753077792b0554:timer','i:1744650950;',1744650950),('80e28a51cbc26fa4bd34938c5e593b36146f5e0c','i:1;',1745254919),('80e28a51cbc26fa4bd34938c5e593b36146f5e0c:timer','i:1745254919;',1745254919),('887309d048beef83ad3eabf2a79a64a389ab1c9f','i:1;',1744619036),('887309d048beef83ad3eabf2a79a64a389ab1c9f:timer','i:1744619036;',1744619036),('902ba3cda1883801594b6e1b452790cc53948fda','i:1;',1744553092),('902ba3cda1883801594b6e1b452790cc53948fda:timer','i:1744553092;',1744553092),('91032ad7bbcb6cf72875e8e8207dcfba80173f7c','i:1;',1745164069),('91032ad7bbcb6cf72875e8e8207dcfba80173f7c:timer','i:1745164069;',1745164069),('9109c85a45b703f87f1413a405549a2cea9ab556','i:1;',1744391229),('9109c85a45b703f87f1413a405549a2cea9ab556:timer','i:1744391229;',1744391229),('92cfceb39d57d914ed8b14d0e37643de0797ae56','i:1;',1744608576),('92cfceb39d57d914ed8b14d0e37643de0797ae56:timer','i:1744608576;',1744608576),('a17554a0d2b15a664c0e73900184544f19e70227','i:1;',1744697665),('a17554a0d2b15a664c0e73900184544f19e70227:timer','i:1744697665;',1744697665),('a72b20062ec2c47ab2ceb97ac1bee818f8b6c6cb','i:1;',1744696155),('a72b20062ec2c47ab2ceb97ac1bee818f8b6c6cb:timer','i:1744696155;',1744696155),('all_products','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:19:\"App\\Models\\Products\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:1;s:19:\"product_category_id\";i:1;s:4:\"name\";s:66:\"Premium \"Learn Syntax\" Round Neck T-Shirt – Redeemable with Gems\";s:11:\"description\";s:942:\"Level up your coding style with our Premium \"Learn Syntax\" Branded T-Shirt – a perfect blend of comfort, class, and community. Designed for true learners and tech enthusiasts, this high-quality round neck tee proudly sports the Learn Syntax logo, making it more than just apparel – it’s a statement.\n\nCrafted from 100% premium cotton, this t-shirt offers a soft-touch feel, durable stitching, and a tailored fit for all-day comfort. Whether you’re attending a coding session, hanging out with fellow developers, or just chilling at home, this shirt keeps you in the zone.\n\nFeatures:\n\nHigh-quality fabric with breathable comfort\n\nClassic round neck design\n\nDurable print of the Learn Syntax logo\n\nUnisex fit, ideal for everyday wear\n\nAvailable in multiple sizes\n\nRedeemable using your gems – because learning should reward you in style!\n\nNote: Limited edition for our Learn Syntax community. Redeem now and wear your code with pride!\";s:6:\"points\";i:2499;s:8:\"imageUrl\";s:53:\"products/YWDefN2BFdzkFx8pBIwXfmiTBKwboU5VGkcNJRFU.jpg\";s:17:\"availableQuantity\";i:10;s:6:\"status\";s:6:\"active\";s:4:\"slug\";s:60:\"premium-learn-syntax-round-neck-t-shirt-redeemable-with-gems\";s:10:\"created_at\";s:19:\"2025-04-06 09:28:15\";s:10:\"updated_at\";s:19:\"2025-04-06 09:28:18\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:1;s:19:\"product_category_id\";i:1;s:4:\"name\";s:66:\"Premium \"Learn Syntax\" Round Neck T-Shirt – Redeemable with Gems\";s:11:\"description\";s:942:\"Level up your coding style with our Premium \"Learn Syntax\" Branded T-Shirt – a perfect blend of comfort, class, and community. Designed for true learners and tech enthusiasts, this high-quality round neck tee proudly sports the Learn Syntax logo, making it more than just apparel – it’s a statement.\n\nCrafted from 100% premium cotton, this t-shirt offers a soft-touch feel, durable stitching, and a tailored fit for all-day comfort. Whether you’re attending a coding session, hanging out with fellow developers, or just chilling at home, this shirt keeps you in the zone.\n\nFeatures:\n\nHigh-quality fabric with breathable comfort\n\nClassic round neck design\n\nDurable print of the Learn Syntax logo\n\nUnisex fit, ideal for everyday wear\n\nAvailable in multiple sizes\n\nRedeemable using your gems – because learning should reward you in style!\n\nNote: Limited edition for our Learn Syntax community. Redeem now and wear your code with pride!\";s:6:\"points\";i:2499;s:8:\"imageUrl\";s:53:\"products/YWDefN2BFdzkFx8pBIwXfmiTBKwboU5VGkcNJRFU.jpg\";s:17:\"availableQuantity\";i:10;s:6:\"status\";s:6:\"active\";s:4:\"slug\";s:60:\"premium-learn-syntax-round-neck-t-shirt-redeemable-with-gems\";s:10:\"created_at\";s:19:\"2025-04-06 09:28:15\";s:10:\"updated_at\";s:19:\"2025-04-06 09:28:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:6:\"points\";i:3;s:8:\"imageUrl\";i:4;s:17:\"availableQuantity\";i:5;s:4:\"slug\";i:6;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1745159113),('b3f0c7f6bb763af1be91d9e74eabfeb199dc1f1f','i:1;',1744740002),('b3f0c7f6bb763af1be91d9e74eabfeb199dc1f1f:timer','i:1744740002;',1744740002),('bd307a3ec329e10a2cff8fb87480823da114f8f4','i:1;',1744162892),('bd307a3ec329e10a2cff8fb87480823da114f8f4:timer','i:1744162892;',1744162892),('ca3512f4dfa95a03169c5a670a4c91a19b3077b4','i:1;',1744557195),('ca3512f4dfa95a03169c5a670a4c91a19b3077b4:timer','i:1744557195;',1744557195),('cb4e5208b4cd87268b208e49452ed6e89a68e0b8','i:1;',1745246310),('cb4e5208b4cd87268b208e49452ed6e89a68e0b8:timer','i:1745246310;',1745246310),('cb7a1d775e800fd1ee4049f7dca9e041eb9ba083','i:1;',1744945554),('cb7a1d775e800fd1ee4049f7dca9e041eb9ba083:timer','i:1744945554;',1744945554),('f1f836cb4ea6efb2a0b1b99f41ad8b103eff4b59','i:1;',1745246944),('f1f836cb4ea6efb2a0b1b99f41ad8b103eff4b59:timer','i:1745246944;',1745246944),('fc074d501302eb2b93e2554793fcaf50b3bf7291','i:1;',1744773469),('fc074d501302eb2b93e2554793fcaf50b3bf7291:timer','i:1744773469;',1744773469),('placed_students_active_homepage','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:18;s:4:\"name\";s:12:\"Suraj Bhagat\";s:7:\"content\";s:243:\"Suraj Bhagat is a Python Django Developer at Great Future Technology Pvt. Ltd. with expertise in Django, REST APIs, and databases. He has experience in both back-end and front-end development, including JWT authentication and payment gateways.\";s:5:\"image\";s:59:\"placedstudent/QAvIWMH0f5Q2AvlzAOKcgzTVHSQtiIofDHJPXgY8.webp\";s:8:\"position\";s:59:\"Python Django Developer @ Great Future Technology Pvt. Ltd.\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:06:49\";s:10:\"updated_at\";s:19:\"2025-02-04 06:08:18\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:18;s:4:\"name\";s:12:\"Suraj Bhagat\";s:7:\"content\";s:243:\"Suraj Bhagat is a Python Django Developer at Great Future Technology Pvt. Ltd. with expertise in Django, REST APIs, and databases. He has experience in both back-end and front-end development, including JWT authentication and payment gateways.\";s:5:\"image\";s:59:\"placedstudent/QAvIWMH0f5Q2AvlzAOKcgzTVHSQtiIofDHJPXgY8.webp\";s:8:\"position\";s:59:\"Python Django Developer @ Great Future Technology Pvt. Ltd.\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:06:49\";s:10:\"updated_at\";s:19:\"2025-02-04 06:08:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:1;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:44;s:4:\"name\";s:12:\"Priyanka Das\";s:7:\"content\";s:277:\"Priyanka Das, Associate Software Engineer at Mphasis, is a skilled Full-Stack Developer with 2+ years of experience in Java, Spring Boot, React.js, AngularJS, and SQL. With 550+ problems solved on GFG and LeetCode, she holds an MCA and specializes in scalable web applications.\";s:5:\"image\";s:59:\"placedstudent/ZcJP6NWVyErhKS2hSiNyl43OMIrFDeobh47sXZQA.webp\";s:8:\"position\";s:37:\"Associate Software Engineer @ Mphasis\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 15:06:15\";s:10:\"updated_at\";s:19:\"2025-02-04 15:16:46\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:44;s:4:\"name\";s:12:\"Priyanka Das\";s:7:\"content\";s:277:\"Priyanka Das, Associate Software Engineer at Mphasis, is a skilled Full-Stack Developer with 2+ years of experience in Java, Spring Boot, React.js, AngularJS, and SQL. With 550+ problems solved on GFG and LeetCode, she holds an MCA and specializes in scalable web applications.\";s:5:\"image\";s:59:\"placedstudent/ZcJP6NWVyErhKS2hSiNyl43OMIrFDeobh47sXZQA.webp\";s:8:\"position\";s:37:\"Associate Software Engineer @ Mphasis\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 15:06:15\";s:10:\"updated_at\";s:19:\"2025-02-04 15:16:46\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:2;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:8;s:4:\"name\";s:10:\"Pratik Sah\";s:7:\"content\";s:417:\"Pratik Sah is currently working as a Senior Software Engineer - Product at Razorpay in Bengaluru, Karnataka, India, since January 2024. His previous roles include Senior Software Engineer at Altysys, Solutions Engineer at Deqode India, and Node.js Developer at Codebucket Solutions. He has expertise in backend development, with skills in Next.js, Amazon ECS, RabbitMQ, Socket.io, Cloud Firestore, and several others.\";s:5:\"image\";s:59:\"placedstudent/R7GkgDfZNBImSEjV8MyjJ6vIVR6whm4ZHItaVO19.webp\";s:8:\"position\";s:34:\"Senior Software Engineer @Razorpay\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 05:51:44\";s:10:\"updated_at\";s:19:\"2025-02-04 05:51:50\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:8;s:4:\"name\";s:10:\"Pratik Sah\";s:7:\"content\";s:417:\"Pratik Sah is currently working as a Senior Software Engineer - Product at Razorpay in Bengaluru, Karnataka, India, since January 2024. His previous roles include Senior Software Engineer at Altysys, Solutions Engineer at Deqode India, and Node.js Developer at Codebucket Solutions. He has expertise in backend development, with skills in Next.js, Amazon ECS, RabbitMQ, Socket.io, Cloud Firestore, and several others.\";s:5:\"image\";s:59:\"placedstudent/R7GkgDfZNBImSEjV8MyjJ6vIVR6whm4ZHItaVO19.webp\";s:8:\"position\";s:34:\"Senior Software Engineer @Razorpay\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 05:51:44\";s:10:\"updated_at\";s:19:\"2025-02-04 05:51:50\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:3;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:30;s:4:\"name\";s:15:\"Kartik Swarnkar\";s:7:\"content\";s:390:\"Kartik Swarnkar, a Senior Software Engineer with expertise in Node.js, React, Python, AWS, Typescript, Harness, Docker, and more. His recent experiences include working at Ascendion and Collabera Digital, where he developed infrastructure automation solutions, integrated cloud services like AWS, and worked on various projects ranging from cryptocurrency exchanges to e-commerce platforms.\";s:5:\"image\";s:59:\"placedstudent/oCQfw5o04CP17T1EEkMU7CmuJUCYVqqyXlZwtdNh.webp\";s:8:\"position\";s:36:\"Senior Software Engineer @ Ascendion\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:36:31\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:43\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:30;s:4:\"name\";s:15:\"Kartik Swarnkar\";s:7:\"content\";s:390:\"Kartik Swarnkar, a Senior Software Engineer with expertise in Node.js, React, Python, AWS, Typescript, Harness, Docker, and more. His recent experiences include working at Ascendion and Collabera Digital, where he developed infrastructure automation solutions, integrated cloud services like AWS, and worked on various projects ranging from cryptocurrency exchanges to e-commerce platforms.\";s:5:\"image\";s:59:\"placedstudent/oCQfw5o04CP17T1EEkMU7CmuJUCYVqqyXlZwtdNh.webp\";s:8:\"position\";s:36:\"Senior Software Engineer @ Ascendion\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:36:31\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:43\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:4;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:28;s:4:\"name\";s:10:\"Ajit Kumar\";s:7:\"content\";s:220:\"Ajit Kumar is a PHP & Laravel Developer at AKS WebSoft Consulting Pvt. Ltd. He has previously worked at Bridge2Business, Dousoft IT Solution, and GameApp Tech. His skills include HTML, AJAX, API Development, and Laravel.\";s:5:\"image\";s:59:\"placedstudent/592BJeGoqFoguoTqDyKC9WwhB90lQmiRMyb4EsSc.webp\";s:8:\"position\";s:51:\"Laravel Developer @ AKS WebSoft Consulting Pvt. Ltd\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:31:53\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:51\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:28;s:4:\"name\";s:10:\"Ajit Kumar\";s:7:\"content\";s:220:\"Ajit Kumar is a PHP & Laravel Developer at AKS WebSoft Consulting Pvt. Ltd. He has previously worked at Bridge2Business, Dousoft IT Solution, and GameApp Tech. His skills include HTML, AJAX, API Development, and Laravel.\";s:5:\"image\";s:59:\"placedstudent/592BJeGoqFoguoTqDyKC9WwhB90lQmiRMyb4EsSc.webp\";s:8:\"position\";s:51:\"Laravel Developer @ AKS WebSoft Consulting Pvt. Ltd\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:31:53\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:51\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:5;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:6;s:4:\"name\";s:13:\"Shubham Kumar\";s:7:\"content\";s:238:\"Shubham Kumar is a Senior System Engineer at Infosys and a Data Engineer for HSBC. He specializes in Data Pipelines, SQL, PySpark, Hadoop, Hive, Git, ETL, and has expertise in Big Data Development, Data Warehousing, and Agile Methodology.\";s:5:\"image\";s:59:\"placedstudent/C3Az4ZnWbzQAxnokOZdjAGpTB0PFOtsCXwSkOaX5.webp\";s:8:\"position\";s:22:\"Senior System Engineer\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 05:48:06\";s:10:\"updated_at\";s:19:\"2025-02-04 05:48:09\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:6;s:4:\"name\";s:13:\"Shubham Kumar\";s:7:\"content\";s:238:\"Shubham Kumar is a Senior System Engineer at Infosys and a Data Engineer for HSBC. He specializes in Data Pipelines, SQL, PySpark, Hadoop, Hive, Git, ETL, and has expertise in Big Data Development, Data Warehousing, and Agile Methodology.\";s:5:\"image\";s:59:\"placedstudent/C3Az4ZnWbzQAxnokOZdjAGpTB0PFOtsCXwSkOaX5.webp\";s:8:\"position\";s:22:\"Senior System Engineer\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 05:48:06\";s:10:\"updated_at\";s:19:\"2025-02-04 05:48:09\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1745298906),('top_scorers_2025-02-17','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1744351804),('top_scorers_2025-03-10','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1744351805),('top_scorers_2025-03-17','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1744308996),('top_scorers_2025-03-24','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1744571647),('top_scorers_2025-03-31','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;a:7:{s:2:\"id\";i:67;s:4:\"name\";s:18:\"Prithvi Raj Sahani\";s:5:\"image\";s:97:\"https://lh3.googleusercontent.com/a/ACg8ocIYdfbIi5nvdvUh219ygorX77DIqrMnm8julR613pRXxvxIDW0=s96-c\";s:6:\"gender\";N;s:4:\"gems\";s:3:\"150\";s:12:\"displayImage\";s:97:\"https://lh3.googleusercontent.com/a/ACg8ocIYdfbIi5nvdvUh219ygorX77DIqrMnm8julR613pRXxvxIDW0=s96-c\";s:5:\"trend\";s:3:\"new\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1745162329),('top_scorers_2025-04-07','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:10:{i:0;a:7:{s:2:\"id\";i:39;s:4:\"name\";s:13:\"Rishav Ranjan\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"399\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:1;a:7:{s:2:\"id\";i:32;s:4:\"name\";s:14:\"Abhishek Kumar\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"329\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:2;a:7:{s:2:\"id\";i:7;s:4:\"name\";s:13:\"Smriti Keshri\";s:5:\"image\";N;s:6:\"gender\";s:6:\"female\";s:4:\"gems\";s:3:\"220\";s:12:\"displayImage\";s:98:\"https://www.vhv.rs/dpng/d/426-4264903_user-avatar-png-picture-avatar-profile-dummy-transparent.png\";s:5:\"trend\";s:3:\"new\";}i:3;a:7:{s:2:\"id\";i:34;s:4:\"name\";s:9:\"Jay Yadav\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"220\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:4;a:7:{s:2:\"id\";i:48;s:4:\"name\";s:10:\"Rishav Raj\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"220\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:5;a:7:{s:2:\"id\";i:54;s:4:\"name\";s:6:\"Muskan\";s:5:\"image\";N;s:6:\"gender\";s:6:\"female\";s:4:\"gems\";s:3:\"220\";s:12:\"displayImage\";s:98:\"https://www.vhv.rs/dpng/d/426-4264903_user-avatar-png-picture-avatar-profile-dummy-transparent.png\";s:5:\"trend\";s:3:\"new\";}i:6;a:7:{s:2:\"id\";i:36;s:4:\"name\";s:14:\"Shalini Kumari\";s:5:\"image\";N;s:6:\"gender\";s:6:\"female\";s:4:\"gems\";s:3:\"199\";s:12:\"displayImage\";s:98:\"https://www.vhv.rs/dpng/d/426-4264903_user-avatar-png-picture-avatar-profile-dummy-transparent.png\";s:5:\"trend\";s:3:\"new\";}i:7;a:7:{s:2:\"id\";i:38;s:4:\"name\";s:5:\"Anand\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"199\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:8;a:7:{s:2:\"id\";i:43;s:4:\"name\";s:11:\"Deepika sen\";s:5:\"image\";N;s:6:\"gender\";s:6:\"female\";s:4:\"gems\";s:3:\"199\";s:12:\"displayImage\";s:98:\"https://www.vhv.rs/dpng/d/426-4264903_user-avatar-png-picture-avatar-profile-dummy-transparent.png\";s:5:\"trend\";s:3:\"new\";}i:9;a:7:{s:2:\"id\";i:65;s:4:\"name\";s:19:\"Rãçhitā Kùmãri\";s:5:\"image\";s:98:\"https://lh3.googleusercontent.com/a/ACg8ocLUFOrJ5iG-HtKAzo55o0Ty7OBt03O081mMfdtIRpeOwvdXJX8j=s96-c\";s:6:\"gender\";N;s:4:\"gems\";s:3:\"150\";s:12:\"displayImage\";s:98:\"https://lh3.googleusercontent.com/a/ACg8ocLUFOrJ5iG-HtKAzo55o0Ty7OBt03O081mMfdtIRpeOwvdXJX8j=s96-c\";s:5:\"trend\";s:3:\"new\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1745162304),('top_scorers_2025-04-14','O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:10:{i:0;a:7:{s:2:\"id\";i:30;s:4:\"name\";s:3:\"Ria\";s:5:\"image\";N;s:6:\"gender\";s:6:\"female\";s:4:\"gems\";s:3:\"440\";s:12:\"displayImage\";s:98:\"https://www.vhv.rs/dpng/d/426-4264903_user-avatar-png-picture-avatar-profile-dummy-transparent.png\";s:5:\"trend\";s:3:\"new\";}i:1;a:7:{s:2:\"id\";i:26;s:4:\"name\";s:9:\"Ankur Jha\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"399\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:2;a:7:{s:2:\"id\";i:20;s:4:\"name\";s:16:\"Chaman Kumar Das\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"379\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:3;a:7:{s:2:\"id\";i:13;s:4:\"name\";s:15:\"sadique hussain\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"373\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:4;a:7:{s:2:\"id\";i:49;s:4:\"name\";s:6:\"Rishav\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"309\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:5;a:7:{s:2:\"id\";i:69;s:4:\"name\";s:15:\"sudhanshu aryan\";s:5:\"image\";s:97:\"https://lh3.googleusercontent.com/a/ACg8ocLnq8Q5vyaAVWHn2RDXsPO0BWECLDRirlf2o0GZ7SJ6UddnXZE=s96-c\";s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"179\";s:12:\"displayImage\";s:97:\"https://lh3.googleusercontent.com/a/ACg8ocLnq8Q5vyaAVWHn2RDXsPO0BWECLDRirlf2o0GZ7SJ6UddnXZE=s96-c\";s:5:\"trend\";s:3:\"new\";}i:6;a:7:{s:2:\"id\";i:24;s:4:\"name\";s:11:\"Aman Kumar \";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"179\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:7;a:7:{s:2:\"id\";i:63;s:4:\"name\";s:13:\"vikash Aryan \";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"179\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:8;a:7:{s:2:\"id\";i:17;s:4:\"name\";s:22:\"Priyanshu Bhattacharya\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"110\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}i:9;a:7:{s:2:\"id\";i:21;s:4:\"name\";s:12:\"shivam kumar\";s:5:\"image\";N;s:6:\"gender\";s:4:\"male\";s:4:\"gems\";s:3:\"110\";s:12:\"displayImage\";s:90:\"https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain\";s:5:\"trend\";s:3:\"new\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1745245776);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_cat_slug_unique` (`cat_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Programming','Programming language','programming','2025-02-02 18:56:07','2025-04-01 13:15:43'),(2,'Python','Python','python','2025-02-02 19:33:18','2025-02-02 19:33:18'),(3,'OOPS Programming','Testing','oops-programming','2025-02-17 17:07:04','2025-02-17 17:07:04'),(4,'Web Development','safdsa','web-development','2025-02-25 02:49:21','2025-02-25 02:49:21');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `certificate_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overall_percentage` decimal(5,2) NOT NULL,
  `admin_approve` tinyint(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `certificates_certificate_no_unique` (`certificate_no`),
  KEY `certificates_user_id_foreign` (`user_id`),
  KEY `certificates_course_id_foreign` (`course_id`),
  CONSTRAINT `certificates_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_feature`
--

DROP TABLE IF EXISTS `course_feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_feature` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `feature_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_feature_course_id_foreign` (`course_id`),
  KEY `course_feature_feature_id_foreign` (`feature_id`),
  CONSTRAINT `course_feature_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_feature_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_feature`
--

LOCK TABLES `course_feature` WRITE;
/*!40000 ALTER TABLE `course_feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_reviews`
--

DROP TABLE IF EXISTS `course_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_reviews`
--

LOCK TABLES `course_reviews` WRITE;
/*!40000 ALTER TABLE `course_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_student`
--

DROP TABLE IF EXISTS `course_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_student` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `is_subs` tinyint(1) NOT NULL DEFAULT '0',
  `batch_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `batch_updated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `course_student_course_id_foreign` (`course_id`),
  KEY `course_student_user_id_foreign` (`user_id`),
  KEY `course_student_batch_id_foreign` (`batch_id`),
  CONSTRAINT `course_student_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_student`
--

LOCK TABLES `course_student` WRITE;
/*!40000 ALTER TABLE `course_student` DISABLE KEYS */;
INSERT INTO `course_student` VALUES (4,1,19,0,2,'2025-02-11 03:31:46','2025-02-11 03:32:16',0),(5,1,21,0,2,'2025-02-17 06:14:00','2025-02-17 06:14:31',0),(8,1,7,0,2,'2025-02-18 09:04:26','2025-02-18 09:04:50',0),(9,1,20,0,2,'2025-02-19 04:41:18','2025-03-25 04:59:15',0),(10,1,16,0,2,'2025-02-19 05:42:46','2025-02-19 05:43:01',0),(11,1,17,0,2,'2025-02-21 06:10:42','2025-02-21 06:11:35',0),(12,5,32,0,4,'2025-02-24 02:52:33','2025-02-25 02:55:50',0),(13,4,35,0,3,'2025-02-25 13:59:10','2025-04-01 15:19:36',1),(14,5,30,0,4,'2025-02-25 16:49:14','2025-03-26 02:41:03',0),(15,4,33,0,3,'2025-02-27 10:23:34','2025-02-28 05:48:38',0),(16,5,34,0,4,'2025-02-28 01:50:34','2025-02-28 01:51:02',0),(17,5,31,0,4,'2025-02-28 03:09:55','2025-03-05 02:45:32',0),(18,4,32,0,3,'2025-02-28 04:53:50','2025-02-28 05:47:40',0),(19,1,22,0,2,'2025-02-28 19:33:26','2025-02-28 19:34:32',0),(20,2,40,0,6,'2025-03-04 04:43:05','2025-03-04 04:43:48',0),(21,4,36,0,3,'2025-03-04 05:48:06','2025-03-04 05:48:16',0),(22,5,37,0,4,'2025-03-05 01:45:20','2025-03-05 14:28:36',0),(23,5,44,0,4,'2025-03-06 02:11:07','2025-03-26 02:53:02',0),(24,4,27,0,3,'2025-03-06 04:31:44','2025-03-06 04:33:17',0),(25,2,41,0,13,'2025-03-07 10:32:37','2025-04-18 17:30:50',0),(26,2,45,0,6,'2025-03-07 10:32:56','2025-03-07 10:34:13',0),(27,2,48,0,6,'2025-03-07 17:00:29','2025-03-07 17:01:00',0),(28,2,17,0,13,'2025-03-10 03:55:55','2025-04-18 17:26:02',0),(29,2,47,0,13,'2025-03-11 10:50:29','2025-04-18 17:27:43',0),(30,6,43,0,5,'2025-03-11 11:55:47','2025-04-08 15:31:00',0),(31,5,54,0,4,'2025-03-17 02:36:43','2025-03-17 02:36:52',0),(32,2,34,0,6,'2025-03-18 03:57:58','2025-03-18 03:58:16',0),(36,2,53,0,6,NULL,'2025-03-25 12:58:31',0),(37,6,38,0,5,NULL,'2025-04-03 05:54:15',0),(38,2,13,0,6,NULL,'2025-04-03 23:20:43',0),(39,6,49,0,5,NULL,'2025-04-04 15:25:37',0),(40,5,67,0,4,NULL,'2025-04-06 09:14:24',0),(41,2,37,0,6,NULL,'2025-04-08 08:19:19',0),(42,6,36,0,5,NULL,'2025-04-08 11:14:13',0),(43,10,39,0,9,NULL,'2025-04-08 15:50:56',0),(44,5,64,0,4,NULL,'2025-04-08 18:15:00',0),(45,8,65,0,8,'2025-04-10 13:56:19','2025-04-10 13:56:19',0),(46,10,26,0,9,NULL,'2025-04-14 13:54:54',1),(47,8,67,0,NULL,'2025-04-12 07:45:24','2025-04-12 07:45:24',0),(48,10,42,0,9,'2025-04-14 09:01:41','2025-04-14 09:17:25',0),(49,10,69,0,9,NULL,'2025-04-14 15:36:44',0),(50,10,24,0,9,NULL,'2025-04-14 15:37:18',0),(51,10,63,0,9,NULL,'2025-04-14 15:38:12',0),(52,2,76,0,13,NULL,'2025-04-18 17:29:33',0),(53,2,26,0,13,NULL,'2025-04-16 15:13:36',0),(54,1,77,0,2,NULL,'2025-04-16 23:53:32',0),(55,6,46,0,5,NULL,'2025-04-18 17:40:56',0),(56,10,51,0,9,NULL,'2025-04-21 15:19:07',0),(57,6,78,0,5,'2025-04-21 19:37:46','2025-04-21 19:37:46',0);
/*!40000 ALTER TABLE `course_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration` double NOT NULL DEFAULT '0',
  `instructor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fees` double DEFAULT NULL,
  `discounted_fees` double DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `course_type` enum('online','offline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `meeting_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_slug_unique` (`slug`),
  KEY `courses_category_id_foreign` (`category_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Python','python-basic-testing','Python','Kickstart your programming journey with Python! This course includes:\r\n✅ Python basics: Variables, loops, and functions\r\n✅ Object-oriented programming and file handling\r\n✅ Web development with Flask/Django\r\n✅ Data analysis and visualization with Pandas & Matplotlib\r\n✅ Automation and scripting\r\nIdeal for beginners and those looking to explore AI and data science!',8,'Sadique Hussain',2500,1500,2,'course_images/iTPdxkOjyqZBg4YG45EbUZFx7bvDMkvZlXnrtB6v.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-02 16:48:16','2025-03-25 09:26:44'),(2,'C Programming language','c-programming-language','CLANG001','Master the fundamentals of C programming with our comprehensive course! Whether you\'re a beginner or looking to strengthen your programming skills, this course will guide you through the core concepts of C, including:\r\n\r\n✅ Introduction to C – Understanding syntax, variables, and data types\r\n✅ Control Structures – Mastering loops, conditionals, and functions\r\n✅ Arrays & Pointers – Efficient data storage and memory management\r\n✅ Structures & File Handling – Organizing complex data and working with files\r\n✅ Memory Management – Dynamic allocation using malloc() and free()\r\n✅ Advanced Concepts – Recursion, bitwise operations, and multi-file programming\r\n\r\nBy the end of this course, you\'ll be able to write efficient C programs, understand memory management, and build real-world applications.',6,'Sadique Hussain',2000,1100,1,'course_images/kfsiiJYoHfT5obZ8jd19GraiKyfViiAzyeAD7jL8.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-02 18:50:32','2025-03-25 09:25:47'),(4,'C++ with object oriented programming for BCA, Btech','c-with-object-oriented-programming-for-bca-btech','CPP','Master C++ with a strong focus on Object-Oriented Programming (OOP) principles. This course is designed for BCA and B.Tech students, covering fundamental and advanced concepts like classes, objects, inheritance, polymorphism, encapsulation, and abstraction. Gain hands-on experience with real-world applications, data structures, and problem-solving techniques. Perfect for students aiming to build a strong foundation in C++ programming and software development.',6,'Syed Sadique Hussain',2500,1099,3,'course_images/BuUxK8DAH4GYIU72dGrqy5KKgRxxQdIBzdTph0lm.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-17 17:02:53','2025-03-25 09:25:07'),(5,'HTML5 & CSS3 with Tailwindcss4','html5-css3-with-tailwindcss4','WEB001','html css and tailwindcss 4',10,'syed sadique hussain',2500,1500,4,'course_images/BdmGj00wC51oeTpi5NJoPeoVl8vYFrFp0yMdE3PQ.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-24 02:22:26','2025-03-25 09:24:04'),(6,'Learn PHP from Scratch & Build Dynamic Websites','learn-php-from-scratch-build-dynamic-websites','PHP001','Are you ready to become a professional web developer? Our PHP batch is designed to take you from beginner to expert in web development. Learn how to build dynamic websites, work with databases, and create powerful web applications using PHP.',10,'Syed Sadique Hussain',3999,1999,4,'course_images/gIIu7semxtSmqcrRFou4Fb7to35sfCmnGscXdlys.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-28 16:06:43','2025-03-25 09:22:38'),(8,'C Programming Online Live class','c-programming-online-live-class','OCLANG01',NULL,6,'Sadique Hussain',2500,1500,1,'course_images/UbHZBp9QFF4JCRDi5wClcXpRxlvVgY9JDvT2hhX9.png',1,'online','https://meet.google.com/otp-nzdp-qsg',NULL,NULL,NULL,'2025-04-01 13:11:13','2025-04-01 17:39:16'),(9,'VB.NET ','vbnet','OFVB01','This VB.NET (Visual Basic .NET) Course is designed for beginners to intermediate learners who want to develop Windows applications using the .NET framework. The course covers VB.NET syntax, object-oriented programming (OOP), database integration, and Windows Forms applications.\n\nCourse Objectives:\nBy the end of this course, participants will:\n✅ Understand the fundamentals of VB.NET and the .NET framework.\n✅ Learn object-oriented programming concepts such as classes, inheritance, and polymorphism.\n✅ Develop Windows Forms applications using GUI components.\n✅ Work with databases using ADO.NET and SQL Server.\n✅ Handle errors and exceptions efficiently.',6,'Sadique hussian',1999,1299,1,'course_images/ctrPrYecWE4JQWM7giA3KiZHgeabVs30INpcJwkN.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)','2025-04-03 23:35:52','2025-04-09 06:42:33'),(10,'Laravel 12 and Mysql','laravel-12-and-mysql','OFLV02','This Laravel 12 course provides a practical and comprehensive introduction to one of the most popular PHP frameworks. Tailored for beginners and intermediate developers, this course covers everything from Laravel\'s core concepts to advanced features introduced in Laravel 12. Learn how to build secure, scalable, and modern web applications using elegant syntax and developer-friendly tools.\nKey Features of Laravel 12:\nCleaner syntax with improved developer experience\n\nImproved performance and security features\n\nNew process layer for job pipelines\n\nEnhanced route handling and middleware\n\nNative support for modern PHP 8.x features\n\nUpdates to Laravel Breeze, Jetstream, and Livewire integration\n\nBy the end of this course, learners will: ✅ Understand the structure and workflow of a Laravel application\n✅ Build RESTful APIs and web apps with routing, controllers, and views\n✅ Work with Eloquent ORM and database migrations\n✅ Implement authentication and authorization\n✅ Master form validation, file uploads, and session management\n✅ Use Laravel\'s artisan commands, queues, events, and jobs\n✅ Learn the new features introduced in Laravel 12',6,'Sadique Hussain',3399,1799,4,'course_images/qeheEIKWiERfWN301SHnf8iylrCkBjDCUCfUYXen.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)','2025-04-04 11:40:16','2025-04-04 11:48:51'),(12,'Django ','django','OFDJ01','Django is a high-level Python web framework that enables rapid development of secure and maintainable websites. Built by experienced developers, Django takes care of much of the hassle of web development, so you can focus on writing your app without needing to reinvent the wheel. It is free and open source, has a thriving and active community, great documentation, and many options for free and paid-for support.',6,'Sadique Hussian',2999,1999,4,'course_images/IgH9SP8nZ78e4DFgxfDMU0cAV0gOJV0GqMKcUYLB.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)','2025-04-14 22:23:47','2025-04-14 22:44:53');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiries`
--

LOCK TABLES `enquiries` WRITE;
/*!40000 ALTER TABLE `enquiries` DISABLE KEYS */;
/*!40000 ALTER TABLE `enquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_users`
--

DROP TABLE IF EXISTS `exam_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `exam_id` bigint unsigned NOT NULL,
  `admin_approved` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '0',
  `total_marks` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_users_user_id_foreign` (`user_id`),
  KEY `exam_users_exam_id_foreign` (`exam_id`),
  CONSTRAINT `exam_users_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_users`
--

LOCK TABLES `exam_users` WRITE;
/*!40000 ALTER TABLE `exam_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `batch_id` bigint unsigned NOT NULL,
  `exam_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `exam_date` date DEFAULT NULL,
  `passcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exams_course_id_foreign` (`course_id`),
  KEY `exams_batch_id_foreign` (`batch_id`),
  CONSTRAINT `exams_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `features`
--

LOCK TABLES `features` WRITE;
/*!40000 ALTER TABLE `features` DISABLE KEYS */;
/*!40000 ALTER TABLE `features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gem_transactions`
--

DROP TABLE IF EXISTS `gem_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gem_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `amount` int NOT NULL,
  `type` enum('earned','spent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gem_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `gem_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gem_transactions`
--

LOCK TABLES `gem_transactions` WRITE;
/*!40000 ALTER TABLE `gem_transactions` DISABLE KEYS */;
INSERT INTO `gem_transactions` VALUES (1,32,109,'earned','Welcome bonus for enrolling in course','2025-05-03 05:47:40','2025-04-03 05:47:40','2025-04-03 05:47:40'),(2,38,199,'earned','Welcome bonus for enrolling in course','2025-05-03 05:54:07','2025-04-03 05:54:07','2025-04-03 05:54:07'),(3,13,110,'earned','Welcome bonus for enrolling in course','2025-05-03 23:20:30','2025-04-03 23:20:30','2025-04-03 23:20:30'),(4,49,199,'earned','Welcome bonus for enrolling in course','2025-05-04 15:25:16','2025-04-04 15:25:16','2025-04-04 15:25:16'),(5,67,150,'earned','Welcome bonus for enrolling in course','2025-05-04 20:57:51','2025-04-04 20:57:51','2025-04-04 20:57:51'),(6,54,10,'earned','Earned By Submitting Assignment.','2025-05-07 09:31:41','2025-04-07 09:31:41','2025-04-07 09:31:41'),(7,54,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-07 09:31:41','2025-04-07 09:31:41','2025-04-07 09:31:41'),(8,54,10,'earned','Earned By Submitting Assignment.','2025-05-07 09:32:04','2025-04-07 09:32:04','2025-04-07 09:32:04'),(9,54,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-07 09:32:04','2025-04-07 09:32:04','2025-04-07 09:32:04'),(10,30,10,'earned','Earned By Submitting Assignment.','2025-05-07 10:53:16','2025-04-07 10:53:16','2025-04-07 10:53:16'),(11,30,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-07 10:53:16','2025-04-07 10:53:16','2025-04-07 10:53:16'),(12,30,10,'earned','Earned By Submitting Assignment.','2025-05-07 10:53:37','2025-04-07 10:53:37','2025-04-07 10:53:37'),(13,30,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-07 10:53:37','2025-04-07 10:53:37','2025-04-07 10:53:37'),(14,37,110,'earned','Welcome bonus for enrolling in course','2025-05-08 08:19:03','2025-04-08 08:19:03','2025-04-08 08:19:03'),(15,20,150,'earned','Welcome bonus for enrolling in course','2025-05-08 09:15:30','2025-04-08 09:15:30','2025-04-08 09:15:30'),(16,36,199,'earned','Welcome bonus for enrolling in course','2025-05-08 11:14:04','2025-04-08 11:14:04','2025-04-08 11:14:04'),(17,43,199,'earned','Welcome bonus for enrolling in course','2025-05-08 15:30:27','2025-04-08 15:30:27','2025-04-08 15:30:27'),(18,39,179,'earned','Welcome bonus for enrolling in course','2025-05-08 15:50:43','2025-04-08 15:50:43','2025-04-08 15:50:43'),(19,64,50,'earned','Welcome bonus for enrolling in course','2025-05-08 18:14:35','2025-04-08 18:14:35','2025-04-08 18:14:35'),(20,13,10,'earned','Earned By Submitting Assignment.','2025-05-09 07:10:37','2025-04-09 07:10:37','2025-04-09 07:10:37'),(21,13,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-09 07:10:37','2025-04-09 07:10:37','2025-04-09 07:10:37'),(22,48,10,'earned','Earned By Submitting Assignment.','2025-05-09 16:29:14','2025-04-09 16:29:14','2025-04-09 16:29:14'),(23,48,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-09 16:29:14','2025-04-09 16:29:14','2025-04-09 16:29:14'),(24,48,10,'earned','Earned By Submitting Assignment.','2025-05-09 16:29:21','2025-04-09 16:29:21','2025-04-09 16:29:21'),(25,48,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-09 16:29:21','2025-04-09 16:29:21','2025-04-09 16:29:21'),(26,7,10,'earned','Earned By Submitting Assignment.','2025-05-10 13:09:12','2025-04-10 13:09:12','2025-04-10 13:09:12'),(27,7,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-10 13:09:12','2025-04-10 13:09:12','2025-04-10 13:09:12'),(28,65,150,'earned','Welcome bonus for enrolling in course','2025-05-10 13:56:19','2025-04-10 13:56:19','2025-04-10 13:56:19'),(29,39,10,'earned','Earned By Submitting Assignment.','2025-05-11 14:25:33','2025-04-11 14:25:33','2025-04-11 14:25:33'),(30,39,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-11 14:25:33','2025-04-11 14:25:33','2025-04-11 14:25:33'),(31,26,179,'earned','Welcome bonus for enrolling in course','2025-05-11 14:57:57','2025-04-11 14:57:57','2025-04-11 14:57:57'),(32,26,10,'earned','Earned By Submitting Assignment.','2025-05-11 15:05:48','2025-04-11 15:05:48','2025-04-11 15:05:48'),(33,26,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-11 15:05:48','2025-04-11 15:05:48','2025-04-11 15:05:48'),(34,7,10,'earned','Earned By Submitting Assignment.','2025-05-13 19:33:57','2025-04-13 19:33:57','2025-04-13 19:33:57'),(35,7,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 19:33:57','2025-04-13 19:33:57','2025-04-13 19:33:57'),(36,39,10,'earned','Earned By Submitting Assignment.','2025-05-13 20:42:19','2025-04-13 20:42:19','2025-04-13 20:42:19'),(37,39,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 20:42:19','2025-04-13 20:42:19','2025-04-13 20:42:19'),(38,20,10,'earned','Earned By Submitting Assignment.','2025-05-13 21:03:02','2025-04-13 21:03:02','2025-04-13 21:03:02'),(39,20,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 21:03:02','2025-04-13 21:03:02','2025-04-13 21:03:02'),(40,20,10,'earned','Earned By Submitting Assignment.','2025-05-13 21:03:19','2025-04-13 21:03:19','2025-04-13 21:03:19'),(41,20,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 21:03:19','2025-04-13 21:03:19','2025-04-13 21:03:19'),(42,34,10,'earned','Earned By Submitting Assignment.','2025-05-13 23:08:48','2025-04-13 23:08:48','2025-04-13 23:08:48'),(43,34,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 23:08:48','2025-04-13 23:08:48','2025-04-13 23:08:48'),(44,34,10,'earned','Earned By Submitting Assignment.','2025-05-13 23:09:10','2025-04-13 23:09:10','2025-04-13 23:09:10'),(45,34,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 23:09:10','2025-04-13 23:09:10','2025-04-13 23:09:10'),(46,32,10,'earned','Earned By Submitting Assignment.','2025-05-13 23:23:33','2025-04-13 23:23:33','2025-04-13 23:23:33'),(47,32,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 23:23:33','2025-04-13 23:23:33','2025-04-13 23:23:33'),(48,32,10,'earned','Earned By Submitting Assignment.','2025-05-13 23:23:56','2025-04-13 23:23:56','2025-04-13 23:23:56'),(49,32,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-13 23:23:56','2025-04-13 23:23:56','2025-04-13 23:23:56'),(50,30,10,'earned','Earned By Submitting Assignment.','2025-05-14 10:52:02','2025-04-14 10:52:02','2025-04-14 10:52:02'),(51,30,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-14 10:52:02','2025-04-14 10:52:02','2025-04-14 10:52:02'),(52,30,10,'earned','Earned By Submitting Assignment.','2025-05-14 10:52:16','2025-04-14 10:52:16','2025-04-14 10:52:16'),(53,30,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-14 10:52:16','2025-04-14 10:52:16','2025-04-14 10:52:16'),(54,42,10,'earned','Earned By Submitting Assignment.','2025-05-14 10:58:52','2025-04-14 10:58:52','2025-04-14 10:58:52'),(55,42,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-14 10:58:52','2025-04-14 10:58:52','2025-04-14 10:58:52'),(56,21,10,'earned','Earned By Submitting Assignment.','2025-05-14 11:27:42','2025-04-14 11:27:42','2025-04-14 11:27:42'),(57,21,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-14 11:27:42','2025-04-14 11:27:42','2025-04-14 11:27:42'),(58,49,10,'earned','Earned By Submitting Assignment.','2025-05-14 12:06:42','2025-04-14 12:06:42','2025-04-14 12:06:42'),(59,49,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-14 12:06:42','2025-04-14 12:06:42','2025-04-14 12:06:42'),(60,69,179,'earned','Welcome bonus for enrolling in course','2025-05-14 15:36:34','2025-04-14 15:36:34','2025-04-14 15:36:34'),(61,24,179,'earned','Welcome bonus for enrolling in course','2025-05-14 15:37:11','2025-04-14 15:37:11','2025-04-14 15:37:11'),(62,63,179,'earned','Welcome bonus for enrolling in course','2025-05-14 15:38:04','2025-04-14 15:38:04','2025-04-14 15:38:04'),(63,19,10,'earned','Earned By Submitting Assignment.','2025-05-15 23:29:07','2025-04-15 23:29:07','2025-04-15 23:29:07'),(64,19,100,'earned','Bonus for completing 7 on-time assignments!','2025-05-15 23:29:07','2025-04-15 23:29:07','2025-04-15 23:29:07'),(65,13,150,'earned','Welcome bonus for enrolling in course','2025-05-16 11:57:36','2025-04-16 11:57:36','2025-04-16 11:57:36'),(66,13,3,'earned','Earned by Practice Test','2025-05-16 11:58:45','2025-04-16 11:58:45','2025-04-16 11:58:45'),(67,26,110,'earned','Welcome bonus for enrolling in course','2025-05-16 15:13:25','2025-04-16 15:13:25','2025-04-16 15:13:25'),(68,77,150,'earned','Welcome bonus for enrolling in course','2025-05-16 23:53:25','2025-04-16 23:53:25','2025-04-16 23:53:25'),(69,47,110,'earned','Welcome bonus for enrolling in course','2025-05-18 17:25:03','2025-04-18 17:25:03','2025-04-18 17:25:03'),(70,17,110,'earned','Welcome bonus for enrolling in course','2025-05-18 17:25:53','2025-04-18 17:25:53','2025-04-18 17:25:53'),(71,76,110,'earned','Welcome bonus for enrolling in course','2025-05-18 17:29:25','2025-04-18 17:29:25','2025-04-18 17:29:25'),(72,41,110,'earned','Welcome bonus for enrolling in course','2025-05-18 17:30:43','2025-04-18 17:30:43','2025-04-18 17:30:43'),(73,46,0,'earned','Welcome bonus for enrolling in course','2025-05-18 17:40:49','2025-04-18 17:40:49','2025-04-18 17:40:49'),(74,20,9,'earned','Earned by Practice Test','2025-05-19 14:56:55','2025-04-19 14:56:55','2025-04-19 14:56:55'),(75,51,179,'earned','Welcome bonus for enrolling in course','2025-05-21 15:18:58','2025-04-21 15:18:58','2025-04-21 15:18:58'),(76,78,199,'earned','Welcome bonus for enrolling in course','2025-05-21 19:37:46','2025-04-21 19:37:46','2025-04-21 19:37:46'),(77,32,10,'earned','Earned By Submitting Assignment.','2025-05-21 20:07:38','2025-04-21 20:07:38','2025-04-21 20:07:38'),(78,34,10,'earned','Earned By Submitting Assignment.','2025-05-21 20:18:15','2025-04-21 20:18:15','2025-04-21 20:18:15'),(79,30,10,'earned','Earned By Submitting Assignment.','2025-05-21 20:25:02','2025-04-21 20:25:02','2025-04-21 20:25:02'),(80,54,10,'earned','Earned By Submitting Assignment.','2025-05-21 22:31:04','2025-04-21 22:31:04','2025-04-21 22:31:04');
/*!40000 ALTER TABLE `gem_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(5,'2024_07_31_122448_create_categories_table',1),(6,'2024_08_10_054152_create_courses_table',1),(7,'2024_08_18_185445_create_features_table',1),(8,'2024_08_18_185505_create_course_feature_table',1),(9,'2024_08_19_071859_create_batches_table',1),(10,'2024_08_23_180715_create_course_student_table',1),(11,'2024_08_24_043713_create_payments_table',1),(12,'2024_09_02_171630_create_enquiries_table',1),(13,'2024_12_14_071508_create_assignments_table',1),(14,'2024_12_14_082820_create_exams_table',1),(15,'2024_12_14_083446_create_quizzes_table',1),(16,'2024_12_16_100352_create_assignment_uploads_table',1),(17,'2024_12_18_072701_create_exam_users_table',1),(18,'2024_12_19_082912_create_answers_table',1),(19,'2025_01_24_074516_create_placed_students_table',1),(20,'2025_02_10_164502_create_post_courses_table',1),(21,'2025_02_10_165009_create_post_chapters_table',1),(22,'2025_02_10_170234_create_post_topic_posts_table',1),(23,'2025_02_10_170918_create_post_my_posts_table',1),(24,'2025_03_05_153929_create_attendances_table',1),(25,'2025_03_09_053805_create_mock_tests_table',1),(26,'2025_03_09_185327_create_mock_test_questions_table',1),(27,'2025_03_11_104418_create_mock_test_results_table',1),(28,'2025_03_12_160513_create_product_categories_table',1),(29,'2025_03_12_160620_create_products_table',1),(30,'2025_03_13_094145_create_course_reviews_table',1),(31,'2025_03_13_214814_create_shipping_details_table',1),(32,'2025_03_13_create_gem_transactions_table',1),(33,'2025_03_14_143632_create_orders_table',1),(34,'2025_03_18_042613_create_personal_access_tokens_table',1),(35,'2025_03_18_062152_create_certificates_table',1),(36,'2025_03_18_161826_add_status_and_slug_to_products_table',1),(37,'2025_03_20_000001_create_subscription_plans_table',1),(38,'2025_03_20_000002_create_subscriptions_table',1),(39,'2025_03_24_0404040_add_transaction_id_to_payments',1),(40,'2024_01_09_043712_create_workshops_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mock_test_questions`
--

DROP TABLE IF EXISTS `mock_test_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mock_test_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mocktest_id` bigint unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mock_test_questions_mocktest_id_foreign` (`mocktest_id`),
  CONSTRAINT `mock_test_questions_mocktest_id_foreign` FOREIGN KEY (`mocktest_id`) REFERENCES `mock_tests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mock_test_questions_chk_1` CHECK (json_valid(`options`))
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_test_questions`
--

LOCK TABLES `mock_test_questions` WRITE;
/*!40000 ALTER TABLE `mock_test_questions` DISABLE KEYS */;
INSERT INTO `mock_test_questions` VALUES (1,1,'What is the correct syntax to declare an integer variable in C?','\"[\\\"int x;\\\",\\\"integer x;\\\",\\\"x: int;\\\",\\\"declare int x;\\\"]\"','int x;',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(2,1,'Which of the following is a valid keyword in C?','\"[\\\"var\\\",\\\"main\\\",\\\"int\\\",\\\"define\\\"]\"','int',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(3,1,'What is the output of: printf(\"%d\", 10 + 5);','\"[\\\"10\\\",\\\"15\\\",\\\"105\\\",\\\"Error\\\"]\"','15',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(4,1,'Which header file is required to use the printf function?','\"[\\\"<conio.h>\\\",\\\"<stdio.h>\\\",\\\"<stdlib.h>\\\",\\\"<math.h>\\\"]\"','<stdio.h>',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(5,1,'How do you write a comment in C?','\"[\\\"# This is a comment\\\",\\\"\\\\\\/\\\\\\/ This is a comment\\\",\\\"<!-- comment -->\\\",\\\"** This is a comment **\\\"]\"','// This is a comment',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(6,1,'Which data type is used to store a single character?','\"[\\\"char\\\",\\\"string\\\",\\\"int\\\",\\\"float\\\"]\"','char',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(7,1,'What will be the output of: printf(\"%c\", \'A\' + 1);','\"[\\\"B\\\",\\\"A1\\\",\\\"2\\\",\\\"Error\\\"]\"','B',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(8,1,'Which of the following is not a loop structure in C?','\"[\\\"for\\\",\\\"while\\\",\\\"repeat\\\",\\\"do-while\\\"]\"','repeat',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(9,1,'Which operator is used to assign a value to a variable?','\"[\\\"==\\\",\\\"=\\\",\\\"++\\\",\\\"--\\\"]\"','=',1,'2025-04-16 11:55:55','2025-04-16 11:55:55'),(10,1,'Which of the following is the correct way to start the main function in C?','\"[\\\"void main()\\\",\\\"main()\\\",\\\"int main()\\\",\\\"start main()\\\"]\"','int main()',1,'2025-04-16 11:55:55','2025-04-16 11:55:55');
/*!40000 ALTER TABLE `mock_test_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mock_test_results`
--

DROP TABLE IF EXISTS `mock_test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mock_test_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `mock_test_id` bigint unsigned NOT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `score` int unsigned NOT NULL,
  `total_questions` int NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_mock_test_unique` (`user_id`,`mock_test_id`),
  KEY `mock_test_results_mock_test_id_foreign` (`mock_test_id`),
  CONSTRAINT `mock_test_results_mock_test_id_foreign` FOREIGN KEY (`mock_test_id`) REFERENCES `mock_tests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mock_test_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mock_test_results_chk_1` CHECK (json_valid(`answers`))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_test_results`
--

LOCK TABLES `mock_test_results` WRITE;
/*!40000 ALTER TABLE `mock_test_results` DISABLE KEYS */;
INSERT INTO `mock_test_results` VALUES (1,13,1,'\"{\\\"1\\\":\\\"int x;\\\",\\\"2\\\":\\\"var\\\",\\\"3\\\":\\\"10\\\",\\\"4\\\":\\\"<conio.h>\\\",\\\"5\\\":\\\"# This is a comment\\\",\\\"6\\\":\\\"char\\\",\\\"7\\\":\\\"B\\\",\\\"8\\\":\\\"for\\\",\\\"9\\\":\\\"==\\\",\\\"10\\\":\\\"void main()\\\"}\"',3,10,'2025-04-16 11:58:45','2025-04-16 11:58:45','2025-04-16 11:58:45'),(2,20,1,'\"{\\\"1\\\":\\\"int x;\\\",\\\"2\\\":\\\"int\\\",\\\"3\\\":\\\"15\\\",\\\"4\\\":\\\"<stdio.h>\\\",\\\"5\\\":\\\"** This is a comment **\\\",\\\"6\\\":\\\"char\\\",\\\"7\\\":\\\"B\\\",\\\"8\\\":\\\"repeat\\\",\\\"9\\\":\\\"=\\\",\\\"10\\\":\\\"int main()\\\"}\"',9,10,'2025-04-19 14:56:55','2025-04-19 14:56:55','2025-04-19 14:56:55');
/*!40000 ALTER TABLE `mock_test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mock_tests`
--

DROP TABLE IF EXISTS `mock_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mock_tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `test_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `level` enum('beginners','intermediate','hard') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mock_tests_course_id_foreign` (`course_id`),
  CONSTRAINT `mock_tests_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_tests`
--

LOCK TABLES `mock_tests` WRITE;
/*!40000 ALTER TABLE `mock_tests` DISABLE KEYS */;
INSERT INTO `mock_tests` VALUES (1,'C Programming Mock Test',2,'beginners',1,'2025-04-16 11:55:55','2025-04-18 09:26:26',0);
/*!40000 ALTER TABLE `mock_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `shipping_detail_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_shipping_detail_id_foreign` (`shipping_detail_id`),
  KEY `orders_product_id_foreign` (`product_id`),
  CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_shipping_detail_id_foreign` FOREIGN KEY (`shipping_detail_id`) REFERENCES `shipping_details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('ajjuaarju950@gmail.com','$2y$12$odFmctDPPRKMKInb5o9xie0sAm3FsR9o.4BbRF5huOZI5Wc3uxpw2','2025-04-08 08:27:37'),('jhas57082@gmail.com','$2y$12$2Yhgz4hIqFr7S7uz2ib7Ke2kFQlGLUM8n0uviT06LeFQCLN4oGoLC','2025-04-04 10:21:27'),('rachitak730@gmail.com','$2y$12$VwaSeiR26MVhmOzLik7r1ujyawEqnFk/./jFAgXE3naGTfhLVCo3y','2025-04-10 11:45:51'),('raman766423@gmail.com','$2y$12$sTIH8y/.slimeQXJy41/LuK6hWGitcZ3O8DK4zQD3JS3Nuykn/yHC','2025-04-18 12:05:33'),('shreyaa8673@gmail.com','$2y$12$OhpMcxIk6Nh3Wg6knOt9Se2zq4B.RCZbG3St9jFpr0jSwVeN52e1u','2025-04-08 15:20:45');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `workshop_id` bigint unsigned DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'course',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `transaction_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_course_id_foreign` (`course_id`),
  KEY `payments_workshop_id_foreign` (`workshop_id`),
  KEY `payments_student_id_course_id_index` (`student_id`,`course_id`),
  KEY `payments_student_id_workshop_id_index` (`student_id`,`workshop_id`),
  KEY `payments_payment_type_status_index` (`payment_type`,`status`),
  KEY `payments_payment_status_created_at_index` (`payment_status`,`created_at`),
  CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_workshop_id_foreign` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,34,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67e21818309c5','CASH-67e21818309c6',NULL,'RCPT-CRS-1742870552',NULL,NULL,NULL,'49.47.133.34','Course: C Programming language','2025-03-25 02:42:32',3,2025,'2025-03-25 02:42:32','2025-03-25 02:42:32'),(4,53,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67e297b75c579','CASH-67e297b75c57a',NULL,'RCPT-CRS-1742903223',NULL,NULL,NULL,'49.47.133.34','Course: C Programming language','2025-03-25 11:47:03',3,2025,'2025-03-25 11:47:03','2025-03-25 11:47:03'),(5,30,5,NULL,'course',1500.00,1500.00,0.00,'INR','cash','completed','captured','ORD-67e369321a00a','CASH-67e369321a00b',NULL,'RCPT-CRS-1742956850',NULL,NULL,NULL,'49.47.133.205','Course: HTML5 & CSS3 with Tailwindcss4','2025-03-26 02:40:50',3,2025,'2025-03-26 02:40:50','2025-03-26 02:40:50'),(6,54,NULL,NULL,'subscription',700.00,700.00,0.00,'INR','cash','completed','captured','ORD-67e369654cf64','CASH-67e369654c41f',NULL,'RCPT-SUB-1742956901',NULL,NULL,NULL,'49.47.133.205','Subscription Plan: 1-Month Plan','2025-03-11 02:41:41',3,2025,'2025-03-26 02:41:41','2025-03-26 02:41:41'),(7,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR','cash','completed','captured','ORD-67e36a67f3d8f','CASH-67e36a67f327f',NULL,'RCPT-SUB-1742957159',NULL,NULL,NULL,'49.47.133.205','Subscription Plan: 1-Month Plan','2025-03-26 02:45:59',3,2025,'2025-03-26 02:45:59','2025-03-26 02:45:59'),(8,18,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QBNPKUlsvnBANn',NULL,NULL,'COURSE_1742982826',NULL,NULL,NULL,'49.47.131.62',NULL,NULL,3,2025,'2025-03-26 09:53:47','2025-03-26 09:53:47'),(9,18,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QBNPUXcwoeQjiM',NULL,NULL,'COURSE_1742982836',NULL,NULL,NULL,'49.47.131.62',NULL,NULL,3,2025,'2025-03-26 09:53:56','2025-03-26 09:53:56'),(10,53,5,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QBgoCm34O3G2w9',NULL,NULL,'CRS_1743051150',NULL,NULL,NULL,'157.42.16.146',NULL,NULL,3,2025,'2025-03-27 04:52:30','2025-03-27 04:52:30'),(11,53,5,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QBgoEWyb1Xpsud',NULL,NULL,'CRS_1743051152',NULL,NULL,NULL,'157.42.16.146',NULL,NULL,3,2025,'2025-03-27 04:52:32','2025-03-27 04:52:32'),(12,20,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QBmL7XgdL7Mw02',NULL,NULL,'SUB_1743070627',NULL,NULL,NULL,NULL,NULL,NULL,3,2025,'2025-03-27 10:17:07','2025-03-27 10:17:08'),(13,20,NULL,NULL,'subscription',2047.00,2047.00,0.00,'INR',NULL,'initiated','pending','order_QBmOA3ttH0YDn7',NULL,NULL,'SUB_1743070801',NULL,NULL,NULL,NULL,NULL,NULL,3,2025,'2025-03-27 10:20:01','2025-03-27 10:20:01'),(14,59,2,NULL,'course',1100.00,1100.00,0.00,'INR','razorpay','initiated','pending','order_QCDnV0ivfzexXZ',NULL,NULL,'COURSE_1743167323',NULL,NULL,NULL,'110.226.36.4',NULL,NULL,3,2025,'2025-03-28 13:08:44','2025-03-28 13:08:44'),(15,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDgJYOuQhYhHmi',NULL,NULL,'SUB_1743486088',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 05:41:28','2025-04-01 05:41:30'),(16,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDgK55Od4AiMGs',NULL,NULL,'SUB_1743486120',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 05:42:00','2025-04-01 05:42:00'),(17,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBgLke8xtWjj',NULL,NULL,'SUB_1743520857',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:20:57','2025-04-01 15:20:59'),(18,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBkj8Uz8c5WT',NULL,NULL,'SUB_1743520862',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:21:02','2025-04-01 15:21:03'),(19,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBvfhCNsLXrZ',NULL,NULL,'SUB_1743520873',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:21:13','2025-04-01 15:21:13'),(20,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBwecDGrhTej',NULL,NULL,'SUB_1743520874',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:21:14','2025-04-01 15:21:14'),(21,12,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending',NULL,NULL,NULL,'CRS_1743603686',NULL,NULL,NULL,'122.164.74.237',NULL,NULL,4,2025,'2025-04-02 14:21:26','2025-04-02 14:21:26'),(22,32,4,NULL,'course',1099.00,1099.00,0.00,'INR','cash','completed','captured','ORD-67ee20fc60363','CASH-67ee20fc60364',NULL,'RCPT-CRS-1743659260',NULL,NULL,NULL,'49.47.129.51','Course: C++ with object oriented programming for BCA, Btech','2025-04-03 05:47:40',4,2025,'2025-04-03 05:47:40','2025-04-03 05:47:40'),(23,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR','cash','completed','captured','ORD-67ee214d23c41','CASH-67ee214d2322b',NULL,'RCPT-SUB-1743659341',NULL,NULL,NULL,'49.47.129.51','Subscription Plan: 1-Month Plan','2025-04-03 05:49:01',4,2025,'2025-04-03 05:49:01','2025-04-03 05:49:01'),(24,38,6,NULL,'course',1999.00,1999.00,0.00,'INR','cash','completed','captured','ORD-67ee227f299ee','CASH-67ee227f299ef',NULL,'RCPT-CRS-1743659647',NULL,NULL,NULL,'49.47.129.51','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-03 05:54:07',4,2025,'2025-04-03 05:54:07','2025-04-03 05:54:07'),(25,12,5,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QETnaIYqPK31Ks',NULL,NULL,'CRS_1743660354',NULL,NULL,NULL,'49.47.129.51',NULL,NULL,4,2025,'2025-04-03 06:05:54','2025-04-03 06:05:55'),(27,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QEr85Zcu1TWE5x',NULL,NULL,'CRS_1743742515',NULL,NULL,NULL,'157.35.79.42',NULL,NULL,4,2025,'2025-04-04 10:25:15','2025-04-04 10:25:16'),(28,49,6,NULL,'course',1999.00,1999.00,0.00,'INR','cash','completed','captured','ORD-67efac84ad4ab','CASH-67efac84ad4ac',NULL,'RCPT-CRS-1743760516',NULL,NULL,NULL,'152.58.133.211','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-04 15:25:16',4,2025,'2025-04-04 15:25:16','2025-04-04 15:25:16'),(29,26,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QEyaJORFjmDsMF',NULL,NULL,'WS_1743768769',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-04 17:42:51','2025-04-04 17:42:51'),(30,26,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QEyaM7py4wq0df',NULL,NULL,'WS_1743768773',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-04 17:42:53','2025-04-04 17:42:53'),(31,26,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QEyaN0p6t3kv23',NULL,NULL,'WS_1743768774',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-04 17:42:54','2025-04-04 17:42:54'),(32,66,9,NULL,'course',1299.00,1299.00,0.00,'INR',NULL,'initiated','pending','order_QEyc0zs7gXJDDu',NULL,NULL,'CRS_1743768867',NULL,NULL,NULL,'152.56.134.195',NULL,NULL,4,2025,'2025-04-04 17:44:27','2025-04-04 17:44:28'),(33,26,2,NULL,'course',1100.00,1100.00,0.00,'INR',NULL,'initiated','pending','order_QEyjR418ln7m92',NULL,NULL,'CRS_1743769288',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:51:28','2025-04-04 17:51:29'),(34,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEyl5fFfQvwdqX',NULL,NULL,'CRS_1743769382',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:02','2025-04-04 17:53:03'),(35,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylGql3vd8iEg',NULL,NULL,'CRS_1743769393',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:13','2025-04-04 17:53:13'),(36,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylJh5ADBPNie',NULL,NULL,'CRS_1743769395',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:15','2025-04-04 17:53:16'),(37,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylMKvwQDQx7f',NULL,NULL,'CRS_1743769398',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:18','2025-04-04 17:53:18'),(38,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylPDzmyeTAeG',NULL,NULL,'CRS_1743769400',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:20','2025-04-04 17:53:21'),(39,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylRsmA6Vphjm',NULL,NULL,'CRS_1743769403',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:23','2025-04-04 17:53:23'),(40,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylVAz7cETyoU',NULL,NULL,'CRS_1743769406',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:26','2025-04-04 17:53:26'),(41,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylYiD5eh8yYC',NULL,NULL,'CRS_1743769408',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:28','2025-04-04 17:53:30'),(42,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEyldSMmWdo6Pf',NULL,NULL,'CRS_1743769413',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:33','2025-04-04 17:53:34'),(43,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylg1Iy5jlKPF',NULL,NULL,'CRS_1743769416',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:36','2025-04-04 17:53:36'),(44,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEynpzPPXsDl50',NULL,NULL,'CRS_1743769538',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:55:38','2025-04-04 17:55:39'),(45,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEyoOqUJI2yZNI',NULL,NULL,'CRS_1743769570',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:56:10','2025-04-04 17:56:11'),(46,67,5,NULL,'course',1500.00,1500.00,0.00,'INR','cash','completed','captured','ORD-67effa774c96e','CASH-67effa774c96f',NULL,'RCPT-CRS-1743780471',NULL,NULL,NULL,'152.58.189.65','Course: HTML5 & CSS3 with Tailwindcss4','2025-04-04 20:57:51',4,2025,'2025-04-04 20:57:51','2025-04-04 20:57:51'),(47,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEilPRmfqtbFW',NULL,NULL,'CRS_1743825595',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:29:55','2025-04-05 09:29:57'),(48,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEjFvubbv6RH6',NULL,NULL,'CRS_1743825624',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:30:24','2025-04-05 09:30:25'),(49,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEjKVfAJhshSE',NULL,NULL,'CRS_1743825628',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:30:28','2025-04-05 09:30:29'),(50,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEjQBhFjjq7PX',NULL,NULL,'CRS_1743825633',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:30:33','2025-04-05 09:30:34'),(51,67,NULL,NULL,'subscription',899.00,899.00,0.00,'INR','cash','completed','captured','ORD-67f1f87431ed0','CASH-67f1f874306fc',NULL,'RCPT-SUB-1743911028',NULL,NULL,NULL,'122.172.167.43','Subscription Plan: 1-Month Plan','2025-04-06 09:13:48',4,2025,'2025-04-06 09:13:48','2025-04-06 09:13:48'),(52,37,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67f48e9fe8ff3','CASH-67f48e9fe8ff4',NULL,'RCPT-CRS-1744080543',NULL,NULL,NULL,'49.47.129.185','Course: C Programming language','2025-04-08 08:19:03',4,2025,'2025-04-08 08:19:03','2025-04-08 08:19:03'),(53,20,1,NULL,'course',1500.00,1500.00,0.00,'INR','cash','completed','captured','ORD-67f49bdaecdc2','CASH-67f49bdaecdc3',NULL,'RCPT-CRS-1744083930',NULL,NULL,NULL,'49.47.129.185','Course: Python','2025-04-08 09:15:30',4,2025,'2025-04-08 09:15:30','2025-04-08 09:15:30'),(54,36,6,NULL,'course',1999.00,1999.00,0.00,'INR','cash','completed','captured','ORD-67f4b7a4cab06','CASH-67f4b7a4cab07',NULL,'RCPT-CRS-1744091044',NULL,NULL,NULL,'152.59.142.204','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-08 11:14:04',4,2025,'2025-04-08 11:14:04','2025-04-08 11:14:04'),(55,39,10,NULL,'course',1799.00,1799.00,0.00,'INR','razorpay','initiated','pending','order_QGSB0GmMiGa70q',NULL,NULL,'COURSE_1744091320',NULL,NULL,NULL,'42.104.248.95',NULL,NULL,4,2025,'2025-04-08 11:18:42','2025-04-08 11:18:42'),(56,43,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QGWOjeLa4MB3v4',NULL,NULL,'COURSE_1744106187',NULL,NULL,NULL,'152.59.146.227',NULL,NULL,4,2025,'2025-04-08 15:26:28','2025-04-08 15:26:28'),(57,63,10,NULL,'course',1799.00,1799.00,0.00,'INR','razorpay','initiated','pending','order_QGWPzDG6jWVIKE',NULL,NULL,'COURSE_1744106259',NULL,NULL,NULL,'223.176.58.66',NULL,NULL,4,2025,'2025-04-08 15:27:39','2025-04-08 15:27:39'),(58,43,6,NULL,'course',1999.00,1999.00,0.00,'INR','cash','completed','captured','ORD-67f4f3bbcd6a8','CASH-67f4f3bbcd6a9',NULL,'RCPT-CRS-1744106427',NULL,NULL,NULL,'49.47.129.185','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-08 15:30:27',4,2025,'2025-04-08 15:30:27','2025-04-08 15:30:27'),(59,39,10,NULL,'course',1799.00,1799.00,0.00,'INR','cash','completed','captured','ORD-67f4f878d9dfc','CASH-67f4f87bd1837',NULL,'RCPT-CRS-1744107643',NULL,NULL,NULL,'152.59.142.1','Course: Laravel 12 and Mysql','2025-04-08 15:50:43',4,2025,'2025-04-08 15:50:43','2025-04-08 15:50:43'),(60,64,NULL,NULL,'subscription',899.00,899.00,0.00,'INR','cash','completed','captured','ORD-67f51a1758e9b','CASH-67f51a1756de7',NULL,'RCPT-SUB-1744116247',NULL,NULL,NULL,'49.47.129.185','Subscription Plan: 1-Month Plan','2025-04-08 18:14:07',4,2025,'2025-04-08 18:14:07','2025-04-08 18:14:07'),(61,64,5,NULL,'course',500.00,500.00,0.00,'INR','cash','completed','captured','ORD-67f51a2e62605','CASH-67f51a3391e64',NULL,'RCPT-CRS-1744116275',NULL,NULL,NULL,'49.47.129.185','Course: HTML5 & CSS3 with Tailwindcss4','2025-04-08 18:14:35',4,2025,'2025-04-08 18:14:35','2025-04-08 18:14:35'),(62,9,9,NULL,'course',1299.00,1299.00,0.00,'INR',NULL,'initiated','pending','order_QGZTIiJKZ14Voe',NULL,NULL,'CRS_1744117011',NULL,NULL,NULL,'49.47.129.185',NULL,NULL,4,2025,'2025-04-08 18:26:51','2025-04-08 18:26:52'),(63,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGne2pSdtwfQvR',NULL,NULL,'CRS_1744166924',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:18:44','2025-04-09 08:18:45'),(64,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGne8QFtHvRxX0',NULL,NULL,'CRS_1744166930',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:18:50','2025-04-09 08:18:50'),(65,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGneQre6VPZ4ve',NULL,NULL,'CRS_1744166947',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:19:07','2025-04-09 08:19:07'),(66,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGneUksayZTu0h',NULL,NULL,'CRS_1744166950',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:19:10','2025-04-09 08:19:11'),(67,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnekpsWx5MwHW',NULL,NULL,'CRS_1744166965',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:19:25','2025-04-09 08:19:26'),(68,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnf7UqjOqI8FZ',NULL,NULL,'CRS_1744166986',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:19:46','2025-04-09 08:19:46'),(69,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnfBgvW9oVdyu',NULL,NULL,'CRS_1744166990',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:19:50','2025-04-09 08:19:50'),(70,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnfObA9g67XRE',NULL,NULL,'CRS_1744167001',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:20:01','2025-04-09 08:20:02'),(71,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnfR7q2BO2Ru2',NULL,NULL,'CRS_1744167004',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:20:04','2025-04-09 08:20:04'),(72,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnfTV9Yne3F1Q',NULL,NULL,'CRS_1744167006',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:20:06','2025-04-09 08:20:06'),(73,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnfW8sJwI0fvT',NULL,NULL,'CRS_1744167008',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:20:08','2025-04-09 08:20:09'),(74,67,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QGnfswsgfYviNT',NULL,NULL,'WS_1744167029',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-09 08:20:30','2025-04-09 08:20:30'),(75,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnjY4SJ5rPA9F',NULL,NULL,'CRS_1744167237',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:23:57','2025-04-09 08:23:58'),(76,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QGnjpfLg4Ft6Gv',NULL,NULL,'CRS_1744167253',NULL,NULL,NULL,'49.47.129.56',NULL,NULL,4,2025,'2025-04-09 08:24:13','2025-04-09 08:24:14'),(77,26,NULL,NULL,'subscription',2626.00,2626.00,0.00,'INR',NULL,'initiated','pending','order_QGvkE4KOwxIlP7',NULL,NULL,'SUB_1744195448',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-09 16:14:08','2025-04-09 16:14:09'),(78,26,NULL,NULL,'subscription',2626.00,2626.00,0.00,'INR',NULL,'initiated','pending','order_QGvkFwdXfjADru',NULL,NULL,'SUB_1744195450',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-09 16:14:10','2025-04-09 16:14:11'),(79,26,NULL,NULL,'subscription',2626.00,2626.00,0.00,'INR',NULL,'initiated','pending','order_QGvkHEUEbaqYnL',NULL,NULL,'SUB_1744195452',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-09 16:14:12','2025-04-09 16:14:12'),(80,26,NULL,NULL,'subscription',899.00,899.00,0.00,'INR',NULL,'initiated','pending','order_QGvkIMmqM7UIZJ',NULL,NULL,'SUB_1744195453',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-09 16:14:13','2025-04-09 16:14:13'),(81,26,NULL,NULL,'subscription',899.00,899.00,0.00,'INR',NULL,'initiated','pending','order_QGvkJUpVIAsrBc',NULL,NULL,'SUB_1744195454',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-09 16:14:14','2025-04-09 16:14:14'),(82,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHAbr6T4S9o9GG',NULL,NULL,'CRS_1744247797',NULL,NULL,NULL,'152.59.133.166',NULL,NULL,4,2025,'2025-04-10 06:46:37','2025-04-10 06:46:38'),(83,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHAe4z5wsXjWCx',NULL,NULL,'CRS_1744247924',NULL,NULL,NULL,'152.59.133.166',NULL,NULL,4,2025,'2025-04-10 06:48:44','2025-04-10 06:48:44'),(84,65,8,NULL,'course',1500.00,1500.00,0.00,'INR','razorpay','completed','captured','order_QHHtsZn0ofyoqP',NULL,NULL,'COURSE_1744273472','order_QHHtsZn0ofyoqP','pay_QHHupDNVP60GjK','d205654d2a2a83920dc6d6e46ac973e5cbfa54960ca3a333b032be0535d0183e','157.37.152.114',NULL,'2025-04-10 13:56:19',4,2025,'2025-04-10 13:54:33','2025-04-10 13:56:19'),(85,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHercGNDmZR2mV',NULL,NULL,'CRS_1744354340',NULL,NULL,NULL,'157.35.40.212',NULL,NULL,4,2025,'2025-04-11 12:22:20','2025-04-11 12:22:22'),(86,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHerhISvbpu5WP',NULL,NULL,'CRS_1744354346',NULL,NULL,NULL,'157.35.40.212',NULL,NULL,4,2025,'2025-04-11 12:22:26','2025-04-11 12:22:26'),(87,53,8,NULL,'course',1500.00,1500.00,0.00,'INR','razorpay','initiated','pending','order_QHfoLuKqyGhowx',NULL,NULL,'COURSE_1744357676',NULL,NULL,NULL,'157.35.42.129',NULL,NULL,4,2025,'2025-04-11 13:17:58','2025-04-11 13:17:58'),(88,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHfr6TW9cJ0CZ6',NULL,NULL,'CRS_1744357834',NULL,NULL,NULL,'157.35.42.129',NULL,NULL,4,2025,'2025-04-11 13:20:34','2025-04-11 13:20:34'),(89,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHfrCGS8cCG0XB',NULL,NULL,'CRS_1744357839',NULL,NULL,NULL,'157.35.42.129',NULL,NULL,4,2025,'2025-04-11 13:20:39','2025-04-11 13:20:39'),(90,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHfrUC7U4VsD5Z',NULL,NULL,'CRS_1744357855',NULL,NULL,NULL,'157.35.42.129',NULL,NULL,4,2025,'2025-04-11 13:20:55','2025-04-11 13:20:56'),(91,26,10,NULL,'course',1799.00,1799.00,0.00,'INR','cash','completed','captured','ORD-67f8e09bd12eb','CASH-67f8e09dace03',NULL,'RCPT-CRS-1744363677',NULL,NULL,NULL,'49.47.129.63','Course: Laravel 12 and Mysql','2025-04-11 14:57:57',4,2025,'2025-04-11 14:57:57','2025-04-11 14:57:57'),(92,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHybRinl3O46fc',NULL,NULL,'CRS_1744423854',NULL,NULL,NULL,'152.56.153.118',NULL,NULL,4,2025,'2025-04-12 07:40:54','2025-04-12 07:40:56'),(93,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QHybaIG3DRVK1u',NULL,NULL,'CRS_1744423863',NULL,NULL,NULL,'152.56.153.118',NULL,NULL,4,2025,'2025-04-12 07:41:03','2025-04-12 07:41:03'),(94,67,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'completed','captured','order_QHybhuMuGBmQgy',NULL,NULL,'CRS_1744423870',NULL,'pay_QHyfB1miJBeWRP','d089f47bb35048aa7dc6be6a189601199e53e2c29d2d17d44663812eb886f254','152.56.153.118',NULL,'2025-04-12 07:45:24',4,2025,'2025-04-12 07:41:10','2025-04-12 07:45:24'),(95,63,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QHzF63ekVA0JH2',NULL,NULL,'CRS_1744426106',NULL,NULL,NULL,'223.176.62.114',NULL,NULL,4,2025,'2025-04-12 08:18:26','2025-04-12 08:18:28'),(96,24,10,NULL,'course',1799.00,1799.00,0.00,'INR','razorpay','initiated','pending','order_QHzFPenaQv4UiN',NULL,NULL,'COURSE_1744426125',NULL,NULL,NULL,'223.176.62.114',NULL,NULL,4,2025,'2025-04-12 08:18:46','2025-04-12 08:18:46'),(97,73,1,NULL,'course',1500.00,1500.00,0.00,'INR','razorpay','initiated','pending','order_QIU3UWBf7nb7Zf',NULL,NULL,'COURSE_1744534617',NULL,NULL,NULL,'49.207.195.168',NULL,NULL,4,2025,'2025-04-13 14:26:59','2025-04-13 14:26:59'),(98,42,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QIn0PqagPzI9ns',NULL,NULL,'CRS_1744601353',NULL,NULL,NULL,'152.59.169.52',NULL,NULL,4,2025,'2025-04-14 08:59:13','2025-04-14 08:59:15'),(99,42,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QIn0UfYnhw6b88',NULL,NULL,'CRS_1744601358',NULL,NULL,NULL,'152.59.169.52',NULL,NULL,4,2025,'2025-04-14 08:59:18','2025-04-14 08:59:19'),(100,42,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QIn0c7NJX9iOAo',NULL,NULL,'CRS_1744601365',NULL,NULL,NULL,'152.59.169.52',NULL,NULL,4,2025,'2025-04-14 08:59:25','2025-04-14 08:59:26'),(101,42,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QIn0xljwrccXIP',NULL,NULL,'CRS_1744601385',NULL,NULL,NULL,'152.59.169.52',NULL,NULL,4,2025,'2025-04-14 08:59:45','2025-04-14 08:59:46'),(102,42,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'completed','captured','order_QIn23jwmHMvhDR',NULL,NULL,'CRS_1744601447',NULL,'pay_QIn2TMt98KCU81','bab13ab031275056ad0b2fa18fbf0f75672970858037a04e67405e401b7d430c','152.59.169.52',NULL,'2025-04-14 09:01:41',4,2025,'2025-04-14 09:00:47','2025-04-14 09:01:41'),(103,69,10,NULL,'course',1799.00,1799.00,0.00,'INR','cash','completed','captured','ORD-67fcde26a766c','CASH-67fcde2a62b3f',NULL,'RCPT-CRS-1744625194',NULL,NULL,NULL,'49.47.129.188','Course: Laravel 12 and Mysql','2025-04-14 15:36:34',4,2025,'2025-04-14 15:36:34','2025-04-14 15:36:34'),(104,24,10,NULL,'course',1799.00,1799.00,0.00,'INR','cash','completed','captured','ORD-67fcde4e0778a','CASH-67fcde4fd33fd',NULL,'RCPT-CRS-1744625231',NULL,NULL,NULL,'49.47.129.188','Course: Laravel 12 and Mysql','2025-04-14 15:37:11',4,2025,'2025-04-14 15:37:11','2025-04-14 15:37:11'),(105,63,10,NULL,'course',1799.00,1799.00,0.00,'INR','cash','completed','captured','ORD-67fcde8134ec6','CASH-67fcde84512e0',NULL,'RCPT-CRS-1744625284',NULL,NULL,NULL,'49.47.129.188','Course: Laravel 12 and Mysql','2025-04-14 15:38:04',4,2025,'2025-04-14 15:38:04','2025-04-14 15:38:04'),(106,26,2,NULL,'course',1100.00,1100.00,0.00,'INR','razorpay','initiated','pending','order_QIxQ6Rhva5jgqn',NULL,NULL,'COURSE_1744638028',NULL,NULL,NULL,'106.221.42.101',NULL,NULL,4,2025,'2025-04-14 19:10:30','2025-04-14 19:10:30'),(108,27,4,NULL,'course',1099.00,1099.00,0.00,'INR',NULL,'initiated','pending','order_QJcndfgBEdiNtt',NULL,NULL,'CRS_1744783751',NULL,NULL,NULL,'106.76.248.36',NULL,NULL,4,2025,'2025-04-16 11:39:11','2025-04-16 11:39:13'),(109,27,4,NULL,'course',1099.00,1099.00,0.00,'INR',NULL,'initiated','pending','order_QJcnjOHum5dq4q',NULL,NULL,'CRS_1744783757',NULL,NULL,NULL,'106.76.248.36',NULL,NULL,4,2025,'2025-04-16 11:39:17','2025-04-16 11:39:18'),(110,27,2,NULL,'course',1100.00,1100.00,0.00,'INR',NULL,'initiated','pending','order_QJcnuNTMfHf9H1',NULL,NULL,'CRS_1744783767',NULL,NULL,NULL,'106.76.248.36',NULL,NULL,4,2025,'2025-04-16 11:39:27','2025-04-16 11:39:28'),(111,27,2,NULL,'course',1100.00,1100.00,0.00,'INR',NULL,'initiated','pending','order_QJcnycVbOase2r',NULL,NULL,'CRS_1744783771',NULL,NULL,NULL,'106.76.248.36',NULL,NULL,4,2025,'2025-04-16 11:39:31','2025-04-16 11:39:32'),(112,13,NULL,NULL,'subscription',899.00,899.00,0.00,'INR','cash','completed','captured','ORD-67ff4dc8a46fd','CASH-67ff4dc8a4062',NULL,'RCPT-SUB-1744784840',NULL,NULL,NULL,'49.47.129.218','Subscription Plan: 1-Month Plan','2025-04-16 11:57:20',4,2025,'2025-04-16 11:57:20','2025-04-16 11:57:20'),(113,13,8,NULL,'course',1500.00,1500.00,0.00,'INR','cash','completed','captured','ORD-67ff4dd6928b7','CASH-67ff4dd878138',NULL,'RCPT-CRS-1744784856',NULL,NULL,NULL,'49.47.129.218','Course: C Programming Online Live class','2025-04-16 11:57:36',4,2025,'2025-04-16 11:57:36','2025-04-16 11:57:36'),(116,26,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67ff7bbb29105','CASH-67ff7bbdbae8a',NULL,'RCPT-CRS-1744796605',NULL,NULL,NULL,'49.47.129.218','Course: C Programming language','2025-04-16 15:13:25',4,2025,'2025-04-16 15:13:25','2025-04-16 15:13:25'),(118,78,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QK572l6HvSQAnL',NULL,NULL,'COURSE_1744883459',NULL,NULL,NULL,'152.59.147.45',NULL,NULL,4,2025,'2025-04-17 15:21:00','2025-04-17 15:21:00'),(119,20,NULL,NULL,'subscription',899.00,899.00,0.00,'INR',NULL,'initiated','pending','order_QK7UR4c4LRATra',NULL,NULL,'SUB_1744891831',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-17 17:40:31','2025-04-17 17:40:32'),(120,21,1,NULL,'course',1500.00,1500.00,0.00,'INR','razorpay','initiated','pending','order_QKAJnOl3h4akge',NULL,NULL,'COURSE_1744901791',NULL,NULL,NULL,'223.237.131.120',NULL,NULL,4,2025,'2025-04-17 20:26:33','2025-04-17 20:26:33'),(121,20,12,NULL,'course',1999.00,1999.00,0.00,'INR',NULL,'initiated','pending','order_QKNXF4xmYEX5Z3',NULL,NULL,'CRS_1744948336',NULL,NULL,NULL,'49.47.129.86',NULL,NULL,4,2025,'2025-04-18 09:22:16','2025-04-18 09:22:17'),(122,79,6,NULL,'course',1999.00,1999.00,0.00,'INR',NULL,'initiated','pending','order_QKULPSNAfB51Sz',NULL,NULL,'CRS_1744972315',NULL,NULL,NULL,'27.61.119.24',NULL,NULL,4,2025,'2025-04-18 16:01:55','2025-04-18 16:01:56'),(123,79,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QKUv8R0upNl0DC',NULL,NULL,'COURSE_1744974344',NULL,NULL,NULL,'27.61.119.24',NULL,NULL,4,2025,'2025-04-18 16:35:46','2025-04-18 16:35:46'),(124,47,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-68023d954531e','CASH-68023d97211a0',NULL,'RCPT-CRS-1744977303',NULL,NULL,NULL,'49.47.129.86','Course: C Programming language','2025-04-18 17:25:03',4,2025,'2025-04-18 17:25:03','2025-04-18 17:25:03'),(125,17,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-68023dc70fc58','CASH-68023dc9719fe',NULL,'RCPT-CRS-1744977353',NULL,NULL,NULL,'49.47.129.86','Course: C Programming language','2025-04-18 17:25:53',4,2025,'2025-04-18 17:25:53','2025-04-18 17:25:53'),(126,76,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-68023e9a70f7f','CASH-68023e9d33b11',NULL,'RCPT-CRS-1744977565',NULL,NULL,NULL,'49.47.129.86','Course: C Programming language','2025-04-18 17:29:25',4,2025,'2025-04-18 17:29:25','2025-04-18 17:29:25'),(127,41,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-68023eea49017','CASH-68023eebd4c63',NULL,'RCPT-CRS-1744977643',NULL,NULL,NULL,'49.47.129.86','Course: C Programming language','2025-04-18 17:30:43',4,2025,'2025-04-18 17:30:43','2025-04-18 17:30:43'),(128,46,6,NULL,'course',1999.00,0.00,0.00,'INR','cash','completed','captured','ORD-6802414564f76','CASH-68024149268d5',NULL,'RCPT-CRS-1744978249',NULL,NULL,NULL,'49.47.129.86','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-18 17:40:49',4,2025,'2025-04-18 17:40:49','2025-04-18 17:40:49'),(129,20,NULL,NULL,'subscription',899.00,899.00,0.00,'INR',NULL,'completed','captured','order_QKrbyqYM3S1I5K','pay_QKrcyF0VafVg3O','pay_QKrcyF0VafVg3O','SUB_1745054253',NULL,NULL,NULL,NULL,NULL,'2025-04-19 14:48:58',4,2025,'2025-04-19 14:47:33','2025-04-19 14:48:58'),(130,21,NULL,NULL,'subscription',899.00,899.00,0.00,'INR',NULL,'initiated','pending','order_QLacjkHYoL5POZ',NULL,NULL,'SUB_1745212769',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-21 10:49:29','2025-04-21 10:49:30'),(131,51,10,NULL,'course',1799.00,1799.00,0.00,'INR','cash','completed','captured','ORD-68061485e8a1d','CASH-6806148a4c6e1',NULL,'RCPT-CRS-1745228938',NULL,NULL,NULL,'152.58.188.189','Course: Laravel 12 and Mysql','2025-04-21 15:18:58',4,2025,'2025-04-21 15:18:58','2025-04-21 15:18:58'),(132,78,6,NULL,'course',1999.00,1999.00,0.00,'INR',NULL,'initiated','pending','order_QLjXoaOYSnVjbJ',NULL,NULL,'CRS_1745244184',NULL,NULL,NULL,'152.59.144.79',NULL,NULL,4,2025,'2025-04-21 19:33:04','2025-04-21 19:33:05'),(133,78,6,NULL,'course',1999.00,1999.00,0.00,'INR',NULL,'initiated','pending','order_QLjXv7vBKIn7mt',NULL,NULL,'CRS_1745244191',NULL,NULL,NULL,'152.59.144.79',NULL,NULL,4,2025,'2025-04-21 19:33:11','2025-04-21 19:33:11'),(134,78,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','completed','captured','order_QLjZ1vRKmFpYpZ',NULL,NULL,'COURSE_1745244254','order_QLjZ1vRKmFpYpZ','pay_QLjcE3y57gB9Mz','03ee71d6929fc8fb4dd18558564f60cefc02e5e05e707fbcd940938cfcd18776','152.59.144.79',NULL,'2025-04-21 19:37:46',4,2025,'2025-04-21 19:34:15','2025-04-21 19:37:46');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placed_students`
--

DROP TABLE IF EXISTS `placed_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `placed_students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placed_students`
--

LOCK TABLES `placed_students` WRITE;
/*!40000 ALTER TABLE `placed_students` DISABLE KEYS */;
INSERT INTO `placed_students` VALUES (1,'Raj Shekhar','Raj Sekhar is the founder of MyPages Inc. and MyIndex Inc., leading innovative digital solutions. With a strong entrepreneurial vision, he has been shaping the tech landscape since 2016','placedstudent/iWMC19WKFTlPDWaWcMQjlAr2svPjltr8vIlr1CE5.webp','Founder @myindex Inc',1,'2025-02-04 05:30:41','2025-02-04 05:30:57'),(2,'Piyush Kumar','Piyush Kumar is a Senior Executive at SAMSUNG SDS with over 2 years of experience, specializing in SAP ABAP. Prior to his current role, he was a software intern at SAMSUNG SDS, where he worked with Core Java and Spring Boot.','placedstudent/qJd1exoAQfDeAJmqjghswYBBFeISO3DbUwAsvuAQ.webp','Senior Executive Engineer',1,'2025-02-04 05:34:00','2025-02-04 05:34:10'),(3,'Rajat Bhalotia','He is a Software Engineer at Optum Global Solutions, with expertise in Java and SpringBoot. He has experience in migrating APIs to microservices and enhancing backend data flow.','placedstudent/jH5WFQPQnO2yFfoyD69nOSpnfSL4761cQAhpMdte.webp','Associate Software Engineer II',1,'2025-02-04 05:36:41','2025-02-04 05:36:46'),(4,'Bhanu Bhashkar','He is an Information Technology Analyst at Tata Consultancy Services, specializing in software development and system migration. He has successfully led and supported multiple projects, including a messaging system migration to the cloud, and earned multiple recognitions for his contributions.','placedstudent/4bLwqnceUHfr45d0z2t97hx8ihq2Bt2ZwC1rinbE.webp','Information Technology Analyst',1,'2025-02-04 05:39:23','2025-02-04 05:39:29'),(5,'Ritu Raj','Ritu Raj is a Senior Technical Consultant at EY, with expertise in Cloud, Azure, and AI. He has over 5 years of experience, including roles at PEOL Technologies and EY, where he has contributed to technical consulting and SAP solutions.','placedstudent/cKFwNBJzb5mQTMu8Ln2UthxjUbMDaMe39bEeoVKg.webp','Senior Technical Consultant',1,'2025-02-04 05:46:28','2025-02-04 05:46:34'),(6,'Shubham Kumar','Shubham Kumar is a Senior System Engineer at Infosys and a Data Engineer for HSBC. He specializes in Data Pipelines, SQL, PySpark, Hadoop, Hive, Git, ETL, and has expertise in Big Data Development, Data Warehousing, and Agile Methodology.','placedstudent/C3Az4ZnWbzQAxnokOZdjAGpTB0PFOtsCXwSkOaX5.webp','Senior System Engineer',1,'2025-02-04 05:48:06','2025-02-04 05:48:09'),(7,'Tasneem Kausar','Tasneem Kausar is currently working as a Frontend Developer (Intern) at Keen & Able Computers Pvt Ltd in Noida, Uttar Pradesh, India, since September 2022. Her skills include Front-End Development, HTML5, and several others.','placedstudent/LaMKILRGAdBTPzZatb63z1Hb5XZ59zFl11y3JGEZ.webp','Frontend Developer',1,'2025-02-04 05:50:02','2025-02-04 05:50:21'),(8,'Pratik Sah','Pratik Sah is currently working as a Senior Software Engineer - Product at Razorpay in Bengaluru, Karnataka, India, since January 2024. His previous roles include Senior Software Engineer at Altysys, Solutions Engineer at Deqode India, and Node.js Developer at Codebucket Solutions. He has expertise in backend development, with skills in Next.js, Amazon ECS, RabbitMQ, Socket.io, Cloud Firestore, and several others.','placedstudent/R7GkgDfZNBImSEjV8MyjJ6vIVR6whm4ZHItaVO19.webp','Senior Software Engineer @Razorpay',1,'2025-02-04 05:51:44','2025-02-04 05:51:50'),(9,'Ayush Kumar','Ayush Kumar is currently a Solutions Developer at Tata Technologies in Pune, Maharashtra, India, since September 2022. Before this, he worked as a Software Engineer at TecHealerz Solutions, a Teaching Professional at TechVidya, and a Web Developer at Eventilators Private Limited. His expertise includes scripting, programming, and he has experience in both front-end and back-end development, working on multiple websites. Additionally, he has worked in Python and Data Analytics during his time at TechVidya.','placedstudent/iOjahehiGK7ZRA1oO6xM2IWx2mocbpBAacmvAkK2.webp','Solutions Developer @ Tata Technologies',1,'2025-02-04 05:53:13','2025-02-04 05:53:17'),(10,'Gautam Kumar','Gautam Kumar is a Frontend Software Development Engineer at K12 Techno Services Pvt. Ltd. in Kolkata, specializing in React.js, Redux.js, and AWS S3 integration. He has previously worked at MoodBridge Wellness and WIFT Cap Solutions, focusing on data visualization and file upload systems. Gautam also has experience as a Software Engineer at JagritiDigiedutech Pvt Ltd.','placedstudent/fnRe79tmnLTJiNbcpYuJpertJurZHj1QFpWNw9K3.png','Frontend Software Engineer @ K12 Techno Services Pvt Ltd',1,'2025-02-04 05:55:39','2025-03-27 03:42:35'),(11,'Vikas Kumar','Vikas Kumar is currently working as a Software Engineer at PhonePe in Bengaluru, specializing in Python, Airflow, and other related technologies. Previously, he worked at UrbanPiper as a Software Engineer with expertise in Python and Django. Vikas has also been a Python Developer and Node.js Developer at Codebucket Solutions and interned as a Django Developer at PythonMate.','placedstudent/5TyZzRBshk1AJYBuUOh67O27zoAT3qXIH8PgZOj8.webp','Software Engineer @ PhonePe',1,'2025-02-04 05:57:43','2025-02-04 05:57:47'),(12,'Md Danish Alam','Md Danish Alam is currently a Software Engineer at MapmyIndia in New Delhi, specializing in jQuery, MongoDB, and other related technologies. He previously worked at HD Labs in Hyderabad, focusing on MySQLi and Laravel, and also worked at MapmyIndia in Ranchi, where he gained experience in HTML5, PHP, and additional skills.','placedstudent/49JzylCdozx4VU01NZhQEFk7rEPZQdjwcCZokviu.webp','Software Engineer @ MapmyIndia',1,'2025-02-04 05:59:13','2025-02-04 06:00:43'),(13,'Kamana Kumari','Kamana Kumari is currently a Software Engineer II at JPMorgan Chase in Bengaluru. Before joining JPMorgan Chase, she worked at UrbanPiper for over two years, contributing to backend services, optimizing APIs, and resolving airflow-related issues. Kamana has also worked as a Python Developer at Hyperreality Technologies, where she developed backend solutions and worked with technologies like Python, Node.js, Airflow, and React, and started as a Graduate Student Intern at UIPRO Corporation, specializing in Laravel and MySQL.','placedstudent/Zm3JZu4eWGFQiEF1RTBGdzUfGWlfprObczdQ2fS7.webp','Software Engineer II @ JPMorgan Chase',1,'2025-02-04 06:00:31','2025-02-04 06:00:45'),(14,'Dhritesh Kumar','Dhritesh Kumar is a Full Stack Engineer at Eqaim Technology & Services, with experience in developing web and mobile applications using Next.js, React Native, and MERN stack. He has worked on projects like a spiritual web app and bank app development during his internships at Infoogy, ManTech Studio, and Codefeast.','placedstudent/oMLuHhZp0lri8JTIg79tlxeJZlopypnjA9wIwi2h.webp','Full Stack Engineer @ Eqaim Technology & Services',1,'2025-02-04 06:02:30','2025-02-04 06:03:52'),(15,'Priyanshu Choudhary','Priyanshu Choudhary is a Full Stack Developer at Codetower Web Development & Services, with 5+ years of experience in Python, Responsive Web Design, and web technologies. He has previously worked as a Back End Developer at Codetower Web Application and a Frontend Developer at Code with SadiQ.','placedstudent/CR8WEQS9609udKiba6wUjOvppmcznaFmYgbjAkEW.webp','Full Stack Developer @ Codetower',1,'2025-02-04 06:03:46','2025-02-04 06:03:55'),(16,'Rishiraj Aman','Rishiraj Aman is a Senior Software Engineer at Persistent Systems, specializing in Azure Integration with 5 Azure certifications. He has experience with Azure Logic Apps, Functions, and DevOps. Previously, he worked at Capgemini and Enseur Digital, focusing on .NET and Laravel technologies.','placedstudent/SH7bBMMRlvFwFMkJEMdZzzvbJHrmzARXgTMPwjX2.webp','Senior Software Engineer @ Persistent Systems',1,'2025-02-04 06:05:05','2025-02-04 06:08:06'),(18,'Suraj Bhagat','Suraj Bhagat is a Python Django Developer at Great Future Technology Pvt. Ltd. with expertise in Django, REST APIs, and databases. He has experience in both back-end and front-end development, including JWT authentication and payment gateways.','placedstudent/QAvIWMH0f5Q2AvlzAOKcgzTVHSQtiIofDHJPXgY8.webp','Python Django Developer @ Great Future Technology Pvt. Ltd.',1,'2025-02-04 06:06:49','2025-02-04 06:08:18'),(19,'Jayant Raj','Jayant Raj is a Backend Developer at Headstart, currently working as an SDE-2. He has a background in Python, Django, and PostgreSQL, with internship experiences at Wobot.ai, NamaSYS, and Avogadro IT Solutions. He specializes in FastAPI, Django REST Framework, and Django Channels.','placedstudent/gurwGQgm3ji4OcWTxQyKobbCMWC0bOyoJylJWs8j.webp','Backend Developer @ Headstart',1,'2025-02-04 06:08:01','2025-02-04 06:08:15'),(20,'Jay Kumar Bharti','Jay Kumar Bharti is a Full Stack Developer at TechQware with 3+ years of experience in Python, React.js, Django, and REST APIs. He previously worked at EnR Consultancy Services and Bluespacelabs.','placedstudent/qya2F86jaDLF3ap052RGFyXu6W6D8YIZtNLa1zeL.webp','Full Stack Developer @ TechQware',1,'2025-02-04 06:09:49','2025-02-04 06:38:37'),(21,'Akhilesh Kumar','Akhilesh Kumar is a Software Developer at Swipewire Technologies with experience in full-stack development. He previously worked at Bunk Infotech Pvt. Ltd., specializing in Laravel and Node.js. He is passionate about learning new technologies and contributing to organizational growth.','placedstudent/y2oBS7Xblyib9RVRoGC0fRt1yYYkQoD5NiyxS9Fn.webp','Software Developer @ Swipewire Technologies',1,'2025-02-04 06:11:03','2025-02-04 06:39:16'),(22,'Md Faiyyaj Alam','Md Faiyyaj Alam is a Web Developer at Pemlix Technology Solutions Pvt. Ltd., with expertise in PHP, Laravel, MySQL, JavaScript, WordPress, and Asterisk. He holds an MCA degree from Dr. A.P.J. Abdul Kalam Technical University and has worked on various web development projects. He has also gained experience through internships at Uipropitome Tech and UIPRO Corporation Pvt. Ltd. His skills include back-end web development and database management systems (DBMS).','placedstudent/aE5vnQJV3GVHLKvZaJX0tFxq1oqdIi7DC8rZCsSa.webp','Web Developer @ Pemlix Technology Solutions Pvt. Ltd',1,'2025-02-04 06:13:26','2025-02-04 06:39:13'),(23,'Manas Das','Manas Das is a Full Stack Developer with 3 years of experience in PHP, Laravel, JavaScript, HTML, CSS, Vue.js, and Socket.io. He has worked at Nyusoft Solutions, DEVLOC Studio, and Innovative Knowledge Software Solution, focusing on scalable web applications. Manas is passionate about problem-solving and staying updated with industry trends.','placedstudent/S8g3KFg9J7WlbL1T6zhGXXPD1Y90Zt3lI5f1A97W.webp','Full Stack Developer @  Nyusoft Solutions',1,'2025-02-04 06:14:59','2025-02-04 06:39:09'),(24,'Jatin Choudhary','Jatin Choudhary is a Senior Software Engineer at Quantum IT Innovation skilled in React.js, Node.js, AI, and MongoDB. He works at NewU, focusing on health tech, and has experience at Vujis, Ionio, specializing in Full Stack Development and MERN Stack.','placedstudent/BadjVDCQgUPetBCSkovGZDQhN8iDprH53JVGirNu.webp','Senior Software Engineer @ Quantum IT Innovation',1,'2025-02-04 06:17:12','2025-02-04 06:39:05'),(25,'Pramod Kumar Pandit','Pramod Kumar Pandit is a Ruby on Rails developer with 3 years of experience in backend development, RESTful APIs, and database optimization. He currently works at NetConnectGlobal and has previously worked at AspireEdge Solutions and Chetu, Inc.','placedstudent/Gs8Oegn4Oy6wI5XwkdxEih8kDLeZrJvBznq4V5if.webp','Ruby on Rails @ NetConnectGlobal',1,'2025-02-04 06:18:38','2025-02-04 06:39:01'),(26,'Amit Kumar Jha','Amit Kumar Jha is a rising Laravel developer with experience in HTML, CSS, JavaScript, PHP, MySQL, and Amazon S3. He currently works at RADIANT and previously worked at Webstiffy Technology Pvt Ltd and Auxous Network Pvt Ltd. He specializes in web development, backend programming, and deploying scalable applications.','placedstudent/2jLuq2H3aXFOKF18IlXf5lGvp8XFvZghaec8OnCZ.webp','Laravel developer @ RADIANT',1,'2025-02-04 06:20:11','2025-02-04 06:38:57'),(27,'Uttsav Kumar','Uttsav Kumar is a Full-stack Developer at Srchout Software, currently specializing in Laravel, React, and React Native. He previously interned at Srchout Software and CodingBhasha, where he gained experience in JavaScript, Livewire, and other web technologies.','placedstudent/MxsRsmBLXmkQUdZ04wW8vNm5ueoe7NZQh27b4Ccg.webp','Full-stack Developer @ Srchout Software',1,'2025-02-04 06:21:07','2025-02-04 06:38:54'),(28,'Ajit Kumar','Ajit Kumar is a PHP & Laravel Developer at AKS WebSoft Consulting Pvt. Ltd. He has previously worked at Bridge2Business, Dousoft IT Solution, and GameApp Tech. His skills include HTML, AJAX, API Development, and Laravel.','placedstudent/592BJeGoqFoguoTqDyKC9WwhB90lQmiRMyb4EsSc.webp','Laravel Developer @ AKS WebSoft Consulting Pvt. Ltd',1,'2025-02-04 06:31:53','2025-02-04 06:38:51'),(29,'Yash Raj','Yash Raj is a MERN Developer at Arramton Infotech Pvt. Ltd. since November 2022. He has also worked as a Back End Developer at MetroGhar during an internship. His skills include Node.js, MongoDB, and other related technologies.','placedstudent/ZghWpb0lZzEVnLzxTZVodIaUJocJLR19YHsrQg1W.webp','MERN Developer @ Arramton Infotech Pvt. Ltd',1,'2025-02-04 06:33:48','2025-02-04 06:38:47'),(30,'Kartik Swarnkar','Kartik Swarnkar, a Senior Software Engineer with expertise in Node.js, React, Python, AWS, Typescript, Harness, Docker, and more. His recent experiences include working at Ascendion and Collabera Digital, where he developed infrastructure automation solutions, integrated cloud services like AWS, and worked on various projects ranging from cryptocurrency exchanges to e-commerce platforms.','placedstudent/oCQfw5o04CP17T1EEkMU7CmuJUCYVqqyXlZwtdNh.webp','Senior Software Engineer @ Ascendion',1,'2025-02-04 06:36:31','2025-02-04 06:38:43'),(31,'Wasim Reza','Wasim Reza is a skilled Backend Developer with expertise in Node.js, having worked for over 3 years at Daily Doc Technology. He excels in building and maintaining scalable backend systems to support dynamic applications.','placedstudent/9LNJHYtBygTz8cWzkLP48k4XQLoybB6V4CM9CcxB.webp','Backend Developer @  Daily Doc Technology',1,'2025-02-04 06:38:10','2025-02-04 06:38:41'),(32,'Siddharth Singh','Siddharth Singh is currently working as a Data Analyst with Python at Main Flow Services and Technologies Pvt. Ltd. With a strong foundation in web development technologies and a passion for learning, he brings valuable skills in JavaScript, React, Node.js, and Python to his projects.','placedstudent/DZGnIAJ7XxmlGmKp0CWrJSYgYsKLmFtP1IMzjwRz.webp','Data Analyst @ Main Flow Services and Technologies Pvt. Ltd.',1,'2025-02-04 06:43:10','2025-02-04 06:43:18'),(33,'Muskan Naaz','Muskan Naaz is an experienced Automation Test Engineer with over 4 years of expertise in designing and executing automated test scripts in banking and e-commerce. She currently works at Hollard Insurance, proficient in tools like Selenium WebDriver, TestNG, and Jira, with a strong background in Agile methodologies.','placedstudent/klpzohCNYqCPO5kvnnuyVfjjXZFqEzcgcSbtzNqB.webp','Automation Test Engineer @ Hollard Insurance',1,'2025-02-04 06:44:42','2025-02-04 06:53:36'),(34,'Sanjiv Kumar','Sanjiv Kumar is a passionate Full Stack Developer with a strong interest in cutting-edge technologies. He has experience in Django and Python, having worked as a Software Developer at eTechCube and completed an internship at UIPRO Corporation Pvt. Ltd.','placedstudent/wVHPwayGTGorZbK5RQNbp975JONSHOMQBVejshha.webp','Full Stack Developer @ eTechCube',1,'2025-02-04 06:50:48','2025-02-04 06:53:43'),(35,'Sweta Kumari','Sweta Kumari is a System Engineer at Tata Consultancy Services with a keen interest in Data Analysis, Blockchain, Cloud Computing, and Machine Learning. She has also contributed to various roles, including volunteering with UNICEF and interning with Accenture and OgmaTechLab.','placedstudent/PjwgIBqnTJde2S81qVqoqdXK1drpSNIAV7DRhZBW.webp','System Engineer @ Tata Consultancy Services',1,'2025-02-04 06:53:30','2025-02-04 06:53:40'),(36,'Saumy Anand','Saumy Anand is a Fullstack Developer with expertise in Laravel, Next.js, and system design, currently working remotely at SoftArt It Hub. He also interned at Comestro Techlabs Pvt Ltd, honing his skills in React, Livewire, and full stack development.','placedstudent/chZF2ywfPqi6oe332E4mPQ4YgvwoEhK1igbv7HTw.webp','Fullstack Developer @ SoftArt It Hub',1,'2025-02-04 06:56:48','2025-02-04 07:00:49'),(37,'Pushpesh Pujan','Pushpesh Pujan is a certified Workday Senior Specialist at Strada, with prior experience as a Workday Specialist at Alight Solutions and internships at Simpsoft Solutions and Optimasedge LLP.','placedstudent/8MdO2yA4iBQ6V8snJV7giRRWZgTNcarQdtCD3HUc.webp','Workday Senior Specialist @ Strada',1,'2025-02-04 07:00:33','2025-02-04 07:00:52'),(38,'Divya Suman','Divya Suman is an Associate System Engineer at IBM, specializing in ETL and API testing. She is ISTQB certified and has over a year of experience with IBM.','placedstudent/2XL47672M692bIpmjA6vEukVDajcvPoih8kWWmDW.webp','Associate System Engineer @ IBM',1,'2025-02-04 07:03:19','2025-02-04 08:07:22'),(39,'Manisha kumari','Manisha Kumari Currently working in Virtusa Consulting Services Private Limited, Bangalore as  Senior Software Engineer in JAVA. Mostly I am working on JAVA, SQL. As of now I am working for banking domain project JPMC (J.P.Morgan chase bank) .','placedstudent/Edt7Ua7Y4f052jwbXxON71qNqb6wfIN1SoJNhj2q.webp','Senior Software Engineer @ Virtusa Consulting Services Private Limited',1,'2025-02-04 14:47:25','2025-02-04 14:47:34'),(40,'Shivam Anand','Shivam Anand is a skilled Full-stack Developer at Bloom IT Solutions, proficient in technologies like Sequelize, Node.js, and MERN stack. Previously, he honed his frontend development skills during a 3-month internship at Brainwaves Learning Library, working with React.js and Tailwind CSS.','placedstudent/zZIxBtFHlZYp8iGq53KjL8ZpRoI6jHzRQyMF7A1l.webp','Full-stack Developer @ Bloom IT Solutions',1,'2025-02-04 14:57:26','2025-02-04 15:16:57'),(41,'Sominto Kumar','Sominto Kumar is a passionate Software Developer at Helios Tech Labs, specializing in frontend development with expertise in JavaScript, ReactJS, and Tailwind CSS. With prior experience as a Web Developer intern at CodSoft and Bharat Intern, he brings strong technical skills and a dedication to continuous learning in the ever-evolving tech industry.','placedstudent/UZHTC2PQIbf6ZQkd6NgSa55rUEwc9kAnJcehjZ3g.webp','Software Developer @ Helios Tech Labs',1,'2025-02-04 15:00:24','2025-02-04 15:17:01'),(42,'Roni Saha','Roni Saha is a skilled software developer with expertise in Laravel, React.js, Next.js, and Tailwind CSS. Currently working at Leonlogic (Remote) and Comestro Techlabs, he has a strong background in backend and full-stack development through roles at AryaGo, Analysed.in, and others. Roni is passionate about learning, creativity, and delivering impactful solutions.','placedstudent/InzFTkXCIU5CNLIEWDAH71XIMIZiW5z3USpwBnDq.webp','software developer @ Leonlogic',1,'2025-02-04 15:03:28','2025-02-04 15:16:53'),(43,'Ravi Kumar','Ravi Kumar is a skilled Frontend Developer at Kaash Light Engineers, specializing in React.js, TypeScript, and Node.js. He creates responsive user interfaces with modern frameworks like Tailwind CSS and ensures smooth, engaging user experiences. Dedicated to continuous learning and clean coding, Ravi has prior experience as a Full Stack Developer at AltCampus.','placedstudent/Cl5MLJU3Kk3jrfWEa7vLlHT4lUEOkLDXbOGtYzoB.webp','Frontend Developer @ Kaash Light Engineers',1,'2025-02-04 15:04:54','2025-02-04 15:16:50'),(44,'Priyanka Das','Priyanka Das, Associate Software Engineer at Mphasis, is a skilled Full-Stack Developer with 2+ years of experience in Java, Spring Boot, React.js, AngularJS, and SQL. With 550+ problems solved on GFG and LeetCode, she holds an MCA and specializes in scalable web applications.','placedstudent/ZcJP6NWVyErhKS2hSiNyl43OMIrFDeobh47sXZQA.webp','Associate Software Engineer @ Mphasis',1,'2025-02-04 15:06:15','2025-02-04 15:16:46'),(45,'Amrit Utsav','Amrit Utsav, an MCA student at NIT Raipur (AIR 658, NIMCET \'24), is a proficient Full-Stack Developer specializing in scalable digital solutions using React, Django, FastAPI, and more. With internships at GrowMeOrganic and TEJ, he has gained expertise in building dynamic web apps, developing reusable components, integrating APIs, and optimizing performance.','placedstudent/3CEGVT5qxSSPVoveOh71G44zGgAdVpO1tOWsGOmk.webp','MCA student @ NIT Raipur (AIR 658, NIMCET \'24)',1,'2025-02-04 15:08:25','2025-02-04 15:16:43'),(46,'Gunjan Kumar','Gunjan Kumar is a Data Engineer at Tata Consultancy Services with over three years of experience, specializing in machine learning and working with foreign clients like Citi Bank. He has also gained experience as a Teaching Assistant at Coding Ninjas and a Frontend Developer at Triunits Infotech.','placedstudent/QPaqRlppwlHb08KAUIuDnHUfRvz98G9vzQKhZXiV.webp','Data Engineer @ Tata Consultancy Services',1,'2025-02-04 15:10:08','2025-02-04 15:16:40'),(47,'Vishal Kumar','Vishal Kumar is a Full Stack Developer with 3+ years of experience, specializing in frontend technologies like Angular, React, JavaScript, and TypeScript, while also skilled in Java, Spring Boot, and microservices. Currently working as an SDE 1 Frontend at JobTwine, he has a proven track record of improving user engagement and delivering high-quality web applications.','placedstudent/s17uYYUtp5xcUzIeiFdPNMqw5HnXCQGBjmTcxNih.webp','SDE1 @ JobTwine',1,'2025-02-04 15:12:59','2025-02-04 15:16:36'),(48,'Neeraj Kumar','Neeraj Kumar is a skilled Full Stack Engineer with over 5 years of experience, specializing in JavaScript, Blockchain, and Cloud technologies. He has worked with diverse industries like Blockchain, Finance, and Healthcare, and is passionate about building scalable applications and contributing to global teams.','placedstudent/8j5kJhrLm4e2w1EaHW7juamoqVTC2Zbnfv0MmVqF.webp','Product Development Engineer @ ResMed',1,'2025-02-04 15:16:16','2025-02-04 15:16:31'),(49,'Raja Kumar','Raja Kumar is a Software Engineer at PharynxAI, specializing in React.js, Tailwind CSS, and building innovative interfaces like chatbots and posture recognition systems. He is passionate about creating scalable and responsive applications.','placedstudent/JYZy3aSg2pYUWt3cMx1roZM74ydQAKRuXvp8eScq.webp','Software Engineer @ PharynxAI,',1,'2025-02-04 15:22:40','2025-02-04 15:22:51');
/*!40000 ALTER TABLE `placed_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_chapters`
--

DROP TABLE IF EXISTS `post_chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_chapters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_course_id` bigint unsigned NOT NULL,
  `chapter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_description` text COLLATE utf8mb4_unicode_ci,
  `chapter_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_chapters_chapter_slug_unique` (`chapter_slug`),
  KEY `post_chapters_post_course_id_foreign` (`post_course_id`),
  CONSTRAINT `post_chapters_post_course_id_foreign` FOREIGN KEY (`post_course_id`) REFERENCES `post_courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_chapters`
--

LOCK TABLES `post_chapters` WRITE;
/*!40000 ALTER TABLE `post_chapters` DISABLE KEYS */;
INSERT INTO `post_chapters` VALUES (1,1,'Introduction & Setup:','Learn about Python\'s history, philosophy, and its widespread use across various domains. Set up Python and your development environment for coding, testing, and debugging.','introduction-setup',1,'2025-04-11 22:38:00','2025-04-11 22:38:00');
/*!40000 ALTER TABLE `post_chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_courses`
--

DROP TABLE IF EXISTS `post_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `course_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_courses_course_slug_unique` (`course_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_courses`
--

LOCK TABLES `post_courses` WRITE;
/*!40000 ALTER TABLE `post_courses` DISABLE KEYS */;
INSERT INTO `post_courses` VALUES (1,'Python','Python is a high-level, easy-to-read, and versatile programming language used for web development, data analysis, automation, AI, and more.','courses/HjkVj9sRZc89e7XoQrJyx9TTxGOBDvKZz4LPuxHW.png',0,'python','2025-04-11 22:36:12','2025-04-11 22:39:59');
/*!40000 ALTER TABLE `post_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_my_posts`
--

DROP TABLE IF EXISTS `post_my_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_my_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_topic_post_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_my_posts_post_topic_post_id_foreign` (`post_topic_post_id`),
  CONSTRAINT `post_my_posts_post_topic_post_id_foreign` FOREIGN KEY (`post_topic_post_id`) REFERENCES `post_topic_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_my_posts`
--

LOCK TABLES `post_my_posts` WRITE;
/*!40000 ALTER TABLE `post_my_posts` DISABLE KEYS */;
INSERT INTO `post_my_posts` VALUES (1,1,'History and Philosophy of Python','Python’s journey began at Centrum Wiskunde & Informatica (CWI) in the Netherlands when Guido van Rossum sought to create a language that could overcome the complexities found in other programming languages. Drawing inspiration from the ABC language (an earlier teaching tool for beginners), Guido aimed to design a language that avoided the pitfalls of syntactic clutter while still delivering powerful functionality. This led to the creation of a language that, at its core, encouraged clean, readable, and maintainable code.\n',NULL,'2025-04-11 22:39:36','2025-04-11 22:39:36');
/*!40000 ALTER TABLE `post_my_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_topic_posts`
--

DROP TABLE IF EXISTS `post_topic_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_topic_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_chapter_id` bigint unsigned NOT NULL,
  `topic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int DEFAULT '0',
  `topic_description` text COLLATE utf8mb4_unicode_ci,
  `topic_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_topic_posts_topic_slug_unique` (`topic_slug`),
  KEY `post_topic_posts_post_chapter_id_foreign` (`post_chapter_id`),
  CONSTRAINT `post_topic_posts_post_chapter_id_foreign` FOREIGN KEY (`post_chapter_id`) REFERENCES `post_chapters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_topic_posts`
--

LOCK TABLES `post_topic_posts` WRITE;
/*!40000 ALTER TABLE `post_topic_posts` DISABLE KEYS */;
INSERT INTO `post_topic_posts` VALUES (1,1,'History and Philosophy of Python',1,NULL,'history-and-philosophy-of-python','2025-04-11 22:39:10','2025-04-11 22:39:10');
/*!40000 ALTER TABLE `post_topic_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `imageUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availableQuantity` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Fashion','fashion product',1,NULL,0,'2025-04-06 09:27:19','2025-04-06 09:27:19');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `points` int unsigned NOT NULL DEFAULT '0',
  `imageUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availableQuantity` int unsigned NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_product_category_id_foreign` (`product_category_id`),
  CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Premium \"Learn Syntax\" Round Neck T-Shirt – Redeemable with Gems','Level up your coding style with our Premium \"Learn Syntax\" Branded T-Shirt – a perfect blend of comfort, class, and community. Designed for true learners and tech enthusiasts, this high-quality round neck tee proudly sports the Learn Syntax logo, making it more than just apparel – it’s a statement.\n\nCrafted from 100% premium cotton, this t-shirt offers a soft-touch feel, durable stitching, and a tailored fit for all-day comfort. Whether you’re attending a coding session, hanging out with fellow developers, or just chilling at home, this shirt keeps you in the zone.\n\nFeatures:\n\nHigh-quality fabric with breathable comfort\n\nClassic round neck design\n\nDurable print of the Learn Syntax logo\n\nUnisex fit, ideal for everyday wear\n\nAvailable in multiple sizes\n\nRedeemable using your gems – because learning should reward you in style!\n\nNote: Limited edition for our Learn Syntax community. Redeem now and wear your code with pride!',2499,'products/YWDefN2BFdzkFx8pBIwXfmiTBKwboU5VGkcNJRFU.jpg',10,'active','premium-learn-syntax-round-neck-t-shirt-redeemable-with-gems','2025-04-06 09:28:15','2025-04-06 09:28:18');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` bigint unsigned NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` enum('option1','option2','option3','option4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `marks` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quizzes_exam_id_foreign` (`exam_id`),
  CONSTRAINT `quizzes_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2ZMzne1nea7wjalc99cJOCnioV1JUHpObTfPc6nh',NULL,'171.51.184.76','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieXZWcGZVZWZVQzBlaUkwcWFDSUpyek5pU0xrV1ZPN3UxVG1Na0hpOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1745290948),('4SKDsLrPeZI0JzVsJb0YllSwNaIEHbnUhRe29ZpI',NULL,'157.245.32.241','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUJOTjVRYlRWSmlpU3BBUVBSdFA2U0FhckdSa1FHMXJvenE3TFFLZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9jb3Vyc2VzL3ZibmV0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745285665),('7PGV8yS6CmuA0q1m3sDYEaFHYRRuVV3NYjoYmGPQ',NULL,'49.47.132.210','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiekEzOFVPTm9KazVKWDJUOVJnRm45emJleWExcEdoQWJKcnAxcEJiYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2F1dGgvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1745287440),('ALQB8R1bZWzYlGJCoP7S1WkdbFZpk4Pl4wD64uqV',NULL,'35.203.210.18','Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDUyS1RCTE5Ed1FXWjlvRHM5OG5ZOGxtSE82R24wR0dmTGtGejdPRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vNjkuNjIuMTIyLjQwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745297818),('aQ6OPjXZSRt3VlAtq2wErxb5DtOLfu9ci1PYe0EY',NULL,'64.176.82.23','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4240.193 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWktVNUtBZm1vbGVSUVVBMzlrVDdqWkhkM1MxTlkxVlhYYlllUmxpTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745295834),('av37xaVaqght1ka33cWsF4kv797nC9Fbjl6cgFUG',NULL,'142.93.1.29','Mozilla/5.0 (compatible)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFdIeFdRQU1VY2RzV29WeGtsMEVEZHQ4Sm1aWjFVeWlIR0twUUlWayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745298142),('awTZCrazrLeNEV8L4GityfkBHVOZ0deH39IMS97c',NULL,'54.36.149.18','Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTBFdzJNc081djJWTThpd0JaVk5xYWFscnNNVWh4UHBHaXZYcGFuQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745287672),('BCbllRtipp9Ii5XKnYpiXbcnTOBGJ1LxMvD0GySb',NULL,'45.95.214.132','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRThSa3VHaUdLbTViZThnbkY3elcwc0I2ZFdUTTluQmtRamlKUll1MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTUyOiJodHRwczovL2xlYXJuc3ludGF4LmNvbS8/cm91dGU9cHJvZHVjdCUyRnNlYXJjaCZzZWFyY2g9JTIyJTNFJTNDYSUyMGhyZWYlM0QlMjJodHRwcyUzQSUyRiUyRnd3dy5waW5hcm96ZGFsLmNvbSUyRmthdGFyYWt0LWFtZWxpeWF0aSUyMiUzRXNlbGFtJTNDJTJGYSUzRSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1745298846),('BTRyw0Z7o3SZkg7QzzGWq7cmd2rTxTNQ0Pu2d6wg',79,'27.61.73.211','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoidlZUeklWSFdPR0ZidkhxT3dDbEdwblNxMVJyWnU1TkgydmdMaXlZaSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzk7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjE6e2k6MDtzOjc6IndlbGNvbWUiO31zOjM6Im5ldyI7YTowOnt9fXM6MTE6InVzZXJfYXZhdGFyIjtOO3M6Nzoid2VsY29tZSI7czo2MzoiV2VsY29tZSB0byBDV1MgTGVhcm5pbmcgRGFzaGJvYXJkISBTdGFydCB5b3VyIGxlYXJuaW5nIGpvdXJuZXkuIjtzOjg6IndlbGNvbWVkIjtiOjE7fQ==',1745294679),('cmr5aAkNzt2f5n0tEOVWHp2jwj1xNVMt1SmjqoHO',NULL,'74.80.208.185','Mozilla/5.0 (compatible; ImagesiftBot; +imagesift.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHlUUVFUR1RMRTBGcHMwZERVeWF1aTNVMTk3MU02QkhOUGUxYWNxSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2ZyZWUtY291cnNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1745291100),('EuBdq8d8TKj3xpoX9gAuoqVe6QXmOlYKb50ZXm6Z',57,'49.47.129.112','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiREQ0bk9lQ2dxUVhvajA3SjgyRkEwcDV6Z1VqNTJDZXFHUXc4cDBvayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL3YyL2FkbWluL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU3O3M6MTE6InVzZXJfYXZhdGFyIjtOO30=',1745292551),('fDvTmqdfCcfXW7wE78XPbCGXPngG3uywlSuUrcfS',65,'223.237.9.252','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZWh6YXpkTHlLYk1IVjVCY1lYYnlObVlXZkVRTU12WTNqUFRKSlI1TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L215LWF0dGVuZGFuY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6InN0YXRlIjtzOjQwOiJDNmVYWkRmMFZqdUlEbVdob0FvQnQ4a1NlUENqcnlpQXJtYVlqbm9OIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2NTtzOjExOiJ1c2VyX2F2YXRhciI7czo5ODoiaHR0cHM6Ly9saDMuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2EvQUNnOG9jTFVGT3JKNWlHLUh0S0F6bzU1bzBUeTdPQnQwM08wODFtTWZkdElScGVPd3ZkWEpYOGo9czk2LWMiO3M6ODoid2VsY29tZWQiO2I6MTt9',1745285745),('HoMiy7esztJYqJEamsQkv7ksebhajNt5rBibcm9c',NULL,'196.251.112.155','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibllWY0FtYVBkc0tWTFpIdkpHd2NjRHBDY2VIcWcwTnhMR0JWUkVKayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745293443),('iJI3RHv4Q0xkg0bxAkUCoKS9TLDSPsyQGoUnJI6S',63,'106.220.61.144','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTUVNSURlcFM5akZOT2s3VWFLakRMbHBiWWpCbDFKUk9EbkVORHA4QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IlBVTlNsMWhya1B3MVJZYTNhUGp4bG50ZFNPa2pLTEN6VUxmeG5EZkEiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjYzO3M6MTE6InVzZXJfYXZhdGFyIjtOO3M6ODoid2VsY29tZWQiO2I6MTt9',1745294469),('jYqokqF6t3FwBJdfFVnZ11K9k9tvHGoGHWwbQWOj',NULL,'152.59.146.82','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDcweFhPc1hRVzluZ1BSSUdmMWpndFhwZHJoeVJPekNmNFhnZ1dQdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745297546),('L2rvJ0xNJY0iVJreFIu9Xkf7vzjvrVeEQcVgGz1G',NULL,'66.249.65.161','Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1RhOE5sUjhJNWVYUDVVcm0xWkJRaXFXZXhpcU9CckR4UFlhUHRrVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745298730),('n80PpNM2NvcBtYCXy0u8Ouo1fapD8DHSaYqohwPM',NULL,'157.230.19.244','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibGt4Uk5OOFA3NFZibzYwNXNDNG9ydnF0ZlZSMzJPazBNSWk2eDUyQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9jb3Vyc2VzL2MtcHJvZ3JhbW1pbmctb25saW5lLWxpdmUtY2xhc3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1745287360),('NW2qVU3KRmATSWdxFM1febv0xfXlxUcvo7lQoz7K',NULL,'64.176.82.23','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4240.193 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzBETWhReklyeXlJVHZ2YVZzRmJyeXlkTjNNN1dHRkpiUFRKcGJpSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745291990),('spXBYqplPtepCu8Yx5ckGxicxf198JBK3Fzt38LH',NULL,'152.59.146.82','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibUJUTm9jaUh5RFlPYk9WWHRQaThTcEhXRWFNVjZ2Qkd3TkJ3ZzBBZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2F1dGgvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1745297541),('sYKlBoAuxcWa05QNNfaGdhxJyWvEo8SZyp7z71Va',32,'117.96.144.131','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMkhQY0JJZ3B0VUNtYkVVVE9KTTliVTM5TVF1WXpJaW9kclAyNndzdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2V4cGxvcmUtY291cnNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMyO3M6MTE6InVzZXJfYXZhdGFyIjtOO3M6ODoid2VsY29tZWQiO2I6MTt9',1745292735),('X4UQvsLL0OiWA67L5GRnnJEI9eO2JUibyha0FOBY',NULL,'52.167.144.200','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEREdEJ1eGw4UzNBZWs1N2loNU1CbzFZMTJEbE9SYWpyWEdVVFF5SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2ZyZWUtY291cnNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1745289579),('Y238GVmj4o4ElA02PpbjQpFWuEFIITMQGO3mylRY',NULL,'74.80.208.185','Mozilla/5.0 (compatible; ImagesiftBot; +imagesift.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiODNEV3ZXYk1IVlFiWnFLZERTaHRZa2tvaE9WZ0R5bzR2eWdKaWZ3YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL3ByYWN0aWNlLXRlc3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745290275),('YY17nfMcdUwuuX6ZZoLS3bC9Jw2SGfyAhjyTHRj2',NULL,'52.167.144.23','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTdIZHNyVmQ1dnJRb0xPT21xMUJnVlZISHRzZ3lnOXg1SzZXdHBVZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1745289380);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_details`
--

DROP TABLE IF EXISTS `shipping_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipping_details_user_id_foreign` (`user_id`),
  CONSTRAINT `shipping_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_details`
--

LOCK TABLES `shipping_details` WRITE;
/*!40000 ALTER TABLE `shipping_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `duration_in_days` int NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_plans_slug_unique` (`slug`),
  CONSTRAINT `subscription_plans_chk_1` CHECK (json_valid(`features`))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_plans`
--

LOCK TABLES `subscription_plans` WRITE;
/*!40000 ALTER TABLE `subscription_plans` DISABLE KEYS */;
INSERT INTO `subscription_plans` VALUES (1,'1-Month Plan','1-month-plan','Access to Learn Syntax for 1 month	',899.00,30,1,'\"[\\\"Full Course Access\\\",\\\"Support\\\",\\\"Updates\\\"]\"','2025-03-25 08:05:55','2025-04-03 06:13:03'),(2,'3-Month Plan','3-month-plan','Access to Learn Syntax for 3 months (2.5% Discount)	',2626.00,90,1,'\"[\\\"(\\\\u20b9875\\\\\\/month)\\\",\\\"Full Course Access\\\",\\\"Support\\\",\\\"Updates\\\"]\"','2025-03-25 08:08:03','2025-04-03 06:14:27'),(3,'6-Month Plan	','6-month-plan','Access to Learn Syntax for 6 months (5% Discount)	',5120.00,180,1,'\"[\\\"(\\\\u20b9850\\\\\\/month)\\\",\\\"Full Course Access\\\",\\\"Support\\\",\\\"Updates\\\"]\"','2025-03-25 08:12:49','2025-04-03 06:14:59');
/*!40000 ALTER TABLE `subscription_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `starts_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ends_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_foreign` (`user_id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`),
  CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,54,1,'2025-03-10 02:41:41','2025-04-09 02:41:41','active','completed','cash','CASH-67e369654c41f','2025-03-26 02:41:41','2025-03-26 02:41:41'),(2,32,1,'2025-02-24 02:45:59','2025-03-24 02:45:59','active','completed','cash','CASH-67e36a67f327f','2025-03-26 02:45:59','2025-03-26 02:45:59'),(3,32,1,'2025-04-03 05:49:01','2025-05-03 05:49:01','active','completed','cash','CASH-67ee214d2322b','2025-04-03 05:49:01','2025-04-03 05:49:01'),(4,67,1,'2025-04-06 09:13:48','2025-05-06 09:13:48','active','completed','cash','CASH-67f1f874306fc','2025-04-06 09:13:48','2025-04-06 09:13:48'),(5,64,1,'2025-04-08 18:14:07','2025-05-08 18:14:07','active','completed','cash','CASH-67f51a1756de7','2025-04-08 18:14:07','2025-04-08 18:14:07'),(6,13,1,'2025-04-16 11:57:20','2025-05-16 11:57:20','active','completed','cash','CASH-67ff4dc8a4062','2025-04-16 11:57:20','2025-04-16 11:57:20'),(7,20,1,'2025-04-19 14:48:58','2025-05-19 14:48:58','active','completed','razorpay','pay_QKrcyF0VafVg3O','2025-04-19 14:48:58','2025-04-19 14:48:58');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `is_member` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_contact_unique` (`contact`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Shaique Aijaz','shaique.9434@gmail.com','8051860994','male','B.COM',1,1,'2025-02-02 17:05:33','','2025-01-13',NULL,'0',0,NULL,NULL,'101873','2025-02-10 10:16:46',1,NULL,'2025-02-02 17:04:52','2025-02-10 10:06:46'),(4,'sarita','saritaakumari24@gmail.com','9123267867','female','BCA',1,0,'2025-02-02 17:56:44','','2025-01-29',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-02 17:56:09','2025-02-02 17:56:44'),(5,'Smriti Kumari','smritikeshri141@gmail.com','7004664014','female','BCA',1,1,'2025-02-02 18:31:50','','2004-01-05',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-02 18:30:19','2025-02-18 09:29:55'),(6,'Smriti Keshri','keshrismriti@gmail.com','9934445985','female','BCA',0,0,NULL,'','2004-01-05',NULL,'0',0,NULL,NULL,'418753','2025-03-11 10:56:47',1,NULL,'2025-02-02 19:31:08','2025-03-11 10:46:47'),(7,'Smriti Keshri','keshrismriti124@gmail.com','9934445981','female','BCA',0,1,'2025-02-02 19:43:11','$2y$12$abCwqdXpD655Fa0Go4.0fu6z//.QztmYEhFP6KgkYVYtlX/yvKCsq','2004-01-05',NULL,'220',0,'zYbsL6RQds6UEwv08Tb5VXMFPBu7fHqpf3ruocSOvlZDo7PHgez7mNaoj5R4',NULL,NULL,NULL,1,'LS00000007','2025-02-02 19:41:47','2025-04-13 19:33:57'),(8,'aditi keshri','aditikeshri21@gmail.com','7079565005','female','BCA',0,1,'2025-02-02 20:08:08','','2002-02-04',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-02 20:07:33','2025-02-02 20:09:51'),(9,'Nidhi  Bharti','knidhibharti8178@gmail.com','9263167817','female','BCA',0,0,NULL,'','2006-09-01',NULL,'0',0,NULL,NULL,'405731','2025-02-04 04:36:55',1,NULL,'2025-02-04 04:24:05','2025-02-04 04:26:55'),(10,'Puja Kumari','pujakumari11th2003@gmail.com','8789119882','female','BCA',0,0,NULL,'','2003-01-08',NULL,'0',0,NULL,NULL,'263990','2025-02-04 05:08:46',1,NULL,'2025-02-04 04:38:20','2025-02-04 04:58:46'),(11,'Nidhi Bharti','bhartinidhi178@gmail.com','9162520856','female','BCA',0,0,'2025-02-04 04:41:48','','2005-09-01',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-04 04:40:49','2025-02-04 04:41:48'),(12,'saurav kumar','kumarsaurav17742@gmail.com','9117442498','male','BCA',1,0,'2025-02-04 07:41:55','','2003-03-25',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-04 07:41:03','2025-02-04 07:41:55'),(13,'sadique hussain','comestrotechlabs@gmail.com','9876543125','male','BCA',0,1,'2025-02-05 05:45:17','','2017-01-04',NULL,'373',0,NULL,NULL,NULL,NULL,1,'LS00000013','2025-02-05 05:44:29','2025-04-16 11:58:45'),(14,'Abhishek Anand','anandavishek0007@gmail.com','6205733437','male','BCA',0,0,NULL,'','2004-11-06',NULL,'0',0,NULL,NULL,'292343','2025-02-06 06:02:45',1,NULL,'2025-02-06 05:49:10','2025-02-06 05:52:45'),(15,'aakash kumar','aakashkumar6505@gmail.com','9570812669','male','BCA',0,0,'2025-02-06 06:39:09','','2005-05-15',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-06 06:37:02','2025-02-28 01:52:52'),(16,'Md Jawaid Ali','mrd307449@gmail.com','8825118040','male','BCA',0,1,'2025-02-06 18:07:51','','2000-11-14',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-06 18:06:40','2025-03-10 16:34:56'),(17,'Priyanshu Bhattacharya','pkrb7945@gmail.com','9060573350','male','BCA',0,1,'2025-02-10 09:49:52','$2y$12$YyWduqRYIhFF5mf8ns8ABOClhiR4KUwws6R2Pu9TlFoL3inQsP8Ke','2005-08-10',NULL,'110',0,'hDuCfQ6DJuvB9wPl0tCbGrxIUIHIfp7y8aAO6kbFeTh4AEcxXDC7LNY0WPz4',NULL,NULL,NULL,1,'LS00000017','2025-02-10 09:48:39','2025-04-18 17:25:53'),(18,'Aijaz','shaiqueaijaz.9434@gmail.com','9661620597','male','BBA',0,0,'2025-02-10 10:19:19','$2y$12$iU3Xcfa9OMgdCPoY1UH2Ne5wDSVVe/CnSI/grG4Fk6bPsbvA13k4C','2025-01-30',NULL,'0',0,'PjHvnndS9g1qHa8adsmimbPFumBQFBrRzIA3OqCW3jaqXuJFkJuL3EhNQuCG',NULL,'767920','2025-02-20 17:12:52',1,NULL,'2025-02-10 10:16:05','2025-03-26 09:58:15'),(19,'Soma sha','somasha09@gmail.com','9263970161','female','BCA',0,0,'2025-02-10 14:34:19','','1999-04-06',NULL,'110',0,NULL,NULL,NULL,NULL,1,'LS00000019','2025-02-10 14:32:36','2025-04-15 23:29:07'),(20,'Chaman Kumar Das','chamandas254@gmail.com','8294365912','male','BCA',0,1,'2025-02-14 05:30:02','$2y$12$gfl4wJLRJpLphWSE4w9w0OslD5u7rRlSaR.vI/Y4CuRyh297q/pv2','2002-04-16',NULL,'379',0,'4RLxGUR4f5DaIlvF66Tn3Hkr6gC9iNFIrpNJK1522bR88A5Fc11j5IyFXh8h',NULL,NULL,NULL,1,'LS00000020','2025-02-14 03:45:36','2025-04-19 14:56:55'),(21,'shivam kumar','bcashivam11@gmail.com','9334354264','male','BCA',0,1,'2025-02-15 08:10:01','$2y$12$wH/RLY8SkPap8oxd24iqnu4cpNmzlm47a6wqhnApvUyINVSSyun5e','2004-03-12',NULL,'110',0,'KelLsY89zpr0pmhSmiam2R6gmPu36sdIRZN0w63wmOgQHRZeibb4JJMi8K1m',NULL,NULL,NULL,1,'LS00000021','2025-02-15 08:09:08','2025-04-14 11:27:42'),(22,'Kirti Kumari','k23keshri@gmail.com','6202388633','female','Others',0,0,'2025-02-17 04:02:49','$2y$12$fRlQti95GZgaRLhBRdXr8uKiYOO.65CrHn8w4jmxLtw4xbw7gQSBe','2002-01-02',NULL,'0',0,'JTnWHfoQq6XEShlXLaKcKlTf8oZ3mqLfJewgfVWBWmHjEojTLf6127tnNJfk',NULL,NULL,NULL,1,'LS00000022','2025-02-17 03:59:21','2025-04-15 09:26:40'),(23,'Aman Kumar','iamaman20082006@gmail.com','8677989323','male','BCA',0,0,'2025-02-17 06:56:50','','2006-08-20',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-17 06:56:13','2025-02-17 10:14:49'),(24,'Aman Kumar ','theaman6826@gmail.com','8227046826','male','BCA',0,0,'2025-02-18 02:32:59','','2004-05-02',NULL,'179',0,NULL,NULL,NULL,NULL,1,'LS00000024','2025-02-18 02:32:21','2025-04-16 15:09:37'),(25,'Trial','elegantrobinson6@getsafesurfer.com','7986987365','male','B.COM',0,0,'2025-02-18 17:30:22','','2003-10-15',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-18 17:30:03','2025-02-18 17:30:22'),(26,'Ankur Jha','akj41731@gmail.com','7763972896','male','Others',0,0,NULL,'','2006-12-25',NULL,'399',0,NULL,NULL,'974366','2025-02-18 19:42:56',1,'LS00000026','2025-02-18 19:31:37','2025-04-16 15:13:25'),(27,'Md Aasif','aliaarya70@gmail.com','8877127530','male','BCA',0,0,'2025-03-02 12:52:53','','2004-03-10',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-19 09:32:42','2025-03-16 15:16:48'),(28,'Suman Kumar','sumanmovies1200020@gmail.com','9162131629','male','BCA',0,0,'2025-02-20 01:41:37','','2004-01-01',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-20 01:41:01','2025-02-20 01:41:37'),(29,'shaique','msawork9334@gmail.com','8051862555','male','MCA',0,0,'2025-02-20 17:05:11','','2025-02-12',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-20 17:04:32','2025-02-20 17:05:11'),(30,'Ria','riamohann@gmail.com','9142978301','female','Others',0,0,'2025-02-25 02:49:01','$2y$12$RT9R/pI3.uCzlENQWIraEO5gk4K/aF40xnL3dBdchi2tiJ3DQS/SK','2005-04-12',NULL,'450',0,'N8nshdB0TTLqFDHzu2yvVlkvnw1um2f32LG5jI859VMB7nom6Ypyw14EBYeW',NULL,NULL,NULL,1,'LS00000030','2025-02-21 13:03:00','2025-04-21 20:25:02'),(31,'Rani Ara','ararani402@outlook.com','8102879165','female','BCA',0,0,'2025-02-25 03:17:26','$2y$12$dQQt7sXBeQ9MhNUJaHrMlu4/UEIowPJVth0jrUH.aBWQWFQ0.DwKe','2002-07-18',NULL,'0',0,'k6F9u9MndQsw95lfzWwjo5lKU4xqqZ9fw4blzUUCTTJxeIeJxbx5Wvhtt25K',NULL,NULL,NULL,1,'LS00000031','2025-02-24 01:48:44','2025-04-10 18:00:07'),(32,'Abhishek Kumar','abhirahul028@gmail.com','9199032431','male','BCA',0,1,'2025-02-24 02:49:32','$2y$12$XQGEYXO4MuXmNUAxUf493eLkRl8on21MEvdpd3zvq2IiXi46wgC8u','2006-04-14',NULL,'339',0,'I0LOCcwLNlnL0NYtXt4kNgeyJlmhofVuDM2rpsfG95sTESaQn2ejZQoW60bV',NULL,NULL,NULL,1,'LS00000032','2025-02-24 02:48:27','2025-04-21 20:07:38'),(33,'Deep saha','deepsaha221205221205@gmail.com','9470410017','male','BCA',0,0,'2025-02-25 04:52:54','','2005-12-22',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-24 05:41:32','2025-03-16 07:25:12'),(34,'Jay Yadav','jy510914@gmail.com','9110134326','male','BCA',0,1,'2025-02-25 02:58:10','$2y$12$bh0cyu9xDsXK7JHX.OCFj.k0Kd6O1VVhJsgF0zrGNWpF81KVQGNOK','2004-06-06',NULL,'230',0,'2OXCR9XBgCwJSu6vXx5sjwCox6vEEP67ZqnqXtLBxBYZSrniy95VWxOZxJHH',NULL,NULL,NULL,1,'LS00000034','2025-02-25 02:51:17','2025-04-21 20:18:15'),(35,'Rupesh Saha','rupeshsaha899@gmail.com','8207528958','male','BCA',0,0,'2025-02-25 03:50:33','$2y$12$EU/BmWVg3pA4Q.MTcxHKcOdtQ4ghfY6hDAwt.uPUiesktEA.DiuZK','2005-05-25',NULL,'0',0,'1qRCwN24MDY8qR1ibLUKHvhOzFG0I5Bn0IGVgodUzGIT2MhRpJIrB5I2ZdBW',NULL,NULL,NULL,1,NULL,'2025-02-25 03:49:50','2025-04-01 15:18:18'),(36,'Shalini Kumari','shalinikushwaha317@gmail.com','6299040053','female','BCA',0,1,'2025-02-28 05:48:13','$2y$12$wz6zrVnauGH9GJNjvE.K5euO7AKInsj4oyixjx01E1M088bZ8IPFO','2007-03-31',NULL,'199',0,'CeDbPqVyUBfayuWddKCxZKwT2UEjbxbKokCbY4EnLK6e1MrtniwM2XQUqFfX',NULL,NULL,NULL,1,'LS00000036','2025-02-26 11:12:08','2025-04-13 16:45:00'),(37,'Arju kumari','ajjuaarju950@gmail.com','8102412189','female','BCA',0,0,'2025-03-02 15:12:18','','2025-03-02',NULL,'110',0,NULL,NULL,NULL,NULL,1,'LS00000037','2025-03-02 15:11:12','2025-04-08 08:19:03'),(38,'Anand','ka582916@gmail.com','9334742579','male','BCA',0,0,'2025-03-03 02:50:50','','2006-06-09',NULL,'199',0,NULL,NULL,NULL,NULL,1,'LS00000038','2025-03-03 02:48:55','2025-04-09 16:06:10'),(39,'Rishav Ranjan','rishuyadav970822@gmail.com','8603733231','male','BCA',0,0,'2025-03-03 05:11:08','','2006-03-15',NULL,'399',0,NULL,NULL,NULL,NULL,1,'LS00000039','2025-03-03 05:09:47','2025-04-13 20:42:19'),(40,'chandravardhan','chandravardhan9955@gmail.com','7700899779','male','BCA',0,1,'2025-03-04 04:33:25','$2y$12$30Pwt/Utdf428GnNcY6vhOH64BqcJ.keW1rUTF7xijVm1ASspAkHW','2006-02-03',NULL,'0',0,'nR7FMy8OLkZhvKDu53S8eiTiKxMbEXmMXkfMG68CQ0HsXiET1IVAjJMumYK9',NULL,NULL,NULL,1,'LS00000040','2025-03-04 04:31:44','2025-04-11 16:33:24'),(41,'Arya anand','manishsha9939@gmail.com','7970476426','male','Others',0,0,'2025-03-05 11:44:19','$2y$12$cTTfx6yI0AHP2IXrnwjVueHqgHwzTl3lKbnEqsiWmEKX/v2VFsS9a','2007-03-17',NULL,'110',0,'drB658zTsZRxa6OjKwi0GVHh2jxkSDqDafiLOUHHZBlUzKqW4A7TIR5j2jwM',NULL,NULL,NULL,1,'LS00000041','2025-03-05 11:42:59','2025-04-18 17:30:43'),(42,'Shreya','shreyaa8673@gmail.com','7979018292','female','BCA',0,0,'2025-03-05 15:23:58','','2005-04-28',NULL,'110',0,NULL,NULL,NULL,NULL,1,'LS00000042','2025-03-05 15:23:01','2025-04-14 10:58:52'),(43,'Deepika sen','sendeepika9333@gmail.com','9798208512','female','BCA',0,1,'2025-03-11 11:53:50','$2y$12$Tsmub.2P6qED3lB9EcJL.uS4oSi28esQaAUoLAHp3qEr2kxn9MQ/2','2005-01-15',NULL,'199',0,'hxIIBEYKvVo7tNAfZ4Gm8iDVeX6qxhpJygc36UPVElhbPwvXjsYkdyRu7qEh',NULL,NULL,NULL,1,'LS00000043','2025-03-05 15:24:25','2025-04-08 15:31:15'),(44,'Gouravkumarjha','gouravjha371@gmail.com','9199605519','male','BCA',0,1,'2025-03-06 01:53:16','','2006-03-16',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-06 01:52:16','2025-03-19 14:53:59'),(45,'Abhinav poddar','poddarabhinav52@gmail.com','9631179271','male','BCA',0,0,'2025-03-06 13:31:12','$2y$12$eWurccFuGAYvq4CWLRuwmu59HLhQko.yQgHUg2dlEKCw18SG8CdRS','2007-05-23',NULL,'0',0,'lWFWYWKhbr8RHvm7se2OLzZ0xK5xEe4RkvZ8RmtKkD2cTVg1QqF3fxmUY0bZ',NULL,NULL,NULL,1,'LS00000045','2025-03-06 13:30:35','2025-04-08 17:23:31'),(46,'Kishlay Krishnan','kishlaykrishnan@gmail.com','6205298625','male','BCA',0,0,'2025-03-07 06:26:22','','2006-08-06',NULL,'0',0,NULL,NULL,NULL,NULL,1,'LS00000046','2025-03-07 06:24:52','2025-04-18 17:40:59'),(47,'Prabhakar Kumar Singh','prabhakarkumarsingh578@gmail.com','9142656092','male','Others',0,0,'2025-03-07 08:59:21','','2007-10-25',NULL,'110',0,NULL,NULL,NULL,NULL,1,'LS00000047','2025-03-07 08:57:13','2025-04-18 17:25:03'),(48,'Rishav Raj','rishavraj993194@gmail.com','9931945540','male','BCA',0,0,'2025-03-07 16:46:11','$2y$12$TIOpG0RpjUt.yDKuYWT10.Lt3S7MSbSW6BCnBUJ45SdrDY1KH.I.2','2004-04-30',NULL,'220',0,'86F6VM8sCmFNhnfXSc7Lwizs0B9qeiRvz5xKy7A4CR4XxPnI8Bm6cPoRzQXX',NULL,NULL,NULL,1,'LS00000048','2025-03-07 16:45:29','2025-04-09 16:29:21'),(49,'Rishav','rishav7766941815@gmail.com','7766941815','male','BCA',0,0,'2025-03-09 02:54:12','','2005-09-05',NULL,'309',0,NULL,NULL,NULL,NULL,1,'LS00000049','2025-03-09 02:52:48','2025-04-14 12:06:42'),(50,'Aastha priya','aasthapriya185@gmail.com','7250409966','female','BCA',0,0,NULL,'','2005-09-05',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-09 03:45:57','2025-03-09 03:45:57'),(51,'Khushi  Kumari','khumarikhushi03@gmail.com','8292057979','female','BCA',0,0,'2025-03-09 11:29:36','$2y$12$K7FyIVWb7Yacm1ZezAT0tO6VF.49mxpTCSRAvhYZtWwuX2iW.2lle','2005-08-22',NULL,'179',0,'xnv4ImH0CCACSKESoZTuh1aVzgznaCJ0WxruiwrY0YMtqqX3xQrgHSXtZZSc',NULL,NULL,NULL,1,NULL,'2025-03-09 11:28:48','2025-04-21 16:14:24'),(52,'Raman Kumar','ramankumardamha2001@gmail.com','6202891807','male','BCA',0,0,NULL,'','2001-09-01',NULL,'0',0,NULL,NULL,'967256','2025-03-10 15:25:52',1,NULL,'2025-03-10 15:13:12','2025-03-10 15:15:52'),(53,'Sakshi','jhas57082@gmail.com','8789122579','female','BCA',0,0,'2025-03-11 11:12:00','','2006-03-05',NULL,'0',0,NULL,NULL,'429765','2025-03-18 11:50:36',1,'STU00000053','2025-03-11 11:09:03','2025-03-29 07:08:08'),(54,'Muskan','muskankatyayan123@gmail.com','9523470620','female','Others',0,1,'2025-03-12 03:52:36','','2004-03-09',NULL,'230',0,NULL,NULL,NULL,NULL,1,'LS00000054','2025-03-11 13:48:55','2025-04-21 22:31:04'),(55,'sakshi kumari','abc@gmail.com','9304060153','female','BCA',0,0,NULL,'','2006-09-05',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-12 05:02:39','2025-03-12 05:02:39'),(56,'Paras','p@gmail.com','8789118987',NULL,NULL,0,0,NULL,'$2y$12$2keaNVCdp.3Ge34FXuL0u.k4kt.zndWzQ3haN3v2y0ONOEejSYAtG',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-24 08:13:47','2025-03-24 08:13:47'),(57,'sadique hussain','sadique.hussain96@gmail.com','9546805580',NULL,NULL,1,0,NULL,'$2y$12$JE15fZKrJaKuN6FeMWF8zuvf8lutSgk3EFFX5uuUOs4gn9E4DhRFq',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-24 09:15:49','2025-03-24 09:15:49'),(58,'saurav','sauravkumar52778@gmail.com','6203051595',NULL,NULL,0,0,NULL,'$2y$12$ajfS.KLc.EhNJgg51rVUeO9Ez84lNVlHZcRZeguU7tUdxS7aE4x0e',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-24 16:35:10','2025-03-24 16:35:10'),(59,'learn syntax','learnsyntaxpurnea@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$ozWQsYj5hgcr1znT6SNlYONcMHDUisaVlJg/Eyf/e1fRUeOVHR/za',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-28 13:06:15','2025-03-28 13:06:15'),(60,'Abhishek Kumar','abhishekk78508@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$SqGxqlTMBqDrhi8NCcakDuumxRgMFL1GK47EnO6V6ITYQQvU6t1Vy',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-01 18:13:30','2025-04-01 18:13:30'),(61,'Arju Jha','arjujhaarju@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$TZylr0pWpOvY9F0M3F13D.bBEStljB2BooSrR5GH048aVBkO6rfy.',NULL,NULL,'0',0,'1uzLcl1PMfVVdgD5wIXj7rQfojzC57gQwGbw82yR4OPqoZxY1pAoCaRpf8Xz',NULL,NULL,NULL,1,NULL,'2025-04-04 09:20:07','2025-04-06 16:46:03'),(62,'Rani Ara','ranirahi99396@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$9dW2yJadpdC4lHpkBH/ry.E9CgLE0Y8S8xGBt1gAe62nNp3vNUpC6',NULL,NULL,'0',0,'CFfoKM0chRBZL854Pmj8ZMQqoePKmswju8My3p3C6fOFncd8SjxMwj0XTOON',NULL,NULL,NULL,1,NULL,'2025-04-04 09:21:37','2025-04-08 08:24:11'),(63,'vikash Aryan ','vikasharyan323@gmail.com',NULL,'male',NULL,0,0,NULL,'$2y$12$GVyngMzhYEOC32/gbYrMeeB3BH48.4cE4Ll.hh.PDUGHz57uRLJz.',NULL,NULL,'179',0,NULL,NULL,NULL,NULL,1,'LS00000063','2025-04-04 09:30:31','2025-04-16 15:11:32'),(64,'Nexus Purnea','nexuspurnea@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$ix429hKsGay7dHL5JHdpG.eIVuhIzz2PScRPHK8qbMec5p6mpGTgW',NULL,NULL,'50',0,NULL,NULL,NULL,NULL,0,'LS00000064','2025-04-04 10:58:24','2025-04-18 17:55:02'),(65,'Rãçhitā Kùmãri','rachitak730@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$Mffm0ZchxI0ygg/29Wt8iOGlG5poBIibzahHkYbTss3yk0S5DH3cG',NULL,'https://lh3.googleusercontent.com/a/ACg8ocLUFOrJ5iG-HtKAzo55o0Ty7OBt03O081mMfdtIRpeOwvdXJX8j=s96-c','150',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 15:11:01','2025-04-10 13:56:19'),(66,'Raman Sah','raman766423@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$w9T97mmMn9sSEQB2bFH4n.T3OJP4pmy77B8ss83oIKDCbGMDlBimm',NULL,'https://lh3.googleusercontent.com/a/ACg8ocKaYTsC6J0umQQs1mdSmdVj37bm1OMl2oJbz1EAlCFvMgZgPA=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 17:43:43','2025-04-04 17:43:43'),(67,'Prithvi Raj Sahani','0707error@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$8U1KMiyyWIWzOXjhiFYJZuhjxYb4PZEWlndxm8xdOS51S2qvIZ9Xq',NULL,'https://lh3.googleusercontent.com/a/ACg8ocIYdfbIi5nvdvUh219ygorX77DIqrMnm8julR613pRXxvxIDW0=s96-c','150',0,NULL,NULL,NULL,NULL,1,'LS00000067','2025-04-04 20:56:14','2025-04-06 09:13:48'),(68,'rani ara','arar63180@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$iI2e1VWS7jXKZ5d5ua6oauYIG8Ha8E31VnUA2DPlmLKnm34fD/eD6',NULL,'https://lh3.googleusercontent.com/a/ACg8ocIbmRg58usMw8lUE4wv0t8xX6SqgCPOSFiyL4izUiioOvf9DQ=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-08 08:26:04','2025-04-08 08:26:04'),(69,'sudhanshu aryan','sudhanshuaryan2005@gmail.com',NULL,'male','BCA',0,0,NULL,'$2y$12$5nnLW45Id1n2Gc.H8joQbesJ7rhaj2.wdvIflDSER9Ghbys3Aymeq',NULL,'https://lh3.googleusercontent.com/a/ACg8ocLnq8Q5vyaAVWHn2RDXsPO0BWECLDRirlf2o0GZ7SJ6UddnXZE=s96-c','179',0,NULL,NULL,NULL,NULL,1,'LS00000069','2025-04-08 15:20:27','2025-04-16 15:10:26'),(70,'Jagriti_ Prakash','jagritiprakash17@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$nSvchlbSo0OSzq1qODwqK.8WcMOP50Ts9GtsTreyjvFtfE8pmxDaS',NULL,'https://lh3.googleusercontent.com/a/ACg8ocJXiLjHMjSy_kkALNTTfBlQjKyOyxY518z3XZ5lbepIDYxJ0w=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-08 15:21:18','2025-04-08 15:21:18'),(71,'Kunal kumar','kunaloct268@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$K9x/Vd7N53WlY3FFJvUq8.CnUcYtgyjmI.ZNh7x0SK0/bSE8qPmyS',NULL,'https://lh3.googleusercontent.com/a/ACg8ocJbnQGbmho9TxutDdLdqZqZqUp-nGk-hi3QdSjo4ZM-BvCc89Oj=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-09 15:12:39','2025-04-09 15:12:39'),(72,'Vikas','vikas.vm788@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$YJGyjaghUThWyEbgtWgvfu/tEFBdmbSUm2Y62Kt4xCqjuCrDfc/5O',NULL,'https://lh3.googleusercontent.com/a/ACg8ocK-EPVn7K1Ms78yROUunq5dzdGz2qhDtx-b50uAaL5i_5D13I2j=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-13 14:25:21','2025-04-13 14:25:21'),(73,'Pratik Sah','shivam3448@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$I5wL2SiXn3oTOrnvDZ449eQHnZXyQynqJPk9lfvnPRArJb.j6SIKG',NULL,'https://lh3.googleusercontent.com/a/ACg8ocKmC0KfiQy0o11QA1kjVCn7E1lkX-L0ooaGx1CjXKy38uRbXFBYMA=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-13 14:25:24','2025-04-13 14:25:24'),(74,'shalini kushwaha','shalinikushwaha3171@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$7fSaqycwQe2PB5AjxbhXMObxHputy9qpuMcFEVV2wNkqvausjOIEO',NULL,'https://lh3.googleusercontent.com/a/ACg8ocJ-yUwqHezQBYeoa-cWhUrwMsKgz_EPt9_0xJd6-o1D2XHBjg=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-13 16:38:04','2025-04-13 16:38:04'),(75,'Mohammad Saif Samdaani','mdsaifsamdaani@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$AirX1PiuvL3sK3eSV7.qyuDAebYMzi0qShIr3ekHmp4UNU4BcT2R2',NULL,'https://lh3.googleusercontent.com/a/ACg8ocLkEtL3wM6Qb-axCHkA7FTBkRoso7vdxsnblyBzYd-1zAMN3als=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-13 18:57:50','2025-04-13 18:57:50'),(76,'Md shayan sheikh ','sahebsheikh202276@gmail.com','8797475493',NULL,NULL,0,0,NULL,'$2y$12$T/BPXbzzc9hYo0zZbbcwc.7ci3uaKSsiz0iDc2B74pWBocohjwba2',NULL,NULL,'110',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-15 17:32:08','2025-04-18 17:29:25'),(77,'Roni Saha','ronitsaha836@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$npkVH3XN3q2riQfa5eN86.W8GSp/gPJSlPrvegXmvSKmP7uMbyBhO',NULL,'https://lh3.googleusercontent.com/a/ACg8ocIHWae4qYaLHrix56-xejZaNopnhH4RBy_rPTrOG-LxoKNWAVVj3g=s96-c','150',0,NULL,NULL,NULL,NULL,0,NULL,'2025-04-16 16:44:05','2025-04-16 23:54:06'),(78,'Manish Kumar','manish966128@gmail.com','8207593672',NULL,NULL,0,0,NULL,'$2y$12$SdR7QEyFO2dGkHghb5y2h.h6zdPzksuDDC1yHG7VDpYkH1ifihEY6',NULL,NULL,'199',0,'hxd5HeEljYMwOJZzqiAvweJgIxjS4EZIwcJz5PGgQ3cRcVyWrbpfLkbcLUYU',NULL,NULL,NULL,1,NULL,'2025-04-17 09:35:41','2025-04-21 19:37:46'),(79,'Manmohan Das','manmohan.das.2005@gmail.com','8002870395',NULL,NULL,0,0,NULL,'$2y$12$NLT9RZuNIVM5pasg8hJ0guMDCedDvO/31R1DCmIrbHb3pzo1z9eQa',NULL,NULL,'0',0,'iyAvWaNpnZxQTVGGQD4uDzH5QlxdMrnOedHmhaiZKfqia9W4HICWNysVNmWJ',NULL,NULL,NULL,1,NULL,'2025-04-18 12:01:54','2025-04-18 12:01:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workshops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `fees` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` json DEFAULT NULL,
  `status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workshops`
--

LOCK TABLES `workshops` WRITE;
/*!40000 ALTER TABLE `workshops` DISABLE KEYS */;
/*!40000 ALTER TABLE `workshops` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22  5:34:38
