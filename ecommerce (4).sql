-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 28, 2026 at 01:11 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintable`
--

DROP TABLE IF EXISTS `admintable`;
CREATE TABLE IF NOT EXISTS `admintable` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(150) NOT NULL,
  `adminpassword` varchar(150) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`admin_id`, `admin_username`, `adminpassword`) VALUES
(1, 'b72f6e2cba66f789794b3bf19d1b1ab6', '376201e37956aa9d46b8b6b63bfb02bd');

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

DROP TABLE IF EXISTS `businesses`;
CREATE TABLE IF NOT EXISTS `businesses` (
  `product_ID` int NOT NULL AUTO_INCREMENT,
  `businessname` varchar(150) NOT NULL,
  `productname` varchar(150) NOT NULL,
  `sellingprice` varchar(11) NOT NULL,
  `filename` blob NOT NULL,
  `businesstype` varchar(150) NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`product_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`product_ID`, `businessname`, `productname`, `sellingprice`, `filename`, `businesstype`, `status`) VALUES
(4, 'shoprite', 'scones', 'R100', 0x44455349474e2e504e47, 'Pharmacy', 0),
(5, 'picknpay', 'scones', 'R1004', 0x576861747341707020496d61676520323032332d31312d30342061742031332e32322e30372e6a706567, 'Pharmacy', 1),
(6, 'shoprite', 'scones', 'R101', 0x636865657461682e6a7067, 'Pharmacy', 1),
(7, 'shoprite', 'glass', 'R50', 0x62616265732e706e67, 'Restaurant', 1),
(8, 'shoprite', 'mic', 'R60', 0x556e7469746c65642064657369676e2e706e67, 'Restaurant', 1),
(9, 'shoprite', 'glass', 'R21', 0x2e2e43686f707065642d53616c61642e6a7067, 'Restaurant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

DROP TABLE IF EXISTS `claims`;
CREATE TABLE IF NOT EXISTS `claims` (
  `claim_id` int NOT NULL AUTO_INCREMENT,
  `claimantname` varchar(150) NOT NULL,
  `claimantemail` varchar(600) NOT NULL,
  `claimantcontacts` varchar(100) NOT NULL,
  `rewardtype` varchar(150) NOT NULL,
  `paymentmethod` varchar(150) NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`claim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`claim_id`, `claimantname`, `claimantemail`, `claimantcontacts`, `rewardtype`, `paymentmethod`, `status`) VALUES
(1, 'Nkeletseng', 'nkeletseng@gmail.com', '', 'Referral Rewards', 'Loyalty Rewards', 1),
(2, 'Refuoehape Khasake', 'k5refuoehape@gmail.com', '+26665478965', 'Loyalty Rewards', 'Referral Rewards', 1),
(4, 'edwin', 'edwinmatlatsa@gmail.com', '08264902431', 'Referral Rewards', 'Referral Rewards', 0),
(5, 'edwin', 'edwinmatlatsa@gmail.com', '08264902431', 'Referral Rewards', 'Task-based rewards', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `media_id` (`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `media_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 15, 8, 'love it', '2026-02-20 08:41:39'),
(2, 18, 3, 'love it', '2026-03-02 12:07:00'),
(3, 19, 9, 'love it', '2026-03-02 12:29:04'),
(4, 19, 9, 'love it', '2026-03-02 12:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `caller_ID` int NOT NULL AUTO_INCREMENT,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` int NOT NULL,
  `message` varchar(250) NOT NULL,
  `status` varchar(20) DEFAULT 'Unresolved',
  PRIMARY KEY (`caller_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`caller_ID`, `fullnames`, `email`, `phone`, `message`, `status`) VALUES
(1, 'baby Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'baby my love', '1'),
(2, 'baby Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'baby my love', '0'),
(3, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'how to create account', '0'),
(4, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'how to create account', '0'),
(6, 'Refuoehape', 'bosy@gmail.com', 2147483647, 'please come over', '0'),
(7, 'lineo koki', 'lineo@gmail.com', 2147483647, 'registration does not work', '0'),
(8, 'lineo koki', 'lineo@gmail.com', 2147483647, 'registration does not work', '0'),
(9, 'lineo koki', 'krefuoehape@gmail.com', 2147483647, 'registration does not work', '0'),
(10, 'lineo koki', 'krefuoehape@gmail.com', 2147483647, 'registration does not work', '0'),
(11, 'Refuoehape', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'how to create account', '1'),
(12, 'Refuoehape', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'how to create account', '1'),
(14, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'please come over', '1'),
(15, 'zake', 'zake@gmail.com', 2147483647, 'hello', '1'),
(16, 'zake', 'zake@gmail.com', 2147483647, 'hello', '1');

-- --------------------------------------------------------

--
-- Table structure for table `emailtable`
--

DROP TABLE IF EXISTS `emailtable`;
CREATE TABLE IF NOT EXISTS `emailtable` (
  `email_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `emailtable`
--

INSERT INTO `emailtable` (`email_id`, `email`) VALUES
(3, 'krefuoehape@gmail.com'),
(4, 'nkeletsengluciamaretlane@gmail.com'),
(5, 'lineo@gmail.com'),
(6, 'kerefuoehape@gmail.com'),
(7, 'boy@gmail.com'),
(8, 'boy1@gmail.com'),
(9, 'vuyelwa@gmail.com'),
(10, 'zebra@yahoo.com'),
(11, 'lion@zoo.org'),
(12, 'monkey@zoo.com'),
(13, 'mpho@nkhalas.com'),
(14, 'reabetsoe@gmail.com'),
(15, 'reabetsoe1@gmail.com'),
(16, 'khotsomatlatsa98@gmail.com'),
(17, 'khotsomatlatsa98@gmail.com'),
(18, 'khotsomatlatsa98@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `filename` blob NOT NULL,
  `size` varchar(110) NOT NULL,
  `downloads` varchar(100) NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `filename`, `size`, `downloads`, `status`) VALUES
(13, 0x4d65646961322e6d7034, '6465588', '0', 0),
(14, 0x4d65646961312e6d7034, '5079389', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `link_url` varchar(500) NOT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `file_size` int NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `original_name`, `link_url`, `upload_date`, `file_size`, `mime_type`) VALUES
(1, '1771469538_media_6980c0ab862ae2.61409546.png', 'media_6980c0ab862ae2.61409546.png', '', '2026-02-19 02:52:18', 145365, 'image/png'),
(2, '1771475172_media_6981be23c5b2a8.24243648.png', 'media_6981be23c5b2a8.24243648.png', '', '2026-02-19 04:26:12', 111128, 'image/png'),
(3, '1771475207_1771475172_media_6981be23c5b2a8.24243648.png', '1771475172_media_6981be23c5b2a8.24243648.png', '', '2026-02-19 04:26:47', 111128, 'image/png'),
(6, '1772637720_media_698a1ba1aaab62.17640686.png', 'media_698a1ba1aaab62.17640686.png', '', '2026-03-04 15:22:00', 138760, 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `job_ID` int NOT NULL AUTO_INCREMENT,
  `position` varchar(150) NOT NULL,
  `requirements` varchar(600) NOT NULL,
  `positionnumber` int NOT NULL,
  `emailto` varchar(150) NOT NULL,
  `jobtype` varchar(50) NOT NULL,
  `applydate` datetime NOT NULL,
  PRIMARY KEY (`job_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_ID`, `position`, `requirements`, `positionnumber`, `emailto`, `jobtype`, `applydate`) VALUES
(1, 'finance officer', 'degree in finance', 1, 'krefuoehape@gmail.com', 'Full-time', '2025-11-11 11:11:00'),
(14, 'IT personnel', 'degree in IT and 5 years experience', 2, 'careers@quicksolutionsmedia.org', 'internship', '2025-10-25 23:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(191) NOT NULL,
  `requirements` text NOT NULL,
  `email` varchar(191) NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `deadline` datetime NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `position`, `requirements`, `email`, `job_type`, `deadline`, `created_at`) VALUES
(1, 'manager', 'B.tech CSE', 'khotsomatlatsa98@gmail.com', 'Full-time', '2026-03-28 19:48:00', '2026-03-05 19:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `type` enum('image','video') NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `uploaded_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `business_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `filename`, `filepath`, `type`, `price`, `uploaded_by`, `created_at`, `business_name`) VALUES
(2, 'media_6980c0ab862ae2.61409546.png', 'uploads/media_6980c0ab862ae2.61409546.png', 'image', 200.00, NULL, '2026-02-02 15:20:11', NULL),
(7, 'media_6980e6728e1300.75563431.mp4', 'uploads/media_6980e6728e1300.75563431.mp4', 'video', NULL, NULL, '2026-02-02 18:01:22', NULL),
(9, 'media_6984aa8bddaa74.57499321.png', 'uploads/media_6984aa8bddaa74.57499321.png', 'image', 300.00, NULL, '2026-02-05 14:34:51', NULL),
(12, 'media_6984abbfca3683.00002846.mp4', 'uploads/media_6984abbfca3683.00002846.mp4', 'video', NULL, NULL, '2026-02-05 14:39:59', NULL),
(13, 'media_698a1ba1aaab62.17640686.png', 'uploads/media_698a1ba1aaab62.17640686.png', 'image', 488.00, NULL, '2026-02-09 17:38:41', NULL),
(14, 'media_6997bfc1cf33d6.32641441.png', 'uploads/media_6997bfc1cf33d6.32641441.png', 'image', 6000.00, NULL, '2026-02-20 01:58:25', NULL),
(15, 'media_6997bfe7c6d485.96473726.mp4', 'uploads/media_6997bfe7c6d485.96473726.mp4', 'video', NULL, NULL, '2026-02-20 01:59:03', NULL),
(16, 'media_6997c00e95c922.54344994.png', 'uploads/media_6997c00e95c922.54344994.png', 'image', 60.00, NULL, '2026-02-20 01:59:42', NULL),
(18, 'media_69a566288b63c7.44668412.mp4', 'uploads/media_69a566288b63c7.44668412.mp4', 'video', NULL, NULL, '2026-03-02 10:27:52', NULL),
(48, 'media_1773996393_3971.mp4', 'uploads/media_1773996393_3971.mp4', '', NULL, NULL, '2026-03-20 08:46:33', ''),
(22, 'media_69b43042215307.36052279.png', 'uploads/media_69b43042215307.36052279.png', '', 100.00, NULL, '2026-03-13 15:41:54', 'bogo'),
(24, 'media_69bbb65f54a014.12554679.png', 'uploads/media_69bbb65f54a014.12554679.png', '', 344.00, NULL, '2026-03-19 08:39:59', 'KfC'),
(32, 'media_1773924042_8568.png', 'uploads/media_1773924042_8568.png', '', 0.00, NULL, '2026-03-19 12:40:42', ''),
(40, 'media_1773942918_9820.png', 'uploads/media_1773942918_9820.png', '', 55.00, NULL, '2026-03-19 17:55:18', ''),
(44, 'media_1773987018_4244.png', 'uploads/media_1773987018_4244.png', '', 599.00, NULL, '2026-03-20 06:10:18', 'KfC'),
(49, 'media_1773998585_2105.mp4', 'uploads/media_1773998585_2105.mp4', '', NULL, NULL, '2026-03-20 09:23:05', ''),
(50, 'media_1774415400_7521.png', 'uploads/media_1774415400_7521.png', '', 2000.00, NULL, '2026-03-25 05:10:00', 'KfC');

-- --------------------------------------------------------

--
-- Table structure for table `media_comments`
--

DROP TABLE IF EXISTS `media_comments`;
CREATE TABLE IF NOT EXISTS `media_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `media_id` (`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_likes`
--

DROP TABLE IF EXISTS `media_likes`;
CREATE TABLE IF NOT EXISTS `media_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_id` (`media_id`,`user_id`),
  KEY `media_id_2` (`media_id`),
  KEY `idx_likes_media` (`media_id`),
  KEY `idx_likes_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `media_likes`
--

INSERT INTO `media_likes` (`id`, `media_id`, `user_id`, `created_at`) VALUES
(1, 5, 2, '2026-02-02 14:08:08'),
(2, 13, 6, '2026-02-12 14:50:37'),
(3, 12, 6, '2026-02-12 14:50:40'),
(4, 9, 6, '2026-02-12 14:50:47'),
(5, 8, 6, '2026-02-12 16:51:58'),
(6, 13, 2, '2026-02-12 18:15:00'),
(7, 12, 2, '2026-02-12 18:15:03'),
(8, 9, 2, '2026-02-12 18:15:05'),
(9, 8, 2, '2026-02-13 10:55:51'),
(10, 2, 2, '2026-02-13 10:55:56'),
(11, 7, 2, '2026-02-13 10:55:58'),
(12, 13, 7, '2026-02-19 17:46:33'),
(13, 12, 7, '2026-02-19 17:46:35'),
(14, 9, 7, '2026-02-19 17:46:37'),
(15, 2, 7, '2026-02-19 17:50:07'),
(16, 7, 7, '2026-02-19 17:50:10'),
(17, 16, 7, '2026-02-20 02:00:36'),
(18, 15, 7, '2026-02-20 02:00:37'),
(19, 16, 8, '2026-02-20 07:28:40'),
(20, 14, 8, '2026-02-20 07:28:56'),
(21, 15, 8, '2026-02-20 07:28:57'),
(22, 13, 8, '2026-02-20 07:29:05'),
(23, 9, 8, '2026-02-20 07:29:24'),
(24, 16, 9, '2026-02-21 06:24:05'),
(25, 15, 9, '2026-02-21 06:24:07'),
(26, 14, 9, '2026-02-21 06:24:09'),
(27, 2, 9, '2026-02-21 06:24:15'),
(28, 8, 3, '2026-03-02 08:10:25'),
(29, 19, 3, '2026-03-02 12:10:16'),
(30, 18, 3, '2026-03-02 12:10:17'),
(31, 16, 3, '2026-03-02 12:10:19'),
(32, 20, 2, '2026-03-09 06:19:39'),
(33, 19, 2, '2026-03-09 06:19:40'),
(34, 18, 2, '2026-03-09 06:19:42'),
(35, 15, 2, '2026-03-11 07:40:05'),
(36, 14, 2, '2026-03-11 08:38:39'),
(37, 22, 11, '2026-03-14 14:52:19'),
(38, 18, 11, '2026-03-14 14:52:21'),
(39, 9, 12, '2026-03-16 11:43:49'),
(40, 12, 12, '2026-03-16 11:43:51'),
(41, 15, 13, '2026-03-16 13:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `media_posts`
--

DROP TABLE IF EXISTS `media_posts`;
CREATE TABLE IF NOT EXISTS `media_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `media_type` enum('image','video') NOT NULL,
  `media_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_scroll`
--

DROP TABLE IF EXISTS `media_scroll`;
CREATE TABLE IF NOT EXISTS `media_scroll` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `scroll_percent` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `media_id` (`media_id`),
  KEY `media_id_2` (`media_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_scroll_media` (`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `media_scroll`
--

INSERT INTO `media_scroll` (`id`, `media_id`, `user_id`, `scroll_percent`, `created_at`) VALUES
(1, 5, 2, 70, '2026-02-02 14:08:48'),
(2, 16, 7, 100, '2026-02-20 02:11:49'),
(3, 15, 7, 100, '2026-02-20 02:11:49'),
(4, 14, 7, 100, '2026-02-20 02:11:49'),
(5, 12, 7, 100, '2026-02-20 02:11:49'),
(6, 9, 7, 100, '2026-02-20 02:11:49'),
(7, 13, 7, 100, '2026-02-20 02:11:50'),
(8, 8, 7, 100, '2026-02-20 02:11:50'),
(9, 7, 7, 100, '2026-02-20 02:11:50'),
(10, 2, 7, 26, '2026-02-20 02:11:54'),
(11, 16, 7, 100, '2026-02-20 02:12:05'),
(12, 15, 7, 100, '2026-02-20 02:12:05'),
(13, 14, 7, 100, '2026-02-20 02:12:05'),
(14, 13, 7, 100, '2026-02-20 02:12:05'),
(15, 12, 7, 52, '2026-02-20 02:12:05'),
(16, 9, 7, 52, '2026-02-20 02:12:05'),
(17, 8, 7, 52, '2026-02-20 02:12:05'),
(18, 7, 7, 52, '2026-02-20 02:12:05'),
(19, 16, 7, 100, '2026-02-20 04:19:40'),
(20, 15, 7, 100, '2026-02-20 04:19:40'),
(21, 14, 7, 100, '2026-02-20 04:19:40'),
(22, 13, 7, 100, '2026-02-20 04:19:40'),
(23, 12, 7, 100, '2026-02-20 04:19:40'),
(24, 9, 7, 100, '2026-02-20 04:19:40'),
(25, 8, 7, 100, '2026-02-20 04:19:40'),
(26, 7, 7, 100, '2026-02-20 04:19:40'),
(27, 16, 8, 100, '2026-02-20 07:28:34'),
(28, 15, 8, 100, '2026-02-20 07:28:34'),
(29, 14, 8, 100, '2026-02-20 07:28:34'),
(30, 13, 8, 100, '2026-02-20 07:28:34'),
(31, 12, 8, 100, '2026-02-20 07:28:34'),
(32, 9, 8, 100, '2026-02-20 07:28:34'),
(33, 8, 8, 100, '2026-02-20 07:28:34'),
(34, 7, 8, 100, '2026-02-20 07:28:34'),
(35, 2, 8, 26, '2026-02-20 07:29:21'),
(36, 16, 3, 100, '2026-02-20 07:54:16'),
(37, 15, 3, 100, '2026-02-20 07:54:16'),
(38, 14, 3, 100, '2026-02-20 07:54:16'),
(39, 13, 3, 100, '2026-02-20 07:54:16'),
(40, 9, 3, 100, '2026-02-20 07:54:16'),
(41, 8, 3, 93, '2026-02-20 07:54:16'),
(42, 12, 3, 100, '2026-02-20 07:54:16'),
(43, 7, 3, 100, '2026-02-20 07:54:16'),
(44, 16, 8, 100, '2026-02-20 07:54:38'),
(45, 15, 8, 100, '2026-02-20 07:54:38'),
(46, 14, 8, 100, '2026-02-20 07:54:38'),
(47, 13, 8, 100, '2026-02-20 07:54:38'),
(48, 12, 8, 52, '2026-02-20 07:54:38'),
(49, 9, 8, 52, '2026-02-20 07:54:38'),
(50, 8, 8, 52, '2026-02-20 07:54:38'),
(51, 7, 8, 52, '2026-02-20 07:54:38'),
(52, 16, 8, 100, '2026-02-20 08:41:32'),
(53, 15, 8, 100, '2026-02-20 08:41:32'),
(54, 14, 8, 100, '2026-02-20 08:41:32'),
(55, 13, 8, 100, '2026-02-20 08:41:32'),
(56, 12, 8, 74, '2026-02-20 08:41:32'),
(57, 9, 8, 74, '2026-02-20 08:41:32'),
(58, 8, 8, 74, '2026-02-20 08:41:32'),
(59, 7, 8, 74, '2026-02-20 08:41:32'),
(60, 2, 8, 26, '2026-02-20 08:41:49'),
(61, 16, 9, 100, '2026-02-21 05:53:51'),
(62, 13, 9, 100, '2026-02-21 05:53:51'),
(63, 15, 9, 100, '2026-02-21 05:53:51'),
(64, 14, 9, 100, '2026-02-21 05:53:51'),
(65, 12, 9, 74, '2026-02-21 05:53:51'),
(66, 9, 9, 74, '2026-02-21 05:53:51'),
(67, 8, 9, 74, '2026-02-21 05:53:51'),
(68, 7, 9, 74, '2026-02-21 05:53:51'),
(69, 2, 9, 29, '2026-02-21 05:53:56'),
(70, 18, 12, 100, '2026-03-16 12:37:53'),
(71, 14, 12, 100, '2026-03-16 12:37:53'),
(72, 16, 12, 100, '2026-03-16 12:37:53'),
(73, 22, 12, 100, '2026-03-16 12:37:53'),
(74, 15, 12, 100, '2026-03-16 12:37:53'),
(75, 13, 12, 100, '2026-03-16 12:37:54'),
(76, 12, 12, 100, '2026-03-16 12:37:57'),
(77, 9, 12, 100, '2026-03-16 12:37:57'),
(78, 7, 12, 100, '2026-03-16 12:37:57'),
(79, 2, 12, 100, '2026-03-16 12:37:59'),
(80, 22, 13, 100, '2026-03-16 13:13:05'),
(81, 18, 13, 100, '2026-03-16 13:13:05'),
(82, 15, 13, 100, '2026-03-16 13:13:05'),
(83, 14, 13, 100, '2026-03-16 13:13:05'),
(84, 16, 13, 100, '2026-03-16 13:13:05'),
(85, 13, 13, 100, '2026-03-16 13:13:05'),
(86, 12, 13, 10, '2026-03-16 13:13:07'),
(87, 9, 13, 10, '2026-03-16 13:13:07'),
(88, 7, 13, 10, '2026-03-16 13:13:07'),
(89, 18, 3, 100, '2026-03-19 08:38:05'),
(90, 22, 3, 100, '2026-03-19 08:38:05'),
(91, 23, 3, 100, '2026-03-19 08:38:51'),
(92, 24, 3, 100, '2026-03-19 08:40:01'),
(93, 25, 3, 75, '2026-03-19 09:39:42'),
(94, 26, 3, 100, '2026-03-19 09:46:11'),
(95, 27, 3, 78, '2026-03-19 09:53:09'),
(96, 28, 3, 100, '2026-03-19 09:59:21'),
(97, 29, 3, 100, '2026-03-19 11:37:46'),
(98, 30, 3, 75, '2026-03-19 12:35:09'),
(99, 31, 3, 100, '2026-03-19 12:40:28'),
(100, 32, 3, 100, '2026-03-19 12:40:43'),
(101, 33, 3, 100, '2026-03-19 12:49:04'),
(102, 34, 3, 100, '2026-03-19 12:50:29'),
(103, 35, 3, 100, '2026-03-19 12:51:16'),
(104, 36, 3, 100, '2026-03-19 14:50:31'),
(105, 37, 3, 75, '2026-03-19 16:14:07'),
(106, 38, 3, 78, '2026-03-19 16:23:43'),
(107, 39, 3, 100, '2026-03-19 17:54:55'),
(108, 40, 3, 100, '2026-03-19 17:55:19'),
(109, 2, 3, 100, '2026-03-19 17:55:50'),
(110, 41, 3, 79, '2026-03-20 06:02:44'),
(111, 40, 8, 100, '2026-03-20 06:03:21'),
(112, 22, 8, 100, '2026-03-20 06:03:21'),
(113, 24, 8, 100, '2026-03-20 06:03:21'),
(114, 32, 8, 100, '2026-03-20 06:03:22'),
(115, 18, 8, 100, '2026-03-20 06:03:22'),
(116, 43, 3, 100, '2026-03-20 06:09:37'),
(117, 44, 3, 100, '2026-03-20 06:10:18'),
(118, 45, 3, 100, '2026-03-20 06:21:02'),
(119, 46, 3, 75, '2026-03-20 06:31:46'),
(120, 47, 3, 100, '2026-03-20 06:32:41'),
(121, 48, 3, 83, '2026-03-20 08:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `media_views`
--

DROP TABLE IF EXISTS `media_views`;
CREATE TABLE IF NOT EXISTS `media_views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_id` (`media_id`,`user_id`),
  UNIQUE KEY `unique_view` (`user_id`,`media_id`),
  KEY `media_id_2` (`media_id`),
  KEY `idx_views_media` (`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `media_views`
--

INSERT INTO `media_views` (`id`, `media_id`, `user_id`, `viewed_at`) VALUES
(1, 5, 2, '2026-02-02 14:08:28'),
(2, 16, 7, '2026-02-20 02:11:49'),
(3, 15, 7, '2026-02-20 02:11:49'),
(4, 8, 7, '2026-02-20 02:11:49'),
(5, 12, 7, '2026-02-20 02:11:49'),
(6, 7, 7, '2026-02-20 02:11:49'),
(7, 13, 7, '2026-02-20 02:11:49'),
(8, 14, 7, '2026-02-20 02:11:49'),
(9, 9, 7, '2026-02-20 02:11:49'),
(10, 2, 7, '2026-02-20 02:11:49'),
(11, 16, 8, '2026-02-20 07:28:34'),
(12, 15, 8, '2026-02-20 07:28:34'),
(13, 8, 8, '2026-02-20 07:28:34'),
(14, 7, 8, '2026-02-20 07:28:34'),
(15, 2, 8, '2026-02-20 07:28:34'),
(16, 13, 8, '2026-02-20 07:28:34'),
(17, 9, 8, '2026-02-20 07:28:34'),
(18, 14, 8, '2026-02-20 07:28:34'),
(19, 12, 8, '2026-02-20 07:28:34'),
(20, 16, 3, '2026-02-20 07:54:15'),
(21, 15, 3, '2026-02-20 07:54:15'),
(22, 8, 3, '2026-02-20 07:54:15'),
(23, 7, 3, '2026-02-20 07:54:15'),
(24, 2, 3, '2026-02-20 07:54:16'),
(25, 13, 3, '2026-02-20 07:54:16'),
(26, 14, 3, '2026-02-20 07:54:16'),
(27, 12, 3, '2026-02-20 07:54:16'),
(28, 9, 3, '2026-02-20 07:54:16'),
(29, 16, 9, '2026-02-21 05:53:51'),
(30, 15, 9, '2026-02-21 05:53:51'),
(31, 9, 9, '2026-02-21 05:53:51'),
(32, 8, 9, '2026-02-21 05:53:51'),
(33, 7, 9, '2026-02-21 05:53:51'),
(34, 2, 9, '2026-02-21 05:53:51'),
(35, 13, 9, '2026-02-21 05:53:51'),
(36, 12, 9, '2026-02-21 05:53:51'),
(37, 14, 9, '2026-02-21 05:53:51'),
(38, 17, 3, '2026-03-02 10:27:06'),
(39, 19, 3, '2026-03-02 12:07:31'),
(40, 19, 9, '2026-03-02 12:28:57'),
(41, 20, 3, '2026-03-09 02:30:30'),
(42, 20, 2, '2026-03-09 06:19:36'),
(43, 16, 2, '2026-03-09 06:19:36'),
(44, 19, 2, '2026-03-09 06:19:36'),
(45, 14, 2, '2026-03-09 06:19:36'),
(46, 13, 2, '2026-03-09 06:19:36'),
(47, 9, 2, '2026-03-09 06:19:36'),
(48, 2, 2, '2026-03-09 06:19:36'),
(49, 7, 2, '2026-03-11 11:19:33'),
(50, 15, 2, '2026-03-11 12:19:19'),
(51, 21, 3, '2026-03-13 15:20:13'),
(52, 22, 3, '2026-03-13 15:41:55'),
(53, 16, 11, '2026-03-14 14:52:16'),
(54, 14, 11, '2026-03-14 14:52:16'),
(55, 13, 11, '2026-03-14 14:52:16'),
(56, 2, 11, '2026-03-14 14:52:16'),
(57, 9, 11, '2026-03-14 14:52:16'),
(58, 22, 11, '2026-03-14 14:52:16'),
(59, 14, 12, '2026-03-16 11:43:41'),
(60, 16, 12, '2026-03-16 11:43:41'),
(61, 22, 12, '2026-03-16 11:43:41'),
(62, 13, 12, '2026-03-16 11:43:41'),
(63, 9, 12, '2026-03-16 11:43:41'),
(64, 2, 12, '2026-03-16 11:43:41'),
(65, 22, 13, '2026-03-16 13:13:05'),
(66, 16, 13, '2026-03-16 13:13:05'),
(67, 14, 13, '2026-03-16 13:13:05'),
(68, 13, 13, '2026-03-16 13:13:05'),
(69, 9, 13, '2026-03-16 13:13:05'),
(70, 2, 13, '2026-03-16 13:13:05'),
(71, 18, 3, '2026-03-19 08:39:22'),
(72, 24, 3, '2026-03-19 08:40:01'),
(73, 32, 3, '2026-03-19 12:40:43'),
(74, 40, 3, '2026-03-19 17:55:19'),
(75, 40, 8, '2026-03-20 06:03:22'),
(76, 24, 8, '2026-03-20 06:03:22'),
(77, 32, 8, '2026-03-20 06:03:22'),
(78, 22, 8, '2026-03-20 06:03:22'),
(79, 18, 8, '2026-03-20 06:03:38'),
(80, 44, 3, '2026-03-20 06:10:18'),
(81, 49, 3, '2026-03-20 09:23:09'),
(82, 44, 8, '2026-03-21 06:49:12'),
(83, 49, 8, '2026-03-21 06:49:21'),
(84, 44, 13, '2026-03-21 12:38:32'),
(85, 40, 13, '2026-03-21 12:38:32'),
(86, 32, 13, '2026-03-21 12:38:32'),
(87, 24, 13, '2026-03-21 12:38:32'),
(88, 49, 13, '2026-03-21 12:38:56'),
(89, 50, 3, '2026-03-25 05:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
CREATE TABLE IF NOT EXISTS `quotations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `description` text,
  `status` varchar(20) DEFAULT 'Unresolved',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `name`, `email`, `company`, `phone`, `description`, `status`, `created_at`) VALUES
(1, 'khotso Edwin matlatsa', 'khotsomatlatsa98@gmail.com', 'kfc', '08264902431', 'hfhfh', '0', '2026-03-23 16:23:17'),
(2, 'khotso Edwin matlatsa', 'khotsomatlatsa98@gmail.com', 'kfc', '08264902431', 'hfhfh', '0', '2026-03-23 16:23:25'),
(3, 'khotso Edwin matlatsa', 'khotsomatlatsa98@gmail.com', 'kfc', '08264902431', 'hhhd', '0', '2026-03-24 07:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

DROP TABLE IF EXISTS `referrals`;
CREATE TABLE IF NOT EXISTS `referrals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `referrer_id` int NOT NULL,
  `referred_user_id` int NOT NULL,
  `reward_points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward_claims`
--

DROP TABLE IF EXISTS `reward_claims`;
CREATE TABLE IF NOT EXISTS `reward_claims` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `reward_type` varchar(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reward_claims`
--

INSERT INTO `reward_claims` (`id`, `full_name`, `email`, `phone`, `reward_type`, `payment_method`, `status`, `created_at`, `user_id`) VALUES
(1, 'khotso Edwin matlatsa', 'khotsomatlatsa98@gmail.com', '08264902431', 'Referral', 'PayPal', 'Approved', '2026-02-28 07:10:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scrolls`
--

DROP TABLE IF EXISTS `scrolls`;
CREATE TABLE IF NOT EXISTS `scrolls` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `scroll_percent` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `media_id` (`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scroll_tracking`
--

DROP TABLE IF EXISTS `scroll_tracking`;
CREATE TABLE IF NOT EXISTS `scroll_tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `media_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `scroll_percent` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `media_id` (`media_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `softwaretasks`
--

DROP TABLE IF EXISTS `softwaretasks`;
CREATE TABLE IF NOT EXISTS `softwaretasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `softwaretitle` varchar(191) NOT NULL,
  `softwaredescription` text NOT NULL,
  `softwarefile` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `software_link` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `softwaretasks`
--

INSERT INTO `softwaretasks` (`id`, `softwaretitle`, `softwaredescription`, `softwarefile`, `created_at`, `software_link`) VALUES
(1, 'demotester', 'testing functionality', 'demosoftware.zip', '2026-02-27 22:05:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surveyleads`
--

DROP TABLE IF EXISTS `surveyleads`;
CREATE TABLE IF NOT EXISTS `surveyleads` (
  `surveylead_id` int NOT NULL AUTO_INCREMENT,
  `surveyorname` varchar(150) NOT NULL,
  `surveyoremail` varchar(150) NOT NULL,
  `surveyorphone` varchar(100) NOT NULL,
  `surveynumber` varchar(250) NOT NULL,
  PRIMARY KEY (`surveylead_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `surveyleads`
--

INSERT INTO `surveyleads` (`surveylead_id`, `surveyorname`, `surveyoremail`, `surveyorphone`, `surveynumber`) VALUES
(1, 'Refuoehape Khasake', 'krefuoehape@gmail.com', '+26651865798', 'i request survey 2'),
(2, 'Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', '+26651865798', 'i request survey 2'),
(3, 'Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', '+26651865798', 'i request survey 2'),
(4, 'khotso edwin', 'khotsomatlatsa98@gmail.com', '58963238', ''),
(5, 'khotso edwin', 'khotsomatlatsa98@gmail.com', '58963238', ''),
(6, '', '', '', ''),
(7, 'khotso edwin', 'khotsomatlatsa98@gmail.com', '58963238', ''),
(8, 'khotso edwin', 'khotsomatlatsa98@gmail.com', '58963238', ''),
(9, 'edwin', 'khotsomatlatsa98@gmail.com', '58963238', ''),
(10, 'khotso Edwin matlatsa', 'khotsomatlatsa98@gmail.com', '08264902431', 'I request survey 1');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `title`, `link`, `created_at`) VALUES
(1, 'Website User Experience Survey', 'https://forms.gle/wL8Xv7t1sFhYp3qE9', '2026-02-26 15:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `survey_answers`
--

DROP TABLE IF EXISTS `survey_answers`;
CREATE TABLE IF NOT EXISTS `survey_answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int NOT NULL,
  `question_id` int NOT NULL,
  `user_id` int NOT NULL,
  `answer` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`),
  KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_completions`
--

DROP TABLE IF EXISTS `survey_completions`;
CREATE TABLE IF NOT EXISTS `survey_completions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `survey_completions`
--

INSERT INTO `survey_completions` (`id`, `survey_id`, `user_id`, `completed_at`) VALUES
(1, 1, 9, '2026-02-26 15:31:02'),
(2, 1, 2, '2026-03-09 06:20:23'),
(3, 1, 8, '2026-03-11 12:42:39'),
(4, 1, 11, '2026-03-14 14:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

DROP TABLE IF EXISTS `survey_questions`;
CREATE TABLE IF NOT EXISTS `survey_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int NOT NULL,
  `question` text NOT NULL,
  `question_type` enum('text','radio','checkbox','textarea') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

DROP TABLE IF EXISTS `survey_responses`;
CREATE TABLE IF NOT EXISTS `survey_responses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `survey_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_response` (`user_id`,`survey_id`),
  KEY `fk_sr_survey` (`survey_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `businessname` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `surveylink` varchar(250) NOT NULL,
  `deadline` datetime NOT NULL,
  `task_type` varchar(50) NOT NULL DEFAULT 'survey',
  `reward_points` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `businessname`, `description`, `surveylink`, `deadline`, `task_type`, `reward_points`) VALUES
(1, 'starchy combo survey', 'shoprite', 'to check starchy combo effectiveness', 'https://www.googlesurvey.com', '2025-10-08 12:33:00', 'survey', 0),
(2, 'clothes on sales', 'pep', 'to check if customers prefer clothes on sale', 'https://www.google23survey.com', '2025-10-09 12:46:00', 'survey', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncecomments`
--

DROP TABLE IF EXISTS `tblannouncecomments`;
CREATE TABLE IF NOT EXISTS `tblannouncecomments` (
  `announcecommentid` int NOT NULL AUTO_INCREMENT,
  `announcementid` int NOT NULL,
  `user_id` int NOT NULL,
  `commentcontent` longtext NOT NULL,
  `commentdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`announcecommentid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblannouncecomments`
--

INSERT INTO `tblannouncecomments` (`announcecommentid`, `announcementid`, `user_id`, `commentcontent`, `commentdate`) VALUES
(1, 0, 0, 'ok we understand', '2025-12-05 15:15:20'),
(2, 0, 0, 'message received', '2025-12-05 03:18:28'),
(3, 4, 0, 'hello family', '2025-12-05 03:34:23'),
(4, 6, 0, 'alright we get it', '2025-12-05 03:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncements`
--

DROP TABLE IF EXISTS `tblannouncements`;
CREATE TABLE IF NOT EXISTS `tblannouncements` (
  `announcementid` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`announcementid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblannouncements`
--

INSERT INTO `tblannouncements` (`announcementid`, `subject`, `content`, `date_created`) VALUES
(1, 'greetings', 'hello guys my name is Lynn', '2026-02-27 12:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncement_comments`
--

DROP TABLE IF EXISTS `tblannouncement_comments`;
CREATE TABLE IF NOT EXISTS `tblannouncement_comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `announcement_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `announcement_id` (`announcement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblannouncement_comments`
--

INSERT INTO `tblannouncement_comments` (`comment_id`, `announcement_id`, `user_id`, `comment`, `comment_date`) VALUES
(1, 1, 9, 'okay', '2026-02-27 12:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

DROP TABLE IF EXISTS `tblcomments`;
CREATE TABLE IF NOT EXISTS `tblcomments` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `fileid` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(400) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `status` int NOT NULL,
  `postingddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentid`),
  KEY `file` (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblproductview`
--

DROP TABLE IF EXISTS `tblproductview`;
CREATE TABLE IF NOT EXISTS `tblproductview` (
  `productviewid` int NOT NULL AUTO_INCREMENT,
  `useremail` varchar(150) NOT NULL,
  `scrollpercentage` double NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`productviewid`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblproductview`
--

INSERT INTO `tblproductview` (`productviewid`, `useremail`, `scrollpercentage`, `dateandtime`) VALUES
(11, 'krefuoehape@gmail.com', 0, '2025-11-29 20:43:57'),
(35, 'krefuoehape@gmail.com', 0, '2025-12-08 16:03:28'),
(55, 'krefuoehape@gmail.com', 0, '2025-12-08 16:37:58'),
(56, 'krefuoehape@gmail.com', 0, '2025-12-08 16:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblquotation`
--

DROP TABLE IF EXISTS `tblquotation`;
CREATE TABLE IF NOT EXISTS `tblquotation` (
  `quotationid` int NOT NULL AUTO_INCREMENT,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`quotationid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblquotation`
--

INSERT INTO `tblquotation` (`quotationid`, `fullnames`, `email`, `companyname`, `phone`, `description`, `status`) VALUES
(2, 'khotso Edwin matlatsa', 'khotsomatlatsa98@gmail.com', 'kfc', '08264902431', 'ad work', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribers`
--

DROP TABLE IF EXISTS `tblsubscribers`;
CREATE TABLE IF NOT EXISTS `tblsubscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `subscribed_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'annygenissei@gmail.com', '2026-02-27 21:10:35'),
(2, 'khotsomatlatsa98@gmail.com', '2026-02-27 21:11:05'),
(3, 'edwinmatlatsa@gmail.com', '2026-02-27 21:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `urltable`
--

DROP TABLE IF EXISTS `urltable`;
CREATE TABLE IF NOT EXISTS `urltable` (
  `url_id` int NOT NULL AUTO_INCREMENT,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `referrallink` varchar(400) NOT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `urltable`
--

INSERT INTO `urltable` (`url_id`, `fullnames`, `email`, `referrallink`) VALUES
(1, 'Keletso Thulo', 'lineo@gmail.com', 'https://www.quicksolutionsmedia.org lineo@gmail.com 2025-10-06 19:33:21'),
(2, 'Refuoehape Khasake', 'krefuoehape@gmail.com', 'https://www.quicksolutionsmedia.org krefuoehape@gmail.com 2025-10-08 16:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `referral_email` varchar(191) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `referral_code` varchar(50) DEFAULT NULL,
  `referred_by` varchar(50) DEFAULT NULL,
  `referral_count` int DEFAULT '0',
  `contribution_points` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`),
  UNIQUE KEY `referral_code` (`referral_code`),
  UNIQUE KEY `referral_code_2` (`referral_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `referral_email`, `password`, `role`, `created_at`, `referral_code`, `referred_by`, `referral_count`, `contribution_points`) VALUES
(2, 'Khotso Edwin', 'khotsomatlatsa98@gmail.com', '8264902431', 'khotsomatlatsa98@gmail.com', '$2y$10$kZBOInOYhfdqz/rIJdVk1uXlrWngny.nd6AzJjvUFDIXK2yMuUC9q', 'user', '2026-02-03 15:15:53', NULL, NULL, 2, 8),
(3, 'Admin', 'admin@quicks.com', '9999999999', NULL, '$2y$10$sd20N5nyGteHc6e/C9h4BuvywZ3.Edk.A4l2q1d7BW/jpTfg6l3tK', 'admin', '2026-02-03 15:58:24', NULL, NULL, 0, 69),
(4, 'Khotso Edwin', 'edwinmatlatsa@gmail.com', '8264902431', 'khotsomatlatsa98@gmail.com', '$2y$10$l3u7tAQhHM2oSV/O3W6xkOqZ.rA0HQgbLdDAqSNGTyAw8nU.h1fb.', 'user', '2026-02-04 07:16:25', NULL, NULL, 0, 0),
(5, 'james', 'jame@gmail.com', '5896323890', '', '$2y$10$21tfKOGSmy2Y1s43gzsy.euphknQM43p5r93m8Q1HRGlrSVUwh6DW', 'user', '2026-02-05 14:38:20', NULL, NULL, 0, 0),
(6, 'Khotso Edwin', 'edwinmatlatsa1@gmail.com', '8264902431', '', '$2y$10$ataDITgiKD9sE1M2ht4Jy.BtuI2.ISbj9AIDiq0B19LGyJPN9nVq.', 'user', '2026-02-09 06:03:53', NULL, NULL, 0, 0),
(7, 'thabo', 'thabo@gmail.com', '5896323890', 'khotsomatlatsa98@gmail.com', '$2y$10$mNDjlokG6MiUExGilW9K7eBjShSzakZDTJbt5.fQcyo42uXka7clq', 'user', '2026-02-19 17:46:18', NULL, NULL, 0, 0),
(8, 'anny', 'annygenissei@gmail.com', '8264902431', '', '$2y$10$3wN3tZtiONbxY2t16rXVh.hxfrlFXADtxHIzV4ay9kcE8Qfb5xL0C', 'user', '2026-02-20 07:25:53', NULL, NULL, 2, 82),
(9, 'robert', 'robert@gmail.com', '8264902431', '', '$2y$10$i5MBdQdAmW0i6E6cmvRnSOMtrTeyBTE3KmdpAutueqoXVvDq.9rsa', 'user', '2026-02-21 05:53:20', NULL, NULL, 0, 0),
(10, 'jail', 'jail@gamil.com', '8264902431', 'khotsomatlatsa98@gmail.com', '$2y$10$1G.m5MG5LkyqzJuMjNzTH./y7bIfMv6JNiUyW.87Te.ytGvPWutz6', 'user', '2026-03-13 10:19:11', 'RJTG0OAF', '2', 0, 0),
(11, 'guy lynn melissa HARUSHIMANA', 'lynnharushimana@gmail.com', '8264902431', 'khotsomatlatsa98@gmail.com', '$2y$10$peF8gTjzA3k5iLMZP0TzhuIFY5oJUeuUvnHJe7IGaaj.rXrbCULoi', 'user', '2026-03-13 10:25:16', 'T819SDZQ', '2', 0, 29),
(12, 'zake', 'zake@gmail.com', '8264902431', 'annygenissei@gmail.com', '$2y$10$V1dBUANoF0BkVphlL5n7Q.KitBU3CrNEJzMXZFDU/7KeUwK5Sb2ny', 'user', '2026-03-16 11:42:08', 'LG9BSZ4J', '8', 0, 48),
(13, 'tizman', 'tizman@gmail.com', '8264902431', 'annygenissei@gmail.com', '$2y$10$C8LDyCTzkgecIIT1xsaGIe.Qdqu8zwIvwWer/3pvAGbwMqXF22XY2', 'user', '2026-03-16 13:12:52', 'WN9U4P0F', '8', 0, 52);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'completed',
  `reward_points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `points` int DEFAULT '0',
  `activity_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `points_earned` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `activity_type`, `activity_name`, `status`, `reward_points`, `created_at`, `points`, `activity_time`, `points_earned`) VALUES
(1, 2, 'Like', 'Liked media ID: 13', 'Completed', 0, '2026-02-15 08:19:00', 0, '2026-03-13 10:20:53', 0),
(2, 2, 'Like', 'Liked media ID: 12', 'Completed', 0, '2026-02-15 08:19:01', 0, '2026-03-13 10:20:53', 0),
(3, 2, 'Like', 'Liked media ID: 9', 'Completed', 0, '2026-02-15 08:19:03', 0, '2026-03-13 10:20:53', 0),
(4, 2, 'Like', 'Liked media ID: 8', 'Completed', 0, '2026-02-15 08:19:05', 0, '2026-03-13 10:20:53', 0),
(5, 2, 'Like', 'Liked media ID: 7', 'Completed', 0, '2026-02-15 08:19:13', 0, '2026-03-13 10:20:53', 0),
(6, 2, 'Like', 'Liked media ID: 2', 'Completed', 0, '2026-02-15 08:19:15', 0, '2026-03-13 10:20:53', 0),
(7, 6, 'Like', 'Liked media ID: 13', 'Completed', 0, '2026-02-19 14:07:54', 0, '2026-03-13 10:20:53', 0),
(8, 6, 'Like', 'Liked media ID: 12', 'Completed', 0, '2026-02-19 14:07:57', 0, '2026-03-13 10:20:53', 0),
(9, 6, 'Like', 'Liked media ID: 9', 'Completed', 0, '2026-02-19 14:07:59', 0, '2026-03-13 10:20:53', 0),
(10, 7, 'Like', 'Liked: media_698a1ba1aaab62.17640686.png', 'completed', 0, '2026-02-19 17:46:33', 0, '2026-03-13 10:20:53', 0),
(11, 7, 'Like', 'Liked media ID: 13', 'Completed', 0, '2026-02-19 17:46:33', 0, '2026-03-13 10:20:53', 0),
(12, 7, 'Like', 'Liked: media_6984abbfca3683.00002846.mp4', 'completed', 0, '2026-02-19 17:46:35', 0, '2026-03-13 10:20:53', 0),
(13, 7, 'Like', 'Liked media ID: 12', 'Completed', 0, '2026-02-19 17:46:35', 0, '2026-03-13 10:20:53', 0),
(14, 7, 'Like', 'Liked: media_6984aa8bddaa74.57499321.png', 'completed', 0, '2026-02-19 17:46:37', 0, '2026-03-13 10:20:53', 0),
(15, 7, 'Like', 'Liked media ID: 9', 'Completed', 0, '2026-02-19 17:46:37', 0, '2026-03-13 10:20:53', 0),
(16, 7, 'Like', 'Liked: media_6980c0ab862ae2.61409546.png', 'completed', 0, '2026-02-19 17:50:07', 0, '2026-03-13 10:20:53', 0),
(17, 7, 'Like', 'Liked media ID: 2', 'Completed', 0, '2026-02-19 17:50:07', 0, '2026-03-13 10:20:53', 0),
(18, 7, 'Like', 'Liked: media_6980e6728e1300.75563431.mp4', 'completed', 0, '2026-02-19 17:50:10', 0, '2026-03-13 10:20:53', 0),
(19, 7, 'Like', 'Liked media ID: 7', 'Completed', 0, '2026-02-19 17:50:10', 0, '2026-03-13 10:20:53', 0),
(20, 6, 'Like', 'Liked media ID: 8', 'Completed', 0, '2026-02-19 18:03:15', 0, '2026-03-13 10:20:53', 0),
(21, 7, 'Like', 'Liked: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-02-20 02:00:36', 0, '2026-03-13 10:20:53', 0),
(22, 7, 'Like', 'Liked media ID: 16', 'Completed', 0, '2026-02-20 02:00:36', 0, '2026-03-13 10:20:53', 0),
(23, 7, 'Like', 'Liked: media_6997bfe7c6d485.96473726.mp4', 'completed', 0, '2026-02-20 02:00:37', 0, '2026-03-13 10:20:53', 0),
(24, 7, 'Like', 'Liked media ID: 15', 'Completed', 0, '2026-02-20 02:00:37', 0, '2026-03-13 10:20:53', 0),
(25, 8, 'Like', 'Liked: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-02-20 07:28:40', 0, '2026-03-13 10:20:53', 0),
(26, 8, 'Like', 'Liked media ID: 16', 'Completed', 0, '2026-02-20 07:28:40', 0, '2026-03-13 10:20:53', 0),
(27, 8, 'Like', 'Liked: media_6997bfc1cf33d6.32641441.png', 'completed', 0, '2026-02-20 07:28:56', 0, '2026-03-13 10:20:53', 0),
(28, 8, 'Like', 'Liked media ID: 14', 'Completed', 0, '2026-02-20 07:28:56', 0, '2026-03-13 10:20:53', 0),
(29, 8, 'Like', 'Liked: media_6997bfe7c6d485.96473726.mp4', 'completed', 0, '2026-02-20 07:28:57', 0, '2026-03-13 10:20:53', 0),
(30, 8, 'Like', 'Liked media ID: 15', 'Completed', 0, '2026-02-20 07:28:57', 0, '2026-03-13 10:20:53', 0),
(31, 8, 'Like', 'Liked: media_698a1ba1aaab62.17640686.png', 'completed', 0, '2026-02-20 07:29:05', 0, '2026-03-13 10:20:53', 0),
(32, 8, 'Like', 'Liked media ID: 13', 'Completed', 0, '2026-02-20 07:29:05', 0, '2026-03-13 10:20:53', 0),
(33, 8, 'Like', 'Liked: media_6984aa8bddaa74.57499321.png', 'completed', 0, '2026-02-20 07:29:24', 0, '2026-03-13 10:20:53', 0),
(34, 8, 'Like', 'Liked media ID: 9', 'Completed', 0, '2026-02-20 07:29:24', 0, '2026-03-13 10:20:53', 0),
(35, 8, 'Like', 'Liked media ID: 13', 'Completed', 0, '2026-02-20 08:42:05', 0, '2026-03-13 10:20:53', 0),
(36, 9, 'Like', 'Liked: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-02-21 06:24:05', 0, '2026-03-13 10:20:53', 0),
(37, 9, 'Like', 'Liked media ID: 16', 'Completed', 0, '2026-02-21 06:24:05', 0, '2026-03-13 10:20:53', 0),
(38, 9, 'Like', 'Liked: media_6997bfe7c6d485.96473726.mp4', 'completed', 0, '2026-02-21 06:24:07', 0, '2026-03-13 10:20:53', 0),
(39, 9, 'Like', 'Liked media ID: 15', 'Completed', 0, '2026-02-21 06:24:07', 0, '2026-03-13 10:20:53', 0),
(40, 9, 'Like', 'Liked: media_6997bfc1cf33d6.32641441.png', 'completed', 0, '2026-02-21 06:24:10', 0, '2026-03-13 10:20:53', 0),
(41, 9, 'Like', 'Liked media ID: 14', 'Completed', 0, '2026-02-21 06:24:10', 0, '2026-03-13 10:20:53', 0),
(42, 9, 'Like', 'Liked: media_6980c0ab862ae2.61409546.png', 'completed', 0, '2026-02-21 06:24:15', 0, '2026-03-13 10:20:53', 0),
(43, 9, 'Like', 'Liked media ID: 2', 'Completed', 0, '2026-02-21 06:24:15', 0, '2026-03-13 10:20:53', 0),
(44, 3, 'Like', 'Liked: media_6981c18c566a83.45771091.png', 'completed', 0, '2026-03-02 08:10:26', 0, '2026-03-13 10:20:53', 0),
(45, 3, 'Like', 'Liked media ID: 8', 'Completed', 0, '2026-03-02 08:10:26', 0, '2026-03-13 10:20:53', 0),
(46, 3, 'Like', 'Liked: media_69a57d825c7bd7.20963411.png', 'completed', 0, '2026-03-02 12:10:16', 0, '2026-03-13 10:20:53', 0),
(47, 3, 'Like', 'Liked media ID: 19', 'Completed', 0, '2026-03-02 12:10:16', 0, '2026-03-13 10:20:53', 0),
(48, 3, 'Like', 'Liked: media_69a566288b63c7.44668412.mp4', 'completed', 0, '2026-03-02 12:10:17', 0, '2026-03-13 10:20:53', 0),
(49, 3, 'Like', 'Liked media ID: 18', 'Completed', 0, '2026-03-02 12:10:17', 0, '2026-03-13 10:20:53', 0),
(50, 3, 'Like', 'Liked: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-03-02 12:10:19', 0, '2026-03-13 10:20:53', 0),
(51, 3, 'Like', 'Liked media ID: 16', 'Completed', 0, '2026-03-02 12:10:19', 0, '2026-03-13 10:20:53', 0),
(52, 2, 'Like', 'Liked: media_69ae30c54ce203.79289678.png', 'completed', 0, '2026-03-09 06:19:39', 0, '2026-03-13 10:20:53', 0),
(53, 2, 'Like', 'Liked media ID: 20', 'Completed', 0, '2026-03-09 06:19:39', 0, '2026-03-13 10:20:53', 0),
(54, 2, 'Like', 'Liked: media_69a57d825c7bd7.20963411.png', 'completed', 0, '2026-03-09 06:19:40', 0, '2026-03-13 10:20:53', 0),
(55, 2, 'Like', 'Liked media ID: 19', 'Completed', 0, '2026-03-09 06:19:40', 0, '2026-03-13 10:20:53', 0),
(56, 2, 'Like', 'Liked: media_69a566288b63c7.44668412.mp4', 'completed', 0, '2026-03-09 06:19:42', 0, '2026-03-13 10:20:53', 0),
(57, 2, 'Like', 'Liked media ID: 18', 'Completed', 0, '2026-03-09 06:19:42', 0, '2026-03-13 10:20:53', 0),
(58, 2, 'Like', 'Liked: media_6997bfe7c6d485.96473726.mp4', 'completed', 0, '2026-03-11 07:40:05', 0, '2026-03-13 10:20:53', 0),
(59, 2, 'Like', 'Liked media ID: 15', 'Completed', 0, '2026-03-11 07:40:05', 0, '2026-03-13 10:20:53', 0),
(60, 2, 'Like', 'Liked: media_6997bfc1cf33d6.32641441.png', 'completed', 0, '2026-03-11 08:38:39', 0, '2026-03-13 10:20:53', 0),
(61, 2, 'View', 'Viewed media: media_6997bfe7c6d485.96473726.mp4', 'completed', 0, '2026-03-11 12:19:19', 0, '2026-03-13 10:20:53', 0),
(62, 2, 'referral_signup', '', 'completed', 0, '2026-03-13 10:25:16', 50, '2026-03-13 10:25:16', 0),
(63, 3, 'View', 'Viewed media: media_69b42b2cb3efd6.31283055.png', 'completed', 0, '2026-03-13 15:20:13', 0, '2026-03-13 15:20:13', 0),
(64, 3, 'View', 'Viewed media: media_69b43042215307.36052279.png', 'completed', 0, '2026-03-13 15:41:55', 0, '2026-03-13 15:41:55', 0),
(65, 11, 'View', 'Viewed media: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-03-14 14:52:16', 0, '2026-03-14 14:52:16', 0),
(66, 11, 'View', 'Viewed media: media_6997bfc1cf33d6.32641441.png', 'completed', 0, '2026-03-14 14:52:16', 0, '2026-03-14 14:52:16', 0),
(67, 11, 'View', 'Viewed media: media_698a1ba1aaab62.17640686.png', 'completed', 0, '2026-03-14 14:52:16', 0, '2026-03-14 14:52:16', 0),
(68, 11, 'View', 'Viewed media: media_6980c0ab862ae2.61409546.png', 'completed', 0, '2026-03-14 14:52:16', 0, '2026-03-14 14:52:16', 0),
(69, 11, 'View', 'Viewed media: media_6984aa8bddaa74.57499321.png', 'completed', 0, '2026-03-14 14:52:16', 0, '2026-03-14 14:52:16', 0),
(70, 11, 'View', 'Viewed media: media_69b43042215307.36052279.png', 'completed', 0, '2026-03-14 14:52:16', 0, '2026-03-14 14:52:16', 0),
(71, 11, 'Like', 'Liked: media_69b43042215307.36052279.png', 'completed', 0, '2026-03-14 14:52:19', 0, '2026-03-14 14:52:19', 0),
(72, 11, 'Like', 'Liked: media_69a566288b63c7.44668412.mp4', 'completed', 0, '2026-03-14 14:52:21', 0, '2026-03-14 14:52:21', 0),
(73, 11, 'View', 'Visited activity history page', 'completed', 0, '2026-03-14 14:52:33', 0, '2026-03-14 14:52:33', 0),
(74, 8, 'referral_signup', '', 'completed', 0, '2026-03-16 11:42:08', 50, '2026-03-16 11:42:08', 0),
(75, 12, 'View', 'Viewed media: media_6997bfc1cf33d6.32641441.png', 'completed', 0, '2026-03-16 11:43:41', 0, '2026-03-16 11:43:41', 0),
(76, 12, 'View', 'Viewed media: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-03-16 11:43:41', 0, '2026-03-16 11:43:41', 0),
(77, 12, 'View', 'Viewed media: media_69b43042215307.36052279.png', 'completed', 0, '2026-03-16 11:43:41', 0, '2026-03-16 11:43:41', 0),
(78, 12, 'View', 'Viewed media: media_698a1ba1aaab62.17640686.png', 'completed', 0, '2026-03-16 11:43:41', 0, '2026-03-16 11:43:41', 0),
(79, 12, 'View', 'Viewed media: media_6984aa8bddaa74.57499321.png', 'completed', 0, '2026-03-16 11:43:41', 0, '2026-03-16 11:43:41', 0),
(80, 12, 'View', 'Viewed media: media_6980c0ab862ae2.61409546.png', 'completed', 0, '2026-03-16 11:43:41', 0, '2026-03-16 11:43:41', 0),
(81, 12, 'Like', 'Liked: media_6984aa8bddaa74.57499321.png', 'completed', 0, '2026-03-16 11:43:49', 0, '2026-03-16 11:43:49', 0),
(82, 12, 'Like', 'Liked: media_6984abbfca3683.00002846.mp4', 'completed', 0, '2026-03-16 11:43:51', 0, '2026-03-16 11:43:51', 0),
(83, 12, 'Scroll', 'Scrolled media: media_69a566288b63c7.44668412.mp4', 'completed', 2, '2026-03-16 12:37:53', 0, '2026-03-16 12:37:53', 0),
(84, 12, 'Scroll', 'Scrolled media: media_6997c00e95c922.54344994.png', 'completed', 2, '2026-03-16 12:37:53', 0, '2026-03-16 12:37:53', 0),
(85, 12, 'Scroll', 'Scrolled media: media_69b43042215307.36052279.png', 'completed', 2, '2026-03-16 12:37:53', 0, '2026-03-16 12:37:53', 0),
(86, 12, 'Scroll', 'Scrolled media: media_6997bfe7c6d485.96473726.mp4', 'completed', 2, '2026-03-16 12:37:57', 0, '2026-03-16 12:37:57', 0),
(87, 12, 'Scroll', 'Scrolled media: media_698a1ba1aaab62.17640686.png', 'completed', 2, '2026-03-16 12:37:57', 0, '2026-03-16 12:37:57', 0),
(88, 12, 'Scroll', 'Scrolled media: media_6997bfc1cf33d6.32641441.png', 'completed', 2, '2026-03-16 12:37:57', 0, '2026-03-16 12:37:57', 0),
(89, 12, 'Scroll', 'Scrolled media: media_6984abbfca3683.00002846.mp4', 'completed', 2, '2026-03-16 12:37:59', 0, '2026-03-16 12:37:59', 0),
(90, 12, 'Scroll', 'Scrolled media: media_6984aa8bddaa74.57499321.png', 'completed', 2, '2026-03-16 12:37:59', 0, '2026-03-16 12:37:59', 0),
(91, 12, 'Scroll', 'Scrolled media: media_6980e6728e1300.75563431.mp4', 'completed', 2, '2026-03-16 12:37:59', 0, '2026-03-16 12:37:59', 0),
(92, 12, 'Scroll', 'Scrolled media: media_6980c0ab862ae2.61409546.png', 'completed', 2, '2026-03-16 12:38:00', 0, '2026-03-16 12:38:00', 0),
(93, 8, 'referral', '', 'completed', 0, '2026-03-16 13:12:52', 0, '2026-03-16 13:12:52', 50),
(94, 13, 'Scroll', 'Scrolled media: media_69b43042215307.36052279.png', 'completed', 2, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(95, 13, 'Scroll', 'Scrolled media: media_69a566288b63c7.44668412.mp4', 'completed', 2, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(96, 13, 'Scroll', 'Scrolled media: media_6997c00e95c922.54344994.png', 'completed', 2, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(97, 13, 'View', 'Viewed media: media_69b43042215307.36052279.png', 'completed', 0, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(98, 13, 'View', 'Viewed media: media_6997c00e95c922.54344994.png', 'completed', 0, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(99, 13, 'View', 'Viewed media: media_6997bfc1cf33d6.32641441.png', 'completed', 0, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(100, 13, 'View', 'Viewed media: media_698a1ba1aaab62.17640686.png', 'completed', 0, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(101, 13, 'View', 'Viewed media: media_6984aa8bddaa74.57499321.png', 'completed', 0, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(102, 13, 'View', 'Viewed media: media_6980c0ab862ae2.61409546.png', 'completed', 0, '2026-03-16 13:13:05', 0, '2026-03-16 13:13:05', 0),
(103, 13, 'Scroll', 'Scrolled media: media_6997bfe7c6d485.96473726.mp4', 'completed', 2, '2026-03-16 13:13:07', 0, '2026-03-16 13:13:07', 0),
(104, 13, 'Scroll', 'Scrolled media: media_6997bfc1cf33d6.32641441.png', 'completed', 2, '2026-03-16 13:13:07', 0, '2026-03-16 13:13:07', 0),
(105, 13, 'Scroll', 'Scrolled media: media_698a1ba1aaab62.17640686.png', 'completed', 2, '2026-03-16 13:13:07', 0, '2026-03-16 13:13:07', 0),
(106, 13, 'Like', 'Liked: media_6997bfe7c6d485.96473726.mp4', 'completed', 0, '2026-03-16 13:13:09', 0, '2026-03-16 13:13:09', 0),
(107, 3, 'Scroll', 'Scrolled media: media_69b43042215307.36052279.png', 'completed', 2, '2026-03-19 08:38:05', 0, '2026-03-19 08:38:05', 0),
(108, 3, 'Scroll', 'Scrolled media: media_69a566288b63c7.44668412.mp4', 'completed', 2, '2026-03-19 08:38:06', 0, '2026-03-19 08:38:06', 0),
(109, 3, 'Scroll', 'Scrolled media: media_69bbb61a68b5c4.78221526.mp4', 'completed', 2, '2026-03-19 08:39:02', 0, '2026-03-19 08:39:02', 0),
(110, 3, 'View', 'Viewed media: media_69a566288b63c7.44668412.mp4', 'completed', 0, '2026-03-19 08:39:22', 0, '2026-03-19 08:39:22', 0),
(111, 3, 'View', 'Viewed media: media_69bbb65f54a014.12554679.png', 'completed', 0, '2026-03-19 08:40:01', 0, '2026-03-19 08:40:01', 0),
(112, 3, 'Scroll', 'Scrolled media: media_69bbc5e2ceab34.86751821.mp4', 'completed', 2, '2026-03-19 09:46:17', 0, '2026-03-19 09:46:17', 0),
(113, 3, 'Scroll', 'Scrolled media: media_69bbb65f54a014.12554679.png', 'completed', 2, '2026-03-19 09:46:17', 0, '2026-03-19 09:46:17', 0),
(114, 3, 'Scroll', 'Scrolled media: media_1773920264_4901.mp4', 'completed', 2, '2026-03-19 12:24:03', 0, '2026-03-19 12:24:03', 0),
(115, 3, 'Scroll', 'Scrolled media: media_1773914360_2992.mp4', 'completed', 2, '2026-03-19 12:24:03', 0, '2026-03-19 12:24:03', 0),
(116, 3, 'Scroll', 'Scrolled media: media_1773924042_8568.png', 'completed', 2, '2026-03-19 12:40:43', 0, '2026-03-19 12:40:43', 0),
(117, 3, 'Scroll', 'Scrolled media: media_1773924027_6150.mp4', 'completed', 2, '2026-03-19 12:40:43', 0, '2026-03-19 12:40:43', 0),
(118, 3, 'View', 'Viewed media: media_1773924042_8568.png', 'completed', 0, '2026-03-19 12:40:43', 0, '2026-03-19 12:40:43', 0),
(119, 3, 'Scroll', 'Scrolled media: media_1773924628_8122.mp4', 'completed', 2, '2026-03-19 12:50:29', 0, '2026-03-19 12:50:29', 0),
(120, 3, 'Scroll', 'Scrolled media: media_1773924543_7026.mp4', 'completed', 2, '2026-03-19 12:50:29', 0, '2026-03-19 12:50:29', 0),
(121, 3, 'Scroll', 'Scrolled media: media_1773924676_4845.mp4', 'completed', 2, '2026-03-19 12:51:16', 0, '2026-03-19 12:51:16', 0),
(122, 3, 'Scroll', 'Scrolled media: media_1773931831_6637.mp4', 'completed', 2, '2026-03-19 14:50:32', 0, '2026-03-19 14:50:32', 0),
(123, 3, 'Scroll', 'Scrolled media: media_1773942894_7520.mp4', 'completed', 2, '2026-03-19 17:55:19', 0, '2026-03-19 17:55:19', 0),
(124, 3, 'Scroll', 'Scrolled media: media_1773942918_9820.png', 'completed', 2, '2026-03-19 17:55:19', 0, '2026-03-19 17:55:19', 0),
(125, 3, 'View', 'Viewed media: media_1773942918_9820.png', 'completed', 0, '2026-03-19 17:55:19', 0, '2026-03-19 17:55:19', 0),
(126, 3, 'Scroll', 'Scrolled media: media_6980c0ab862ae2.61409546.png', 'completed', 2, '2026-03-19 17:55:50', 0, '2026-03-19 17:55:50', 0),
(127, 8, 'Scroll', 'Scrolled media: media_1773942918_9820.png', 'completed', 2, '2026-03-20 06:03:21', 0, '2026-03-20 06:03:21', 0),
(128, 8, 'Scroll', 'Scrolled media: media_69b43042215307.36052279.png', 'completed', 2, '2026-03-20 06:03:21', 0, '2026-03-20 06:03:21', 0),
(129, 8, 'Scroll', 'Scrolled media: media_69bbb65f54a014.12554679.png', 'completed', 2, '2026-03-20 06:03:21', 0, '2026-03-20 06:03:21', 0),
(130, 8, 'Scroll', 'Scrolled media: media_1773924042_8568.png', 'completed', 2, '2026-03-20 06:03:22', 0, '2026-03-20 06:03:22', 0),
(131, 8, 'Scroll', 'Scrolled media: media_69a566288b63c7.44668412.mp4', 'completed', 2, '2026-03-20 06:03:22', 0, '2026-03-20 06:03:22', 0),
(132, 8, 'View', 'Viewed media: media_1773942918_9820.png', 'completed', 0, '2026-03-20 06:03:22', 0, '2026-03-20 06:03:22', 0),
(133, 8, 'View', 'Viewed media: media_69bbb65f54a014.12554679.png', 'completed', 0, '2026-03-20 06:03:22', 0, '2026-03-20 06:03:22', 0),
(134, 8, 'View', 'Viewed media: media_1773924042_8568.png', 'completed', 0, '2026-03-20 06:03:22', 0, '2026-03-20 06:03:22', 0),
(135, 8, 'View', 'Viewed media: media_69b43042215307.36052279.png', 'completed', 0, '2026-03-20 06:03:22', 0, '2026-03-20 06:03:22', 0),
(136, 8, 'View', 'Viewed media: media_69a566288b63c7.44668412.mp4', 'completed', 0, '2026-03-20 06:03:38', 0, '2026-03-20 06:03:38', 0),
(137, 3, 'Scroll', 'Scrolled media: media_1773986976_6787.mp4', 'completed', 2, '2026-03-20 06:09:38', 0, '2026-03-20 06:09:38', 0),
(138, 3, 'View', 'Viewed media: media_1773987018_4244.png', 'completed', 0, '2026-03-20 06:10:18', 0, '2026-03-20 06:10:18', 0),
(139, 3, 'Scroll', 'Scrolled media: media_1773987018_4244.png', 'completed', 2, '2026-03-20 06:10:20', 0, '2026-03-20 06:10:20', 0),
(140, 3, 'Scroll', 'Scrolled media: media_1773987661_3330.mp4', 'completed', 2, '2026-03-20 06:21:11', 0, '2026-03-20 06:21:11', 0),
(141, 3, 'Scroll', 'Scrolled media: media_1773988360_1465.mp4', 'completed', 2, '2026-03-20 06:32:41', 0, '2026-03-20 06:32:41', 0),
(142, 3, 'Scroll', 'Scrolled media: media_1773996393_3971.mp4', 'completed', 2, '2026-03-20 08:47:26', 0, '2026-03-20 08:47:26', 0),
(143, 3, 'View', 'Viewed media: media_1773998585_2105.mp4', 'completed', 0, '2026-03-20 09:23:09', 0, '2026-03-20 09:23:09', 0),
(144, 8, 'View', 'Viewed media: media_1773987018_4244.png', 'completed', 0, '2026-03-21 06:49:12', 0, '2026-03-21 06:49:12', 0),
(145, 8, 'View', 'Viewed media: media_1773998585_2105.mp4', 'completed', 0, '2026-03-21 06:49:21', 0, '2026-03-21 06:49:21', 0),
(146, 8, 'View', 'Visited activity history page', 'completed', 0, '2026-03-21 12:35:21', 0, '2026-03-21 12:35:21', 0),
(147, 13, 'View', 'Viewed media: media_1773987018_4244.png', 'completed', 0, '2026-03-21 12:38:32', 0, '2026-03-21 12:38:32', 0),
(148, 13, 'View', 'Viewed media: media_1773942918_9820.png', 'completed', 0, '2026-03-21 12:38:32', 0, '2026-03-21 12:38:32', 0),
(149, 13, 'View', 'Viewed media: media_1773924042_8568.png', 'completed', 0, '2026-03-21 12:38:32', 0, '2026-03-21 12:38:32', 0),
(150, 13, 'View', 'Viewed media: media_69bbb65f54a014.12554679.png', 'completed', 0, '2026-03-21 12:38:32', 0, '2026-03-21 12:38:32', 0),
(151, 13, 'Watch', 'Watched video: media_1773998585_2105.mp4', 'completed', 0, '2026-03-21 12:38:56', 0, '2026-03-21 12:38:56', 0),
(152, 3, 'View', 'Viewed media: media_1774415400_7521.png', 'completed', 0, '2026-03-25 05:10:02', 0, '2026-03-25 05:10:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_stats`
--

DROP TABLE IF EXISTS `user_stats`;
CREATE TABLE IF NOT EXISTS `user_stats` (
  `user_id` int NOT NULL,
  `clicks` int DEFAULT '0',
  `invitations` int DEFAULT '0',
  `completed_tasks` int DEFAULT '0',
  `total_rewards` decimal(10,2) DEFAULT '0.00',
  `referrals` int DEFAULT '0',
  `surveys_done` int DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_stats`
--

INSERT INTO `user_stats` (`user_id`, `clicks`, `invitations`, `completed_tasks`, `total_rewards`, `referrals`, `surveys_done`, `updated_at`) VALUES
(0, 0, 0, 0, 0.00, 0, 0, '2026-02-19 16:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `type` enum('image','video') NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
