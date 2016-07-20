-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2016 at 10:47 AM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itmartdb`
--
CREATE DATABASE IF NOT EXISTS `itmartdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `itmartdb`;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ABC Compmany', '2016-07-18 08:02:42', '2016-07-18 08:02:42'),
(2, 'New compnay', '2016-07-18 08:16:55', '2016-07-18 08:16:55'),
(3, 'Comany xyz', '2016-07-18 08:17:44', '2016-07-18 08:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `company_member`
--

DROP TABLE IF EXISTS `company_member`;
CREATE TABLE IF NOT EXISTS `company_member` (
  `company_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_ate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_member`
--

INSERT INTO `company_member` (`company_id`, `member_id`, `created_at`, `updated_ate`) VALUES
(1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `address`, `updated_at`, `created_at`) VALUES
(2, 'Member A', 'high street ', '2016-07-18 07:50:35', '2016-07-18 06:47:03'),
(3, 'Member B', 'Mout lavinia', '2016-07-18 07:50:46', '2016-07-18 07:18:26'),
(4, 'Member C', 'high street ', '2016-07-18 07:53:19', '2016-07-18 07:53:19'),
(10, 'member D', 'Mout lavinia', '2016-07-18 08:15:35', '2016-07-18 08:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2015-12-28 02:45:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(1, 4),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Allison', 'Dev', 'allisondev782@gmail.com', '$2y$10$TowaYjXpskHcfXXp9QLY9.XUHXliG6UwbTeyJ43GRh6efpDkvugMa', 'oKSK3C8ve7prwk16kbEmnLFnt45S4J4oBkKoJ1MWl0csX2hFHHB6231M4DHg', '2016-06-22 23:22:11', '2016-06-22 17:52:11', NULL),
(4, '', NULL, 'chamindar2002@yahoo.com', '$2y$10$gkMOnqtpwSaIi5jMmoyFUOKzx45RjXvv5JX2ElOX/EGXr81mdtx7e', '4abtsEqPoMgEwAk2CZOAW8X9QTD1h846rjA1reDh6UA28nsY01J8lWx59RBP', '2016-07-18 08:18:33', '2016-07-18 02:48:33', NULL),
(13, '', NULL, 'mufeel.fls@gmail.com', '$2y$10$wy1koTtNKQzNFDUKuFCWQe7qaHjveZM0dBTzwAB7pFlLWD5GOEp8q', 'FEszpyLdexiDUmjOC7PrWCjYvPNHYyejIQqAjCtkacjmSOSSz6Q0bIG1QeYR', '2016-02-03 03:15:49', '2016-02-03 03:15:49', NULL),
(14, '', NULL, 'allison4fusion@gmail.com', '$2y$10$1kgQaQ1OO8m8FdG9Ncucj.J41.gJl39EEcxX85Xr92ZvVrqMJ7/Zy', 'hogFRgOiYFgoovKIh6RkO1xrgFBsOlcZYbvnZ7V6CnD5wiN8QFtn01tFmPAU', '2016-02-17 22:47:19', '2016-02-17 22:47:19', NULL),
(15, '', NULL, 'chamindar2002@gmail.com', '$2y$10$cTtgWctuhQ/JRRQACE6J.OEU8Id75XsO8WL9jvp5OPQ4KZBRx2o6C', '5f5Sb1ReyRi5ym07MC2SLWi43CvSTbMpA7U3838swxkBzLdebiAU6VB1poNr', '2016-06-22 22:05:08', '2016-06-22 16:35:08', NULL),
(16, '', NULL, 'chamindar200210@gmail.com', '$2y$10$IW5.esELayw1SGn.hA18GOhx/7yrIs8Xox/3Icz7b2ttUBNPeNcPq', '5veZhx8I5HqUKm5BjeisDFwyPXDRzG1au5oka7ucT3nOez0NUxCiRHfNqzMw', '2016-06-27 01:39:56', '2016-06-26 20:09:56', NULL),
(17, '', NULL, 'desilvadasith@gmail.com', '$2y$10$4s2EKSSJNh10OlMxtR8IhOrWtev4LXO.McNEqMhjzI8Q5VNNBq.rm', 'GO9hUUPYyCEijebPLSvp6bmDAhY6mMBvGzDAKtQ5BnrCYc5fhzhuyxGUV1P1', '2016-06-22 04:24:05', '2016-06-21 22:54:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

DROP TABLE IF EXISTS `fb_ad_media`;
CREATE TABLE IF NOT EXISTS `fb_ad_media` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `media_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'file name',
  `original_file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'original_file name',
  `media_extension` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '.jpg, .gif, etc',
  `video_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('image','video') COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'file size',
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
