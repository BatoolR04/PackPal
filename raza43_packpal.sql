-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2025 at 01:56 AM
-- Server version: 10.4.34-MariaDB-log
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raza43_packpal`
--

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `setting` varchar(50) NOT NULL,
  `value` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`setting`, `value`) VALUES
('theme', 'tropical');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `trip_type` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `destination`, `start_date`, `end_date`, `trip_type`, `user_id`) VALUES
(1, 'Miami', '2025-08-02', '2025-08-09', 'Beach', NULL),
(2, 'florida', '2025-08-02', '2025-08-03', 'Beach', NULL),
(3, 'nyc', '2025-08-03', '2025-08-06', 'City', NULL),
(4, 'miami', '2025-08-03', '2025-08-06', 'Beach', NULL),
(5, 'miami', '2025-08-01', '2025-08-06', 'Beach', NULL),
(6, 'banff', '2025-08-03', '2025-08-06', 'Hiking', NULL),
(7, 'miami', '2025-08-03', '2025-08-09', 'Beach', NULL),
(8, 'switzerland', '2025-08-03', '2025-08-05', 'Winter', NULL),
(9, 'nyc', '2025-08-02', '2025-08-06', 'City', NULL),
(10, 'miami', '2025-08-01', '2025-08-06', 'Beach', NULL),
(11, 'nyc', '2025-08-03', '2025-08-06', 'City', NULL),
(12, 'banff', '2025-08-02', '2025-08-04', 'Hiking', NULL),
(13, 'b', '2025-08-03', '2025-08-06', 'Winter', NULL),
(14, 'm', '2025-08-02', '2025-08-05', 'Beach', NULL),
(15, 'w', '2025-08-08', '2025-08-09', 'Winter', NULL),
(16, 'miami', '2025-08-03', '2025-08-09', 'Beach', NULL),
(17, 'miami', '2025-08-03', '2025-08-10', 'Beach', NULL),
(18, 's', '2025-08-03', '2025-08-05', 'Hiking', NULL),
(19, 'q', '2025-08-09', '2025-08-10', 'City', NULL),
(20, 'miami', '2025-08-02', '2025-08-10', 'Beach', NULL),
(21, 'los angeles', '2025-08-03', '2025-08-08', 'Beach', NULL),
(22, 'NYC', '2025-08-03', '2025-08-06', 'City', NULL),
(23, 'MCJHDCHJDCNJ', '2025-08-10', '2025-08-06', 'Beach', NULL),
(24, 'mexico', '2025-08-01', '2025-08-10', 'Beach', NULL),
(25, 'miami', '2025-08-03', '2025-08-10', 'Beach', NULL),
(26, 'Miami', '2025-08-01', '2025-08-05', 'Beach', NULL),
(28, 'Miami', '2025-08-02', '2025-08-05', 'Beach', NULL),
(30, 'miami', '2025-08-01', '2025-08-05', 'Beach', NULL),
(32, 'Miami', '2025-07-25', '2025-07-25', 'Tropical', NULL),
(33, 'Mexico', '2025-08-03', '2025-08-10', 'Beach', NULL),
(35, 'Mexico', '2025-08-03', '2025-08-05', 'Beach', NULL),
(36, 'Mexico', '2025-08-02', '2025-08-10', 'Beach', NULL),
(37, 'Banff', '2025-08-02', '2025-08-10', 'Hiking', NULL),
(38, 'NYC', '2025-08-03', '2025-08-06', 'City', NULL),
(39, 'Switzerland', '2025-08-02', '2025-08-05', 'Winter', NULL),
(40, 'Turks', '2025-08-10', '2025-08-18', 'Beach', NULL),
(42, 'NYC', '2025-09-07', '2025-09-10', 'City', NULL),
(43, 'miami', '2025-09-06', '2025-09-07', 'Beach', NULL),
(44, 'miami', '2025-08-17', '2025-08-24', 'Beach', NULL),
(45, 'NYC', '2025-08-31', '2025-09-03', 'City', NULL),
(46, 'Paris', '2025-08-30', '2025-09-03', 'City', NULL),
(47, 'Paris', '2025-08-31', '2025-09-01', 'City', NULL),
(48, 'Miami', '2025-08-01', '2025-08-08', 'Beach', NULL),
(49, 'Montana', '2025-08-23', '2025-08-25', 'Hiking', NULL),
(51, 'NYC', '2025-08-17', '2025-08-20', 'City', NULL),
(52, 'Tokyo', '2025-08-17', '2025-08-19', 'City', NULL),
(53, 'Miami', '2025-12-26', '2026-01-02', 'Beach', NULL),
(54, 'Miami', '2025-08-30', '2025-08-31', 'City', NULL),
(55, 'Cancun', '2025-12-27', '2026-01-02', 'Beach', NULL),
(57, 'New York', '2025-08-29', '2025-09-05', 'City', NULL),
(58, 'New York', '2025-08-29', '2025-09-05', 'City', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_admin` tinyint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `created_at`, `is_active`) VALUES
(1, 'b04', 'b04@gmail.com', '$2y$10$DZox/jNv7Z6uyZ7S0eKz7OJjF/f8bV61/M9sycfY3w3hnxKXzDycW\r\n', 0, '2025-07-30 21:59:47', 1),
(2, 'batool.raza04', 'raza43@windsor.ca', '$2y$10$qNkEaXnNmq.bwVVKVYCvo.bXAJ47r0XgwmmTqHCi9.AP.iDLVyFFa', 0, '2025-07-30 22:07:27', 1),
(3, 'raza', 'raza@gmail.com', '$2y$10$4thhKpsqXJaYR9xj70ja2eAc5hiiIph.hP1vFYHbRg04L1/pRlsEC', 0, '2025-07-30 22:12:31', 1),
(4, 'raza45', 'raza@icloud.com', '$2y$10$Fnc2mIx8G9VCTny0P2lWreFywC.kHaPrskww1efMspLOkce3WgaDK', 0, '2025-07-30 22:13:39', 1),
(5, 'braza', 'b@gmail.com', '$2y$10$xp3vBUpk3TI/htyne3Vh9u8.CssyulJIUr...yEOzWKu/HBCcCpuq', 0, '2025-07-30 22:14:24', 1),
(6, 'raza04', 'braza@gmail.com', '$2y$10$muO9xguaOZsl0Xmody76oe8fAca5Pm13AhSxYKnq1SuaFxicMDwye', 0, '2025-07-30 22:19:50', 1),
(7, 'br04', 'br04@gmail.com', '$2y$10$iOUVI11pupqrkEFYCRoTN.EooJ52OpcTDj9P/Miy27HE48dyUlNwm', 0, '2025-07-30 22:55:00', 1),
(8, 'ava1', 'avabarb@gmail.com', '$2y$10$tk9NHO.CS48K.8rrpEJmZucrZqaog2k.PVpJIBOD1z1o58tW9d2by', 0, '2025-08-01 07:42:01', 0),
(9, 'sarah', 'sarah@gmail.com', '$2y$10$.EDgKUibErapANdB2H7O5eWv4buxzDZ1/P/wRFW5bMy1lymQcjMPW', 0, '2025-08-01 07:42:26', 1),
(10, 'bpatel', 'bp@gmail.com', '$2y$10$UiEsJLrHYqgRann9XLwYNelD7tRfAHCBiKbI20F2TncHXAk9YTu3y', 0, '2025-08-02 03:14:30', 1),
(11, 'laibarizvi03', 'laibarizvi03@gmail.com', '$2y$10$QplBaWdKqCp0U2bhPaxg4OES5zyGNEqndErPuTtnXb04HtXnd/d6W', 0, '2025-08-02 04:39:35', 1),
(12, 'r1122', 'r04@gmail.com', '$2y$10$SEtdyRN6IuMKDnY345LhTOGGViLsCoRAfsDZRVLbOZNWaAP/ofGJe', 0, '2025-08-02 04:48:25', 0),
(13, 'ADMIN', 'packpal@gmail.com', '$2y$10$jqY4tL7fbI.uzZxcyEgawOKmjCNw5o/8k.FylqtF.j3AAka96K4Fu', 1, '2025-08-02 04:53:45', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`setting`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
