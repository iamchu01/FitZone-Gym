<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<head>
    <title>Product Category List - GYYMS Admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'layouts/menu.php'; ?>

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Program List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>                   
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="create-program.php" class="btn add-btn"><i class="fa fa-plus"></i> Create program</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

              
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- end main wrapper-->

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

  
</body>
</html>
