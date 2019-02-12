-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Mai 2018 la 10:05
-- Versiune server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practica`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `brands`
--

CREATE TABLE `brands` (
  `brandId` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `originCountry` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `brands`
--

INSERT INTO `brands` (`brandId`, `name`, `originCountry`, `image`) VALUES
(1, 'Samsung', 'Coreea', 'assets/img/brands/samsung.png'),
(6, 'Apple', 'SUA', 'assets/img/brands/Apple.png'),
(7, 'LG', 'Coreea de Sud', 'assets/img/brands/LG.png'),
(8, 'Logitech', 'Elvetia', 'assets/img/brands/Logitech.png');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `cart`
--

CREATE TABLE `cart` (
  `id` int(5) NOT NULL,
  `userId` int(5) NOT NULL,
  `productId` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `categories`
--

INSERT INTO `categories` (`categoryId`, `name`, `description`, `image`) VALUES
(1, 'Monitoare', 'sunt doar monitoare', 'assets/img/categories/monitoare.png'),
(2, 'Televizor', 'alte televizoare', 'assets/img/categories/Televizor.png'),
(3, 'Smartphone', 'Telefoane smechere', 'assets/img/categories/Smartphone.png'),
(4, 'Periferice', 'Obiecte periferice pentru PC-uri', 'assets/img/categories/Periferice.png');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `orders`
--

CREATE TABLE `orders` (
  `orderId` int(5) NOT NULL,
  `userId` int(5) NOT NULL,
  `productId` int(5) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `productId`, `date`, `status`) VALUES
(9, 1, 1, '05/19/2018', 1),
(10, 1, 1, '05/19/2018', 1),
(11, 1, 2, '05/19/2018', 1),
(12, 1, 2, '05/19/2018', 1),
(13, 1, 5, '05/19/2018', 1),
(14, 1, 5, '05/19/2018', 1),
(15, 1, 1, '05/19/2018', 1),
(16, 1, 1, '05/19/2018', 1),
(17, 1, 1, '05/19/2018', 1),
(18, 1, 1, '05/19/2018', 1),
(19, 1, 1, '1526736865', 1),
(20, 1, 5, '1526908012', 1),
(21, 1, 5, '1526908012', 1),
(22, 1, 5, '1526908012', 1),
(23, 1, 5, '1526908012', 1),
(24, 1, 5, '1526908012', 1),
(25, 1, 5, '1526911872', 1),
(26, 1, 5, '1526911872', 1),
(27, 1, 1, '1526938222', 1),
(28, 1, 1, '1526938222', 1),
(29, 1, 1, '1526938222', 1),
(30, 1, 1, '1526938222', 1),
(31, 1, 6, '1526938506', 1),
(32, 1, 6, '1526938506', 1),
(33, 1, 6, '1526938506', 1),
(34, 1, 6, '1526938506', 1),
(35, 1, 6, '1526938506', 1),
(36, 1, 6, '1526938506', 1),
(37, 1, 5, '1527351697', 1),
(38, 1, 5, '1527351697', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `products`
--

CREATE TABLE `products` (
  `productId` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock` int(5) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `categoryId` int(5) NOT NULL,
  `brandId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `products`
--

INSERT INTO `products` (`productId`, `name`, `description`, `stock`, `price`, `image`, `categoryId`, `brandId`) VALUES
(1, 'Monitor', 'E un monitor', 24, 2500, 'assets/img/products/monitor.png', 1, 1),
(2, 'Alt monitor', 'e alt monitor', 12, 3500, 'assets/img/products/alt monitor.png', 1, 1),
(5, 'LG e2500 FULL HD', 'televzor bun', 3, 2500, 'assets/img/products/LG e2500 FULL HD.png', 2, 7),
(6, 'Iphone8', 'e un telefon OK', 31, 2700, 'assets/img/products/Iphone8.png', 3, 6),
(7, 'Casti', 'Casti bluetooth', 12, 350, 'assets/img/products/Casti.png', 4, 1),
(8, 'Tastatura ', 'Tastatura mecanica de gaming', 46, 210, 'assets/img/products/Tastatura .png', 4, 8);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `userId` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`userId`, `email`, `password`, `firstName`, `lastName`, `phone`, `address`, `isAdmin`, `token`) VALUES
(1, 'bisagalexstefan@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'Alexandru Stefan', 'Bisag', '0729601114', 'Strada Pacii, Nr. 14, Medgidia', 1, 'asd'),
(2, 'asdasdasd', 'asdasdasdasd', 'asdasd', 'asdasdas', 'asdasdasd', 'asdasdasd', 0, ''),
(3, 'bisagalexsjtefan@gmail.com', '07gierjge', 'ergergoi', 'gregerg', 'geroijger', 'geroijge', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
