-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2022 at 11:25 AM
-- Server version: 5.7.37-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: adminivan_ivan
--
CREATE DATABASE IF NOT EXISTS adminivan_ivan DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE adminivan_ivan;

-- --------------------------------------------------------

--
-- Table structure for table bank_list
--

CREATE TABLE bank_list (
  bank_ID int(11) NOT NULL,
  bank_abbreviation varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  bank_name_th varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  bank_name_en varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  bank_number varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  bank_logo varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table bank_list
--

INSERT INTO bank_list (bank_ID, bank_abbreviation, bank_name_th, bank_name_en, bank_number, bank_logo) VALUES
(1, 'SCB', 'ไทยพาณิชย์', 'Siam Commercial', '123-4-56789-0', 'scb.jpg'),
(2, 'KTB', 'กรุงไทย', 'Krungthai', '123-4-56789-0', 'ktb.jpg'),
(3, 'KBANK', 'กสิกรไทย', 'Kasikorn', '123-4-56789-0', 'kbank.png'),
(4, 'TTB', 'ทหารไทยธนชาต', 'Thanachart', '123-4-56789-0', 'ttb.jpg');

CREATE TABLE setting (
  setting int NOT NULL AUTO_INCREMENT,
  otp_sender VARCHAR(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  otp_token VARCHAR(65535) COLLATE utf8mb4_unicode_ci NOT NULL,
  otp_off_time int(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  otp_key_off_time int(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  session_timeout int(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  pay_time_off int(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  fb_app_id varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  fb_app_secret varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  fb_default_graph_version varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  note varchar(65535) COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (setting)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO setting (setting, otp_sender, otp_token, otp_off_time, otp_key_off_time, session_timeout, pay_time_off, fb_app_id, fb_app_secret, fb_default_graph_version) VALUES
(1, "Now", "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90aHNtcy5jb21cL21hbmFnZVwvYXBpLWtleSIsImlhdCI6MTY1NjgzNjMwNiwibmJmIjoxNjU2ODM2MzA2LCJqdGkiOiIyZTdXamRKblRsTTJVUEJ2Iiwic3ViIjoxMDYxNzUsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Hm3GFETQxd51p3g-9Ocj_Mzb2WqVZABoCjlJN_cK6K4", 900, 900, 6400, 15, "610041970537938", "8b014dd5a63e6349a7509e6c7e5ae4ea", "v14.0");

-- --------------------------------------------------------

--
-- Table structure for table complaint
--

CREATE TABLE complaint (
  Com_ID int(11) NOT NULL,
  Com_Type_ID int(11) NOT NULL,
  Com_Topic varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  Com_Content mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table complaint
--

INSERT INTO complaint (Com_ID, Com_Type_ID, Com_Topic, Com_Content) VALUES
(1, 1, 'คนขับรถโดยสารป้ายทะเบียน กข6525 ขับรถห่วยแตกมากค่ะ', 'เรื่องเกิดเมื่อวานก่อน คนขับ จอดรถทะเลาะกับเมีย ทำเอาทุกคนที่อยู่บนรถวันนั้นไม่พอใจอย่างมากค่ะ รบกวนอบรมคนของคุณด้วยนะคะ ขอบคุณค่ะ'),
(2, 4, ' ชื่อในเกม _BK_BEEKUNG_', 'ให้แอดมินได้เทสครัช'),
(3, 4, ' ชื่อในเกม EvilNightCH', 'หนูทดลองตัวที่ 2'),
(4, 1, 'apooom', 'หนูทดลองของแอด'),
(5, 2, 'ชื่อในเกม Merquize ', 'Hellotestๆ'),
(6, 2, 'OUM353', 'หนูทดลอง'),
(7, 4, 'Alip42461', 'มารับของฟรีครัฟ555'),
(8, 1, 'ขอร้องเรียนคนขับรถตู้ป้ายทะเบียน กข2552 หน่อยค่ะ', 'คนขับขับรถได้แย่มาก ทั้งขับช้าาาา อืดดดดดด แถมยังจอดรถแวะรับคนนอกจุดจอดรถถี่มาก');

-- --------------------------------------------------------

--
-- Table structure for table complaint_type
--

CREATE TABLE complaint_type (
  Com_Type_ID int(11) NOT NULL,
  Com_Type_Name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table complaint_type
--

INSERT INTO complaint_type (Com_Type_ID, Com_Type_Name) VALUES
(1, 'เกี่ยวกับคนขับรถตู้โดยสารสาธารณะ'),
(2, 'เกี่ยวกับพนักงานขายตั๋ว'),
(3, 'เกี่ยวกับระบบของเว็บไซต์'),
(4, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table dock_car
--

CREATE TABLE dock_car (
  Dock_car_id int(11) NOT NULL,
  Around_Num int(11) NOT NULL,
  Van_Out time NOT NULL,
  Station_ID int(11) NOT NULL,
  Van_ID int(11) NOT NULL,
  Festival_Date date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table dock_car
--

INSERT INTO dock_car (Dock_car_id, Around_Num, Van_Out, Station_ID, Van_ID, Festival_Date) VALUES
(1, 1, '07:10:00', 1, 1, '0000-00-00'),
(2, 1, '07:20:00', 2, 1, '0000-00-00'),
(3, 1, '07:30:00', 3, 1, '0000-00-00'),
(4, 1, '07:50:00', 4, 1, '0000-00-00'),
(5, 1, '08:10:00', 5, 1, '0000-00-00'),
(6, 1, '08:40:00', 6, 1, '0000-00-00'),
(7, 1, '08:50:00', 7, 1, '0000-00-00'),
(8, 1, '09:00:00', 6, 1, '0000-00-00'),
(9, 1, '09:30:00', 5, 1, '0000-00-00'),
(10, 1, '10:00:00', 4, 1, '0000-00-00'),
(11, 1, '10:20:00', 3, 1, '0000-00-00'),
(12, 1, '10:30:00', 2, 1, '0000-00-00'),
(13, 2, '12:10:00', 1, 1, '0000-00-00'),
(14, 2, '12:20:00', 2, 1, '0000-00-00'),
(15, 2, '12:30:00', 3, 1, '0000-00-00'),
(16, 2, '12:50:00', 4, 1, '0000-00-00'),
(17, 2, '13:10:00', 5, 1, '0000-00-00'),
(18, 2, '13:40:00', 6, 1, '0000-00-00'),
(19, 2, '13:50:00', 7, 1, '0000-00-00'),
(20, 2, '14:00:00', 6, 1, '0000-00-00'),
(21, 2, '14:30:00', 5, 1, '0000-00-00'),
(22, 2, '15:00:00', 4, 1, '0000-00-00'),
(23, 2, '15:20:00', 3, 1, '0000-00-00'),
(24, 2, '15:30:00', 2, 1, '0000-00-00'),
(25, 1, '07:40:00', 1, 2, '0000-00-00'),
(26, 1, '07:50:00', 2, 2, '0000-00-00'),
(27, 1, '08:00:00', 3, 2, '0000-00-00'),
(28, 1, '08:20:00', 4, 2, '0000-00-00'),
(29, 1, '08:40:00', 5, 2, '0000-00-00'),
(30, 1, '09:10:00', 6, 2, '0000-00-00'),
(31, 1, '09:20:00', 7, 2, '0000-00-00'),
(32, 1, '09:30:00', 6, 2, '0000-00-00'),
(33, 1, '10:00:00', 5, 2, '0000-00-00'),
(34, 1, '10:30:00', 4, 2, '0000-00-00'),
(35, 1, '10:50:00', 3, 2, '0000-00-00'),
(36, 1, '11:00:00', 2, 2, '0000-00-00'),
(37, 2, '12:40:00', 1, 2, '0000-00-00'),
(38, 2, '12:50:00', 2, 2, '0000-00-00'),
(39, 2, '13:00:00', 3, 2, '0000-00-00'),
(40, 2, '13:20:00', 4, 2, '0000-00-00'),
(41, 2, '13:40:00', 5, 2, '0000-00-00'),
(42, 2, '14:10:00', 6, 2, '0000-00-00'),
(43, 2, '14:20:00', 7, 2, '0000-00-00'),
(44, 2, '14:30:00', 6, 2, '0000-00-00'),
(45, 2, '15:00:00', 5, 2, '0000-00-00'),
(46, 2, '15:30:00', 4, 2, '0000-00-00'),
(47, 2, '15:50:00', 3, 2, '0000-00-00'),
(48, 2, '16:00:00', 2, 2, '0000-00-00'),
(49, 1, '08:10:00', 1, 3, '0000-00-00'),
(50, 1, '08:20:00', 2, 3, '0000-00-00'),
(51, 1, '08:30:00', 3, 3, '0000-00-00'),
(52, 1, '08:50:00', 4, 3, '0000-00-00'),
(53, 1, '09:10:00', 5, 3, '0000-00-00'),
(54, 1, '09:40:00', 6, 3, '0000-00-00'),
(55, 1, '09:50:00', 7, 3, '0000-00-00'),
(56, 1, '10:00:00', 6, 3, '0000-00-00'),
(57, 1, '10:30:00', 5, 3, '0000-00-00'),
(58, 1, '11:00:00', 4, 3, '0000-00-00'),
(59, 1, '11:20:00', 3, 3, '0000-00-00'),
(60, 1, '11:30:00', 2, 3, '0000-00-00'),
(61, 2, '13:10:00', 1, 3, '0000-00-00'),
(62, 2, '13:20:00', 2, 3, '0000-00-00'),
(63, 2, '13:30:00', 3, 3, '0000-00-00'),
(64, 2, '13:50:00', 4, 3, '0000-00-00'),
(65, 2, '14:10:00', 5, 3, '0000-00-00'),
(66, 2, '14:40:00', 6, 3, '0000-00-00'),
(67, 2, '14:50:00', 7, 3, '0000-00-00'),
(68, 2, '15:00:00', 6, 3, '0000-00-00'),
(69, 2, '15:30:00', 5, 3, '0000-00-00'),
(70, 2, '16:00:00', 4, 3, '0000-00-00'),
(71, 2, '16:20:00', 3, 3, '0000-00-00'),
(72, 2, '16:30:00', 2, 3, '0000-00-00'),
(73, 2, '15:30:00', 1, 4, '0000-00-00'),
(74, 2, '15:40:00', 2, 4, '0000-00-00'),
(75, 2, '15:50:00', 3, 4, '0000-00-00'),
(76, 2, '16:10:00', 4, 4, '0000-00-00'),
(77, 2, '16:30:00', 5, 4, '0000-00-00'),
(78, 2, '07:00:00', 6, 4, '0000-00-00'),
(79, 1, '08:40:00', 7, 4, '0000-00-00'),
(80, 1, '08:50:00', 6, 4, '0000-00-00'),
(81, 1, '09:20:00', 5, 4, '0000-00-00'),
(82, 1, '09:50:00', 4, 4, '0000-00-00'),
(83, 1, '10:10:00', 3, 4, '0000-00-00'),
(84, 1, '10:20:00', 2, 4, '0000-00-00'),
(85, 1, '10:30:00', 1, 4, '0000-00-00'),
(86, 1, '10:40:00', 2, 4, '0000-00-00'),
(87, 1, '10:50:00', 3, 4, '0000-00-00'),
(88, 1, '11:10:00', 4, 4, '0000-00-00'),
(89, 1, '11:30:00', 5, 4, '0000-00-00'),
(90, 1, '12:00:00', 6, 4, '0000-00-00'),
(91, 2, '13:40:00', 7, 4, '0000-00-00'),
(92, 2, '13:50:00', 6, 4, '0000-00-00'),
(93, 2, '14:20:00', 5, 4, '0000-00-00'),
(94, 2, '14:50:00', 4, 4, '0000-00-00'),
(95, 2, '15:10:00', 3, 4, '0000-00-00'),
(96, 2, '15:20:00', 2, 4, '0000-00-00'),
(97, 2, '16:00:00', 1, 5, '0000-00-00'),
(98, 2, '16:10:00', 2, 5, '0000-00-00'),
(99, 2, '16:20:00', 3, 5, '0000-00-00'),
(100, 2, '16:40:00', 4, 5, '0000-00-00'),
(101, 2, '07:00:00', 5, 5, '0000-00-00'),
(102, 2, '07:30:00', 6, 5, '0000-00-00'),
(103, 1, '09:10:00', 7, 5, '0000-00-00'),
(104, 1, '09:20:00', 6, 5, '0000-00-00'),
(105, 1, '09:50:00', 5, 5, '0000-00-00'),
(106, 1, '10:20:00', 4, 5, '0000-00-00'),
(107, 1, '10:40:00', 3, 5, '0000-00-00'),
(108, 1, '10:50:00', 2, 5, '0000-00-00'),
(109, 1, '11:00:00', 1, 5, '0000-00-00'),
(110, 1, '11:10:00', 2, 5, '0000-00-00'),
(111, 1, '11:20:00', 3, 5, '0000-00-00'),
(112, 1, '11:40:00', 4, 5, '0000-00-00'),
(113, 1, '12:00:00', 5, 5, '0000-00-00'),
(114, 1, '12:30:00', 6, 5, '0000-00-00'),
(115, 2, '14:10:00', 7, 5, '0000-00-00'),
(116, 2, '14:20:00', 6, 5, '0000-00-00'),
(117, 2, '14:50:00', 5, 5, '0000-00-00'),
(118, 2, '15:20:00', 4, 5, '0000-00-00'),
(119, 2, '15:40:00', 3, 5, '0000-00-00'),
(120, 2, '15:50:00', 2, 5, '0000-00-00'),
(121, 2, '16:30:00', 1, 6, '0000-00-00'),
(122, 2, '16:40:00', 2, 6, '0000-00-00'),
(123, 2, '16:50:00', 3, 6, '0000-00-00'),
(124, 2, '07:10:00', 4, 6, '0000-00-00'),
(125, 2, '07:30:00', 5, 6, '0000-00-00'),
(126, 2, '18:00:00', 6, 6, '0000-00-00'),
(127, 1, '09:40:00', 7, 6, '0000-00-00'),
(128, 1, '09:50:00', 6, 6, '0000-00-00'),
(129, 1, '10:20:00', 5, 6, '0000-00-00'),
(130, 1, '10:50:00', 4, 6, '0000-00-00'),
(131, 1, '11:10:00', 3, 6, '0000-00-00'),
(132, 1, '11:20:00', 2, 6, '0000-00-00'),
(133, 1, '11:30:00', 1, 6, '0000-00-00'),
(134, 1, '11:40:00', 2, 6, '0000-00-00'),
(135, 1, '11:50:00', 3, 6, '0000-00-00'),
(136, 1, '12:10:00', 4, 6, '0000-00-00'),
(137, 1, '12:30:00', 5, 6, '0000-00-00'),
(138, 1, '13:00:00', 6, 6, '0000-00-00'),
(139, 2, '14:40:00', 7, 6, '0000-00-00'),
(140, 2, '14:50:00', 6, 6, '0000-00-00'),
(141, 2, '15:20:00', 5, 6, '0000-00-00'),
(142, 2, '15:50:00', 4, 6, '0000-00-00'),
(143, 2, '16:10:00', 3, 6, '0000-00-00'),
(144, 3, '23:00:00', 2, 6, '2022-12-30'),
(145, 2, '16:20:00', 2, 6, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table notification
--

CREATE TABLE notification (
  N_ID int(11) NOT NULL,
  N_AddDT datetime NOT NULL,
  N_Message mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  N_Read varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  N_ToUser int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table notification
--

INSERT INTO notification (N_ID, N_AddDT, N_Message, N_Read, N_ToUser) VALUES
(1, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(2, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(3, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(4, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(5, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(6, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(7, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(8, '2022-02-24 06:06:48', 'การชำระเงินหมายเลข #121 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(9, '2022-06-26 22:07:11', 'การชำระเงินหมายเลข #4 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 3),
(10, '2022-06-26 22:07:12', 'การชำระเงินหมายเลข #3 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้ารับตั๋ว ☺', 'false', 1),
(11, '2022-09-24 15:16:22', 'การชำระเงินหมายเลข #7 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้าตรวจสอบสถานะการจอง ☺', 'false', 4),
(12, '2022-09-24 15:16:31', 'การชำระเงินหมายเลข #16 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้าตรวจสอบสถานะการจอง ☺', 'false', 4),
(17, '2022-10-01 15:36:47', 'การชำระเงินหมายเลข #PAY25 เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้าตรวจสอบสถานะการจอง ☺', 'true', 28);

-- --------------------------------------------------------

--
-- Table structure for table otp
--

CREATE TABLE otp (
  OTP_ID int(11) NOT NULL,
  TimeToSend int(10) NOT NULL,
  TimeToOut int(10) NOT NULL,
  Refer varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  Number varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  OTP_Key varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  End_Key varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  ToPhone varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  User int(11) NOT NULL,
  Type int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table otp
--

INSERT INTO otp (OTP_ID, TimeToSend, TimeToOut, Refer, Number, OTP_Key, End_Key, ToPhone, User, Type) VALUES
(1, 1653289303, 1653290203, 'dkF2', '992482', 'epsDB2aaR37IMGBI2NvBWTHhMHfNLoCbwluXGwQ7jzoQ8y57Tm4SOa5glnnOoaKKAOGNt8xdArVR3yoHpvcEkm7Xl0VBqQBQLDJkuGdCOZkSm3WLK6I7Pstrff27n9bAqCVGh2wBTpvtdhTBg0iu5X', 'adabf5b424bb7ba827bc6eaf04865077fd88a2d01ad301f3455b67719009f07d83e7bb75888f5f8f14ba5b302bbd2be40b3c56aae48e8a633f980cf0510237f8', '0611230387', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table otp_type
--

CREATE TABLE otp_type (
  Type_ID int(11) NOT NULL,
  Type_Name varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table otp_type
--

INSERT INTO otp_type (Type_ID, Type_Name) VALUES
(1, 'ลืมรหัสผ่าน'),
(2, 'แก้ไขเบอร์โทรติดต่อ'),
(3, 'เข้าสู่ระบบ');

-- --------------------------------------------------------

--
-- Table structure for table payment
--

CREATE TABLE payment (
  Pay_ID int(11) NOT NULL,
  User_ID int(11) NOT NULL,
  Pay_DateTime datetime NOT NULL,
  Bank int(11) NOT NULL,
  Slip varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  Confirm varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  Note mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  Reserve_ID int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table payment
--

INSERT INTO payment (Pay_ID, User_ID, Pay_DateTime, Bank, Slip, Confirm, Note, Reserve_ID) VALUES
(2, 1, '2022-02-23 06:10:32', 2, 'U1R2B4.jpg', 'success', '', 2),
(4, 3, '2022-02-23 06:10:32', 2, 'U3R4B4.jpg', 'success', '', 4),
(5, 4, '2022-06-16 18:12:11', 2, 'U4R6B2.png', 'success', '', 5),
(6, 4, '2022-06-26 22:11:19', 4, 'U4R7B4.png', 'success', '', 6),
(7, 4, '2022-06-26 22:47:20', 4, 'U4R9B4.png', 'success', '', 7),
(9, 13, '2022-08-02 10:09:34', 3, 'U13R15B3.jfif', 'waiting', '', 15),
(10, 7, '2022-08-02 10:11:30', 4, 'U7R17B4.jpg', 'waiting', '', 17),
(11, 7, '2022-08-02 10:11:50', 1, 'U7R18B1.jpg', 'waiting', '', 18),
(13, 8, '2022-08-02 12:02:00', 1, 'U8R23B1.png', 'waiting', '', 23),
(14, 13, '2022-08-03 19:48:41', 1, 'U13R24B1.png', 'success', '', 24),
(15, 1, '2022-08-03 22:59:32', 2, 'U1R25B2.jpg', 'waiting', '', 25),
(16, 4, '2022-09-24 15:15:39', 2, 'U4R31B2.jpg', 'success', '', 31),
(17, 7, '2022-09-24 15:25:16', 1, 'U7R32B1.jpg', 'waiting', '', 32),
(18, 7, '2022-09-24 15:26:06', 1, 'U7R33B1.jpg', 'waiting', '', 33),
(19, 28, '2022-09-24 16:30:03', 2, 'U28R35B2.jpg', 'cancel', 'โกง', 35),
(20, 8, '2022-09-27 22:09:16', 1, 'U8R39B1.jpg', 'success', '', 39),
(21, 13, '2022-09-28 15:58:04', 1, 'U13R42B1.png', 'success', '', 42),
(22, 8, '2022-09-29 18:26:35', 1, 'U8R44B1.jpg', 'success', '', 44),
(23, 7, '2022-09-29 22:31:59', 1, 'U7R45B1.jpg', 'waiting', '', 45),
(24, 8, '2022-09-30 14:07:54', 1, 'U8R46B1.jpg', 'success', '', 46),
(25, 28, '2022-10-01 15:33:59', 2, 'U28R47B2.jpg', 'success', '', 47);

-- --------------------------------------------------------

--
-- Table structure for table reservation
--

CREATE TABLE reservation (
  Reserve_ID int(11) NOT NULL,
  Reserve_Code varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  User_ID int(11) NOT NULL,
  Re_Seate int(11) NOT NULL,
  Re_DateTime datetime NOT NULL,
  Re_TimeStamp int(11) NOT NULL,
  Go_Date date NOT NULL,
  Dock_car_id int(11) NOT NULL,
  Tic_Price_ID int(11) NOT NULL,
  Station_Start int(11) NOT NULL,
  Station_End int(11) NOT NULL,
  Total_Price int(11) NOT NULL,
  Status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table reservation
--

INSERT INTO reservation (Reserve_ID, Reserve_Code, User_ID, Re_Seate, Re_DateTime, Re_TimeStamp, Go_Date, Dock_car_id, Tic_Price_ID, Station_Start, Station_End, Total_Price, Status) VALUES
(2, 'V1230222', 1, 2, '2022-03-13 07:10:00', 1648903634, '2022-02-23', 1, 6, 1, 5, 140, 'confirm'),
(4, 'V1240222', 3, 12, '2022-03-14 07:10:00', 1648903634, '2022-02-24', 1, 6, 1, 6, 840, 'waiting'),
(5, 'V13010722', 4, 5, '2022-06-16 18:11:51', 1655377922, '2022-07-01', 13, 4, 1, 5, 275, 'confirm'),
(6, 'V61290622', 4, 3, '2022-06-26 22:11:14', 1656256275, '2022-06-29', 61, 4, 1, 5, 165, 'confirm'),
(7, 'V31270622', 4, 4, '2022-06-26 22:47:15', 1656258436, '2022-06-27', 31, 40, 7, 4, 200, 'confirm'),
(8, 'V121290722', 12, 12, '2022-07-28 01:44:35', 1658947483, '2022-07-29', 121, 4, 1, 5, 660, 'confirm'),
(9, 'V1300722', 16, 12, '2022-07-30 02:36:58', 1659123452, '2022-07-30', 1, 4, 1, 5, 660, 'confirm'),
(10, 'V97300722', 16, 7, '2022-07-30 13:57:11', 1659164231, '2022-07-30', 97, 4, 1, 5, 385, 'waiting'),
(11, 'V73300722', 16, 7, '2022-07-30 14:04:10', 1659164650, '2022-07-30', 73, 4, 1, 5, 385, 'waiting'),
(13, 'V133010822', 11, 1, '2022-08-01 11:12:17', 1659327137, '2022-08-01', 133, 1, 1, 2, 40, 'waiting'),
(15, 'V85020822', 13, 1, '2022-08-02 10:09:27', 1659409768, '2022-08-02', 85, 6, 1, 7, 70, 'confirm'),
(17, 'V73180822', 7, 4, '2022-08-02 10:11:24', 1659409886, '2022-08-18', 73, 3, 1, 4, 200, 'confirm'),
(18, 'V49120822', 7, 2, '2022-08-02 10:11:44', 1659409905, '2022-08-12', 49, 2, 1, 3, 90, 'confirm'),
(20, 'V91020822', 5, 1, '2022-08-02 10:15:08', 1659410110, '2022-08-02', 91, 39, 7, 3, 55, 'confirm'),
(21, 'V49170822', 5, 2, '2022-08-02 10:15:17', 1659410119, '2022-08-17', 49, 2, 1, 3, 90, 'confirm'),
(23, 'V43020822', 8, 3, '2022-08-02 12:01:46', 1659416507, '2022-08-02', 43, 40, 7, 4, 150, 'confirm'),
(24, 'V103280822', 13, 3, '2022-08-03 19:48:35', 1659530916, '2022-08-28', 103, 39, 7, 3, 165, 'confirm'),
(25, 'V25230822', 1, 4, '2022-08-03 22:59:26', 1659542367, '2022-08-23', 25, 4, 1, 5, 220, 'confirm'),
(26, 'V121050822', 1, 1, '2022-08-05 14:56:42', 1659686208, '2022-08-05', 121, 2, 1, 3, 45, 'confirm'),
(31, 'V73240922', 4, 1, '2022-09-24 15:05:59', 1664006786, '2022-09-24', 73, 1, 1, 2, 40, 'confirm'),
(32, 'V121240922', 7, 4, '2022-09-24 15:22:28', 1664007903, '2022-09-24', 121, 4, 1, 5, 220, 'confirm'),
(33, 'V97240922', 7, 2, '2022-09-24 15:25:54', 1664007958, '2022-09-24', 97, 3, 1, 4, 100, 'confirm'),
(35, 'V121240922', 28, 1, '2022-09-24 16:29:46', 1664011791, '2022-09-24', 121, 1, 1, 2, 40, 'confirm'),
(36, 'V73270922', 28, 1, '2022-09-26 23:28:12', 1664209696, '2022-09-27', 73, 1, 1, 2, 40, 'confirm'),
(39, 'V49290922', 8, 2, '2022-09-27 22:07:20', 1664291244, '2022-09-29', 49, 3, 1, 4, 100, 'confirm'),
(41, 'V1280922', 7, 12, '2022-09-27 23:21:24', 1664295687, '2022-09-28', 1, 6, 1, 7, 840, 'confirm'),
(42, 'V7290922', 13, 5, '2022-09-28 15:57:54', 1664355477, '2022-09-29', 7, 39, 7, 3, 275, 'confirm'),
(43, 'V121280922', 13, 7, '2022-09-28 16:10:15', 1664356215, '2022-09-28', 121, 5, 1, 6, 420, 'waiting'),
(44, 'V109300922', 8, 1, '2022-09-29 18:25:48', 1664450760, '2022-09-30', 109, 1, 1, 2, 40, 'confirm'),
(45, 'V1300922', 7, 1, '2022-09-29 22:31:21', 1664465484, '2022-09-30', 1, 6, 1, 7, 70, 'confirm'),
(46, 'V97300922', 8, 1, '2022-09-30 14:07:01', 1664521623, '2022-09-30', 97, 1, 1, 2, 40, 'confirm'),
(47, 'V133021022', 28, 1, '2022-10-01 15:32:54', 1664613199, '2022-10-02', 133, 3, 1, 4, 50, 'confirm');

-- --------------------------------------------------------

--
-- Table structure for table station
--

CREATE TABLE station (
  Station_ID int(11) NOT NULL,
  Station_Name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Landmark varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  Province varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  District varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  SubDistrict varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Lat double NOT NULL,
  Lng double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table station
--

INSERT INTO station (Station_ID, Station_Name, Landmark, Province, District, SubDistrict, Lat, Lng) VALUES
(1, 'นครปฐม (มาลัยแมน)', 'มหาวิทยาลัยศิลปากร', 'นครปฐม', 'เมืองนครปฐม', 'พระปฐมเจดีย์', 13.7877949, 99.9942832),
(2, 'บ้านโป่ง', 'ตลาดโต้รุ้ง', 'ราชบุรี', 'บ้านโป่ง', 'บ้านโป่ง', 13.8142498, 99.8738692),
(3, 'ลูกแก', 'ตลาดสดลูกแก', 'กาญจนบุรี', 'ท่ามะกา', 'ดอนขมิ้น', 13.868747, 99.82157),
(4, 'ท่าเรือ', 'ถนนตะคร้ำเอน', 'กาญจนบุรี', 'ท่ามะกา', 'ท่าเรือ', 13.9772007, 99.755129),
(5, 'ท่ามะกา', 'ซอยหนองหญ้าปล้อง', 'กาญจนบุรี', 'ท่ามะกา', 'ท่ามะกา', 13.9767574, 99.7282953),
(6, 'ท่าม่วง', 'ท่าตะคร้อ', 'กาญจนบุรี', 'ท่าล้อ', 'ท่าม่วง', 13.9606993, 99.707846),
(7, 'กาญจนบุรี (บขส.)', 'ข้างโรงแรมริเวอร์แคว', 'กาญจนบุรี', 'เมืองกาญจนบุรี', 'ปากแพรก', 13.8193085, 100.0598209);

-- --------------------------------------------------------

--
-- Table structure for table ticket
--

CREATE TABLE ticket (
  Tick_ID int(11) NOT NULL,
  Tick_GetDateTime datetime NOT NULL,
  Tick_Code varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  Pay_ID int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table ticket
--

INSERT INTO ticket (Tick_ID, Tick_GetDateTime, Tick_Code, Pay_ID) VALUES
(1, '2022-08-05 13:48:15', 'IV051580818422', 14),
(2, '2022-09-28 16:01:06', 'IV281580942222', 21);

-- --------------------------------------------------------

--
-- Table structure for table ticket_price
--

CREATE TABLE ticket_price (
  Tic_Price_ID int(11) NOT NULL,
  Station_Start int(11) NOT NULL,
  Station_End int(11) NOT NULL,
  Tic_Price float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table ticket_price
--

INSERT INTO ticket_price (Tic_Price_ID, Station_Start, Station_End, Tic_Price) VALUES
(1, 1, 2, 40),
(2, 1, 3, 45),
(3, 1, 4, 50),
(4, 1, 5, 55),
(5, 1, 6, 60),
(6, 1, 7, 70),
(7, 2, 3, 40),
(8, 2, 4, 45),
(9, 2, 5, 50),
(10, 2, 6, 55),
(11, 2, 7, 60),
(12, 2, 1, 100),
(13, 3, 4, 40),
(14, 3, 5, 45),
(15, 3, 6, 50),
(16, 3, 7, 55),
(17, 3, 1, 90),
(18, 3, 2, 85),
(19, 4, 5, 40),
(20, 4, 6, 45),
(21, 4, 7, 50),
(22, 4, 1, 85),
(23, 4, 2, 80),
(24, 4, 3, 75),
(25, 5, 6, 40),
(26, 5, 7, 45),
(27, 5, 1, 80),
(28, 5, 2, 75),
(29, 5, 3, 70),
(30, 5, 4, 60),
(31, 6, 7, 40),
(32, 6, 1, 75),
(33, 6, 2, 70),
(34, 6, 3, 60),
(35, 6, 4, 55),
(36, 6, 5, 50),
(37, 7, 1, 70),
(38, 7, 2, 60),
(39, 7, 3, 55),
(40, 7, 4, 50),
(41, 7, 5, 45),
(42, 7, 6, 40);

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  User_ID int(11) NOT NULL,
  F_Name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  L_Name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Email varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Pass varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  Phone varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  Pic varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Facebook varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  Pos_ID int(11) NOT NULL,
  Last_Login int(11) DEFAULT NULL,
  Reg_Date int(11) NOT NULL,
  Last_Update int(11) DEFAULT NULL,
  IP_Address varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table users
--

INSERT INTO users (User_ID, F_Name, L_Name, Email, Pass, Phone, Pic, Facebook, Pos_ID, Last_Login, Reg_Date, Last_Update, IP_Address) VALUES
(1, 'สมจิตร', 'สระแก้ว', 'user@hotmail.com', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0123456789', '1.jpg', NULL, 1, 1664718881, 1623839074, 1659022488, '171.5.216.14'),
(2, 'น้ำทัพย์', 'จันทร์ทรา', 'driver@hotmail.com', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0123456789', '2.jpg', NULL, 2, 1623839074, 1623839074, NULL, '127.0.0.1'),
(3, 'สมัย', 'ใจหล่อ', 'officer@hotmail.com', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0123456789', '3.jpg', NULL, 3, 1623839074, 1623839074, NULL, '127.0.0.1'),
(4, 'ธรรมรงค์', 'โยกใหญ่', 'admin@hotmail.com', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0123456789', '4.jpg', NULL, 4, 1664006452, 1623839074, 1655703729, '223.206.136.38'),
(5, 'บุปผาชล', 'สุวรรณวิสุทธิ์', '624259018@webmail.npru.ac.th', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0624074699', '5.jpg', NULL, 4, 1664613350, 1623839074, 1659410138, '223.204.35.69'),
(6, 'ศรัณย์', 'เวียงสิมมา', '624259027@webmail.npru.ac.th', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0809190755', '7.jpg', NULL, 2, 1664728219, 1623839074, 1659161274, '171.5.216.14'),
(7, 'ศิริชัย', 'บุตรเพ็ง', '624259028@webmail.npru.ac.th', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0952419415', '7.jpg', NULL, 4, 1664769253, 1623839074, 1659409873, '184.22.15.16'),
(8, 'สุพัตตา', 'อยู่พิพัฒน์', '624259031@webmail.npru.ac.th', '$2y$10$GvumYll5HRknF1Z4hRIEPeU7MqX6mxn4aYsuo0d2FnJx71dRFn/.6', '0877216351', '8.jpg', NULL, 4, 1664709259, 1623839074, 1659416332, '1.46.154.7'),
(9, 'มนัญพร', 'แซ่ลิ้ม', 'kwan_zanaza@hotmail.com', NULL, NULL, '', '1901132760093057', 2, 1659001427, 1658947130, NULL, '127.0.0.1'),
(10, 'Phob', 'Riley', 'sirapob19191@hotmail.com', NULL, NULL, '', '2936456076500731', 2, 1658947405, 1658947405, NULL, '127.0.0.1'),
(11, 'Prapassorn', 'Lohcharoen', 'keroro.089@hotmail.com', NULL, NULL, '', '2702581509873023', 2, 1659326951, 1658981304, NULL, '101.108.116.66'),
(12, 'Non', 'Khumyaito', '624259006@webmail.npru.ac.th', NULL, '0948123801', '', '1375204162971720', 4, 1664718884, 1659001631, 1659001773, '124.121.173.1'),
(13, 'Saran', 'Wringsimma', 'singtopza@hotmail.com', NULL, '0611230387', '', '3213621535622473', 4, 1664725456, 1659021793, 1661951841, '171.5.216.14'),
(14, "Evil\'Night", 'CH', 'evilnightch@gmail.com', NULL, NULL, '', '116335414480064', 1, 1659103197, 1659103197, NULL, '127.0.0.1'),
(15, '蜜蜂', '陳まと', 'beekung.video.ch@hotmail.com', NULL, NULL, '', '195756566124580', 1, 1659104683, 1659104683, NULL, '127.0.0.1'),
(16, 'ชวนันท์', 'แสนภักดี', 'chawanan.sanpakdee@gmail.com', NULL, NULL, '', '601365171343449', 1, 1659106826, 1659106826, NULL, '127.0.0.1'),
(17, 'Sompob', 'Memongkol', 'sompob16@hotmail.com', NULL, NULL, '', '2908104659334814', 1, 1659108894, 1659108894, NULL, '127.0.0.1'),
(18, 'Oum', 'Distapanya', 'ibizshops9033@gmail.com', NULL, NULL, '', '1077210379899577', 1, 1659122449, 1659122449, NULL, '127.0.0.1'),
(19, 'Alip', 'Salam', 'alip42463@gmail.com', NULL, NULL, '', '1512202352553106', 1, 1659315976, 1659315976, NULL, '1.46.5.251'),
(20, 'Wisit', 'Kraisin Tum', 'big387584@gmail.com', NULL, NULL, '', '790120655355592', 1, 1659441895, 1659441895, NULL, '184.22.69.214'),
(21, 'Nuu', 'Supatta', 'kiseryota482@gmail.com', NULL, NULL, '', '3148668308728524', 1, 1659519427, 1659519427, NULL, '1.46.139.203'),
(23, 'C', 'Sirichai', 'champ415514@gmail.com', NULL, NULL, '', '3393349624228100', 1, 1659520737, 1659520511, NULL, '184.22.22.90'),
(24, 'วัชระ ', 'วันเกิด', 'watcharawankerd123@gmail.com', '$2y$10$8UWGGowr./T1YIL73.FKmeJUOUVzOpkjOLTQU82la2uuUohnPW/dS', '0989084115', '', NULL, 2, 1659520995, 1659520981, NULL, '14.207.117.228'),
(25, 'พัทธดนย์', 'วุฒาพาณิชย์', 'lazadon12@gmail.com', NULL, NULL, '', '151397854164071', 1, 1659530788, 1659530788, NULL, '1.47.129.147'),
(26, 'Kar', 'Kanokphon', 'kanokphon.kar2017@hotmail.com', NULL, NULL, '', '1021576795208932', 1, 1659606404, 1659603900, NULL, '49.48.199.65'),
(27, 'Tai', 'Ratcharote', 'tayneedanime@gmail.com', NULL, NULL, '', '1811653492521743', 1, 1661946686, 1661946686, NULL, '27.55.68.123'),
(28, 'Bubpachol', 'sws', 'tan123@gmail.com', '$2y$10$fBmCoNe5sb3tKBrAI1I.LeMxJRBGpRwihFwP9kWikb5gjetBvP6B2', '0616093620', '', NULL, 1, 1664613398, 1664009155, NULL, '223.204.35.69');

-- --------------------------------------------------------

--
-- Table structure for table u_position
--

CREATE TABLE u_position (
  Pos_ID int(11) NOT NULL,
  Pos_Name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Pos_Name_TH varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table u_position
--

INSERT INTO u_position (Pos_ID, Pos_Name, Pos_Name_TH) VALUES
(1, 'Customer', 'ลูกค้า'),
(2, 'Driver', 'พนักงานขับ'),
(3, 'Officer', 'พนักงานขายตั๋ว'),
(4, 'Admin', 'ผู้ดูแล');

-- --------------------------------------------------------

--
-- Table structure for table van
--

CREATE TABLE van (
  Van_ID int(11) NOT NULL,
  Driver_ID int(11) NOT NULL,
  Van_Num varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Plate varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  Seats_Num int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table van
--

INSERT INTO van (Van_ID, Driver_ID, Van_Num, Plate, Seats_Num) VALUES
(1, 2, 'ม.1(ด)/77-56', 'กข2552', 12),
(2, 6, 'ม.2(จ)/81-98', 'ตก1551', 12),
(3, 9, 'ม.3(จ)/41-11', 'งง9984', 12),
(4, 10, 'ม.4(พ)/65-15', 'ลบ5411', 12),
(5, 11, 'ม.5(จ)/98-87', 'หด1137', 12),
(6, 2, 'ม.6(จ)/23-46', 'นม6446', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table bank_list
--
ALTER TABLE bank_list
  ADD PRIMARY KEY (bank_ID);

--
-- Indexes for table complaint
--
ALTER TABLE complaint
  ADD PRIMARY KEY (Com_ID),
  ADD KEY Com_Type_ID (Com_Type_ID);

--
-- Indexes for table complaint_type
--
ALTER TABLE complaint_type
  ADD PRIMARY KEY (Com_Type_ID);

--
-- Indexes for table dock_car
--
ALTER TABLE dock_car
  ADD PRIMARY KEY (Dock_car_id),
  ADD KEY Van_ID (Van_ID,Station_ID),
  ADD KEY fk_dock_car_station_id (Station_ID);

--
-- Indexes for table notification
--
ALTER TABLE notification
  ADD PRIMARY KEY (N_ID),
  ADD KEY N_ToUser (N_ToUser);

--
-- Indexes for table otp
--
ALTER TABLE otp
  ADD PRIMARY KEY (OTP_ID),
  ADD KEY User (User,Type),
  ADD KEY fk_otp_type (Type);

--
-- Indexes for table otp_type
--
ALTER TABLE otp_type
  ADD PRIMARY KEY (Type_ID);

--
-- Indexes for table payment
--
ALTER TABLE payment
  ADD PRIMARY KEY (Pay_ID),
  ADD KEY User_ID (User_ID,Reserve_ID),
  ADD KEY fk_payment_bank_id (Bank),
  ADD KEY fk_payment_reserve_id (Reserve_ID);

--
-- Indexes for table reservation
--
ALTER TABLE reservation
  ADD PRIMARY KEY (Reserve_ID),
  ADD KEY User_ID (User_ID,Dock_car_id,Tic_Price_ID,Station_Start,Station_End),
  ADD KEY fk_reserva_duck_car_id (Dock_car_id),
  ADD KEY fk_reserva_tic_price_id (Tic_Price_ID),
  ADD KEY fk_reserva_station_start (Station_Start),
  ADD KEY fk_reserva_station_end (Station_End);

--
-- Indexes for table station
--
ALTER TABLE station
  ADD PRIMARY KEY (Station_ID);

--
-- Indexes for table ticket
--
ALTER TABLE ticket
  ADD PRIMARY KEY (Tick_ID),
  ADD KEY Pay_ID (Pay_ID);

--
-- Indexes for table ticket_price
--
ALTER TABLE ticket_price
  ADD PRIMARY KEY (Tic_Price_ID),
  ADD KEY Station_Start (Station_Start,Station_End),
  ADD KEY fk_station_end (Station_End);

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (User_ID),
  ADD KEY Pos_ID (Pos_ID);

--
-- Indexes for table u_position
--
ALTER TABLE u_position
  ADD PRIMARY KEY (Pos_ID);

--
-- Indexes for table van
--
ALTER TABLE van
  ADD PRIMARY KEY (Van_ID),
  ADD KEY Driver_ID (Driver_ID);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table bank_list
--
ALTER TABLE bank_list
  MODIFY bank_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table complaint
--
ALTER TABLE complaint
  MODIFY Com_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table complaint_type
--
ALTER TABLE complaint_type
  MODIFY Com_Type_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table dock_car
--
ALTER TABLE dock_car
  MODIFY Dock_car_id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table notification
--
ALTER TABLE notification
  MODIFY N_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table otp
--
ALTER TABLE otp
  MODIFY OTP_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table otp_type
--
ALTER TABLE otp_type
  MODIFY Type_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table payment
--
ALTER TABLE payment
  MODIFY Pay_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table reservation
--
ALTER TABLE reservation
  MODIFY Reserve_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table station
--
ALTER TABLE station
  MODIFY Station_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table ticket
--
ALTER TABLE ticket
  MODIFY Tick_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table ticket_price
--
ALTER TABLE ticket_price
  MODIFY Tic_Price_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY User_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table van
--
ALTER TABLE van
  MODIFY Van_ID int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table complaint
--
ALTER TABLE complaint
  ADD CONSTRAINT fk_complaint_com_type_id FOREIGN KEY (Com_Type_ID) REFERENCES complaint_type (Com_Type_ID) ON DELETE CASCADE;

--
-- Constraints for table dock_car
--
ALTER TABLE dock_car
  ADD CONSTRAINT fk_dock_car_station_id FOREIGN KEY (Station_ID) REFERENCES station (Station_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_dock_car_van_id FOREIGN KEY (Van_ID) REFERENCES van (Van_ID) ON DELETE CASCADE;

--
-- Constraints for table notification
--
ALTER TABLE notification
  ADD CONSTRAINT fk_notification_user_id FOREIGN KEY (N_ToUser) REFERENCES `users` (User_ID) ON DELETE CASCADE;

--
-- Constraints for table otp
--
ALTER TABLE otp
  ADD CONSTRAINT fk_otp_type FOREIGN KEY (Type) REFERENCES otp_type (Type_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_otp_user FOREIGN KEY (User) REFERENCES `users` (User_ID) ON DELETE CASCADE;

--
-- Constraints for table payment
--
ALTER TABLE payment
  ADD CONSTRAINT fk_payment_bank_id FOREIGN KEY (Bank) REFERENCES bank_list (bank_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_payment_reserve_id FOREIGN KEY (Reserve_ID) REFERENCES reservation (Reserve_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_payment_user_id FOREIGN KEY (User_ID) REFERENCES `users` (User_ID) ON DELETE CASCADE;

--
-- Constraints for table reservation
--
ALTER TABLE reservation
  ADD CONSTRAINT fk_reserva_duck_car_id FOREIGN KEY (Dock_car_id) REFERENCES dock_car (Dock_car_id) ON DELETE CASCADE,
  ADD CONSTRAINT fk_reserva_station_end FOREIGN KEY (Station_End) REFERENCES station (Station_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_reserva_station_start FOREIGN KEY (Station_Start) REFERENCES station (Station_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_reserva_tic_price_id FOREIGN KEY (Tic_Price_ID) REFERENCES ticket_price (Tic_Price_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_reserva_user_id FOREIGN KEY (User_ID) REFERENCES `users` (User_ID) ON DELETE CASCADE;

--
-- Constraints for table ticket
--
ALTER TABLE ticket
  ADD CONSTRAINT fk_ticket_pay_id FOREIGN KEY (Pay_ID) REFERENCES payment (Pay_ID) ON DELETE CASCADE;

--
-- Constraints for table ticket_price
--
ALTER TABLE ticket_price
  ADD CONSTRAINT fk_station_end FOREIGN KEY (Station_End) REFERENCES station (Station_ID) ON DELETE CASCADE,
  ADD CONSTRAINT fk_station_start FOREIGN KEY (Station_Start) REFERENCES station (Station_ID) ON DELETE CASCADE;

--
-- Constraints for table users
--
ALTER TABLE users
  ADD CONSTRAINT fk_users_Pos_ID FOREIGN KEY (Pos_ID) REFERENCES u_position (Pos_ID) ON DELETE CASCADE;

--
-- Constraints for table van
--
ALTER TABLE van
  ADD CONSTRAINT fk_van_emp_id FOREIGN KEY (Driver_ID) REFERENCES `users` (User_ID) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
