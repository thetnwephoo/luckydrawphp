-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2020 at 11:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aungpyae_lucky_draw`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_customer_count`
-- (See below for the actual view)
--
CREATE TABLE `all_customer_count` (
`customer_count` bigint(21)
,`customer_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_customer_prizes`
-- (See below for the actual view)
--
CREATE TABLE `all_customer_prizes` (
`prize_type` varchar(255)
,`lucky_number` int(11)
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ph_no` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `ph_no`, `profile_image`, `remark`, `pass`, `created_date`, `updated_date`) VALUES
(2, 'Myo Aung', 'myoaung@gmail.com', '09781727875', '1581496278-code.jfif', 'jjj', '12345678', NULL, NULL),
(13, 'Linn Linn Htun', 'linlintun1197@gmail.com', '+6593492091', '', '', '', NULL, NULL),
(17, 'Linn Htet', 'linn@gmail.com', '2345678', '', '', '', NULL, NULL),
(18, 'Mya Mya', 'mya@gmail.com', '23456786', '', '', '', NULL, NULL),
(19, 'user1', 'user1@gmail.com', '09876543213', '1581555829-code.jfif', 'hhhhh', '12345678', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_prizes`
--

CREATE TABLE `customer_prizes` (
  `id` int(11) NOT NULL,
  `prize_id` int(11) NOT NULL,
  `lucky_number_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_prizes`
--

INSERT INTO `customer_prizes` (`id`, `prize_id`, `lucky_number_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lucky_numbers`
--

CREATE TABLE `lucky_numbers` (
  `id` int(11) NOT NULL,
  `lucky_number` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lucky_numbers`
--

INSERT INTO `lucky_numbers` (`id`, `lucky_number`, `customer_id`) VALUES
(1, 12345, 2),
(2, 12341, 2),
(3, 56789, 2),
(4, 78543, 2),
(5, 34556, 17),
(6, 53535, 13),
(7, 22222, 13),
(8, 225353, 13);

-- --------------------------------------------------------

--
-- Table structure for table `prizes`
--

CREATE TABLE `prizes` (
  `id` int(11) NOT NULL,
  `prize_type` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prizes`
--

INSERT INTO `prizes` (`id`, `prize_type`, `created_date`, `updated_date`) VALUES
(1, 'Grand Prize', NULL, NULL),
(2, 'Second Prize - 1st Winner', NULL, NULL),
(3, 'Second Prize - 2nd Winner', NULL, NULL),
(4, 'Third Prize - 1st Winner', NULL, NULL),
(5, 'Third Prize - 2nd Winner', NULL, NULL),
(6, 'Third Prize - 3rd Winner', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ph_no` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `ph_no`, `profile_image`, `remark`, `pass`) VALUES
(1, 'test1', 'test1@gmail.com', '09876543213', '1581517695-code.jfif', 'Testing', '12345678'),
(2, 'test1', 'test1@gmail.com', '09876543213', '1581555744-css1.png', 'www', '12345678');

-- --------------------------------------------------------

--
-- Structure for view `all_customer_count`
--
DROP TABLE IF EXISTS `all_customer_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_customer_count`  AS  select count(`lucky_numbers`.`customer_id`) AS `customer_count`,`lucky_numbers`.`customer_id` AS `customer_id` from `lucky_numbers` group by `lucky_numbers`.`customer_id` ;

-- --------------------------------------------------------

--
-- Structure for view `all_customer_prizes`
--
DROP TABLE IF EXISTS `all_customer_prizes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_customer_prizes`  AS  (select `prizes`.`prize_type` AS `prize_type`,`lucky_numbers`.`lucky_number` AS `lucky_number`,`customers`.`name` AS `name` from (((`customer_prizes` join `prizes` on(`customer_prizes`.`prize_id` = `prizes`.`id`)) join `lucky_numbers` on(`lucky_numbers`.`id` = `customer_prizes`.`lucky_number_id`)) join `customers` on(`lucky_numbers`.`customer_id` = `customers`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_prizes`
--
ALTER TABLE `customer_prizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lucky_numbers`
--
ALTER TABLE `lucky_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prizes`
--
ALTER TABLE `prizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer_prizes`
--
ALTER TABLE `customer_prizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lucky_numbers`
--
ALTER TABLE `lucky_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prizes`
--
ALTER TABLE `prizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
