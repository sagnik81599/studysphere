-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2026 at 08:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `Med_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `name`, `image`, `price`, `Med_name`) VALUES
(1, 'Dextrose 25% 100ml', 'med_img/Clopidogrel  75mg.avif', 100.00, 'Dextrose'),
(2, 'Chlorambucil-Tablet', 'med_img/Chlorambucil-Tablet-2 30(tablets).jpg', 60.00, 'Chlorambucil'),
(3, 'Ceterizine 10mg', 'med_img/Ceterizine.webp', 22.00, 'Ceterizine'),
(5, 'azithromycin-500-mg-tablets ', 'med_img/azithromycin-500-mg-tablets.jpg', 42.00, 'Azithromycin'),
(6, 'Acenocoumarol.webp', 'med_img/Acenocoumarol .webp', 50.00, ''),
(7, 'Diclofenac 50 mg tablets', 'med_img/DICL002.jpg', 2.30, ''),
(8, 'Ibuprofen 200mg', 'med_img/Ibuprofen.webp', 3.00, ''),
(9, 'Pantoprazole 20mg', 'med_img/Pantoprazole.jpeg', 13.50, 'Pantoprazole'),
(10, 'Metformin 500mg', 'med_img/Metformin.jpeg', 8.00, 'Metformin'),
(11, 'Amlodipine 10mg', 'med_img/zoom-front-10096313.avif', 6.29, 'Amlodipine '),
(12, 'Omeprazole', 'med_img/Omeprazole.jpg', 12.00, 'Omeprazole'),
(13, 'Telmisartan 40mg', 'med_img/Telmisartan.jpg', 12.00, 'Telmisartan'),
(14, 'Atorvastatin 10mg', 'med_img/Atorvastatin.jpg', 8.00, 'Atorvastatin'),
(15, 'Losartan 50mg ', 'med_img/Losartan.jpg', 22.76, 'Losartan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `Age`, `Password`) VALUES
(3, 'saggy', 'sagniksaha@gmail.com', 20, '2004'),
(5, 'sagnik', 's@gmail.com', 21, '123'),
(10, 'sagnik', 'sagnik@gmail.com', 19, '123'),
(11, 'shivam', 'shivam@gmail.com', 23, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
