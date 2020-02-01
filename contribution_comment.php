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
                                            <li><span class="bread-blod">Comments</span>
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
//submitting comments

	if(isset($_POST['cmnt_submit'])){
	$cmnt_body = $_POST['message'];
	$user_id = $_POST['u_id'];
	$article_id = $_POST['ar_id'];
	$sql = "INSERT INTO `comments`( `user_id`, `article_id`, `comments`, `cmnt_submit_date`) VALUES ('$user_id','$article_id','$cmnt_body',CURDATE())";
	$connect->query($sql);
}





if(isset($_SESSION['userRole'])&& ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 1)){
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$u_id = $_SESSION['userID'];
		$sql = "SELECT * FROM articles, student, users, events WHERE articles.student_id = student.id AND student.userId = users.userId AND articles.eventId = events.event_id AND articles.article_id ='$id'";
		$articles_result = $connect->query($sql);
	
?>		


        <div class="blog-details-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="blog-details-inner">
				<?php foreach($articles_result as $value){?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="latest-blog-single blog-single-full-view">
                                        <div class="blog-image">
                                           <p><strong>Article Name:</strong> <?php echo $value['articles'];?></p>
                                        </div>
                                        <div class="blog-details blog-sig-details">
                                            <p><strong>Submitted By:</strong> <?php echo $value['firstName'].' ' .$value['lastName'];?></p>
                                            <p><strong>Status:</strong> <?php if($value['status']==1){echo 'Selected';}else{echo 'Pending';}?></p>
                                            <p><strong>Event:</strong> <?php echo $value['event_name'];?></p>
                                            <p><strong>Submitted on:</strong> <?php echo $value['submission_date'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
				<?php }//end of foreach?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="comment-head">
                                        <h3>Comments</h3>
                                    </div>
                                </div>
                            </div>
				<?php 
					$sql_for_comment = "SELECT * FROM comments, articles, users WHERE comments.user_id = users.userId AND comments.article_id = articles.article_id AND comments.article_id = '$id'";
					$result_comments = $connect->query($sql_for_comment);
					if($result_comments->num_rows>0){
						foreach($result_comments as $val){
				?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="user-comment">
                                        <img src="img/contact/5.png" alt="" />
                                        <div class="comment-details">
                                            <h5><?php echo $val['firstName'].' ' .$val['lastName'];?><span class="comment-replay"><?php echo $val['cmnt_submit_date']?></span></h5>
                                            <p><?php echo $val['comments'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
					<?php }//end of foreach
						}else{?> 
							<div class="alert alert-warning">
								<?php echo 'No comment is available. Make one.';?>
							</div>
					<?php }?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="lead-head">
                                        <h3>Leave A Comment</h3>
                                    </div>
                                </div>
                            </div>
							
                            <div class="row">
                                <div class="coment-area">
                                    <form id="comment" action="" method="post" class="comment">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
												<input type="hidden" name="u_id" value="<?php echo $u_id;?>" />
												<input type="hidden" name="ar_id" value="<?php echo $id;?>" />
                                                <textarea name="message" cols="30" rows="10" placeholder="Type your comments here.."></textarea>
                                            </div>
                                            <div class="payment-adress comment-stn">
												<input type="submit" name="cmnt_submit" class="btn btn-primary btn-sm" value="Submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
               


		
<?php }//end of get?>	
<?php }//end of user role if?>	
		
		
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>