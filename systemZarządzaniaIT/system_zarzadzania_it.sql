-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 04, 2024 at 01:22 PM
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
-- Database: `system_zarzadzania_it`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `project-id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `tresc` varchar(50) NOT NULL,
  `line` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `project-id`, `user`, `tresc`, `line`) VALUES
(19, 2, 'user', 'sdfa', 1),
(22, 1, 'user', 'jestem komentarzem', 2),
(23, 1, 'user', 'jestem komentarzem', 3),
(25, 1, 'user', 'kom', 11),
(26, 1, 'user', 'jestem komentarzem123', 111),
(27, 1, 'user', 'sd', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dolaczeni`
--

CREATE TABLE `dolaczeni` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dolaczeni`
--

INSERT INTO `dolaczeni` (`id`, `project_id`, `user`) VALUES
(15, 1, 'user'),
(16, 2, 'user'),
(20, 5, 'user'),
(21, 11, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) DEFAULT NULL,
  `kod` varchar(8191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `nazwa`, `kod`) VALUES
(1, '1', '        <?php\r\n        echo \"Hello, World123!\";\r\n        ?>      '),
(2, '2', '        <?php\r\n        echo \"Hello, World!\";;\r\n        ?>      '),
(5, '123', 'echo \"Hello world\";');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `uprawnienia` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`login`, `password`, `uprawnienia`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('pracownik', '491910ff69cf9f888d5bed54630ffbaa', 'pracownik'),
('pracownik2', '491910ff69cf9f888d5bed54630ffbaa', 'pracownik'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `dolaczeni`
--
ALTER TABLE `dolaczeni`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `dolaczeni`
--
ALTER TABLE `dolaczeni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
