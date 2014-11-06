-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 06 nov 2014 om 08:27
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `eatit`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aantalartverkocht`
--

CREATE TABLE IF NOT EXISTS `aantalartverkocht` (
  `BestNR` int(11) NOT NULL,
  `ArtNR` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`BestNR`,`ArtNR`),
  KEY `AantalArtVerkocht_Artikelen_FK` (`ArtNR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aantalingredienten`
--

CREATE TABLE IF NOT EXISTS `aantalingredienten` (
  `AiNR` int(11) NOT NULL AUTO_INCREMENT,
  `GerNR` int(11) NOT NULL,
  `ArtNR` int(11) NOT NULL,
  `ING_Aantal` int(11) NOT NULL,
  PRIMARY KEY (`AiNR`),
  KEY `Aantalingredienten_Artikelen_FK` (`ArtNR`),
  KEY `Aantalingredienten_Gerecht_FK` (`GerNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Gegevens worden geëxporteerd voor tabel `aantalingredienten`
--

INSERT INTO `aantalingredienten` (`AiNR`, `GerNR`, `ArtNR`, `ING_Aantal`) VALUES
(4, 2, 1, 1),
(5, 2, 3, 4),
(9, 1, 3, 2),
(10, 1, 1, 3),
(11, 1, 2, 5),
(23, 4, 2, 6),
(24, 4, 1, 5),
(25, 3, 2, 3),
(26, 3, 1, 3),
(27, 3, 5, 4),
(28, 3, 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `aantalverkocht`
--

CREATE TABLE IF NOT EXISTS `aantalverkocht` (
  `BestNR` int(11) NOT NULL,
  `GerNR` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`BestNR`,`GerNR`),
  KEY `AantalVerkocht_Gerecht_FK` (`GerNR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `aantalverkocht`
--

INSERT INTO `aantalverkocht` (`BestNR`, `GerNR`, `Aantal`) VALUES
(3, 1, 3),
(3, 2, 2),
(4, 2, 4),
(5, 2, 20),
(6, 1, 22),
(7, 1, 4),
(8, 3, 12),
(9, 3, 3),
(10, 3, 3),
(11, 2, 2),
(12, 2, 1),
(13, 2, 17),
(14, 2, 17),
(15, 2, 17),
(16, 2, 17),
(17, 2, 17),
(18, 2, 1),
(19, 2, 3),
(20, 2, 17),
(21, 2, 17),
(22, 2, 17),
(23, 2, 1),
(24, 2, 4),
(25, 2, 3),
(26, 2, 13),
(27, 2, 3),
(28, 2, 19),
(29, 2, 5),
(30, 1, 20),
(31, 3, 3),
(32, 1, 3),
(32, 3, 4),
(33, 3, 1),
(33, 4, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afdeling`
--

CREATE TABLE IF NOT EXISTS `afdeling` (
  `AfdNR` int(11) NOT NULL AUTO_INCREMENT,
  `AFD_Naam` varchar(30) NOT NULL,
  `AFD_Manager` int(11) DEFAULT NULL,
  PRIMARY KEY (`AfdNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden geëxporteerd voor tabel `afdeling`
--

INSERT INTO `afdeling` (`AfdNR`, `AFD_Naam`, `AFD_Manager`) VALUES
(1, 'Directie', 1),
(2, 'Expeditie', 6),
(3, 'Administratie', 3),
(4, 'Financiële administratie', 4),
(5, 'Personeelsadministratie', 5),
(6, 'Commerciele afdeling', 7),
(7, 'Inkoop', 7),
(8, 'Verkoop', 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelen`
--

CREATE TABLE IF NOT EXISTS `artikelen` (
  `ArtNR` int(11) NOT NULL AUTO_INCREMENT,
  `ART_Naam` varchar(30) DEFAULT NULL,
  `ART_TechnischeVoorraad` int(11) DEFAULT NULL,
  `ART_InBestelling` int(11) DEFAULT NULL,
  `ART_Gereserveerd` int(11) DEFAULT NULL,
  `ART_BestelNiveau` int(11) DEFAULT NULL,
  `ART_Leverancier` int(11) DEFAULT NULL,
  `ART_Prijs` double DEFAULT NULL,
  PRIMARY KEY (`ArtNR`),
  KEY `Artikelen_Leverancier_FK` (`ART_Leverancier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden geëxporteerd voor tabel `artikelen`
--

INSERT INTO `artikelen` (`ArtNR`, `ART_Naam`, `ART_TechnischeVoorraad`, `ART_InBestelling`, `ART_Gereserveerd`, `ART_BestelNiveau`, `ART_Leverancier`, `ART_Prijs`) VALUES
(1, 'Pesto', 20, -8, -195, 60, 1, 0.8),
(2, 'Mais', -11, 37, -124, 40, 2, 0.75),
(3, 'Ingredient67', -192, 24, -492, 42, 2, 1.2),
(4, 'Ingredient12', 496, 10, -4, 8, 2, 2.2),
(5, 'Bier', 87, 0, -16, 8, 2, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE IF NOT EXISTS `bestelling` (
  `BestNR` int(11) NOT NULL AUTO_INCREMENT,
  `KlantNR` int(11) NOT NULL,
  `MedNR` int(11) DEFAULT NULL,
  `BEST_Datum` date NOT NULL,
  `BEST_Status` varchar(20) NOT NULL,
  PRIMARY KEY (`BestNR`),
  KEY `Bestelling_Klant_FK` (`KlantNR`),
  KEY `Bestelling_Medewerkers_FK` (`MedNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`BestNR`, `KlantNR`, `MedNR`, `BEST_Datum`, `BEST_Status`) VALUES
(3, 2, 3, '2014-11-05', 'bezorgen'),
(4, 3, 8, '2014-11-20', 'afgerond'),
(5, 1, NULL, '2014-11-05', 'afgerond'),
(6, 1, NULL, '2014-11-05', 'afgerond'),
(7, 1, NULL, '2014-11-05', 'afgerond'),
(8, 1, NULL, '2014-11-05', 'afgerond'),
(9, 1, NULL, '2014-11-05', 'afgerond'),
(10, 1, NULL, '2014-11-05', 'afgerond'),
(11, 1, NULL, '2014-11-05', 'afgerond'),
(12, 1, NULL, '2014-11-05', 'afgerond'),
(13, 1, NULL, '2014-11-05', 'afgerond'),
(14, 1, NULL, '2014-11-05', 'afgerond'),
(15, 1, NULL, '2014-11-05', 'afgerond'),
(16, 1, NULL, '2014-11-05', 'afgerond'),
(17, 1, NULL, '2014-11-05', 'afgerond'),
(18, 1, NULL, '2014-11-05', 'afgerond'),
(19, 1, NULL, '2014-11-05', 'afgerond'),
(20, 1, NULL, '2014-11-05', 'afgerond'),
(21, 1, NULL, '2014-11-05', 'afgerond'),
(22, 1, NULL, '2014-11-05', 'afgerond'),
(23, 1, NULL, '2014-11-05', 'afgerond'),
(24, 1, NULL, '2014-11-05', 'afgerond'),
(25, 1, NULL, '2014-11-05', 'afgerond'),
(26, 1, NULL, '2014-11-05', 'afgerond'),
(27, 1, NULL, '2014-11-05', 'afgerond'),
(28, 1, NULL, '2014-11-06', 'afgerond'),
(29, 1, NULL, '2014-11-06', 'afgerond'),
(30, 1, NULL, '2014-11-06', 'afgerond'),
(31, 1, NULL, '2014-11-06', 'bezorgen'),
(32, 1, NULL, '2014-11-06', 'besteld'),
(33, 1, NULL, '2014-11-06', 'afgerond');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelorder`
--

CREATE TABLE IF NOT EXISTS `bestelorder` (
  `ArtNR` int(11) NOT NULL,
  `OrderNR` int(11) NOT NULL,
  `Aantal` int(11) DEFAULT NULL,
  PRIMARY KEY (`ArtNR`,`OrderNR`),
  KEY `Bestelorder_Inkooporder_FK` (`OrderNR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestelorder`
--

INSERT INTO `bestelorder` (`ArtNR`, `OrderNR`, `Aantal`) VALUES
(1, 7, 3),
(1, 13, 432),
(1, 14, 6665),
(1, 15, 233),
(1, 16, 3),
(1, 17, 12),
(1, 25, 3),
(1, 26, 31),
(1, 30, 12),
(1, 33, 1),
(1, 34, 4),
(1, 35, 11),
(2, 4, 1200),
(2, 9, 23),
(2, 10, 1),
(2, 11, 23),
(2, 12, 31),
(2, 22, 500),
(2, 23, 30),
(2, 24, 60),
(2, 27, 9000),
(2, 28, 1),
(2, 29, 3),
(2, 32, 30),
(3, 19, 10),
(4, 7, 1),
(5, 31, 23);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerecht`
--

CREATE TABLE IF NOT EXISTS `gerecht` (
  `GerNR` int(11) NOT NULL AUTO_INCREMENT,
  `GER_Naam` varchar(30) NOT NULL,
  `GER_Prijs` double DEFAULT NULL,
  `GER_Beschrijving` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`GerNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `gerecht`
--

INSERT INTO `gerecht` (`GerNR`, `GER_Naam`, `GER_Prijs`, `GER_Beschrijving`) VALUES
(1, 'Gerecht 1', 7.8, 'Lekkere gerecht vers gebakken uit de magnetron.'),
(2, 'Gerecht 2', 8.2, 'Gebraden varkensvlees met champignons'),
(3, 'Pizza met ketchup', 12.1, 'Lekker medium '),
(4, 'Hamburger', 3, 'Met extra jam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkoopfactuur`
--

CREATE TABLE IF NOT EXISTS `inkoopfactuur` (
  `InkfNR` int(11) NOT NULL AUTO_INCREMENT,
  `Inkf_Status` varchar(60) DEFAULT NULL,
  `Bedrag` int(11) NOT NULL,
  PRIMARY KEY (`InkfNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Gegevens worden geëxporteerd voor tabel `inkoopfactuur`
--

INSERT INTO `inkoopfactuur` (`InkfNR`, `Inkf_Status`, `Bedrag`) VALUES
(1, 'besteld', 1313131),
(17, 'verwerken', 10),
(19, 'verwerken', 12),
(22, 'verwerken', 375),
(23, 'verwerken', 23),
(24, 'verwerken', 45),
(25, 'verwerken', 2),
(26, 'verwerken', 25),
(27, 'geleverd', 0),
(28, 'geleverd', 10),
(29, 'geleverd', 46),
(30, 'besteld', 23),
(31, 'geleverd', 1),
(32, 'geleverd', 3),
(33, 'geleverd', 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporder`
--

CREATE TABLE IF NOT EXISTS `inkooporder` (
  `OrderNR` int(11) NOT NULL AUTO_INCREMENT,
  `IngNR` int(11) NOT NULL,
  `LevNR` int(11) NOT NULL,
  `Aantal` int(11) DEFAULT NULL,
  PRIMARY KEY (`OrderNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Gegevens worden geëxporteerd voor tabel `inkooporder`
--

INSERT INTO `inkooporder` (`OrderNR`, `IngNR`, `LevNR`, `Aantal`) VALUES
(1, 1, 2, 3),
(2, 0, 0, 0),
(3, 0, 0, 0),
(4, 0, 0, 0),
(5, 0, 0, 0),
(6, 0, 0, 0),
(7, 0, 0, 0),
(8, 0, 0, 0),
(9, 0, 0, 0),
(10, 0, 0, 0),
(11, 0, 0, 0),
(12, 0, 0, 0),
(13, 0, 0, 0),
(14, 0, 0, 0),
(15, 0, 0, 0),
(16, 0, 0, 0),
(17, 0, 0, 0),
(18, 0, 0, 0),
(19, 0, 0, 0),
(20, 0, 0, 0),
(21, 0, 0, 0),
(22, 0, 0, 0),
(23, 0, 0, 0),
(24, 0, 0, 0),
(25, 0, 0, 0),
(26, 0, 0, 0),
(27, 0, 0, 9000),
(28, 0, 0, 1),
(29, 0, 27, 3),
(30, 0, 28, 12),
(31, 0, 29, 23),
(32, 2, 30, 30),
(33, 1, 31, 1),
(34, 1, 32, 4),
(35, 1, 33, 11);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE IF NOT EXISTS `klant` (
  `KlantNR` int(11) NOT NULL AUTO_INCREMENT,
  `KL_Voornaam` varchar(20) NOT NULL,
  `KL_Achternaam` varchar(20) NOT NULL,
  `KL_Telefoonnummer` varchar(16) NOT NULL,
  `KL_Mail` varchar(60) NOT NULL,
  `KL_Plaats` varchar(30) NOT NULL,
  `KL_Adres` varchar(30) NOT NULL,
  `KL_Postcode` varchar(6) NOT NULL,
  `KL_Wachtwoord` varchar(60) NOT NULL,
  PRIMARY KEY (`KlantNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`KlantNR`, `KL_Voornaam`, `KL_Achternaam`, `KL_Telefoonnummer`, `KL_Mail`, `KL_Plaats`, `KL_Adres`, `KL_Postcode`, `KL_Wachtwoord`) VALUES
(1, 'Pieter', 'Halveliter', '0621345647', 'pieterhalveliter@mail.com', 'Haarlem', 'Straat 6', '1244PO', 'Wachtwoord'),
(2, 'Kees', 'Meijer', '0598-542147', 'keesmeijer@mail.com', 'Veendam', 'Oosterdiep 34', '4532YS', 'Password'),
(3, 'Sjaak', 'de Vries', '0597-654217', 'sjaakdevries@mail.com', 'Oude Pekela', 'Steenweg 41', '2104WQ', 'Welkom12'),
(4, 'Linda', 'Klaassens', '050-5421789', 'lindaklaassens@mail.com', 'Groningen', 'Groningerweg 87', '6542RG', 'ABCD1234'),
(5, 'Marith', 'Bos', '050-2314879', 'marithbos@mail.com', 'Groningen', 'Paddepoel 45', '0214ZE', 'HelloWorld'),
(6, 'Klaas', 'Pietersen', '0632323232', 'test@test.com', 'Hoogeveen', 'Doornstraat 23', '2624AP', 'Wachtwoord');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leverancier`
--

CREATE TABLE IF NOT EXISTS `leverancier` (
  `LevNR` int(11) NOT NULL AUTO_INCREMENT,
  `LEV_Naam` varchar(30) NOT NULL,
  `LEV_Telefoonnummer` varchar(16) DEFAULT NULL,
  `LEV_Mail` varchar(60) DEFAULT NULL,
  `LEV_Plaats` varchar(30) DEFAULT NULL,
  `LEV_Adres` varchar(30) DEFAULT NULL,
  `LEV_Postcode` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`LevNR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden geëxporteerd voor tabel `leverancier`
--

INSERT INTO `leverancier` (`LevNR`, `LEV_Naam`, `LEV_Telefoonnummer`, `LEV_Mail`, `LEV_Plaats`, `LEV_Adres`, `LEV_Postcode`) VALUES
(1, 'Smiths', '050-9854781', 'infosmiths@smithsbv.nl', 'Groningen', 'Slingerweg 87', '6565MO'),
(2, 'LekkerLekker', '0595-874120', 'infolekkerlekker@lekkerlekker.nl', 'Winsum', 'Diepdal 98', '3214HW');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

CREATE TABLE IF NOT EXISTS `medewerkers` (
  `MedNR` int(11) NOT NULL AUTO_INCREMENT,
  `MED_Voornaam` varchar(20) NOT NULL,
  `MED_Achternaam` varchar(20) NOT NULL,
  `MED_Mail` varchar(60) DEFAULT NULL,
  `MED_Telefoonnummer` varchar(16) DEFAULT NULL,
  `MED_Plaats` varchar(30) DEFAULT NULL,
  `MED_Adres` varchar(30) DEFAULT NULL,
  `MED_Postcode` varchar(6) DEFAULT NULL,
  `MED_Wachtwoord` varchar(60) DEFAULT NULL,
  `Afdeling` int(11) DEFAULT NULL,
  `Manager_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`MedNR`),
  KEY `Medewerkers_Afdeling_FK` (`Afdeling`),
  KEY `Medewerkers_Medewerkers_FK` (`Manager_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden geëxporteerd voor tabel `medewerkers`
--

INSERT INTO `medewerkers` (`MedNR`, `MED_Voornaam`, `MED_Achternaam`, `MED_Mail`, `MED_Telefoonnummer`, `MED_Plaats`, `MED_Adres`, `MED_Postcode`, `MED_Wachtwoord`, `Afdeling`, `Manager_ID`) VALUES
(1, 'Inge', 'Achternaam', 'ingeachternaam@eatit.com', '050-9658741', 'Groningen', 'Langestraat 23', '1122AB', 'Wachtwoord', 2, NULL),
(2, 'Tim', 'Achter', 'timachter@eatit.com', '050-5423157', 'Groningen', 'Krommebocht 36', '4488ZB', 'Wachtwoord', 1, NULL),
(3, 'Pietersen', 'de Vries', 'jeroendevries@eatit.com', '0597-542168', 'Stadskanaal', 'Kanaal 12', '8465MN', 'Wachtwoord', 3, 1),
(4, 'Bert', 'Bartels', 'bertbartels@eatit.com', '0598-645217', 'Veendam', 'Veenweg 156', '9998ZX', 'Wachtwoord', NULL, 2),
(5, 'Els', 'Zoon', 'elszoon@eatit.com', '050-3214574', 'Groningen', 'Grotemarkt', '4444PO', 'Wachtwoord', 5, 2),
(6, 'Gerard', 'van Holten', 'gerardvanholten@eatit.com', '0598-455215', 'Hoogezand', 'Laagzand 55', '9876RE', 'Wachtwoord', 6, 1),
(7, 'Hanneke', 'Scheepstra', 'hannekescheepstra@eatit.com', '0595-875412', 'Winsum', 'Kleinelaan 4', '2123QW', 'Wachtwoord', 5, 2),
(8, 'Lars', 'Pieters', 'larspieters@eatit.com', '050-2124456', 'Groningen', 'Grachtweg 7', '2134KJ', 'Wachtwoord', 2, 7),
(9, 'Henk', 'Henk', 'Henk@henk.com', '23', 'Henk', 'Henk', '123Hen', 'Wachtwoord', 7, 2),
(10, 'Henk', 'Pietersen', 'thijs.kuilman@gmail.com', '093820938', '23', '9', '9', '123123', 1, NULL),
(11, 'Slak', 'Huis', 'slak@hotmail.com', '06123', 'Schelp', 'Rodeschelp 21', '1000AS', '18eac215', 3, 7);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `aantalartverkocht`
--
ALTER TABLE `aantalartverkocht`
  ADD CONSTRAINT `AantalArtVerkocht_Artikelen_FK` FOREIGN KEY (`ArtNR`) REFERENCES `artikelen` (`ArtNR`),
  ADD CONSTRAINT `AantalArtVerkocht_Bestelling_FK` FOREIGN KEY (`BestNR`) REFERENCES `bestelling` (`BestNR`);

--
-- Beperkingen voor tabel `aantalingredienten`
--
ALTER TABLE `aantalingredienten`
  ADD CONSTRAINT `Aantalingredienten_Artikelen_FK` FOREIGN KEY (`ArtNR`) REFERENCES `artikelen` (`ArtNR`),
  ADD CONSTRAINT `Aantalingredienten_Gerecht_FK` FOREIGN KEY (`GerNR`) REFERENCES `gerecht` (`GerNR`);

--
-- Beperkingen voor tabel `aantalverkocht`
--
ALTER TABLE `aantalverkocht`
  ADD CONSTRAINT `AantalVerkocht_Bestelling_FK` FOREIGN KEY (`BestNR`) REFERENCES `bestelling` (`BestNR`),
  ADD CONSTRAINT `AantalVerkocht_Gerecht_FK` FOREIGN KEY (`GerNR`) REFERENCES `gerecht` (`GerNR`);

--
-- Beperkingen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD CONSTRAINT `Artikelen_Leverancier_FK` FOREIGN KEY (`ART_Leverancier`) REFERENCES `leverancier` (`LevNR`);

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `Bestelling_Klant_FK` FOREIGN KEY (`KlantNR`) REFERENCES `klant` (`KlantNR`),
  ADD CONSTRAINT `Bestelling_Medewerkers_FK` FOREIGN KEY (`MedNR`) REFERENCES `medewerkers` (`MedNR`);

--
-- Beperkingen voor tabel `bestelorder`
--
ALTER TABLE `bestelorder`
  ADD CONSTRAINT `Bestelorder_Artikelen_FK` FOREIGN KEY (`ArtNR`) REFERENCES `artikelen` (`ArtNR`),
  ADD CONSTRAINT `Bestelorder_Inkooporder_FK` FOREIGN KEY (`OrderNR`) REFERENCES `inkooporder` (`OrderNR`);

--
-- Beperkingen voor tabel `inkoopfactuur`
--
ALTER TABLE `inkoopfactuur`
  ADD CONSTRAINT `Inkoopfactuur_Inkooporder_FK` FOREIGN KEY (`InkfNR`) REFERENCES `inkooporder` (`OrderNR`);

--
-- Beperkingen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  ADD CONSTRAINT `Medewerkers_Afdeling_FK` FOREIGN KEY (`Afdeling`) REFERENCES `afdeling` (`AfdNR`),
  ADD CONSTRAINT `Medewerkers_Medewerkers_FK` FOREIGN KEY (`Manager_ID`) REFERENCES `medewerkers` (`MedNR`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
