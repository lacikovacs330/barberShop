-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2023 at 08:58 AM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `misura`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `device_type` enum('computer','phone','tablet') NOT NULL,
  `http_accept` varchar(255) NOT NULL,
  `http_user_agent` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `id_user`, `device_type`, `http_accept`, `http_user_agent`, `ip_address`, `country_code`, `date`) VALUES
(175, 110, 'computer', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '109.245.35.161', 'Array', '2023-06-13 06:00:35'),
(176, 110, 'computer', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '109.245.39.57', 'Array', '2023-06-13 06:45:39'),
(177, 122, 'computer', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '109.245.39.57', 'Array', '2023-06-13 06:50:14'),
(178, 123, 'computer', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '109.245.39.57', 'Array', '2023-06-13 06:53:09'),
(179, 122, 'computer', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '109.245.39.57', 'Array', '2023-06-13 06:58:05'),
(180, 124, 'computer', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '109.245.39.57', 'Array', '2023-06-13 06:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int NOT NULL,
  `id_salon` int NOT NULL,
  `id_worker_user` int NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `duration` int NOT NULL,
  `price` int NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_salon`, `id_worker_user`, `id_user`, `username`, `email`, `duration`, `price`, `service_name`, `date`, `time`) VALUES
(248, 65, 123, 124, 'lacikovacs334', 'lacikovacs330@gmail.com', 15, 1500, 'Hajvágás', '2023-06-25', '12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_archived`
--

CREATE TABLE `reservation_archived` (
  `id_archived` int NOT NULL,
  `id_reservation` int NOT NULL,
  `id_salon` int NOT NULL,
  `id_worker_user` int NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `duration` int NOT NULL,
  `price` int NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_deleted`
--

CREATE TABLE `reservation_deleted` (
  `id_archived` int NOT NULL,
  `id_reservation` int NOT NULL,
  `id_salon` int NOT NULL,
  `id_worker_user` int NOT NULL,
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `duration` int NOT NULL,
  `price` int NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation_deleted`
--

INSERT INTO `reservation_deleted` (`id_archived`, `id_reservation`, `id_salon`, `id_worker_user`, `id_user`, `username`, `email`, `duration`, `price`, `service_name`, `date`, `time`) VALUES
(126, 247, 65, 123, 123, 'bakosd', 'lacikovacs330@gmail.com', 15, 1500, 'Hajvágás', '2023-06-25', '11:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

CREATE TABLE `salons` (
  `id_salon` int NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `ban` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salons`
--

INSERT INTO `salons` (`id_salon`, `id_user`, `name`, `image`, `description`, `status`, `ban`) VALUES
(64, 121, 'ASD', 'Képernyőkép 2023-04-17 162241.png', 'Asd', 0, 0),
(65, 122, 'popopjin', 'Képernyőkép 2023-04-17 162241.png', 'kkkkk', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id_service` int NOT NULL,
  `id_user` int NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `duration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id_service`, `id_user`, `service_name`, `price`, `duration`) VALUES
(50, 123, 'Hajvágás', 1500, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `firstname`, `lastname`, `password`, `email`, `token`, `status`, `role`) VALUES
(110, 'lacikovacs330', 'Kovács', 'László', '$2y$10$ybbNwrVSsxtvJ3pMahmqu.vz5elQ6qFinpIdbLfGlIuDkLPhmuaGC', 'lacikovacs330@gmail.com', 'b765971211b964e884c94f11796d8657', 1, 'admin'),
(121, 'asdasd', 'Asd', 'Asd', '$2y$10$ACGeDSVfQYQ459fH.klQk.MOkTImzYTgMLonqS77YSxTOi8CviOs2', 'asd@asd.com', '314d8029a5781782e77bff15f1555899', 0, 'owner'),
(122, 'lacikovacs33', 'Kovács', 'László', '$2y$10$P1XOAf1F4pM6FGmEhYyQRuEBXJ.mOqnYMi/b8tHeWyP9rnDMmU8aW', 'lacikovacs333@gmail.com', '672d37a5eef1033df5463dfef0397186', 1, 'owner'),
(123, 'bakosd', 'Bakos', 'Dávid', '$2y$10$kvpVkQXWp1y6YycmyD6hQO1Js3oRFs9JNQ/d/hqCDwpCcLTjVwBKy', 'bakos.david555@gmail.com', 'ba1b774e39ff5d97d615148c89b864ca', 1, 'worker'),
(124, 'lacikovacs334', 'Kovács', 'László', '$2y$10$W6KeVzmc2ZOVoglrRtSqxuZhw7LRAY/JV9X8QsCRBoHkR2tIhZl8m', 'asadasdas@asd.com', '78b2babac4d8d60b2b080ef3867421de', 1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id_worker` int NOT NULL,
  `id_salon` int NOT NULL,
  `id_user` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id_worker`, `id_salon`, `id_user`, `image`, `firstname`, `lastname`) VALUES
(17, 65, 123, 'Képernyőkép 2023-05-26 002201.png', 'Bakos', 'Dávid');

-- --------------------------------------------------------

--
-- Table structure for table `workers_hours`
--

CREATE TABLE `workers_hours` (
  `id_hour` int NOT NULL,
  `id_user` int NOT NULL,
  `salon_id` int NOT NULL,
  `day` date NOT NULL,
  `from_hour` time NOT NULL,
  `to_hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers_hours`
--

INSERT INTO `workers_hours` (`id_hour`, `id_user`, `salon_id`, `day`, `from_hour`, `to_hour`) VALUES
(55, 123, 65, '2023-06-25', '08:00:00', '14:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_worker_user` (`id_worker_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reservation_archived`
--
ALTER TABLE `reservation_archived`
  ADD PRIMARY KEY (`id_archived`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_worker_user` (`id_worker_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reservation_deleted`
--
ALTER TABLE `reservation_deleted`
  ADD PRIMARY KEY (`id_archived`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_worker_user` (`id_worker_user`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_reservation_2` (`id_reservation`);

--
-- Indexes for table `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id_salon`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id_worker`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `workers_hours`
--
ALTER TABLE `workers_hours`
  ADD PRIMARY KEY (`id_hour`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `salon_id` (`salon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `reservation_archived`
--
ALTER TABLE `reservation_archived`
  MODIFY `id_archived` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `reservation_deleted`
--
ALTER TABLE `reservation_deleted`
  MODIFY `id_archived` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `salons`
--
ALTER TABLE `salons`
  MODIFY `id_salon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id_worker` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `workers_hours`
--
ALTER TABLE `workers_hours`
  MODIFY `id_hour` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_worker_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_salon`) REFERENCES `salons` (`id_salon`);

--
-- Constraints for table `reservation_archived`
--
ALTER TABLE `reservation_archived`
  ADD CONSTRAINT `reservation_archived_ibfk_1` FOREIGN KEY (`id_salon`) REFERENCES `salons` (`id_salon`),
  ADD CONSTRAINT `reservation_archived_ibfk_2` FOREIGN KEY (`id_worker_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_archived_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `reservation_deleted`
--
ALTER TABLE `reservation_deleted`
  ADD CONSTRAINT `reservation_deleted_ibfk_1` FOREIGN KEY (`id_salon`) REFERENCES `salons` (`id_salon`),
  ADD CONSTRAINT `reservation_deleted_ibfk_2` FOREIGN KEY (`id_worker_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_deleted_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `salons`
--
ALTER TABLE `salons`
  ADD CONSTRAINT `salons_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `workers_ibfk_2` FOREIGN KEY (`id_salon`) REFERENCES `salons` (`id_salon`);

--
-- Constraints for table `workers_hours`
--
ALTER TABLE `workers_hours`
  ADD CONSTRAINT `workers_hours_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `workers_hours_ibfk_2` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id_salon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
