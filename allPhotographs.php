<?php include_once('template/header.php');?>
<?php include_once('session_checker.php');?>
<?php include_once('connect_db.php');?>
<?php $connect = database_connection();?>


<?php if(isset($_SESSION['userName'])){ ?>


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
                                            <li>Contributions <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">All Photographs</span>
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
		<div class="contacts-area mg-b-15">
            <div class="container-fluid">
        
<?php	
if(isset($_POST['slct_photo'])){
		$id = $_POST['pht_id'];
		$sql_for_update = "UPDATE `photographs` SET `status`='1' WHERE `photograph_id` = '$id'";
		$connect->query($sql_for_update);
	}
if(isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 0 || $_SESSION['userRole'] == 2 || $_SESSION['userRole'] == 3 )){


	if($_SESSION['userRole'] == 3){
		$user_id = $_SESSION['userID'];
		$sql_for_photos = "SELECT * from photographs, student,faculties, fac_coordinator,users WHERE photographs.student_id = student.id AND student.faculty_id = faculties.fac_id AND faculties.fac_id = fac_coordinator.fac_id AND student.userId = users.userId AND fac_coordinator.coordinator_user_id = '$user_id' GROUP BY student_id";
		
		
	}else{
		$sql_for_photos = "SELECT * FROM photographs, student, users, faculties WHERE photographs.student_id = student.id AND users.userId = student.userId AND student.faculty_id = faculties.fac_id";
		
	}

$photo_result = $connect->query($sql_for_photos); ?>
			  <div class="row col-md-12">
					<div class="row"> 
						<div class="col-md-10">
							<h1>All Photographs</h1>
						</div>
						<?php if($_SESSION['userRole'] != 3){?>	
						<div class="col-md-2">
							<form action="download.php" method="post"><input type="submit" class="btn btn-primary btn-sm" name="ph_download" value="Download All" /></form>
						</div>
						<?php }?>
					</div>
			  
			  
			  
			<?php foreach($photo_result as $value){?>
										
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="hovereffect">
							<a href="photographs/<?php echo $value['photograph'];?>" target="blank"><img src="photographs/<?php echo $value['photograph'];?>" alt="" /></a>
							<div class="overlay">
								<p><strong>Submitted by: </strong><?php echo $value['firstName']. " ". $value['lastName'];?></p>
								<p><strong>Faculty: </strong><?php echo $value['fac_name'];?></p>
								<p>Submitted on: <?php echo $value['submission_date'];?></p>
								<span><form action="" method="post" id="selection">
								<?php if($value['status'] == '0'){ echo "<span>Pending...</span>";?>

								<input type="hidden" value="<?php echo $value['photograph_id'];?>" name="pht_id" />
								<input type="submit" class="btn btn-primary" value="Select" name="slct_photo"/>

								<?php }if($value['status'] == '1'){ echo "<p>Selected</p>";}?>
								</form></span>
							</div>
						</div>
					</div>
					
			<?php }// end of foreach ?>
				</div>
			</div>
        </div>
<?php }else if($_SESSION['userRole'] == 1){
		$s_id =$_SESSION['stu_Id'];
	?>			
		<div class="contacts-area mg-b-15">
            <div class="container-fluid">
        

				<div class="row col-md-12">
					<?php if(isset($_GET['msg'])){?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<?php echo 'Photographs deleted successfully!!!';?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
						<?php }?>	
						<div class="col-md-10">
							<h1>All Photographs</h1>
						</div>
		<?php 
		$sql_for_photos = "SELECT * FROM photographs, events WHERE photographs.eventId = events.event_id AND photographs.student_id = '$s_id'";
		$photo_result = $connect->query($sql_for_photos);
			foreach($photo_result as $value){?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						
						<div class="hovereffect">
							<!--img class="img-responsive" src="http://placehold.it/350x250" alt=""-->
							<a href="photographs/<?php echo $value['photograph'];?>" target="blank"><img src="photographs/<?php echo $value['photograph'];?>" alt="" class="img-responsive" id="photo_thumb"/></a>
							<div class="overlay">
								<p>Status: <?php if($value['status'] == '0'){ echo "Pending...";}else{ echo "Selected";}?></p>
								<p>Event name: <?php echo $value['event_name'];?></p>
								<p>Submitted on: <?php echo $value['submission_date'];?></p>
							</div>
						</div>
						<form action="checker.php" method="post">
								<input type="hidden" name="photograph_id" value="<?php echo $value['photograph_id'];?>" /> 
								<input type="hidden" name="photograph" value="<?php echo $value['photograph'];?>" /> 
								<input type="submit" name="delete_photograph" value="Delete" class="btn btn-danger btn-sm" />
							</form>
					</div>
	<?php }// end of foreach ?>
				</div>
			</div>
        </div>
		
<?php } ?>
		
		
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>