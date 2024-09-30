<?php
include 'layouts/db-connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Product ID is missing.']);
    exit;
}

$product_id = $_GET['id'];

// Fetch the product details
$sql = "SELECT product_id, product_name, product_category, product_description, expire_date, product_price, product_quantity, product_image FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Product not found.']);
    exit;
}

$product = $result->fetch_assoc();

// Encode product image as base64 if it's a BLOB
if ($product['product_image']) {
    $product['product_image'] = base64_encode($product['product_image']);
}

header('Content-Type: application/json');
echo json_encode($product);

$conn->close();
?>
