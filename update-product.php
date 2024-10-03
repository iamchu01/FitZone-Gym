<?php
include 'layouts/session.php';
include 'layouts/db-connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $expire_date = $_POST['expire_date'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    // Check if a new image is uploaded
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $image_name = $_FILES['product_image']['name'];
        $image_tmp_name = $_FILES['product_image']['tmp_name'];
        $image_path = 'uploads/' . basename($image_name); // Adjust the path as needed
        move_uploaded_file($image_tmp_name, $image_path);
    } else {
        // If no new image, keep the old image path
        $sql = "SELECT product_image FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $image_path = $product['product_image'];
    }

    // Update the product information
    $sql = "UPDATE products SET product_name = ?, product_category = ?, product_description = ?, expire_date = ?, product_price = ?, product_quantity = ?, product_image = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdisi", $product_name, $product_category, $product_description, $expire_date, $product_price, $product_quantity, $image_path, $product_id);
    
    if ($stmt->execute()) {
        header('Location: edit-product.php?id=' . $product_id . '&status=success');
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

$conn->close();
?>
