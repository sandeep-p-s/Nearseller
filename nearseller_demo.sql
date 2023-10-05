-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 29, 2023 at 12:24 PM
-- Server version: 8.0.31-0ubuntu0.20.04.2
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nearseller_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_product_attributes`
--

CREATE TABLE `add_product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int DEFAULT NULL,
  `attribute_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `slug_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_price` double(8,2) DEFAULT NULL,
  `mrp_price` double(8,2) DEFAULT NULL,
  `attribute_stock` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_product_attributes`
--

INSERT INTO `add_product_attributes` (`id`, `product_id`, `attribute_1`, `attribute_2`, `attribute_3`, `attribute_4`, `stock_status`, `slug_description`, `offer_price`, `mrp_price`, `attribute_stock`, `created_at`, `updated_at`) VALUES
(28, 2, '10', 'blue', NULL, NULL, '1', NULL, 500.00, 600.00, 5, '2023-09-26 11:21:37', '2023-09-26 11:21:37'),
(29, 2, '25', 'red', NULL, NULL, '0', NULL, 100.00, 120.00, 5, '2023-09-26 11:21:37', '2023-09-26 11:21:37'),
(30, 4, '38', 'Red', NULL, NULL, '1', NULL, 600.00, 650.00, 20, '2023-09-29 08:37:33', '2023-09-29 08:37:33'),
(31, 4, '38', 'Green', 'Silk', NULL, '1', NULL, 650.00, 700.00, 10, '2023-09-29 08:37:33', '2023-09-29 08:37:33'),
(32, 4, '38', 'Yellow', 'corton', '10', '1', NULL, 300.00, 450.00, 10, '2023-09-29 08:37:33', '2023-09-29 08:37:33'),
(33, 4, '40', 'red', NULL, NULL, '0', NULL, 500.00, 550.00, 10, '2023-09-29 08:37:33', '2023-09-29 08:37:33'),
(37, 6, 'red', NULL, NULL, NULL, '0', NULL, 300.00, 320.00, 30, '2023-09-29 08:58:01', '2023-09-29 08:58:01'),
(38, 6, 'green', NULL, NULL, NULL, '0', NULL, 500.00, 600.00, 20, '2023-09-29 08:58:01', '2023-09-29 08:58:01'),
(39, 1, '38', 'Red', NULL, NULL, '1', NULL, 600.00, 650.00, 20, '2023-09-29 08:58:36', '2023-09-29 08:58:36'),
(40, 1, '38', 'Green', 'Silk', '20', '1', NULL, 650.00, 700.00, 20, '2023-09-29 08:58:36', '2023-09-29 08:58:36'),
(41, 1, '38', 'Yellow', 'corton', '10', '1', NULL, 300.00, 450.00, 10, '2023-09-29 08:58:36', '2023-09-29 08:58:36'),
(42, 5, '38', 'Red', NULL, NULL, '1', NULL, 600.00, 650.00, 20, '2023-09-29 09:03:16', '2023-09-29 09:03:16'),
(43, 5, '38', 'Green', 'Silk', NULL, '1', NULL, 650.00, 700.00, 20, '2023-09-29 09:03:16', '2023-09-29 09:03:16'),
(44, 5, '38', 'Yellow', 'corton', '10', '1', NULL, 300.00, 450.00, 10, '2023-09-29 09:03:16', '2023-09-29 09:03:16'),
(45, 7, '38', 'Red', NULL, NULL, '1', NULL, 600.00, 650.00, 20, '2023-09-29 09:04:05', '2023-09-29 09:04:05'),
(46, 7, '38', 'Green', 'Silk', NULL, '1', NULL, 650.00, 700.00, 20, '2023-09-29 09:04:05', '2023-09-29 09:04:05'),
(47, 7, '38', 'Yellow', 'corton', '10', '1', NULL, 300.00, 450.00, 10, '2023-09-29 09:04:05', '2023-09-29 09:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate`
--

CREATE TABLE `affiliate` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mob_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate_reg_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referal_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int DEFAULT NULL,
  `state` int DEFAULT NULL,
  `district` int DEFAULT NULL,
  `aadhar_file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `passbook_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_condition` tinyint(1) NOT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `direct_affiliate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aff_coordinator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_country` int DEFAULT NULL,
  `bank_state` int DEFAULT NULL,
  `bank_dist` int DEFAULT NULL,
  `bank_type` int DEFAULT NULL,
  `branch_code` int DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate_approved` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliate`
--

INSERT INTO `affiliate` (`id`, `name`, `email`, `mob_no`, `dob`, `gender`, `profession`, `other_profession`, `marital_status`, `religion`, `affiliate_reg_id`, `referal_id`, `aadhar_no`, `locality`, `country`, `state`, `district`, `aadhar_file`, `passbook_file`, `photo_file`, `terms_condition`, `pan_no`, `registration_date`, `direct_affiliate`, `aff_coordinator`, `account_holder_name`, `account_no`, `bank_country`, `bank_state`, `bank_dist`, `bank_type`, `branch_code`, `user_id`, `parent_id`, `affiliate_approved`, `created_at`, `updated_at`) VALUES
(1, 'Kannan Rajesh', 'savinumtdm@gmail.com', '8947512891', NULL, NULL, NULL, NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, NULL, '{\"fileval\":[]}', '{\"passbook\":[]}', '{\"photos\":[]}', 0, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '3', NULL, 'N', '2023-09-15 05:44:44', '2023-09-15 05:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` bigint UNSIGNED NOT NULL,
  `district_code` int DEFAULT NULL,
  `bank_code` int DEFAULT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `district_code`, `bank_code`, `branch_name`, `branch_address`, `ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 599, 1, 'PORT BLAIR', 'PORTBLAIR, ANDAMAN AND NICOBAR ISLANDS', 'SBIN0000156', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_types`
--

CREATE TABLE `bank_types` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_types`
--

INSERT INTO `bank_types` (`id`, `bank_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'STATE BANK OF INDIA', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_type`
--

CREATE TABLE `business_type` (
  `id` bigint UNSIGNED NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`id`, `business_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sales', 'Y', NULL, NULL),
(2, 'Services', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `category_level` int DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_type` int DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `approved_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`, `category_level`, `category_image`, `category_type`, `status`, `category_slug`, `approval_status`, `created_at`, `updated_at`, `approved_by`, `approved_time`) VALUES
(1, 'Fashion', 0, 0, NULL, 1, 'Y', 'fashion-22', 'Y', NULL, '2023-09-29 12:20:28', NULL, NULL),
(2, 'Electronics', 0, 0, NULL, 1, 'Y', 'electronics-22', 'Y', NULL, NULL, NULL, NULL),
(3, 'Home Appliances', 0, 0, NULL, 1, 'Y', 'home-appliances-22', 'Y', NULL, NULL, NULL, NULL),
(4, 'Mens', 1, 1, '1695299697_TkOCpKXu.png', NULL, 'Y', 'mens-6266', 'Y', '2023-09-21 12:34:58', '2023-09-29 12:19:29', 1, '2023-09-29 12:19:29'),
(5, 'Shirts', 4, 2, '', NULL, 'Y', 'shirts-1428', 'Y', '2023-09-21 12:35:52', '2023-09-29 12:19:19', 1, '2023-09-29 12:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'India', 'Y', NULL, NULL),
(2, 'United Arab Emirates', 'Y', NULL, NULL),
(3, 'Afghanistan', 'Y', NULL, NULL),
(4, 'Antigua and Barbuda', 'Y', NULL, NULL),
(5, 'Anguilla', 'Y', NULL, NULL),
(6, 'Albania', 'Y', NULL, NULL),
(7, 'Armenia', 'Y', NULL, NULL),
(8, 'Netherlands Antilles', 'Y', NULL, NULL),
(9, 'Angola', 'Y', NULL, NULL),
(10, 'Antarctica', 'Y', NULL, NULL),
(11, 'Argentina', 'Y', NULL, NULL),
(12, 'Austria', 'Y', NULL, NULL),
(13, 'Australia', 'Y', NULL, NULL),
(14, 'Azerbaijan', 'Y', NULL, NULL),
(15, 'Bosnia and Herzegovina', 'Y', NULL, NULL),
(16, 'Barbados', 'Y', NULL, NULL),
(17, 'Bangladesh', 'Y', NULL, NULL),
(18, 'Belgium', 'Y', NULL, NULL),
(19, 'Bulgaria', 'Y', NULL, NULL),
(20, 'Bahrain', 'Y', NULL, NULL),
(21, 'Bermuda', 'Y', NULL, NULL),
(22, 'Burundi', 'Y', NULL, NULL),
(23, 'Brunei', 'Y', NULL, NULL),
(24, 'Bolivia', 'Y', NULL, NULL),
(25, 'Brazil', 'Y', NULL, NULL),
(26, 'Bahamas', 'Y', NULL, NULL),
(27, 'Bhutan', 'Y', NULL, NULL),
(28, 'Canada', 'Y', NULL, NULL),
(29, 'Congo [DRC]', 'Y', NULL, NULL),
(30, 'Switzerland', 'Y', NULL, NULL),
(31, 'Chile', 'Y', NULL, NULL),
(32, 'Bhutan', 'Y', NULL, NULL),
(33, 'China', 'Y', NULL, NULL),
(34, 'Colombia', 'Y', NULL, NULL),
(35, 'Cuba', 'Y', NULL, NULL),
(36, 'Cyprus', 'Y', NULL, NULL),
(37, 'Czech Republic', 'Y', NULL, NULL),
(38, 'Germany', 'Y', NULL, NULL),
(39, 'Denmark', 'Y', NULL, NULL),
(40, 'Ecuador', 'Y', NULL, NULL),
(41, 'Egypt', 'Y', NULL, NULL),
(42, 'Spain', 'Y', NULL, NULL),
(43, 'Ethiopia', 'Y', NULL, NULL),
(44, 'Finland', 'Y', NULL, NULL),
(45, 'Fiji', 'Y', NULL, NULL),
(46, 'France', 'Y', NULL, NULL),
(47, 'United Kingdom', 'Y', NULL, NULL),
(48, 'Georgia', 'Y', NULL, NULL),
(49, 'French Guiana', 'Y', NULL, NULL),
(50, 'Ghana', 'Y', NULL, NULL),
(51, 'Greenland', 'Y', NULL, NULL),
(52, 'Gambia', 'Y', NULL, NULL),
(53, 'Greece', 'Y', NULL, NULL),
(54, 'Hong Kong', 'Y', NULL, NULL),
(55, 'Croatia', 'Y', NULL, NULL),
(56, 'Haiti', 'Y', NULL, NULL),
(57, 'Hungary', 'Y', NULL, NULL),
(58, 'Indonesia', 'Y', NULL, NULL),
(59, 'Ireland', 'Y', NULL, NULL),
(60, 'Israel', 'Y', NULL, NULL),
(61, 'Andorra', 'Y', NULL, NULL),
(62, 'Iraq', 'Y', NULL, NULL),
(63, 'Iran', 'Y', NULL, NULL),
(64, 'Iceland', 'Y', NULL, NULL),
(65, 'Italy', 'Y', NULL, NULL),
(66, 'Jamaica', 'Y', NULL, NULL),
(67, 'Jordan', 'Y', NULL, NULL),
(68, 'Japan', 'Y', NULL, NULL),
(69, 'Kenya', 'Y', NULL, NULL),
(70, 'Kyrgyzstan', 'Y', NULL, NULL),
(71, 'Cambodia', 'Y', NULL, NULL),
(72, 'North Korea', 'Y', NULL, NULL),
(73, 'South Korea', 'Y', NULL, NULL),
(74, 'Kuwait', 'Y', NULL, NULL),
(75, 'Kazakhstan', 'Y', NULL, NULL),
(76, 'Laos', 'Y', NULL, NULL),
(77, 'Lebanon', 'Y', NULL, NULL),
(78, 'Sri Lanka', 'Y', NULL, NULL),
(79, 'Liberia', 'Y', NULL, NULL),
(80, 'Lithuania', 'Y', NULL, NULL),
(81, 'Luxembourg', 'Y', NULL, NULL),
(82, 'Latvia', 'Y', NULL, NULL),
(83, 'Libya', 'Y', NULL, NULL),
(84, 'Morocco', 'Y', NULL, NULL),
(85, 'Monaco', 'Y', NULL, NULL),
(86, 'Montenegro', 'Y', NULL, NULL),
(87, 'Madagascar', 'Y', NULL, NULL),
(88, 'Macedonia [FYROM]', 'Y', NULL, NULL),
(89, 'Mali', 'Y', NULL, NULL),
(90, 'Myanmar [Burma]', 'Y', NULL, NULL),
(91, 'Mongolia', 'Y', NULL, NULL),
(92, 'Malta', 'Y', NULL, NULL),
(93, 'Mauritius', 'Y', NULL, NULL),
(94, 'Maldives', 'Y', NULL, NULL),
(95, 'Mexico', 'Y', NULL, NULL),
(96, 'Malaysia', 'Y', NULL, NULL),
(97, 'Mozambique', 'Y', NULL, NULL),
(98, 'Namibia', 'Y', NULL, NULL),
(99, 'Niger', 'Y', NULL, NULL),
(100, 'Nigeria', 'Y', NULL, NULL),
(101, 'Netherlands', 'Y', NULL, NULL),
(102, 'Norway', 'Y', NULL, NULL),
(103, 'Nepal', 'Y', NULL, NULL),
(104, 'Nauru', 'Y', NULL, NULL),
(105, 'New Zealand', 'Y', NULL, NULL),
(106, 'Oman', 'Y', NULL, NULL),
(107, 'Panama', 'Y', NULL, NULL),
(108, 'Peru', 'Y', NULL, NULL),
(109, 'Papua New Guinea', 'Y', NULL, NULL),
(110, 'Philippines', 'Y', NULL, NULL),
(111, 'Pakistan', 'Y', NULL, NULL),
(112, 'Poland', 'Y', NULL, NULL),
(113, 'Puerto Rico', 'Y', NULL, NULL),
(114, 'Palestinian Territories', 'Y', NULL, NULL),
(115, 'Portugal', 'Y', NULL, NULL),
(116, 'Palau', 'Y', NULL, NULL),
(117, 'Paraguay', 'Y', NULL, NULL),
(118, 'Qatar', 'Y', NULL, NULL),
(119, 'Romania', 'Y', NULL, NULL),
(120, 'Serbia', 'Y', NULL, NULL),
(121, 'Russia', 'Y', NULL, NULL),
(122, 'Rwanda', 'Y', NULL, NULL),
(123, 'Saudi Arabia', 'Y', NULL, NULL),
(124, 'Seychelles', 'Y', NULL, NULL),
(125, 'Sudan', 'Y', NULL, NULL),
(126, 'Sweden', 'Y', NULL, NULL),
(127, 'Singapore', 'Y', NULL, NULL),
(128, 'Saint Helena', 'Y', NULL, NULL),
(129, 'Slovenia', 'Y', NULL, NULL),
(130, 'Svalbard and Jan Mayen', 'Y', NULL, NULL),
(131, 'Slovakia', 'Y', NULL, NULL),
(132, 'San Marino', 'Y', NULL, NULL),
(133, 'Senegal', 'Y', NULL, NULL),
(134, 'Somalia', 'Y', NULL, NULL),
(135, 'Suriname', 'Y', NULL, NULL),
(136, 'El Salvador', 'Y', NULL, NULL),
(137, 'Syria', 'Y', NULL, NULL),
(138, 'Swaziland', 'Y', NULL, NULL),
(139, 'Chad', 'Y', NULL, NULL),
(140, 'Turkmenistan', 'Y', NULL, NULL),
(141, 'French Southern Territories', 'Y', NULL, NULL),
(142, 'Thailand', 'Y', NULL, NULL),
(143, 'Tajikistan', 'Y', NULL, NULL),
(144, 'Tunisia', 'Y', NULL, NULL),
(145, 'Turkey', 'Y', NULL, NULL),
(146, 'Taiwan', 'Y', NULL, NULL),
(147, 'Tanzania', 'Y', NULL, NULL),
(148, 'Ukraine', 'Y', NULL, NULL),
(149, 'Uganda', 'Y', NULL, NULL),
(150, 'United States', 'Y', NULL, NULL),
(151, 'Uruguay', 'Y', NULL, NULL),
(152, 'Uzbekistan', 'Y', NULL, NULL),
(153, 'Vatican City', 'Y', NULL, NULL),
(154, 'Venezuela', 'Y', NULL, NULL),
(155, 'Vietnam', 'Y', NULL, NULL),
(156, 'Samoa', 'Y', NULL, NULL),
(157, 'Kosovo', 'Y', NULL, NULL),
(158, 'Yemen', 'Y', NULL, NULL),
(159, 'South Africa', 'Y', NULL, NULL),
(160, 'Zambia', 'Y', NULL, NULL),
(161, 'Zimbabwe', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` bigint UNSIGNED NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `district_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `state_id`, `district_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 15, 'Anantnag', 'Y', NULL, NULL),
(2, 15, 'Bandipore', 'Y', NULL, NULL),
(3, 15, 'Baramulla', 'Y', NULL, NULL),
(4, 15, 'Budgam', 'Y', NULL, NULL),
(5, 15, 'Doda', 'Y', NULL, NULL),
(6, 15, 'Ganderbal', 'Y', NULL, NULL),
(7, 15, 'Jammu', 'Y', NULL, NULL),
(8, 15, 'Kargil', 'Y', NULL, NULL),
(9, 15, 'Kathua', 'Y', NULL, NULL),
(10, 15, 'Kishtwar', 'Y', NULL, NULL),
(11, 15, 'Kulgam', 'Y', NULL, NULL),
(12, 15, 'Kupwara', 'Y', NULL, NULL),
(13, 15, 'Leh (Ladakh)', 'Y', NULL, NULL),
(14, 15, 'Poonch', 'Y', NULL, NULL),
(15, 15, 'Pulwama', 'Y', NULL, NULL),
(16, 15, 'Rajouri', 'Y', NULL, NULL),
(17, 15, 'Ramban', 'Y', NULL, NULL),
(18, 15, 'Reasi', 'Y', NULL, NULL),
(19, 15, 'Samba', 'Y', NULL, NULL),
(20, 15, 'Shopian', 'Y', NULL, NULL),
(21, 15, 'Srinagar', 'Y', NULL, NULL),
(22, 15, 'Udhampur', 'Y', NULL, NULL),
(23, 14, 'Bilaspur (Himachal Pradesh)', 'Y', NULL, NULL),
(24, 14, 'Chamba', 'Y', NULL, NULL),
(25, 14, 'Hamirpur (Himachal Pradesh)', 'Y', NULL, NULL),
(26, 14, 'Kangra', 'Y', NULL, NULL),
(27, 14, 'Kinnaur', 'Y', NULL, NULL),
(28, 14, 'Kullu', 'Y', NULL, NULL),
(29, 14, 'Lahul & Spiti', 'Y', NULL, NULL),
(30, 14, 'Mandi', 'Y', NULL, NULL),
(31, 14, 'Shimla', 'Y', NULL, NULL),
(32, 14, 'Sirmaur', 'Y', NULL, NULL),
(33, 14, 'Solan', 'Y', NULL, NULL),
(34, 14, 'Una', 'Y', NULL, NULL),
(35, 28, 'Amritsar', 'Y', NULL, NULL),
(36, 28, 'Barnala', 'Y', NULL, NULL),
(37, 28, 'Bathinda', 'Y', NULL, NULL),
(38, 28, 'Faridkot', 'Y', NULL, NULL),
(39, 28, 'Fatehgarh Sahib', 'Y', NULL, NULL),
(40, 28, 'Firozpur', 'Y', NULL, NULL),
(41, 28, 'Gurdaspur', 'Y', NULL, NULL),
(42, 28, 'Hoshiarpur', 'Y', NULL, NULL),
(43, 28, 'Jalandhar', 'Y', NULL, NULL),
(44, 28, 'Kapurthala', 'Y', NULL, NULL),
(45, 28, 'Ludhiana', 'Y', NULL, NULL),
(46, 28, 'Mansa', 'Y', NULL, NULL),
(47, 28, 'Moga', 'Y', NULL, NULL),
(48, 28, 'Muktsar', 'Y', NULL, NULL),
(49, 28, 'Patiala', 'Y', NULL, NULL),
(50, 28, 'Rupnagar (Ropar)', 'Y', NULL, NULL),
(51, 28, 'Sahibzada Ajit Singh Nagar (Mohali)', 'Y', NULL, NULL),
(52, 28, 'Sangrur', 'Y', NULL, NULL),
(53, 28, 'Shahid Bhagat Singh Nagar (Nawanshahr)', 'Y', NULL, NULL),
(54, 28, 'Tarn Taran', 'Y', NULL, NULL),
(55, 6, 'Chandigarh', 'Y', NULL, NULL),
(56, 34, 'Almora', 'Y', NULL, NULL),
(57, 34, 'Bageshwar', 'Y', NULL, NULL),
(58, 34, 'Chamoli', 'Y', NULL, NULL),
(59, 34, 'Champawat', 'Y', NULL, NULL),
(60, 34, 'Dehradun', 'Y', NULL, NULL),
(61, 34, 'Haridwar', 'Y', NULL, NULL),
(62, 34, 'Nainital', 'Y', NULL, NULL),
(63, 34, 'Pauri Garhwal', 'Y', NULL, NULL),
(64, 34, 'Pithoragarh', 'Y', NULL, NULL),
(65, 34, 'Rudraprayag', 'Y', NULL, NULL),
(66, 34, 'Tehri Garhwal', 'Y', NULL, NULL),
(67, 34, 'Udham Singh Nagar', 'Y', NULL, NULL),
(68, 34, 'Uttarkashi', 'Y', NULL, NULL),
(69, 13, 'Ambala', 'Y', NULL, NULL),
(70, 13, 'Bhiwani', 'Y', NULL, NULL),
(71, 13, 'Faridabad', 'Y', NULL, NULL),
(72, 13, 'Fatehabad', 'Y', NULL, NULL),
(73, 13, 'Gurgaon', 'Y', NULL, NULL),
(74, 13, 'Hisar', 'Y', NULL, NULL),
(75, 13, 'Jhajjar', 'Y', NULL, NULL),
(76, 13, 'Jind', 'Y', NULL, NULL),
(77, 13, 'Kaithal', 'Y', NULL, NULL),
(78, 13, 'Karnal', 'Y', NULL, NULL),
(79, 13, 'Kurukshetra', 'Y', NULL, NULL),
(80, 13, 'Mahendragarh', 'Y', NULL, NULL),
(81, 13, 'Mewat', 'Y', NULL, NULL),
(82, 13, 'Palwal', 'Y', NULL, NULL),
(83, 13, 'Panchkula', 'Y', NULL, NULL),
(84, 13, 'Panipat', 'Y', NULL, NULL),
(85, 13, 'Rewari', 'Y', NULL, NULL),
(86, 13, 'Rohtak', 'Y', NULL, NULL),
(87, 13, 'Sirsa', 'Y', NULL, NULL),
(88, 13, 'Sonipat', 'Y', NULL, NULL),
(89, 13, 'Yamuna Nagar', 'Y', NULL, NULL),
(90, 10, 'Central Delhi', 'Y', NULL, NULL),
(91, 10, 'East Delhi', 'Y', NULL, NULL),
(92, 10, 'New Delhi', 'Y', NULL, NULL),
(93, 10, 'North Delhi', 'Y', NULL, NULL),
(94, 10, 'North East Delhi', 'Y', NULL, NULL),
(95, 10, 'North West Delhi', 'Y', NULL, NULL),
(96, 10, 'South Delhi', 'Y', NULL, NULL),
(97, 10, 'South West Delhi', 'Y', NULL, NULL),
(98, 10, 'West Delhi', 'Y', NULL, NULL),
(99, 29, 'Ajmer', 'Y', NULL, NULL),
(100, 29, 'Alwar', 'Y', NULL, NULL),
(101, 29, 'Banswara', 'Y', NULL, NULL),
(102, 29, 'Baran', 'Y', NULL, NULL),
(103, 29, 'Barmer', 'Y', NULL, NULL),
(104, 29, 'Bharatpur', 'Y', NULL, NULL),
(105, 29, 'Bhilwara', 'Y', NULL, NULL),
(106, 29, 'Bikaner', 'Y', NULL, NULL),
(107, 29, 'Bundi', 'Y', NULL, NULL),
(108, 29, 'Chittorgarh', 'Y', NULL, NULL),
(109, 29, 'Churu', 'Y', NULL, NULL),
(110, 29, 'Dausa', 'Y', NULL, NULL),
(111, 29, 'Dholpur', 'Y', NULL, NULL),
(112, 29, 'Dungarpur', 'Y', NULL, NULL),
(113, 29, 'Ganganagar', 'Y', NULL, NULL),
(114, 29, 'Hanumangarh', 'Y', NULL, NULL),
(115, 29, 'Jaipur', 'Y', NULL, NULL),
(116, 29, 'Jaisalmer', 'Y', NULL, NULL),
(117, 29, 'Jalor', 'Y', NULL, NULL),
(118, 29, 'Jhalawar', 'Y', NULL, NULL),
(119, 29, 'Jhunjhunu', 'Y', NULL, NULL),
(120, 29, 'Jodhpur', 'Y', NULL, NULL),
(121, 29, 'Karauli', 'Y', NULL, NULL),
(122, 29, 'Kota', 'Y', NULL, NULL),
(123, 29, 'Nagaur', 'Y', NULL, NULL),
(124, 29, 'Pali', 'Y', NULL, NULL),
(125, 29, 'Pratapgarh (Rajasthan)', 'Y', NULL, NULL),
(126, 29, 'Rajsamand', 'Y', NULL, NULL),
(127, 29, 'Sawai Madhopur', 'Y', NULL, NULL),
(128, 29, 'Sikar', 'Y', NULL, NULL),
(129, 29, 'Sirohi', 'Y', NULL, NULL),
(130, 29, 'Tonk', 'Y', NULL, NULL),
(131, 29, 'Udaipur', 'Y', NULL, NULL),
(132, 33, 'Agra', 'Y', NULL, NULL),
(133, 33, 'Aligarh', 'Y', NULL, NULL),
(134, 33, 'Allahabad', 'Y', NULL, NULL),
(135, 33, 'Ambedkar Nagar', 'Y', NULL, NULL),
(136, 33, 'Auraiya', 'Y', NULL, NULL),
(137, 33, 'Azamgarh', 'Y', NULL, NULL),
(138, 33, 'Bagpat', 'Y', NULL, NULL),
(139, 33, 'Bahraich', 'Y', NULL, NULL),
(140, 33, 'Ballia', 'Y', NULL, NULL),
(141, 33, 'Balrampur', 'Y', NULL, NULL),
(142, 33, 'Banda', 'Y', NULL, NULL),
(143, 33, 'Barabanki', 'Y', NULL, NULL),
(144, 33, 'Bareilly', 'Y', NULL, NULL),
(145, 33, 'Basti', 'Y', NULL, NULL),
(146, 33, 'Bijnor', 'Y', NULL, NULL),
(147, 33, 'Budaun', 'Y', NULL, NULL),
(148, 33, 'Bulandshahr', 'Y', NULL, NULL),
(149, 33, 'Chandauli', 'Y', NULL, NULL),
(150, 33, 'Chitrakoot', 'Y', NULL, NULL),
(151, 33, 'Deoria', 'Y', NULL, NULL),
(152, 33, 'Etah', 'Y', NULL, NULL),
(153, 33, 'Etawah', 'Y', NULL, NULL),
(154, 33, 'Faizabad', 'Y', NULL, NULL),
(155, 33, 'Farrukhabad', 'Y', NULL, NULL),
(156, 33, 'Fatehpur', 'Y', NULL, NULL),
(157, 33, 'Firozabad', 'Y', NULL, NULL),
(158, 33, 'Gautam Buddha Nagar', 'Y', NULL, NULL),
(159, 33, 'Ghaziabad', 'Y', NULL, NULL),
(160, 33, 'Ghazipur', 'Y', NULL, NULL),
(161, 33, 'Gonda', 'Y', NULL, NULL),
(162, 33, 'Gorakhpur', 'Y', NULL, NULL),
(163, 33, 'Hamirpur', 'Y', NULL, NULL),
(164, 33, 'Hardoi', 'Y', NULL, NULL),
(165, 33, 'Hathras', 'Y', NULL, NULL),
(166, 33, 'Jalaun', 'Y', NULL, NULL),
(167, 33, 'Jaunpur', 'Y', NULL, NULL),
(168, 33, 'Jhansi', 'Y', NULL, NULL),
(169, 33, 'Jyotiba Phule Nagar', 'Y', NULL, NULL),
(170, 33, 'Kannauj', 'Y', NULL, NULL),
(171, 33, 'Kanpur Dehat', 'Y', NULL, NULL),
(172, 33, 'Kanpur Nagar', 'Y', NULL, NULL),
(173, 33, 'Kanshiram Nagar', 'Y', NULL, NULL),
(174, 33, 'Kaushambi', 'Y', NULL, NULL),
(175, 33, 'Kheri', 'Y', NULL, NULL),
(176, 33, 'Kushinagar', 'Y', NULL, NULL),
(177, 33, 'Lalitpur', 'Y', NULL, NULL),
(178, 33, 'Lucknow', 'Y', NULL, NULL),
(179, 33, 'Maharajganj', 'Y', NULL, NULL),
(180, 33, 'Mahoba', 'Y', NULL, NULL),
(181, 33, 'Mainpuri', 'Y', NULL, NULL),
(182, 33, 'Mathura', 'Y', NULL, NULL),
(183, 33, 'Mau', 'Y', NULL, NULL),
(184, 33, 'Meerut', 'Y', NULL, NULL),
(185, 33, 'Mirzapur', 'Y', NULL, NULL),
(186, 33, 'Moradabad', 'Y', NULL, NULL),
(187, 33, 'Muzaffarnagar', 'Y', NULL, NULL),
(188, 33, 'Pilibhit', 'Y', NULL, NULL),
(189, 33, 'Pratapgarh', 'Y', NULL, NULL),
(190, 33, 'Rae Bareli', 'Y', NULL, NULL),
(191, 33, 'Rampur', 'Y', NULL, NULL),
(192, 33, 'Saharanpur', 'Y', NULL, NULL),
(193, 33, 'Sant Kabir Nagar', 'Y', NULL, NULL),
(194, 33, 'Sant Ravidas Nagar (Bhadohi)', 'Y', NULL, NULL),
(195, 33, 'Shahjahanpur', 'Y', NULL, NULL),
(196, 33, 'Shrawasti', 'Y', NULL, NULL),
(197, 33, 'Siddharthnagar', 'Y', NULL, NULL),
(198, 33, 'Sitapur', 'Y', NULL, NULL),
(199, 33, 'Sonbhadra', 'Y', NULL, NULL),
(200, 33, 'Sultanpur', 'Y', NULL, NULL),
(201, 33, 'Unnao', 'Y', NULL, NULL),
(202, 33, 'Varanasi', 'Y', NULL, NULL),
(203, 5, 'Araria', 'Y', NULL, NULL),
(204, 5, 'Arwal', 'Y', NULL, NULL),
(205, 5, 'Aurangabad (Bihar)', 'Y', NULL, NULL),
(206, 5, 'Banka', 'Y', NULL, NULL),
(207, 5, 'Begusarai', 'Y', NULL, NULL),
(208, 5, 'Bhagalpur', 'Y', NULL, NULL),
(209, 5, 'Bhojpur', 'Y', NULL, NULL),
(210, 5, 'Buxar', 'Y', NULL, NULL),
(211, 5, 'Darbhanga', 'Y', NULL, NULL),
(212, 5, 'East Champaran', 'Y', NULL, NULL),
(213, 5, 'Gaya', 'Y', NULL, NULL),
(214, 5, 'Gopalganj', 'Y', NULL, NULL),
(215, 5, 'Jamui', 'Y', NULL, NULL),
(216, 5, 'Jehanabad', 'Y', NULL, NULL),
(217, 5, 'Kaimur (Bhabua)', 'Y', NULL, NULL),
(218, 5, 'Katihar', 'Y', NULL, NULL),
(219, 5, 'Khagaria', 'Y', NULL, NULL),
(220, 5, 'Kishanganj', 'Y', NULL, NULL),
(221, 5, 'Lakhisarai', 'Y', NULL, NULL),
(222, 5, 'Madhepura', 'Y', NULL, NULL),
(223, 5, 'Madhubani', 'Y', NULL, NULL),
(224, 5, 'Munger', 'Y', NULL, NULL),
(225, 5, 'Muzaffarpur', 'Y', NULL, NULL),
(226, 5, 'Nalanda', 'Y', NULL, NULL),
(227, 5, 'Nawada', 'Y', NULL, NULL),
(228, 5, 'Patna', 'Y', NULL, NULL),
(229, 5, 'Purnia', 'Y', NULL, NULL),
(230, 5, 'Rohtas', 'Y', NULL, NULL),
(231, 5, 'Saharsa', 'Y', NULL, NULL),
(232, 5, 'Samastipur', 'Y', NULL, NULL),
(233, 5, 'Saran', 'Y', NULL, NULL),
(234, 5, 'Sheikhpura', 'Y', NULL, NULL),
(235, 5, 'Sheohar', 'Y', NULL, NULL),
(236, 5, 'Sitamarhi', 'Y', NULL, NULL),
(237, 5, 'Siwan', 'Y', NULL, NULL),
(238, 5, 'Supaul', 'Y', NULL, NULL),
(239, 5, 'Vaishali', 'Y', NULL, NULL),
(240, 5, 'West Champaran', 'Y', NULL, NULL),
(241, 30, 'East Sikkim', 'Y', NULL, NULL),
(242, 30, 'North Sikkim', 'Y', NULL, NULL),
(243, 30, 'South Sikkim', 'Y', NULL, NULL),
(244, 30, 'West Sikkim', 'Y', NULL, NULL),
(245, 3, 'Anjaw', 'Y', NULL, NULL),
(246, 3, 'Changlang', 'Y', NULL, NULL),
(247, 3, 'Dibang Valley', 'Y', NULL, NULL),
(248, 3, 'East Kameng', 'Y', NULL, NULL),
(249, 3, 'East Siang', 'Y', NULL, NULL),
(250, 3, 'Kurung Kumey', 'Y', NULL, NULL),
(251, 3, 'Lohit', 'Y', NULL, NULL),
(252, 3, 'Lower Dibang Valley', 'Y', NULL, NULL),
(253, 3, 'Lower Subansiri', 'Y', NULL, NULL),
(254, 3, 'Papum Pare', 'Y', NULL, NULL),
(255, 3, 'Tawang', 'Y', NULL, NULL),
(256, 3, 'Tirap', 'Y', NULL, NULL),
(257, 3, 'Upper Siang', 'Y', NULL, NULL),
(258, 3, 'Upper Subansiri', 'Y', NULL, NULL),
(259, 3, 'West Kameng', 'Y', NULL, NULL),
(260, 3, 'West Siang', 'Y', NULL, NULL),
(261, 25, 'Dimapur', 'Y', NULL, NULL),
(262, 25, 'Kiphire', 'Y', NULL, NULL),
(263, 25, 'Kohima', 'Y', NULL, NULL),
(264, 25, 'Longleng', 'Y', NULL, NULL),
(265, 25, 'Mokokchung', 'Y', NULL, NULL),
(266, 25, 'Mon', 'Y', NULL, NULL),
(267, 25, 'Peren', 'Y', NULL, NULL),
(268, 25, 'Phek', 'Y', NULL, NULL),
(269, 25, 'Tuensang', 'Y', NULL, NULL),
(270, 25, 'Wokha', 'Y', NULL, NULL),
(271, 25, 'Zunheboto', 'Y', NULL, NULL),
(272, 22, 'Bishnupur', 'Y', NULL, NULL),
(273, 22, 'Chandel', 'Y', NULL, NULL),
(274, 22, 'Churachandpur', 'Y', NULL, NULL),
(275, 22, 'Imphal East', 'Y', NULL, NULL),
(276, 22, 'Imphal West', 'Y', NULL, NULL),
(277, 22, 'Senapati', 'Y', NULL, NULL),
(278, 22, 'Tamenglong', 'Y', NULL, NULL),
(279, 22, 'Thoubal', 'Y', NULL, NULL),
(280, 22, 'Ukhrul', 'Y', NULL, NULL),
(281, 24, 'Aizawl', 'Y', NULL, NULL),
(282, 24, 'Champhai', 'Y', NULL, NULL),
(283, 24, 'Kolasib', 'Y', NULL, NULL),
(284, 24, 'Lawngtlai', 'Y', NULL, NULL),
(285, 24, 'Lunglei', 'Y', NULL, NULL),
(286, 24, 'Mamit', 'Y', NULL, NULL),
(287, 24, 'Saiha', 'Y', NULL, NULL),
(288, 24, 'Serchhip', 'Y', NULL, NULL),
(289, 32, 'Dhalai', 'Y', NULL, NULL),
(290, 32, 'North Tripura', 'Y', NULL, NULL),
(291, 32, 'South Tripura', 'Y', NULL, NULL),
(292, 32, 'West Tripura', 'Y', NULL, NULL),
(293, 23, 'East Garo Hills', 'Y', NULL, NULL),
(294, 23, 'East Khasi Hills', 'Y', NULL, NULL),
(295, 23, 'Jaintia Hills', 'Y', NULL, NULL),
(296, 23, 'Ri Bhoi', 'Y', NULL, NULL),
(297, 23, 'South Garo Hills', 'Y', NULL, NULL),
(298, 23, 'West Garo Hills', 'Y', NULL, NULL),
(299, 23, 'West Khasi Hills', 'Y', NULL, NULL),
(300, 4, 'Baksa', 'Y', NULL, NULL),
(301, 4, 'Barpeta', 'Y', NULL, NULL),
(302, 4, 'Bongaigaon', 'Y', NULL, NULL),
(303, 4, 'Cachar', 'Y', NULL, NULL),
(304, 4, 'Chirang', 'Y', NULL, NULL),
(305, 4, 'Darrang', 'Y', NULL, NULL),
(306, 4, 'Dhemaji', 'Y', NULL, NULL),
(307, 4, 'Dhubri', 'Y', NULL, NULL),
(308, 4, 'Dibrugarh', 'Y', NULL, NULL),
(309, 4, 'Dima Hasao (North Cachar Hills)', 'Y', NULL, NULL),
(310, 4, 'Goalpara', 'Y', NULL, NULL),
(311, 4, 'Golaghat', 'Y', NULL, NULL),
(312, 4, 'Hailakandi', 'Y', NULL, NULL),
(313, 4, 'Jorhat', 'Y', NULL, NULL),
(314, 4, 'Kamrup', 'Y', NULL, NULL),
(315, 4, 'Kamrup Metropolitan', 'Y', NULL, NULL),
(316, 4, 'Karbi Anglong', 'Y', NULL, NULL),
(317, 4, 'Karimganj', 'Y', NULL, NULL),
(318, 4, 'Kokrajhar', 'Y', NULL, NULL),
(319, 4, 'Lakhimpur', 'Y', NULL, NULL),
(320, 4, 'Morigaon', 'Y', NULL, NULL),
(321, 4, 'Nagaon', 'Y', NULL, NULL),
(322, 4, 'Nalbari', 'Y', NULL, NULL),
(323, 4, 'Sivasagar', 'Y', NULL, NULL),
(324, 4, 'Sonitpur', 'Y', NULL, NULL),
(325, 4, 'Tinsukia', 'Y', NULL, NULL),
(326, 4, 'Udalguri', 'Y', NULL, NULL),
(327, 35, 'Bankura', 'Y', NULL, NULL),
(328, 35, 'Bardhaman', 'Y', NULL, NULL),
(329, 35, 'Birbhum', 'Y', NULL, NULL),
(330, 35, 'Cooch Behar', 'Y', NULL, NULL),
(331, 35, 'Dakshin Dinajpur (South Dinajpur)', 'Y', NULL, NULL),
(332, 35, 'Darjiling', 'Y', NULL, NULL),
(333, 35, 'Hooghly', 'Y', NULL, NULL),
(334, 35, 'Howrah', 'Y', NULL, NULL),
(335, 35, 'Jalpaiguri', 'Y', NULL, NULL),
(336, 35, 'Kolkata', 'Y', NULL, NULL),
(337, 35, 'Maldah', 'Y', NULL, NULL),
(338, 35, 'Murshidabad', 'Y', NULL, NULL),
(339, 35, 'Nadia', 'Y', NULL, NULL),
(340, 35, 'North 24 Parganas', 'Y', NULL, NULL),
(341, 35, 'Paschim Medinipur (West Midnapore)', 'Y', NULL, NULL),
(342, 35, 'Purba Medinipur (East Midnapore)', 'Y', NULL, NULL),
(343, 35, 'Puruliya', 'Y', NULL, NULL),
(344, 35, 'South 24 Parganas', 'Y', NULL, NULL),
(345, 35, 'Uttar Dinajpur (North Dinajpur)', 'Y', NULL, NULL),
(346, 16, 'Bokaro', 'Y', NULL, NULL),
(347, 16, 'Chatra', 'Y', NULL, NULL),
(348, 16, 'Deoghar', 'Y', NULL, NULL),
(349, 16, 'Dhanbad', 'Y', NULL, NULL),
(350, 16, 'Dumka', 'Y', NULL, NULL),
(351, 16, 'East Singhbhum', 'Y', NULL, NULL),
(352, 16, 'Garhwa', 'Y', NULL, NULL),
(353, 16, 'Giridih', 'Y', NULL, NULL),
(354, 16, 'Godda', 'Y', NULL, NULL),
(355, 16, 'Gumla', 'Y', NULL, NULL),
(356, 16, 'Hazaribagh', 'Y', NULL, NULL),
(357, 16, 'Jamtara', 'Y', NULL, NULL),
(358, 16, 'Khunti', 'Y', NULL, NULL),
(359, 16, 'Koderma', 'Y', NULL, NULL),
(360, 16, 'Latehar', 'Y', NULL, NULL),
(361, 16, 'Lohardaga', 'Y', NULL, NULL),
(362, 16, 'Pakur', 'Y', NULL, NULL),
(363, 16, 'Palamu', 'Y', NULL, NULL),
(364, 16, 'Ramgarh', 'Y', NULL, NULL),
(365, 16, 'Ranchi', 'Y', NULL, NULL),
(366, 16, 'Sahibganj', 'Y', NULL, NULL),
(367, 16, 'Seraikela-Kharsawan', 'Y', NULL, NULL),
(368, 16, 'Simdega', 'Y', NULL, NULL),
(369, 16, 'West Singhbhum', 'Y', NULL, NULL),
(370, 26, 'Angul', 'Y', NULL, NULL),
(371, 26, 'Balangir', 'Y', NULL, NULL),
(372, 26, 'Baleswar', 'Y', NULL, NULL),
(373, 26, 'Bargarh', 'Y', NULL, NULL),
(374, 26, 'Bhadrak', 'Y', NULL, NULL),
(375, 26, 'Boudh', 'Y', NULL, NULL),
(376, 26, 'Cuttack', 'Y', NULL, NULL),
(377, 26, 'Debagarh', 'Y', NULL, NULL),
(378, 26, 'Dhenkanal', 'Y', NULL, NULL),
(379, 26, 'Gajapati', 'Y', NULL, NULL),
(380, 26, 'Ganjam', 'Y', NULL, NULL),
(381, 26, 'Jagatsinghapur', 'Y', NULL, NULL),
(382, 26, 'Jajapur', 'Y', NULL, NULL),
(383, 26, 'Jharsuguda', 'Y', NULL, NULL),
(384, 26, 'Kalahandi', 'Y', NULL, NULL),
(385, 26, 'Kandhamal', 'Y', NULL, NULL),
(386, 26, 'Kendrapara', 'Y', NULL, NULL),
(387, 26, 'Kendujhar', 'Y', NULL, NULL),
(388, 26, 'Khordha', 'Y', NULL, NULL),
(389, 26, 'Koraput', 'Y', NULL, NULL),
(390, 26, 'Malkangiri', 'Y', NULL, NULL),
(391, 26, 'Mayurbhanj', 'Y', NULL, NULL),
(392, 26, 'Nabarangapur', 'Y', NULL, NULL),
(393, 26, 'Nayagarh', 'Y', NULL, NULL),
(394, 26, 'Nuapada', 'Y', NULL, NULL),
(395, 26, 'Puri', 'Y', NULL, NULL),
(396, 26, 'Rayagada', 'Y', NULL, NULL),
(397, 26, 'Sambalpur', 'Y', NULL, NULL),
(398, 26, 'Subarnapur (Sonapur)', 'Y', NULL, NULL),
(399, 26, 'Sundergarh', 'Y', NULL, NULL),
(400, 7, 'Bastar', 'Y', NULL, NULL),
(401, 7, 'Bijapur (Chhattisgarh)', 'Y', NULL, NULL),
(402, 7, 'Bilaspur (Chhattisgarh)', 'Y', NULL, NULL),
(403, 7, 'Dakshin Bastar Dantewada', 'Y', NULL, NULL),
(404, 7, 'Dhamtari', 'Y', NULL, NULL),
(405, 7, 'Durg', 'Y', NULL, NULL),
(406, 7, 'Janjgir-Champa', 'Y', NULL, NULL),
(407, 7, 'Jashpur', 'Y', NULL, NULL),
(408, 7, 'Kabirdham (Kawardha)', 'Y', NULL, NULL),
(409, 7, 'Korba', 'Y', NULL, NULL),
(410, 7, 'Koriya', 'Y', NULL, NULL),
(411, 7, 'Mahasamund', 'Y', NULL, NULL),
(412, 7, 'Narayanpur', 'Y', NULL, NULL),
(413, 7, 'Raigarh (Chhattisgarh)', 'Y', NULL, NULL),
(414, 7, 'Raipur', 'Y', NULL, NULL),
(415, 7, 'Rajnandgaon', 'Y', NULL, NULL),
(416, 7, 'Surguja', 'Y', NULL, NULL),
(417, 7, 'Uttar Bastar Kanker', 'Y', NULL, NULL),
(418, 20, 'Alirajpur', 'Y', NULL, NULL),
(419, 20, 'Anuppur', 'Y', NULL, NULL),
(420, 20, 'Ashok Nagar', 'Y', NULL, NULL),
(421, 20, 'Balaghat', 'Y', NULL, NULL),
(422, 20, 'Barwani', 'Y', NULL, NULL),
(423, 20, 'Betul', 'Y', NULL, NULL),
(424, 20, 'Bhind', 'Y', NULL, NULL),
(425, 20, 'Bhopal', 'Y', NULL, NULL),
(426, 20, 'Burhanpur', 'Y', NULL, NULL),
(427, 20, 'Chhatarpur', 'Y', NULL, NULL),
(428, 20, 'Chhindwara', 'Y', NULL, NULL),
(429, 20, 'Damoh', 'Y', NULL, NULL),
(430, 20, 'Datia', 'Y', NULL, NULL),
(431, 20, 'Dewas', 'Y', NULL, NULL),
(432, 20, 'Dhar', 'Y', NULL, NULL),
(433, 20, 'Dindori', 'Y', NULL, NULL),
(434, 20, 'Guna', 'Y', NULL, NULL),
(435, 20, 'Gwalior', 'Y', NULL, NULL),
(436, 20, 'Harda', 'Y', NULL, NULL),
(437, 20, 'Hoshangabad', 'Y', NULL, NULL),
(438, 20, 'Indore', 'Y', NULL, NULL),
(439, 20, 'Jabalpur', 'Y', NULL, NULL),
(440, 20, 'Jhabua', 'Y', NULL, NULL),
(441, 20, 'Katni', 'Y', NULL, NULL),
(442, 20, 'Khandwa (East Nimar)', 'Y', NULL, NULL),
(443, 20, 'Khargone (West Nimar)', 'Y', NULL, NULL),
(444, 20, 'Mandla', 'Y', NULL, NULL),
(445, 20, 'Mandsaur', 'Y', NULL, NULL),
(446, 20, 'Morena', 'Y', NULL, NULL),
(447, 20, 'Narsinghpur', 'Y', NULL, NULL),
(448, 20, 'Neemuch', 'Y', NULL, NULL),
(449, 20, 'Panna', 'Y', NULL, NULL),
(450, 20, 'Raisen', 'Y', NULL, NULL),
(451, 20, 'Rajgarh', 'Y', NULL, NULL),
(452, 20, 'Ratlam', 'Y', NULL, NULL),
(453, 20, 'Rewa', 'Y', NULL, NULL),
(454, 20, 'Sagar', 'Y', NULL, NULL),
(455, 20, 'Satna', 'Y', NULL, NULL),
(456, 20, 'Sehore', 'Y', NULL, NULL),
(457, 20, 'Seoni', 'Y', NULL, NULL),
(458, 20, 'Shahdol', 'Y', NULL, NULL),
(459, 20, 'Shajapur', 'Y', NULL, NULL),
(460, 20, 'Sheopur', 'Y', NULL, NULL),
(461, 20, 'Shivpuri', 'Y', NULL, NULL),
(462, 20, 'Sidhi', 'Y', NULL, NULL),
(463, 20, 'Singrauli', 'Y', NULL, NULL),
(464, 20, 'Tikamgarh', 'Y', NULL, NULL),
(465, 20, 'Ujjain', 'Y', NULL, NULL),
(466, 20, 'Umaria', 'Y', NULL, NULL),
(467, 20, 'Vidisha', 'Y', NULL, NULL),
(468, 12, 'Ahmedabad', 'Y', NULL, NULL),
(469, 12, 'Amreli', 'Y', NULL, NULL),
(470, 12, 'Anand', 'Y', NULL, NULL),
(471, 12, 'Banaskantha', 'Y', NULL, NULL),
(472, 12, 'Bharuch', 'Y', NULL, NULL),
(473, 12, 'Bhavnagar', 'Y', NULL, NULL),
(474, 12, 'Dahod', 'Y', NULL, NULL),
(475, 12, 'Gandhi Nagar', 'Y', NULL, NULL),
(476, 12, 'Jamnagar', 'Y', NULL, NULL),
(477, 12, 'Junagadh', 'Y', NULL, NULL),
(478, 12, 'Kachchh', 'Y', NULL, NULL),
(479, 12, 'Kheda', 'Y', NULL, NULL),
(480, 12, 'Mahesana', 'Y', NULL, NULL),
(481, 12, 'Narmada', 'Y', NULL, NULL),
(482, 12, 'Navsari', 'Y', NULL, NULL),
(483, 12, 'Panch Mahals', 'Y', NULL, NULL),
(484, 12, 'Patan', 'Y', NULL, NULL),
(485, 12, 'Porbandar', 'Y', NULL, NULL),
(486, 12, 'Rajkot', 'Y', NULL, NULL),
(487, 12, 'Sabarkantha', 'Y', NULL, NULL),
(488, 12, 'Surat', 'Y', NULL, NULL),
(489, 12, 'Surendra Nagar', 'Y', NULL, NULL),
(490, 12, 'Tapi', 'Y', NULL, NULL),
(491, 12, 'The Dangs', 'Y', NULL, NULL),
(492, 12, 'Vadodara', 'Y', NULL, NULL),
(493, 12, 'Valsad', 'Y', NULL, NULL),
(494, 9, 'Daman', 'Y', NULL, NULL),
(495, 9, 'Diu', 'Y', NULL, NULL),
(496, 8, 'Dadra & Nagar Haveli', 'Y', NULL, NULL),
(497, 21, 'Ahmed Nagar', 'Y', NULL, NULL),
(498, 21, 'Akola', 'Y', NULL, NULL),
(499, 21, 'Amravati', 'Y', NULL, NULL),
(500, 21, 'Aurangabad', 'Y', NULL, NULL),
(501, 21, 'Beed', 'Y', NULL, NULL),
(502, 21, 'Bhandara', 'Y', NULL, NULL),
(503, 21, 'Buldhana', 'Y', NULL, NULL),
(504, 21, 'Chandrapur', 'Y', NULL, NULL),
(505, 21, 'Dhule', 'Y', NULL, NULL),
(506, 21, 'Gadchiroli', 'Y', NULL, NULL),
(507, 21, 'Gondia', 'Y', NULL, NULL),
(508, 21, 'Hingoli', 'Y', NULL, NULL),
(509, 21, 'Jalgaon', 'Y', NULL, NULL),
(510, 21, 'Jalna', 'Y', NULL, NULL),
(511, 21, 'Kolhapur', 'Y', NULL, NULL),
(512, 21, 'Latur', 'Y', NULL, NULL),
(513, 21, 'Mumbai', 'Y', NULL, NULL),
(514, 21, 'Mumbai Suburban', 'Y', NULL, NULL),
(515, 21, 'Nagpur', 'Y', NULL, NULL),
(516, 21, 'Nanded', 'Y', NULL, NULL),
(517, 21, 'Nandurbar', 'Y', NULL, NULL),
(518, 21, 'Nashik', 'Y', NULL, NULL),
(519, 21, 'Osmanabad', 'Y', NULL, NULL),
(520, 21, 'Parbhani', 'Y', NULL, NULL),
(521, 21, 'Pune', 'Y', NULL, NULL),
(522, 21, 'Raigarh (Maharashtra)', 'Y', NULL, NULL),
(523, 21, 'Ratnagiri', 'Y', NULL, NULL),
(524, 21, 'Sangli', 'Y', NULL, NULL),
(525, 21, 'Satara', 'Y', NULL, NULL),
(526, 21, 'Sindhudurg', 'Y', NULL, NULL),
(527, 21, 'Solapur', 'Y', NULL, NULL),
(528, 21, 'Thane', 'Y', NULL, NULL),
(529, 21, 'Wardha', 'Y', NULL, NULL),
(530, 21, 'Washim', 'Y', NULL, NULL),
(531, 21, 'Yavatmal', 'Y', NULL, NULL),
(532, 2, 'Adilabad', 'Y', NULL, NULL),
(533, 2, 'Anantapur', 'Y', NULL, NULL),
(534, 2, 'Chittoor', 'Y', NULL, NULL),
(535, 2, 'East Godavari', 'Y', NULL, NULL),
(536, 2, 'Guntur', 'Y', NULL, NULL),
(537, 2, 'Hyderabad', 'Y', NULL, NULL),
(538, 2, 'Kadapa (Cuddapah)', 'Y', NULL, NULL),
(539, 2, 'Karim Nagar', 'Y', NULL, NULL),
(540, 2, 'Khammam', 'Y', NULL, NULL),
(541, 2, 'Krishna', 'Y', NULL, NULL),
(542, 2, 'Kurnool', 'Y', NULL, NULL),
(543, 2, 'Mahbubnagar', 'Y', NULL, NULL),
(544, 2, 'Medak', 'Y', NULL, NULL),
(545, 2, 'Nalgonda', 'Y', NULL, NULL),
(546, 2, 'Nellore', 'Y', NULL, NULL),
(547, 2, 'Nizamabad', 'Y', NULL, NULL),
(548, 2, 'Prakasam', 'Y', NULL, NULL),
(549, 2, 'Rangareddy', 'Y', NULL, NULL),
(550, 2, 'Srikakulam', 'Y', NULL, NULL),
(551, 2, 'Visakhapatnam', 'Y', NULL, NULL),
(552, 2, 'Vizianagaram', 'Y', NULL, NULL),
(553, 2, 'Warangal', 'Y', NULL, NULL),
(554, 2, 'West Godavari', 'Y', NULL, NULL),
(555, 17, 'Bagalkot', 'Y', NULL, NULL),
(556, 17, 'Bangalore', 'Y', NULL, NULL),
(557, 17, 'Bangalore Rural', 'Y', NULL, NULL),
(558, 17, 'Belgaum', 'Y', NULL, NULL),
(559, 17, 'Bellary', 'Y', NULL, NULL),
(560, 17, 'Bidar', 'Y', NULL, NULL),
(561, 17, 'Bijapur (Karnataka)', 'Y', NULL, NULL),
(562, 17, 'Chamrajnagar', 'Y', NULL, NULL),
(563, 17, 'Chickmagalur', 'Y', NULL, NULL),
(564, 17, 'Chikkaballapur', 'Y', NULL, NULL),
(565, 17, 'Chitradurga', 'Y', NULL, NULL),
(566, 17, 'Dakshina Kannada', 'Y', NULL, NULL),
(567, 17, 'Davanagere', 'Y', NULL, NULL),
(568, 17, 'Dharwad', 'Y', NULL, NULL),
(569, 17, 'Gadag', 'Y', NULL, NULL),
(570, 17, 'Gulbarga', 'Y', NULL, NULL),
(571, 17, 'Hassan', 'Y', NULL, NULL),
(572, 17, 'Haveri', 'Y', NULL, NULL),
(573, 17, 'Kodagu', 'Y', NULL, NULL),
(574, 17, 'Kolar', 'Y', NULL, NULL),
(575, 17, 'Koppal', 'Y', NULL, NULL),
(576, 17, 'Mandya', 'Y', NULL, NULL),
(577, 17, 'Mysore', 'Y', NULL, NULL),
(578, 17, 'Raichur', 'Y', NULL, NULL),
(579, 17, 'Ramanagara', 'Y', NULL, NULL),
(580, 17, 'Shimoga', 'Y', NULL, NULL),
(581, 17, 'Tumkur', 'Y', NULL, NULL),
(582, 17, 'Udupi', 'Y', NULL, NULL),
(583, 17, 'Uttara Kannada', 'Y', NULL, NULL),
(584, 17, 'Yadgir', 'Y', NULL, NULL),
(585, 11, 'North Goa', 'Y', NULL, NULL),
(586, 11, 'South Goa', 'Y', NULL, NULL),
(587, 19, 'Lakshadweep', 'Y', NULL, NULL),
(588, 18, 'Alappuzha', 'Y', NULL, NULL),
(589, 18, 'Ernakulam', 'Y', NULL, NULL),
(590, 18, 'Idukki', 'Y', NULL, NULL),
(591, 18, 'Kannur', 'Y', NULL, NULL),
(592, 18, 'Kasaragod', 'Y', NULL, NULL),
(593, 18, 'Kollam', 'Y', NULL, NULL),
(594, 18, 'Kottayam', 'Y', NULL, NULL),
(595, 18, 'Kozhikode', 'Y', NULL, NULL),
(596, 18, 'Malappuram', 'Y', NULL, NULL),
(597, 18, 'Palakkad', 'Y', NULL, NULL),
(598, 18, 'Pathanamthitta', 'Y', NULL, NULL),
(599, 18, 'Thiruvananthapuram', 'Y', NULL, NULL),
(600, 18, 'Thrissur', 'Y', NULL, NULL),
(601, 18, 'Wayanad', 'Y', NULL, NULL),
(602, 31, 'Ariyalur', 'Y', NULL, NULL),
(603, 31, 'Chennai', 'Y', NULL, NULL),
(604, 31, 'Coimbatore', 'Y', NULL, NULL),
(605, 31, 'Cuddalore', 'Y', NULL, NULL),
(606, 31, 'Dharmapuri', 'Y', NULL, NULL),
(607, 31, 'Dindigul', 'Y', NULL, NULL),
(608, 31, 'Erode', 'Y', NULL, NULL),
(609, 31, 'Kanchipuram', 'Y', NULL, NULL),
(610, 31, 'Kanyakumari', 'Y', NULL, NULL),
(611, 31, 'Karur', 'Y', NULL, NULL),
(612, 31, 'Krishnagiri', 'Y', NULL, NULL),
(613, 31, 'Madurai', 'Y', NULL, NULL),
(614, 31, 'Nagapattinam', 'Y', NULL, NULL),
(615, 31, 'Namakkal', 'Y', NULL, NULL),
(616, 31, 'Nilgiris', 'Y', NULL, NULL),
(617, 31, 'Perambalur', 'Y', NULL, NULL),
(618, 31, 'Pudukkottai', 'Y', NULL, NULL),
(619, 31, 'Ramanathapuram', 'Y', NULL, NULL),
(620, 31, 'Salem', 'Y', NULL, NULL),
(621, 31, 'Sivaganga', 'Y', NULL, NULL),
(622, 31, 'Thanjavur', 'Y', NULL, NULL),
(623, 31, 'Theni', 'Y', NULL, NULL),
(624, 31, 'Thoothukudi (Tuticorin)', 'Y', NULL, NULL),
(625, 31, 'Tiruchirappalli', 'Y', NULL, NULL),
(626, 31, 'Tirunelveli', 'Y', NULL, NULL),
(627, 31, 'Tiruppur', 'Y', NULL, NULL),
(628, 31, 'Tiruvallur', 'Y', NULL, NULL),
(629, 31, 'Tiruvannamalai', 'Y', NULL, NULL),
(630, 31, 'Tiruvarur', 'Y', NULL, NULL),
(631, 31, 'Vellore', 'Y', NULL, NULL),
(632, 31, 'Viluppuram', 'Y', NULL, NULL),
(633, 31, 'Virudhunagar', 'Y', NULL, NULL),
(634, 27, 'Karaikal', 'Y', NULL, NULL),
(635, 27, 'Mahe', 'Y', NULL, NULL),
(636, 27, 'Puducherry (Pondicherry)', 'Y', NULL, NULL),
(637, 27, 'Yanam', 'Y', NULL, NULL),
(638, 1, 'Nicobar', 'Y', NULL, NULL),
(639, 1, 'North And Middle Andaman', 'Y', NULL, NULL),
(640, 1, 'South Andaman', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `executives`
--

CREATE TABLE `executives` (
  `id` bigint UNSIGNED NOT NULL,
  `executive_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `executive_type` bigint UNSIGNED NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `executives`
--

INSERT INTO `executives` (`id`, `executive_name`, `executive_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ashwin', 2, 'Y', '2023-09-06 12:12:40', '2023-09-08 05:30:18'),
(2, 'Salman', 2, 'Y', '2023-09-06 12:12:40', '2023-09-06 12:12:40'),
(3, 'Anees', 2, 'Y', '2023-09-06 12:12:40', '2023-09-06 12:12:40'),
(4, 'Anees Khan', 1, 'Y', '2023-09-06 12:12:40', '2023-09-06 12:12:40'),
(5, 'Salman Khan', 1, 'Y', '2023-09-06 12:12:40', '2023-09-06 12:12:40'),
(6, 'Ashwin Raj', 1, 'Y', '2023-09-06 12:12:40', '2023-09-08 05:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logdetails`
--

CREATE TABLE `logdetails` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logdetails`
--

INSERT INTO `logdetails` (`id`, `user_id`, `ip_address`, `log_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hyzvinukumar@gmail.com', '192.168.56.1', '2023-09-15 04:57:52', 'Registration Success! hyzvinukumar@gmail.com register id : 2', '2023-09-15 04:57:52', '2023-09-15 04:57:52'),
(2, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-15 05:44:44', 'Registration Success! savinumtdm@gmail.com register id : 3', '2023-09-15 05:44:44', '2023-09-15 05:44:44'),
(3, 'hyzvinukumar@gmail.com', '192.168.56.1', '2023-09-15 08:22:02', 'Email ID Successfully Verified. Verified Email ID : hyzvinukumar@gmail.com User Reg ID 2', NULL, NULL),
(4, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-15 08:22:13', 'Email ID Successfully Verified. Verified Email ID : savinumtdm@gmail.com User Reg ID 3', NULL, NULL),
(5, 'rewrewrew@adfas.dafas', '192.168.56.1', '2023-09-16 08:07:38', 'Registration Success! rewrewrew@adfas.dafas register id : 4', '2023-09-16 08:07:38', '2023-09-16 08:07:38'),
(6, 'hyzsalmanulfaris@gmail.com', '192.168.56.1', '2023-09-16 08:37:47', 'Registration Success! hyzsalmanulfaris@gmail.com register id : 5', '2023-09-16 08:37:47', '2023-09-16 08:37:47'),
(7, 'hyzsalmanulfaris@gmail.com', '192.168.56.1', '2023-09-16 08:38:20', 'Successfully updated! hyzsalmanulfaris@gmail.com shop updated id : 5', '2023-09-16 08:38:20', '2023-09-16 08:38:20'),
(8, 'hyzvinukumar@gmail.com', '192.168.56.1', '2023-09-16 08:50:15', 'Successfully updated! hyzvinukumar@gmail.com shop updated id : 2', '2023-09-16 08:50:15', '2023-09-16 08:50:15'),
(9, 'ashwin@gmail.com', '192.168.56.1', '2023-09-16 08:52:34', 'Registration Success! ashwin@gmail.com register id : 6', '2023-09-16 08:52:34', '2023-09-16 08:52:34'),
(10, 'ashwin@gmail.com', '192.168.56.1', '2023-09-16 08:54:49', 'Successfully updated! ashwin@gmail.com shop updated id : 6', '2023-09-16 08:54:49', '2023-09-16 08:54:49'),
(11, 'rewrewrew@adfas.dafas', '192.168.56.1', '2023-09-16 08:57:28', 'Successfully updated! rewrewrew@adfas.dafas shop updated id : 4', '2023-09-16 08:57:28', '2023-09-16 08:57:28'),
(12, 'ashwin@gmail.com', '192.168.56.1', '2023-09-18 11:51:49', 'Successfully updated! ashwin@gmail.com shop updated id : 6', '2023-09-18 11:51:49', '2023-09-18 11:51:49'),
(13, 'rewrewrew@adfas.dafas', '192.168.56.1', '2023-09-21 09:41:25', 'Successfully updated! rewrewrew@adfas.dafas shop updated id : 4', '2023-09-21 09:41:25', '2023-09-21 09:41:25'),
(14, '1', '192.168.56.1', '2023-09-23 17:09:54', 'New Product Successfully added. product ID is :  8', '2023-09-23 17:09:55', '2023-09-23 17:09:55'),
(15, '1', '192.168.56.1', '2023-09-23 17:11:25', 'New Product Successfully added. product ID is :  9', '2023-09-23 17:11:26', '2023-09-23 17:11:26'),
(16, '1', '192.168.56.1', '2023-09-23 17:15:10', 'New Product Successfully added. product ID is :  1', '2023-09-23 17:15:10', '2023-09-23 17:15:10'),
(17, '1', '192.168.56.1', '2023-09-23 17:31:14', 'New Product Successfully added. product ID is :  2', '2023-09-23 17:31:15', '2023-09-23 17:31:15'),
(18, '1', '192.168.56.1', '2023-09-25 03:58:01', 'Deleted Image uploads/product_images/1695489310_jpeg', '2023-09-25 03:58:01', '2023-09-25 03:58:01'),
(19, '1', '192.168.56.1', '2023-09-25 03:58:49', 'Deleted Image uploads/product_images/1695489310_png', '2023-09-25 03:58:49', '2023-09-25 03:58:49'),
(20, '1', '192.168.56.1', '2023-09-25 03:59:25', 'Deleted Image uploads/product_images/1695490274_jpeg', '2023-09-25 03:59:25', '2023-09-25 03:59:25'),
(21, '1', '192.168.56.1', '2023-09-25 04:12:32', 'New Product Successfully added. product ID is :  1', '2023-09-25 04:12:32', '2023-09-25 04:12:32'),
(22, '1', '192.168.56.1', '2023-09-25 04:14:54', 'Deleted Image uploads/product_images/1695615152_jpg', '2023-09-25 04:14:54', '2023-09-25 04:14:54'),
(23, '1', '192.168.56.1', '2023-09-25 04:20:56', 'New Product Successfully added. product ID is :  1', '2023-09-25 04:20:57', '2023-09-25 04:20:57'),
(24, '1', '192.168.56.1', '2023-09-25 04:22:02', 'Deleted Image uploads/product_images/19197306171695615657_png', '2023-09-25 04:22:02', '2023-09-25 04:22:02'),
(25, '1', '192.168.56.1', '2023-09-25 05:18:59', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:18:59', '2023-09-25 05:18:59'),
(26, '1', '192.168.56.1', '2023-09-25 05:20:45', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:20:45', '2023-09-25 05:20:45'),
(27, '1', '192.168.56.1', '2023-09-25 05:33:14', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:33:14', '2023-09-25 05:33:14'),
(28, '1', '192.168.56.1', '2023-09-25 05:35:04', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:35:04', '2023-09-25 05:35:04'),
(29, '1', '192.168.56.1', '2023-09-25 05:43:52', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:43:52', '2023-09-25 05:43:52'),
(30, '1', '192.168.56.1', '2023-09-25 05:57:05', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:57:05', '2023-09-25 05:57:05'),
(31, '1', '192.168.56.1', '2023-09-25 05:57:45', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:57:45', '2023-09-25 05:57:45'),
(32, '1', '192.168.56.1', '2023-09-25 05:58:53', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 05:58:53', '2023-09-25 05:58:53'),
(33, '1', '192.168.56.1', '2023-09-25 06:00:31', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:00:31', '2023-09-25 06:00:31'),
(34, '1', '192.168.56.1', '2023-09-25 06:19:00', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:19:01', '2023-09-25 06:19:01'),
(35, '1', '192.168.56.1', '2023-09-25 06:19:44', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:19:44', '2023-09-25 06:19:44'),
(36, '1', '192.168.56.1', '2023-09-25 06:20:23', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:20:23', '2023-09-25 06:20:23'),
(37, '1', '192.168.56.1', '2023-09-25 06:21:49', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:21:49', '2023-09-25 06:21:49'),
(38, '1', '192.168.56.1', '2023-09-25 06:29:49', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:29:50', '2023-09-25 06:29:50'),
(39, '1', '192.168.56.1', '2023-09-25 06:59:13', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:59:13', '2023-09-25 06:59:13'),
(40, '1', '192.168.56.1', '2023-09-25 06:59:38', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 06:59:38', '2023-09-25 06:59:38'),
(41, '1', '192.168.56.1', '2023-09-25 07:04:25', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 07:04:25', '2023-09-25 07:04:25'),
(42, '1', '192.168.56.1', '2023-09-25 07:04:46', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 07:04:46', '2023-09-25 07:04:46'),
(43, '1', '192.168.56.1', '2023-09-25 07:13:03', 'New Product Successfully added. product ID is :  2', '2023-09-25 07:13:03', '2023-09-25 07:13:03'),
(44, '1', '192.168.56.1', '2023-09-25 07:22:20', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 07:22:20', '2023-09-25 07:22:20'),
(45, '1', '192.168.56.1', '2023-09-25 07:23:07', 'Product Successfully Updated. Updated product ID is :  2', '2023-09-25 07:23:07', '2023-09-25 07:23:07'),
(46, '1', '192.168.56.1', '2023-09-25 10:32:04', 'Product Successfully Updated. Updated product ID is :  2', '2023-09-25 10:32:04', '2023-09-25 10:32:04'),
(47, '1', '192.168.56.1', '2023-09-25 10:32:26', 'Product Successfully Updated. Updated product ID is :  2', '2023-09-25 10:32:26', '2023-09-25 10:32:26'),
(48, '1', '192.168.56.1', '2023-09-25 11:53:32', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 11:53:32', '2023-09-25 11:53:32'),
(49, '1', '192.168.56.1', '2023-09-25 12:00:20', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-25 12:00:20', '2023-09-25 12:00:20'),
(50, '1', '192.168.56.1', '2023-09-25 12:00:26', 'Product Successfully Updated. Updated product ID is :  2', '2023-09-25 12:00:26', '2023-09-25 12:00:26'),
(51, '1', '192.168.56.1', '2023-09-25 12:23:18', 'New Product Successfully added. product ID is :  3', '2023-09-25 12:23:18', '2023-09-25 12:23:18'),
(52, '1', '192.168.56.1', '2023-09-26 06:47:56', 'Successfully Approved! Approved id : #2#3', '2023-09-26 06:47:56', '2023-09-26 06:47:56'),
(53, '1', '192.168.56.1', '2023-09-26 06:48:02', 'Successfully Approved! Approved id : #3', '2023-09-26 06:48:02', '2023-09-26 06:48:02'),
(54, '1', '192.168.56.1', '2023-09-26 07:03:00', 'Successfully Approved! Approved id : #3', '2023-09-26 07:03:00', '2023-09-26 07:03:00'),
(55, '1', '192.168.56.1', '2023-09-26 07:03:34', 'Successfully Approved! Approved id : #1#2#3', '2023-09-26 07:03:34', '2023-09-26 07:03:34'),
(56, '1', '192.168.56.1', '2023-09-26 10:35:26', 'Successfully Approved! Approved id : #1#3', '2023-09-26 10:35:26', '2023-09-26 10:35:26'),
(57, '1', '192.168.56.1', '2023-09-26 10:35:39', 'Successfully Approved! Approved id : #1#2#3', '2023-09-26 10:35:39', '2023-09-26 10:35:39'),
(58, '1', '192.168.56.1', '2023-09-26 10:35:42', 'Successfully Approved! Approved id : #3', '2023-09-26 10:35:42', '2023-09-26 10:35:42'),
(59, '1', '192.168.56.1', '2023-09-26 10:36:29', 'Successfully Approved! Approved id : #3', '2023-09-26 10:36:29', '2023-09-26 10:36:29'),
(60, '1', '192.168.56.1', '2023-09-26 10:37:57', 'Successfully Approved! Approved id : #3', '2023-09-26 10:37:57', '2023-09-26 10:37:57'),
(61, '1', '192.168.56.1', '2023-09-26 10:39:25', 'Successfully Approved! Approved id : #1#3', '2023-09-26 10:39:25', '2023-09-26 10:39:25'),
(62, '1', '192.168.56.1', '2023-09-26 10:39:31', 'Successfully Approved! Approved id : #2#3', '2023-09-26 10:39:31', '2023-09-26 10:39:31'),
(63, '1', '192.168.56.1', '2023-09-26 10:40:12', 'Successfully Approved! Approved id : #1#2#3', '2023-09-26 10:40:12', '2023-09-26 10:40:12'),
(64, '1', '192.168.56.1', '2023-09-26 10:42:14', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-26 10:42:14', '2023-09-26 10:42:14'),
(65, '1', '192.168.56.1', '2023-09-26 10:49:43', 'Product Successfully Updated. Updated product ID is :  2', '2023-09-26 10:49:43', '2023-09-26 10:49:43'),
(66, '1', '192.168.56.1', '2023-09-26 11:20:55', 'Aprroved Status =  Y product approved id : 2', '2023-09-26 11:20:55', '2023-09-26 11:20:55'),
(67, '1', '192.168.56.1', '2023-09-26 11:21:10', 'Aprroved Status =  N product approved id : 2', '2023-09-26 11:21:10', '2023-09-26 11:21:10'),
(68, '1', '192.168.56.1', '2023-09-26 11:21:14', 'Successfully Approved! Approved id : #1#2#3', '2023-09-26 11:21:14', '2023-09-26 11:21:14'),
(69, '1', '192.168.56.1', '2023-09-26 11:21:37', 'Product Successfully Updated. Updated product ID is :  2', '2023-09-26 11:21:37', '2023-09-26 11:21:37'),
(70, 'hyzsandeep@gmail.com', '192.168.56.1', '2023-09-27 05:28:57', 'Registration Success! hyzsandeep@gmail.com register id : 7', '2023-09-27 05:28:57', '2023-09-27 05:28:57'),
(71, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 09:03:42', 'Registration Success! savinumtdm@gmail.com register id : 8', '2023-09-27 09:03:42', '2023-09-27 09:03:42'),
(72, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 09:17:49', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 09:17:49', '2023-09-27 09:17:49'),
(73, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 09:18:08', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 09:18:09', '2023-09-27 09:18:09'),
(74, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 09:25:18', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 09:25:18', '2023-09-27 09:25:18'),
(75, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 09:25:24', 'Aprroved Status =  Y shop updated id : 8', '2023-09-27 09:25:24', '2023-09-27 09:25:24'),
(76, 'hyzsandeep@gmail.com', '192.168.56.1', '2023-09-27 10:16:24', 'Registration Success! hyzsandeep@gmail.com register id : 9', '2023-09-27 10:16:24', '2023-09-27 10:16:24'),
(77, '1', '192.168.56.1', '2023-09-27 10:18:17', 'Deleted Image uploads/shopimages/1695809784_3_462.jpg', '2023-09-27 10:18:17', '2023-09-27 10:18:17'),
(78, '1', '192.168.56.1', '2023-09-27 10:18:53', 'Deleted Image uploads/shopimages/1695809784_3_168.png', '2023-09-27 10:18:53', '2023-09-27 10:18:53'),
(79, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 10:30:23', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 10:30:23', '2023-09-27 10:30:23'),
(80, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 10:30:42', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 10:30:42', '2023-09-27 10:30:42'),
(81, '1', '192.168.56.1', '2023-09-27 10:32:33', 'Deleted Image uploads/shopimages/1695805422_order_LKYt8Hv32rWL2O(1).png', '2023-09-27 10:32:33', '2023-09-27 10:32:33'),
(82, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 10:36:52', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 10:36:52', '2023-09-27 10:36:52'),
(83, '1', '192.168.56.1', '2023-09-27 10:42:18', 'Deleted Image uploads/shopimages/1695811012_3_393.png', '2023-09-27 10:42:18', '2023-09-27 10:42:18'),
(84, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-27 10:46:33', 'Successfully updated! savinumtdm@gmail.com shop updated id : 8', '2023-09-27 10:46:33', '2023-09-27 10:46:33'),
(85, '1', '192.168.56.1', '2023-09-27 10:46:43', 'Deleted Image uploads/shopimages/1695811593_4_41.png', '2023-09-27 10:46:43', '2023-09-27 10:46:43'),
(86, '1', '192.168.56.1', '2023-09-27 10:46:57', 'Successfully Approved! Approved id : #1#2#3', '2023-09-27 10:46:57', '2023-09-27 10:46:57'),
(87, 'hyzsandeep@gmail.com', '192.168.56.1', '2023-09-27 11:00:43', 'Shop Deleted =  hyzsandeep@gmail.com shop updated id : 9', '2023-09-27 11:00:43', '2023-09-27 11:00:43'),
(88, '1', '192.168.56.1', '2023-09-27 11:47:55', 'Product Deleted  product id : 3', '2023-09-27 11:47:55', '2023-09-27 11:47:55'),
(89, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-29 06:29:38', 'Email ID : savinumtdm@gmail.com User Reg ID 8 OTP is The OTP has been send to your registered mobile number, Your One Time Password is  : 153496', NULL, NULL),
(90, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-29 06:30:05', 'Mobile Number : 9042204905 User Reg ID 8 Verify OTP is 153496', NULL, NULL),
(91, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-29 06:30:28', 'Mobile Number : 9042204905 User Reg ID 8 OTP is The OTP has been send to your registered mobile number, Your One Time Password is  : 297564', NULL, NULL),
(92, 'savinumtdm@gmail.com', '192.168.56.1', '2023-09-29 06:30:38', 'Mobile Number : 9042204905 User Reg ID 8 Verify OTP is 297564', NULL, NULL),
(93, '1', '192.168.56.1', '2023-09-29 06:38:45', 'Successfully Approved! Approved id : #1#2', '2023-09-29 06:38:45', '2023-09-29 06:38:45'),
(94, '1', '192.168.56.1', '2023-09-29 08:37:32', 'New Product Successfully added. product ID is :  4', '2023-09-29 08:37:33', '2023-09-29 08:37:33'),
(95, '1', '192.168.56.1', '2023-09-29 08:45:33', 'Deleted Image uploads/product_images/5283416201695976653_png', '2023-09-29 08:45:33', '2023-09-29 08:45:33'),
(96, '1', '192.168.56.1', '2023-09-29 08:51:13', 'New Product Successfully added. product ID is :  5', '2023-09-29 08:51:13', '2023-09-29 08:51:13'),
(97, '1', '192.168.56.1', '2023-09-29 08:57:11', 'New Product Successfully added. product ID is :  6', '2023-09-29 08:57:11', '2023-09-29 08:57:11'),
(98, '1', '192.168.56.1', '2023-09-29 08:58:01', 'Product Successfully Updated. Updated product ID is :  6', '2023-09-29 08:58:01', '2023-09-29 08:58:01'),
(99, '1', '192.168.56.1', '2023-09-29 08:58:36', 'Product Successfully Updated. Updated product ID is :  1', '2023-09-29 08:58:36', '2023-09-29 08:58:36'),
(100, '1', '192.168.56.1', '2023-09-29 08:59:39', 'Deleted Image uploads/product_images/9628220911695615657_png', '2023-09-29 08:59:39', '2023-09-29 08:59:39'),
(101, '1', '192.168.56.1', '2023-09-29 09:03:16', 'Product Successfully Updated. Updated product ID is :  5', '2023-09-29 09:03:16', '2023-09-29 09:03:16'),
(102, '1', '192.168.56.1', '2023-09-29 09:04:05', 'New Product Successfully added. product ID is :  7', '2023-09-29 09:04:06', '2023-09-29 09:04:06'),
(103, '1', '192.168.56.1', '2023-09-29 09:04:18', 'Successfully Approved! Approved id : #1#2#4#5#6#7', '2023-09-29 09:04:18', '2023-09-29 09:04:18'),
(104, 'hyz@hyzfranchise.com', '192.168.56.1', '2023-09-29 10:52:04', 'Email ID : hyz@hyzfranchise.com User Reg ID 1 New Password is ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marital_statuses`
--

CREATE TABLE `marital_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `mr_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marital_statuses`
--

INSERT INTO `marital_statuses` (`id`, `mr_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Single', 'Y', NULL, NULL),
(2, 'Married', 'Y', NULL, NULL),
(3, 'Widowed', 'Y', NULL, NULL),
(4, 'Divorced', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_masters`
--

CREATE TABLE `menu_masters` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_level_1` bigint DEFAULT NULL,
  `menu_level_2` bigint DEFAULT NULL,
  `menu_level_3` bigint DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_masters`
--

INSERT INTO `menu_masters` (`id`, `menu_desc`, `menu_level_1`, `menu_level_2`, `menu_level_3`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Approvals', 1, 0, 0, '#', 1, NULL, NULL),
(2, 'Affiliate Approval', 1, 1, 0, 'affiliateapprovals', 0, NULL, NULL),
(3, 'Shop Approval', 1, 2, 0, 'shopapprovals/1', 1, NULL, NULL),
(4, 'Service Approval', 1, 3, 0, 'shopapprovals/2', 1, NULL, NULL),
(5, 'Category Approval', 1, 4, 0, 'listcategory', 1, NULL, NULL),
(6, 'User Details', 2, 0, 0, '#', 1, NULL, NULL),
(7, 'Add Role', 2, 1, 0, 'addrole', 1, NULL, NULL),
(8, 'Manage Roles', 2, 2, 0, 'getrole', 1, NULL, NULL),
(9, 'User Creation', 2, 3, 0, 'newuser', 1, NULL, NULL),
(10, 'User Menu Mapping', 2, 4, 0, 'usermenu', 1, NULL, NULL),
(11, 'Masters', 3, 0, 0, '#', 1, NULL, NULL),
(12, 'Business Type', 3, 1, 0, 'businesstype', 1, NULL, NULL),
(13, 'Shop Type', 3, 2, 0, 'shoptype', 1, NULL, NULL),
(14, 'Service Type', 3, 3, 0, 'servicetype', 1, NULL, NULL),
(15, 'Executives', 3, 4, 0, 'listexecutive', 1, NULL, NULL),
(16, 'Country', 3, 5, 0, 'listcountry', 1, NULL, NULL),
(17, 'State', 3, 6, 0, 'liststate', 1, NULL, NULL),
(18, 'District', 3, 7, 0, 'listdistrict', 1, NULL, NULL),
(19, 'Profession', 3, 8, 0, 'listprofession', 1, NULL, NULL),
(20, 'Religion', 3, 9, 0, 'listreligion', 1, NULL, NULL),
(21, 'Bank Type', 3, 10, 0, 'listbank', 1, NULL, NULL),
(22, 'Bank Branch', 3, 11, 0, 'listbank_branch', 1, NULL, NULL),
(23, 'Category', 3, 12, 0, 'listcategory', 0, NULL, NULL),
(24, 'Affiliate List', 4, 0, 0, '#', 0, NULL, NULL),
(25, 'Affiliate User List', 4, 1, 0, 'affiliatelist', 0, NULL, NULL),
(26, 'Affiliate Shops', 5, 0, 0, '#', 0, NULL, NULL),
(27, 'Affiliate User Shops', 5, 1, 0, 'affliateshops/1', 0, NULL, NULL),
(34, 'Role Menu Mapping', 2, 5, 0, 'rolemenu', 1, NULL, NULL),
(35, 'User Role Mapping', 2, 6, 0, 'userrole', 1, NULL, NULL),
(36, 'Affiliate User Services', 5, 1, 0, 'affliateshops/2', 0, NULL, NULL),
(37, 'Product Approval', 1, 5, 0, 'listshopproduct', 1, NULL, NULL),
(38, 'Change Password', 2, 7, 0, 'changepassword', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2023_08_11_045121_create_executives_table', 1),
(98, '2023_09_11_105214_create_product_attributes_table', 17),
(99, '2023_09_12_045200_create_attributes_table', 17),
(169, '2023_09_12_052017_create_product_attributes_table', 18),
(580, '2014_10_12_000000_create_users_table', 19),
(581, '2014_10_12_100000_create_password_reset_tokens_table', 19),
(582, '2019_08_19_000000_create_failed_jobs_table', 19),
(583, '2019_12_14_000001_create_personal_access_tokens_table', 19),
(584, '2023_08_09_070751_create_user_account_table', 19),
(585, '2023_08_09_113743_add_fields_to_user_account_table', 19),
(586, '2023_08_09_114953_add_fields_to_user_account_table', 19),
(587, '2023_08_09_120842_create_seller_details_table', 19),
(588, '2023_08_11_044151_add_fields_to_user_account_table', 19),
(589, '2023_08_11_044921_create_country_table', 19),
(590, '2023_08_11_044933_create_state_table', 19),
(591, '2023_08_11_044942_create_district_table', 19),
(592, '2023_08_11_045103_create_business_type_table', 19),
(593, '2023_08_11_084929_create_logdetails_table', 19),
(594, '2023_08_14_095932_create_otp_generate_table', 19),
(595, '2023_08_17_040353_create_roles_table', 19),
(596, '2023_08_17_052340_rename_user_type_in_user_account_table', 19),
(597, '2023_08_17_062508_create_affiliate_table', 19),
(598, '2023_08_17_084637_create_permissions_table', 19),
(599, '2023_08_17_085000_create_roles_permissions_table', 19),
(600, '2023_08_17_090847_add_fields_seller_details_table', 19),
(601, '2023_08_21_035715_add_fields_to_permissions_table', 19),
(602, '2023_08_21_114349_rename_field_name_table', 19),
(603, '2023_08_21_121347_create_shop_type_table', 19),
(604, '2023_08_21_121848_add_fields_to_affiliate_table', 19),
(605, '2023_08_22_045301_create_service_types_table', 19),
(606, '2023_08_22_061457_alter_table_affiliate_change_aadhar_file', 19),
(607, '2023_08_22_061811_alter_table_seller_details_change_shop_photo', 19),
(608, '2023_08_23_065406_create_site_modules_table', 19),
(609, '2023_08_23_072019_add_fields_affiliate_table', 19),
(610, '2023_08_23_085928_add_fields_seller_details_table', 19),
(611, '2023_08_23_090906_add_fields_affiliate_table', 19),
(612, '2023_08_23_104626_make_shop_reg_id_nullable_in_seller_details_table', 19),
(613, '2023_08_23_105059_make_affiliate_reg_id_nullable_in_affiliate_table', 19),
(614, '2023_08_23_123225_add_fields_to_permissions_table', 19),
(615, '2023_08_25_130510_add_fields_role_permissions_table', 19),
(616, '2023_08_31_064427_add_fields_to_affiliate_table', 19),
(617, '2023_08_31_065131_add_fields_to_seller_details_table', 19),
(618, '2023_09_01_085039_add_fields_to_seller_details', 19),
(619, '2023_09_01_100058_add_fields_roles_table', 19),
(620, '2023_09_04_071843_create_professions_table', 19),
(621, '2023_09_04_072001_create_marital_statuses_table', 19),
(622, '2023_09_04_072026_create_religions_table', 19),
(623, '2023_09_04_083502_create_bank_types_table', 19),
(624, '2023_09_04_083802_create_bank_details_table', 19),
(625, '2023_09_04_085133_add_fields_seller_details_table', 19),
(626, '2023_09_04_085440_add_fields_affiliate_table', 19),
(627, '2023_09_04_115848_add_fields_affiliate_table', 19),
(628, '2023_09_05_071341_add_fields_affiliate_table', 19),
(629, '2023_09_05_090919_add_fields_affiliate_table', 19),
(630, '2023_09_05_095413_alter_table_affiliate_change_registration_date', 19),
(631, '2023_09_05_100221_alter_table_affiliate_change_account_no', 19),
(632, '2023_09_06_063720_update_enum_in_table', 19),
(633, '2023_09_06_101003_create_executives_table', 19),
(634, '2023_09_06_125003_add_fields_executives_table', 19),
(635, '2023_09_08_062101_add_fields_to_seller_details_table', 19),
(636, '2023_09_08_062133_add_fields_to_affiliate_table', 19),
(637, '2023_09_08_064458_add_fields_to_seller_details_table', 19),
(638, '2023_09_08_064503_add_fields_to_affiliate_table', 19),
(639, '2023_09_08_124442_create_categories_table', 19),
(640, '2023_09_09_114459_drop_country_code_from_bank_details_table', 19),
(641, '2023_09_11_092543_add_status_to_category', 19),
(642, '2023_09_11_101911_add_slug_to_category', 19),
(643, '2023_09_11_104851_create_product_details_table', 19),
(644, '2023_09_12_045340_create_attributes_table', 19),
(645, '2023_09_12_090251_create_product_attributes_table', 19),
(646, '2023_09_12_102643_create_shop_offers_table', 19),
(647, '2023_09_13_051614_add_feilds_to_categories_table', 19),
(648, '2023_09_14_085059_create_menu_masters_table', 19),
(649, '2023_09_14_090032_create_user_pages_table', 19),
(650, '2023_09_14_090040_create_role_pages_table', 19),
(652, '2023_09_15_044309_add_fields_to_seller_details', 20),
(654, '2023_09_16_035834_create_role_pages_table', 21),
(656, '2023_09_20_065039_create_add_product_attributes_table', 22),
(658, '2023_09_20_070835_create_product_details_table', 23),
(685, '2023_09_13_101223_add_fields_to_categories_table', 24),
(686, '2023_09_14_051748_create_service_employees_table', 24),
(687, '2023_09_14_104254_add_image_fields_to_categories_table', 24),
(688, '2023_09_15_042920_change_field_name_in_categories_table', 24),
(689, '2023_09_15_072455_create_offers_table', 24),
(690, '2023_09_21_101832_add_field_type_to_categories_table', 24),
(691, '2023_09_21_105022_change_field_name_in_categories_table', 24),
(694, '2023_09_21_115717_drop_column_from_add_product_attributes_table', 25),
(697, '2023_09_21_120004_add_column_add_product_attributes_table', 26),
(699, '2023_09_25_092044_add_field_to_product_details_table', 27),
(700, '2023_09_26_045406_create_service_categories_table', 28),
(704, '2023_09_26_101619_create_individual_categories_table', 29),
(705, '2023_09_26_103020_create_shop_categories_table', 29),
(706, '2023_09_26_103027_create_company_categories_table', 29),
(708, '2023_09_26_122109_create_service_sub_categories_table', 30),
(710, '2023_09_26_124235_add_field_to_service_types_table', 31),
(714, '2023_09_27_043911_add_fields_to_seller_details_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 -> Shop ,2 -> Service',
  `offer_to_display` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditions` longtext COLLATE utf8mb4_unicode_ci,
  `from_date_time` datetime NOT NULL,
  `to_date_time` datetime NOT NULL,
  `offer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_generate`
--

CREATE TABLE `otp_generate` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otpmsgtype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_generate`
--

INSERT INTO `otp_generate` (`id`, `user_id`, `otpmsgtype`, `otp`, `created_time`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '8', '9042204905', '297564', '2023-09-29 06:29:38', '8', NULL, '2023-09-29 06:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_created_by` bigint UNSIGNED NOT NULL DEFAULT '0',
  `permission_last_updated_by` bigint UNSIGNED NOT NULL DEFAULT '0',
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `module_id` int NOT NULL DEFAULT '0',
  `is_disabled` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `permission_created_by`, `permission_last_updated_by`, `is_deleted`, `module_id`, `is_disabled`, `created_at`, `updated_at`) VALUES
(1, 'c_v_admin', 'Can View admin user', 0, 0, 0, 1, 0, NULL, NULL),
(2, 'c_a_admin', 'Can Add admin user', 0, 0, 0, 1, 0, NULL, NULL),
(3, 'c_e_admin', 'Can Edit admin user', 0, 0, 0, 1, 0, NULL, NULL),
(4, 'c_d_admin', 'Can Delete admin user', 0, 0, 0, 1, 1, NULL, NULL),
(5, 'c_v_role', 'Can View Role', 0, 0, 0, 2, 0, NULL, NULL),
(6, 'c_a_role', 'Can Add Role', 0, 0, 0, 2, 0, NULL, NULL),
(7, 'c_e_role', 'Can Edit Role', 0, 0, 0, 2, 0, NULL, NULL),
(8, 'c_d_role', 'Can Delete Role', 0, 0, 0, 2, 1, NULL, NULL),
(9, 'c_v_seller', 'Can View seller user', 0, 0, 0, 3, 0, NULL, NULL),
(10, 'c_a_seller', 'Can Add seller user', 0, 0, 0, 3, 0, NULL, NULL),
(11, 'c_e_seller', 'Can Edit seller user', 0, 0, 0, 3, 0, NULL, NULL),
(12, 'c_d_seller', 'Can Delete seller user', 0, 0, 0, 3, 1, NULL, NULL),
(13, 'c_v_affiliate', 'Can View affiliate user', 0, 0, 0, 4, 0, NULL, NULL),
(14, 'c_a_affiliate', 'Can Add affiliate user', 0, 0, 0, 4, 0, NULL, NULL),
(15, 'c_e_affiliate', 'Can Edit affiliate user', 0, 0, 0, 4, 0, NULL, NULL),
(16, 'c_d_affiliate', 'Can Delete affiliate user', 0, 0, 0, 4, 1, NULL, NULL),
(17, 'c_v_affiliate_coordinator', 'Can View affiliate_coordinator user', 0, 0, 0, 5, 0, NULL, NULL),
(18, 'c_a_affiliate_coordinator', 'Can Add affiliate_coordinator user', 0, 0, 0, 5, 0, NULL, NULL),
(19, 'c_e_affiliate_coordinator', 'Can Edit affiliate_coordinator user', 0, 0, 0, 5, 0, NULL, NULL),
(20, 'c_d_affiliate_coordinator', 'Can Delete affiliate_coordinator user', 0, 0, 0, 5, 1, NULL, NULL),
(21, 'c_v_hr', 'Can View hr user', 0, 0, 0, 6, 0, NULL, NULL),
(22, 'c_a_hr', 'Can Add hr user', 0, 0, 0, 6, 0, NULL, NULL),
(23, 'c_e_hr', 'Can Edit hr user', 0, 0, 0, 6, 0, NULL, NULL),
(24, 'c_d_hr', 'Can Delete hr user', 0, 0, 0, 6, 1, NULL, NULL),
(25, 'c_v_product_adding_executive', 'Can View product_adding_executive user', 0, 0, 0, 7, 0, NULL, NULL),
(26, 'c_a_product_adding_executive', 'Can Add product_adding_executive user', 0, 0, 0, 7, 0, NULL, NULL),
(27, 'c_e_product_adding_executive', 'Can Edit product_adding_executive user', 0, 0, 0, 7, 0, NULL, NULL),
(28, 'c_d_product_adding_executive', 'Can Delete product_adding_executive user', 0, 0, 0, 7, 1, NULL, NULL),
(29, 'c_v_shop_coordinator', 'Can View shop_coordinator user', 0, 0, 0, 8, 0, NULL, NULL),
(30, 'c_a_shop_coordinator', 'Can Add shop_coordinator user', 0, 0, 0, 8, 0, NULL, NULL),
(31, 'c_e_shop_coordinator', 'Can Edit shop_coordinator user', 0, 0, 0, 8, 0, NULL, NULL),
(32, 'c_d_shop_coordinator', 'Can Delete shop_coordinator user', 0, 0, 0, 8, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` int DEFAULT NULL,
  `product_attribute_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint UNSIGNED NOT NULL,
  `shop_id` int DEFAULT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_specification` longtext COLLATE utf8mb4_unicode_ci,
  `category_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description` longtext COLLATE utf8mb4_unicode_ci,
  `product_images` longtext COLLATE utf8mb4_unicode_ci,
  `product_videos` longtext COLLATE utf8mb4_unicode_ci,
  `product_document` longtext COLLATE utf8mb4_unicode_ci,
  `manufacture_details` longtext COLLATE utf8mb4_unicode_ci,
  `brand_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paying_mode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_stock` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_attribute` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `product_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `is_approved` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `approved_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `shop_id`, `product_name`, `product_specification`, `category_id`, `product_description`, `product_images`, `product_videos`, `product_document`, `manufacture_details`, `brand_name`, `paying_mode`, `product_stock`, `is_attribute`, `created_by`, `created_time`, `product_status`, `is_approved`, `approved_by`, `approved_time`, `created_at`, `updated_at`) VALUES
(1, 8, 'Shirts', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', '2', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element. These messages can provide insights into what might be causing the issue.\r\n\r\nCSS Styles: Check if any CSS styles applied to the video element or its parent containers are affecting its visibility. Make sure there are no conflicting CSS rules.\r\n\r\nJavaScript Interference: If you have JavaScript running on your page, ensure that it\'s not interfering with the video element. JavaScript errors or conflicts can prevent the video from loading.', '{\"fileval\":[\"uploads\\/product_images\\/17637368231695615657_png\",\"uploads\\/product_images\\/7328657481695615657_png\"]}', 'uploads/product_video/15270947701695615656.mp4', 'uploads/product_document/12333757151695615656.pdf', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', 'Zero Brand', 'cod', '50', 'Y', '1', '2023-09-25 04:20:56', 'Y', 'Y', '1', '2023-09-29 09:04:18', '2023-09-25 04:20:57', '2023-09-29 09:04:18'),
(2, 8, 'asfdsaf', 'safas', '2', 'fasfas', '{\"fileval\":[\"uploads\\/product_images\\/9836982331695625983_png\",\"uploads\\/product_images\\/18053288881695625983_jpeg\",\"uploads\\/product_images\\/4506114081695625983_jpeg\",\"uploads\\/product_images\\/16931029891695625983_jpeg\"]}', NULL, NULL, 'dfdsfd', 'fdsfds', 'shop', '10', 'Y', '1', '2023-09-25 07:13:03', 'Y', 'Y', '1', '2023-09-29 09:04:18', '2023-09-25 07:13:03', '2023-09-29 09:04:18'),
(4, 8, 'Pin Shirts', 'Browser Developer Tools: Open the browser\'s developer tools', '4', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\")', '{\"fileval\":[\"uploads\\/product_images\\/11548327321695976653_jpg\",\"uploads\\/product_images\\/9271681061695976653_png\"]}', 'uploads/product_video/5963417021695976652.mp4', 'uploads/product_document/8683049551695976652.pdf', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on', 'Zero Brand Sangi', 'cod', '50', 'Y', '1', '2023-09-29 08:37:32', 'Y', 'Y', '1', '2023-09-29 09:04:18', '2023-09-29 08:37:33', '2023-09-29 09:04:18'),
(5, 8, 'Jeens Pant', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', '5', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element. These messages can provide insights into what might be causing the issue.\r\n\r\nCSS Styles: Check if any CSS styles applied to the video element or its parent containers are affecting its visibility. Make sure there are no conflicting CSS rules.\r\n\r\nJavaScript Interference: If you have JavaScript running on your page, ensure that it\'s not interfering with the video element. JavaScript errors or conflicts can prevent the video from loading.', '{\"fileval\":[\"\",\"uploads\\/product_images\\/1695978196_jpg\"]}', NULL, NULL, 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', 'Zero Brand', 'cod', '50', 'Y', '1', '2023-09-29 08:51:13', 'Y', 'Y', '1', '2023-09-29 09:04:18', '2023-09-29 08:51:13', '2023-09-29 09:04:18'),
(6, 8, 'Shirts branded', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', '4', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element. These messages can provide insights into what might be causing the issue.\r\n\r\nCSS Styles: Check if any CSS styles applied to the video element or its parent containers are affecting its visibility. Make sure there are no conflicting CSS rules.\r\n\r\nJavaScript Interference: If you have JavaScript running on your page, ensure that it\'s not interfering with the video element. JavaScript errors or conflicts can prevent the video from loading.', '{\"fileval\":[\"uploads\\/product_images\\/19056886271695977831_png\",\"uploads\\/product_images\\/18630951471695977831_png\"]}', 'uploads/product_video/4805162991695977831.mp4', 'uploads/product_document/11661948741695977831.pdf', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', 'Zero Brand Freach', 'shop', '50', 'Y', '1', '2023-09-29 08:57:11', 'Y', 'Y', '1', '2023-09-29 09:04:18', '2023-09-29 08:57:11', '2023-09-29 09:04:18'),
(7, 8, 'Jeens Pant Shirts', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', '5', 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element. These messages can provide insights into what might be causing the issue.\r\n\r\nCSS Styles: Check if any CSS styles applied to the video element or its parent containers are affecting its visibility. Make sure there are no conflicting CSS rules.\r\n\r\nJavaScript Interference: If you have JavaScript running on your page, ensure that it\'s not interfering with the video element. JavaScript errors or conflicts can prevent the video from loading.', '{\"fileval\":[\"uploads\\/product_images\\/12224671641695978245_jpg\",\"uploads\\/product_images\\/17271049871695978245_jpg\",\"uploads\\/product_images\\/18174107471695978245_png\"]}', NULL, NULL, 'Browser Developer Tools: Open the browser\'s developer tools (usually accessible by pressing F12 or right-clicking on the page and selecting \"Inspect\" or \"Inspect Element\"). Check the Console tab for any error messages related to the video element.', 'Zero Brand', 'cod', '50', 'Y', '1', '2023-09-29 09:04:05', 'Y', 'Y', '1', '2023-09-29 09:04:18', '2023-09-29 09:04:05', '2023-09-29 09:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` bigint UNSIGNED NOT NULL,
  `profession_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `profession_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Doctor', 'Y', NULL, NULL),
(2, 'Engineer', 'Y', NULL, NULL),
(3, 'Others', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint UNSIGNED NOT NULL,
  `religion_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `religion_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Christian', 'Y', NULL, NULL),
(2, 'Hindu', 'Y', NULL, NULL),
(3, 'Muslim', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_created_by` bigint UNSIGNED NOT NULL DEFAULT '0',
  `role_last_updated_by` bigint UNSIGNED NOT NULL DEFAULT '0',
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0' COMMENT '0 -> Inactive ,1 -> Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_created_by`, `role_last_updated_by`, `is_deleted`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Super_admin', 0, 0, 0, NULL, NULL, 0),
(2, 'Seller', 0, 0, 0, NULL, NULL, 0),
(3, 'Affiliate', 0, 0, 0, NULL, NULL, 0),
(4, 'Customer', 0, 0, 0, NULL, NULL, 0),
(5, 'Affiliate_coordinator', 0, 0, 0, NULL, NULL, 0),
(6, 'Product_adding_executive', 0, 0, 0, NULL, NULL, 0),
(7, 'HR', 0, 0, 0, NULL, NULL, 0),
(8, 'Shop_coordinator', 0, 0, 0, NULL, NULL, 0),
(9, 'Services', 0, 0, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `rp_created_by` bigint UNSIGNED NOT NULL DEFAULT '0',
  `rp_last_updated_by` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_pages`
--

CREATE TABLE `role_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint DEFAULT NULL,
  `menu_id` bigint DEFAULT NULL,
  `privilage` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A-All Privilages,V-View Only',
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_pages`
--

INSERT INTO `role_pages` (`id`, `role_id`, `menu_id`, `privilage`, `updated_by`, `created_at`, `updated_at`) VALUES
(19, 1, 1, 'A', '1', NULL, NULL),
(20, 1, 2, 'A', '1', NULL, NULL),
(21, 1, 3, 'A', '1', NULL, NULL),
(22, 1, 4, 'A', '1', NULL, NULL),
(23, 1, 5, 'A', '1', NULL, NULL),
(24, 1, 6, 'A', '1', NULL, NULL),
(25, 1, 7, 'A', '1', NULL, NULL),
(26, 1, 8, 'A', '1', NULL, NULL),
(27, 1, 9, 'A', '1', NULL, NULL),
(28, 1, 10, 'A', '1', NULL, NULL),
(29, 1, 34, 'A', '1', NULL, NULL),
(30, 1, 35, 'A', '1', NULL, NULL),
(31, 1, 11, 'A', '1', NULL, NULL),
(32, 1, 12, 'A', '1', NULL, NULL),
(33, 1, 13, 'A', '1', NULL, NULL),
(34, 1, 14, 'A', '1', NULL, NULL),
(35, 1, 15, 'A', '1', NULL, NULL),
(36, 1, 16, 'A', '1', NULL, NULL),
(37, 1, 17, 'A', '1', NULL, NULL),
(38, 1, 18, 'A', '1', NULL, NULL),
(39, 1, 19, 'A', '1', NULL, NULL),
(40, 1, 20, 'A', '1', NULL, NULL),
(41, 1, 21, 'A', '1', NULL, NULL),
(42, 1, 22, 'A', '1', NULL, NULL),
(43, 1, 23, 'A', '1', NULL, NULL),
(44, 1, 24, 'A', '1', NULL, NULL),
(45, 1, 25, 'A', '1', NULL, NULL),
(46, 1, 26, 'A', '1', NULL, NULL),
(47, 1, 27, 'A', '1', NULL, NULL),
(48, 2, 1, 'A', '1', NULL, NULL),
(49, 2, 3, 'A', '1', NULL, NULL),
(50, 2, 37, 'A', '1', NULL, NULL),
(51, 2, 6, 'A', '1', NULL, NULL),
(52, 2, 38, 'A', '1', NULL, NULL),
(53, 2, 11, 'A', '1', NULL, NULL),
(54, 2, 15, 'A', '1', NULL, NULL),
(55, 2, 23, 'A', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_details`
--

CREATE TABLE `seller_details` (
  `id` bigint UNSIGNED NOT NULL,
  `shop_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_mobno` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_reg_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate_reg_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referal_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `busnes_type` int DEFAULT NULL,
  `shop_service_type` int DEFAULT NULL,
  `service_subcategory_id` int DEFAULT NULL,
  `shop_type` int DEFAULT NULL,
  `shop_executive` int DEFAULT NULL,
  `term_condition` int DEFAULT NULL,
  `shop_licence` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_gstno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_panno` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_name_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locality` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int DEFAULT NULL,
  `state` int DEFAULT NULL,
  `district` int DEFAULT NULL,
  `pincode` int DEFAULT NULL,
  `socialmedia` longtext COLLATE utf8mb4_unicode_ci,
  `manufactoring_details` longtext COLLATE utf8mb4_unicode_ci,
  `googlemap` longtext COLLATE utf8mb4_unicode_ci,
  `shop_photo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `establish_date` date DEFAULT NULL,
  `open_close_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `direct_affiliate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_affiliate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_coordinator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_approved` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_details`
--

INSERT INTO `seller_details` (`id`, `shop_name`, `owner_name`, `shop_email`, `shop_mobno`, `shop_reg_id`, `affiliate_reg_id`, `referal_id`, `busnes_type`, `shop_service_type`, `service_subcategory_id`, `shop_type`, `shop_executive`, `term_condition`, `shop_licence`, `shop_gstno`, `shop_panno`, `house_name_no`, `locality`, `village`, `country`, `state`, `district`, `pincode`, `socialmedia`, `manufactoring_details`, `googlemap`, `shop_photo`, `establish_date`, `open_close_time`, `registration_date`, `direct_affiliate`, `second_affiliate`, `shop_coordinator`, `user_id`, `parent_id`, `seller_approved`, `created_at`, `updated_at`) VALUES
(1, 'SUGATH SHOP', 'SANDEEP', 'savinumtdm@gmail.com', '9042204905', '100', NULL, NULL, 1, 4, 12, 4, 6, 1, 'ABS4234343', 'GSDS343423', 'GDET32432433', 'Kollakulam', 'Kodumkulam', 'Marthandam', 1, 31, 610, 629165, '{\"mediadets\":[{\"mediatype\":\"1\",\"mediaurl\":\"https:facebook.com\"},{\"mediatype\":\"2\",\"mediaurl\":\"https:\\/\\/instagam.com\"}]}', 'test', 'www.google.com', '{\"fileval\":[\"uploads\\/shopimages\\/1695805422_istockphoto-1337232523-1024x1024.jpg\",\"uploads\\/shopimages\\/1695805422_istockphoto-1414930624-1024x1024.jpg\",\"uploads\\/shopimages\\/1695811012_2_799.jpg\",\"uploads\\/shopimages\\/1695811012_3_168.png\",\"uploads\\/shopimages\\/1695811593_3_878.png\"]}', '2022-06-27', 'Mon 09:00 AM-Sat 06:00 PM', '2023-09-27', NULL, NULL, NULL, '8', NULL, 'Y', '2023-09-27 09:03:42', '2023-09-27 10:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `service_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type_id` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `service_category_name`, `business_type_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Individual', 2, 'Y', NULL, NULL),
(2, 'Shop', 2, 'Y', NULL, NULL),
(3, 'Companies & Organisations', 2, 'Y', NULL, NULL),
(4, 'Retail Shop', 1, 'Y', NULL, NULL),
(5, 'Manufactures', 1, 'Y', NULL, NULL),
(6, 'Wholesale Shops', 1, 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_employees`
--

CREATE TABLE `service_employees` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joining_date` date DEFAULT NULL,
  `aadhar_no` bigint DEFAULT NULL,
  `permanent_address` longtext COLLATE utf8mb4_unicode_ci,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` longtext COLLATE utf8mb4_unicode_ci,
  `present_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_sub_categories`
--

CREATE TABLE `service_sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_category_id` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_sub_categories`
--

INSERT INTO `service_sub_categories` (`id`, `sub_category_name`, `service_category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electrician', 1, 'Y', NULL, NULL),
(2, 'Plumber', 1, 'Y', NULL, NULL),
(3, 'Doctor', 1, 'Y', NULL, NULL),
(4, 'Advocate', 1, 'Y', NULL, NULL),
(5, 'Saloons', 2, 'Y', NULL, NULL),
(6, 'Tattoos', 2, 'Y', NULL, NULL),
(7, 'DTS', 2, 'Y', NULL, NULL),
(8, 'Advocate', 2, 'Y', NULL, NULL),
(9, 'Educational Consultancies', 3, 'Y', NULL, NULL),
(10, 'Legal Consultancies', 3, 'Y', NULL, NULL),
(11, 'Saloons', 4, 'Y', NULL, NULL),
(12, 'Tattoos', 4, 'Y', NULL, NULL),
(13, 'DTP', 4, 'Y', NULL, NULL),
(14, 'Manufacture demo', 5, 'Y', NULL, NULL),
(15, 'Manufacture test', 5, 'Y', NULL, NULL),
(16, 'wholesale shop demo', 6, 'Y', NULL, NULL),
(17, 'wholesale shop test', 6, 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_type_id` int DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `service_name`, `business_type_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Saloon', 2, 'Y', NULL, NULL),
(2, 'Tours and Travels', 2, 'Y', NULL, NULL),
(3, 'Supermarket', 1, 'Y', NULL, NULL),
(4, 'Toyshop', 1, 'Y', NULL, NULL),
(5, 'Electronics Shop', 1, 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_offers`
--

CREATE TABLE `shop_offers` (
  `id` bigint UNSIGNED NOT NULL,
  `offer_to_display` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditions` longtext COLLATE utf8mb4_unicode_ci,
  `from_date_time` datetime NOT NULL,
  `to_date_time` datetime NOT NULL,
  `offer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_type`
--

CREATE TABLE `shop_type` (
  `id` bigint UNSIGNED NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_type`
--

INSERT INTO `shop_type` (`id`, `shop_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Manufacturer', 'Y', '2023-09-13 05:07:08', '2023-09-13 10:03:29'),
(2, 'Wholesaler', 'Y', '2023-09-13 05:08:52', '2023-09-13 10:03:20'),
(3, 'Retailer', 'Y', '2023-09-13 05:09:01', '2023-09-13 05:09:01'),
(4, 'Distributor', 'Y', '2023-09-13 05:09:15', '2023-09-13 05:09:15'),
(5, 'Stockist', 'Y', '2023-09-13 05:09:27', '2023-09-13 05:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `site_modules`
--

CREATE TABLE `site_modules` (
  `id` bigint UNSIGNED NOT NULL,
  `module_title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_modules`
--

INSERT INTO `site_modules` (`id`, `module_title`, `module_description`, `module_order`, `created_at`, `updated_at`) VALUES
(1, 'all_admin_user', 'Admin User', 1, NULL, NULL),
(2, 'all_roles_perm', 'Roles & Permissions', 101, NULL, NULL),
(3, 'seller', 'Seller', 201, NULL, NULL),
(4, 'affiliate', 'Affiliate', 301, NULL, NULL),
(5, 'affiliate_coordinator', 'Affiliate Co-ordinator', 401, NULL, NULL),
(6, 'hr', 'HR', 501, NULL, NULL),
(7, 'product_adding_executive', 'Product adding executive', 601, NULL, NULL),
(8, 'shop coordinator', 'Shop Co-ordinator', 701, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `state_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `state_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Andaman & Nicobar Islands', 'Y', NULL, NULL),
(2, 1, 'Andhra Pradesh', 'Y', NULL, NULL),
(3, 1, 'Arunachal Pradesh', 'Y', NULL, NULL),
(4, 1, 'Assam', 'Y', NULL, NULL),
(5, 1, 'Bihar', 'Y', NULL, NULL),
(6, 1, 'Chandigarh', 'Y', NULL, NULL),
(7, 1, 'Chhattisgarh', 'Y', NULL, NULL),
(8, 1, 'Dadra & Nagar Haveli', 'Y', NULL, NULL),
(9, 1, 'Daman & Diu', 'Y', NULL, NULL),
(10, 1, 'Delhi', 'Y', NULL, NULL),
(11, 1, 'Goa', 'Y', NULL, NULL),
(12, 1, 'Gujarat', 'Y', NULL, NULL),
(13, 1, 'Haryana', 'Y', NULL, NULL),
(14, 1, 'Himachal Pradesh', 'Y', NULL, NULL),
(15, 1, 'Jammu & Kashmir', 'Y', NULL, NULL),
(16, 1, 'Jharkhand', 'Y', NULL, NULL),
(17, 1, 'Karnataka', 'Y', NULL, NULL),
(18, 1, 'Kerala', 'Y', NULL, NULL),
(19, 1, 'Lakshadweep', 'Y', NULL, NULL),
(20, 1, 'Madhya Pradesh', 'Y', NULL, NULL),
(21, 1, 'Maharashtra', 'Y', NULL, NULL),
(22, 1, 'Manipur', 'Y', NULL, NULL),
(23, 1, 'Meghalaya', 'Y', NULL, NULL),
(24, 1, 'Mizoram', 'Y', NULL, NULL),
(25, 1, 'Nagaland', 'Y', NULL, NULL),
(26, 1, 'Odisha', 'Y', NULL, NULL),
(27, 1, 'Puducherry', 'Y', NULL, NULL),
(28, 1, 'Punjab', 'Y', NULL, NULL),
(29, 1, 'Rajasthan', 'Y', NULL, NULL),
(30, 1, 'Sikkim', 'Y', NULL, NULL),
(31, 1, 'Tamil Nadu', 'Y', NULL, NULL),
(32, 1, 'Tripura', 'Y', NULL, NULL),
(33, 1, 'Uttar Pradesh', 'Y', NULL, NULL),
(34, 1, 'Uttarakhand', 'Y', NULL, NULL),
(35, 1, 'West Bengal', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobno` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `forgot_pass` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_date` date DEFAULT NULL,
  `approved` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `approved_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `mobile_verify` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `referal_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_house_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_locality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_dist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `name`, `email`, `mobno`, `password`, `user_status`, `forgot_pass`, `role_id`, `active_date`, `approved`, `approved_by`, `approved_at`, `ip`, `parent_id`, `email_verify`, `mobile_verify`, `referal_id`, `photo_file`, `user_dob`, `user_house_name`, `user_locality`, `user_city`, `user_country`, `user_state`, `user_dist`, `user_pincode`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'hyz@hyzfranchise.com', '9656912880', '$2y$10$1QlToo0WcaBFW32yOFVFC.X5eerK6anGuz3.3LvIZaEHF.2KHrNM6', 'Y', 'Shine@123', '1', '2023-09-15', 'Y', NULL, NULL, NULL, NULL, 'Y', 'Y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-15 04:31:04', '2023-09-29 10:52:04'),
(8, 'SUGATH SHOP', 'savinumtdm@gmail.com', '9042204905', '$2y$10$nn8zoEkxcBgPOsj.GoLnhet5XYNiZ1J3a93dArwaniRaaOEfYh9w6', 'Y', 'Shine@123', '2', NULL, 'Y', '1', '2023-09-27 09:25:24', '192.168.56.1', NULL, 'N', 'Y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-27 09:03:42', '2023-09-29 06:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_pages`
--

CREATE TABLE `user_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` bigint DEFAULT NULL,
  `privilage` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A-All Privilages,V-View Only',
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_pages`
--

INSERT INTO `user_pages` (`id`, `menu_id`, `user_id`, `user_role`, `privilage`, `updated_by`, `created_at`, `updated_at`) VALUES
(107, 1, '2', 2, 'A', '1', '2023-09-20 04:44:25', '2023-09-20 04:44:25'),
(108, 3, '2', 2, NULL, '1', '2023-09-20 04:44:25', '2023-09-20 04:44:25'),
(140, 1, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(141, 2, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(142, 3, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(143, 4, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(144, 5, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(145, 37, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(146, 6, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(147, 7, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(148, 8, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(149, 9, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(150, 10, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(151, 34, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(152, 35, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(153, 38, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(154, 11, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(155, 12, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(156, 13, '1', 1, 'A', '1', '2023-09-29 09:40:53', '2023-09-29 09:40:54'),
(157, 14, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(158, 15, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(159, 16, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(160, 17, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(161, 18, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(162, 19, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(163, 20, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(164, 21, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(165, 22, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(166, 23, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(167, 24, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(168, 25, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(169, 26, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(170, 27, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(171, 36, '1', 1, 'A', '1', '2023-09-29 09:40:54', '2023-09-29 09:40:54'),
(172, 1, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(173, 3, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(174, 37, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(175, 6, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(176, 38, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(177, 11, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(178, 15, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25'),
(179, 23, '8', 2, 'A', '1', '2023-09-29 10:56:25', '2023-09-29 10:56:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_product_attributes`
--
ALTER TABLE `add_product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate`
--
ALTER TABLE `affiliate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_types`
--
ALTER TABLE `bank_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_type`
--
ALTER TABLE `business_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `executives`
--
ALTER TABLE `executives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logdetails`
--
ALTER TABLE `logdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_masters`
--
ALTER TABLE `menu_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_generate`
--
ALTER TABLE `otp_generate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_permission_created_by_index` (`permission_created_by`),
  ADD KEY `permissions_permission_last_updated_by_index` (`permission_last_updated_by`),
  ADD KEY `permissions_module_id_index` (`module_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_name_category_id_index` (`product_name`,`category_id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_role_created_by_index` (`role_created_by`),
  ADD KEY `roles_role_last_updated_by_index` (`role_last_updated_by`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_permissions_rp_created_by_index` (`rp_created_by`),
  ADD KEY `roles_permissions_rp_last_updated_by_index` (`rp_last_updated_by`);

--
-- Indexes for table `role_pages`
--
ALTER TABLE `role_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_details`
--
ALTER TABLE `seller_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_employees`
--
ALTER TABLE `service_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_sub_categories`
--
ALTER TABLE `service_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_offers`
--
ALTER TABLE `shop_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_type`
--
ALTER TABLE `shop_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_modules`
--
ALTER TABLE `site_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_modules_module_title_index` (`module_title`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_account_email_unique` (`email`),
  ADD UNIQUE KEY `user_account_mobno_unique` (`mobno`);

--
-- Indexes for table `user_pages`
--
ALTER TABLE `user_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_product_attributes`
--
ALTER TABLE `add_product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `affiliate`
--
ALTER TABLE `affiliate`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_types`
--
ALTER TABLE `bank_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business_type`
--
ALTER TABLE `business_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=641;

--
-- AUTO_INCREMENT for table `executives`
--
ALTER TABLE `executives`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logdetails`
--
ALTER TABLE `logdetails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_masters`
--
ALTER TABLE `menu_masters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=715;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_generate`
--
ALTER TABLE `otp_generate`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_pages`
--
ALTER TABLE `role_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `seller_details`
--
ALTER TABLE `seller_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_employees`
--
ALTER TABLE `service_employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_sub_categories`
--
ALTER TABLE `service_sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_offers`
--
ALTER TABLE `shop_offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_type`
--
ALTER TABLE `shop_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site_modules`
--
ALTER TABLE `site_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_pages`
--
ALTER TABLE `user_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
