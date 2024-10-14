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

                <!-- //! APPS LINK -->
                <!-- <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Apps</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="chat.php">Chat</a></li>
                        <li class="submenu">
                            <a href="#"><span> Calls</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="voice-call.php">Voice Call</a></li>
                                <li><a href="video-call.php">Video Call</a></li>
                                <li><a href="outgoing-call.php">Outgoing Call</a></li>
                                <li><a href="incoming-call.php">Incoming Call</a></li>
                            </ul>
                        </li>
                        <li><a class="<?php echo ($page == 'events.php')?'active':'';?>" href="events.php">Calendar</a></li>
                        <li><a class="<?php echo ($page == 'contacts.php')?'active':'';?>" href="contacts.php">Contacts</a></li>
                        <li><a class="<?php echo ($page == 'inbox.php')?'active':'';?>" href="inbox.php">Email</a></li>
                        <li><a class="<?php echo ($page == 'file-manager.php')?'active':'';?>" href="file-manager.php">File Manager</a></li>
                    </ul>
                </li> -->
                <!-- //! APPS LINK -->

                <!-- //* CALENDAR -->
                 <li class="<?php echo ($page == 'events.php')?'active':'';?>" href="events.php"> 
                    <a href="events.php"><i class="la la-calendar"></i> <span>Calendar</span></a>
                </li>
                 <!-- //* CALENDAR -->
                 <li class="<?php echo ($page == 'create-program.php')?'active':'';?>" href="create-program.php"> 
                    <a href="create-program.php"><i class="la la-edit"></i> <span>Custimize program</span></a>
                </li>
                <li class="<?php echo ($page == 'estore')?'active':'';?>" href="estore.php"> 
                    <a href="estore.php"><i class="la la-store"></i> <span>Storefront</span></a>
                </li>
                
                

           

                <!-- //* PROGRAMS and WORKOUTS -->
                 <li class="submenu">
                    <a href="#" ><i class="la la-dumbbell"></i> <span> Programs & Workouts</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="<?php echo ($page == 'offered-programs.php')?'active':'';?>" href="offered-programs.php">Offered Programs</a></li>
                        <li><a class="<?php echo ($page == 'targeted-exercise.php')?'active':'';?>" href="targeted-exercise.php">Targeted Exercise</a></li>
                        <li><a class="<?php echo ($page == 'weekly-workout-plans.php')?'active':'';?>" href="weekly-workout-plans.php">Weekly Workout Plans</a></li>
                    </ul>
                </li>
                <li class="<?php echo ($page == 'settings.php')?'active':'';?>"> 
                        <a href="settings.php"><i class="la la-cogs"></i> <span>Account settings</span></a>
                    </li>
                <!-- //* PROGRAMS and WORKOUTS -->


            
                <!-- //! REMOVED TABLES -->



                <!-- //! REMOVED EXTRAS -->
                <!-- <li class="menu-title"> 
                    <span>Extras</span>
                </li>
                <li> 
                    <a href="#"><i class="la la-file-text"></i> <span>Documentation</span></a>
                </li>
                <li> 
                    <a href="javascript:void(0);"><i class="la la-info"></i> <span>Change Log</span> <span class="badge badge-primary ms-auto">v3.4</span></a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="la la-share-alt"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="submenu">
                            <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> <span>Level 1</span></a>
                        </li>
                    </ul>
                </li> -->
                <!-- //! REMOVED EXTRAS -->
            </ul>
            
        </div>
    </div>
</div>
