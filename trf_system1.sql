-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2018 at 01:01 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trf_system1`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `created_at`, `updated_at`) VALUES
(1, 'PFMC Manila', NULL, NULL),
(2, 'PFMC Iloilo', NULL, NULL),
(3, 'PFMC Davao', NULL, NULL),
(4, 'PFMC Cauayan', NULL, NULL),
(5, 'PFMC Bataan', NULL, NULL),
(6, 'LFUG Manila', NULL, NULL),
(7, 'LFUG Bacolod', NULL, NULL),
(8, 'LFUG Davao', NULL, NULL),
(9, 'LFUG Subdivision', NULL, NULL),
(10, 'Lafil Meats', NULL, NULL),
(11, 'Global', NULL, NULL),
(12, 'AAPC', NULL, NULL),
(13, 'ALC', NULL, NULL),
(14, 'PLILI', NULL, NULL),
(15, 'MTPCI', NULL, NULL),
(16, 'ASC', NULL, NULL),
(17, 'STI', NULL, NULL),
(18, 'MGPCI Bukidnon', NULL, NULL),
(19, 'CSCI', NULL, NULL),
(20, 'DTSI', NULL, NULL),
(21, 'Excel Farm', NULL, NULL),
(22, 'MGC', NULL, NULL),
(23, 'ATH', NULL, NULL),
(24, 'Amigo Mall', NULL, NULL),
(25, 'Zashi', NULL, NULL),
(26, 'New Company', '2018-11-13 00:17:12', '2018-11-13 00:23:34'),
(27, 'Sample1', '2018-11-13 02:24:17', '2018-11-13 02:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(10) UNSIGNED NOT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `destination`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Bacolod', 'BCD', NULL, '2018-11-13 00:10:20'),
(2, 'Busuanga', 'USU', NULL, NULL),
(3, 'Butuan', 'BXU', NULL, NULL),
(4, 'Cagayan de Oro', 'CGY', NULL, NULL),
(5, 'Calbayog', 'CYP', NULL, NULL),
(6, 'Camiguin', 'CGM', NULL, NULL),
(7, 'Catarman', 'CRM', NULL, NULL),
(8, 'Caticlan', 'MPH', NULL, NULL),
(9, 'Cauayan', 'CYZ', NULL, NULL),
(10, 'Cebu', 'CEB', NULL, NULL),
(11, 'Clark', 'CRK', NULL, NULL),
(12, 'Cotabato', 'CBO', NULL, NULL),
(13, 'Davao', 'DVO', NULL, NULL),
(14, 'Dipolog', 'DPL', NULL, NULL),
(15, 'Dumaguete', 'DGT', NULL, NULL),
(16, 'General Santos', 'GES', NULL, NULL),
(17, 'Iloilo', 'ILO', NULL, NULL),
(18, 'Kalibo', 'KLO', NULL, NULL),
(19, 'Laoag', 'LAO', NULL, NULL),
(20, 'Legazpi', 'LGP', NULL, NULL),
(21, 'Manila', 'MNL', NULL, NULL),
(22, 'Masbate', 'MBT', NULL, NULL),
(23, 'Naga', 'WNP', NULL, NULL),
(24, 'Ormoc', 'OMC', NULL, NULL),
(25, 'Ozamiz', 'OZC', NULL, NULL),
(26, 'Pagadian', 'PAG', NULL, NULL),
(27, 'Puerto Princesa', 'PPS', NULL, NULL),
(28, 'Roxas', 'RXS', NULL, NULL),
(29, 'San Jose', 'SJI', NULL, NULL),
(30, 'Siargao', 'IAO', NULL, NULL),
(31, 'Subic', 'SFS', NULL, NULL),
(32, 'Surigao', 'SUG', NULL, NULL),
(33, 'Tablas', 'TBH', NULL, NULL),
(34, 'Tacloban', 'TAC', NULL, NULL),
(35, 'Tagbilaran', 'TAG', NULL, NULL),
(36, 'Tandag', 'TDG', NULL, NULL),
(37, 'Tawi-Tawi', 'TWT', NULL, NULL),
(38, 'Tuguegarao', 'TUG', NULL, NULL),
(39, 'Virac', 'VRC', NULL, NULL),
(40, 'Zamboanga', 'ZAM', NULL, NULL),
(41, 'Gold Coast', 'OOL', '2018-11-12 23:57:23', '2018-11-12 23:57:23'),
(42, 'Sample', 'AAA', '2018-11-13 02:17:53', '2018-11-13 02:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_13_004659_create_destinations_table', 1),
(4, '2018_11_13_005249_create_users_request_table', 1),
(5, '2018_11_13_005443_create_companies_table', 1),
(6, '2018_11_13_005939_create_roles_table', 1),
(7, '2018_11_13_010035_create_user_destinations_table', 1),
(8, '2018_11_13_010101_create_user_roles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'User', NULL, NULL),
(3, 'Approver', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `company_name` int(11) NOT NULL,
  `register` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `birth_date`, `contact_number`, `employee_id`, `company_name`, `register`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `activate`) VALUES
(1, 'admin', '1996-01-01', '09652305513', 0, 1, 1, 2, 'renzchristian.cabato@lafilgroup.com', NULL, '$2y$10$jO35U3Dc5X7J2r1geaVUtOeSaD9M1jYWQhGq2OhoPrB8yFnX6Fpd2', 'iosUBTHLLLo0h7fDIDLQwDEjibgcxFzNoMNtai7HxXEjGYG1yUnPsrMZcRzs', NULL, '2018-11-13 02:06:43', 1),
(7, 'Jhon Marco', '1991-11-11', '0000000000', 2, 1, 1, 3, 'jhonmarco.tomaquin@lafilgroup.com', NULL, '$2y$10$nFFapGDsLOJ8VeuFMAXr5u2Omp.dMJuhXA0oJqRtluFt6nO1Ai.0K', '7OmgfqZIJrejnKr0eib2bhRdfCQJov1FunZ0lraW0ykE468I2fQXnmrFazqc', '2018-11-13 21:08:15', '2018-11-13 21:08:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_approvers`
--

CREATE TABLE `user_approvers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `approver_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_approvers`
--

INSERT INTO `user_approvers` (`id`, `user_id`, `approver_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2018-11-14 11:22:57', '2018-11-13 18:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_destinations`
--

CREATE TABLE `user_destinations` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(11) NOT NULL,
  `origin` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `time_appointment` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_of_travel` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_destinations`
--

INSERT INTO `user_destinations` (`id`, `request_id`, `origin`, `destination`, `time_appointment`, `created_at`, `updated_at`, `date_of_travel`) VALUES
(99, 56, 21, 4, '6:00 AM', '2018-11-14 03:37:53', '2018-11-14 03:37:53', '2018-11-14'),
(100, 56, 4, 21, '6:00 PM', '2018-11-14 03:37:53', '2018-11-14 03:37:53', '2018-11-16'),
(101, 57, 21, 40, '6:00 AM', '2018-11-14 03:43:06', '2018-11-14 03:43:06', '2018-11-14'),
(102, 57, 40, 21, '6:00 PM', '2018-11-14 03:43:06', '2018-11-14 03:43:06', '2018-11-16'),
(103, 58, 21, 3, '6:00 AM', '2018-11-14 03:48:12', '2018-11-14 03:48:12', '2018-11-14'),
(104, 58, 3, 21, '6:00 PM', '2018-11-14 03:48:12', '2018-11-14 03:48:12', '2018-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `purpose_of_travel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `baggage_allowance` int(11) NOT NULL,
  `budget_code_line` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_code_approved` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_available` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gl_account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `traveler_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` int(11) NOT NULL,
  `cost_center` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `company_name`, `request_date`, `purpose_of_travel`, `contact_number`, `destination`, `date_from`, `date_to`, `baggage_allowance`, `budget_code_line`, `budget_code_approved`, `budget_available`, `gl_account`, `requestor_id`, `status`, `created_at`, `updated_at`, `traveler_name`, `approved_by`, `cost_center`) VALUES
(56, 24, '2018-11-14', 'Meeting With Client', '09652305513', 4, '2018-11-14', '2018-11-16', 20, 'asd123', 'asd123', 'asd123', 'asd123', 1, 2, '2018-11-14 03:37:53', '2018-11-14 03:53:23', 'Renz Christian Cabato', 7, 'asd123'),
(57, 13, '2018-11-14', 'Meeting With Client', '09652305513', 40, '2018-11-14', '2018-11-16', 0, 'asd123', 'asd123', 'asd123', 'asd123', 1, 1, '2018-11-14 03:43:06', '2018-11-14 03:43:06', 'Renz Christian Cabato', 0, 'asd123'),
(58, 13, '2018-11-14', 'Meeting With Client', '09652305513', 3, '2018-11-14', '2018-11-16', 20, 'asd123', 'asd123', 'asd123', 'asd123', 1, 1, '2018-11-14 03:48:12', '2018-11-14 03:48:12', 'Renz Christian Cabato', 0, 'asd123');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `user_approvers`
--
ALTER TABLE `user_approvers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_destinations`
--
ALTER TABLE `user_destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_approvers`
--
ALTER TABLE `user_approvers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_destinations`
--
ALTER TABLE `user_destinations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
