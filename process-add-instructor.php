<?php
include 'layouts/db-connection.php'; // Include the $conn variable for mysqli

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $first_name = $conn->real_escape_string(trim($_POST['firstname']));
    $last_name = $conn->real_escape_string(trim($_POST['lastname']));
    $phone_number = $conn->real_escape_string(trim($_POST['mobile']));
    $gender = isset($_POST['Gender']) ? $conn->real_escape_string(trim($_POST['Gender'])) : 'Others'; // Ensure 'Others' is captured

    $date_of_birth = $conn->real_escape_string(trim($_POST['dateOfBirth']));
    $age = $conn->real_escape_string(trim($_POST['instructor_age']));

    // Capture the text values for the address from the hidden input fields
    $region_text = $conn->real_escape_string(trim($_POST['region_text']));
    $province_text = $conn->real_escape_string(trim($_POST['province_text']));
    $city_text = $conn->real_escape_string(trim($_POST['city_text']));
    $barangay_text = $conn->real_escape_string(trim($_POST['barangay_text']));

    // Concatenate full address for the address field
    $address = "$region_text, $province_text, $city_text, $barangay_text";

    $specialization = $conn->real_escape_string(trim($_POST['specialization']));
    $status = 'Active'; // Default status for new instructors

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($phone_number) || empty($gender) || empty($date_of_birth) || empty($address) || empty($specialization)) {
        header('Location: add-instructor.php?error=empty_fields');
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO tbl_instructors (first_name, last_name, phone_number, gender, date_of_birth, age, address, specialization, status) 
            VALUES ('$first_name', '$last_name', '$phone_number', '$gender', '$date_of_birth', '$age', '$address', '$specialization', '$status')";

         

    if ($conn->query($sql) === TRUE) {
        header('Location: add-instructor.php?success=added');
        exit;
    } else {
        header('Location: add-instructor.php?error=database_error');
        exit;
    }
}

?>
