-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2020 at 06:59 AM
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
-- Database: `farmers_world`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Admin','Sub Admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admin',
  `farmers_access` tinyint(4) NOT NULL DEFAULT 0,
  `advisors_access` tinyint(4) NOT NULL DEFAULT 0,
  `suppliers_access` tinyint(4) NOT NULL DEFAULT 0,
  `ussd_notifications_access` tinyint(4) NOT NULL DEFAULT 0,
  `markets_access` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `type`, `farmers_access`, `advisors_access`, `suppliers_access`, `ussd_notifications_access`, `markets_access`, `status`, `created_at`, `updated_at`) VALUES
(7, 'rabsonsayendajnr@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-14 22:30:38', '2020-06-22 01:29:26'),
(8, 'sayenda@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-14 22:33:15', '2020-06-14 22:33:15'),
(9, 'junior@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 1, 0, 0, 0, 0, 1, '2020-06-15 03:10:22', '2020-06-15 03:10:22'),
(13, 'ettw', '6cee4618fc4960d184eb7efbd0aa27b5', 'Admin', 0, 0, 0, 0, 0, 0, '2020-06-15 03:55:18', '2020-06-15 03:55:18'),
(16, 'farmer@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-15 19:21:02', '2020-06-15 19:21:02'),
(17, 'jnr@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 0, 0, 1, 1, 0, 1, '2020-06-15 20:58:58', '2020-06-15 20:58:58'),
(18, 'jnr1@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 0, '2020-06-20 08:25:59', '2020-06-20 08:25:59'),
(19, 'jnr2@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-20 08:27:41', '2020-06-21 09:30:44'),
(20, 'bule@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-20 08:51:13', '2020-06-20 08:51:54'),
(23, 'jnr7@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-21 01:25:15', '2020-06-21 01:26:20'),
(24, 'rabsonsayendajnr2@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Sub Admin', 1, 0, 0, 0, 1, 0, '2020-06-21 04:29:56', '2020-06-21 07:55:12'),
(25, 'jnr10@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-06-22 05:44:29', '2020-06-22 05:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `id` int(10) UNSIGNED NOT NULL,
  `advisor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` int(11) NOT NULL,
  `advisor_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`id`, `advisor_name`, `specialty`, `phone_number`, `advisor_location`, `days`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Rabson', 'Insects', 888788210, 'Machinjiri', 'Monday - Friday', '7:30AM', '4:30PM', 'Available 1', '2020-05-19 23:37:51', '2020-05-19 23:56:34'),
(3, 'Rabson Sayenda', 'Pestcides', 886788220, 'Machinjiri', 'monday - friday', '7:00AM', '4:00PM', 'Available', '2020-05-22 09:53:44', '2020-06-13 03:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'rabson sayenda', 'rabson@gmail.com', 'adminstration query', 'testing is going on', '2019-03-31 05:58:14', '2019-03-31 00:28:14'),
(2, 'junior sayenda', 'junior@yopmail.com', 'Intro', 'I want some intro', '2019-03-31 05:58:51', '2019-03-31 00:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday_date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_of_kin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `produce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `parent_id`, `full_name`, `id_number`, `birthday_date`, `location`, `sex`, `phonenumber`, `next_of_kin`, `farm_activity`, `produce`, `remember_token`, `created_at`, `updated_at`) VALUES
(34, 0, 'hunior', 'bsc-93-18', '1997-03-03', 'Zomba', 'Male', '886788215', 'Tiwonge Limba', 'tapystylishstore', '', NULL, '2020-06-08 21:54:17', '2020-06-08 21:54:17'),
(35, 0, 'junior', 'bsoc-80-18', '1997-03-03', 'Blantryre', 'Male', '880788210', 'Tiwonge Limba', 'tapystylishstore', '', NULL, '2020-06-08 21:55:28', '2020-06-08 21:55:28'),
(50, 0, 'rabson', 'bsc-90-16', '1997-03-03', 'Blantryre', 'Male', '0886788210', 'Tiwonge Limba', 'tapystylishstore', '', NULL, '2020-06-11 07:06:29', '2020-06-11 07:06:29'),
(51, 0, 'rooming', 'bsc-90-13', '1997-03-03', 'Blantryre', 'Male', '0886788250', 'Tiwonge Limba', 'tapystylishstore', '', NULL, '2020-06-11 21:46:06', '2020-06-11 21:46:06'),
(55, 0, 'sayenda', 'bsc-90-15u7', '1917-08-01', 'Blantryre', 'Male', '088678827610', 'Tiwonge Limba', 'tapystylishstore', '', NULL, '2020-06-21 20:53:44', '2020-06-21 20:53:44'),
(56, 0, 'yenda', 'ndnnfn', '1917-08-06', 'Blantryre', 'Female', '0886788229', 'Junior Limba', 'tapystylishstore', '', NULL, '2020-06-21 21:47:07', '2020-06-21 21:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_products`
--

CREATE TABLE `farmer_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `farmer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produce_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `status` tinyint(255) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmer_products`
--

INSERT INTO `farmer_products` (`id`, `farmer_id`, `produce_name`, `selling_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, '51', 'Chimanga', '202', 'jdsh', 210.00, 0, '2020-06-27 23:28:43', '2020-06-27 23:28:43'),
(2, '50', 'Chimanga', '202', 'jdsh', 210.00, 0, '2020-06-27 23:32:03', '2020-06-27 23:32:03'),
(3, '56', 'Chimanga 20', '202', 'fjjafj', 2920.00, 0, '2020-06-27 23:36:08', '2020-06-27 23:36:08'),
(4, '34', 'Chimanga 202', '202', 'fjjafj', 2920.00, 0, '2020-06-27 23:37:28', '2020-06-27 23:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `market_parent_id` int(11) NOT NULL DEFAULT 0,
  `mark_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`mark_id`, `market_parent_id`, `mark_name`, `mark_location`, `created_at`, `updated_at`) VALUES
(18, 0, 'Limbe Market', 'Lilongwe', '2020-06-27 04:20:26', '2020-06-27 04:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `market_products`
--

CREATE TABLE `market_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `market_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `buying_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `status` tinyint(255) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_products`
--

INSERT INTO `market_products` (`id`, `market_id`, `product_name`, `selling_price`, `buying_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(3, '18', 'Tobacco', '200', '300', 'jdjfa', 40.00, 0, '2020-06-27 21:12:39', '2020-06-27 21:12:39'),
(4, '18', 'Crops', '500', '300', 'Junior 2', 321.00, 0, '2020-06-27 21:29:18', '2020-06-27 21:29:18'),
(5, '18', 'Cotton Bags', '5000', '1234', 'jfjs', 405.00, 1, '2020-06-27 21:32:04', '2020-06-27 21:32:04'),
(6, '18', 'Tobacco', '238', '123', 'Junior', 2920.00, 0, '2020-06-27 21:32:43', '2020-06-27 21:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_01_081517_create_users_phone_number_table', 2),
(4, '2020_04_01_140602_create_orders_table', 3),
(5, '2020_05_18_022904_create_farmers_table', 4),
(6, '2020_05_19_011701_create_markets_table', 5),
(7, '2020_05_19_023800_create_suppliers_table', 6),
(8, '2020_05_20_011834_create_advisors_table', 7),
(9, '2020_05_20_015515_create_advisors_table', 8),
(10, '2020_05_20_025459_create_advisors_table', 9),
(11, '2020_05_31_120422_create_ussd_notifications_table', 10),
(12, '2020_05_31_123441_create_ussd_notifications_table', 11),
(13, '2020_05_31_162037_create_ussd_notifications_table', 12),
(14, '2020_05_31_164846_create_notifications_table', 13),
(15, '2020_05_31_165113_create_ussd_notifications_table', 14),
(16, '2020_06_11_104220_create_admins_table', 15),
(17, '2020_06_12_013459_create_notifications_table', 16),
(18, '2020_06_13_103737_create_kondwani_table', 17),
(19, '2020_06_13_103936_create_kondwani_table', 18),
(20, '2020_06_13_104637_create_kondwani_table', 19),
(21, '2020_06_22_001510_create_notifications_table', 19),
(22, '2020_06_22_034918_create_enquiries_table', 20),
(23, '2020_06_22_223620_create_products_table', 21),
(24, '2020_06_22_230614_create_products_attributes_table', 22),
(25, '2020_06_27_235422_create_market_products_table', 23),
(26, '2020_06_27_235539_create_farmer_products_table', 23),
(27, '2020_06_28_000416_create_farmer_products_table', 24),
(28, '2020_06_28_001214_create_market_products_table', 25),
(29, '2020_06_28_034027_create_supplier_products_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `current_location`, `last_location`, `status`, `created_at`, `updated_at`) VALUES
(1, 'qBLJ6DZLx6', '992 Murray Park', '808 Kessler Valleys', 'approved', NULL, NULL),
(2, 'wSc18dVHNq', '9141 Glen Harbor', '7621 Strosin Crescent Apt. 593', 'delivered', NULL, NULL),
(3, 'J2yAmB0AA6', '44950 Nienow Estates Apt. 617', '3891 Reilly Divide Suite 725', 'in transit', NULL, NULL),
(4, 'rwrQZ7tUqT', '67763 Royal Inlet Apt. 080', '92092 Eichmann Harbor', 'awaiting approval', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(16) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `phonenumber`, `level`) VALUES
('8', '0996788223', 4),
('9', '0996788923', 14),
('11', '0996788953', 1),
('12', '0996788953', 1),
('14', '0996788953', 1),
('15', '0996788953', 0),
('16', '0996788953', 1),
('17', '0996700953', 0),
('18', '0996700958', 0),
('19', '0996700958', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_parent_id` int(11) NOT NULL DEFAULT 0,
  `supplier_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_phonenumber` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_parent_id`, `supplier_location`, `supplier_phonenumber`, `working_hour`, `working_day`, `created_at`, `updated_at`) VALUES
(17, 'Chombe Tea', 0, 'Mulanje', '0886788210', '10-12AM', 'Monday-Saturday', '2020-06-27 02:51:53', '2020-06-27 02:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(255) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(255) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_products`
--

INSERT INTO `supplier_products` (`id`, `supplier_id`, `product_name`, `selling_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 17, 'Tobacco34', '500', 'hhdfah', 0.00, 0, '2020-06-28 00:44:16', '2020-06-28 00:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'rabsonsayendajnr@gmail.com', '$2y$10$Agqoi3afwIJpVxuJtFRf7uC5jpzGscwhxNizZOdnEjm.GfUxCuHGi', 1, 'zFhb6jUHAZdWZB8NBUUQ9WVvkcmbDLWJWETLnOtgEpJB8aLnmKbe1zLEit2l', '2020-03-16 22:18:30', '2020-03-17 13:24:01'),
(2, 'Rabson Sayenda', 'rabsonsayenda@gmail.com', '$2y$10$3biDALrTtAy86C5dlONdcOXFFGddfjAT9u6NVwjnf4nZsnIptwdOG', NULL, 'nupyqGCVAIbBAdLOsjGEgmEKWyCkJ2mfCMiJuQZporMsj38yrbMzNxYmM4FR', '2020-03-16 22:21:23', '2020-03-16 22:21:23'),
(3, 'Kondwani Lusinje', 'kondwanlusinje@gmail.com', '$2y$10$2tAX9UhoaAUabItRTSSSk.Ik2z1Tolt2HLQd/PtVTNRJXHy8Fo9Mi', 2, '0DYgh12UEYGfXjO9H34f2afE3vGbPWE36fclt9sNt9NRKbvj6xnnSJaA3jKM', '2020-03-17 06:40:04', '2020-03-17 06:40:04'),
(7, 'nndnnfdnad', 'juniroafkladf@gmail.com', '123949', 3, NULL, '2020-06-21 20:00:00', '2020-06-21 20:00:00'),
(9, 'nndnnfdnad', 'junir@gmail.com', '123949', 3, NULL, '2020-06-21 20:00:00', '2020-06-21 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_phone_number`
--

CREATE TABLE `users_phone_number` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_phone_number`
--

INSERT INTO `users_phone_number` (`id`, `phone_number`, `created_at`, `updated_at`) VALUES
(14, '265888788210', '2020-06-11 21:08:51', '2020-06-11 21:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `ussd_notifications`
--

CREATE TABLE `ussd_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ussd_notifications`
--

INSERT INTO `ussd_notifications` (`id`, `farmer_id`, `sender_name`, `sent_message`, `received_message`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(15, 35, 'jfjfj', 'jjfjf', NULL, NULL, NULL, '2020-06-23 21:05:24', '2020-06-23 21:05:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `advisors`
--
ALTER TABLE `advisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `farmers_id_number_unique` (`id_number`),
  ADD UNIQUE KEY `farmers_phonenumber_unique` (`phonenumber`);

--
-- Indexes for table `farmer_products`
--
ALTER TABLE `farmer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `market_products`
--
ALTER TABLE `market_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_phone_number`
--
ALTER TABLE `users_phone_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ussd_notifications`
--
ALTER TABLE `ussd_notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `advisors`
--
ALTER TABLE `advisors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `farmer_products`
--
ALTER TABLE `farmer_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `market_products`
--
ALTER TABLE `market_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_phone_number`
--
ALTER TABLE `users_phone_number`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ussd_notifications`
--
ALTER TABLE `ussd_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
