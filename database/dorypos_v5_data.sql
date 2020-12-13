-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: us-cdbr-east-02.cleardb.com    Database: heroku_49801d5b4274a10
-- ------------------------------------------------------
-- Server version	5.5.62-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `root` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Mr. DoryPOS','mail@appsolic.io','$2y$11$d14b1a67c420f2b89e874O9g4zXg0PfqZYU4tR99QSCc3lZLYRTcS','+880 17',1),(2,'Noor Collection','noor@mail.com','$2y$11$4d4428c8e9764a0463cbcOihCUy9aARoJku4CWNP4Aox/Gvs78OOi','01713703799',0),(3,'Sazal Ahamed','admin','$2y$11$2958de2aa34f2ec886d6eOkj3xQXnYlyhuyYkTarmFOzhhew9wdMC','01758148788',1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_brand`
--

DROP TABLE IF EXISTS `dorypos_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_title` varchar(100) NOT NULL,
  `brand_category` int(11) DEFAULT NULL,
  `brand_vendor` int(11) DEFAULT NULL,
  `brand_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_brand`
--

LOCK TABLES `dorypos_brand` WRITE;
/*!40000 ALTER TABLE `dorypos_brand` DISABLE KEYS */;
INSERT INTO `dorypos_brand` VALUES (1,'REX',NULL,NULL,NULL);
/*!40000 ALTER TABLE `dorypos_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_category`
--

DROP TABLE IF EXISTS `dorypos_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_category`
--

LOCK TABLES `dorypos_category` WRITE;
/*!40000 ALTER TABLE `dorypos_category` DISABLE KEYS */;
INSERT INTO `dorypos_category` VALUES (1,'T-Shirt');
/*!40000 ALTER TABLE `dorypos_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_customer`
--

DROP TABLE IF EXISTS `dorypos_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `verify` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `rowid_UNIQUE` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1041 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_customer`
--

LOCK TABLES `dorypos_customer` WRITE;
/*!40000 ALTER TABLE `dorypos_customer` DISABLE KEYS */;
INSERT INTO `dorypos_customer` VALUES (1001,3,'12-13-2020 06:29:08 am','67728'),(1011,3,'12-13-2020 06:42:52 am','18698'),(1021,3,'12-13-2020 06:53:39 am','86423'),(1031,3,'12-13-2020 07:10:49 am','20392');
/*!40000 ALTER TABLE `dorypos_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_ex`
--

DROP TABLE IF EXISTS `dorypos_ex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_ex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_ex`
--

LOCK TABLES `dorypos_ex` WRITE;
/*!40000 ALTER TABLE `dorypos_ex` DISABLE KEYS */;
INSERT INTO `dorypos_ex` VALUES (1,'Breakfast',40,1,'2020-12-13');
/*!40000 ALTER TABLE `dorypos_ex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_order`
--

DROP TABLE IF EXISTS `dorypos_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_discount` float NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_order`
--

LOCK TABLES `dorypos_order` WRITE;
/*!40000 ALTER TABLE `dorypos_order` DISABLE KEYS */;
INSERT INTO `dorypos_order` VALUES (1,1,2,20,1001,'2020-12-13'),(11,1,3,60,1021,'2020-12-13'),(21,11,5,160,1031,'2020-12-13');
/*!40000 ALTER TABLE `dorypos_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_product`
--

DROP TABLE IF EXISTS `dorypos_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_product` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `in_quantity` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_date` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_product`
--

LOCK TABLES `dorypos_product` WRITE;
/*!40000 ALTER TABLE `dorypos_product` DISABLE KEYS */;
INSERT INTO `dorypos_product` VALUES (1,'Couple T-Shirt ','12',250,400,80,75,1,1,'M X XL -WRBO','12-13-2020 06:26:29 am'),(11,'Corporate T-Shirt ','K99067022D',300,800,150,145,1,1,'X XL XXL','12-13-2020 07:04:16 am');
/*!40000 ALTER TABLE `dorypos_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_sale`
--

DROP TABLE IF EXISTS `dorypos_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_sale` (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `discount` float NOT NULL,
  `discount_round` float DEFAULT NULL,
  `final_discount` float NOT NULL,
  `net_price` float NOT NULL,
  `card` tinyint(1) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_sale`
--

LOCK TABLES `dorypos_sale` WRITE;
/*!40000 ALTER TABLE `dorypos_sale` DISABLE KEYS */;
INSERT INTO `dorypos_sale` VALUES (1,1001,800,0,20,20,780,0,'2020-12-13'),(11,1021,1200,5,0,60,1140,1,'2020-12-13'),(21,1031,4000,4,0,160,3840,1,'2020-12-13');
/*!40000 ALTER TABLE `dorypos_sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorypos_vendor`
--

DROP TABLE IF EXISTS `dorypos_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dorypos_vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_phone` varchar(255) NOT NULL,
  `vendor_address` varchar(255) NOT NULL,
  `vendor_brand` int(11) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorypos_vendor`
--

LOCK TABLES `dorypos_vendor` WRITE;
/*!40000 ALTER TABLE `dorypos_vendor` DISABLE KEYS */;
INSERT INTO `dorypos_vendor` VALUES (1,'RANA','017xxx','Dhaka',1);
/*!40000 ALTER TABLE `dorypos_vendor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-13  7:32:22
