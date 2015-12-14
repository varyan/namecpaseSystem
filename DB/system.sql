-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2015 at 08:39 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `vs_menus`
--

CREATE TABLE IF NOT EXISTS `vs_menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `linkURL` varchar(255) NOT NULL,
  `parentID` int(11) NOT NULL DEFAULT '0',
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vs_menus`
--

INSERT INTO `vs_menus` (`id`, `title`, `linkURL`, `parentID`, `updatedAt`) VALUES
(1, 'Home', '#banner', 0, '0000-00-00 00:00:00'),
(2, 'About', '#about', 0, '0000-00-00 00:00:00'),
(3, 'Services', '#services', 0, '0000-00-00 00:00:00'),
(4, 'Portfolio', '#portfolio', 0, '0000-00-00 00:00:00'),
(5, 'Clients', '#clients', 0, '0000-00-00 00:00:00'),
(6, 'Contact', '#contact', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vs_users`
--

CREATE TABLE IF NOT EXISTS `vs_users` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ipAddress` varchar(30) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vs_users`
--

INSERT INTO `vs_users` (`id`, `username`, `password`, `email`, `ipAddress`, `createdAt`, `updatedAt`) VALUES
(1, 'varyan', '98bfe7780b3044eba8560c4a35455a18', 'var-stepanyan@mail.ru', '192.168.200.11', '2015-12-13 21:27:46', '2015-12-13 21:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `vs_welcome`
--

CREATE TABLE IF NOT EXISTS `vs_welcome` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vs_menus`
--
ALTER TABLE `vs_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vs_users`
--
ALTER TABLE `vs_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vs_welcome`
--
ALTER TABLE `vs_welcome`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vs_menus`
--
ALTER TABLE `vs_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vs_users`
--
ALTER TABLE `vs_users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vs_welcome`
--
ALTER TABLE `vs_welcome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
