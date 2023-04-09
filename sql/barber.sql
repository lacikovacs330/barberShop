-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Ápr 10. 00:22
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
  `service_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reservation_archived`
--

CREATE TABLE `reservation_archived` (
  `id_archived` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_worker_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reservation_deleted`
--

CREATE TABLE `reservation_deleted` (
  `id_archived` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_worker_user` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `salons`
--

CREATE TABLE `salons` (
  `id_salon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 22, 'Hajvágás', 1500, 15),
(8, 22, 'Hajfestés', 2000, 30),
(10, 21, 'Borotválás', 1500, 20);

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
(35, 'lacikovacs330', 'Kovács', 'László', '$2y$10$VgApo8q/CEwcttUNdyzCpeuPpj.hpGXe6m1yd.sW3Yb.e6aaHlLMy', 'lacikovacs330@gmail.com', '299283476656acd659e4aaab07886287', 1, 'admin');

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
(8, 21, '2023-08-31', '11:00:00', '18:00:00'),
(9, 22, '2023-07-13', '13:00:00', '18:00:00'),
(10, 22, '2023-04-01', '11:00:00', '17:00:00');

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
-- A tábla indexei `reservation_archived`
--
ALTER TABLE `reservation_archived`
  ADD PRIMARY KEY (`id_archived`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_worker_user` (`id_worker_user`),
  ADD KEY `id_user` (`id_user`);

--
-- A tábla indexei `reservation_deleted`
--
ALTER TABLE `reservation_deleted`
  ADD PRIMARY KEY (`id_archived`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_worker_user` (`id_worker_user`),
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `id_reservation_2` (`id_reservation`);

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
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT a táblához `reservation_archived`
--
ALTER TABLE `reservation_archived`
  MODIFY `id_archived` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `reservation_deleted`
--
ALTER TABLE `reservation_deleted`
  MODIFY `id_archived` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT a táblához `salons`
--
ALTER TABLE `salons`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT a táblához `workers`
--
ALTER TABLE `workers`
  MODIFY `id_worker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `workers_hours`
--
ALTER TABLE `workers_hours`
  MODIFY `id_hour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
