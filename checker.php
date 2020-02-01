<?php 
include_once('connect_db.php');
include_once('session_checker.php');

$connect = database_connection();
//=============================Login checking area====================================

if(isset($_POST['submit'])){
	$email = mysqli_real_escape_string($connect,$_POST['email']);
	$pass = mysqli_real_escape_string($connect,$_POST['password']);
	$pass = md5($pass);
	
	$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
	$get_user_email = $connect->query($sql);
	if($get_user_email->num_rows>0){
		$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'";
		$get_user_details = $connect->query($sql);
		
		if($get_user_details->num_rows>0){
			foreach($get_user_details as $value){
				if($value['acc_status'] == 1){
					$_SESSION['userID'] = $value['userId'];
					$id = $value['userId'];
					
					$_SESSION['userName'] = $value['firstName']." ". $value['lastName'];
					$_SESSION['userRole'] = $value['userRole'];
					$_SESSION['userEmail'] = $value['email'];
					$_SESSION['isLoggedIn'] = true;
				}else{
					$_SESSION['isLoggedIn'] = false;
					header('location:login.php?msg=Your account isn\'t activated yet!! Contact with the admin.');
				}
					
			}
		//=========== check for the student role================
				if($_SESSION['userRole'] == 1){
					$sql = "SELECT * FROM `student` WHERE `userId` = '$id'";
					$sql_result=$connect->query($sql);
					foreach($sql_result as $value){
						$_SESSION['stu_Id'] = $value['id'];
						$_SESSION['stu_fac_Id'] = $value['faculty_id'];
					}
				}
				
				header('location: home.php');
		}else{
			$_SESSION['isLoggedIn'] = false;
			header('location: login.php?msg=Password doesn\'t match with the email !!!');
		}
	}else{
		$_SESSION['isLoggedIn'] = false;
		header('location: login.php?msg=Email doesn\'t match !!!');
	}
	
}





if($_POST['check'] == 'loginEmail'){
	$email =  $_POST['email'];
	
	$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
	$get_user = $connect->query($sql);
	if($get_user->num_rows>0){
		echo 'User';
	}else{
		echo 'Invalid';
	}
	
}
if($_POST['check'] == 'loginPass'){
	$email =  $_POST['email'];
	$pass =  $_POST['pass'];
	$pass = md5($pass);
	
	$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'";
	$get_user = $connect->query($sql);
	if($get_user->num_rows>0){
		echo 'User';
	}else{
		echo 'Invalid';
	}
	
}



//=====================================for event closure date on student page====================================
if($_POST['check'] == 'event_id_check'){
	$event_id = $_POST['event_id'];
	
	$sql = "SELECT * FROM `events` WHERE `event_id` = '$event_id'";
	$get_details = $connect->query($sql);
	foreach($get_details as $value){
		echo $value['closure_date'];
	}
}




//=====================================for changing notification status====================================
if($_POST['check'] == 'chngNoti'){
	$id = $_POST['id'];
	
	$sql = "UPDATE `mail_notification` SET `mail_stts`='1' WHERE `mail_id` = '$id'";
	$connect->query($sql);
}




//=====================================for updating articles by students ====================================

	if(isset($_POST['update_article'])){
		header('location: updateArticle.php?art_id='.$_POST['article_id']);
	}

//=====================================for deleting articles by students ====================================

	if(isset($_POST['delete_article'])){
		$id = $_POST['article_id'];
		$article_name = $_POST['article_name'];
		$path = 'articles/'.$article_name;
		
		$sql = "DELETE FROM `articles` WHERE `article_id` ='$id'";
		$connect->query($sql);
		
		unlink($path);
		
		$mail_id = 'ar_'.$id;
		$sql = "DELETE FROM `mail_notification` WHERE `contribution_id` = '$mail_id'";
		$connect->query($sql);
		header("location:allArticles.php?msg");
	}
//=====================================for deleting photograph by students ====================================

	if(isset($_POST['delete_photograph'])){
		$id = $_POST['photograph_id'];
		$photograph_name = $_POST['photograph'];
		$path = 'photographs/'.$photograph_name;
		
		$sql = "DELETE FROM `photographs` WHERE `photograph_id` ='$id'";
		$connect->query($sql);
		
		unlink($path);
		$mail_id = 'ph_'.$id;
		$sql = "DELETE FROM `mail_notification` WHERE `contribution_id` = '$mail_id'";
		$connect->query($sql);
		
		header("location:allPhotographs.php?msg");
	}















?>