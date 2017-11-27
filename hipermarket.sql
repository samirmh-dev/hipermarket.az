-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2017 at 09:49 AM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hipermarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `kateqoriyalar`
--

CREATE TABLE IF NOT EXISTS `kateqoriyalar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kateqoriya_ad` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `multi` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kateqoriya_ad` (`kateqoriya_ad`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `kateqoriyalar`
--

INSERT INTO `kateqoriyalar` (`id`, `kateqoriya_ad`, `slug`, `multi`, `created_at`, `updated_at`) VALUES
(15, 'kateqoriya 1', 'kateqoriya-1', 0, '2017-09-13 18:47:54', '2017-09-13 18:47:54'),
(16, 'kateqoriya 2', 'kateqoriya-2', 1, '2017-09-13 18:49:50', '2017-09-13 18:49:50'),
(17, 'kateqoriya 3', 'kateqoriya-3', 1, '2017-09-13 18:53:02', '2017-09-23 13:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `mallar`
--

CREATE TABLE IF NOT EXISTS `mallar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kod` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kod` (`kod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=110 ;

--
-- Dumping data for table `mallar`
--

INSERT INTO `mallar` (`id`, `kod`, `created_at`, `updated_at`) VALUES
(89, '1231231231', '2017-09-24 12:03:46', '2017-09-24 12:03:46'),
(90, 'a23dasdasd', '2017-09-24 12:06:56', '2017-09-24 12:06:56'),
(93, '213123', '2017-09-24 12:13:59', '2017-09-24 12:13:59'),
(94, 'asdasdqw211', '2017-09-24 12:17:57', '2017-09-24 12:17:57'),
(95, 'asdasdqw211fefe', '2017-09-24 12:18:30', '2017-09-24 12:18:30'),
(96, 'vfvdfv', '2017-09-24 12:19:07', '2017-09-24 12:19:07'),
(99, '12e122', '2017-09-28 16:32:41', '2017-09-28 16:32:41'),
(101, '122', '2017-09-28 16:38:36', '2017-09-28 16:38:36'),
(102, '12332ed2', '2017-10-15 07:53:35', '2017-10-15 07:53:35'),
(106, '12e12', '2017-10-15 09:21:30', '2017-10-15 09:21:30'),
(107, '123', '2017-10-18 22:51:47', '2017-10-18 22:51:47'),
(108, '12e12e', '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(109, '31231212f', '2017-10-18 22:53:15', '2017-10-18 22:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-ad`
--

CREATE TABLE IF NOT EXISTS `mallar-ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ad` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_mal_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=102 ;

--
-- Dumping data for table `mallar-ad`
--

INSERT INTO `mallar-ad` (`id`, `ad`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(81, 'mal1', 89, '2017-09-24 12:03:46', '2017-10-18 22:50:24'),
(82, 'asdadqw', 90, '2017-09-24 12:06:56', '2017-10-18 22:50:18'),
(85, '32e2e', 93, '2017-09-24 12:13:59', '2017-10-18 22:50:10'),
(86, 'asdasda', 94, '2017-09-24 12:17:57', '2017-10-18 22:50:02'),
(87, 'asdasda', 95, '2017-09-24 12:18:30', '2017-10-18 22:49:48'),
(88, 'aasdasd', 96, '2017-09-24 12:19:07', '2017-10-18 22:49:40'),
(91, '2e12', 99, '2017-09-28 16:32:41', '2017-10-18 22:49:33'),
(93, '132asda', 101, '2017-09-28 16:38:36', '2017-10-18 22:49:27'),
(94, '123', 102, '2017-10-15 07:53:35', '2017-10-18 22:49:21'),
(98, '12r2', 106, '2017-10-15 09:21:30', '2017-10-18 22:47:17'),
(99, 'ad', 107, '2017-10-18 22:51:47', '2017-10-18 22:52:57'),
(100, 'asda', 108, '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(101, 'sdqwdqwd', 109, '2017-10-18 22:53:15', '2017-10-18 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-endirim`
--

CREATE TABLE IF NOT EXISTS `mallar-endirim` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faiz` int(11) NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `mallar-endirim`
--

INSERT INTO `mallar-endirim` (`id`, `faiz`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(58, 25, 106, '2017-10-18 22:47:17', '2017-10-18 22:47:17'),
(59, 20, 101, '2017-10-18 22:49:27', '2017-10-18 22:49:27'),
(60, 40, 95, '2017-10-18 22:49:48', '2017-10-18 22:49:48'),
(61, 20, 93, '2017-10-18 22:50:10', '2017-10-18 22:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-kateqoriya`
--

CREATE TABLE IF NOT EXISTS `mallar-kateqoriya` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kateqoriya` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_mal_id` (`fk_mal_id`),
  KEY `kateqoriya` (`kateqoriya`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `mallar-kateqoriya`
--

INSERT INTO `mallar-kateqoriya` (`id`, `kateqoriya`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(28, '15', 89, '2017-09-24 12:03:46', '2017-10-18 22:50:24'),
(29, '15', 90, '2017-09-24 12:06:56', '2017-10-18 22:50:18'),
(32, '15', 93, '2017-09-24 12:13:59', '2017-10-18 22:50:10'),
(33, '15', 94, '2017-09-24 12:17:57', '2017-10-18 22:50:02'),
(34, '15', 95, '2017-09-24 12:18:30', '2017-10-18 22:49:48'),
(35, '15', 96, '2017-09-24 12:19:07', '2017-10-18 22:49:40'),
(38, '15', 99, '2017-09-28 16:32:41', '2017-10-18 22:49:33'),
(40, '15', 101, '2017-09-28 16:38:36', '2017-10-18 22:49:27'),
(41, '15', 102, '2017-10-15 07:53:35', '2017-10-18 22:49:21'),
(45, '15', 106, '2017-10-15 09:21:30', '2017-10-18 22:47:17'),
(46, '15', 107, '2017-10-18 22:51:47', '2017-10-18 22:52:57'),
(47, '15', 108, '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(48, '16_33', 109, '2017-10-18 22:53:15', '2017-10-18 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-melumat`
--

CREATE TABLE IF NOT EXISTS `mallar-melumat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `melumat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=102 ;

--
-- Dumping data for table `mallar-melumat`
--

INSERT INTO `mallar-melumat` (`id`, `melumat`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(81, 'asdasdasda', 89, '2017-09-24 12:03:46', '2017-10-18 22:50:24'),
(82, 'aszxvsdaskdoqpdkpefkspdopaosdk', 90, '2017-09-24 12:06:56', '2017-10-18 22:50:18'),
(85, 'asdasdas', 93, '2017-09-24 12:13:59', '2017-10-18 22:50:10'),
(86, 'dqwdqwdqwd', 94, '2017-09-24 12:17:57', '2017-10-18 22:50:02'),
(87, 'dqwdqwdqwd', 95, '2017-09-24 12:18:30', '2017-10-18 22:49:48'),
(88, 'qwd', 96, '2017-09-24 12:19:07', '2017-10-18 22:49:40'),
(91, 'e12e12e', 99, '2017-09-28 16:32:41', '2017-10-18 22:49:33'),
(93, 'asdasd', 101, '2017-09-28 16:38:36', '2017-10-18 22:49:27'),
(94, '123123', 102, '2017-10-15 07:53:35', '2017-10-18 22:49:21'),
(98, 'fasdasd', 106, '2017-10-15 09:21:30', '2017-10-18 22:47:17'),
(99, 'asdasd', 107, '2017-10-18 22:51:47', '2017-10-18 22:52:57'),
(100, 'qwqe12', 108, '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(101, 'asdasda', 109, '2017-10-18 22:53:15', '2017-10-18 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-olcu`
--

CREATE TABLE IF NOT EXISTS `mallar-olcu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `olcu` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=505 ;

--
-- Dumping data for table `mallar-olcu`
--

INSERT INTO `mallar-olcu` (`id`, `olcu`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(485, '22', 106, '2017-10-18 22:47:17', '2017-10-18 22:47:17'),
(486, 'w2', 102, '2017-10-18 22:49:21', '2017-10-18 22:49:21'),
(487, '2', 101, '2017-10-18 22:49:27', '2017-10-18 22:49:27'),
(488, '22', 99, '2017-10-18 22:49:33', '2017-10-18 22:49:33'),
(489, '2e2', 96, '2017-10-18 22:49:40', '2017-10-18 22:49:40'),
(490, '2', 96, '2017-10-18 22:49:40', '2017-10-18 22:49:40'),
(491, '2e2', 95, '2017-10-18 22:49:48', '2017-10-18 22:49:48'),
(492, '45', 94, '2017-10-18 22:50:02', '2017-10-18 22:50:02'),
(493, '46', 94, '2017-10-18 22:50:02', '2017-10-18 22:50:02'),
(494, '45', 93, '2017-10-18 22:50:10', '2017-10-18 22:50:10'),
(495, '12', 90, '2017-10-18 22:50:18', '2017-10-18 22:50:18'),
(496, '13', 90, '2017-10-18 22:50:18', '2017-10-18 22:50:18'),
(497, '22', 89, '2017-10-18 22:50:24', '2017-10-18 22:50:24'),
(499, '22', 108, '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(500, '22', 107, '2017-10-18 22:52:57', '2017-10-18 22:52:57'),
(504, '222', 109, '2017-10-18 23:53:19', '2017-10-18 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-qiymet`
--

CREATE TABLE IF NOT EXISTS `mallar-qiymet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qiymet` int(11) NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=96 ;

--
-- Dumping data for table `mallar-qiymet`
--

INSERT INTO `mallar-qiymet` (`id`, `qiymet`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(77, 123, 89, '2017-10-18 11:50:24', '2017-10-18 22:50:24'),
(78, 2252, 90, '2017-10-18 11:50:18', '2017-10-18 22:50:18'),
(81, 233, 93, '2017-10-18 11:50:10', '2017-10-18 22:50:10'),
(82, 23232, 94, '2017-10-18 11:50:02', '2017-10-18 22:50:02'),
(83, 23232, 95, '2017-10-18 11:49:48', '2017-10-18 22:49:48'),
(84, 22, 96, '2017-10-18 11:49:40', '2017-10-18 22:49:40'),
(85, 55, 99, '2017-10-18 11:49:33', '2017-10-18 22:49:33'),
(87, 222, 101, '2017-10-18 11:49:27', '2017-10-18 22:49:27'),
(88, 12312, 102, '2017-10-18 11:49:21', '2017-10-18 22:49:21'),
(92, 12, 106, '2017-10-18 11:47:17', '2017-10-18 22:47:17'),
(93, 123, 107, '2017-10-18 11:52:57', '2017-10-18 22:52:57'),
(94, 123, 108, '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(95, 222, 109, '2017-10-18 12:53:19', '2017-10-18 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-sekil`
--

CREATE TABLE IF NOT EXISTS `mallar-sekil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=135 ;

--
-- Dumping data for table `mallar-sekil`
--

INSERT INTO `mallar-sekil` (`id`, `name`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(117, '1506251026508.jpg', 89, '2017-09-24 12:03:48', '2017-09-24 12:03:48'),
(118, '1506251216185.jpg', 90, '2017-09-24 12:06:58', '2017-09-24 12:06:58'),
(121, '1506251640583.jpg', 93, '2017-09-24 12:14:02', '2017-09-24 12:14:02'),
(122, '1506251877125.jpg', 94, '2017-09-24 12:17:59', '2017-09-24 12:17:59'),
(123, '1506251910950.jpg', 95, '2017-09-24 12:18:32', '2017-09-24 12:18:32'),
(124, '1506251947145.jpg', 96, '2017-09-24 12:19:10', '2017-09-24 12:19:10'),
(125, '1506612761800.jpg', 99, '2017-09-28 16:32:43', '2017-09-28 16:32:43'),
(127, '1506613116385.jpg', 101, '2017-09-28 16:38:39', '2017-09-28 16:38:39'),
(128, '1508050415242.jpg', 102, '2017-10-15 07:53:38', '2017-10-15 07:53:38'),
(129, '1508050511745.jpg', 102, '2017-10-15 07:55:13', '2017-10-15 07:55:13'),
(130, '1508050553665.jpg', 101, '2017-10-15 07:55:55', '2017-10-15 07:55:55'),
(131, '1508055690809.jpg', 106, '2017-10-15 09:21:33', '2017-10-15 09:21:33'),
(132, '1508327507993.jpg', 107, '2017-10-18 22:51:50', '2017-10-18 22:51:50'),
(133, '1508327560849.jpg', 108, '2017-10-18 22:52:43', '2017-10-18 22:52:43'),
(134, '1508327595353.jpg', 109, '2017-10-18 22:53:19', '2017-10-18 22:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-stok`
--

CREATE TABLE IF NOT EXISTS `mallar-stok` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stok` tinyint(1) NOT NULL DEFAULT '1',
  `fk_mal_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=93 ;

--
-- Dumping data for table `mallar-stok`
--

INSERT INTO `mallar-stok` (`id`, `stok`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(74, 1, 89, '2017-09-24 12:03:46', '2017-10-18 22:50:24'),
(75, 1, 90, '2017-09-24 12:06:56', '2017-10-18 22:50:18'),
(78, 1, 93, '2017-09-24 12:14:00', '2017-10-18 22:50:10'),
(79, 1, 94, '2017-09-24 12:17:57', '2017-10-18 22:50:02'),
(80, 0, 95, '2017-09-24 12:18:30', '2017-10-18 22:49:48'),
(81, 1, 96, '2017-09-24 12:19:07', '2017-10-18 22:49:40'),
(82, 1, 99, '2017-09-28 16:32:41', '2017-10-18 22:49:33'),
(84, 0, 101, '2017-09-28 16:38:36', '2017-10-18 22:49:27'),
(85, 1, 102, '2017-10-15 07:53:35', '2017-10-18 22:49:21'),
(89, 1, 106, '2017-10-15 09:21:30', '2017-10-18 22:47:17'),
(90, 1, 107, '2017-10-18 22:51:47', '2017-10-18 22:52:57'),
(91, 1, 108, '2017-10-18 22:52:40', '2017-10-18 22:52:40'),
(92, 1, 109, '2017-10-18 22:53:15', '2017-10-18 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `mallar-xususiyyet`
--

CREATE TABLE IF NOT EXISTS `mallar-xususiyyet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `xususiyyetAdi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xususiyyet` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_mal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_mal_id` (`fk_mal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=227 ;

--
-- Dumping data for table `mallar-xususiyyet`
--

INSERT INTO `mallar-xususiyyet` (`id`, `xususiyyetAdi`, `xususiyyet`, `fk_mal_id`, `created_at`, `updated_at`) VALUES
(221, '22', '3r', 101, '2017-10-18 22:49:27', '2017-10-18 22:49:27'),
(222, '123', 'rr', 101, '2017-10-18 22:49:27', '2017-10-18 22:49:27'),
(223, 'asd', 'asd', 99, '2017-10-18 22:49:33', '2017-10-18 22:49:33'),
(224, '2', '22', 96, '2017-10-18 22:49:40', '2017-10-18 22:49:40'),
(226, '123', '3123', 107, '2017-10-18 22:52:57', '2017-10-18 22:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_02_09_225721_create_visitor_registry', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2017_08_17_204939_create_categories_table', 1),
(5, '2017_08_17_210151_create_mehsuls_table', 1),
(6, '2017_08_18_142223_create_multi_categories_table', 1),
(7, '2017_08_20_120643_create_stoks_table', 1),
(8, '2017_08_20_124643_pages', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multi-kateqoriyalar`
--

CREATE TABLE IF NOT EXISTS `multi-kateqoriyalar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kateqoriya_ad` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_kateqoriya_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_kateqoriya_id` (`fk_kateqoriya_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `multi-kateqoriyalar`
--

INSERT INTO `multi-kateqoriyalar` (`id`, `kateqoriya_ad`, `slug`, `fk_kateqoriya_id`, `created_at`, `updated_at`) VALUES
(33, 'Multi Kateqoriya 1', 'multi-kateqoriya-1', 16, '2017-09-13 18:53:29', '2017-09-13 18:53:29'),
(34, 'Multi Kateqoriya 2', 'multi-kateqoriya-2', 16, '2017-09-13 18:53:44', '2017-09-13 18:53:44'),
(35, 'Multi Kateqoriya 3', 'multi-kateqoriya-3', 17, '2017-09-23 13:37:39', '2017-09-23 13:37:39'),
(36, 'Multi Kateqoriya 4', 'multi-kateqoriya-4', 17, '2017-09-23 13:37:48', '2017-09-23 13:37:48'),
(37, 'Multi Kateqoriya 5', 'multi-kateqoriya-5', 17, '2017-09-23 13:37:55', '2017-09-23 13:37:55'),
(38, 'Multi Kateqoriya 6', 'multi-kateqoriya-6', 17, '2017-09-23 13:38:04', '2017-09-23 13:38:04'),
(39, 'Multi Kateqoriya 7', 'multi-kateqoriya-7', 17, '2017-09-23 13:38:14', '2017-09-23 13:38:14'),
(40, 'Multi Kateqoriya 8', 'multi-kateqoriya-8', 17, '2017-09-23 13:38:25', '2017-09-23 13:38:25'),
(41, 'Multi Kateqoriya 9', 'multi-kateqoriya-9', 17, '2017-09-23 13:38:39', '2017-09-23 13:38:39'),
(42, 'Multi Kateqoriya 10', 'multi-kateqoriya-10', 17, '2017-09-23 13:38:54', '2017-09-23 13:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mal` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `img`, `title`, `mal`, `created_at`, `updated_at`) VALUES
(16, '1508329702558.jpg', 'melumat 1', 109, '2017-10-18 23:28:22', '2017-10-18 23:28:22'),
(17, '1508329719117.jpg', 'melumat 2', 108, '2017-10-18 23:28:39', '2017-10-18 23:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ad` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soyad` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `email_token` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ad`, `soyad`, `username`, `isAdmin`, `email_token`, `email_confirmed`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'samir', 'mh', 'samirmh', 1, '', 1, 'samir.mammadhasanov@gmail.com', '$2y$10$8lGRjomxVQMLjmk8Q1fL..71mzJ7c/Wc.tgzby4xs4JYhgRRh7ykq', '5GTPdLP5JdK169of30VxVD0BKYlywGdTYzfP0HWdYJjuuABWENH7vxRSmwWC', '2017-09-19 18:31:12', '2017-09-20 11:28:01'),
(15, 'afn', 'transport', 'afn', 0, '', 1, 'samirakerimova@afntransport.az', '$2y$10$bGYACkLwvMl5ctJRZ7yRw.XIscti1m9e6F2onB8aJuG7mD24XrKtm', 'A35bcE38NLX4IAYANUhg0aasqWL7w4DMvXzCFoXt8GhJmuCtxNycUSF287HA', '2017-11-05 00:23:50', '2017-11-05 00:25:20');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mallar-ad`
--
ALTER TABLE `mallar-ad`
  ADD CONSTRAINT `mallar-ad_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-endirim`
--
ALTER TABLE `mallar-endirim`
  ADD CONSTRAINT `mallar-endirim_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-kateqoriya`
--
ALTER TABLE `mallar-kateqoriya`
  ADD CONSTRAINT `mallar-kateqoriya_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-melumat`
--
ALTER TABLE `mallar-melumat`
  ADD CONSTRAINT `mallar-melumat_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-olcu`
--
ALTER TABLE `mallar-olcu`
  ADD CONSTRAINT `mallar-olcu_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-qiymet`
--
ALTER TABLE `mallar-qiymet`
  ADD CONSTRAINT `mallar-qiymet_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-sekil`
--
ALTER TABLE `mallar-sekil`
  ADD CONSTRAINT `mallar-sekil_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-stok`
--
ALTER TABLE `mallar-stok`
  ADD CONSTRAINT `mallar-stok_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mallar-xususiyyet`
--
ALTER TABLE `mallar-xususiyyet`
  ADD CONSTRAINT `mallar-xususiyyet_ibfk_1` FOREIGN KEY (`fk_mal_id`) REFERENCES `mallar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `multi-kateqoriyalar`
--
ALTER TABLE `multi-kateqoriyalar`
  ADD CONSTRAINT `multi-kateqoriyalar_ibfk_1` FOREIGN KEY (`fk_kateqoriya_id`) REFERENCES `kateqoriyalar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
