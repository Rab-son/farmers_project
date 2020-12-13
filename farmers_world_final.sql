-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 08:13 AM
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
(7, 'rabsonsayendajnr@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Admin', 0, 0, 0, 0, 0, 1, '2020-06-14 22:30:38', '2020-12-13 12:07:46'),
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
(33, 'test@gmail.com', '7717dca1543a25f26c3c40d28865d638', 'Sub Admin', 1, 0, 0, 0, 1, 1, '2020-10-01 18:06:20', '2020-10-01 18:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `id` int(10) UNSIGNED NOT NULL,
  `advisor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advisor_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `advisor_epa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advisor_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `advisors` (`id`, `advisor_name`, `specialty`, `phone_number`, `advisor_location`, `advisor_epa`, `advisor_district`, `days`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(16, 'Taurai Gombera', 'Soil Science', '0888799122', 'Not Assigned', 'Mbewe', '6', 'Monday', '10', '12', '1', '2020-11-16 01:51:00', '2020-11-16 01:51:00'),
(17, 'Taurai Gombera', 'Home Science', '0888799122', 'Not Assigned', 'Kunthembwe', '2', 'Monday', '10', '12', '1', '2020-11-16 02:02:12', '2020-11-16 02:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `epa_id` int(10) UNSIGNED NOT NULL,
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `districtname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`epa_id`, `id`, `region`, `districtname`, `created_at`, `updated_at`) VALUES
(1, '1', 'Southern Region', 'Zomba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '2', 'Southern Region', 'Blantyre', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '3', 'Central Region', 'Lilongwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '4', 'Northern Region', 'Mzimba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '5', 'Southern Region', 'Balaka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '6', 'Southern Region', 'Chikwawa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '7', 'Southern Region', 'Chiradzulu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '8', 'Northern Region', 'Chitipa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '9', 'Central Region', 'Dedza', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '10', 'Central Region', 'Dowa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '11', 'Northern Region', 'Karonga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '12', 'Central Region', 'Kasungu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '13', 'Southern Region', 'Neno', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '14', 'Southern Region', 'Machinga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '15', 'Southern Region', 'Mangochi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '16', 'Central Region', 'Mchinji', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '17', 'Southern Region', 'Mulanje', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '18', 'Southern Region', 'Mwanza', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '19', 'Northern Region', 'NkhataBay', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '20', 'Central Region', 'Nkhotakota', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '21', 'Southern Region', 'Nsanje', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '22', 'Central Region', 'Ntchisi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '23', 'Southern Region', 'Phalombe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '24', 'Northern Region', 'Rumphi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, '25', 'Central Region', 'Salima', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, '27', 'Southern Region', 'Thyolo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, '28', 'Central Region', 'Ntcheu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, '29', 'Central Region', 'Likoma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, '0', 'Not Available', 'Not Available', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
-- Table structure for table `epas`
--

CREATE TABLE `epas` (
  `ep_id` int(10) UNSIGNED NOT NULL,
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `epaname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epas`
--

INSERT INTO `epas` (`ep_id`, `id`, `epaname`, `created_at`, `updated_at`) VALUES
(1, '1', 'Chingale', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '1', 'Thondwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '1', 'Malosa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '1', 'Nsondole', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '1', 'Mpokwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '1', 'Ngwelero', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '1', 'Dzaona', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '2', 'Lilangwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '2', 'Chipanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '2', 'Kunthembwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '2', 'Ntonda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '3', 'Lilangwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '3', 'Chipanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '3', 'Chiwamba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '3', 'Chitekwere', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '3', 'Nyanja', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '3', 'Mpenu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '3', 'Chitsime', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '3', 'Mkwinda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '3', 'Mitundu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '3', 'Mlomba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '3', 'Thawale', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '3', 'Malingunde\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, '3', 'Ming\'ongo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, '3', 'Mpingu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, '4', 'Zombwe\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, '4', 'Emfeni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, '4', 'Khosolo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, '4', 'Luwelezi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, '4', 'Champhira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, '4', 'Vibangalala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, '4', 'Mbawa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, '4', 'Kazomba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, '4', 'Manyamula\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, '4', 'Mjinge', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, '4', 'Bulala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, '4', 'Eswazini', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, '4', 'Mbalachanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, '4', 'Euthini', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, '4', 'Njuyu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, '4', 'Emsizini', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, '4', 'Zombwe\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, '4', 'Malidade', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, '4', 'Mpherembe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, '4', 'Bwengu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, '5', 'Phalula ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, '5', 'Utale ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, '5', 'Mpilis', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, '5', 'Rivirivi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, '5', 'Bazale ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, '5', 'Ulongwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, '6', 'Kalambo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, '6', 'Mitole ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, '6', 'Mbewe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, '6', 'Livunzu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, '6', 'Mikalango', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, '6', 'Dolo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, '7', 'Thumbwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, '7', 'Mombezi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, '7', 'Mbulumbuzi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, '8', 'Kameme', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, '8', 'Mwamkumbwa\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, '8', 'Misuku', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, '8', 'Lufita', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, '8', 'Chisenga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, '8', 'Kavukuku', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, '8', 'Nyika National Park', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, '9', 'Golomoti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, '9', 'Mtakataka ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, '9', 'Bembeke', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, '9', 'Kanyama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, '9', 'Mayani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, '9', 'Kaphuka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, '9', 'Linthipe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, '9', 'Lobi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, '9', 'Kabwazi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, '9', 'Chafumbwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, '9', 'Dzalanyama\r\nRanch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, '10', 'Mvera', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, '10', 'Chibvala\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, '10', 'Nachisaka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, '10', 'Nalunga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, '10', 'Mponela', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, '10', 'Mndolera\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, '10', 'Chisepo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, '10', 'Madisi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, '10', 'Bowe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, '11', 'North Kaporo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, '11', 'South Kaporo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, '11', 'Mpata', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, '11', 'Lupembe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, '11', 'Nyungwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, '11', 'Vinthukutu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, '11', 'Nyika National Park', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, '12', 'Santhe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, '12', 'Lisasadzi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, '12', 'Kasungu/ Chipala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, '12', 'Chamamae', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, '12', 'Kaluluma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, '12', 'Chulu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, '12', 'Kasungu National Park', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, '13', 'Neno', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, '13', 'Lisungwi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, '14', 'Nsanama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, '14', 'Mbonechera', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, '14', 'Nanyumbu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, '14', 'Nyambi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, '14', 'Chikweo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, '14', 'Nampeya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, '14', 'Mtubwi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, '15', 'Chilipa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, '15', 'Mthilimanja', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, '15', 'Mbwadzulu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, '15', 'Nansenga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, '15', 'Maiwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, '15', 'Masuku', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, '15', 'Mtiya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, '15', 'Katuli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, '15', 'Lungwena', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, '15', 'Mpilipili', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, '15', 'Nankumba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, '16', 'Msitu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, '16', 'Mlonyeni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, '16', 'Chiwoshya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, '16', 'Mikundi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, '16', 'Kalulu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, '16', 'Mkanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, '17', 'Msikawanjala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, '17', 'Mulanje', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, '17', 'Milonde', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, '17', 'Thuchila', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, '17', 'Kamwendo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, '18', 'Mwanza', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, '18', 'Thamban', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, '19', 'Chikwina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, '19', 'Mpamba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, '19', 'Nkhata Bay', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, '19', 'Mzenga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, '19', 'Chitheka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, '19', 'Chintheche', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, '19', 'Tukombo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, '20', 'Nkhunga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, '20', 'Nkhota kota\r\nGame Reserve', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, '20', 'Linga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, '20', 'Zidyana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, '20', 'Mwansambo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, '21', 'Makhanga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, '21', 'Magoti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, '21', 'Zunde', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, '21', 'Nyachirenda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, '22', 'Chipukwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, '22', 'Malomo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, '22', 'Chikwatula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, '22', 'Kalira', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, '23', 'Tamani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, '23', 'Mpinda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, '23', 'Kasonga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, '23', 'Naminjiwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, '23', 'Waruma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, '23', 'Nkhulambe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, '24', 'Nyika National Park', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, '24', 'Nchenachena', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, '24', 'Chiweta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, '24', 'Mhuju', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, '24', 'Mphompha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, '24', 'Bolero', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, '24', 'Katowo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, '25', 'Nyika National Park', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, '25', 'Nchenachena', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, '25', 'Chiweta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, '25', 'Mhuju', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `farmer_epa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `farmer_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
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

INSERT INTO `farmers` (`id`, `parent_id`, `full_name`, `id_number`, `birthday_date`, `status`, `farmer_epa`, `farmer_district`, `sex`, `phonenumber`, `next_of_kin`, `farm_activity`, `produce`, `remember_token`, `created_at`, `updated_at`) VALUES
(216, 0, 'Rabson Sayenda', 'uuutu', '1917-08-01', '0', 'Lilangwe', '2', '1', '0886473454345', 'Esther Phiri', 'Crop Production', 'Not Available', NULL, '2020-11-15 22:46:58', '2020-12-13 11:31:40'),
(257, 0, 'dfajafd', 'Testing One123', '0000-00-00', '2', 'Chingale', '1', NULL, '0999776291899', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-11-17 15:43:15', '2020-12-13 06:11:23'),
(265, 0, 'RABSON SAYENDA', 'rABSON1234', '0000-00-00', '0', 'Kameme', '1', NULL, '09999969899976', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-11-17 21:41:21', '2020-12-13 11:31:37'),
(270, 0, 'KKKK hdhafh', '3fdjjaf', '0000-00-00', '0', 'Mpata', '11', NULL, '0999996985812', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-11-17 23:21:29', '2020-12-13 11:27:59'),
(271, 0, 'fdajaf', 'uuutu123456', '2010-01-03', '0', 'Mbewe', '6', '1', '0999996985126', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-11-17 23:22:29', '2020-12-13 11:27:51'),
(275, 0, 'Kondwani Lusinje', '14545', '0000-00-00', '0', 'Kameme', '1', NULL, '0888888888888888888', 'Not Assigned', 'Not Assigned', 'Not Available', NULL, '2020-11-19 09:27:58', '2020-12-13 06:11:12'),
(278, 0, 'Rabson Sayenda 888', 'uuutu12345', '1917-08-04', '0', 'Lilangwe', '2', '1', '0888799122123', 'Jones Moyenda', 'Animal Husbandry', 'Not Available', NULL, '2020-11-20 18:37:28', '2020-11-20 18:37:28'),
(279, 0, 'Moses Sayenda', 'uuutu34000', '1917-08-04', '0', 'Ntonda', '2', '1', '0888799122000', 'Esther Phiri', 'Poultry Farming', 'Not Available', NULL, '2020-11-20 18:39:35', '2020-11-20 18:39:35'),
(289, 0, 'Mayamiko Mambo', 'uuututt9884', '1917-08-01', '0', 'Malosa', '1', '1', '+265888799122', 'Llyod Giga', 'Crop Production', 'Not Available', NULL, '2020-12-10 15:40:46', '2020-12-10 15:48:53'),
(290, 0, 'Rabson Sayenda', 'uuutu123567', '1917-08-02', '0', 'Thumbwe', '7', '1', '+265800799122', 'Jones Moyenda', 'Crop Production', 'Not Available', NULL, '2020-12-10 15:46:35', '2020-12-10 15:48:51'),
(291, 0, 'Ezekiel Vitsitsi', 'uuutu3420', '1917-08-04', '0', 'Dolo', '6', '1', '+265888799144', 'Jones Moyenda', 'Crop Production', 'Not Available', NULL, '2020-12-10 15:48:28', '2020-12-10 16:00:27'),
(294, 0, 'Rabson Sayenda', 'uuutu334', '1917-07-30', '0', 'Mikalango', '6', '1', '+265888799110', 'Llyod Giga', 'Maize Production', 'Not Available', NULL, '2020-12-10 15:56:57', '2020-12-10 16:00:07'),
(297, 0, 'Rabson Sayenda', 'uuutu987', '1917-07-31', '0', 'Chingale', '1', '2', '0888799122983', 'Gift Soko', 'crop production', 'Not Available', NULL, '2020-12-10 18:51:33', '2020-12-10 19:02:58'),
(360, 0, 'Rabson Sayenda', 'uuutu274', '1917-08-01', '0', 'Not Available', '3', '1', '0888799122978', 'Jones Moyenda', 'Maize Production', 'Not Available', NULL, '2020-12-11 05:37:19', '2020-12-11 05:40:56');

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
(11, '216', 'Mbudzi', '10000', 'fjfaj', 100.00, 0, '2020-12-10 16:10:27', '2020-12-10 16:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `mark_id` int(10) UNSIGNED NOT NULL,
  `market_parent_id` int(11) NOT NULL DEFAULT 0,
  `mark_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_epa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `market_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`mark_id`, `market_parent_id`, `mark_name`, `mark_location`, `market_epa`, `market_district`, `created_at`, `updated_at`) VALUES
(39, 0, 'Agora', NULL, 'Lilangwe', '2', '2020-11-16 02:47:19', '2020-11-16 02:47:19'),
(41, 0, 'Blantyre Admarc', NULL, 'Ntonda', '2', '2020-11-16 03:04:03', '2020-11-16 03:04:03'),
(42, 0, 'Zomba Agora', NULL, 'Kunthembwe', '2', '2020-11-16 19:50:27', '2020-11-18 20:31:32'),
(43, 0, 'Blantyre Admarc', NULL, 'Not Available', '1', '2020-12-10 17:16:09', '2020-12-10 17:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `market_products`
--

CREATE TABLE `market_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `market_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `product_epa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `market_products` (`id`, `market_id`, `mark_location`, `product_epa`, `product_district`, `mark_name`, `product_name`, `selling_price`, `buying_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(38, '41 Blantyre Admarc', 'Not Assigned', 'Ntonda', '2', '41 Blantyre Admarc', 'Mbuzi', 100.00, '100', 'jjjjj', '100', 1, '2020-11-16 03:04:49', '2020-11-16 03:04:49'),
(39, '42 Zomba Agora', 'Not Assigned', 'Chipanda', '2', '42 Zomba Agora', 'Mtedza', 10000.00, '10', 'jjjj', '100', 1, '2020-11-16 19:51:04', '2020-11-16 19:51:04'),
(40, '39 Agora', 'Not Assigned', 'Not Available', '1', '39 Agora', 'Chimanga', 10000.00, '10', '', '100', 1, '2020-12-10 16:41:56', '2020-12-10 16:41:56');

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
(29, '2020_06_28_034027_create_supplier_products_table', 26),
(30, '2020_11_10_064431_create_districts_table', 27),
(31, '2020_11_10_064951_create_epas_table', 28);

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
('1', '099999124311', 26),
('2', '099999124311', 4),
('3', '099999124311', 0),
('4', '099999124311', 1),
('5', '099999124411', 8),
('6', '099999124411', 0),
('6', '099999124411', 1),
('7', '099999126411', 15),
('9', '099999126411', 5),
('10', '099999126411', 15),
('11', '099999126411', 15),
('12', '099999126411', 15),
('13', '099999126411', 15),
('14', '099999126411', 16),
('15', '099999126411', 15),
('16', '099999126411', 16),
('17', '099999126411', 5),
('18', '099999126411', 16),
('19', '099999126411', 38),
('20', '099999126411', 11),
('21', '099999126411', 3),
('22', '099999126411', 11),
('23', '099999126411', 12),
('24', '099999126411', 3),
('25', '099999126411', 25),
('26', '099999126411', 3),
('27', '099999126411', 11),
('28', '099999126411', 3),
('29', '099999126411', 12),
('30', '099999126411', 3),
('31', '099999126411', 3),
('32', '099999126411', 1),
('34', '099999126411', 3),
('35', '099999126411', 4),
('36', '099999126411', 2),
('37', '099999126411', 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_parent_id` int(11) NOT NULL DEFAULT 0,
  `supplier_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Not Assigned',
  `supplier_epa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `supplier_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phonenumber` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_parent_id`, `supplier_location`, `supplier_epa`, `supplier_district`, `supplier_phonenumber`, `working_hour`, `working_day`, `created_at`, `updated_at`) VALUES
(61, 'Bika Agro-dealer', 0, 'Not Assigned', 'Phalula', '5', '0996788210', '9AM-5PM', 'Monday-Sunday', '2020-11-15 23:44:14', '2020-12-05 20:49:03'),
(64, 'Admarch Blantyre', 0, 'Not Assigned', 'Mbewe', '6', '0999788210', '8AM-4PM', 'Monday-Friday', '2020-12-05 21:03:57', '2020-12-05 21:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `product_epa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `supplier_products` (`id`, `supplier_id`, `supplier_location`, `product_epa`, `product_district`, `supplier_name`, `product_name`, `selling_price`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(31, '61 Bika Agro-dealer', 'Not Assigned', 'Lilangwe', '2', '61 Bika Agro-dealer', 'Maize Bags', '10000', 'oooo', 0.00, 1, '2020-11-16 02:43:46', '2020-11-16 02:43:46');

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
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ussd_notifications`
--

INSERT INTO `ussd_notifications` (`id`, `farmer_id`, `sender_name`, `sent_message`, `received_message`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(69, 216, 'George Kondoni', 'fdasaflkdafld', NULL, '1', NULL, '2020-11-16 02:24:19', '2020-11-16 02:24:19'),
(70, 216, 'George Kondoni', 'Hello', NULL, '0', NULL, '2020-11-16 02:25:26', '2020-11-16 02:25:26'),
(71, 270, 'George Kondoni', 'hello', NULL, '0', NULL, '2020-11-19 15:24:52', '2020-11-19 15:24:52'),
(72, 270, 'rabson', 'kkkkkk', NULL, '0', NULL, '2020-11-19 15:25:19', '2020-11-19 15:25:19'),
(73, 270, 'Rabson Sayenda', 'pppppp', NULL, '0', NULL, '2020-11-19 15:27:19', '2020-11-19 15:27:19'),
(74, 270, 'Kondwani Lusinje', 'testing', NULL, '0', NULL, '2020-11-19 15:58:35', '2020-11-19 15:58:35'),
(75, 270, 'Rabson Sayenda', 'try2', NULL, '0', NULL, '2020-11-19 15:58:52', '2020-11-19 15:58:52');

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
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`epa_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epas`
--
ALTER TABLE `epas`
  ADD PRIMARY KEY (`ep_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `epa_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `epas`
--
ALTER TABLE `epas`
  MODIFY `ep_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `farmer_products`
--
ALTER TABLE `farmer_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `mark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `market_products`
--
ALTER TABLE `market_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
