-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 07:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wchc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminId` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `AdminFirstName` varchar(50) NOT NULL,
  `AdminLastName` varchar(50) NOT NULL,
  `AdminPhone` varchar(15) NOT NULL,
  `AdminEmail` varchar(20) NOT NULL,
  `AdminDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `password`, `AdminFirstName`, `AdminLastName`, `AdminPhone`, `AdminEmail`, `AdminDOB`) VALUES
('wchcadmin', 'Wchcadmin!', 'First', 'Last', '3135550000', 'email@gmail.com', '1970-01-01');

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
  `race` varchar(20) NOT NULL,
  `validate` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

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