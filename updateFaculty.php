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
                                            <li>Faculties <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Change Faculty Coordinator</span>
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

	$sql_for_faculties = "SELECT * FROM fac_coordinator, faculties, users WHERE fac_coordinator.fac_id = faculties.fac_id AND fac_coordinator.coordinator_user_id = users.userId";	
	$fac_result = $connect->query($sql_for_faculties);
?>			

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="container">
                                <div class="main-sparkline13-hd">
                                    <h1>Update Faculty Coordinator</h1>
                                </div>
								<table class="table">
									 <thead>
										<tr>
										  <th>Faculty Name</th>
										  <th>Current Marketing Coordinator</th>
										  <th>Marketing Coordinator</th>
										  <th>Action</th>
										</tr>
									  </thead>
									<tbody>
			<?php foreach($fac_result as $value){
				$fac_id = $value['fac_id'];
				$fac_coor_id = $value['fac_coor_id'];
				?>			
				
										<tr>
											<form action="users.php" method="post" >
												<td hidden><input type="hidden" value="<?php echo $fac_coor_id; ?>" name="fac_coor_id"/></td>
												<td width="15%"><?php echo $value['fac_name']; ?></td>
												<td width="20%"><?php echo $value['firstName']. " ".$value['lastName'];?></td>
												<td>
												<select name="coordinator_user_id" class="form-control" required>
													<option value="">--Select One--</option>
													<?php 
														$sql = "SELECT * FROM fac_coordinator, users WHERE fac_coordinator.coordinator_user_id = users.userId AND users.userRole = '3' AND fac_coordinator.coordinator_user_id !=(SELECT `coordinator_user_id` FROM `fac_coordinator` WHERE `fac_id` = '$fac_id')GROUP BY users.userId";
														$result = $connect->query($sql);
														foreach($result as $value){
													?>
													  <option value="<?php echo $value['userId'];?>"><?php echo $value['firstName']. " ".$value['lastName'];?></option>
												<?php }//end of foreach?>
												</select>
											</td>
												<td width="17%" id="selection"><input type="submit" value="Update" class="btn btn-primary btn-sm" name="update_faculty"/></td>
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