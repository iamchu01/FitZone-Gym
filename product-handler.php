<?php
include 'layouts/db-connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve POST values
    $product_name = trim($_POST['product_name']);
    $product_category = trim($_POST['product_category']);
    $product_description = trim($_POST['product_description']);
    $product_quantity = trim($_POST['product_quantity']);
    $product_price = trim($_POST['product_price']);

    // Check if the expire_date key exists and assign its value
    $expire_date = isset($_POST['expire_date']) && $_POST['expire_date'] !== '' ? trim($_POST['expire_date']) : NULL;

    // Handle the image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        // Check if the image size is valid (2MB limit)
        if ($_FILES['product_image']['size'] > 2097152) { 
            echo "Error: Image size should not exceed 2MB.";
            exit();
        }

        // Get the image content as binary data
        $product_image = file_get_contents($_FILES['product_image']['tmp_name']);

        // Prepare SQL statement to insert the product into the database
        $sql = "INSERT INTO products (product_image, product_name, category_id, product_description, product_quantity, product_price, expire_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit();
        }

        // Bind parameters: 'b' for BLOB, 's' for string, 'i' for integer, and 'd' for double
        $stmt->bind_param("sssssis", $product_image, $product_name, $product_category, $product_description, $product_quantity, $product_price, $expire_date);

        // Send the BLOB data as a separate parameter
        $stmt->send_long_data(0, $product_image);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: inventory.php?status=success");
            exit();
        } else {
            echo "Error executing statement: (" . $stmt->errno . ") " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "No image uploaded or file upload error: " . $_FILES['product_image']['error'];
        exit();
    }

    // Close the connection
    $conn->close();
}
?>
