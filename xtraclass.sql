-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2018 at 07:41 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xtraclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `myans` varchar(255) NOT NULL,
  `status` int(255) DEFAULT '1',
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `exam_id`, `question_id`, `myans`, `status`, `date`) VALUES
(1, '1', '1', '1', 'ans1', 1, '2018-06-22 03:06:30.548267'),
(2, '1', '1', '2', 'yes', 1, '2018-06-22 03:06:30.548267'),
(3, '1', '2', '6', '8', 1, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(255) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `exam_id` int(255) NOT NULL,
  `status` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `exam_id`, `status`) VALUES
(1, 'jamb', 1, 1),
(2, 'post ume', 2, 1),
(3, 'waec', 3, 1),
(4, 'neco', 4, 1),
(11, '4', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_book`
--

CREATE TABLE `order_book` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `book_id` varchar(255) NOT NULL,
  `in_order` int(255) NOT NULL,
  `sold` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `seller_id` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `book_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_book`
--

INSERT INTO `order_book` (`id`, `order_id`, `book_id`, `in_order`, `sold`, `price`, `description`, `seller_id`, `status`, `book_title`) VALUES
(1, '1', '1', 1, 2, 2000, 'dhdjd', '1', 1, ''),
(2, '1', '1', 1, 0, 2000, 'dhdjd', '1', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(6) NOT NULL,
  `question` text NOT NULL,
  `exam_id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `optiona` varchar(255) NOT NULL,
  `optionb` varchar(255) NOT NULL,
  `optionc` varchar(255) NOT NULL,
  `optiond` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `exam_id`, `question_id`, `optiona`, `optionb`, `optionc`, `optiond`, `answer`) VALUES
(1, 'What is Biology?', 1, 1, 'study of life', 'study of money', 'study of food', 'study of forests', 'study of life '),
(2, 'What is Biology?', 2, 2, 'study of life', 'study of money', 'study of food', 'study of forests', 'study of life '),
(3, 'What is Biology?', 3, 3, 'study of life', 'study of money', 'study of food', 'study of forests', 'study of life '),
(4, 'What is Biology?', 4, 4, 'study of life', 'study of money', 'study of food', 'study of forests', 'study of life '),
(5, 'What is Biology?', 5, 5, 'study of life', 'study of money', 'study of food', 'study of forests', 'study of life '),
(7, '4', 2, 6, 'are u a man?', '4', '4', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `book_id` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `featured` int(2) NOT NULL,
  `price` double NOT NULL,
  `banner` varchar(100) NOT NULL,
  `abstract` longtext NOT NULL,
  `long_description` longtext NOT NULL,
  `attachment` text NOT NULL,
  `tags` text NOT NULL,
  `sellers_note` text NOT NULL,
  `sellers_id` varchar(16) NOT NULL,
  `views` int(11) DEFAULT NULL,
  `downloads` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=REDUNDANT;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`id`, `book_title`, `book_id`, `category`, `featured`, `price`, `banner`, `abstract`, `long_description`, `attachment`, `tags`, `sellers_note`, `sellers_id`, `views`, `downloads`, `status`) VALUES
(3, 'am changed1', '3', 'novels', 1, 2001, 'Yea a new BANNER', 'true', 'lets discuss later', 'nothing for now', '2', 'yes its a great book', '2', 34, 3, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_book`
--
ALTER TABLE `order_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `order_book`
--
ALTER TABLE `order_book`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
