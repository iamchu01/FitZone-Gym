<?php
include 'layouts/db-connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize input data
    $subscription_name = $conn->real_escape_string(trim($_POST['subscription_name']));
    $subscription_type_id = intval($_POST['subscription_type_id']); // Use the ID from the dropdown
    $pricing = floatval($_POST['pricing']); // Ensure this is cast to a float for pricing
    $duration = intval($_POST['duration']);
    $payment_method_id = intval($_POST['payment_method_id']); // Use the ID for the payment method
    $description = $conn->real_escape_string(trim($_POST['description']));

    // Insert data into the database
    $sql = "INSERT INTO tbl_member_subscription (name, subscription_type_id, pricing, duration, payment_method_id, description, status, archive_status, created_at) 
            VALUES ('$subscription_name', '$subscription_type_id', '$pricing', '$duration', '$payment_method_id', '$description', 'inactive', 'unarchived', NOW())";

    if ($conn->query($sql) === TRUE) {
        header('Location: create-subscription.php?success=added');
        exit;
    } else {
        header('Location: create-subscription.php?error=database_error');
        exit;
    }
}
?>
