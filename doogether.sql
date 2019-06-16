-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2019 at 08:28 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doogether`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbmenu`
--

DROP TABLE IF EXISTS `tbmenu`;
CREATE TABLE IF NOT EXISTS `tbmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namamenu` varchar(50) NOT NULL,
  `harga` float NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbmenu`
--

INSERT INTO `tbmenu` (`id`, `namamenu`, `harga`, `keterangan`) VALUES
(1, 'Paket A', 200000, 'Nasi,1Lauk,2Sayur,Minum'),
(2, 'Paket B', 150000, 'Nasi,1Lauk,1Sayur,Minum');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

DROP TABLE IF EXISTS `tbuser`;
CREATE TABLE IF NOT EXISTS `tbuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `authkey` varchar(20) NOT NULL,
  `accessToken` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id`, `username`, `password`, `authkey`, `accessToken`) VALUES
(1, 'coba', 'coba', 'coba', 'coba'),
(2, 'test', 'test', 'test', 'test');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
