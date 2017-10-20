-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2017 at 11:44 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `city`, `country`, `email`) VALUES
(1, 'Roman Abramovich', 'Saratov', 'Russian', 'roman@gmail.com'),
(2, 'Bill Gates', 'Washington', 'USA', 'bill@gmail.com'),
(3, 'Jack Ma', 'Hangzhou', 'China', 'jack@gmail.com'),
(4, 'Dinh Van', 'Ho Chi Minh', 'Viet Nam', 'dinhvan@gmail.com'),
(5, 'William', 'Brasília', 'Brasil', 'william@gmail.com'),
(7, 'Amagumo', 'Paris', 'France', 'amagumo@gmail.com'),
(10, 'Ronaldo', 'Lisboa', 'Portugal', 'ronaldo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE `employee_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_types`
--

INSERT INTO `employee_types` (`id`, `type`) VALUES
(1, 'Developer'),
(2, 'Manager'),
(3, 'HR'),
(4, 'CEO'),
(5, 'Director'),
(6, 'Board of directors');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `department`, `status`, `start_date`, `end_date`, `customer_id`) VALUES
(1, 'Project 10', 'Director', 0, '2017-10-13 08:55:33', '2017-12-31 17:00:00', 1),
(2, 'Project 2', 'HR', 1, '2017-08-10 17:00:00', '2018-11-10 17:00:00', 3),
(5, 'Project 5', 'CEO', 1, '2017-10-13 08:54:43', '2018-12-26 17:00:00', 7),
(6, 'Project 6', 'Manager', 1, '2017-10-25 17:00:00', '2018-01-25 17:00:00', 10),
(7, 'Project 7', 'HR', 0, '2017-10-17 17:00:00', '2018-01-17 17:00:00', 3),
(8, 'Project 8', 'Board of directors', 1, '2017-10-26 17:00:00', '2017-12-07 17:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `taskname` varchar(50) NOT NULL,
  `comments` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `taskname`, `comments`) VALUES
(1, 5, 'Task 11', 'Mr Van'),
(2, 8, 'Task 10', 'Mr Philippe'),
(4, 6, 'Task Add', 'Mr Minh'),
(5, 2, 'Task Romove', 'Miss Trang'),
(7, 7, 'Task 13', 'Jack Ma');

-- --------------------------------------------------------

--
-- Table structure for table `time_entries`
--

CREATE TABLE `time_entries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `working_time` int(11) DEFAULT NULL,
  `overtime` int(11) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_entries`
--

INSERT INTO `time_entries` (`id`, `user_id`, `working_time`, `overtime`, `create_date`, `note`, `task_id`, `start_date`) VALUES
(16, 10, 8, 2, '2017-10-19 02:57:45', 'Mr. Dinh Van', 4, '2017-10-18 17:00:00'),
(17, 1, 8, NULL, '2017-10-19 08:47:25', 'asghgfds', 7, '2017-10-18 17:00:00'),
(19, 1, 8, NULL, '2017-10-19 08:51:33', 'Dinh Van Add', 4, '2017-10-18 17:00:00'),
(20, 1, 8, 0, '2017-10-19 08:56:22', 'Test overtime', 7, '2017-10-18 17:00:00'),
(21, 1, 9, 0, '2017-10-19 09:08:10', 'Dinh Van Add', 4, '2017-10-29 17:00:00'),
(22, 1, 8, 0, '2017-10-18 17:00:00', 'Dinh Van Add', 2, '2017-10-28 17:00:00'),
(23, 1, 8, 0, '2017-10-18 17:00:00', 'Hnay la ngay dep troi', 7, '2017-10-30 17:00:00'),
(24, 1, 8, 0, '2017-10-18 17:00:00', 'Dinh Van Test', 7, '2017-10-24 17:00:00'),
(25, 1, 9, 0, '2017-10-18 17:00:00', 'William test', 2, '2017-10-29 17:00:00'),
(26, 1, 8, 0, '2017-10-19 17:00:00', 'H?m nay l? ng?y....', 7, '2017-10-29 17:00:00'),
(27, 1, 8, 0, '2017-10-19 17:00:00', 'H?m nay l?....', 7, '2017-10-29 17:00:00'),
(28, 1, 8, 0, '2017-10-19 17:00:00', 'Hôm nay là ngày phụ nữ Việt Nam', 7, '2017-11-29 17:00:00'),
(29, 1, 8, 0, '2017-10-19 17:00:00', 'Hôm nay là ngày phụ nữ Việt Nam\r\nMình mới gọi điện thoại về cho má lúc sáng, trưa nay sẽ gọi cho bà nội', 2, '2017-11-09 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `employee_type_id` int(11) NOT NULL,
  `remember_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `position`, `firstname`, `start_date`, `end_date`, `password`, `lastname`, `username`, `employee_type_id`, `remember_token`) VALUES
(1, 1, 1, 'Phan', '2017-10-20 04:40:06', '2020-05-20 17:00:00', '$2y$10$HT8Lbzr6BHy331EzZ8jEg.eYwNipRVc65.jzuLY8.nZmHRiq5vxmG', 'Dinh Van', 'pdvan.it@gmail.com', 1, 'O07VpifgMXGMY4Cu9OD9mlOhjprzGqTss1Jw1QJaEvTcp7S7NkerW43bh0hR'),
(2, 1, 1, 'Phan', '2017-10-17 06:48:45', '2018-11-27 17:00:00', '$2y$10$KR7DQRF0UvPa1IGNfXiEfudwI6PU2.sslbekNeQIWRrWgS37jJwm6', 'Thu', 'thuphan@gmail.com', 1, '8RSwjr7KFD1HmCNiWkBFirla6JdizNkpkni3Pp7Zk2VJ1F0zp97ozu0VD3tK'),
(3, 0, 0, 'Phan', '2017-10-12 10:35:27', '2019-06-09 17:00:00', '123', 'Dinh Vu', 'pdvu@gmail.com', 1, ''),
(5, 1, 0, 'Le', '2017-10-12 04:08:34', '0000-00-00 00:00:00', '123', 'Quang Khai', 'quangkhai@gmail.com', 1, ''),
(7, 1, 1, 'Nguyen', '2014-12-31 17:00:00', '0000-00-00 00:00:00', '123', 'Philippe', 'bnc3.mailjet.com ', 2, ''),
(8, 1, 1, 'My', '2014-12-31 17:00:00', '0000-00-00 00:00:00', '123', 'Trang', 'admin@amagumolabs.com', 3, ''),
(10, 1, 0, 'Ly', '2017-10-17 07:27:29', '2017-10-12 09:37:18', '$2y$10$yJrvCxOxQ64.i42neoRpHu4SfdaLiAijHNfqN6B4H4SrytbTe5Lsa', 'Hai', 'lyhai@gmail.com', 1, 'nb9vkU642KXgI5wXxlSHgT1g02wvmTcUp3ZsZPNLGKBsXIdUa2P53wUyExVA'),
(12, 1, 0, 'Đàm', '2017-10-24 17:00:00', '2018-07-12 17:00:00', '$2y$10$WIv7FTOqZaQQ8RGeSouoaOWubzYpub3DAH8uAWNP2i5s6xJRCjfby', 'Vĩnh Hưng', 'dvhung@gmail.com', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_project_ind` (`customer_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `time_entries`
--
ALTER TABLE `time_entries`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `timesheet_ind` (`user_id`),
  ADD KEY `time_ind` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_emp_ind` (`employee_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_types`
--
ALTER TABLE `employee_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `time_entries`
--
ALTER TABLE `time_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_project_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_entries`
--
ALTER TABLE `time_entries`
  ADD CONSTRAINT `fk_timesheet_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_emp` FOREIGN KEY (`employee_type_id`) REFERENCES `employee_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
