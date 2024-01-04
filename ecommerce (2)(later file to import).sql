-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 11:15 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(5) NOT NULL,
  `pro_id` int(5) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `price` varchar(8) DEFAULT NULL,
  `total_price` varchar(14) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivery_time` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `pro_id`, `quantity`, `price`, `total_price`, `user_id`, `created_at`, `updated_at`, `delivery_time`) VALUES
(8, 6, 2, '67', '134', 1, '2024-01-04 10:25:49', '2024-01-04 10:25:51', NULL),
(9, 7, 2, '120', '240', 1, '2024-01-04 10:28:07', '2024-01-04 10:28:47', NULL),
(10, 6, 2, '67', '134', 4, '2024-01-04 10:31:32', '2024-01-04 10:11:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(17, 'Dried Fruit', '2023-11-23 15:31:10', '2023-11-23 16:04:26'),
(19, 'Special Gift Boxes(customized Dry Fruits) ', '2023-11-25 15:38:52', '2024-01-04 10:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `cat_products`
--

CREATE TABLE `cat_products` (
  `id` int(5) NOT NULL,
  `cat_id` int(4) DEFAULT NULL,
  `pro_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_products`
--

INSERT INTO `cat_products` (`id`, `cat_id`, `pro_id`) VALUES
(311, 19, 7),
(312, 17, 7),
(326, 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(5) NOT NULL,
  `product_id` int(5) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(94, 7, 1, '2024-01-04 10:29:03', '2024-01-04 10:29:03'),
(96, 6, 1, '2024-01-04 10:30:07', '2024-01-04 10:30:07'),
(97, 6, 2, '2024-01-04 10:30:19', '2024-01-04 10:30:19'),
(98, 7, 2, '2024-01-04 10:30:21', '2024-01-04 10:30:21'),
(100, 7, 4, '2024-01-04 10:30:55', '2024-01-04 10:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(5) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` int(10) DEFAULT NULL,
  `bill_no` int(8) DEFAULT NULL,
  `product_quantity` int(5) DEFAULT NULL,
  `product_total_price` int(10) DEFAULT NULL,
  `date_of_order` date DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `image` varchar(70) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `delivery_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_name`, `product_price`, `bill_no`, `product_quantity`, `product_total_price`, `date_of_order`, `user_id`, `image`, `address`, `delivery_time`) VALUES
(2, 'first', 7, 102, 1000, 7, '2023-12-24', 2, '1703405210-image3.png', 'bikaner', '2023-12-31'),
(3, 'new firsts', 88, 102, 1000, 88, '2023-12-24', 2, '1703397450-image3.png', 'bikaner', '2023-12-31'),
(4, 'First', 67, 103, 1, 67, '2024-01-04', 1, '1704363752-image2.png', 'Bikaner, Rajasthan', '2024-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `cost` int(8) DEFAULT NULL,
  `grading` enum('low','medium','high') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(150) DEFAULT NULL,
  `brand` varchar(70) DEFAULT NULL,
  `delivery_time` int(11) DEFAULT NULL,
  `hidden` enum('yes','no') DEFAULT 'no',
  `description` longtext DEFAULT NULL,
  `stock` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cost`, `grading`, `created_at`, `updated_at`, `image`, `brand`, `delivery_time`, `hidden`, `description`, `stock`) VALUES
(6, 'First', 67, 'medium', '2024-01-04 10:21:40', '2024-01-04 10:11:03', '1704363752-image2.png', 'fgh', 5, 'no', 'First desscription       ', 1),
(7, 'Second', 120, 'medium', '2024-01-04 10:28:01', '2024-01-04 10:29:23', '1704364081-image3.png', 'new', 1, 'no', 'Second description', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `is_admin` enum('yes','no') DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`, `created_at`, `updated_at`, `address`) VALUES
(1, 'admin', 'minal123', 'yes', '2023-07-10 12:22:41', '2023-11-21 09:25:25', 'Bikaner, Rajasthan'),
(2, 'minal', 'minal', 'no', '2023-07-10 12:40:57', '2023-08-11 12:01:35', 'gangashahar'),
(3, 'minal', 'minal1234', 'no', '2023-11-04 09:29:58', '2023-11-04 09:29:58', NULL),
(4, 'rajesh', 'rajesh123', 'yes', '2023-12-13 12:14:37', '2023-12-13 12:16:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_products`
--
ALTER TABLE `cat_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cat_products`
--
ALTER TABLE `cat_products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cat_products`
--
ALTER TABLE `cat_products`
  ADD CONSTRAINT `cat_products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat_products_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
