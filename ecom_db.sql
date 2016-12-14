-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2016 at 01:41 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `fullname` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `mobilenumber` varchar(15) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE IF NOT EXISTS `product_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `code` varchar(25) NOT NULL,
  `audience` varchar(25) NOT NULL,
  `image` text NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `name`, `type`, `code`, `audience`, `image`, `price`) VALUES
(1, 'Female Danshiki', 'smock', 'da001', 'women', 'images/danshiki2.jpg', 35),
(2, 'Male Danshiki', 'smock', 'da002', 'men', 'images/danshiki3.jpg', 45),
(3, 'Kids Danshiki', 'smock', 'da003', 'kids', 'images/danshiki4.jpg', 20),
(4, 'Kids Danshiki ', 'smock', 'da004', 'kids', 'images/danshiki5.jpg', 20),
(5, 'Kids Danshiki', 'smock', 'da005', 'kids', 'images/danshiki6.jpg', 25),
(6, 'Female Danshiki', 'smock', 'da0006', 'women', 'images/danshiki7.jpg', 35),
(7, 'Unisex Danshiki', 'smock', 'da0007', 'men', 'images/danshiki8.jpg', 30),
(8, 'Unisex Danshiki', 'smock', 'da0008', 'women', 'images/danshiki9.jpg', 30),
(9, 'Unisex Danshiki', 'smock', 'da0009', 'men', 'images/danshiki10.jpg', 30),
(10, 'Danshiki Leggings', 'smock', 'da0010', 'women', 'images/danshiki11.jpg', 25),
(11, 'Danshiki ', 'smock', 'da0011', 'women', 'images/danshiki12.jpg', 40),
(12, 'Danshiki Men', 'smock', 'da0012', 'men', 'images/danshiki13.jpg', 30),
(13, 'Danshiki ', 'smock', 'da0013', 'women', 'images/danshiki14.jpg', 45),
(14, 'Danshiki', 'smock', 'da0014', 'women', 'images/danshiki15.jpg', 50),
(15, 'Danshiki', 'smock', 'da0015', 'men', 'images/danshiki16.jpg', 30),
(16, 'Kid Danshiki', 'smock', 'da0016', 'kids', 'images/danshiki17.jpg', 50),
(17, 'Danshiki', 'smock', 'da0017', 'women', 'images/danshiki18.jpg', 45),
(18, 'Kente', 'kente', 'ke001', 'men', 'images/kente3.jpg', 150),
(19, 'Kente', 'kente', 'ke002', 'women', 'images/kente1.jpg', 200),
(20, 'Kente', 'kente', 'ke003', 'male', 'images/kente2.jpg', 150),
(21, 'Smock', 'smock', 'sm001', 'men', 'images/smock1.jpg', 90),
(22, 'Smock', 'smock', 'sm002', 'men', 'images/smock2.jpg', 70),
(23, 'Smock', 'smock', 'sm003', 'men', 'images/smock3.jpg', 80),
(24, 'Smock', 'smock', 'sm004', 'men', 'images/smock4.jpg', 110),
(25, 'Smock', 'smock', 'sm005', 'men', 'images/smock5.jpg', 60);

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE IF NOT EXISTS `users_tbl` (
  `fullname` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `cpassword` varchar(25) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`fullname`, `email`, `dob`, `telephone`, `username`, `password`, `cpassword`) VALUES
('tunji', 'email@gmail.com', '2016-04-04', '986492346', 'teejay', 'teejay', 'teejay');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
