<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<?php
// Check if form is submitted (this will handle form submission through AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $middlename = $_POST['middle_name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone'];
    $age = $_POST['age'];
    $region = $_POST['region_text'];  // Changed to take the value as per your original design
    $province = $_POST['province_text'];  // Same here
    $city = $_POST['city_text'];  // Same here
    $barangay = $_POST['barangay_text'];  // Same here

    // Insert data into database
    $sql = "INSERT INTO members (firstname, lastname, middlename, email, phonenumber, age, region, province, city, barangay) 
            VALUES ('$firstname', '$lastname', '$middlename', '$email', '$phonenumber', '$age', '$region', '$province', '$city', '$barangay')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $response = array(
            "id" => $last_id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "phonenumber" => $phonenumber
        );
        echo json_encode($response); // Return the new member details as JSON
        exit();
    } else {
        echo json_encode(array("error" => $conn->error));
        exit();
    }
}
?>


<head>
    <title>Member List - Gym Management System</title>

    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>
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
                                <li class="breadcrumb-item active">Add Member</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <!-- Search Filter -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Member ID</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Member Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-primary w-100">Search</a>  
                    </div>     
                    <div class="col-sm-6 col-md-3"> 
                        <a href="#" class="btn btn-primary w-100 " data-bs-toggle="modal" data-bs-target="#add_member"><i class="fa fa-plus"></i> Add Member</a>
                    </div>
                </div>
                <!-- /Search Filter -->
                
                <!-- Data Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th class="text-nowrap">Join Date</th>
                                        <th>Membership Status</th>
                                        <th class="text-end no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch members from the database
                                    $sql = "SELECT * FROM members";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data for each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td>
                                                    <h2 class='table-avatar'>
                                                        <a href='profile.php' class='avatar'><img alt='' src='assets/img/profiles/avatar-02.jpg'></a>
                                                        <a href='profile.php'>" . $row["firstname"] . " " . $row["lastname"] . "</a>
                                                    </h2>
                                                </td>
                                                <td>MEM-" . $row["id"] . "</td>
                                                <td>" . $row["email"] . "</td>
                                                <td>" . $row["phonenumber"] . "</td>
                                                <td>" . date('d M Y', strtotime($row["created_at"])) . "</td>
                                                <td><a class='btn bg-danger btn-sm text-white avail-subscription-btn' data-id='" . $row["id"] . "' data-bs-toggle='modal' data-bs-target='#subscriptionModal'>No Membership</a></td>
                                                <td class='text-end'>
                                                    <div class='dropdown dropdown-action'>
                                                        <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a class='dropdown-item edit-member' href='#' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#edit_member'><i class='fa fa-pencil m-r-5'></i> Edit</a>
                                                            <a class='dropdown-item' href='#' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#archive_member' onclick='setArchiveId(" . $row['id'] . ")'>
                                                            <i class='fa fa-trash-o m-r-5'></i>Archive</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No members found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Data Table -->
            </div>
            <!-- /Page Content -->
            
            <!-- Add Member Modal -->
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
                            <form id="addMemberForm" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" id="firstName" placeholder="Enter first name" required oninput="validateName('firstName')">
                                            <small id="firstNameWarning" class="text-danger" style="display:none;">Please enter a valid first name (letters only).</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name <span class="text-danger">*</span> </label>
                                            <input class="form-control" type="text" name="last_name" id="lastName" placeholder="Enter last name" oninput="validateName('lastName')">
                                            <small id="lastNameWarning" class="text-danger" style="display:none;">Please enter a valid last name (letters only).</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Middle Name</label>
                                            <input class="form-control" type="text" name="middle_name" id="middleName" placeholder="Enter middle name" required oninput="validateName('middleName')">
                                            <small id="middleNameWarning" class="text-danger" style="display:none;">Please enter a valid middle name (letters only).</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" id="emailInput" placeholder="Enter a valid email" required oninput="validateEmail('emailInput')">
                                            <small id="emailWarning" class="text-danger" style="display:none;">Please enter a valid email address.</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">+63</span>
                                                <input type="tel" class="form-control" name="phone" id="phoneNumber" placeholder="" maxlength="10" required oninput="validatePhoneNumber(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Age <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="age" id="ageInput" placeholder="Enter age" required oninput="validateAge('ageInput')">
                                            <small id="ageWarning" class="text-danger" style="display:none;">You must be at least 15 years old.</small>
                                        </div>
                                    </div>

                                    <!-- Address Fields -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Region <span class="text-danger">*</span> </label>
                                            <select name="region" class="form-control form-control-md" id="region"></select>
                                            <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Province <span class="text-danger">*</span></label>
                                            <select name="province" class="form-control form-control-md" id="province"></select>
                                            <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">City / Municipality <span class="text-danger">*</span></label>
                                            <select name="city" class="form-control form-control-md" id="city"></select>
                                            <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Barangay <span class="text-danger">*</span></label>
                                            <select name="barangay" class="form-control form-control-md" id="barangay"></select>
                                            <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
                                        </div>
                                    </div>
                                    <!-- End Address Fields -->
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn mb-3" type="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Member Modal -->

            <!-- Edit Member Modal -->
            <div id="edit_member" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Member</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editMemberForm" method="POST">
                                <input type="hidden" name="edit_id" id="edit_member_id">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" id="edit_first_name" required oninput="validateName('edit_first_name')">
                                            <small id="edit_first_nameWarning" class="text-danger" style="display:none;">Please enter a valid first name (letters only).</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" id="edit_last_name" oninput="validateName('edit_last_name')">
                                            <small id="edit_last_nameWarning" class="text-danger" style="display:none;">Please enter a valid last name (letters only).</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Middle Name</label>
                                            <input class="form-control" type="text" name="middle_name" id="edit_middle_name" oninput="validateName('edit_middle_name')">
                                            <small id="edit_middle_nameWarning" class="text-danger" style="display:none;">Please enter a valid middle name (letters only).</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" id="edit_email" required oninput="validateEditEmail()">
                                            <small id="edit_emailWarning" class="text-danger" style="display:none;">Please enter a valid email address.</small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+63</span>
                                                <input class="form-control" type="tel" name="phone" id="edit_phone" placeholder="" maxlength="10" oninput="validatePhoneNumber(this)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Age</label>
                                            <input class="form-control" type="number" name="age" id="edit_age" placeholder="Enter age" oninput="validateEditAge()">
                                            <small id="edit_ageWarning" class="text-danger" style="display:none;">You must be at least 15 years old.</small>
                                        </div>
                                    </div>

                                    <!-- Address Fields -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Region</label>
                                            <input class="form-control" type="text" name="region" id="edit_region"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Province</label>
                                            <input class="form-control" type="text" name="province" id="edit_province"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">City / Municipality</label>
                                            <input class="form-control" type="text" name="city" id="edit_city"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Barangay</label>
                                            <input class="form-control" type="text" name="barangay" id="edit_barangay"> 
                                        </div>
                                    </div>
                                    <!-- End Address Fields -->
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn mb-3" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Member Modal -->

            <!-- Archive Member Modal -->
            <div id="archive_member" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Archive Member</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to archive this member?</p>
                            <form id="archiveMemberForm" >
                                <input type="hidden" name="archive_member_id" id="archive_member_id">
                                <div class="submit-section">
                                    <button class="btn btn-danger" type="submit">Archive</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Archive Member Modal -->

            <!-- Subscription Modal -->
            <div id="subscriptionModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Avail Subscription</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Please select a subscription plan for the member.</p>
                            <form id="subscriptionForm">
                                <input type="hidden" name="member_id" id="subscription_member_id" />

                                <!-- Pricing Type Selection -->
                                <div class="form-group">
                                    <label for="pricing_type">Select Pricing Type</label>
                                    <select class="form-control" id="pricing_type" name="pricing_type" required>
                                        <option value="Regular">Regular</option>
                                        <option value="Student">Student</option>
                                    </select>
                                </div>

                                <!-- Subscription Plan Selection (Prices will update dynamically) -->
                                <div class="form-group">
                                    <label for="subscription_plan">Select Subscription Plan</label>
                                    <select class="form-control" id="subscription_plan" name="subscription_plan" required>
                                        <!-- Options will be dynamically updated based on pricing type -->
                                    </select>
                                </div>

                                <!-- Payment Method -->
                                <div class="form-group">
                                    <label for="payment_method">Select Payment Method</label>
                                    <select class="form-control" id="payment_method" name="payment_method" required>
                                        <option value="Cash">Cash</option>
                                        <option value="Gcash">Gcash</option>
                                    </select>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Subscription Modal -->





        </div>
    </div>
    <!-- /Main Wrapper -->

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('.datatable').DataTable();

        // Handle form submission with AJAX for adding member
        $('#addMemberForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // AJAX request to add the member
            $.ajax({
                url: '',  // Current PHP page handles the form submission
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Close the modal
                    $('#add_member').modal('hide');

                    // Parse response (expecting JSON)
                    var member = JSON.parse(response);

                    // Add new row to the DataTable
                    table.row.add([
                        '<h2 class="table-avatar"><a href="profile.php" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a><a href="profile.php">' + member.firstname + ' ' + member.lastname + '</a></h2>',
                        'MEM-' + member.id,
                        member.email,
                        member.phonenumber,
                        new Date().toLocaleDateString(), // Date added
                        '<a class="btn bg-info btn-sm text-dark" style="cursor: default; pointer-events: none; color: white;">No Membership</a>',
                        '<div class="dropdown dropdown-action">' +
                            '<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                                '<a class="dropdown-item edit-member" href="#" data-id="' + member.id + '" data-bs-toggle="modal" data-bs-target="#edit_member"><i class="fa fa-pencil m-r-5"></i> Edit</a>' +
                                '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_member"><i class="fa fa-trash-o m-r-5"></i> Archive</a>' +
                            '</div>' +
                        '</div>'
                    ]).draw(false);  // Redraw the table
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
        
    });

$(document).ready(function() {
    // Handle Edit button click
    $(document).on('click', '.edit-member', function() {
        var memberId = $(this).data('id');  // Get the member ID

        // AJAX request to fetch the member data
        $.ajax({
            url: 'fetch_member.php',  // This PHP file will return member data as JSON
            type: 'GET',
            data: { id: memberId },
            success: function(response) {
                var member = JSON.parse(response);  // Parse the response

                if (member.error) {
                    alert("Member not found");
                } else {
                    // Populate the modal fields with the member data
                    $('#edit_member_id').val(member.id);
                    $('#edit_first_name').val(member.firstname);
                    $('#edit_last_name').val(member.lastname);
                    $('#edit_middle_name').val(member.middlename);
                    $('#edit_email').val(member.email);
                    $('#edit_phone').val(member.phonenumber);
                    $('#edit_age').val(member.age);

                    // Populate the address fields
                    $('#edit_region').val(member.region);         // Text or Dropdown
                    $('#edit_province').val(member.province);     // Text or Dropdown
                    $('#edit_city').val(member.city);             // Text or Dropdown
                    $('#edit_barangay').val(member.barangay);     // Text or Dropdown

                    // Show the modal
                    $('#edit_member').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });
});





$(document).ready(function() {
    // Subscription plans for Regular and Student pricing
    const pricingOptions = {
        Regular: [
            { value: 'Weekly', text: 'Weekly - ₱250' },
            { value: 'Half Month', text: 'Half Month - ₱450' },
            { value: 'Monthly', text: 'Monthly - ₱800' }
            
        ],
        Student: [
            { value: 'Weekly', text: 'Weekly - ₱200' },
            { value: 'Half Month', text: 'Half Month - ₱350' },
            { value: 'Monthly', text: 'Monthly - ₱600' }
            
        ]
    };

    // Handle "No Membership" button click to open the subscription modal
    $(document).on('click', '.avail-subscription-btn', function() {
        var memberId = $(this).data('id');  // Get the member ID
        $('#subscription_member_id').val(memberId);  // Set member ID in hidden input
    });

    // Dynamically update subscription plans based on selected pricing type
    $('#pricing_type').on('change', function() {
        var pricingType = $(this).val();  // Get selected pricing type
        var subscriptionPlanSelect = $('#subscription_plan');
        
        // Clear current options
        subscriptionPlanSelect.empty();

        // Populate with new options based on the selected pricing type
        pricingOptions[pricingType].forEach(function(option) {
            subscriptionPlanSelect.append(new Option(option.text, option.value));
        });
    });

    // Trigger change event to initialize the plan options on modal open
    $('#pricing_type').trigger('change');

    // Handle form submission (disabled for now)
    $('#subscriptionForm').on('submit', function(e) {
        e.preventDefault();
        // AJAX or further logic to process subscription can go here
    });
});


// * Add/Edit Modals
// * Function to validate name fields (First Name, Last Name, Middle Name) for both Add and Edit forms
function validateName(fieldId, isEdit = false) {
    const nameInput = document.getElementById(fieldId);
    const nameWarning = document.getElementById(`${fieldId}Warning`);
    const button = isEdit ? document.querySelector('#editMemberForm .submit-btn') : document.querySelector('#addMemberForm .submit-btn');
    const namePattern = /^[a-zA-Z\s]+$/; // Allow only letters and spaces

    const value = nameInput.value;

    if (value !== '') {
        if (!namePattern.test(value)) {
            nameWarning.style.display = "block"; // Show warning if the name is invalid
            button.disabled = true; // Disable the submit button
        } else {
            nameWarning.style.display = "none"; // Hide warning if the name is valid
            validateForm(isEdit); // Check if all required fields are valid
        }
    } else {
        nameWarning.style.display = "none"; // Hide warning if input is cleared
        button.disabled = true; // Disable the submit button if input is empty
    }
}

// Function to validate phone number for both Add and Edit forms
function validatePhoneNumber(input, isEdit = false) {
    const value = input.value;
    const button = isEdit ? document.querySelector('#editMemberForm .submit-btn') : document.querySelector('#addMemberForm .submit-btn');
    
    input.value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

    // Limit input to 10 digits
    if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);
    }

    // Disable button if phone number is not valid
    if (input.value.length !== 10) {
        button.disabled = true;
    }
}

// Function to validate age for both Add and Edit forms
function validateAge(inputId, isEdit = false) {
    const ageInput = document.getElementById(inputId);
    const ageWarning = document.getElementById(isEdit ? "editAgeWarning" : "ageWarning");
    const button = isEdit ? document.querySelector('#editMemberForm .submit-btn') : document.querySelector('#addMemberForm .submit-btn');

    const min = 15;
    const max = 100;
    const value = ageInput.value;

    if (value !== '') {
        if (value < min) {
            ageWarning.style.display = "block"; // Show warning
            button.disabled = true; // Disable the submit button
        } else if (value >= min && value <= max) {
            ageWarning.style.display = "none"; // Hide warning
            button.disabled = false; // Enable the submit button
        } else if (value > max) {
            ageInput.value = max; // Cap the age at max
        }
    } else {
        ageWarning.style.display = "none"; // Hide warning if input is cleared
        button.disabled = true; // Disable the submit button if input is empty
    }
}

// Function to validate email for both Add and Edit forms
function validateEmail(inputId, isEdit = false) {
    const emailInput = document.getElementById(inputId);
    const emailWarning = document.getElementById(isEdit ? "editEmailWarning" : "emailWarning");
    const button = isEdit ? document.querySelector('#editMemberForm .submit-btn') : document.querySelector('#addMemberForm .submit-btn');
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Basic email regex pattern

    const value = emailInput.value;

    if (value !== '') {
        if (!emailPattern.test(value)) {
            emailWarning.style.display = "block"; // Show warning if the email is invalid
            button.disabled = true; // Disable the submit button
        } else {
            emailWarning.style.display = "none"; // Hide warning if the email is valid
            button.disabled = false; // Enable the submit button
        }
    } else {
        emailWarning.style.display = "none"; // Hide warning if input is empty
        button.disabled = true; // Disable the submit button if input is empty
    }
}

// Prevent invalid characters in phone number and age inputs
document.querySelectorAll("input[type='tel'], input[type='number']").forEach(input => {
    input.addEventListener("keydown", function(event) {
        if (['e', 'E', '+', '-'].includes(event.key)) {
            event.preventDefault(); // Block these invalid characters
        }
    });
});

// Function to check if the entire form is valid for both Add and Edit forms
function validateForm(isEdit = false) {
    const firstName = document.getElementById(isEdit ? 'edit_first_name' : 'firstName').value;
    const middleName = document.getElementById(isEdit ? 'edit_middle_name' : 'middleName').value;
    const firstNameValid = /^[a-zA-Z\s]+$/.test(firstName);
    const middleNameValid = /^[a-zA-Z\s]+$/.test(middleName);

    const button = isEdit ? document.querySelector('#editMemberForm .submit-btn') : document.querySelector('#addMemberForm .submit-btn');

    if (firstNameValid && middleNameValid) {
        button.disabled = false; // Enable the submit button when form is valid
    } else {
        button.disabled = true; // Disable the submit button if form is invalid
    }
}

// Disable the buttons initially for both Add and Edit forms
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('#addMemberForm .submit-btn').disabled = true; // Disable the Add button on page load
    document.querySelector('#editMemberForm .submit-btn').disabled = true; // Disable the Edit button on page load
});


function validateEditEmail() {
    const emailInput = document.getElementById("edit_email");
    const emailWarning = document.getElementById("edit_emailWarning");
    const saveButton = document.querySelector('#editMemberForm .submit-btn');
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    const value = emailInput.value;

    if (value !== '') {
        if (!emailPattern.test(value)) {
            emailWarning.style.display = "block"; // Show warning if the email is invalid
            saveButton.disabled = true; // Disable the save button
        } else {
            emailWarning.style.display = "none"; // Hide warning if the email is valid
            enableSaveButton(); // Recheck form validity
        }
    } else {
        emailWarning.style.display = "none"; // Hide warning if input is cleared
        saveButton.disabled = true; // Disable save button if input is empty
    }
}

function validateEditAge() {
    const ageInput = document.getElementById("edit_age");
    const ageWarning = document.getElementById("edit_ageWarning");
    const saveButton = document.querySelector('#editMemberForm .submit-btn');

    const minAge = 15;
    const maxAge = 100;
    const value = ageInput.value;

    if (value !== '') {
        if (value < minAge) {
            ageWarning.style.display = "block"; // Show warning
            saveButton.disabled = true; // Disable the save button
        } else if (value >= minAge && value <= maxAge) {
            ageWarning.style.display = "none"; // Hide warning
            enableSaveButton(); // Recheck form validity
        } else if (value > maxAge) {
            ageInput.value = maxAge; // Cap the age at max
        }
    } else {
        ageWarning.style.display = "none"; // Hide warning if input is cleared
        saveButton.disabled = true; // Disable save button if input is empty
    }
}

function enableSaveButton() {
    const firstNameWarning = document.getElementById('edit_first_nameWarning').style.display;
    const lastNameWarning = document.getElementById('edit_last_nameWarning').style.display;
    const middleNameWarning = document.getElementById('edit_middle_nameWarning').style.display;
    const emailWarning = document.getElementById('edit_emailWarning').style.display;
    const ageWarning = document.getElementById('edit_ageWarning').style.display;

    const saveButton = document.querySelector('#editMemberForm .submit-btn');

    // Enable the save button only if all warnings are hidden
    if (firstNameWarning === "none" &&
        lastNameWarning === "none" &&
        middleNameWarning === "none" &&
        emailWarning === "none" &&
        ageWarning === "none") {
        saveButton.disabled = false; // Enable the save button
    } else {
        saveButton.disabled = true; // Disable the save button
    }
}

    </script>
</body>
</html>
