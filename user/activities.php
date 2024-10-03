<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Activities - HRMS admin template</title>

    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>
    <div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>


    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content">
            
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Activities</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Activities</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="activity">
                        <div class="activity-box">
                            <ul class="activity-list">
                                <li>
                                    <div class="activity-user">
                                        <a href="profile.php" title="Lesley Grauer" data-bs-toggle="tooltip" class="avatar">
                                            <img src="assets/img/profiles/avatar-01.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="profile.php" class="name">Lesley Grauer</a> added new task <a href="#">Hospital Administration</a>
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity-user">
                                        <a href="profile.php" class="avatar" title="Jeffery Lalor" data-bs-toggle="tooltip">
                                            <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="profile.php" class="name">Jeffery Lalor</a> added <a href="profile.php" class="name">Loren Gatlin</a> and <a href="profile.php" class="name">Tarah Shropshire</a> to project <a href="#">Patient appointment booking</a>
                                            <span class="time">6 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity-user">
                                        <a href="profile.php" title="Catherine Manseau" data-bs-toggle="tooltip" class="avatar">
                                            <img src="assets/img/profiles/avatar-08.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="profile.php" class="name">Catherine Manseau</a> completed task <a href="#">Appointment booking with payment gateway</a>
                                            <span class="time">12 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Bernardo Galaviz" data-bs-toggle="tooltip" class="avatar">
                                            <img src="assets/img/profiles/avatar-13.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="profile.php" class="name">Bernardo Galaviz</a> changed the task name <a href="#">Doctor available module</a>
                                            <span class="time">1 day ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity-user">
                                        <a href="profile.php" title="Mike Litorus" data-bs-toggle="tooltip" class="avatar">
                                            <img src="assets/img/profiles/avatar-05.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="profile.php" class="name">Mike Litorus</a> added new task <a href="#">Patient and Doctor video conferencing</a>
                                            <span class="time">2 days ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity-user">
                                        <a href="profile.php" title="Jeffery Lalor" data-bs-toggle="tooltip" class="avatar">
                                            <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="profile.php" class="name">Jeffery Lalor</a> added <a href="profile.php" class="name">Jeffrey Warden</a> and <a href="profile.php" class="name">Bernardo Galaviz</a> to the task of <a href="#">Private chat module</a>
                                            <span class="time">7 days ago</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->


</div>
<!-- end main Wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>




</body>

</html>