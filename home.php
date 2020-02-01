<?php include_once('template/header.php');?>
<?php include_once('session_checker.php');?>
<?php include_once('connect_db.php');?>
<?php $connect = database_connection();?>


<?php if(isset($_SESSION['userName']) ){ ?>


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
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod"></span>
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
		
		<div class="container"> 
			<!--img src="img/versity1.jpg" alt="" width="100%" /-->
			
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
				<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>

			<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="img/versity1.jpg" alt="" width="100%" />
					</div>

					<div class="item">
						<img src="img/versity2.jpg" alt="" width="100%" />
					</div>

					<div class="item">
						<img src="img/versity3.png" alt="" width="100%" />
					</div>
				</div>

			<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<hr /> 
			<h2>University of Greenwich</h2>
			<hr /> 
			<p>The University of Greenwich is a public university located in London, in the United Kingdom. It has three campuses in London and Kent, England. These are located at Greenwich, in the grounds of the Old Royal Naval College, and in Avery Hill and Medway. Previous names include Woolwich Polytechnic and Thames Polytechnic.</p>

			<p>The university's range of subjects includes architecture, business, computing, mathematics, education, engineering, humanities, maritime studies, natural sciences, pharmacy and social sciences.</p>
			
			<hr /> 
			<h5>History</h5>
			<hr /> 
			<p>The university dates back to November 1891, when Woolwich Polytechnic, the second-oldest polytechnic in the United Kingdom, opened in Woolwich. In 1970, Woolwich Polytechnic merged with part of Hammersmith College of Art and Building to form Thames Polytechnic. In the following years, Dartford College (1976), Avery Hill College (1985), Garnett College (1987) and parts of Goldsmiths College and the City of London College (1988) were incorporated.</p>

			<p>In 1992, Thames Polytechnic was granted university status by the Major government (together with various other polytechnics) and renamed University of Greenwich in 1993. In 2001, the university gave up its historic main campus in the Bathway Quarter in Woolwich, relocating to its current main campus in Greenwich.</p>
		</div>
    
		
		
       
		<?php include_once('template/copyright.php');?>
    </div>


<?php }else{
	header('location:index.php');
} ?>
<?php include_once('template/scripts.php');?>