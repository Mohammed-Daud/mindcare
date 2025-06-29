-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 08:36 AM
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
-- Database: `mindcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `fee` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `coupon_code` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `meeting_room` varchar(255) DEFAULT NULL COMMENT 'Unique identifier for the virtual meeting room',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reschedule_count` int(11) NOT NULL DEFAULT 0,
  `last_rescheduled_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `client_id`, `professional_id`, `start_time`, `end_time`, `status`, `fee`, `discount_amount`, `coupon_code`, `notes`, `meeting_room`, `created_at`, `updated_at`, `reschedule_count`, `last_rescheduled_at`) VALUES
(1, 1, 3, '2025-04-24 10:10:00', '2025-04-24 10:40:00', 'cancelled', 1000.00, 1000.00, 'WELCOME100', NULL, NULL, '2025-04-22 22:38:03', '2025-04-22 22:44:02', 0, NULL),
(2, 1, 3, '2025-04-28 10:11:00', '2025-04-28 10:41:00', 'completed', 1000.00, 1000.00, 'WELCOME100', NULL, NULL, '2025-04-22 22:43:44', '2025-05-18 05:56:13', 2, '2025-04-23 02:26:07'),
(3, 1, 3, '2025-04-24 12:11:00', '2025-04-24 12:41:00', 'completed', 1000.00, 500.00, 'C1', NULL, NULL, '2025-04-22 23:21:30', '2025-05-18 05:56:00', 1, '2025-04-23 02:27:03'),
(4, 2, 4, '2025-04-25 14:13:00', '2025-04-25 14:43:00', 'confirmed', 1400.00, 1400.00, 'WELCOME100', NULL, NULL, '2025-04-24 09:43:13', '2025-04-24 09:43:13', 0, NULL),
(5, 1, 4, '2025-05-06 10:00:00', '2025-05-06 10:30:00', 'confirmed', 1400.00, 1400.00, 'WELCOME100', NULL, 'vijahat-khan-a525b54a', '2025-05-03 07:28:10', '2025-05-04 00:38:51', 0, NULL),
(6, 1, 6, '2025-05-08 10:15:00', '2025-05-08 11:15:00', 'cancelled', 500.00, 500.00, 'WELCOME100', NULL, NULL, '2025-05-03 08:46:54', '2025-05-03 23:41:32', 0, NULL),
(7, 1, 6, '2025-05-05 09:00:00', '2025-05-05 10:00:00', 'confirmed', 500.00, 500.00, 'WELCOME100', NULL, 'daud-khan-4156d41c', '2025-05-04 01:32:57', '2025-05-04 01:34:52', 0, NULL),
(8, 2, 6, '2025-05-05 10:30:00', '2025-05-05 11:00:00', 'confirmed', 500.00, 500.00, 'WELCOME100', NULL, NULL, '2025-05-04 04:59:50', '2025-05-04 04:59:50', 0, NULL),
(9, 1, 6, '2025-05-19 09:45:00', '2025-05-19 10:15:00', 'confirmed', 500.00, 500.00, 'WELCOME100', NULL, 'daud-khan-7227a5ea', '2025-05-18 07:15:27', '2025-05-18 07:15:51', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `password`, `profile_photo`, `email_verification_token`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'daud.csbt+c1@gmail.com', '216545', 'fgh', '$2y$12$1BR4tWqzSgnteWHv3k118uEIltSbeYkftBl0pgD6ulpa4aWUzdT6W', 'profile-photos/MSv1Ba7SDVlDk9NVY5yB6Hxr8IejNml1ZaihxO5B.jpg', NULL, '2025-04-22 19:21:19', NULL, '2025-04-22 19:17:43', '2025-05-18 05:45:05'),
(2, 'VIJAHAT', 'KHAN', 'vijahat.mba+client@gmail.com', '+97430429837', 'DOHA', '$2y$12$w3e2N1JTb3fDfbxLtQiHd.Ez656L/sxN0mBmYhbkqR3UmEGNFqg2m', NULL, NULL, '2025-04-23 02:41:43', NULL, '2025-04-23 02:41:12', '2025-04-23 02:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `client_password_reset_tokens`
--

CREATE TABLE `client_password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `code`, `type`, `value`, `max_uses`, `used_count`, `starts_at`, `expires_at`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME100', 'percentage', 100.00, NULL, 0, '2025-04-22 22:15:12', '2025-07-22 22:15:12', 1, 'Limited time offer: 100% discount on your first session', '2025-04-22 22:15:12', '2025-04-22 22:15:12'),
(2, 'C1', 'percentage', 50.00, NULL, 1, '2025-03-31 18:30:00', '2025-04-29 18:30:00', 1, 'sdf', '2025-04-22 23:06:05', '2025-04-22 23:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_14_000000_create_professionals_table', 1),
(6, '2024_04_14_000000_create_clients_table', 1),
(7, '2024_04_14_000001_create_client_password_reset_tokens_table', 1),
(8, '2025_04_14_065500_add_is_admin_to_users_table', 1),
(9, '2025_04_14_074010_create_jobs_table', 1),
(10, '2025_04_22_112055_create_appointments_table', 2),
(11, '2025_04_23_014459_add_slug_to_professionals_table', 3),
(12, '2025_04_22_120639_create_notifications_table', 4),
(13, '2025_04_22_112047_create_professional_settings_table', 5),
(14, '2024_04_22_000001_create_coupon_codes_table', 6),
(15, '2024_02_14_000002_add_reschedule_columns_to_professional_settings', 7),
(16, '2025_04_23_061028_update_appointments_table_add_schedule_count_col', 8),
(17, '2025_05_03_131254_add_country_code_and_phone_verification_to_professionals_table', 9),
(18, '2025_05_03_132523_create_professional_languages_table', 10),
(20, '2025_05_04_054803_add_meeting_room_to_appointments_table', 11),
(21, '2025_05_05_000000_add_user_type_to_password_reset_tokens', 12),
(23, '2025_05_06_000000_recreate_password_reset_tokens_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `user_type`, `created_at`) VALUES
('daud.csbt+c1@gmail.com', 'wHF87PDyWQqb29AJ0OXNXZtfobSifWIJ3Grt403ANgYqY9JMTz8AJ5FDO3phITNE', 'client', '2025-05-18 05:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL DEFAULT '+91',
  `phone` varchar(255) DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `bio` text DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `license_expiry_date` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `password` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`id`, `first_name`, `last_name`, `slug`, `email`, `country_code`, `phone`, `is_phone_verified`, `bio`, `specialization`, `qualification`, `license_number`, `license_expiry_date`, `profile_photo`, `cv`, `status`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'KHAN', 'test-khan', 'daud.csbt+1@gmail.com', '+91', '8744019461', 0, 'sdfsdf', 'asd', 'BTech', 'gfjhg', '2025-04-16 00:00:00', 'professionals/photos/1745372801_img1.jpg', NULL, 'approved', '$2y$12$NSBb5wZqyXQp.vkMwjkD/.fNMn3Bse5GGQQKqhDDXDHmgWaF6uLqu', NULL, NULL, '2025-04-22 20:16:41', '2025-05-18 06:00:59'),
(2, 'prof2', 'asd', 'prof2-asd', 'daud.csbt+prof2@gmail.com', '+91', '7210007464', 0, 'sdfsdf', 'asd', 'sdf', 'sdfsdf', '2025-04-23 00:00:00', NULL, NULL, 'approved', '$2y$12$2omMckQwVKxLjnDQ.RYRZeAb1Yyt4mBqqP5fzq92fgbFfyaqAcWAm', NULL, NULL, '2025-04-22 20:39:06', '2025-04-22 20:40:11'),
(3, 'test', 'prof3', 'test-prof3', 'daud.csbt+prof3@gmail.com', '+91', '8744019462', 0, 'asasd', 'asd', 'test', 'sdf', '2025-04-24 00:00:00', 'professionals/photos/1745375566_img1.jpg', 'professionals/cvs/1745375566_daud-cv-15-apr.pdf', 'approved', '$2y$12$g9aina/3wSuV8vmnE9EnAuqM7u56k3A3lNdV.672943ejudXL3eza', NULL, NULL, '2025-04-22 20:48:18', '2025-05-18 05:48:11'),
(4, 'VIJAHAT', 'KHAN', 'vijahat-khan', 'vijahat.mba@gmail.com', '+91', '30429837', 0, 'I\'m', 'OCD', 'MA', 'R2737373', '2027-04-13 00:00:00', NULL, NULL, 'approved', '$2y$12$BobPBzPRHDRfUXceNUfjROhbtNtMwUjA5rUglkYipbEdnCBzj.UQu', NULL, NULL, '2025-04-24 08:53:34', '2025-04-24 09:34:37'),
(5, 'Haya', 'Khan', 'haya-khan', 'nehamushtaq4@gmail.com', '+91', '987362626262', 0, 'For testing', 'Mind fullness', 'PHD', 'R27373736', '2026-04-13 00:00:00', NULL, NULL, 'approved', '$2y$12$vtR8Fx7XlCfjLhcibm1yEuBtNyflkZlLk7y9km8EdPJdivBnNzIfG', NULL, NULL, '2025-04-24 09:30:08', '2025-04-24 09:34:31'),
(6, 'daud', 'khan', 'daud-khan', 'daud.csbt+prof35712@gmail.com', '+91', '3571200000', 0, 'asdsdf', 'test', 'test', 'test', '2029-11-11 00:00:00', NULL, NULL, 'approved', '$2y$12$Ax3qbpeuQpgcNYnxM5EH8OnB1Rz13PeaMa2dlcEm9StiOXdBmCjl2', NULL, NULL, '2025-05-03 08:14:24', '2025-05-03 08:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `professional_languages`
--

CREATE TABLE `professional_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) NOT NULL,
  `proficiency` enum('basic','intermediate','fluent','native') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_languages`
--

INSERT INTO `professional_languages` (`id`, `professional_id`, `language`, `proficiency`, `created_at`, `updated_at`) VALUES
(1, 6, 'Hindi', 'native', '2025-05-03 08:14:24', '2025-05-03 08:14:24'),
(2, 6, 'English', 'intermediate', '2025-05-03 08:14:24', '2025-05-03 08:14:24'),
(3, 6, 'English', 'fluent', '2025-05-03 08:14:24', '2025-05-03 08:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `professional_settings`
--

CREATE TABLE `professional_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `session_durations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`session_durations`)),
  `session_fees` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`session_fees`)),
  `working_hours` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`working_hours`)),
  `working_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`working_days`)),
  `buffer_time` int(11) NOT NULL DEFAULT 15,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `allow_client_reschedule` tinyint(1) NOT NULL DEFAULT 0,
  `max_reschedule_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_settings`
--

INSERT INTO `professional_settings` (`id`, `professional_id`, `session_durations`, `session_fees`, `working_hours`, `working_days`, `buffer_time`, `is_available`, `created_at`, `updated_at`, `allow_client_reschedule`, `max_reschedule_count`) VALUES
(1, 3, '[\"30\"]', '[\"1000\"]', '{\"Monday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Tuesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Wednesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Thursday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Friday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Saturday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Sunday\":{\"start\":\"09:00\",\"end\":\"17:00\"}}', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]', 15, 1, '2025-04-22 21:18:13', '2025-04-23 00:46:03', 1, 10),
(2, 4, '[\"30\"]', '[\"1400\"]', '{\"Monday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Tuesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Wednesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Thursday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Friday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Saturday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Sunday\":{\"start\":\"09:00\",\"end\":\"17:00\"}}', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"]', 15, 1, '2025-04-24 09:41:05', '2025-04-24 09:41:05', 0, 0),
(3, 6, '[\"30\",\"60\"]', '[\"500\",\"1000\"]', '{\"Monday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Tuesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Wednesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Thursday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Friday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Saturday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Sunday\":{\"start\":\"09:00\",\"end\":\"17:00\"}}', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]', 15, 1, '2025-05-03 08:19:52', '2025-05-03 08:19:52', 1, 2),
(4, 1, '[\"30\",\"60\",\"90\"]', '[\"500\",\"1000\",\"1500\"]', '{\"Monday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Tuesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Wednesday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Thursday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Friday\":{\"start\":\"09:00\",\"end\":\"17:00\"},\"Saturday\":{\"start\":\"10:00\",\"end\":\"17:00\"},\"Sunday\":{\"start\":\"10:00\",\"end\":\"13:00\"}}', '[\"Saturday\",\"Sunday\"]', 15, 1, '2025-05-18 06:17:32', '2025-05-18 06:22:55', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Admin', 'admin@admin.com', '2025-04-22 20:23:51', '$2y$12$6gkeoa9BKSxj.zV3qoekSOrAtiz4mJe7TIshLsRvQ.aA667Zt1oXO', NULL, '2025-04-22 20:23:51', '2025-04-22 20:23:51', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_client_id_foreign` (`client_id`),
  ADD KEY `appointments_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `client_password_reset_tokens`
--
ALTER TABLE `client_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_codes_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `professionals_email_unique` (`email`),
  ADD UNIQUE KEY `professionals_license_number_unique` (`license_number`),
  ADD UNIQUE KEY `professionals_slug_unique` (`slug`),
  ADD UNIQUE KEY `professionals_country_code_phone_unique` (`country_code`,`phone`);

--
-- Indexes for table `professional_languages`
--
ALTER TABLE `professional_languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professional_languages_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `professional_settings`
--
ALTER TABLE `professional_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professional_settings_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `professional_languages`
--
ALTER TABLE `professional_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professional_settings`
--
ALTER TABLE `professional_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `professional_languages`
--
ALTER TABLE `professional_languages`
  ADD CONSTRAINT `professional_languages_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `professional_settings`
--
ALTER TABLE `professional_settings`
  ADD CONSTRAINT `professional_settings_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
