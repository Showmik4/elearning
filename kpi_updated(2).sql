-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 08:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpi_updated`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `offered_answer_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `reference_no`, `survey_id`, `question_id`, `offered_answer_id`, `feedback`, `fk_user_id`, `created_at`, `updated_at`) VALUES
(1, '1-2-95998', 1, 1, 2, NULL, 2, '2024-12-08 21:18:33', '2024-12-08 21:18:33'),
(2, '1-2-95998', 1, 2, 7, NULL, 2, '2024-12-08 21:18:33', '2024-12-08 21:18:33'),
(3, '1-2-76892', 1, 1, 2, 'gsdhsdh', 2, '2024-12-10 07:46:38', '2024-12-10 07:46:38'),
(4, '1-2-76892', 1, 2, 7, 'sgsdhs', 2, '2024-12-10 07:46:38', '2024-12-10 07:46:38'),
(5, '1-2-19698', 1, 1, 2, 'dgsdhs', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(6, '1-2-19698', 1, 2, 6, 'sdghshd', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(7, '1-2-19698', 1, 3, 14, 'sdhgsdh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(8, '1-2-19698', 1, 4, 16, 'fjhdjfdj', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(9, '1-2-19698', 1, 7, 22, 'sdgsh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(10, '1-2-19698', 1, 8, 27, 'sdhsdh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(11, '1-2-19698', 1, 9, 30, 'sdgsdh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(12, '1-2-19698', 1, 10, 34, 'sdhsdh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(13, '1-2-19698', 1, 11, 38, 'sdhgsdh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(14, '1-2-19698', 1, 12, 43, 'sdhsdjh', 2, '2025-01-13 19:09:26', '2025-01-13 19:09:26'),
(15, '1-2011-82391', 1, 1, 3, 'dhdsfjd', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(16, '1-2011-82391', 1, 2, 6, 'sdhdfhj', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(17, '1-2011-82391', 1, 3, 15, 'sdhsdh', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(18, '1-2011-82391', 1, 4, 18, 'sdghsh', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(19, '1-2011-82391', 1, 7, 23, 'sdhgshd', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(20, '1-2011-82391', 1, 8, 25, 'sdhsdfh', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(21, '1-2011-82391', 1, 9, 28, 'sdghsh', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(22, '1-2011-82391', 1, 10, 34, 'sdhshd', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(23, '1-2011-82391', 1, 11, 39, 'sdhsh', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(24, '1-2011-82391', 1, 12, 42, 'sdhsh', 2011, '2025-01-19 12:26:53', '2025-01-19 12:26:53'),
(25, '1-2015-23004', 1, 1, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(26, '1-2015-23004', 1, 2, 6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(27, '1-2015-23004', 1, 3, 12, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(28, '1-2015-23004', 1, 4, 18, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(29, '1-2015-23004', 1, 7, 22, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(30, '1-2015-23004', 1, 8, 26, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(31, '1-2015-23004', 1, 9, 30, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(32, '1-2015-23004', 1, 10, 33, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(33, '1-2015-23004', 1, 11, 39, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(34, '1-2015-23004', 1, 12, 42, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50'),
(35, '1-2015-23004', 1, 13, 44, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 2015, '2025-01-26 05:26:50', '2025-01-26 05:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `fkUserId` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `optional_phone` varchar(20) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `customerImage` varchar(255) DEFAULT NULL,
  `reseller_id` int(11) DEFAULT NULL,
  `membership` varchar(50) DEFAULT '''no''',
  `fkCountryId` int(11) DEFAULT NULL,
  `districtId` int(11) DEFAULT NULL,
  `locationId` int(11) DEFAULT NULL,
  `fkCityId` int(11) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `fkAddressId` int(11) DEFAULT NULL,
  `fkShipmentZoneId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `fkUserId`, `phone`, `optional_phone`, `billing_address`, `shipping_address`, `status`, `customerImage`, `reseller_id`, `membership`, `fkCountryId`, `districtId`, `locationId`, `fkCityId`, `postcode`, `fkAddressId`, `fkShipmentZoneId`, `created_at`, `updated_at`) VALUES
(104, 1989, '01224228684', NULL, 'Dhaka', NULL, 'active', NULL, 1, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 07:07:09', '2024-09-06 07:57:15'),
(105, 1990, '01334332684', NULL, NULL, NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 02:28:37', '2024-09-06 02:28:37'),
(106, 1991, '3426486790737', NULL, 'sfsdg', NULL, 'active', NULL, 1, '\'no\'', NULL, 50, 3, NULL, NULL, NULL, NULL, '2024-09-06 11:11:53', '2024-09-06 11:11:53'),
(107, 1992, '325357597808', NULL, 'sdgdf', NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 11:41:59', '2024-09-06 11:41:59'),
(108, 1993, '234645686898', NULL, 'sfasfgs', NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 11:43:37', '2024-09-06 11:43:37'),
(109, 1994, '23464756', NULL, 'zcxbcvn', NULL, 'active', NULL, 1, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 11:46:01', '2024-09-06 11:46:01'),
(110, 1995, '347556867978', NULL, 'cxzvxc', NULL, 'active', NULL, 1, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-06 12:07:55', '2024-09-06 12:07:55'),
(111, 1997, '01718277861', NULL, NULL, NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-25 00:58:58', '2024-09-25 00:58:58'),
(112, 1998, '01664662684', NULL, NULL, NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-25 01:58:38', '2024-09-25 01:58:38'),
(113, 1999, '01224222684', NULL, NULL, NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-27 05:08:21', '2024-09-27 05:08:21'),
(114, 2000, '01334332674', NULL, 'asdgsdf', NULL, 'active', NULL, NULL, '\'no\'', NULL, 2, NULL, NULL, NULL, NULL, NULL, '2024-09-27 07:15:12', '2024-09-27 07:15:12'),
(115, 2001, '01994992684', NULL, NULL, NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-02 01:57:25', '2024-10-02 01:57:25'),
(116, 2002, '01664662674', NULL, NULL, NULL, 'active', NULL, NULL, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-08 07:06:13', '2024-10-08 07:06:13'),
(117, 2003, '01664772684', NULL, 'dhaka', NULL, 'active', NULL, 1, '\'no\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24 12:11:04', '2024-10-24 12:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `kpi`
--

CREATE TABLE `kpi` (
  `id` int(11) NOT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_subtype_id` int(11) DEFAULT NULL,
  `fk_subtype_topic_id` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi`
--

INSERT INTO `kpi` (`id`, `fk_type_id`, `fk_subtype_id`, `fk_subtype_topic_id`, `added_by`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, '2024-12-05', '2024-12-04 20:08:06', '2024-12-04 20:08:06'),
(2, 1, 1, 1, 2, '2024-12-05', '2024-12-04 20:09:14', '2024-12-04 20:09:14'),
(3, 1, 1, 1, 2, '2024-12-05', '2024-12-04 21:04:07', '2024-12-04 21:04:07'),
(4, 2, 4, 8, 2, '2025-01-13', '2025-01-13 17:18:50', '2025-01-13 17:18:50'),
(5, 2, 5, 11, 2, '2025-01-13', '2025-01-13 17:21:39', '2025-01-13 17:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_assign`
--

CREATE TABLE `kpi_assign` (
  `id` int(11) NOT NULL,
  `fk_kpi_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `target` int(11) DEFAULT 0,
  `total_complete` int(11) DEFAULT 0,
  `assigned_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_assign`
--

INSERT INTO `kpi_assign` (`id`, `fk_kpi_id`, `fk_user_id`, `status`, `date`, `target`, `total_complete`, `assigned_by`, `created_at`, `updated_at`) VALUES
(1, 3, 2009, 'Completed', '2024-12-11', 5, 5, 2010, '2024-12-11 10:56:07', '2024-12-11 10:57:04'),
(2, 3, 2013, 'Completed', '2024-12-11', 5, 3, 2010, '2024-12-11 10:56:07', '2025-01-25 17:16:08'),
(3, 3, 2009, 'Assigned', '2024-12-30', 5, 0, 2, '2024-12-29 18:39:59', '2024-12-29 18:39:59'),
(4, 3, 2012, 'Assigned', '2024-12-30', 5, 0, 2, '2024-12-29 18:39:59', '2024-12-29 18:39:59'),
(5, 5, 2, 'Assigned', '2025-01-13', 5, 0, 2, '2025-01-13 17:21:39', '2025-01-13 17:21:39'),
(6, 5, 2010, 'Assigned', '2025-01-13', 5, 0, 2, '2025-01-13 17:21:39', '2025-01-13 17:21:39'),
(7, 5, 2009, 'Assigned', '2025-01-19', 5, 0, 2, '2025-01-19 13:07:37', '2025-01-19 13:07:37'),
(8, 3, 2011, 'Completed', '2025-01-19', 10, 7, 2, '2025-01-19 17:09:47', '2025-01-19 17:10:42'),
(9, 3, 2014, 'Completed', '2025-01-23', 10, 2, 2, '2025-01-22 19:27:35', '2025-01-22 19:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_attachment`
--

CREATE TABLE `kpi_attachment` (
  `id` int(11) NOT NULL,
  `fk_kpi_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_attachment`
--

INSERT INTO `kpi_attachment` (`id`, `fk_kpi_id`, `file`) VALUES
(1, 2, 'public/documents/1733342954_dummy.pdf'),
(2, 3, 'public/documents/1733346247_tests-example.xls'),
(3, 4, 'public/documents/1736788730_Screenshot 2023-08-24 031229.png'),
(4, 5, 'public/documents/1736788899_Screenshot 2023-12-25 034603.png');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_feedback_attachment`
--

CREATE TABLE `kpi_feedback_attachment` (
  `id` int(11) NOT NULL,
  `fk_kpi_assign_id` int(11) DEFAULT NULL,
  `fk_kpi_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_feedback_attachment`
--

INSERT INTO `kpi_feedback_attachment` (`id`, `fk_kpi_assign_id`, `fk_kpi_id`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'public/documents/1733914624_darklogo.jpg', '2024-12-11 10:57:05', '2024-12-11 10:57:05'),
(2, 2, 3, 'public/documents/1733914742_darklogo.jpg', '2024-12-11 10:59:02', '2024-12-11 10:59:02'),
(3, 8, 3, 'public/documents/1737306642_dummy.pdf', '2025-01-19 17:10:42', '2025-01-19 17:10:42'),
(4, 9, 3, 'public/documents/1737574103_dummy.pdf', '2025-01-22 19:28:23', '2025-01-22 19:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_subtype`
--

CREATE TABLE `kpi_subtype` (
  `id` int(11) NOT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `subtype_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_subtype`
--

INSERT INTO `kpi_subtype` (`id`, `fk_type_id`, `subtype_name`) VALUES
(1, 1, 'CEO\'s COMMITMENT LETTER'),
(2, 1, 'CCC MEETING- AGENDA & PROGESS'),
(3, 2, 'KYC QC'),
(4, 2, 'CR'),
(5, 2, 'STRSAR'),
(6, 2, 'Risk rating'),
(7, 2, 'Sanction Screening'),
(8, 3, 'ADVERSE MEDIA SCREENING'),
(9, 3, 'FCA'),
(10, 3, 'Investigation'),
(11, 4, 'Training'),
(12, 4, 'Awareness');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_subtype_topic`
--

CREATE TABLE `kpi_subtype_topic` (
  `id` int(11) NOT NULL,
  `fk_subtype_id` int(11) DEFAULT NULL,
  `topic_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_subtype_topic`
--

INSERT INTO `kpi_subtype_topic` (`id`, `fk_subtype_id`, `topic_name`) VALUES
(1, 1, 'Employees'),
(2, 1, 'Channel Partners'),
(3, 2, '1st Meeting'),
(4, 2, '2nd Meeting'),
(5, 3, 'Personal'),
(6, 3, 'Agent'),
(7, 3, 'Merchant'),
(8, 4, 'Registration process monitoring'),
(9, 4, 'Transaction monitoring'),
(10, 5, 'Process'),
(11, 5, 'Disclosure'),
(12, 6, 'Personal'),
(13, 6, 'Agent'),
(14, 6, 'Merchant'),
(15, 7, 'Case Management'),
(16, 7, 'Feedback'),
(17, 8, 'Screened'),
(18, 8, 'Identified'),
(19, 8, 'Reported'),
(20, 9, 'Agent'),
(21, 9, 'Merchant'),
(22, 9, 'DH'),
(23, 10, 'IRM'),
(24, 10, 'Strsar'),
(25, 10, 'external'),
(26, 11, 'Agent'),
(27, 11, 'Merchant'),
(28, 11, 'Employees'),
(29, 12, 'Cautionary (SMS) - Personal'),
(30, 12, 'Cautionary (SMS) - Agent'),
(31, 12, 'Cautionary (SMS) - Merchant');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_type`
--

CREATE TABLE `kpi_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kpi_type`
--

INSERT INTO `kpi_type` (`id`, `type_name`) VALUES
(1, 'Organization & Culture'),
(2, 'CDD'),
(3, 'EDD'),
(4, 'CB'),
(5, 'Development');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_08_100000_create_telescope_entries_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) NOT NULL,
  `token` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$CD7r.20emvi77yfLZnW2..8swaYWCRtvk1iSPZItU70WqDVopbODC', '2021-07-07 06:43:43'),
('masud@gmail.com', '$2y$10$GMTAMyRaML.PinP9RXWllONB2gJc.ru.ARSm3FVUfD63Q.fsymdui', '2021-07-07 09:55:32'),
('yes@gmail.com', '$2y$10$cHlfyzW6WDwSyzTg84t6i.6jorLLqm5oRY/.qkUUG7mnfR7OhCy3i', '2021-09-21 05:58:02'),
('munjurinatcl@gmail.com', '$2y$10$0QS3y9bnBlS/tZ62dRLQGexv/wp6YWh2M0vdMIfARQhDRiqj.ix8S', '2021-09-22 02:52:39'),
('munjurinaa@gmail.com', '$2y$10$8hA7MF2hy.vvFC6KBsij..Bp1CXshIhDdqbEIJnnPeOFukWAQj5Xy', '2021-09-22 03:24:00'),
('munjurinaazam@gmail.com', '$2y$10$smqTF5arAFfgL8AsF4eYRet45TGokGsA/Jfjq6Cji9zggc.RlocOm', '2021-09-22 03:24:47'),
('rajib@gmail.com', '$2y$10$tIBpagJwXTrCLqcbsDkI/eewNIvKCqWiWR.3BbT/kNUs/Fpf3Bp9W', '2021-10-21 01:13:41'),
('showmik.aiub@gmail.com', '$2y$10$5jhUIbc.l0CeQh6kNkkNbOO1W8ubb7ijpE7iuNAbb6shmY0rTjVWm', '2024-08-29 03:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'setting.show'),
(2, 'user.view-employee'),
(3, 'user.create-employee'),
(4, 'user.editEmployee'),
(5, 'userType.show'),
(16, 'team.show'),
(17, 'team.create'),
(18, 'team.edit'),
(19, 'kpi_type.show'),
(20, 'kpi_type.create'),
(21, 'kpi_type.edit'),
(22, 'kpi_subtype.show'),
(23, 'kpi_subtype.create'),
(24, 'kpi_subtype.edit'),
(25, 'kpi.show'),
(26, 'kpi.create'),
(27, 'kpi.edit'),
(28, 'kpi.assign'),
(29, 'kpi.all_assigned_kpi'),
(30, 'kpi.kpi_feedback'),
(31, 'question.show'),
(32, 'question.create'),
(33, 'question.edit'),
(34, 'survey.show'),
(35, 'survey.create'),
(36, 'survey.edit'),
(37, 'survey.details'),
(38, 'survey.complete_survey'),
(39, 'survey.view_complete_survey_answer'),
(40, 'team.delete'),
(41, 'kpi_subtype.delete'),
(42, 'kpi_type.delete'),
(43, 'kpi.complete_kpi'),
(44, 'survey.delete');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `title`, `survey_id`) VALUES
(1, 'How often did the officer meet or exceed their assigned KPIs?', 1),
(2, 'What is recorded for each target completed by the officer?', 1),
(3, 'Which of the following is NOT part of the officer\'s core responsibilities?', 1),
(4, 'How frequently were targets completed on time?', 1),
(7, 'How effectively did the officer collaborate with the team?', 1),
(8, 'Who can assign KPIs to team officers?', 1),
(9, 'Which of the following best reflects the officer’s problem-solving ability?', 1),
(10, 'What actions should the officer take if a transaction anomaly is detected?', 1),
(11, 'Which tool is primarily used for PEP/IP list screening?', 1),
(12, 'What is displayed on the dashboard for performance monitoring?', 1),
(13, 'How are AML/CFT risks assessed?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_point`
--

CREATE TABLE `question_point` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `offered_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_point`
--

INSERT INTO `question_point` (`id`, `survey_id`, `question_id`, `offered_answer`) VALUES
(1, 1, 1, 'Rarely'),
(2, 1, 1, 'Sometimes'),
(3, 1, 1, 'Often'),
(4, 1, 2, 'Assigned date only'),
(5, 1, 2, 'Completion date only'),
(6, 1, 2, 'Both assigned and completion dates'),
(7, 1, 2, 'File upload status'),
(11, 1, 1, 'Always'),
(12, 1, 3, 'KYC QC'),
(13, 1, 3, 'Case Management'),
(14, 1, 3, 'Adverse Media Screening'),
(15, 1, 3, 'Team assignment changes'),
(16, 1, 4, 'Never'),
(17, 1, 4, 'Rarely'),
(18, 1, 4, 'Sometimes'),
(19, 1, 4, 'Always'),
(20, 1, 7, 'Poor'),
(21, 1, 7, 'Satisfactory'),
(22, 1, 7, 'Good'),
(23, 1, 7, 'Excellent'),
(24, 1, 8, 'Admin only'),
(25, 1, 8, 'Line managers only'),
(26, 1, 8, 'Officers themselves'),
(27, 1, 8, 'Both admin and line managers'),
(28, 1, 9, 'Rarely proactive'),
(29, 1, 9, 'Reactive only'),
(30, 1, 9, 'Occasionally innovative'),
(31, 1, 9, 'Consistently innovative'),
(32, 1, 10, 'Ignore the anomaly'),
(33, 1, 10, 'Notify their line manager immediately'),
(34, 1, 10, 'Modify the target'),
(35, 1, 10, 'Reassign the task to another officer'),
(36, 1, 11, 'AML360'),
(37, 1, 11, 'Case Manager'),
(38, 1, 11, 'STRSAR'),
(39, 1, 11, 'Risk Rating Module'),
(40, 1, 12, 'Raw data entries'),
(41, 1, 12, 'Graphs and team comparisons'),
(42, 1, 12, 'Completion dates only'),
(43, 1, 12, 'Individual-only data'),
(44, 1, 13, 'Intuitively');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_permission_id` int(11) NOT NULL,
  `role_id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_permission_id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(14, 1, 5),
(17, 1, 16),
(18, 1, 17),
(19, 1, 18),
(20, 1, 34),
(21, 1, 35),
(22, 1, 36),
(23, 1, 37),
(24, 1, 38),
(29, 1, 19),
(30, 1, 20),
(31, 1, 21),
(32, 1, 22),
(33, 1, 23),
(34, 1, 24),
(35, 1, 25),
(37, 1, 27),
(39, 1, 29),
(40, 1, 30),
(41, 2, 34),
(42, 2, 37),
(43, 2, 38),
(44, 2, 39),
(45, 2, 25),
(46, 2, 28),
(47, 2, 29),
(48, 2, 30),
(49, 14, 34),
(50, 14, 37),
(51, 14, 29),
(52, 14, 30),
(53, 1, 40),
(54, 1, 42),
(55, 1, 41),
(56, 1, 28),
(57, 1, 26),
(58, 1, 43),
(59, 1, 44),
(60, 1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settingId` int(11) NOT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logoDark` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingId`, `companyName`, `email`, `logo`, `logoDark`, `address`, `phone`) VALUES
(1, 'Bkash', 'Example@gmail.com', 'public/settingImage/675b3eb1beba4.png', 'public/settingImage/675b3eb1cea36.png', 'Dhaka,  Bangladesh.', '00000772684');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Yearly KPI Achievement', 'Efficiency and Quality', '2024-12-03 16:53:50', '2025-01-13 23:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', '2024-12-03 09:07:12', '2024-12-03 09:13:19'),
(2, 'RTT', '2024-12-11 06:28:48', '2024-12-11 06:28:48'),
(3, 'AML&CFT Gov.', '2024-12-11 06:29:15', '2024-12-11 06:29:15'),
(4, 'CAD', '2024-12-11 06:29:33', '2024-12-11 06:29:33'),
(5, 'STRSAR', '2024-12-11 06:29:52', '2024-12-11 06:29:52'),
(6, 'CPMCT', '2024-12-11 06:30:11', '2024-12-11 06:30:11'),
(7, 'FCAT', '2024-12-11 06:30:28', '2024-12-11 06:30:28'),
(8, 'RAMLCO', '2024-12-11 06:30:44', '2024-12-11 06:30:44'),
(9, 'RMCT', '2024-12-11 06:31:10', '2024-12-11 06:31:10'),
(10, 'SCT', '2024-12-11 06:31:27', '2024-12-11 06:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT 'active/inactive',
  `fk_team_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fkUserTypeId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `phone`, `email`, `password`, `username`, `status`, `fk_team_id`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `fkUserTypeId`) VALUES
(2, 'Towhidur', 'Rahman', '01234567890', 'admin@gmail.com', '$2a$12$z.yfy6cPPAfIWXceulVSb..yvwq/XktrlMUxsgBQx8gWNNiVA.LJC', 'sfasdgsd', 'active', 1, NULL, '6qlbkrhiUlLqnbTZjSbcnGRaGzhnWMIMlkvgh9WBdRllEvbHPwrH0Z2yP390', '2020-03-13 08:16:33', '2024-12-11 06:44:04', 1),
(2009, 'Jerin Tasnim', 'Purba', NULL, 'rtt1@gmail.com', '$2y$10$jgBJf2ykFPAR3Kl0tBhhqe2JJ8pRB96e/ZTSmKjVsP1fliZdFbOt.', 'dipto', 'active', 2, NULL, '3OleilUoYIbENxpcON5RmAzOC7QhajTMD5KRKaNqxBU3IhemgCzNA8CsZf6G', '2024-11-07 16:39:42', '2024-12-11 06:54:41', 14),
(2010, 'Farhan Masud', 'Khan Pathan', '01774552684', 'linemanagers1@gmail.com', '$2y$10$AXBZ2I8hYmjLh/DtsrxwK.MQoh6oh6HBOpNxvxYuK9ubeagWZax2K', NULL, 'active', 2, NULL, 'oUJUG24u9rMlm4Lbp4Sf8geXpxlK3Y0z32HP9qa9nGlgfKqRzmhVrzoRBO5f', '2024-11-07 16:46:13', '2024-12-11 06:52:12', 2),
(2011, 'Wilma', 'Sellers', '+1 (424) 445-2135', 'jotusazec@mailinator.com', '$2a$12$VeQvF5VIlgyOEQiZ4EIAzOicdPHFEivQD0J/4iZO/jqdCHDAv4VUq', NULL, 'active', 9, NULL, NULL, '2024-12-03 09:40:07', '2025-01-19 17:06:49', 2),
(2012, 'Shah Sadmaney', 'Yeasar Shopnil', '01664662674', 'shah@gmail.com', '$2y$10$nuvLP/o/igAhmRietsA7tuWCDfhgZz9JfeClCYmXuDqB2tICzYxv6', NULL, 'active', 1, NULL, NULL, '2024-12-11 06:37:42', '2024-12-11 06:37:42', 1),
(2013, 'Md. Nahid', 'Al Hossain', '01224222684', 'rtt2@gmail.com', '$2y$10$I5jRsgcQYkP6kYoy2aLzmuVpU36RlRuPe.xtHHlVmMdBHzr5uWqZ2', NULL, 'active', 2, NULL, NULL, '2024-12-11 06:56:02', '2024-12-11 06:56:02', 14),
(2014, 'S. M. Shawkat', 'Jamil', '01700111108', 'Jamil@gmail.com', '$2y$10$hWXVNdTXiZtBVe865XmVC.ttR0XuBfLjV/G79HDJjTNt1Xi44lp16', NULL, 'active', 3, NULL, NULL, '2025-01-22 19:23:12', '2025-01-22 19:23:12', 2),
(2015, 'Meer Ehsan', 'Rumy', '01700022084', 'rumys@gmail.com', '$2y$10$6IdMAPg/OSueNe3K4WYwh.e6A9t.wA0UgOpoFBtZyp7zgMlZRb5me', NULL, 'active', 3, NULL, NULL, '2025-01-22 19:25:44', '2025-01-26 05:28:18', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `userTypeId` int(11) NOT NULL,
  `typeName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`userTypeId`, `typeName`) VALUES
(1, 'Admin'),
(2, 'Line Manager'),
(14, 'Officer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `fk_customer_user1_idx` (`fkUserId`);

--
-- Indexes for table `kpi`
--
ALTER TABLE `kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_assign`
--
ALTER TABLE `kpi_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_attachment`
--
ALTER TABLE `kpi_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_feedback_attachment`
--
ALTER TABLE `kpi_feedback_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_subtype`
--
ALTER TABLE `kpi_subtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_subtype_topic`
--
ALTER TABLE `kpi_subtype_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_type`
--
ALTER TABLE `kpi_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_point`
--
ALTER TABLE `question_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_permission_id`),
  ADD KEY `fk_permission` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingId`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_user_usertype_idx` (`fkUserTypeId`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`userTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `kpi`
--
ALTER TABLE `kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kpi_assign`
--
ALTER TABLE `kpi_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kpi_attachment`
--
ALTER TABLE `kpi_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kpi_feedback_attachment`
--
ALTER TABLE `kpi_feedback_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kpi_subtype`
--
ALTER TABLE `kpi_subtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kpi_subtype_topic`
--
ALTER TABLE `kpi_subtype_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `kpi_type`
--
ALTER TABLE `kpi_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `question_point`
--
ALTER TABLE `question_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `role_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2016;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `userTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
