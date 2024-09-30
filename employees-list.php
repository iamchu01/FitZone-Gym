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
                            <h3 class="page-title">Member List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Member List</li>
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
                        <a href="#" class="btn btn-success w-100">Search</a>  
                    </div>     
                    <div class="col-sm-6 col-md-3"> 
                        <a href="#" class="btn btn-success w-100 add-btn" data-bs-toggle="modal" data-bs-target="#add_member"><i class="fa fa-plus"></i> Add Member</a>
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
                                                <td><a class='btn bg-info btn-sm text-dark' style='cursor: default; pointer-events: none; color: white;'>Active</a></td>
                                                <td class='text-end'>
                                                    <div class='dropdown dropdown-action'>
                                                        <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a class='dropdown-item edit-member' href='#' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#edit_member'><i class='fa fa-pencil m-r-5'></i> Edit</a>
                                                            <a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#delete_member'><i class='fa fa-trash-o m-r-5'></i> Archive</a>
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
                                            <input class="form-control" type="text" name="first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" type="text" name="last_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Middle Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Age</label>
                                            <input class="form-control" type="number" name="age">
                                        </div>
                                    </div>

                                    <!-- Address Fields (Original as per your request) -->
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
            <!-- /Add Member Modal -->

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
                                <input class="form-control" type="text" name="first_name" id="edit_first_name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Last Name</label>
                                <input class="form-control" type="text" name="last_name" id="edit_last_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" id="edit_middle_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="edit_email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">  
                            <div class="form-group">
                                <label class="col-form-label">Phone Number</label>
                                <input class="form-control" type="text" name="phone" id="edit_phone">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Age</label>
                                <input class="form-control" type="number" name="age" id="edit_age">
                            </div>
                        </div>

                        <!-- Region, Province, City, Barangay Fields -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Region</label>
                                <input class="form-control" type="text" name="region" id="edit_region"> <!-- Ensure this is a simple text input -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Province</label>
                                <input class="form-control" type="text" name="province" id="edit_province"> <!-- Simple text input -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">City / Municipality</label>
                                <input class="form-control" type="text" name="city" id="edit_city"> <!-- Simple text input -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Barangay</label>
                                <input class="form-control" type="text" name="barangay" id="edit_barangay"> <!-- Simple text input -->
                            </div>
                        </div>
                        <!-- End Region, Province, City, Barangay Fields -->

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


        </div>
    </div>
    <!-- /Main Wrapper -->

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- DataTables JS -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="ph-address-selector.js"></script>

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


    </script>

</body>
</html>
