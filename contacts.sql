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
-- Tabellenstruktur für Tabelle `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `cId` int(11) NOT NULL AUTO_INCREMENT,
  `cCrtDate` date NOT NULL,
  `cCrtUser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cUpdtDate` date NOT NULL,
  `cUpdtUser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cBirthDay` date NOT NULL,
  `cCity` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cMail` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cNotes` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `contacts`
--

INSERT INTO `contacts` (`cId`, `cCrtDate`, `cCrtUser`, `cUpdtDate`, `cUpdtUser`, `cName`, `cBirthDay`, `cCity`, `cMail`, `cNotes`) VALUES
(1, '2012-01-08', 'admin', '2012-01-08', 'admin', 'Obama', '1956-01-08', 'Hawai', 'obama@care.gov', 'Auch das ist noch zu tun'),
(2, '2012-03-08', 'admin', '2013-11-07', 'user', 'Schmidt', '1945-01-08', 'Kalk', 'schmidt@raucherkette.de', ''),
(3, '2014-03-08', 'admin', '2014-01-01', 'admin', 'Brandt', '1914-01-08', 'Brunsbuettel', 'deutschland@brandt.de', ''),
(4, '2013-11-21', 'user', '2013-12-24', 'user', 'Kohl', '1948-01-08', 'Rostock', 'schwarzkonto@kohl.de', 'Hier das ist noch zu tun'),
(5, '2013-11-21', 'admin', '2012-05-09', 'admin', 'Rocky', '1980-01-08', 'Arena', 'rocky@adrian.com', 'Noch mehr ist zu tun'),
(6, '2013-11-21', 'user', '2012-08-08', 'admin', 'Clinton', '1961-01-08', 'Hawana', 'clinton@practice.gov', 'Das ist noch zu tun'),
(7, '2013-11-21', 'admin', '2014-02-08', 'admin', 'Bush', '1983-01-08', 'Teheran', 'bush@standard-oil.gov', 'Jenes ist noch zu tun');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
