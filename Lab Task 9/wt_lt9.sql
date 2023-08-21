-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 01:37 AM
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
-- Database: `wt_lt5`
--

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
('placeHolderUserNameFromSession1692651690', 'placeHolderUserNameFromSession', 'solution', 'Case', 'Denmark', 'a random title', '2023-08-21', '2023-08-21', '../uploads/placeHolderUserNameFromSession1692651690-1692651690Screenshot (13).png', '../uploads/placeHolderUserNameFromSession1692651690-challenge-1692651690.txt', '../uploads/placeHolderUserNameFromSession1692651690-solution-1692651690.txt', '../uploads/placeHolderUserNameFromSession1692651690-result-1692651690.txt', '', 'approved'),
('placeHolderUserNameFromSession1692651731', 'placeHolderUserNameFromSession', 'solution', 'Policy', 'bangladesh', 'a title', '2023-08-21', '2023-08-21', '../uploads/placeHolderUserNameFromSession1692651731-1692651731Screenshot (21).png', '../uploads/placeHolderUserNameFromSession1692651731-challenge-1692651731.txt', '../uploads/placeHolderUserNameFromSession1692651731-solution-1692651731.txt', '../uploads/placeHolderUserNameFromSession1692651731-result-1692651731.txt', '', 'approved'),
('placeHolderUserNameFromSession1692651768', 'placeHolderUserNameFromSession', 'solution', 'R and D project', 'USA', 'title here', '2023-08-21', '2023-08-21', '../uploads/placeHolderUserNameFromSession1692651768-1692651768Screenshot (24).png', '../uploads/placeHolderUserNameFromSession1692651768-challenge-1692651768.txt', '../uploads/placeHolderUserNameFromSession1692651768-solution-1692651768.txt', '../uploads/placeHolderUserNameFromSession1692651768-result-1692651768.txt', '', 'approved'),
('placeHolderUserNameFromSession1692651809', 'placeHolderUserNameFromSession', 'solution', 'Case', 'bangladesh', 'random title here', '2023-08-21', '2023-08-21', '../uploads/placeHolderUserNameFromSession1692651809-1692651809Screenshot (16).png', '../uploads/placeHolderUserNameFromSession1692651809-challenge-1692651809.txt', '../uploads/placeHolderUserNameFromSession1692651809-solution-1692651809.txt', '../uploads/placeHolderUserNameFromSession1692651809-result-1692651809.txt', '', 'approved'),
('placeHolderUserNameFromSession1692651854', 'placeHolderUserNameFromSession', 'solution', 'Policy', 'Denmark', 'top asdf', '2023-08-21', '2023-08-21', '../uploads/placeHolderUserNameFromSession1692651854-1692651854Screenshot (26).png', '../uploads/placeHolderUserNameFromSession1692651854-challenge-1692651854.txt', '../uploads/placeHolderUserNameFromSession1692651854-solution-1692651854.txt', '../uploads/placeHolderUserNameFromSession1692651854-result-1692651854.txt', '', 'approved'),
('placeHolderUserNameFromSession1692651884', 'placeHolderUserNameFromSession', 'solution', 'R and D project', 'USA', 'another title', '2023-08-21', '2023-08-21', '../uploads/placeHolderUserNameFromSession1692651884-1692651884Screenshot (18).png', '../uploads/placeHolderUserNameFromSession1692651884-challenge-1692651884.txt', '../uploads/placeHolderUserNameFromSession1692651884-solution-1692651884.txt', '../uploads/placeHolderUserNameFromSession1692651884-result-1692651884.txt', '', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `solutionprovider`
--

CREATE TABLE `solutionprovider` (
  `username` varchar(255) NOT NULL,
  `organizationName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutionprovider`
--

INSERT INTO `solutionprovider` (`username`, `organizationName`) VALUES
('placeHolderUserNameFromSession', 'placeHolderOrgName');

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
  `type` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`type`, `id`, `sector`) VALUES
('solution', 'placeHolderUserNameFromSession1692651690', 'Bio Energy'),
('solution', 'placeHolderUserNameFromSession1692651690', 'Carbon Capture'),
('solution', 'placeHolderUserNameFromSession1692651731', 'District Heating'),
('solution', 'placeHolderUserNameFromSession1692651768', 'Carbon Capture'),
('solution', 'placeHolderUserNameFromSession1692651768', 'Offshore Wind'),
('solution', 'placeHolderUserNameFromSession1692651809', 'Bio Energy'),
('solution', 'placeHolderUserNameFromSession1692651809', 'Wastewater Management'),
('solution', 'placeHolderUserNameFromSession1692651854', 'District Heating'),
('solution', 'placeHolderUserNameFromSession1692651854', 'Offshore Wind'),
('solution', 'placeHolderUserNameFromSession1692651854', 'Wastewater Management'),
('solution', 'placeHolderUserNameFromSession1692651884', 'Offshore Wind');

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
('solution');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `solutionprovider_organizationname_unique` (`organizationName`);

--
-- Indexes for table `solutiontype`
--
ALTER TABLE `solutiontype`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD KEY `specialization_id_foreign` (`id`),
  ADD KEY `specialization_sector_foreign` (`sector`),
  ADD KEY `specialization_type_foreign` (`type`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `solution_solutiontype_foreign` FOREIGN KEY (`solutionType`) REFERENCES `solutiontype` (`name`),
  ADD CONSTRAINT `solution_type_foreign` FOREIGN KEY (`type`) REFERENCES `type` (`name`),
  ADD CONSTRAINT `solution_username_foreign` FOREIGN KEY (`username`) REFERENCES `solutionprovider` (`username`);

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `specialization_id_foreign` FOREIGN KEY (`id`) REFERENCES `solution` (`solutionID`),
  ADD CONSTRAINT `specialization_sector_foreign` FOREIGN KEY (`sector`) REFERENCES `sector` (`name`),
  ADD CONSTRAINT `specialization_type_foreign` FOREIGN KEY (`type`) REFERENCES `type` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
