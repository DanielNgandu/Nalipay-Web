-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2019 at 07:04 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `admin_id`, `friend_id`) VALUES
(1, 1, 1),
(2, 1, 11),
(3, 1, 6),
(4, 1, 9),
(5, 12, 12),
(6, 12, 12),
(18, 12, 12),
(19, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_loan_status`
--

CREATE TABLE `group_loan_status` (
  `id` int(11) NOT NULL,
  `loangroup` int(11) NOT NULL,
  `currentposition` int(11) NOT NULL,
  `datedue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loangroup`
--

CREATE TABLE `loangroup` (
  `group_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loangroup`
--

INSERT INTO `loangroup` (`group_id`, `admin_id`, `group_name`, `total`) VALUES
(12, 12, 'Buba', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `loangroupmember`
--

CREATE TABLE `loangroupmember` (
  `loan_group_member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `group_name` varchar(34) NOT NULL,
  `member_id` int(11) NOT NULL,
  `first_name` varchar(34) NOT NULL,
  `phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loangroupmember`
--

INSERT INTO `loangroupmember` (`loan_group_member_id`, `group_id`, `group_name`, `member_id`, `first_name`, `phone`) VALUES
(12, 12, 'Buba', 12, 'Tembo', '+260973130149'),
(13, 12, '', 1, 'Abraham', '+260979287812');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `phone`, `password`) VALUES
(12, '+260973130149', 'missbelle');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logid` int(11) NOT NULL,
  `first_name` varchar(34) NOT NULL,
  `last_name` varchar(34) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `acc_number` varchar(34) NOT NULL,
  `phone_number` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logid`, `first_name`, `last_name`, `user_id`, `group_id`, `acc_number`, `phone_number`) VALUES
(1, 'Abraham', 'Bwalya', 1, 1, '15558632411234', '+260979287812'),
(2, 'Enoch', 'Siame', 11, 1, '154343295645', '+260950003563'),
(3, 'jessy', 'bwalya', 6, 1, '114425255355', '+260950516274'),
(4, 'lubuto', 'banda', 9, 1, '4546431248454', '+260950878598'),
(5, 'Tembo', 'kelvin', 12, 12, '8245324', '+260973130149');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `nrc` varchar(11) NOT NULL,
  `DOB` date NOT NULL,
  `acc_number` varchar(18) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `nrc`, `DOB`, `acc_number`, `phone_number`, `city`, `email`) VALUES
(1, 'Abraham', 'Bwalya', '233449/10/1', '1993-12-23', '15558632411234', '+260979287812', 'lusaka', 'kb@gmail.com'),
(2, 'Baraka', 'banda', '12233/10/2', '1990-10-12', '124565389524', '+260962783270', 'kitwe', 'barake@yahoo'),
(3, 'Dr khalezhi', 'Dr', '12223/10/2', '1845-10-24', '125434557648', '+260971978077', 'kitwe', 'Drk@yahoo'),
(4, 'bupe', 'tembo', '12334/10/1', '1996-03-10', '154245564885', '+260976503727', 'lusaka', 'bupa@gmail.com'),
(5, 'Chileleko', 'H', '15432/10/2', '1992-09-30', '5434826154845', '+260964669680', 'ndola', 'chilele@yahoo.com'),
(6, 'jessy', 'bwalya', '12245/10/1', '1993-10-23', '114425255355', '+260950516274', 'lusaka', 'jessy@gmail.com'),
(9, 'lubuto', 'banda', '12338/10/3', '0000-00-00', '4546431248454', '+260950878598', 'kitwe', 'lulu@gmail.com'),
(10, 'chiyalu', 'zimba', '2352/20/3', '1999-09-17', '8454246434545', '+260953152394', 'ndola', 'chiya@yahoo.com'),
(11, 'Enoch', 'Siame', '12334/30/1', '1889-10-22', '154343295645', '+260950003563', 'ndola', 'enoch@yahoo.com'),
(12, 'Tembo', 'kelvin', '620617/52/1', '0000-00-00', '8245324', '+260973130149', 'lusaka', 'celcius.kt@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`admin_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `group_loan_status`
--
ALTER TABLE `group_loan_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loangroup` (`loangroup`);

--
-- Indexes for table `loangroup`
--
ALTER TABLE `loangroup`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `loangroupmember`
--
ALTER TABLE `loangroupmember`
  ADD PRIMARY KEY (`loan_group_member_id`),
  ADD KEY `group_id` (`group_id`,`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logid`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `nrc` (`nrc`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `acc_number_2` (`acc_number`),
  ADD KEY `acc_number` (`acc_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `group_loan_status`
--
ALTER TABLE `group_loan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loangroup`
--
ALTER TABLE `loangroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `loangroupmember`
--
ALTER TABLE `loangroupmember`
  MODIFY `loan_group_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `users` (`phone_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
