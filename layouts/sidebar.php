<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];
?>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="menu-title"> 
                    <span>Main</span>
                </li>

                <!--//* DASHBOARD LINK -->
                <li class="<?php echo ($page == 'admin-dashboard.php')?'active':'';?>" href="admin-dashboard.php"> 
                    <a href="admin-dashboard.php"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                </li>
               
                <!--//* DASHBOARD LINK -->

                <!-- //* CALENDAR -->
                 <li class="<?php echo ($page == 'events.php')?'active':'';?>" href="events.php"> 
                    <a href="events.php"><i class="la la-calendar"></i> <span>Calendar</span></a>
                </li>
                 <!-- //* CALENDAR -->
                  <!-- //* file maintinance -->
                <li class=" submenu"> 
                <a href="#" ><i class="la la-box"></i> <span> File maintinance</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="<?php echo ($page == 'category-list.php')?'active':'';?>" href="category-list.php">Category List</a></li>                 
                        <li><a class="<?php echo ($page == 'inventory.php')?'active':'';?>" href="inventory.php">Product List</a></li>
                        <li><a class="<?php echo ($page == 'offered-programs.php')?'active':'';?>" href="offered-programs.php">Offered Programs</a></li>  
                        <li><a class="<?php echo ($page == 'targeted-exercise.php')?'active':'';?>" href="targeted-exercise.php">Targeted Exercise</a></li>
                    </ul>
                </li>

          
                <!-- //* INVENTORY -->

                <!-- //* CUSTOMER MANAGEMENT -->
                <li class="submenu">
                    <a href="#" ><i class="la la-users"></i> <span>Customer Management</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="<?php echo ($page == 'employees-list.php')?'active':'';?>" href="employees-list.php">Member List</a></li>
                        <li><a class="<?php echo ($page == 'enrollment.php')?'active':'';?>" href="enrollment.php">Enrollment</a></li>
                        <li><a class="<?php echo ($page == 'renewal-and-cancellation.php')?'active':'';?>" href="renewal-and-cancellation.php">Renewal & Cancellations</a></li>
                        <!-- <li><a class="<?php echo ($page == 'client-profile.php')?'active':'';?>" href="client-profile.php">Profile Overview</a></li> -->
                        <li><a class="<?php echo ($page == 'attendance-tracking.php')?'active':'';?>" href="attendance-tracking.php">Attendance Tracking</a></li>
                        <li><a class="<?php echo ($page == 'personalized-recommendation.php')?'active':'';?>" href="personalized-recommendation.php">Personalized Recommendation</a></li>
                   </ul>
                </li>
                <!-- //* CUSTOMER MANAGEMENT -->

                <li class="menu-title"> 
                    <span>Transaction</span>
                </li>

                <!-- //* POINT OF SALE -->
                 <li class="<?php echo ($page == 'pos.php')?'active':'';?>" href="pos.php"> 
                    <a href="pos.php"> <i class="la la-cash-register"></i> <span>Point of Sale</span></a>
                </li>
                 <!-- //* POINT OF SALE -->

                <li class="menu-title"> 
                    <span>Utilities</span>
                </li>
                <li class="<?php echo ($page == 'discount.php')?'active':'';?>" href="discount.php"> 
                    <a href="discount.php"> <i class="la la-gem"></i> <span>Discounts</span></a>
                    <li><a class="<?php echo ($page == 'stock-in.php')?'active':'';?>" href="stock-in.php">Stock In</a></li>
                    <li><a class="<?php echo ($page == 'stock-out.php')?'active':'';?>" href="stock-out.php">Stock Out</a></li>
                </li>
                <li class="<?php echo ($page == 'archive.php')?'active':'';?>" href="archive.php"> 
                    <a href="archive.php"> <i class="fas fa-archive"></i> <span>Archive</span></a>
                </li>

                <!-- //* REPORTS -->
                 <li class="submenu">
                    <a href="#" ><i class="la la-chart-bar"></i> <span>Reports</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="<?php echo ($page == 'sales-reports.php')?'active':'';?>" href="sales-reports.php">Sales Reports</a></li>
                        <li><a class="<?php echo ($page == 'inventory-reports.php')?'active':'';?>" href="inventory-reports.php">Inventory Reports</a></li>
                        <li><a class="<?php echo ($page == 'attendance-reports.php')?'active':'';?>" href="attendance-reports.php">Attendance Reports</a></li>
                    </ul>
                </li>
                <!-- //* REPORTS -->

                 <!-- //* YOU CAN DELETE THIS -->
                 <li class="submenu">
                    <a href="#"><i class="la la-database"></i> <span> Backup & Restore </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="<?php echo ($page == 'backup-and-restore.php')?'active':'';?>" href="backup-and-restore.php">Backup & Restore</a></li>
                        <li><a class="<?php echo ($page == 'tax-settings.php')?'active':'';?>" href="tax-settings.php">Tax Settings</a></li>
                    </ul>
                </li>
                <!-- //* YOU CAN DELETE THIS -->
            </ul>
            
        </div>
    </div>
</div>
