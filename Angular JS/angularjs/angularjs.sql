-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2016 at 12:13 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angularjs`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(3) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `category_flag` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_flag`) VALUES
(1, 'Beaches', 1),
(2, 'Artists', 1),
(3, 'Restaurants', 1),
(4, 'Animals', 1),
(5, 'Mountains', 1),
(60, 'esdfssf', 1),
(61, 'esdfssfsd', 1),
(62, 'esdfss', 1),
(63, 'ssssss', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(3) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `flag` tinyint(3) DEFAULT NULL,
  `category_id` int(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `image`, `flag`, `category_id`) VALUES
(64, 'Boracay', 'syxm5tyP6LoEeKuUHiQc.jpg', NULL, 1),
(65, 'Dalaguete Beach Park', 'cJVDXVGMHbAKEnC8vQf1.png', NULL, 1),
(66, 'Lambug Beach in Badian', 'hBGdHAAgOBPzNumJozHP.png', NULL, 1),
(67, 'Moalboal Beach Resort', 'YJgvXUaPh2BRbYxao3rR.jpg', NULL, 1),
(68, 'Palm Beach Minglanilla Cebu', '3TogrCbfSfHmzCTcg4fQ.jpg', NULL, 1),
(69, 'Pandanon Island', '8sIVW7MuTSpaG632zDIH.jpg', NULL, 1),
(70, 'Sayaw Beach in Barili', 'FqPocHBby26wtLQt8IKE.png', NULL, 1),
(71, 'Sta. Fe Beach in Bantayan Island', 'hgj98fvzpZNZkm80AG0I.png', NULL, 1),
(72, 'Tingko Beach in Alcoy', 'rNnIz4I5ekZr7VFSsHIX.png', NULL, 1),
(92, 'Cat', 'aCa2S6UtuA9lyPd7c0XL.jpg', NULL, 4),
(93, 'Chicken', '0RIK3Al2YWb7O74WcPmY.jpg', NULL, 4),
(94, 'Cow', 'ejSdthZ52WxAv1QbZKLQ.jpg', NULL, 4),
(95, 'Dog', '4PE1QulIUramlUZWLB9W.jpg', NULL, 4),
(96, 'Goat', 'fKuio4lviMzwyAuOfJYm.jpg', NULL, 4),
(97, 'Horsesssssss', 'YVmCQntzqOGFQrOTEZdH.jpg', NULL, 4),
(98, 'Kitanglad Mountain Range, Bukidnon', 'bR5kZ9LXwhla15OxbUB9.jpg', NULL, 5),
(99, 'Mount Apo, Davao del Sur', 'eBICTuB2nrfZpN5zco8n.jpg', NULL, 5),
(100, 'Mount Banahaw, Quezon', 'uyPvsa8xRxyATw1eht1z.jpg', NULL, 5),
(101, 'Mount Kanla-on, Negros Occidental', 'gdvbw7Yci0najdbdLCmV.jpg', NULL, 5),
(102, 'Mount Pico de Loro, Cavite', 'pxnoqOcdyOjt0mFLvNJb.jpg', NULL, 5),
(103, 'Mount Pinatubo, Zambales', 'gZul0fpjXrrGPU4zPufz.jpg', NULL, 5),
(104, 'Mount Pinatubo', 'GxtKDSGImRmy6luSAFvM.jpg', NULL, 5),
(105, 'Mount Pulag, Benguet', '1EoP7FD86xbiHDvo8LA2.jpg', NULL, 5),
(130, 'AA BBQ', 'joLofVGL6TmfXuFMprVP.jpg', NULL, 3),
(131, 'Anzanisss', 'yYZoZOcVO9onBIVfsKDu.jpg', NULL, 3),
(134, 'Cafe Marco', 'KQZhJlEyvEXjaXKuj0mz.jpg', NULL, 3),
(135, 'Canvas Bistro Bar Gallery', '0ZFwSE0P0cbrYmAPSl2X.jpg', NULL, 3),
(136, 'Carden Cafe', 'kSTjqaYQJXE2lqKRTkCL.jpg', NULL, 3),
(137, 'Circa 1900', 'qR7JzKyepeOexZcc2gA5.jpg', NULL, 3),
(138, 'Feria', 'wMjo4Kd4hSDAeopUy1Uw.jpg', NULL, 3),
(139, 'Kuya Js', 'jYXn6YTX2eAdGtlC9V29.jpg', NULL, 3),
(140, 'Lantaw 2 Native Restaurant', '2i0hqN5YUaDGABtp3PXA.jpg', NULL, 3),
(141, 'Maya Mexican Restaurant', 'p4Wce3KICZf7aALRY48T.jpg', NULL, 3),
(142, 'Moshi Moshi Yakiniku', 'DaJJf6minzp59NG49vxH.jpg', NULL, 3),
(143, 'Pizzeria Michelangelo', 'sVPXGLTiUezHK4cDgtD4.jpg', NULL, 3),
(144, 'Tequi La La', 'dgmndP2qFIhI9EpJLRhq.jpg', NULL, 3),
(145, 'The Social', '62ehgq7fPJgOUaxW4tg5.jpg', NULL, 3),
(146, 'Tokyo Table Cebu', 'rQifB1YRDc8U978SdZPH.jpg', NULL, 3),
(147, 'Zubuchonss', 'swwSXW5mjZRDBQGDqfUR.jpg', NULL, 3),
(188, 'baguio', 'XLZfpwyTr5CPMMD9CuBr.jpg', NULL, 2),
(189, 'Bon Jovi', 'GwXNdJHPUshBZyFJbmli.jpg', NULL, 2),
(190, 'cebu', 'HIgUgYTE5Yd6T3GoT3h5.jpg', NULL, 2),
(191, 'davao', 'PlthTJeAOA04PKMmCx1w.jpg', NULL, 2),
(192, 'Evan Strong', 'qPH9YXimsLKICAxlFhEO.jpg', NULL, 2),
(193, 'Grace Joren', 'kbxeO8bbQu2LE44zVfLH.jpg', NULL, 2),
(194, 'Grace Poe', 'TQ5JiduMkcXqJ9XKHUsn.jpg', NULL, 2),
(199, 'baguio', 'ymzkye7t8jrAzswdxZOu.jpg', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=249;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
