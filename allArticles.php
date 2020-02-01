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
                                            <li>Contributions <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">All Articles</span>
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
		

<?php // update article status
	if(isset($_POST['slct_article'])){
		$id = $_POST['ar_id'];
		$sql_for_update = "UPDATE `articles` SET `status`='1' WHERE `article_id` = '$id'";
		$connect->query($sql_for_update);
	}
	
	
	
if(isset($_SESSION['userRole'])&& ($_SESSION['userRole'] == 0 || $_SESSION['userRole'] == 2 || $_SESSION['userRole'] == 3 )){
	
	if($_SESSION['userRole'] == 3){
		$user_id = $_SESSION['userID'];
		$sql_for_articles = "SELECT * from articles, student,faculties, fac_coordinator,users WHERE articles.student_id = student.id AND student.faculty_id = faculties.fac_id AND faculties.fac_id = fac_coordinator.fac_id AND student.userId = users.userId AND fac_coordinator.coordinator_user_id = '$user_id'";
	}else{
		$sql_for_articles = "SELECT * FROM articles, student, users, faculties WHERE articles.student_id = student.id AND users.userId = student.userId AND student.faculty_id = faculties.fac_id";
	}
	
	$articles_result = $connect->query($sql_for_articles); ?>			

		<div class="single-pro-review-area mt-t-30 mg-b-15">	
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="data-table-area mg-b-15">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
									<div class="row"> 
										<div class="col-md-10">
											<h1>All Articles</h1>
										</div>
								<?php if($_SESSION['userRole'] != 3){?>		
										<div class="col-md-2">
											<form action="download.php" method="post"><input type="submit" class="btn btn-primary btn-sm" name="ar_download" value="Download All" /></form>
										</div>
								<?php }?>	
									</div>
                                </div>
                            </div>
                            <div class="container">
								<table class="table">
									 <thead>
										<tr>
										  <th>Student Name</th>
										  <th>Faculty</th>
										  <th>Contribution</th>
										  <th>Submission Date</th>
										  <th>Status</th>
										  <?php if($_SESSION['userRole'] == 3){?>
										  <th>Action</th>
										  <?php }?>
										</tr>
									  </thead>
									<tbody>
			<?php foreach($articles_result as $value){
					$returnDate = $value['submission_date'];
					$expired_date = date('Y-m-d', strtotime($returnDate. ' + 14 days'));
					$today = date("Y-m-d");
			?>	
			
									<tr>
									  <td><?php echo $value['firstName']. " ". $value['lastName'];?></td>
									  <td><?php echo $value['fac_name'];?></td>
									  <td><a href="articles/<?php echo $value['articles'];?>"><?php echo $value['articles'];?></a></td>
									  <td><?php echo $value['submission_date'];?></td>
									<form action="" method="post" >
									  <td id="selection" >
									<?php if($value['status'] == '0'){ echo "Pending...";?>
									
												<input type="hidden" value="<?php echo $value['article_id'];?>" name="ar_id" />
												<input type="submit" class="btn btn-primary btn-sm" value="Select" name="slct_article"/>	
												
									<?php }else if($value['status'] == '1'){echo "<input type='button' disabled class='btn btn-sm' value='Selected'/>";}?>
												
									  </td>
									<?php if($_SESSION['userRole'] == 3 && ($today < $expired_date)){
									?>
									  <td><a href="contribution_comment.php?id=<?php echo $value['article_id'];?>" class="btn btn-primary btn-sm">Comment</a></td>
									<?php }else{?>
										<td><p disabled class="btn btn-primary btn-sm">Comment</p></td>
									<?php }?>
									</form>
									</tr>
			<?php }// end of foreach?>
								  </tbody>
								</table>
							</div>
		
	<?php }else if($_SESSION['userRole'] == 1){
		$s_id =$_SESSION['stu_Id'];
	?>
	
							<div class="container"> 
						<?php if(isset($_GET['msg'])){?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<?php echo 'Articles deleted successfully!!!';?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
						<?php }?>		
						
								<div class="col-md-10">
									<h1>All Articles</h1>
								</div>
								<table class="table">
									 <thead>
										<tr>
										  <th>Student Name</th>
										  <th>Faculty</th>
										  <th>Contribution</th>
										  <th>Submission Date</th>
										  <th>Status</th>
										  <th>Action</th>
										</tr>
									  </thead>
	<?php 
			$sql_for_articles = "SELECT * FROM articles, events WHERE articles.eventId = events.event_id AND articles.student_id = '$s_id'";
			$articles_result = $connect->query($sql_for_articles);
			foreach($articles_result as $value){
				$returnDate = $value['closure_date'];
				//$expired_date = date('Y-m-d', strtotime($returnDate. ' + 14 days'));
				$today = date("Y-m-d");
		?>
									<tbody>
										<tr> 
											<td><a href="articles/<?php echo $value['articles'];?>"><?php echo $value['articles'];?></a></td>
											<td><?php echo $value['event_name'];?></td>
											<td><?php echo $value['submission_date'];?></td>
								
											<td id="selection" >
										<?php if($value['status'] == '0'){ echo "Pending...";}else{echo "Selected";}?>	
											</td>
											<td width="20%">
											<form action="checker.php" method="post">
												<input type="hidden" name="article_id" value="<?php echo $value['article_id'];?>" /> 
												<input type="hidden" name="article_name" value="<?php echo $value['articles'];?>" /> 
										<?php if(($value['status'] == '0') && ($today < $returnDate)){?>			
												<input type="submit" name="update_article" value="Update" class="btn btn-primary btn-sm" /> 
												<input type="submit" name="delete_article" value="Delete" class="btn btn-danger btn-sm" />
										<?php }else{?>
												<input type="submit" disabled name="update_article" value="Update" class="btn btn-primary btn-sm" /> 
										<?php }?>
												
											</form>
											</td width="10%">
										
											  <td><a href="contribution_comment.php?id=<?php echo $value['article_id'];?>" class="btn btn-primary btn-sm">Comment</a></td>
										
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
				
	<?php }?>
		
		
		
		
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>