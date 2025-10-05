-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2025 at 08:21 AM
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
-- Database: `usersdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass1` varchar(255) NOT NULL,
  `educations` text NOT NULL,
  `languages` text NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'regular',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `phone`, `email`, `pass1`, `educations`, `languages`, `profile_pic`, `role`, `created`) VALUES
('user-1569-1752815499', 'Tiyasha Sarkar', '7003959558', 'tiyasha@gmail.com', '$2y$10$74vSZvyC2aNQIaSImzYpV.sykRWEPDnYqjNCC9kVJ0R94Edty6yNS', '10th,12th,Graduation,Post-Graduation', 'English,Bengali', './uploads/3156-1759509814-img9.jpg', 'regular', '2025-07-19 21:57:28'),
('user-1631-1753005813', 'Debjani Saha', '9999999991', 'debjali@gmail.com', '$2y$10$uLtMxrlnIvH4lJwDTZDgiOnG5Cr3pjZN5VQA3onlVDYRN.m3zlmtO', '10th,12th,Graduation', 'Bengali,Hindi', './uploads/6200-1759509786-img5-compressed.jpg', 'regular', '2025-07-20 10:03:33'),
('user-3743-1752815537', 'Sourav Kar', '9999999998', 'sourav.kar@gmail.com', '$2y$10$9h1YN2yV08gCTIM2Y0sFNuWf65hOT53fTqHfyfKaynyL9qYQoHTv2', '10th,12th,Graduation', 'English,Bengali,Tamil', './uploads/6177-1759509747-img3.png', 'regular', '2025-07-19 21:57:18'),
('user-4777-1753008090', 'John Doe', '8989898987', 'john.doe@gmail.com', '$2y$10$WluCxAwHn4ngNHK6M1v5vOtmhxM9GXQLxQTOotfjAT5L0nXe4ahby', '10th,12th', 'English,Bengali', './uploads/1678-1759509674-img4.png', 'regular', '2025-07-20 10:41:30'),
('user-7838-1752815402', 'Sneha Mondal', '9163452400', 'sneha@yahoo.com', '$2y$10$rIjTqTaugmlN7S4RuCc4EOy6PpP88YpUcHiyF0tBAFqjQl0HjE1HC', '10th,12th,Graduation', 'English,Bengali,Hindi', './uploads/7357-1759509643-img2.png', 'regular', '2025-07-19 21:57:39'),
('user-9139-1759644405', 'Ankita Paul', '9087656789', 'ankita@gmail.com', '$2y$10$XNUtX2j1WVRSCNUeernSHuiuILIa/rgYU320f.4cM.KeL.mU981ju', '10th,12th,Graduation,Post-Graduation', 'Bengali,Hindi', './uploads/1747-1759644405-img2.png', 'regular', '2025-10-05 06:06:45'),
('user-9486-1758606190', 'Subham Paul', '9433340388', 'subham@gmail.com', '$2y$10$4CeMzJNhPAgtHQWmfC9YfOGulOJpoBOM165.IUh55dHjiRg.BCE1y', '10th,12th,Graduation', 'Bengali,Tamil', './uploads/4423-1759516879-temp1.jpg', 'admin', '2025-09-23 05:43:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
