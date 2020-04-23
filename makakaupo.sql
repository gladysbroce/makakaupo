-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 04:55 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makakaupo`
--

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `restaurant_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `branch_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_desc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `full_desc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `business_hours` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `website` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.png',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `user_id`, `restaurant_name`, `branch_name`, `short_desc`, `full_desc`, `business_hours`, `address`, `longitude`, `latitude`, `website`, `phone_no`, `image`, `last_modified`) VALUES
(1, 1, 'Jobeeee', 'tanauan', 'short', 'long', '10AM', 'Tanauan, Batangas, Philippines', '121.150000', '14.083330', 'www', '090', '1.jpg', '2020-04-21 14:12:00'),
(2, 2, 'Mang Donaldo', 'Makati', 'short', 'long', '10AM', 'Shibuya, Tokyo, Tokyo Prefecture, Japan', '139.702400', '35.669800', 'www', '090', '2.jpg', '2020-04-21 14:12:03'),
(3, 3, 'KMC', 'Makati', 'short', 'long', '10AM', 'Makati, Philippines', '121.033330', '14.550000', 'www', '090', '3.jpg', '2020-04-21 14:12:06'),
(4, 0, 'Wendies', 'Makati', 'short', 'long', '10AM', 'Mandaluyong, Philippines', '121.033330', '14.583330', 'www', '090', '4.jpg', '2020-03-16 12:00:00'),
(5, 0, 'ABC', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '5.jpg', '2020-03-16 12:00:00'),
(6, 0, 'A', 'Makati', 'short', 'long', '10AM', 'Shibuya, Tokyo, Tokyo Prefecture, Japan', '139.702400', '35.669800', 'www', '090', '6.jpg', '0000-00-00 00:00:00'),
(7, 0, 'B', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '7.jpg', '2020-03-16 11:00:00'),
(8, 0, 'C', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '8.jpg', '2020-03-16 09:00:00'),
(9, 0, 'D', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '9.jpg', '2020-03-16 12:00:00'),
(10, 0, 'E', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '10.jpg', '2020-03-16 12:00:00'),
(11, 0, 'F', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '11.jpg', '2020-03-16 12:00:00'),
(12, 0, 'G', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '12.jpg', '2020-03-16 12:00:00'),
(13, 0, 'X', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '13.jpg', '2020-03-16 11:00:00'),
(14, 0, 'Y', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '14.jpg', '2020-03-16 09:00:00'),
(15, 0, 'Z', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '15.jpg', '2020-03-16 12:00:00'),
(16, 0, 'Q', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '16.jpg', '2020-03-16 12:00:00'),
(17, 0, 'R', 'Makati', 'short', 'long', '10AM', 'Batangas City, Batangas, Philippines', '121.050000', '13.750000', 'www', '090', '17.jpg', '2020-03-16 12:00:00'),
(18, 0, 'S', 'Makati', 'short', 'long', '10AM', 'Makati City', '121.033330', '14.550000', 'www', '090', '18.jpg', '2020-03-16 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seat_id` int(10) NOT NULL,
  `restaurant_id` int(10) NOT NULL,
  `floor_id` int(10) NOT NULL,
  `row_no` int(5) NOT NULL,
  `col_no` int(5) NOT NULL,
  `status_id` int(2) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `restaurant_id`, `floor_id`, `row_no`, `col_no`, `status_id`, `date_modified`) VALUES
(1, 1, 1, 1, 1, 1, '2020-04-16 21:03:40'),
(2, 1, 1, 1, 20, 1, '2020-04-16 21:03:40'),
(3, 1, 1, 25, 1, 1, '2020-04-16 21:03:40'),
(4, 1, 1, 25, 20, 1, '2020-04-16 21:03:40'),
(5, 1, 2, 1, 2, 1, '2020-04-16 21:03:40'),
(6, 1, 2, 1, 19, 0, '2020-04-16 21:03:40'),
(7, 1, 2, 25, 2, 0, '2020-04-16 21:03:40'),
(8, 1, 2, 25, 19, 0, '2020-04-16 21:03:40'),
(9, 1, 1, 1, 2, 1, '2020-04-18 12:07:54'),
(10, 1, 1, 1, 19, 1, '2020-04-18 12:07:54'),
(11, 1, 1, 2, 1, 1, '2020-04-18 12:07:54'),
(12, 1, 1, 2, 2, 1, '2020-04-18 12:07:54'),
(13, 1, 1, 2, 19, 1, '2020-04-18 12:07:54'),
(14, 1, 1, 2, 20, 1, '2020-04-18 12:07:54'),
(15, 1, 1, 24, 1, 1, '2020-04-18 12:07:54'),
(16, 1, 1, 24, 2, 1, '2020-04-18 12:07:54'),
(17, 1, 1, 24, 19, 1, '2020-04-18 12:07:54'),
(18, 1, 1, 24, 20, 1, '2020-04-18 12:07:54'),
(19, 1, 1, 25, 2, 1, '2020-04-18 12:07:54'),
(20, 1, 1, 25, 19, 1, '2020-04-18 12:07:54'),
(21, 1, 1, 23, 2, 0, '2020-04-18 15:26:50'),
(22, 2, 1, 1, 1, 0, '2020-04-21 23:43:44'),
(23, 2, 1, 25, 20, 0, '2020-04-21 23:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `seat_log`
--

CREATE TABLE `seat_log` (
  `seat_log_id` int(50) NOT NULL,
  `restaurant_id` int(10) NOT NULL,
  `floor_id` int(10) NOT NULL,
  `row_no` int(5) NOT NULL,
  `col_no` int(5) NOT NULL,
  `status_id` int(2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seat_log`
--

INSERT INTO `seat_log` (`seat_log_id`, `restaurant_id`, `floor_id`, `row_no`, `col_no`, `status_id`, `date_created`) VALUES
(1, 1, 1, 1, 1, 1, '2020-04-15 21:03:50'),
(2, 1, 1, 1, 20, 1, '2020-04-01 00:00:00'),
(3, 1, 2, 1, 2, 1, '2020-04-18 12:03:57'),
(4, 1, 2, 1, 2, 2, '2020-04-17 21:03:59'),
(5, 1, 1, 1, 1, 2, '2020-04-11 21:04:48'),
(6, 1, 1, 1, 1, 1, '2020-04-16 21:04:50'),
(7, 1, 1, 1, 20, 2, '2020-04-16 21:05:13'),
(8, 1, 1, 1, 20, 0, '2020-04-16 21:05:13'),
(9, 1, 2, 1, 2, 1, '2020-04-17 21:05:25'),
(10, 1, 2, 1, 2, 1, '2020-04-18 00:00:00'),
(11, 1, 1, 1, 1, 1, '2020-04-18 12:16:26'),
(12, 1, 1, 1, 1, 2, '2020-04-18 12:16:26'),
(13, 1, 1, 1, 2, 1, '2020-04-18 12:16:28'),
(14, 1, 1, 1, 2, 2, '2020-04-18 12:16:28'),
(15, 1, 1, 1, 2, 0, '2020-04-18 12:21:31'),
(16, 1, 1, 1, 2, 1, '2020-04-18 12:22:22'),
(17, 1, 1, 1, 2, 2, '2020-04-18 12:22:23'),
(18, 1, 1, 1, 2, 0, '2020-04-18 12:25:39'),
(19, 1, 1, 1, 2, 1, '2020-04-18 12:25:39'),
(20, 1, 1, 1, 2, 2, '2020-04-18 12:25:41'),
(21, 1, 1, 1, 2, 0, '2020-04-18 12:25:41'),
(22, 1, 1, 2, 2, 1, '2020-04-18 12:26:58'),
(23, 1, 1, 2, 2, 2, '2020-04-18 12:26:58'),
(24, 1, 1, 2, 2, 0, '2020-04-18 12:27:04'),
(25, 1, 1, 2, 2, 1, '2020-04-18 12:27:04'),
(26, 1, 1, 2, 2, 0, '2020-04-18 12:29:42'),
(27, 1, 1, 2, 2, 2, '2020-04-18 12:29:47'),
(28, 1, 1, 1, 2, 2, '2020-04-18 12:29:52'),
(29, 1, 1, 1, 2, 0, '2020-04-18 12:29:54'),
(30, 1, 1, 1, 2, 1, '2020-04-18 12:29:54'),
(31, 1, 1, 2, 1, 2, '2020-04-18 12:29:57'),
(32, 1, 1, 2, 2, 1, '2020-04-18 12:32:50'),
(33, 1, 1, 1, 1, 2, '2020-04-18 13:02:30'),
(34, 1, 1, 1, 20, 2, '2020-04-18 13:02:30'),
(35, 1, 1, 25, 1, 2, '2020-04-18 13:02:30'),
(36, 1, 1, 25, 20, 2, '2020-04-18 13:02:30'),
(37, 1, 1, 1, 2, 2, '2020-04-18 13:02:30'),
(38, 1, 1, 1, 19, 2, '2020-04-18 13:02:30'),
(39, 1, 1, 2, 1, 2, '2020-04-18 13:02:30'),
(40, 1, 1, 2, 2, 2, '2020-04-18 13:02:30'),
(41, 1, 1, 2, 19, 2, '2020-04-18 13:02:30'),
(42, 1, 1, 2, 20, 2, '2020-04-18 13:02:30'),
(43, 1, 1, 24, 1, 2, '2020-04-18 13:02:30'),
(44, 1, 1, 24, 2, 2, '2020-04-18 13:02:30'),
(45, 1, 1, 24, 19, 2, '2020-04-18 13:02:30'),
(46, 1, 1, 24, 20, 2, '2020-04-18 13:02:30'),
(47, 1, 1, 25, 2, 2, '2020-04-18 13:02:30'),
(48, 1, 1, 25, 19, 2, '2020-04-18 13:02:30'),
(49, 1, 1, 1, 1, 1, '2020-04-18 13:02:34'),
(50, 1, 1, 1, 20, 1, '2020-04-18 13:02:34'),
(51, 1, 1, 25, 1, 1, '2020-04-18 13:02:34'),
(52, 1, 1, 25, 20, 1, '2020-04-18 13:02:34'),
(53, 1, 1, 1, 2, 1, '2020-04-18 13:02:34'),
(54, 1, 1, 1, 19, 1, '2020-04-18 13:02:34'),
(55, 1, 1, 2, 1, 1, '2020-04-18 13:02:34'),
(56, 1, 1, 2, 2, 1, '2020-04-18 13:02:34'),
(57, 1, 1, 2, 19, 1, '2020-04-18 13:02:34'),
(58, 1, 1, 2, 20, 1, '2020-04-18 13:02:34'),
(59, 1, 1, 24, 1, 1, '2020-04-18 13:02:34'),
(60, 1, 1, 24, 2, 1, '2020-04-18 13:02:34'),
(61, 1, 1, 24, 19, 1, '2020-04-18 13:02:34'),
(62, 1, 1, 24, 20, 1, '2020-04-18 13:02:34'),
(63, 1, 1, 25, 2, 1, '2020-04-18 13:02:34'),
(64, 1, 1, 25, 19, 1, '2020-04-18 13:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `seat_status`
--

CREATE TABLE `seat_status` (
  `seat_status_id` int(10) NOT NULL,
  `seat_status_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seat_status`
--

INSERT INTO `seat_status` (`seat_status_id`, `seat_status_name`) VALUES
(0, 'vacant'),
(1, 'occupied'),
(2, 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `last_login`) VALUES
(1, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '2020-03-28 04:48:35'),
(2, 'test', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'test@gmail.com', '2020-04-21 14:11:32'),
(3, 'glad', 'c6aa1595f76142b8020e7f7ec2ddaa8ef62a4254a5819095f4f8ed4816d96123', 'gladysbroce@gmail.com', '2020-04-21 14:11:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `seat_log`
--
ALTER TABLE `seat_log`
  ADD PRIMARY KEY (`seat_log_id`);

--
-- Indexes for table `seat_status`
--
ALTER TABLE `seat_status`
  ADD PRIMARY KEY (`seat_status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `seat_log`
--
ALTER TABLE `seat_log`
  MODIFY `seat_log_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
