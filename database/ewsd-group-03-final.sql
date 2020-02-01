-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2019 at 03:17 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewsd-group-03`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `articles` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '0->pending; 1->selected',
  `eventId` int(11) NOT NULL,
  `submission_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `student_id`, `articles`, `status`, `eventId`, `submission_date`) VALUES
(1, 4, 'bookfestival.doc', 0, 1, '2019-04-29'),
(2, 4, 'Annual Convo.docx', 0, 2, '2019-04-29'),
(3, 5, 'masumbillah.docx', 0, 1, '2019-04-29'),
(4, 5, 'Medical Article.doc', 0, 2, '2019-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `cmnt_submit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `comments`, `cmnt_submit_date`) VALUES
(1, 3, 1, 'Thanks for your contribution.', '2019-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `closure_date` date NOT NULL,
  `event_session` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `closure_date`, `event_session`) VALUES
(1, 'Book Festival', '2019-05-09', 2019),
(2, 'Annual Convocation', '2019-05-15', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`fac_id`, `fac_name`) VALUES
(1, 'IT'),
(2, 'CSE'),
(3, 'CIS');

-- --------------------------------------------------------

--
-- Table structure for table `fac_coordinator`
--

CREATE TABLE `fac_coordinator` (
  `fac_coor_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `coordinator_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fac_coordinator`
--

INSERT INTO `fac_coordinator` (`fac_coor_id`, `fac_id`, `coordinator_user_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mail_notification`
--

CREATE TABLE `mail_notification` (
  `mail_id` int(11) NOT NULL,
  `coordinator_user_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `contribution_id` varchar(14) NOT NULL,
  `mail_body` text NOT NULL,
  `mail_stts` int(1) NOT NULL COMMENT '0->new; 1->read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_notification`
--

INSERT INTO `mail_notification` (`mail_id`, `coordinator_user_id`, `fac_id`, `student_id`, `contribution_id`, `mail_body`, `mail_stts`) VALUES
(1, 3, 1, 4, 'ph_1', 'Md Abdul Goni Rabbee has submitted an image.', 0),
(2, 3, 1, 4, 'ar_1', 'Md Abdul Goni Rabbee has submitted an articles.', 0),
(3, 3, 1, 4, 'ar_2', 'Md Abdul Goni Rabbee has submitted an articles.', 0),
(4, 2, 2, 5, 'ph_2', 'Md Masum Billah has submitted an image.', 0),
(5, 2, 2, 5, 'ar_3', 'Md Masum Billah has submitted an articles.', 0),
(6, 2, 2, 5, 'ar_4', 'Md Masum Billah has submitted an articles.', 0),
(7, 3, 3, 6, 'ph_3', 'John Doe has submitted an image.', 0),
(8, 3, 1, 4, 'ph_4', 'Md Abdul Goni Rabbee has submitted an image.', 0),
(9, 3, 1, 4, 'ph_5', 'Md Abdul Goni Rabbee has submitted an image.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `photographs`
--

CREATE TABLE `photographs` (
  `photograph_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `photograph` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0->pending; 1->selected',
  `eventId` int(11) NOT NULL,
  `submission_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photographs`
--

INSERT INTO `photographs` (`photograph_id`, `student_id`, `photograph`, `status`, `eventId`, `submission_date`) VALUES
(1, 4, 'study1.jpg', 0, 1, '2019-04-29'),
(2, 5, 'study2.jpg', 0, 1, '2019-04-29'),
(3, 6, 'study3.jpg', 0, 2, '2019-04-29'),
(4, 4, 'coding.png', 0, 2, '2019-04-29'),
(5, 4, 'programming.jpg', 0, 1, '2019-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `roll`, `userId`, `faculty_id`) VALUES
(1, 0, 2, 0),
(2, 0, 3, 0),
(3, 0, 4, 1),
(4, 1, 5, 1),
(5, 1, 6, 2),
(6, 2, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `userRole` int(1) NOT NULL COMMENT '0->admin, 1->student, 2->manager, 3->coordinator, 4->guest',
  `acc_status` int(1) NOT NULL COMMENT '0->pending, 1-> active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `contact`, `userRole`, `acc_status`) VALUES
(1, 'System', 'Admin', 'system@admin.com', '21232F297A57A5A743894A0E4A801FC3', '12345678901', 0, 1),
(2, 'Md Ashadozzaman', 'Shovoua', 'shovoua@gmail.com', 'd8d811374d4fe78f2b5b641b5db5f28f', '+8801762662171', 3, 1),
(3, 'Kamrul', 'Islam', '1000438@daffodil.ac', '3481fb769274abccd300e1516f252712', '+8801836858311', 3, 1),
(4, 'Md Shahid', 'Hossan', '1000111@daffodil.ac', 'f3224d90c778d5e456b49c75f85dd668', '+8801716148452', 2, 1),
(5, 'Md Abdul Goni', 'Rabbee', '1000559@daffodil.ac', '61cdade4ed883b6051ca5e7c22b21392', '+8801799872659', 1, 1),
(6, 'Md Masum', 'Billah', 'masumthamid@gmail.com', 'd76f375ed95c85499d966c5b90be90a9', '+8801402290505', 1, 1),
(7, 'John', 'Doe', '1000559@diit.info', '527bd5b5d689e2c32ae974c6229ff785', '+8801754236987', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `fac_coordinator`
--
ALTER TABLE `fac_coordinator`
  ADD PRIMARY KEY (`fac_coor_id`);

--
-- Indexes for table `mail_notification`
--
ALTER TABLE `mail_notification`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `photographs`
--
ALTER TABLE `photographs`
  ADD PRIMARY KEY (`photograph_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fac_coordinator`
--
ALTER TABLE `fac_coordinator`
  MODIFY `fac_coor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mail_notification`
--
ALTER TABLE `mail_notification`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `photographs`
--
ALTER TABLE `photographs`
  MODIFY `photograph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
