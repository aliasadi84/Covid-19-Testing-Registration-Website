-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 17, 2022 at 02:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sourcecodester_dadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appId` int(3) NOT NULL,
  `patientIc` varchar(100) NOT NULL,
  `scheduleId` int(10) NOT NULL,
  `appSymptom` varchar(100) NOT NULL,
  `appComment` varchar(100) NOT NULL,
  `symp` varchar(10000) NOT NULL,
  `isolating` varchar(4) NOT NULL,
  `contact` varchar(4) NOT NULL,
  `travel` varchar(4) NOT NULL,
  `vaccinated` varchar(4) NOT NULL,
  `location` varchar(2) NOT NULL,
  `make` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `plate` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appId`, `patientIc`, `scheduleId`, `appSymptom`, `appComment`, `symp`, `isolating`, `contact`, `travel`, `vaccinated`, `location`, `make`, `color`, `plate`, `status`) VALUES
(86, '920517105553', 40, 'Pening Kepala', 'Bila doktor free?', '', '', '', '', '', '', '', '', '', 'done'),
(124, '123', 71, 'jkhkhg', 'mjghj', '', '', '', '', '', 'D', 'Tesla', 'Yellow', 'EJ5321', 'checked-in'),
(125, '123', 72, 'jijd', 'hdkjhd', '', '', '', '', '', 'G', 'Ford', 'Orange', 'KL1234', 'checked-in'),
(127, '123', 74, 'Sick', 'covid', 'fever or chills,cough,shortness of breath or difficulty breathing,', 'yes', 'yes', 'no', 'no', 'C', 'Ford', 'Yellow', '8967U', 'checked-in');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `icDoctor` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `doctorId` int(3) NOT NULL,
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `doctorAddress` varchar(100) NOT NULL,
  `doctorPhone` varchar(15) NOT NULL,
  `doctorEmail` varchar(20) NOT NULL,
  `doctorDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`icDoctor`, `password`, `doctorId`, `doctorFirstName`, `doctorLastName`, `doctorAddress`, `doctorPhone`, `doctorEmail`, `doctorDOB`) VALUES
('123456789', '123', 123, 'Docto', 'Sehgal', '', '01735677567', 'dsehg@gmail.com', '1990-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `doctorschedule`
--

CREATE TABLE `doctorschedule` (
  `scheduleId` int(11) NOT NULL,
  `scheduleDate` date NOT NULL,
  `scheduleDay` varchar(15) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `bookAvail` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorschedule`
--

INSERT INTO `doctorschedule` (`scheduleId`, `scheduleDate`, `scheduleDay`, `startTime`, `endTime`, `bookAvail`) VALUES
(40, '2015-12-13', 'Sunday', '09:00:00', '10:00:00', 'notavail'),
(69, '2022-03-15', '', '16:21:00', '16:22:00', 'notavail'),
(70, '2022-03-15', '', '16:55:00', '16:55:00', 'notavail'),
(71, '2022-03-15', '', '16:58:00', '17:00:00', 'notavail'),
(72, '2022-03-15', '', '17:10:00', '17:13:00', 'notavail'),
(73, '2022-03-15', '', '18:13:00', '21:09:00', 'available'),
(74, '2022-03-16', '', '15:33:00', '15:35:00', 'notavail');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `icPatient` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `patientFirstName` varchar(20) NOT NULL,
  `patientLastName` varchar(20) NOT NULL,
  `patientDOB` date NOT NULL,
  `patientGender` varchar(10) NOT NULL,
  `patientPhone` varchar(15) NOT NULL,
  `patientEmail` varchar(100) NOT NULL,
  `race` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`icPatient`, `password`, `patientFirstName`, `patientLastName`, `patientDOB`, `patientGender`, `patientPhone`, `patientEmail`, `race`) VALUES
('123', '123', 'Jaco', 'Korangu', '1995-09-14', 'female', '9999999999', 'josephpezhathinal1@gmail.com', ''),
('920517105553', '123', 'Mohd', 'Mazlan', '1992-05-17', 'male', '173567758', 'lan.psis@gmail.com', ''),
('podapullai', 'Sanjose111!', 'Joseph', 'Pezhathinal', '2015-06-09', 'male', '1234567890', 'jopan@gmail.com', 'asian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appId`),
  ADD UNIQUE KEY `scheduleId_2` (`scheduleId`),
  ADD KEY `patientIc` (`patientIc`),
  ADD KEY `scheduleId` (`scheduleId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`icDoctor`);

--
-- Indexes for table `doctorschedule`
--
ALTER TABLE `doctorschedule`
  ADD PRIMARY KEY (`scheduleId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`icPatient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `doctorschedule`
--
ALTER TABLE `doctorschedule`
  MODIFY `scheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`patientIc`) REFERENCES `patient` (`icPatient`),
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`scheduleId`) REFERENCES `doctorschedule` (`scheduleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
