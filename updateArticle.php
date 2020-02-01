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
	if(isset($_POST['update_articles'])){
	$update_id = $_POST['art_update_id'];
	$selected_val = $_POST['eventName'];
	
	$target_dir = "articles/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$fileName = $_FILES["fileToUpload"]["name"];
	$uploadOk = 1;
	$docFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if file is a actual doc, docx or pdf 
		if( $fileName != "") {
			$check = filesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "<span>File is an document - " . $check["mime"] . ". </span><br />";
				$uploadOk = 1;
			} else {
				echo "<span style='color:tomato'>File is not an document.</span><br />";
				$uploadOk = 0;
			}

		// Check if file already exists
			if (file_exists($target_file)) {
				$uploadOk = 0;
				echo "<span style='color:tomato'>Sorry, same document name matched.</span><br />";
			}
		// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "<span style='color:tomato'>Sorry, your file is too large.</span><br />";
				$uploadOk = 0;
			}
		// Allow certain file formats
			if($docFileType != "doc" && $docFileType != "docx" && $docFileType != "pdf") {
				echo "<span style='color:tomato'>Sorry, only DOC, DOCX & PDF files are allowed.</span><br />";
				$uploadOk = 0;
			}
			
			if(isset($_POST['check'])){
				$uploadOk = 1;
			}else{
				echo "<span style='color:tomato'>The terms and conditions need to be agreed before uploading.</span><br />";
				$uploadOk = 0;
			}
			
			if($selected_val > 0){
				$uploadOk = 1;
			}else{
				echo "<span style='color:tomato'>Please Select an event.</span><br />";
				$uploadOk = 0;
			}
			
		// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 1) {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$sql = "UPDATE `articles` SET `articles`='$fileName' WHERE `article_id` = '$update_id'";
					$connect->query($sql);
					
					echo "<span style='color:green'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been updated.</span><br />";
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
					
					$sql_mail = "INSERT INTO `mail_notification`(`coordinator_user_id`, `fac_id`, `student_id`,`contribution_id`, `mail_body`, `mail_stts`) VALUES ('$co_id','$fac_id','$s_id','$cont_id','$stu_name has updated an articles.','0')";
					$connect->query($sql_mail);
					//======================================
				} else {
					echo "<span style='color:tomato'>Sorry, there was an error updating your file.</span><br />";
				}
			}
		}else{
			echo "<script type='text/javascript'>alert('Please select an document to update');</script>";
		}
	}	
	
	
	
	if(isset($_GET['art_id'])){
		$id = $_GET['art_id'];
		$sql = "SELECT * from articles, events WHERE articles.eventId = events.event_id AND articles.article_id = '$id'";
		$result = $connect->query($sql);
		foreach($result as $value){
	
?>		
														<form action="" method="post" enctype="multipart/form-data">
														
															<input type="hidden" name="art_update_id" value="<?php echo $value['article_id'];?>" />
															<div class="row col-md-12">
																<p>Select Event
																	<select class="form-control" name="eventName" id="selectEvent"> 
																		<option value="<?php echo $value['event_id'];?>"><?php echo $value['event_name'];?></option>											
																	</select>
																</p>
															</div>	
														
															<p>Select Article to upload:</p>
															<p><input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload"></p>
															
															<p><input type="checkbox" name="check" /> Agree with the <a href="" data-toggle="modal" data-target="#exampleModalLong">terms and conditions</a></p>
															
															<p><input type="submit" class="btn btn-primary" value="Update" name="update_articles"></p>
														</form> 
		<?php }//end of foreach?>
		<?php }//end of if?>
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