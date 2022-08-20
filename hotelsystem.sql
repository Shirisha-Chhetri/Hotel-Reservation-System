-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 08:43 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ADMIN_ID` int(11) NOT NULL,
  `FULLNAME` varchar(40) DEFAULT NULL,
  `PHONE` bigint(10) DEFAULT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ADMIN_ID`, `FULLNAME`, `PHONE`, `USERNAME`, `PASSWORD`, `EMAIL`) VALUES
(1, 'Shirisha Chhetri', 9809876543, 'Admin', 'YWRtaW4=', 'shirischhe87@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cancellations`
--

CREATE TABLE `cancellations` (
  `CANCEL_ID` int(30) NOT NULL,
  `RESERVATION_ID` int(11) NOT NULL,
  `CANCELLED_DATE` date NOT NULL,
  `PAID_AMOUNT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancellations`
--

INSERT INTO `cancellations` (`CANCEL_ID`, `RESERVATION_ID`, `CANCELLED_DATE`, `PAID_AMOUNT`) VALUES
(2, 134, '2022-04-26', 4000),
(3, 135, '2022-08-19', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CUS_ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(20) DEFAULT NULL,
  `LASTNAME` varchar(20) DEFAULT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CUS_ID`, `FIRSTNAME`, `LASTNAME`, `USERNAME`, `PASSWORD`, `EMAIL`) VALUES
(15, 'Shirisha', 'Chhetri', 'Shirisha', 'c2hpcmlzaGE=', 'shirischhe87@gmail.com'),
(16, 'Niharika', 'Ghimire', 'Niharika', 'bmloYXJpa2E=', 'niharika@gmail.com'),
(17, 'Sachita', 'Ghimire', 'Sachita', 'c2FjaGl0YQ==', 'sachita122@yahoo.com'),
(18, 'Sujita', 'Thapa', 'Sujita', 'c3VqaXRh', 'sujita12@yahoo.com'),
(19, 'Sameer', 'Chhetri', 'Sameer', 'c2FtZWVy', 'chhetrisameer11@gmail.com'),
(20, 'Krishna', 'BK', 'Krishna', 'a3Jpc2huYQ==', 'bkkrishna@gmail.com'),
(24, 'Chan', 'Bang', 'BangChan', 'YmFuZ2NoYW4=', 'bangchabn78@outlook.com');

-- --------------------------------------------------------

--
-- Table structure for table `gallerys`
--

CREATE TABLE `gallerys` (
  `IMG_ID` int(11) NOT NULL,
  `IMAGE1` varchar(300) DEFAULT NULL,
  `IMAGE2` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallerys`
--

INSERT INTO `gallerys` (`IMG_ID`, `IMAGE1`, `IMAGE2`) VALUES
(21, 'fountain.jpg', 'vase2.jpg'),
(22, 'pool.jpg', 'food2.jpg'),
(24, 'r2.jpg', 'food1.jpg'),
(25, 'g1.jpg', 'r3.jpg'),
(26, 'family2.jpg', 'sit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `RES_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `CONTACT` bigint(10) NOT NULL,
  `ADDRESS` varchar(20) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `ROOM_ID` int(11) NOT NULL,
  `NUMBER_OF_ROOMS` int(30) NOT NULL,
  `CHECK_IN` date NOT NULL,
  `PAID_AMOUNT` bigint(20) NOT NULL,
  `TRANSACTION_ID` varchar(50) NOT NULL,
  `RESERVED_DATE` date NOT NULL,
  `STATUS` int(11) NOT NULL COMMENT '1=reserved,\r\n2=cancelled/checked_out'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`RES_ID`, `CUSTOMER_ID`, `CONTACT`, `ADDRESS`, `GENDER`, `DOB`, `ROOM_ID`, `NUMBER_OF_ROOMS`, `CHECK_IN`, `PAID_AMOUNT`, `TRANSACTION_ID`, `RESERVED_DATE`, `STATUS`) VALUES
(132, 15, 9809876543, 'Sanothimi', 'female', '1994-02-02', 31, 3, '2021-09-25', 21000, 'card_1JcUu0SAqwIwgmCpbbMPfwVz', '2021-09-22', 2),
(133, 16, 9807876543, 'KTM', 'female', '1991-01-29', 31, 2, '2022-04-28', 20000, 'card_1KsmCmSAqwIwgmCpGoSL1mo9', '2022-04-26', 1),
(134, 16, 9807876543, 'KTM', 'female', '1993-06-08', 31, 1, '2022-04-30', 15000, 'card_1KsmGiSAqwIwgmCpujSRMUfB', '2022-04-26', 0),
(135, 15, 9809888011, 'saewee', 'female', '1992-07-08', 31, 1, '2022-08-22', 7000, 'card_1LYU3lSAqwIwgmCpir3w5z77', '2022-08-19', 0),
(136, 18, 9809888011, 'Lalitpur', 'female', '1997-06-24', 31, 2, '2022-08-23', 20000, 'card_1LYU77SAqwIwgmCpypoBxlCW', '2022-08-19', 1),
(137, 24, 9809888011, 'Baneshwor', 'male', '1996-12-30', 31, 2, '2022-08-30', 14000, 'card_1LYlE8SAqwIwgmCpXhlqbgvr', '2022-08-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservations_rooms`
--

CREATE TABLE `reservations_rooms` (
  `ID` int(11) NOT NULL,
  `RESERVATION_ID` int(11) DEFAULT NULL,
  `ROOM_ID` int(11) DEFAULT NULL,
  `NO_OF_ROOM` int(11) NOT NULL,
  `CHECKOUT_ROOM` varchar(25) NOT NULL,
  `CHECKOUT_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations_rooms`
--

INSERT INTO `reservations_rooms` (`ID`, `RESERVATION_ID`, `ROOM_ID`, `NO_OF_ROOM`, `CHECKOUT_ROOM`, `CHECKOUT_DATE`) VALUES
(37, 132, 31, 3, 'R126  ', '2021-09-27'),
(38, 132, 31, 3, 'R142  ', '2021-09-27'),
(39, 132, 31, 3, 'R117  ', '2022-04-26'),
(40, 136, 31, 2, 'R131  ', '2022-08-19'),
(41, 137, 31, 2, 'R105  ', '2022-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `ROOM_ID` int(20) NOT NULL,
  `ROOM_TYPE` varchar(30) NOT NULL,
  `PRICE` bigint(20) NOT NULL,
  `TOTAL_ROOM` int(11) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `IMAGE1` varchar(300) NOT NULL,
  `IMAGE2` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`ROOM_ID`, `ROOM_TYPE`, `PRICE`, `TOTAL_ROOM`, `DESCRIPTION`, `IMAGE1`, `IMAGE2`, `reg_date`) VALUES
(31, 'Deluxe Suite Room', 20000, 15, 'Super King 203 X 203 cm', '9.jpg', '13.jpg', '2021-09-19 11:22:38'),
(32, 'Suite Room', 15000, 20, 'King 200 X 200 cm', '14.jpg', '8.jpg', '2021-09-19 11:22:26'),
(42, 'Twin Room', 10000, 20, 'Long Single 92 X 203 cm', '6.jpg', '3.jpg', '2021-09-19 11:21:59'),
(43, 'Double Room', 7000, 25, 'Double 138 X 187 cm', 'r3.jpg', 'r5.jpg', '2021-09-19 11:13:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `cancellations`
--
ALTER TABLE `cancellations`
  ADD PRIMARY KEY (`CANCEL_ID`),
  ADD KEY `RESERVATION_ID` (`RESERVATION_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CUS_ID`);

--
-- Indexes for table `gallerys`
--
ALTER TABLE `gallerys`
  ADD PRIMARY KEY (`IMG_ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`RES_ID`),
  ADD KEY `ROOM_ID` (`ROOM_ID`),
  ADD KEY `CUSTOMER_ID` (`CUSTOMER_ID`);

--
-- Indexes for table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ROOM_ID` (`ROOM_ID`),
  ADD KEY `RESERVATION_ID` (`RESERVATION_ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ROOM_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cancellations`
--
ALTER TABLE `cancellations`
  MODIFY `CANCEL_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CUS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gallerys`
--
ALTER TABLE `gallerys`
  MODIFY `IMG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `RES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `ROOM_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cancellations`
--
ALTER TABLE `cancellations`
  ADD CONSTRAINT `cancellations_ibfk_1` FOREIGN KEY (`RESERVATION_ID`) REFERENCES `reservations` (`RES_ID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`ROOM_ID`) REFERENCES `rooms` (`ROOM_ID`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customers` (`CUS_ID`);

--
-- Constraints for table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  ADD CONSTRAINT `reservations_rooms_ibfk_1` FOREIGN KEY (`ROOM_ID`) REFERENCES `rooms` (`ROOM_ID`),
  ADD CONSTRAINT `reservations_rooms_ibfk_2` FOREIGN KEY (`RESERVATION_ID`) REFERENCES `reservations` (`RES_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
