<?php
include 'layouts/db-connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $productName = htmlspecialchars($_POST['product_name']);
    $productCategory = htmlspecialchars($_POST['product_category']);
    $productDescription = htmlspecialchars($_POST['product_description']);
    $productQuantity = (int) $_POST['product_quantity'];
    $productPrice = (float) $_POST['product_price'];
    $expireDate = $_POST['expire_date'];
    
    // File upload handling
    $targetDir = "uploads/products/"; // Directory where the image will be saved
    $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is a valid image type
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $validExtensions)) {
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            // Insert product into the database
            $sql = "INSERT INTO products (product_name, product_category, product_description, product_quantity, product_price, expire_date, product_image)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
                    
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sisidss", $productName, $productCategory, $productDescription, $productQuantity, $productPrice, $expireDate, $targetFile);

            if ($stmt->execute()) {
                // Redirect with a success status
                header("Location: add-product.php?status=success");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    $conn->close();
}
?>
