-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 09:28 PM
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
-- Database: `gujju_homes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT 'Admin',
  `email` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `username`, `email`, `mobile`, `city`, `address`, `password`, `photo`) VALUES
(1, 'Kishan', 'rana12@gmail.com', '6353978865', 'Patan', '', 'kishan123', 'IMG-646128bc664185.97735029.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bk_id` smallint(6) NOT NULL,
  `u_id` smallint(5) NOT NULL,
  `pr_id` smallint(5) NOT NULL,
  `bk_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `sr_id` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fav_property`
--

CREATE TABLE `fav_property` (
  `f_id` smallint(5) NOT NULL,
  `u_id` smallint(3) NOT NULL,
  `pr_id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `my_orders`
--

CREATE TABLE `my_orders` (
  `o_id` smallint(5) NOT NULL,
  `u_id` smallint(3) NOT NULL,
  `pr_id` smallint(5) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `pr_id` smallint(5) NOT NULL,
  `u_id` smallint(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `area` varchar(30) NOT NULL,
  `society` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `pro_no` varchar(10) NOT NULL,
  `rent_sell` varchar(4) NOT NULL,
  `p_space` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'aquired or not',
  `p_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`pr_id`, `u_id`, `city`, `area`, `society`, `type`, `pro_no`, `rent_sell`, `p_space`, `price`, `description`, `status`, `p_date`) VALUES
(8, 1, 'patan', 'subhash chock', 'krishna flats -1 ', 'tenament', '80', 'Rent', '3BHK', 10000, '', 0, '2023-05-10 08:08:59'),
(9, 1, 'patan', 'ambaji nediyu', 'harsh nagar society', 'apartment', '420', 'Sell', '3BHK', 3500000, '', 0, '2023-05-10 08:13:03'),
(12, 6, 'patan', 'soni vado', 'vishvadham part-1', 'tenament', '49', 'Sell', '1BHK', 150000, '', 0, '2023-05-10 08:23:17'),
(13, 6, 'ahmedabad', 'soni vado', 'vishvadham part-1', 'tenament', '50', 'Rent', '1BHK', 10000, '', 0, '2023-05-10 08:25:15'),
(15, 5, 'ahmedabad', 'subhash chock', 'krishna flats -3', 'apartment', '104', 'Rent', '3BHK', 15000, '', 0, '2023-05-10 08:33:35'),
(17, 7, 'patan', 'bhairav nagar', 'raj nagar flats', 'apartment', '101', 'Sell', '3BHK', 5000000, '', 0, '2023-05-10 08:40:30'),
(18, 3, 'patan', 'ambaji nediyu', 'tirupati nagar', 'tenament', '120', 'Sell', '3BHK', 3500000, 'full address is ambaji nediyu tirupati nagar, patan', 0, '2023-05-12 05:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `prop_photo`
--

CREATE TABLE `prop_photo` (
  `pr_id` smallint(5) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prop_photo`
--

INSERT INTO `prop_photo` (`pr_id`, `photo`) VALUES
(8, 'IMG-645b511be33e44.09984453.jpg'),
(8, 'IMG-645b511be40dd7.71664252.jpg'),
(8, 'IMG-645b511be4e359.81514168.jpg'),
(8, 'IMG-645b511be62928.03620795.jpg'),
(8, 'IMG-645b511be70b65.81436691.jpg'),
(8, 'IMG-645b511be7d276.11292985.jpg'),
(9, 'IMG-645b520f9f50c2.73214940.jpg'),
(9, 'IMG-645b520fbc1a86.51835302.jpg'),
(9, 'IMG-645b520fcb57a1.86351367.jpg'),
(9, 'IMG-645b52100fdf91.65229548.jpg'),
(9, 'IMG-645b52101ede66.39834736.jpg'),
(9, 'IMG-645b52102f1b02.27897561.jpg'),
(12, 'IMG-645b54759bcc74.33870189.jpg'),
(12, 'IMG-645b54759c92e7.26788576.jpg'),
(12, 'IMG-645b54759da5e0.21398692.jpg'),
(12, 'IMG-645b54759e8c11.82408631.jpg'),
(12, 'IMG-645b54759f6ef4.06233439.jpg'),
(12, 'IMG-645b5475a03749.86527242.jpg'),
(13, 'IMG-645b54eb2071c3.73235850.jpg'),
(13, 'IMG-645b54eb219dd9.37479200.jpg'),
(13, 'IMG-645b54eb2293e3.65878036.jpg'),
(13, 'IMG-645b54eb2353d0.34886401.jpg'),
(13, 'IMG-645b54eb240296.16295358.jpg'),
(13, 'IMG-645b54eb24cb22.56128489.jpg'),
(15, 'IMG-645b56df4da1d4.92788053.jpg'),
(15, 'IMG-645b56df4e84d9.30456855.jpg'),
(15, 'IMG-645b56df4f5f12.46246820.jpg'),
(15, 'IMG-645b56df505f00.87928550.jpg'),
(15, 'IMG-645b56df515f92.98411895.jpg'),
(15, 'IMG-645b56df5222a3.03258249.jpg'),
(17, 'IMG-645b587ee27f02.31631455.jpg'),
(17, 'IMG-645b587ee35907.27403787.jpg'),
(17, 'IMG-645b587ee42944.85494168.jpg'),
(17, 'IMG-645b587ee51ae6.55296504.jpg'),
(17, 'IMG-645b587ee5d9f6.08291642.jpg'),
(17, 'IMG-645b587ee71a53.21223293.jpg'),
(18, 'IMG-645dc9f2de2650.02752017.jpg'),
(18, 'IMG-645dc9f2e276b8.92909088.jpg'),
(18, 'IMG-645dc9f2e6e429.51680774.jpg'),
(18, 'IMG-645dc9f2ee10e4.69413140.jpg'),
(18, 'IMG-645dc9f2f25577.43550548.jpg'),
(18, 'IMG-645dc9f302aca5.55078973.jpg'),
(8, 'IMG-646129dc522761.02657690.jpg'),
(8, 'IMG-646129dc528aa4.86521287.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` smallint(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `u_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `email`, `mobile`, `password`, `photo`, `city`, `address`, `u_date`) VALUES
(1, 'krish', 'krishsoni198@gmail.com', '8320302446', '$2y$10$PUaHe6eWzzXMcNKDFGCcBOfZoa4kU//Cze10.yrTKhhPrNk/FmFB.', 'IMG-645de11738dbd2.91293328.png', 'Patan', 'Soni vado, Patan', '2023-05-10 05:55:03'),
(3, 'harsh patel', 'harshpatel@gmail.com', '9853020827', '$2y$10$7Li0TVsRfyQEX5em7gbLc.ClR3v3Jzb8up/7LNZ70YxXy6dxcsH.2', NULL, 'Patan', 'Ambaji Nediyu ,Patan', '2023-05-10 06:07:51'),
(4, 'dhairya gaikwad', 'dhairyag@gmail.com', '9978412971', '$2y$10$jbWA0.cEOYLoOTNRjD.t/eI/F8QLtFIgRawtSbmNsh.PdQNIayPpi', NULL, NULL, NULL, '2023-05-10 06:09:14'),
(5, 'dhruv patel', 'dhruvpatel@gmail.com', '8923298751', '$2y$10$UD375cVXl4I.fTc8TTozuu/NpVAVUxA5F2ZOg8eIA06v47oppK6G2', NULL, NULL, NULL, '2023-05-10 06:10:08'),
(6, 'darji prince', 'dprince05@gmail.com', '6354137632', '$2y$10$0gO2JJMei4q230T0oBTnuOkhA0LuNYt0zhYKlZ2878V6KSyaK4jjy', NULL, NULL, NULL, '2023-05-10 06:13:20'),
(7, 'ritik joshi', 'rj45@gmail.com', '8412907321', '$2y$10$1CGutWWfS4mCuNUKSU7SEu1ccYyRxFDDBll0gIEg3PP5uQzCw9xeu', NULL, NULL, NULL, '2023-05-10 06:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bk_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `fav_property`
--
ALTER TABLE `fav_property`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `prop_photo`
--
ALTER TABLE `prop_photo`
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bk_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `sr_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fav_property`
--
ALTER TABLE `fav_property`
  MODIFY `f_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `my_orders`
--
ALTER TABLE `my_orders`
  MODIFY `o_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `pr_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fav_property`
--
ALTER TABLE `fav_property`
  ADD CONSTRAINT `fav_property_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fav_property_ibfk_2` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD CONSTRAINT `my_orders_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `my_orders_ibfk_2` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prop_photo`
--
ALTER TABLE `prop_photo`
  ADD CONSTRAINT `prop_photo_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `property` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
