-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 10:59 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `town` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `category` varchar(50) NOT NULL,
  `thumbnail_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `town`, `city`, `phone`, `address`, `description`, `category`, `thumbnail_url`) VALUES
(1, 'Grand Sultan', 'town name', 'city name', '9780650234', 'address', 'Updated', 'Motel', 'restaurant.jpg'),
(7, 'Larose', 'town name', 'city name', '9780650234', 'address', 'Updated', 'Motel', 'food.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `hotel_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(500) NOT NULL,
  `profile` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `hotel_id`, `user_id`, `title`, `rating`, `review`, `profile`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Best One', 5, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-20 18:00:00', '2022-04-20 18:00:00'),
(3, 1, 2, 'Best in the country', 3, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-20 18:00:00', '2022-04-20 18:00:00'),
(4, 1, 2, 'Marvelous', 4, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-20 18:00:00', '2022-04-20 18:00:00'),
(5, 7, 2, 'Title', 3, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-20 18:00:00', '2022-04-20 18:00:00'),
(6, 7, 2, 'Worst ever', 2, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-20 18:00:00', '2022-04-20 18:00:00'),
(14, 7, 4, 'asd', 2, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-26 09:20:33', '2022-04-26 09:20:33'),
(22, 7, 4, 'asd', 2, 'Birthday dinner for boyfriend. The food selection was okay, I feel like the view is definitely the main attraction.', 'avatar.png', '2022-04-26 09:20:33', '2022-04-26 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_type` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email_address`, `phone`, `password`, `user_type`) VALUES
(1, 'System Admin', 'test@admin.co', '01712345678', '08f5b04545cbf7eaa238621b9ab84734', 'Admin'),
(2, 'Test User', 'test@user.co', '01798765432', '08f5b04545cbf7eaa238621b9ab84734', 'User'),
(3, 'Russel Hussain', 'russel@test.co', '01717282114', '08f5b04545cbf7eaa238621b9ab84734', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
