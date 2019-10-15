-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2016 at 03:49 PM
-- Server version: 5.5.52-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evelocit_1id`
--

--
-- Dumping data for table `screen_segments`
--

INSERT INTO `screen_segments` (`id`, `screen_id`, `name`, `model`, `class`, `render_type`, `identifier`, `action`, `method`, `sort`, `status`, `created_at`, `updated_at`) VALUES
('2', '2', 'Unnamed Segment', '', 'icon-grid', 1, NULL, NULL, NULL, 2, 1, NULL, NULL),
('57f3c031c4038', '57f3c031c3518', 'Unnamed Segment', '', 'icon-grid', 1, NULL, '', NULL, 1, 1, '2016-10-03 20:00:00', '2016-10-21 05:04:16'),
('57fcc759a47f9', '57fcc759a2ca0', 'Unnamed Segment', 'App\\User', NULL, 1, NULL, '57fcc759a47f9::create_or_update', NULL, 1, 1, '2016-10-11 09:04:57', '2016-10-12 07:52:04'),
('57fcc7e7cd4d4', '57fcc7e7cadc3', 'Unnamed Segment', 'App\\User', NULL, 1, NULL, '57fcc7e7cd4d4::create_or_update', NULL, 1, 1, '2016-10-11 09:07:19', '2016-10-17 14:57:47'),
('57fcc7fe5214b', '57fcc7fe505f2', 'Unnamed Segment', 'App\\User', NULL, 1, NULL, '57fcc7fe5214b::create_or_update', NULL, 1, 1, '2016-10-11 09:07:42', '2016-10-24 08:59:19'),
('57fcc81c86fe3', '57fcc81c8548b', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:08:12', '2016-10-11 09:08:12'),
('57fcc86010101', '57fcc8600e990', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:09:20', '2016-10-11 09:09:20'),
('57fcc8bbd8904', '57fcc8bbd69c4', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:10:51', '2016-10-11 09:10:51'),
('57fcc8f1da4b5', '57fcc8f1d895d', 'Unnamed Segment', 'App\\Models\\BankAccountsCards', NULL, 1, NULL, '57fcc8f1da4b5::create_or_update', NULL, 1, 1, '2016-10-11 09:11:45', '2016-10-19 07:04:03'),
('57fccaba3547a', '57fccaba33921', 'Unnamed Segment', 'App\\Models\\WorkExperience', NULL, 1, NULL, '57fccaba3547a::create_or_update', 'Models\\WorkExper', 1, 1, '2016-10-11 09:19:22', '2016-10-12 11:27:28'),
('57fccad99200d', '57fccad9904b4', 'Unnamed Segment', 'App\\Models\\Project', NULL, 1, NULL, '57fccad99200d::create_or_update', NULL, 1, 1, '2016-10-11 09:19:53', '2016-10-12 11:28:11'),
('57fccaefb4faf', '57fccaefb306f', 'Unnamed Segment', 'App\\Models\\Education', NULL, 1, NULL, '57fccaefb4faf::create_or_update', NULL, 1, 1, '2016-10-11 09:20:15', '2016-10-12 11:28:28'),
('57fccb056e3d1', '57fccb056c490', 'Unnamed Segment', 'App\\Models\\SpokenLanguage', NULL, 1, NULL, '57fccb056e3d1::create_or_update', NULL, 1, 1, '2016-10-11 09:20:37', '2016-10-19 05:28:08'),
('57fccb170a247', '57fccb17086ee', 'Unnamed Segment', 'App\\Models\\Interest', NULL, 1, NULL, '57fccb170a247::create_or_update', NULL, 1, 1, '2016-10-11 09:20:55', '2016-10-17 09:54:30'),
('57fccb265260a', '57fccb2650e99', 'Unnamed Segment', 'App\\Models\\Qualification', NULL, 1, NULL, '57fccb265260a::create_or_update', NULL, 1, 1, '2016-10-11 09:21:10', '2016-10-17 09:57:18'),
('57fccb38777f0', '57fccb38758b0', 'Unnamed Segment', 'App\\Models\\References', NULL, 1, NULL, '57fccb38777f0::create_or_update', NULL, 1, 1, '2016-10-11 09:21:28', '2016-10-17 10:01:59'),
('57fccc000e20f', '57fccc000bafe', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:24:48', '2016-10-11 09:24:48'),
('57fccc38616f5', '57fccc385fb9d', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:25:44', '2016-10-11 09:25:44'),
('57fcd0058b96b', '57fcd0058925b', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:41:57', '2016-10-11 09:41:57'),
('57fcd013ccbab', '57fcd013ca49b', 'Unnamed Segment', 'App\\Models\\Bookmark', NULL, 1, NULL, '57fcd013ccbab::create_or_update', NULL, 1, 1, '2016-10-11 09:42:11', '2016-10-12 10:49:01'),
('57fcd07f0a6cf', '57fcd07f0878f', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:43:59', '2016-10-11 09:43:59'),
('57fcd0b67d36c', '57fcd0b67b42b', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:44:54', '2016-10-11 09:44:54'),
('57fcd0d469db3', '57fcd0d467e73', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:45:24', '2016-10-11 09:45:24'),
('57fcd0e0ce209', '57fcd0e0cca99', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:45:36', '2016-10-11 09:45:36'),
('57fcd11657bbe', '57fcd11655c7e', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:46:30', '2016-10-11 09:46:30'),
('57fcd24eae208', '57fcd24eac2c7', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:51:42', '2016-10-11 09:51:42'),
('57fcd36c34231', '57fcd36c322f1', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:56:28', '2016-10-11 09:56:28'),
('57fcd38bb387c', '57fcd38bb116c', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:56:59', '2016-10-11 09:56:59'),
('57fcd3af2ad17', '57fcd3af2821f', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:57:35', '2016-10-11 09:57:35'),
('57fcd3c45bf14', '57fcd3c459beb', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:57:56', '2016-10-11 09:57:56'),
('57fcd3f5262e2', '57fcd3f5237e9', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:58:45', '2016-10-11 09:58:45'),
('57fcd40f5a4dd', '57fcd40f5859d', 'Unnamed Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-11 09:59:11', '2016-10-11 09:59:11'),
('57fcf34abe0a0', '57fccb38758b0', 'Show table with References', 'App\\Models\\References', NULL, 2, NULL, '', NULL, 1, -1, '2016-10-11 12:12:26', '2016-10-17 10:02:09'),
('57fcf4c36d36b', '57fccaba33921', 'Show Table With Work Experience', 'App\\Models\\WorkExperience', NULL, 2, NULL, '', '', 1, -1, '2016-10-11 12:18:43', '2016-10-11 13:08:18'),
('57fcfa1226893', '57fcc7e7cadc3', 'Table With Contact Infos', 'App\\Models\\ContactInfo', NULL, 2, NULL, '', NULL, 1, -1, '2016-10-11 12:41:22', '2016-10-11 13:11:05'),
('57fe20431d70f', '57fe20431baa5', 'Untitled Segment', '', 'icon-grid', 1, NULL, '', NULL, 1, 1, '2016-10-12 09:36:35', '2016-10-12 09:47:57'),
('58008625d8404', '58008625d7cf4', 'Untitled Segment', NULL, 'icon-grid', 1, NULL, NULL, NULL, 1, 1, '2016-10-14 05:15:49', '2016-10-14 05:15:49'),
('58061da1d0773', '58061da1ce072', 'Untitled Segment', 'App\\Models\\Company', 'icon-grid', 1, NULL, '58061da1d0773::create_or_update', NULL, 1, 1, '2016-10-18 11:03:29', '2016-10-18 11:03:50'),
('580dd06c21596', '580dd06c1ff4b', 'Untitled Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-24 07:12:12', '2016-10-24 07:12:12'),
('580dd0970322b', '580dd0970257b', 'Untitled Segment', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2016-10-24 07:12:55', '2016-10-24 07:12:55'),
('580dd0a85443d', '580dd0a85398e', 'Untitled Segment', 'App\\Models\\Company', NULL, 1, NULL, '580dd0a85443d::create_or_update', NULL, 1, 1, '2016-10-24 07:13:12', '2016-10-24 07:13:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
