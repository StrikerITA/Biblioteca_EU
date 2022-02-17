-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 15, 2022 alle 14:34
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `CodiceCategoria` varchar(30) NOT NULL,
  `NomeCategoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`CodiceCategoria`, `NomeCategoria`) VALUES
('035', 'giallo'),
('057', 'romantico'),
('068', 'drammatico'),
('098', 'fantasy');

-- --------------------------------------------------------

--
-- Struttura della tabella `libro`
--

CREATE TABLE `libro` (
  `CodiceLibro` int(20) NOT NULL,
  `Autore` varchar(40) NOT NULL,
  `Editore` varchar(40) NOT NULL,
  `Titolo` varchar(40) NOT NULL,
  `Descrizione` varchar(500) NOT NULL,
  `Immagine` varchar(60) NOT NULL,
  `Pagine` int(5) NOT NULL,
  `UltimoPrezzo` float NOT NULL,
  `NumeroCopie` int(5) NOT NULL,
  `CopieDisponibili` int(5) NOT NULL,
  `CodiceCategoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `libro`
--

INSERT INTO `libro` (`CodiceLibro`, `Autore`, `Editore`, `Titolo`, `Descrizione`, `Immagine`, `Pagine`, `UltimoPrezzo`, `NumeroCopie`, `CopieDisponibili`, `CodiceCategoria`) VALUES
(748569, 'J.K.Rowling', 'salani editori', 'harry potter e la pietra filosofale', 'A 11 anni, Harry Potter scopre di essere il figlio orfano di due potenti maghi. Frequenta la scuola di magia e stregoneria di Hogwarts dove scopre la verità su se stesso e sulla morte dei suoi genitori.', 'https://www.libreriailfaro.com/wp-content/uploads/2017/05/Ha', 350, 20.65, 2, 2, '098'),
(4589632, 'Jamie McGuire', 'Garzanti', 'Il mio disastro sei tu', 'Uno splendido disastro racconta della storia d\'amore tra Abby Abernathy e Travis Maddox. Abby Abernathy è una brava ragazza, all\'apparenza sembra la solita ragazza della porta accanto, ma dentro di sé nasconde un passato oscuro da cui non riesce a fuggire. Quando arriva alla Eastern University con la sua amica del cuore, America, spera di poter ricominciare da zero ed iniziare una nuova vita. Al contrario di ciò che Abby sperava, viene travolta da un turbine di emozioni incontrando Travis Maddox', 'https://images-na.ssl-images-amazon.com/images/I/71Y3UaIQ0EL', 298, 15.2, 10, 9, '057'),
(25896421, 'Raymond Chandler', 'feltrinelli', 'il grande sonno', 'Il grande sonno è un romanzo hardboiled scritto da Raymond Chandler nel 1939. Viene considerato dalla Crime Writers\' Association il secondo miglior romanzo giallo di tutti i tempi', 'https://4.bp.blogspot.com/-naGeoBZZyqQ/Vsi7ho6HjQI/AAAAAAAAA', 277, 23.56, 5, 5, '035'),
(578524589, 'Harper Lee', 'feltrinelli', 'il buio oltre la siepe', 'In una cittadina del \"profondo\" Sud degli Stati Uniti l\'onesto avvocato Atticus Finch è incaricato della difesa d\'ufficio di un \"negro\" accusato di violenza carnale; riuscirà a dimostrarne l\'innocenza, ma l\'uomo sarà ugualmente condannato a morte. La vicenda, che è solo l\'episodio centrale del romanzo, è raccontata dalla piccola Scout, la figlia di Atticus, un Huckleberry in gonnella, che scandalizza le signore con un linguaggio non proprio ortodosso, testimone e protagonista di fatti che nella ', 'https://images-na.ssl-images-amazon.com/images/I/81ZdqHCyXGL', 326, 15.21, 2, 2, '068');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenota`
--

CREATE TABLE `prenota` (
  `CodicePrenotazione` int(10) NOT NULL,
  `DataPrenotazione` date NOT NULL,
  `CodiceFiscale` varchar(16) NOT NULL,
  `CodiceLibro` int(20) NOT NULL,
  `StatoPrenotazione` varchar(30) NOT NULL DEFAULT 'attesa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prenota`
--

INSERT INTO `prenota` (`CodicePrenotazione`, `DataPrenotazione`, `CodiceFiscale`, `CodiceLibro`, `StatoPrenotazione`) VALUES
(5940, '7843-05-04', 'RCCNDR03H21A479I', 4589632, 'attesa'),
(5941, '4567-03-12', 'RCCNDR03H21A479I', 4589632, 'attesa');

-- --------------------------------------------------------

--
-- Struttura della tabella `prestito`
--

CREATE TABLE `prestito` (
  `CodicePrenotazione` int(10) NOT NULL,
  `InizioPrestito` date NOT NULL,
  `FinePrestito` date NOT NULL,
  `StatoPrestito` varchar(30) NOT NULL,
  `CodiceCopia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `CodiceFiscale` varchar(16) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Indirizzi` varchar(70) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Privilegi` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodiceFiscale`, `Cognome`, `Nome`, `Email`, `Password`, `Indirizzi`, `Telefono`, `Privilegi`) VALUES
('BRLCLT02L52C665V', 'Brollo', 'Carlotta', 'carlottabrollo@gmail.com', 'Pippo123.', 'via E. Tellini, 19 Chivasso(To)', '3347155868', b'0'),
('LPTLCU03L03F335I', 'Lopetti', 'Luca', 'lucalopetti@gmail.com', 'Pluto123.', 'via G. Bosco,13 Settimo Torinese(To)', '3884320890', b'0'),
('RCCNDR03H21A479I', 'Riccardi', 'Andrea', 'andrea.riccardi03@gmail.com', 'Paperino123.', 'Corso Pinin Giachino, 41 Cocconato(AT)', '3917553170', b'1');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodiceCategoria`);

--
-- Indici per le tabelle `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`CodiceLibro`),
  ADD KEY `CodiceCategoria` (`CodiceCategoria`);

--
-- Indici per le tabelle `prenota`
--
ALTER TABLE `prenota`
  ADD PRIMARY KEY (`CodicePrenotazione`),
  ADD KEY `CodiceFiscale` (`CodiceFiscale`),
  ADD KEY `prenota_ibfk_1` (`CodiceLibro`);

--
-- Indici per le tabelle `prestito`
--
ALTER TABLE `prestito`
  ADD PRIMARY KEY (`CodicePrenotazione`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `libro`
--
ALTER TABLE `libro`
  MODIFY `CodiceLibro` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=578524590;

--
-- AUTO_INCREMENT per la tabella `prenota`
--
ALTER TABLE `prenota`
  MODIFY `CodicePrenotazione` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5942;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`CodiceCategoria`) REFERENCES `categoria` (`CodiceCategoria`);

--
-- Limiti per la tabella `prenota`
--
ALTER TABLE `prenota`
  ADD CONSTRAINT `prenota_ibfk_1` FOREIGN KEY (`CodiceLibro`) REFERENCES `libro` (`CodiceLibro`);

--
-- Limiti per la tabella `prestito`
--
ALTER TABLE `prestito`
  ADD CONSTRAINT `prestito_ibfk_1` FOREIGN KEY (`CodicePrenotazione`) REFERENCES `prenota` (`CodicePrenotazione`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
