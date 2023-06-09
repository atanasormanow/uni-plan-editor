-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2023 at 12:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uni_plans`
--

-- --------------------------------------------------------

--
-- Table structure for table `plans_plans`
--

CREATE TABLE `plans_plans` (
  `plan_id_main` int(11) UNSIGNED NOT NULL,
  `plan_id_dependency` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `plans_plans`
--

INSERT INTO `plans_plans` (`plan_id_main`, `plan_id_dependency`) VALUES
(20, 29),
(21, 24),
(21, 30),
(21, 34),
(37, 24),
(37, 30),
(37, 34);

-- --------------------------------------------------------

--
-- Table structure for table `subject_plans`
--

CREATE TABLE `subject_plans` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner` int(11) UNSIGNED NOT NULL,
  `type` enum('z','i') CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `target_majors` set('i','is','kn','si','ad','m','pm','s','mi') CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `department` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `busyness` int(11) UNSIGNED NOT NULL,
  `credits` int(10) UNSIGNED NOT NULL,
  `required_skills` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `aquired_skills` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exam_synopsis` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bibliography` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject_plans`
--

INSERT INTO `subject_plans` (`id`, `name`, `description`, `owner`, `type`, `target_majors`, `department`, `busyness`, `credits`, `required_skills`, `aquired_skills`, `contents`, `exam_synopsis`, `bibliography`) VALUES
(20, 'GNUS', '', 6, 'i', 'kn', 'IS', 1000, 20, '', '', 'stuff', 'idk', ''),
(21, 'Lambda Calculus and Proof Theory', 'best course in FMI', 6, 'i', 'i,kn', 'KI', 500, 20, 'know functional programming', '', 'Untyped LC, Typed LC, Proof theory', 'TODO', ''),
(22, 'Application programming interfaces for Cloud Architectures with AWS', 'Ð”Ð¸ÑÑ†Ð¸Ð¿Ð»Ð¸Ð½Ð°Ñ‚Ð° Ð°Ð´Ñ€ÐµÑÐ¸Ñ€Ð° Ð½ÐµÐ¾Ð±Ñ…Ð¾Ð´Ð¸Ð¼Ð¾Ñ‚Ð¾ Ð½Ð¸Ð²Ð¾ Ð·Ð½Ð°Ð½Ð¸Ñ Ð½Ð° Ð·Ð° ÑÑŠÐ·Ð´Ð°Ð²Ð°Ð½Ðµ Ð½Ð° Ð°Ñ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð½Ð¸\nÑ€ÐµÑˆÐµÐ½Ð¸Ñ Ñ ÑƒÐµÐ± ÑƒÑÐ»ÑƒÐ³Ð¸ Ð½Ð° ÐÐ¼Ð°Ð·Ð¾Ð½ (AWS). ÐŸÑ€ÐµÐ´Ð²Ð¸Ð´ÐµÐ½Ð¾ Ðµ Ð¿Ð¾ÑÑ‚ÐµÐ¿ÐµÐ½Ð½Ð¾ Ð¿Ñ€ÐµÐ´ÑÑ‚Ð°Ð²ÑÐ½Ðµ Ð½Ð°\nÐ¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸ÑÑ‚Ð° Ð¸ Ð¿Ð¾ÑÑ‚ÐµÐ¿ÐµÐ½Ð½Ð¾ Ð½Ð°Ð´Ð³Ñ€Ð°Ð¶Ð´Ð°Ð½Ðµ Ð½Ð° Ð·Ð½Ð°Ð½Ð¸ÑÑ‚Ð°. Ð”Ð¸ÑÑ†Ð¸Ð¿Ð»Ð¸Ð½Ð°Ñ‚Ð° Ð²ÑŠÐ²ÐµÐ¶Ð´Ð° Ð½ÑÐºÐ¾Ð¸ Ð¾Ñ‚\nÐ½Ð°Ð¹-Ñ‡ÐµÑÑ‚Ð¾ Ð¸Ð·Ð¿Ð¾Ð»Ð·Ð²Ð°Ð½Ð¸Ñ‚Ðµ ÑƒÑÐ»ÑƒÐ³Ð¸ Ð½Ð° ÐÐ¼Ð°Ð·Ð¾Ð½ Ð£ÐµÐ± Ð£ÑÐ»ÑƒÐ³Ð¸ Ð¸ Ð¿Ñ€Ð¸Ð»Ð¾Ð¶Ð½Ð¾-Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð½Ð¸Ñ‚Ðµ\nÐ¸Ð½Ñ‚ÐµÑ€Ñ„ÐµÐ¹ÑÐ¸ ÑÐ²ÑŠÑ€Ð·Ð°Ð½Ð¸ Ñ Ñ‚ÑÑ…â€“ Ñ‚ÐµÐ¾Ñ€Ð¸Ñ Ð¸ Ð¿Ñ€Ð°ÐºÑ‚Ð¸Ñ‡ÐµÑÐºÐ¸ Ð¿Ñ€Ð¸Ð¼ÐµÑ€Ð¸. Ð Ð°Ð·Ð³Ð»ÐµÐ¶Ð´Ð°Ñ‚ ÑÐµ Ð¸ Ñ€Ð°Ð·Ð»Ð¸Ñ‡Ð½Ð¸\nÐ°ÑÐ¿ÐµÐºÑ‚Ð¸ Ð¾Ñ‚ ÑÐ¸Ð³ÑƒÑ€Ð½Ð¾ÑÑ‚Ñ‚Ð° Ð¿Ñ€Ð¸ Ñ€Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚Ð²Ð°Ð½Ðµ Ð¸ Ð¸Ð·Ð¿Ð¾Ð»Ð·Ð²Ð°Ð½Ðµ Ð½Ð° AWS', 6, 'i', 'i,kn,si', 'Ð¡Ð¾Ñ„Ñ‚ÑƒÐµÑ€Ð½Ð¸ Ñ‚ÐµÑ…Ð½Ð¾Ð»Ð¾Ð³Ð¸Ð¸', 150, 5, 'ÐžÐ¿ÐµÑ€Ð°Ñ†Ð¸Ð¾Ð½Ð½Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼Ð¸: Ð›Ð¸Ð½ÑƒÐºÑ, Ð¾ÑÐ½Ð¾Ð²Ð½Ð¸ Ð¿Ð¾Ð·Ð½Ð°Ð½Ð¸Ñ Ð·Ð° Ð²ÑŠÑ‚Ñ€ÐµÑˆÐ½Ð¸ Shell ÐºÐ¾Ð¼Ð°Ð½Ð´Ð¸\nÐœÑ€ÐµÐ¶Ð¸: Ð¾ÑÐ½Ð¾Ð²Ð½Ð¸ Ð¸ Ð¼Ð°Ð»ÐºÐ¾ Ð¿Ð¾-Ð·Ð°Ð´ÑŠÐ»Ð±Ð¾Ñ‡ÐµÐ½Ð¸ Ð¿Ð¾Ð·Ð½Ð°Ð½Ð¸Ñ â€“ Ð°Ð´Ñ€ÐµÑÐ¸Ñ€Ð°Ð½Ðµ (IP), Ð¼Ð°ÑÐºÐ¸, ÑˆÐ»ÑŽÐ·Ð¾Ð²Ðµ,\nÐ¿Ñ€Ð¾Ñ‚Ð¾ÐºÐ¾Ð»Ð¸ (HTTP/HTTPS), Telnet/SSH;\nÐ Ð°Ð±Ð¾Ñ‚Ð½Ð¾ Ð²Ð»Ð°Ð´ÐµÐµÐ½Ðµ Ð½Ð° Ð½ÑÐºÐ°ÐºÑŠÐ² Ñ‚ÐµÐºÑÑ‚Ð¾Ð¾Ð±Ñ€Ð°Ð±Ð¾Ñ‚Ð²Ð°Ñ‰ Ñ€ÐµÐ´Ð°ÐºÑ‚Ð¾Ñ€, Ñ€Ð°Ð±Ð¾Ñ‚ÐµÑ‰ Ð¿Ð¾Ð´ Ð›Ð¸Ð½ÑƒÐºÑ', 'Ð¡Ð»ÐµÐ´ Ð·Ð°Ð²ÑŠÑ€ÑˆÐ²Ð°Ð½Ðµ Ð½Ð° ÐºÑƒÑ€ÑÐ° ÑÑ‚ÑƒÐ´ÐµÐ½Ñ‚Ð¸Ñ‚Ðµ Ñ‰Ðµ Ð¼Ð¾Ð³Ð°Ñ‚ Ð´Ð°:\n1. Ð Ð°Ð·Ð³Ñ€Ð°Ð½Ð¸Ñ‡Ð°Ð²Ð°Ñ‚ Ñ€Ð°Ð·Ð»Ð¸Ñ‡Ð½Ð¸Ñ‚Ðµ Ð¾Ð±Ð»Ð°Ñ‡Ð½Ð¸ Ð°Ñ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð¸;\n2. Ð©Ðµ Ð¼Ð¾Ð³Ð°Ñ‚ Ð´Ð° Ð¾Ð¿Ð¸ÑÐ²Ð°Ñ‚ Ð¾ÑÐ½Ð¾Ð²Ð½Ð¸Ñ‚Ðµ ÐÐ¼Ð°Ð·Ð¾Ð½ AWS ÑƒÑÐ»ÑƒÐ³Ð¸ Ð¸ Ð¿Ñ€Ð¸Ð»Ð¾Ð¶Ð½Ð¾ Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð½Ð¸\nÐ¸Ð½Ñ‚ÐµÑ€Ñ„ÐµÐ¹ÑÐ¸;\n3. Ð©Ðµ Ð¸Ð¼Ð°Ñ‚ Ñ€Ð°Ð·Ð±Ð¸Ñ€Ð°Ð½ÐµÑ‚Ð¾ Ð¸ Ð·Ð½Ð°Ð½Ð¸ÑÑ‚Ð° Ð·Ð° Ð²Ð½Ð¸Ð¼Ð°Ñ‚ÐµÐ»Ð½Ð¾ Ð¸Ð·Ð¿Ð¾Ð»Ð·Ð²Ð°Ð½Ðµ Ð½Ð° Ñ€ÐµÑÑƒÑ€ÑÐ¸Ñ‚Ðµ Ð² Ð¾Ð±Ð»Ð°Ñ‡Ð½Ð¸Ñ‚Ðµ\nÐ¸Ð½Ñ„Ñ€Ð°ÑÑ‚Ñ€ÑƒÐºÑ‚ÑƒÑ€Ð¸;\n4. Ð”Ð° ÑÑŠÐ·Ð´Ð°Ð²Ð°Ñ‚ API Ð¾Ð±Ñ€ÑŠÑ‰ÐµÐ½Ð¸Ñ â€“ Ð¿Ñ€ÐµÐ· CLI ÐºÐ¾Ð¼Ð°Ð½Ð´Ð¸ Ð¸ Ð¿Ñ€ÐµÐ· Ð½ÑÐºÐ¾Ð¸ Ð¾Ñ‚ ÑÑŠÑ‰ÐµÑÑ‚Ð²ÑƒÐ²Ð°Ñ‰Ð¸Ñ‚Ðµ SDK-\nÑ‚Ð° Ð½Ð° ÐÐ¼Ð°Ð·Ð¾Ð½;\n5. Ð©Ðµ Ð¼Ð¾Ð³Ð°Ñ‚ ÑÐ²Ð¾Ð±Ð¾Ð´Ð½Ð¾ Ð·Ð° Ð¸Ð·Ð¿Ð¾Ð»Ð·Ð²Ð°Ñ‚ Ð£ÐµÐ± ÐºÐ¾Ð½Ð·Ð¾Ð»Ð°Ñ‚Ð° Ð½Ð° ÐÐ¼Ð°Ð·Ð¾Ð½ Ð·Ð° AWS.\n6. Ð©Ðµ Ð¼Ð¾Ð³Ð°Ñ‚ Ð´Ð° ÑÑŠÐ·Ð´Ð°Ð²Ð°Ñ‚ Ð¾ÑÐ½Ð¾Ð²Ð½Ð¸ AWS Ð°Ñ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð¸;\n7. Ð©Ðµ Ð¿Ð¾Ð»ÑƒÑ‡Ð°Ñ‚ Ð½ÐµÐ¾Ð±Ñ…Ð¾Ð´Ð¸Ð¼Ð°Ñ‚Ð° Ð¾ÑÐ½Ð¾Ð²Ð° Ð¾Ñ‚Ð³Ð¾Ð²Ð°Ñ€ÑÑ‰Ð° Ð½Ð° Ð·Ð½Ð°Ð½Ð¸ÑÑ‚Ð° Ð² ÑÐµÑ€Ñ‚Ð¸Ñ„Ð¸ÐºÐ°Ñ†Ð¸Ð¾Ð½Ð½Ð¸Ñ Ð¸Ð·Ð¿Ð¸Ñ‚\nÐ½Ð° ÐÐ¼Ð°Ð·Ð¾Ð½ â€žAWS Certified Solution Architect â€“ Associateâ€', 'ÐžÑÐ½Ð¾Ð²Ð½Ð¸ ÐºÐ¾Ð½Ñ†ÐµÐ¿Ñ†Ð¸Ð¸:\n - ÐœÑ€ÐµÐ¶Ð¸ (DNS, IP Ð°Ð´Ñ€ÐµÑÐ¸, Ð¼Ð°ÑÐºÐ¸Ñ€Ð°Ð½Ðµ);\n - Ð¡Ð¸Ð³ÑƒÑ€Ð½Ð¾ÑÑ‚;\n - ÐžÐ¿ÐµÑ€Ð°Ñ†Ð¸Ð¾Ð½Ð½Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼Ð¸ (Ð›Ð¸Ð½ÑƒÐºÑ);\nÐžÑÐ½Ð¾Ð²Ð¸ Ð½Ð° ÐÐ¼Ð°Ð·Ð¾Ð½ AWS:\n - Ð ÐµÐ³Ð¸Ð¾Ð½Ð¸; AZs; ÐšÑ€Ð°Ð¹Ð½Ð¸ Ð›Ð¾ÐºÐ°Ñ†Ð¸Ð¸; ÐÐºÐ°ÑƒÐ½Ñ‚Ð¸; ARNs; Ð¢Ð°Ð³Ð¾Ð²Ðµ; \n - ÐšÐ¾Ð½Ð·Ð¾Ð»Ð°, CLI, APIs', 'ÐžÐ±Ð»Ð°ÑÑ‚ 1: Ð”Ð¸Ð·Ð°Ð¹Ð½ Ð½Ð° Ð•Ð»Ð°ÑÑ‚Ð¸Ñ‡Ð½Ð¸ ÐÑ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð¸ \n1.1. Ð˜Ð·Ð±Ð¾Ñ€ Ð½Ð° Ð¼ÐµÑ…Ð°Ð½Ð¸Ð·Ð¼Ð¸ Ð·Ð° Ð½Ð°Ð´ÐµÐ¶Ð´Ð½Ð¾/ÐµÐ»Ð°ÑÑ‚Ð¸Ñ‡Ð½Ð¾ ÑÑŠÑ…Ñ€Ð°Ð½ÐµÐ½Ð¸Ðµ. \n1.2. Ð”Ð¸Ð·Ð°Ð¹Ð½ Ð½Ð° Ñ€ÐµÑˆÐµÐ½Ð¸Ñ Ñ Ð¼Ð½Ð¾Ð³Ð¾ÑÐ»Ð¾Ð¹Ð½Ð¸ Ð°Ñ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð¸. \n1.3. Ð”Ð¸Ð·Ð°Ð¹Ð½ Ð½Ð° Ð²Ð¸ÑÐ¾ÐºÐ¾ Ð½Ð°Ð´ÐµÐ¶Ð´Ð½Ð¸ Ð¸/Ð¸Ð»Ð¸ ÑƒÑÑ‚Ð¾Ð¹Ñ‡Ð¸Ð²Ð¸ Ð½Ð° Ð³Ñ€ÐµÑˆÐºÐ¸ Ð°Ñ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð¸.\nÐžÐ±Ð»Ð°ÑÑ‚ 2: Ð”ÐµÑ„Ð¸Ð½Ð¸Ñ€Ð°Ð½Ðµ Ð½Ð° ÐŸÑ€Ð¾Ð¸Ð·Ð²Ð¾Ð´Ð¸Ñ‚ÐµÐ»Ð½Ð¸ ÐÑ€Ñ…Ð¸Ñ‚ÐµÐºÑ‚ÑƒÑ€Ð¸ \n2.1. Ð˜Ð·Ð±Ð¾Ñ€ Ð½Ð° Ð¿Ñ€Ð¾Ð¸Ð·Ð²Ð¾Ð´Ð¸Ñ‚ÐµÐ»Ð½Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼Ð¸ Ð·Ð° ÑÑŠÑ…Ñ€Ð°Ð½ÐµÐ½Ð¸Ðµ Ð¸ Ð±Ð°Ð·Ð¸ Ð´Ð°Ð½Ð½Ð¸. \n2.2. ÐŸÑ€Ð¸Ð»Ð°Ð³Ð°Ð½Ðµ Ð½Ð° ÐºÐµÑˆÐ¸Ñ€Ð°Ð½Ðµ Ð·Ð° Ð¿Ð¾Ð´Ð¾Ð±Ñ€ÐµÐ½Ð¸Ðµ Ð½Ð° Ð¿Ñ€Ð¾Ð¸Ð·Ð²Ð¾Ð´Ð¸Ñ‚ÐµÐ»Ð½Ð¾ÑÑ‚Ñ‚Ð°. \n2.3. Ð”Ð¸Ð·Ð°Ð¹Ð½ Ð½Ð° Ñ€ÐµÑˆÐµÐ½Ð¸Ñ Ð·Ð° ÐµÐ»Ð°ÑÑ‚Ð¸Ñ‡Ð½Ð¾ÑÑ‚ Ð¸ Ð¼Ð°Ñ‰Ð°Ð±Ð¸Ñ€ÑƒÐµÐ¼Ð¾ÑÑ‚\n', '[1.] \"AWS Certified Solutions Architect - Official Study Guide\", Joe Baron, Hisham Baz, Tim\nBixler, Biff Gaut, Kevin E. Kelly, Sean Senior, John Stamper; 2017, John Wiley & Sons'),
(23, 'ÐšÐ¾Ð¼Ð¿ÑŽÑ‚ÑŠÑ€Ð½Ð° Ð³Ñ€Ð°Ñ„Ð¸ÐºÐ°', '', 6, 'z', 'i,is,kn', 'ÐÐ·', 160, 12, '', '', 'TODO', 'TODO', ''),
(24, 'Ð›Ð¸Ð½ÐµÐ¹Ð½Ð° Ð°Ð»Ð³ÐµÐ±Ñ€Ð°', 'TODO', 6, 'z', 'i,is,kn,si', 'ÐÐ»Ð³ÐµÐ±Ñ€Ð°', 100, 15, '', '', 'TODO', 'TODO', ''),
(25, 'Ð¤ÑƒÐ½ÐºÑ†Ð¸Ð¾Ð½Ð°Ð»Ð½Ð¾ Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð¸Ñ€Ð°Ð½Ðµ Ñ Elixir', 'TODO', 6, 'i', 'i,is,kn,si', 'ÐšÐ˜', 110, 11, '', '', 'TODO', 'TODO', ''),
(26, 'Ð¡Ñ‚Ð°Ñ‚Ð¸ÑÑ‚Ð¸ÐºÐ°', 'TOdo', 5, 'i', 's', 'Ð’Ð¡', 80, 2, '', '', 'TODO', 'TODO', ''),
(29, 'ÐžÐ¡', 'TODO', 6, 'z', 'is', 'Ð˜Ð¡', 50, 5, '', '', 'TODO', 'TODO', ''),
(30, 'Ð£ÐŸ', 'TODO', 5, 'z', '', 'ÐšÐ˜', 60, 8, '', '', 'TODO', 'TODO', ''),
(32, 'Ð¡Ð¸ÑÑ‚ÐµÐ¼Ð½Ð¾ Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð¸Ñ€Ð°Ð½Ðµ', 'TODO', 6, 'i', 'i,is,kn,si', 'Ð˜Ð·Ñ‡Ð¸ÑÐ»Ð¸Ñ‚ÐµÐ»Ð½Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼Ð¸', 40, 3, '', '', 'TODO', 'TODO', ''),
(33, 'Ð¢ÐµÐ¾Ñ€Ð¸Ñ Ð½Ð° Ð¼Ð½Ð¾Ð¶ÐµÑÑ‚Ð²Ð°Ñ‚Ð°', 'ÐÐºÑÐ¸Ð¾Ð¼Ð°Ñ‚Ð¸Ñ‡Ð½Ð¾ Ð¸Ð·Ð³Ñ€Ð°Ð¶Ð´Ð°Ð½Ðµ Ð½Ð° Ñ‚ÐµÐ¾Ñ€Ð¸ÑÑ‚Ð° Ð½Ð° Ð¼Ð½Ð¾Ð¶ÐµÑÑ‚Ð²Ð°Ñ‚Ð°', 6, 'i', 'i,is,kn,si,m,pm,mi', 'Ð›Ð¾Ð³Ð¸ÐºÐ°', 800, 100, 'Ð¿Ð¾Ð½Ðµ 300iq', '', 'TODO', 'TODO', ''),
(34, 'Ð”Ð¸ÑÐºÑ€ÐµÑ‚Ð½Ð¸ ÑÑ‚Ñ€ÑƒÐºÑ‚ÑƒÑ€Ð¸', 'TODO', 6, 'z', 'i,is,kn,si,m,pm,s,mi', 'Ð˜Ð¡', 50, 10, '', '', 'TODO', 'TODO', ''),
(35, 'ÐœÐ°Ñ‚ÐµÐ¼Ð°Ñ‚Ð¸Ñ‡ÐµÑÐºÐ° Ð»Ð¾Ð³Ð¸ÐºÐ°', 'TODO', 6, 'i', 'i,is,kn,m,pm', 'Ð›Ð¾Ð³Ð¸ÐºÐ°', 100, 15, '', '', 'TODO', 'TODO', ''),
(37, 'Ð”Ð¸Ð·Ð°Ð¹Ð½ Ð¸ Ð°Ð½Ð°Ð»Ð¸Ð· Ð½Ð° Ð°Ð»Ð³Ð¾Ñ€Ð¸Ñ‚Ð¼Ð¸', 'Ð¢ÐžÐ”Ðž', 6, 'z', 'kn', 'ÐÐ·', 120, 14, '', '', 'Ð¢ÐžÐ”Ðž', 'Ð¢ÐžÐ”Ðž', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(5, 'pesho', '$2y$10$FvMrAo6YECu0.RMkf8A2Oe6S5dXBdn3rPAyxndC.XTeswg0E2Ql4y'),
(6, 'nakata', '$2y$10$gQn83UyS/FZyZGLtCXy0YuyzhBXzVOtZtCYstOziEt4uyyXFqwqfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plans_plans`
--
ALTER TABLE `plans_plans`
  ADD UNIQUE KEY `plan_id_main` (`plan_id_main`,`plan_id_dependency`),
  ADD KEY `fk_plan_id2` (`plan_id_dependency`);

--
-- Indexes for table `subject_plans`
--
ALTER TABLE `subject_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject_plans`
--
ALTER TABLE `subject_plans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plans_plans`
--
ALTER TABLE `plans_plans`
  ADD CONSTRAINT `fk_plan_id1` FOREIGN KEY (`plan_id_main`) REFERENCES `subject_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_plan_id2` FOREIGN KEY (`plan_id_dependency`) REFERENCES `subject_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_plans`
--
ALTER TABLE `subject_plans`
  ADD CONSTRAINT `subject_plans_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
