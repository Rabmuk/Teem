-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2014 at 08:48 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rabserve_teem`
--
CREATE DATABASE IF NOT EXISTS `rabserve_teem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rabserve_teem`;

-- --------------------------------------------------------

--
-- Table structure for table `agendaitems`
--

CREATE TABLE IF NOT EXISTS `agendaitems` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_meeting` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` varchar(0) DEFAULT NULL,
  `allotedTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `id_meeting` (`id_meeting`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `freetime`
--

CREATE TABLE IF NOT EXISTS `freetime` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `dayOfWeek` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groupmeeting`
--

CREATE TABLE IF NOT EXISTS `groupmeeting` (
  `meeting_id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `name` varchar(0) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`meeting_id`),
  KEY `id_group` (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupmembers`
--

CREATE TABLE IF NOT EXISTS `groupmembers` (
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_group` (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `name` varchar(0) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `id_owner` (`id_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agendaitems`
--
ALTER TABLE `agendaitems`
  ADD CONSTRAINT `agendaitems_ibfk_1` FOREIGN KEY (`id_meeting`) REFERENCES `groupmeeting` (`meeting_id`),
  ADD CONSTRAINT `agendaitems_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `freetime`
--
ALTER TABLE `freetime`
  ADD CONSTRAINT `freetime_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `groupmeeting`
--
ALTER TABLE `groupmeeting`
  ADD CONSTRAINT `groupmeeting_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD CONSTRAINT `groupmembers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `groupmembers_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
