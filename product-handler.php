<?php
include 'layouts/db-connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve POST values
    $product_name = trim($_POST['product_name']);
    $product_category = trim($_POST['product_category']); // Assuming you have category ID here
    $product_description = trim($_POST['product_description']);
    $product_quantity = trim($_POST['product_quantity']);
    $product_price = trim($_POST['product_price']);
    $expire_date = trim($_POST['expire_date']);

    // Handle the image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        // Get the image content as a string
        $imageData = file_get_contents($_FILES['product_image']['tmp_name']);
        
        // Check if the image size is valid (optional)
        if ($_FILES['product_image']['size'] > 2097152) { // 2MB limit
            echo "Error: Image size should not exceed 2MB.";
            exit();
        }

        // Prepare SQL statement to insert the product into the database
        $sql = "INSERT INTO products (product_image, product_name, category_id, product_description, product_quantity, product_price, expire_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit();
        }

        // Bind parameters
        // Use 'b' for the BLOB (binary string) type for image data
        $stmt->bind_param("ssssids", $imageData, $product_name, $product_category, $product_description, $product_quantity, $product_price, $expire_date);

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
        // Print error message for file upload failure
        echo "Error uploading image: " . $_FILES['product_image']['error'];
        exit();
    }

    // Close the connection
    $conn->close();
}
?>
