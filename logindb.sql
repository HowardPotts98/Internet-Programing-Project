-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 15, 2020 at 07:50 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(45) NOT NULL,
  `password` varchar(90) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `created_at`) VALUES
('joe', '$2y$10$3p/9fxUQZxoltp32uetSFObUta3Etp2r8cm60CFak.WRBT8i9Ih/G', '2020-11-11 20:59:42'),
('bill', '$2y$10$co8IOHI7c5hl5g7OSz33pOJGEl.HA0FmleJ7YXIV7BafMyQQORaQ.', '2020-11-12 14:29:37'),
('kal', '$2y$10$IfrCSHKhMV9SuZzu7NzvFuxBFhTFM8dEjcMv8TGgLEh1DMk41Ipe.', '2020-11-12 16:54:49'),
('kalel', '$2y$10$3pYPp0S44ZB4HqucD5.NKuTuVJY8oTgZkZz7OKvvLmvnZU.xdsAqm', '2020-11-12 17:04:03'),
('timmy', '$2y$10$jjnnKXN2c9OcF/zadxwm2uekNDiXFwg0ow6p.0Goy5PD4HvRftiTS', '2020-11-13 13:24:31');
COMMIT;


--
-- Table structure for table `msgchat`
--
DROP TABLE IF EXISTS `msgchat`;
CREATE TABLE IF NOT EXISTS `msgchat` (
  `username` varchar(45) NOT NULL,
  `msg` varchar(225) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`username`) REFERENCES users(`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Dumping data for table `msgchat`
--

INSERT INTO 'msgchat' (`username`, 'msg', 'date') VALUES
('joe','Hello World', CURRENT_TIMESTAMP),
('timmy','Hello World', CURRENT_TIMESTAMP)
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
