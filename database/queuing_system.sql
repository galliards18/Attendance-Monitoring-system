-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2024 at 05:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queuing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(3, 'a', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `gradesid` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `yearid` int DEFAULT NULL,
  `subid` int DEFAULT NULL,
  `grades` float(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gradesid`, `student_id`, `yearid`, `subid`, `grades`) VALUES
(1, 20, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `Date` date NOT NULL,
  `Que_no` int UNSIGNED NOT NULL,
  `student_id` int DEFAULT NULL,
  `student_fullname` varchar(50) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`Date`, `Que_no`, `student_id`, `student_fullname`, `IsActive`) VALUES
('2024-04-22', 1001, 20, '', 0),
('2024-04-22', 1002, 20, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `student_id` int NOT NULL,
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `yearid` int DEFAULT NULL,
  `subid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`student_id`, `id`, `firstname`, `lastname`, `address`, `gender`, `email`, `birthday`, `phone`, `yearid`, `subid`) VALUES
(20, '2110055-1', 'Re Ann', 'Nunez', 'Tinago, Tomas Oppus, Southern leyte', 'female', 'jamessabandal@gmail.com', '2024-03-10', '09383403973', NULL, NULL),
(21, '2110055-1', 'Ryan', 'Nunez', 'Tinago, Tomas Oppus, Southern leyte', 'male', 'jamessabandal@gmail.com', '2024-03-12', '09383403973', NULL, NULL),
(22, '2110055-1', 'Rico James', 'Sabandal', 'Tinago, Tomas Oppus, Southern leyte', 'male', 'jamessabandal@gmail.com', '2024-03-18', '09383403973', NULL, NULL),
(23, '2110055-1', 'Riche Jim', 'Sabandal', 'Tinago, Tomas Oppus, Southern leyte', 'male', 'jamessabandal@gmail.com', '2024-03-23', '09383403973', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subid` int NOT NULL,
  `yearid` int DEFAULT NULL,
  `subname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subid`, `yearid`, `subname`) VALUES
(1, 1, 'Introduction to Computer Science'),
(2, 1, 'Programming Fundamentals'),
(3, 1, 'Mathematics for Computing'),
(4, 1, 'Information Systems'),
(5, 1, 'Computer Hardware and Software'),
(6, 2, 'Network Fundamentals'),
(7, 2, 'Database Management Systems'),
(8, 2, 'Data Structures and Algorithms'),
(9, 2, 'Object-Oriented Programming\r\n'),
(10, 2, 'Web Development'),
(11, 3, 'Software Engineering'),
(12, 3, 'Operating Systems'),
(13, 3, 'Computer Security'),
(14, 3, 'Mobile Application Development'),
(15, 3, 'Cloud Computing'),
(16, 4, 'Capstone Project'),
(17, 4, 'IT Project Management'),
(18, 4, 'Artificial Intelligence'),
(19, 4, 'Cybersecurity Management'),
(20, 4, 'Advanced Topics in IT');

-- --------------------------------------------------------

--
-- Table structure for table `yearlvl`
--

CREATE TABLE `yearlvl` (
  `yearid` int NOT NULL,
  `yearlvl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `yearlvl`
--

INSERT INTO `yearlvl` (`yearid`, `yearlvl`) VALUES
(1, 'first-year college'),
(2, 'second-year college'),
(3, 'third-year college'),
(4, 'fourth-year college');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`gradesid`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `yearid` (`yearid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`Date`,`Que_no`),
  ADD KEY `Student_ID` (`student_id`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `yearid` (`yearid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subid`),
  ADD KEY `yearid` (`yearid`);

--
-- Indexes for table `yearlvl`
--
ALTER TABLE `yearlvl`
  ADD PRIMARY KEY (`yearid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `gradesid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `student_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `yearlvl`
--
ALTER TABLE `yearlvl`
  MODIFY `yearid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_registration` (`student_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`yearid`) REFERENCES `yearlvl` (`yearid`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`subid`) REFERENCES `subject` (`subid`);

--
-- Constraints for table `registrar`
--
ALTER TABLE `registrar`
  ADD CONSTRAINT `registrar_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_registration` (`student_id`);

--
-- Constraints for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD CONSTRAINT `student_registration_ibfk_1` FOREIGN KEY (`yearid`) REFERENCES `yearlvl` (`yearid`),
  ADD CONSTRAINT `student_registration_ibfk_2` FOREIGN KEY (`subid`) REFERENCES `subject` (`subid`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`yearid`) REFERENCES `yearlvl` (`yearid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
