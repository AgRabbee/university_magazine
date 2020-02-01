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
                                            <li><a href="home.php">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li>Update User Details
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
		

<?php
if(isset($_SESSION['userRole'])){
	if(isset($_GET['id'])){
	$u_id = $_GET['id'];
	$sql_for_user = "SELECT * FROM `users` WHERE `userId` ='$u_id'";
	$user = $connect->query($sql_for_user); 
	foreach($user as $u_details){
?>		

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="container">
                                <div class="main-sparkline13-hd">
                                    <h1>Update User Details</h1>
                                </div>
								<div class="row col-md-8">
									<form action="users.php" method="post" >
									<table class="table">
										<tr hidden> 
											<td></td>
											<td><input type="hidden" value="<?php echo $u_details['userId'];?>" class="form-control"name="u_id"/></td>
										</tr>
										<tr> 
											<td>First Name</td>
											<td><input type="text" value="<?php echo $u_details['firstName'];?>" class="form-control"name="firstName"/></td>
										</tr>
										<tr> 
											<td>Last Name</td>
											<td><input type="text" value="<?php echo $u_details['lastName'];?>" class="form-control" name="lastName"/></td>
										</tr>
										<tr> 
											<td>Email</td>
											<td><input type="text" value="<?php echo $u_details['email'];?>" class="form-control" disabled/></td>
										</tr>
										<tr> 
											<td>Contact</td>
											<td><input type="text" value="<?php echo $u_details['contact'];?>" class="form-control" name="contact"/></td>
										</tr>
										<tr> 
											<td>User Role</td>
											<td><input type="text" value="<?php 
													if($u_details['userRole']==0){
															echo "Admin";
														}elseif($u_details['userRole']==1){
															echo "Student";
														}elseif($u_details['userRole']==2){
															echo "Marketing Manager";
														}elseif($u_details['userRole']==3){
															echo "Marketing Coordinator";
														}elseif($u_details['userRole']==4){
															echo "Guest";
														}?>" 
														class="form-control" disabled/>
											</td>
										</tr>
										<tr> 
											<td></td>
											<td id="selection"><input type="submit" value="Update Details" class="btn btn-primary btn-sm" name="update_active_user_data"/></td>
										</tr>
									</table>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
		
	<?php 	}//end of foreach
}// end of get id if clause 
}// end of user if clause ?>
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>