-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 05:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataagenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(6, 'admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `isi`, `tanggal`, `created_at`, `keterangan`) VALUES
(48, 'asaasas', 'asasas', '2024-01-01', '2024-05-22 13:59:20', 'asasasa'),
(49, 'dfdf', 'dfdf', '2024-05-06', '2024-05-22 15:50:41', 'dfdf');

-- --------------------------------------------------------

--
-- Table structure for table `agenda_keterangan`
--

CREATE TABLE `agenda_keterangan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `agenda_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda_keterangan`
--

INSERT INTO `agenda_keterangan` (`id`, `user_id`, `agenda_id`, `keterangan`, `created_at`) VALUES
(31, 6, 48, 'asasasa', '2024-05-22 13:59:20'),
(37, 6, 49, 'dfdf', '2024-05-22 15:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(4, 'Andi1', '$2y$10$GiHCYHhqDT3yqsr27PcUYeZBwLbpXLZPU4taYQ38MwFwyx/RGTSZq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda_keterangan`
--
ALTER TABLE `agenda_keterangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_id` (`agenda_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `agenda_keterangan`
--
ALTER TABLE `agenda_keterangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda_keterangan`
--
ALTER TABLE `agenda_keterangan`
  ADD CONSTRAINT `agenda_keterangan_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
