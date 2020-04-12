-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 10:19 AM
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
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `restaurant_name`, `branch_name`, `short_desc`, `full_desc`, `business_hours`, `address`, `longitude`, `latitude`, `website`, `phone_no`, `image`, `date_created`) VALUES
(1, 'Sukiya', 'Fuchu', 'short', 'long', '10AM', 'Makati, Philippines', '121.033330', '14.550000', 'www', '090', '1.jpg', '0000-00-00 00:00:00'),
(2, 'Mang Donaldo', 'Makati', 'short', 'long', '10AM', 'Fuchu Driver\'s License Center, 多磨町3-1-1, Fuchu Shi, Tokyo Prefecture, Japan', NULL, NULL, 'www', '090', '2.jpg', '2020-03-16 20:00:00'),
(3, 'KMC', 'Makati', 'short', 'long', '10AM', 'Makati, Philippines', '121.033330', '14.550000', 'www', '090', '3.jpg', '2020-03-16 18:00:00'),
(4, 'Wendies', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '4.jpg', '2020-03-16 21:00:00'),
(5, 'ABC', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '5.jpg', '2020-03-16 21:00:00'),
(6, 'A', 'Makati', 'short', 'long', '10AM', 'a', NULL, NULL, 'www', '090', '6.jpg', '0000-00-00 00:00:00'),
(7, 'B', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '7.jpg', '2020-03-16 20:00:00'),
(8, 'C', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '8.jpg', '2020-03-16 18:00:00'),
(9, 'D', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '9.jpg', '2020-03-16 21:00:00'),
(10, 'E', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '10.jpg', '2020-03-16 21:00:00'),
(11, 'F', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '11.jpg', '2020-03-16 21:00:00'),
(12, 'G', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '12.jpg', '2020-03-16 21:00:00'),
(13, 'X', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '13.jpg', '2020-03-16 20:00:00'),
(14, 'Y', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '14.jpg', '2020-03-16 18:00:00'),
(15, 'Z', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '15.jpg', '2020-03-16 21:00:00'),
(16, 'Q', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '16.jpg', '2020-03-16 21:00:00'),
(17, 'R', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '17.jpg', '2020-03-16 21:00:00'),
(18, 'S', 'Makati', 'short', 'long', '10AM', 'Makati City', NULL, NULL, 'www', '090', '18.jpg', '2020-03-16 21:00:00');

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
  `status_id` int(5) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `restaurant_id`, `floor_id`, `row_no`, `col_no`, `status_id`, `date_modified`) VALUES
(21, 2, 1, 25, 1, 0, '2020-03-08 15:42:15'),
(22, 2, 1, 25, 20, 2, '2020-03-08 15:42:15'),
(23, 4, 3, 1, 1, 1, '2020-03-08 16:20:16'),
(25, 4, 1, 1, 1, 0, '2020-03-10 21:51:12'),
(29, 1, 1, 2, 2, 2, '2020-04-10 20:56:08'),
(30, 1, 1, 2, 3, 2, '2020-04-10 20:56:08'),
(31, 1, 1, 3, 2, 1, '2020-04-10 20:56:08'),
(32, 1, 1, 3, 3, 2, '2020-04-10 20:56:08'),
(33, 1, 2, 2, 3, 0, '2020-04-10 20:56:08'),
(34, 1, 2, 2, 4, 0, '2020-04-10 20:56:08'),
(35, 1, 2, 3, 3, 0, '2020-04-10 20:56:08'),
(36, 1, 2, 3, 4, 0, '2020-04-10 20:56:08'),
(37, 1, 3, 2, 4, 2, '2020-04-10 20:56:08'),
(38, 1, 3, 2, 5, 2, '2020-04-10 20:56:08'),
(39, 1, 3, 3, 4, 2, '2020-04-10 20:56:08'),
(40, 1, 3, 3, 5, 2, '2020-04-10 20:56:08'),
(41, 1, 4, 2, 5, 0, '2020-04-10 20:56:08'),
(42, 1, 4, 2, 6, 0, '2020-04-10 20:56:08'),
(43, 1, 4, 3, 5, 0, '2020-04-10 20:56:08'),
(44, 1, 4, 3, 6, 0, '2020-04-10 20:56:08'),
(45, 1, 1, 2, 4, 0, '2020-04-10 20:59:50'),
(46, 1, 1, 3, 4, 0, '2020-04-10 20:59:50'),
(47, 1, 1, 1, 1, 0, '2020-04-10 21:30:24'),
(48, 1, 1, 1, 20, 0, '2020-04-10 21:30:24'),
(49, 1, 1, 25, 1, 0, '2020-04-10 21:30:24'),
(50, 1, 1, 25, 20, 0, '2020-04-10 21:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `seat_status`
--

CREATE TABLE `seat_status` (
  `seat_status_id` int(10) NOT NULL,
  `seat_status_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
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
(13, 'test', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'test@gmail.com', '2020-04-06 13:47:29'),
(14, 'glad', 'c6aa1595f76142b8020e7f7ec2ddaa8ef62a4254a5819095f4f8ed4816d96123', 'gladysbroce@gmail.com', '2020-04-06 14:00:40');

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
  MODIFY `seat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
