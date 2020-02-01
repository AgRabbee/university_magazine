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
	if(isset($_SESSION['userRole']) && $_SESSION['userRole'] !=1){
	
	?>
		<div class="charts-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="charts-single-pro responsive-mg-b-30">
                            <div id="piechart" style = "width: 520px; height: 400px; margin: 0 auto"></div>
							
						<?php 
							$sql1 ="SELECT COUNT(article_id)as a from articles";
							$result1= $connect->query($sql1)->fetch_object()->a;
							$sql2 ="SELECT COUNT(photograph_id)as p from photographs";
							$result2= $connect->query($sql2)->fetch_object()->p;
							$totalCont = $result1 + $result2;
							
							$sql ="SELECT 
									COUNT(a.article_id) as 'articlenum',
									f.fac_name, 
									YEAR(STR_TO_DATE(a.`submission_date`, '%Y'))as 'year' 
									FROM `faculties` as f 
									LEFT JOIN student as s ON f.fac_id=s.faculty_id
									LEFT JOIN articles as a ON s.id = a.student_id 
									GROUP BY f.fac_id";
								
							$results1 = $connect->query($sql);
							foreach($results1 as $val){
								$data[] = array(
										'fac_name' => $val['fac_name'],
										'num_art' => $val['articlenum'],
										'total' => 0
										);
							}
							
							$sql ="SELECT 
										COUNT(p.photograph_id) as 'noOfPhotograph',
										f.fac_name, 
										YEAR(STR_TO_DATE(p.`submission_date`, '%Y'))as 'year' 
										FROM `faculties` as f 
										LEFT JOIN student as s ON f.fac_id=s.faculty_id
										LEFT JOIN photographs as p ON s.id = p.student_id 
										GROUP BY f.fac_id";
								
							$results2 = $connect->query($sql);
							$i=0;
							foreach($results2 as $val){
								$data[$i]['total'] = $val['noOfPhotograph']+$data[$i]['num_art'];
								//$data1 .= '["'.$val['fac_name'].'",'.$val['noOfPhotograph'].'],';
								$i++;
							}
							$jsData = '';
							foreach($data as $item){
								//$facPercent[] =  ($item['total']* 100)/$totalCont;
								$jsData .= '["'.$item['fac_name'].'",'.($item['total']* 100)/$totalCont.'],';
							}
						
						?>

							
						</div>	
						<!-- google chart  JS============================================ -->
						<script src="js/google.chart.js"></script>
						<script type="text/javascript">
						  google.charts.load('current', {'packages':['corechart']});
						  google.charts.setOnLoadCallback(drawChart);

						  function drawChart() {

							var data = google.visualization.arrayToDataTable([
							  ['Faculty', 'Percent'],
							  <?=$jsData?>
							]);

							var options = {
							  title: 'Percentage of contribution by each faculty'
							};

							var chart = new google.visualization.PieChart(document.getElementById('piechart'));

							chart.draw(data, options);
						  }
						</script>
						
						
						
						
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