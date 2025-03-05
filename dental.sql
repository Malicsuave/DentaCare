-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 04:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`, `role`) VALUES
(1, 'admin', '$2y$10$/U.bSMVQykVF2wt8WIJhrefWlMEy9RmY/DCn8.OnZ0FyJ50kkUC1K', '04-03-2025 11:24:50 PM', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `payment_method` varchar(50) NOT NULL DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`, `payment_method`) VALUES
(3, 'Demo test', 7, 6, 600, '2019-06-29', '9:15 AM', '2019-06-23 18:31:28', 1, 0, '0000-00-00 00:00:00', 'cash'),
(4, 'Ayurveda', 5, 5, 8050, '2019-11-08', '1:00 PM', '2019-11-05 10:28:54', 1, 1, '0000-00-00 00:00:00', 'cash'),
(5, 'Dermatologist', 9, 7, 500, '2019-11-30', '5:30 PM', '2019-11-10 18:41:34', 1, 0, '2019-11-10 18:48:30', 'cash'),
(6, 'Physician', 11, 2, 2000, '2020-07-14', '10:15 AM', '2020-07-05 02:12:37', 0, 1, '2024-11-02 03:05:18', 'cash'),
(7, 'General Physician', 3, 2, 1200, '2020-07-05', '10:15 AM', '2020-07-05 02:14:49', 0, 1, '2024-11-03 04:04:54', 'cash'),
(8, 'Dentist', 0, 2, 0, '2024-10-25', '11:45 AM', '2024-10-23 03:37:33', 1, 0, '2024-11-02 05:31:52', 'cash'),
(9, 'Dentist', 1, 2, 500, '2024-10-23', '11:45 AM', '2024-10-23 03:40:47', 1, 2, '2024-11-02 06:04:10', 'cash'),
(10, 'Dentist', 1, 2, 500, '2024-11-26', '12:15 PM', '2024-11-03 04:03:54', 1, 2, '2024-11-03 04:04:21', 'cash'),
(11, 'Dentist', 1, 2, 50000, '2024-11-26', '6:00 PM', '2024-11-03 09:55:54', 1, 1, NULL, 'cash'),
(12, 'Dentist', 12, 2, 5000, '2024-11-07', '6:45 PM', '2024-11-03 10:38:05', 1, 1, NULL, 'cash'),
(13, 'Dentist', 12, 2, 5000, '2024-11-08', '1:00 AM', '2024-11-03 16:55:05', 1, 2, '2024-11-03 16:58:09', 'cash'),
(14, 'Dentist', 14, 2, 5000, '2024-11-13', '10:15 PM', '2024-11-05 14:02:55', 1, 2, '2024-11-05 14:03:23', 'cash'),
(15, 'Dentist', 14, 2, 5000, '2024-11-27', '10:15 PM', '2024-11-05 14:04:42', 0, 1, '2024-11-05 14:05:08', 'cash'),
(16, 'Dentist', 14, 2, 5000, '2024-11-25', '10:15 PM', '2024-11-05 14:06:51', 1, 2, '2024-11-05 14:55:19', 'cash'),
(17, 'Dentist', 14, 2, 5000, '2024-11-18', '10:15 PM', '2024-11-05 14:07:04', 1, 0, '2024-11-05 14:08:17', 'cash'),
(18, 'Dentist', 14, 2, 5000, '2024-11-18', '10:15 PM', '2024-11-05 14:07:25', 1, 2, '2024-11-05 14:40:24', 'cash'),
(19, 'Dentist', 14, 2, 5000, '2024-11-27', '3:00 AM', '2024-11-05 18:49:13', 1, 1, NULL, 'cash'),
(20, 'Dentist', 14, 2, 5000, '2024-11-11', '10:00 PM', '2024-11-05 18:53:47', 1, 1, NULL, 'cash'),
(21, 'Dentist', 14, 2, 5000, '2024-11-12', '3:00 AM', '2024-11-05 18:57:27', 1, 1, NULL, 'cash'),
(22, 'Dentist', 14, 2, 5000, '2024-11-21', '3:00 AM', '2024-11-05 18:58:32', 1, 1, NULL, 'cash'),
(23, 'Dentist', 14, 2, 5000, '2024-11-19', '3:15 AM', '2024-11-05 19:08:37', 1, 1, NULL, 'cash'),
(24, 'Dentist', 14, 2, 5000, '2024-11-30', '3:30 AM', '2024-11-05 19:17:09', 1, 1, NULL, 'cash'),
(25, 'Dentist', 14, 2, 5000, '2024-11-29', '3:30 AM', '2024-11-05 19:19:33', 1, 1, NULL, 'cash'),
(26, 'Dentist', 14, 2, 5000, '2024-10-08', '3:30 AM', '2024-11-05 19:19:49', 1, 1, NULL, 'cash'),
(27, 'Dentist', 14, 2, 5000, '2024-12-12', '3:30 AM', '2024-11-05 19:21:11', 1, 1, NULL, 'cash'),
(28, 'General Dentist', 15, 39, 700, '2024-12-18', '2:00 PM', '2024-11-06 16:29:06', 1, 2, '2024-11-07 02:15:43', 'cash'),
(29, 'Orthodontist', 16, 39, 1000, '2024-12-27', '2:00 PM', '2024-11-06 17:04:40', 1, 0, '2025-03-04 05:42:58', 'cash'),
(30, 'Oral and Maxillofacial Surgeon', 18, 39, 2000, '2024-12-19', '10:15 AM', '2024-11-07 02:05:14', 1, 0, '2025-03-03 17:57:42', 'cash'),
(31, 'General Dentist', 15, 40, 700, '2024-12-27', '10:30 AM', '2024-11-07 02:30:03', 1, 2, '2024-11-07 02:41:32', 'cash'),
(32, 'Cosmetic Dentist', 0, 40, 700, '2024-11-29', '11:15 AM', '2024-11-07 03:04:54', 1, 1, NULL, 'cash'),
(33, 'Orthodontist', 16, 40, 1000, '2024-12-30', '11:15 AM', '2024-11-07 03:06:05', 1, 0, '2025-03-03 18:55:41', 'cash'),
(34, 'General Dentist', 15, 40, 700, '2025-12-24', '1:15 PM', '2024-11-07 05:16:08', 1, 2, '2024-11-07 06:19:49', 'cash'),
(35, 'Orthodontist', 16, 40, 1000, '2024-11-13', '2:30 PM', '2024-11-07 06:19:04', 0, 1, '2024-11-07 06:32:03', 'cash'),
(36, 'General Dentist', 31, 2, 500, '2025-03-17', '10:00 AM', '2025-03-01 12:51:35', 0, 1, '2025-03-02 06:57:31', 'cash'),
(37, 'General Dentist', 15, 2, 700, '2025-03-27', '10:30 AM', '2025-03-01 14:24:17', 0, 1, '2025-03-02 08:04:02', 'cash'),
(38, 'General Dentist', 15, 2, 700, '2025-03-13', '10:30 AM', '2025-03-01 14:28:44', 1, 1, NULL, 'cash'),
(39, 'General Dentist', 15, 2, 700, '2025-03-31', '11:00 PM', '2025-03-01 15:54:00', 1, 1, NULL, 'cash'),
(40, 'General Dentist', 31, 2, 500, '2025-03-29', '1:15 PM', '2025-03-01 16:02:14', 1, 1, NULL, 'cash'),
(41, 'General Dentist', 15, 2, 700, '2025-03-31', '13:15', '2025-03-02 05:05:15', 1, 1, NULL, 'Online'),
(42, 'Orthodontist', 16, 2, 1000, '2025-03-25', '1:15', '2025-03-02 05:06:58', 1, 1, NULL, 'Online'),
(43, 'Orthodontist', 16, 2, 1000, '2025-02-11', '22:15', '2025-03-02 05:07:52', 1, 1, NULL, 'Online'),
(44, 'Orthodontist', 16, 2, 1000, '2025-02-11', '22:15', '2025-03-02 05:10:00', 1, 1, NULL, 'Online'),
(45, 'Orthodontist', 16, 57, 1000, '2025-03-31', '11:30 AM', '2025-03-02 13:27:33', 0, 1, '2025-03-02 13:27:48', 'Online'),
(46, 'General Dentist', 31, 57, 500, '2025-03-30', '2:30 PM', '2025-03-03 10:28:18', 1, 0, '2025-03-03 17:48:45', 'Online'),
(47, 'Oral and Maxillofacial Surgeon', 18, 57, 2000, '2025-03-31', '12:45 PM', '2025-03-04 04:36:35', 0, 1, '2025-03-04 04:36:49', 'Online'),
(48, 'General Dentist', 15, 57, 700, '2025-04-16', '2:00 PM', '2025-03-04 05:48:30', 1, 0, '2025-03-04 05:50:02', 'Cash'),
(49, 'General Dentist', 15, 57, 700, '2025-03-25', '2:00 PM', '2025-03-04 05:49:12', 1, 0, '2025-03-04 05:51:43', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` varchar(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `role` enum('doctor') NOT NULL DEFAULT 'doctor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`, `role`) VALUES
(15, 'General Dentist', 'Maria Teresa Cruz', '1234 Mabini Street, Ermita, Manila, Philippines', '700', '09177654321', 'dr.mariateresa.cruz@gmail.com', '32250170a0dca92d53ec9624f336ca24', '2024-11-06 15:42:54', '0000-00-00 00:00:00', 'doctor'),
(16, 'Orthodontist', 'Jose Luis Reyes', '4567 Quezon Avenue, Quezon City, Metro Manila, Philippines', '1000', '09917765432', 'dr.joseluis.reyes@yahoo.com', '03f132ccd6d4bc260f4aa688513252b3', '2024-11-06 15:47:54', '2024-11-07 02:44:37', 'doctor'),
(18, 'Oral and Maxillofacial Surgeon', 'Ana Isabel Santos', '7890 Ayala Street, Bauang, Batangas, Philippines', '2000', '09922234562', 'dr.anaisabel.santos@gmail.com', '2a47e313cd065767d65d5d6a1cd4a9a3', '2024-11-06 16:07:47', '2024-11-07 02:52:01', 'doctor'),
(28, 'Pedodontist', 'Rafael Hernandez', '321 Bonifacio Street, Tanauan City, Batangas, Philippines', '1500', '09188765432', 'dr.rafael.hernandez@gmail.com', '087804e66db7b2757136a748e9cb9b9d', '2024-11-06 16:19:29', NULL, 'doctor'),
(29, 'Prosthodontist', 'Clara Valdez', 'Bagoon Pook, Lipa City, Batangas, Philippines', '3000', '09056789012', 'dr.clara.valdez@gmail.com', 'fb46b0346888fd48e77b6db4690f6c24', '2024-11-06 16:25:00', NULL, 'doctor'),
(31, 'General Dentist', 'Rey Willard R, Malicse', 'Sico', '500', '09777726493', 'reywillardd01@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2025-01-10 23:36:40', '2025-03-03 10:47:05', 'doctor'),
(32, 'General Dentist', 'Ivan Alcantara', 'Tambo', '500', '09911776722', 'alcantaraivan2003@gmail.com', '070bc025fd79b9d322bec8a99e08cd94', '2025-03-04 05:14:54', NULL, 'doctor'),
(33, 'General Dentist', 'Ivan Alcantaraa', 'Sico', '1000', '09123123112', 'reywillardd01@gmail.com', '$2y$10$X180hrt4IK4Q.uI1yyqOU.FBj27C0ylDEIrgQPcMjhh7cyJCSUEUC', '2025-03-04 05:18:15', NULL, 'doctor'),
(34, 'General Dentist', 'Drexel Cueto', 'OXdQbDlMaWFmcnROcHFVcExHUmlLZz09', '1200', '09123812312', 'reywillardd01@gmail.com', '$2y$10$3/PUbffvK9QhMQciDmf.uu8kxz4aa8fu2l1h5Kpc.zv/sjPVKYbXm', '2025-03-04 05:33:18', NULL, 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(385, 31, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-03 18:57:04', NULL, 1),
(386, 31, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-03 19:44:58', NULL, 1),
(387, NULL, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 14:24:07', NULL, 0),
(388, 31, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 14:24:19', NULL, 1),
(389, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 16:34:22', '05-03-2025 12:36:00 AM', 1),
(390, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:49:48', NULL, 1),
(391, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:52:43', NULL, 1),
(392, 31, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 18:53:05', NULL, 1),
(393, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:54:27', NULL, 0),
(394, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:55:31', NULL, 0),
(395, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:55:48', NULL, 0),
(396, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:56:01', NULL, 0),
(397, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:56:14', NULL, 0),
(398, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:56:37', NULL, 0),
(399, NULL, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:05:36', NULL, 0),
(400, NULL, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:05:56', NULL, 0),
(401, NULL, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:06:04', NULL, 0),
(402, NULL, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:06:16', NULL, 0),
(403, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:27:46', NULL, 1),
(404, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:35:52', '05-03-2025 09:37:18 AM', 1),
(405, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 02:45:45', '05-03-2025 10:46:56 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(23, 'General Dentist', '2024-11-06 01:56:23', NULL),
(24, 'Orthodontist', '2024-11-06 01:56:40', NULL),
(25, 'Oral and Maxillofacial Surgeon', '2024-11-06 01:56:58', NULL),
(26, 'Pedodontist', '2024-11-06 01:57:09', NULL),
(28, 'Prosthodontist', '2024-11-06 01:58:47', NULL),
(29, 'Cosmetic Dentist', '2024-11-06 01:58:56', '2024-11-06 02:14:40'),
(30, 'sample specialization', '2025-03-04 14:10:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `transaction_id`, `status`, `created_at`) VALUES
(1, 2, 700.00, '5NX71931RG2207137', 'COMPLETED', '2025-03-01 15:54:00'),
(2, 2, 1000.00, '1KF61916P4140014U', 'COMPLETED', '2025-03-01 16:10:44'),
(3, 2, 700.00, '15J75870WJ006821D', 'COMPLETED', '2025-03-02 05:01:02'),
(4, 2, 700.00, '5AU05927PV363225L', 'COMPLETED', '2025-03-02 05:05:15'),
(5, 2, 1000.00, '8FT837045G474835R', 'COMPLETED', '2025-03-02 05:06:58'),
(6, 2, 1000.00, '0V094881LY134721C', 'COMPLETED', '2025-03-02 05:07:52'),
(7, 2, 1000.00, '0V094881LY134721C', 'COMPLETED', '2025-03-02 05:10:00'),
(8, 57, 1000.00, '1FY92626HY5489713', 'COMPLETED', '2025-03-02 13:27:33'),
(9, 57, 500.00, '490886360V956280X', 'COMPLETED', '2025-03-03 10:28:18'),
(10, 57, 2000.00, '87V98075AX960642E', 'COMPLETED', '2025-03-04 04:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` varchar(11) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'test user', 'test@gmail.com', '25235235225', ' This is sample text for the test.', '2019-06-29 19:03:08', 'Test Admin Remark', '2019-06-30 12:55:23', 1),
(2, 'Lyndon Bermoy', 'serbermz2020@gmail.com', '11111111111', ' This is sample text for testing.  This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing.', '2019-06-30 13:06:50', 'Answered', '2020-07-05 02:13:25', 1),
(3, 'fdsfsdf', 'fsdfsd@ghashhgs.com', '3264826346', 'sample text   sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  ', '2019-11-10 18:53:48', 'vfdsfgfd', '2019-11-10 18:54:04', 1),
(4, 'demo', 'demo@gmail.com', '123456789', ' hi, this is a demo', '2020-07-05 01:57:20', 'answered', '2020-07-05 01:57:46', 1),
(5, 'fafadf', 'sample@gmail.com', '9777726493', 'adfafafa', '2024-11-06 12:25:03', 'readable', '2024-11-06 12:29:23', 1),
(6, 'Ra', 're@gmail.com', '23444234234', 'eraerewrerewre', '2024-11-06 14:57:34', 'Approved', '2024-11-06 15:00:50', 1),
(7, 'rerer', 'rere@gmail.com', '12312321321', 'dfdfdsf', '2024-11-06 15:02:20', 'accepted', '2024-11-06 15:04:20', 1),
(8, 'Rey Willard R Malicse', 'reywillardd01@gmail.com', '00900809808', 'Finals Na iyaq', '2024-11-07 02:53:16', '123', '2025-03-03 18:00:39', 1),
(9, 'John doe', 'adf@gmail.com', '09898434343', 'HI PO PLS', '2024-11-07 02:54:39', NULL, NULL, NULL),
(10, 'Christian Bale', 'christian@gmail.com', '00940343493', 'sample\r\n', '2024-11-07 02:57:55', NULL, NULL, NULL),
(11, 'ivan alcantara', 'alcantaraivan2003@gmail.com', '09911776722', 'unread sample', '2024-11-07 05:34:23', 'hi\r\n', '2024-11-07 05:34:45', 1),
(12, 'Rey Willard', 'reywillardd01@gmail.com', '09809808089', 'Inquiry', '2024-11-07 06:27:42', 'read', '2024-11-07 06:28:18', 1),
(13, 'Rey Willard Malicse', 'jane@gmail.com', '0977772649', 'hi ', '2025-03-04 15:16:50', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `ChronicCond` varchar(255) DEFAULT NULL,
  `PrevDen` varchar(255) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `ChronicCond`, `PrevDen`, `CreationDate`) VALUES
(2, 3, '120/185', '80/120', '85 Kg', '101 degree', '#Fever, #BP high\r\n1.Paracetamol\r\n2.jocib tab\r\n', 'adfs', 'adfadf', '2024-11-02 10:04:29'),
(17, 8, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 01:54:06'),
(18, 8, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 01:54:59'),
(19, 8, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 01:55:41'),
(20, 20, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 02:19:52'),
(21, 20, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 02:20:26'),
(22, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 05:17:08'),
(23, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 05:17:27'),
(24, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 05:17:58'),
(25, 20, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 05:21:51'),
(26, 20, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 05:26:20'),
(27, 20, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 05:28:11'),
(28, 20, 'mataaas', 'mataas', 'mataba', 'mainit', 'biogesic', 'wala', 'wala', '2024-11-07 05:29:02'),
(29, 21, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2024-11-07 06:31:08'),
(30, 21, '1020', '40', '50', '35', 'none', 'none ', 'none', '2024-11-07 06:31:08'),
(31, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2025-03-03 12:29:04'),
(32, 0, '1020', '40', '50', '35', 'none', 'none ', 'none', '2025-03-03 12:29:05'),
(33, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2025-03-03 12:33:25'),
(34, 0, '1020', '40', '50', '35', 'none', 'none ', 'none', '2025-03-03 12:33:26'),
(35, NULL, 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', '2025-03-03 12:43:19'),
(36, NULL, 'bFk0aTZWT3huQ3RqRUhOdlZUaW0wZz09', 'T2swUjROK2pyYmNROUZ5VnNHWFcxUT09', 'T2FYdC9JL1kvRDlVTlhqYTd4eEFyZz09', 'SXJMb3U3eGxoU2YyV09lUDY1VEpiUT09', 'ZUxZZ2dXTjNneS83cWhSbmtxVncvUT09', 'OUZTSjcrK05UeEhIMkxFczFPcm9KQT09', 'ZUxZZ2dXTjNneS83cWhSbmtxVncvUT09', '2025-03-03 12:43:19'),
(37, NULL, 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', 'Smgvd2JaK3IyMU9YZXY1NlNtVDhBdz09', '2025-03-03 13:27:31'),
(38, NULL, 'bFk0aTZWT3huQ3RqRUhOdlZUaW0wZz09', 'T2swUjROK2pyYmNROUZ5VnNHWFcxUT09', 'T2FYdC9JL1kvRDlVTlhqYTd4eEFyZz09', 'SXJMb3U3eGxoU2YyV09lUDY1VEpiUT09', 'ZUxZZ2dXTjNneS83cWhSbmtxVncvUT09', 'OUZTSjcrK05UeEhIMkxFczFPcm9KQT09', 'ZUxZZ2dXTjNneS83cWhSbmtxVncvUT09', '2025-03-03 13:27:32'),
(39, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2025-03-03 13:38:56'),
(40, 0, '1020', '40', '50', '35', 'none', 'none ', 'none', '2025-03-03 13:38:56'),
(41, 0, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2025-03-03 13:43:21'),
(42, 0, '1020', '40', '50', '35', 'none', 'none ', 'none', '2025-03-03 13:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(8, 12, 'sample', 909809384, 'malicsuave@gmail.com', 'Male', 'Sico', 0, 'afafafafafadfdfa', '2024-11-03 10:39:19', '2024-11-03 10:39:32'),
(9, 12, 'sample', 909809384, 'sample@gmail.com', 'male', 'sico', 12, 'adfafadfadfasd', '2024-11-03 16:59:00', NULL),
(10, 14, 'Patient 3', 909809384, 'reywillard01@gmail.com', 'Male', 'Sico', 22, 'Completed a surgery, have a diabetes', '2024-11-03 17:50:20', '2024-11-05 15:37:34'),
(16, 14, '1234', 123, '123@gmail.com', 'Male', '123', 123, '1234', '2024-11-05 15:31:02', '2024-11-05 15:39:27'),
(17, 14, '123', 123, '12345@gmail.com', 'male', '123', 123, '123', '2024-11-05 15:47:26', NULL),
(18, 14, '123', 123, '123@email.com', 'male', '123', 123, '123', '2024-11-05 16:16:52', NULL),
(19, 14, 'Patient 12', 1231231213, '1231321@gmail.coim', 'male', '123', 123, '123', '2024-11-05 16:47:28', NULL),
(20, 15, 'Junnie', 90909090, 'alcantaraivan2003@gmail.com', 'Male', 'Tambo', 12, 'Heart Break', '2024-11-07 02:17:31', '2024-11-07 02:17:41'),
(21, 15, 'ivan alcantara', 90909090, 'alcantaraivan2003@gmail.com', 'male', 'tambo', 20, 'none', '2024-11-07 06:17:55', NULL),
(22, 31, 'Junnie', 90909090, 'alcantaraivan2003@gmail.com', 'male', 'saan', 12, 'adfa', '2025-03-03 18:57:25', NULL),
(23, 31, 'sample', 909809384, 'malicsuave@gmail.com', 'male', 'sample', 0, 'af', '2025-03-04 14:29:48', NULL),
(24, 31, 'sample', 909809384, 'email@gmail.com', 'male', 'sample', 0, 'sample', '2025-03-04 14:31:26', NULL),
(25, 31, 'rey', 800000000, 'adsf@gmail.com', 'female', 'afd', 0, 'af', '2025-03-04 14:33:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(578, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-03 19:19:17', '04-03-2025 03:23:14 AM', 1),
(579, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 04:35:32', '04-03-2025 12:37:05 PM', 1),
(580, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 05:47:49', '04-03-2025 01:49:20 PM', 1),
(581, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 16:32:16', '', 0),
(582, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 16:32:36', '05-03-2025 12:33:33 AM', 1),
(583, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 16:44:40', '', 1),
(584, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:41:28', '', 1),
(585, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:45:04', '', 1),
(586, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:47:01', '', 1),
(587, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:48:44', '05-03-2025 02:49:18 AM', 1),
(588, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 18:49:20', '', 1),
(589, 0, 'reywillardd01@gmai.com', 0x3a3a3100000000000000000000000000, '2025-03-04 18:58:21', '', 0),
(590, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 18:58:33', '', 1),
(591, 0, 'reywillardd01@gmai.com', 0x3a3a3100000000000000000000000000, '2025-03-04 18:59:13', '', 0),
(592, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 18:59:22', '', 1),
(593, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:00:44', '', 1),
(594, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:05:19', '', 1),
(595, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-04 19:06:34', '', 1),
(596, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:09:25', '', 1),
(597, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:12:45', '', 1),
(598, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:12:51', '', 1),
(599, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:13:34', '', 1),
(600, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:13:39', '', 1),
(601, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:14:01', '', 1),
(602, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:14:05', '', 1),
(603, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-04 19:15:59', '', 1),
(604, 57, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-03-05 00:56:17', '', 1),
(605, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:07:41', '05-03-2025 09:22:02 AM', 1),
(606, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:26:00', '05-03-2025 09:27:29 AM', 1),
(607, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:34:15', '05-03-2025 09:34:54 AM', 1),
(608, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:52:20', '', 0),
(609, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:52:35', '', 1),
(610, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:56:22', '', 0),
(611, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 01:56:30', '05-03-2025 09:56:54 AM', 1),
(612, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 02:21:00', '', 1),
(613, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 02:39:33', '', 1),
(614, 57, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-03-05 02:43:50', '05-03-2025 10:44:35 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `role` enum('user') NOT NULL DEFAULT 'user',
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `province`, `gender`, `email`, `password`, `regDate`, `updationDate`, `role`, `profile_picture`) VALUES
(9, 'admin', 'admin', 'admin', NULL, 'male', 'admin@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-10-27 12:26:33', '2025-01-11 08:20:16', 'user', NULL),
(37, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuaveforex@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-05 19:55:19', '2025-01-11 08:20:16', 'user', NULL),
(39, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuave@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-05 19:57:42', '2025-01-11 08:20:16', 'user', 'uploads/Picture5.png'),
(40, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuave@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-05 19:57:43', '2025-01-11 08:20:16', 'user', 'uploads/Picture3.png'),
(42, 'Lebron James', 'Sico', 'Lipa', 'Batangas', 'male', 'adfadf@gmial.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-06 14:09:54', '2025-01-11 08:20:16', 'user', NULL),
(49, 'sample', 'sample', 'sample', 'sample', 'male', 'reywillard01@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-06 14:51:34', '2025-01-11 08:20:16', 'user', NULL),
(51, 'Marvin Anatacio', 'lipa', 'city', 'Batangas', 'male', 'testbeta613@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-07 06:14:26', '2025-01-11 08:20:16', 'user', NULL),
(53, 'Ivan Alcantara', 'Tambo', 'LIpa ', 'Batangas', 'male', 'alcantaraivan2003@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2025-01-11 00:25:51', '2025-01-11 08:51:16', 'user', NULL),
(57, 'Rey Willard Malicse', 'Z05EbDhzOWxNdFFYdGYrb1VKdkRRUT09', 'YXU2L2Q0KzJRanYrMER1dmNCd1I2QT09', 'YXU2L2Q0KzJRanYrMER1dmNCd1I2QT09', 'female', 'reywillardd01@gmail.com', '$2y$10$jIU.Np6jlqZi9Bl28lpvIO0JKa.9TEs/1IL9aOjlRNxniEAuOwWui', '2025-03-02 12:01:02', '2025-03-03 19:23:08', 'user', 'uploads/335449004_208366981777416_7083356570306965740_n.jpg'),
(58, 'Rey Willard', '8x/4iCVOsQyRmljLDlQp3w==', 'vAo6jdI0LW7cLrNsgmaTIg==', 'AGyj4VKmVo/jjqekqY0+Fw==', 'male', 'malicsuave@gmail.com', '$2y$10$agRnK1D3jGvLkjDau73yRuCuWXrXiJdUQ4qxVUIm6iKYPpUhPBQgC', '2025-03-02 12:05:25', NULL, 'user', NULL),
(59, 'Rey Willard Malicse', 'Zy+cqPWvTY2KS4sztOG+Mw==', 'yrARvfCvZkBtKHGB1yud3g==', 'Zy+cqPWvTY2KS4sztOG+Mw==', 'male', 'malisuave@gmail.com', '$2y$10$qSjzVD2dUy2hRCvZiTBQJ.x3xgZQ24sabGjmzXRrBJGDfwttMlGdW', '2025-03-04 15:35:47', NULL, 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
