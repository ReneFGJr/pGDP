-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2018 at 12:01 AM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pgdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `dcr_plans`
--

CREATE TABLE IF NOT EXISTS `dcr_plans` (
`id_p` bigint(20) unsigned NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_update` date DEFAULT NULL,
  `p_user` int(11) DEFAULT NULL,
  `p_templat` int(11) DEFAULT NULL,
  `p_test` int(11) DEFAULT '0',
  `p_visibility` int(11) DEFAULT '0',
  `p_status` int(11) DEFAULT '1',
  `p_shared` int(11) NOT NULL DEFAULT '0',
  `p_title` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dcr_plans`
--
ALTER TABLE `dcr_plans`
 ADD UNIQUE KEY `id_p` (`id_p`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dcr_plans`
--
ALTER TABLE `dcr_plans`
MODIFY `id_p` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
