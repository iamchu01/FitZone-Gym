<?php
include 'layouts/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Handle file upload
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == 0) {
        $image_name = $_FILES['category_image']['name'];
        $image_tmp = $_FILES['category_image']['tmp_name'];

        // Read the image file into a binary string
        $image_data = file_get_contents($image_tmp);
        $image_data = mysqli_real_escape_string($conn, $image_data); // Sanitize binary data for SQL insertion

        // SQL Query to insert data into the category table
        $sql = "INSERT INTO category (category_image, category_name, category_description)
        VALUES ('$image_data', '$category_name', '$category_description')";


        if ($conn->query($sql) === TRUE) {
            $message = "New category added successfully!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Please upload an image.";
    }
}
