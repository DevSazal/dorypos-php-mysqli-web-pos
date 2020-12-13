-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 12:36 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dorypos_v5`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `root` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `contact`, `root`) VALUES
(1, 'Mr. DoryPOS', 'mail@appsolic.io', '$2y$11$d14b1a67c420f2b89e874O9g4zXg0PfqZYU4tR99QSCc3lZLYRTcS', '+880 17', 1),
(2, 'Noor Collection', 'noor@mail.com', '$2y$11$4d4428c8e9764a0463cbcOihCUy9aARoJku4CWNP4Aox/Gvs78OOi', '01713703799', 0),
(3, 'Sazal Ahamed', 'admin', '$2y$11$2958de2aa34f2ec886d6eOkj3xQXnYlyhuyYkTarmFOzhhew9wdMC', '01758148788', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_brand`
--

CREATE TABLE `dorypos_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL,
  `brand_category` int(11) DEFAULT NULL,
  `brand_vendor` int(11) DEFAULT NULL,
  `brand_comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_category`
--

CREATE TABLE `dorypos_category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_customer`
--

CREATE TABLE `dorypos_customer` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `verify` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_ex`
--

CREATE TABLE `dorypos_ex` (
  `id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_order`
--

CREATE TABLE `dorypos_order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_discount` float NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_product`
--

CREATE TABLE `dorypos_product` (
  `row_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `in_quantity` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_sale`
--

CREATE TABLE `dorypos_sale` (
  `sale_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `discount` float NOT NULL,
  `discount_round` float DEFAULT NULL,
  `final_discount` float NOT NULL,
  `net_price` float NOT NULL,
  `card` tinyint(1) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dorypos_vendor`
--

CREATE TABLE `dorypos_vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_phone` varchar(255) NOT NULL,
  `vendor_address` varchar(255) NOT NULL,
  `vendor_brand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dorypos_brand`
--
ALTER TABLE `dorypos_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `dorypos_category`
--
ALTER TABLE `dorypos_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `dorypos_customer`
--
ALTER TABLE `dorypos_customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `rowid_UNIQUE` (`customer_id`);

--
-- Indexes for table `dorypos_ex`
--
ALTER TABLE `dorypos_ex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dorypos_order`
--
ALTER TABLE `dorypos_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `dorypos_product`
--
ALTER TABLE `dorypos_product`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `dorypos_sale`
--
ALTER TABLE `dorypos_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `dorypos_vendor`
--
ALTER TABLE `dorypos_vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dorypos_brand`
--
ALTER TABLE `dorypos_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dorypos_category`
--
ALTER TABLE `dorypos_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dorypos_customer`
--
ALTER TABLE `dorypos_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `dorypos_ex`
--
ALTER TABLE `dorypos_ex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dorypos_order`
--
ALTER TABLE `dorypos_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dorypos_product`
--
ALTER TABLE `dorypos_product`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dorypos_sale`
--
ALTER TABLE `dorypos_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dorypos_vendor`
--
ALTER TABLE `dorypos_vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
