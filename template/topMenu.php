

			<div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
								<?php if($_SESSION['userRole'] == 4){?>
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro"></div>
                                    </div>
								<?php }else{?>
									<div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="educate-icon educate-nav"></i>
												</button>
                                        </div>
                                    </div>
								<?php }?>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n"></div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                												
			<?php if($_SESSION['userRole'] == 3){?>
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i>
						<?php  
							$id = $_SESSION['userID'];
							$sql = "SELECT COUNT(`mail_stts`) as Total FROM `mail_notification` WHERE mail_stts = '0' AND `coordinator_user_id` = '$id'";
							$result = $connect->query($sql);		
							$row = mysqli_fetch_assoc($result); 
							$sum = $row['Total'];
						?>						
												<span class="badge badge-danger badge-counter"><?php echo $sum;?></span></a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        <div class="notification-single-top">
                                                            <h1>Notifications</h1>
                                                        </div>
                                                        <ul class="notification-menu">
                                                            
                        <?php 
							$sql_for_notifications = "SELECT * FROM mail_notification WHERE mail_notification.coordinator_user_id = '$id' AND `mail_stts` = '0'";
							$result = $connect->query($sql_for_notifications);
							
							foreach($result as $value){
								$cont_id = $value['contribution_id'];
								$mail = $value['mail_body']; 
								$id = $value['mail_id']; 
						?>
								
									<?php //collecting submission date
										$letters = str_split("$cont_id",3);
										if($letters[0] == 'ph_'){
											$sql = "SELECT * FROM `photographs` WHERE `photograph_id` = '$letters[1]'";
											$result = $connect->query($sql);		
											$row = mysqli_fetch_assoc($result); 
											$date = $row['submission_date'];
											$cont_name = $row['photograph'];
										}else{
											$sql = "SELECT * FROM `articles` WHERE `article_id` ='$letters[1]'";
											$result = $connect->query($sql);		
											$row = mysqli_fetch_assoc($result); 
											$date = $row['submission_date'];
											$cont_name = $row['articles'];
										}
									  ?>          
									  
									  	<li>
											<form action="" method="post" id="notifications">  
											<input type="" value="<?php echo $id;?>" id="notification_id" hidden />
												<a class="dropdown-item d-flex align-items-center" href="<?php if($letters[0] == 'ph_'){echo 'photographs/'.$cont_name;}else {echo 'articles/'.$cont_name;}?>" target="blank">
													<div class="notification-icon">
														<i class="fa fa-eraser edu-shield" aria-hidden="true"></i>
													</div>
													<div class="notification-content">
														<span class="notification-date"><?php echo $date;?></span>
														<br />
														<p><?php echo $mail;?></p>
													</div>
												</a>
											</form>   
										</li>
																	
							<?php	}//end of foreach loop?>										
																
                                                        </ul>
                                                    </div>
                                                </li>
												
			<?php }//end of checking user role for notification?>	
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
															<img src="img/product/pro4.jpg" alt="" />
													<?php 
														$id = $_SESSION['userID'];
														$sql ="Select * from users where userID = '$id'";
														$result = $connect->query($sql);
														foreach($result as $val){
															$userName = $val['firstName']. ' ' . $val['lastName'];
															$userRole = $val['userRole'];
														}
													?>		
															<span class="admin-name"><?php echo $userName;?> <br />
															<small>(<?php 
													if($userRole == 0){
															echo "Admin";
														}elseif($userRole == 1){
															echo "Student";
														}elseif($userRole == 2){
															echo "Marketing Manager";
														}elseif($userRole == 3){
															echo "Marketing Coordinator";
														}elseif($userRole == 4){
															echo "Guest";
														}?>)</small>
														</span>
															
															
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                     
														<li><a href="profile.php"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                                                        </li>
													
                                                        <li><a href="logout.php"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>