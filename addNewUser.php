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
                                            <li><span class="bread-blod">Create Users</span>
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
if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 0){
?>		

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="container">				
                                <div class="main-sparkline13-hd">
                                    <h1>Create New User</h1>
                                </div>
								<div class="row col-md-8">
									<form action="users.php" method="post" >
									<table class="table">
										<tr> 
											<td>First Name</td>
											<td><input type="text" value="" class="form-control" required name="firstName"/></td>
										</tr>
										<tr> 
											<td>Last Name</td>
											<td><input type="text" value="" class="form-control" required name="lastName"/></td>
										</tr>
										<tr> 
											<td>Email</td>
											<td><input type="text" value="" class="form-control" required name="email" placeholder="example@gmail.com"/></td>
										</tr>
										<tr> 
											<td>Password</td>
											<td><input type="password" value="" class="form-control" required name="password"/></td>
										</tr>
										<tr> 
											<td>Contact</td>
											<td><input type="text" value="" class="form-control" required name="contact"/></td>
										</tr>
										<tr> 
											<td>User Role</td>
											<td>
												<select name="userRole" id ='role' class="form-control" >
												  <option>--Select one--</option>
												  <option value="1">Student</option>
												  <option value="2">Marketing Manager</option>
												  <option value="3">Marketing Coordinator</option>
												  <option value="4">Guest</option>
												</select>
											</td>
										</tr>
									
										<tr class = "fac"> 
											<td>Faculty</td>
											<td>
												<select name="stu_faculty"class="form-control" >
												  <option>--Select one--</option>
							<?php  
								$sql = 'SELECT * FROM `faculties`';
								$result = $connect->query($sql);
								foreach($result as $fac){
							?>
												  <option value="<?=$fac['fac_id']?>"><?=$fac['fac_name']?></option>
								<?php }?>
												</select>
											</td>
										</tr>
										<tr class = "fac"> 
											<td>Roll</td>
											<td><input type="text" value="" class="form-control"  name="roll"/></td>
										</tr>
										<tr> 
											<td>Status</td>
											<td>
												<select name="status" class="form-control" >
												  <option>--Select one--</option>
												  <option value="0">Pending</option>
												  <option value="1">Active</option>
												</select>
											</td>
										</tr>
										<tr> 
											<td></td>
											<td id="selection" ><input type="submit" value="Create User" class="btn btn-primary btn-sm" name="new_user_data"/></td>
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
				
		
<?php }// end of if clause ?>
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>