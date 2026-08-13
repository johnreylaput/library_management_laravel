-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2026 at 05:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `username`, `role`, `action`, `description`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-04 07:15:53', '2026-08-04 07:15:53'),
(2, 1, 'admin', 'Admin', 'Search', 'Searched for: Jennifer Doudna, Emmanuelle Charpentier (2020). CRISPR-Cas9 Gene Editing: A Comprehensive Review. <em>Nature</em>, 578(7795), 1-10. DOI: 10.1038/s41586-020-1932-1. (1 results)', '127.0.0.1', '2026-08-04 07:17:21', '2026-08-04 07:17:21'),
(3, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-04 08:15:18', '2026-08-04 08:15:18'),
(4, 16, 'Laiza', 'Member', 'Register', 'Registered new account', '127.0.0.1', '2026-08-04 08:24:54', '2026-08-04 08:24:54'),
(5, 16, 'Laiza', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-04 08:24:57', '2026-08-04 08:24:57'),
(6, 16, 'Laiza', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-04 08:25:05', '2026-08-04 08:25:05'),
(7, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (1 results)', '127.0.0.1', '2026-08-04 08:42:13', '2026-08-04 08:42:13'),
(8, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (1 results)', '127.0.0.1', '2026-08-04 08:42:28', '2026-08-04 08:42:28'),
(9, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:42:54', '2026-08-04 08:42:54'),
(10, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:42:58', '2026-08-04 08:42:58'),
(11, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:43:02', '2026-08-04 08:43:02'),
(12, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:43:05', '2026-08-04 08:43:05'),
(13, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:43:07', '2026-08-04 08:43:07'),
(14, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:43:07', '2026-08-04 08:43:07'),
(15, 16, 'Laiza', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-04 08:43:07', '2026-08-04 08:43:07'),
(16, 16, 'Laiza', 'Member', 'Search', 'Searched for: Susan Clayton, Ashlee Cunsolo (1 results)', '127.0.0.1', '2026-08-04 08:43:35', '2026-08-04 08:43:35'),
(17, 16, 'Laiza', 'Member', 'Search', 'Searched for: Susan Clayton, Ashlee Cunsolo (1 results)', '127.0.0.1', '2026-08-04 08:43:43', '2026-08-04 08:43:43'),
(18, 16, 'Laiza', 'Member', 'Search', 'Searched for: 10.1016/j.jenvp.2020.101502 (1 results)', '127.0.0.1', '2026-08-04 08:44:18', '2026-08-04 08:44:18'),
(19, 16, 'Laiza', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-04 08:49:35', '2026-08-04 08:49:35'),
(20, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-04 08:49:42', '2026-08-04 08:49:42'),
(21, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-04 08:50:48', '2026-08-04 08:50:48'),
(22, 16, 'Laiza', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:10:07', '2026-08-07 06:10:07'),
(23, 16, 'Laiza', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:17:50', '2026-08-07 06:17:50'),
(24, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:23:29', '2026-08-07 06:23:29'),
(25, 1, 'admin', 'Admin', 'Reservation Approved', 'Approved reservation for book: Dune (Member: Laiza Quillobe)', '127.0.0.1', '2026-08-07 06:23:41', '2026-08-07 06:23:41'),
(26, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:34:45', '2026-08-07 06:34:45'),
(27, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:37:27', '2026-08-07 06:37:27'),
(28, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:37:32', '2026-08-07 06:37:32'),
(29, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:40:32', '2026-08-07 06:40:32'),
(30, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:41:08', '2026-08-07 06:41:08'),
(31, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:41:15', '2026-08-07 06:41:15'),
(32, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:43:50', '2026-08-07 06:43:50'),
(33, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:44:09', '2026-08-07 06:44:09'),
(34, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:48:37', '2026-08-07 06:48:37'),
(35, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:48:43', '2026-08-07 06:48:43'),
(36, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 06:51:11', '2026-08-07 06:51:11'),
(37, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 06:51:29', '2026-08-07 06:51:29'),
(38, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 14:55:33', '2026-08-07 14:55:33'),
(39, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 15:02:15', '2026-08-07 15:02:15'),
(40, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 15:04:01', '2026-08-07 15:04:01'),
(41, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-07 15:07:21', '2026-08-07 15:07:21'),
(42, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 15:10:19', '2026-08-07 15:10:19'),
(43, 21, 'snorlaxcute11', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-07 15:26:38', '2026-08-07 15:26:38'),
(44, 21, 'snorlaxcute11', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-07 15:26:50', '2026-08-07 15:26:50'),
(45, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 01:24:30', '2026-08-10 01:24:30'),
(46, 1, 'admin', 'Admin', 'Search', 'Searched for: HarperCollins (0 results)', '127.0.0.1', '2026-08-10 02:25:12', '2026-08-10 02:25:12'),
(47, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:28:56', '2026-08-10 02:28:56'),
(48, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 02:29:18', '2026-08-10 02:29:18'),
(49, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:30:03', '2026-08-10 02:30:03'),
(50, 21, 'snorlaxcute11', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 02:30:32', '2026-08-10 02:30:32'),
(51, 21, 'snorlaxcute11', 'Member', 'Search', 'Searched for: Mary Jane A. Intao (2025). Self-Efficacy and Work Satisfaction of Non-Teaching Personnel. Guimaras State University. Masters. (0 results)', '127.0.0.1', '2026-08-10 02:38:52', '2026-08-10 02:38:52'),
(52, 21, 'snorlaxcute11', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:39:19', '2026-08-10 02:39:19'),
(53, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 02:39:31', '2026-08-10 02:39:31'),
(54, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:43:05', '2026-08-10 02:43:05'),
(55, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 02:43:25', '2026-08-10 02:43:25'),
(56, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:43:53', '2026-08-10 02:43:53'),
(57, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 02:44:02', '2026-08-10 02:44:02'),
(58, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:44:21', '2026-08-10 02:44:21'),
(59, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 02:44:27', '2026-08-10 02:44:27'),
(60, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (0 results)', '127.0.0.1', '2026-08-10 02:44:32', '2026-08-10 02:44:32'),
(61, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (0 results)', '127.0.0.1', '2026-08-10 02:44:59', '2026-08-10 02:44:59'),
(62, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (0 results)', '127.0.0.1', '2026-08-10 02:44:59', '2026-08-10 02:44:59'),
(63, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (0 results)', '127.0.0.1', '2026-08-10 02:45:00', '2026-08-10 02:45:00'),
(64, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:45:03', '2026-08-10 02:45:03'),
(65, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 02:45:14', '2026-08-10 02:45:14'),
(66, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:45:33', '2026-08-10 02:45:33'),
(67, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 02:45:39', '2026-08-10 02:45:39'),
(68, 22, 'johnylaput', 'Member', 'Search', 'Searched for: 10.1038/s41586-020-1932-1 (1 results)', '127.0.0.1', '2026-08-10 02:45:58', '2026-08-10 02:45:58'),
(69, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 02:53:03', '2026-08-10 02:53:03'),
(70, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 02:53:08', '2026-08-10 02:53:08'),
(71, 1, 'admin', 'Admin', 'Search', 'Searched for: 10.1038/s41586-020-1932-1 (1 results)', '127.0.0.1', '2026-08-10 03:02:24', '2026-08-10 03:02:24'),
(72, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:08:38', '2026-08-10 03:08:38'),
(73, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 03:08:46', '2026-08-10 03:08:46'),
(74, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:10:18', '2026-08-10 03:10:18'),
(75, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 03:10:25', '2026-08-10 03:10:25'),
(76, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:26:17', '2026-08-10 03:26:17'),
(77, 21, 'snorlaxcute11', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 03:26:25', '2026-08-10 03:26:25'),
(78, 21, 'snorlaxcute11', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:29:22', '2026-08-10 03:29:22'),
(79, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 03:29:43', '2026-08-10 03:29:43'),
(80, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:45:41', '2026-08-10 03:45:41'),
(81, 23, 'johnreylaput48', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 03:45:52', '2026-08-10 03:45:52'),
(82, 23, 'johnreylaput48', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:49:55', '2026-08-10 03:49:55'),
(83, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 03:50:04', '2026-08-10 03:50:04'),
(84, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 03:54:28', '2026-08-10 03:54:28'),
(85, 23, 'johnreylaput48', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 03:54:35', '2026-08-10 03:54:35'),
(86, 23, 'johnreylaput48', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 04:10:02', '2026-08-10 04:10:02'),
(87, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 04:12:11', '2026-08-10 04:12:11'),
(88, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 04:21:34', '2026-08-10 04:21:34'),
(89, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 04:21:41', '2026-08-10 04:21:41'),
(90, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 04:32:11', '2026-08-10 04:32:11'),
(91, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 04:32:26', '2026-08-10 04:32:26'),
(92, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 04:33:34', '2026-08-10 04:33:34'),
(93, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 04:33:40', '2026-08-10 04:33:40'),
(94, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 04:35:44', '2026-08-10 04:35:44'),
(95, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 04:36:07', '2026-08-10 04:36:07'),
(96, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (5 results)', '127.0.0.1', '2026-08-10 04:36:14', '2026-08-10 04:36:14'),
(97, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Non-Teaching (0 results)', '127.0.0.1', '2026-08-10 04:36:24', '2026-08-10 04:36:24'),
(98, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Non-Teaching (1 results)', '127.0.0.1', '2026-08-10 04:36:26', '2026-08-10 04:36:26'),
(99, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Non-Teaching (1 results)', '127.0.0.1', '2026-08-10 04:36:36', '2026-08-10 04:36:36'),
(100, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 04:36:53', '2026-08-10 04:36:53'),
(101, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 04:37:00', '2026-08-10 04:37:00'),
(102, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 08:23:59', '2026-08-10 08:23:59'),
(103, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 08:34:26', '2026-08-10 08:34:26'),
(104, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 08:34:41', '2026-08-10 08:34:41'),
(105, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 08:35:41', '2026-08-10 08:35:41'),
(106, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 08:35:48', '2026-08-10 08:35:48'),
(107, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (5 results)', '127.0.0.1', '2026-08-10 08:35:56', '2026-08-10 08:35:56'),
(108, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (5 results)', '127.0.0.1', '2026-08-10 08:36:02', '2026-08-10 08:36:02'),
(109, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Computer Science (5 results)', '127.0.0.1', '2026-08-10 08:36:05', '2026-08-10 08:36:05'),
(110, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 08:36:06', '2026-08-10 08:36:06'),
(111, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 08:36:27', '2026-08-10 08:36:27'),
(112, 2, 'maria.librarian', 'Librarian', 'Reservation Approved', 'Approved reservation for book: Structure and Interpretation of Computer Programs (Member: Johny Laput)', '127.0.0.1', '2026-08-10 08:36:59', '2026-08-10 08:36:59'),
(113, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 08:37:03', '2026-08-10 08:37:03'),
(114, 22, 'johnylaput', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-10 08:37:10', '2026-08-10 08:37:10'),
(115, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Non-Teaching (0 results)', '127.0.0.1', '2026-08-10 08:37:51', '2026-08-10 08:37:51'),
(116, 22, 'johnylaput', 'Member', 'Search', 'Searched for: Non-Teaching (1 results)', '127.0.0.1', '2026-08-10 08:37:54', '2026-08-10 08:37:54'),
(117, 22, 'johnylaput', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 08:39:19', '2026-08-10 08:39:19'),
(118, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 08:39:28', '2026-08-10 08:39:28'),
(119, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-10 08:42:23', '2026-08-10 08:42:23'),
(120, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-10 08:42:30', '2026-08-10 08:42:30'),
(121, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 03:11:48', '2026-08-11 03:11:48'),
(122, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 03:15:11', '2026-08-11 03:15:11'),
(123, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 03:15:18', '2026-08-11 03:15:18'),
(124, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 03:24:31', '2026-08-11 03:24:31'),
(125, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 03:24:45', '2026-08-11 03:24:45'),
(126, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 03:25:12', '2026-08-11 03:25:12'),
(127, 23, 'johnreylaput48', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-11 03:25:22', '2026-08-11 03:25:22'),
(128, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Computer Science (5 results)', '127.0.0.1', '2026-08-11 03:26:17', '2026-08-11 03:26:17'),
(129, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Computer Science (5 results)', '127.0.0.1', '2026-08-11 03:26:25', '2026-08-11 03:26:25'),
(130, 23, 'johnreylaput48', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 03:26:57', '2026-08-11 03:26:57'),
(131, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 03:29:47', '2026-08-11 03:29:47'),
(132, 2, 'maria.librarian', 'Librarian', 'Borrow Approved', 'Approved borrow request for book: Deep Learning (Member: John rey Laput)', '127.0.0.1', '2026-08-11 03:29:55', '2026-08-11 03:29:55'),
(133, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 04:37:41', '2026-08-11 04:37:41'),
(134, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 04:37:58', '2026-08-11 04:37:58'),
(135, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 05:59:39', '2026-08-11 05:59:39'),
(136, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:10:14', '2026-08-11 06:10:14'),
(137, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:14:50', '2026-08-11 06:14:50'),
(138, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:22:43', '2026-08-11 06:22:43'),
(139, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:22:50', '2026-08-11 06:22:50'),
(140, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:23:39', '2026-08-11 06:23:39'),
(141, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:23:45', '2026-08-11 06:23:45'),
(142, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:24:09', '2026-08-11 06:24:09'),
(143, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:33:43', '2026-08-11 06:33:43'),
(144, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Book \'1984\' (ID: 1)', '127.0.0.1', '2026-08-11 06:34:38', '2026-08-11 06:34:38'),
(145, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:34:47', '2026-08-11 06:34:47'),
(146, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:35:22', '2026-08-11 06:35:22'),
(147, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:39:23', '2026-08-11 06:39:23'),
(148, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:39:29', '2026-08-11 06:39:29'),
(149, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:43:16', '2026-08-11 06:43:16'),
(150, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:43:28', '2026-08-11 06:43:28'),
(151, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:44:29', '2026-08-11 06:44:29'),
(152, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:44:37', '2026-08-11 06:44:37'),
(153, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Book \'1984\' (ID: 1)', '127.0.0.1', '2026-08-11 06:46:25', '2026-08-11 06:46:25'),
(154, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 06:46:31', '2026-08-11 06:46:31'),
(155, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 06:47:06', '2026-08-11 06:47:06'),
(156, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 07:50:30', '2026-08-11 07:50:30'),
(157, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 07:50:39', '2026-08-11 07:50:39'),
(158, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 07:51:53', '2026-08-11 07:51:53'),
(159, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 07:52:13', '2026-08-11 07:52:13'),
(160, 24, 'carlos.ws', 'Working-Student', 'Search', 'Searched for: 10.1038/s41586-020-1932-1 (1 results)', '127.0.0.1', '2026-08-11 07:52:25', '2026-08-11 07:52:25'),
(161, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 08:43:01', '2026-08-11 08:43:01'),
(162, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 08:43:11', '2026-08-11 08:43:11'),
(163, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 08:48:50', '2026-08-11 08:48:50'),
(164, 23, 'johnreylaput48', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-11 08:48:59', '2026-08-11 08:48:59'),
(165, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Tourism (1 results)', '127.0.0.1', '2026-08-11 08:59:52', '2026-08-11 08:59:52'),
(166, 23, 'johnreylaput48', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 09:00:10', '2026-08-11 09:00:10'),
(167, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 09:00:20', '2026-08-11 09:00:20'),
(168, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 09:03:53', '2026-08-11 09:03:53'),
(169, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 09:04:00', '2026-08-11 09:04:00'),
(170, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 09:04:07', '2026-08-11 09:04:07'),
(171, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 09:04:18', '2026-08-11 09:04:18'),
(172, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-11 09:16:37', '2026-08-11 09:16:37'),
(173, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-11 09:16:49', '2026-08-11 09:16:49'),
(174, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 00:13:16', '2026-08-12 00:13:16'),
(175, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 00:46:51', '2026-08-12 00:46:51'),
(176, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 00:47:00', '2026-08-12 00:47:00'),
(177, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:07:15', '2026-08-12 01:07:15'),
(178, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:10:09', '2026-08-12 01:10:09'),
(179, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:10:41', '2026-08-12 01:10:41'),
(180, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:10:55', '2026-08-12 01:10:55'),
(181, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' (ID: 1)', '127.0.0.1', '2026-08-12 01:11:23', '2026-08-12 01:11:23'),
(182, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:14:12', '2026-08-12 01:14:12'),
(183, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:14:30', '2026-08-12 01:14:30'),
(184, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:17:05', '2026-08-12 01:17:05'),
(185, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:17:18', '2026-08-12 01:17:18'),
(186, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' (ID: 1)', '127.0.0.1', '2026-08-12 01:17:45', '2026-08-12 01:17:45'),
(187, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:17:48', '2026-08-12 01:17:48'),
(188, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:17:55', '2026-08-12 01:17:55'),
(189, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:18:26', '2026-08-12 01:18:26'),
(190, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:18:39', '2026-08-12 01:18:39'),
(191, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Journal \'Online Learning Effectiveness: A Meta-Analysis\' (ID: 6)', '127.0.0.1', '2026-08-12 01:19:25', '2026-08-12 01:19:25'),
(192, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:25:18', '2026-08-12 01:25:18'),
(193, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:25:26', '2026-08-12 01:25:26'),
(194, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:25:58', '2026-08-12 01:25:58'),
(195, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:26:31', '2026-08-12 01:26:31'),
(196, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:29:16', '2026-08-12 01:29:16'),
(197, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:29:23', '2026-08-12 01:29:23'),
(198, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:30:30', '2026-08-12 01:30:30'),
(199, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:30:37', '2026-08-12 01:30:37'),
(200, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 01:32:27', '2026-08-12 01:32:27'),
(201, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 01:32:37', '2026-08-12 01:32:37'),
(202, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' (ID: 1)', '127.0.0.1', '2026-08-12 01:35:48', '2026-08-12 01:35:48'),
(203, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 02:44:04', '2026-08-12 02:44:04'),
(204, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 02:44:48', '2026-08-12 02:44:48'),
(205, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 03:01:44', '2026-08-12 03:01:44'),
(206, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 03:01:53', '2026-08-12 03:01:53'),
(207, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 03:25:55', '2026-08-12 03:25:55'),
(208, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 03:27:18', '2026-08-12 03:27:18'),
(209, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 03:30:27', '2026-08-12 03:30:27'),
(210, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 03:34:34', '2026-08-12 03:34:34'),
(211, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 03:37:16', '2026-08-12 03:37:16'),
(212, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 03:40:00', '2026-08-12 03:40:00'),
(213, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 03:48:25', '2026-08-12 03:48:25'),
(214, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 03:49:34', '2026-08-12 03:49:34'),
(215, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 04:02:35', '2026-08-12 04:02:35'),
(216, 23, 'johnreylaput48', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-12 04:02:46', '2026-08-12 04:02:46'),
(217, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Tourism (1 results)', '127.0.0.1', '2026-08-12 04:03:49', '2026-08-12 04:03:49'),
(218, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Tourism (0 results)', '127.0.0.1', '2026-08-12 04:03:58', '2026-08-12 04:03:58'),
(219, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Tourism (1 results)', '127.0.0.1', '2026-08-12 04:04:02', '2026-08-12 04:04:02'),
(220, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Tourism (1 results)', '127.0.0.1', '2026-08-12 04:04:39', '2026-08-12 04:04:39'),
(221, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: Tourism (1 results)', '127.0.0.1', '2026-08-12 04:10:53', '2026-08-12 04:10:53'),
(222, 23, 'johnreylaput48', 'Member', 'Search', 'Searched for: 978-0547928227 (1 results)', '127.0.0.1', '2026-08-12 04:15:01', '2026-08-12 04:15:01'),
(223, 23, 'johnreylaput48', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 04:17:12', '2026-08-12 04:17:12'),
(224, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 04:17:34', '2026-08-12 04:17:34'),
(225, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 04:18:02', '2026-08-12 04:18:02'),
(226, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 04:18:15', '2026-08-12 04:18:15'),
(227, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Journal \'Deep Learning Approaches for Natural Language Processing\' (ID: 3)', '127.0.0.1', '2026-08-12 04:18:47', '2026-08-12 04:18:47'),
(228, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 04:19:57', '2026-08-12 04:19:57'),
(229, 25, 'johnnicks', 'Member', 'Register', 'Registered new account', '127.0.0.1', '2026-08-12 04:21:17', '2026-08-12 04:21:17'),
(230, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 04:33:30', '2026-08-12 04:33:30'),
(231, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 04:33:39', '2026-08-12 04:33:39'),
(232, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:02:35', '2026-08-12 05:02:35'),
(233, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:02:49', '2026-08-12 05:02:49'),
(234, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:04:10', '2026-08-12 05:04:10'),
(235, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:04:26', '2026-08-12 05:04:26'),
(236, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:05:29', '2026-08-12 05:05:29'),
(237, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:05:38', '2026-08-12 05:05:38'),
(238, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:09:47', '2026-08-12 05:09:47'),
(239, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:41:20', '2026-08-12 05:41:20'),
(240, 1, 'admin', 'Admin', 'Borrow Approved', 'Approved borrow request for book: 1984 (Member: Johnicks Laput)', '127.0.0.1', '2026-08-12 05:42:26', '2026-08-12 05:42:26'),
(241, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:43:54', '2026-08-12 05:43:54'),
(242, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:44:05', '2026-08-12 05:44:05'),
(243, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:53:19', '2026-08-12 05:53:19'),
(244, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:53:28', '2026-08-12 05:53:28'),
(245, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:55:01', '2026-08-12 05:55:01'),
(246, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:55:10', '2026-08-12 05:55:10'),
(247, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 05:56:52', '2026-08-12 05:56:52'),
(248, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 05:57:01', '2026-08-12 05:57:01'),
(249, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 06:00:04', '2026-08-12 06:00:04'),
(250, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 06:27:27', '2026-08-12 06:27:27'),
(251, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 06:28:24', '2026-08-12 06:28:24'),
(252, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 06:28:33', '2026-08-12 06:28:33'),
(253, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 06:35:28', '2026-08-12 06:35:28'),
(254, 23, 'johnreylaput48', 'Member', 'Login', 'Logged in via Google', '127.0.0.1', '2026-08-12 06:35:37', '2026-08-12 06:35:37'),
(255, 23, 'johnreylaput48', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 06:35:57', '2026-08-12 06:35:57'),
(256, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 06:42:52', '2026-08-12 06:42:52'),
(257, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 06:43:52', '2026-08-12 06:43:52'),
(258, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 06:44:03', '2026-08-12 06:44:03'),
(259, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 06:44:41', '2026-08-12 06:44:41'),
(260, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 06:44:49', '2026-08-12 06:44:49'),
(261, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:21:00', '2026-08-12 08:21:00'),
(262, 24, 'carlos.ws', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:21:20', '2026-08-12 08:21:20'),
(263, 24, 'carlos.ws', 'Working-Student', 'Section Selection', 'Selected section: Reserve', '127.0.0.1', '2026-08-12 08:21:27', '2026-08-12 08:21:27'),
(264, 24, 'carlos.ws', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:21:36', '2026-08-12 08:21:36'),
(265, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:21:44', '2026-08-12 08:21:44'),
(266, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:26:20', '2026-08-12 08:26:20'),
(267, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:26:29', '2026-08-12 08:26:29'),
(268, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:33:11', '2026-08-12 08:33:11'),
(269, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:33:21', '2026-08-12 08:33:21'),
(270, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:35:01', '2026-08-12 08:35:01'),
(271, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:35:13', '2026-08-12 08:35:13'),
(272, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:38:16', '2026-08-12 08:38:16'),
(273, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:39:24', '2026-08-12 08:39:24'),
(274, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:40:26', '2026-08-12 08:40:26'),
(275, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:40:37', '2026-08-12 08:40:37'),
(276, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:41:47', '2026-08-12 08:41:47'),
(277, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:42:43', '2026-08-12 08:42:43'),
(278, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:44:52', '2026-08-12 08:44:52'),
(279, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:44:59', '2026-08-12 08:44:59'),
(280, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:45:16', '2026-08-12 08:45:16'),
(281, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:45:26', '2026-08-12 08:45:26'),
(282, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:48:55', '2026-08-12 08:48:55'),
(283, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:49:03', '2026-08-12 08:49:03'),
(284, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 08:52:54', '2026-08-12 08:52:54'),
(285, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 08:57:22', '2026-08-12 08:57:22'),
(286, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:00:50', '2026-08-12 09:00:50'),
(287, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:01:06', '2026-08-12 09:01:06'),
(288, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:01:11', '2026-08-12 09:01:11'),
(289, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:01:19', '2026-08-12 09:01:19'),
(290, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:04:09', '2026-08-12 09:04:09'),
(291, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:04:15', '2026-08-12 09:04:15'),
(292, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:04:41', '2026-08-12 09:04:41'),
(293, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:04:50', '2026-08-12 09:04:50'),
(294, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:08:16', '2026-08-12 09:08:16'),
(295, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:08:33', '2026-08-12 09:08:33'),
(296, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:13:29', '2026-08-12 09:13:29'),
(297, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:13:44', '2026-08-12 09:13:44'),
(298, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:13:57', '2026-08-12 09:13:57'),
(299, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:14:06', '2026-08-12 09:14:06'),
(300, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:14:23', '2026-08-12 09:14:23'),
(301, 24, 'carlos.ws-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:14:45', '2026-08-12 09:14:45'),
(302, 24, 'carlos.ws-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:15:09', '2026-08-12 09:15:09'),
(303, 24, 'Work.stud-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:29:16', '2026-08-12 09:29:16'),
(304, 24, 'Work.stud-Reserve', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:32:51', '2026-08-12 09:32:51'),
(305, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:33:05', '2026-08-12 09:33:05'),
(306, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:33:38', '2026-08-12 09:33:38'),
(307, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:35:39', '2026-08-12 09:35:39'),
(308, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:37:42', '2026-08-12 09:37:42'),
(309, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:38:02', '2026-08-12 09:38:02'),
(310, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:39:02', '2026-08-12 09:39:02'),
(311, 24, 'Work.stud-Reserve', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:39:19', '2026-08-12 09:39:19'),
(312, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:46:34', '2026-08-12 09:46:34'),
(313, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:46:47', '2026-08-12 09:46:47'),
(314, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:46:59', '2026-08-12 09:46:59'),
(315, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:47:11', '2026-08-12 09:47:11'),
(316, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:47:23', '2026-08-12 09:47:23'),
(317, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:47:30', '2026-08-12 09:47:30'),
(318, 2, 'maria.librarian', 'Librarian', 'Reject Deletion Request', 'Rejected deletion of App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' (ID: 1)', '127.0.0.1', '2026-08-12 09:47:44', '2026-08-12 09:47:44'),
(319, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:47:54', '2026-08-12 09:47:54'),
(320, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:48:03', '2026-08-12 09:48:03'),
(321, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:48:37', '2026-08-12 09:48:37'),
(322, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:48:46', '2026-08-12 09:48:46'),
(323, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:49:51', '2026-08-12 09:49:51'),
(324, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-12 09:49:57', '2026-08-12 09:49:57'),
(325, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-12 09:51:09', '2026-08-12 09:51:09'),
(326, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 01:22:07', '2026-08-13 01:22:07'),
(327, 24, 'Work.stud', 'Working-Student', 'Borrow Approved', 'Approved borrow request for book: Brave New World (Member: Johnicks Laput)', '127.0.0.1', '2026-08-13 01:22:46', '2026-08-13 01:22:46'),
(328, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 01:57:22', '2026-08-13 01:57:22'),
(329, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 01:57:34', '2026-08-13 01:57:34'),
(330, 2, 'maria.librarian', 'Librarian', 'Reservation Approved', 'Approved reservation for Brave New World (Member: Johnicks Laput)', '127.0.0.1', '2026-08-13 01:57:51', '2026-08-13 01:57:51'),
(331, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 01:58:14', '2026-08-13 01:58:14'),
(332, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 01:58:35', '2026-08-13 01:58:35'),
(333, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 02:23:42', '2026-08-13 02:23:42'),
(334, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 02:23:55', '2026-08-13 02:23:55'),
(335, 24, 'Work.stud-Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 02:24:15', '2026-08-13 02:24:15'),
(336, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 02:24:22', '2026-08-13 02:24:22'),
(337, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 02:25:08', '2026-08-13 02:25:08'),
(338, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 02:25:17', '2026-08-13 02:25:17'),
(339, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 02:26:22', '2026-08-13 02:26:22'),
(340, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 02:28:50', '2026-08-13 02:28:50'),
(341, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 02:31:22', '2026-08-13 02:31:22'),
(342, 24, 'Work.stud', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 02:31:37', '2026-08-13 02:31:37'),
(343, 24, 'Work.stud', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 02:59:18', '2026-08-13 02:59:18'),
(344, 24, 'Work.stud', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:04:50', '2026-08-13 03:04:50'),
(345, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:05:00', '2026-08-13 03:05:00'),
(346, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:05:14', '2026-08-13 03:05:14'),
(347, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:05:34', '2026-08-13 03:05:34'),
(348, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:06:10', '2026-08-13 03:06:10'),
(349, 24, 'Work.stud', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:06:39', '2026-08-13 03:06:39'),
(350, 24, 'Work.stud', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:08:00', '2026-08-13 03:08:00'),
(351, 2, 'maria.librarian', 'Librarian', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:08:12', '2026-08-13 03:08:12'),
(352, 2, 'maria.librarian', 'Librarian', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:29:20', '2026-08-13 03:29:20'),
(353, 25, 'johnnicks', 'Member', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:29:27', '2026-08-13 03:29:27'),
(354, 25, 'johnnicks', 'Member', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:30:36', '2026-08-13 03:30:36'),
(355, 24, 'Work.stud', 'Working-Student', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:31:15', '2026-08-13 03:31:15'),
(356, 24, 'Work.stud', 'Working-Student', 'Borrow Approved', 'Approved borrow request for Becoming (Member: Johnicks Laput)', '127.0.0.1', '2026-08-13 03:32:33', '2026-08-13 03:32:33'),
(357, 24, 'Work.stud', 'Working-Student', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:34:38', '2026-08-13 03:34:38'),
(358, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:34:50', '2026-08-13 03:34:50'),
(359, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:36:11', '2026-08-13 03:36:11'),
(360, 1, 'admin', 'Admin', 'Login', 'Logged in successfully', '127.0.0.1', '2026-08-13 03:36:21', '2026-08-13 03:36:21'),
(361, 1, 'admin', 'Admin', 'Logout', 'Logged out', '127.0.0.1', '2026-08-13 03:36:28', '2026-08-13 03:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_name` varchar(150) NOT NULL,
  `biography` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author_name`, `biography`, `created_at`, `updated_at`) VALUES
(1, 'George Orwell', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(2, 'Aldous Huxley', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(3, 'J.R.R. Tolkien', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(4, 'Isaac Asimov', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(5, 'Arthur C. Clarke', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(6, 'Philip K. Dick', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(7, 'Ray Bradbury', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(8, 'H.G. Wells', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(9, 'Mary Shelley', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(10, 'Bram Stoker', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(11, 'Agatha Christie', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(12, 'Arthur Conan Doyle', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(13, 'Edgar Allan Poe', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(14, 'Stephen King', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(15, 'Dean Koontz', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(16, 'Jane Austen', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(17, 'Charlotte Brontë', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(18, 'Emily Brontë', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(19, 'Charles Dickens', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(20, 'Mark Twain', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(21, 'Ernest Hemingway', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(22, 'F. Scott Fitzgerald', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(23, 'William Shakespeare', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(24, 'J.K. Rowling', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(25, 'Neil Gaiman', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(26, 'Terry Pratchett', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(27, 'Brandon Sanderson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(28, 'Robert Jordan', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(29, 'Frank Herbert', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(30, 'Orson Scott Card', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(31, 'Dan Brown', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(32, 'John Grisham', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(33, 'Tom Clancy', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(34, 'Michael Crichton', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(35, 'James Patterson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(36, 'C.S. Lewis', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(37, 'Homer', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(38, 'Virgil', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(39, 'Dante Alighieri', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(40, 'Miguel de Cervantes', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(41, 'Leo Tolstoy', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(42, 'Fyodor Dostoevsky', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(43, 'Anton Chekhov', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(44, 'Gabriel García Márquez', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(45, 'Pablo Neruda', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(46, 'Octavio Paz', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(47, 'Haruki Murakami', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(48, 'Kazuo Ishiguro', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(49, 'Chinua Achebe', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(50, 'George R.R. Martin', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(51, 'Ursula K. Le Guin', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(52, 'Stieg Larsson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(53, 'Gillian Flynn', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(54, 'Paula Hawkins', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(55, 'Walter Isaacson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(56, 'Siddhartha Mukherjee', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(57, 'Paul Kalanithi', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(58, 'Michelle Obama', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(59, 'Stephen Covey', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(60, 'James Clear', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(61, 'Napoleon Hill', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(62, 'Dale Carnegie', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(63, 'Eckhart Tolle', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(64, 'Richard Dawkins', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(65, 'Carl Sagan', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(66, 'Charles Darwin', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(67, 'Rachel Carson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(68, 'Robert C. Martin', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(69, 'David Thomas', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(70, 'Thomas H. Cormen', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(71, 'Steve McConnell', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(72, 'Harold Abelson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(73, 'Stuart Russell', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(74, 'Ian Goodfellow', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(75, 'James Kurose', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(76, 'Abraham Silberschatz', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(77, 'James Stewart', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(78, 'David C. Lay', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(79, 'Kenneth Rosen', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(80, 'Richard Rusczyk', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(81, 'Joseph Blitzstein', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(82, 'Marcus Aurelius', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(83, 'Plato', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(84, 'Aristotle', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(85, 'Friedrich Nietzsche', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(86, 'Jean-Paul Sartre', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(87, 'Daniel Kahneman', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(88, 'Viktor Frankl', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(89, 'Charles Duhigg', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(90, 'Robert Cialdini', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(91, 'Malcolm Gladwell', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(92, 'E.H. Gombrich', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(93, 'John Berger', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(94, 'Robert Henri', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(95, 'Alex Ross', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(96, 'Karen Chung', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(97, 'T.S. Eliot', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(98, 'Walt Whitman', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(99, 'Bruce Chatwin', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(100, 'Elizabeth Gilbert', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(101, 'Julia Child', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(102, 'Samin Nosrat', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(103, 'Irma Rombauer', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(104, 'Andre Agassi', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(105, 'Michael Lewis', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(106, 'Adam Smith', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(107, 'Steven Levitt', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(108, 'Thomas Piketty', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(109, 'Paulo Freire', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(110, 'John Holt', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(111, 'Ken Robinson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(112, 'J.E. Gordon', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(113, 'Henry Petroski', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(114, 'Robert D. Putnam', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(115, 'Niccolò Machiavelli', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(116, 'Thomas Hobbes', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(117, 'Alan Moore', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(118, 'Frank Miller', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(119, 'Art Spiegelman', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(120, 'Raymond Chandler', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(121, 'Robert Ludlum', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(122, 'Diana Gabaldon', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(123, 'Nicholas Sparks', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(124, 'Jojo Moyes', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(125, 'William Peter Blatty', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(126, 'Yuval Noah Harari', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(127, 'Jared Diamond', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(128, 'Barbara W. Tuchman', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(129, 'Mary Beard', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(130, 'Nelson Mandela', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(131, 'J.D. Salinger', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(132, 'Neal Stephenson', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(133, 'Scott Lynch', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(134, 'Patrick Rothfuss', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(135, 'Robin Hobb', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(136, 'Terry Goodkind', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(137, 'Joe Abercrombie', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(138, 'Guy Gavriel Kay', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(139, 'Mary Jane A. Intao', NULL, '2026-08-04 07:41:41', '2026-08-04 07:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `accession_no` varchar(50) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `edition` varchar(30) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `available_quantity` int(11) NOT NULL DEFAULT 1,
  `shelf_location` varchar(100) DEFAULT NULL,
  `book_cover` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Available','Unavailable','Archived') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `accession_no`, `isbn`, `title`, `category_id`, `author_id`, `publisher_id`, `publication_year`, `edition`, `language`, `pages`, `quantity`, `available_quantity`, `shelf_location`, `book_cover`, `description`, `status`, `created_at`, `updated_at`, `added_by`, `edited_by`) VALUES
(1, NULL, '978-0451524935', '1984', 1, 1, 1, 1949, '1st', 'English', 328, 5, 4, 'A1-01', NULL, 'A dystopian novel about totalitarianism and surveillance.', 'Available', '2026-08-04 07:08:19', '2026-08-12 05:42:26', NULL, NULL),
(2, NULL, '978-0060850524', 'Brave New World', 1, 2, 2, 1932, '1st', 'English', 288, 4, 3, 'A1-02', NULL, 'A dystopian novel set in a futuristic World State.', 'Available', '2026-08-04 07:08:19', '2026-08-13 01:22:46', NULL, NULL),
(3, NULL, '978-0141439518', 'Pride and Prejudice', 1, 16, 1, 1813, 'Revised', 'English', 432, 3, 3, 'A1-03', NULL, 'A romantic novel of manners.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(4, NULL, '978-0743273565', 'The Great Gatsby', 1, 22, 13, 1925, 'Reprint', 'English', 180, 6, 6, 'A1-04', NULL, 'A novel about the American Dream in the Jazz Age.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(5, NULL, '978-0316769488', 'The Catcher in the Rye', 1, 131, 54, 1951, 'Back Bay', 'English', 277, 3, 3, 'A1-06', NULL, 'A story about teenage alienation and rebellion.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(6, NULL, '978-0441172719', 'Dune', 2, 29, 1, 1965, 'Revised', 'English', 688, 5, 5, 'B2-01', NULL, 'An epic science fiction novel set on the desert planet Arrakis.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(7, NULL, '978-0553293357', 'Foundation', 2, 4, 14, 1951, '1st', 'English', 244, 4, 4, 'B2-02', NULL, 'A psychohistorian works to preserve knowledge through the fall of the Galactic Empire.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(8, NULL, '978-0553380958', 'Snow Crash', 2, 132, 14, 1992, '1st', 'English', 440, 3, 3, 'B2-04', NULL, 'A satirical cyberpunk novel about a hacker in a virtual reality world.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(9, NULL, '978-0441478125', 'The Left Hand of Darkness', 2, 51, 15, 1969, 'Reprint', 'English', 304, 2, 2, 'B2-05', NULL, 'A human envoy navigates a planet where humans have no fixed gender.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(10, NULL, '978-0547928227', 'The Hobbit', 3, 3, 55, 1937, '75th Anniversary', 'English', 310, 6, 6, 'C3-01', NULL, 'A hobbit embarks on an unexpected journey with dwarves.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(11, NULL, '978-0618640157', 'The Lord of the Rings', 3, 3, 55, 1954, '50th Anniversary', 'English', 1178, 4, 4, 'C3-02', NULL, 'A fellowship sets out to destroy the One Ring.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(12, NULL, '978-0553593716', 'A Game of Thrones', 3, 50, 14, 1996, '1st', 'English', 835, 3, 3, 'C3-03', NULL, 'Noble families vie for control of the Iron Throne.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(13, NULL, '978-0756404741', 'The Name of the Wind', 3, 134, 16, 2007, '1st', 'English', 662, 3, 3, 'C3-04', NULL, 'The story of a legendary figure told by himself.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(14, NULL, '978-0765326355', 'The Way of Kings', 3, 27, 17, 2010, '1st', 'English', 1007, 3, 3, 'C3-05', NULL, 'The first book in the Stormlight Archive series.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(15, NULL, '978-0553588981', 'The Lies of Locke Lamora', 3, 133, 14, 2006, '1st', 'English', 499, 2, 2, 'C3-06', NULL, 'A fantasy about a gang of con artists in a Venice-like city.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(16, NULL, '978-0062693662', 'The Murder of Roger Ackroyd', 4, 11, 2, 1926, 'Revised', 'English', 288, 4, 4, 'D4-01', NULL, 'A classic whodunit featuring Hercule Poirot.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(17, NULL, '978-0141183668', 'The Hound of the Baskervilles', 4, 12, 1, 1902, 'Revised', 'English', 256, 3, 3, 'D4-02', NULL, 'Sherlock Holmes investigates a supernatural hound.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(18, NULL, '978-0394758282', 'The Big Sleep', 4, 120, 19, 1939, 'Reprint', 'English', 231, 2, 2, 'D4-03', NULL, 'A hardboiled detective novel featuring Philip Marlowe.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(19, NULL, '978-0307588371', 'Gone Girl', 4, 53, 21, 2012, '1st', 'English', 415, 4, 4, 'D4-04', NULL, 'A psychological thriller about a missing wife.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(20, NULL, '978-0307454546', 'The Girl with the Dragon Tattoo', 4, 52, 18, 2005, '1st', 'English', 672, 3, 3, 'D4-05', NULL, 'A journalist and hacker investigate a decades-old disappearance.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(21, NULL, '978-0307474278', 'The Da Vinci Code', 5, 31, 51, 2003, 'Special Illustrated', 'English', 597, 5, 5, 'E5-01', NULL, 'A symbologist uncovers a conspiracy hidden in art.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(22, NULL, '978-0385416469', 'The Firm', 5, 32, 51, 1991, '1st', 'English', 432, 4, 4, 'E5-02', NULL, 'A young lawyer discovers his firm is a front for the mob.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(23, NULL, '978-0553260113', 'The Bourne Identity', 5, 121, 52, 1980, '1st', 'English', 512, 3, 3, 'E5-03', NULL, 'An amnesiac assassin searches for his identity.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(24, NULL, '978-0425261569', 'Patriot Games', 5, 33, 53, 1987, 'Reprint', 'English', 528, 3, 3, 'E5-04', NULL, 'Jack Ryan foils a terrorist attack.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(25, NULL, '978-1594633669', 'The Girl on the Train', 5, 54, 22, 2015, '1st', 'English', 336, 4, 4, 'E5-05', NULL, 'A commuter witnesses a shocking event from a train.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(26, NULL, '978-0141441146', 'Jane Eyre', 6, 17, 1, 1847, 'Revised', 'English', 532, 3, 3, 'F6-01', NULL, 'A governess falls in love with her mysterious employer.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(27, NULL, '978-0141439556', 'Wuthering Heights', 6, 18, 1, 1847, 'Revised', 'English', 416, 2, 2, 'F6-02', NULL, 'A passionate and tragic love story on the Yorkshire moors.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(28, NULL, '978-0440212560', 'Outlander', 6, 122, 35, 1991, 'Reprint', 'English', 850, 3, 3, 'F6-03', NULL, 'A WWII nurse travels back in time to 18th-century Scotland.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(29, NULL, '978-1455582877', 'The Notebook', 6, 123, 36, 1996, 'Reprint', 'English', 228, 4, 4, 'F6-04', NULL, 'A man reads to his wife from a notebook recounting their love story.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(30, NULL, '978-0143124542', 'Me Before You', 6, 124, 1, 2012, 'Reprint', 'English', 369, 3, 3, 'F6-05', NULL, 'A caregiver and her quadriplegic employer find love.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(31, NULL, '978-0141439477', 'Frankenstein', 7, 9, 1, 1818, 'Revised', 'English', 280, 3, 3, 'G7-01', NULL, 'A scientist creates a sentient creature with tragic consequences.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(32, NULL, '978-0141439846', 'Dracula', 7, 10, 1, 1897, 'Revised', 'English', 418, 4, 4, 'G7-02', NULL, 'Count Dracula moves from Transylvania to England.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(33, NULL, '978-0307743657', 'The Shining', 7, 14, 49, 1977, 'Reprint', 'English', 688, 5, 5, 'G7-03', NULL, 'A family is snowed in at a haunted hotel.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(34, NULL, '978-1501142970', 'It', 7, 14, 13, 1986, 'Reprint', 'English', 1139, 3, 3, 'G7-04', NULL, 'Seven friends confront an evil entity in their hometown.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(35, NULL, '978-0060817221', 'The Exorcist', 7, 125, 2, 1971, 'Reprint', 'English', 340, 2, 2, 'G7-05', NULL, 'A young girl is possessed by a demonic entity.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(36, NULL, '978-0062316097', 'Sapiens', 8, 126, 2, 2011, 'Reprint', 'English', 498, 5, 5, 'H8-02', NULL, 'A brief history of humankind from the Stone Age to the present.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(37, NULL, '978-0393354324', 'Guns, Germs, and Steel', 8, 127, 20, 1997, 'Reprint', 'English', 528, 3, 3, 'H8-03', NULL, 'Why some civilizations conquered others.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(38, NULL, '978-0345476098', 'The Guns of August', 8, 128, 38, 1962, 'Reprint', 'English', 544, 2, 2, 'H8-04', NULL, 'A Pulitzer Prize-winning account of the outbreak of WWI.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(39, NULL, '978-0871404237', 'SPQR', 8, 129, 39, 2015, '1st', 'English', 608, 3, 3, 'H8-05', NULL, 'A sweeping history of ancient Rome.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(40, NULL, '978-0316548182', 'Long Walk to Freedom', 9, 130, 54, 1994, 'Reprint', 'English', 656, 3, 3, 'I9-02', NULL, 'The autobiography of Nelson Mandela.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(41, NULL, '978-1451648539', 'Steve Jobs', 9, 55, 3, 2011, '1st', 'English', 656, 3, 3, 'I9-03', NULL, 'The definitive biography of Steve Jobs.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(42, NULL, '978-0743264747', 'Einstein: His Life and Universe', 9, 55, 3, 2007, 'Reprint', 'English', 704, 2, 2, 'I9-04', NULL, 'A comprehensive biography of Albert Einstein.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(43, NULL, '978-1524763138', 'Becoming', 9, 58, 21, 2018, '1st', 'English', 448, 4, 3, 'I9-05', NULL, 'The memoir of former First Lady Michelle Obama.', 'Available', '2026-08-04 07:08:19', '2026-08-13 03:32:33', NULL, NULL),
(44, NULL, '978-1451639612', 'The 7 Habits of Highly Effective People', 10, 59, 3, 1989, 'Reprint', 'English', 432, 4, 4, 'J10-01', NULL, 'A guide to personal and professional effectiveness.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(45, NULL, '978-1585424337', 'Think and Grow Rich', 10, 61, 1, 1937, 'Reprint', 'English', 384, 3, 3, 'J10-03', NULL, 'A classic guide to achieving wealth and success.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(46, NULL, '978-0671027032', 'How to Win Friends and Influence People', 10, 62, 3, 1936, 'Revised', 'English', 304, 4, 4, 'J10-04', NULL, 'Techniques for handling people and making friends.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(47, NULL, '978-1577314806', 'The Power of Now', 10, 63, 29, 1997, 'Reprint', 'English', 236, 3, 3, 'J10-05', NULL, 'A guide to spiritual enlightenment and living in the present.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(48, NULL, '978-0199291151', 'The Selfish Gene', 11, 64, 6, 1976, '30th Anniversary', 'English', 360, 3, 3, 'K11-02', NULL, 'A revolutionary look at evolution through gene-centered view.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(49, NULL, '978-0345539434', 'Cosmos', 11, 65, 44, 1980, 'Reprint', 'English', 432, 3, 3, 'K11-03', NULL, 'A journey through the universe with astronomer Carl Sagan.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(50, NULL, '978-0140439120', 'The Origin of Species', 11, 66, 1, 1859, 'Revised', 'English', 576, 2, 2, 'K11-04', NULL, 'The foundational work on evolutionary biology.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(51, NULL, '978-0618249060', 'Silent Spring', 11, 67, 55, 1962, 'Reprint', 'English', 400, 2, 2, 'K11-05', NULL, 'A landmark book that launched the environmental movement.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(52, NULL, '978-0132350884', 'Clean Code', 12, 68, 27, 2008, '1st', 'English', 464, 5, 5, 'L12-01', NULL, 'A handbook of agile software craftsmanship.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(53, NULL, '978-0135957059', 'The Pragmatic Programmer', 12, 69, 26, 2019, '20th Anniversary', 'English', 352, 4, 4, 'L12-02', NULL, 'Your journey to mastery in software development.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(54, NULL, '978-0262033848', 'Introduction to Algorithms', 12, 70, 23, 2009, '3rd', 'English', 1312, 3, 3, 'L12-04', NULL, 'A comprehensive textbook on algorithms.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(55, NULL, '978-0262510875', 'Structure and Interpretation of Computer Programs', 22, 72, 23, 1996, '2nd', 'English', 657, 2, 2, 'M13-01', NULL, 'A foundational textbook on computer science principles.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(56, NULL, '978-0134610993', 'Artificial Intelligence: A Modern Approach', 22, 73, 10, 2020, '4th', 'English', 1136, 3, 3, 'M13-02', NULL, 'The standard textbook on artificial intelligence.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(57, NULL, '978-0262035613', 'Deep Learning', 22, 74, 23, 2016, '1st', 'English', 800, 3, 2, 'M13-03', NULL, 'A comprehensive introduction to deep learning.', 'Available', '2026-08-04 07:08:19', '2026-08-11 03:29:55', NULL, NULL),
(58, NULL, '978-0133594140', 'Computer Networking', 22, 75, 10, 2016, '7th', 'English', 864, 2, 2, 'M13-04', NULL, 'A top-down approach to computer networking.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(59, NULL, '978-1119456339', 'Operating System Concepts', 22, 76, 8, 2018, '10th', 'English', 976, 2, 2, 'M13-05', NULL, 'The definitive guide to operating systems.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(60, NULL, '978-1285740621', 'Calculus', 14, 77, 28, 2015, '8th', 'English', 1392, 4, 4, 'N14-01', NULL, 'A comprehensive calculus textbook.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(61, NULL, '978-0321982384', 'Linear Algebra and Its Applications', 14, 78, 10, 2015, '5th', 'English', 576, 3, 3, 'N14-02', NULL, 'An introduction to linear algebra.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(62, NULL, '978-0073383095', 'Discrete Mathematics and Its Applications', 14, 79, 9, 2018, '8th', 'English', 1072, 3, 3, 'N14-03', NULL, 'A comprehensive guide to discrete mathematics.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(63, NULL, '978-0977304561', 'The Art of Problem Solving', 14, 80, 33, 2006, '1st', 'English', 288, 2, 2, 'N14-04', NULL, 'A problem-solving approach to mathematics.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(64, NULL, '978-1138369917', 'Introduction to Probability', 14, 81, 34, 2014, '1st', 'English', 592, 2, 2, 'N14-05', NULL, 'An introduction to probability theory and its applications.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(65, NULL, '978-0140449334', 'Meditations', 15, 82, 1, 180, 'Revised', 'English', 256, 3, 3, 'O15-01', NULL, 'Personal writings of the Roman Emperor Marcus Aurelius.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(66, NULL, '978-0140455113', 'The Republic', 15, 83, 1, -380, 'Revised', 'English', 416, 3, 3, 'O15-02', NULL, 'Plato\'s masterwork on justice and the ideal state.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(67, NULL, '978-0140459530', 'Nicomachean Ethics', 15, 84, 1, -340, 'Revised', 'English', 400, 2, 2, 'O15-03', NULL, 'Aristotle\'s seminal work on ethics and virtue.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(68, NULL, '978-0140449235', 'Beyond Good and Evil', 15, 85, 1, 1886, 'Revised', 'English', 240, 2, 2, 'O15-04', NULL, 'Nietzsche\'s critique of traditional morality.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(69, NULL, '978-0671867805', 'Being and Nothingness', 15, 86, 3, 1943, 'Reprint', 'English', 835, 2, 2, 'O15-05', NULL, 'Sartre\'s existentialist masterpiece.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(70, NULL, '978-0374533557', 'Thinking, Fast and Slow', 16, 87, 43, 2011, 'Reprint', 'English', 512, 4, 4, 'P16-01', NULL, 'Nobel laureate Daniel Kahneman explains how we think.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(71, NULL, '978-0807014271', 'Man\'s Search for Meaning', 16, 88, 31, 1946, 'Revised', 'English', 200, 3, 3, 'P16-02', NULL, 'A psychiatrist\'s memoir of surviving the Holocaust.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(72, NULL, '978-0812981605', 'The Power of Habit', 16, 89, 44, 2012, 'Reprint', 'English', 400, 3, 3, 'P16-03', NULL, 'Why we do what we do in life and business.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(73, NULL, '978-0316013324', 'Blink', 16, 91, 37, 2005, 'Reprint', 'English', 304, 2, 2, 'P16-05', NULL, 'The power of thinking without thinking.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(74, NULL, '978-0714832470', 'The Story of Art', 23, 92, 32, 1950, '16th Revised', 'English', 688, 2, 2, 'Q17-01', NULL, 'A comprehensive history of art from ancient times to the modern era.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(75, NULL, '978-0140135152', 'Ways of Seeing', 23, 93, 1, 1972, 'Reprint', 'English', 176, 2, 2, 'Q17-02', NULL, 'A groundbreaking critique of visual culture.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(76, NULL, '978-0465007172', 'The Art Spirit', 23, 94, 30, 1923, 'Reprint', 'English', 320, 2, 2, 'Q17-03', NULL, 'Notes on art and creativity.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(77, NULL, '978-0312427719', 'The Rest Is Noise', 24, 95, 43, 2007, 'Reprint', 'English', 640, 2, 2, 'R18-01', NULL, 'A history of 20th-century music.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(78, NULL, '978-0141182517', 'The Waste Land', 25, 97, 1, 1922, 'Revised', 'English', 128, 2, 2, 'S19-01', NULL, 'A landmark modernist poem.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(79, NULL, '978-0140422006', 'Leaves of Grass', 25, 98, 1, 1855, 'Revised', 'English', 152, 2, 2, 'S19-02', NULL, 'A collection of poems celebrating nature and the human spirit.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(80, NULL, '978-0743477123', 'Hamlet', 26, 23, 3, 1603, 'Revised', 'English', 342, 3, 3, 'T20-01', NULL, 'Shakespeare\'s tragedy about the Prince of Denmark.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(81, NULL, '978-0743477116', 'Romeo and Juliet', 26, 23, 3, 1597, 'Revised', 'English', 304, 3, 3, 'T20-02', NULL, 'The tragic love story of two young lovers.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(82, NULL, '978-0743477109', 'Macbeth', 26, 23, 3, 1606, 'Revised', 'English', 272, 2, 2, 'T20-03', NULL, 'A tragedy about ambition, power, and guilt.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(83, NULL, '978-0142437190', 'In Patagonia', 28, 99, 1, 1977, 'Reprint', 'English', 240, 2, 2, 'U21-01', NULL, 'A travelogue exploring the remote region of Patagonia.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(84, NULL, '978-0143038412', 'Eat, Pray, Love', 28, 100, 1, 2006, 'Reprint', 'English', 352, 3, 3, 'U21-02', NULL, 'A woman travels to Italy, India, and Bali in search of meaning.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(85, NULL, '978-0375413407', 'Mastering the Art of French Cooking', 29, 101, 18, 1961, 'Revised', 'English', 752, 3, 3, 'V22-01', NULL, 'A classic French cookbook for home cooks.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(86, NULL, '978-1476759700', 'Salt, Fat, Acid, Heat', 29, 102, 3, 2017, '1st', 'English', 464, 2, 2, 'V22-02', NULL, 'A revolutionary approach to cooking.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(87, NULL, '978-1501169714', 'The Joy of Cooking', 29, 103, 13, 1931, 'Revised', 'English', 1152, 2, 2, 'V22-03', NULL, 'The all-purpose cookbook.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(88, NULL, '978-0307388381', 'Open', 30, 104, 18, 2009, 'Reprint', 'English', 416, 2, 2, 'W23-01', NULL, 'The autobiography of tennis legend Andre Agassi.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(89, NULL, '978-0393338391', 'Moneyball', 30, 105, 20, 2003, 'Reprint', 'English', 304, 2, 2, 'W23-02', NULL, 'How Billy Beane used analytics to transform baseball.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(90, NULL, '978-0393337592', 'The Blind Side', 30, 105, 20, 2006, 'Reprint', 'English', 336, 2, 2, 'W23-03', NULL, 'The evolution of American football and the left tackle position.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(91, NULL, '978-0140436114', 'The Wealth of Nations', 18, 106, 1, 1776, 'Revised', 'English', 1248, 2, 2, 'X24-01', NULL, 'The foundational work on modern economics.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(92, NULL, '978-0060731335', 'Freakonomics', 18, 107, 2, 2005, 'Reprint', 'English', 336, 3, 3, 'X24-02', NULL, 'A rogue economist explores the hidden side of everything.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(93, NULL, '978-0674979857', 'Capital in the Twenty-First Century', 18, 108, 24, 2014, 'Reprint', 'English', 696, 2, 2, 'X24-03', NULL, 'An analysis of wealth inequality over centuries.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(94, NULL, '978-1501314134', 'Pedagogy of the Oppressed', 20, 109, 46, 1968, 'Revised', 'English', 192, 2, 2, 'Y25-01', NULL, 'A critical approach to education and liberation.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(95, NULL, '978-0201484025', 'How Children Learn', 20, 110, 47, 1967, 'Reprint', 'English', 320, 2, 2, 'Y25-02', NULL, 'A classic on how children naturally learn.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(96, NULL, '978-0670023179', 'The Element', 20, 111, 48, 2009, 'Reprint', 'English', 288, 2, 2, 'Y25-03', NULL, 'How finding your passion changes everything.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(97, NULL, '978-1439170915', 'The Emperor of All Maladies', 21, 56, 13, 2010, 'Reprint', 'English', 592, 2, 2, 'Z26-01', NULL, 'A biography of cancer from ancient times to modern treatments.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(98, NULL, '978-0812988406', 'When Breath Becomes Air', 21, 57, 44, 2016, '1st', 'English', 228, 3, 3, 'Z26-02', NULL, 'A neurosurgeon confronts mortality.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(99, NULL, '978-1476733524', 'The Gene', 21, 56, 13, 2016, 'Reprint', 'English', 608, 2, 2, 'Z26-03', NULL, 'An intimate history of the gene and its impact on identity.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(100, NULL, '978-0226285546', 'Structures', 13, 112, 25, 1978, 'Reprint', 'English', 256, 2, 2, 'AA27-01', NULL, 'Why things don\'t fall down - an accessible look at structural engineering.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(101, NULL, '978-1476708690', 'The Innovators', 13, 55, 3, 2014, 'Reprint', 'English', 560, 2, 2, 'AA27-02', NULL, 'The story of the digital revolution and its genius hackers.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(102, NULL, '978-0679734163', 'To Engineer Is Human', 13, 113, 19, 1985, 'Reprint', 'English', 288, 2, 2, 'AA27-03', NULL, 'The role of failure in successful design.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(103, NULL, '978-0316346627', 'The Tipping Point', 17, 91, 37, 2000, 'Reprint', 'English', 304, 3, 3, 'BB28-01', NULL, 'How little things can make a big difference.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(104, NULL, '978-0316017932', 'Outliers', 17, 91, 37, 2008, 'Reprint', 'English', 336, 3, 3, 'BB28-02', NULL, 'The story of success and what makes high-achievers different.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(105, NULL, '978-0743203043', 'Bowling Alone', 17, 114, 3, 2000, 'Reprint', 'English', 544, 2, 2, 'BB28-03', NULL, 'The collapse and revival of American community.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(106, NULL, '978-0140449159', 'The Prince', 19, 115, 1, 1532, 'Revised', 'English', 176, 2, 2, 'CC29-01', NULL, 'Machiavelli\'s classic treatise on political power.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(107, NULL, '978-0140431957', 'Leviathan', 19, 116, 1, 1651, 'Revised', 'English', 576, 2, 2, 'CC29-02', NULL, 'Hobbes\' foundational work on social contract theory.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(108, NULL, '978-1401245252', 'Watchmen', 27, 117, 41, 1986, 'Deluxe', 'English', 416, 3, 3, 'DD30-01', NULL, 'A groundbreaking graphic novel about retired superheroes.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(109, NULL, '978-1563893421', 'Batman: The Dark Knight Returns', 27, 118, 41, 1986, 'Reprint', 'English', 224, 2, 2, 'DD30-02', NULL, 'An aging Batman returns to fight crime.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(110, NULL, '978-0679406417', 'Maus', 27, 119, 40, 1986, 'Reprint', 'English', 296, 2, 2, 'DD30-03', NULL, 'A Pulitzer Prize-winning graphic novel about the Holocaust.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_records`
--

CREATE TABLE `borrow_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `borrowed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('Pending','Borrowed','Returned','Overdue','Cancelled') DEFAULT 'Borrowed',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `journal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thesis_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_records`
--

INSERT INTO `borrow_records` (`id`, `member_id`, `book_id`, `borrowed_by`, `borrow_date`, `due_date`, `status`, `remarks`, `created_at`, `updated_at`, `journal_id`, `thesis_id`) VALUES
(1, 14, 57, 23, '2026-08-11', '2026-08-14', 'Borrowed', NULL, '2026-08-11 03:26:25', '2026-08-11 03:29:55', NULL, NULL),
(2, 15, 1, 25, '2026-08-12', '2026-08-15', 'Borrowed', NULL, '2026-08-12 04:43:20', '2026-08-12 05:42:26', NULL, NULL),
(3, 15, 2, 25, '2026-08-12', '2026-08-15', 'Borrowed', NULL, '2026-08-12 09:49:46', '2026-08-13 01:22:46', NULL, NULL),
(4, 15, 43, 25, '2026-08-13', '2026-08-16', 'Borrowed', NULL, '2026-08-13 03:30:31', '2026-08-13 03:32:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fiction', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(2, 'Science Fiction', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(3, 'Fantasy', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(4, 'Mystery', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(5, 'Thriller', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(6, 'Romance', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(7, 'Horror', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(8, 'History', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(9, 'Biography', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(10, 'Self-Help', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(11, 'Science', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(12, 'Technology', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(13, 'Engineering', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(14, 'Mathematics', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(15, 'Philosophy', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(16, 'Psychology', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(17, 'Sociology', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(18, 'Economics', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(19, 'Political Science', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(20, 'Education', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(21, 'Medicine', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(22, 'Computer Science', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(23, 'Art', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(24, 'Music', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(25, 'Poetry', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(26, 'Drama', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(27, 'Comics', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(28, 'Travel', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(29, 'Cooking', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(30, 'Sports', NULL, '2026-08-04 07:08:19', '2026-08-04 07:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `deletion_requests`
--

CREATE TABLE `deletion_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `reason` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deletion_requests`
--

INSERT INTO `deletion_requests` (`id`, `user_id`, `item_type`, `item_id`, `title`, `status`, `reason`, `rejection_reason`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 24, 'App\\Models\\Journal', '1', 'CRISPR-Cas9 Gene Editing: A Comprehensive Review', 'Approved', NULL, NULL, 2, '2026-08-11 06:32:16', '2026-08-11 06:22:40', '2026-08-11 06:32:16'),
(2, 24, 'App\\Models\\Book', '1', '1984', 'Rejected', NULL, 'Item is still referenced in other records.', 2, '2026-08-11 06:32:41', '2026-08-11 06:31:27', '2026-08-11 06:32:41'),
(3, 24, 'App\\Models\\Book', '1', '1984', 'Rejected', NULL, 'Still usable', 2, '2026-08-11 06:34:38', '2026-08-11 06:32:40', '2026-08-11 06:34:38'),
(4, 24, 'App\\Models\\Book', '2', 'Brave New World', 'Approved', NULL, NULL, 2, '2026-08-11 06:42:38', '2026-08-11 06:42:38', '2026-08-11 06:42:38'),
(5, 24, 'App\\Models\\Book', '1', '1984', 'Rejected', NULL, 'This book is currently borrowed by a member and cannot be deleted.', 2, '2026-08-11 06:42:38', '2026-08-11 06:42:38', '2026-08-11 06:42:38'),
(6, 24, 'App\\Models\\Book', '1', '1984', 'Rejected', NULL, 'Pages are still intact and the book is still usable', 2, '2026-08-11 06:46:25', '2026-08-11 06:44:26', '2026-08-11 06:46:25'),
(7, 24, 'App\\Models\\Journal', '1', 'CRISPR-Cas9 Gene Editing: A Comprehensive Review', 'Rejected', NULL, NULL, 2, '2026-08-12 01:11:23', '2026-08-11 08:42:57', '2026-08-12 01:11:23'),
(8, 24, 'App\\Models\\Journal', '1', 'CRISPR-Cas9 Gene Editing: A Comprehensive Review', 'Rejected', NULL, 'still usable', 2, '2026-08-12 01:17:45', '2026-08-12 01:16:56', '2026-08-12 01:17:45'),
(9, 24, 'App\\Models\\Journal', '6', 'Online Learning Effectiveness: A Meta-Analysis', 'Rejected', NULL, 'Still Usable', 2, '2026-08-12 01:19:25', '2026-08-12 01:18:15', '2026-08-12 01:19:25'),
(10, 24, 'App\\Models\\Journal', '1', 'CRISPR-Cas9 Gene Editing: A Comprehensive Review', 'Rejected', NULL, 'Still Ok and Usable', 2, '2026-08-12 01:35:48', '2026-08-12 01:26:42', '2026-08-12 01:35:48'),
(11, 24, 'App\\Models\\Journal', '3', 'Deep Learning Approaches for Natural Language Processing', 'Rejected', NULL, 'No Need to Delete this', 2, '2026-08-12 04:18:47', '2026-08-12 04:17:51', '2026-08-12 04:18:47'),
(12, 24, 'App\\Models\\Journal', '1', 'CRISPR-Cas9 Gene Editing: A Comprehensive Review', 'Rejected', NULL, 'adsa', 2, '2026-08-12 09:47:44', '2026-08-12 05:05:19', '2026-08-12 09:47:44');

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
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrow_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `reason` varchar(255) DEFAULT NULL,
  `paid` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `authors` text NOT NULL,
  `volume` varchar(50) DEFAULT NULL,
  `issue` varchar(50) DEFAULT NULL,
  `pages` varchar(50) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `doi` varchar(255) DEFAULT NULL,
  `issn` varchar(20) DEFAULT NULL,
  `database_collection` varchar(255) DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `subjects` varchar(500) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_text` varchar(255) DEFAULT NULL,
  `abstract` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Available','Unavailable','Archived') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `journal_name`, `title`, `source`, `authors`, `volume`, `issue`, `pages`, `publication_date`, `doi`, `issn`, `database_collection`, `availability`, `subjects`, `keyword`, `link`, `category_id`, `publisher_id`, `publisher_text`, `abstract`, `description`, `status`, `created_at`, `updated_at`, `added_by`, `edited_by`) VALUES
(1, 'Nature', 'CRISPR-Cas9 Gene Editing: A Comprehensive Review of Related Literature', 'Nature', 'Jennifer Doudna, Emmanuelle Charpentier', '578', '7795', '1-10', '2020-02-13', '10.1038/s41586-020-1932-1', NULL, NULL, 'Available', NULL, NULL, 'https://www.nature.com/articles/s41586-020-1932-1', 22, 23, NULL, 'A comprehensive review of the CRISPR-Cas9 gene editing technology and its applications in modern biology.', 'This journal article provides an in-depth analysis of CRISPR-Cas9, discussing its mechanism, applications, and ethical considerations.', 'Available', '2026-08-04 07:08:19', '2026-08-12 09:05:14', NULL, 'Reserve'),
(2, 'The Lancet', 'Global Health Challenges in the 21st Century', NULL, 'Margaret Chan, Tedros Adhanom', '395', '10223', '112-119', '2020-01-18', '10.1016/S0140-6736(19)32378-1', NULL, NULL, NULL, NULL, NULL, 'https://www.thelancet.com/journals/lancet/article/PIIS0140-6736(19)32378-1/fulltext', 21, 2, NULL, 'An overview of the major global health challenges facing humanity in the 21st century.', 'This article examines emerging infectious diseases, climate change impacts, and healthcare disparities worldwide.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(3, 'Journal of Machine Learning Research 2.0', 'Deep Learning Approaches for Natural Language Processing', 'Journal of Machine Learning Research 2.0', 'Yoshua Bengio, Ian Goodfellow, Aaron Courville', '21', '3', '1-37', '2020-03-15', '10.5555/3455716.3455721', NULL, NULL, 'Available', NULL, NULL, 'https://jmlr.org/papers/v21/20-302.html', 22, 23, NULL, 'A survey of deep learning techniques applied to natural language processing tasks.', 'This paper reviews state-of-the-art deep learning models for NLP, including transformers, BERT, and GPT architectures.', 'Available', '2026-08-04 07:08:19', '2026-08-12 09:45:25', NULL, 'Reserve\r\nPeriodicals\r\nCirculation\r\nITS\r\nTechnical'),
(4, 'American Economic Review', 'Inequality in the Modern Economy: Causes and Policy Responses', NULL, 'Thomas Piketty, Emmanuel Saez', '109', '9', '2875-2920', '2019-11-01', '10.1257/aer.20190123', NULL, NULL, NULL, NULL, NULL, 'https://www.aeaweb.org/articles?id=10.1257/aer.20190123', 18, 20, NULL, 'An analysis of economic inequality trends and evaluation of policy interventions.', 'This paper examines the rise in income and wealth inequality and assesses various policy responses including taxation and social programs.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(5, 'Journal of Environmental Psychology', 'Climate Change Anxiety and Mental Health: A Global Perspective', NULL, 'Susan Clayton, Ashlee Cunsolo', '72', '1', '1-12', '2020-06-01', '10.1016/j.jenvp.2020.101502', NULL, NULL, NULL, NULL, NULL, 'https://www.sciencedirect.com/science/article/pii/S0272494420302142', 16, 8, NULL, 'An exploration of the psychological impacts of climate change on mental health worldwide.', 'This study investigates eco-anxiety, climate grief, and other psychological responses to environmental crises.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(6, 'Review of Educational Research', 'Online Learning Effectiveness: A Meta-Analysis', NULL, 'Barbara Means, Ya-Ling Chen', '90', '2', '143-182', '2020-04-01', '10.3102/0034654320916423', NULL, NULL, NULL, NULL, NULL, 'https://journals.sagepub.com/doi/abs/10.3102/0034654320916423', 20, 7, NULL, 'A meta-analysis examining the effectiveness of online learning compared to traditional face-to-face instruction.', 'This comprehensive meta-analysis synthesizes findings from over 100 studies on online learning outcomes.', 'Available', '2026-08-04 07:08:19', '2026-08-04 07:08:19', NULL, NULL),
(7, 'Physical Review Letters', 'Quantum Computing: Recent Advances and Future Directions', NULL, 'John Preskill, Scott Aaronson', '123', '14', '140501-140508', '2019-10-04', '10.1103/PhysRevLett.123.140501', NULL, NULL, NULL, NULL, NULL, 'https://journals.aps.org/prl/abstract/10.1103/PhysRevLett.123.140501', 11, 24, NULL, 'A review of recent advances in quantum computing and discussion of future research directions.', 'This article covers quantum error correction, quantum supremacy experiments, and potential applications of quantum computers.', 'Available', '2026-08-04 07:11:25', '2026-08-04 07:11:25', NULL, NULL),
(13, 'Tourism Geographies: An International Journal of Tourism Space and Environment', 'The spectral geographies of slavery: tourism and the hauntings of distant colonial heritage', 'Tourism Geographies: An International Journal of Tourism Space and Environment', 'Dan Knox', '27', '2025', '17-30', '2024-02-23', 'doi.org/10.1080/14616688.2024.2328612', 'Print ISSN 146-6688', NULL, 'Available', 'Tourism', 'Tourism', 'https://creativecommons.org/licenses/by-nc-nd/4..0/)', NULL, NULL, 'Informa UK Limited trading as Taylor & Francis Group', 'The spectral geography of the colonial legacy in Bristol is marked by a series of absences from official and tourist narratives about the city. The people and practices of the Atlantic slave trade are part of the historical and contemporary fabric of the city and per-sist as ever-present spectres. There are significant differences of view that agree with little beyond that the city was a major port of Empire and a significant site in the triangular trade. Bristol is commonly portrayed as a multicultural city with a rebellious spirit and a strong commitment to social justice. This urban imaginary is evident in accounts of the removal of a statue of Edward Colston, a slave trader and philanthropist, during a Black Lives Matter rally in 2020. The now empty plinth of the Colston statue has become a contested, liminal space that sits between disparate interpreta-tions and radically different points in time in terms of social rela-tions. Individual and collective memories and stories about slavery constitute hauntings in a spectral geography of Bristol. Such stories are rarely heard, and the city is thus haunted by the absences of the voices of those enslaved and a lack of knowledge of the role of slavery in the growth and historic prosperity of the city. Little has been done to incorporate such dissonant heritage and so the histories of slavers, slavery, and slaves are not significant themes in tourism marketing, attractions or experiences in the city. This paper demonstrates that a process of coming to terms with difficult her-itage and associated hauntings offers significant potential for tour-ism to contribute to historic and contemporary social justice.', 'The article explores how the history of slavery and colonialism continues to influence tourism and the way people understand historical places. It explains that former sites connected to slavery can be viewed as “haunted” spaces because the memories, suffering, and experiences of enslaved people remain connected to these locations. The article also highlights how tourism can bring attention to these difficult histories, but it can sometimes simplify or commercialize the suffering of the past. Overall, the article emphasizes the importance of remembering colonial and slavery histories responsibly and recognizing the people and communities affected by them.', 'Available', '2026-08-12 03:52:08', '2026-08-12 03:52:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_no` varchar(30) NOT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year_level` varchar(20) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `member_no`, `course`, `year_level`, `contact_number`, `address`, `created_at`, `updated_at`) VALUES
(11, 16, 'MEM-000016', 'BEED', '3rd Year', '0987326325523', 'TALAMBAN, CEBU', '2026-08-04 08:24:54', '2026-08-04 08:24:54'),
(12, 21, 'MEM-000021', NULL, NULL, NULL, NULL, '2026-08-07 15:26:38', '2026-08-07 15:26:38'),
(13, 22, 'MEM-000022', NULL, NULL, NULL, NULL, '2026-08-10 02:43:25', '2026-08-10 02:43:25'),
(14, 23, 'MEM-000023', NULL, NULL, NULL, NULL, '2026-08-10 03:45:52', '2026-08-10 03:45:52'),
(15, 25, 'MEM-000025', 'BSIT', '4th Year', '097512466124', 'TALAMBAN', '2026-08-12 04:21:17', '2026-08-12 04:21:17');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_31_144037_create_authors_table', 1),
(5, '2026_07_31_144037_create_categories_table', 1),
(6, '2026_07_31_144037_create_publishers_table', 1),
(7, '2026_07_31_144038_create_books_table', 1),
(8, '2026_07_31_144038a_create_members_table', 1),
(9, '2026_07_31_144038b_create_borrow_records_table', 1),
(10, '2026_07_31_144039_create_activity_logs_table', 1),
(11, '2026_07_31_144039_create_fines_table', 1),
(12, '2026_07_31_144039_create_reservations_table', 1),
(13, '2026_07_31_144039_create_return_records_table', 1),
(14, '2026_08_01_200000_change_publication_year_to_integer_in_books_table', 1),
(15, '2026_08_01_200001_add_missing_columns_to_users_table', 1),
(16, '2026_08_01_200002_add_google_columns_to_users_table', 1),
(17, '2026_08_02_073912_add_pending_and_cancelled_to_borrow_records_table', 1),
(18, '2026_08_02_145047_create_notifications_table', 1),
(19, '2026_08_04_000001_create_journals_table', 1),
(20, '2026_08_04_000002_create_theses_table', 1),
(21, '2026_08_04_000003_add_journal_and_thesis_to_borrow_records_table', 1),
(22, '2026_08_04_000004_add_journal_and_thesis_to_reservations_table', 1),
(23, '2026_08_10_000001_add_extra_fields_to_journals_and_theses_table', 2),
(24, '2026_08_11_134247_create_deletion_requests_table', 3),
(25, '2026_08_11_134248_add_working_student_role_to_users_table', 3),
(26, '2026_08_11_140638_hash_carlos_password', 4),
(27, '2026_08_11_140639_add_publisher_and_category_text_to_journals_table', 5),
(28, '2026_08_11_140640_add_source_to_journals_table', 5),
(29, '2026_08_11_140641_add_keyword_to_journals_table', 6),
(30, '2026_08_11_140642_drop_category_text_from_journals_table', 6),
(31, '2026_08_12_161357_add_section_to_users_table', 7),
(32, '2026_08_12_162220_add_added_by_and_edited_by_to_journals_table', 8),
(33, '2026_08_12_162221_add_added_by_and_edited_by_to_books_table', 8),
(34, '2026_08_12_162222_add_added_by_and_edited_by_to_theses_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `borrow_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `sent_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `borrow_id`, `reservation_id`, `title`, `message`, `is_read`, `sent_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of book \"1984\" (ID: 1)', 0, 24, '2026-08-11 06:31:27', '2026-08-11 06:31:27'),
(2, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of book \"1984\" (ID: 1)', 0, 24, '2026-08-11 06:31:27', '2026-08-11 06:31:27'),
(5, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of book \"1984\" (ID: 1)', 0, 24, '2026-08-11 06:31:27', '2026-08-11 06:31:27'),
(6, 24, 'deletion_request', NULL, NULL, 'Deletion Request Approved', 'Your deletion request for App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' has been approved and the item has been deleted.', 0, 2, '2026-08-11 06:32:16', '2026-08-11 06:32:16'),
(7, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Book \'1984\' has been rejected. Reason: Item is still referenced in other records.', 0, 2, '2026-08-11 06:32:41', '2026-08-11 06:32:41'),
(8, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Book \'1984\' has been rejected. Reason: Still usable', 0, 2, '2026-08-11 06:34:38', '2026-08-11 06:34:38'),
(9, 24, 'deletion_request', NULL, NULL, 'Deletion Request Approved', 'Your deletion request for App\\Models\\Book \'Brave New World\' has been approved and the item has been deleted.', 0, 2, '2026-08-11 06:42:38', '2026-08-11 06:42:38'),
(10, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Book \'1984\' has been rejected. Reason: This book is currently borrowed by a member and cannot be deleted.', 0, 2, '2026-08-11 06:42:38', '2026-08-11 06:42:38'),
(11, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of book \"1984\" (ID: 1)', 0, 24, '2026-08-11 06:44:26', '2026-08-11 06:44:26'),
(12, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of book \"1984\" (ID: 1)', 0, 24, '2026-08-11 06:44:26', '2026-08-11 06:44:26'),
(15, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of book \"1984\" (ID: 1)', 0, 24, '2026-08-11 06:44:26', '2026-08-11 06:44:26'),
(16, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Book \'1984\' has been rejected. Reason: Pages are still intact and the book is still usable', 0, 2, '2026-08-11 06:46:25', '2026-08-11 06:46:25'),
(17, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-11 08:42:57', '2026-08-11 08:42:57'),
(18, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-11 08:42:57', '2026-08-11 08:42:57'),
(19, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-11 08:42:57', '2026-08-11 08:42:57'),
(20, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' has been rejected.', 0, 2, '2026-08-12 01:11:23', '2026-08-12 01:11:23'),
(21, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 01:16:56', '2026-08-12 01:16:56'),
(22, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 01:16:56', '2026-08-12 01:16:56'),
(23, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 01:16:56', '2026-08-12 01:16:56'),
(24, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' has been rejected. Reason: still usable', 0, 2, '2026-08-12 01:17:45', '2026-08-12 01:17:45'),
(25, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"Online Learning Effectiveness: A Meta-Analysis\" (ID: 6)', 0, 24, '2026-08-12 01:18:15', '2026-08-12 01:18:15'),
(26, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"Online Learning Effectiveness: A Meta-Analysis\" (ID: 6)', 0, 24, '2026-08-12 01:18:15', '2026-08-12 01:18:15'),
(27, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"Online Learning Effectiveness: A Meta-Analysis\" (ID: 6)', 0, 24, '2026-08-12 01:18:15', '2026-08-12 01:18:15'),
(28, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Journal \'Online Learning Effectiveness: A Meta-Analysis\' has been rejected. Reason: Still Usable', 0, 2, '2026-08-12 01:19:25', '2026-08-12 01:19:25'),
(29, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 01:26:42', '2026-08-12 01:26:42'),
(30, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 01:26:42', '2026-08-12 01:26:42'),
(31, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 01:26:42', '2026-08-12 01:26:42'),
(32, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' was rejected by Maria Santos. Reason: Still Ok and Usable', 0, 2, '2026-08-12 01:35:48', '2026-08-12 01:35:48'),
(33, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"Deep Learning Approaches for Natural Language Processing\" (ID: 3)', 0, 24, '2026-08-12 04:17:51', '2026-08-12 04:17:51'),
(34, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"Deep Learning Approaches for Natural Language Processing\" (ID: 3)', 0, 24, '2026-08-12 04:17:51', '2026-08-12 04:17:51'),
(35, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"Deep Learning Approaches for Natural Language Processing\" (ID: 3)', 0, 24, '2026-08-12 04:17:51', '2026-08-12 04:17:51'),
(36, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Journal \'Deep Learning Approaches for Natural Language Processing\' was rejected by Maria Santos. Reason: No Need to Delete this', 0, 2, '2026-08-12 04:18:47', '2026-08-12 04:18:47'),
(37, 1, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 05:05:19', '2026-08-12 05:05:19'),
(38, 2, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 05:05:19', '2026-08-12 05:05:19'),
(39, 17, 'deletion_request', NULL, NULL, 'New Deletion Request', 'Carlos Mendoza (Working-Student) requested deletion of journal \"CRISPR-Cas9 Gene Editing: A Comprehensive Review\" (ID: 1)', 0, 24, '2026-08-12 05:05:19', '2026-08-12 05:05:19'),
(40, 24, 'deletion_request', NULL, NULL, 'Deletion Request Rejected', 'Your deletion request for App\\Models\\Journal \'CRISPR-Cas9 Gene Editing: A Comprehensive Review\' was rejected by Maria Santos. Reason: adsa', 0, 2, '2026-08-12 09:47:44', '2026-08-12 09:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `publisher_name`, `address`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 'Penguin Random House', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(2, 'HarperCollins', '195 Broadway, New York, NY', '212-207-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(3, 'Simon & Schuster', '1230 Avenue of the Americas, New York, NY', '212-698-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(4, 'Macmillan Publishers', '120 Broadway, New York, NY', '646-638-6000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(5, 'Hachette Book Group', '1290 Avenue of the Americas, New York, NY', '212-364-1100', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(6, 'Oxford University Press', '198 Madison Avenue, New York, NY', '212-726-6000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(7, 'Cambridge University Press', '32 Avenue of the Americas, New York, NY', '212-337-5000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(8, 'Wiley', '111 River Street, Hoboken, NJ', '201-748-6000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(9, 'McGraw-Hill Education', '2525 NOL, New York, NY', '212-904-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(10, 'Pearson Education', '221 River Street, Hoboken, NJ', '201-236-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(11, 'Scholastic Corporation', '557 Broadway, New York, NY', '212-505-3000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(12, 'Bloomsbury Publishing', '1385 Broadway, New York, NY', '212-419-5300', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(13, 'Scribner', '1230 Avenue of the Americas, New York, NY', '212-698-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(14, 'Bantam Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(15, 'Ace Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(16, 'DAW Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(17, 'Tor Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(18, 'Knopf', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(19, 'Vintage Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(20, 'W.W. Norton', '500 Fifth Avenue, New York, NY', '212-555-0100', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(21, 'Crown Publishing', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(22, 'Riverhead Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(23, 'MIT Press', 'One Rogers Street, Cambridge, MA', '617-625-8400', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(24, 'Harvard University Press', '79 Garden Street, Cambridge, MA', '617-495-2600', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(25, 'University of Chicago Press', '1427 E. 60th Street, Chicago, IL', '773-702-7700', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(26, 'Addison-Wesley', '75 Arlington Street, Boston, MA', '617-848-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(27, 'Prentice Hall', '1 Lake Street, Upper Saddle River, NJ', '201-236-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(28, 'Cengage Learning', '200 Pier 4 Boulevard, Boston, MA', '617-289-7700', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(29, 'New World Library', '14 Pamaron Way, Novato, CA', '415-884-2100', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(30, 'Basic Books', '1290 Avenue of the Americas, New York, NY', '212-364-1100', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(31, 'Beacon Press', '24 Beacon Street, Boston, MA', '617-742-2110', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(32, 'Phaidon Press', '65 Bleecker Street, New York, NY', '212-759-0909', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(33, 'AoPS Inc', '2846 Marburg Avenue, Columbus, OH', '614-447-7777', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(34, 'Chapman and Hall', '2-6 Boundary Row, London, UK', '+44-20-7777-7000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(35, 'Delacorte Press', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(36, 'Grand Central Publishing', '345 Hudson Street, New York, NY', '212-699-9000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(37, 'Back Bay Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(38, 'Presidio Press', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(39, 'Liveright Publishing', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(40, 'Pantheon Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(41, 'DC Comics', '1700 Broadway, New York, NY', '212-656-1000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(42, 'Vintage', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(43, 'Farrar, Straus and Giroux', '120 Broadway, New York, NY', '646-638-6000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(44, 'Random House', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(45, 'Liverpool University Press', '4 Cambridge Street, Liverpool, UK', '+44-151-794-2233', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(46, 'Bloomsbury Academic', '1385 Broadway, New York, NY', '212-419-5300', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(47, 'Da Capo Press', '44 Cambridge Street, Boston, MA', '617-584-8388', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(48, 'Viking', '1875 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(49, 'Anchor Books', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(50, 'G.P. Putnam\'s Sons', '345 Hudson Street, New York, NY', '212-699-9000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(51, 'Doubleday', '1745 Broadway, New York, NY', '212-366-2000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(52, 'Richard Marek Publishers', '200 Madison Avenue, New York, NY', '212-685-6400', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(53, 'Putnam', '345 Hudson Street, New York, NY', '212-699-9000', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(54, 'Little, Brown', '1290 Avenue of the Americas, New York, NY', '212-364-1100', '2026-08-04 07:08:19', '2026-08-04 07:08:19'),
(55, 'Houghton Mifflin', '215 Park Avenue South, New York, NY', '212-566-8200', '2026-08-04 07:08:19', '2026-08-04 07:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `book_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Cancelled','Claimed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `journal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thesis_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `member_id`, `book_id`, `reservation_date`, `expiration_date`, `status`, `created_at`, `updated_at`, `journal_id`, `thesis_id`) VALUES
(1, 11, 6, '2026-08-04', NULL, 'Approved', '2026-08-04 08:38:50', '2026-08-07 06:23:41', NULL, NULL),
(2, 13, 55, '2026-08-10', NULL, 'Approved', '2026-08-10 08:36:04', '2026-08-10 08:36:59', NULL, NULL),
(3, 15, NULL, '2026-08-12', '2026-08-19', 'Approved', '2026-08-12 06:44:37', '2026-08-12 08:43:33', 13, NULL),
(4, 15, NULL, '2026-08-12', '2026-08-19', 'Approved', '2026-08-12 09:49:00', '2026-08-12 09:50:20', 13, NULL),
(5, 15, 2, '2026-08-12', '2026-08-19', 'Approved', '2026-08-12 09:49:41', '2026-08-13 01:57:51', NULL, NULL),
(6, 15, 109, '2026-08-13', '2026-08-20', 'Pending', '2026-08-13 03:30:23', '2026-08-13 03:30:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `return_records`
--

CREATE TABLE `return_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrow_id` bigint(20) UNSIGNED NOT NULL,
  `returned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `condition_status` enum('Good','Damaged','Lost') NOT NULL DEFAULT 'Good',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theses`
--

CREATE TABLE `theses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` text NOT NULL,
  `thesis_type` varchar(100) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `pages` varchar(50) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `database_collection` varchar(255) DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `subjects` varchar(500) DEFAULT NULL,
  `abstract` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Available','Unavailable','Archived') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theses`
--

INSERT INTO `theses` (`id`, `title`, `authors`, `thesis_type`, `institution`, `year`, `pages`, `category_id`, `author_id`, `publisher_id`, `link`, `database_collection`, `availability`, `subjects`, `abstract`, `description`, `status`, `created_at`, `updated_at`, `added_by`, `edited_by`) VALUES
(1, 'Climate Change Impact on Coastal Ecosystems: A Comprehensive Analysis', 'Rachel Carson', 'Masters', 'University of California, Berkeley', '2018', '1-95', 11, 67, 6, 'https://scholar.google.com/scholar?q=Climate+Change+Impact+on+Coastal+Ecosystems', 'UC Berkeley eScholarship', 'Available', 'Climate Change, Coastal Ecosystems, Marine Biology', 'An analysis of climate change impacts on coastal ecosystems and biodiversity.', 'This thesis examines sea level rise, ocean acidification, and their effects on marine biodiversity.', 'Available', '2026-08-04 07:08:19', '2026-08-10 02:37:24', NULL, NULL),
(2, 'Renewable Energy Integration: Challenges and Opportunities in Smart Grids', 'James Kurose', 'PhD', 'MIT', '2016', '1-210', 13, 75, 23, 'https://scholar.google.com/scholar?q=Renewable+Energy+Integration+Challenges+and+Opportunities+in+Smart+Grids', 'MIT DSpace', 'Available', 'Renewable Energy, Smart Grids, Engineering', 'A study on integrating renewable energy sources into smart grid infrastructure.', 'This thesis proposes optimization algorithms for balancing renewable energy supply and demand in smart grids.', 'Available', '2026-08-04 07:08:19', '2026-08-10 02:37:24', NULL, NULL),
(3, 'The Effects of Mindfulness Meditation on Stress Reduction', 'Daniel Kahneman', 'Masters', 'Harvard University', '2019', '1-78', 16, 87, 24, 'https://scholar.google.com/scholar?q=Effects+of+Mindfulness+Meditation+on+Stress+Reduction', 'Harvard DASH', 'Available', 'Mindfulness, Stress Reduction, Psychology', 'An investigation into the effects of mindfulness meditation on stress reduction and well-being.', 'This thesis presents empirical evidence from a randomized controlled trial on mindfulness interventions.', 'Available', '2026-08-04 07:08:19', '2026-08-10 02:37:24', NULL, NULL),
(4, 'Urban Planning Strategies for Sustainable City Development', 'Yuval Noah Harari', 'Masters', 'University of Oxford', '2017', '1-120', 8, 126, 6, 'https://scholar.google.com/scholar?q=Urban+Planning+Strategies+for+Sustainable+City+Development', 'Oxford Research Archive', 'Available', 'Urban Planning, Sustainability, Cities', 'An exploration of urban planning strategies that promote sustainable city development.', 'This thesis analyzes successful sustainable urban development projects and proposes frameworks for future cities.', 'Available', '2026-08-04 07:08:19', '2026-08-10 02:37:24', NULL, NULL),
(5, 'Artificial Intelligence in Healthcare: Diagnostic Applications', 'Abraham Silberschatz', 'PhD', 'Carnegie Mellon University', '2018', '1-195', 22, 76, 23, 'https://scholar.google.com/scholar?q=Artificial+Intelligence+in+Healthcare+Diagnostic+Applications', 'CMU Digital Library', 'Available', 'Artificial Intelligence, Healthcare, Diagnostics', 'A study on the application of artificial intelligence in healthcare diagnostics.', 'This thesis develops deep learning models for medical image analysis and disease prediction.', 'Available', '2026-08-04 07:08:19', '2026-08-10 02:37:24', NULL, NULL),
(6, 'Machine Learning Approaches for Predictive Maintenance in Manufacturing', 'Ian Goodfellow', 'PhD', 'Stanford University', '2015', '1-180', 22, 74, 23, 'https://scholar.google.com/scholar?q=Machine+Learning+Approaches+for+Predictive+Maintenance+in+Manufacturing', 'Stanford Digital Repository', 'Available', 'Machine Learning, Predictive Maintenance, Manufacturing', 'This thesis presents novel machine learning approaches for predictive maintenance in manufacturing environments.', 'The research develops deep learning models for anomaly detection and failure prediction in industrial equipment.', 'Available', '2026-08-04 07:14:03', '2026-08-10 02:37:24', NULL, NULL),
(7, 'Self-Efficacy and Work Satisfaction of Non-Teaching Personnel', 'Mary Jane A. Intao', 'Masters', 'Guimaras State University', '2025', '1-502', 16, 139, 7, 'https://scholar.google.com/scholar?q=Self-Efficacy+and+Work+Satisfaction+of+Non-Teaching+Personnel+Mary+Jane+A.+Intao', 'Guimaras State University Repository', 'Available', 'Self-Efficacy, Work Satisfaction, Non-Teaching Personnel', 'This study aimed to determine the level of self-efficacy and the work satisfaction of Non-Teaching personnel of St. Vincent College all located in Panay, Philippines for the academic year 2024-2025.', 'The study utilized a descriptive research design to investigate the level of self-efficacy and work satisfaction among 42 non-teaching personnel from three campuses of St. Vincent College in Panay Island, Philippines.', 'Available', '2026-08-04 07:41:41', '2026-08-10 02:37:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('Admin','Librarian','Member','Working-Student') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `section` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `google_id`, `avatar`, `email_verified_at`, `password`, `remember_token`, `role`, `status`, `section`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin', 'admin@library.com', NULL, NULL, NULL, '$2y$12$rXbG2kWUoGwsVJWWQJk0UeYy1tEI1WWcXHJuIMvjI7j0Bl0.9X2M6', NULL, 'Admin', 'Active', NULL, '2026-08-04 07:08:16', '2026-08-13 03:36:21'),
(2, 'Maria Santos', 'maria.librarian', 'maria@library.com', NULL, NULL, NULL, '$2y$12$gpUDNoC7paaciWsOb9B1.u5yZ1sz1fg6kjY5miLebWADx97IbfPLm', NULL, 'Librarian', 'Active', NULL, '2026-08-04 07:08:16', '2026-08-11 05:49:39'),
(16, 'Laiza Quillobe', 'Laiza', 'laiza@gmail.com', NULL, NULL, NULL, '$2y$12$55buOh82jDzRtoRE1q5dw.iQ6Wo90xkdgW28AnCUPhAOdkKEIfkbq', NULL, 'Member', 'Active', NULL, '2026-08-04 08:24:54', '2026-08-04 08:24:54'),
(17, 'Ana Reyes', 'ana.librarian', 'ana@library.com', NULL, NULL, NULL, '$2y$12$Y5L9aE2/AlFtd0SMgKxWM.1grzXYLuqTGwVqW7rU8oKe61on7bYp2', NULL, 'Librarian', 'Active', NULL, '2026-08-07 06:42:50', '2026-08-11 05:49:39'),
(18, 'John Smith', 'john.smith', 'john@example.com', NULL, NULL, NULL, '$2y$12$2FrVv9WiMmh.wrdTfomcteXfJjiYOmebja.wmjZajTKCTIcn..boq', NULL, 'Member', 'Active', NULL, '2026-08-07 06:42:50', '2026-08-07 06:42:50'),
(19, 'Fiona Green', 'fiona.green', 'fiona@example.com', NULL, NULL, NULL, '$2y$12$5i4VjcnVQiNaU61xP1Nvz.G86YtAH0Xbu1xBP6zWvHeE3Ew3iiejy', NULL, 'Member', 'Active', NULL, '2026-08-07 06:42:52', '2026-08-07 06:42:52'),
(20, 'George Hill', 'george.hill', 'george@example.com', NULL, NULL, NULL, '$2y$12$9WVxl/z02NK1MlwUOWP.WOV9bYHsFm0MNe4eY3tDCpY2NJ8l1dvjO', NULL, 'Member', 'Active', NULL, '2026-08-07 06:42:52', '2026-08-07 06:42:52'),
(21, 'snorlax cute', 'snorlaxcute11', 'snorlaxcute11@gmail.com', '110461186051209603828', 'https://lh3.googleusercontent.com/a/ACg8ocJf8Lo9JUdqE3iu3znsbHSgGP6ThI51CJ8Bn0x6J0Pw6wjX6Q=s96-c', NULL, '$2y$12$ZbE.wytWA32xigsRT./0o.sQAoZ0CPNlswBuYkupzwr.MJURPrnji', '6XPkoj1Rk1J3j6FpTMAwPlVgvdYCLee5hYi2kYa1Sw5kCUuWYLCrkfGlvogk', 'Member', 'Active', NULL, '2026-08-07 15:26:38', '2026-08-07 15:26:38'),
(22, 'Johny Laput', 'johnylaput', 'johnylaput@gmail.com', '106265393228620234676', 'https://lh3.googleusercontent.com/a/ACg8ocJx0eUrkTcWN-XXMIzgKbbQ3gAUeASGq_q7oNjrqMmywFMw5gHB=s96-c', NULL, '$2y$12$wA4Eey0FlGJWwEERymDuOum5CbqRPUoddP3F/RujcA402GA7AhWse', 'SW46g8ZlPHZMa2HRfxe8R1eMROdsllKUMrjnAMEbfUbD2sqwMaQI8O4Fi8y2', 'Member', 'Active', NULL, '2026-08-10 02:43:25', '2026-08-10 02:43:25'),
(23, 'John rey Laput', 'johnreylaput48', 'johnreylaput48@gmail.com', '113671809443987869529', 'https://lh3.googleusercontent.com/a/ACg8ocIlvoi-lTeYSAmWbPeyljWoEdYc168nntKC_2Njwn-_k_1Qb066=s96-c', NULL, '$2y$12$wm52QHJPcRe9q66rAra87OgTtzlP1nZ5lIJ9KGr1mlAyGlJYm1JxG', 'EmgVoHeyJafrtYS3O8Ok0bkxZ01DOsPHWE9uLZkT8xMsp0Ib2TOnCFlzSJhA', 'Member', 'Active', NULL, '2026-08-10 03:45:52', '2026-08-10 03:45:52'),
(24, 'Work.stud', 'Work.stud', 'Workstud@library.com', NULL, NULL, NULL, '$2y$12$2sb4sFy51PA7vRMt72y7Fu7zaMoOIortrcBAD5IHLuT44h1PSZo0m', NULL, 'Working-Student', 'Active', '', '2026-08-11 05:49:39', '2026-08-12 09:27:49'),
(25, 'Johnicks Laput', 'johnnicks', 'johnnicks@gmail.com', NULL, NULL, NULL, '$2y$12$rWIUsAt.HitOk1RlkgCqVuxtEsT6QiLYXBtdrVVk.WA6AYy5F5i6y', NULL, 'Member', 'Active', NULL, '2026-08-12 04:21:17', '2026-08-12 04:21:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_accession_no_unique` (`accession_no`),
  ADD KEY `books_category_id_foreign` (`category_id`),
  ADD KEY `books_author_id_foreign` (`author_id`),
  ADD KEY `books_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `borrow_records`
--
ALTER TABLE `borrow_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrow_records_member_id_foreign` (`member_id`),
  ADD KEY `borrow_records_book_id_foreign` (`book_id`),
  ADD KEY `borrow_records_borrowed_by_foreign` (`borrowed_by`),
  ADD KEY `borrow_records_journal_id_foreign` (`journal_id`),
  ADD KEY `borrow_records_thesis_id_foreign` (`thesis_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `deletion_requests`
--
ALTER TABLE `deletion_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deletion_requests_user_id_foreign` (`user_id`),
  ADD KEY `deletion_requests_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `deletion_requests_item_type_item_id_status_index` (`item_type`,`item_id`,`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fines_borrow_id_foreign` (`borrow_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journals_category_id_foreign` (`category_id`),
  ADD KEY `journals_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_member_no_unique` (`member_no`),
  ADD UNIQUE KEY `members_user_id_unique` (`user_id`);

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
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_sent_by_foreign` (`sent_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_member_id_foreign` (`member_id`),
  ADD KEY `reservations_book_id_foreign` (`book_id`),
  ADD KEY `reservations_journal_id_foreign` (`journal_id`),
  ADD KEY `reservations_thesis_id_foreign` (`thesis_id`);

--
-- Indexes for table `return_records`
--
ALTER TABLE `return_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `return_records_borrow_id_unique` (`borrow_id`),
  ADD KEY `return_records_returned_by_foreign` (`returned_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `theses`
--
ALTER TABLE `theses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theses_category_id_foreign` (`category_id`),
  ADD KEY `theses_author_id_foreign` (`author_id`),
  ADD KEY `theses_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `borrow_records`
--
ALTER TABLE `borrow_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `deletion_requests`
--
ALTER TABLE `deletion_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `return_records`
--
ALTER TABLE `return_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theses`
--
ALTER TABLE `theses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `books_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `borrow_records`
--
ALTER TABLE `borrow_records`
  ADD CONSTRAINT `borrow_records_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrow_records_borrowed_by_foreign` FOREIGN KEY (`borrowed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `borrow_records_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `borrow_records_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrow_records_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `deletion_requests`
--
ALTER TABLE `deletion_requests`
  ADD CONSTRAINT `deletion_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `deletion_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fines`
--
ALTER TABLE `fines`
  ADD CONSTRAINT `fines_borrow_id_foreign` FOREIGN KEY (`borrow_id`) REFERENCES `borrow_records` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `journals`
--
ALTER TABLE `journals`
  ADD CONSTRAINT `journals_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `journals_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_sent_by_foreign` FOREIGN KEY (`sent_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservations_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_thesis_id_foreign` FOREIGN KEY (`thesis_id`) REFERENCES `theses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `return_records`
--
ALTER TABLE `return_records`
  ADD CONSTRAINT `return_records_borrow_id_foreign` FOREIGN KEY (`borrow_id`) REFERENCES `borrow_records` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_records_returned_by_foreign` FOREIGN KEY (`returned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `theses`
--
ALTER TABLE `theses`
  ADD CONSTRAINT `theses_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `theses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `theses_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
