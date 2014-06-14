-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Jun 2014 um 23:26
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `cmdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kontakt`
--

CREATE TABLE IF NOT EXISTS `kontakt` (
  `cId` int(11) NOT NULL AUTO_INCREMENT,
  `cCrtDate` date NOT NULL,
  `cCrtUser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cUpdtDate` date NOT NULL,
  `cUpdtUser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cVName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cNName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cCompany` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cCity` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cBirthDay` date NOT NULL,
  `cMail` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cPhone` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `kontakt`
--

INSERT INTO `kontakt` (`cId`, `cCrtDate`, `cCrtUser`, `cUpdtDate`, `cUpdtUser`, `cVName`, `cNName`, `cCompany`, `cCity`, `cBirthDay`, `cMail`, `cPhone`) VALUES
(1, '2012-01-08', 'admin', '2012-01-08', 'admin', 'B.', 'Obama', 'US State', 'Hawai', '1956-01-08', 'obama@care.gov', '0800666666'),
(2, '2012-03-08', 'admin', '2013-11-07', 'user', 'H.', 'Schmidt', 'Kanzleramt', 'Kalk', '1945-01-08', 'schmidt@raucherkette.de', ''),
(3, '2014-03-08', 'admin', '2014-01-01', 'admin', 'W.', 'Brandt', 'Kanzleramt', 'Brunsbuettel', '1914-01-08', 'deutschland@brandt.de', ''),
(4, '2013-11-21', 'user', '2013-12-24', 'user', 'H.', 'Kohl', 'Kanzleramt', 'Rostock', '1948-01-08', 'schwarzkonto@kohl.de', ''),
(5, '2013-11-21', 'admin', '2012-05-09', 'admin', 'B.', 'Rocky', 'Box', 'Arena', '1980-01-08', 'rocky@adrian.com', ''),
(6, '2013-11-21', 'user', '2012-08-08', 'admin', 'B.', 'Clinton', 'US State', 'Hawana', '1961-01-08', 'clinton@practice.gov', ''),
(7, '2013-11-21', 'admin', '2014-02-08', 'admin', 'G.', 'Bush', 'US State', 'Teheran', '1983-01-08', 'bush@standard-oil.gov', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
