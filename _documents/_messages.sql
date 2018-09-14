-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2018 at 03:08 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `proethos`
--

-- --------------------------------------------------------

--
-- Table structure for table `_messages`
--

CREATE TABLE IF NOT EXISTS `_messages` (
`id_msg` bigint(20) unsigned NOT NULL,
  `msg_pag` text,
  `msg_language` char(5) NOT NULL,
  `msg_field` char(60) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_ativo` int(11) NOT NULL,
  `msg_update` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8734 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_messages`
--
ALTER TABLE `_messages`
 ADD UNIQUE KEY `id_msg` (`id_msg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_messages`
--
ALTER TABLE `_messages`
MODIFY `id_msg` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8734;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
