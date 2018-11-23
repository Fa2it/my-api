-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 05:55 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181121113545'),
('20181121195219');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double NOT NULL,
  `creation_date` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_modified_date` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_list` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `supplier_id`, `category_id`, `description`, `unit_price`, `creation_date`, `last_modified_date`, `group_list`, `discount`, `discount_price`) VALUES
(103, 'A', 2553, 0, 'Product A description', 10, '2018-11-21 10:47:04', NULL, NULL, NULL, NULL),
(104, 'B', 7158, 0, 'Product B description', 20, '2018-11-21 12:47:04', NULL, NULL, NULL, NULL),
(105, 'C', 4399, 0, 'Product C description', 30, '2018-11-21 02:47:05', NULL, NULL, NULL, NULL),
(106, 'D', 3489, 0, 'Product D description', 40, '2018-11-20 04:47:05', NULL, NULL, NULL, NULL),
(107, 'E', 8748, 0, 'Product E description', 50, '2018-11-20 06:47:05', NULL, NULL, NULL, NULL),
(108, 'F', 4877, 0, 'Product F description', 60, '2018-11-19 08:47:05', NULL, NULL, NULL, NULL),
(109, 'G', 8436, 0, 'Product G description', 70, '2018-11-19 10:47:05', NULL, NULL, NULL, NULL),
(110, 'H', 2795, 0, 'Product H description', 80, '2018-11-19 12:47:05', NULL, NULL, NULL, NULL),
(111, 'I', 6920, 0, 'Product I description', 90, '2018-11-18 02:47:05', NULL, NULL, NULL, NULL),
(112, 'J', 4950, 0, 'Product J description', 100, '2018-11-18 04:47:05', NULL, NULL, NULL, NULL),
(113, 'K', 8999, 0, 'Product K description', 110, '2018-11-17 06:47:05', NULL, NULL, NULL, NULL),
(114, 'L', 3919, 0, 'Product L description', 120, '2018-11-17 08:47:05', NULL, NULL, NULL, NULL),
(115, 'M', 3661, 0, 'Product M description', 130, '2018-11-16 10:47:05', NULL, NULL, NULL, NULL),
(116, 'N', 9332, 0, 'Product N description', 140, '2018-11-16 12:47:05', NULL, NULL, NULL, NULL),
(117, 'O', 9707, 0, 'Product O description', 150, '2018-11-16 02:47:05', NULL, NULL, NULL, NULL),
(118, 'P', 8881, 0, 'Product P description', 160, '2018-11-15 04:47:05', NULL, NULL, NULL, NULL),
(119, 'Q', 8769, 0, 'Product Q description', 170, '2018-11-15 06:47:05', NULL, NULL, NULL, NULL),
(120, 'R', 2907, 0, 'Product R description', 180, '2018-11-14 08:47:05', NULL, NULL, NULL, NULL),
(121, 'S', 9387, 0, 'Product S description', 190, '2018-11-14 10:47:05', NULL, NULL, NULL, NULL),
(122, 'T', 1307, 0, 'Product T description', 200, '2018-11-14 12:47:05', NULL, NULL, NULL, NULL),
(123, 'U', 6888, 0, 'Product U description', 210, '2018-11-13 02:47:05', NULL, NULL, NULL, NULL),
(124, 'V', 5602, 0, 'Product V description', 220, '2018-11-13 04:47:05', NULL, NULL, NULL, NULL),
(125, 'W', 1390, 0, 'Product W description', 230, '2018-11-12 06:47:05', NULL, NULL, NULL, NULL),
(126, 'X', 3731, 0, 'Product X description', 240, '2018-11-12 08:47:05', NULL, NULL, NULL, NULL),
(127, 'Samsung Handy', 87123, 0, 'i7 32gb RAM, multicore processors', 400, '2018-11-23 05:20:36', NULL, '120, 125, 128', '50%', 200),
(128, 'Lenovo Laptop', 87123, 0, 'i7 32gb RAM, multicore processors', 500, '2018-11-23 05:20:35', '2018-11-22 10:44:48', '120, 125, 128', '-50', 450);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `role`, `password`) VALUES
(3, 'Admin', 'admin@admin.com', 'Admin', '$2y$10$agXWueTmeJmhzUfIa4jubedxmVYgeBpWMjwZgYoKX2hZzxKCk2hV6'),
(5, 'Brown Thomas', 'customer@admin.com', 'Customer', '$2y$10$ncsYBFPxR4PNosgG887y4.4tu6g7lAgPA2liyogudzOn4lWzwod6C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
