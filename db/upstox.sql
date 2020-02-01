-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2020 at 04:53 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upstox`
--

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_delivery`
--

CREATE TABLE `stock_delivery` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `stock_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_intraday`
--

CREATE TABLE `stock_intraday` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `stock_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `is_remember` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `transaction_status` int(10) NOT NULL,
  `order_complexity` int(10) NOT NULL,
  `intra_delivery` int(10) NOT NULL,
  `transaction_price_type` int(10) NOT NULL,
  `buy_sell` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `user_id`, `stock_name`, `quantity`, `transaction_status`, `order_complexity`, `intra_delivery`, `transaction_price_type`, `buy_sell`, `price`, `transaction_date`) VALUES
(1, 1, 'GOOG', 0, 0, 0, 1, 1, 0, 98, '2020-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `DOB`, `phone_number`) VALUES
(1, 'jatinsumai1104@gmail.com', '$2y$10$g3dYRrPlys1J1XXXimrGru2JJktruvfGGeK/yJtkKKeJZOSRILBJm', 'jatinsumai1104@gmail.com', '1999-04-11', '7058043260'),
(2, 'jatinsumai1104@gmail.com', '$2y$10$g3dYRrPlys1J1XXXimrGru2JJktruvfGGeK/yJtkKKeJZOSRILBJm', 'ghind20@gmail.com', '1999-04-12', '7021197094');

-- --------------------------------------------------------

--
-- Table structure for table `watch_list`
--

CREATE TABLE `watch_list` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `watch_list_name` varchar(255) NOT NULL,
  `deleted` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watch_list`
--

INSERT INTO `watch_list` (`id`, `user_id`, `watch_list_name`, `deleted`) VALUES
(1, 1, 'Testing', 0),
(2, 1, 'Jatin Sumai', 0);

-- --------------------------------------------------------

--
-- Table structure for table `watch_list_stock`
--

CREATE TABLE `watch_list_stock` (
  `id` int(10) NOT NULL,
  `watch_list_id` int(10) NOT NULL,
  `stock_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watch_list_stock`
--

INSERT INTO `watch_list_stock` (`id`, `watch_list_id`, `stock_name`) VALUES
(1, 1, 'GOOG'),
(2, 1, 'APPL'),
(3, 2, 'BOI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_delivery`
--
ALTER TABLE `stock_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_intraday`
--
ALTER TABLE `stock_intraday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watch_list`
--
ALTER TABLE `watch_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watch_list_stock`
--
ALTER TABLE `watch_list_stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_delivery`
--
ALTER TABLE `stock_delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_intraday`
--
ALTER TABLE `stock_intraday`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `watch_list`
--
ALTER TABLE `watch_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `watch_list_stock`
--
ALTER TABLE `watch_list_stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
