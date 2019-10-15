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
-- Dumping data for table `screen_fields`
--

INSERT INTO `screen_fields` (`id`, `screen_segment_id`, `type`, `name`, `label`, `action`, `meta`, `sort`, `created_at`, `updated_at`) VALUES
('57fdf336f287c', '57fcc81c86fe3', 'html', '', '', '', '{"content":"This page is under construction."}', 1000000, '2016-10-12 06:24:22', '2016-10-12 06:24:22'),
('57fea41af2340', '57fe20431d70f', 'link', '', 'biography_data_work_experience', '', '{"href":"57fccaba33921"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('57fea41af2844', '57fe20431d70f', 'link', '', 'biography_data_projects', '', '{"href":"57fccad9904b4"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('57fea41af2c72', '57fe20431d70f', 'link', '', 'biography_data_education', '', '{"href":"57fccaefb306f"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('57fea41af309d', '57fe20431d70f', 'link', '', 'biography_data_languages', '', '{"href":"57fccb17086ee"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('57fea41af34cb', '57fe20431d70f', 'link', '', 'biography_data_interests', '', '{"href":"57fccb17086ee"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('57fea41af38ee', '57fe20431d70f', 'link', '', 'biography_data_qualifications', '', '{"href":"57fccb2650e99"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('57fea41af3d0e', '57fe20431d70f', 'link', '', 'biography_data_references', '', '{"href":"57fccb38758b0"}', 1000000, '2016-10-12 18:59:06', '2016-10-12 18:59:06'),
('580079e635909', '57fcd40f5a4dd', 'email', '', 'imail_id', '', '[]', 20, '2016-10-14 04:23:34', '2016-10-14 04:23:34'),
('580079e635d0e', '57fcd40f5a4dd', 'text', '', '1id_access_security', '', '[]', 1000000, '2016-10-14 04:23:34', '2016-10-14 04:23:34'),
('58008cbbdde76', '58008625d8404', 'link', '', 'loyalty_cards', '', '{"href":"57fcd0058925b"}', 1000000, '2016-10-14 05:43:55', '2016-10-14 05:43:55'),
('58008cbbde320', '58008625d8404', 'link', '', 'reading_list', '', '{"href":"57fcd013ca49b"}', 1000000, '2016-10-14 05:43:55', '2016-10-14 05:43:55'),
('5800ce5de3f48', '57f3c031c4038', 'link', '', 'general_data', '', '{"href":"57fcc759a2ca0","class":"general-data-icon","validation":""}', 10, '2016-10-14 10:23:57', '2016-10-14 10:23:57'),
('5800ce5de43d5', '57f3c031c4038', 'link', '', 'contact_data', '', '{"href":"57fcc7e7cadc3","class":"contact-data-icon","validation":""}', 20, '2016-10-14 10:23:57', '2016-10-14 10:23:57'),
('5800ce5de4796', '57f3c031c4038', 'link', '', 'passwords', '', '{"href":"57fcc7fe505f2","class":"passwords-icon","validation":""}', 30, '2016-10-14 10:23:57', '2016-10-14 10:23:57'),
('5800ce5de4bd8', '57f3c031c4038', 'link', '', 'security_settings', '', '{"href":"57fcc81c8548b","class":"security-settings-icon","validation":""}', 40, '2016-10-14 10:23:57', '2016-10-14 10:23:57'),
('5800ce5de4fd9', '57f3c031c4038', 'link', '', 'bank_accounts', '', '{"href":"57fcc8f1d895d","class":"bank-accounts-icon","validation":""}', 50, '2016-10-14 10:23:57', '2016-10-14 10:23:57'),
('5800ce5de53c3', '57f3c031c4038', 'link', '', 'biography_data', '', '{"href":"57fccaba33921","class":"biography-data-icon","validation":""}', 60, '2016-10-14 10:23:57', '2016-10-14 10:23:57'),
('5800d7fae3b44', '57fcd013ccbab', 'text', 'title', 'title', '', '{"validation":"required"}', 10, '2016-10-14 11:04:58', '2016-10-14 11:04:58'),
('5800d7fae3f7d', '57fcd013ccbab', 'text', 'url', '', '', '{"validation":"required"}', 20, '2016-10-14 11:04:58', '2016-10-14 11:04:58'),
('5800d7fae4325', '57fcd013ccbab', 'text', 'starred', '', '', '[]', 30, '2016-10-14 11:04:58', '2016-10-14 11:04:58'),
('5800d7fae46b9', '57fcd013ccbab', 'submit', '', 'submit', '', '[]', 50, '2016-10-14 11:04:58', '2016-10-14 11:04:58'),
('5800d7fae4a49', '57fcd013ccbab', 'recordset', '', '', '', '[]', 60, '2016-10-14 11:04:58', '2016-10-14 11:04:58'),
('5800d7fae4dd1', '57fcd013ccbab', 'read-later-tags', 'tags[]', '', '', '{"validation":""}', 40, '2016-10-14 11:04:58', '2016-10-14 11:04:58'),
('5807370aa4139', '57fcc8f1da4b5', 'text', 'card', 'card', '', '{"validation":"required"}', 1000000, '2016-10-19 07:04:10', '2016-10-19 07:04:10'),
('5807370aa4601', '57fcc8f1da4b5', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-19 07:04:10', '2016-10-19 07:04:10'),
('5807370aa4a2e', '57fcc8f1da4b5', 'recordset', '', '', '', '[]', 1000000, '2016-10-19 07:04:10', '2016-10-19 07:04:10'),
('5809f062933b4', '57fccaefb4faf', 'text', 'course', 'course_name', '', '{"validation":"required"}', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f0629381c', '57fccaefb4faf', 'text', 'institution', 'institution_name', '', '{"validation":"required"}', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f06293c10', '57fccaefb4faf', 'date', 'start_date', 'start_date', '', '{"validation":"required"}', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f06294007', '57fccaefb4faf', 'date', 'end_date', 'end_date', '', '{"validation":"required|date|after:start_date"}', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f062943d0', '57fccaefb4faf', 'revision', 'revisions[]', 'revisions', '', '{"validation":""}', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f06294796', '57fccaefb4faf', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f06294b5b', '57fccaefb4faf', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 08:39:30', '2016-10-21 08:39:30'),
('5809f0dae18b9', '57fccb170a247', 'text', 'name', 'name', '', '{"validation":"required"}', 1000000, '2016-10-21 08:41:30', '2016-10-21 08:41:30'),
('5809f0dae1fc3', '57fccb170a247', 'revision', 'revisions[]', 'revisions', '', '{"validation":""}', 1000000, '2016-10-21 08:41:30', '2016-10-21 08:41:30'),
('5809f0dae25c4', '57fccb170a247', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 08:41:30', '2016-10-21 08:41:30'),
('5809f0dae2bad', '57fccb170a247', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 08:41:30', '2016-10-21 08:41:30'),
('5809f0e2c1b29', '57fccb265260a', 'text', 'name', 'name', '', '{"validation":"required"}', 1000000, '2016-10-21 08:41:38', '2016-10-21 08:41:38'),
('5809f0e2c2284', '57fccb265260a', 'revision', 'revisions[]', 'revisions', '', '{"validation":""}', 1000000, '2016-10-21 08:41:38', '2016-10-21 08:41:38'),
('5809f0e2c28e8', '57fccb265260a', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 08:41:38', '2016-10-21 08:41:38'),
('5809f0e2c2f00', '57fccb265260a', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 08:41:38', '2016-10-21 08:41:38'),
('5809f0ec64dff', '57fccb38777f0', 'select', 'project_id', 'customer_name', '', '{"validation":"required"}', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f0ec6525c', '57fccb38777f0', 'text', 'job_title', 'job_title', '', '{"validation":"required"}', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f0ec6566c', '57fccb38777f0', 'date', 'reference_date', 'reference_date', '', '{"validation":""}', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f0ec65a5b', '57fccb38777f0', 'text', 'position_vs_you', 'position_vs_you', '', '{"validation":"required"}', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f0ec65e41', '57fccb38777f0', 'revision', 'revisions[]', 'revisions', '', '{"validation":""}', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f0ec661f9', '57fccb38777f0', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f0ec665a9', '57fccb38777f0', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 08:41:48', '2016-10-21 08:41:48'),
('5809f5341aebd', '57fccad99200d', 'select', 'work_experience_id', 'company_name', '', '{"validation":"required"}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f5341b756', '57fccad99200d', 'text', 'customer', 'customer', '', '{"validation":"required"}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f5341ee72', '57fccad99200d', 'text', 'project_name', 'project_name', '', '{"class":"test","validation":"required"}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f53420ba1', '57fccad99200d', 'text', 'job_title', 'job_title', '', '{"validation":"required"}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f5342202b', '57fccad99200d', 'date', 'start_date', 'start_date', '', '{"validation":"required"}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f53422876', '57fccad99200d', 'date', 'end_date', 'end_date', '', '{"validation":""}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f53422fef', '57fccad99200d', 'revision', 'revisions[]', 'revisions', '', '{"validation":""}', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f5342373b', '57fccad99200d', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809f53423e50', '57fccad99200d', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 09:00:04', '2016-10-21 09:00:04'),
('5809fe426806c', '57fccaba3547a', 'text', 'job_title', 'job_title', '', '{"validation":"required"}', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('5809fe42685ad', '57fccaba3547a', 'text', 'company_name', 'company_name', '', '{"validation":"required"}', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('5809fe42689d6', '57fccaba3547a', 'date', 'start_date', 'start_date', '', '{"validation":"required"}', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('5809fe4268de8', '57fccaba3547a', 'date', 'end_date', 'end_date', '', '{"validation":"required|date|after:start_date"}', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('5809fe4269359', '57fccaba3547a', 'revision', 'revisions[]', 'revisions', '', '{"validation":""}', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('5809fe4269832', '57fccaba3547a', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('5809fe4269f15', '57fccaba3547a', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 09:38:42', '2016-10-21 09:38:42'),
('580a0384ab8af', '57fccb056e3d1', 'select', 'languages_list_id', 'language', '', '{"validation":"required"}', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580a0384abe6e', '57fccb056e3d1', 'text', 'listening', 'listening', '', '{"validation":""}', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580a0384ac34b', '57fccb056e3d1', 'text', 'speaking', 'speaking', '', '{"validation":""}', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580a0384ac801', '57fccb056e3d1', 'text', 'reading', 'reading', '', '{"validation":""}', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580a0384accad', '57fccb056e3d1', 'text', 'writing', 'writing', '', '{"validation":""}', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580a0384ad153', '57fccb056e3d1', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580a0384ad5d2', '57fccb056e3d1', 'recordset', '', '', '', '[]', 1000000, '2016-10-21 10:01:08', '2016-10-21 10:01:08'),
('580babefc60bb', '2', 'link', '', 'personal_data', '', '{"href":"57f3c031c3518","class":"personal-data-icon"}', 10, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc66dc', '2', 'link', '', 'contacts', '', '{"content":"","placeholder":"0","href":"57fccc000bafe","class":"contacts-icon"}', 20, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc6b63', '2', 'link', '', 'loyalty_cards', '', '{"content":"","placeholder":"0","href":"57fcd0058925b","class":"loyalty-cards-icon"}', 30, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc7082', '2', 'link', '', 'reading_list', '', '{"content":"","placeholder":"0","href":"57fcd013ca49b","class":"reading-list-icon"}', 40, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc7495', '2', 'link', '', 'saved_passwords', '', '{"content":"","placeholder":"0","href":"57fcd07f0878f","class":"saved-passwords-icon"}', 50, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc79e5', '2', 'link', '', 'send_information', '', '{"content":"","placeholder":"0","href":"57fcd0b67b42b","class":"send-information-icon"}', 60, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc7f02', '2', 'link', '', 'task_list', '', '{"content":"","placeholder":"0","href":"57fcd0d467e73","class":"task-list-icon"}', 70, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc8373', '2', 'link', '', 'calendar', '', '{"content":"","placeholder":"0","href":"57fcd0e0cca99","class":"calendar-icon"}', 80, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc87d0', '2', 'link', '', 'document_server', '', '{"content":"","placeholder":"","href":"57fcd11655c7e","class":"document-server-icon"}', 90, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc8be2', '2', 'link', '', 'resume_generator', '', '{"content":"","placeholder":"0","href":"57fcd24eac2c7","class":"resume-generator-icon"}', 100, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc905c', '2', 'link', '', 'virtual_payments', '', '{"content":"","placeholder":"0","href":"57fcd36c322f1","class":"virtual-payments-icon"}', 110, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc9413', '2', 'link', '', 'myid_dashboard', '', '{"content":"","placeholder":"0","href":"57fcd40f5859d","class":"oneid-dashboard-icon"}', 120, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc97e5', '2', 'link', '', 'imail_id', '', '{"content":"","placeholder":"0","class":"oneid-mail-icon"}', 130, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580babefc9be2', '2', 'link', '', 'companies', '', '{"content":"","placeholder":"0","href":"58061da1ce072","class":"companies-icon"}', 140, '2016-10-22 16:11:59', '2016-10-22 16:11:59'),
('580dd0bda2bef', '580dd0a85443d', 'text', 'name', 'name', '', '{"validation":"required"}', 1000000, '2016-10-24 07:13:33', '2016-10-24 07:13:33'),
('580dd0bda641d', '580dd0a85443d', 'text', 'registration_number', 'registration_number', '', '{"validation":""}', 1000000, '2016-10-24 07:13:33', '2016-10-24 07:13:33'),
('580dd0bda7479', '580dd0a85443d', 'text', 'website', 'website', '', '{"validation":""}', 1000000, '2016-10-24 07:13:33', '2016-10-24 07:13:33'),
('580dd0bda7cd7', '580dd0a85443d', 'file', 'logo', 'logo', '', '{"validation":""}', 1000000, '2016-10-24 07:13:33', '2016-10-24 07:13:33'),
('580dd0bda8496', '580dd0a85443d', 'submit', '', 'submit', '', '[]', 1000000, '2016-10-24 07:13:33', '2016-10-24 07:13:33'),
('580dd0bda9003', '580dd0a85443d', 'recordset', '', '', '', '[]', 1000000, '2016-10-24 07:13:33', '2016-10-24 07:13:33'),
('580dd49275fe7', '58061da1d0773', 'link', '', 'view_companies', '', '{"href":"580dd06c1ff4b","class":"companies-icon"}', 1000000, '2016-10-24 07:29:54', '2016-10-24 07:29:54'),
('580dd492766ca', '58061da1d0773', 'link', '', 'search_companies', '', '{"href":"580dd0970257b","class":"companies-icon"}', 1000000, '2016-10-24 07:29:54', '2016-10-24 07:29:54'),
('580dd4927896a', '58061da1d0773', 'link', '', 'my_companies', '', '{"href":"580dd0a85398e","class":"companies-icon"}', 1000000, '2016-10-24 07:29:54', '2016-10-24 07:29:54'),
('580de9b8af78d', '57fcc7fe5214b', 'readonly', 'id', 'id', '', '{"href":"2"}', 10, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580de9b8affbe', '57fcc7fe5214b', 'readonly', 'personal_id', 'personal_id', '', '[]', 20, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580de9b8b06e3', '57fcc7fe5214b', 'readonly', 'email', '', '', '[]', 30, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580de9b8b0e11', '57fcc7fe5214b', 'password', 'old_password', 'current_password', '', '[]', 40, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580de9b8b155d', '57fcc7fe5214b', 'password', 'password', 'new_password', '', '[]', 50, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580de9b8b1cb8', '57fcc7fe5214b', 'password', 'password_confirmation', 'repeat_pass', '', '[]', 60, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580de9b8b23fe', '57fcc7fe5214b', 'submit', '', 'submit', '', '[]', 70, '2016-10-24 09:00:08', '2016-10-24 09:00:08'),
('580df4c477c0f', '57fcc759a47f9', 'readonly', 'id', 'id', '', '[]', 10, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c478068', '57fcc759a47f9', 'readonly', 'personal_id', 'personal_id', '', '[]', 20, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c478433', '57fcc759a47f9', 'readonly', 'email', 'email', '', '[]', 30, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c4787e3', '57fcc759a47f9', 'text', 'first_name', 'first_name', '', '{"validation":"required"}', 40, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c478b8b', '57fcc759a47f9', 'text', 'middle_name', 'middle_name', '', '{"validation":""}', 50, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c478f42', '57fcc759a47f9', 'text', 'last_name', 'last_name', '', '{"validation":"required"}', 60, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c479336', '57fcc759a47f9', 'text', 'nickname', 'nickname', '', '{"validation":""}', 70, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c47972e', '57fcc759a47f9', 'date', 'birthday', 'birthday', '', '{"validation":""}', 100, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c479b2b', '57fcc759a47f9', 'select', 'country_of_birth', 'country_of_birth', '', '{"validation":""}', 110, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c479f5a', '57fcc759a47f9', 'text', 'city_of_birth', 'city_of_birth', '', '{"validation":""}', 120, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c47a374', '57fcc759a47f9', 'select', 'blood_type', 'blood_type_group', '', '{"validation":""}', 130, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c47a845', '57fcc759a47f9', 'select', 'selected_lang', 'myid_logon_language', '', '{"validation":"required"}', 140, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c47ac10', '57fcc759a47f9', 'file', 'avatar', '', '', '{"validation":""}', 150, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c47afc3', '57fcc759a47f9', 'submit', '', 'submit', '', '{"validation":""}', 160, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580df4c47d0ee', '57fcc759a47f9', 'select', 'gender', 'gender', '', '{"validation":""}', 80, '2016-10-24 09:47:16', '2016-10-24 09:47:16'),
('580e103fa6c09', '57fcc7e7cd4d4', 'readonly', 'id', 'id', '', '[]', 10, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa7078', '57fcc7e7cd4d4', 'readonly', 'personal_id', 'personal_id', '', '[]', 20, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa752f', '57fcc7e7cd4d4', 'readonly', 'email', '', '', '[]', 30, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa790c', '57fcc7e7cd4d4', 'text', 'street', 'street', '', '{"validation":""}', 40, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa7ce7', '57fcc7e7cd4d4', 'text', 'house_number', 'house_number', '', '{"validation":""}', 50, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa80c1', '57fcc7e7cd4d4', 'text', 'postal_code', 'postal_code', '', '{"validation":""}', 60, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa84a1', '57fcc7e7cd4d4', 'text', 'city', 'city', '', '{"validation":""}', 70, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa886a', '57fcc7e7cd4d4', 'text', 'place', 'place', '', '{"validation":""}', 80, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa8c2a', '57fcc7e7cd4d4', 'text', 'province', 'province', '', '{"validation":""}', 90, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa8fea', '57fcc7e7cd4d4', 'select', 'country', 'country', '', '{"validation":""}', 100, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa94c6', '57fcc7e7cd4d4', 'contacts-list', 'contacts[]', '', '', '{"validation":""}', 110, '2016-10-24 11:44:31', '2016-10-24 11:44:31'),
('580e103fa98ca', '57fcc7e7cd4d4', 'submit', '', 'submit', '', '[]', 120, '2016-10-24 11:44:31', '2016-10-24 11:44:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
