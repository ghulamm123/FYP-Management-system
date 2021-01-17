-- phpMyAdmin SQL Dump

-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2019 at 02:52 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8403841_fypms`
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
(1, 'admin', 'admin123', '2019-09-05', '2019-09-05');

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
  `midyear_status` tinyint(1) NOT NULL DEFAULT 0,
  `final_external_id` int(11) DEFAULT NULL,
  `final_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `username`, `password`, `internal_id`, `internal_req_id`, `midyear_external_id`, `midyear_status`, `final_external_id`, `final_status`) VALUES
(4, 'leader1', '$2y$10$eqbw0krcVAh2XOXceZQQRuwFM2WXEFaPx6UMR2Xm.Tz9dCWZ75Kqe', 8, 8, 6, 0, NULL, 0),
(5, 'Wajeh', '$2y$10$ADopM7vJn2L1MY.CYzpSSuXtjc6BLaSRaf7DAGJVA3.Jyg55vvUPS', NULL, NULL, NULL, 0, NULL, 0);

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
  `committee` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `internals`
--

INSERT INTO `internals` (`id`, `username`, `password`, `fullname`, `designation`, `committee`, `status`) VALUES
(6, 'Shahab', '$2y$10$gyBvBI3qCw9a9QdSCQqxt./lR1ae2JTRCdFxRyIUZYNYc43nzH6Zi', 'Shahab Tehzeeb', 'associate professor', 1, 1),
(8, 'ismail', '$2y$10$q8Haj2ipS922IZCWTIX83.Uhs5eyThgAXQ9eyba9x.eA0BaWffpZu', 'Ali Ismail', 'associate professor', 2, 1),
(11, 'Shehzad', '$2y$10$ynoG0zCoojLUMoOyPOg2oOfJSiURUhhYkJNlDdTF.lFiQEg.13fXi', 'Shehzad Hasan', 'associate professor', 3, 1),
(12, 'khurram', '$2y$10$erjxVxVZYO0bME/S5aKs0uPttGwC.HVJHMB.2tzOtt8u.s8Ysjsni', 'Muhammad Khurram', 'associate professor', 4, 1),
(13, 'Wajeh', '$2y$10$ywwZgk1yYELO6GYJCYZlN.tSh7oAZE8RmYjN6IatXa2nQmbuApQ06', 'Kashif_Asrar', 'lecturer', 0, 1),
(14, 'majida', '$2y$10$D0WwIoD6fg/9pYjCgngCw.UxI6IdHRm6LlHponNFlj.IdCadTRdEa', 'Majida Kazmi', 'associate professor', 5, 1);

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
  `poster` tinyint(1) NOT NULL DEFAULT 0,
  `checklist` tinyint(1) NOT NULL DEFAULT 0
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
  `comment_5` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requested`
--

INSERT INTO `requested` (`id`, `group_id`, `filename`, `description`, `date_time`, `status_1`, `comment_1`, `status_2`, `comment_2`, `status_3`, `comment_3`, `status_4`, `comment_4`, `status_5`, `comment_5`) VALUES
(7, 4, 'Group 4 Example Project', 'Some Description!!', '2019-09-02 05:23:30', 1, 'Committee 1 comment!!', 1, 'Committee 2 comment!!', 1, 'Committee 3 comment!!', 1, 'Committee 4 comment!!', 1, 'Committee 5 comment!!');

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
(16, 5, 'wajeh3', '24', 'ned/', 3.6);

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
(45, 6, 'idea', 'description			', '2019-09-01 15:11:40', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `final`
--
ALTER TABLE `final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `internals`
--
ALTER TABLE `internals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `midyear`
--
ALTER TABLE `midyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requested`
--
ALTER TABLE `requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
