<?php
include 'layouts/db-connection.php'; // Ensure this file connects to your database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_subscription_type'])) {
    // Sanitize and validate input data
    $type_name = htmlspecialchars(trim($_POST['type_name']));
    $duration_days = intval($_POST['duration_days']);
    $price = floatval($_POST['price']);

    // Check if all required fields are provided
    if (!empty($type_name) && $duration_days > 0 && $price >= 0) {
        // Prepare the SQL query to insert data
        $query = "INSERT INTO tbl_subscription_types (type_name, duration_days, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdi", $type_name, $duration_days, $price);

        // Execute and check if the query was successful
        if ($stmt->execute()) {
            echo "New subscription type added successfully!";
            // Optionally, you can redirect or show a success message here
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all required fields correctly.";
    }

    $conn->close();
}
?>
