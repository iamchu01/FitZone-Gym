<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<head>

    <title>Clients - HRMS admin template</title>

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
                        <h3 class="page-title">Member</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Member</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_instructor"><i class="fa fa-plus"></i> Add Client</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-md-6 col-md-3">  
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Search</label>
                    </div>
                </div>    
            </div>
            <!-- Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Client ID</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="client-profile.php" class="avatar"><img src="assets/img/profiles/avatar-19.jpg" alt=""></a>
                                            <a href="client-profile.php">Global Technologies</a>
                                        </h2>
                                    </td>
                                    <td>CLT-0001</td>
                                    <td>Barry Cuda</td>
                                    <td>barrycuda@example.com</td>
                                    <td>9876543210</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a href="#" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Active </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#archive_instructor"><i class="fa fa-trash-o m-r-5"></i> Archive</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    
          <!-- //* add instructor modal -->
                    <div id="add_instructor" class="modal custom-modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                        <h5 class="modal-title">Add Instructor</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <!-- //* Add Instructor Form -->
                                   <form id="addUserForm" class="needs-validation instructor-info" novalidate method="POST" action="">
                                    <div class="row">

                                        <!-- //* firstname -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input id="firstname" class="form-control" type="text" name="firstname" placeholder="Enter First Name" required pattern="[A-Za-z\s]+">
                                                <div class="invalid-feedback">Please enter a valid first name.</div>
                                            </div>
                                        </div>

                                        <!-- //* middlename -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Middle Name <span style="color: gray;">(Optional)</span> </label>
                                                <input id="middlename" class="form-control" type="text" name="middlename" placeholder="Enter Middle Name" pattern="[A-Za-z\s]+">
                                                <div class="invalid-feedback">Please enter a valid middle name.</div>
                                            </div>
                                        </div>

                                        <!-- //* lastname -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input id="lastname" class="form-control" type="text" name="lastname" placeholder="Enter Last Name" required pattern="[A-Za-z\s]+">
                                                <div class="invalid-feedback">Please enter a valid last name.</div>
                                            </div>
                                        </div>

                                        <!-- //* phone number -->
                                        <div class="col-sm-6">
                                                    <label>Mobile Number <span style="color:red;">*</span></label>
                                                    <div class="form-group">
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend">+63</span>
                                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="ex. 9123456789" required minlength="10" maxlength="10" pattern="9[0-9]{9}">
                                                            <div class="invalid-feedback">Please enter a valid mobile number.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <!-- //* Gender -->
                                            <div class="col-sm-6" >
                                                <div class="form-group mb-2" >
                                                    <label>Gender <span style="color:red;">*</span></label>
                                                    <div class="position-relative" >
                                                        <select class="form-select py-2" name="Gender" id="gender-selector" required>
                                                        <option value="" disabled selected >Select Gender</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- //* date of birth -->
                                            <div class="col-sm-6">
                                                <div class="form-group mb-2">
                                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                                    <div class="cal-icon">
                                                        <input type="text" id="dateOfBirth" class="form-control datetimepicker" name="dateOfBirth" placeholder="Select Date of Birth" required>
                                                        <small id="dateWarning" class="text-danger" style="display: none;">Please select a valid date of birth.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- //* age -->
                                            <div class="col-sm-6">
                                                <div class="form-group mb-2">
                                                    <label>Age</label>
                                                    <input type="text" id="age" name="instructor_age" class="form-control" placeholder="Age" readonly>
                                                </div>
                                            </div>

                                             <!-- Address Form -->
                                                       <div class="col-sm-6">
                                                                 <div class="form-group">
                                                                      <label for="region">Region <span class="text-danger">*</span></label>
                                                                      <select id="region" class="form-select" name="region" required>
                                                                           <option value="" disabled selected>Select Region</option>
                                                                           <!-- Populate regions dynamically -->
                                                                      </select>
                                                                      <input type="hidden" name="region_text" id="region-text">
                                                                      <div class="invalid-feedback">Please select a region.</div>
                                                                 </div>
                                                       </div>

                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <label for="province">Province <span class="text-danger">*</span></label>
                                                                 <select id="province" class="form-select" name="province" required>
                                                                      <option value="" disabled selected>Select Province</option>
                                                                      <!-- Populate provinces dynamically -->
                                                                 </select>
                                                                 <input type="hidden" name="province_text" id="province-text">
                                                                 <div class="invalid-feedback">Please select a province.</div>
                                                            </div>
                                                       </div>

                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                                 <label for="city">City/Municipality <span class="text-danger">*</span></label>
                                                                 <select id="city" class="form-select" name="city" required>
                                                                      <option value="" disabled selected>Select City/Municipality</option>
                                                                      <!-- Populate cities dynamically -->
                                                                 </select>
                                                                 <input type="hidden" name="city_text" id="city-text">
                                                                 <div class="invalid-feedback">Please select a city or municipality.</div>
                                                            </div>
                                                       </div>

                                                  <div class="col-sm-6">
                                                       <div class="form-group">
                                                            <label for="barangay">Barangay <span class="text-danger">*</span></label>
                                                            <select id="barangay" class="form-select" name="barangay" required>
                                                                 <option value="" disabled selected>Select Barangay</option>
                                                                 <!-- Populate barangays dynamically -->
                                                            </select>
                                                            <input type="hidden" name="barangay_text" id="barangay-text">
                                                            <div class="invalid-feedback">Please select a barangay.</div>
                                                  </div>
                                             </div>

                                        <!-- //* new specialized field -->
                                        <div class="form-group mt-3">
                                            <label>Specialization <span class="text-danger">*</span></label>
                                            <div class="position-relative" >
                                                <!-- Textarea for entering multiple specializations -->
                                                <textarea class="form-control" id="specializationTextarea" name="specialization" rows="4" placeholder="Enter specializations, separated by commas or new lines" required></textarea>
                                            </div>
                                        </div>
                                        <!-- //* new specialized field -->

                                    </div>

                                        <div class="submit-section" style="margin-top: 10px;">
                                            <button class="btn btn-primary submit-btn" type="submit">Add Instructor</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //* add instructor modal -->
        
        
        <!-- Archive instructor modal -->
        <div class="modal custom-modal fade" id="archive_instructor" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Archive Instructor</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Archive</a>
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
        <!-- /Archive instructor modal -->
        
    </div>
    <!-- /Page Wrapper -->


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


<!-- //* Reset all fields when add modal is closed. -->
<script>
        // Reset form fields when modal is closed
    document.getElementById('add_instructor').addEventListener('hidden.bs.modal', function () {
        // Reset the form fields
        document.getElementById('addUserForm').reset();

        // Clear the age field
        document.getElementById('age').value = '';

        // Reset specialization dropdown button text
        document.getElementById('specializationDropdownButton').textContent = 'Select Specialization';

        // Uncheck all checkboxes in the specialization list
        document.querySelectorAll('#specialization-list input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });

        // Hide the "Create New" input container if it was open
        document.getElementById('addNewInputContainer').style.display = 'none';
        document.getElementById('add-new-specialization').style.display = 'block';
    });
</script>

<!-- //* Calculate age based on date of birth -->
<script>
    $(document).ready(function () {
        // Initialize datepicker with minDate and maxDate
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: new Date(), // Restrict future dates
            minDate: '1924-01-01' // Restrict dates before 1924
        });

        // Simplified function to calculate age in years only
        function calculateAge(birthdate) {
            const birthDate = new Date(birthdate);
            const today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            
            // Adjust if birthdate hasn't occurred this year yet
            if (today.getMonth() < birthDate.getMonth() || 
                (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return `${age} year${age > 1 ? 's' : ''} old`;
        }

        // Handle date change and validate date range
        $('.datetimepicker').on('dp.change', function (e) {
            if (e.date) {
                const selectedDate = e.date.toDate(); // Convert to JavaScript Date object
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Set time to midnight for accurate comparison

                const minDate = new Date('1924-01-01');

                // Check if the selected date is within the current year
                if (selectedDate.getFullYear() === today.getFullYear()) {
                    $('#dateWarning').text("Please select a valid date of birth.").show();
                    $(this).data("DateTimePicker").clear(); // Clear the selected date
                    $('#age').val(''); // Clear the age field
                    return;
                } else if (selectedDate > today || selectedDate < minDate) {
                    $('#dateWarning').text("Please select a valid date of birth.").show();
                    $(this).data("DateTimePicker").clear(); // Clear the selected date
                    $('#age').val(''); // Clear the age field
                    return;
                } else {
                    $('#dateWarning').hide(); // Hide the warning message
                }

                const age = calculateAge(e.date.format('YYYY-MM-DD'));
                $('#age').val(age);
            } else {
                // Clear the age field if no date is selected
                $('#age').val('');
            }
        });
    });
</script>


</body>

</html>