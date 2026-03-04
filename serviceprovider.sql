-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2026 at 08:25 AM
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
-- Database: `serviceprovider`
--

-- --------------------------------------------------------

--
-- Table structure for table `smsforotp`
--

CREATE TABLE `smsforotp` (
  `id` int(11) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `smsString` text NOT NULL,
  `otpNumber` varchar(10) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `dateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smsforotp`
--

INSERT INTO `smsforotp` (`id`, `mobileNumber`, `smsString`, `otpNumber`, `status`, `dateCreated`) VALUES
(1, '639153953621', 'Your OTP for password reset is: 221940', '221940', 1, '2026-02-18 18:43:16'),
(2, '639153953621', 'Your OTP for password reset is: 955080', '955080', 2, '2026-02-18 18:50:02'),
(3, '639911460732', 'Your OTP for password reset is: 171517', '171517', 2, '2026-02-18 19:05:55'),
(4, '639153953621', 'Your OTP is: 978967', '978967', 0, '2026-02-19 11:08:52'),
(5, '639911460732', 'Your OTP for password reset is: 431793', '431793', 2, '2026-02-21 19:16:09'),
(6, '639153953621', 'Your OTP for password reset is: 581151', '581151', 2, '2026-02-25 13:00:13'),
(7, '639153953621', 'Your OTP for password reset is: 747640', '747640', 2, '2026-02-25 14:48:57'),
(8, '639153953621', 'Your OTP for password reset is: 499156', '499156', 2, '2026-02-25 14:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `id` int(11) NOT NULL,
  `eMail` varchar(100) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `dateCreated` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`id`, `eMail`, `mobileNumber`, `passwd`, `dateCreated`, `status`) VALUES
(1, 'richellebeltran7@gmail.com', '639153953621', '$2y$10$e.SbrAjQ5WHzntUgKjLo4ObUorxxs04vm5VWSnZx/qhh6ae.NLczi', '2026-02-18 18:00:22', 'active'),
(2, 'richellebeltran@gmail.com', '639153953620', '$2y$10$h1TrPJdFKqg7jiY0V.GnEeeDz57bpsQ6r.ghdcezDFvgG7sKWoJyu', '2026-02-18 18:36:08', 'active'),
(3, 'beltranrichele@gmail.com', '639911460732', '$2y$10$t6oHbtxXCnnOE3OiFpc3wOGIQ/8N0GAMhleAEQlYfnHGUtd4WbQVq', '2026-02-18 19:04:00', 'active'),
(4, 'richelle@gmail.com', '639153953629', '$2y$10$Qlrc/2cPHfQMuR9LimeRyuC9MxUyREFFnzgx6tVFdk5OTxERTMQ3S', '2026-02-19 11:16:46', 'active'),
(5, 'richele@gmail.com', '639123456789', '$2y$10$sqDnAW3mhzzi3Bdey8RbG.WpHxfchlfJV5zodNYiZ0Cx3q2Ih8lkm', '2026-02-19 12:32:47', 'active'),
(6, 'r@gmail.com', '639123456780', '$2y$10$XjuTS31CAm5jPLMowQgyOu0iBAncqPP6XLwycVBnybxpS53jGqsEe', '2026-02-21 20:00:23', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smsforotp`
--
ALTER TABLE `smsforotp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eMail` (`eMail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smsforotp`
--
ALTER TABLE `smsforotp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
