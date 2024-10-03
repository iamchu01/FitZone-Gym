<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Estimates - HRMS admin template</title>

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
                                <h3 class="page-title">Inventory</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Inventory</li>
                                </ul>
                            </div>
                            <div class="col-auto float-end ms-auto">
                                <a href="add-product.php" class="btn add-btn"><i class="fa fa-plus"></i> Add Product</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    
                    <!-- Search Filter -->
                  
                    <!-- /Search Filter -->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Product name</th>
                                            <th>Product quantity</th>
                                            <th>Expiry Date</th>
                                            <th>Price</th>
                                            <th class="text-end">Discription</th>
                                        </tr>
                                    </thead>
                                 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Content -->
                
                <!-- Delete Estimate Modal -->
                <div class="modal custom-modal fade" id="delete_estimate" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Estimate</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Delete Estimate Modal -->
            
            </div>
            <!-- /Page Wrapper -->


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>



</body>

</html>