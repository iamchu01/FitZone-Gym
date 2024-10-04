<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>
<head>
    

    <title>Form Basic Input - HRMS admin template</title>

    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>


</head>

<body>
    <div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Special program</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="offered-programs.php">Program list</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#">
                            <div class="form-group row">
                                    <label class="col-form-label col-md-2">Program profile</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="file">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Program Title</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Select Trainer</label>
                                    <div class="col-md-10">
                                        <select class="form-control">
                                            <option value="">Select a trainer</option>
                                            <option value="trainer1">Trainer 1</option>
                                            <option value="trainer2">Trainer 2</option>
                                            <option value="trainer3">Trainer 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Slots</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Program Duration (days)</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                            <label class="col-form-label col-md-2">Membership Fee</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Enter amount">
                                </div>
                            </div>
                        </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Program Description</label>
                                    <div class="col-md-10">
                                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter text here"></textarea>
                                    </div>
                                </div>
                                
                                                              
                            </div>
                        </div>
                                <div class="form-group mb-0 row">
                                    <dclass="col-md-10">
                                        <div class="input-group">
                                            <button class="btn btn-primary" type="button">Create Program</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        
        </div>          
    </div>

</div>

</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>




</body>

</html>