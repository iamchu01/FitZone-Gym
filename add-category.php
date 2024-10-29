<?php include 'layouts/db-connection.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];
    $is_perishable = isset($_POST['is_perishable']) ? 1 : 0; // Set 1 if checked, 0 if not

    // Handle the file upload for the image
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == 0) {
        $category_image = file_get_contents($_FILES['category_image']['tmp_name']);
        
        // Prepare and execute the SQL statement
        $sql = "INSERT INTO category (category_image, category_name, category_description, is_perishable) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $category_image, $category_name, $category_description, $is_perishable);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Category added successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error adding category."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Image upload error."]);
    }
}


$conn->close();
?>