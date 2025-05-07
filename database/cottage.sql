-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 08:17 AM
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
-- Database: `cottage`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('User','Admin') DEFAULT 'User',
  `notifs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `account_type`, `notifs`) VALUES
(11, 'admin', 'admin@gmail.com', 'admin', 'Admin', NULL),
(12, 'user', 'user@gmail.com', 'user', 'User', 'Your cat submission for \\\'Orange\\\' has been approved.\n\nYour adoption request for \\\'Orange\\\' has been approved.');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_requests`
--

INSERT INTO `adoption_requests` (`id`, `user_id`, `cat_id`, `pickup_date`, `pickup_time`, `status`, `timestamp`) VALUES
(12, 12, 28, '2025-05-22', '13:55:00', 'Approved', '2025-05-07 05:51:16'),
(13, 12, 29, '2025-05-15', '18:05:00', 'Approved', '2025-05-07 06:01:48'),
(14, 12, 22, '2025-05-15', '18:09:00', 'Pending', '2025-05-07 06:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `neutered` enum('Yes','No') NOT NULL,
  `vaccination` enum('Fully Vaccinated','Partially Vaccinated','Not Vaccinated') NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Available','Adopted') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `breed`, `age`, `sex`, `neutered`, `vaccination`, `description`, `image`, `status`) VALUES
(22, 'Whiskers', 'Siamese', 2, 'Male', 'Yes', 'Fully Vaccinated', 'Playful and charming.', 'cats/whiskers.jpg', 'Available'),
(25, 'Bella', 'Persian', 5, 'Female', 'Yes', 'Partially Vaccinated', 'Quiet and reserved', 'cats/681af0ddc5004_bella.jpg', 'Available'),
(26, 'Mushroom', 'British Shorthair', 3, 'Male', 'No', 'Partially Vaccinated', 'Calm and affectionate', 'cats/681af102d5ea9_mushroom.jpg', 'Available'),
(27, 'Mike', 'Puspin', 3, 'Male', 'No', 'Not Vaccinated', 'Rescue cat', 'cats/681af12c6a676_mike.jpg', 'Available'),
(28, 'Iris', 'Ragdoll', 3, 'Female', 'No', 'Partially Vaccinated', 'Cuddly', 'cats/681af146e755c_iris.jpg', 'Adopted'),
(29, 'Orange', 'Orange', 2, 'Male', 'Yes', '', 'Cute', 'uploads/orange.jpg', 'Adopted');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_cats`
--

CREATE TABLE `submitted_cats` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `neutered` enum('Yes','No') NOT NULL,
  `vaccination` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Pending','Rejected','Approved') NOT NULL DEFAULT 'Pending',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submitted_cats`
--

INSERT INTO `submitted_cats` (`id`, `email`, `name`, `breed`, `age`, `sex`, `neutered`, `vaccination`, `description`, `image`, `status`, `timestamp`) VALUES
(7, 'user@gmail.com', 'Orange', 'Orange', 2, 'Male', 'Yes', 'Partially', 'Cute', 'uploads/orange.jpg', 'Approved', '2025-05-07 05:45:37'),
(8, 'user@gmail.com', 'Whitey', 'White', 2, 'Male', 'Yes', 'Partially', 'Cute', 'uploads/whitey.jpg', 'Pending', '2025-05-07 05:47:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_cats`
--
ALTER TABLE `submitted_cats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `submitted_cats`
--
ALTER TABLE `submitted_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoption_requests_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `cats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
