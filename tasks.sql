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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `user_id` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `description`, `status`, `user_id`, `created`) VALUES
('task-001-001', 'This is first task title', 'This is first task description', 'Pending', 'user-1569-1752815499', '2025-07-21 05:43:52'),
('task-002-002', 'Lorem ipsum edited', 'lorem ipsum EDITED', 'Completed', 'user-7838-1752815402', '2025-07-21 05:43:52'),
('task-003-003', 'Hello world', 'Hii world', 'Completed', 'user-4777-1753008090', '2025-07-21 05:50:22'),
('tasks-1924-1755704317', 'buy coffee', 'buy new coffee', 'Pending', 'user-9418-1755704215', '2025-08-20 15:38:37'),
('tasks-2315-1753959224', 'my personal task', 'hddsdhdhkasd', 'Completed', 'user-2450-1753953559', '2025-07-31 10:53:44'),
('tasks-2549-1753888320', 'hello', 'My Rask is my task', 'Rejected', 'user-8675-1753888268', '2025-07-30 15:12:00'),
('tasks-5202-1759644489', 'Task title', 'Task description', 'Rejected', 'user-9139-1759644405', '2025-10-05 06:08:09'),
('tasks-9388-1753247273', 'Hello Im Tiyasha', 'Hello Again', 'Pending', 'user-1569-1752815499', '2025-07-23 05:07:53'),
('tasks-9605-1754997567', 'buy coffee', 'buy new coffee', 'Rejected', 'user-2245-1754994707', '2025-08-12 11:19:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
