-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 10:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `class_teacher` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`user_id`, `full_name`, `email`, `password`, `class_teacher`) VALUES
(29, 'Jelena P', 'jelena@skolers.org', '$2y$10$Rnjfbh2GrB9Hl6ZYZtFfgOL7OB3RwlS9CqQWmAfsm8z5C8RpeY3nK', 'Izaberi ra'),
(30, 'Saška Vilić', 'saska.vilic@gmail.com', '$2y$10$I40YIWHd3.EG1boFadjanOUhtiBk5ZoYX81F.hM3yqVbw7Fg.xcDW', 'IV4'),
(31, 'Dragana Ili', 'gaga@gmail.com', 'ff01bba597cb80047eb8e7926ecaa016', 'IV5'),
(34, 'Dusan Ivkovic', 'dusan@skolers.org', '$2y$10$oaB.dqK1T00frKBcliv03ex0NKcosjPaA.Vj2iF6jqcard/X9ortW', 'IV2'),
(36, 'Adrijana Sarcevic', 'adrijana@skolers.org', '$2y$10$hycTEUxiZzglYQ/cXZLv1emRGs7KtVWerCyD5y8ViJZMpvGciKdei', 'VII2'),
(37, 'Natasa Z', 'natasa@skolers.org', '$2y$10$wZb9lSZxc3D7T9.7hAPLcuI0cpbkLQwuwgT3jvQg6UUGFFWb6ZN2y', 'IV2'),
(42, 'Despot Subic', 'despot@skolers.org', '$2y$10$Mrpecn8Jum0uQRFYYgtBO.TS7JdZMkEhM/cVWJqFz9sbzeHcmAizK', 'III5'),
(43, 'Zorana Miljkovic', 'zorana@skolers.org', '$2y$10$WXfddQd06C6axlAiptO0buBfhUbdQAg0yN6Zxs26z3NjLyokHppO6', '');

-- --------------------------------------------------------

--
-- Table structure for table `testes`
--

CREATE TABLE `testes` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `class` varchar(10) NOT NULL,
  `test_type` varchar(10) NOT NULL,
  `termin` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testes`
--

INSERT INTO `testes` (`id`, `subject`, `class`, `test_type`, `termin`, `user_id`) VALUES
(37, 'Njemački jezik', 'VII4', 'kontrolni', '2024-08-14', 43),
(51, 'Priroda i društvo', 'VII2', 'pismeni', '2024-09-27', 36),
(52, 'Priroda i društvo', 'IV2', 'kontrolni', '2024-09-06', 36),
(53, 'Moja okolina', 'III1', 'kontrolni', '2024-09-07', 36),
(54, 'Digitalni svijet', 'VII2', 'pismeni', '2024-09-26', 36),
(76, 'Osnovi informatike', 'VII1', 'pismeni', '2024-09-03', 34),
(77, 'Osnovi informatike', 'VII2', 'kontrolni', '2024-08-27', 34),
(80, 'Moja okolina', 'III2', 'kontrolni', '2024-09-04', 34),
(82, 'Osnovi informatike', 'IX1', 'kontrolni', '2024-09-26', 34),
(83, 'Osnovi informatike', 'IX2', 'kontrolni', '2024-09-26', 34),
(84, 'Osnovi informatike', 'IX3', 'kontrolni', '2024-09-26', 34),
(85, 'Osnovi informatike', 'IX4', 'kontrolni', '2024-10-03', 34),
(86, 'Digitalni svijet', 'VII2', 'kontrolni', '2024-08-27', 34),
(128, 'Moja okolina', 'III5', 'kontrolni', '2024-10-12', 42),
(137, 'Srpski jezik', 'IV4', 'pismeni', '2024-08-15', 30),
(143, 'Priroda i društvo', 'IV4', 'kontrolni', '2024-10-12', 30),
(144, 'Moja okolina', 'IV4', 'kontrolni', '2024-10-10', 30),
(145, 'Osnovi informatike', 'IV1', 'pismeni', '2024-08-15', 30),
(146, 'Osnovi informatike', 'IV3', 'pismeni', '2024-08-15', 30),
(147, 'Osnovi informatike', 'IV4', 'pismeni', '2024-08-15', 30),
(148, 'Hemija', 'IV4', 'kontrolni', '2024-07-11', 30),
(149, 'Moja okolina', 'IV4', 'pismeni', '2024-09-02', 30),
(151, 'Srpski jezik', 'IV2', 'kontrolni', '2024-10-11', 34),
(152, 'Moja okolina', 'IV4', 'pismeni', '2024-09-19', 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `testes`
--
ALTER TABLE `testes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TeacherId` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `testes`
--
ALTER TABLE `testes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `testes`
--
ALTER TABLE `testes`
  ADD CONSTRAINT `FK_TeacherId` FOREIGN KEY (`user_id`) REFERENCES `teachers` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
