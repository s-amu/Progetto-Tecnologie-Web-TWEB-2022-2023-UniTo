-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 13, 2023 alle 22:47
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cars`
--

CREATE TABLE `cars` (
  `ID` tinyint(4) UNSIGNED NOT NULL,
  `NumeroTelaio` char(15) NOT NULL,
  `Marchio` char(30) NOT NULL,
  `Modello` char(30) NOT NULL,
  `Anno` smallint(4) UNSIGNED NOT NULL,
  `Cavalli` smallint(4) UNSIGNED NOT NULL,
  `Prezzo` char(4) NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cars`
--

INSERT INTO `cars` (`ID`, `NumeroTelaio`, `Marchio`, `Modello`, `Anno`, `Cavalli`, `Prezzo`, `Descrizione`) VALUES
(3, 'djh7333djidd', 'Maserati', 'MC20', 2021, 630, '150', 'La new entry del Tridente che mancava da tempo. Unisce modernità e vecchia scuola e le esalta con il suo motore e le sue prestazioni, che soddisfano anche i più esigenti.'),
(5, 'erhg45gerr', 'Lotus', 'Emira', 2019, 404, '110', 'Piccola, leggera e potente... queste caratteristiche la rendono estremamente divertente soprattutto in pista, dove dà del filo da torcere ad auto con motori ben più potenti e più costose.'),
(6, 'ggtgywrtg', 'Alfa Romeo', 'Giulia QV GTAm', 2020, 540, '265', 'Una macchina unica nel suo genere. La regina delle Giulia, porta in altro il nome di Alfa Romeo.'),
(2, 'idfgh874rje', 'Porsche', '911 Turbo S', 2016, 650, '250', 'Questa tedesca non è da sottovalutare. Un misto di leggerezza e potenza che la rendono una delle migliori sullo 0-100 e non solo.'),
(4, 'rg5g34343r', 'Ferrari', '458 Italia', 2010, 570, '206', 'Agile e scattante, questa macchina è una delle più iconiche del mondo Ferrari odierno. Nonostante abbia una certa età, si difende egregiamente a livello di prestazioni ed emozioni di guida.'),
(1, 'v75tbi4gnferj', 'Lamborghini', 'Huracán STO', 2018, 640, '310', 'Aerodinamica e prestazioni da pista per la Super Trofeo Omologata. Questa Huracán con i muscoli vi farà capire cosa vuol dire guidare una Lamborghini.');

-- --------------------------------------------------------

--
-- Struttura della tabella `reservations`
--

CREATE TABLE `reservations` (
  `ID` smallint(4) NOT NULL,
  `Auto` char(15) NOT NULL,
  `Pista` tinyint(4) UNSIGNED NOT NULL,
  `Utente` char(16) NOT NULL,
  `Data` date NOT NULL,
  `Ora` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `reservations`
--

INSERT INTO `reservations` (`ID`, `Auto`, `Pista`, `Utente`, `Data`, `Ora`) VALUES
(161, 'v75tbi4gnferj', 1, 'DNNMNT01M15H128G', '2023-03-03', '09:00'),
(163, 'v75tbi4gnferj', 1, 'DFHRTL99U23R444M', '2023-02-26', '09:00'),
(164, 'ggtgywrtg', 1, 'DFHRTL99U23R444M', '2023-06-23', '09:00'),
(165, 'erhg45gerr', 3, 'AFGBFGFGRGEDFVRR', '2023-03-15', '13:30'),
(166, 'djh7333djidd', 2, 'DNNMNT01M15H128G', '2023-03-02', '15:30'),
(167, 'idfgh874rje', 5, 'DNNMNT01M15H128G', '2023-04-18', '11:00'),
(174, 'ggtgywrtg', 3, 'SGT56FSG34TGGHGG', '2023-03-01', '11:00'),
(175, 'rg5g34343r', 5, 'SGT56FSG34TGGHGG', '2023-04-01', '10:00'),
(176, 'idfgh874rje', 1, 'SGT56FSG34TGGHGG', '2023-06-08', '12:30'),
(177, 'erhg45gerr', 2, 'AFGBFGFGRGEDFVRR', '2023-02-27', '14:30'),
(178, 'ggtgywrtg', 2, 'FDRFRANJ6EIN76FF', '2023-04-22', '15:30');

-- --------------------------------------------------------

--
-- Struttura della tabella `reviews`
--

CREATE TABLE `reviews` (
  `ID` tinyint(4) NOT NULL,
  `Autore` char(16) NOT NULL,
  `Auto` char(15) NOT NULL,
  `Circuito` tinyint(4) UNSIGNED NOT NULL,
  `Commento` text NOT NULL,
  `Grado` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `reviews`
--

INSERT INTO `reviews` (`ID`, `Autore`, `Auto`, `Circuito`, `Commento`, `Grado`) VALUES
(50, 'AFGBFGFGRGEDFVRR', 'erhg45gerr', 3, 'Wow! Che pista incredibile... è stato veramente bello poter sfrecciare a tutta velocità lungo il rettilineo. Lo consiglio a tutti.', 3),
(51, 'SGT56FSG34TGGHGG', 'idfgh874rje', 1, 'Ridatemi i miei soldi!!! Auto rotta, pista troppo affollata e giornata piovosa... una combinazione unica per non tornarci mai più.', 1),
(52, 'DNNMNT01M15H128G', 'djh7333djidd', 2, 'Nella norma... ho visto piste migliori e guidato auto migliori, però ci sta se volete provare una scarica di adrenalina.', 2),
(53, 'DNNMNT01M15H128G', 'idfgh874rje', 5, 'Questa sì che è una macchina. Sembrava di essere sopra una saetta, è incredibile come quest\'auto rasenta la perfezione. La pista invece è ok.', 3),
(54, 'AFGBFGFGRGEDFVRR', 'erhg45gerr', 2, 'Brutto, brutto e ancora brutto. Quest\'auto me l\'aspettavo completamente diversa. Per non parlare della pista che avrebbe bisogno di qualche sistemata soprattutto in curva 4.', 1),
(55, 'DFHRTL99U23R444M', 'ggtgywrtg', 1, 'Ok poteva andare peggio, però mi aspettavo di più dalla pista. Sull\'auto nulla da dire... una lama!', 2),
(56, 'SGT56FSG34TGGHGG', 'rg5g34343r', 5, 'Non pensò lo rifarò più, però devo ammettere che mi sono divertito dai.', 2),
(57, 'FDRFRANJ6EIN76FF', 'ggtgywrtg', 2, 'Non andateci. Organizzazione pessima e personale scortese. La macchina era addirittura sporca all\'interno. L\'unica cosa che si salva è la pista.', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tracks`
--

CREATE TABLE `tracks` (
  `ID` tinyint(4) UNSIGNED NOT NULL,
  `Nome` char(50) NOT NULL,
  `Città` char(30) NOT NULL,
  `Lunghezza` smallint(5) UNSIGNED NOT NULL,
  `NumeroCurve` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tracks`
--

INSERT INTO `tracks` (`ID`, `Nome`, `Città`, `Lunghezza`, `NumeroCurve`) VALUES
(1, 'Autodromo Enzo e Dino Ferrari', 'Imola', 4909, 19),
(2, 'Autodromo Nazionale di Monza', 'Monza', 5793, 11),
(3, 'Autodromo Internazionale del Mugello', 'Scarperia e San Piero', 5245, 15),
(5, 'Autodromo di Modena', 'Modena', 2007, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `ID` smallint(3) UNSIGNED NOT NULL,
  `Nome` char(30) NOT NULL,
  `Cognome` char(32) NOT NULL,
  `CF` char(16) NOT NULL,
  `Sesso` char(1) DEFAULT NULL,
  `DataNascita` date NOT NULL,
  `Email` char(50) NOT NULL,
  `Password` char(32) NOT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`ID`, `Nome`, `Cognome`, `CF`, `Sesso`, `DataNascita`, `Email`, `Password`, `Admin`) VALUES
(182, 'Alberto', 'Marino', 'AFGBFGFGRGEDFVRR', 'M', '2000-06-15', 'alberto.marino@gmail.com', 'dd823d8aa706982d094bc8a69c77761c', 0),
(2, 'Michele', 'Merico', 'DFHRTL99U23R444M', 'M', '1999-10-02', 'michele.merico@yahoo.com', '309acf957503ff246f7d11d1106602aa', 0),
(175, 'Dennis', 'Montesi', 'DNNMNT01M15H128G', 'M', '2001-02-15', 'dennis.montesi@libero.com', '81c170a75dd6e664b6ca08b3aeaa006b', 0),
(189, 'Federica', 'Franceschini', 'FDRFRANJ6EIN76FF', 'F', '2003-02-06', 'lucia.fra@libero.com', 'c17d4044f6641447f22099c9e1c66bd4', 0),
(177, 'ADMIN', 'ADMIN', 'FFFFFFFFFFFFFFFF', NULL, '2001-08-08', 'admin@admin.com', '751cb3f4aa17c36186f4856c8982bf27', 1),
(176, 'Boris', 'Turcan', 'SGT56FSG34TGGHGG', 'M', '2000-10-12', 'boris.turcan@gmail.com', '99bd718ba13d7ed38cafd4077fa0776e', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`NumeroTelaio`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indici per le tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `reservations_cars` (`Auto`),
  ADD KEY `reservations_tracks` (`Pista`),
  ADD KEY `reservations_users` (`Utente`);

--
-- Indici per le tabelle `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `reviews_cars` (`Auto`),
  ADD KEY `reviews_tracks` (`Circuito`),
  ADD KEY `reviews_users` (`Autore`);

--
-- Indici per le tabelle `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CF`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cars`
--
ALTER TABLE `cars`
  MODIFY `ID` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la tabella `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ID` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT per la tabella `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT per la tabella `tracks`
--
ALTER TABLE `tracks`
  MODIFY `ID` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `ID` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_cars` FOREIGN KEY (`Auto`) REFERENCES `cars` (`NumeroTelaio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_tracks` FOREIGN KEY (`Pista`) REFERENCES `tracks` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_users` FOREIGN KEY (`Utente`) REFERENCES `users` (`CF`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_cars` FOREIGN KEY (`Auto`) REFERENCES `cars` (`NumeroTelaio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_tracks` FOREIGN KEY (`Circuito`) REFERENCES `tracks` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_users` FOREIGN KEY (`Autore`) REFERENCES `users` (`CF`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
