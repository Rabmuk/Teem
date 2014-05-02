-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2014 at 09:45 PM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rabserve_teem`
--

-- --------------------------------------------------------

--
-- Table structure for table `actionItems`
--

CREATE TABLE IF NOT EXISTS `actionItems` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_meeting` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `action` varchar(512) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `id_meeting` (`id_meeting`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `agendaItems`
--

CREATE TABLE IF NOT EXISTS `agendaItems` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_meeting` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `heading` varchar(512) DEFAULT NULL,
  `allottedMinutes` int(11) DEFAULT NULL,
  `itemOrder` int(10) DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `agendaItems_ibfk_1` (`id_meeting`),
  KEY `agendaItems_ibfk_2` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_item` int(10) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `location` varchar(512) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groupMembers`
--

CREATE TABLE IF NOT EXISTS `groupMembers` (
  `id_group` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  KEY `id_group` (`id_group`),
  KEY `id_user` (`id_user`),
  KEY `id_group_2` (`id_group`),
  KEY `id_user_2` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_owner` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `id_owner` (`id_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meetingMembers`
--

CREATE TABLE IF NOT EXISTS `meetingMembers` (
  `id_meeting` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  KEY `id_meeting` (`id_meeting`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `meeting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_owner` int(10) unsigned NOT NULL,
  `title` varchar(512) CHARACTER SET utf8 NOT NULL DEFAULT 'No Title',
  `description` varchar(8000) CHARACTER SET utf8 DEFAULT NULL,
  `location` varchar(512) NOT NULL DEFAULT 'No Location Set',
  `date` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  PRIMARY KEY (`meeting_id`),
  KEY `meeting_id` (`meeting_id`),
  KEY `id_owner` (`id_owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id_item` int(10) unsigned NOT NULL,
  `topic` varchar(256) CHARACTER SET utf8 NOT NULL,
  KEY `id_item` (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(512) NOT NULL,
  `salt` varchar(512) NOT NULL,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actionItems`
--
ALTER TABLE `actionItems`
  ADD CONSTRAINT `actionItems_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actionItems_ibfk_1` FOREIGN KEY (`id_meeting`) REFERENCES `meetings` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agendaItems`
--
ALTER TABLE `agendaItems`
  ADD CONSTRAINT `agendaItems_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agendaItems_ibfk_1` FOREIGN KEY (`id_meeting`) REFERENCES `meetings` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groupMembers`
--
ALTER TABLE `groupMembers`
  ADD CONSTRAINT `groupMembers_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupMembers_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meetingMembers`
--
ALTER TABLE `meetingMembers`
  ADD CONSTRAINT `meetingMembers_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meetingMembers_ibfk_1` FOREIGN KEY (`id_meeting`) REFERENCES `meetings` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `agendaItems` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
