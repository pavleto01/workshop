-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 11:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL,
  `agent_email` varchar(255) NOT NULL,
  `agent_username` varchar(255) NOT NULL,
  `agent_password` varchar(255) NOT NULL,
  `agent_firstname` varchar(255) NOT NULL,
  `agent_lastname` varchar(255) NOT NULL,
  `perm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id_agent`, `agent_email`, `agent_username`, `agent_password`, `agent_firstname`, `agent_lastname`, `perm`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 'admin', 'admin', 1),
(2, 'pavleto01@gmail.com', 'pavel', '123456', 'Pavel', 'Todorov', 2),
(3, 'gosho@gmail.com', 'gosho', 'qwert', 'Georgi', 'Petrov', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id_car` int(11) NOT NULL,
  `car_license` varchar(255) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `VIN` varchar(255) NOT NULL,
  `car_brand` varchar(255) NOT NULL,
  `car_km` varchar(255) NOT NULL,
  `car_firm` varchar(255) NOT NULL,
  `owner_address` varchar(255) NOT NULL,
  `owner_phone1` varchar(255) NOT NULL,
  `owner_phone2` varchar(255) NOT NULL,
  `owner_phone3` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `car_note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id_case` int(11) NOT NULL,
  `date_in` timestamp NOT NULL DEFAULT current_timestamp(),
  `case_type` varchar(255) NOT NULL,
  `car_id` int(11) NOT NULL,
  `part_type` varchar(255) NOT NULL,
  `km_in` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `ow_address` varchar(255) NOT NULL,
  `ow_phone1` varchar(255) NOT NULL,
  `ow_phone2` varchar(255) NOT NULL,
  `ow_phone3` varchar(255) NOT NULL,
  `safo_type` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `bulstat` varchar(255) NOT NULL,
  `sum` decimal(12,2) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `caseworkers`
--

CREATE TABLE `caseworkers` (
  `id_cw` int(11) NOT NULL,
  `caseID` int(11) NOT NULL,
  `workerID` int(11) NOT NULL,
  `salary` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_car`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id_case`);

--
-- Indexes for table `caseworkers`
--
ALTER TABLE `caseworkers`
  ADD PRIMARY KEY (`id_cw`),
  ADD KEY `caseID` (`caseID`),
  ADD KEY `workerID` (`workerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id_case` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caseworkers`
--
ALTER TABLE `caseworkers`
  MODIFY `id_cw` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `caseworkers`
--
ALTER TABLE `caseworkers`
  ADD CONSTRAINT `caseID` FOREIGN KEY (`caseID`) REFERENCES `cases` (`id_case`),
  ADD CONSTRAINT `workerID` FOREIGN KEY (`workerID`) REFERENCES `agents` (`id_agent`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
