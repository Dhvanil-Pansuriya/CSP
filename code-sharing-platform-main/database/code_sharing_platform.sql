-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 04:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_sharing_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `name` varchar(50) NOT NULL,
  `registered_on` datetime NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `user_avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `email`, `name`, `registered_on`, `admin_password`, `user_avatar`) VALUES
('khatrifaiz', 'faizkhatri00@gmail.com', 'Khatri Faiz', '2023-04-30 18:23:11', '59e7d3ff65d3753e4fa7a70022893611', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `code_snippets`
--

CREATE TABLE `code_snippets` (
  `snippet_id` varchar(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `html_code` mediumtext DEFAULT NULL,
  `css_code` mediumtext DEFAULT NULL,
  `js_code` mediumtext DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `code_snippets`
--

INSERT INTO `code_snippets` (`snippet_id`, `title`, `html_code`, `css_code`, `js_code`, `created_on`, `author`) VALUES
('5DjEMNXBNwi', 'Rotating Flower Animation', '<body>\r\n  <div class=\"flower\">\r\n    <div class=\"petal petal-1\"></div>\r\n    <div class=\"petal petal-2\"></div>\r\n    <div class=\"petal petal-3\"></div>\r\n    <div class=\"petal petal-4\"></div>\r\n    <div class=\"petal petal-5\"></div>\r\n    <div class=\"petal petal-6\"></div>\r\n    <div class=\"petal petal-7\"></div>\r\n    <div class=\"petal petal-8\"></div>\r\n    <div class=\"center\"></div>\r\n  </div>\r\n</body>\r\n', 'body {\r\n  background-color: #fdfd96;\r\n  height: 100vh;\r\n  margin: 0;\r\n  padding: 0;\r\n}\r\n\r\n.flower {\r\n  position: absolute;\r\n  top: 50%;\r\n  left: 50%;\r\n  transform: translate(-50%, -50%);\r\n  width: 600px;\r\n  height: 600px;\r\n  display: flex;\r\n  align-items: center;\r\n  justify-content: center;\r\n  animation: rotate 25s ease-in-out infinite alternate;\r\n}\r\n\r\n.petal {\r\n  width: 100px;\r\n  height: 200px;\r\n  background-color: #ffaa00;\r\n  border-radius: 50% 50% 0 0;\r\n  transform-origin: bottom center;\r\n  position: absolute;\r\n  top: 100px;\r\n}\r\n\r\n.petal:nth-child(1) {\r\n  transform: rotate(0deg);\r\n  animation: bounce 1s ease-in-out infinite alternate;\r\n}\r\n\r\n.petal:nth-child(2) {\r\n  transform: rotate(45deg);\r\n  animation: bounce2 1s ease-in-out infinite alternate;\r\n}\r\n\r\n.petal:nth-child(3) {\r\n  transform: rotate(90deg);\r\n  animation: bounce3 1s ease-in-out infinite alternate;\r\n}\r\n\r\n.petal:nth-child(4) {\r\n  transform: rotate(135deg);\r\n  animation: bounce4 1s ease-in-out infinite alternate;\r\n}\r\n.petal:nth-child(5) {\r\n  transform: rotate(180deg);\r\n  animation: bounce5 1s ease-in-out infinite alternate;\r\n}\r\n.petal:nth-child(6) {\r\n  transform: rotate(220deg);\r\n  animation: bounce6 1s ease-in-out infinite alternate;\r\n}\r\n.petal:nth-child(7) {\r\n  transform: rotate(265deg);\r\n  animation: bounce7 1s ease-in-out infinite alternate;\r\n}\r\n.petal:nth-child(8) {\r\n  transform: rotate(310deg);\r\n  animation: bounce8 1s ease-in-out infinite alternate;\r\n}\r\n\r\n\r\n\r\n.center {\r\n  width: 80px;\r\n  height: 80px;\r\n  background-color: #ff3030;\r\n  border-radius: 50%;\r\n  position: absolute;\r\n  top: 50%;\r\n  left: 50%;\r\n  transform: translate(-50%, -50%);\r\n  z-index: 2;\r\n}\r\n\r\n\r\n@keyframes rotate {\r\n  from {\r\n    transform: translate(-50%, -50%) rotate(0deg)\r\n  }\r\n  to {\r\n    transform: translate(-50%, -50%) rotate(360deg)\r\n  }\r\n}\r\n\r\n\r\n@keyframes bounce {\r\n  from {\r\n    transform: rotate(0deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(1deg) translateY(-10px);\r\n  }\r\n}\r\n@keyframes bounce2 {\r\n  from {\r\n    transform: rotate(45deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(44deg) translateY(-10px);\r\n  }\r\n}\r\n@keyframes bounce3 {\r\n  from {\r\n    transform: rotate(90deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(92deg) translateY(-6px);\r\n  }\r\n}\r\n@keyframes bounce4 {\r\n  from {\r\n    transform: rotate(135deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(133deg) translateY(-10px);\r\n  }\r\n}\r\n@keyframes bounce5 {\r\n  from {\r\n    transform: rotate(180deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(177deg)  translateY(-8px);\r\n  }\r\n}\r\n@keyframes bounce6 {\r\n  from {\r\n    transform: rotate(220deg)  translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(222deg)  translateY(-9px);\r\n  }\r\n}\r\n@keyframes bounce7 {\r\n  from {\r\n    transform: rotate(265deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(265deg) translateY(-10px);\r\n  }\r\n}\r\n@keyframes bounce8 {\r\n  from {\r\n    transform: rotate(310deg) translateY(0);\r\n  }\r\n  to {\r\n    transform: rotate(310deg) translateY(-10px);\r\n  }\r\n}', '', '2023-04-30 16:12:39', 'sahilkhan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `name` varchar(50) NOT NULL,
  `registered_date` datetime NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `name`, `registered_date`, `password`, `user_avatar`) VALUES
('admin', 'admin@gmail.com', 'admin', '2023-04-07 09:57:05', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
('ajayagar', 'ajaynagar23@gmail.com', 'Ajay Nagar', '2023-04-06 09:24:59', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
('ajaynagar', 'ajaynagar123@gmail.com', 'Ajay Nagar', '2023-04-06 09:20:00', 'dcdd136df5c72a4a039d6fd97d468bd9', NULL),
('akshaykumar', 'akshaykumar16@gmail.com', 'Akshay Kumar', '2023-04-06 00:00:00', '1609448126e1e0e75255631685378ac0', NULL),
('akshay_kumar', 'akshaykumar1@gmail.com', 'Kumar Akshay', '2023-04-06 00:00:00', '1609448126e1e0e75255631685378ac0', NULL),
('faiz@2004', 'faizkhatri00@gmail.com', 'Faiz Khatri', '2023-04-06 11:34:51', '59e7d3ff65d3753e4fa7a70022893611', NULL),
('faizkh', 'Faizkhatri@gmail.com', 'Faizkhatri', '2023-04-06 12:56:08', 'd73d3961b4990b1e73b4ed7f1818bba4', NULL),
('faizkhatri2004', 'faizkhatri2004@gmail.com', 'Faiz khatri', '2023-04-06 13:39:55', '59e7d3ff65d3753e4fa7a70022893611', NULL),
('sahilkhan', 'sahilkhan@gmail.com', 'Pathan Sahil', '2023-04-06 19:12:52', '827ccb0eea8a706c4c34a16891f84e7b', 'sahilkhan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `code_snippets`
--
ALTER TABLE `code_snippets`
  ADD PRIMARY KEY (`snippet_id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `code_snippets`
--
ALTER TABLE `code_snippets`
  ADD CONSTRAINT `code_snippets_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
