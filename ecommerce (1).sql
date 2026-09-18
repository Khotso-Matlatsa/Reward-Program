-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2025 at 01:04 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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

CREATE TABLE `admintable` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(150) NOT NULL,
  `adminpassword` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`admin_id`, `admin_username`, `adminpassword`) VALUES
(1, 'b72f6e2cba66f789794b3bf19d1b1ab6', '376201e37956aa9d46b8b6b63bfb02bd');

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `product_ID` int(11) NOT NULL,
  `businessname` varchar(150) NOT NULL,
  `productname` varchar(150) NOT NULL,
  `sellingprice` varchar(11) NOT NULL,
  `filename` blob NOT NULL,
  `businesstype` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `claims` (
  `claim_id` int(11) NOT NULL,
  `claimantname` varchar(150) NOT NULL,
  `claimantemail` varchar(600) NOT NULL,
  `claimantcontacts` varchar(100) NOT NULL,
  `rewardtype` varchar(150) NOT NULL,
  `paymentmethod` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`claim_id`, `claimantname`, `claimantemail`, `claimantcontacts`, `rewardtype`, `paymentmethod`, `status`) VALUES
(1, 'Nkeletseng', 'nkeletseng@gmail.com', '', 'Referral Rewards', 'Loyalty Rewards', 1),
(2, 'Refuoehape Khasake', 'k5refuoehape@gmail.com', '+26665478965', 'Loyalty Rewards', 'Referral Rewards', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `caller_ID` int(11) NOT NULL,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`caller_ID`, `fullnames`, `email`, `phone`, `message`, `status`) VALUES
(1, 'baby Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'baby my love', 1),
(2, 'baby Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'baby my love', 0),
(3, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'how to create account', 0),
(4, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'how to create account', 0),
(5, 'Refuoehape', 'bosy@gmail.com', 2147483647, 'please come over', 0),
(6, 'Refuoehape', 'bosy@gmail.com', 2147483647, 'please come over', 0),
(7, 'lineo koki', 'lineo@gmail.com', 2147483647, 'registration does not work', 0),
(8, 'lineo koki', 'lineo@gmail.com', 2147483647, 'registration does not work', 0),
(9, 'lineo koki', 'krefuoehape@gmail.com', 2147483647, 'registration does not work', 0),
(10, 'lineo koki', 'krefuoehape@gmail.com', 2147483647, 'registration does not work', 0),
(11, 'Refuoehape', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'how to create account', 1),
(12, 'Refuoehape', 'nkeletsengluciamaretlane@gmail.com', 2147483647, 'how to create account', 1),
(13, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'please come over', 1),
(14, 'baby Nkeletseng', 'kerefuoehape@gmail.com', 2147483647, 'please come over', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emailtable`
--

CREATE TABLE `emailtable` (
  `email_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(15, 'reabetsoe1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `filename` blob NOT NULL,
  `size` varchar(110) NOT NULL,
  `downloads` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `filename`, `size`, `downloads`, `status`) VALUES
(13, 0x4d65646961322e6d7034, '6465588', '0', 0),
(14, 0x4d65646961312e6d7034, '5079389', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_ID` int(11) NOT NULL,
  `position` varchar(150) NOT NULL,
  `requirements` varchar(600) NOT NULL,
  `positionnumber` int(11) NOT NULL,
  `emailto` varchar(150) NOT NULL,
  `jobtype` varchar(50) NOT NULL,
  `applydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_ID`, `position`, `requirements`, `positionnumber`, `emailto`, `jobtype`, `applydate`) VALUES
(1, 'finance officer', 'degree in finance', 1, 'krefuoehape@gmail.com', 'Full-time', '2025-11-11 11:11:00'),
(14, 'IT personnel', 'degree in IT and 5 years experience', 2, 'careers@quicksolutionsmedia.org', 'internship', '2025-10-25 23:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `softwaretasks`
--

CREATE TABLE `softwaretasks` (
  `softwaretask_id` int(11) NOT NULL,
  `softwaretitle` varchar(150) NOT NULL,
  `businessname` varchar(150) NOT NULL,
  `softwaredescription` varchar(500) NOT NULL,
  `softwarelink` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `softwaretasks`
--

INSERT INTO `softwaretasks` (`softwaretask_id`, `softwaretitle`, `businessname`, `softwaredescription`, `softwarelink`) VALUES
(1, 'bitcoin app', 'bitcoin', 'this app helps thos who wish to trade for a living to make money from the comfort of their home via an app', 'https://bitcoinapp.com'),
(2, 'a book', 'rich dad', 'this book teaches readers how to get rich', 'https://book.com'),
(4, 'cooking tutorial', 'lipuo kitchen', 'this tutorial shows how to cook best food', 'https://cookingtutorial.org');

-- --------------------------------------------------------

--
-- Table structure for table `surveyleads`
--

CREATE TABLE `surveyleads` (
  `surveylead_id` int(11) NOT NULL,
  `surveyorname` varchar(150) NOT NULL,
  `surveyoremail` varchar(150) NOT NULL,
  `surveyorphone` varchar(100) NOT NULL,
  `surveynumber` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveyleads`
--

INSERT INTO `surveyleads` (`surveylead_id`, `surveyorname`, `surveyoremail`, `surveyorphone`, `surveynumber`) VALUES
(1, 'Refuoehape Khasake', 'krefuoehape@gmail.com', '+26651865798', 'i request survey 2'),
(2, 'Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', '+26651865798', 'i request survey 2'),
(3, 'Nkeletseng', 'nkeletsengluciamaretlane@gmail.com', '+26651865798', 'i request survey 2');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `businessname` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `surveylink` varchar(250) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `businessname`, `description`, `surveylink`, `deadline`) VALUES
(1, 'starchy combo survey', 'shoprite', 'to check starchy combo effectiveness', 'https://www.googlesurvey.com', '2025-10-08 12:33:00'),
(2, 'clothes on sales', 'pep', 'to check if customers prefer clothes on sale', 'https://www.google23survey.com', '2025-10-09 12:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncecomments`
--

CREATE TABLE `tblannouncecomments` (
  `announcecommentid` int(11) NOT NULL,
  `announcementid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `commentcontent` longtext NOT NULL,
  `commentdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `tblannouncements` (
  `announcementid` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `subject` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblannouncements`
--

INSERT INTO `tblannouncements` (`announcementid`, `content`, `subject`, `date_created`) VALUES
(3, 'attention, QS Media is big', '', '2025-12-03 05:40:59'),
(4, 'hellow guys', '', '2025-12-03 05:41:16'),
(5, 'please note we will process payments soon', 'payments underway', '2025-12-05 01:13:16'),
(6, 'there will be maintence on Friday', 'system under maintenance', '2025-12-05 01:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `commentid` int(11) NOT NULL,
  `fileid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(400) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `postingddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblproductview`
--

CREATE TABLE `tblproductview` (
  `productviewid` int(11) NOT NULL,
  `useremail` varchar(150) NOT NULL,
  `scrollpercentage` double NOT NULL,
  `dateandtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `tblquotation` (
  `quotationid` int(11) NOT NULL,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `companyname` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `urltable`
--

CREATE TABLE `urltable` (
  `url_id` int(11) NOT NULL,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `referrallink` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `urltable`
--

INSERT INTO `urltable` (`url_id`, `fullnames`, `email`, `referrallink`) VALUES
(1, 'Keletso Thulo', 'lineo@gmail.com', 'https://www.quicksolutionsmedia.org lineo@gmail.com 2025-10-06 19:33:21'),
(2, 'Refuoehape Khasake', 'krefuoehape@gmail.com', 'https://www.quicksolutionsmedia.org krefuoehape@gmail.com 2025-10-08 16:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `fullnames` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `referralemail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirmpassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `fullnames`, `email`, `mobile`, `referralemail`, `password`, `confirmpassword`) VALUES
(42, 'lineo', 'neoza1@gmail.com', 2147483647, 'neo@gmail.com', '25f9e794323b453885f5181f1b624d0b', '25f9e794323b453885f5181f1b624d0b'),
(45, 'Refuoehape Khasake', 'krefuoehape@gmail.com', 1234567890, 'krefuoehape@gmail.com', '781e5e245d69b566979b86e28d23f2c7', '781e5e245d69b566979b86e28d23f2c7'),
(48, 'thakane toeba', 'toeba@gmail.com', 53427611, '', '36982186e546c434e046c9bbe578e9d7', '36982186e546c434e046c9bbe578e9d7'),
(49, 'mpho khoasa', 'khoasa@gmail.com', 2147483647, 'krefuoehape@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintable`
--
ALTER TABLE `admintable`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`claim_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`caller_ID`);

--
-- Indexes for table `emailtable`
--
ALTER TABLE `emailtable`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_ID`);

--
-- Indexes for table `softwaretasks`
--
ALTER TABLE `softwaretasks`
  ADD PRIMARY KEY (`softwaretask_id`);

--
-- Indexes for table `surveyleads`
--
ALTER TABLE `surveyleads`
  ADD PRIMARY KEY (`surveylead_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tblannouncecomments`
--
ALTER TABLE `tblannouncecomments`
  ADD PRIMARY KEY (`announcecommentid`);

--
-- Indexes for table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  ADD PRIMARY KEY (`announcementid`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `file` (`fileid`);

--
-- Indexes for table `tblproductview`
--
ALTER TABLE `tblproductview`
  ADD PRIMARY KEY (`productviewid`);

--
-- Indexes for table `tblquotation`
--
ALTER TABLE `tblquotation`
  ADD PRIMARY KEY (`quotationid`);

--
-- Indexes for table `urltable`
--
ALTER TABLE `urltable`
  ADD PRIMARY KEY (`url_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintable`
--
ALTER TABLE `admintable`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `caller_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `emailtable`
--
ALTER TABLE `emailtable`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `softwaretasks`
--
ALTER TABLE `softwaretasks`
  MODIFY `softwaretask_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surveyleads`
--
ALTER TABLE `surveyleads`
  MODIFY `surveylead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblannouncecomments`
--
ALTER TABLE `tblannouncecomments`
  MODIFY `announcecommentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  MODIFY `announcementid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblproductview`
--
ALTER TABLE `tblproductview`
  MODIFY `productviewid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tblquotation`
--
ALTER TABLE `tblquotation`
  MODIFY `quotationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `urltable`
--
ALTER TABLE `urltable`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
