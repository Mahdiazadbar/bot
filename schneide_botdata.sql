-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2017 at 07:08 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schneide_botdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `seriallist`
--

CREATE TABLE `seriallist` (
  `id` int(11) NOT NULL,
  `ref_num` text COLLATE utf16_persian_ci NOT NULL,
  `startserial` text COLLATE utf16_persian_ci NOT NULL,
  `endserial` text COLLATE utf16_persian_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `total_use_qty` text COLLATE utf16_persian_ci NOT NULL,
  `oprator` text COLLATE utf16_persian_ci NOT NULL,
  `customer` text COLLATE utf16_persian_ci NOT NULL,
  `dateT` text COLLATE utf16_persian_ci NOT NULL,
  `roll_number` text COLLATE utf16_persian_ci NOT NULL,
  `fault_number` int(11) NOT NULL,
  `l` text COLLATE utf16_persian_ci NOT NULL,
  `m` text COLLATE utf16_persian_ci NOT NULL,
  `n` text COLLATE utf16_persian_ci NOT NULL,
  `o` text COLLATE utf16_persian_ci NOT NULL,
  `p` text COLLATE utf16_persian_ci NOT NULL,
  `q` text COLLATE utf16_persian_ci NOT NULL,
  `r` text COLLATE utf16_persian_ci NOT NULL,
  `s` text COLLATE utf16_persian_ci NOT NULL,
  `t` text COLLATE utf16_persian_ci NOT NULL,
  `y` text COLLATE utf16_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `seriallist`
--
ALTER TABLE `seriallist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seriallist`
--
ALTER TABLE `seriallist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
