<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<?php
// Check if form is submitted (this will handle form submission through AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and validate
    $errors = [];
    $firstname = trim($_POST['first_name']);
    $lastname = trim($_POST['last_name']);
    $middlename = trim($_POST['middle_name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phonenumber = preg_match('/^[0-9]{10}$/', $_POST['phone']) ? $_POST['phone'] : null;
    $age = intval($_POST['age']);
    $specialization = trim($_POST['specialization']);
    $region = trim($_POST['region_text']);
    $province = trim($_POST['province_text']);
    $city = trim($_POST['city_text']);
    $barangay = trim($_POST['barangay_text']);

    // Validate required fields
    if (!$firstname || !$lastname || !$email || !$phonenumber || !$age || !$specialization || !$region || !$province || !$city || !$barangay) {
        $errors[] = "Please fill all the required fields.";
    }

    // Additional validations
    if ($age < 18) {
        $errors[] = "The instructor must be at least 18 years old.";
    }

    if (!$email) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!$phonenumber) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit();
    }

    // Insert data into database if validation passes
    $sql = "INSERT INTO instructors (firstname, lastname, middlename, email, phonenumber, age, specialization, region, province, city, barangay) 
            VALUES ('$firstname', '$lastname', '$middlename', '$email', '$phonenumber', '$age', '$specialization', '$region', '$province', '$city', '$barangay')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
        exit();
    } else {
        echo json_encode(['status' => 'error', 'errors' => [$conn->error]]);
        exit();
    }
}
?>


<head>
    <title>Instructor List - Gym Management System</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Instructors</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Instructor</li>
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
                            <label class="focus-label">Instructor ID</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Instructor Name</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">  
                        <a href="#" class="btn btn-primary w-100">Search</a>  
                    </div>     
                    <div class="col-sm-6 col-md-3"> 
                        <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add_instructor"><i class="fa fa-plus"></i> Add Instructor</a>
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
                                        <th>Instructor ID</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Specialization</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch instructors from the database
                                    $sql = "SELECT * FROM instructors";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td>
                                                    <h2 class='table-avatar'>
                                                        <a href='profile.php' class='avatar'><img alt='' src='assets/img/profiles/avatar-02.jpg'></a>
                                                        <a href='profile.php'>" . $row["firstname"] . " " . $row["lastname"] . "</a>
                                                    </h2>
                                                </td>
                                                <td>INS-" . $row["id"] . "</td>
                                                <td>" . $row["email"] . "</td>
                                                <td>" . $row["phonenumber"] . "</td>
                                                <td>" . $row["specialization"] . "</td>
                                                <td class='text-end'>
                                                    <div class='dropdown dropdown-action'>
                                                        <a href='#' class='action-icon dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'><i class='material-icons'>more_vert</i></a>
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a class='dropdown-item edit-instructor' href='#' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#edit_instructor'><i class='fa fa-pencil m-r-5'></i> Edit</a>
                                                            <a class='dropdown-item' href='#' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#archive_instructor' onclick='setArchiveId(" . $row['id'] . ")'>
                                                            <i class='fa fa-trash-o m-r-5'></i> Archive</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No instructors found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Data Table -->
            </div>

            <!-- Add Instructor Modal -->
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
                            <form id="addInstructorForm" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="last_name" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Middle Name</label>
                                            <input class="form-control" type="text" name="middle_name" placeholder="Enter middle name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input class="form-control" type="tel" name="phone" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Age <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="age" placeholder="Enter age" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Specialization <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="specialization" placeholder="Enter specialization" required>
                                        </div>
                                    </div>

                                    <!-- Address Fields -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Region <span class="text-danger">*</span></label>
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
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn mb-3" type="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add Instructor Modal -->

            <!-- Edit Instructor Modal -->
            <div id="edit_instructor" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Instructor</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editInstructorForm" method="POST">
                                <input type="hidden" name="edit_id" id="edit_instructor_id">
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
                                            <input class="form-control" type="tel" name="phone" id="edit_phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Age</label>
                                            <input class="form-control" type="number" name="age" id="edit_age">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Specialization</label>
                                            <input class="form-control" type="text" name="specialization" id="edit_specialization">
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
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn mb-3" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Edit Instructor Modal -->

            <!-- Archive Instructor Modal -->
            <div id="archive_instructor" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Archive Instructor</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to archive this instructor?</p>
                            <form id="archiveInstructorForm">
                                <input type="hidden" name="archive_instructor_id" id="archive_instructor_id">
                                <div class="submit-section">
                                    <button class="btn btn-danger" type="submit">Archive</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Archive Instructor Modal -->
        </div>
    </div>
    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

    <script>
$(document).ready(function () {
    // Handle form submission with AJAX
    $('#addInstructorForm').on('submit', function (e) {
        e.preventDefault();

        // Client-side validation
        let errors = [];
        const email = $("input[name='email']").val();
        const phone = $("input[name='phone']").val();
        const age = $("input[name='age']").val();
        
        if (!validateEmail(email)) {
            errors.push('Please enter a valid email.');
        }

        if (!validatePhone(phone)) {
            errors.push('Please enter a valid 10-digit phone number.');
        }

        if (age < 18) {
            errors.push('Instructor must be at least 18 years old.');
        }

        // If errors exist, display them
        if (errors.length > 0) {
            alert(errors.join("\n"));
            return;
        }

        // AJAX request to submit form
        $.ajax({
            url: '',  // Current PHP page handles the form submission
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert("Instructor added successfully!");
                    location.reload();  // Reload the page after successful submission
                } else if (response.status === 'error') {
                    alert(response.errors.join("\n"));  // Show error messages
                }
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });

    // Email validation
    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }

    // Phone validation (for a 10-digit phone number)
    function validatePhone(phone) {
        return /^[0-9]{10}$/.test(phone);
    }
});
</script>

</body>
</html>
