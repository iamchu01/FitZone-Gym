<?php 
    include 'layouts/session.php';
    include 'layouts/head-main.php';
    include 'layouts/db-connection.php';
    require 'vendor/autoload.php'; 
    use Coreproc\MsisdnPh\Msisdn;

    $mobileError = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobileNumber = $_POST['mobile'] ?? '';

    // Validate the phone number
    if (Msisdn::validate($mobileNumber)) {
        // Format the number in the standardized form
        $msisdn = new Msisdn($mobileNumber);
        $formattedNumber = $msisdn->get(true); // returns +639 format
    } else {
        $mobileError = 'Invalid mobile number. Please enter a valid Philippine phone number.';
    }
}
?>

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
                        <h3 class="page-title">Instructor</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Instructor</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                         <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_instructor"><i class="fa fa-plus"></i>Add Instructor</a>
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
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
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
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_client"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_client"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
    
        <!-- //* Add Instructor Modal -->
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
               <form id="addUserForm" class="needs-validation" novalidate method="POST" action="">
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
                              <label>Middle Name <span class="text-danger">*</span></label>
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
                                            <label>Phone Number <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="input-group has-validation">
                                                    <!-- <span class="input-group-text" id="inputGroupPrepend">+63</span> -->
                                                    <input type="text" class="form-control <?php echo $mobileError ? 'is-invalid' : ''; ?>" id="mobile" name="mobile" placeholder="ex. 09123456789 or +639123456789" required>
                                                    <div class="invalid-feedback">
                                                        <?php echo $mobileError ?: 'Please enter a valid Philippine phone number.'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                        <!-- //* Gender -->
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label>Gender <span style="color:red;">*</span></label>
                                <div class="position-relative">
                                    <select class="form-select py-2" name="Gender" required>
                                    <option value="" disabled selected>Select Gender</option>
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
                                <input type="date" id="dateOfBirth" class="form-control" placeholder="Select Date of Birth" onchange="calculateAge()">
                            </div>
                        </div>

                        <!-- //* age -->
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label>Age</label>
                                <input type="text" id="age" class="form-control" placeholder="Age" readonly>
                            </div>
                        </div>

                         <!-- //* address -->
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                         <label>Address <span class="text-danger">*</span></label>
                         <input id="autocomplete" class="form-control" type="text" name="address" required autocomplete="off">
                         <div class="invalid-feedback">Please enter a valid address.</div>
                         </div>
                    </div>

                        <!-- //* Specialization-->
                    <div class="form-group mt-3">
                        <!-- <div class="form-group mb-2"> -->
                            <label>Specialization <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <div class="dropdown">
                                    <button class="form-select py-3" type="button" id="specializationDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Specialization
                                    </button>
                                    <div class="dropdown-menu p-2" id="specializationDropdownMenu" style="width: 100%; max-height: 200px; overflow-y: auto;">
                                        <!-- Search bar inside the dropdown -->
                                        <input type="text" id="specialization-search" class="form-control mb-2" placeholder="Search Specialization">

                                        <!-- Option to trigger add new specialization under the search bar -->
                                        <a href="#" id="add-new-specialization" class="dropdown-item text-primary">+ Create New</a>

                                        <!-- Add New Specialization Input Container, initially hidden -->
                                        <div id="addNewInputContainer" class="mt-2" style="display: none;">
                                            <input type="text" id="newSpecializationInput" class="form-control mb-1" placeholder="Enter new specialization"> 
                                            <button type="button" class="btn btn-primary btn-sm" id="addSpecializationButton">Add</button>
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="cancelAdd(event)">Cancel</button>
                                        </div>

                                        <!-- Specializations list with checkboxes -->
                                        <ul id="specialization-list" class="list-unstyled mt-2">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>   
               </div>

                <div class="submit-section" style="margin-top: 10px;">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->

    </div>
</form>
            </div>
        </div>
    </div>
</div>
        <!-- /Add Client Modal -->
        
    </div>
    <!-- /Page Wrapper -->


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


//* Specialization
<script>
    // Prevent dropdown from closing when clicking "+ Create New"
    document.getElementById('add-new-specialization').addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation(); // Prevents dropdown from closing
        document.getElementById('addNewInputContainer').style.display = 'block';
        this.style.display = 'none'; // Hide "+ Create New" link
        document.getElementById('newSpecializationInput').focus(); // Focus the input field
    });

    // Prevent dropdown from closing when clicking on any specialization item
    function itemClicked(event) {
        event.stopPropagation(); // Prevent dropdown from closing
    }

    // Add new specialization
    document.getElementById('addSpecializationButton').addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent dropdown from closing
        const newSpecializationInput = document.getElementById('newSpecializationInput');
        const newSpecialization = newSpecializationInput.value.trim();

        if (newSpecialization) {
            // Create a new list item element with a checkbox
            const listItem = document.createElement('li');
            listItem.innerHTML = `<label class="dropdown-item" onclick="itemClicked(event)">
                <input type="checkbox" value="${newSpecialization}" onclick="updateSelection()"> ${newSpecialization}
            </label>`;

            // Insert the new option before the "+ Create New" link
            const specializationList = document.getElementById('specialization-list');
            specializationList.insertBefore(listItem, specializationList.firstChild);

            // Reset input field and keep the dropdown open
            newSpecializationInput.value = '';
            document.getElementById('addNewInputContainer').style.display = 'none';
            document.getElementById('add-new-specialization').style.display = 'block';

            // Update selection display
            updateSelection();
        }
    });

    // Close "Create New" field when focus is lost
    document.getElementById('newSpecializationInput').addEventListener('blur', function (e) {
        setTimeout(() => {
            document.getElementById('addNewInputContainer').style.display = 'none';
            document.getElementById('add-new-specialization').style.display = 'block';
            e.target.value = ''; // Clear the input field
        }, 150);
    });

    // Cancel adding new specialization
    function cancelAdd(event) {
        event.stopPropagation(); // Prevent dropdown from closing
        document.getElementById('newSpecializationInput').value = '';
        document.getElementById('addNewInputContainer').style.display = 'none';
        document.getElementById('add-new-specialization').style.display = 'block';
    }

    // Filter options based on search input
    document.getElementById('specialization-search').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const listItems = document.querySelectorAll('#specialization-list li');

        listItems.forEach(function (item) {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Update button text based on selected checkboxes
    function updateSelection() {
        const selected = [];
        document.querySelectorAll('#specialization-list input[type="checkbox"]:checked').forEach((checkbox) => {
            selected.push(checkbox.value);
        });

        const dropdownButton = document.getElementById('specializationDropdownButton');
        dropdownButton.textContent = selected.length > 0 ? selected.join(', ') : 'Select Specialization';
    }
</script>

//* Calculate age based on date of birth
<script>
    function calculateAge() {
        const dobInput = document.getElementById('dateOfBirth').value;
        const dob = new Date(dobInput);
        const today = new Date();

        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();

        // Adjust age if the birth month and day haven't occurred yet this year
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        // Display the calculated age in the age field
        document.getElementById('age').value = age >= 0 ? age : '';
    }
</script>


//* Reset all fields when add modal is closed.
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

//* Phone Number validation
<script>
        // Restrict the input field to numbers only
        document.getElementById('mobile').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+]/g, ''); // Allows only numbers and '+'
        });

        // Show error if the mobile field is invalid on blur
        document.getElementById('mobile').addEventListener('blur', function(e) {
            const mobileNumber = this.value;
            if (mobileNumber && !/^(\+639|09)\d{9}$/.test(mobileNumber)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
</script>


</body>

</html>