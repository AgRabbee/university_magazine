			<div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <?php if($_SESSION['userRole']== 0 || $_SESSION['userRole']== 2){//for admin and manager?>
                        <li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Contributions</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Inbox" href="allArticles.php"><span class="mini-sub-pro">All Articles</span></a></li>
                                <li><a title="View Mail" href="allPhotographs.php"><span class="mini-sub-pro">All Photograph</span></a></li>
                            </ul>
                        </li>
                        
					   <li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Users</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Professors" href="activeUsers.php"><span class="mini-sub-pro">Active Users</span></a></li>
                                <li><a title="Add Professor" href="pendingUsers.php"><span class="mini-sub-pro">Pending Users</span></a></li>
								<?php if($_SESSION['userRole'] == 0){?>  
                                <li><a title="Edit Professor" href="addNewUser.php"><span class="mini-sub-pro">Add New User</span></a></li>
								<?php }?>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-student icon-wrap"></span> <span class="mini-click-non">Faculties</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="All Students" href="allFaculties.php"><span class="mini-sub-pro">All Faculties</span></a></li>
								<?php if($_SESSION['userRole'] == 0){?> 
                                <li><a title="Add Students" href="addNewFaculty.php"><span class="mini-sub-pro">Add New Faculty</span></a></li>
								<?php }?>
                                <li><a title="Edit Students" href="updateFaculty.php"><span class="mini-sub-pro">Change Marketing <br /> Coordinator</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-department icon-wrap"></span> <span class="mini-click-non">Events</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Departments List" href="allEvents.php"><span class="mini-sub-pro">All Events</span></a></li>
								<?php if($_SESSION['userRole'] == 0){?>  
                                <li><a title="Add Departments" href="addNewEvent.php"><span class="mini-sub-pro">Add New Event</span></a></li>
								<?php }?>
                            </ul>
                        </li>
						
                        <li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-charts icon-wrap"></span> <span class="mini-click-non">Reports</span></a>
                            <ul class="submenu-angle chart-mini-nb-dp" aria-expanded="false">
                                <li><a title="Bar Charts" href="noOfContributions.php"><span class="mini-sub-pro">Number of Contributions</span></a></li>
                                <li><a title="Bar Charts" href="percentageOfContributions.php"><span class="mini-sub-pro">Percentage of Contributions</span></a></li>
                                <li><a title="Bar Charts" href="noOfContributors.php"><span class="mini-sub-pro">Number of Contributors</span></a></li>
                                <li><a title="Bar Charts" href="contributionswithoutcomment.php"><span class="mini-sub-pro">Contributions without comment</span></a></li>
                            </ul>
                        </li>

		<?php }else if($_SESSION['userRole']== 3){ //end of admin and manager and start for coordinator?>
						<li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Contributions</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Inbox" href="allArticles.php"><span class="mini-sub-pro">All Articles</span></a></li>
                                <li><a title="View Mail" href="allPhotographs.php"><span class="mini-sub-pro">All Photograph</span></a></li>
                            </ul>
                        </li>
						
                        <li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-charts icon-wrap"></span> <span class="mini-click-non">Reports</span></a>
                            <ul class="submenu-angle chart-mini-nb-dp" aria-expanded="false">
                                <li><a title="Bar Charts" href="noOfContributions.php"><span class="mini-sub-pro">Number of Contributions</span></a></li>
                                <li><a title="Bar Charts" href="percentageOfContributions.php"><span class="mini-sub-pro">Percentage of Contributions</span></a></li>
                                <li><a title="Bar Charts" href="noOfContributors.php"><span class="mini-sub-pro">Number of Contributors</span></a></li>
                                <li><a title="Bar Charts" href="contributionswithoutcomment.php"><span class="mini-sub-pro">Contributions without comment</span></a></li>
                            </ul>
                        </li>
						
		<?php }else if($_SESSION['userRole']== 1){// end of coordinator and start for student?>	
						<li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Contributions</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Inbox" href="allArticles.php"><span class="mini-sub-pro">All Articles</span></a></li>
                                <li><a title="View Mail" href="allPhotographs.php"><span class="mini-sub-pro">All Photographs</span></a></li>
                                <li><a title="Compose Mail" href="addNewContribution.php"><span class="mini-sub-pro">Add New</span></a></li>
                            </ul>
                        </li>
		<?php }else if($_SESSION['userRole']== 4){// end of coordinator and start for student?>	
						<li>
                            <a class="has-arrow" href="" aria-expanded="false"><span class="educate-icon educate-charts icon-wrap"></span> <span class="mini-click-non">Reports</span></a>
                            <ul class="submenu-angle chart-mini-nb-dp" aria-expanded="false">
                                <li><a title="Bar Charts" href="noOfContributions.php"><span class="mini-sub-pro">Number of Contributions</span></a></li>
                                <li><a title="Bar Charts" href="percentageOfContributions.php"><span class="mini-sub-pro">Percentage of Contributions</span></a></li>
                                <li><a title="Bar Charts" href="noOfContributors.php"><span class="mini-sub-pro">Number of Contributors</span></a></li>
                                <li><a title="Bar Charts" href="contributionswithoutcomment.php"><span class="mini-sub-pro">Contributions without comment</span></a></li>
                            </ul>
                        </li>
		<?php }?>							
						
						
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>