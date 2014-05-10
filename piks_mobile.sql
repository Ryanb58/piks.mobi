-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2014 at 02:22 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Funny');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`ID`, `picName`, `categoryID`, `authorEmail`, `uploadedDate`) VALUES
(27, '36f34c72743b41940972cd5f3de0442e.jpg', 1, NULL, '2014-05-10 06:44:54'),
(28, '5f4c5e13cc3f1d77a4af7b1c067731bf.jpg', 1, NULL, '2014-05-10 06:44:57'),
(29, 'b4a894f4856c79967a47b2974614a8f1.jpg', 1, NULL, '2014-05-10 06:45:00'),
(30, 'b602f7aed638ce92c740cdbc6d1bdbdf.jpg', 1, NULL, '2014-05-10 06:45:02'),
(31, '6a17caad71989830d740d91288a88250.jpg', 1, NULL, '2014-05-10 06:45:09'),
(32, '653e9b127af5f3b43831bc4f4777fb8c.jpg', 1, NULL, '2014-05-10 06:45:11'),
(33, 'f3033d3453e0498797d09961bdedba1c.jpg', 1, NULL, '2014-05-10 06:45:18'),
(35, 'b33d61ce55bc15916a4f71f757abc03f.jpg', 0, NULL, '2014-05-10 12:21:20');

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
