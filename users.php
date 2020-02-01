<?php 
include_once('header.php');
include_once('connect_db.php');
include_once('session_checker.php');

$connect = database_connection();
?>

<?php 	// update user details 
	if(isset($_POST['update_user_data'])){
		$id = $_POST['u_id'];
		$fName = $_POST['firstName'];
		$lName = $_POST['lastName'];
		$eml = $_POST['email'];
		$pass = $_POST['password'];
		$cntct = $_POST['contact'];
		
		$sql_for_update = "UPDATE `users` SET `firstName`='$fName',`lastName`='$lName',`email`='$eml',`password`='$pass',`contact`='$cntct' WHERE `userId` = '$id'";
		$connect->query($sql_for_update);
		header('location: activeUsers.php?update');
}
else if(isset($_POST['activate_user_data'])){
	$id = $_POST['u_id'];
	
	$sql_for_update = "UPDATE `users` SET `acc_status`='1' WHERE `userId`='$id'";
	$connect->query($sql_for_update);
	header('location: activeUsers.php?activate');
}
else if(isset($_POST['delete_user_data'])){
	$id = $_POST['u_id'];
	
	$sql_for_update = "DELETE FROM `users` WHERE `userId`='$id'";
	$connect->query($sql_for_update);
	header('location: pendingUsers.php?delete');
}
else if(isset($_POST['new_user_data'])){
	$fName = $_POST['firstName'];
	$lName = $_POST['lastName'];
	$eml = $_POST['email'];
	$pass = $_POST['password'];
	$pass = md5($pass);
	$cntct = $_POST['contact'];
	$uRole = $_POST['userRole'];
	$stts = $_POST['status'];
	$roll = $_POST['roll'];
	$stu_faculty = $_POST['stu_faculty'];
		
	$sql_for_new_entry = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`, `contact`, `userRole`, `acc_status`) VALUES ('$fName','$lName','$eml','$pass','$cntct','$uRole','$stts')";
	$connect->query($sql_for_new_entry);
	
	$sql_for_new_user_id = "SELECT * FROM `users` WHERE `email` = '$eml'";
	$u_id = $connect->query($sql_for_new_user_id)->fetch_object()->userId;
	
	
	$sql_for_add_into_faculty = "INSERT INTO `student`( `roll`, `userId`, `faculty_id`) VALUES ('$roll','$u_id','$stu_faculty')";
	$connect->query($sql_for_add_into_faculty);
	
	if($stts == 0){
		header('location: pendingUsers.php');
	}else{
	header('location: activeUsers.php?msg');
	}
	
}
else if(isset($_POST['new_fac_data'])){
	$facName = $_POST['facName'];
	$coordinator_user_id = $_POST['coordinator_user_id'];
	
	if(!empty($facName) || !empty($coordinator_user_id)){
		echo $facNamelow = strtolower($facName);
		$sql = "SELECT Lower(`fac_name`) FROM `faculties` where `fac_name` = '$facNamelow'";
		$result = $connect->query($sql);
		
		if($result->num_rows < 1){
			$sql_for_new_entry = "INSERT INTO `faculties`(`fac_name`) VALUES ('$facName')";
			$connect->query($sql_for_new_entry);
			$get_new_fac_id = "SELECT * FROM `faculties` WHERE `fac_name` ='$facName'";
			$result = $connect->query($get_new_fac_id);
			foreach($result as $value){
				$id = $value['fac_id'];
			}
			$sql_for_new_entry = "INSERT INTO `fac_coordinator`(`fac_id`, `coordinator_user_id`) VALUES ('$id','$coordinator_user_id')";
			$connect->query($sql_for_new_entry);
			header('location: allFaculties.php?create');
		}else{
			header('location: addNewFaculty.php?errorfacName');
		}
	}		
}
else if(isset($_POST['update_faculty'])){
	$fac_coor_id = $_POST['fac_coor_id'];
	
	$coordinator_user_id = $_POST['coordinator_user_id'];
	if(!empty($coordinator_user_id)){
		$sql_for_update = "UPDATE `fac_coordinator` SET `coordinator_user_id`='$coordinator_user_id' WHERE `fac_coor_id` = '$fac_coor_id'";
		$connect->query($sql_for_update);
		header('location: allFaculties.php?update');
	}
}
else if(isset($_POST['update_active_user_data'])){
		$id = $_POST['u_id'];
		$fName = $_POST['firstName'];
		$lName = $_POST['lastName'];
		$cntct = $_POST['contact'];
		
		$sql_for_update = "UPDATE `users` SET `firstName`='$fName',`lastName`='$lName',`contact`='$cntct' WHERE `userId` = '$id'";
		$connect->query($sql_for_update);
		header('location: profile.php?update');
}

else{//end of session checker for logged in person
	header('location: index.php');
}?>