-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 01:59 AM
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
(1, 'admin', 'pass123', '06-11-2024 12:25:13 PM', 'admin');

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
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(3, 'Demo test', 7, 6, 600, '2019-06-29', '9:15 AM', '2019-06-23 18:31:28', 1, 0, '0000-00-00 00:00:00'),
(4, 'Ayurveda', 5, 5, 8050, '2019-11-08', '1:00 PM', '2019-11-05 10:28:54', 1, 1, '0000-00-00 00:00:00'),
(5, 'Dermatologist', 9, 7, 500, '2019-11-30', '5:30 PM', '2019-11-10 18:41:34', 1, 0, '2019-11-10 18:48:30'),
(6, 'Physician', 11, 2, 2000, '2020-07-14', '10:15 AM', '2020-07-05 02:12:37', 0, 1, '2024-11-02 03:05:18'),
(7, 'General Physician', 3, 2, 1200, '2020-07-05', '10:15 AM', '2020-07-05 02:14:49', 0, 1, '2024-11-03 04:04:54'),
(8, 'Dentist', 0, 2, 0, '2024-10-25', '11:45 AM', '2024-10-23 03:37:33', 1, 0, '2024-11-02 05:31:52'),
(9, 'Dentist', 1, 2, 500, '2024-10-23', '11:45 AM', '2024-10-23 03:40:47', 1, 2, '2024-11-02 06:04:10'),
(10, 'Dentist', 1, 2, 500, '2024-11-26', '12:15 PM', '2024-11-03 04:03:54', 1, 2, '2024-11-03 04:04:21'),
(11, 'Dentist', 1, 2, 50000, '2024-11-26', '6:00 PM', '2024-11-03 09:55:54', 1, 1, NULL),
(12, 'Dentist', 12, 2, 5000, '2024-11-07', '6:45 PM', '2024-11-03 10:38:05', 1, 1, NULL),
(13, 'Dentist', 12, 2, 5000, '2024-11-08', '1:00 AM', '2024-11-03 16:55:05', 1, 2, '2024-11-03 16:58:09'),
(14, 'Dentist', 14, 2, 5000, '2024-11-13', '10:15 PM', '2024-11-05 14:02:55', 1, 2, '2024-11-05 14:03:23'),
(15, 'Dentist', 14, 2, 5000, '2024-11-27', '10:15 PM', '2024-11-05 14:04:42', 0, 1, '2024-11-05 14:05:08'),
(16, 'Dentist', 14, 2, 5000, '2024-11-25', '10:15 PM', '2024-11-05 14:06:51', 1, 2, '2024-11-05 14:55:19'),
(17, 'Dentist', 14, 2, 5000, '2024-11-18', '10:15 PM', '2024-11-05 14:07:04', 1, 0, '2024-11-05 14:08:17'),
(18, 'Dentist', 14, 2, 5000, '2024-11-18', '10:15 PM', '2024-11-05 14:07:25', 1, 2, '2024-11-05 14:40:24'),
(19, 'Dentist', 14, 2, 5000, '2024-11-27', '3:00 AM', '2024-11-05 18:49:13', 1, 1, NULL),
(20, 'Dentist', 14, 2, 5000, '2024-11-11', '10:00 PM', '2024-11-05 18:53:47', 1, 1, NULL),
(21, 'Dentist', 14, 2, 5000, '2024-11-12', '3:00 AM', '2024-11-05 18:57:27', 1, 1, NULL),
(22, 'Dentist', 14, 2, 5000, '2024-11-21', '3:00 AM', '2024-11-05 18:58:32', 1, 1, NULL),
(23, 'Dentist', 14, 2, 5000, '2024-11-19', '3:15 AM', '2024-11-05 19:08:37', 1, 1, NULL),
(24, 'Dentist', 14, 2, 5000, '2024-11-30', '3:30 AM', '2024-11-05 19:17:09', 1, 1, NULL),
(25, 'Dentist', 14, 2, 5000, '2024-11-29', '3:30 AM', '2024-11-05 19:19:33', 1, 1, NULL),
(26, 'Dentist', 14, 2, 5000, '2024-10-08', '3:30 AM', '2024-11-05 19:19:49', 1, 1, NULL),
(27, 'Dentist', 14, 2, 5000, '2024-12-12', '3:30 AM', '2024-11-05 19:21:11', 1, 1, NULL),
(28, 'General Dentist', 15, 39, 700, '2024-12-18', '2:00 PM', '2024-11-06 16:29:06', 1, 2, '2024-11-07 02:15:43'),
(29, 'Orthodontist', 16, 39, 1000, '2024-12-27', '2:00 PM', '2024-11-06 17:04:40', 1, 1, NULL),
(30, 'Oral and Maxillofacial Surgeon', 18, 39, 2000, '2024-12-19', '10:15 AM', '2024-11-07 02:05:14', 1, 1, NULL),
(31, 'General Dentist', 15, 40, 700, '2024-12-27', '10:30 AM', '2024-11-07 02:30:03', 1, 2, '2024-11-07 02:41:32'),
(32, 'Cosmetic Dentist', 0, 40, 700, '2024-11-29', '11:15 AM', '2024-11-07 03:04:54', 1, 1, NULL),
(33, 'Orthodontist', 16, 40, 1000, '2024-12-30', '11:15 AM', '2024-11-07 03:06:05', 1, 1, NULL),
(34, 'General Dentist', 15, 40, 700, '2025-12-24', '1:15 PM', '2024-11-07 05:16:08', 1, 2, '2024-11-07 06:19:49'),
(35, 'Orthodontist', 16, 40, 1000, '2024-11-13', '2:30 PM', '2024-11-07 06:19:04', 0, 1, '2024-11-07 06:32:03');

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
(31, 'General Dentist', 'Rey Willard R, Malicse', 'Sico', '500', '09777726493', 'reywillardd01@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2025-01-10 23:36:40', '0000-00-00 00:00:00', 'doctor');

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
(85, 12, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 10:36:55', '03-11-2024 06:37:34 PM', 1),
(86, 12, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 10:38:34', '03-11-2024 06:40:00 PM', 1),
(87, 12, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 16:41:51', '04-11-2024 12:44:01 AM', 1),
(88, 12, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 16:55:35', '04-11-2024 12:56:43 AM', 1),
(89, 12, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 16:58:02', '04-11-2024 12:59:24 AM', 1),
(90, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:48:40', '04-11-2024 01:48:51 AM', 1),
(91, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:49:27', NULL, 1),
(92, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:46:58', NULL, 0),
(93, NULL, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:47:07', NULL, 0),
(94, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:47:17', NULL, 0),
(95, NULL, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:47:24', NULL, 0),
(96, NULL, 'maliscuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:48:00', NULL, 0),
(97, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:48:08', NULL, 0),
(98, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:48:35', '05-11-2024 08:49:30 PM', 1),
(99, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:26:12', NULL, 1),
(100, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:26:18', NULL, 1),
(101, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:27:45', NULL, 1),
(102, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:29:35', '05-11-2024 09:30:02 PM', 1),
(103, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:30:35', '05-11-2024 09:31:01 PM', 1),
(104, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:03:15', '05-11-2024 10:03:27 PM', 1),
(105, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:05:27', '05-11-2024 10:05:39 PM', 1),
(106, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:08:12', '05-11-2024 10:08:20 PM', 1),
(107, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:40:15', '05-11-2024 10:40:26 PM', 1),
(108, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:47:59', NULL, 1),
(109, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 15:48:04', '06-11-2024 01:25:55 AM', 1),
(110, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 17:29:27', NULL, 1),
(111, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 06:55:26', NULL, 0),
(112, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 06:55:32', NULL, 1),
(113, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 07:07:37', NULL, 0),
(114, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 07:07:41', NULL, 0),
(115, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 07:07:51', NULL, 1),
(116, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 11:42:13', NULL, 0),
(117, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 11:42:18', '06-11-2024 07:49:59 PM', 1),
(118, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:46:51', NULL, 0),
(119, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:46:58', NULL, 0),
(120, NULL, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:47:06', NULL, 0),
(121, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:48:27', '07-11-2024 02:49:34 AM', 1),
(122, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:26:54', NULL, 0),
(123, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:27:01', NULL, 0),
(124, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:27:08', NULL, 0),
(125, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:27:19', NULL, 0),
(126, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:27:26', NULL, 0),
(127, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:27:37', '07-11-2024 09:28:12 AM', 1),
(128, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:15:33', '07-11-2024 10:29:40 AM', 1),
(129, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:30:56', '07-11-2024 10:43:11 AM', 1),
(130, NULL, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:12:37', NULL, 0),
(131, NULL, 'dr.francisco.morales@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:12:57', NULL, 0),
(132, NULL, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:13:25', NULL, 0),
(133, NULL, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:13:36', NULL, 0),
(134, NULL, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:13:49', NULL, 0),
(135, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:13:54', '07-11-2024 01:14:43 PM', 1),
(136, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:16:23', '07-11-2024 01:18:34 PM', 1),
(137, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:21:34', '07-11-2024 01:29:18 PM', 1),
(138, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:17:24', NULL, 1),
(139, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:19:43', NULL, 1),
(140, 15, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:28:53', '07-11-2024 02:31:34 PM', 1),
(141, NULL, 'doctor@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-10 23:33:29', NULL, 0),
(142, 31, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-10 23:39:38', NULL, 1),
(143, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 02:27:46', NULL, 0),
(144, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 02:27:55', NULL, 0),
(145, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 02:28:09', NULL, 0),
(146, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 02:28:41', NULL, 0),
(147, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 02:29:28', NULL, 1),
(148, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 02:40:07', NULL, 0),
(149, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 02:45:46', NULL, 0),
(150, 31, 'reywillardd01@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-11 04:29:29', NULL, 1),
(151, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 04:30:30', NULL, 1),
(152, NULL, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 06:01:50', NULL, 0),
(153, NULL, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 06:01:50', NULL, 0),
(154, NULL, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 06:01:50', NULL, 0),
(155, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 06:01:58', NULL, 0),
(156, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 06:02:06', NULL, 0),
(157, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 06:02:06', NULL, 0),
(158, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 06:02:06', NULL, 0),
(159, NULL, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:34', NULL, 0),
(160, NULL, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:34', NULL, 0),
(161, NULL, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:35', NULL, 0),
(162, NULL, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:49', NULL, 0),
(163, NULL, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:49', NULL, 0),
(164, NULL, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:49', NULL, 0),
(165, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:59', NULL, 1),
(166, NULL, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:29:02', NULL, 0),
(167, NULL, 'reywillardd01@gmail.com\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:29:02', NULL, 0),
(168, NULL, ';', 0x3132372e302e302e3100000000000000, '2025-01-11 07:29:03', NULL, 0),
(169, NULL, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:29:41', NULL, 0),
(170, NULL, 'reywillardd01@gmail.com\" and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:30:13', NULL, 0),
(171, NULL, 'reywillardd01@gmail.com\" and 0 in (select sleep(1) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:30:59', NULL, 0),
(172, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:22', NULL, 0),
(173, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:40', NULL, 0),
(174, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:32:31', NULL, 0),
(175, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:32:33', NULL, 0),
(176, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:33:30', NULL, 0),
(177, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:35:45', NULL, 0),
(178, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:35:45', NULL, 0),
(179, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:35:45', NULL, 0),
(180, NULL, 'cat /etc/passwd', 0x3132372e302e302e3100000000000000, '2025-01-11 07:35:55', NULL, 0),
(181, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', NULL, 1),
(182, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', NULL, 1),
(183, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', NULL, 1),
(184, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', NULL, 1),
(185, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', NULL, 1),
(186, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', NULL, 1),
(187, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:06', NULL, 1),
(188, NULL, 'sdheVIlrPAByblOWSiKRKMaVFxGWCutYTVACJvSYRRjtgUNPKOCkAUwUMiJIKOAYJenVqMoKVnomMrFAMTkIflcdPInSATPktZISMvZEAjbmITOytjbMUrMkrKsSLwSuHfdkMYPPUxlpvTAAgZvCpHgmXuhdLSCUERAWGlIvBLmrjcjtdjWZtlLqnFCrZoZEWGUIluIQeRjwZtWrHknTawDFmMBfAUkUhSpVyXVUdeZjOQJfuaoaQLhfPxgNuDQ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:17', NULL, 0),
(189, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:18', NULL, 0),
(190, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:45:14', NULL, 0),
(191, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:45:20', NULL, 1),
(192, NULL, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:45', NULL, 0),
(193, NULL, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:45', NULL, 0),
(194, NULL, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:45', NULL, 0),
(195, NULL, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:10', NULL, 0),
(196, NULL, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:10', NULL, 0),
(197, NULL, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:10', NULL, 0),
(198, NULL, 'zApPX72sS', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:23', NULL, 0),
(199, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:23', NULL, 0),
(200, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:23', NULL, 0),
(201, NULL, ';', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:33', NULL, 0),
(202, NULL, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:53', NULL, 0),
(203, NULL, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:53', NULL, 0),
(204, NULL, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:48:08', NULL, 0),
(205, NULL, '\"java.lang.Thread.sleep\"(15000)', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:28', NULL, 0),
(206, NULL, 'reywillardd01@gmail.com / \"java.lang.Thread.sleep\"(15000) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:28', NULL, 0),
(207, NULL, 'reywillardd01@gmail.com\" / \"java.lang.Thread.sleep\"(15000) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:28', NULL, 0),
(208, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:38', NULL, 0),
(209, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:51:14', NULL, 0),
(210, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:51:33', NULL, 0),
(211, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:55:32', NULL, 0),
(212, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:39', NULL, 0),
(213, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:39', NULL, 0),
(214, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:39', NULL, 0),
(215, NULL, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:52', NULL, 0),
(216, NULL, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:53', NULL, 0),
(217, NULL, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:53', NULL, 0),
(218, NULL, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:11', NULL, 0),
(219, NULL, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:11', NULL, 0),
(220, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:11', NULL, 0),
(221, NULL, '<#assign ex=\"freemarker.template.utility.Execute\"?new()> ${ ex(\"sleep 15\") }', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:24', NULL, 0),
(222, NULL, '#set($engine=\"\")\n#set($proc=$engine.getClass().forName(\"java.lang.Runtime\").getRuntime().exec(\"sleep 15\"))\n#set($null=$proc.waitFor())\n${null}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:24', NULL, 0),
(223, NULL, '{{\"\".__class__.__mro__[1].__subclasses__()[157].__repr__.__globals__.get(\"__builtins__\").get(\"__import__\")(\"subprocess\").check_output(\"sleep 15\")}}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:24', NULL, 0),
(224, NULL, 'SRCHfWuAZxehSskyJACHZoqLJHtMeWnjYBidqGwrnuJkFSdRiMEIbHMNjlXIqAaVuQiGscvEjsLdNpMEdGrOiXsNUDmsejRiJDcZUGEQrNeNmhdRqChfQMuMMVZvqMSZobFhbJwnWRNwPMhEDwqrMFPbNihJbvmIyeoQhOwcAuKmnLnQIAyXAwFvwwNMQyywMmpSMJnEFqrJUepKqiQOTsByudNcVCGEcQgqgfdnLokPjTiOqjiViLMqMhPCFXO', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:36', NULL, 0),
(225, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', NULL, 0),
(226, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', NULL, 0),
(227, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:47', NULL, 0),
(228, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:01:02', NULL, 0),
(229, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:01:02', NULL, 0),
(230, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:01:02', NULL, 0),
(231, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:17:14', '11-01-2025 04:17:47 PM', 1),
(232, NULL, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:25', NULL, 0),
(233, NULL, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:25', NULL, 0),
(234, NULL, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:25', NULL, 0),
(235, NULL, 'http://www.google.com/', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:35', NULL, 0),
(236, NULL, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:51', NULL, 0),
(237, NULL, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:51', NULL, 0),
(238, NULL, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:51', NULL, 0),
(239, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:02', NULL, 0),
(240, NULL, '0W45pz4p', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:12', NULL, 0),
(241, NULL, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:15', NULL, 0),
(242, NULL, 'reywillardd01@gmail.com\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:15', NULL, 0),
(243, NULL, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:40', NULL, 0),
(244, NULL, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:40', NULL, 0),
(245, NULL, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:55', NULL, 0),
(246, NULL, '\"java.lang.Thread.sleep\"(15000)', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:01', NULL, 0),
(247, NULL, 'reywillardd01@gmail.com / \"java.lang.Thread.sleep\"(15000) ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:01', NULL, 0),
(248, NULL, 'reywillardd01@gmail.com\" / \"java.lang.Thread.sleep\"(15000) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:01', NULL, 0),
(249, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:11', NULL, 0),
(250, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:58', NULL, 0),
(251, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:29:00', NULL, 0),
(252, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:39:36', NULL, 0),
(253, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:19', NULL, 0),
(254, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:19', NULL, 0),
(255, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:19', NULL, 0),
(256, NULL, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:37', NULL, 0),
(257, NULL, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:38', NULL, 0),
(258, NULL, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:38', NULL, 0),
(259, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:48', NULL, 0),
(260, NULL, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:04', NULL, 0),
(261, NULL, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:04', NULL, 0),
(262, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:05', NULL, 0),
(263, NULL, 'zj 5570*7186 zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:32', NULL, 0),
(264, NULL, 'zj{6654*4947}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:33', NULL, 0),
(265, NULL, 'zj${9242*4926}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:33', NULL, 0),
(266, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:45', NULL, 0),
(267, NULL, 'AJYTAEiUOBDnrCNJBwMVCOBlZvhhMGOoUSESiAeTlNSLkumJEuqcHHHOZAhwFewNhYQOdwdSGDYcCymYedPnCPaysTlfWESjkIeUKkHJUUrjryNAtbEEWZvYtYAiiCnFkGLVkhnRagxlbZRCSTbfGaiAybBnIBHcHlQmyViSLuHiUFnhdnuaIVZuFCpOAjWlTvgKODFEtfOMDiQvbpfrFuvEVFqOJMEZwAgLQZgpyDMcCiEOkPZovMTNUWbjxSO', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', NULL, 0),
(268, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', NULL, 0),
(269, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', NULL, 0),
(270, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:04', NULL, 0),
(271, NULL, '<', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', NULL, 0),
(272, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', NULL, 0),
(273, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', NULL, 0),
(274, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:41:35', NULL, 1),
(275, NULL, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:43:08', NULL, 0),
(276, NULL, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:43:08', NULL, 0),
(277, NULL, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:43:09', NULL, 0),
(278, NULL, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:21', NULL, 0),
(279, NULL, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:21', NULL, 0),
(280, NULL, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:22', NULL, 0),
(281, NULL, '543940209345055925.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:40', NULL, 0),
(282, NULL, 'http://543940209345055925.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:41', NULL, 0),
(283, NULL, 'https://543940209345055925.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:41', NULL, 0),
(284, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(285, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(286, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(287, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(288, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(289, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(290, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(291, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(292, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:51', NULL, 1),
(293, NULL, 'zApPX34sS', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', NULL, 0),
(294, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', NULL, 0),
(295, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', NULL, 1),
(296, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', NULL, 1),
(297, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:59', NULL, 1),
(298, NULL, '0W45pz4p', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:05', NULL, 0),
(299, NULL, '</td><script>alert(1);</script><td>', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:06', NULL, 0),
(300, NULL, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:09', NULL, 0),
(301, NULL, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:25', NULL, 0),
(302, NULL, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:40', NULL, 0),
(303, NULL, 'reywillardd01@gmail.com\" / sleep(15) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:55', NULL, 0),
(304, NULL, '\"java.lang.Thread.sleep\"(15000)', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:14', NULL, 0),
(305, NULL, 'reywillardd01@gmail.com / \"java.lang.Thread.sleep\"(15000) ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:14', NULL, 0),
(306, NULL, 'reywillardd01@gmail.com\" / \"java.lang.Thread.sleep\"(15000) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:15', NULL, 0),
(307, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:27', NULL, 1),
(308, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:27', NULL, 1),
(309, NULL, 'case randomblob(100000) when not null then 1 else 1 end ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:27', NULL, 0),
(310, NULL, 'engcyql539dukf03dufr9ldvfgr68jdkc2rh8jjy91tmf1rpzqj156lx', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:27', NULL, 0),
(311, NULL, 'case randomblob(1000000) when not null then 1 else 1 end ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:27', NULL, 0),
(312, NULL, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:07', NULL, 0),
(313, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:38', NULL, 0),
(314, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:38', NULL, 0),
(315, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:38', NULL, 0),
(316, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:02', NULL, 1),
(317, NULL, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:13', NULL, 0),
(318, NULL, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:15', NULL, 0),
(319, NULL, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:15', NULL, 0),
(320, NULL, 'reywillardd01@gmail.com&sleep 15.0&', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:25', NULL, 0),
(321, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(322, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(323, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(324, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(325, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(326, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(327, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(328, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(329, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(330, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(331, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(332, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(333, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:35', NULL, 1),
(334, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(335, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(336, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(337, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(338, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(339, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(340, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(341, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(342, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(343, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(344, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(345, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:36', NULL, 1),
(346, NULL, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:41', NULL, 0),
(347, NULL, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:42', NULL, 0),
(348, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:42', NULL, 0),
(349, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(350, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(351, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(352, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(353, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(354, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(355, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', NULL, 1),
(356, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(357, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(358, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(359, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(360, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(361, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(362, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(363, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(364, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(365, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(366, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(367, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(368, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(369, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(370, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:53', NULL, 1),
(371, NULL, '<#assign ex=\"freemarker.template.utility.Execute\"?new()> ${ ex(\"sleep 15\") }', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:57', NULL, 0),
(372, NULL, '#set($engine=\"\")\n#set($proc=$engine.getClass().forName(\"java.lang.Runtime\").getRuntime().exec(\"sleep 15\"))\n#set($null=$proc.waitFor())\n${null}', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:57', NULL, 0),
(373, NULL, '{{\"\".__class__.__mro__[1].__subclasses__()[157].__repr__.__globals__.get(\"__builtins__\").get(\"__import__\")(\"subprocess\").check_output(\"sleep 15\")}}', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:57', NULL, 0),
(374, NULL, 'gsjOyrGnQgShWUgtYPPFqdYLUHGUvwfdIKdeHcfQYphEiMLMQSGanifsoTgcWCLPuVfALmkjgqIyKBpaNVVpJxpOGXWFVfvCVgyTCaUjyerinhJWGskovMcksqZcthtewyBEIKdxbldgunDevlTLBJffDoPvlbQevPZLgkiaXFAuaEPdXQnXGpkFTJofWbvlJOirmshEBTKOPbsDAQoDPVtcIPZDaQidNYvEANhUoqDwdBajRBTaDkTSRMcxvVC', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', NULL, 0),
(375, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', NULL, 0),
(376, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', NULL, 1),
(377, 31, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', NULL, 1),
(378, NULL, 'ZAP', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:14', NULL, 0),
(379, NULL, 'ZAP%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s\n', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:14', NULL, 0),
(380, NULL, 'ZAP %1!s%2!s%3!s%4!s%5!s%6!s%7!s%8!s%9!s%10!s%11!s%12!s%13!s%14!s%15!s%16!s%17!s%18!s%19!s%20!s%21!n%22!n%23!n%24!n%25!n%26!n%27!n%28!n%29!n%30!n%31!n%32!n%33!n%34!n%35!n%36!n%37!n%38!n%39!n%40!n\n', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:15', NULL, 0),
(381, NULL, '<', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:36', NULL, 0),
(382, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:37', NULL, 0),
(383, NULL, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:37', NULL, 0);

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
(29, 'Cosmetic Dentist', '2024-11-06 01:58:56', '2024-11-06 02:14:40');

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
(8, 'Rey Willard R Malicse', 'reywillardd01@gmail.com', '00900809808', 'Finals Na iyaq', '2024-11-07 02:53:16', NULL, NULL, NULL),
(9, 'John doe', 'adf@gmail.com', '09898434343', 'HI PO PLS', '2024-11-07 02:54:39', NULL, NULL, NULL),
(10, 'Christian Bale', 'christian@gmail.com', '00940343493', 'sample\r\n', '2024-11-07 02:57:55', NULL, NULL, NULL),
(11, 'ivan alcantara', 'alcantaraivan2003@gmail.com', '09911776722', 'unread sample', '2024-11-07 05:34:23', 'hi\r\n', '2024-11-07 05:34:45', 1),
(12, 'Rey Willard', 'reywillardd01@gmail.com', '09809808089', 'Inquiry', '2024-11-07 06:27:42', 'read', '2024-11-07 06:28:18', 1);

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
(30, 21, '1020', '40', '50', '35', 'none', 'none ', 'none', '2024-11-07 06:31:08');

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
(21, 15, 'ivan alcantara', 90909090, 'alcantaraivan2003@gmail.com', 'male', 'tambo', 20, 'none', '2024-11-07 06:17:55', NULL);

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
(131, 0, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:36:26', '', 0),
(132, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:36:47', '', 0),
(133, 32, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:41:26', '04-11-2024 01:41:47 AM', 1),
(134, 35, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:44:40', '04-11-2024 01:45:09 AM', 1),
(135, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:56:36', '05-11-2024 08:56:50 PM', 1),
(136, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:06:23', '', 0),
(137, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:06:28', '', 1),
(138, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:12:08', '', 1),
(139, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:26:46', '05-11-2024 09:26:49 PM', 1),
(140, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:58:44', '', 0),
(141, 0, 'rey@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:58:57', '', 0),
(142, 0, 'rey@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:59:07', '', 0),
(143, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:59:15', '05-11-2024 10:03:05 PM', 1),
(144, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:03:41', '05-11-2024 10:05:12 PM', 1),
(145, 0, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:02', '', 0),
(146, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:14', '', 0),
(147, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:20', '', 0),
(148, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:32', '', 0),
(149, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:41', '05-11-2024 10:07:46 PM', 1),
(150, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:08:32', '05-11-2024 10:40:06 PM', 1),
(151, 0, 'rey@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:40:33', '', 0),
(152, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:40:39', '05-11-2024 10:47:43 PM', 1),
(153, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 18:47:02', '06-11-2024 03:54:58 AM', 1),
(154, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 19:59:55', '', 1),
(155, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:24:41', '', 0),
(156, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:24:48', '', 0),
(157, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:24:55', '', 0),
(158, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:25:33', '06-11-2024 04:25:59 AM', 1),
(159, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:26:07', '', 1),
(160, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:32:47', '06-11-2024 04:35:25 AM', 1),
(161, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 05:26:41', '06-11-2024 01:35:58 PM', 1),
(162, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 05:36:49', '06-11-2024 01:36:51 PM', 1),
(163, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 05:37:13', '06-11-2024 01:37:16 PM', 1),
(164, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 05:37:29', '06-11-2024 03:06:18 PM', 1),
(165, 0, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:06:53', '', 0),
(166, 0, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:07:14', '', 0),
(167, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:09:27', '', 0),
(168, 0, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:21:07', '', 0),
(169, 41, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:21:27', '06-11-2024 10:21:33 PM', 1),
(170, 41, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:22:28', '06-11-2024 10:22:31 PM', 1),
(171, 47, 'alcantaraivan2003@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:34:43', '', 1),
(172, 47, 'alcantaraivan2003@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:37:34', '06-11-2024 10:38:04 PM', 1),
(173, 47, 'alcantaraivan2003@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:38:31', '06-11-2024 10:38:35 PM', 1),
(174, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:39:52', '', 0),
(175, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:44:27', '', 0),
(176, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:45:01', '', 0),
(177, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:45:39', '', 0),
(178, 47, 'alcantaraivan2003@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:46:22', '06-11-2024 10:46:39 PM', 1),
(179, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:47:12', '', 0),
(180, 0, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:48:12', '', 0),
(181, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:49:05', '', 0),
(182, 0, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:50:46', '', 0),
(183, 49, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 14:52:00', '06-11-2024 10:52:05 PM', 1),
(184, 0, 'admin', 0x3a3a3100000000000000000000000000, '2024-11-06 14:52:15', '', 0),
(185, 0, 'admin', 0x3a3a3100000000000000000000000000, '2024-11-06 14:52:24', '', 0),
(186, 0, 'admin', 0x3a3a3100000000000000000000000000, '2024-11-06 14:52:30', '', 0),
(187, 0, 'admin', 0x3a3a3100000000000000000000000000, '2024-11-06 14:52:35', '', 0),
(188, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 15:04:49', '', 0),
(189, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 15:05:37', '06-11-2024 11:16:29 PM', 1),
(190, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 15:26:27', '06-11-2024 11:26:35 PM', 1),
(191, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 16:27:01', '', 1),
(192, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:38:22', '07-11-2024 02:40:37 AM', 1),
(193, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:38:32', '', 0),
(194, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:40:47', '07-11-2024 02:43:40 AM', 1),
(195, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:43:45', '07-11-2024 02:44:34 AM', 1),
(196, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:44:40', '07-11-2024 02:45:05 AM', 1),
(197, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:45:11', '07-11-2024 02:46:36 AM', 1),
(198, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-06 18:54:29', '07-11-2024 04:08:57 AM', 1),
(199, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 01:30:14', '07-11-2024 10:04:55 AM', 1),
(200, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:05:01', '', 1),
(201, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:12:01', '07-11-2024 10:12:07 AM', 1),
(202, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:12:12', '07-11-2024 10:15:21 AM', 1),
(203, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:29:47', '07-11-2024 10:30:06 AM', 1),
(204, 0, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:30:11', '', 0),
(205, 0, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 02:30:18', '', 0),
(206, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 03:03:52', '07-11-2024 11:06:36 AM', 1),
(207, 0, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:11:08', '', 0),
(208, 0, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:11:14', '', 0),
(209, 0, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:12:07', '', 0),
(210, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:14:55', '', 0),
(211, 0, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:15:01', '', 0),
(212, 0, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:15:14', '', 0),
(213, 0, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:15:29', '', 0),
(214, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:15:34', '07-11-2024 01:16:11 PM', 1),
(215, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 05:18:40', '07-11-2024 01:21:27 PM', 1),
(216, 0, 'testbeta@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:15:10', '', 0),
(217, 0, 'testbeta613@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:15:37', '', 0),
(218, 51, 'testbeta613@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:16:16', '', 1),
(219, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:18:44', '', 1),
(220, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:20:04', '07-11-2024 02:23:06 PM', 1),
(221, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:25:42', '07-11-2024 02:27:58 PM', 1),
(222, 40, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:31:41', '07-11-2024 02:32:13 PM', 1),
(223, 0, 'dr.mariateresa.cruz@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-07 06:32:17', '', 0),
(224, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-10 23:32:49', '11-01-2025 07:32:54 AM', 1),
(225, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 00:15:28', '', 0),
(226, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 02:26:32', '', 1),
(227, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 02:41:10', '', 0),
(228, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 02:46:23', '', 0),
(229, 0, 'eqgsGGWUKfpSGchA', 0x3132372e302e302e3100000000000000, '2025-01-11 02:57:43', '', 0),
(230, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 05:58:09', '', 0),
(231, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 05:58:15', '', 0),
(232, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 05:58:31', '', 0),
(233, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 06:00:08', '', 1),
(234, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:59', '', 0),
(235, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:28:59', '', 0),
(236, 0, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:29:56', '', 0),
(237, 0, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:29:56', '', 0),
(238, 0, 'reywillardd01@gmail.com\" and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:00', '', 0),
(239, 0, 'reywillardd01@gmail.com\" and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:00', '', 0),
(240, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:21', '', 0),
(241, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:23', '', 0),
(242, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:40', '', 0),
(243, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:31:41', '', 0),
(244, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:32:46', '', 0),
(245, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:34:02', '', 0),
(246, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:34:03', '', 0),
(247, 0, 'zj 8507*4408 zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(248, 0, 'zj 4583*6489 zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(249, 0, 'zj{8987*7184}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(250, 0, 'zj{1301*5161}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(251, 0, 'zj${4220*2637}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(252, 0, 'zj${8347*1772}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(253, 0, 'zj#{8543*2205}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:05', '', 0),
(254, 0, 'zj#{1804*7246}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:06', '', 0),
(255, 0, 'zj{#1482*1685}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:06', '', 0),
(256, 0, 'zj{#9877*7597}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:06', '', 0),
(257, 0, 'zj{@3355*7589}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:06', '', 0),
(258, 0, 'fIYScjbijxTaZpPhNsFmAZOovNDtUiOOXyMCtPDbsNcLbZXuXTwWFmCqZAJqXIOCpsibfyxPpGswHilIYEnmLDXYssWuIUtOxnDltmFFgdCKwWRwmtWqnTsntOujXoReStJghOvBOxKUbneGOfwEweOArSmABJTuiZPEbsfLxKFuctvKFwfFuaDCuwarQiAyOliPDhHCobsBHvpyWvBHmxBhxXaeueAWxDjPIDxqZprStiwposLaVQgvhyMJAJI', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:18', '', 0),
(259, 0, '<', 0x3132372e302e302e3100000000000000, '2025-01-11 07:36:28', '', 0),
(260, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:43:54', '', 0),
(261, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:44:10', '', 1),
(262, 0, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:47', '', 0),
(263, 0, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:47', '', 0),
(264, 0, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:48', '', 0),
(265, 0, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:48', '', 0),
(266, 0, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:48', '', 0),
(267, 0, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 07:46:48', '', 0),
(268, 0, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:10', '', 0),
(269, 0, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:11', '', 0),
(270, 0, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:11', '', 0),
(271, 0, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:11', '', 0),
(272, 0, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:11', '', 0),
(273, 0, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:11', '', 0),
(274, 0, 'zApPX90sS', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 0),
(275, 0, 'zApPX91sS', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 0),
(276, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 0),
(277, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 0),
(278, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 0),
(279, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 1),
(280, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:24', '', 1),
(281, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:25', '', 1),
(282, 0, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:35', '', 0),
(283, 0, 'reywillardd01@gmail.com\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:35', '', 0),
(284, 0, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:35', '', 0),
(285, 0, ';', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:36', '', 0),
(286, 0, 'alcantaraivan2003@gmail.com\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:36', '', 0),
(287, 0, ';', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:36', '', 0),
(288, 0, 'alcantaraivan2003@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:53', '', 0),
(289, 0, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:48:08', '', 0),
(290, 0, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:47:53', '', 0),
(291, 0, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:48:08', '', 0),
(292, 0, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:48:09', '', 0),
(293, 0, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 07:48:39', '', 0),
(294, 0, 'reywillardd01@gmail.com and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:48:55', '', 0),
(295, 0, 'reywillardd01@gmail.com and 0 in (select sleep(1) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:49:11', '', 0),
(296, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:49:49', '', 0),
(297, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:49:50', '', 0),
(298, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:06', '', 0),
(299, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:24', '', 0),
(300, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:27', '', 0),
(301, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:28', '', 0),
(302, 0, '\"java.lang.Thread.sleep\"(15000)', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:29', '', 0),
(303, 0, 'alcantaraivan2003@gmail.com / \"java.lang.Thread.sleep\"(15000) ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:29', '', 0),
(304, 0, 'alcantaraivan2003@gmail.com\" / \"java.lang.Thread.sleep\"(15000) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:29', '', 0),
(305, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:39', '', 0),
(306, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:39', '', 0),
(307, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:39', '', 0),
(308, 0, 'case randomblob(100000) when not null then 1 else 1 end ', 0x3132372e302e302e3100000000000000, '2025-01-11 07:50:39', '', 0),
(309, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:51:47', '', 0),
(310, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:52:06', '', 0),
(311, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:56:15', '', 0),
(312, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 07:56:34', '', 0),
(313, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:40', '', 0),
(314, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:40', '', 0),
(315, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:40', '', 0),
(316, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:40', '', 0),
(317, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:40', '', 0),
(318, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:40', '', 0),
(319, 0, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:53', '', 0),
(320, 0, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:54', '', 0),
(321, 0, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:54', '', 0),
(322, 0, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:54', '', 0),
(323, 0, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:54', '', 0),
(324, 0, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 07:59:54', '', 0),
(325, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:04', '', 0),
(326, 0, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:11', '', 0),
(327, 0, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:11', '', 0),
(328, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:11', '', 0),
(329, 0, 'zj 3220*5295 zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:18', '', 0),
(330, 0, 'zj{9062*7095}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:18', '', 0),
(331, 0, 'zj${7085*6504}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:18', '', 0),
(332, 0, '<#assign ex=\"freemarker.template.utility.Execute\"?new()> ${ ex(\"sleep 15\") }', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:24', '', 0),
(333, 0, '#set($engine=\"\")\n#set($proc=$engine.getClass().forName(\"java.lang.Runtime\").getRuntime().exec(\"sleep 15\"))\n#set($null=$proc.waitFor())\n${null}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:24', '', 0),
(334, 0, '{{\"\".__class__.__mro__[1].__subclasses__()[157].__repr__.__globals__.get(\"__builtins__\").get(\"__import__\")(\"subprocess\").check_output(\"sleep 15\")}}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:24', '', 0),
(335, 0, 'XndnxXpUYpYIJHPvyJtlFWWhVhVwLkabFxaaIYbbFjCxpGQgLHDTOxJxdBuugfjWFrricDhuwMjeKRjAxPtTiTNPCavxfUsijnKuHrhsktsvfLnKauFdhhuQNkwNioMpkgXgcTdhucPpAqFqLBqdfAvaNqOXtxUsAHdkWIERyjOgSGKRFdRwUxlSvWPKsRpiyekocSVrcaYRpgLQYuugfnjleDXvkwnfkGwXwLhJHtqqEspfXtWNBmKdyQdIgsd', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', '', 0),
(336, 0, 'LiNaNCjIZbceFRRwPmqciFAoaixJbAfjFVnMmSuwrBvfMNSfcHnJJogEjnqkbXhvESrpaYjnywoZtJERcsPRIqoqCSSfCkPRNvNlGLISeGQSewBwhRjGgBntppkRjsLvOHbsTYIghnJvMBshGOomykiCCASeIPqCZWJxsbPkGkEEWPyeMEWybYoyjVeFbBsqnXHmlbYJrpkSAIbwUSdtCCAhmrauTLZeXcbDjFTRGdUVPprCyTZYqyFcWWhslKC', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', '', 0),
(337, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', '', 0),
(338, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', '', 0),
(339, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', '', 0),
(340, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:37', '', 0),
(341, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:47', '', 0),
(342, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:47', '', 0),
(343, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:57', '', 0),
(344, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:00:57', '', 0),
(345, 0, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:27', '', 0),
(346, 0, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:27', '', 0),
(347, 0, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:27', '', 0),
(348, 0, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:29', '', 0),
(349, 0, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:30', '', 0),
(350, 0, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:30', '', 0),
(351, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:37', '', 0),
(352, 0, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:52', '', 0),
(353, 0, '2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:52', '', 0),
(354, 0, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:52', '', 0),
(355, 0, 'http://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:53', '', 0),
(356, 0, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:53', '', 0),
(357, 0, 'https://2269736122707719753.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 08:19:53', '', 0),
(358, 0, 'zApPX145sS', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:06', '', 0),
(359, 0, 'zApPX146sS', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:06', '', 0),
(360, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:06', '', 0),
(361, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:06', '', 0),
(362, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:06', '', 0),
(363, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:06', '', 0),
(364, 0, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:18', '', 0),
(365, 0, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:18', '', 0),
(366, 0, 'reywillardd01@gmail.com\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:18', '', 0),
(367, 0, ';', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:18', '', 0),
(368, 0, 'alcantaraivan2003@gmail.com\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:18', '', 0),
(369, 0, ';', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:18', '', 0),
(370, 0, 'alcantaraivan2003@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:42', '', 0),
(371, 0, 'reywillardd01@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:56', '', 0),
(372, 0, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:42', '', 0),
(373, 0, NULL, 0x3132372e302e302e3100000000000000, '2025-01-11 08:20:57', '', 0),
(374, 0, 'reywillardd01@gmail.com\" / sleep(15) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:23:12', '', 0),
(375, 0, 'reywillardd01@gmail.com and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:23:12', '', 0),
(376, 0, 'reywillardd01@gmail.com\" and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:23:42', '', 0),
(377, 0, 'reywillardd01@gmail.com where 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:23:57', '', 0),
(378, 0, 'reywillardd01@gmail.com\" where 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:24:28', '', 0),
(379, 0, 'reywillardd01@gmail.com or 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:24:43', '', 0),
(380, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:24:58', '', 0),
(381, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:25:13', '', 0),
(382, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:25:43', '', 0),
(383, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:25:59', '', 0),
(384, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:26:14', '', 0),
(385, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:26:44', '', 0),
(386, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:26:59', '', 0),
(387, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:27:14', '', 0),
(388, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:27:29', '', 0),
(389, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:27:44', '', 0),
(390, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:27:59', '', 1),
(391, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:27:59', '', 1),
(392, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:27:59', '', 1),
(393, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(394, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(395, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(396, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(397, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(398, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(399, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(400, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(401, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(402, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(403, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(404, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(405, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(406, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(407, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:00', '', 1),
(408, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:01', '', 1),
(409, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:01', '', 1),
(410, 0, '\"java.lang.Thread.sleep\"(15000)', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:02', '', 0),
(411, 0, '\"java.lang.Thread.sleep\"(15000)', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:02', '', 0),
(412, 0, 'alcantaraivan2003@gmail.com / \"java.lang.Thread.sleep\"(15000) ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:02', '', 0),
(413, 0, 'reywillardd01@gmail.com / \"java.lang.Thread.sleep\"(15000) ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:02', '', 0),
(414, 0, 'alcantaraivan2003@gmail.com\" / \"java.lang.Thread.sleep\"(15000) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:02', '', 0),
(415, 0, 'reywillardd01@gmail.com\" / \"java.lang.Thread.sleep\"(15000) / \"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:02', '', 0),
(416, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 1),
(417, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 0),
(418, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 1),
(419, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 0),
(420, 0, 'case randomblob(100000) when not null then 1 else 1 end ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 0),
(421, 0, 'case randomblob(100000) when not null then 1 else 1 end ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 0),
(422, 0, 'mm1ofdhzgiztguhd4iu3u20ewb0ej01otecrskkwbkt4vyzistccuz93', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 0),
(423, 0, 'case randomblob(1000000) when not null then 1 else 1 end ', 0x3132372e302e302e3100000000000000, '2025-01-11 08:28:13', '', 0),
(424, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:29:37', '', 0),
(425, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:29:46', '', 0),
(426, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:44:16', '', 0),
(427, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:20', '', 0),
(428, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:20', '', 0),
(429, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:20', '', 0),
(430, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:22', '', 0),
(431, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:22', '', 0),
(432, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:22', '', 0),
(433, 0, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:40', '', 0),
(434, 0, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:40', '', 0),
(435, 0, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:40', '', 0),
(436, 0, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:40', '', 0),
(437, 0, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:40', '', 0),
(438, 0, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:40', '', 0),
(439, 0, 'cat /etc/passwd', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:51', '', 0),
(440, 0, 'cat /etc/passwd', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:51', '', 0),
(441, 0, 'alcantaraivan2003@gmail.com&cat /etc/passwd&', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:51', '', 0),
(442, 0, 'reywillardd01@gmail.com&cat /etc/passwd&', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:51', '', 0),
(443, 0, 'alcantaraivan2003@gmail.com;cat /etc/passwd;', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:51', '', 0),
(444, 0, 'reywillardd01@gmail.com;cat /etc/passwd;', 0x3132372e302e302e3100000000000000, '2025-01-11 08:49:51', '', 0),
(445, 0, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:05', '', 0),
(446, 0, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:05', '', 0),
(447, 0, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:05', '', 0),
(448, 0, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:05', '', 0),
(449, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:05', '', 0),
(450, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:06', '', 0),
(451, 0, 'zj 3368*7681 zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:34', '', 0),
(452, 0, 'zj{4480*6775}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:34', '', 0),
(453, 0, 'zj 5122*1942 zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:34', '', 0),
(454, 0, 'zj{6857*5608}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:34', '', 0),
(455, 0, 'zj${9415*5355}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:34', '', 0),
(456, 0, 'zj${4219*1676}zj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:34', '', 0),
(457, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:45', '', 0),
(458, 0, 'XLRLtvjjiLktkJHSGoIviXNSehNZkaJAsfyfZAJACaWvTcXKahoaDNhSFmekLcDamxXhsYiZOvSdIZdBxrBFDgYWQbRvgnSYSmvhiqRUsjnAGUNLvrUDdBQIMNMDnDENTwdwtBlKhrbSJdCBBTburMtBOocfPJJDGJEobxdettJMGTJTWAiUuseuJOXFHZIqaNTnYNfamkIbogvpqcwIGXwTdBBJKBYhfwDjxSHHjhdggRQbnDOucTkmlNPZBoj', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', '', 0),
(459, 0, 'OqMLcQFMYYSWTLJMDXbUnRkpOdFnFabsMMqglkNlroPYaOrFNSSimGAGpfcasQULsGfTrMnFZXZYMcbUJaQcruPuOvDOOZiQJbVDKQrejHXytXNGBLtEcVhKIhGmQLhdcvZBlbHTbHQcAafQTdJPmVHdJBcIEsNindMuOPFapJXFpLnHEJUcdYKUQfCKIOiMXdOQaPteYwqNghOUbJOIWRHkUwhArqpfoPMbtLNVmjihHomUlawbfnhgZSoYWBp', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', '', 0),
(460, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', '', 0),
(461, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', '', 0),
(462, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', '', 1),
(463, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:54', '', 1),
(464, 0, 'ZAP', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:56', '', 0),
(465, 0, 'ZAP%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s\n', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:56', '', 0),
(466, 0, 'ZAP %1!s%2!s%3!s%4!s%5!s%6!s%7!s%8!s%9!s%10!s%11!s%12!s%13!s%14!s%15!s%16!s%17!s%18!s%19!s%20!s%21!n%22!n%23!n%24!n%25!n%26!n%27!n%28!n%29!n%30!n%31!n%32!n%33!n%34!n%35!n%36!n%37!n%38!n%39!n%40!n\n', 0x3132372e302e302e3100000000000000, '2025-01-11 08:50:57', '', 0),
(467, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:05', '', 0),
(468, 0, '', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:06', '', 0),
(469, 0, '', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:06', '', 0),
(470, 0, '<', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', '', 0),
(471, 0, '<', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', '', 0),
(472, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', '', 0),
(473, 0, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 08:51:16', '', 0),
(474, 43, 'reywillardd01@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:17:40', '', 1),
(475, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:36:53', '', 1),
(476, 0, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:43:08', '', 0),
(477, 0, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:43:08', '', 0),
(478, 0, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:43:08', '', 0),
(479, 0, 'c:/Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:21', '', 0),
(480, 0, '../../../../../../../../../../../../../../../../Windows/system.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:21', '', 0),
(481, 0, 'c:Windowssystem.ini', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:21', '', 0),
(482, 0, '543940209345055925.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:42', '', 0),
(483, 0, 'http://543940209345055925.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:42', '', 0),
(484, 0, 'https://543940209345055925.owasp.org', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:42', '', 0),
(485, 0, 'zApPX42sS', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', '', 0),
(486, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', '', 0),
(487, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', '', 1),
(488, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:56', '', 1),
(489, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:44:59', '', 1),
(490, 0, '0W45pz4p', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:05', '', 0),
(491, 0, '</td><script>alert(1);</script><td>', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:06', '', 0),
(492, 0, '\"', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:09', '', 0),
(493, 0, 'alcantaraivan2003@gmail.com / sleep(15) ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:45:25', '', 0),
(494, 0, 'alcantaraivan2003@gmail.com and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:47:56', '', 0),
(495, 0, 'alcantaraivan2003@gmail.com\" and 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:12', '', 0),
(496, 0, 'alcantaraivan2003@gmail.com where 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:13', '', 0),
(497, 0, 'alcantaraivan2003@gmail.com\" where 0 in (select sleep(15) ) -- ', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:13', '', 0),
(498, 0, 'case when cast(pg_sleep(15.0) as varchar) > \' then 0 else 1 end', 0x3132372e302e302e3100000000000000, '2025-01-11 13:48:23', '', 0),
(499, 0, '?name=abc#<img src=\"random.gif\" onerror=alert(5397)>', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:23', '', 0),
(500, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:41', '', 0),
(501, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:42', '', 0),
(502, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:49:42', '', 0),
(503, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:02', '', 1),
(504, 0, '\";print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));$var=\"', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:16', '', 0),
(505, 0, '${@print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110))}', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:16', '', 0),
(506, 0, ';print(chr(122).chr(97).chr(112).chr(95).chr(116).chr(111).chr(107).chr(101).chr(110));', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:17', '', 0),
(507, 0, 'alcantaraivan2003@gmail.com;sleep 15.0;', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:27', '', 0),
(508, 0, '<!--', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:42', '', 0),
(509, 0, ']]>', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:42', '', 0),
(510, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:42', '', 0),
(511, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:50:52', '', 0),
(512, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:04', '', 1),
(513, 0, 'txQggMQrhGioofQaUjiHHuPhXhIvOSgtmwcrVixLxjAUYuRtuTqbktXDBMPwPELRcuoLZkwrkBkvyoTfnRQgmnmBPqkUVOWcAuQqoTMxkdefeBncvoltdkxldTKLJItVddanKEntpZIRfhbMyLFhTMhWtXEyKFOpKBwfJiRBnpreJymimLFGUIoTmUFGHnipEsIBTrYHPHGelKUxsIgxTUdCMbRcfllCIcSkBWORZLaIvDDoAVLtpRJtwAMgxhd', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', '', 0),
(514, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', '', 0),
(515, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', '', 1),
(516, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:12', '', 1),
(517, 0, 'ZAP', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:14', '', 0),
(518, 0, 'ZAP%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s%n%s\n', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:15', '', 0),
(519, 0, 'ZAP %1!s%2!s%3!s%4!s%5!s%6!s%7!s%8!s%9!s%10!s%11!s%12!s%13!s%14!s%15!s%16!s%17!s%18!s%19!s%20!s%21!n%22!n%23!n%24!n%25!n%26!n%27!n%28!n%29!n%30!n%31!n%32!n%33!n%34!n%35!n%36!n%37!n%38!n%39!n%40!n\n', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:15', '', 0),
(520, 0, '<', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:37', '', 0),
(521, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:37', '', 0),
(522, 0, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-11 13:51:37', '', 0),
(523, 0, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2025-01-18 11:43:27', '', 0),
(524, 53, 'alcantaraivan2003@gmail.com', 0x3a3a3100000000000000000000000000, '2025-01-18 11:44:08', '', 1),
(525, 53, 'alcantaraivan2003@gmail.com', 0x3132372e302e302e3100000000000000, '2025-01-18 11:45:54', '', 1);

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
(2, 'sample', 'Manila, Philippines', 'Sico', NULL, 'female', 'test@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2016-12-30 05:34:39', '2025-01-11 08:20:16', 'user', 'uploads/Picture3.png'),
(9, 'admin', 'admin', 'admin', NULL, 'male', 'admin@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-10-27 12:26:33', '2025-01-11 08:20:16', 'user', NULL),
(37, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuaveforex@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-05 19:55:19', '2025-01-11 08:20:16', 'user', NULL),
(39, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuave@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-05 19:57:42', '2025-01-11 08:20:16', 'user', 'uploads/Picture5.png'),
(40, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuave@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-05 19:57:43', '2025-01-11 08:20:16', 'user', 'uploads/Picture3.png'),
(42, 'Lebron James', 'Sico', 'Lipa', 'Batangas', 'male', 'adfadf@gmial.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-06 14:09:54', '2025-01-11 08:20:16', 'user', NULL),
(43, 'Steve Adamas', 'Sico', 'Lipa ', 'Batangas', 'male', 'reywillardd01@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-06 14:23:09', '2025-01-11 08:20:16', 'user', NULL),
(49, 'sample', 'sample', 'sample', 'sample', 'male', 'reywillard01@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-06 14:51:34', '2025-01-11 08:20:16', 'user', NULL),
(51, 'Marvin Anatacio', 'lipa', 'city', 'Batangas', 'male', 'testbeta613@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-07 06:14:26', '2025-01-11 08:20:16', 'user', NULL),
(53, 'Ivan Alcantara', 'Tambo', 'LIpa ', 'Batangas', 'male', 'alcantaraivan2003@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2025-01-11 00:25:51', '2025-01-11 08:51:16', 'user', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
