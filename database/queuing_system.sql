-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2024 at 09:35 PM
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
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `datetimetaken` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `gradesid` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `yearid` int DEFAULT NULL,
  `subid` int DEFAULT NULL,
  `grades` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gradesid`, `student_id`, `yearid`, `subid`, `grades`) VALUES
(5, 24, NULL, 6, 1.2),
(6, 24, NULL, 9, 4.6),
(7, 24, NULL, 7, 1),
(8, 24, NULL, 8, 5),
(9, 24, NULL, 10, 1),
(10, 25, NULL, 17, 9),
(11, 25, NULL, 18, 2),
(12, 25, NULL, 16, 2),
(15, 24, NULL, 1, 0),
(16, 27, NULL, 5, 1.2);

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
('2024-05-28', 1001, 25, '', 1),
('2024-05-28', 1002, 24, '', 0),
('2024-05-28', 1003, 27, '', 1);

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
(24, '2110055-1', 'Rico James', 'Sabandal', 'Tinago, Tomas Oppus, Southern Leyte', 'male', 'jamessabandal@gmail.com', '2000-12-18', '09383403973', 1, NULL),
(25, '3110055-1', 'Re Ann', 'Nunez', 'Cambite, Tomas Oppus, Southern Leyte', 'female', 'jamessabandal@gmail.com', '2024-05-14', '09383403973', 4, NULL),
(27, '2210066-1', 'Jay', 'Nacano', 'Tinago, Tomas Oppus, Southern leyte', 'male', 'jamessabandal@gmail.com', '2024-05-10', '09123456789', 1, NULL);

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
-- Table structure for table `teacher_registration`
--

CREATE TABLE `teacher_registration` (
  `teacher_id` int NOT NULL,
  `id` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `yearid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teacher_registration`
--

INSERT INTO `teacher_registration` (`teacher_id`, `id`, `firstname`, `lastname`, `address`, `gender`, `email`, `birthday`, `phone`, `yearid`) VALUES
(1, '2110055-1', 'Rex', 'Toledo', 'sogod, southern leyte', 'male', 'jamessabandal@gmail.com', '2024-05-31', '09999999999', 1),
(2, '3110055-1', 'Rex', 'Toledo', 'sogod, southern leyte', 'male', 'jamessabandal@gmail.com', '2024-05-01', '09999999999', 2),
(3, '4110055-1', 'Rex', 'Toledo', 'sogod, southern leyte', 'male', 'jamessabandal@gmail.com', '2024-05-01', '099999999999', 3),
(4, '5110055-1', 'Rex', 'Toledo', 'sogod, southern leyte', 'male', 'jamessabandal@gmail.com', '2024-05-03', '099999999999', 4);

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
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
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
  ADD UNIQUE KEY `subid` (`subid`),
  ADD KEY `yearid` (`yearid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subid`),
  ADD KEY `yearid` (`yearid`);

--
-- Indexes for table `teacher_registration`
--
ALTER TABLE `teacher_registration`
  ADD PRIMARY KEY (`teacher_id`),
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `gradesid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `student_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teacher_registration`
--
ALTER TABLE `teacher_registration`
  MODIFY `teacher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

--
-- Constraints for table `teacher_registration`
--
ALTER TABLE `teacher_registration`
  ADD CONSTRAINT `teacher_registration_ibfk_1` FOREIGN KEY (`yearid`) REFERENCES `yearlvl` (`yearid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
