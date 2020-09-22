-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: rentzambia.com.mysql.service.one.com:3306
-- Generation Time: Dec 02, 2019 at 05:46 PM
-- Server version: 10.3.17-MariaDB-1:10.3.17+maria~bionic
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentzambia_com_nalipay2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_levels`
--

CREATE TABLE `access_levels` (
  `access_level_id` int(255) NOT NULL,
  `access_level_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_levels`
--

INSERT INTO `access_levels` (`access_level_id`, `access_level_name`) VALUES
(1, 'Super-Admin'),
(2, 'Admin'),
(3, 'Agent'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  `user_role_id` int(20) DEFAULT NULL,
  `access_level_id` int(20) NOT NULL,
  `city_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `nrc` varchar(110) NOT NULL,
  `acc_balance` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `group_id`, `user_role_id`, `access_level_id`, `city_id`, `first_name`, `last_name`, `email`, `contact_number`, `nrc`, `acc_balance`, `password`, `address`) VALUES
(1, 1, 1, 1, 1, 'Daniel', 'Ng`andu', 'dan.ngandu@gmail.com', '0975517084', '111111/11/1', 105, '7c4a8d09ca3762af61e59520943dc26494f8941b', ''),
(2, 2, 1, 1, 2, 'Kelvin', 'Tembo', 'kelvin.tembo@gmail.com', '0973130149', '112222/11/1', 915, '7c4a8d09ca3762af61e59520943dc26494f8941b', ''),
(10, 2, 1, 4, 1, 'lisa', 'bwalya', 'lisa@gmail.com', '0975517084', '620616/52/1', 0, 'ac922e4476e122813b1a15f9fed056ee1563fb9b', ''),
(11, 1, 1, 4, 2, 'mema', 'mama', 'celcius.kt@gmail.com', '0975517084', '345617/54/1', 0, '49f94880edfb4c0827db697346b53b015b73e1eb', '');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `province_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='names of various cities in each province';

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `province_id`, `date_created`, `date_modified`) VALUES
(1, 'Lusaka', 5, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(2, 'Kitwe', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(3, 'Ndola', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(4, 'Kabwe', 1, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(5, 'Chingola', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(6, 'Mufulira', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(7, 'Luanshya', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(8, 'Livingstone', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(9, 'Kasama', 8, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(10, 'Chipata', 3, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(11, 'Kalulushi', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(12, 'Mazabuka', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(13, 'Chililabombwe', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(14, 'Mongu', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(15, 'Kafue', 5, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(16, 'Choma', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(17, 'Mansa', 4, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(18, 'Kansanshi', 7, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(19, 'Kapiri Mposhi', 1, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(20, 'Monze', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(21, 'Mpika', 6, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(22, 'Nchelenge', 4, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(23, 'Kawambwa', 4, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(24, 'Mbala', 8, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(25, 'Samfya', 4, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(26, 'Sesheke', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(27, 'Petauke', 3, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(28, 'Mumbwa', 1, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(29, 'Siavonga', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(30, 'Kaoma', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(31, 'Chinsali', 6, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(32, 'Kataba', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(33, 'Mwinilunga', 7, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(34, 'Isoka', 6, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(35, 'Mkushi', 1, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(36, 'Maamba', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(37, 'Lundazi', 3, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(38, 'Sinazongwe', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(39, 'Chambishi', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(40, 'Nakonde', 6, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(41, 'Nakambala', 9, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(42, 'Senanga', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(43, 'Mpongwe', 2, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(44, 'Serenje', 1, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(45, 'Mpulungu', 8, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(46, 'Kalabo', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(47, 'Kalengwa', 7, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(48, 'Limulunga', 10, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(49, 'Zambezi', 7, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(50, 'Mungwi', 8, '2018-10-10 10:25:18', '0000-00-00 00:00:00'),
(51, 'Solwezi', 7, '2018-10-10 10:25:18', '0000-00-00 00:00:00');

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
(19, 12, 1),
(20, 12, 12),
(21, 12, 12),
(22, 12, 12),
(23, 12, 12),
(24, 12, 12),
(25, 12, 12),
(26, 12, 12),
(27, 12, 12),
(28, 12, 12),
(29, 12, 12),
(30, 12, 4),
(31, 12, 5),
(32, 12, 1),
(33, 12, 4),
(34, 12, 5),
(35, 12, 1),
(36, 12, 4),
(37, 12, 5),
(38, 12, 5),
(39, 12, 4),
(40, 12, 1),
(41, 12, 1),
(42, 12, 1),
(43, 12, 4),
(44, 12, 5),
(45, 12, 5),
(46, 12, 5),
(47, 12, 4),
(48, 12, 1),
(49, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(30) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `group_address` varchar(30) NOT NULL,
  `group_account_bal` double NOT NULL,
  `created_by` int(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_address`, `group_account_bal`, `created_by`, `date_created`) VALUES
(1, 'Group One', 'UNZA, Lusaka', 750, NULL, NULL),
(2, 'Group Two', 'Kabwata, Lusaka', 1790, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_mem_id` int(11) NOT NULL,
  `group_id` int(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(255) DEFAULT NULL,
  `modified_by` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_mem_id`, `group_id`, `date_created`, `created_by`, `modified_by`) VALUES
(1, 1, 1, '2019-10-20 08:35:13', NULL, NULL),
(2, 2, 2, '2019-11-12 20:52:06', NULL, NULL);

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
(12, 1, 'Buba', 12, 'Tembo', '+260973130149'),
(13, 1, '', 1, 'Abraham', '+260979287812'),
(14, 1, '', 4, 'bupe', '+260976503727'),
(15, 1, '', 5, 'Chileleko', '+260964669680');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(20) NOT NULL,
  `group_mem_id` int(20) DEFAULT NULL,
  `group_id` int(20) NOT NULL,
  `amount_given` decimal(10,0) NOT NULL,
  `interest_charged` decimal(10,0) NOT NULL,
  `interest_amt` int(11) DEFAULT NULL,
  `loan_officer_id` int(20) NOT NULL,
  `date_given` date NOT NULL,
  `date_to_payback` date DEFAULT NULL,
  `payback_amt` decimal(10,0) NOT NULL,
  `loan_status` varchar(11) DEFAULT NULL,
  `amount_paid` float NOT NULL,
  `owing` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loan_id`, `group_mem_id`, `group_id`, `amount_given`, `interest_charged`, `interest_amt`, `loan_officer_id`, `date_given`, `date_to_payback`, `payback_amt`, `loan_status`, `amount_paid`, `owing`) VALUES
(4, 1, 1, '400', '0', NULL, 1, '2019-10-03', '2019-12-29', '407', NULL, 500, 0),
(5, 1, 1, '1000', '0', NULL, 1, '2019-10-03', '2019-12-29', '1017', NULL, 0, 0),
(6, 1, 1, '1000', '10', NULL, 1, '2019-10-03', '2020-01-11', '1025', NULL, 700, 0),
(7, 1, 1, '400', '20', 480, 1, '2019-10-26', '2019-12-30', '880', '1', 0, 880),
(8, 1, 1, '200', '20', 80, 1, '2019-10-28', '2019-12-30', '280', '1', 0, 280),
(9, 1, 1, '200', '20', 40, 1, '2019-10-28', '2019-11-28', '240', '1', 0, 240),
(10, 1, 1, '250', '20', 150, 1, '2019-10-28', '2020-01-07', '400', '1', 0, 400);

-- --------------------------------------------------------

--
-- Table structure for table `loan_officers`
--

CREATE TABLE `loan_officers` (
  `loan_officer_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `loan_officer_number` varchar(13) NOT NULL,
  `loan_officer_address` varchar(30) NOT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_officers`
--

INSERT INTO `loan_officers` (`loan_officer_id`, `user_id`, `loan_officer_number`, `loan_officer_address`, `date_created`) VALUES
(1, 1, '0987655442', 'Lusaka', '2019-04-17'),
(2, 2, '09781111111', 'Lusaka', '2019-04-15'),
(3, 1, '0987654', 'Lsk', '2019-04-15'),
(4, 1, '0987654', 'Lsk', '2019-04-15'),
(5, 1, '0987654', 'Lsk', '2019-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `money_transfers`
--

CREATE TABLE `money_transfers` (
  `trans_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `sender_phone_number` varchar(255) NOT NULL,
  `reciever_phone_number` varchar(15) NOT NULL,
  `amount_sent` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `money_transfers`
--

INSERT INTO `money_transfers` (`trans_id`, `user_id`, `sender_phone_number`, `reciever_phone_number`, `amount_sent`, `description`, `transaction_date`) VALUES
(1, 1, '0975517084', '0973130149', 500, 'Sent 500 meant for personal to Kelvin', '2019-11-05 21:07:32'),
(2, 1, '0975517084', '', 200, 'Sent 200 meant for need to ', '2019-11-05 21:44:44'),
(3, 1, '0975517084', '', 200, 'Sent 200 meant for need to ', '2019-11-05 21:45:22'),
(4, 1, '0975517084', '', 100, 'Sent 100 meant for need to ', '2019-11-05 21:47:17'),
(5, 1, '0975517084', '', 50, 'Sent 50 meant for need to ', '2019-11-05 21:50:29'),
(6, 1, '0975517084', '', 10, 'Sent 10 meant for need to ', '2019-11-05 21:54:48'),
(7, 1, '0975517084', '', 10, 'Sent K10 meant for need to ', '2019-11-05 21:56:37'),
(8, 1, '0975517084', '', 10, 'Sent K10 meant for need to ', '2019-11-05 21:58:43'),
(9, 1, '0975517084', '0973130149', 10, 'Sent K10 meant for need to Kelvin', '2019-11-05 22:02:45'),
(10, 1, '0975517084', '0973130149', 20, 'Sent K20 meant for nkongole to Kelvin', '2019-11-05 22:26:18'),
(11, 1, '0975517084', '0973130149', 150, 'Sent K150 meant for airtime to Kelvin', '2019-11-05 22:29:06'),
(12, 1, '0975517084', '0973130149', 80, 'Sent K80 meant for nkongole to Kelvin', '2019-11-05 22:30:08'),
(13, 1, '0975517084', '0973130149', 80, 'Sent K80 meant for free to Kelvin', '2019-11-06 11:38:17'),
(14, 1, '0975517084', '', 20, 'Sent K20 meant for personal to ', '2019-11-12 21:06:33'),
(15, 1, '0975517084', '0973130149', 20, 'Sent K20 meant for personal to Kelvin', '2019-11-12 21:07:00'),
(16, 1, '0975517084', '0973130149', 20, 'Sent K20 meant for personal to Kelvin', '2019-11-12 21:08:53'),
(17, 1, '0975517084', '0973130149', 20, 'Sent K20 meant for personal to Kelvin', '2019-11-12 21:26:22'),
(18, 1, '0975517084', '0973130149', 10, 'Sent K10 meant for Loan to Kelvin', '2019-11-12 21:27:53'),
(19, 1, '0975517084', '0973130149', 5, 'Sent K5 meant for fly to Kelvin', '2019-11-14 20:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `pending_loans`
--

CREATE TABLE `pending_loans` (
  `loan_app_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `amount` int(110) NOT NULL,
  `purpose` longtext NOT NULL,
  `application_date` date NOT NULL,
  `owing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_loans`
--

INSERT INTO `pending_loans` (`loan_app_id`, `user_id`, `group_id`, `amount`, `purpose`, `application_date`, `owing`) VALUES
(4, 1, 1, 200, 'personal', '2019-11-03', 3049);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `province_id` int(11) NOT NULL,
  `province_name` tinytext NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='names of varios provinces withing the country';

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `province_name`, `date_created`, `date_modified`) VALUES
(1, 'Central', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(2, 'Copperbelt', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(3, 'Eastern', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(4, 'Luapula', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(5, 'Lusaka', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(6, 'Muchinga', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(7, 'North-Western', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(8, 'Northern', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(9, 'Southern', '2018-10-10 11:10:46', '0000-00-00 00:00:00'),
(10, 'Western', '2018-10-10 11:10:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `trans_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `amount_saved` decimal(65,0) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `trans_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`trans_id`, `user_id`, `amount_saved`, `description`, `trans_date`) VALUES
(1, 1, '200', NULL, '2019-06-19 00:00:00'),
(2, 1, '20', NULL, '2019-06-09 09:56:50'),
(3, 1, '20', 'Savings 20 meant for test', '2019-06-09 10:03:02'),
(4, 1, '20', 'Saving K20 meant for test', '2019-06-09 10:04:02'),
(5, 1, '20', 'Saving K20 meant for test', '2019-06-09 10:04:04'),
(6, 1, '-20', '', '2019-06-17 17:55:41'),
(7, 1, '-20', '', '2019-06-17 17:55:54'),
(8, 1, '-20', '', '2019-06-17 17:56:43'),
(9, 1, '-20', '', '2019-06-17 17:57:50'),
(10, 1, '-20', '', '2019-06-17 17:58:12'),
(11, 1, '-20', 'User Released K20', '2019-06-17 18:00:09'),
(12, 1, '-20', 'User Released K20', '2019-06-17 18:00:26'),
(13, 1, '-20', 'User Released K20', '2019-06-17 18:05:42'),
(14, 1, '20', '', '2019-11-04 20:34:47'),
(15, 1, '20', '', '2019-11-04 20:44:15'),
(16, 1, '40', '', '2019-11-04 21:26:00'),
(17, 1, '-35', '', '2019-11-05 20:02:21'),
(18, 1, '-5', '', '2019-11-05 20:08:52'),
(19, 1, '-5', '', '2019-11-05 20:10:10'),
(20, 1, '-5', '', '2019-11-05 20:10:28'),
(21, 1, '-5', '', '2019-11-05 20:10:30'),
(22, 1, '-5', '', '2019-11-05 20:10:32'),
(23, 1, '-5', '', '2019-11-05 20:11:42'),
(24, 1, '-5', '', '2019-11-05 20:14:26'),
(25, 1, '-24', '', '2019-11-05 20:34:40'),
(26, 1, '-6', '', '2019-11-05 20:39:25'),
(27, 1, '15', '', '2019-11-05 20:39:39'),
(28, 1, '15', '', '2019-11-05 20:46:16'),
(29, 1, '20', '', '2019-11-05 20:46:35'),
(30, 1, '-40', '', '2019-11-05 20:46:48'),
(31, 1, '-10', '', '2019-11-05 20:48:31'),
(32, 1, '50', '', '2019-11-12 20:08:29'),
(33, 1, '20', '', '2019-11-12 20:11:22'),
(34, 1, '20', '', '2019-11-12 20:12:48'),
(35, 1, '20', '', '2019-11-12 20:13:46'),
(36, 1, '20', '', '2019-11-12 20:14:39'),
(37, 1, '20', '', '2019-11-12 20:15:39'),
(38, 1, '20', '', '2019-11-12 20:18:23'),
(39, 1, '20', '', '2019-11-12 20:22:15'),
(40, 1, '20', '', '2019-11-12 20:25:39'),
(41, 1, '20', '', '2019-11-12 20:26:47'),
(42, 1, '20', '', '2019-11-12 20:27:55'),
(43, 1, '-200', '', '2019-11-12 20:28:28'),
(44, 1, '20', '', '2019-11-12 20:28:43'),
(45, 1, '20', '', '2019-11-12 20:29:11'),
(46, 1, '-20', '', '2019-11-12 20:33:44'),
(47, 1, '20', '', '2019-11-14 20:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `token` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `user`, `token`) VALUES
(1, 1, 'cwkCVMKOBYQ:APA91bFtfFfmsncfc6naAmaZsFTKl58n1HbirxlAUeFmaBAOpae0f00jCZbfj3ViKpFbPXfNhbDeCCRRbb4iKVBYUgk08nmff-inWs7jrP8IOF7HWxLCaqcQjqckN9JNAyURT9poggsC');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `group_id` int(20) NOT NULL,
  `trans_date` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `group_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES
(1, 1, '2019-10-26 20:40:26', 'Approved Loan', 400, 0, 1400),
(2, 1, '2019-10-26 20:43:11', 'Approved Loan', 400, 0, 1400),
(3, 1, '2019-10-26 20:58:48', 'Approved Loan', 400, 0, 1400),
(4, 1, '2019-10-27 22:56:47', 'Approved Loan', 200, 0, 1200),
(5, 1, '2019-10-27 23:00:48', 'Approved Loan', 200, 0, 1000),
(6, 1, '2019-10-27 23:18:44', 'Approved Loan', 250, 0, 750);

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
  `phone_number` varchar(14) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `nrc`, `DOB`, `phone_number`, `city`, `email`) VALUES
(1, 'Abraham', 'Bwalya', '233449/10/1', '1993-12-23', '+260979287812', 'lusaka', 'kb@gmail.com'),
(2, 'Baraka', 'banda', '12233/10/2', '1990-10-12', '+260962783270', 'kitwe', 'barake@yahoo'),
(3, 'Dr khalezhi', 'Dr', '12223/10/2', '1845-10-24', '+260971978077', 'kitwe', 'Drk@yahoo'),
(4, 'bupe', 'tembo', '12334/10/1', '1996-03-10', '+260976503727', 'lusaka', 'bupa@gmail.com'),
(5, 'Chileleko', 'H', '15432/10/2', '1992-09-30', '+260964669680', 'ndola', 'chilele@yahoo.com'),
(6, 'jessy', 'bwalya', '12245/10/1', '1993-10-23', '+260950516274', 'lusaka', 'jessy@gmail.com'),
(9, 'lubuto', 'banda', '12338/10/3', '0000-00-00', '+260950878598', 'kitwe', 'lulu@gmail.com'),
(10, 'chiyalu', 'zimba', '2352/20/3', '1999-09-17', '+260953152394', 'ndola', 'chiya@yahoo.com'),
(11, 'Enoch', 'Siame', '12334/30/1', '1889-10-22', '+260950003563', 'ndola', 'enoch@yahoo.com'),
(12, 'Tembo', 'kelvin', '620617/52/1', '0000-00-00', '+260973130149', 'lusaka', 'celcius.kt@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `trans_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trans_date` datetime NOT NULL,
  `remarks` varchar(110) NOT NULL,
  `debit` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`trans_id`, `user_id`, `trans_date`, `remarks`, `debit`, `credit`, `balance`) VALUES
(1, 1, '2019-10-26 20:36:24', 'Approved Loan amount of K400 from Group One vilage banking group', 0, 400, 400),
(6, 1, '2019-10-27 23:00:48', 'Approved Loan amount of K200 from Group One vilage banking group', 0, 200, 200),
(7, 1, '2019-10-27 23:18:44', 'Approved Loan amount of K250 from Group Two vilage banking group', 0, 250, 250),
(8, 1, '2019-11-04 20:44:15', 'You have saved K20', 0, 20, 1030),
(9, 1, '2019-11-04 21:26:00', 'You have saved K40', 0, 40, 990),
(10, 1, '2019-11-05 20:10:10', 'Released K5', 0, 5, 1035),
(11, 1, '2019-11-05 20:10:28', 'Released K5', 0, 5, 1040),
(12, 1, '2019-11-05 20:10:30', 'Released K5', 0, 5, 1045),
(13, 1, '2019-11-05 20:10:32', 'Released K5', 0, 5, 1050),
(14, 1, '2019-11-05 20:11:42', 'Released K5from savings', 0, 5, 1055),
(15, 1, '2019-11-05 20:14:26', 'Released K5 from savings', 0, 5, 130),
(16, 1, '2019-11-05 20:34:40', 'Released K24 from savings', 0, 24, 106),
(17, 1, '2019-11-05 20:39:25', 'Released K6 from savings', 0, 6, 100),
(18, 1, '2019-11-05 20:39:39', 'You have saved K15', 0, 15, 1075),
(19, 1, '2019-11-05 20:46:16', 'You have saved K15', 0, 15, 1060),
(20, 1, '2019-11-05 20:46:35', 'You have saved K20', 0, 20, 1040),
(21, 1, '2019-11-05 20:46:48', 'Released K40 from savings', 0, 40, 110),
(22, 1, '2019-11-05 20:48:31', 'Released K10 from savings', 0, 10, 100),
(23, 1, '2019-11-05 21:07:32', 'Sent 500 meant for personal to Kelvin', 0, 500, 590),
(24, 1, '2019-11-05 21:44:44', 'Sent 200 meant for need to ', 0, 200, 390),
(25, 1, '2019-11-05 21:45:22', 'Sent 200 meant for need to ', 0, 200, 190),
(26, 1, '2019-11-05 21:47:17', 'Sent 100 meant for need to ', 0, 100, 90),
(27, 1, '2019-11-05 21:50:29', 'Sent 50 meant for need to ', 0, 50, 40),
(28, 1, '2019-11-05 21:54:48', 'Sent 10 meant for need to ', 0, 10, 30),
(29, 1, '2019-11-05 21:56:37', 'Sent K10 meant for need to ', 0, 10, 20),
(30, 1, '2019-11-05 21:58:43', 'Sent K10 meant for need to ', 0, 10, 10),
(31, 1, '2019-11-05 22:02:45', 'Sent K10 meant for need to Kelvin', 0, 10, 0),
(32, 1, '2019-11-05 22:26:18', 'Sent K20 meant for nkongole to Kelvin', 0, 20, 570),
(33, 1, '2019-11-05 22:29:06', 'Sent K150 meant for airtime to Kelvin', 0, 150, 420),
(34, 1, '2019-11-05 22:30:08', 'Sent K80 meant for nkongole to Kelvin', 0, 80, 340),
(35, 1, '2019-11-06 11:38:17', 'Sent K80 meant for free to Kelvin', 0, 80, 260),
(36, 1, '2019-11-12 20:08:29', 'You have saved K50', 0, 50, 210),
(37, 1, '2019-11-12 20:11:22', 'You have saved K20', 0, 20, 190),
(38, 1, '2019-11-12 20:12:48', 'You have saved K20', 0, 20, 170),
(39, 1, '2019-11-12 20:13:46', 'You have saved K20', 0, 20, 150),
(40, 1, '2019-11-12 20:14:39', 'You have saved K20', 0, 20, 130),
(41, 1, '2019-11-12 20:15:39', 'You have saved K20', 0, 20, 110),
(42, 1, '2019-11-12 20:18:23', 'You have saved K20', 0, 20, 90),
(43, 1, '2019-11-12 20:22:15', 'You have saved K20', 0, 20, 70),
(44, 1, '2019-11-12 20:25:39', 'You have saved K20', 0, 20, 50),
(45, 1, '2019-11-12 20:26:47', 'You have saved K20', 0, 20, 30),
(46, 1, '2019-11-12 20:27:55', 'You have saved K20', 0, 20, 10),
(47, 1, '2019-11-12 20:28:28', 'Released K200 from savings', 0, 200, 150),
(48, 1, '2019-11-12 20:28:43', 'You have saved K20', 0, 20, 190),
(49, 1, '2019-11-12 20:29:11', 'You have saved K20', 0, 20, 170),
(50, 1, '2019-11-12 20:33:44', 'Released K20 from savings', 0, 20, 170),
(51, 1, '2019-11-12 21:06:33', 'Sent K20 meant for personal to ', 0, 20, 170),
(52, 1, '2019-11-12 21:07:00', 'Sent K20 meant for personal to Kelvin', 0, 20, 150),
(53, 1, '2019-11-12 21:08:54', 'Sent K20 meant for personal to Kelvin', 0, 20, 130),
(54, 1, '2019-11-12 21:26:23', 'Sent K20 meant for personal to Kelvin', 0, 20, 110),
(55, 1, '2019-11-12 21:27:53', 'Sent K10 meant for Loan to Kelvin', 0, 10, 100),
(56, 1, '2019-11-14 20:52:35', 'You have saved K20', 0, 20, 110),
(57, 1, '2019-11-14 20:58:47', 'Sent K5 meant for fly to Kelvin', 0, 5, 105);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_levels`
--
ALTER TABLE `access_levels`
  ADD PRIMARY KEY (`access_level_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`admin_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loangroupmember`
--
ALTER TABLE `loangroupmember`
  ADD PRIMARY KEY (`loan_group_member_id`),
  ADD KEY `group_id` (`group_id`,`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_officers`
--
ALTER TABLE `loan_officers`
  ADD PRIMARY KEY (`loan_officer_id`);

--
-- Indexes for table `money_transfers`
--
ALTER TABLE `money_transfers`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `sender_phone_number` (`sender_phone_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pending_loans`
--
ALTER TABLE `pending_loans`
  ADD PRIMARY KEY (`loan_app_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `nrc` (`nrc`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_levels`
--
ALTER TABLE `access_levels`
  MODIFY `access_level_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loangroupmember`
--
ALTER TABLE `loangroupmember`
  MODIFY `loan_group_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loan_officers`
--
ALTER TABLE `loan_officers`
  MODIFY `loan_officer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `money_transfers`
--
ALTER TABLE `money_transfers`
  MODIFY `trans_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pending_loans`
--
ALTER TABLE `pending_loans`
  MODIFY `loan_app_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `trans_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
