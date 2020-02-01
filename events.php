<?php 
include_once('header.php');
include_once('connect_db.php');
include_once('session_checker.php');

$connect = database_connection();
?>
<?php
	if(isset($_SESSION['userName'])){ ?>



<body id="page-top">
<?php if(isset($_SESSION['isLoggedIn']) AND $_SESSION['isLoggedIn'] == true){?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
<?php include_once('sidebar.php');?>  
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
<?php include_once('topbar.php');?>  		
        <!-- End of Topbar -->

<?php 	


// check for delete event
if(isset($_POST['delete_event'])){
	$event_id = $_POST['event_id'];
	$sql_for_delete = "DELETE FROM `events` WHERE `event_id` = '$event_id'";
	$connect->query($sql_for_delete);
}
// end of delete event

// check for update event
if(isset($_POST['update_event'])){
	$event_id = $_POST['event_id'];
	$event_name = $_POST['event_name'];
	$closure_date = $_POST['closure_date'];
	$sql_for_update = "UPDATE `events` SET `event_name`='$event_name',`closure_date`='$closure_date' WHERE `event_id` = '$event_id'";
	$connect->query($sql_for_update);
}
// end of update event

// check for new event
if(isset($_POST['new_event_data'])){
	$event_name = $_POST['eventName'];
	$closure_date = date('Y-m-d', strtotime($_POST['closing_date']));
	$event_session = substr($closure_date,0,4);
	$sql = "INSERT INTO `events`(`event_name`, `closure_date`, `event_session`) VALUES ('$event_name','$closure_date','$event_session')";
	$connect->query($sql);
}
// end of new event

	
	if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 0){
	$sql_for_events = "SELECT * FROM `events`";
	$event_result = $connect->query($sql_for_events); ?>		  
		  
		<div class="row">
            <div class="col-lg-12">
				<div class="card shadow mb-4">
					<div class="card-header py-3">
					  <h6 class="m-0 font-weight-bold text-primary">Active Users</h6>
					</div>
					<div class="card-body">
					  <div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						  <thead>
							<tr>
							  <th>Event Name</th>
							  <th>Closure Date</th>
							  <th>Session</th>
							  <th>Action</th>
							</tr>
						  </thead>
						  <tfoot>
							<tr>
							  <th>Event Name</th>
							  <th>Closure Date</th>
							  <th>Session</th>
							  <th>Action</th>
							</tr>
						  </tfoot>
						  <tbody>
<?php foreach($event_result as $value){?>						  
							<tr>
							<form action="events.php" method="post" >
								<td hidden><input type="hidden" value="<?php echo $value['event_id']; ?>" name="event_id"/></td>
								<td width="50%"><input type="text" value="<?php echo $value['event_name']; ?>" name="event_name"/></td>
								<td width="20%"><input type="text" value="<?php echo $value['closure_date']; ?>" name="closure_date"/></td>
								<td width="10%"><?php echo $value['event_session']; ?></td>
								<td width="20%"><input type="submit" name="update_event" value="Update" class="btn btn-primary" /> <input type="submit" name="delete_event" value="Delete" class="btn btn-danger" /></td>
							</form>
							</tr>
	<?php }// end of foreach?>
<?php }// end of if clause ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
		
		<!--/div> <!-- /main content ->
	</div> <!-- /content wrapper-->
		        

      
      <!-- End of Main Content -->

      <!-- Footer -->



<?php
	}else{
		include_once('topbar.php');
?>
	
	<div class="container">
<?php
		include_once('guest.php');	
		include_once('footer.php');
		?>
	</div>
<?php	}
?>


  <!-- footer-->
<?php include_once('footer.php');?>
<?php }else{//end of session checker for logged in person
	header('location: index.php');
}?>