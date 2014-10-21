-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2014 at 02:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eatit`
--

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE IF NOT EXISTS `klant` (
  `klantennummer` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `voornaam` text NOT NULL,
  `achternaam` text NOT NULL,
  `telefoonnummer` int(50) NOT NULL,
  `plaats` text NOT NULL,
  `adres` text NOT NULL,
  `postcode` varchar(40) NOT NULL,
  `wachtwoord` varchar(40) NOT NULL,
  `permissies` text NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `klantennummer` (`klantennummer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`klantennummer`, `email`, `voornaam`, `achternaam`, `telefoonnummer`, `plaats`, `adres`, `postcode`, `wachtwoord`, `permissies`) VALUES
(1, '3thijs.kuilman@gmail.com', 'ok', 'ok', 0, '90', '09', '09', '123456', 'lid'),
(3, 'eend@assdf.com', '89', '89', 89, '89', '89', '89', '3637fd38', 'lid'),
(4, 'haas@konijn.nl', 'Konijn', 'haas', 61161616, 'efeok', 'ok', 'od', '123456', 'lid'),
(2, 'sadasd@adsfs.com', '89', '89', 89, '89', '89', '89', '3e8d3bf6', 'lid');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
