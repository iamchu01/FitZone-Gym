<?php
include 'layouts/db-connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $productName = htmlspecialchars($_POST['product_name']);
    $categoryId = (int) $_POST['category_id']; // Use category_id instead of product_category
    $productDescription = htmlspecialchars($_POST['product_description']);
    $productQuantity = (int) $_POST['product_quantity'];
    $productPrice = (float) $_POST['product_price'];
    $expireDate = $_POST['expire_date'];
    
    // File upload handling
    $imageFile = $_FILES["product_image"]["tmp_name"];
    $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
    $imageFileSize = $_FILES["product_image"]["size"];

    // Check if the file is a valid image type
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $validExtensions)) {
        // Check the file size (optional, e.g., max 2MB)
        if ($imageFileSize > 2097152) {
            echo "Error: Image size should not exceed 2MB.";
            exit();
        }

        // Read the file into a variable to store it as BLOB
        $imageContent = file_get_contents($imageFile);

        // Insert product into the database
        $sql = "INSERT INTO products (product_name, category_id, product_description, product_quantity, product_price, expire_date, product_image)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sisidss", $productName, $categoryId, $productDescription, $productQuantity, $productPrice, $expireDate, $imageContent);

            if ($stmt->execute()) {
                // Redirect with a success status
                header("Location: add-product.php?status=success");
                exit();
            } else {
                echo "Error executing statement: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    $conn->close();
}
?>
