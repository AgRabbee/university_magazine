-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2019 at 11:23 PM
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
(1, 2, 'vocabulary.docx', 1, 1, '2019-02-12'),
(2, 1, 'updateTry3.docx', 1, 1, '2019-02-13'),
(5, 2, 'Technical Article Example.doc', 1, 1, '2019-03-16'),
(6, 2, 'Medical Article.doc', 1, 1, '2019-03-31'),
(14, 1, 'boishak.docx', 0, 3, '2019-04-14'),
(15, 1, 'testArticle.docx', 0, 3, '2019-04-14');

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
(1, 8, 2, 'Test comment one', '2019-04-14'),
(6, 2, 2, 'Yeah I know that. Thanks', '2019-04-14'),
(8, 8, 14, 'Good one for boisakh event.', '2019-04-14');

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
(1, 'magazine for freshers reception', '2019-04-30', 2019),
(3, 'event for pohela boishak', '2019-04-29', 2019),
(4, 'Test event name 1', '2019-04-28', 2019),
(5, 'test event 3', '2019-09-23', 2019);

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
(4, 'Physics'),
(7, 'Bangla'),
(8, 'English'),
(9, 'Math');

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
(1, 1, 6),
(2, 2, 8),
(4, 4, 6),
(6, 7, 6),
(7, 8, 8),
(8, 9, 6);

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
(1, 6, 1, 1, 'ph_5', 'abdul goni Rabbee has submitted an image.', 1),
(3, 6, 1, 1, 'ar_8', 'abdul goni Rabbee has submitted an articles.', 1),
(10, 6, 1, 1, 'ph_18', 'abdul goni Rabbee has submitted an image.', 1),
(11, 6, 1, 1, 'ar_9', 'abdul goni Rabbee has submitted an articles.', 1),
(12, 6, 1, 1, 'ph_19', 'abdul goni Rabbee has submitted an image.', 1),
(13, 6, 1, 1, 'ph_19', 'abdul goni Rabbee has submitted an image.', 1),
(14, 6, 1, 1, 'ph_19', 'abdul goni Rabbee has submitted an image.', 1),
(15, 6, 1, 1, 'ph_19', 'abdul goni Rabbee has submitted an image.', 0),
(16, 6, 1, 1, 'ar_10', 'abdul goni Rabbee has submitted an articles.', 0),
(17, 6, 1, 1, 'ar_10', 'abdul goni Rabbee has submitted an articles.', 0),
(18, 6, 1, 1, 'ph_23', 'abdul goni Rabbee has submitted an image.', 0),
(19, 6, 1, 1, 'ph_24', 'abdul goni Rabbee has submitted an image.', 0),
(20, 6, 1, 1, 'ph_25', 'abdul goni Rabbee has submitted an image.', 0),
(26, 6, 1, 1, 'ar_12', 'abdul goni Rabbee has submitted an articles.', 0),
(27, 6, 1, 1, 'ph_26', 'abdul goni Rabbee has submitted an image.', 0),
(28, 6, 1, 1, 'ph_27', 'abdul goni Rabbee has submitted an image.', 0),
(31, 6, 1, 1, 'ph_27', 'abdul goni Rabbee has submitted an image.', 0),
(32, 6, 1, 1, 'ar_13', 'abdul goni Rabbee has submitted an articles.', 0),
(33, 6, 1, 1, 'ar_2', 'abdul goni Rabbee has updated an articles.', 0),
(34, 6, 1, 1, 'ar_2', 'abdul goni Rabbee has updated an articles.', 0),
(35, 6, 1, 1, 'ar_2', 'abdul goni Rabbee has updated an articles.', 0),
(36, 6, 1, 1, 'ar_2', 'abdul goni Rabbee has updated an articles.', 0),
(37, 6, 1, 1, 'ar_2', 'abdul goni Rabbee has updated an articles.', 0),
(38, 6, 1, 1, 'ar_2', 'abdul goni Rabbee has updated an articles.', 0),
(39, 6, 1, 1, 'ar_11', 'abdul goni Rabbee has updated an articles.', 0),
(40, 6, 1, 1, 'ar_14', 'abdul goni Rabbee has submitted an articles.', 0),
(41, 6, 1, 1, 'ar_15', 'abdul goni Rabbee has submitted an articles.', 0),
(42, 6, 1, 1, 'ar_16', 'abdul goni Rabbee has submitted an articles.', 0),
(43, 8, 1, 1, 'ar_14', 'abdul goni Rabbee has submitted an articles.', 0);

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
(1, 1, '49898699_274731363200235_1528815255646371840_o.jpg', 1, 1, '2019-02-11'),
(2, 2, '49812743_274731013200270_6069677091564027904_n.jpg', 1, 1, '2019-02-12'),
(3, 2, '51286678_669352956796361_1581566507832311808_n.jpg', 1, 1, '2019-02-19'),
(5, 1, '3d-animated-frog-image.jpg', 1, 1, '2019-02-19'),
(10, 1, 'Screenshot_1.png', 0, 1, '2019-03-01'),
(19, 1, 'perception1.jpg', 0, 1, '2019-04-09'),
(24, 1, 'visibility.png', 0, 1, '2019-04-09'),
(25, 1, 'images.png', 0, 1, '2019-04-09'),
(27, 1, 'boishak.jpg', 0, 3, '2019-04-13');

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
(1, 1, 2, 1),
(2, 2, 3, 2);

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
(2, 'Abdul Goni', 'Rabbee', '1000559@daffodil.ac', '61CDADE4ED883B6051CA5E7C22B21392', '+8801799872659', 1, 1),
(3, 'John', 'Doe', 'john.doe@gmail.com', '527BD5B5D689E2C32AE974C6229FF785', '+01124578963', 1, 1),
(5, 'Md Shahid', 'Hossan', '1000111@daffodil.ac', 'F3224D90C778D5E456B49C75F85DD668', '+8801716148452', 2, 1),
(6, 'kamrul', 'Islam', '1000438@daffodil.ac', '3481FB769274ABCCD300E1516F252712', '+8801836858311', 3, 1),
(7, 'Md Masum', 'Billah', 'masumthamid@gmail.com', 'D76F375ED95C85499D966C5B90BE90A9', '+8801402290505', 1, 1),
(8, 'Md Ashadozzaman', 'Shovoua', 'shovoua@gmail.com', 'D8D811374D4FE78F2B5B641B5DB5F28F', '+8801762662171', 3, 1),
(12, 'gFirstname', 'gLastName', 'guest@email.com', '084E0343A0486FF05530DF6C705C8BB4', '123456789', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `student_id` (`student_id`);

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
  ADD PRIMARY KEY (`fac_coor_id`),
  ADD KEY `fac_id` (`fac_id`),
  ADD KEY `coordinator_user_id` (`coordinator_user_id`);

--
-- Indexes for table `mail_notification`
--
ALTER TABLE `mail_notification`
  ADD PRIMARY KEY (`mail_id`),
  ADD KEY `coordinator_user_id` (`coordinator_user_id`),
  ADD KEY `fac_id` (`fac_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `photographs`
--
ALTER TABLE `photographs`
  ADD PRIMARY KEY (`photograph_id`),
  ADD KEY `photo_student` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `st_user` (`userId`),
  ADD KEY `faculty_id` (`faculty_id`);

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
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fac_coordinator`
--
ALTER TABLE `fac_coordinator`
  MODIFY `fac_coor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mail_notification`
--
ALTER TABLE `mail_notification`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `photographs`
--
ALTER TABLE `photographs`
  MODIFY `photograph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fac_coordinator`
--
ALTER TABLE `fac_coordinator`
  ADD CONSTRAINT `fac_coordinator_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `faculties` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fac_coordinator_ibfk_2` FOREIGN KEY (`coordinator_user_id`) REFERENCES `users` (`userId`);

--
-- Constraints for table `mail_notification`
--
ALTER TABLE `mail_notification`
  ADD CONSTRAINT `mail_notification_ibfk_1` FOREIGN KEY (`coordinator_user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_notification_ibfk_2` FOREIGN KEY (`fac_id`) REFERENCES `faculties` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_notification_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photographs`
--
ALTER TABLE `photographs`
  ADD CONSTRAINT `photo_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `st_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
