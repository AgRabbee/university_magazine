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
                                            <li><span class="bread-blod">All Faculties</span>
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
	if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 0 || $_SESSION['userRole'] == 2){
	$sql_for_faculties = "SELECT * FROM fac_coordinator, faculties, users WHERE fac_coordinator.fac_id = faculties.fac_id AND fac_coordinator.coordinator_user_id = users.userId";
	$fac_result = $connect->query($sql_for_faculties); ?>			

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="">
							<?php 
								if(isset($_GET['create'])){?>
								<div class="alert alert-success" role="alert">
								  Faculty Created successfully!!
								</div>
							<?php }else if(isset($_GET['update'])){?>
								<div class="alert alert-success" role="alert">
								  Marketing Coordinator changed successfully!!
								</div>
							<?php }
							?>
								<div class="col-md-6">
								<div class="main-sparkline13-hd">
                                    <h1>All Faculties</h1>
                                </div>
									<table class="table">
										 <thead>
											<tr>
											  <th>Faculty Name</th>
											  <th>Marketing Coordinator</th>
											</tr>
										  </thead>
										<tbody>
						<?php foreach($fac_result as $value){?>						  
											<tr>
												<td hidden><?php echo $value['fac_id']; ?></td>
												<td><?php echo $value['fac_name']; ?></td>
												<td><?php echo $value['firstName']." ". $value['lastName']; ?></td>
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
		</div>
				
	<?php }?>
		
		
		
		
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>