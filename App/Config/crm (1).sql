-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 12:52 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `availabilities`
--

CREATE TABLE `availabilities` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availabilities`
--

INSERT INTO `availabilities` (`id`, `code`, `title`, `created_at`, `updated_at`) VALUES
(4, '1', 'Available', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '2', 'Out of Stoke', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '3', 'Comming Soon', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_image` text NOT NULL,
  `address` text NOT NULL,
  `vat_no` varchar(100) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `website` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `email`, `company_image`, `address`, `vat_no`, `reg_no`, `phone`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Pran RFL', 'pran2017@gmail.com', 'pran.jpg', '47/19, New Chasara, Jamtola , Narayanganj', '258852', '654322', '01824844042', 'www.code-press.com', '0000-00-00 00:00:00', '2017-06-12 00:00:00'),
(6, 'Pusti', 'pusti2016@gmail.com', 'pust.jpg', 'Dhaka,1200', '2546987', '4562134', '018524684636', 'kobira.com', '2017-06-08 00:00:00', '2017-06-12 00:00:00'),
(7, 'Desh Agro', 'desh.agro@gmail.com', 'desh.jpg', 'Kawran Bazar , Dhaka', '145687', '984561', '01955296634', 'deshagro.com', '2017-06-12 00:00:00', '2017-06-12 00:00:00'),
(8, 'RFL', 'kardi@gmail.com', 'rfl-1.png', 'Mirpur,Dhaka', '420', '1555', '015669569856', 'http://theagora.com/', '2017-06-12 00:00:00', '2017-06-12 00:00:00'),
(10, 'Pran', 'pran2012@gmail.co', 'pran.jpg', '', '258469', '5475632', '01824844043', '', '2017-06-12 00:00:00', '2017-06-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `permission` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'standard', '{\"standard\":0}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Administrator', '{\"admin\":1}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Moderator', '{\"moderator\":1}', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `product_image` text,
  `status` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `title`, `company`, `price`, `currency`, `product_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'P301', 'Pran Dairy Milk', 1, 205, 'TAKA', 'fun_football_player_name.jpg', '1', NULL, '2017-06-08 00:00:00'),
(3, 'P302', 'Pran Dairy Milk', 1, 305, 'Tk', 'pran.jpg', '1', '2017-06-08 00:00:00', '2017-06-12 00:00:00'),
(4, 'R3026', 'Radio Three Hundred Two', 1, 10500, 'Tk', 'abuahsan.jpg', '1', '2017-06-08 00:00:00', '2017-06-08 00:00:00'),
(5, 'D301', 'Desh Best Minicate', 7, 2800, 'Tk', 'product4.jpg', '1', '2017-06-12 00:00:00', '2017-06-12 00:00:00'),
(6, '12548', 'Jouce', 1, 18, 'Tk', 'product1.jpeg', '1', '2017-06-12 00:00:00', '2017-06-12 00:00:00'),
(7, '48865', 'Ata', 6, 70, 'Tk', 'product3.jpg', '1', '2017-06-12 00:00:00', '2017-06-12 00:00:00'),
(8, '92268', 'Moida', 6, 65, 'Tk', 'product3.jpg', '1', '2017-06-12 00:00:00', '2017-06-12 00:00:00'),
(10, '255228', 'Suji', 6, 58, 'Tk', 'download.jpg', '3', '2017-06-14 00:00:00', '2017-06-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `user_image` text,
  `birth_date` varchar(100) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text,
  `company` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `fname`, `lname`, `gender`, `user_image`, `birth_date`, `country_code`, `city`, `zip_code`, `phone`, `mobile`, `address`, `company`, `website`) VALUES
(6, 9, 'Md. Abu Ahsan', 'Basir', '', 'abuahsan.jpg', '', 'BD', 'Narayangaj', '', '0265642', '01824844045', '47/19,New Chashara, Jamtola', '', 'www.code-press.com'),
(8, 11, '', '', '', NULL, '', '', '', '', '', '', NULL, '', ''),
(9, 12, 'Mohammad ', 'Ibrahim', '', '', '', '', 'Dhaka', '', '', '0167520313', '', '', ''),
(10, 13, '', '', '', NULL, '', '', '', '', '', '', NULL, '', ''),
(11, 14, '', '', '', NULL, '', '', '', '', '', '', NULL, '', ''),
(12, 15, '', '', '', NULL, '', '', '', '', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `grp` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `active`, `grp`, `created_at`, `updated_at`) VALUES
(9, 'abuahsan', '3098a32ef3922b8267da3c644415848b3a99bb09b04b63673d7ea3f0b711fc1d', '', 'maab.tips2@gmail.com', 1, 2, '2017-06-07 00:00:00', '2017-06-12 00:00:00'),
(11, 'maab16', '3098a32ef3922b8267da3c644415848b3a99bb09b04b63673d7ea3f0b711fc1d', '', 'abuahsan91@gmail.com', 1, 1, '2017-06-08 00:00:00', '2017-06-13 00:00:00'),
(12, 'kardi', '4c0894a6e49924e5342293f7dcb8db29b1512bd3b5050f3072b2a444307786ae', '', 'ikardi04@gmail.com', 0, 2, '2017-06-09 00:00:00', '2017-06-14 00:00:00'),
(13, 'fahad', '3098a32ef3922b8267da3c644415848b3a99bb09b04b63673d7ea3f0b711fc1d', '', 'fahad2017@gmail.com', 0, 1, '2017-06-14 00:00:00', '2017-06-14 00:00:00'),
(14, 'mim16', '3098a32ef3922b8267da3c644415848b3a99bb09b04b63673d7ea3f0b711fc1d', '', 'mim2016@gmail.com', 0, 1, '2017-06-14 00:00:00', '2017-06-14 00:00:00'),
(15, 'fahim', '3098a32ef3922b8267da3c644415848b3a99bb09b04b63673d7ea3f0b711fc1d', '', 'fahim2017@gmail.com', 1, 3, '2017-06-14 00:00:00', '2017-06-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(2, 9, '87d4cff9f1c1d6f63d0121b95f044be2c3cc46c997899f3f205124af4e03d790');

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_products`
--

INSERT INTO `user_products` (`id`, `user_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 11, 10, 1, '2017-06-14 00:00:00', '2017-06-14 00:00:00'),
(2, 11, 8, 1, '2017-06-14 00:00:00', '2017-06-14 00:00:00'),
(3, 11, 7, 1, '2017-06-14 00:00:00', '2017-06-14 00:00:00'),
(4, 11, 10, 1, '2017-06-14 00:00:00', '2017-06-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `status_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 0, 'Inactive', '2017-06-09 00:00:00', '2017-06-09 00:00:00'),
(2, 1, 'Active', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availabilities`
--
ALTER TABLE `availabilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Availabilty_Code` (`code`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Customer_Product` (`user_id`,`product_id`),
  ADD KEY `FK_PRODUCT_ID` (`product_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `vat_no` (`vat_no`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Product_Code` (`code`),
  ADD KEY `FK_COMPANY` (`company`),
  ADD KEY `FK_STATUS` (`status`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `grp` (`grp`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_SESSION_ID` (`user_id`);

--
-- Indexes for table `user_products`
--
ALTER TABLE `user_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availabilities`
--
ALTER TABLE `availabilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_products`
--
ALTER TABLE `user_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_CUSTOMER_ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_PRODUCT_ID` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_COMPANY` FOREIGN KEY (`company`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `FK_STATUS` FOREIGN KEY (`status`) REFERENCES `availabilities` (`code`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `FK_USER` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_products`
--
ALTER TABLE `user_products`
  ADD CONSTRAINT `user_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
