-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 11:12 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portofolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `address_city` varchar(222) NOT NULL,
  `address_street` varchar(222) NOT NULL,
  `address_country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment_author` varchar(100) NOT NULL,
  `comment_body` text NOT NULL,
  `comment_timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_image_url` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_tags` varchar(100) NOT NULL,
  `product_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_image_url`, `product_price`, `product_tags`, `product_timestamp`) VALUES
(68, 'Samsung Galaxy S20 5G', 'Samsung Electronics Samsung Galaxy S21 5G | Factory Unlocked Android Cell Phone | US Version 5G Smartphone | Pro-Grade Camera, 8K Video, 64MP High Res | 128GB, Phantom Gray (SM-G991UZAAXAA)', '61db2f36b95444.83401872.webp', 509, 'phone, phones, samsung, galaxy, samsung galaxy, s20', 1641754422),
(69, 'OnePlus Nord N200', 'OnePlus Nord N200 | 5G Unlocked Android Smartphone U.S Version | 6.49\" Full HD+LCD Screen | 90Hz Smooth Display | Large 5000mAh Battery | Fast Charging | 64GB Storage | Triple Camera,Blue Quantum', '61db2fbd4ed230.28754723.jpg', 209, 'phone, phones, oneplus, n200', 1641754557),
(74, 'SAMSUNG Galaxy Z Flip 3', 'SAMSUNG Electronics Galaxy Z Flip 3 5G Factory Unlocked Android Cell Phone US Version Smartphone Flex Mode Intuitive Camera Compact 256GB Storage US Warranty, Phantom Black', '61db310ac201f2.77538797.jpg', 1049, 'phone, phones, samsung, galaxy, samsung galaxy, z flip 3', 1641754890),
(75, 'OnePlus Buds Z2', 'OnePlus Buds Z2 True Wireless Earbud Headphones-Touch Control with Charging Case,Active Noise Cancellation,IP55 Waterproof Stereo Earphones for Home,Sport, Obsidian Black', '61db4bfa750155.03205609.jpg', 99, 'headphones, oneplus headphones, oneplus', 1641761786),
(76, 'Samsung Galaxy A12', 'Samsung Galaxy A12 (A125M) 64GB Dual SIM, GSM Unlocked, (CDMA Verizon/Sprint Not Supported) Smartphone Latin American Version No Warranty (Blue)', '61db4cb6e6de87.08273310.jpg', 180, 'phone, phones, samsung, galaxy, samsung galaxy, a12, samsung a12', 1641761974),
(77, 'Google Pixel 6', 'Google Pixel 6 – 5G Android Phone - Unlocked Smartphone with Wide and Ultrawide Lens - 256GB - Stormy Black', '61db4d41df18b1.82794263.webp', 899, 'phone, phones, google, pixel, google pixel 6, pixel 6', 1641762113),
(78, 'Lenovo Legion Y540', '2021 Lenovo Legion Y540 15.6\" FHD IPS 144Hz Gaming Laptop Intel 6-Core i7-9750H 64GB DDR4 1TB NVMe SSD+1TB HDD NVIDIA GTX 1660TI GDDR6 Backlit USB-C WiFi HDMI Windows 10 Pro w/ RE 32GB USB3.0 Drive', '61db4da781e6e7.60788066.jpg', 1649, 'laptop, laptop gaming, laptop lenovo, lenovo, lenovo legion, lenovo legion y540, y540', 1641762215),
(79, 'HP 15 inch Laptop', 'HP 15-inch Laptop, 11th Generation Intel Core i5-1135G7, Intel Iris Xe Graphics, 8 GB RAM, 256 GB SSD, Windows 11 Home (15-dy2024nr, Natural silver)', '61db4e64bd09d4.48105053.jpg', 537, 'laptop, hp, laptop hp', 1641762404),
(80, 'ASUS TUF FX706HE', '2022 ASUS TUF FX706HE Gaming Laptop 17.3” 144Hz FHD IPS Display Intel 6-Core i5-11260H 8GB DDR4 512GB NVMe SSD NVIDIA GeForce RTX 3050Ti 4GB GDDR6 WiFi AX BT 5.2 RJ45 USB-C Backlit Windows 11 w/USB', '61db4ebfb934e7.84090638.webp', 979, 'laptop, laptop gaming, laptop asus, asus, asus tuf, tuf', 1641762495),
(81, 'HP 14 Laptop', 'HP 14 Laptop, Intel Celeron N4020, 4 GB RAM, 64 GB Storage, 14-inch Micro-Edge HD Display, Windows 10 Home, Thin & Portable, 4K Graphics, One Year of Microsoft 365 (14-dq0010nr, 2021, Indigo Blue)', '61db4f22c8ef69.57316651.jpg', 329, 'laptop, hp, laptop hp', 1641762594),
(83, 'Razer Blade 15 Studio Edition Laptop 2020', 'Razer Blade 15 Studio Edition Laptop 2020: Intel Core i7-10875H 8-Core, NVIDIA Quadro RTX 5000, 15.6” 4K OLED Touch, 32GB RAM, 1TB SSD, CNC Aluminum, Chroma RGB, Thunderbolt 3, Creator Ready', '61db4fc62a2f63.23509652.jpg', 3802, 'laptop, laptop gaming, laptop lenovo, lenovo', 1641762758),
(84, 'Acer Nitro 5 Gaming Laptop', 'Acer Nitro 5 Gaming Laptop, Intel Core i5-9300H, NVIDIA GeForce GTX 1650, 15.6\" Full HD IPS Display, Wi-Fi 6, Backlit Keyboard, Win10, with Accessories (16GB RAM | 1TB PCIe SSD)', '61db500d620181.59512997.jpg', 985, 'laptop, laptop gaming, laptop acer, acer nitro 5, acer nitro', 1641762829),
(86, 'ASUS ROG Strix', 'ASUS ROG Strix G15 (2021) Gaming Laptop, 15.6” 144Hz IPS Type FHD Display, NVIDIA GeForce RTX 3050, AMD Ryzen 7 4800H, 8GB DDR4, 512GB PCIe NVMe SSD, RGB Keyboard, Windows 10, G513IC-EB73', '61db509c979802.59378736.webp', 999, 'laptop, laptop gaming, laptop asus, asus, asus rog, rog strix, strix', 1641762972),
(87, 'Beats Studio3', 'Beats Studio3 Wireless Noise Cancelling Over-Ear Headphones - Apple W1 Headphone Chip, Class 1 Bluetooth, 22 Hours of Listening Time, Built-in Microphone - Matte Black (Latest Model)', '61db513acfc973.55169869.jpg', 226, 'headphones, beats, beats studio 3, beats studio', 1641763130),
(88, 'Apple EarPods', 'Apple EarPods with 3.5mm Headphone Plug - White', '61db51cb6f9368.52137838.webp', 23, 'headphones, apple, apple headphones', 1641763275),
(89, 'Beats Studio Buds', 'Beats Studio Buds – True Wireless Noise Cancelling Earbuds – Compatible with Apple & Android, Built-in Microphone, IPX4 Rating, Sweat Resistant Earphones, Class 1 Bluetooth Headphones - Red', '61db56e2cedd57.05479115.jpg', 105, 'headphones, beats, beats studio buds, beats buds', 1641764578),
(90, 'Sony WF 1000XM4', 'Sony WF-1000XM4 Industry Leading Noise Canceling Truly Wireless Earbud Headphones with Alexa Built-in, Black', '61db5827000444.70753478.jpg', 278, 'headphones, sony, sony headphones', 1641764903);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_second_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_admin` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_second_name`, `user_email`, `user_password`, `user_admin`, `user_image`) VALUES
(16, 'Constantin', 'Manu', 'manu.constantin95@yahoo.com', 'cosmin', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id` int(100) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `prenume` varchar(222) NOT NULL,
  `parola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`id`, `nume`, `prenume`, `parola`) VALUES
(28, 'manu', 'constantin', '$2y$10$JB6KVIT4S66tHE4a5xk1SeY5zX.dajkIexfPvq1pGNFMkUGxzMFye');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
