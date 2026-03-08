/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - english_ai
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`english_ai` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `english_ai`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

insert  into `cache`(`key`,`value`,`expiration`) values 
('laravel-cache-aviansh@gmail.com|127.0.0.1','i:2;',1772986265),
('laravel-cache-aviansh@gmail.com|127.0.0.1:timer','i:1772986265;',1772986265);

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `conversations` */

DROP TABLE IF EXISTS `conversations`;

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_message` varchar(255) DEFAULT NULL,
  `ai_message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `conversations` */

insert  into `conversations`(`id`,`user_message`,`ai_message`,`created_at`,`updated_at`) values 
(1,'hhello','I think you meant to say \"Hello\"','2026-03-08 10:43:58',NULL),
(2,'hhello','A friendly greeting!\n\nThe correct spelling is: \"Hello\"','2026-03-08 10:44:01',NULL),
(3,'i want to learn english','That\'s a great start! Here\'s a corrected version of your sentence:\n\n\"I want to learn English.\"\n\nThis is grammatically correct and concise. Well done!','2026-03-08 10:44:25',NULL),
(4,'my name is bhanu i love cricket','Nice to meet you, Bhanu! Here\'s a corrected version of your sentence:\n\n\"My name is Bhanu, and I love cricket.\"\n\nLet me know if you have any other sentences you\'d like me to review!','2026-03-08 13:44:33',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('22sMqkXjVo86M9CnoydnOtaKteVI89wtCZUpdtqY',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidjc2dVY3U1ZqZVk4RFFmZHhiTGdBSVNPWDNxcXhJbzlUMnR0dmlMaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=',1772987189),
('oXjZstwfKCJQO24ap3ppNwpUb3xx0Ddri0sVpISc',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSW5lRXFnMmtweGNoQzhjTkVJbE5OTmRLdldLemlDYW5pT05WNzNHZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbXMvbGlzdGVuaW5nIjtzOjU6InJvdXRlIjtzOjEzOiJjbXMubGlzdGVuaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE0OiJzcGVha2luZ19sZXZlbCI7czo4OiJhZHZhbmNlZCI7fQ==',1772986177);

/*Table structure for table `user_sessions` */

DROP TABLE IF EXISTS `user_sessions`;

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `sentence` text DEFAULT NULL,
  `user_text` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_sessions` */

insert  into `user_sessions`(`id`,`type`,`level`,`sentence`,`user_text`,`score`,`feedback`,`created_at`,`updated_at`) values 
(1,'speaking','beginner','she is studying english','she is studying english',100,'Excellent pronunciation!','2026-03-08 15:15:40','2026-03-08 15:15:40'),
(2,'speaking','beginner','ill be happy to help you with that','i will be happy',49,'Try again and speak clearly.','2026-03-08 15:15:54','2026-03-08 15:15:54'),
(3,'speaking','beginner','i am going to the store','i am going to the score',96,'Excellent pronunciation!','2026-03-08 15:16:03','2026-03-08 15:16:03'),
(4,'speaking','beginner','my cat is sleeping','my cat is sleeping',100,'Excellent pronunciation!','2026-03-08 15:16:11','2026-03-08 15:16:11'),
(5,'speaking','beginner','the sun is shining','the sun is shining',100,'Excellent pronunciation!','2026-03-08 15:16:19','2026-03-08 15:16:19'),
(6,'speaking','beginner','i eat breakfast early','i eat breakfast early',100,'Excellent pronunciation!','2026-03-08 15:16:28','2026-03-08 15:16:28'),
(7,'speaking','beginner','my dog runs quickly','my dog runs quickly',100,'Excellent pronunciation!','2026-03-08 15:16:37','2026-03-08 15:16:37'),
(8,'speaking','beginner','i am feeling tired','i am feeling tired',100,'Excellent pronunciation!','2026-03-08 15:16:45','2026-03-08 15:16:45'),
(9,'speaking','beginner','i enjoy hiking','i enjoy hiking',100,'Excellent pronunciation!','2026-03-08 15:16:52','2026-03-08 15:16:52'),
(10,'speaking','intermediate','i love playing piano','i love playing piano',100,'Excellent pronunciation!','2026-03-08 15:18:32','2026-03-08 15:18:32'),
(11,'speaking','beginner','i go to school tomorrow','go to school tomorrow',95,'Excellent pronunciation!','2026-03-08 15:18:41','2026-03-08 15:18:41'),
(12,'speaking','intermediate','the baby is laughing loudly','the baby is laughing loudly',100,'Excellent pronunciation!','2026-03-08 15:18:50','2026-03-08 15:18:50'),
(13,'speaking','intermediate','the park is beautiful','the park is beautiful',100,'Excellent pronunciation!','2026-03-08 15:18:58','2026-03-08 15:18:58'),
(14,'speaking','beginner','the dog is barking loudly','dog is barking loudly',91,'Excellent pronunciation!','2026-03-08 15:19:07','2026-03-08 15:19:07'),
(15,'speaking','intermediate','i need a dictionary','i need a dictionary',100,'Excellent pronunciation!','2026-03-08 15:20:46','2026-03-08 15:20:46'),
(16,'speaking','intermediate','the teacher is smiling','the teacher is smiling',100,'Excellent pronunciation!','2026-03-08 15:20:54','2026-03-08 15:20:54'),
(17,'speaking','intermediate','i wear a watch','i wear a watch',100,'Excellent pronunciation!','2026-03-08 15:21:05','2026-03-08 15:21:05'),
(18,'speaking','beginner','the dog wags its tail','the dog wax is its tail',91,'Excellent pronunciation!','2026-03-08 15:21:11','2026-03-08 15:21:11'),
(19,'speaking','beginner','the weather is warm today','weather is warm today',91,'Excellent pronunciation!','2026-03-08 15:21:20','2026-03-08 15:21:20'),
(20,'speaking','intermediate','i live in london','i live in london',100,'Excellent pronunciation!','2026-03-08 15:21:28','2026-03-08 15:21:28'),
(21,'speaking','beginner','the baby is sleeping','the baby sleeping',92,'Excellent pronunciation!','2026-03-08 15:21:36','2026-03-08 15:21:36'),
(22,'speaking','intermediate','i like reading books','i like reading books',100,'Excellent pronunciation!','2026-03-08 15:21:45','2026-03-08 15:21:45'),
(23,'speaking','intermediate','the book is mine','the book is mine',100,'Excellent pronunciation!','2026-03-08 15:21:53','2026-03-08 15:21:53'),
(24,'speaking','intermediate','my friend is coming tonight','my friend is coming tonight',100,'Excellent pronunciation!','2026-03-08 15:22:01','2026-03-08 15:22:01'),
(25,'speaking','intermediate','the teacher is giving us homework','the teacher is giving us homework',100,'Excellent pronunciation!','2026-03-08 15:22:11','2026-03-08 15:22:11'),
(26,'speaking','intermediate','i have a meeting tomorrow','i have a meeting tomorrow',100,'Excellent pronunciation!','2026-03-08 15:22:19','2026-03-08 15:22:19'),
(27,'speaking','intermediate','the cat is very lazy','the cat is very lazy',100,'Excellent pronunciation!','2026-03-08 15:25:18','2026-03-08 15:25:18'),
(28,'speaking','intermediate','the hotel room is very small','hotel room is very small',92,'Excellent pronunciation!','2026-03-08 15:25:29','2026-03-08 15:25:29'),
(29,'speaking','intermediate','the new employee starts work on monday','new employee start work on monday',93,'Excellent pronunciation!','2026-03-08 15:25:38','2026-03-08 15:25:38'),
(30,'speaking','intermediate','the music is too loud','music is too loud',89,'Try again and speak clearly.','2026-03-08 15:25:47','2026-03-08 15:25:47'),
(31,'speaking','intermediate','i attend concerts regularly','i attend concert regularly',98,'Excellent pronunciation!','2026-03-08 15:25:56','2026-03-08 15:25:56'),
(32,'speaking','intermediate','im studying abroad in japan','i am studying abroad in japan',96,'Excellent pronunciation!','2026-03-08 15:26:05','2026-03-08 15:26:05'),
(33,'speaking','intermediate','the weather forecast warns of heavy rain tonight','the weather forecast want to of heavy rain tonight',94,'Excellent pronunciation!','2026-03-08 15:26:17','2026-03-08 15:26:17'),
(34,'speaking','advanced','the traffic is terrible today','the traffic is terrible today',100,'Excellent pronunciation!','2026-03-08 15:26:37','2026-03-08 15:26:37'),
(35,'speaking','advanced','the novel was a surprise hit','the noble gases surprise hit',82,'Try again and speak clearly.','2026-03-08 15:26:59','2026-03-08 15:26:59'),
(36,'speaking','advanced','the debate has been raging for centuries','the debate has been ragging for centuries',99,'Excellent pronunciation!','2026-03-08 15:27:10','2026-03-08 15:27:10'),
(37,'speaking','advanced','the debate has been raging for centuries','did you pet has been ragging for centuries',76,'Try again and speak clearly.','2026-03-08 15:27:21','2026-03-08 15:27:21'),
(38,'listening','beginner','i am reading a book','i am reading about',86,'Good job.','2026-03-08 16:18:55','2026-03-08 16:18:55'),
(39,'listening','intermediate','he is eating an apple','he is eating an apple',100,'Excellent listening!','2026-03-08 16:20:12','2026-03-08 16:20:12'),
(40,'listening','intermediate','i am buying milk today','i am buying milk today',100,'Excellent listening!','2026-03-08 16:20:56','2026-03-08 16:20:56'),
(41,'listening','intermediate','the dog is very happy','the dog is very happy',100,'Excellent listening!','2026-03-08 16:21:35','2026-03-08 16:21:35'),
(42,'listening','beginner','she has a new phone','she has uniform',59,'You heard some parts correctly.','2026-03-08 16:23:25','2026-03-08 16:23:25'),
(43,'listening','intermediate','i am making breakfast now','i am making breakfast now',100,'Excellent listening!','2026-03-08 16:24:42','2026-03-08 16:24:42'),
(44,'listening','intermediate','im planning to attend the concert tonight','i am planing to attend the consert tonight',94,'Excellent listening!','2026-03-08 16:25:35','2026-03-08 16:25:35');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Avinash','avinash@gmail.com',NULL,'$2y$12$vuIXgBPJLxPGusgW9o.Zr.6Pky9joRBdLH8.6VqiowqWelGFCvxmm',NULL,'2026-03-08 09:37:18','2026-03-08 09:37:18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
