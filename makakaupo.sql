-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2020 at 02:18 PM
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
  `website` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `restaurant_name`, `branch_name`, `short_desc`, `full_desc`, `business_hours`, `address`, `website`, `phone_no`) VALUES
(1, 'jobee', 'Makati', 'short', 'long', '10AM', 'Makati City', 'www', '090');

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
(18, 1, 2, 1, 1, 2, '2020-03-08 15:39:40'),
(20, 1, 1, 1, 20, 2, '2020-03-08 15:42:15'),
(21, 1, 1, 25, 1, 2, '2020-03-08 15:42:15'),
(22, 1, 1, 25, 20, 2, '2020-03-08 15:42:15'),
(23, 1, 3, 1, 1, 1, '2020-03-08 16:20:16'),
(25, 1, 1, 1, 1, 0, '2020-03-10 21:51:12');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `restaurant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
