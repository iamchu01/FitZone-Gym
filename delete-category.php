<?php
include 'layouts/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the category ID from the POST request
    $categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    // Check if the category is used in the products table
    $checkSql = "SELECT COUNT(*) as count FROM products WHERE category_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $checkResult = $stmt->get_result();
    $row = $checkResult->fetch_assoc();

    if ($row['count'] > 0) {
        // Category is used by other products
        echo json_encode([
            'status' => 'error',
            'message' => 'Category cannot be deleted because it is being used by products.'
        ]);
    } else {
        // Proceed with the deletion
        $deleteSql = "DELETE FROM category WHERE category_id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $categoryId);

        if ($deleteStmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Category deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete category. Please try again.'
            ]);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
