-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 09:35 PM
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
(1, 'admin', 'lolzz1230', '05-11-2024 07:24:01 PM', 'admin');

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
(27, 'Dentist', 14, 2, 5000, '2024-12-12', '3:30 AM', '2024-11-05 19:21:11', 1, 1, NULL);

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
(14, 'Dentist', 'Rey Willard R, Malicsee', 'Sicoo1', '5000', '09777726493', 'malicsuave@gmail.com', '089322f6b0a5b998b94281cc6e7aff06', '2024-11-03 17:47:49', '0000-00-00 00:00:00', 'doctor');

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
(110, 14, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 17:29:27', NULL, 1);

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
(6, 'Dentist-Brace', '2016-12-28 06:40:08', '2024-11-03 13:47:44'),
(10, 'Bones Specialist demo', '2017-01-07 08:07:53', '0000-00-00 00:00:00'),
(22, 'Dentist', '2024-11-03 13:24:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
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
(1, 'test user', 'test@gmail.com', 2523523522523523, ' This is sample text for the test.', '2019-06-29 19:03:08', 'Test Admin Remark', '2019-06-30 12:55:23', 1),
(2, 'Lyndon Bermoy', 'serbermz2020@gmail.com', 1111111111111111, ' This is sample text for testing.  This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing.', '2019-06-30 13:06:50', 'Answered', '2020-07-05 02:13:25', 1),
(3, 'fdsfsdf', 'fsdfsd@ghashhgs.com', 3264826346, 'sample text   sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  ', '2019-11-10 18:53:48', 'vfdsfgfd', '2019-11-10 18:54:04', 1),
(4, 'demo', 'demo@gmail.com', 123456789, ' hi, this is a demo', '2020-07-05 01:57:20', 'answered', '2020-07-05 01:57:46', 1);

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
(3, 2, '90/120', '92/190', '86 kg', '99 deg', '#Sugar High\r\n1.Petz 30', '', '', '2019-11-06 04:31:24'),
(4, 1, '125/200', '86/120', '56 kg', '98 deg', '# blood pressure is high\r\n1.koil cipla', '', '', '2019-11-06 04:52:42'),
(5, 1, '96/120', '98/120', '57 kg', '102 deg', '#Viral\r\n1.gjgjh-1Ml\r\n2.kjhuiy-2M', '', '', '2019-11-06 04:56:55'),
(6, 4, '90/120', '120', '56', '98 F', '#blood sugar high\r\n#Asthma problem', '', '', '2019-11-06 14:38:33'),
(7, 5, '80/120', '120', '85', '98.6', 'Rx\r\n\r\nAbc tab\r\nxyz Syrup', '', '', '2019-11-10 18:50:23'),
(8, 8, '123/50', '123', '123kg', '123', 'fafafadfadf', NULL, NULL, '2024-11-03 16:56:29'),
(9, 10, '123', '123', '123', '123', '123', NULL, '123', '2024-11-03 18:19:14'),
(10, 10, '123', '123', '123', '123', '123', NULL, '123', '2024-11-03 18:20:54'),
(11, 10, '123', '123', '123', '123', '123', '123', '123', '2024-11-03 18:25:00'),
(12, 10, '123', '123', '123', '123', '123', '123', '123', '2024-11-05 15:42:28'),
(13, 10, '123', '123', '123', '123', '123', '123', '123', '2024-11-05 15:49:16'),
(14, 16, '123', '123', '123', '123', '123', '123', '123', '2024-11-05 15:55:38'),
(15, 16, '123', '123', '123', '123', '123', '123', '123', '2024-11-05 15:59:25'),
(16, 16, '123', '123', '123', '123', '123', '123', '123', '2024-11-05 16:03:02');

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
(19, 14, 'Patient 12', 1231231213, '1231321@gmail.coim', 'male', '123', 123, '123', '2024-11-05 16:47:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(131, NULL, 'reywillard01@gmai.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:36:26', NULL, 0),
(132, NULL, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:36:47', NULL, 0),
(133, 32, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:41:26', '04-11-2024 01:41:47 AM', 1),
(134, 35, 'reywillard01@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-03 17:44:40', '04-11-2024 01:45:09 AM', 1),
(135, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 12:56:36', '05-11-2024 08:56:50 PM', 1),
(136, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:06:23', NULL, 0),
(137, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:06:28', NULL, 1),
(138, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:12:08', NULL, 1),
(139, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:26:46', '05-11-2024 09:26:49 PM', 1),
(140, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:58:44', NULL, 0),
(141, NULL, 'rey@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:58:57', NULL, 0),
(142, NULL, 'rey@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:59:07', NULL, 0),
(143, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 13:59:15', '05-11-2024 10:03:05 PM', 1),
(144, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:03:41', '05-11-2024 10:05:12 PM', 1),
(145, NULL, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:02', NULL, 0),
(146, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:14', NULL, 0),
(147, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:20', NULL, 0),
(148, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:32', NULL, 0),
(149, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:06:41', '05-11-2024 10:07:46 PM', 1),
(150, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:08:32', '05-11-2024 10:40:06 PM', 1),
(151, NULL, 'rey@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:40:33', NULL, 0),
(152, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 14:40:39', '05-11-2024 10:47:43 PM', 1),
(153, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 18:47:02', '06-11-2024 03:54:58 AM', 1),
(154, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 19:59:55', NULL, 1),
(155, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:24:41', NULL, 0),
(156, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:24:48', NULL, 0),
(157, NULL, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:24:55', NULL, 0),
(158, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:25:33', '06-11-2024 04:25:59 AM', 1),
(159, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:26:07', NULL, 1),
(160, 39, 'malicsuave@gmail.com', 0x3a3a3100000000000000000000000000, '2024-11-05 20:32:47', '06-11-2024 04:35:25 AM', 1);

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
(2, 'sample', 'Manila, Philippines', 'Sico', NULL, 'female', 'test@gmail.com', '32250170a0dca92d53ec9624f336ca24', '2016-12-30 05:34:39', '2024-11-05 20:15:05', 'user', 'uploads/Picture3.png'),
(9, 'admin', 'admin', 'admin', NULL, 'male', 'admin@gmail.com', '32250170a0dca92d53ec9624f336ca24', '2024-10-27 12:26:33', '2024-10-27 12:29:52', 'user', NULL),
(37, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuaveforex@gmail.com', 'de22fbb570d6b27984b3431d473e05ad', '2024-11-05 19:55:19', NULL, 'user', NULL),
(39, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuave@gmail.com', '32250170a0dca92d53ec9624f336ca24', '2024-11-05 19:57:42', '2024-11-05 20:25:54', 'user', 'uploads/Picture5.png'),
(40, 'sample', 'sample', 'sample', 'sample', 'male', 'malicsuave@gmail.com', '32250170a0dca92d53ec9624f336ca24', '2024-11-05 19:57:43', '2024-11-05 20:25:24', 'user', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
