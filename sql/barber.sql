-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Feb 21. 23:49
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `barber`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_worker_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_salon`, `id_worker_user`, `id_user`, `username`, `email`, `duration`, `price`, `date`, `time`) VALUES
(1, 2, 4, 3, 'Eper', 'lacikovacs333@gmail.com', 30, 1500, '2023-02-23', '12:30:00'),
(7, 2, 4, 3, 'Eper', 'szilvia19750621@gmail.com', 30, 1500, '2023-02-23', '17:30:00'),
(8, 2, 5, 3, 'Eper', 'szilvia19750621@gmail.com', 40, 1000, '2023-02-26', '08:40:00'),
(9, 2, 4, 3, 'Eper', 'szilvia19750621@gmail.com', 10, 1000, '2023-02-23', '10:50:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `salons`
--

CREATE TABLE `salons` (
  `id_salon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `salons`
--

INSERT INTO `salons` (`id_salon`, `id_user`, `name`, `image`, `description`) VALUES
(2, 3, 'COIFFEUR', 'Coiffeur.jpg', 'Jó hely');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `services`
--

CREATE TABLE `services` (
  `id_service` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `services`
--

INSERT INTO `services` (`id_service`, `id_user`, `service_name`, `price`, `duration`) VALUES
(1, 4, 'Hajvágás', 1500, 30),
(2, 4, 'Hajfestés', 1000, 10),
(3, 5, 'asd', 1000, 40);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id_user`, `username`, `firstname`, `lastname`, `password`, `email`, `token`, `status`, `role`) VALUES
(1, 'lacikovacs330', 'Kovács', 'László', '$2y$10$Wd8JBlTZuJ8VX1NH7KfH8.5RYyUOYkinys0yqPuDRlzHFInTvmwa.', 'lacikovacs330@gmail.com', '00f9b220282dfb161e1c626c3abff56b', 1, 'admin'),
(3, 'Eper', 'Eper', 'Dávid', '$2y$10$ckPAcORxjARHUPlw9wkoFOaFVE37A62.46bckiVvcVMwkdtvWmQle', 'lacikovacs330@gmail.com', '94498eca4542cb6692864ff272b2c58f', 1, 'owner'),
(4, 'pnorbi', 'Péter', 'Norbert', '$2y$10$5tsfJrNszXXt2O6XlnrtYeOsDAgeJ0j6E0aGZL9ItQeKO2QC39emy', 'lacikovacs330@gmail.com', 'f6355194fda5e7173c659848c2f6108a', 1, 'worker'),
(5, 'bdani', 'Brada', 'Dániel', '$2y$10$7UhMkGvGAI3AGtc8humQW.Y2rHA3S5BlchDjrM/q53m3e4bTUJmoK', 'lacikovacs330@gmail.com', 'e6c2be42262d946df761e01e78a59d35', 1, 'worker');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workers`
--

CREATE TABLE `workers` (
  `id_worker` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `workers`
--

INSERT INTO `workers` (`id_worker`, `id_salon`, `id_user`, `image`, `firstname`, `lastname`) VALUES
(1, 2, 4, 'charlie-green-3JmfENcL24M-unsplash.jpg', 'Péter', 'Norbert'),
(2, 2, 5, 'leilani-angel-K84vnnzxmTQ-unsplash.jpg', 'Brada', 'Dániel');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workers_hours`
--

CREATE TABLE `workers_hours` (
  `id_hour` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `day` date NOT NULL,
  `from_hour` time NOT NULL,
  `to_hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `workers_hours`
--

INSERT INTO `workers_hours` (`id_hour`, `id_user`, `day`, `from_hour`, `to_hour`) VALUES
(1, 4, '2023-02-23', '10:00:00', '19:00:00'),
(2, 4, '2023-02-25', '17:00:00', '22:45:00'),
(3, 5, '2023-02-26', '04:00:00', '11:30:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_worker_user` (`id_worker_user`),
  ADD KEY `id_user` (`id_user`);

--
-- A tábla indexei `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id_salon`),
  ADD KEY `id_user` (`id_user`);

--
-- A tábla indexei `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_user` (`id_user`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- A tábla indexei `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id_worker`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_user` (`id_user`);

--
-- A tábla indexei `workers_hours`
--
ALTER TABLE `workers_hours`
  ADD PRIMARY KEY (`id_hour`),
  ADD KEY `id_user` (`id_user`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `salons`
--
ALTER TABLE `salons`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `workers`
--
ALTER TABLE `workers`
  MODIFY `id_worker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `workers_hours`
--
ALTER TABLE `workers_hours`
  MODIFY `id_hour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Megkötések a táblához `workers_hours`
--
ALTER TABLE `workers_hours`
  ADD CONSTRAINT `workers_hours_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
