-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 11:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5114asst1`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `idcreator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`idalbum`, `title`, `imageurl`, `idcreator`) VALUES
(2, '-', NULL, NULL),
(3, 'Lonely Night ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `creator`
--

CREATE TABLE `creator` (
  `idcreator` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `bio` varchar(300) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneNo` varchar(13) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `profilePhoto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creator`
--

INSERT INTO `creator` (`idcreator`, `name`, `website`, `imageurl`, `bio`, `email`, `phoneNo`, `gender`, `username`, `password`, `created_at`, `profilePhoto`) VALUES
(1, 'Joey', 'www.google.com', NULL, 'Who runs the world? ME', 'example@ypccollege.edu.my', '010-110-1091', 'others', 'xinyijoey', '$2y$10$itmPjZg3xk2b/vdajJ0EO.eAYQhFBqVnLxtOzPQPXwFYIDu5Soque', '2021-04-22 17:23:35', 'Laptop.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `idphoto` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `comment` varchar(140) DEFAULT NULL,
  `idcreator` int(11) DEFAULT NULL,
  `idalbum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`idphoto`, `title`, `imageurl`, `comment`, `idcreator`, `idalbum`) VALUES
(2, 'A blue Door #red', 'Blue Door.jpg', 'I love red color. Red is my fav color <3', NULL, 2),
(3, 'Macbook ', 'Laptop.jpg', 'My new laptop is arrived ', NULL, 2),
(4, 'Night View', 'Night.jpg', 'Sleeplest night :(', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`),
  ADD KEY `album_creator_idx` (`idcreator`);

--
-- Indexes for table `creator`
--
ALTER TABLE `creator`
  ADD PRIMARY KEY (`idcreator`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idphoto`),
  ADD KEY `photo_album_idx` (`idalbum`),
  ADD KEY `photo_creator_idx` (`idcreator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `idalbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `creator`
--
ALTER TABLE `creator`
  MODIFY `idcreator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_creator` FOREIGN KEY (`idcreator`) REFERENCES `creator` (`idcreator`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `image_album` FOREIGN KEY (`idalbum`) REFERENCES `album` (`idalbum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `photo_creator` FOREIGN KEY (`idcreator`) REFERENCES `creator` (`idcreator`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
