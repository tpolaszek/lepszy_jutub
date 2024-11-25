-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 26, 2024 at 12:59 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bilibili`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy`
--

CREATE TABLE `filmy` (
  `id_filmiku` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `plik` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `filmy`
--

INSERT INTO `filmy` (`id_filmiku`, `nazwa`, `opis`, `plik`, `username`) VALUES
(1, 'videoplayback.mp4', NULL, 'uploads/videoplayback.mp4', ''),
(2, 'Honda Civic EK K24 TURBO _LOUD_ POV Drive.mp4', NULL, 'uploads/Honda Civic EK K24 TURBO _LOUD_ POV Drive.mp4', ''),
(3, 'Mitsubishi 3000gt DRIFT PO SNIEGU', 'test', 'uploads/3000GT VR4 Snow Drift 01 _).mp4', ''),
(4, 'Mitsubishi Eclipse 2g Turbo', 'Test turbiny na mitsubishi eclipse 2g!', 'uploads/Mitsubishi Eclipse 2g turbo.mp4', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'asd', '$2y$10$XRCEMK3AbBguJA5hfXG8zuJnvkS7ZB/JNAS0yrdnBJf6lTwUQCR7q');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `filmy`
--
ALTER TABLE `filmy`
  ADD PRIMARY KEY (`id_filmiku`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmy`
--
ALTER TABLE `filmy`
  MODIFY `id_filmiku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
