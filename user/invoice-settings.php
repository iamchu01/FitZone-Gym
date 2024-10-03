<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Invoice Setting - HRMS admin template</title>

    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>
    <div class="main-wrapper">
    <?php include 'layouts/topbar.php'; ?>
    <?php include 'layouts/settings-sidebar.php'; ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Invoice Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <form>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Invoice prefix</label>
                            <div class="col-lg-9">
                                <input type="text" value="INV" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Invoice Logo</label>
                            <div class="col-lg-7">
                                <input type="file" class="form-control">
                                <span class="form-text text-muted">Recommended image size is 200px x 40px</span>
                            </div>
                            <div class="col-lg-2">
                                <div class="img-thumbnail float-end"><img src="assets/img/logo3.png" class="img-fluid" alt="" width="140" height="40"></div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->


</div>
<!-- end main content-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


</body>

</html>