-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2022 at 05:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoe`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `imgsrc1` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `imgsrc2` char(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `imgsrc1`, `imgsrc2`) VALUES
(21, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/1.jpg', 'images/shoes/1-1.jpg'),
(22, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/2.jpg', 'images/shoes/2-2.jpg'),
(23, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/3.jpg', 'images/shoes/3-3.jpg'),
(24, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/4.jpg', 'images/shoes/4-4.jpg'),
(25, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/5.jpg', 'images/shoes/5-5.jpg'),
(26, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/6.jpg', 'images/shoes/6-6.jpg'),
(27, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/7.jpg', 'images/shoes/7-7.jpg'),
(28, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/8.jpg', 'images/shoes/8-8.jpg'),
(29, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/201493_1_017364c87c3e4802a8cda5259e3d5a95_grande.jpg', 'images/shoes/shoes fade 2.jpg'),
(30, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/800502_01_e92c3b2bb8764b52a791846d84a3a360_grande.jpg', 'images/shoes/shoes fade 5.jpg'),
(31, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/801432_01_b16d089f8bda434bacfe4620e8480be1_grande.jpg', 'images/shoes/shoes fade 4.jpg'),
(32, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/801740_1_e4adfa6d09b7468a8c9fb21bf8e02bd4_medium (1).jpg', 'images/shoes/shoes fade 1.jpg'),
(33, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/802501_01_eccb69b5bcdf4ef5b209557ec6547774_grande.jpg', 'images/shoes/shoes fade 6.jpg'),
(34, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/805266_02_b8b2cdd1782246febf8879a44a7e5021_grande.jpg', 'images/shoes/shoes fade 3.jpg'),
(35, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/805338_01_eb7365e97d3f471d872159918a8526a9_grande.jpg', 'images/shoes/shoes fade 8.jpg'),
(36, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/806859_01_1ad7dd36e7b5403286b95a253e00718d_grande.jpg', 'images/shoes/shoes fade 7.jpg'),
(37, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/9.jpg', 'images/shoes/9-9.jpg'),
(38, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/10.jpg', 'images/shoes/10-10.jpg'),
(39, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/11.jpg', 'images/shoes/11-11.jpg'),
(40, 'Adidas EQT Cushion ADV North America', 7000000, 'images/shoes/12.jpg', 'images/shoes/12-12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ho` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `gioitinh` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` char(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ho`, `ten`, `gioitinh`, `ngaysinh`, `email`, `pass`) VALUES
(1, 'dasd', 'adsdas', 'on', '0000-00-00', 'hatranquang02@gmail.com', '123123'),
(2, 'tran', 'ha', 'on', '0000-00-00', 'havip442@gmail.com', '123123'),
(3, 'tran', 'ha', 'male', '0000-00-00', 'maxherosta@gmail.com', '123123'),
(4, 'Hieu', 'Xau trai', 'male', '0000-00-00', 'hieukutehl8@gmail.com', '123123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
