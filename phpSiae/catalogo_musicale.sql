-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 30, 2023 alle 22:01
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalogo_musicale`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

CREATE TABLE `album` (
  `ID_Album` int(11) NOT NULL,
  `Anno` date NOT NULL,
  `Titolo` varchar(32) NOT NULL,
  `Genere` varchar(32) NOT NULL,
  `ID_Autore` int(11) NOT NULL,
  `Copertina` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `album`
--

INSERT INTO `album` (`ID_Album`, `Anno`, `Titolo`, `Genere`, `ID_Autore`, `Copertina`) VALUES
(1, '2023-11-08', 'Mi First', 'rap', 1, 'C:\\xamp\\htdocs\\progettiInfo\\phpSiae\\imgs'),
(2, '2023-11-01', 'Turbe Giovanili', 'rap', 2, 'C:\\xamp\\htdocs\\progettiInfo\\phpSiae\\imgs');

-- --------------------------------------------------------

--
-- Struttura della tabella `autore`
--

CREATE TABLE `autore` (
  `ID_Autore` int(11) NOT NULL,
  `Nome` varchar(32) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `NomeArte` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `autore`
--

INSERT INTO `autore` (`ID_Autore`, `Nome`, `Cognome`, `NomeArte`) VALUES
(1, 'Cosimo', 'Fini', 'Gue Pequeno'),
(2, 'Fabrizio', 'Tarducci', 'Fabri Fibra');

-- --------------------------------------------------------

--
-- Struttura della tabella `canzone`
--

CREATE TABLE `canzone` (
  `Anno` date NOT NULL,
  `Titolo` varchar(32) NOT NULL,
  `Genere` varchar(32) NOT NULL,
  `ID_Album` int(11) NOT NULL,
  `Durata` time NOT NULL,
  `Link` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `canzone`
--

INSERT INTO `canzone` (`Anno`, `Titolo`, `Genere`, `ID_Album`, `Durata`, `Link`) VALUES
('2023-11-09', 'Cronache di resistenza', 'rap', 1, '00:02:40', 'https://www.youtube.com/watch?v=kcBlH-coA8w'),
('2023-11-15', 'Fuori norma', 'rap', 2, '00:04:02', 'https://www.youtube.com/watch?v=AfDc2xlhJ_A');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`ID_Album`),
  ADD KEY `ID_Autore` (`ID_Autore`);

--
-- Indici per le tabelle `autore`
--
ALTER TABLE `autore`
  ADD PRIMARY KEY (`ID_Autore`);

--
-- Indici per le tabelle `canzone`
--
ALTER TABLE `canzone`
  ADD KEY `ID_Album` (`ID_Album`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `album`
--
ALTER TABLE `album`
  MODIFY `ID_Album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `autore`
--
ALTER TABLE `autore`
  MODIFY `ID_Autore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`ID_Autore`) REFERENCES `autore` (`ID_Autore`);

--
-- Limiti per la tabella `canzone`
--
ALTER TABLE `canzone`
  ADD CONSTRAINT `canzone_ibfk_1` FOREIGN KEY (`ID_Album`) REFERENCES `album` (`ID_Album`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
