-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 10:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` text NOT NULL,
  `cat_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`, `cat_status`) VALUES
(1, 'Farm Inputs', 'Category for Farm Inputs', 'Available'),
(2, 'Farm Machinery', 'Category for Farm Machinery', 'Not Available'),
(3, 'Animal Feed ', 'Category for Animal Feed', 'Available'),
(4, 'Farm Labour', 'Category for Farm Labour', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `name` varchar(40) DEFAULT NULL,
  `id_number` varchar(30) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`name`, `id_number`, `location`, `phonenumber`) VALUES
('john banda', 'BSC-78-15', 'BLANTYRE', '0888029640'),
('Rabson Sayenda', 'BSC-78-15', 'Zomba', '0886788240');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_number` int(10) UNSIGNED NOT NULL,
  `advisor_name` varchar(255) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `location_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_number`, `advisor_name`, `phone_number`, `location_name`) VALUES
(1, 'Rabson Sayenda', '265886799210', 'BLANTYRE'),
(2, 'Kondwani Lusinje', '265886788210', 'ZOMBA'),
(3, 'Blessing Moyenda', '26588677210', 'MULUNJE'),
(4, 'Emmanuel Soko', '265886755210', 'THYOLO'),
(5, 'Luka James', '265886744210', 'PHALOMBE'),
(6, 'Praise Gome', '265886733210', 'CHIRADZULU'),
(7, 'Junior Sayenda', '265886722210', 'MWANZA'),
(8, 'Mwayi Njala', '265886766210', 'BALAKA'),
(9, 'Joseph Banda', '265886783210', 'MACHINGA'),
(10, '', '0', 'MANGOCHI'),
(11, '', '0', 'NTCHEU'),
(12, '', '0', 'LILONGWE'),
(13, '', '0', 'SALIMA'),
(14, '', '0', 'DOWA'),
(15, '', '0', 'DEDZA'),
(16, '', '0', 'MZIMBA'),
(17, '', '0', 'NKHATABAY'),
(18, '', '0', 'NKHOTAKOTA'),
(19, '', '0', 'MZIMBA'),
(20, '', '0', 'KARONGA'),
(21, '', '0', 'RUMPHI'),
(22, '', '0', 'NTCHISI'),
(23, '', '0', 'KASUNGU'),
(24, '', '0', 'LIKOMA'),
(25, '', '0', 'CHIKHWAWA'),
(26, '', '0', 'MZUZU');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `mark_name` varchar(255) NOT NULL,
  `mark_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`mark_id`, `mark_name`, `mark_location`) VALUES
(1, 'Zomba ADMARC Market', 'ZOMBA'),
(2, 'Lilongwe Auction Holdings Market', 'LILONGWE'),
(3, 'Kulima Gold', 'ZOMBA'),
(4, 'Auction Holdings', 'BLANTYRE'),
(5, 'ACE', 'LILONGWE'),
(6, 'ACE', 'BLANTYRE'),
(7, 'ADMARC', 'LILONGWE'),
(8, 'Auction Holdings', 'ZOMBA');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_number` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_number`, `product_name`, `product_price`) VALUES
(1, 'CAN Fertilizer', 20000),
(2, '26Plus1 Fertilizer', 20000),
(3, 'Kanyani', 1000),
(4, 'Rape', 500),
(5, 'Tomato', 400),
(6, 'Cabbage', 600),
(7, 'Chinese', 800),
(8, 'Growers Marsh', 10000),
(9, 'Start Marsh', 15000),
(10, 'Actellic', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(25) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_number` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_number`, `supplier_name`, `supplier_location`) VALUES
(1, 'Zomba ADMARC', 'Zomba'),
(2, 'Blantyre ADMARC', 'Blantyre'),
(3, 'Lilongwe ADMARC', 'Lilongwe'),
(4, 'Mzuzu ADMARC', 'Mzuzu'),
(6, 'AGORA', 'Lilongwe'),
(7, 'NASIFARM', 'Blantyre'),
(8, 'Lilongwe Auction Holdings', 'Lilongwe'),
(9, 'Kulima Gold', 'Zomba');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `id_number` char(9) NOT NULL,
  `birthday_date` date DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `phone_number` int(14) DEFAULT NULL,
  `next_of_kin` varchar(255) NOT NULL,
  `farm_activity` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `pin` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `id_number`, `birthday_date`, `location`, `sex`, `phone_number`, `next_of_kin`, `farm_activity`, `email`, `user_password`, `pin`) VALUES
(1, 'Rabson Sayenda', 'BSC/78/15', '1996-03-03', 'Zomba', 'M', 888799122, 'Blessings Sayenda', 'Tobacco Farming', 'NULL', 'NULL', 4490),
(2, 'Tionge Sala', 'BSC/77/17', '1990-04-04', 'Dowa', 'M', 888699124, 'Tasala Mandala', 'Tobacco Farming', 'NULL', 'NULL', 4477),
(3, 'Fredson Kumba', 'BSC/76/16', '1991-11-05', 'Lilongwe', 'M', 999899122, 'Likongwe Longwe', 'Tobacco Farming', 'NULL', 'NULL', 4433),
(4, 'Kondwani Lusinje', 'BSC/11/15', '1995-12-03', 'Blantyre', 'M', 888906122, 'Tedashii Munthali', 'Cattle Farming', 'NULL', 'NULL', 3390),
(5, 'Lisa Banda', 'BSC/12/20', '1996-03-03', 'Mulunje', 'F', 888899133, 'Chisomo Gondwe', 'Fish Farming', 'NULL', 'NULL', 1290),
(6, 'Moses Namate', 'BSC/20/20', '1990-11-20', 'Salima', 'M', 888099122, 'Allan Namate', 'Pond Farming', 'NULL', 'NULL', 6677),
(7, 'Sheila Luka', 'BSC/22/22', '1995-01-01', 'Mzuzu', 'F', 888899144, 'Chisomo Luka', 'Cattle Farming', 'NULL', 'NULL', 1280),
(8, 'Lucy Banda', 'BSC/28/20', '1996-03-03', 'Mzimba', 'F', 888899133, 'Jali Songani', 'Pond Farming', 'NULL', 'NULL', 1240),
(9, 'Beyonce Johnson', 'BSC/13/23', '1996-03-03', 'Ntcheu', 'F', 888899133, 'Limbani Gondwe', 'Maize Farming', 'NULL', 'NULL', 1230);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_number`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_number`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
