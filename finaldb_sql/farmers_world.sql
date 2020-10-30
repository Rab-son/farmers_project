-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 02:21 AM
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
(23, 'jnr7@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Admin', 0, 0, 0, 0, 0, 0, '2020-06-21 01:25:15', '2020-09-14 20:22:04'),
(24, 'rabsonsayendajnr2@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-06-21 04:29:56', '2020-09-14 20:21:45'),
(25, 'jnr10@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-06-22 05:44:29', '2020-06-22 05:46:04'),
(26, 'gausi@gmail.com', 'eb22eb329b87f55ebb4dcf97e5578081', 'Sub Admin', 1, 0, 0, 0, 0, 1, '2020-09-14 20:23:31', '2020-09-14 20:23:31'),
(27, 'taurai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Sub Admin', 1, 0, 0, 0, 0, 1, '2020-09-16 08:31:20', '2020-09-16 08:33:16'),
(28, 'pius@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 0, 0, 0, 0, 0, 1, '2020-09-17 01:53:08', '2020-09-17 01:55:03'),
(29, 'pius12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-09-17 01:56:27', '2020-09-17 01:56:56'),
(30, 'kondwanlusinje@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 1, '2020-09-23 21:52:47', '2020-09-23 21:54:43'),
(31, 'testing@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-09-29 22:12:08', '2020-09-29 22:12:58'),
(32, 'advisormarket@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Sub Admin', 0, 1, 0, 0, 1, 1, '2020-09-29 22:39:14', '2020-09-29 22:40:13'),
(33, 'test@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-10-01 18:06:20', '2020-10-01 18:06:49'),
(34, 'rabsonsayendajnrkk@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Sub Admin', 1, 1, 1, 1, 1, 0, '2020-10-02 16:11:28', '2020-10-02 16:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `id` int(10) UNSIGNED NOT NULL,
  `advisor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, 'Hopson Gausi', 'Home Science', '088879913277', 'Chitipa', 'Monday', '10', '12', '1', '2020-10-24 13:52:46', '2020-10-24 14:28:58'),
(10, 'Taurai Gombera', 'Home Science', '0888654734', 'Blantyre', 'Monday', '10', '12PM', '1', '2020-10-24 14:31:11', '2020-10-24 14:31:11'),
(11, 'Usher Ray', 'Home Science', '0888799123', 'Mzimba', 'Monday', '10', '12', '1', '2020-10-24 14:32:36', '2020-10-24 14:32:36'),
(13, 'Rabson Moyenda', 'Home Science', '0888799122', 'Zomba', 'Monday', '10', '12', '1', '2020-10-25 22:48:09', '2020-10-25 22:48:09');

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
  `next_of_kin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `farm_activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Not Assigned',
  `produce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Not Available',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `parent_id`, `full_name`, `id_number`, `birthday_date`, `location`, `sex`, `phonenumber`, `next_of_kin`, `farm_activity`, `produce`, `remember_token`, `created_at`, `updated_at`) VALUES
(90, 0, 'Rabson Moyenda', 'bsc/79/11', '1917-08-06', 'Zomba', '1', '+265888799122', 'Jones Moyenda', 'Crop Production', 'Not Available', NULL, '2020-09-29 16:38:57', '2020-10-01 22:40:45'),
(91, 0, 'Kondwani Lusinje', 'bsc/80/11', '1999-03-01', 'Blantyre', '1', '+265882897073', 'Llyod Giga', 'Animal Husbandry', 'Not Available', NULL, '2020-09-29 16:44:31', '2020-10-01 22:40:32'),
(92, 0, 'Charity Phiri', 'bsc/81/11', '1917-08-04', 'Mzuzu', '2', '+265888799124', 'Esther Phiri', 'Poultry Farming', 'Not Available', NULL, '2020-09-29 16:45:40', '2020-10-01 22:40:17'),
(93, 0, 'Mayamiko Mambo', 'esc/11/15', '1917-08-04', 'Karonga', '1', '+265888788122', 'Gilbert Sayenda', 'Crop Production', 'Not Available', NULL, '2020-09-29 16:46:43', '2020-10-01 22:40:03'),
(94, 0, 'Moses Munthali', 'esc/15/15', '1917-08-08', 'Mzimba', '1', '+265999799122', 'Gilbert Sayenda', 'Crop Production', 'Not Available', NULL, '2020-09-29 16:48:00', '2020-10-01 22:39:49'),
(95, 0, 'Emmanuel Mangulenje', 'esc/89/22', '1917-07-29', 'Zomba', '1', '+265999789122', 'Gift Soko', 'Crop Production', 'Not Available', NULL, '2020-09-29 16:50:44', '2020-10-01 22:39:39'),
(96, 0, 'Ezekiel Vitsitsi', 'esc/100/15', '1917-08-25', 'Lilongwe', '1', '+265888999122', 'Esther Phiri', 'Animal Husbandry', 'Not Available', NULL, '2020-09-29 16:53:18', '2020-10-01 22:39:28'),
(97, 0, 'Silvia Mambo', 'soc/87/123', '1917-08-07', 'Ntcheu', '2', '+265999788122', 'Mayamiko Mambo', 'Poultry Farming', 'Not Available', NULL, '2020-09-29 16:55:22', '2020-10-01 22:39:13'),
(98, 0, 'Margret Chituwa', 'esc/123/15', '1981-08-01', 'Salima', '2', '+265888169122', 'Esther Phiri', 'Crop Production', 'Not Available', NULL, '2020-09-29 16:59:46', '2020-10-01 22:38:57'),
(99, 0, 'Laston Nyasulu', 'bsd/20/120', '1999-03-01', 'Rumphi', '1', '+265999799102', 'Gift Soko', 'Crop Production', 'Not Available', NULL, '2020-09-29 17:02:24', '2020-10-01 22:38:43'),
(100, 0, 'Mwayi Massi', 'soc/87/124', '1999-03-01', 'Zomba', '1', '+265888710122', 'Omega Kamba', 'Poultry Farming', 'Not Available', NULL, '2020-09-29 17:03:45', '2020-10-01 22:38:29'),
(118, 0, 'Rabson Sayenda', 'uuutu5613', '1917-08-06', 'Lilongwe', '1', '+265888700122', 'Llyod Giga', 'crop production', 'Not Available', NULL, '2020-09-30 13:37:12', '2020-10-01 22:38:15'),
(119, 0, 'Rabson Sayenda', 'uuutu', '1917-08-01', 'Zomba', '1', '+265888799622', 'Gift Soko', 'crop production', 'Not Available', NULL, '2020-09-30 13:37:47', '2020-10-01 22:37:10'),
(193, 0, 'BBB', 'bbb', '0000-00-00', 'bbb', NULL, '+265889799210', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-02 14:17:05', '2020-10-02 14:17:05'),
(195, 0, 'MMM', 'nnn', '0000-00-00', 'nnn', NULL, '+265776788210', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-02 14:29:11', '2020-10-02 14:29:11'),
(196, 0, '2fjajjfa', 'Lilongwe123', '0000-00-00', 'Lilongwe', NULL, '09081100989', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-24 07:44:35', '2020-10-24 07:44:35'),
(198, 0, 'Kondwani Banda', 'bbbb', '0000-00-00', '', NULL, '+265887888221', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-27 07:39:28', '2020-10-27 07:39:28'),
(199, 0, 'Mulungu Dosi', 'hh', '0000-00-00', '', NULL, '+265998876210', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-27 07:42:13', '2020-10-27 07:42:13'),
(200, 0, 'NNN', 'JJJ', '0000-00-00', 'JJJ', NULL, '+265999805678', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-27 08:16:01', '2020-10-27 08:16:01'),
(202, 0, 'Islam Zomba', 'IIIII', '0000-00-00', 'Lilongwe', NULL, '+265888705888', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-10-29 11:45:00', '2020-10-29 11:45:00');

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
(10, '90', 'Ground Nuts', '10000', 'Quality Ground nuts in 50kgs', 10.00, 0, '2020-09-30 00:46:46', '2020-09-30 00:46:46');

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
(22, 0, 'Annes Investments', 'chitipa', '2020-09-29 17:55:38', '2020-09-29 17:55:38'),
(23, 0, 'Agrocomm Trade Limited', 'Lilongwe', '2020-09-29 17:56:30', '2020-09-29 17:56:30'),
(24, 0, 'Zomba Admarc', 'Zomba', '2020-09-29 18:18:32', '2020-09-29 18:18:32'),
(25, 0, 'Admarc Blantyre', 'Blantyre', '2020-09-29 18:19:57', '2020-09-29 18:19:57'),
(26, 0, 'Agora', 'Liwonde', '2020-09-29 18:20:16', '2020-09-29 18:20:16'),
(27, 0, 'Zomba Agora', 'Zomba', '2020-09-29 18:23:21', '2020-09-29 18:23:21'),
(28, 0, 'Direct Source World Wide', 'Nsanje', '2020-09-29 18:25:19', '2020-09-29 18:25:19'),
(29, 0, 'Mowe Agrodealers', 'Chiradzulu', '2020-09-29 18:26:06', '2020-09-29 18:26:06'),
(30, 0, 'Kago Agro & General Deaers', 'Rumphi', '2020-09-29 18:26:48', '2020-09-29 18:26:48'),
(31, 0, 'Pagwanji Enterprises', 'Mchinji', '2020-09-29 18:28:25', '2020-09-29 18:28:25'),
(32, 0, 'Mwadzaangati Agrodealer', 'Mulanje', '2020-09-29 18:29:00', '2020-09-29 18:29:15'),
(33, 0, 'Kangachepe Agrodealer', 'Zomba', '2020-09-29 18:29:50', '2020-09-29 18:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `market_products`
--

CREATE TABLE `market_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `market_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` double(8,2) NOT NULL DEFAULT 0.00,
  `buying_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(255) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_products`
--

INSERT INTO `market_products` (`id`, `market_id`, `mark_location`, `mark_name`, `product_name`, `selling_price`, `buying_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(23, '23 Agrocomm Trade Limited', 'chitipa', '23 Agrocomm Trade Limited', 'Chimanga', 101.00, '101', 'hfhaf', '101', 1, '2020-10-26 19:47:10', '2020-10-26 19:47:10'),
(24, '22 Annes Investments', 'chitipa', '22 Annes Investments', 'Maize Bags', 101.00, '101', 'jjj', '10', 1, '2020-10-26 19:48:55', '2020-10-26 19:48:55'),
(25, '33 Kangachepe Agrodealer', 'Zomba', '33 Kangachepe Agrodealer', 'Chimanga', 10.00, '10', 'jjj', '10', 1, '2020-10-26 19:51:12', '2020-10-26 19:51:12'),
(26, '25 Admarc Blantyre', 'Blantyre', '25 Admarc Blantyre', 'Maize Bags', 10.00, '10', 'fffff', '10', 1, '2020-10-26 19:55:54', '2020-10-26 19:55:54'),
(27, '26 Agora', 'Liwonde', '26 Agora', 'Chimanga', 101.00, '10', 'jjjj', '10', 1, '2020-10-26 21:22:29', '2020-10-26 21:22:29');

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
  `level` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `phonenumber`, `level`) VALUES
('ATUid_2c5eb65aa9b5bea39113e6239ad1fcef', '+265996799210', 1),
('ATUid_e8f1308f74a0dfdbc44c10fa4583ebde', '+265886799210', 4),
('ATUid_4c56859f47168b3d9c446758636fa664', '+265886799210', 0),
('ATUid_fd6a4d190def3ffe8ed6c2880b620f14', '+265886799210', 1),
('ATUid_5ed1fcfc656f043ecfbc4c41f05f05ad', '+265998977120', 4),
('ATUid_48b735390c99a8ea2721576869d2ca06', '+265886799210', 4),
('ATUid_218389ce317ea6c0f13b7e0574635c9a', '+265886799210', 2),
('ATUid_9aa83e1679963908def79ce355be4e03', '+265888799622', 23),
('ATUid_01c2010ff84a90a98f0f6ecfb926f88f', '+265888799622', 1),
('ATUid_86b78a383a641a9488ed2410812c08db', '+265888799633', 4),
('ATUid_bb96dbfa92218b0efe934a75184833e5', '+265888799633', 1),
('ATUid_db7ae0857871f322209e72fb98fba774', '+265888899122', 3),
('ATUid_238afba231a791051f8a66d8b521d217', '+265888788122', 1),
('ATUid_cbc55d38c73857689aef141403839055', '+265888905666', 0),
('ATUid_cd2052c7d514ae460ee1b88e31d6e296', '+265888905666', 30),
('ATUid_ef3ac67427a365f60464e5e2a2b09fef', '+265888905666', 1),
('ATUid_67cdc3d5e30caea5a44211ca1c2062aa', '+265999624221', 0),
('', '', 1),
('ATUid_7175ab7b58728bedae72e454e00322b9', '+265999624221', 3),
('ATUid_f2eb010233dee6cb27d7f5f1edd3b9b8', '+265999624221', 3),
('ATUid_d1d760244ef96284e4d8d21ae039f1a0', '+265999624221', 1),
('ATUid_dd62a95c87e651cf537fe96e25395a17', '+265999624221', 3),
('ATUid_6b67e5fa8ffbd178ddd9690a742c8a75', '+265888905666', 2),
('ATUid_642c8c972475fcbfa2f3c472490a53f9', '+265888905666', 1),
('ATUid_f98e2e9209767a051db40b8ae5381696', '+265888905666', 1),
('ATUid_84a1e96c466826e1f714b05b8e4fa729', '+265888799622', 2),
('ATUid_294bddab792153dfe37b0440513039dd', '+265888905666', 2),
('ATUid_f08f716b1596b2d1b177f21fc5f1cc46', '+265888905666', 0),
('ATUid_4ff7bf0169d68c7d144c9413d5bf8296', '+265888905666', 1),
('ATUid_3968f863b8a67a5057ed688432248ba7', '+265881404368', 4),
('ATUid_590ac820337c1b6ac7d6e1c3ca8ae197', '+265881404368', 8),
('ATUid_a1373450cd24059b7898c40a3006a9ce', '+265881404368', 15),
('ATUid_de8a27133ef4a28124a657b9a0eb3f2c', '+265889799210', 0),
('ATUid_ab7e3bfe3ae9e573ffbaafa57fe3b04b', '+265889799210', 30),
('ATUid_4bdb9bac3efe4f05a239b438ddf5dcec', '+265887622910', 1),
('ATUid_1e510dc59c7ee59a5cbb1d3f5ccce387', '+265776788210', 0),
('ATUid_918bc747e7a2f0d0fd702ea0199695c9', '+265776788210', 17),
('1', '09081100989', 0),
('2', '09081100989', 9),
('3', '09081100989', 16),
('ATUid_c36f1a68b5b0b3c77ee79e0c557f17ea', '+265887877210', 0),
('ATUid_3cf70b87bd24841384eb88f033281e34', '+265887877210', 23),
('ATUid_c199175822cf46c60b64581377bbc0b8', '+265887877210', 2),
('ATUid_7a6f8d1e3ab7283139c8a243e4b461d4', '+265887877210', 16),
('ATUid_9a06ba0f7cbc773d6edc705462c2cdba', '+265887877210', 15),
('ATUid_ad03d37d2c33a3feb138447dc8c4fc33', '+265887877210', 2),
('ATUid_dd53fb4fd3017808e316519a77cebfd0', '+265887877210', 23),
('ATUid_829153fe1613b555f656b82edbe5f331', '+265887877210', 23),
('ATUid_ec511d03f5257c349c2843ecd9084e36', '+265887888221', 0),
('ATUid_e752d64bab65b14c5d75587ca0404d9b', '+265887888221', 30),
('ATUid_88754ec588ec2085ed6b9808872c2987', '+265887888221', 3),
('ATUid_69d687c3ceae0c8ee5561fe4ef48bbd6', '+265887888221', 30),
('ATUid_f44076c5b5a5f703e829a660fe6c0e2a', '+265887888221', 2),
('ATUid_f680630ccec29592d61b7de2f744428f', '+265998876210', 0),
('ATUid_9ed74fc2379229c9ed8fc0f49388d6ba', '+265998876210', 8),
('ATUid_d6976b40b0c9f5e0d1005e1961b0670d', '+265998876210', 1),
('ATUid_7d4153f893adc032c31dee01ea400491', '+265998876210', 16),
('ATUid_ea6f32e4e0bbab74775e6b9386162eeb', '+265998876210', 1),
('ATUid_2b28b18e1b7eee6f7ea2776e20239a7f', '+265998876210', 16),
('ATUid_d981a94382e117bea8bc8540d849b84e', '+265998876210', 16),
('ATUid_558acc91f153b347c6a781bb0e38d53b', '+265998876210', 2),
('ATUid_1be137f29a3becf9bc5bfd22b7ad49a1', '+265998876210', 12),
('ATUid_f1afdd636f1ba17664a058bbd4b8580e', '+265998876210', 12),
('ATUid_8868d443e0bf720af607268f7b408129', '+265998876210', 1),
('ATUid_5e9aa54af8a57bb494d2ec4f17ac352c', '+265998876210', 1),
('ATUid_b3d5293fd86684e0b3b2210bf54f4cb0', '+265998876210', 1),
('ATUid_fc8973c426d3e157983abb7fecb99686', '+265998876210', 25),
('ATUid_117d8197568822c0db74a7a4a841e0ce', '+265998876210', 2),
('ATUid_cb46fc115767a5c29ba7fe2de5776eb2', '+265998876210', 14),
('ATUid_83bbafd4b6918365e33392f690a0eaa0', '+265998876210', 10),
('ATUid_83f89c0819706d96ab491718d309c746', '+265998876210', 23),
('ATUid_07adf9c925d3a6aabfd74fdbb5ce185c', '+265998876210', 13),
('ATUid_068e8a3f9174134b3e23656772b56889', '+265998876210', 16),
('ATUid_c32c7f4f4117f1887b8b0ad9fcc64e49', '+265998876210', 16),
('ATUid_f90e03f938e8bcb4c01c95b717a9f08f', '+265998876210', 15),
('4', '09081100989', 16),
('10', '09081100989', 5),
('9', '09081100989', 16),
('ATUid_d5ad5522b1b4dbfa34231d86987a851e', '+265999805678', 1),
('ATUid_7fb2df344aeb9c7057609d422a3dfe72', '+265999805678', 0),
('ATUid_091058877004f92696f2948f210372a0', '+265999805678', 16),
('ATUid_f5620a0f4bbd6ddf042ee68a8734f8e7', '+265999805678', 5),
('ATUid_4dc2d2ca908317d6401996014d234f26', '+265888705888', 0),
('ATUid_bbc97eeee9d8a584711c1186f14a2d49', '+265888705888', 2),
('ATUid_7a68bfdf7c70e1a296e78203290c9eb5', '+265888705888', 2),
('ATUid_cfa1a324b0b72a60f14c634bd2909826', '+265888705888', 6),
('ATUid_dfa113667dc808ad62e013d6b34d9fc8', '+265888705888', 8),
('ATUid_fe067e627c47f84c8dffd86dae57b762', '+265888705888', 17),
('ATUid_d7a1959d07c56a2d61689f86cf64390b', '+265888705888', 2),
('ATUid_181529b6351715109c81c975f8237310', '+265888705888', 6),
('ATUid_c04716e4520fb43533dac861c19f6c35', '+265888705888', 8),
('ATUid_c05222d7acbcd6525bef583c5c2fb855', '+265888705888', 1),
('ATUid_c5ce9babfda3fe94153b2ccebaffea0e', '+265888705888', 7),
('ATUid_c305ebe0b6158aaaf7fff0f744915ea5', '+265888705888', 8),
('ATUid_35dabfac171d21d16b66868eb8362b9a', '+265888705888', 1),
('ATUid_9f05f9e78149976f3761dcd7bcaea94b', '+265888705888', 7),
('ATUid_b38aaa22b5b09fbf685e430c3c36c03a', '+265888705888', 8),
('ATUid_7b4d6919d3a5d0b8728dba34a9752bb0', '+265888705888', 15),
('ATUid_9fb03b79e81aeecd263eee343fb5e4e4', '+265888705888', 7),
('ATUid_708fca3d5edabdad2e160e2c018efc40', '+265888705888', 5),
('11', '09081100989', 5),
('12', '09081100989', 68),
('13', '09081100989', 68),
('14', '09081100989', 68),
('16', '09081100989', 68),
('17', '09081100989', 68),
('18', '09081100989', 69),
('19', '09081100989', 16),
('20', '09081100989', 16);

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
(20, 'Annes Investments', 0, 'chitipa', '0886788210', '8AM-4PM', 'Monday-Sunday', '2020-09-29 17:08:10', '2020-09-29 17:08:10'),
(21, 'JM & ES Agrodealers', 0, 'Mchinji', '0886788210', '9AM-4PM', 'Monday-Friday', '2020-09-29 17:11:08', '2020-09-29 17:11:08'),
(22, 'Time Agrodaelers', 0, 'Machinga', '0885783822', '9AM-5PM', 'Monday-Saturday', '2020-09-29 17:12:05', '2020-09-29 17:12:05'),
(23, 'Bika Agro-dealer', 0, 'Salima', '0886788212', '0888764712', 'Monday-Friday', '2020-09-29 17:15:26', '2020-09-29 17:15:26'),
(24, 'Bika Agro-dealer', 0, 'Nkhotakota', '0996788210', '8AM-4PM', 'Monday-Sunday', '2020-09-29 17:17:32', '2020-09-29 17:17:32'),
(25, 'Pateda Investment', 0, 'Nsanje', '0886788210', '9AM-5PM', 'Monday-Saturday', '2020-09-29 17:19:28', '2020-09-29 17:19:28'),
(26, 'Walusiya Investments', 0, 'Blantyre', '0999788210', '9AM-6PM', 'Monday-Friday', '2020-09-29 17:20:22', '2020-09-29 17:20:22'),
(27, 'Uliso', 0, 'Rumphi', '0886777210', '9AM-5PM', 'Monday-Friday', '2020-09-29 17:23:19', '2020-09-29 17:23:19'),
(28, 'GBM Investments', 0, 'Lilongwe', '0886788212', '9AM-6PM', 'Monday-Saturday', '2020-09-29 17:24:40', '2020-09-29 17:24:40'),
(29, 'AGRI-ECO INVESTMENTS', 0, 'Mzimba', '0886788222', '7AM-5PM', 'Monday-Sunday', '2020-09-29 17:28:35', '2020-09-29 17:28:35'),
(30, 'Alimi Trading', 0, 'Thyolo', '0889988210', '9AM-5PM', 'Monday-Saturday', '2020-09-29 17:29:48', '2020-09-29 17:29:48'),
(31, 'A.S.K Enterprise', 0, 'Ntcheu', '0996722210', '9AM-4PM', 'Monday-Saturday', '2020-09-29 17:31:34', '2020-09-29 17:31:34'),
(32, 'Masambuka\'s General Supply', 0, 'Ntcheu', '0886788212', '9AM-5PM', 'Monday-Friday', '2020-09-29 17:32:27', '2020-09-29 17:32:27'),
(33, 'Glorious Agro Dealers', 0, 'Zomba', '0886788213', '9AM-5PM', 'Monday-Saturday', '2020-09-29 17:34:23', '2020-09-29 17:34:23'),
(34, 'Mowe Agrodealers', 0, 'Zomba', '0886788210', '9AM-5PM', 'Monday-Saturday', '2020-09-29 17:35:31', '2020-09-29 17:35:31'),
(35, 'One Acre', 0, 'Zomba', '0886788210', '9AM-5PM', 'Monday-Saturday', '2020-09-29 18:27:30', '2020-09-29 18:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
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

INSERT INTO `supplier_products` (`id`, `supplier_id`, `supplier_location`, `supplier_name`, `product_name`, `selling_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(13, '20 Annes Investments', 'Lilongwe', '20 Annes Investments', 'fbbfa', '10', 'fnnfaf', 0.00, 1, '2020-10-26 23:06:18', '2020-10-26 23:06:18');

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
(21, 92, 'John Banda', 'Chonde bwerani ku likulu lanthu mudzikumane ndi alangizi', NULL, NULL, NULL, '2020-09-29 19:42:49', '2020-09-29 19:42:49'),
(22, 91, 'George Kondoni', 'Mukuyenera kudzatenga ndalama zanu zomwe anasiya a Zomba Admarc', NULL, NULL, NULL, '2020-09-29 19:44:57', '2020-09-29 19:44:57'),
(23, 95, 'Kondwani Lusinje', 'Mulime matumba 17 a chimanga&nbsp;', NULL, NULL, NULL, '2020-09-29 19:46:23', '2020-09-29 19:46:23'),
(24, 98, 'Rabson Sayenda', 'Talandira madandaulo ano, chonde tidikira tikuyimbira tikapeza yankho', NULL, NULL, NULL, '2020-09-29 19:47:21', '2020-09-29 19:47:21'),
(25, 100, 'Hestings Kamba', 'A Zomba Admarc akufuna matumba 17 omwe munagwirizana', NULL, NULL, NULL, '2020-09-29 19:49:21', '2020-09-29 19:49:21'),
(26, 98, 'Luka Phiri', 'Mukuyenera kugula matumba 18 a fertilizer', NULL, NULL, NULL, '2020-09-29 19:50:32', '2020-09-29 19:50:32'),
(27, 99, 'George Kondoni', 'Pempho lanu talimva chonde bwereani kuma offices anthu kuno ku Lilongwe', NULL, NULL, NULL, '2020-09-29 19:52:11', '2020-09-29 19:52:11'),
(28, 99, 'George Kondoni', 'Alangizi akuyimbirani pompano&nbsp;', NULL, NULL, NULL, '2020-09-29 19:54:56', '2020-09-29 19:54:56'),
(29, 100, 'Kondwani Lusinje', 'Agora akutumizirani fertilizer lachitatu', NULL, NULL, NULL, '2020-09-29 19:57:27', '2020-09-29 19:57:27'),
(30, 100, 'Rabson Sayenda', 'Fertilizer watha wina afika week ya mmawa', NULL, NULL, NULL, '2020-09-29 19:58:52', '2020-09-29 19:58:52'),
(31, 97, 'Maggie Machinga', 'Mitsika ya nyemba yapedzeka chonde wonani pa dera lanu', NULL, NULL, NULL, '2020-09-29 20:00:41', '2020-09-29 20:00:41'),
(32, 100, 'Rabson Sayenda', 'Junior we securities&nbsp;', NULL, NULL, NULL, '2020-09-29 22:09:59', '2020-09-29 22:09:59'),
(33, 90, 'Gender Must', 'Tiwonane masana', NULL, NULL, NULL, '2020-09-29 22:33:59', '2020-09-29 22:33:59');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `advisors`
--
ALTER TABLE `advisors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `farmer_products`
--
ALTER TABLE `farmer_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `market_products`
--
ALTER TABLE `market_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
