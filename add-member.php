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
                        <h3 class="page-title">Members</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Members</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                         <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_member"><i class="fa fa-plus"></i>Add Members</a>
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
    
        <!-- //* Add Member Modal -->
<div id="add_member" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Add Member</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
            <div class="modal-body">
                
                <!-- //* Add Member Form -->
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
                                   <span class="input-group-text" id="inputGroupPrepend">+63</span>
                                   <input type="text" class="form-control" id="mobile" name="mobile" placeholder="ex. 9123456789" required minlength="10" maxlength="10" pattern="9[0-9]{9}">
                                   <div class="invalid-feedback">Please enter a valid phone number.</div>
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
                                            <li><label class="dropdown-item" onclick="itemClicked(event)"><input type="checkbox" value="Trainer" onclick="updateSelection()"> Trainer</label></li>
                                            <li><label class="dropdown-item" onclick="itemClicked(event)"><input type="checkbox" value="Group Fitness" onclick="updateSelection()"> Group Fitness</label></li>
                                            <li><label class="dropdown-item" onclick="itemClicked(event)"><input type="checkbox" value="Strength and Conditioning" onclick="updateSelection()"> Strength and Conditioning</label></li>
                                            <li><label class="dropdown-item" onclick="itemClicked(event)"><input type="checkbox" value="Yoga Instructor" onclick="updateSelection()"> Yoga Instructor</label></li>
                                            <li><label class="dropdown-item" onclick="itemClicked(event)"><input type="checkbox" value="Combat Sports Training" onclick="updateSelection()"> Combat Sports Training</label></li>
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
        
        <!-- Edit Client Modal -->
        <div id="edit_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Client</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" value="Barry" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Last Name</label>
                                        <input class="form-control" value="Cuda" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                        <input class="form-control" value="barrycuda" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" value="barrycuda@example.com" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <input class="form-control" value="barrycuda" type="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Confirm Password</label>
                                        <input class="form-control" value="barrycuda" type="password">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label class="col-form-label">Client ID <span class="text-danger">*</span></label>
                                        <input class="form-control floating" value="CLT-0001" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone </label>
                                        <input class="form-control" value="9876543210" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Company Name</label>
                                        <input class="form-control" type="text" value="Global Technologies">
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-15">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Module Permission</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Write</th>
                                            <th class="text-center">Create</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center">Import</th>
                                            <th class="text-center">Export</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Projects</td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tasks</td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chat</td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Estimates</td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Invoices</td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Timing Sheets</td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                            <td class="text-center">
                                                <input checked="" type="checkbox">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Client Modal -->
        
        <!-- Delete Client Modal -->
        <div class="modal custom-modal fade" id="delete_client" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Client</h3>
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
        <!-- /Delete Client Modal -->
        
    </div>
    <!-- /Page Wrapper -->


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


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
</body>

</html>