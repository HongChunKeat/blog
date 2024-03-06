-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2024 at 11:26 AM
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
(1, 'E9QMJCW7K23A5QT1', '2024-01-09 14:51:17', '2024-03-06 16:11:28', NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', 'eric', NULL, NULL, NULL, 'web3_address', 'active', NULL),
(2, 'E9QMJCW7K23A5QT5', '2024-01-10 13:13:17', '2024-01-10 13:13:17', NULL, '0xf0E9784EA2B904eCae8aD0a6C18c91Fa9cf57c55', 'david', NULL, NULL, NULL, NULL, 'active', NULL),
(3, 'O14XIXHVHYOJHXMO', '2024-01-23 16:53:42', '2024-01-23 16:53:42', NULL, '0x0e1497245518320e8F089Eb648c8533DB636C696', 'zk', NULL, NULL, NULL, NULL, 'active', NULL),
(4, 'T0OXJT7AXEFB86VE', '2024-01-24 19:03:56', '2024-01-24 19:03:56', NULL, '0xEA6BAE28525bc41624d67B1e5F01Efdcd813419c', 'clement', NULL, NULL, NULL, NULL, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_account_user`
--

CREATE TABLE `sw_account_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `web3_address` varchar(255) DEFAULT NULL,
  `nickname` varchar(128) DEFAULT NULL,
  `login_id` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `authenticator` varchar(64) DEFAULT NULL,
  `status` enum('active','inactivated','freezed','suspended') DEFAULT 'active',
  `telegram` varchar(255) DEFAULT NULL,
  `discord` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `telegram_name` varchar(255) DEFAULT NULL,
  `discord_name` varchar(255) DEFAULT NULL,
  `twitter_name` varchar(255) DEFAULT NULL,
  `google_name` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_account_user`
--

INSERT INTO `sw_account_user` (`id`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `avatar`, `intro`, `web3_address`, `nickname`, `login_id`, `password`, `tag`, `authenticator`, `status`, `telegram`, `discord`, `twitter`, `google`, `telegram_name`, `discord_name`, `twitter_name`, `google_name`, `remark`) VALUES
(1, 'QGBV11YOOU6MGT0N', '2024-03-06 16:10:47', '2024-03-06 18:25:10', NULL, NULL, NULL, '0xBdc76521b93cbF4E1dEf17a8d17a7767A3B85C4c', NULL, NULL, NULL, NULL, 'web3_address', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_admin_permission`
--

CREATE TABLE `sw_admin_permission` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `admin_uid` int(11) DEFAULT 0 COMMENT 'refer to account_admin',
  `role` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_admin_permission`
--

INSERT INTO `sw_admin_permission` (`id`, `created_at`, `updated_at`, `deleted_at`, `admin_uid`, `role`) VALUES
(1, '2023-11-24 17:39:06', '2023-11-24 17:39:09', NULL, 1, 1),
(2, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 2, 1),
(3, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 3, 1),
(4, '2023-11-24 17:39:06', '2024-01-10 17:35:33', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_admin`
--

CREATE TABLE `sw_log_admin` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `admin_uid` int(11) DEFAULT 0 COMMENT 'refer to account_admin',
  `by_admin_uid` int(11) DEFAULT 0 COMMENT 'refer to account_admin',
  `ip` varchar(255) DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` int(11) DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_log_user`
--

CREATE TABLE `sw_log_user` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `used_at` varchar(50) DEFAULT NULL,
  `uid` int(11) DEFAULT 0 COMMENT 'refer to account_user',
  `by_uid` int(11) DEFAULT 0 COMMENT 'refer to account_user',
  `ip` varchar(255) DEFAULT NULL,
  `ref_table` varchar(64) DEFAULT NULL,
  `ref_id` int(11) DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sw_permission_template`
--

CREATE TABLE `sw_permission_template` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `template_code` varchar(64) DEFAULT NULL,
  `rule` text DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_permission_template`
--

INSERT INTO `sw_permission_template` (`id`, `deleted_at`, `template_code`, `rule`, `remark`) VALUES
(1, NULL, 'admin', '[\"*\"]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_permission_warehouse`
--

CREATE TABLE `sw_permission_warehouse` (
  `id` int(11) NOT NULL,
  `code` varchar(128) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `from_site` varchar(128) DEFAULT 'common',
  `path` varchar(255) DEFAULT NULL,
  `action` varchar(128) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_permission_warehouse`
--

INSERT INTO `sw_permission_warehouse` (`id`, `code`, `deleted_at`, `from_site`, `path`, `action`, `remark`) VALUES
(1, 'admin_auth_request@get', NULL, 'admin', '/admin/auth/request', 'GET', NULL),
(2, 'admin_auth_verify@post', NULL, 'admin', '/admin/auth/verify', 'POST', NULL),
(3, 'admin_auth_logout@post', NULL, 'admin', '/admin/auth/logout', 'POST', NULL),
(4, 'admin_auth_rule@get', NULL, 'admin', '/admin/auth/rule', 'GET', NULL),
(5, 'admin_enumlist_list@get', NULL, 'admin', '/admin/enumList/list', 'GET', NULL),
(6, 'admin_account_admin_id@get', NULL, 'admin', '/admin/account/admin/{id:\\d+}', 'GET', NULL),
(7, 'admin_account_admin_list@get', NULL, 'admin', '/admin/account/admin/list', 'GET', NULL),
(8, 'admin_account_admin@get', NULL, 'admin', '/admin/account/admin', 'GET', NULL),
(9, 'admin_account_admin@post', NULL, 'admin', '/admin/account/admin', 'POST', NULL),
(10, 'admin_account_admin_id@delete', NULL, 'admin', '/admin/account/admin/{id:\\d+}', 'DELETE', NULL),
(11, 'admin_account_admin_id@put', NULL, 'admin', '/admin/account/admin/{id:\\d+}', 'PUT', NULL),
(12, 'admin_account_user_id@get', NULL, 'admin', '/admin/account/user/{id:\\d+}', 'GET', NULL),
(13, 'admin_account_user_list@get', NULL, 'admin', '/admin/account/user/list', 'GET', NULL),
(14, 'admin_account_user@get', NULL, 'admin', '/admin/account/user', 'GET', NULL),
(15, 'admin_account_user@post', NULL, 'admin', '/admin/account/user', 'POST', NULL),
(16, 'admin_account_user_id@put', NULL, 'admin', '/admin/account/user/{id:\\d+}', 'PUT', NULL),
(17, 'admin_account_user_id@delete', NULL, 'admin', '/admin/account/user/{id:\\d+}', 'DELETE', NULL),
(18, 'admin_log_admin_id@get', NULL, 'admin', '/admin/log/admin/{id:\\d+}', 'GET', NULL),
(19, 'admin_log_admin_list@get', NULL, 'admin', '/admin/log/admin/list', 'GET', NULL),
(20, 'admin_log_admin@get', NULL, 'admin', '/admin/log/admin', 'GET', NULL),
(21, 'admin_log_admin@post', NULL, 'admin', '/admin/log/admin', 'POST', NULL),
(22, 'admin_log_admin_id@put', NULL, 'admin', '/admin/log/admin/{id:\\d+}', 'PUT', NULL),
(23, 'admin_log_admin_id@delete', NULL, 'admin', '/admin/log/admin/{id:\\d+}', 'DELETE', NULL),
(24, 'admin_log_user_list@get', NULL, 'admin', '/admin/log/user/list', 'GET', NULL),
(25, 'admin_log_user_id@get', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'GET', NULL),
(26, 'admin_log_user@get', NULL, 'admin', '/admin/log/user', 'GET', NULL),
(27, 'admin_log_user@post', NULL, 'admin', '/admin/log/user', 'POST', NULL),
(28, 'admin_log_user_id@put', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'PUT', NULL),
(29, 'admin_log_user_id@delete', NULL, 'admin', '/admin/log/user/{id:\\d+}', 'DELETE', NULL),
(30, 'admin_permission_admin_id@get', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'GET', NULL),
(31, 'admin_permission_admin_list@get', NULL, 'admin', '/admin/permission/admin/list', 'GET', NULL),
(32, 'admin_permission_admin@get', NULL, 'admin', '/admin/permission/admin', 'GET', NULL),
(33, 'admin_permission_admin@post', NULL, 'admin', '/admin/permission/admin', 'POST', NULL),
(34, 'admin_permission_admin_id@put', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'PUT', NULL),
(35, 'admin_permission_admin_id@delete', NULL, 'admin', '/admin/permission/admin/{id:\\d+}', 'DELETE', NULL),
(36, 'admin_permission_template_id@get', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'GET', NULL),
(37, 'admin_permission_template_list@get', NULL, 'admin', '/admin/permission/template/list', 'GET', NULL),
(38, 'admin_permission_template@get', NULL, 'admin', '/admin/permission/template', 'GET', NULL),
(39, 'admin_permission_template@post', NULL, 'admin', '/admin/permission/template', 'POST', NULL),
(40, 'admin_permission_template_id@put', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'PUT', NULL),
(41, 'admin_permission_template_id@delete', NULL, 'admin', '/admin/permission/template/{id:\\d+}', 'DELETE', NULL),
(42, 'admin_permission_warehouse_id@get', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'GET', NULL),
(43, 'admin_permission_warehouse_list@get', NULL, 'admin', '/admin/permission/warehouse/list', 'GET', NULL),
(44, 'admin_permission_warehouse@get', NULL, 'admin', '/admin/permission/warehouse', 'GET', NULL),
(45, 'admin_permission_warehouse@post', NULL, 'admin', '/admin/permission/warehouse', 'POST', NULL),
(46, 'admin_permission_warehouse_id@put', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'PUT', NULL),
(47, 'admin_permission_warehouse_id@delete', NULL, 'admin', '/admin/permission/warehouse/{id:\\d+}', 'DELETE', NULL),
(48, 'admin_setting_general_id@get', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'GET', NULL),
(49, 'admin_setting_general_list@get', NULL, 'admin', '/admin/setting/general/list', 'GET', NULL),
(50, 'admin_setting_general@get', NULL, 'admin', '/admin/setting/general', 'GET', NULL),
(51, 'admin_setting_general@post', NULL, 'admin', '/admin/setting/general', 'POST', NULL),
(52, 'admin_setting_general_id@put', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'PUT', NULL),
(53, 'admin_setting_general_id@delete', NULL, 'admin', '/admin/setting/general/{id:\\d+}', 'DELETE', NULL),
(54, 'admin_setting_lang_id@get', NULL, 'admin', '/admin/setting/lang/{id:\\d+}', 'GET', NULL),
(55, 'admin_setting_lang@get', NULL, 'admin', '/admin/setting/lang', 'GET', NULL),
(56, 'admin_setting_lang_list@get', NULL, 'admin', '/admin/setting/lang/list', 'GET', NULL),
(57, 'admin_setting_lang@post', NULL, 'admin', '/admin/setting/lang', 'POST', NULL),
(58, 'admin_setting_lang_id@put', NULL, 'admin', '/admin/setting/lang/{id:\\d+}', 'PUT', NULL),
(59, 'admin_setting_lang_id@delete', NULL, 'admin', '/admin/setting/lang/{id:\\d+}', 'DELETE', NULL),
(60, 'admin_setting_operator_id@get', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'GET', NULL),
(61, 'admin_setting_operator_list@get', NULL, 'admin', '/admin/setting/operator/list', 'GET', NULL),
(62, 'admin_setting_operator@get', NULL, 'admin', '/admin/setting/operator', 'GET', NULL),
(63, 'admin_setting_operator@post', NULL, 'admin', '/admin/setting/operator', 'POST', NULL),
(64, 'admin_setting_operator_id@put', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'PUT', NULL),
(65, 'admin_setting_operator_id@delete', NULL, 'admin', '/admin/setting/operator/{id:\\d+}', 'DELETE', NULL),
(66, 'admin_user_blog@post', NULL, 'admin', '/admin/user/blog', 'POST', NULL),
(67, 'admin_user_blog_id@put', NULL, 'admin', '/admin/user/blog/{id:\\d+}', 'PUT', NULL),
(68, 'admin_user_blog_id@delete', NULL, 'admin', '/admin/user/blog/{id:\\d+}', 'DELETE', NULL),
(69, 'admin_user_blog_id@get', NULL, 'admin', '/admin/user/blog/{id:\\d+}', 'GET', NULL),
(70, 'admin_user_blog_list@get', NULL, 'admin', '/admin/user/blog/list', 'GET', NULL),
(71, 'admin_user_blog@get', NULL, 'admin', '/admin/user/blog', 'GET', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_general`
--

CREATE TABLE `sw_setting_general` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_general`
--

INSERT INTO `sw_setting_general` (`id`, `deleted_at`, `category`, `code`, `value`, `is_show`, `remark`) VALUES
(1, NULL, 'log_reader', 'allow_access', '1', 1, NULL),
(2, NULL, 'maintenance', 'stop_dapp', '0', 1, NULL),
(3, NULL, 'maintenance', 'stop_admin', '0', 1, NULL),
(4, NULL, 'maintenance', 'stop_login', '0', 1, NULL),
(5, NULL, 'maintenance', 'stop_register', '0', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_lang`
--

CREATE TABLE `sw_setting_lang` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_lang`
--

INSERT INTO `sw_setting_lang` (`id`, `deleted_at`, `code`, `value`, `remark`) VALUES
(1, NULL, 'english', 'en', NULL),
(2, NULL, 'chinese simplified', 'zh', NULL),
(3, NULL, 'chinese traditional', 'zh-TW', NULL),
(4, NULL, 'indonesia', 'id', NULL),
(5, NULL, 'japan', 'ja', NULL),
(6, NULL, 'korea', 'ko', NULL),
(7, NULL, 'thailand', 'th', NULL),
(8, NULL, 'vietnam', 'vi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_setting_operator`
--

CREATE TABLE `sw_setting_operator` (
  `id` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sw_setting_operator`
--

INSERT INTO `sw_setting_operator` (`id`, `deleted_at`, `category`, `code`, `remark`) VALUES
(1, NULL, 'status', 'pending', NULL),
(2, NULL, 'status', 'processing', NULL),
(3, NULL, 'status', 'success', NULL),
(4, NULL, 'status', 'failed', NULL),
(5, NULL, 'status', 'accepted', NULL),
(6, NULL, 'status', 'rejected', NULL),
(7, NULL, 'status', 'approved', NULL),
(8, NULL, 'status', 'claimed', NULL),
(9, NULL, 'status', 'completed', NULL),
(10, NULL, 'status', 'expired', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_blog`
--

CREATE TABLE `sw_user_blog` (
  `id` bigint(20) NOT NULL,
  `sn` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  `uid` int(11) DEFAULT 0 COMMENT 'refer to account_user',
  `main_image` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `tag` text DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT 'refer to setting_operator',
  `views` bigint(20) DEFAULT 0,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `sw_account_user`
--
ALTER TABLE `sw_account_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `web3_address` (`web3_address`);

--
-- Indexes for table `sw_admin_permission`
--
ALTER TABLE `sw_admin_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_log_admin`
--
ALTER TABLE `sw_log_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`admin_uid`),
  ADD KEY `by_uid` (`by_admin_uid`);

--
-- Indexes for table `sw_log_user`
--
ALTER TABLE `sw_log_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `by_uid` (`by_uid`);

--
-- Indexes for table `sw_permission_template`
--
ALTER TABLE `sw_permission_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_permission_warehouse`
--
ALTER TABLE `sw_permission_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_general`
--
ALTER TABLE `sw_setting_general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_lang`
--
ALTER TABLE `sw_setting_lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_setting_operator`
--
ALTER TABLE `sw_setting_operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_user_blog`
--
ALTER TABLE `sw_user_blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sn` (`sn`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sw_account_admin`
--
ALTER TABLE `sw_account_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sw_account_user`
--
ALTER TABLE `sw_account_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_admin_permission`
--
ALTER TABLE `sw_admin_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sw_log_admin`
--
ALTER TABLE `sw_log_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_log_user`
--
ALTER TABLE `sw_log_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_permission_template`
--
ALTER TABLE `sw_permission_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_permission_warehouse`
--
ALTER TABLE `sw_permission_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `sw_setting_general`
--
ALTER TABLE `sw_setting_general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sw_setting_lang`
--
ALTER TABLE `sw_setting_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sw_setting_operator`
--
ALTER TABLE `sw_setting_operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sw_user_blog`
--
ALTER TABLE `sw_user_blog`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
