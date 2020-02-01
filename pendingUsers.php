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
                                            <li>Users <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Pending Users</span>
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
	
	
	
if(isset($_SESSION['userRole'])&& $_SESSION['userRole'] == 0 || $_SESSION['userRole'] == 2){
	
	$sql_for_users = "SELECT * FROM `users` WHERE `acc_status` = '0' AND `userRole` != '0'";
	$users = $connect->query($sql_for_users); ?>	

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="container">
							<?php if(isset($_GET['delete'])){?>
								<div class="alert alert-danger" role="alert">
								  User Deleted successful!!
								</div>
							<?php }
							?>
							
                                <div class="main-sparkline13-hd">
                                    <h1>Pending Users</h1>
                                </div>
								<table class="table">
									 <thead>
										<tr>
										  <th>First Name</th>
										  <th>Last Name</th>
										  <th>Email</th>
										  <th>Contact</th>
										  <th>User Role</th>
										  <th>Action</th>
										</tr>
									  </thead>
									<tbody>
			<?php foreach($users as $value){?>						  
										<tr>
											<form action="users.php" method="post" >
												<td hidden><input type="hidden" value="<?php echo $value['userId']; ?>" name="u_id"/></td>
												<td width="15%"><?php echo $value['firstName']; ?></td>
												<td width="15%"><?php echo $value['lastName']; ?></td>
												<td width="15%"><?php echo $value['email']; ?></td>
												<td width="18%"><?php echo $value['contact']; ?></td>
												<td width="20%"><?php if($value['userRole'] == 0){
																						echo 'Admin';
																					}else if($value['userRole'] == 1) {
																						echo 'Student';
																					}else if($value['userRole'] == 2) {
																						echo 'Marketing Manager';
																					}else if($value['userRole'] == 3) {
																						echo 'Marketing Coordinator';
																					}?>
												</td>
												<td width="17%" id="selection"><input type="submit" value="Activate" class="btn btn-primary btn-sm" name="activate_user_data"/> <input type="submit" value="Delete" class="btn btn-danger btn-sm"  name="delete_user_data"/></td>
											</form>
										</tr>
										
				<?php }// end of foreach?>
								  </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
		
<?php }// end of if clause ?>
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>