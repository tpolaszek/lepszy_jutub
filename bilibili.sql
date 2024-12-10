-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 12:39 AM
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
  `username` varchar(255) NOT NULL,
  `tagi` text NOT NULL,
  `wyswietlenia` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `filmy`
--

INSERT INTO `filmy` (`id_filmiku`, `nazwa`, `opis`, `plik`, `username`, `tagi`, `wyswietlenia`) VALUES
(1, 'videoplayback.mp4', NULL, 'uploads/videoplayback.mp4', '', '', 1000),
(2, 'Honda Civic EK K24 TURBO _LOUD_ POV Drive.mp4', NULL, 'uploads/Honda Civic EK K24 TURBO _LOUD_ POV Drive.mp4', '', '', 900),
(3, 'Mitsubishi 3000gt DRIFT PO SNIEGU', 'test', 'uploads/3000GT VR4 Snow Drift 01 _).mp4', '', '', 800),
(4, 'Mitsubishi Eclipse 2g Turbo', 'Test turbiny na mitsubishi eclipse 2g!', 'uploads/Mitsubishi Eclipse 2g turbo.mp4', '', '', 700),
(5, 'ty to jest civic', 'civic', 'uploads/Tunning Honda Civic by Alladino ReaL LiVe   Â® (BEZ WERYFIKACJI).mp4', '', '#civic #sigma #aura #skibidi #330 #fyp #gyat #sczur #siÄ™ #nie #przeciÅ›nie', 600),
(6, 'napad na fabryke jaboli â–ˆâ–¬â–ˆ â–ˆ â–€â–ˆâ–€', 'napad', 'uploads/videoplayback (2).mp4', '', '#orzeÅ‚ #napad #gtaonline #â–ˆâ–¬â–ˆ â–ˆ â–€â–ˆâ–€', 500),
(7, 'PaweÅ‚ Jumper', 'PaweÅ‚ bÄ™dzie skakaÅ‚', 'uploads/PaweÅ‚ jumper.mp4', '', '#metr50 #dzwoÅ„cie#pytajcieobolida #0700', 400),
(8, 'Fraszki o michale', 'co lubi michaÅ‚', 'uploads/videoplayback (1).mp4', '', '#zakupy #oferty #niskacena', 300),
(9, 'przekaz myÅ›lowy', 'za granicÄ… diabeÅ‚ jest', 'uploads/videoplayback (3).mp4', '', '#netia #przekaz', 200);

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
(1, 'asd', '$2y$10$XRCEMK3AbBguJA5hfXG8zuJnvkS7ZB/JNAS0yrdnBJf6lTwUQCR7q'),
(2, 'asdasda', '$2y$10$YbIgreMg4iz8pQn0miyqle4EOM/AEazaAVqZ/wKsKAPwRtsXfAGDa'),
(3, 'asdasd', '$2y$10$EvsKA3W5vQi1nQ.ezq3tleagNV13Vwwjp9/83Tl2I/rLJFT02Jhn6'),
(4, 'asdasdasd', '$2y$10$R1g0D9UhEt8lI71exnYBlOlxgIzw0rXRF7gODDcL50chIGZ5pR.4y');

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
  MODIFY `id_filmiku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
