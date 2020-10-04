/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.8-MariaDB : Database - dating_app
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `likes` */

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(10) unsigned NOT NULL,
  `to_user` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `likes` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_10_02_111826_create_user_profiles_table',2),(5,'2020_10_02_124623_create_like_statuses_table',2),(6,'2020_10_02_125920_create_user_profiles_table',3),(7,'2020_10_02_125945_create_likes_table',3),(8,'2020_10_02_151455_add_columm_to_proflie_table',4);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values ('sakib2439@gmail.com','$2y$10$cdgqppgIcNYM0hox0vB.yuPual2.Y6GBZDIEjgI76.bOlWg.lmGK.','2020-10-04 03:58:03');

/*Table structure for table `user_profiles` */

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint(3) unsigned NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_profiles` */

insert  into `user_profiles`(`id`,`user_id`,`date_of_birth`,`gender`,`photo`,`created_at`,`updated_at`,`latitude`,`longitude`) values (1,1,'2020-10-06',1,'profile-20201004060352.jpg','2020-10-04 05:37:41','2020-10-04 06:03:52',23.82,91.7782033),(2,2,'2002-12-30',2,NULL,'2020-10-04 10:06:19','2020-10-04 10:06:19',23.83,91.7782033),(3,3,'1997-06-10',1,NULL,'2020-10-04 10:07:22','2020-10-04 10:07:40',23.84,91.7782033),(4,4,'2002-02-05',2,NULL,'2020-10-04 10:08:48','2020-10-04 10:08:48',23.85,91.7782033);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Asiful Islam Sakib','sakib2439@gmail.com',NULL,'$2y$10$/SSWTQ9GA3z1Mwe/2f6PE.Ilqj9JmckSBaUvXe1aw2DCB3Cn5fIs.',NULL,'2020-10-04 05:37:41','2020-10-04 06:11:00'),(2,'Jorina Begum','jorina@gmail.com',NULL,'$2y$10$AFKaZ4T8Qcjx3lpQmH34JO9PV5kz3oXcCmBz3SFiNT8njhazFuC6G',NULL,'2020-10-04 10:06:19','2020-10-04 10:06:19'),(3,'Abdul Kuddus','kuddus@gmail.com',NULL,'$2y$10$09v8NoHCbN1ovatOFQEVEu8eKMOznNWishQHGPpCzjIuDzIlfEq1W',NULL,'2020-10-04 10:07:22','2020-10-04 10:07:22'),(4,'Oporajita Chatterje','oporajita@gmail.com',NULL,'$2y$10$FJVjtVTSNa.ZGFjqK587XuBHgz.paa3.0oe7v6GnWKZXkC1bfLw9y',NULL,'2020-10-04 10:08:48','2020-10-04 10:08:48');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
