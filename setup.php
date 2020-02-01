<?php include_once('connect_db.php');?>
<?php $connect = database_connection(true);

$sql ="CREATE DATABASE ewsd-group-03";
if($connect->query($sql)){
	echo'Database Created Successfully <br />';
}

//connect to database

$connect = database_connection();
if($connect->connect_error){
	die("Connection failed: ". $connect->connect_error);
}


// Table structure for table `users`

$sql = "CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `userRole` int(1) NOT NULL COMMENT '0->admin, 1->student, 2->manager, 3->coordinator, 4->guest',
  `acc_status` int(1) NOT NULL COMMENT '0->pending, 1-> active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'Users table Created Successfully <br />';
}

//insert into users table for admin*/
$sql = "INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `contact`, `userRole`, `acc_status`) VALUES
(1, 'System', 'Admin', 'system@admin.com', '21232F297A57A5A743894A0E4A801FC3', '12345678901', 0, 1)";

if($connect->query($sql)){
	echo 'Admin id created successfully <br />';
	echo 'Username: Admin , email: system@admin.com, password: admin <br />';
}




/* Table structure for table `student`*/


$sql = "CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `roll` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'student table Created Successfully <br />';
}


/*Table structure for table `articles`*/


$sql = "CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `student_id` int(11) NOT NULL,
  `articles` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '0->pending; 1->selected',
  `eventId` int(11) NOT NULL,
  `submission_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'articles table Created Successfully <br />';
}


//Table structure for table `photographs`*/

$sql = "CREATE TABLE `photographs` (
  `photograph_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `student_id` int(11) NOT NULL,
  `photograph` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0->pending; 1->selected',
  `eventId` int(11) NOT NULL,
  `submission_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'photographs table Created Successfully <br />';
}



//Table structure for table `comments*/


$sql = "CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `cmnt_submit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'comments table Created Successfully <br />';
}



//Table structure for table `events*/


$sql = "CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `event_name` varchar(150) NOT NULL,
  `closure_date` date NOT NULL,
  `event_session` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'events table Created Successfully <br />';
}


//Table structure for table `faculties*/


$sql = "CREATE TABLE `faculties` (
  `fac_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fac_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'faculties table Created Successfully <br />';
}


//Table structure for table `fac_coordinator*/


$sql = "CREATE TABLE `fac_coordinator` (
  `fac_coor_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fac_id` int(11) NOT NULL,
  `coordinator_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'faculty coordinator table Created Successfully <br />';
}


//Table structure for table `mail_notification*/


$sql = "CREATE TABLE `mail_notification` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `coordinator_user_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `contribution_id` varchar(14) NOT NULL,
  `mail_body` text NOT NULL,
  `mail_stts` int(1) NOT NULL COMMENT '0->new; 1->read'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($connect->query($sql)){
	echo'mail notification table Created Successfully <br />';
}












?>

<p>Try to <a href="index.php">Log In</a></p>