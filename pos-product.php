<?php
include 'layouts/db-connection.php';

// Check if category_id is set and not empty
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : '';

// Prepare SQL query based on whether a category is selected or not
if ($category_id) {
    // Filter by category using category_id
    $sql = "SELECT * FROM products WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $category_id);
} else {
    // Show all products
    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Start a new row for the cards
    echo "<div class='row g-2'>"; // g-2 for gap of 0.5rem (approximately 2% spacing)

    // Output data for each product
    while ($row = $result->fetch_assoc()) {
        $productName = htmlspecialchars($row['product_name']);
        $productDescription = htmlspecialchars($row['product_description']);
        $productPrice = htmlspecialchars($row['product_price']);
        $productImage = $row['product_image']; // BLOB data
        $productQuantity = htmlspecialchars($row['product_quantity']);
        $productId = htmlspecialchars($row['product_id']);
        
        if ($productImage) {
            $imageSrc = 'data:image/jpeg;base64,' . base64_encode($productImage);
        } else {
            $imageSrc = 'assets/images/placeholder-image.png';
        }
        
        // Adjust column size and card height
        echo "<div class='col-6 col-md-4 col-lg-3'>"; // Adjust the number of columns per row
        echo "<div class='card' style='width: 170px; height: 270px;'>"; // Fixed card width and height
        echo "<img src='" . $imageSrc . "' class='card-img-top' alt='" . $productName . "' style='height: 120px; width: 100%; object-fit: cover;'>"; // Adjusted image height
        echo "<div class='card-body' style='display: flex; flex-direction: column; justify-content: flex-start; height: 130px; padding: 5px;'>"; // Adjusted padding and flex direction
        echo "<h5 class='card-title text-center' style='font-size: 0.9rem; margin-top: 5px; margin-bottom: 5px;'>" . $productName . "</h5>"; // Reduced margin to bring the name closer
        echo "<p class='card-text' style='font-size: 0.75rem; margin-bottom: 0;'>" . $productDescription . "</p>"; // Smaller font size for description
        echo "<p class='card-text text-success' style='font-size: 0.75rem; margin-bottom: 0;'>₱" . $productPrice . "</p>"; // Price
        echo "<p class='card-text' style='font-size: 0.75rem; margin-bottom: 0;'>Quantity: " . $productQuantity . "</p>"; // Quantity
        echo "<div class='d-grid gap-1'>"; // Adjusted gap for buttons
        echo "<button class='btn btn-outline-success btn-sm add-to-order-btn' data-product-id='" . htmlspecialchars($row['product_id']) . "' data-product-name='" . htmlspecialchars($row['product_name']) . "' data-product-price='" . htmlspecialchars($row['product_price']) . "'>Add to List</button>";
        echo "</div>";
        echo "</div>"; // Close card body
        echo "</div>"; // Close card
        echo "</div>"; // Close column
    }

    // Close the row after all products
    echo "</div>";
} else {
    echo "<div class='col-12'>No products found.</div>";
}

$stmt->close();
$conn->close();
?>
