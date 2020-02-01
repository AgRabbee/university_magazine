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
	if(isset($_SESSION['userRole']) && $_SESSION['userRole'] != 1){
	
	?>
		<div class="charts-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro responsive-mg-b-30">
                            <div id="chart_articles" style = "width: 550px; height: 400px; margin: 0 auto"></div>
							<?php 
							// php code for getting value from database
								$sql ="SELECT 
										COUNT(a.article_id) as 'articlenum',
										f.fac_name, 
										YEAR(STR_TO_DATE(a.`submission_date`, '%Y'))as 'year' 
										FROM `faculties` as f 
										LEFT JOIN student as s ON f.fac_id=s.faculty_id
										LEFT JOIN articles as a ON s.id = a.student_id 
										GROUP BY f.fac_id";
								
								$results = $connect->query($sql);
								$data ='';
								foreach($results as $val){
									$data .= '["'.$val['fac_name'].'",'.$val['articlenum'].'],';
									}
									
								$data = rtrim($data,',');
								//echo $data;
								?>
							<!-- google chart  JS
							============================================ -->
							<script src="js/google.chart.js"></script>
							<script type="text/javascript">
								google.charts.load('current', {'packages':['bar']});
								google.charts.setOnLoadCallback(drawStuff);

								function drawStuff() {
									var data = new google.visualization.arrayToDataTable([
									['Faculty', 'No of Articles'],
									<?=$data?>
									]);

									var options = {
									title: 'Number of articles for each faculty',
									width: 500,
									legend: { position: 'none' },
									chart: { title: 'Number of articles for each faculty'},
									bars: 'vertical', // Required for Material Bar Charts.
									axes: {
									x: {
									0: { side: 'left', label: 'Faculties'} // Top x-axis.
									}
									},
									bar: { groupWidth: "90%" }
									};

									var chart = new google.charts.Bar(document.getElementById('chart_articles'));
									chart.draw(data, options);
								};
							</script>
              
						</div>
                    </div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="charts-single-pro responsive-mg-b-30">
                            <div id="chart_photographs" style = "width: 550px; height: 400px; margin: 0 auto"></div>
					
							<?php 
							// php code for getting value from database
								$sql ="SELECT 
										COUNT(p.photograph_id) as 'noOfPhotograph',
										f.fac_name, 
										YEAR(STR_TO_DATE(p.`submission_date`, '%Y'))as 'year' 
										FROM `faculties` as f 
										LEFT JOIN student as s ON f.fac_id=s.faculty_id
										LEFT JOIN photographs as p ON s.id = p.student_id 
										GROUP BY f.fac_id";
								
								$results = $connect->query($sql);
								$data1 ='';
								foreach($results as $val){
									$data1 .= '["'.$val['fac_name'].'",'.$val['noOfPhotograph'].'],';
									}
									
								$data1 = rtrim($data1,',');
								//echo $data;
							?>
					
					
						<script type="text/javascript">
							google.charts.load('current', {'packages':['bar']});
							google.charts.setOnLoadCallback(drawStuff);

							function drawStuff() {
								var data = new google.visualization.arrayToDataTable([
								['Faculty', 'No of Photographs'],
								<?=$data1?>
								]);

								var options = {
								title: 'Number of photographs for each faculty',
								width: 500,
								legend: { position: 'none' },
								chart: { title: 'Number of photographs for each faculty'},
								bars: 'vertical', // Required for Material Bar Charts.
								axes: {
								x: {
								0: { side: 'left', label: 'Faculties'} // Top x-axis.
								}
								},
								bar: { groupWidth: "90%" }
								};

								var chart = new google.charts.Bar(document.getElementById('chart_photographs'));
								chart.draw(data, options);
							};
						</script>
						</div>
					</div>
                </div>
            </div>
        </div>
		
				
	<?php }//end of user role for admin?>
		
		
		
		
		
		
		
		
		

    <?php include_once('template/popupModal.php');?>
    <?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>