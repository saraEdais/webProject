-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2022 at 08:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friendsbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'saraedais12', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `postId` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `postId`, `comment`, `createdTime`) VALUES
(1, 'saraedais', 8, 'hello', '2022-04-12 15:17:37'),
(2, 'saraedais', 13, 'true 100%', '2022-04-12 15:27:16'),
(3, 'rubairshaid', 13, 'i agree with you', '2022-04-15 11:47:30'),
(4, 'hibaedais', 11, 'Ramadan Kareem ', '2022-04-15 11:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `userId` int(11) NOT NULL,
  `friendId` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`userId`, `friendId`, `status`) VALUES
(1, 4, 'friend'),
(4, 1, 'friend'),
(3, 1, 'friend'),
(1, 3, 'friend'),
(3, 2, 'friend'),
(2, 3, 'friend'),
(1, 8, 'send'),
(8, 1, 'receive'),
(5, 1, 'send'),
(1, 5, 'receive'),
(1, 6, 'send'),
(6, 1, 'receive'),
(4, 9, 'send'),
(9, 4, 'receive'),
(4, 5, 'friend'),
(5, 4, 'friend'),
(2, 8, 'send'),
(8, 2, 'receive'),
(1, 9, 'send'),
(9, 1, 'receive'),
(2, 1, 'friend'),
(1, 2, 'friend'),
(2, 4, 'friend'),
(4, 2, 'friend'),
(5, 2, 'friend'),
(2, 5, 'friend');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `username` varchar(60) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`username`, `postId`) VALUES
('saraedais', 11),
('rubairshaid', 13),
('rubairshaid', 11),
('saraedais', 7),
('saraedais', 13),
('saraedais', 12),
('saraedais', 10);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `user_id` int(11) NOT NULL,
  `send_to_id` int(11) NOT NULL,
  `body` varchar(500) NOT NULL,
  `sended_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen_state` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`user_id`, `send_to_id`, `body`, `sended_at`, `seen_state`) VALUES
(1, 2, 'hi', '2022-05-13 20:58:23', 1),
(1, 2, 'how are you', '2022-05-13 20:58:34', 1),
(2, 1, 'hello', '2022-05-13 21:01:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `textContent` varchar(400) NOT NULL,
  `imageContent` varchar(100) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `username`, `textContent`, `imageContent`, `likes`, `createdTime`, `activation`) VALUES
(3, 'saraedais', 'my first post on friendsBook website ', NULL, 0, '2022-03-26 17:54:42', 1),
(6, 'saraedais', 'Hello world :)', NULL, 0, '2022-03-31 18:37:59', 1),
(7, 'hibaedais', 'All life is an experiment. The more experiments you make the better', NULL, 1, '2022-03-31 19:28:53', 1),
(8, 'ahmad123', 'hi', NULL, 0, '2022-03-31 21:03:41', 0),
(10, 'ahmad123', 'Good evening all :)', '3800_4_02.jpg', 1, '2022-03-31 21:13:13', 1),
(11, 'saraedais', 'Ramadan Kareem 2/4/2022', '5066096.jpg', 2, '2022-04-01 16:57:40', 1),
(12, 'rubairshaid', 'soooooooooon', 'sooon.jpg', 1, '2022-04-01 17:23:10', 1),
(13, 'saraedais', 'A man who dares to waste one hour of time has not discovered the value of life\r\n', 'life.jpg', 2, '2022-04-02 20:47:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `telephone` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `imageFile` varchar(30) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `password`, `telephone`, `address`, `email`, `gender`, `imageFile`, `active`) VALUES
(1, 'saraedais', 'sara', 'edais', '12345', '0595209370', 'hebron', 'saraedais99@gmail.com', 'female', 'head_pomegranate.png', 1),
(2, 'hibaedais', 'hiba', 'edais', '67890', '0599756240', 'hebron', 'hiba123@gmail.com', 'female', 'head_alizarin.png', 1),
(3, 'ahmad123', 'ahmad', 'edais', '462873', '0599375674', 'hebron', 'ahmad435@gmail.com', 'male', 'head_wet_asphalt.png', 1),
(4, 'rubairshaid', 'ruba', 'irshaid', '23875', '0595347627', 'hebron', 'rubairshaid@gmail.com', 'female', 'head_sun_flower.png', 1),
(5, 'manaredais', 'manar', 'edais', '388749', '0599376764', 'hebron', 'manar235@gmail.com', 'female', 'head_amethyst.png', 1),
(6, 'ammeredais', 'ameer', 'edais', '845848', '0599736452', 'hebron', 'ameer66@gmail.com', 'male', 'head_deep_blue.png', 1),
(7, 'mohammad34', 'mohammad', 'edais', '093894', '0595736570', 'hebron', 'mohammad45@gmail.com', 'male', 'head_emerald.png', 1),
(8, 'aseelIrshaid', 'aseel', 'irshaid', '23678', '0595233899', 'hebron', 'aseel989@gmail.com', 'female', 'head_wisteria.png', 1),
(9, 'alaairshaid', 'alaa', 'irshaid', '883222', '0599876440', 'hebron', 'alaa33@gmail.com', 'male', 'head_deep_blue.png', 1),
(10, 'omarirshaid', 'omar', 'irshaid', '12678', '0599767869', 'hebron', 'omar09@gmail.com', 'male', 'head_pumpkin.png', 1),
(11, 'noorRamadan', 'noor', 'ramadan', '66878', '0599679899', 'hebron', 'noor22@gmail.com', 'female', 'head_carrot.png', 0),
(12, 'halaedais', 'hala', 'edais', '987655', '0599345678', 'hebron', 'halaedais@gmail.com', 'female', 'head_red.png', 1),
(13, 'yousefZaro', 'yousef', 'zaro', '09543', '0599543490', 'hebron', 'yousef67@gmail.com', 'male', 'head_green_sea.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
