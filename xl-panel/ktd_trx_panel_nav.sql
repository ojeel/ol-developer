-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2018 at 06:05 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kt.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `ktd_trx_panel_nav`
--

CREATE TABLE `ktd_trx_panel_nav` (
  `id` int(10) NOT NULL,
  `panel_id` varchar(50) NOT NULL,
  `nav_title` varchar(200) NOT NULL,
  `nav_slug` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_subnav` varchar(3) NOT NULL DEFAULT 'No',
  `parent_id` int(10) DEFAULT NULL,
  `nav_icon` varchar(100) DEFAULT NULL,
  `short_value` int(3) NOT NULL DEFAULT '0',
  `page_title` varchar(200) NOT NULL,
  `page_src` varchar(250) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ktd_trx_panel_nav`
--
ALTER TABLE `ktd_trx_panel_nav`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ktd_trx_panel_nav`
--
ALTER TABLE `ktd_trx_panel_nav`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
