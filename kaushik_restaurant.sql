-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 08:54 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yadav_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Hyderabadi Biryani'),
(2, 'Lucknowi Biryani'),
(3, 'Kebab'),
(4, 'Beverages'),
(5, 'Dessert'),
(6, 'Korma');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `ph_no` varchar(20) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `email_id` varchar(40) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `locality` varchar(30) DEFAULT NULL,
  `date_joined` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `password`, `ph_no`, `full_name`, `email_id`, `state`, `city`, `locality`, `date_joined`) VALUES
(3, '123', '7838938738', 'Md', 'mohammadsaqulain18@gmail.com', 'Haryana', 'Haryana', NULL, NULL),
(4, '123', '9899157445', 'Md', 'sasa@gmail.com', 'Haryana', 'Haryana', NULL, NULL),
(5, '1234', '7838938739', 'Md ', 'mohammadsaqulain18@gmail.com', 'Haryana', 'Haryana', NULL, NULL),
(6, 'asasa', '7838938731', 'sasas', 'moham@gmail.com', 'Haryana', 'Haryana', NULL, NULL),
(7, 'nasir@123', '8377949601', 'Nasir ', '1419nasir@gmail.com', 'Haryana', 'Haryana', NULL, NULL),
(8, '1234', '9899157446', 'Mohd', 'mohd@gmail.com', 'Haryana', 'Gurgaon', 'Rajeev Nagar', NULL),
(9, '1234', '9899154776', 'new', 'mohd@gmail.com', 'Haryana', 'Gurgaon', 'Sector 5', NULL),
(10, '1234', '9899154773', 'new', 'mohd@gmail.com', 'Haryana', 'Gurgaon', 'Sector 5', NULL),
(12, '1212', '1212121', 'asasas', 'sasasa', 'Haryana', 'Gurgaon', 'Sector 17', NULL),
(13, '1212', '12121212', 'ssasas', 'sasas', 'Haryana', 'Gurgaon', 'Sector 14', NULL),
(14, '1234', '7838938736', 'New Data', 'mohad@gmail.com', 'Haryana', 'Gurgaon', 'Sector 4', '2019/07/31'),
(15, '1234', '7838938735', 'NewDtaa', 'sasasasa', 'Haryana', 'Gurgaon', 'Sector 4', '2019/07/31'),
(16, '1234', '7838938733', 'new data g', 'sasasa@gmail.com', 'Haryana', 'Gurgaon', 'Sector 14', '2019/07/31'),
(19, '1234', '8888888888', 'all data is new', 'mhshas@gmail.com', 'Haryana', 'Gurgaon', 'Sector 17', '2019/07/31'),
(20, '1234', '9898989898', 'check it', 'sahsa@gmail.com', 'Haryana', 'Gurgaon', 'Rajeev Nagar', '2019/07/31');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `item_name` varchar(40) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `category_id`, `item_name`, `price`, `image`) VALUES
(1, 1, 'Hyderabadi Chicken Biryani 1/2 Kg', '200.00', 'hyderabadi-biryani-recipe-500x500.jpg'),
(2, 1, 'Hyderabadi Veg Biryani 1/2 Kg', '150.00', 'big_biryani-10300.jpg'),
(4, 1, 'Hyderabadi Mutton 1/2 Kg', '300.00', 'big_biryani-10300.jpg'),
(5, 1, 'Hyderabadi Egg 1/2 Kg', '150.00', 'hyderabadi-biryani-recipe-500x500.jpg'),
(6, 2, 'Awadhi Veg 1/2 Kg', '150.00', 'awadhi-chicken-biryani-.jpg'),
(7, 2, 'Awadhi Murg 1/2 Kg', '200.00', 'awadhi-chicken-biryani-.jpg'),
(8, 2, 'Awadhi Mutton 1/2 Kg', '300.00', 'awadhi-chicken-biryani-.jpg'),
(10, 3, 'Chicken Seekh', '200.00', 'chicken.seekh.jpg'),
(12, 4, 'Pepsi 650 ml', '40.00', 'Pepsi-16oz.jpg'),
(13, 4, 'Coke 650 ml', '40.00', 'coke.jpg'),
(14, 1, 'Hyderabadi Chicken Biryani 1 Kg', '350.00', 'hyderabadi-biryani-recipe-500x500.jpg'),
(15, 1, 'Hyderabadi Veg Biryani 1 Kg', '300.00', 'hyderabadi-biryani-recipe-500x500.jpg'),
(17, 1, 'Hyderabadi Mutton 1 Kg', '450.00', 'hyderabadi-biryani-recipe-500x500.jpg'),
(18, 1, 'Hyderabadi Egg 1 Kg', '250.00', 'hyderabadi-biryani-recipe-500x500.jpg'),
(19, 2, 'Awadhi Veg 1 Kg', '250.00', 'awadhi-chicken-biryani-.jpg'),
(20, 2, 'Awadhi Murg 1 Kg', '350.00', 'awadhi-chicken-biryani-.jpg'),
(21, 2, 'Awadhi Mutton 1 Kg', '450.00', 'awadhi-chicken-biryani-.jpg'),
(22, 3, 'Veg Shami Kebab', '200.00', 'chicken.seekh.jpg'),
(23, 3, 'Veg Galouti Kebab', '200.00', 'chicken.seekh.jpg'),
(24, 3, 'Mutton Galouti Kebab', '375.00', 'chicken.seekh.jpg'),
(25, 3, 'Chicken Galouti Kebab', '325.00', 'chicken.seekh.jpg'),
(26, 3, 'Chicken Boti Kebab', '325.00', 'chicken.seekh.jpg'),
(27, 3, 'Chicken Angara Kebab', '325.00', 'chicken.seekh.jpg'),
(28, 3, 'Kakori Kebab', '375.00', 'chicken.seekh.jpg'),
(29, 6, 'Paneer Tamatar K Kut', '300.00', 'chicken.seekh.jpg'),
(30, 6, 'Dahi K Kebab', '300.00', 'chicken.seekh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `ord_time` varchar(20) DEFAULT NULL,
  `ord_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `cust_id`, `ord_time`, `ord_status`) VALUES
(2, 8, '2019/07/31 04:43:07', 'done'),
(3, 8, '2019/07/31 04:43:19', 'done'),
(4, 8, '2019/07/31 04:43:34', 'done'),
(5, 8, '2019/07/31 04:43:44', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `ord_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_items`
--

INSERT INTO `ordered_items` (`ord_id`, `item_id`, `quantity`) VALUES
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`ord_id`,`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`);

--
-- Constraints for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD CONSTRAINT `ordered_items_ibfk_1` FOREIGN KEY (`ord_id`) REFERENCES `orders` (`ord_id`),
  ADD CONSTRAINT `ordered_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
