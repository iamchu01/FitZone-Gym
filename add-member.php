<?php
include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $first_name = $_POST['firstname'] ?? '';
    $middle_name = $_POST['middlename'] ?? '';
    $last_name = $_POST['lastname'] ?? '';
    $phone_number = $_POST['mobile'] ?? '';
    $gender = $_POST['Gender'] ?? '';
    $date_of_birth = DateTime::createFromFormat('m/d/Y', $_POST['dateOfBirth'])->format('Y-m-d');
    $age = $_POST['member_age'] ?? '';
    $location = $_POST['location_text'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = '1234'; // Default password
    $membership = $_POST['Membership'] ?? 'No Membership'; // Default value
    $status = $_POST['Status'] ?? 'Active'; // Default value

    // Insert into database
    $sql = "INSERT INTO tbl_members (first_name, middle_name, last_name, phone_number, date_of_birth, age, gender, location, email, membership, status, password, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $first_name, $middle_name, $last_name, $phone_number, $date_of_birth, $age, $gender, $location, $email, $membership, $status, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Member added successfully";
    } else {
        $_SESSION['message'] = "Failed to add member";
    }
    $stmt->close();

    // Redirect to avoid form resubmission
    header("Location: add-member.php");
    exit();
}
?>

<style>
    /* Additional Styles for Success Modal */
    #messageModal .modal-content {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    #messageModal .modal-header {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
    }
    #messageModal .modal-header .btn-close {
        background: black;
        opacity: 0.8;
    }
    #messageModal .modal-body {
        padding: 20px;
        font-size: 1rem;
        color: #333;
    }
    #messageModal .modal-footer {
        border-top: none;
        padding: 15px;
    }
    #messageModal .btn-primary {
        background-color: #4CAF50;
        border: none;
        padding: 8px 20px;
        font-size: 1rem;
    }
</style>

<head>
    <title>Members - HRMS admin template</title>
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
                            <li class="breadcrumb-item active">Member</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                         <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_member"><i class="fa fa-plus"></i>Add Member</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- //* search bar -->
            <div class="row filter-row">
                <div class="col-md-6 col-md-3">  
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Search</label>
                    </div>
                </div>    
            </div>
            <!-- //* search bar -->
            
            <!-- //* data table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table table-dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Membership</th>
                                    <th>Expiration Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="member-profile.php" class="avatar"><img src="assets/img/profiles/avatar-19.jpg" alt=""></a>
                                            <a href="member-profile.php">my fullname</a>
                                        </h2>
                                    </td>
                                    <td>barrycuda@example.com</td>
                                    <td><button class="btn btn-danger btn-sm">No Membership</button></td>
                                    <td>Free User</td>
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
            <!-- //* data table-->
            
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->

                    <!-- //* add member modal -->
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
                                   <form id="addMemberForm" class="needs-validation member-info" novalidate method="POST" action="">
                                    <div class="row">
                                        <!-- //* Firstname -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input id="firstname" class="form-control" type="text" name="firstname" placeholder="Enter First Name" required>
                                                <div class="invalid-feedback">Please enter a valid first name without numbers or symbols.</div>
                                            </div>
                                        </div>

                                        <!-- //* Lastname -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input id="lastname" class="form-control" type="text" name="lastname" placeholder="Enter Last Name" required>
                                                <div class="invalid-feedback">Please enter a valid last name without numbers or symbols.</div>
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

                                            <!-- Date of Birth Field -->
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
                                                    <input type="text" id="age" name="member_age" class="form-control" placeholder="Age" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Email Address <span style="color:red;">*</span></label>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                                </div>
                                            </div>
                                            <!-- Password Field (Read-Only) -->
                                            <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <div class="input-group">
                                                            <input id="password1" class="form-control" type="password" name="password1" placeholder="Enter Password">
                                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                                                                <i class="fa fa-eye-slash"></i>
                                                            </button>
                                                        </div>
                                                        
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

                                    <div class="submit-section" style="margin-top: 10px;">
                                        <button class="btn btn-primary submit-btn" type="submit">Add Member</button>
                                    </div>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //* add member modal -->

                <!-- Success Message Modal -->
                <div id="messageModal" class="modal fade" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 8px; overflow: hidden;">
                            <div class="modal-header" style="background-color: #4CAF50; color: white; padding: 15px;">
                                <h5 class="modal-title" id="messageModalLabel">Notification</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: white; opacity: 0.8;"></button>
                            </div>
                            <div class="modal-body" style="padding: 20px; font-size: 1rem; color: #333;">
                                <p id="modalMessage" style="margin: 0;"></p>
                            </div>
                            <div class="modal-footer" style="border-top: none; padding: 15px;">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="background-color: #4CAF50; border: none;">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="ph-address-selector.js"></script>

<?php if (isset($_SESSION['message'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const message = "<?php echo $_SESSION['message']; ?>";
            document.getElementById("modalMessage").textContent = message;
            const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
        });
    </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!--//* Scripts for Resetting Fields, Age Calculation, and Phone Number Validation -->
<script>
    // Reset form fields when modal is closed
    document.getElementById('add_member').addEventListener('hidden.bs.modal', function () {
        document.getElementById('addMemberForm').reset();
        document.getElementById('age').value = '';
    });

    // Phone Number validation for Philippines
    const mobileInput = document.getElementById("mobile");
    mobileInput.addEventListener("input", () => {
        const philippineNumberPattern = /^9\d{9}$/;
        if (!philippineNumberPattern.test(mobileInput.value)) {
            mobileInput.classList.add("is-invalid");
        } else {
            mobileInput.classList.remove("is-invalid");
        }
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

<!-- //* password toggle -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password1');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>';
    });
</script>

</body>
</html>
