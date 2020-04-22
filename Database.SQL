-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 22, 2020 at 09:13 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `autonoleggio`
--

-- --------------------------------------------------------

--
-- Table structure for table `Auto`
--

CREATE TABLE `Auto` (
  `IDMezzo` int(11) NOT NULL,
  `Targa` varchar(7) NOT NULL,
  `Colore` varchar(10) DEFAULT NULL,
  `Marca` varchar(10) DEFAULT NULL,
  `Modello` varchar(10) DEFAULT NULL,
  `Alimentazione` varchar(10) DEFAULT NULL,
  `NPosti` int(11) NOT NULL,
  `Cilindrata` int(11) DEFAULT NULL,
  `Under25` tinyint(4) NOT NULL,
  `Prezzo` double(5,2) NOT NULL,
  `Image` varchar(30) DEFAULT NULL,
  `Image2` varchar(30) DEFAULT NULL,
  `Image3` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Auto`
--

INSERT INTO `Auto` (`IDMezzo`, `Targa`, `Colore`, `Marca`, `Modello`, `Alimentazione`, `NPosti`, `Cilindrata`, `Under25`, `Prezzo`, `Image`, `Image2`, `Image3`) VALUES
(1, 'AA123BB', 'Nero', 'FIAT', 'Panda', 'DIESEL', 5, 1500, 0, 49.99, 'fiat.png', 'panda-gamma.jpg', 'fiat.jpg'),
(2, 'FE000GB', 'Bianco', 'FIAT', 'Punto', 'BENZINA', 5, 1200, 1, 99.00, NULL, NULL, NULL),
(8, 'AZ456PY', 'Grigio', 'FIAT', 'Tipo', 'DIESEL', 4, 1500, 1, 50.00, NULL, NULL, NULL),
(9, 'SE777GB', 'Bianco', 'FIAT', 'Panda', 'DIESEL', 4, 1200, 0, 90.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Faq`
--

CREATE TABLE `Faq` (
  `IDFaq` int(11) NOT NULL,
  `Domanda` text,
  `Risposta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Faq`
--

INSERT INTO `Faq` (`IDFaq`, `Domanda`, `Risposta`) VALUES
(3, 'E possibile prenotare auto per occassioni speciali ?', 'Si, abbiamo auto di rappresentanza e per occassioni speciali, in più abbiamo anche il servizio : noleggio con conducente'),
(4, 'Compilazione form di registrazione', 'Basta andare nella pagina di login, in basso troverai il link alla pagina di registrazione, benvenuto nel nostro mondo ');

-- --------------------------------------------------------

--
-- Table structure for table `Gestione`
--

CREATE TABLE `Gestione` (
  `IDGestione` int(11) NOT NULL,
  `IDMezzo` int(11) NOT NULL,
  `IDUtente` int(11) NOT NULL,
  `DataUltimaModifica` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Messaggio`
--

CREATE TABLE `Messaggio` (
  `IDMessaggio` int(11) NOT NULL,
  `DataOra` datetime NOT NULL,
  `IDMittente` int(11) NOT NULL,
  `IDDestinatario` int(11) NOT NULL,
  `Messaggio` text,
  `Visualizzato` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Messaggio`
--

INSERT INTO `Messaggio` (`IDMessaggio`, `DataOra`, `IDMittente`, `IDDestinatario`, `Messaggio`, `Visualizzato`) VALUES
(1, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?Ciao come stai ?', 1),
(2, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(3, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(4, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(5, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(6, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(7, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(8, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(9, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(10, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(11, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(12, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(13, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(14, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(15, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(16, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(17, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(18, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1),
(19, '2019-05-22 04:00:00', 1, 2, 'Ciao come stai ?', 0),
(20, '2019-05-30 00:00:00', 2, 1, 'Tutto bene, tu ?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Prenotazione`
--

CREATE TABLE `Prenotazione` (
  `IDPrenotazione` int(11) NOT NULL,
  `IDMezzo` int(11) NOT NULL,
  `IDUtente` int(11) NOT NULL,
  `KmAttuali` int(11) DEFAULT NULL,
  `DataInizio` datetime NOT NULL,
  `DataFine` datetime NOT NULL,
  `DataPrenotazione` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Prenotazione`
--

INSERT INTO `Prenotazione` (`IDPrenotazione`, `IDMezzo`, `IDUtente`, `KmAttuali`, `DataInizio`, `DataFine`, `DataPrenotazione`) VALUES
(3, 2, 1, 10000, '2000-10-10 00:00:00', '2010-10-10 00:00:00', '2020-04-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Utente`
--

CREATE TABLE `Utente` (
  `IDUtente` int(11) NOT NULL,
  `CodicePatente` varchar(10) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Utente`
--

INSERT INTO `Utente` (`IDUtente`, `CodicePatente`, `Nome`, `Cognome`, `Username`, `Password`, `Role`) VALUES
(1, 'AAAAAAAA', 'Mario', 'Rossi', 'user', 'pass', 'client'),
(2, 'BBBBBBBB', 'Piero', 'Bianchi', 'admin', 'pass', 'admin'),
(3, 'CCCCCCC', 'Carlo', 'Verdi', 'carlo', 'pass', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Auto`
--
ALTER TABLE `Auto`
  ADD PRIMARY KEY (`IDMezzo`),
  ADD UNIQUE KEY `Targa` (`Targa`);

--
-- Indexes for table `Faq`
--
ALTER TABLE `Faq`
  ADD PRIMARY KEY (`IDFaq`);

--
-- Indexes for table `Gestione`
--
ALTER TABLE `Gestione`
  ADD PRIMARY KEY (`IDGestione`),
  ADD KEY `IDMezzo` (`IDMezzo`),
  ADD KEY `IDUtente` (`IDUtente`);

--
-- Indexes for table `Messaggio`
--
ALTER TABLE `Messaggio`
  ADD PRIMARY KEY (`IDMessaggio`,`IDMittente`,`IDDestinatario`),
  ADD KEY `IDMittente` (`IDMittente`),
  ADD KEY `IDDestinatario` (`IDDestinatario`);

--
-- Indexes for table `Prenotazione`
--
ALTER TABLE `Prenotazione`
  ADD PRIMARY KEY (`IDPrenotazione`),
  ADD KEY `IDMezzo` (`IDMezzo`),
  ADD KEY `IDUtente` (`IDUtente`);

--
-- Indexes for table `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`IDUtente`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Auto`
--
ALTER TABLE `Auto`
  MODIFY `IDMezzo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Faq`
--
ALTER TABLE `Faq`
  MODIFY `IDFaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Gestione`
--
ALTER TABLE `Gestione`
  MODIFY `IDGestione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Prenotazione`
--
ALTER TABLE `Prenotazione`
  MODIFY `IDPrenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Utente`
--
ALTER TABLE `Utente`
  MODIFY `IDUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Gestione`
--
ALTER TABLE `Gestione`
  ADD CONSTRAINT `gestione_ibfk_1` FOREIGN KEY (`IDMezzo`) REFERENCES `Auto` (`IDMezzo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gestione_ibfk_2` FOREIGN KEY (`IDUtente`) REFERENCES `Utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Messaggio`
--
ALTER TABLE `Messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`IDMittente`) REFERENCES `Utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messaggio_ibfk_2` FOREIGN KEY (`IDDestinatario`) REFERENCES `Utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Prenotazione`
--
ALTER TABLE `Prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`IDMezzo`) REFERENCES `Auto` (`IDMezzo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prenotazione_ibfk_2` FOREIGN KEY (`IDUtente`) REFERENCES `Utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;
