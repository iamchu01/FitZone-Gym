<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Compose - HRMS admin template</title>

    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>
    <div class="main-wrapper">
    <?php include 'layouts/topbar.php'; ?>
    <?php include 'layouts/inbox_sidebar.php'; ?>
    <?php include 'layouts/two-col-sidebar.php'; ?>

   <!-- Page Wrapper -->
            <div class="page-wrapper">
            
                <!-- Page Content -->
                <div class="content container-fluid">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Compose</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Compose</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="email" placeholder="To" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Cc" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Bcc" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Subject" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control summernote" placeholder="Enter your message here"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="text-center">
                                                <button class="btn btn-primary"><span>Send</span> <i class="fa fa-send m-l-5"></i></button>
                                                <button class="btn btn-success m-l-5" type="button"><span>Draft</span> <i class="fa fa-floppy-o m-l-5"></i></button>
                                                <button class="btn btn-success m-l-5" type="button"><span>Delete</span> <i class="fa fa-trash-o m-l-5"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Content -->
                
            </div>
            <!-- /Page Wrapper -->


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>



</body>

</html>