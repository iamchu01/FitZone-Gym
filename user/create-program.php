<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

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
                        <h3 class="page-title">Customized Program</h3>
                        <ul class="breadcrumb">
                         
                            <li class="breadcrumb-item active">Create your own program</li>
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
                                    <label class="col-form-label col-md-2">program profile</label>
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
                                    <label class="col-form-label col-md-2">Program Description</label>
                                    <div class="col-md-10">
                                        <textarea rows="5" cols="5" class="form-control" placeholder="Enter text here"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                            <label for="program_duration">Program Duration (Weeks)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="button" id="decrement_duration">-</button>
                                </div>
                                <input type="text" class="input-group-prepend" id="program_duration" name="program_duration" placeholder="0" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="increment_duration">+</button>
                                </div>
                            </div>
                            
                        </div>  
                        <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Weeks</h4>
                            <div id="week-table-container"></div>
                        </div>
                        <div class="card-body">
                        
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
<!--create exercise per day -->
    <div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dayModalLabel">Day Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-between mb-2">
          <button type="button" class="btn btn-success" id="addExercise">+ Add Exercise</button>
          <button type="button" class="btn btn-danger" id="removeExercise">- Remove Exercise</button>
        </div>
        <div id="exerciseContainer"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add Plan</button>
      </div>
    </div>
  </div>
</div>


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/create-program.js"></script>




</body>

</html>