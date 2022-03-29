-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 29, 2022 at 04:39 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `symp` varchar(10000) NOT NULL,
  `isolating` varchar(4) NOT NULL,
  `contact` varchar(4) NOT NULL,
  `travel` varchar(4) NOT NULL,
  `vaccinated` varchar(4) NOT NULL,
  `location` varchar(2) NOT NULL,
  `make` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `plate` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) DEFAULT NULL,
  `result` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `symp`, `isolating`, `contact`, `travel`, `vaccinated`, `location`, `make`, `color`, `plate`, `status`, `date`, `timeslot`, `result`) VALUES
(13, 'johnjacob', 'fever or chills,fatigue,', 'yes', 'yes', 'no', 'no', 'C', 'Ford', 'Orange', 'PL5678', 'result entered', '2022-03-26', '09:00AM - 09:10AM', 'positive'),
(14, 'johnjacob', 'fever or chills,shortness of breath or difficulty breathing,fatigue,', 'yes', 'yes', 'no', 'no', 'B', 'TATA', 'Blue', 'PLK8900', 'result entered', '2022-03-26', '10:30AM - 10:40AM', 'positive'),
(15, '123', 'fever or chills,cough,shortness of breath or difficulty breathing,', 'yes', 'yes', 'no', 'no', 'C', 'Tesla', '', 'EJ53', 'sample collected', '2022-03-28', '10:10AM - 10:20AM', 'processing'),
(16, '123', 'fever or chills,cough,', 'no', 'yes', 'no', 'no', 'C', 'Tesla', '', 'EJ53', 'result entered', '2022-03-28', '9:00AM - 9:10AM', 'positive'),
(17, '123', 'fever or chills,cough,', 'no', 'yes', 'no', 'no', 'C', 'Tesla', '', 'EJ53', 'result entered', '2022-03-28', '9:00AM - 9:10AM', 'negetive'),
(18, '123', 'fever or chills,cough,', 'no', 'yes', 'no', 'yes', 'C', 'Tesla', '', 'EJ53', 'result entered', '2022-03-28', '9:10AM - 9:20AM', 'positive'),
(19, '123', 'fever or chills,cough,', 'no', 'yes', 'no', 'yes', '', '', '', '', 'appointment booked', '2022-03-29', '9:00AM - 9:10AM', '');

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
('123', '123', 'Jaco', 'Korangu', '1995-09-14', 'male', '9999999999', 'josephpezhathinal1@gmail.com', ''),
('920517105553', '123', 'Mohd', 'Mazlan', '1992-05-17', 'male', '173567758', 'lan.psis@gmail.com', ''),
('johnjacob', 'Asweread3214!', 'John', 'Jacob', '2008-02-18', 'male', '2487172198', 'johnjacob@gmail.com', 'asian'),
('podapullai', 'Sanjose111!', 'Joseph', 'Pezhathinal', '2015-06-09', 'male', '1234567890', 'jopan@gmail.com', 'asian');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `icstaff` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `staffFirstName` varchar(50) NOT NULL,
  `staffLastName` varchar(50) NOT NULL,
  `staffPhone` varchar(100) NOT NULL,
  `staffEmail` varchar(100) NOT NULL,
  `staffDOB` date NOT NULL,
  `active` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`icstaff`, `password`, `staffFirstName`, `staffLastName`, `staffPhone`, `staffEmail`, `staffDOB`, `active`) VALUES
('josephthomas', 'Sanjose111!', 'Joseph', 'Thomas', '2489434012', 'joseph@gmail.com', '2022-03-10', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`icDoctor`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`icPatient`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`icstaff`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


