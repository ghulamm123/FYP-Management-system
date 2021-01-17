-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 03:09 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `defence_deadline` date DEFAULT NULL,
  `internal_selection_deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `defence_deadline`, `internal_selection_deadline`) VALUES
(1, 'admin', 'admin123', '2020-10-01', '2020-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `proposal_docx` tinyint(1) NOT NULL,
  `proposal_pdf` tinyint(1) NOT NULL,
  `research_paper_docx` tinyint(1) NOT NULL,
  `research_paper_pdf` tinyint(1) NOT NULL,
  `final_report_docx` tinyint(1) NOT NULL,
  `final_report_pdf` tinyint(1) NOT NULL,
  `proposal_defense_pptx` tinyint(1) NOT NULL,
  `midyear_pptx` tinyint(1) NOT NULL,
  `poster_day_pptx` tinyint(1) NOT NULL,
  `final_exam_pptx` tinyint(1) NOT NULL,
  `executable` tinyint(1) NOT NULL,
  `source_code` tinyint(1) NOT NULL,
  `database_files` tinyint(1) NOT NULL,
  `tools` tinyint(1) NOT NULL,
  `mp4_video` tinyint(1) NOT NULL,
  `poster` tinyint(1) NOT NULL,
  `hardware_module` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `hardware_details` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final`
--

CREATE TABLE `final` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `internal_id` int(11) NOT NULL,
  `external_id` int(11) NOT NULL,
  `criterion_1` int(11) NOT NULL,
  `criterion_2` int(11) NOT NULL,
  `criterion_3` int(11) NOT NULL,
  `criterion_4` int(11) NOT NULL,
  `criterion_5` int(11) NOT NULL,
  `criterion_6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `internal_id` int(11) DEFAULT NULL,
  `internal_req_id` int(11) DEFAULT NULL,
  `midyear_external_id` int(11) DEFAULT NULL,
  `midyear_status` tinyint(1) NOT NULL DEFAULT '0',
  `final_external_id` int(11) DEFAULT NULL,
  `final_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `username`, `password`, `internal_id`, `internal_req_id`, `midyear_external_id`, `midyear_status`, `final_external_id`, `final_status`) VALUES
(4, 'leader1', '$2y$10$eqbw0krcVAh2XOXceZQQRuwFM2WXEFaPx6UMR2Xm.Tz9dCWZ75Kqe', 8, 8, 6, 0, NULL, 0),
(5, 'Wajeh', '$2y$10$ADopM7vJn2L1MY.CYzpSSuXtjc6BLaSRaf7DAGJVA3.Jyg55vvUPS', 20, 20, NULL, 0, NULL, 0),
(22, 'aneelkumar', '$2y$10$pgY1qYrxTSTnYIPkcve7tu4GuyhS3H0Y9.3g2g6iimjdHAZmIvj72', 6, 6, NULL, 0, NULL, 0),
(23, 'tushar kum', '$2y$10$Y2jW0MfmeYEWMxjOwGpnfupJKrtXaylaC/1.WFCQBm5xhepkBvvH6', 6, 6, NULL, 0, NULL, 0),
(24, 'tusharkuma', '$2y$10$YG/XFZ6ZfSl5WzE/81eQgeJlwI2vl.NOBltqiMeiNlHS3krQ8yrpu', 6, 6, NULL, 0, NULL, 0),
(25, 'tusharkuma', '$2y$10$Zu4kbMWEtky91hVMDtTnde4rJ0FMxg/PmBBtvFbcQyFRkb87VNifi', 6, 6, NULL, 0, NULL, 0),
(26, 'tusharkuma', '$2y$10$qujt9hc2M4QzybBNVqLldOzsPxVBxgae6sINg6nHgdEZUZRMRQnJ.', 6, 6, NULL, 0, NULL, 0),
(27, 'aneelkumar', '$2y$10$LACmIpEoSy.UPyWVGpvj0OOhQwR6uYryWsyk69a8KvTcM0qF/i6Ji', 6, 6, NULL, 0, NULL, 0),
(28, 'aneelkumar', '$2y$10$YoZPoMAqHjYYZDOtPGaHOuneYq7rK5pbnuvH0gG9JfsdR9zzMHLjW', 8, 8, NULL, 0, NULL, 0),
(29, 'tusharkuma', '$2y$10$jn15vpdI3ERnEC1gLwTNzumhHk2CV3vnlwzRahmlTBDEn8fM8rTL6', 14, 14, NULL, 0, NULL, 0),
(30, 'aneelkumar', '$2y$10$bfQoyXNrIW28Uv8Ex/9npO3RrgqhmpjztJ601pdeF/j.J.bAH5K8C', 17, 17, NULL, 0, NULL, 0),
(31, 'rajeshkuma', '$2y$10$.u3XR7T2TNniyx0duQapU.PnqZi0vVdLDcoFIr86UErjTWp81Q79S', 11, 11, NULL, 0, NULL, 0),
(32, 'sahilkumar', '$2y$10$yh2cz6q.JglNy9ZnD5vOaeRAe2dLXwSYDx99umQVMkfui3plCfXbG', NULL, 6, NULL, 0, NULL, 0),
(33, 'ghulam', '$2y$10$9chE7vWzvnPqSqh.nuy/WehGxyn/5yARF.zNXk4QLgsD7DnG20HRG', 20, 20, NULL, 0, NULL, 0),
(34, 'waqas', '$2y$10$RR0Vs3SK5BSOXGDX7iqBGe8e34YS4kf1ll333XlLWuyzC0P54Rsji', 6, 6, NULL, 0, NULL, 0),
(35, 'vikram ', '$2y$10$qXAp48NMGUVVvmYFIRDl..q09ZDeTC8bmgiKYfO0oAl4PmS6Xy31.', NULL, 6, NULL, 0, NULL, 0),
(36, 'raj', '$2y$10$H7hKPs1L9QxXifDUoADqYONbDwkmmsp8ByWf8n0JNhi1Eb55kry2e', NULL, 6, NULL, 0, NULL, 0),
(37, 'karan', '$2y$10$qXAp48NMGUVVvmYFIRDl..q09ZDeTC8bmgiKYfO0oAl4PmS6Xy31.', NULL, NULL, NULL, 0, NULL, 0),
(38, 'Parshant', '$2y$10$s6pNUTUnX6wGYfG8d1dw0uj51XeJV1fv04eZDKAMWha/3mEFljfli', NULL, 24, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `internals`
--

CREATE TABLE `internals` (
  `id` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `committee` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `internals`
--

INSERT INTO `internals` (`id`, `username`, `password`, `fullname`, `designation`, `committee`, `status`) VALUES
(6, 'Shahab', '$2y$10$4LRfkXimTEiE7ruwpZDzzeOnB/5qy5Oje.AhLikFw1i.BD4I9wqXO', 'Shahab Tehzeeb', 'associate professor', 1, 1),
(8, 'ismail', '$2y$10$q8Haj2ipS922IZCWTIX83.Uhs5eyThgAXQ9eyba9x.eA0BaWffpZu', 'Ali Ismail', 'associate professor', 2, 1),
(11, 'Shehzad', '$2y$10$ynoG0zCoojLUMoOyPOg2oOfJSiURUhhYkJNlDdTF.lFiQEg.13fXi', 'Shehzad Hasan', 'associate professor', 3, 1),
(12, 'khurram', '$2y$10$erjxVxVZYO0bME/S5aKs0uPttGwC.HVJHMB.2tzOtt8u.s8Ysjsni', 'Muhammad Khurram', 'associate professor', 4, 1),
(13, 'Wajeh', '$2y$10$ywwZgk1yYELO6GYJCYZlN.tSh7oAZE8RmYjN6IatXa2nQmbuApQ06', 'Kashif_Asrar', 'lecturer', 0, 1),
(14, 'majida', '$2y$10$D0WwIoD6fg/9pYjCgngCw.UxI6IdHRm6LlHponNFlj.IdCadTRdEa', 'Majida Kazmi', 'associate professor', 5, 1),
(15, 'sirkashif', '$2y$10$VPf4WnTGVamqgPR4IbxpLeCq/LHRzwKHqc/IyWqIPjanf/BhmQSqi', 'sirkashifasrar', 'lecturer', 6, 1),
(16, 'sirkashif', '$2y$10$bJqDNxIrPZKxxUYbZQZvBubDVXBmuTEsodwWzvI1K17FbT.6aglCq', 'sir kashif asrar', 'lecturer', 7, 1),
(17, 'sir zafar', '$2y$10$tO5Fsa8kbfV3S0xJSrte8uuokSK2wp56RGn7MBQ3hcepE//DEPlti', 'sir zafar qasim', 'lecturer', 0, 1),
(18, 'sirkashif', '$2y$10$Rjjiv2q3fl9UpZVvEsVleO8OziOcJGA5X0lAZjDonsilr.AZLq5Ti', 'sir kashif asrar', 'lecturer', 8, 1),
(19, 'tusharkuma', '$2y$10$hxOsoeECobCqZs7GCsk1wO4GLh27uWVNHVH/NEngm5se8Uq7A4spC', 'tusharkumarmalhi', 'lecturer', 9, 1),
(20, 'siryasir', '$2y$10$DobAcKXH5WW2c0S4GFVQXe991D/dLwwmdJwfxLKVfUvHQ1iGUu56y', 'sir yasir naqvi', 'lecturer', 0, 1),
(21, 'sir yousaf', '$2y$10$KmGHcubHnri9iDsJKCqo9etOt.Ux9nESsPltwczqpDxPS96O9m1Z.', 'sir yousuf khan', 'assistant professor', 0, 1),
(22, 'sir kashif', '$2y$10$4LRfkXimTEiE7ruwpZDzzeOnB/5qy5Oje.AhLikFw1i.BD4I9wqXO', 'sir Kashif', 'lecturer', 0, 1),
(23, 'sir shahab', '$2y$10$DrkNUjdckoG9xRG9ySUUJuU9CyiX3FmLBd0YPH6ujrrtkZTsrhoRq', 'sir shahab', 'assistant professor', 0, 1),
(24, 'Sir Samad', '$2y$10$XwpBWEGdfuyz53A6y7R.Zuwmx.aIU1bNUyvhW4petVzHIzwRb9Mhu', 'Sir Samad khan', 'assistant professor', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `midyear`
--

CREATE TABLE `midyear` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `internal_id` int(11) NOT NULL,
  `external_id` int(11) NOT NULL,
  `criterion_1` int(11) NOT NULL,
  `criterion_2` int(11) NOT NULL,
  `criterion_3` int(11) NOT NULL,
  `criterion_4` int(11) NOT NULL,
  `criterion_5` int(11) NOT NULL,
  `criterion_6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `requested_id` int(11) NOT NULL,
  `internal_id` int(11) NOT NULL,
  `filename` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `poster` tinyint(1) NOT NULL DEFAULT '0',
  `checklist` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `group_id`, `requested_id`, `internal_id`, `filename`, `description`, `date_time`, `poster`, `checklist`) VALUES
(2, 4, 7, 8, 'Group 4  Project Proposal', 'Some Proposal Description!!', '2019-09-02 06:03:57', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requested`
--

CREATE TABLE `requested` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `filename` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `status_1` tinyint(1) DEFAULT NULL,
  `comment_1` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_2` tinyint(1) DEFAULT NULL,
  `comment_2` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_3` tinyint(1) DEFAULT NULL,
  `comment_3` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_4` tinyint(1) DEFAULT NULL,
  `comment_4` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_5` tinyint(1) DEFAULT NULL,
  `comment_5` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_6` tinyint(1) DEFAULT NULL,
  `comment_6` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_7` tinyint(1) DEFAULT NULL,
  `comment_7` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_8` tinyint(1) DEFAULT NULL,
  `comment_8` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_9` tinyint(1) DEFAULT NULL,
  `comment_9` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requested`
--

INSERT INTO `requested` (`id`, `group_id`, `filename`, `description`, `date_time`, `status_1`, `comment_1`, `status_2`, `comment_2`, `status_3`, `comment_3`, `status_4`, `comment_4`, `status_5`, `comment_5`, `status_6`, `comment_6`, `status_7`, `comment_7`, `status_8`, `comment_8`, `status_9`, `comment_9`) VALUES
(7, 4, 'Group 4 Example Project', 'Some Description!!', '2019-09-02 05:23:30', 1, 'Committee 1 comment!!', 1, 'Committee 2 comment!!', 1, 'Committee 3 comment!!', 1, 'Committee 4 comment!!', 1, 'Committee 5 comment!!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 35, 'Version 2', '		Modification of version 1	', '2020-09-20 12:52:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 36, 'Robotics 6', '	AI CLUB		', '2020-09-21 15:07:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 35, 'dummy', '			asdasdas', '2020-09-23 21:11:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 37, 'lo', '		ggggggggggggggggg	', '2020-09-23 22:04:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 38, 'ghjhjkjk', '	adadadad		', '2020-09-28 23:44:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `fullname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `rollno` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `enrollment` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `cgpa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `group_id`, `fullname`, `rollno`, `enrollment`, `cgpa`) VALUES
(11, 4, 'Hamza ali', 'CS-145', 'NED/2045/15-45', 3.5),
(12, 4, 'Imran', 'CS-055', 'NED/2225/15-45', 3.7),
(13, 4, 'Ibrahim', 'CS-099', 'NED/2012/15-45', 3.4),
(14, 5, 'wajeh1', '12', 'ned/', 3.2),
(15, 5, 'wajeh2', '13', 'ned/', 3.1),
(16, 5, 'wajeh3', '24', 'ned/', 3.6),
(54, 22, 'aneel', 'cs-305', 'ned/0210/15-16', 1.7),
(55, 22, 'ghulam', 'cs-063', 'ned/0104/15-16', 2.7),
(56, 22, 'ahmed', 'cs-069', 'ned/0696/15-16', 2.6),
(57, 32, 'sahil kumar', 'cs-123', 'Ned/1234/15-16', 2.5),
(58, 32, 'pankaj kumar', 'cs-122', 'Ned/5678/15-16', 2.6),
(59, 32, 'vinay kumar', 'cs-012', 'Ned/8765/15-16', 3.7),
(60, 33, 'a', 'cs-305', '23', 2.1),
(61, 33, 'b', 'cs-301', '12', 2.3),
(62, 33, 'c', 'cs-123', '45', 2),
(63, 34, 'asx', 'cs-123', '123', 2.2),
(64, 34, 'aws', 'cs-589', '589', 2.5),
(65, 34, 'qaz', 'cs-987', '987', 2.8),
(66, 35, 'parshant', 'cs-123', 'ned/0254/16-17', 2.8),
(67, 35, 'gulab', 'cs-234', 'ned/0321/16-17', 2.5),
(68, 35, 'mukesh', 'cs-456', 'ned/0325/16-17', 3.5),
(69, 36, 'pk', 'cs-120', 'ned/0222/16-17', 2.8),
(70, 36, 'tk', 'cs-128', 'ned/0223/16-17', 2.3),
(71, 36, 'jp', 'cs-124', 'ned/0222/16-17', 2.9),
(72, 37, 'karan1', '2221', '21', 2),
(73, 37, 'karan1', '33', '32', 3),
(74, 37, 'hhjjj', '45', '765', 1),
(75, 38, 'vijay', 'cs-231', 'ned/0210/16-17', 2),
(76, 38, 'Ghulam', 'cs-232', 'ned/0216/16-17', 2.2),
(77, 38, 'Hassan', 'cs-128', 'ned/0215/16-17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `internal_id` int(11) NOT NULL,
  `filename` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `group_req_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `internal_id`, `filename`, `description`, `date_time`, `group_id`, `group_req_id`) VALUES
(45, 6, 'idea', 'description			', '2019-09-01 15:11:40', NULL, 38),
(46, 15, 'fypmanagementsystem', '			fhdkjfdhkjhfrjhfkjhfrkjhfr', '2020-02-12 15:44:01', NULL, NULL),
(49, 22, 'drggfr', '		rdgfrr	', '2020-09-21 15:10:40', NULL, NULL),
(50, 23, 'dfghjkl', '		lkjhgfd	', '2020-09-21 15:16:33', NULL, NULL),
(51, 22, 'asd2', '	rgtgttgh', '2020-09-23 22:02:54', NULL, NULL),
(52, 22, 'karan', '	asasasssa		', '2020-09-26 16:17:22', NULL, NULL),
(53, 6, 'testing 1', '	tytyt		', '2020-09-26 16:50:17', NULL, NULL),
(54, 24, 'agagagaga', '	jghghgh		', '2020-09-28 23:46:12', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `final`
--
ALTER TABLE `final`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `internal_id` (`internal_id`),
  ADD KEY `external_id` (`external_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internal_id` (`internal_id`),
  ADD KEY `external_id` (`midyear_external_id`),
  ADD KEY `final_external_id` (`final_external_id`);

--
-- Indexes for table `internals`
--
ALTER TABLE `internals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `midyear`
--
ALTER TABLE `midyear`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `internal_id` (`internal_id`),
  ADD KEY `external_id` (`external_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `requested_id` (`requested_id`),
  ADD KEY `internal_id` (`internal_id`);

--
-- Indexes for table `requested`
--
ALTER TABLE `requested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internal_id` (`internal_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `final`
--
ALTER TABLE `final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `internals`
--
ALTER TABLE `internals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `midyear`
--
ALTER TABLE `midyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `requested`
--
ALTER TABLE `requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`),
  ADD CONSTRAINT `checklist_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `final`
--
ALTER TABLE `final`
  ADD CONSTRAINT `final_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `final_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `final_ibfk_3` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`),
  ADD CONSTRAINT `final_ibfk_4` FOREIGN KEY (`internal_id`) REFERENCES `internals` (`id`),
  ADD CONSTRAINT `final_ibfk_5` FOREIGN KEY (`external_id`) REFERENCES `internals` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`internal_id`) REFERENCES `internals` (`id`),
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`midyear_external_id`) REFERENCES `internals` (`id`),
  ADD CONSTRAINT `groups_ibfk_3` FOREIGN KEY (`final_external_id`) REFERENCES `internals` (`id`);

--
-- Constraints for table `midyear`
--
ALTER TABLE `midyear`
  ADD CONSTRAINT `midyear_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `midyear_ibfk_2` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`),
  ADD CONSTRAINT `midyear_ibfk_3` FOREIGN KEY (`internal_id`) REFERENCES `internals` (`id`),
  ADD CONSTRAINT `midyear_ibfk_4` FOREIGN KEY (`external_id`) REFERENCES `internals` (`id`),
  ADD CONSTRAINT `midyear_ibfk_5` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `proposals_ibfk_2` FOREIGN KEY (`requested_id`) REFERENCES `requested` (`id`),
  ADD CONSTRAINT `proposals_ibfk_3` FOREIGN KEY (`internal_id`) REFERENCES `internals` (`id`);

--
-- Constraints for table `requested`
--
ALTER TABLE `requested`
  ADD CONSTRAINT `requested_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`internal_id`) REFERENCES `internals` (`id`),
  ADD CONSTRAINT `uploads_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
