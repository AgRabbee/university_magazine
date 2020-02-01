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
                                            <li><a href="allEvents.php">Events</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">All Events</span>
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
// check for delete event
if(isset($_POST['delete_event'])){
	$event_id = $_POST['event_id'];
	$sql_for_delete = "DELETE FROM `events` WHERE `event_id` = '$event_id'";
	$connect->query($sql_for_delete);
	$delete_msg = '';
}
// end of delete event

// check for update event
if(isset($_POST['update_event'])){
	$event_id = $_POST['event_id'];
	$event_name = $_POST['event_name'];
	$closure_date = date('Y-m-d', strtotime($_POST['closure_date']));
	$sql_for_update = "UPDATE `events` SET `event_name`='$event_name',`closure_date`='$closure_date' WHERE `event_id` = '$event_id'";
	$connect->query($sql_for_update);
	$update_msg = '';
}
// end of update event

// check for new event
if(isset($_POST['new_event_data'])){
	$event_name = $_POST['eventName'];
	$closure_date = date('Y-m-d', strtotime($_POST['closing_date']));
	$event_session = substr($closure_date,0,4);
	$sql = "INSERT INTO `events`(`event_name`, `closure_date`, `event_session`) VALUES ('$event_name','$closure_date','$event_session')";
	$connect->query($sql);
	$create_msg = '';
}
// end of new event

	
	if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 0 || $_SESSION['userRole'] == 2){
	$sql_for_events = "SELECT * FROM `events`";
	$event_result = $connect->query($sql_for_events); ?>			

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="">
								<?php 
									if(isset($delete_msg)){?>
									<div class="alert alert-danger" role="alert">
									  Event deleted successfully!!
									</div>
								<?php }else if(isset($update_msg)){?>
									<div class="alert alert-success" role="alert">
									  Event updated successfully!!
									</div>
								<?php }else if(isset($create_msg)){?>
									<div class="alert alert-success" role="alert">
									  Event created successfully!!
									</div>
								<?php }
								?>
								<div class="col-md-8">
								<div class="main-sparkline13-hd">
                                    <h1>All Events</h1>
                                </div>
									<table class="table">
										 <thead>
											<tr>
											  <th>Event Name</th>
											  <th>Closure Date</th>
											  <th>Session</th>
											  <th>Action</th>
											</tr>
										  </thead>
										<tbody>
						<?php foreach($event_result as $value){?>					  
											<tr>
											<form action="" method="post" >
												<td hidden><input type="hidden" value="<?php echo $value['event_id']; ?>" name="event_id"/></td>
												<td width="40%"><input type="text" class="form-control" value="<?php echo $value['event_name']; ?>" name="event_name"/></td>
												<td width="15%"><input type="text" class="form-control datepicker" value="<?php echo $value['closure_date']; ?>" name="closure_date" id="datepicker<?php echo $value['event_id']; ?>"/></td>
												<td width="15%"><input type="text" disabled class="form-control" value="<?php echo $value['event_session']; ?>" /></td>
												<td width="20%"><input type="submit" name="update_event" value="Update" class="btn btn-primary" /> <input type="submit" name="delete_event" value="Delete" class="btn btn-danger" /></td>
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
		</div>
				
	<?php }?>
		
		
	<script type="text/javascript"> 
		$(document).ready(function(){
			$( "#datepicker<?php echo $value['event_id']; ?>" ).datepicker({
				dateFormat: "dd-mm-yy",
				todayHighlight: true,
				changeMonth: true,
				changeYear: true,
				minDate: new Date()
			});
		});
	
	</script>
		
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>