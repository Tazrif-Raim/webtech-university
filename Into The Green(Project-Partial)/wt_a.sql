-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 01:59 AM
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
-- Database: `wt_a`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`name`) VALUES
('Admin'),
('Reporter'),
('Researcher'),
('Solution Provider');

-- --------------------------------------------------------

--
-- Table structure for table `accesstype`
--

CREATE TABLE `accesstype` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accesstype`
--

INSERT INTO `accesstype` (`name`) VALUES
('Reporter'),
('Researcher'),
('Solution Provider');

-- --------------------------------------------------------

--
-- Table structure for table `organizationtype`
--

CREATE TABLE `organizationtype` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizationtype`
--

INSERT INTO `organizationtype` (`name`) VALUES
('Company'),
('Financial Institution'),
('Organization'),
('Public Sector'),
('Research Instituition'),
('Utility');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`name`) VALUES
('Bio Energy'),
('Carbon Capture'),
('District Heating'),
('Offshore Wind'),
('Wastewater Management');

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `solutionID` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `solutionType` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `submissionDate` date NOT NULL,
  `publicationDate` date DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `challenge` varchar(255) NOT NULL,
  `solutionBody` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solution`
--

INSERT INTO `solution` (`solutionID`, `username`, `type`, `solutionType`, `region`, `title`, `submissionDate`, `publicationDate`, `media`, `challenge`, `solutionBody`, `result`, `comment`, `status`) VALUES
('hannah1692772098', 'hannah', 'solution', 'Case', 'Bangladesh', 'a random title here', '2023-08-23', '2023-08-23', '../uploads/hannah1692772098-1692772098pic.png', '../uploads/hannah1692772098-challenge-1692772098.txt', '../uploads/hannah1692772098-solution-1692772098.txt', '../uploads/hannah1692772098-result-1692772098.txt', '', 'approved'),
('hannah1692772133', 'hannah', 'solution', 'Case', 'USA', 'this title', '2023-08-23', '2023-08-23', NULL, '../uploads/hannah1692772133-challenge-1692772133.txt', '../uploads/hannah1692772133-solution-1692772133.txt', '../uploads/hannah1692772133-result-1692772133.txt', '', 'approved'),
('hannah1692772171', 'hannah', 'solution', 'Policy', 'Denmark', 'carbon title', '2023-08-23', '2023-08-23', '../uploads/hannah1692772171-1692772171pexels-yelena-odintsova-7162551.jpg', '../uploads/hannah1692772171-challenge-1692772171.txt', '../uploads/hannah1692772171-solution-1692772171.txt', '../uploads/hannah1692772171-result-1692772171.txt', '', 'approved'),
('hannah1692772206', 'hannah', 'solution', 'R and D project', 'USA', 'district title', '2023-08-23', '2023-08-23', '../uploads/hannah1692772206-1692772206comLogo.png', '../uploads/hannah1692772206-challenge-1692772206.txt', '../uploads/hannah1692772206-solution-1692772206.txt', '../uploads/hannah1692772206-result-1692772206.txt', '', 'approved'),
('hannah1692772259', 'hannah', 'solution', 'Case', 'India', 'title India', '2023-08-23', '2023-08-23', '../uploads/hannah1692772259-1692772259OIP.jpg', '../uploads/hannah1692772259-challenge-1692772259.txt', '../uploads/hannah1692772259-solution-1692772259.txt', '../uploads/hannah1692772259-result-1692772259.txt', '', 'approved'),
('mehedihasan1692768557', 'mehedihasan', 'solution', 'Case', 'Denmark', 'a random title', '2023-08-23', '2023-08-23', '../uploads/mehedihasan1692768557-1692768557OIP.jpg', '../uploads/mehedihasan1692768557-challenge-1692768557.txt', '../uploads/mehedihasan1692768557-solution-1692768557.txt', '../uploads/mehedihasan1692768557-result-1692768557.txt', '', 'approved'),
('mehedihasan1692772305', 'mehedihasan', 'solution', 'Case', 'Bangladesh', 'random title', '2023-08-23', '2023-08-23', NULL, '../uploads/mehedihasan1692772305-challenge-1692772305.txt', '../uploads/mehedihasan1692772305-solution-1692772305.txt', '../uploads/mehedihasan1692772305-result-1692772305.txt', '', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `solutionprovider`
--

CREATE TABLE `solutionprovider` (
  `username` varchar(255) NOT NULL,
  `organizationName` varchar(255) DEFAULT NULL,
  `organizationType` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `aboutMedia` varchar(255) DEFAULT NULL,
  `founded` varchar(255) DEFAULT NULL,
  `employees` varchar(255) DEFAULT NULL,
  `hq` varchar(255) DEFAULT NULL,
  `story` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mapsLink` varchar(255) DEFAULT NULL,
  `contactName` varchar(255) DEFAULT NULL,
  `contactEmail` varchar(255) DEFAULT NULL,
  `shortAbout` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutionprovider`
--

INSERT INTO `solutionprovider` (`username`, `organizationName`, `organizationType`, `logo`, `aboutMedia`, `founded`, `employees`, `hq`, `story`, `website`, `address`, `mapsLink`, `contactName`, `contactEmail`, `shortAbout`) VALUES
('hannah', 'Random Name', 'Organization', NULL, NULL, '', NULL, NULL, '../uploads/hannahstory.txt', '', NULL, '', '', NULL, '../uploads/hannahshortAbout.txt'),
('mehedihasan', 'Solution Pro', 'Company', '../uploads/mehedihasan-1692755340image_2023_04_04_145646954.0.jpg', '../uploads/mehedihasan-1692755340Screenshot (13).png', '2019-01-07', '40', 'dhaka, bd', '../uploads/mehedihasanstory.txt', 'https://www.aiub.edu', 'dhaka, bd', 'https://www.google.com/maps/place/American+International+University+-+Bangladesh+(AIUB)/@23.8221291,90.424826,17z/data=!3m1!4b1!4m6!3m5!1s0x3755c711d13bbec7:0xc47f7c3e8e2263f2!8m2!3d23.8221242!4d90.4274063!16s%2Fm%2F026zp7q?entry=ttu', 'where', 'ssda@d.c', '../uploads/mehedihasanshortAbout.txt');

-- --------------------------------------------------------

--
-- Table structure for table `solutiontype`
--

CREATE TABLE `solutiontype` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutiontype`
--

INSERT INTO `solutiontype` (`name`) VALUES
('Case'),
('Policy'),
('R and D project');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `type` varchar(255) DEFAULT NULL,
  `id` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`type`, `id`, `sector`) VALUES
(NULL, 'mehedihasan', 'Carbon Capture'),
(NULL, 'mehedihasan', 'District Heating'),
(NULL, 'mehedihasan', 'Offshore Wind'),
('solution', 'mehedihasan1692768557', 'Carbon Capture'),
('solution', 'mehedihasan1692768557', 'District Heating'),
('solution', 'mehedihasan1692768557', 'Offshore Wind'),
('solution', 'hannah1692772098', 'Bio Energy'),
('solution', 'hannah1692772133', 'Offshore Wind'),
('solution', 'hannah1692772133', 'Wastewater Management'),
('solution', 'hannah1692772171', 'Carbon Capture'),
('solution', 'hannah1692772206', 'District Heating'),
('solution', 'hannah1692772259', 'Carbon Capture'),
('solution', 'hannah1692772259', 'District Heating'),
('solution', 'mehedihasan1692772305', 'Offshore Wind'),
('solution', 'mehedihasan1692772305', 'Wastewater Management'),
(NULL, 'hannah', 'Bio Energy'),
(NULL, 'hannah', 'District Heating'),
(NULL, 'hannah', 'Wastewater Management');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`name`) VALUES
('news'),
('publication'),
('reporter'),
('researcher'),
('solution'),
('solutionProvider');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `access` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `access`, `firstname`, `lastname`) VALUES
('admin', '$2y$10$U8Xo84XtJdsL7woCWJ5JGuipmTS0oKY2gH1FC1Smf3NZIgvM.N1ma', 'tyamshitr@gmail.com', 'Admin', 'admin', 'admin'),
('adminX', '$2y$10$021voFKxXC6vXdbbhgWfYuejFuRSKJfLGBt23.yW18oeU9jlhY6Ye', 'tyamshitr@gmail.com', 'Admin', 'adminX', 'adminX'),
('hannah', '$2y$10$24apylyYiU6/CA98goVo/uJ3Z56ERAejT/YmReHk2liPgMETLgZ.m', 'asd@g.com', 'Solution Provider', 'alve', ' hasan'),
('mehedihasan', '$2y$10$TbiMmO6UaMqUhqjpWaCzIuXFS4QeqfKh9UZgl5Xe9KWt5TVtYrYKK', 'yetiol1234@gmail.com', 'Solution Provider', 'Mehedi', 'Hasan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `accesstype`
--
ALTER TABLE `accesstype`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `organizationtype`
--
ALTER TABLE `organizationtype`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`solutionID`),
  ADD KEY `solution_type_foreign` (`type`),
  ADD KEY `solution_solutiontype_foreign` (`solutionType`),
  ADD KEY `solution_username_foreign` (`username`);

--
-- Indexes for table `solutionprovider`
--
ALTER TABLE `solutionprovider`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `solutionprovider_organizationname_unique` (`organizationName`),
  ADD KEY `solutionprovider_organizationtype_foreign` (`organizationType`);

--
-- Indexes for table `solutiontype`
--
ALTER TABLE `solutiontype`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD KEY `specialization_sector_foreign` (`sector`),
  ADD KEY `specialization_type_foreign` (`type`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `user_access_foreign` (`access`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accesstype`
--
ALTER TABLE `accesstype`
  ADD CONSTRAINT `accesstype_name_foreign` FOREIGN KEY (`name`) REFERENCES `access` (`name`);

--
-- Constraints for table `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `solution_solutiontype_foreign` FOREIGN KEY (`solutionType`) REFERENCES `solutiontype` (`name`),
  ADD CONSTRAINT `solution_type_foreign` FOREIGN KEY (`type`) REFERENCES `type` (`name`),
  ADD CONSTRAINT `solution_username_foreign` FOREIGN KEY (`username`) REFERENCES `solutionprovider` (`username`);

--
-- Constraints for table `solutionprovider`
--
ALTER TABLE `solutionprovider`
  ADD CONSTRAINT `solutionprovider_organizationtype_foreign` FOREIGN KEY (`organizationType`) REFERENCES `organizationtype` (`name`),
  ADD CONSTRAINT `solutionprovider_username_foreign` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `specialization_sector_foreign` FOREIGN KEY (`sector`) REFERENCES `sector` (`name`),
  ADD CONSTRAINT `specialization_type_foreign` FOREIGN KEY (`type`) REFERENCES `type` (`name`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_access_foreign` FOREIGN KEY (`access`) REFERENCES `access` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
