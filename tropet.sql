-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Czas generowania: 15 Sty 2022, 01:09
-- Wersja serwera: 8.0.27
-- Wersja PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tropet`
--
CREATE DATABASE IF NOT EXISTS `tropet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tropet`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `PET_ID` int NOT NULL AUTO_INCREMENT,
  `PET_NAME` varchar(16) NOT NULL,
  `BREED` varchar(16) NOT NULL,
  `SIZE` varchar(16) NOT NULL,
  `COLOR` varchar(16) NOT NULL,
  `NATURE` varchar(16) NOT NULL,
  `OWNER_ID` int NOT NULL,
  PRIMARY KEY (`PET_ID`),
  UNIQUE KEY `OWNER_ID` (`OWNER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

DROP TABLE IF EXISTS `uzytkownik`;
CREATE TABLE IF NOT EXISTS `uzytkownik` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `user` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id_user`, `user`, `password`, `email`) VALUES
(1, 'xdxdxdxdxdxd', '1234567', 'stara@op.pl');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`OWNER_ID`) REFERENCES `user` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
