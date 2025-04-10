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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignment_uploads`
--

LOCK TABLES `assignment_uploads` WRITE;
/*!40000 ALTER TABLE `assignment_uploads` DISABLE KEYS */;
INSERT INTO `assignment_uploads` VALUES (1,1,1,'1J8v8oIXA5J2qn0yThuR6fFs4VSzSa6m_','2025-02-06 17:17:34',80,'graded','2025-02-06 17:17:34','2025-02-17 10:12:02'),(2,7,1,'1P2h3fYqUq7RctcthN3JrbNFQ5S4wrwcn','2025-02-18 09:02:32',NULL,'submitted','2025-02-18 09:02:32','2025-02-18 09:02:32'),(3,7,2,'1XPpRKR3VFBuy_lzPMXYMUGEd2QSDCgZM','2025-02-18 09:05:23',10,'graded','2025-02-18 09:05:23','2025-02-19 11:00:12'),(4,21,2,'1GA7DIerkhzGpZ3Nt020uRn_T0UtShcmT','2025-02-19 04:42:24',70,'graded','2025-02-19 04:42:24','2025-02-19 11:00:04'),(5,20,2,'1puzsse83dft8blyMjSw006zIFU6F104I','2025-02-19 04:42:31',80,'graded','2025-02-19 04:42:31','2025-02-19 11:00:57'),(6,16,2,'1Rd8tIqYSIA55gSxCdjUonQmyTQ9cZ1Sd','2025-02-19 18:14:49',65,'graded','2025-02-19 18:14:49','2025-02-21 02:18:14'),(7,19,2,'1VExTCixeF1xzPlTez-6nsFD_OsS4wyBJ','2025-02-21 08:04:09',75,'graded','2025-02-21 08:04:09','2025-02-25 04:59:15'),(8,17,2,'1I4YyYOqsWWJOZsVgVGA9f0mFoLni_GkO','2025-02-26 12:39:22',70,'graded','2025-02-26 12:39:22','2025-03-07 04:31:51'),(9,32,3,'1gHkfba_F_FeYzcTsJ04j-UVi6JVSoEuY','2025-02-27 02:44:40',80,'graded','2025-02-27 02:44:40','2025-03-03 02:44:10'),(10,35,4,'1jrmXfN3x3sd-CXpOCFwU6G7X6FlAEYOV','2025-03-01 05:56:01',85,'graded','2025-03-01 05:56:01','2025-03-03 05:46:27'),(11,30,3,'1PmUngdV-kUlNazzJCOfk-inbAqJh0UIJ','2025-03-01 14:39:03',65,'graded','2025-03-01 14:39:03','2025-03-03 02:44:24'),(12,32,4,'1NdToIbbPuOEUdb8GyAfFtMPiNzNfP2nv','2025-03-02 04:59:59',85,'graded','2025-03-02 04:59:59','2025-03-03 05:47:36'),(13,34,3,'1LPLa0ExQ2o7tH2-K8dz8AZKyqo_HlB3d','2025-03-02 05:08:53',60,'graded','2025-03-02 05:08:53','2025-03-03 02:44:31'),(14,33,4,'1mfP7TMiaNIyYxDYSGsz3KHUpOQV0QUMX','2025-03-02 07:58:34',85,'graded','2025-03-02 07:58:34','2025-03-03 05:48:08'),(15,33,4,'1MWbMzaXEf-gTR71ya1HjKDiqhI9gzMQy','2025-03-02 07:58:38',NULL,'submitted','2025-03-02 07:58:38','2025-03-02 07:58:38'),(16,33,4,'1vMcPFmx1NMvkcrp0ed7QvrcIZnCt1ccW','2025-03-02 07:58:38',NULL,'submitted','2025-03-02 07:58:38','2025-03-02 07:58:38'),(17,30,5,'1als8hberLlRHf0YC7OBe9hc7uMNN7x1f','2025-03-04 01:43:00',75,'graded','2025-03-04 01:43:00','2025-03-07 02:39:48'),(18,36,4,'1ixQ7jq_o5_sPPIzKUUVBWTszM2yZN1q2','2025-03-04 14:43:29',NULL,'submitted','2025-03-04 14:43:29','2025-03-04 14:43:29'),(19,22,2,'11W6g8VQOwxmpNJBytYb8nj1l6eM1q0dx','2025-03-04 17:14:09',80,'graded','2025-03-04 17:14:09','2025-03-07 04:32:57'),(20,32,5,'1T8iYqy5O3mnR0WHDxsXUJFco7kXKz90Y','2025-03-04 18:53:29',80,'graded','2025-03-04 18:53:29','2025-03-07 02:40:08'),(21,37,5,'1Le3vRX-15xlVke9SPDpw-ZqLeMGyxHkW','2025-03-05 14:46:38',70,'graded','2025-03-05 14:46:38','2025-03-07 02:40:46'),(22,44,3,'1D57shTf5I37z81EMTNYnuiA2jBk6Mgj1','2025-03-06 14:57:36',60,'graded','2025-03-06 14:57:36','2025-03-07 02:44:17'),(23,44,5,'1nMC7I0oiU27kpb6ksk5_Ma10Pq95lulR','2025-03-07 01:52:42',80,'graded','2025-03-07 01:52:42','2025-03-07 02:42:19'),(24,34,5,'1e8A5lJW6j88Ynv9K85W_EiwW32B8So96','2025-03-07 02:41:40',80,'graded','2025-03-07 02:41:40','2025-03-07 02:43:35'),(25,31,3,'1usYShJPNdBRFDOLyFwf4T7ChgLkF0xcT','2025-03-08 16:08:27',80,'graded','2025-03-08 16:08:27','2025-03-17 04:00:51'),(26,31,5,'1i6DfgQtlfoByrIYY00xUWjhBofvZUdkB','2025-03-08 16:09:31',80,'graded','2025-03-08 16:09:31','2025-03-17 04:01:21'),(27,31,7,'1Br-mwLkU5wJ2BKlFKSF9n5xXOlm4f37I','2025-03-08 16:24:51',75,'graded','2025-03-08 16:24:51','2025-03-10 02:46:40'),(28,35,9,'1Iq8Nlgy7P0yNJgxBqWth54oHRLZtXDzu','2025-03-09 05:58:09',NULL,'submitted','2025-03-09 05:58:09','2025-03-09 05:58:09'),(29,44,7,'1Mz5cMKxoh7Tlbuh0TBUKZr4Mbfqld_d7','2025-03-09 07:56:57',75,'graded','2025-03-09 07:56:57','2025-03-10 02:47:40'),(30,32,9,'12m57KlJPZVPEP2wsVvnV1BZgmstLG7fg','2025-03-09 15:55:34',NULL,'submitted','2025-03-09 15:55:34','2025-03-09 15:55:34'),(31,32,7,'1FI--i_gVAf-DcYa1gm89urIftU0kBLzT','2025-03-09 18:49:19',80,'graded','2025-03-09 18:49:19','2025-03-10 02:47:57'),(32,36,9,'1Vg5rA6-looeK0uCmn4xsbBG7mQWdnd6v','2025-03-09 19:06:58',NULL,'submitted','2025-03-09 19:06:58','2025-03-09 19:06:58'),(33,45,10,'1yWlBgKnNmCDkYfoUmKsBzB5SkNhQ97zT','2025-03-09 22:40:22',70,'graded','2025-03-09 22:40:22','2025-03-12 10:37:42'),(34,30,7,'1mD_aUUwRISKqiNesvmQfvVElfElkM9tT','2025-03-10 02:44:40',75,'graded','2025-03-10 02:44:40','2025-03-10 02:48:18'),(35,34,7,'1nLnxZM1XVPCc8pHMEiHcwnOkKLKM3QV3','2025-03-10 02:45:14',75,'graded','2025-03-10 02:45:14','2025-03-10 02:48:50'),(36,21,8,'1rhQ7q3K1Dy_p09jd-1PDnYm3pgjZ6rL_','2025-03-10 02:52:38',NULL,'submitted','2025-03-10 02:52:38','2025-03-10 02:52:38'),(37,41,10,'10-BOqTZWMxhGehUU8RUNAYBKhavcXJhE','2025-03-10 04:25:14',70,'graded','2025-03-10 04:25:14','2025-03-12 10:38:31'),(38,33,9,'1DCN0qF7bb02unpsUmzAy-Lj4RSOoH8dU','2025-03-10 04:57:33',NULL,'submitted','2025-03-10 04:57:33','2025-03-10 04:57:33'),(39,37,7,'1fVd-wW1rQCkwydR8oH2lsagOvPCmNov_','2025-03-10 15:22:36',NULL,'submitted','2025-03-10 15:22:36','2025-03-10 15:22:36'),(40,27,4,'1gyiVGAX3zD5HvRUpjQa91BIKTtfx8rTe','2025-03-11 12:54:22',NULL,'submitted','2025-03-11 12:54:22','2025-03-11 12:54:22'),(41,48,10,'11wQiMJS0wozbI9PR7oSrph-OwWTEwYwi','2025-03-11 14:37:26',65,'graded','2025-03-11 14:37:26','2025-03-12 10:39:56'),(42,27,9,'1N3L1gtF_6UwpJ1EXB2WX-ztDn9AxWIBt','2025-03-12 04:04:51',NULL,'submitted','2025-03-12 04:04:51','2025-03-12 04:04:51'),(43,17,10,'1CgxeIcUcpRWV5sMrHElwljDhX3QYPVZK','2025-03-12 06:06:08',70,'graded','2025-03-12 06:06:08','2025-03-12 10:41:22'),(44,47,10,'1julGI0m68OiXn13u0pSGf4CscF6tn-7x','2025-03-12 07:42:18',50,'graded','2025-03-12 07:42:18','2025-03-12 10:42:39'),(45,37,11,'1W6KxaNjaRI1493BdWi0T6QpU8DvvVxk_','2025-03-12 16:25:28',65,'graded','2025-03-12 16:25:28','2025-03-17 03:53:42'),(46,20,8,'1OApxSb-031mE1B7o3zgAGDyAngGcgHYp','2025-03-15 03:13:28',NULL,'submitted','2025-03-15 03:13:28','2025-03-15 03:13:28'),(47,34,11,'1Vfg9DiDlbe55vM_1KPfpYX73plWg2XVi','2025-03-17 02:43:10',80,'graded','2025-03-17 02:43:10','2025-03-17 03:54:10'),(48,32,11,'1S3DZdqCrFg2XEhqWnJeWx-x9Ivf6YH0_','2025-03-17 03:07:14',70,'graded','2025-03-17 03:07:14','2025-03-17 03:54:37'),(49,31,11,'1uwBgVD1vY19hRwpG1PozSShJYCMzOQ3X','2025-03-17 03:22:16',70,'graded','2025-03-17 03:22:16','2025-03-17 03:59:27'),(50,31,11,'161ltwZB571naC1e2XENkEeJLRLJi1Xrs','2025-03-17 03:22:19',NULL,'submitted','2025-03-17 03:22:19','2025-03-17 03:22:19'),(51,45,12,'1ws91enuUaro-Uc3q36RyyBbXkf5wZQZs','2025-03-17 08:29:23',75,'graded','2025-03-17 08:29:23','2025-03-17 10:43:59'),(52,41,12,'1bbSdpeiTsg7naHQDdf_617Oe69ORuDXT','2025-03-17 10:42:36',75,'graded','2025-03-17 10:42:36','2025-03-17 10:44:43'),(53,54,11,'1oHLYQbS_JRICpbOQ5RayIxW5Gev2ZsFo','2025-03-17 17:31:12',NULL,'submitted','2025-03-17 17:31:12','2025-03-17 17:31:12'),(54,34,10,'1kBK6fAd7UF42fr3BnU5JyZGYZrEwMpis','2025-03-18 09:01:04',NULL,'submitted','2025-03-18 09:01:04','2025-03-18 09:01:04'),(55,47,12,'1nJGbguneR0Ho3BWjPWUWozHAeFhqQkp8','2025-03-18 11:26:44',NULL,'submitted','2025-03-18 11:26:44','2025-03-18 11:26:44'),(56,44,11,'1PyEbkNvqTz3Mn-EE-0i7nExTwFCdIJk7','2025-03-19 14:55:15',NULL,'submitted','2025-03-19 14:55:15','2025-03-19 14:55:15'),(57,34,12,'1y3q_V3yROjR41OZkjkXDMH-Hqvojkie8','2025-03-24 16:02:10',NULL,'submitted','2025-03-24 16:02:10','2025-03-24 16:02:10'),(58,34,12,'1qhNxt5dUr2-57AivGW0b05LwpwNPsSBY','2025-03-24 16:02:21',NULL,'submitted','2025-03-24 16:02:21','2025-03-24 16:02:21'),(59,53,10,'16OptW9vKbA_hthvxChPV8vFnGpBiiFRZ','2025-03-27 04:44:46',NULL,'submitted','2025-03-27 04:44:46','2025-03-27 04:44:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (2,'Explain Different type of data types in python? and its casting with example','<p>Explain Different type of data types in python? and its casting with example</p>',NULL,1,2,1,'2025-02-14 03:48:00','2025-02-14 03:48:00'),(3,'Create table for timetable','<p>see image for ref : <a href=\"https://programmingtrick.com/upload/1641874727.png\">https://programmingtrick.com/upload/1641874727.png</a>&nbsp;</p>',NULL,5,4,1,'2025-02-25 02:52:29','2025-02-25 02:52:29'),(4,'C++ introduction','<p>explain few things&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>1. keywords &amp; identifier with example&nbsp;</p><p>2. variable &amp; constant with example</p><p>3. basic datatype with its modifiers with example</p><p>4. escape sequences&nbsp;</p>',NULL,4,3,1,'2025-02-27 05:49:24','2025-02-27 05:49:24'),(5,'Create admission Form','<figure class=\"image\"><img src=\"https://files.codingninjas.in/article_images/custom-upload-1682703830.webp\"></figure>',NULL,5,4,1,'2025-03-03 02:47:34','2025-03-03 02:47:34'),(6,'php variable, constant, operator and data type, function explain with example',NULL,NULL,6,5,1,'2025-03-05 10:39:32','2025-03-05 10:39:32'),(7,'Create a portfolio webpage and details about you with your resume',NULL,NULL,5,4,1,'2025-03-07 02:45:34','2025-03-07 02:45:34'),(8,'python 2nd module','<ol><li>operator&nbsp;</li><li>loop</li><li>function</li><li>data types</li><li>list</li><li>tuple</li><li>string</li><li>set</li><li>dict</li></ol>',NULL,1,2,1,'2025-03-07 04:30:52','2025-03-07 04:30:52'),(9,'assignment module 2','<ol><li>if else… else if statement&nbsp;</li><li>switch case statement</li><li>operators</li><li>type casting</li><li>fundamental data types</li><li>loop and its type</li></ol>',NULL,4,3,1,'2025-03-07 05:35:07','2025-03-07 05:35:07'),(10,'Assignment Module 1  - C Programming Basics','<h3><strong>Assignment: C Programming Basics</strong></h3><h4><strong>1. Variables in C</strong></h4><p>Write a C program that declares and initializes three different types of variables: an integer, a float, and a character. Print their values on the screen.</p><h4><strong>2. Keywords in C</strong></h4><p>Explain what keywords are in C programming. List any five keywords and describe their usage with an example.</p><h4><strong>3. Constants in C</strong></h4><p>Write a C program that demonstrates the use of a #define preprocessor directive and the const keyword to declare constants. Show the difference between them using an example.</p><h4><strong>4. Basic Structure of a C Program</strong></h4><p>Write a simple C program that follows the basic structure of a C program, including #include, main(), variable declaration, input/output, and return statement. The program should ask the user to enter their name and then print a greeting message.</p>',NULL,2,6,1,'2025-03-08 05:21:40','2025-03-08 05:21:40'),(11,'create your portfolio webpage and write and design about your education  using HTML CSS',NULL,NULL,5,4,1,'2025-03-12 03:48:23','2025-03-12 03:48:23'),(12,'Assignment Module 2: C Programming - Operators, Data Types, and Sizes','<h3>&nbsp;</h3><p><strong>Data Types in C</strong><br>Write a C program that declares variables of the following data types: int, float, char, and double. Print their values along with their respective sizes using the sizeof() operator.</p><p><strong>Arithmetic Operators in C</strong><br>Write a C program that takes two integer inputs from the user and performs the following operations: addition, subtraction, multiplication, division, and modulus. Display the results for each operation.</p><p><strong>Relational Operators in C</strong><br>Write a C program that compares two numbers using relational operators (&gt;, &lt;, &gt;=, &lt;=, ==, !=). Display whether each condition is true or false.</p><p><strong>Logical Operators in C</strong><br>Write a C program that asks the user for their age and nationality. Using logical operators (&amp;&amp;, ||, !), determine if the person is eligible to vote (e.g., age ≥ 18 and nationality = Indian).</p>',NULL,2,6,1,'2025-03-16 06:58:52','2025-03-16 06:58:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,54,5,4,'2025-03-27 07:10:25','offline','2025-03-27 07:10:25','2025-03-27 07:10:25'),(2,54,5,4,'2025-03-29 09:41:54','offline','2025-03-29 09:41:54','2025-03-29 09:41:54'),(3,13,2,6,'2025-04-06 09:29:15','offline','2025-04-06 09:29:15','2025-04-06 09:29:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (2,1,'9 am - 06 feb','2025-02-27','2025-04-24','2025-02-04 11:17:06','2025-02-05 15:44:44'),(3,4,'10:00 AM','2025-02-19','2025-04-02','2025-02-17 17:06:27','2025-02-17 17:06:27'),(4,5,'7 AM to 8 AM','2025-02-25','2025-05-06','2025-02-25 02:50:47','2025-02-25 02:50:47'),(5,6,'3:00 PM to 4:00 PM','2025-03-03','2025-05-12','2025-02-28 16:09:46','2025-02-28 16:09:46'),(6,2,'4 PM to 5 PM','2025-03-04','2025-04-15','2025-03-04 04:43:21','2025-03-04 04:43:21'),(8,8,'7 AM to 8 AM','2025-04-03','2025-05-15','2025-04-01 14:06:38','2025-04-01 14:06:38'),(9,10,'2 PM To 3 PM','2025-04-04','2025-05-16','2025-04-04 11:48:49','2025-04-04 11:48:49');
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
INSERT INTO `cache` VALUES ('7b52009b64fd0a2a49e6d8a939753077792b0554','i:1;',1743852455),('7b52009b64fd0a2a49e6d8a939753077792b0554:timer','i:1743852455;',1743852455),('9109c85a45b703f87f1413a405549a2cea9ab556','i:1;',1743911940),('9109c85a45b703f87f1413a405549a2cea9ab556:timer','i:1743911940;',1743911940),('all_products','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:19:\"App\\Models\\Products\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:1;s:19:\"product_category_id\";i:1;s:4:\"name\";s:66:\"Premium \"Learn Syntax\" Round Neck T-Shirt – Redeemable with Gems\";s:11:\"description\";s:942:\"Level up your coding style with our Premium \"Learn Syntax\" Branded T-Shirt – a perfect blend of comfort, class, and community. Designed for true learners and tech enthusiasts, this high-quality round neck tee proudly sports the Learn Syntax logo, making it more than just apparel – it’s a statement.\n\nCrafted from 100% premium cotton, this t-shirt offers a soft-touch feel, durable stitching, and a tailored fit for all-day comfort. Whether you’re attending a coding session, hanging out with fellow developers, or just chilling at home, this shirt keeps you in the zone.\n\nFeatures:\n\nHigh-quality fabric with breathable comfort\n\nClassic round neck design\n\nDurable print of the Learn Syntax logo\n\nUnisex fit, ideal for everyday wear\n\nAvailable in multiple sizes\n\nRedeemable using your gems – because learning should reward you in style!\n\nNote: Limited edition for our Learn Syntax community. Redeem now and wear your code with pride!\";s:6:\"points\";i:2499;s:8:\"imageUrl\";s:53:\"products/YWDefN2BFdzkFx8pBIwXfmiTBKwboU5VGkcNJRFU.jpg\";s:17:\"availableQuantity\";i:10;s:6:\"status\";s:6:\"active\";s:4:\"slug\";s:60:\"premium-learn-syntax-round-neck-t-shirt-redeemable-with-gems\";s:10:\"created_at\";s:19:\"2025-04-06 09:28:15\";s:10:\"updated_at\";s:19:\"2025-04-06 09:28:18\";}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:1;s:19:\"product_category_id\";i:1;s:4:\"name\";s:66:\"Premium \"Learn Syntax\" Round Neck T-Shirt – Redeemable with Gems\";s:11:\"description\";s:942:\"Level up your coding style with our Premium \"Learn Syntax\" Branded T-Shirt – a perfect blend of comfort, class, and community. Designed for true learners and tech enthusiasts, this high-quality round neck tee proudly sports the Learn Syntax logo, making it more than just apparel – it’s a statement.\n\nCrafted from 100% premium cotton, this t-shirt offers a soft-touch feel, durable stitching, and a tailored fit for all-day comfort. Whether you’re attending a coding session, hanging out with fellow developers, or just chilling at home, this shirt keeps you in the zone.\n\nFeatures:\n\nHigh-quality fabric with breathable comfort\n\nClassic round neck design\n\nDurable print of the Learn Syntax logo\n\nUnisex fit, ideal for everyday wear\n\nAvailable in multiple sizes\n\nRedeemable using your gems – because learning should reward you in style!\n\nNote: Limited edition for our Learn Syntax community. Redeem now and wear your code with pride!\";s:6:\"points\";i:2499;s:8:\"imageUrl\";s:53:\"products/YWDefN2BFdzkFx8pBIwXfmiTBKwboU5VGkcNJRFU.jpg\";s:17:\"availableQuantity\";i:10;s:6:\"status\";s:6:\"active\";s:4:\"slug\";s:60:\"premium-learn-syntax-round-neck-t-shirt-redeemable-with-gems\";s:10:\"created_at\";s:19:\"2025-04-06 09:28:15\";s:10:\"updated_at\";s:19:\"2025-04-06 09:28:18\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"name\";i:1;s:11:\"description\";i:2;s:6:\"points\";i:3;s:8:\"imageUrl\";i:4;s:17:\"availableQuantity\";i:5;s:4:\"slug\";i:6;s:6:\"status\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1743952195),('placed_students_active_homepage','O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:25;s:4:\"name\";s:19:\"Pramod Kumar Pandit\";s:7:\"content\";s:245:\"Pramod Kumar Pandit is a Ruby on Rails developer with 3 years of experience in backend development, RESTful APIs, and database optimization. He currently works at NetConnectGlobal and has previously worked at AspireEdge Solutions and Chetu, Inc.\";s:5:\"image\";s:59:\"placedstudent/Gs8Oegn4Oy6wI5XwkdxEih8kDLeZrJvBznq4V5if.webp\";s:8:\"position\";s:32:\"Ruby on Rails @ NetConnectGlobal\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:18:38\";s:10:\"updated_at\";s:19:\"2025-02-04 06:39:01\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:25;s:4:\"name\";s:19:\"Pramod Kumar Pandit\";s:7:\"content\";s:245:\"Pramod Kumar Pandit is a Ruby on Rails developer with 3 years of experience in backend development, RESTful APIs, and database optimization. He currently works at NetConnectGlobal and has previously worked at AspireEdge Solutions and Chetu, Inc.\";s:5:\"image\";s:59:\"placedstudent/Gs8Oegn4Oy6wI5XwkdxEih8kDLeZrJvBznq4V5if.webp\";s:8:\"position\";s:32:\"Ruby on Rails @ NetConnectGlobal\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:18:38\";s:10:\"updated_at\";s:19:\"2025-02-04 06:39:01\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:1;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:16;s:4:\"name\";s:13:\"Rishiraj Aman\";s:7:\"content\";s:291:\"Rishiraj Aman is a Senior Software Engineer at Persistent Systems, specializing in Azure Integration with 5 Azure certifications. He has experience with Azure Logic Apps, Functions, and DevOps. Previously, he worked at Capgemini and Enseur Digital, focusing on .NET and Laravel technologies.\";s:5:\"image\";s:59:\"placedstudent/SH7bBMMRlvFwFMkJEMdZzzvbJHrmzARXgTMPwjX2.webp\";s:8:\"position\";s:45:\"Senior Software Engineer @ Persistent Systems\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:05:05\";s:10:\"updated_at\";s:19:\"2025-02-04 06:08:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:16;s:4:\"name\";s:13:\"Rishiraj Aman\";s:7:\"content\";s:291:\"Rishiraj Aman is a Senior Software Engineer at Persistent Systems, specializing in Azure Integration with 5 Azure certifications. He has experience with Azure Logic Apps, Functions, and DevOps. Previously, he worked at Capgemini and Enseur Digital, focusing on .NET and Laravel technologies.\";s:5:\"image\";s:59:\"placedstudent/SH7bBMMRlvFwFMkJEMdZzzvbJHrmzARXgTMPwjX2.webp\";s:8:\"position\";s:45:\"Senior Software Engineer @ Persistent Systems\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:05:05\";s:10:\"updated_at\";s:19:\"2025-02-04 06:08:06\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:2;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:29;s:4:\"name\";s:8:\"Yash Raj\";s:7:\"content\";s:227:\"Yash Raj is a MERN Developer at Arramton Infotech Pvt. Ltd. since November 2022. He has also worked as a Back End Developer at MetroGhar during an internship. His skills include Node.js, MongoDB, and other related technologies.\";s:5:\"image\";s:59:\"placedstudent/ZghWpb0lZzEVnLzxTZVodIaUJocJLR19YHsrQg1W.webp\";s:8:\"position\";s:43:\"MERN Developer @ Arramton Infotech Pvt. Ltd\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:33:48\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:47\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:29;s:4:\"name\";s:8:\"Yash Raj\";s:7:\"content\";s:227:\"Yash Raj is a MERN Developer at Arramton Infotech Pvt. Ltd. since November 2022. He has also worked as a Back End Developer at MetroGhar during an internship. His skills include Node.js, MongoDB, and other related technologies.\";s:5:\"image\";s:59:\"placedstudent/ZghWpb0lZzEVnLzxTZVodIaUJocJLR19YHsrQg1W.webp\";s:8:\"position\";s:43:\"MERN Developer @ Arramton Infotech Pvt. Ltd\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:33:48\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:47\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:3;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:21;s:4:\"name\";s:14:\"Akhilesh Kumar\";s:7:\"content\";s:285:\"Akhilesh Kumar is a Software Developer at Swipewire Technologies with experience in full-stack development. He previously worked at Bunk Infotech Pvt. Ltd., specializing in Laravel and Node.js. He is passionate about learning new technologies and contributing to organizational growth.\";s:5:\"image\";s:59:\"placedstudent/y2oBS7Xblyib9RVRoGC0fRt1yYYkQoD5NiyxS9Fn.webp\";s:8:\"position\";s:43:\"Software Developer @ Swipewire Technologies\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:11:03\";s:10:\"updated_at\";s:19:\"2025-02-04 06:39:16\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:21;s:4:\"name\";s:14:\"Akhilesh Kumar\";s:7:\"content\";s:285:\"Akhilesh Kumar is a Software Developer at Swipewire Technologies with experience in full-stack development. He previously worked at Bunk Infotech Pvt. Ltd., specializing in Laravel and Node.js. He is passionate about learning new technologies and contributing to organizational growth.\";s:5:\"image\";s:59:\"placedstudent/y2oBS7Xblyib9RVRoGC0fRt1yYYkQoD5NiyxS9Fn.webp\";s:8:\"position\";s:43:\"Software Developer @ Swipewire Technologies\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:11:03\";s:10:\"updated_at\";s:19:\"2025-02-04 06:39:16\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:4;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:9;s:4:\"name\";s:11:\"Ayush Kumar\";s:7:\"content\";s:510:\"Ayush Kumar is currently a Solutions Developer at Tata Technologies in Pune, Maharashtra, India, since September 2022. Before this, he worked as a Software Engineer at TecHealerz Solutions, a Teaching Professional at TechVidya, and a Web Developer at Eventilators Private Limited. His expertise includes scripting, programming, and he has experience in both front-end and back-end development, working on multiple websites. Additionally, he has worked in Python and Data Analytics during his time at TechVidya.\";s:5:\"image\";s:59:\"placedstudent/iOjahehiGK7ZRA1oO6xM2IWx2mocbpBAacmvAkK2.webp\";s:8:\"position\";s:39:\"Solutions Developer @ Tata Technologies\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 05:53:13\";s:10:\"updated_at\";s:19:\"2025-02-04 05:53:17\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:9;s:4:\"name\";s:11:\"Ayush Kumar\";s:7:\"content\";s:510:\"Ayush Kumar is currently a Solutions Developer at Tata Technologies in Pune, Maharashtra, India, since September 2022. Before this, he worked as a Software Engineer at TecHealerz Solutions, a Teaching Professional at TechVidya, and a Web Developer at Eventilators Private Limited. His expertise includes scripting, programming, and he has experience in both front-end and back-end development, working on multiple websites. Additionally, he has worked in Python and Data Analytics during his time at TechVidya.\";s:5:\"image\";s:59:\"placedstudent/iOjahehiGK7ZRA1oO6xM2IWx2mocbpBAacmvAkK2.webp\";s:8:\"position\";s:39:\"Solutions Developer @ Tata Technologies\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 05:53:13\";s:10:\"updated_at\";s:19:\"2025-02-04 05:53:17\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}i:5;O:24:\"App\\Models\\PlacedStudent\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:15:\"placed_students\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:27;s:4:\"name\";s:12:\"Uttsav Kumar\";s:7:\"content\";s:260:\"Uttsav Kumar is a Full-stack Developer at Srchout Software, currently specializing in Laravel, React, and React Native. He previously interned at Srchout Software and CodingBhasha, where he gained experience in JavaScript, Livewire, and other web technologies.\";s:5:\"image\";s:59:\"placedstudent/MxsRsmBLXmkQUdZ04wW8vNm5ueoe7NZQh27b4Ccg.webp\";s:8:\"position\";s:39:\"Full-stack Developer @ Srchout Software\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:21:07\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:54\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:27;s:4:\"name\";s:12:\"Uttsav Kumar\";s:7:\"content\";s:260:\"Uttsav Kumar is a Full-stack Developer at Srchout Software, currently specializing in Laravel, React, and React Native. He previously interned at Srchout Software and CodingBhasha, where he gained experience in JavaScript, Livewire, and other web technologies.\";s:5:\"image\";s:59:\"placedstudent/MxsRsmBLXmkQUdZ04wW8vNm5ueoe7NZQh27b4Ccg.webp\";s:8:\"position\";s:39:\"Full-stack Developer @ Srchout Software\";s:6:\"status\";i:1;s:10:\"created_at\";s:19:\"2025-02-04 06:21:07\";s:10:\"updated_at\";s:19:\"2025-02-04 06:38:54\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}',1743953962);
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_student`
--

LOCK TABLES `course_student` WRITE;
/*!40000 ALTER TABLE `course_student` DISABLE KEYS */;
INSERT INTO `course_student` VALUES (4,1,19,0,2,'2025-02-11 03:31:46','2025-02-11 03:32:16',0),(5,1,21,0,2,'2025-02-17 06:14:00','2025-02-17 06:14:31',0),(8,1,7,0,2,'2025-02-18 09:04:26','2025-02-18 09:04:50',0),(9,1,20,0,2,'2025-02-19 04:41:18','2025-03-25 04:59:15',0),(10,1,16,0,2,'2025-02-19 05:42:46','2025-02-19 05:43:01',0),(11,1,17,0,2,'2025-02-21 06:10:42','2025-02-21 06:11:35',0),(12,5,32,0,4,'2025-02-24 02:52:33','2025-02-25 02:55:50',0),(13,4,35,0,3,'2025-02-25 13:59:10','2025-04-01 15:19:36',1),(14,5,30,0,4,'2025-02-25 16:49:14','2025-03-26 02:41:03',0),(15,4,33,0,3,'2025-02-27 10:23:34','2025-02-28 05:48:38',0),(16,5,34,0,4,'2025-02-28 01:50:34','2025-02-28 01:51:02',0),(17,5,31,0,4,'2025-02-28 03:09:55','2025-03-05 02:45:32',0),(18,4,32,0,3,'2025-02-28 04:53:50','2025-02-28 05:47:40',0),(19,1,22,0,2,'2025-02-28 19:33:26','2025-02-28 19:34:32',0),(20,2,40,0,6,'2025-03-04 04:43:05','2025-03-04 04:43:48',0),(21,4,36,0,3,'2025-03-04 05:48:06','2025-03-04 05:48:16',0),(22,5,37,0,4,'2025-03-05 01:45:20','2025-03-05 14:28:36',0),(23,5,44,0,4,'2025-03-06 02:11:07','2025-03-26 02:53:02',0),(24,4,27,0,3,'2025-03-06 04:31:44','2025-03-06 04:33:17',0),(25,2,41,0,6,'2025-03-07 10:32:37','2025-03-07 10:34:44',0),(26,2,45,0,6,'2025-03-07 10:32:56','2025-03-07 10:34:13',0),(27,2,48,0,6,'2025-03-07 17:00:29','2025-03-07 17:01:00',0),(28,2,17,0,6,'2025-03-10 03:55:55','2025-03-11 11:30:19',0),(29,2,47,0,6,'2025-03-11 10:50:29','2025-03-11 11:45:01',0),(30,6,43,0,NULL,'2025-03-11 11:55:47','2025-03-11 11:55:47',0),(31,5,54,0,4,'2025-03-17 02:36:43','2025-03-17 02:36:52',0),(32,2,34,0,6,'2025-03-18 03:57:58','2025-03-18 03:58:16',0),(36,2,53,0,6,NULL,'2025-03-25 12:58:31',0),(37,6,38,0,5,NULL,'2025-04-03 05:54:15',0),(38,2,13,0,6,NULL,'2025-04-03 23:20:43',0),(39,6,49,0,5,NULL,'2025-04-04 15:25:37',0),(40,5,67,0,4,NULL,'2025-04-06 09:14:24',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Python','python-basic-testing','Python','Kickstart your programming journey with Python! This course includes:\r\n✅ Python basics: Variables, loops, and functions\r\n✅ Object-oriented programming and file handling\r\n✅ Web development with Flask/Django\r\n✅ Data analysis and visualization with Pandas & Matplotlib\r\n✅ Automation and scripting\r\nIdeal for beginners and those looking to explore AI and data science!',8,'Sadique Hussain',2500,1500,2,'course_images/iTPdxkOjyqZBg4YG45EbUZFx7bvDMkvZlXnrtB6v.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-02 16:48:16','2025-03-25 09:26:44'),(2,'C Programming language','c-programming-language','CLANG001','Master the fundamentals of C programming with our comprehensive course! Whether you\'re a beginner or looking to strengthen your programming skills, this course will guide you through the core concepts of C, including:\r\n\r\n✅ Introduction to C – Understanding syntax, variables, and data types\r\n✅ Control Structures – Mastering loops, conditionals, and functions\r\n✅ Arrays & Pointers – Efficient data storage and memory management\r\n✅ Structures & File Handling – Organizing complex data and working with files\r\n✅ Memory Management – Dynamic allocation using malloc() and free()\r\n✅ Advanced Concepts – Recursion, bitwise operations, and multi-file programming\r\n\r\nBy the end of this course, you\'ll be able to write efficient C programs, understand memory management, and build real-world applications.',6,'Sadique Hussain',2000,1100,1,'course_images/kfsiiJYoHfT5obZ8jd19GraiKyfViiAzyeAD7jL8.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-02 18:50:32','2025-03-25 09:25:47'),(4,'C++ with object oriented programming for BCA, Btech','c-with-object-oriented-programming-for-bca-btech','CPP','Master C++ with a strong focus on Object-Oriented Programming (OOP) principles. This course is designed for BCA and B.Tech students, covering fundamental and advanced concepts like classes, objects, inheritance, polymorphism, encapsulation, and abstraction. Gain hands-on experience with real-world applications, data structures, and problem-solving techniques. Perfect for students aiming to build a strong foundation in C++ programming and software development.',6,'Syed Sadique Hussain',2500,1099,3,'course_images/BuUxK8DAH4GYIU72dGrqy5KKgRxxQdIBzdTph0lm.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-17 17:02:53','2025-03-25 09:25:07'),(5,'HTML5 & CSS3 with Tailwindcss4','html5-css3-with-tailwindcss4','WEB001','html css and tailwindcss 4',10,'syed sadique hussain',2500,1500,4,'course_images/BdmGj00wC51oeTpi5NJoPeoVl8vYFrFp0yMdE3PQ.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-24 02:22:26','2025-03-25 09:24:04'),(6,'Learn PHP from Scratch & Build Dynamic Websites','learn-php-from-scratch-build-dynamic-websites','PHP001','Are you ready to become a professional web developer? Our PHP batch is designed to take you from beginner to expert in web development. Learn how to build dynamic websites, work with databases, and create powerful web applications using PHP.',10,'Syed Sadique Hussain',3999,1999,4,'course_images/gIIu7semxtSmqcrRFou4Fb7to35sfCmnGscXdlys.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)	','2025-02-28 16:06:43','2025-03-25 09:22:38'),(8,'C Programming Online Live class','c-programming-online-live-class','OCLANG01',NULL,6,'Sadique Hussain',2500,1500,1,'course_images/UbHZBp9QFF4JCRDi5wClcXpRxlvVgY9JDvT2hhX9.png',1,'online','https://meet.google.com/otp-nzdp-qsg',NULL,NULL,NULL,'2025-04-01 13:11:13','2025-04-01 17:39:16'),(9,'VB.NET ','vbnet','OFVB01','This VB.NET (Visual Basic .NET) Course is designed for beginners to intermediate learners who want to develop Windows applications using the .NET framework. The course covers VB.NET syntax, object-oriented programming (OOP), database integration, and Windows Forms applications.\n\nCourse Objectives:\nBy the end of this course, participants will:\n✅ Understand the fundamentals of VB.NET and the .NET framework.\n✅ Learn object-oriented programming concepts such as classes, inheritance, and polymorphism.\n✅ Develop Windows Forms applications using GUI components.\n✅ Work with databases using ADO.NET and SQL Server.\n✅ Handle errors and exceptions efficiently.',6,'Sadique hussian',1999,1299,1,'course_images/ctrPrYecWE4JQWM7giA3KiZHgeabVs30INpcJwkN.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)','2025-04-03 23:35:52','2025-04-04 11:46:10'),(10,'Laravel 12 and Mysql','laravel-12-and-mysql','OFLV02','This Laravel 12 course provides a practical and comprehensive introduction to one of the most popular PHP frameworks. Tailored for beginners and intermediate developers, this course covers everything from Laravel\'s core concepts to advanced features introduced in Laravel 12. Learn how to build secure, scalable, and modern web applications using elegant syntax and developer-friendly tools.\nKey Features of Laravel 12:\nCleaner syntax with improved developer experience\n\nImproved performance and security features\n\nNew process layer for job pipelines\n\nEnhanced route handling and middleware\n\nNative support for modern PHP 8.x features\n\nUpdates to Laravel Breeze, Jetstream, and Livewire integration\n\nBy the end of this course, learners will: ✅ Understand the structure and workflow of a Laravel application\n✅ Build RESTful APIs and web apps with routing, controllers, and views\n✅ Work with Eloquent ORM and database migrations\n✅ Implement authentication and authorization\n✅ Master form validation, file uploads, and session management\n✅ Use Laravel\'s artisan commands, queues, events, and jobs\n✅ Learn the new features introduced in Laravel 12',6,'Sadique Hussain',3399,1799,4,'course_images/qeheEIKWiERfWN301SHnf8iylrCkBjDCUCfUYXen.png',1,'offline',NULL,NULL,NULL,'Ramavtar market, Gandhinagar, Madhubani Purnea - (Bihar)','2025-04-04 11:40:16','2025-04-04 11:48:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gem_transactions`
--

LOCK TABLES `gem_transactions` WRITE;
/*!40000 ALTER TABLE `gem_transactions` DISABLE KEYS */;
INSERT INTO `gem_transactions` VALUES (1,32,109,'earned','Welcome bonus for enrolling in course','2025-05-03 05:47:40','2025-04-03 05:47:40','2025-04-03 05:47:40'),(2,38,199,'earned','Welcome bonus for enrolling in course','2025-05-03 05:54:07','2025-04-03 05:54:07','2025-04-03 05:54:07'),(3,13,110,'earned','Welcome bonus for enrolling in course','2025-05-03 23:20:30','2025-04-03 23:20:30','2025-04-03 23:20:30'),(4,49,199,'earned','Welcome bonus for enrolling in course','2025-05-04 15:25:16','2025-04-04 15:25:16','2025-04-04 15:25:16'),(5,67,150,'earned','Welcome bonus for enrolling in course','2025-05-04 20:57:51','2025-04-04 20:57:51','2025-04-04 20:57:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_test_questions`
--

LOCK TABLES `mock_test_questions` WRITE;
/*!40000 ALTER TABLE `mock_test_questions` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_test_results`
--

LOCK TABLES `mock_test_results` WRITE;
/*!40000 ALTER TABLE `mock_test_results` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mock_tests`
--

LOCK TABLES `mock_tests` WRITE;
/*!40000 ALTER TABLE `mock_tests` DISABLE KEYS */;
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
INSERT INTO `password_reset_tokens` VALUES ('jhas57082@gmail.com','$2y$12$2Yhgz4hIqFr7S7uz2ib7Ke2kFQlGLUM8n0uviT06LeFQCLN4oGoLC','2025-04-04 10:21:27'),('shalinikushwaha317@gmail.com','$2y$12$LvOuRImn30txC2uTILRyZu8Ksw/JEcBvWewrd/gPGr1PZcskBk/gG','2025-03-24 10:37:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,34,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67e21818309c5','CASH-67e21818309c6',NULL,'RCPT-CRS-1742870552',NULL,NULL,NULL,'49.47.133.34','Course: C Programming language','2025-03-25 02:42:32',3,2025,'2025-03-25 02:42:32','2025-03-25 02:42:32'),(4,53,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67e297b75c579','CASH-67e297b75c57a',NULL,'RCPT-CRS-1742903223',NULL,NULL,NULL,'49.47.133.34','Course: C Programming language','2025-03-25 11:47:03',3,2025,'2025-03-25 11:47:03','2025-03-25 11:47:03'),(5,30,5,NULL,'course',1500.00,1500.00,0.00,'INR','cash','completed','captured','ORD-67e369321a00a','CASH-67e369321a00b',NULL,'RCPT-CRS-1742956850',NULL,NULL,NULL,'49.47.133.205','Course: HTML5 & CSS3 with Tailwindcss4','2025-03-26 02:40:50',3,2025,'2025-03-26 02:40:50','2025-03-26 02:40:50'),(6,54,NULL,NULL,'subscription',700.00,700.00,0.00,'INR','cash','completed','captured','ORD-67e369654cf64','CASH-67e369654c41f',NULL,'RCPT-SUB-1742956901',NULL,NULL,NULL,'49.47.133.205','Subscription Plan: 1-Month Plan','2025-03-11 02:41:41',3,2025,'2025-03-26 02:41:41','2025-03-26 02:41:41'),(7,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR','cash','completed','captured','ORD-67e36a67f3d8f','CASH-67e36a67f327f',NULL,'RCPT-SUB-1742957159',NULL,NULL,NULL,'49.47.133.205','Subscription Plan: 1-Month Plan','2025-03-26 02:45:59',3,2025,'2025-03-26 02:45:59','2025-03-26 02:45:59'),(8,18,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QBNPKUlsvnBANn',NULL,NULL,'COURSE_1742982826',NULL,NULL,NULL,'49.47.131.62',NULL,NULL,3,2025,'2025-03-26 09:53:47','2025-03-26 09:53:47'),(9,18,6,NULL,'course',1999.00,1999.00,0.00,'INR','razorpay','initiated','pending','order_QBNPUXcwoeQjiM',NULL,NULL,'COURSE_1742982836',NULL,NULL,NULL,'49.47.131.62',NULL,NULL,3,2025,'2025-03-26 09:53:56','2025-03-26 09:53:56'),(10,53,5,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QBgoCm34O3G2w9',NULL,NULL,'CRS_1743051150',NULL,NULL,NULL,'157.42.16.146',NULL,NULL,3,2025,'2025-03-27 04:52:30','2025-03-27 04:52:30'),(11,53,5,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QBgoEWyb1Xpsud',NULL,NULL,'CRS_1743051152',NULL,NULL,NULL,'157.42.16.146',NULL,NULL,3,2025,'2025-03-27 04:52:32','2025-03-27 04:52:32'),(12,20,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QBmL7XgdL7Mw02',NULL,NULL,'SUB_1743070627',NULL,NULL,NULL,NULL,NULL,NULL,3,2025,'2025-03-27 10:17:07','2025-03-27 10:17:08'),(13,20,NULL,NULL,'subscription',2047.00,2047.00,0.00,'INR',NULL,'initiated','pending','order_QBmOA3ttH0YDn7',NULL,NULL,'SUB_1743070801',NULL,NULL,NULL,NULL,NULL,NULL,3,2025,'2025-03-27 10:20:01','2025-03-27 10:20:01'),(14,59,2,NULL,'course',1100.00,1100.00,0.00,'INR','razorpay','initiated','pending','order_QCDnV0ivfzexXZ',NULL,NULL,'COURSE_1743167323',NULL,NULL,NULL,'110.226.36.4',NULL,NULL,3,2025,'2025-03-28 13:08:44','2025-03-28 13:08:44'),(15,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDgJYOuQhYhHmi',NULL,NULL,'SUB_1743486088',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 05:41:28','2025-04-01 05:41:30'),(16,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDgK55Od4AiMGs',NULL,NULL,'SUB_1743486120',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 05:42:00','2025-04-01 05:42:00'),(17,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBgLke8xtWjj',NULL,NULL,'SUB_1743520857',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:20:57','2025-04-01 15:20:59'),(18,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBkj8Uz8c5WT',NULL,NULL,'SUB_1743520862',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:21:02','2025-04-01 15:21:03'),(19,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBvfhCNsLXrZ',NULL,NULL,'SUB_1743520873',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:21:13','2025-04-01 15:21:13'),(20,35,NULL,NULL,'subscription',700.00,700.00,0.00,'INR',NULL,'initiated','pending','order_QDqBwecDGrhTej',NULL,NULL,'SUB_1743520874',NULL,NULL,NULL,NULL,NULL,NULL,4,2025,'2025-04-01 15:21:14','2025-04-01 15:21:14'),(21,12,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending',NULL,NULL,NULL,'CRS_1743603686',NULL,NULL,NULL,'122.164.74.237',NULL,NULL,4,2025,'2025-04-02 14:21:26','2025-04-02 14:21:26'),(22,32,4,NULL,'course',1099.00,1099.00,0.00,'INR','cash','completed','captured','ORD-67ee20fc60363','CASH-67ee20fc60364',NULL,'RCPT-CRS-1743659260',NULL,NULL,NULL,'49.47.129.51','Course: C++ with object oriented programming for BCA, Btech','2025-04-03 05:47:40',4,2025,'2025-04-03 05:47:40','2025-04-03 05:47:40'),(23,32,NULL,NULL,'subscription',700.00,700.00,0.00,'INR','cash','completed','captured','ORD-67ee214d23c41','CASH-67ee214d2322b',NULL,'RCPT-SUB-1743659341',NULL,NULL,NULL,'49.47.129.51','Subscription Plan: 1-Month Plan','2025-04-03 05:49:01',4,2025,'2025-04-03 05:49:01','2025-04-03 05:49:01'),(24,38,6,NULL,'course',1999.00,1999.00,0.00,'INR','cash','completed','captured','ORD-67ee227f299ee','CASH-67ee227f299ef',NULL,'RCPT-CRS-1743659647',NULL,NULL,NULL,'49.47.129.51','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-03 05:54:07',4,2025,'2025-04-03 05:54:07','2025-04-03 05:54:07'),(25,12,5,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QETnaIYqPK31Ks',NULL,NULL,'CRS_1743660354',NULL,NULL,NULL,'49.47.129.51',NULL,NULL,4,2025,'2025-04-03 06:05:54','2025-04-03 06:05:55'),(26,13,2,NULL,'course',1100.00,1100.00,0.00,'INR','cash','completed','captured','ORD-67eeca66c0b2a','CASH-67eeca66c0b2b',NULL,'RCPT-CRS-1743702630',NULL,NULL,NULL,'122.172.167.43','Course: C Programming language','2025-04-03 23:20:30',4,2025,'2025-04-03 23:20:30','2025-04-03 23:20:30'),(27,53,8,NULL,'course',1500.00,1500.00,0.00,'INR',NULL,'initiated','pending','order_QEr85Zcu1TWE5x',NULL,NULL,'CRS_1743742515',NULL,NULL,NULL,'157.35.79.42',NULL,NULL,4,2025,'2025-04-04 10:25:15','2025-04-04 10:25:16'),(28,49,6,NULL,'course',1999.00,1999.00,0.00,'INR','cash','completed','captured','ORD-67efac84ad4ab','CASH-67efac84ad4ac',NULL,'RCPT-CRS-1743760516',NULL,NULL,NULL,'152.58.133.211','Course: Learn PHP from Scratch & Build Dynamic Websites','2025-04-04 15:25:16',4,2025,'2025-04-04 15:25:16','2025-04-04 15:25:16'),(29,26,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QEyaJORFjmDsMF',NULL,NULL,'WS_1743768769',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-04 17:42:51','2025-04-04 17:42:51'),(30,26,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QEyaM7py4wq0df',NULL,NULL,'WS_1743768773',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-04 17:42:53','2025-04-04 17:42:53'),(31,26,NULL,NULL,'course',0.00,199.00,0.00,'INR',NULL,'initiated','pending','order_QEyaN0p6t3kv23',NULL,NULL,'WS_1743768774',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-04 17:42:54','2025-04-04 17:42:54'),(32,66,9,NULL,'course',1299.00,1299.00,0.00,'INR',NULL,'initiated','pending','order_QEyc0zs7gXJDDu',NULL,NULL,'CRS_1743768867',NULL,NULL,NULL,'152.56.134.195',NULL,NULL,4,2025,'2025-04-04 17:44:27','2025-04-04 17:44:28'),(33,26,2,NULL,'course',1100.00,1100.00,0.00,'INR',NULL,'initiated','pending','order_QEyjR418ln7m92',NULL,NULL,'CRS_1743769288',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:51:28','2025-04-04 17:51:29'),(34,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEyl5fFfQvwdqX',NULL,NULL,'CRS_1743769382',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:02','2025-04-04 17:53:03'),(35,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylGql3vd8iEg',NULL,NULL,'CRS_1743769393',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:13','2025-04-04 17:53:13'),(36,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylJh5ADBPNie',NULL,NULL,'CRS_1743769395',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:15','2025-04-04 17:53:16'),(37,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylMKvwQDQx7f',NULL,NULL,'CRS_1743769398',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:18','2025-04-04 17:53:18'),(38,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylPDzmyeTAeG',NULL,NULL,'CRS_1743769400',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:20','2025-04-04 17:53:21'),(39,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylRsmA6Vphjm',NULL,NULL,'CRS_1743769403',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:23','2025-04-04 17:53:23'),(40,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylVAz7cETyoU',NULL,NULL,'CRS_1743769406',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:26','2025-04-04 17:53:26'),(41,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylYiD5eh8yYC',NULL,NULL,'CRS_1743769408',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:28','2025-04-04 17:53:30'),(42,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEyldSMmWdo6Pf',NULL,NULL,'CRS_1743769413',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:33','2025-04-04 17:53:34'),(43,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEylg1Iy5jlKPF',NULL,NULL,'CRS_1743769416',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:53:36','2025-04-04 17:53:36'),(44,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEynpzPPXsDl50',NULL,NULL,'CRS_1743769538',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:55:38','2025-04-04 17:55:39'),(45,26,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QEyoOqUJI2yZNI',NULL,NULL,'CRS_1743769570',NULL,NULL,NULL,'223.190.138.121',NULL,NULL,4,2025,'2025-04-04 17:56:10','2025-04-04 17:56:11'),(46,67,5,NULL,'course',1500.00,1500.00,0.00,'INR','cash','completed','captured','ORD-67effa774c96e','CASH-67effa774c96f',NULL,'RCPT-CRS-1743780471',NULL,NULL,NULL,'152.58.189.65','Course: HTML5 & CSS3 with Tailwindcss4','2025-04-04 20:57:51',4,2025,'2025-04-04 20:57:51','2025-04-04 20:57:51'),(47,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEilPRmfqtbFW',NULL,NULL,'CRS_1743825595',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:29:55','2025-04-05 09:29:57'),(48,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEjFvubbv6RH6',NULL,NULL,'CRS_1743825624',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:30:24','2025-04-05 09:30:25'),(49,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEjKVfAJhshSE',NULL,NULL,'CRS_1743825628',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:30:28','2025-04-05 09:30:29'),(50,39,10,NULL,'course',1799.00,1799.00,0.00,'INR',NULL,'initiated','pending','order_QFEjQBhFjjq7PX',NULL,NULL,'CRS_1743825633',NULL,NULL,NULL,'152.59.142.230',NULL,NULL,4,2025,'2025-04-05 09:30:33','2025-04-05 09:30:34'),(51,67,NULL,NULL,'subscription',899.00,899.00,0.00,'INR','cash','completed','captured','ORD-67f1f87431ed0','CASH-67f1f874306fc',NULL,'RCPT-SUB-1743911028',NULL,NULL,NULL,'122.172.167.43','Subscription Plan: 1-Month Plan','2025-04-06 09:13:48',4,2025,'2025-04-06 09:13:48','2025-04-06 09:13:48');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_chapters`
--

LOCK TABLES `post_chapters` WRITE;
/*!40000 ALTER TABLE `post_chapters` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_courses`
--

LOCK TABLES `post_courses` WRITE;
/*!40000 ALTER TABLE `post_courses` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_my_posts`
--

LOCK TABLES `post_my_posts` WRITE;
/*!40000 ALTER TABLE `post_my_posts` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_topic_posts`
--

LOCK TABLES `post_topic_posts` WRITE;
/*!40000 ALTER TABLE `post_topic_posts` DISABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('3lbMBZ2L5jlbZwLknmSWRzwb95sGMLU3RnSZTIrk',32,'106.216.118.152','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOGh3SE9OZmViOXE4MWp5SW95VmpYMGNjRHVXRlJncTVZQjcxZ2FHRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2Fzc2lnbm1lbnRzL3ZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozMjtzOjg6IndlbGNvbWVkIjtiOjE7fQ==',1743953733),('5YAkQzmgo4NU0K7IOFQRy3e11QZtsY39O8fURMXl',62,'49.47.132.222','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiU0dtcFluTHJUZHBVckVzeU5WOXR3c0pYUXlUV3NxbHFmUkVOdzJqOSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjI7czoxMToidXNlcl9hdmF0YXIiO3M6OTY6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hL0FDZzhvY0xWUUJoNnhOeXpIN1NVMFE1eTZobkhuenRKc0JocVhZMlBia0lFMEdaNU5OUFVldz1zOTYtYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoid2VsY29tZWQiO2I6MTt9',1743953014),('8WN22f6YdyeB294bD4jn636fECgxpcOEsPFN9TtM',NULL,'152.56.153.39','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzFGY1FJSWthbkJXU3BRYkR5b2RkOHlnbTdkT0hqNTZSU2VkSE56WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1743952354),('aZ2u960jMwzSr1F5kgrmJWkBTolPi2v5m36ADUh9',30,'152.59.142.245','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV2IwNWpZUFROenJrVzJOUXZId0ltZ2dPVVhVWVFXYXF2d2YyMzJhZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2Fzc2lnbm1lbnRzL3ZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozMDtzOjg6IndlbGNvbWVkIjtiOjE7fQ==',1743953051),('bFH3g2DUaBm5ixLRA8MYL9s0zuC7cpNFlh5f3gty',57,'152.58.188.239','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTzJpRGM3T1BKYjdXc21RSDk1VUxDRVpRaTRXamlRbjF4MTM1YWtJOCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTc7czoxMToidXNlcl9hdmF0YXIiO3M6MTAwOiJodHRwczovL2xoMy5nb29nbGV1c2VyY29udGVudC5jb20vYS9BQ2c4b2NMQXdGOFJwVXQ5RUlSbFFpNXBPZDJHbS1BRjNKZkUzWHBpY0Yzdnp4ZFVEaGlUNENHcjdBPXM5Ni1jIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NjoiaHR0cHM6Ly93d3cubGVhcm5zeW50YXguY29tL3YyL2FkbWluL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1743953920),('e6nMEcoq8aSh7S4WsTSKQUJMgrw4g2vapwdLNNMW',34,'152.58.133.78','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMU9ESFNkSUppNzY2V3ZxZ2RlOEdVUmFud1k3emh2eldMdUNkS3JsdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9zdHVkZW50L2Fzc2lnbm1lbnRzL3ZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozNDtzOjg6IndlbGNvbWVkIjtiOjE7fQ==',1743952568),('GzOoMbAm0IrEe2Rb5UsscUVXVmbnx2GtyfYESdq8',NULL,'49.47.132.222','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidXIzS09aZW85UFlEMDVMN2lBU3RhdGR5R01vc3NTbXRLUTN0VmVqMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NToiZXJyb3IiO31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IkgwbG93UEtOclZFSlhGTGhBR2tFNXdiMm9ObVVaZXNUdFk1dUFzcG4iO30=',1743953402),('ipbA3uN1tZC4hEueZ3ffCUA9PjYi5ONY9Ck7VFeG',NULL,'152.58.188.239','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmdTcFQxc1ZucXBRTVNubGQ5d3RieWlsV1JlOW40dXoxek45WlV5UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2F1dGgvbG9naW4iO31zOjU6InN0YXRlIjtzOjQwOiJKd2pXb2FIN2tmWHJpYVE0aTBXbGs5RmJjcWs2STZaNnlIQU5JN3VQIjt9',1743953912),('JlhLHqKBJxBLzR9pd2cHqxMkt7bfsGVW0ioHbcc7',3,'152.58.187.30','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUTlhNGFSWDg5cXdseGVaMmV6TEF2RlB3dVhrQUpWRFhieVU2c3c2VyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjExOiJ1c2VyX2F2YXRhciI7czo5ODoiaHR0cHM6Ly9saDMuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2EvQUNnOG9jS1ZrbnhJV3RtTGluUUNnLXRwelJrYWlKS2FXWGdlYnVPX1JWOGJCRk5FN01hTHliMnI9czk2LWMiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjU0OiJodHRwczovL3d3dy5sZWFybnN5bnRheC5jb20vdjIvYWRtaW4vYXNzaWdubWVudC9tYW5hZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1743949711),('LYphWbcvdHgri15SSX9p0CeCyIDZ4uLJ1HL0jg5I',NULL,'152.56.153.39','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkdYN3Z2dnU5TUlxY1JxdnpuYkNsb05ENkhtRXo3dVkzT1hYSjN3VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2F1dGgvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YToxOntpOjA7czo1OiJlcnJvciI7fXM6MzoibmV3IjthOjA6e319fQ==',1743951754),('McuR87QOYVD8xjeF4iNqyRPHrYaiXBDv5AdRg5pf',NULL,'152.56.153.39','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRG1uT1czWGRMTVllSTZBeWU4eXcxOWcwajlieFRSRGVZbzFOaVc4RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTM4OiJodHRwczovL2xlYXJuc3ludGF4LmNvbS9hdXRoL3Jlc2V0LXBhc3N3b3JkLzVhN2I1NzRlZWVjN2FlNjIzMmU3MDU0ZmUyY2FiYzI5OWY4NmNhOGQzMWFmOGE0YTFkNTU5YWMyYjZjMGM2NDg/ZW1haWw9YXJqdWpoYWFyanUlNDBnbWFpbC5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1743951577),('NExuZG3M78hWkYYQpA2ntG9ZjXcgD0Gn8mXpgwoN',NULL,'49.47.132.222','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRjhFVWNVd0JqSHZ5bHFSV0hGSUNQNnY3SWU5MEQ2ZjlPME0wSlAzayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2F1dGgvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6InN0YXRlIjtzOjQwOiJNSzZ5TWdFT0JPTEJHcmdtOTRMb3VkckZLREZnbWx4cmdUZlV6aTBFIjt9',1743952954),('on71z4PZUetANocjUfKNmcblX5GecFeOBw1Mjkwt',NULL,'57.141.0.12','meta-externalagent/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGx1TGhZTVE3S1RHb0xMQzk5NGVZTzNTOUlqQ3R0enE4QzFWRlZMTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2ZyZWUtY291cnNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1743951533),('PDcQM2Ob58BS3DBmwaReSpIwDUFeneJD6gPFoihi',NULL,'51.210.144.71','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFRqMG1BcXl3UlBvQ3o0ZEdjdVRNMERTYmJYYWRjcEhFMVlSR1JpOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1743953050),('PlfVVqRUNnbXkg12cGrFg7lveQzKjBN5N9UhicHz',12,'152.59.144.180','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaEVQOFZkenJCTHg5emt0Y2hWZUh1cFNpTmtUNzBsSVR6VzFTY3l5eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS92Mi9hZG1pbi9hc3NpZ25tZW50L21hbmFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IkNudzExTzE5UTFJYkhNampjSXVDcVRQRW5ralRNTEh3TEV4YklqbVAiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEyO3M6MTE6InVzZXJfYXZhdGFyIjtzOjk4OiJodHRwczovL2xoMy5nb29nbGV1c2VyY29udGVudC5jb20vYS9BQ2c4b2NLRFRIOWJkemtCV1B4VEwtNUxhd3JfcHJmWjR3ZGlGNjExVThyT0o3Zmg5SmdCNDAzaD1zOTYtYyI7fQ==',1743947886),('QD5K9HjW8WV1V5BggOAU3yF8OLhxhPJ7pBkrPXCJ',NULL,'192.71.3.222','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.3','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVlleTRvMmFabktXSzhoZjVTeWhGS3ByUlAyOUVNWmlFQkxuUVVFRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1743949811),('qkgiMJBeZqeg9DWOJA5RnlYw9xnAjzvlRfNpbwPN',NULL,'85.208.96.196','Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoidlJjUkFGZmFkeDZyWHhjc2U5WmZteDdYRE1hZkJsUTNYNWVYMmNVaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2NvdXJzZXMvYy1wcm9ncmFtbWluZy1sYW5ndWFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1743946523),('qYpV1pUX3K2ePHxVjaPwLbeO7RtSm7ZRlwDvwFNF',NULL,'152.58.188.239','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiRFhZemZjOUdHTlJxaksyRVdaRnA1SjlORlhldmlVcTNOOTlJQkxxeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1743953902),('Rd9bcMNRCgZaF7PwToj7Sp2tyJ81p8xAuOt1PApm',NULL,'152.58.188.103','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1dIcGxlTDAyVzR4c1FZeTBNYmx3b3dUSzlaY3d4UVFVZWtnYkpkQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tIjt9czo1OiJzdGF0ZSI7czo0MDoiT3YwY0k0VjdIN1RLa1Rjek1wQXVnZEhYUzBwalM1NGtPdmZiNlJrZiI7fQ==',1743953597),('Sq5YuTDGplJQ97uh5LKdeOs97UAvMINVioP67p5W',54,'223.185.62.130','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoic3BUQm9VeEZ6emNYdWtVM0FKRXI5dm1EV3RKYmozQ0dhQXRBdlRYZCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUyOiJodHRwczovL3d3dy5sZWFybnN5bnRheC5jb20vc3R1ZGVudC9hc3NpZ25tZW50cy92aWV3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJzdGF0ZSI7czo0MDoiUGdHME9aeXdBTG1OME1VWHNMdDAxOTRzWHhBQkRhN1c5SzFyUzNjdiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTQ7czoxMToidXNlcl9hdmF0YXIiO3M6OTc6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hL0FDZzhvY0xzVWxHenZ3aEk3MHdCeFQyT2NmRFVkMFRQVXN6RW1iTFMtVEt2dG9xOUtvLVZBUkU9czk2LWMiO30=',1743952658),('T70y8zDjunfL0M8C9QKqkJKLTJtpUbgtvbgcGsrZ',NULL,'52.167.144.187','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidkZwMFdSdVJWeVlIYXI0bTlLNFNoQ2lUa0dmVElsOEdhYk1wa2UxZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vd3d3LmxlYXJuc3ludGF4LmNvbS9wcmFjdGljZS10ZXN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1743951218),('YJyIsydcvdmxCHxoKldG4OqPMfLelG4ExdXPhVsC',NULL,'85.208.96.199','Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3JHdFVvdFpyWlpHdTBwT3J3UEJDWTR1WXlsa3p2TGt3bFdjSHV3UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL2NvdXJzZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1743950968),('zglncsfyk2SIaF6UxbrhtiYKQOfQvoOMb9teONvB',NULL,'85.208.96.203','Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnFqVDZLRkk0YVNKRkk2N3hMQ3JSMWRpWjlBS1JWeGN1V1RSUTZwZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbGVhcm5zeW50YXguY29tL3ByaXZhY3ktcG9saWN5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1743951712);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,54,1,'2025-03-10 02:41:41','2025-04-09 02:41:41','active','completed','cash','CASH-67e369654c41f','2025-03-26 02:41:41','2025-03-26 02:41:41'),(2,32,1,'2025-02-24 02:45:59','2025-03-24 02:45:59','active','completed','cash','CASH-67e36a67f327f','2025-03-26 02:45:59','2025-03-26 02:45:59'),(3,32,1,'2025-04-03 05:49:01','2025-05-03 05:49:01','active','completed','cash','CASH-67ee214d2322b','2025-04-03 05:49:01','2025-04-03 05:49:01'),(4,67,1,'2025-04-06 09:13:48','2025-05-06 09:13:48','active','completed','cash','CASH-67f1f874306fc','2025-04-06 09:13:48','2025-04-06 09:13:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Shaique Aijaz','shaique.9434@gmail.com','8051860994','male','B.COM',1,1,'2025-02-02 17:05:33','','2025-01-13',NULL,'0',0,NULL,NULL,'101873','2025-02-10 10:16:46',1,NULL,'2025-02-02 17:04:52','2025-02-10 10:06:46'),(4,'sarita','saritaakumari24@gmail.com','9123267867','female','BCA',1,0,'2025-02-02 17:56:44','','2025-01-29',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-02 17:56:09','2025-02-02 17:56:44'),(5,'Smriti Kumari','smritikeshri141@gmail.com','7004664014','female','BCA',1,1,'2025-02-02 18:31:50','','2004-01-05',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-02 18:30:19','2025-02-18 09:29:55'),(6,'Smriti Keshri','keshrismriti@gmail.com','9934445985','female','BCA',0,0,NULL,'','2004-01-05',NULL,'0',0,NULL,NULL,'418753','2025-03-11 10:56:47',1,NULL,'2025-02-02 19:31:08','2025-03-11 10:46:47'),(7,'Smriti Keshri','keshrismriti124@gmail.com','9934445981','female','BCA',0,1,'2025-02-02 19:43:11','$2y$12$abCwqdXpD655Fa0Go4.0fu6z//.QztmYEhFP6KgkYVYtlX/yvKCsq','2004-01-05',NULL,'0',0,'Jfc2BD9ylg6lZLk8z9A6pydj311IvoCPYsQYtbtFMEO7sa9Y06KlIqXHJvAX',NULL,NULL,NULL,1,NULL,'2025-02-02 19:41:47','2025-03-29 09:25:15'),(8,'aditi keshri','aditikeshri21@gmail.com','7079565005','female','BCA',0,1,'2025-02-02 20:08:08','','2002-02-04',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-02 20:07:33','2025-02-02 20:09:51'),(9,'Nidhi  Bharti','knidhibharti8178@gmail.com','9263167817','female','BCA',0,0,NULL,'','2006-09-01',NULL,'0',0,NULL,NULL,'405731','2025-02-04 04:36:55',1,NULL,'2025-02-04 04:24:05','2025-02-04 04:26:55'),(10,'Puja Kumari','pujakumari11th2003@gmail.com','8789119882','female','BCA',0,0,NULL,'','2003-01-08',NULL,'0',0,NULL,NULL,'263990','2025-02-04 05:08:46',1,NULL,'2025-02-04 04:38:20','2025-02-04 04:58:46'),(11,'Nidhi Bharti','bhartinidhi178@gmail.com','9162520856','female','BCA',0,0,'2025-02-04 04:41:48','','2005-09-01',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-04 04:40:49','2025-02-04 04:41:48'),(12,'saurav kumar','kumarsaurav17742@gmail.com','9117442498','male','BCA',1,0,'2025-02-04 07:41:55','','2003-03-25',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-04 07:41:03','2025-02-04 07:41:55'),(13,'sadique hussain','comestrotechlabs@gmail.com','9876543125','male','BCA',0,1,'2025-02-05 05:45:17','','2017-01-04',NULL,'110',0,NULL,NULL,NULL,NULL,1,'LS00000013','2025-02-05 05:44:29','2025-04-06 09:20:36'),(14,'Abhishek Anand','anandavishek0007@gmail.com','6205733437','male','BCA',0,0,NULL,'','2004-11-06',NULL,'0',0,NULL,NULL,'292343','2025-02-06 06:02:45',1,NULL,'2025-02-06 05:49:10','2025-02-06 05:52:45'),(15,'aakash kumar','aakashkumar6505@gmail.com','9570812669','male','BCA',0,0,'2025-02-06 06:39:09','','2005-05-15',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-06 06:37:02','2025-02-28 01:52:52'),(16,'Md Jawaid Ali','mrd307449@gmail.com','8825118040','male','BCA',0,1,'2025-02-06 18:07:51','','2000-11-14',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-06 18:06:40','2025-03-10 16:34:56'),(17,'Priyanshu Bhattacharya','pkrb7945@gmail.com','9060573350','male','BCA',0,1,'2025-02-10 09:49:52','','2005-08-10',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-10 09:48:39','2025-03-12 06:05:11'),(18,'Aijaz','shaiqueaijaz.9434@gmail.com','9661620597','male','BBA',0,0,'2025-02-10 10:19:19','$2y$12$iU3Xcfa9OMgdCPoY1UH2Ne5wDSVVe/CnSI/grG4Fk6bPsbvA13k4C','2025-01-30',NULL,'0',0,'PjHvnndS9g1qHa8adsmimbPFumBQFBrRzIA3OqCW3jaqXuJFkJuL3EhNQuCG',NULL,'767920','2025-02-20 17:12:52',1,NULL,'2025-02-10 10:16:05','2025-03-26 09:58:15'),(19,'Soma sha','somasha09@gmail.com','9263970161','female','BCA',0,0,'2025-02-10 14:34:19','','1999-04-06',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-10 14:32:36','2025-03-10 14:59:00'),(20,'Chaman Kumar Das','chamandas254@gmail.com','8294365912','male','BCA',0,1,'2025-02-14 05:30:02','$2y$12$gfl4wJLRJpLphWSE4w9w0OslD5u7rRlSaR.vI/Y4CuRyh297q/pv2','2002-04-16',NULL,'0',0,'4RLxGUR4f5DaIlvF66Tn3Hkr6gC9iNFIrpNJK1522bR88A5Fc11j5IyFXh8h',NULL,NULL,NULL,1,NULL,'2025-02-14 03:45:36','2025-04-04 13:15:20'),(21,'shivam kumar','bcashivam11@gmail.com','9334354264','male','BCA',0,1,'2025-02-15 08:10:01','$2y$12$wH/RLY8SkPap8oxd24iqnu4cpNmzlm47a6wqhnApvUyINVSSyun5e','2004-03-12',NULL,'0',0,'KelLsY89zpr0pmhSmiam2R6gmPu36sdIRZN0w63wmOgQHRZeibb4JJMi8K1m',NULL,NULL,NULL,1,NULL,'2025-02-15 08:09:08','2025-04-04 13:15:17'),(22,'Kirti Kumari','k23keshri@gmail.com','6202388633','female','Others',0,0,'2025-02-17 04:02:49','$2y$12$fRlQti95GZgaRLhBRdXr8uKiYOO.65CrHn8w4jmxLtw4xbw7gQSBe','2002-01-02',NULL,'0',0,'JTnWHfoQq6XEShlXLaKcKlTf8oZ3mqLfJewgfVWBWmHjEojTLf6127tnNJfk',NULL,NULL,NULL,1,NULL,'2025-02-17 03:59:21','2025-04-04 13:15:14'),(23,'Aman Kumar','iamaman20082006@gmail.com','8677989323','male','BCA',0,0,'2025-02-17 06:56:50','','2006-08-20',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-17 06:56:13','2025-02-17 10:14:49'),(24,'Aman Kumra','theaman6826@gmail.com','8227046826','male','BCA',0,0,'2025-02-18 02:32:59','','2004-05-02',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-18 02:32:21','2025-03-05 06:39:03'),(25,'Trial','elegantrobinson6@getsafesurfer.com','7986987365','male','B.COM',0,0,'2025-02-18 17:30:22','','2003-10-15',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-18 17:30:03','2025-02-18 17:30:22'),(26,'Ankur Jha','akj41731@gmail.com','7763972896','male','Others',0,0,NULL,'','2006-12-25',NULL,'0',0,NULL,NULL,'974366','2025-02-18 19:42:56',1,NULL,'2025-02-18 19:31:37','2025-02-18 19:32:56'),(27,'Md Aasif','aliaarya70@gmail.com','8877127530','male','BCA',0,0,'2025-03-02 12:52:53','','2004-03-10',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-19 09:32:42','2025-03-16 15:16:48'),(28,'Suman Kumar','sumanmovies1200020@gmail.com','9162131629','male','BCA',0,0,'2025-02-20 01:41:37','','2004-01-01',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-20 01:41:01','2025-02-20 01:41:37'),(29,'shaique','msawork9334@gmail.com','8051862555','male','MCA',0,0,'2025-02-20 17:05:11','','2025-02-12',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-20 17:04:32','2025-02-20 17:05:11'),(30,'Ria','riamohann@gmail.com','9142978301','female','Others',0,0,'2025-02-25 02:49:01','$2y$12$RT9R/pI3.uCzlENQWIraEO5gk4K/aF40xnL3dBdchi2tiJ3DQS/SK','2005-04-12',NULL,'0',0,'NOqFQRE1Ajv2G2LNnStuk167ZakQwWW4p5z5k0SUB8S8420okP49nnBvQOP2',NULL,NULL,NULL,0,'LS00000030','2025-02-21 13:03:00','2025-04-05 11:36:04'),(31,'Rani Ara','ararani402@outlook.com','8102879165','female','BCA',0,0,'2025-02-25 03:17:26','','2002-07-18',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-24 01:48:44','2025-03-17 03:16:26'),(32,'Abhishek Kumar','abhirahul028@gmail.com','9199032431','male','BCA',0,1,'2025-02-24 02:49:32','$2y$12$XQGEYXO4MuXmNUAxUf493eLkRl8on21MEvdpd3zvq2IiXi46wgC8u','2006-04-14',NULL,'109',0,'I0LOCcwLNlnL0NYtXt4kNgeyJlmhofVuDM2rpsfG95sTESaQn2ejZQoW60bV',NULL,NULL,NULL,1,NULL,'2025-02-24 02:48:27','2025-04-03 05:49:01'),(33,'Deep saha','deepsaha221205221205@gmail.com','9470410017','male','BCA',0,0,'2025-02-25 04:52:54','','2005-12-22',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-24 05:41:32','2025-03-16 07:25:12'),(34,'Jay Yadav','jy510914@gmail.com','9110134326','male','BCA',0,1,'2025-02-25 02:58:10','$2y$12$bh0cyu9xDsXK7JHX.OCFj.k0Kd6O1VVhJsgF0zrGNWpF81KVQGNOK','2004-06-06',NULL,'0',0,'gVSfb4634ubQTlbymCpvXYdLnn241Fi0Zyx9jujqycpyShKrCaMYZtWt1Iux',NULL,NULL,NULL,1,NULL,'2025-02-25 02:51:17','2025-03-24 11:39:50'),(35,'Rupesh Saha','rupeshsaha899@gmail.com','8207528958','male','BCA',0,0,'2025-02-25 03:50:33','$2y$12$EU/BmWVg3pA4Q.MTcxHKcOdtQ4ghfY6hDAwt.uPUiesktEA.DiuZK','2005-05-25',NULL,'0',0,'1qRCwN24MDY8qR1ibLUKHvhOzFG0I5Bn0IGVgodUzGIT2MhRpJIrB5I2ZdBW',NULL,NULL,NULL,1,NULL,'2025-02-25 03:49:50','2025-04-01 15:18:18'),(36,'Shalini Kumari','shalinikushwaha317@gmail.com','6299040053','female','BCA',0,1,'2025-02-28 05:48:13','','2007-03-31',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-02-26 11:12:08','2025-03-16 13:48:41'),(37,'Arju kumari','ajjuaarju950@gmail.com','8102412189','female','BCA',0,0,'2025-03-02 15:12:18','','2025-03-02',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-02 15:11:12','2025-03-19 02:51:58'),(38,'Anand','ka582916@gmail.com','9334742579','male','BCA',0,0,'2025-03-03 02:50:50','','2006-06-09',NULL,'199',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-03 02:48:55','2025-04-03 05:54:07'),(39,'Rishav Ranjan','rishuyadav970822@gmail.com','8603733231','male','BCA',0,0,'2025-03-03 05:11:08','','2006-03-15',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-03 05:09:47','2025-03-03 05:11:08'),(40,'chandravardhan','chandravardhan9955@gmail.com','7700899779','male','BCA',0,1,'2025-03-04 04:33:25','$2y$12$30Pwt/Utdf428GnNcY6vhOH64BqcJ.keW1rUTF7xijVm1ASspAkHW','2006-02-03',NULL,'0',0,'nR7FMy8OLkZhvKDu53S8eiTiKxMbEXmMXkfMG68CQ0HsXiET1IVAjJMumYK9',NULL,NULL,NULL,1,NULL,'2025-03-04 04:31:44','2025-03-25 10:51:15'),(41,'Arya anand','manishsha9939@gmail.com','7970476426','male','Others',0,0,'2025-03-05 11:44:19','$2y$12$cTTfx6yI0AHP2IXrnwjVueHqgHwzTl3lKbnEqsiWmEKX/v2VFsS9a','2007-03-17',NULL,'0',0,'drB658zTsZRxa6OjKwi0GVHh2jxkSDqDafiLOUHHZBlUzKqW4A7TIR5j2jwM',NULL,NULL,NULL,1,NULL,'2025-03-05 11:42:59','2025-03-28 05:19:11'),(42,'Shreya','shreyaa8673@gmail.com','7979018292','female','BCA',0,0,'2025-03-05 15:23:58','','2005-04-28',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-05 15:23:01','2025-03-19 04:01:50'),(43,'Deepika sen','sendeepika9333@gmail.com','9798208512','female','BCA',0,1,'2025-03-11 11:53:50','$2y$12$fqbLYasT.OK/.XR57OVHLegBoxtBvdbvG5ztsm42yaFoMxPCOLiX6','2005-01-15',NULL,'0',0,'pVEjWVQOFdXKXloDolrWdZTOuRSh12gWCpmO49ysOTc3c9BYLh6w92jhXMEl',NULL,NULL,NULL,1,NULL,'2025-03-05 15:24:25','2025-04-01 10:01:08'),(44,'Gouravkumarjha','gouravjha371@gmail.com','9199605519','male','BCA',0,1,'2025-03-06 01:53:16','','2006-03-16',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-06 01:52:16','2025-03-19 14:53:59'),(45,'Abhinav poddar','poddarabhinav52@gmail.com','9631179271','male','BCA',0,0,'2025-03-06 13:31:12','$2y$12$eWurccFuGAYvq4CWLRuwmu59HLhQko.yQgHUg2dlEKCw18SG8CdRS','2007-05-23',NULL,'0',0,'lWFWYWKhbr8RHvm7se2OLzZ0xK5xEe4RkvZ8RmtKkD2cTVg1QqF3fxmUY0bZ',NULL,NULL,NULL,1,NULL,'2025-03-06 13:30:35','2025-04-04 13:14:49'),(46,'Kishlay Krishnan','kishlaykrishnan@gmail.com','6205298625','male','BCA',0,0,'2025-03-07 06:26:22','','2006-08-06',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-07 06:24:52','2025-03-09 13:13:38'),(47,'Prabhakar Kumar Singh','prabhakarkumarsingh578@gmail.com','9142656092','male','Others',0,0,'2025-03-07 08:59:21','','2007-10-25',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-07 08:57:13','2025-03-19 17:16:13'),(48,'Rishav Raj','rishavraj993194@gmail.com','9931945540','male','BCA',0,0,'2025-03-07 16:46:11','$2y$12$TIOpG0RpjUt.yDKuYWT10.Lt3S7MSbSW6BCnBUJ45SdrDY1KH.I.2','2004-04-30',NULL,'0',0,'bKrj88VoEbgHp8SwK2mNrTHpqWO8H660YJGpGAgFerBaUW15cwyvMMXT177D',NULL,NULL,NULL,1,NULL,'2025-03-07 16:45:29','2025-04-04 13:14:47'),(49,'Rishav','rishav7766941815@gmail.com','7766941815','male','BCA',0,0,'2025-03-09 02:54:12','','2005-09-05',NULL,'199',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-09 02:52:48','2025-04-04 15:25:16'),(50,'Aastha priya','aasthapriya185@gmail.com','7250409966','female','BCA',0,0,NULL,'','2005-09-05',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-09 03:45:57','2025-03-09 03:45:57'),(51,'Khushi  Kumari','khumarikhushi03@gmail.com','8292057979','female','BCA',0,0,'2025-03-09 11:29:36','','2005-08-22',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-09 11:28:48','2025-03-09 11:29:36'),(52,'Raman Kumar','ramankumardamha2001@gmail.com','6202891807','male','BCA',0,0,NULL,'','2001-09-01',NULL,'0',0,NULL,NULL,'967256','2025-03-10 15:25:52',1,NULL,'2025-03-10 15:13:12','2025-03-10 15:15:52'),(53,'Sakshi','jhas57082@gmail.com','8789122579','female','BCA',0,0,'2025-03-11 11:12:00','','2006-03-05',NULL,'0',0,NULL,NULL,'429765','2025-03-18 11:50:36',1,'STU00000053','2025-03-11 11:09:03','2025-03-29 07:08:08'),(54,'Muskan','muskankatyayan123@gmail.com','9523470620','female','Others',0,1,'2025-03-12 03:52:36','','2004-03-09',NULL,'0',0,NULL,NULL,NULL,NULL,1,'LS00000054','2025-03-11 13:48:55','2025-03-29 09:41:22'),(55,'sakshi kumari','abc@gmail.com','9304060153','female','BCA',0,0,NULL,'','2006-09-05',NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-12 05:02:39','2025-03-12 05:02:39'),(56,'Paras','p@gmail.com','8789118987',NULL,NULL,0,0,NULL,'$2y$12$2keaNVCdp.3Ge34FXuL0u.k4kt.zndWzQ3haN3v2y0ONOEejSYAtG',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-24 08:13:47','2025-03-24 08:13:47'),(57,'sadique hussain','sadique.hussain96@gmail.com','9546805580',NULL,NULL,1,0,NULL,'$2y$12$JE15fZKrJaKuN6FeMWF8zuvf8lutSgk3EFFX5uuUOs4gn9E4DhRFq',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-24 09:15:49','2025-03-24 09:15:49'),(58,'saurav','sauravkumar52778@gmail.com','6203051595',NULL,NULL,0,0,NULL,'$2y$12$ajfS.KLc.EhNJgg51rVUeO9Ez84lNVlHZcRZeguU7tUdxS7aE4x0e',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-24 16:35:10','2025-03-24 16:35:10'),(59,'learn syntax','learnsyntaxpurnea@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$ozWQsYj5hgcr1znT6SNlYONcMHDUisaVlJg/Eyf/e1fRUeOVHR/za',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-03-28 13:06:15','2025-03-28 13:06:15'),(60,'Abhishek Kumar','abhishekk78508@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$SqGxqlTMBqDrhi8NCcakDuumxRgMFL1GK47EnO6V6ITYQQvU6t1Vy',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-01 18:13:30','2025-04-01 18:13:30'),(61,'Arju Jha','arjujhaarju@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$TZylr0pWpOvY9F0M3F13D.bBEStljB2BooSrR5GH048aVBkO6rfy.',NULL,NULL,'0',0,'TneOvH3UC8wFiJJNnIZNBSD5AjdYh9SACAAuSz16gH2ttKzeckPvRM4747KQ',NULL,NULL,NULL,1,NULL,'2025-04-04 09:20:07','2025-04-06 16:46:03'),(62,'Rani Ara','ranirahi99396@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$OFlIbna0cWwmNd3pnsPtNuqklxZwcdyLXgEPSkF6F2aVxCaRBXnLW',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 09:21:37','2025-04-04 09:21:37'),(63,'vikash Aaryan14','vikasharyan323@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$GVyngMzhYEOC32/gbYrMeeB3BH48.4cE4Ll.hh.PDUGHz57uRLJz.',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 09:30:31','2025-04-04 09:30:31'),(64,'Nexus Purnea','nexuspurnea@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$ix429hKsGay7dHL5JHdpG.eIVuhIzz2PScRPHK8qbMec5p6mpGTgW',NULL,NULL,'0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 10:58:24','2025-04-04 13:08:53'),(65,'Rãçhitā Kùmãri','rachitak730@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$Mffm0ZchxI0ygg/29Wt8iOGlG5poBIibzahHkYbTss3yk0S5DH3cG',NULL,'https://lh3.googleusercontent.com/a/ACg8ocLUFOrJ5iG-HtKAzo55o0Ty7OBt03O081mMfdtIRpeOwvdXJX8j=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 15:11:01','2025-04-04 15:11:01'),(66,'Raman Sah','raman766423@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$w9T97mmMn9sSEQB2bFH4n.T3OJP4pmy77B8ss83oIKDCbGMDlBimm',NULL,'https://lh3.googleusercontent.com/a/ACg8ocKaYTsC6J0umQQs1mdSmdVj37bm1OMl2oJbz1EAlCFvMgZgPA=s96-c','0',0,NULL,NULL,NULL,NULL,1,NULL,'2025-04-04 17:43:43','2025-04-04 17:43:43'),(67,'Prithvi Raj Sahani','0707error@gmail.com',NULL,NULL,NULL,0,0,NULL,'$2y$12$8U1KMiyyWIWzOXjhiFYJZuhjxYb4PZEWlndxm8xdOS51S2qvIZ9Xq',NULL,'https://lh3.googleusercontent.com/a/ACg8ocIYdfbIi5nvdvUh219ygorX77DIqrMnm8julR613pRXxvxIDW0=s96-c','150',0,NULL,NULL,NULL,NULL,1,'LS00000067','2025-04-04 20:56:14','2025-04-06 09:13:48');
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
INSERT INTO `workshops` VALUES (2,'C++ crash course ','2025-04-12','9 AM  to 4PM','workshops/bMXXKRT2NPXelXLzYEDcxY2lVZYMB9QTmqO9o3Ro.jpg','1','199','[\"Testing \"]','pending','2025-04-05 16:43:19','2025-04-05 16:56:45');
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

-- Dump completed on 2025-04-06 15:55:43
