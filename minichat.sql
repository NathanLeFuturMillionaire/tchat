-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2023 at 01:33 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minichat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_sender` int NOT NULL,
  `id_receiver` int NOT NULL,
  `messages` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `message_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `id_sender`, `id_receiver`, `messages`, `message_date`) VALUES
(1, 3, 4, 'dfdfdfdfdfdfdfdfdfdf', '2023-12-20 07:40:16'),
(2, 3, 4, 'dfdfdfdfdfdfdfdfdfdf', '2023-12-20 07:40:46'),
(3, 3, 4, 'Yo yo yo yo', '2023-12-20 07:43:13'),
(4, 3, 4, 'dsfsdf', '2023-12-20 07:43:16'),
(5, 3, 4, 'sdfsf', '2023-12-20 07:43:17'),
(6, 3, 4, 'sdfsdfsdf', '2023-12-20 07:43:19'),
(7, 3, 4, 'sdfsdfsf', '2023-12-20 07:43:21'),
(8, 3, 4, 'sdfsfsdfs', '2023-12-20 07:43:22'),
(9, 3, 4, 'sdfsfsdf', '2023-12-20 07:43:24'),
(10, 3, 4, 'sdfsdfd', '2023-12-20 07:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

DROP TABLE IF EXISTS `online_users`;
CREATE TABLE IF NOT EXISTS `online_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `online_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id`, `id_user`, `online_date`) VALUES
(15, 2, '2023-12-19 14:43:12'),
(18, 4, '2023-12-20 06:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `enroll_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='The users table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `enroll_date`) VALUES
(1, 'Nathan l\'artiste', 'nathan@gmail.com', '$2y$10$clwXx36DxYEtOOIcLuScuOcXT4MvhcjKc6ePA9OSaKzLXrv0Xr3wm', '2023-12-18 14:12:10'),
(2, 'Prince', 'prince@gmail.com', '$2y$10$i.sjYNgWt2TxwrMdEWNbsuKwc2IFICESvgX4hzcqL.cUhQg.B9JK6', '2023-12-18 17:39:08'),
(3, 'Nathan le futur millionaire', 'nathanfutur@gmail.com', '$2y$10$0WfXaJM3vjwMsZrG194yLe74goLOYxfWgyvjaaxtloJP5pYE3wsvC', '2023-12-18 18:09:36'),
(4, 'Nathan l\'artiste', 'harydeveloppeur@gmail.com', '$2y$10$cBMweux1m7ogU.A8lP1hVeGg7zvncs3a4PoUtiHkp4J75KFM9Ecue', '2023-12-19 14:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_informations`
--

DROP TABLE IF EXISTS `user_informations`;
CREATE TABLE IF NOT EXISTS `user_informations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_informations`
--

INSERT INTO `user_informations` (`id`, `id_user`, `picture`) VALUES
(1, 1, '1.jpg'),
(2, 2, '2.JPG'),
(3, 3, '3.jpeg'),
(4, 4, '4.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
