-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 05, 2024 alle 23:46
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
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `artists_preferiti`
--

CREATE TABLE `artists_preferiti` (
  `user_id` int(10) NOT NULL,
  `artist_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_artisti`
--

CREATE TABLE `dati_artisti` (
  `id_artista` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_canzoni`
--

CREATE TABLE `dati_canzoni` (
  `id_canzone` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `dati_canzoni`
--

INSERT INTO `dati_canzoni` (`id_canzone`, `title`, `artist`, `image_url`) VALUES
(6, '15 Piani', 'Sfera Ebbasta', 'https://i.scdn.co/image/ab67616d0000b2733c0eada9fb45ba9d43116f1d'),
(7, 'Anche Stasera', 'Sfera Ebbasta', 'https://i.scdn.co/image/ab67616d0000b2733c0eada9fb45ba9d43116f1d'),
(8, 'Visiera A Becco', 'Sfera Ebbasta', 'https://i.scdn.co/image/ab67616d0000b2730b5557811b1eab235b1fade4');

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_utente`
--

CREATE TABLE `dati_utente` (
  `id_utente` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `data_di_nascita` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sesso` varchar(255) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `codice_postale` int(20) NOT NULL,
  `nazione` varchar(255) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `dati_utente`
--

INSERT INTO `dati_utente` (`id_utente`, `username`, `nome`, `cognome`, `data_di_nascita`, `email`, `password`, `sesso`, `indirizzo`, `codice_postale`, `nazione`, `citta`, `provincia`) VALUES
(1, 'Bebo99', 'luigi', 'scalzo', '1999-04-28', 'scalzolu99@gmail.com', 'Bebo9999@', 'Uomo', 'Via san nullo 5/o', 95123, 'Italia', 'Catania', 'Catania');

-- --------------------------------------------------------

--
-- Struttura della tabella `songs_preferiti`
--

CREATE TABLE `songs_preferiti` (
  `user_id` int(10) NOT NULL,
  `song_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `songs_preferiti`
--

INSERT INTO `songs_preferiti` (`user_id`, `song_id`) VALUES
(1, 6),
(1, 7),
(1, 8);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `artists_preferiti`
--
ALTER TABLE `artists_preferiti`
  ADD PRIMARY KEY (`user_id`,`artist_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indici per le tabelle `dati_artisti`
--
ALTER TABLE `dati_artisti`
  ADD PRIMARY KEY (`id_artista`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `dati_canzoni`
--
ALTER TABLE `dati_canzoni`
  ADD PRIMARY KEY (`id_canzone`),
  ADD UNIQUE KEY `title` (`title`,`artist`);

--
-- Indici per le tabelle `dati_utente`
--
ALTER TABLE `dati_utente`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `songs_preferiti`
--
ALTER TABLE `songs_preferiti`
  ADD PRIMARY KEY (`user_id`,`song_id`),
  ADD KEY `song_id` (`song_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dati_artisti`
--
ALTER TABLE `dati_artisti`
  MODIFY `id_artista` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `dati_canzoni`
--
ALTER TABLE `dati_canzoni`
  MODIFY `id_canzone` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `dati_utente`
--
ALTER TABLE `dati_utente`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `artists_preferiti`
--
ALTER TABLE `artists_preferiti`
  ADD CONSTRAINT `artists_preferiti_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `dati_utente` (`id_utente`) ON DELETE CASCADE,
  ADD CONSTRAINT `artists_preferiti_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `dati_artisti` (`id_artista`) ON DELETE CASCADE;

--
-- Limiti per la tabella `songs_preferiti`
--
ALTER TABLE `songs_preferiti`
  ADD CONSTRAINT `songs_preferiti_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `dati_utente` (`id_utente`) ON DELETE CASCADE,
  ADD CONSTRAINT `songs_preferiti_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `dati_canzoni` (`id_canzone`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
