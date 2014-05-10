-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2014 at 09:25 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `piks_mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(15) NOT NULL,
  PRIMARY KEY (`categoryId`),
  KEY `categoryId` (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Funny'),
(2, 'Cool'),
(3, 'Political'),
(4, 'Scenery'),
(5, 'Music'),
(6, 'Animals'),
(7, 'Selfie & Cute');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `picName` varchar(64) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `authorEmail` varchar(256) DEFAULT NULL,
  `uploadedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`ID`, `picName`, `categoryID`, `authorEmail`, `uploadedDate`) VALUES
(41, '6e05a68bf2521c98d4a0e05f06afc0a5.jpg', 5, NULL, '2014-05-10 19:03:47'),
(42, 'c4a4691eb02ab25727782147f49ba606.jpg', 1, NULL, '2014-05-10 19:06:34'),
(43, 'b9c8b939dc6f90e2aa827686116c5433.jpg', 6, NULL, '2014-05-10 19:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `voteID` int(11) NOT NULL,
  `upVotes` bigint(20) NOT NULL,
  `downVotes` bigint(20) NOT NULL,
  `reports` int(11) NOT NULL,
  UNIQUE KEY `picID` (`voteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voteID`, `upVotes`, `downVotes`, `reports`) VALUES
(41, 0, 0, 0),
(42, 0, 0, 0),
(43, 0, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voteID`) REFERENCES `pictures` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
