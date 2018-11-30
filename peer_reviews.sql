-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 04:43 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peer_reviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `EvaluationID` int(11) NOT NULL,
  `CourseID` varchar(255) NOT NULL,
  `CourseTitle` varchar(255) NOT NULL,
  `Section` int(11) NOT NULL,
  `Semester` varchar(7) NOT NULL,
  `Year` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `finalgrades`
--

CREATE TABLE `finalgrades` (
  `StudentID` int(11) NOT NULL,
  `EvaluationID` int(11) NOT NULL,
  `FinalGrade` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradecriteria`
--

CREATE TABLE `gradecriteria` (
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradecriteria`
--

INSERT INTO `gradecriteria` (`Title`, `Description`) VALUES
('Attendance', 'Did he/she attend group meetings?'),
('Communication', 'Did he/she communicate well with the group?'),
('Contribution', 'Did he/she contribute to the project?'),
('Participation', 'Did he/she participate in group conversation?'),
('Supportiveness', 'Was he/she available to help other members?');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GradeID` int(11) NOT NULL,
  `Participation` int(11) NOT NULL,
  `Contribution` int(11) NOT NULL,
  `Attendance` int(11) NOT NULL,
  `Supportiveness` int(11) NOT NULL,
  `Communication` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `GraderID` int(11) NOT NULL,
  `EvaluationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` int(11) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `ProjectDescription` varchar(255) NOT NULL,
  `LeaderEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(1, 'Test', 'Test', 'testadmin@test.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `GroupID` int(10) DEFAULT NULL,
  `EvaluationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`EvaluationID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- Indexes for table `finalgrades`
--
ALTER TABLE `finalgrades`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `fk_eval` (`EvaluationID`);

--
-- Indexes for table `gradecriteria`
--
ALTER TABLE `gradecriteria`
  ADD PRIMARY KEY (`Title`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GradeID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `GraderID` (`GraderID`),
  ADD KEY `EvaluationID` (`EvaluationID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`),
  ADD UNIQUE KEY `LeaderEmail` (`LeaderEmail`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`InstructorID`),
  ADD UNIQUE KEY `email` (`Email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `email` (`Email`),
  ADD KEY `fk_groupID` (`GroupID`),
  ADD KEY `fk_evaluationID` (`EvaluationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `EvaluationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);

--
-- Constraints for table `finalgrades`
--
ALTER TABLE `finalgrades`
  ADD CONSTRAINT `fk_eval` FOREIGN KEY (`EvaluationID`) REFERENCES `evaluations` (`EvaluationID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`GraderID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`EvaluationID`) REFERENCES `evaluations` (`EvaluationID`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_evaluationID` FOREIGN KEY (`EvaluationID`) REFERENCES `evaluations` (`EvaluationID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_groupID` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
