-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2024 at 02:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `sw_account_admin`
--

CREATE TABLE `sw_account_admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `web3_address` varchar(255) DEFAULT NULL,
  `nickname` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `authenticator` varchar(64) DEFAULT NULL,
  `status` enum('active','inactivated','freezed','suspended') DEFAULT 'active',
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_account_admin`
--

INSERT INTO `sw_account_admin` (`id`, `admin_id`, `created_at`, `updated_at`, `deleted_at`, `web3_address`, `nickname`, `password`, `tag`, `email`, `authenticator`, `status`, `remark`) VALUES
(1, 'E9QMJCW7K23A5QT1', '2024-01-09 14:51:17', '2024-03-06 19:47:14', NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', 'eric', NULL, NULL, NULL, 'web3_address', 'active', NULL),
(2, 'E9QMJCW7K23A5QT5', '2024-01-10 13:13:17', '2024-01-10 13:13:17', NULL, '0xf0E9784EA2B904eCae8aD0a6C18c91Fa9cf57c55', 'david', NULL, NULL, NULL, NULL, 'active', NULL),
(3, 'O14XIXHVHYOJHXMO', '2024-01-23 16:53:42', '2024-01-23 16:53:42', NULL, '0x0e1497245518320e8F089Eb648c8533DB636C696', 'zk', NULL, NULL, NULL, NULL, 'active', NULL),
(4, 'T0OXJT7AXEFB86VE', '2024-01-24 19:03:56', '2024-01-24 19:03:56', NULL, '0xEA6BAE28525bc41624d67B1e5F01Efdcd813419c', 'clement', NULL, NULL, NULL, NULL, 'active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sw_account_admin`
--
ALTER TABLE `sw_account_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD KEY `web3_address` (`web3_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sw_account_admin`
--
ALTER TABLE `sw_account_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
