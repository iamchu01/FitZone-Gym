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
                
            <nav class='greedy'>
                <ul class="list-inline-item list-unstyled links">
                    <li> 
                        <a href="admin-dashboard.php"><i class="la la-home"></i> <span>Back to Home</span></a>
                    </li>
                    <li class="menu-title">Settings</li>
                    <li class="<?php echo ($page == 'admin-settings.php')?'active':'';?>"> 
                        <a href="admin-settings.php"><i class="fas fa-cog"></i> <span>FitZone Gym Settings</span></a>
                    </li>
                    <li class="<?php echo ($page == 'admin-roles-permissions.php')?'active':'';?>"> 
                        <a href="admin-roles-permissions.php"><i class="fas fa-users-cog"></i> <span>Roles & Permissions</span></a>
                    </li>
                   
                </ul>
                
        </div>
    </div>
</div>
<!-- Sidebar -->