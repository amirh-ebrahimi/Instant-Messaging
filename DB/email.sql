-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2019 at 06:55 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_agent` varchar(300) COLLATE utf8_bin NOT NULL,
  `value` varchar(300) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `ID` int(100) NOT NULL,
  `subject` varchar(20) COLLATE utf8_bin NOT NULL,
  `email_from` varchar(40) COLLATE utf8_bin NOT NULL,
  `email_to` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `details` text COLLATE utf8_bin DEFAULT NULL,
  `seen_status` tinyint(1) NOT NULL,
  `file_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`ID`, `subject`, `email_from`, `email_to`, `details`, `seen_status`, `file_id`) VALUES
(1, 'Salam', 'amirhossein.ebrahimi@maktab.ir', 'ali.paknahad@maktab.ir', 'Hello! This is a test email without attachment', 1, NULL),
(2, 'Re: Hello', 'ali.paknahad@maktab.ir', 'amirhossein.ebrahimi@maktab.ir', 'This is a Reply to test with attachment file', 1, 1),
(3, 'Re: Hello', 'ali.paknahad@maktab.ir', 'salman.khosravy@maktab.ir', 'This is a Reply to test with attachment file', 1, 1),
(4, 'Test', 'ali.paknahad@maktab.ir', 'amirhossein.ebrahimi@maktab.ir', 'This is a Test without a file', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_attempts`
--

CREATE TABLE `failed_attempts` (
  `ID` int(100) NOT NULL,
  `IP` varchar(250) COLLATE utf8_bin NOT NULL,
  `time` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `ID` int(100) NOT NULL,
  `addr` varchar(50) COLLATE utf8_bin NOT NULL,
  `checksum` varchar(120) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`ID`, `addr`, `checksum`) VALUES
(1, '../files/Attachments/11.pdf', 'c899c4e74bb0fc0ee05f3a150188e0f7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(100) NOT NULL,
  `username` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `city` varchar(45) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `family` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `city`, `email`, `name`, `family`) VALUES
(1, 'amirhossein.ebrahimi', '$2y$10$3mTc0tCi8F/xjgFJBVZWB.Yb.H0Pz65en4BD67qhGN.mAKuCND1DO', 'Tehran', 'amirhossein.ebrahimi@maktab.ir', 'amirhossein', 'ebrahimi'),
(2, 'ali.paknahad', '$2y$10$tVu9kZ.eiXuEIYNhanGloONUCZCvhPcDXlYcqUuscs1U.f0XPzfpG', 'Tehran', 'ali.paknahad@maktab.ir', 'ali', 'pknahad'),
(3, 'salman.khosravy', '$2y$10$HDYM9AP.sqpJmYA3qaYrjuZr.dn.8LTs5XPDCiBc.fRssN8LCr/Pa', 'Khomein', 'salman.khosravy@maktab.ir', 'salman', 'khosravy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `file_id_fk` (`file_id`);

--
-- Indexes for table `failed_attempts`
--
ALTER TABLE `failed_attempts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_attempts`
--
ALTER TABLE `failed_attempts`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cookies`
--
ALTER TABLE `cookies`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `file_id_fk` FOREIGN KEY (`file_id`) REFERENCES `files` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
