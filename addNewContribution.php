<?php include_once('template/header.php');?>
<?php include_once('session_checker.php');?>
<?php include_once('connect_db.php');?>
<?php $connect = database_connection();?>


<?php	if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 1){
	$s_id =$_SESSION['stu_Id'];
?>


    <!-- Start Left menu area -->
<?php include_once('template/sidebar.php');?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
                    <?php include_once('template/topMenu.php');?>

            <!-- Mobile Menu start -->
           <?php include_once('template/mobileMenu.php');?>
            <!-- Mobile Menu end -->

            <!-- Breadcome area start -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                                <input type="text" placeholder="Search..." class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">New Contribution</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!-- Breadcome area end -->
        </div>
		<div class="single-pro-review-area mt-t-30 mg-b-15">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="product-tab-list tab-pane fade active in" id="description">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="review-content-section">
										<div id="dropzone1" class="pro-ad addcoursepro">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<?php
    if(isset($_POST["submit_image"])){
		$selected_val = $_POST['eventName'];
		if(empty($selected_val)){
			echo "<span style='color:tomato'>Please, Select an event!!!</span><br />";
		}else{
				if($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_NO_FILE){
					echo "<span style='color:tomato'>Please, Select file to upload!!!</span><br />";
				}
				else{
					if(isset($_POST['check'])){
						$errors = array();

						$extension = array("jpeg","jpg","png");
						$ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
						$fileName = $_FILES["fileToUpload"]["name"];
						if(!in_array($ext, $extension)){
							array_push($errors, "File type is invalid, Please select jpeg, jpg, png only.");
						}

						$totalBytes = 2000000;

						if($_FILES["fileToUpload"]["size"] > $totalBytes){
							array_push($errors, "File size must be less than 2mb!!!");
						}

						if(file_exists("photographs/".$_FILES["fileToUpload"]["name"]))
						{
							array_push($errors, "File is already exist!!!");
						}

						$count = count($errors);

						if($count == 0){
							move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"photographs/".$_FILES["fileToUpload"]["name"]);
							echo "<span style='color:green'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</span><br />";
							$sql = "INSERT INTO `photographs`(`student_id`, `photograph`, `eventId`, `submission_date`) VALUES ('$s_id','$fileName','$selected_val', CURDATE())";
							$connect->query($sql);


							//================================================
							$sql_for_contribution_id = "SELECT `photograph_id` FROM `photographs` WHERE `student_id` = '$s_id' AND `photograph` = '$fileName'";
							$result = $connect->query($sql_for_contribution_id);
							$row = mysqli_fetch_assoc($result);
							$cont_id = 'ph_'.$row['photograph_id'];

							$fac_id = $_SESSION['stu_fac_Id'];
							$stu_name = $_SESSION['userName'];

							$sql_co_id = "SELECT * FROM `fac_coordinator` WHERE `fac_id` = '$fac_id'";
							$result = $connect->query($sql_co_id);
							foreach($result as $value){$co_id = $value['coordinator_user_id'];}

							$sql_mail = "INSERT INTO `mail_notification`(`coordinator_user_id`, `fac_id`, `student_id`,`contribution_id`, `mail_body`, `mail_stts`) VALUES ('$co_id','$fac_id','$s_id','$cont_id','$stu_name has submitted an image.','0')";
							$connect->query($sql_mail);
							//======================================

							//get coordinator_user_email
							$sql = "SELECT * FROM `users` WHERE `userId` ='$co_id'";
							$result = $connect->query($sql);
							foreach($result as $value){
								$co_email = $value['email'];
								$co_name = $value['firstName'].' '.$value['lastName'];
								}

							// Edit this path if PHPMailer is in a different location.

							require 'PHPMailer/PHPMailerAutoload.php';
							// require 'PHPMailer/class.phpmailer.php';
							$mail = new PHPMailer;
							$mail->isSMTP();

							/*
							 * Server Configuration
							 */

							$mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
							//$mail->SMTPSecure = 'ssl'; // Which security method to use. TLS is most secure.
							$mail->Port = 25; // Which port to use, 587 is the default port for TLS security.
							$mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
							$mail->Username = "universitymagazine3@gmail.com"; // Your Gmail address.
							$mail->Password = "Universitymagazine_3#"; // Your Gmail login password or App Specific Password.



							/*
							 * Message Configuration
							 */

							$mail->setFrom('University Magazine', 'University Magazine'); // Set the sender of the message.
							$mail->addAddress($co_email, $co_name); // Set the recipient of the message.
							$mail->Subject = $stu_name.' has submitted an image'; // The subject of the message.

							// Choose to send either a simple text email...
							$mail->Body = $stu_name.' has submitted an image.'; // Set a plain text body.

							if ($mail->send()) {
								echo "<span style='color:green'>A notification email was sent to your coordinator successfully!</span><br />";
							}else {
								echo "<span style='color:tomato'>Mailer Error: " . $mail->ErrorInfo."</span><br />";
							}
						}else{
							foreach($errors as $error){
								echo "<span style='color:tomato'>".$error."</span><br />";
							}
						}
					}else{
					echo "<span style='color:tomato'>Please, check the checkbox!!!</span><br />";
					}
				}
			}
		}

?>


														<form action="" method="post" enctype="multipart/form-data" style="border:2px dashed #ddd; padding: 15px;">

															<div class="row col-md-12">
																<p>Select Event
																	<select class="form-control" name="eventName" id="selectEvent">
																	<?php
																		$sql = "SELECT * FROM `events` WHERE `closure_date` >= CURRENT_DATE";
																		$result = $connect->query($sql);
																		if(mysqli_num_rows($result) > 0 ){
																		?>
																		<option value="" class="form-control" >--Select One--</option>
																		<?php
																		foreach($result as $value){?>
																		<option value="<?php echo $value['event_id'];?>"><?php echo $value['event_name'];?></option>
																		<?php }//end of foreach
																		}else{?>
																			<option value="">No available event for today!!!</option>
																		<?php }?>
																	</select>
																</p>
															</div>


															<p>Select image to upload:</p>
															<p><input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"></p>
		<!--============== script for disable new entries after closure date===========================-->
		<?php
			$sql_for_closure_date = "SELECT * FROM `events` WHERE `event_id` = ''";
			$closure_date = $connect->query($sql_for_closure_date);
			foreach($closure_date as $value){ $date = $value['closure_date'];} // need work===========================================
		?>
															<p><input type="checkbox" name="check" /> Agree with the <a href="" data-toggle="modal" data-target="#exampleModalLong">terms and conditions</a></p>
															<p><input type="submit" class="btn btn-primary" value="Upload" name="submit_image"></p>
														</form>

													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<?php
    if(isset($_POST["submit_articles"])){
		$selected_val = $_POST['eventName'];
		if(empty($selected_val)){
			echo "<span style='color:tomato'>Please, Select an event!!!</span><br />";
		}else{
				if($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_NO_FILE){
					echo "<span style='color:tomato'>Please, Select file to upload!!!</span><br />";
				}
				else{
					if(isset($_POST['check'])){
						$errors = array();

						$extension = array("docx","doc","pdf");
						$ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
						$fileName = $_FILES["fileToUpload"]["name"];
						if(!in_array($ext, $extension)){
							array_push($errors, "File type is invalid, Please select doc, docx, pdf only.");
						}

						$totalBytes = 2000000;

						if($_FILES["fileToUpload"]["size"] > $totalBytes){
							array_push($errors, "File size must be less than 2mb!!!");
						}

						if(file_exists("articles/".$_FILES["fileToUpload"]["name"]))
						{
							array_push($errors, "File is already exist!!!");
						}

						$count = count($errors);

						if($count == 0){
							move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"articles/".$_FILES["fileToUpload"]["name"]);
							echo "<span style='color:green'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</span><br />";
							$sql = "INSERT INTO `articles`( `student_id`, `articles`, `eventId`, `submission_date`) VALUES ('$s_id','$fileName','$selected_val', CURDATE())";
							$connect->query($sql);

							//================================================
							$sql_for_contribution_id = "SELECT `article_id` FROM `articles` WHERE `student_id` = '$s_id' AND `articles` = '$fileName'";
							$result = $connect->query($sql_for_contribution_id);
							$row = mysqli_fetch_assoc($result);
							$cont_id = 'ar_'.$row['article_id'];

							$fac_id = $_SESSION['stu_fac_Id'];
							$stu_name = $_SESSION['userName'];

							$sql_co_id = "SELECT * FROM `fac_coordinator` WHERE `fac_id` = '$fac_id'";
							$result = $connect->query($sql_co_id);
							foreach($result as $value){$co_id = $value['coordinator_user_id'];}

							$sql_mail = "INSERT INTO `mail_notification`(`coordinator_user_id`, `fac_id`, `student_id`,`contribution_id`, `mail_body`, `mail_stts`) VALUES ('$co_id','$fac_id','$s_id','$cont_id','$stu_name has submitted an articles.','0')";
							$connect->query($sql_mail);
							//======================================

							//get coordinator_user_email
							$sql = "SELECT * FROM `users` WHERE `userId` ='$co_id'";
							$result = $connect->query($sql);
							foreach($result as $value){
								$co_email = $value['email'];
								$co_name = $value['firstName'].' '.$value['lastName'];
								}

							// Edit this path if PHPMailer is in a different location.
							require 'PHPMailer/PHPMailerAutoload.php';

							$mail = new PHPMailer;
							$mail->isSMTP();

							/*
							 * Server Configuration
							 */
							$mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
							//$mail->SMTPSecure = 'ssl'; // Which security method to use. TLS is most secure.
							$mail->Port = 25; // Which port to use, 587 is the default port for TLS security.
							$mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
							$mail->Username = "universitymagazine3@gmail.com"; // Your Gmail address.
							$mail->Password = "Universitymagazine_3#"; // Your Gmail login password or App Specific Password.

							/*
							 * Message Configuration
							 */

							$mail->setFrom('University Magazine', 'University Magazine'); // Set the sender of the message.
							$mail->addAddress($co_email, $co_name); // Set the recipient of the message.
							$mail->Subject = $stu_name.' has submitted an articles'; // The subject of the message.

							// Choose to send either a simple text email...
							$mail->Body = $stu_name.' has submitted an articles.'; // Set a plain text body.

							if ($mail->send()) {
								echo "<span style='color:green'>A notification email was sent to your coordinator successfully!</span><br />";
							} else {
								echo "<span style='color:tomato'>Mailer Error: " . $mail->ErrorInfo."</span><br />";
							}
						}else{
							foreach($errors as $error){
								echo "<span style='color:tomato'>".$error."</span><br />";
							}
						}
					}else{
					echo "<span style='color:tomato'>Please, check the checkbox!!!</span><br />";
					}
				}
			}
		}

?>

														<form action="" method="post" enctype="multipart/form-data" style="border:2px dashed #ddd; padding: 15px;">


															<div class="row col-md-12">
																<p>Select Event
																	<select class="form-control" name="eventName" id="selectEvent">
																	<?php
																		$sql = "SELECT * FROM `events` WHERE `closure_date` >= CURRENT_DATE";
																		$result = $connect->query($sql);
																		if(mysqli_num_rows($result) > 0 ){
																		?>
																		<option value="">--Select One--</option>
																		<?php
																		foreach($result as $value){?>
																		<option value="<?php echo $value['event_id'];?>"><?php echo $value['event_name'];?></option>
																		<?php }//end of foreach
																		}else{?>
																			<option value="">No available event for today!!!</option>
																		<?php }?>
																	</select>
																</p>
															</div>

															<p>Select Article to upload:</p>
															<p><input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"></p>

															<p><input type="checkbox" name="check" /> Agree with the <a href="" data-toggle="modal" data-target="#exampleModalLong">terms and conditions</a></p>

															<p><input type="submit" class="btn btn-primary" value="Upload" name="submit_articles"></p>
														</form>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>












    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>
