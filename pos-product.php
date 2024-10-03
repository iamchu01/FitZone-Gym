<?php
include 'layouts/db-connection.php';

// Check if category_id is set and not empty
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : '';

// Prepare SQL query based on whether a category is selected or not
if ($category_id) {
    // Filter by category using category_id
    $sql = "SELECT * FROM products WHERE category_id = ?"; // Updated here
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
        
        echo "<div class='row'>";  
        echo "<div class='col'>"; 
        echo "<div class='card'>";
        echo "<img src='" . $imageSrc . "' class='product-image' alt='" . $productName . "'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title text-center'>" . $productName . "</h5>";
        echo "<p class='card-text'>" . $productDescription . "</p>";
        echo "<p class='card-text text-success'>₱" . $productPrice . "</p>";
        echo "<p class='card-text'>Quantity: " . $productQuantity . "</p>"; 
        echo "<div class='d-grid gap-2'>";
        echo "<button class='btn btn-outline-success add-to-order-btn ' data-product-id='" . htmlspecialchars($row['product_id']) . "' data-product-name='" . htmlspecialchars($row['product_name']) . "' data-product-price='" . htmlspecialchars($row['product_price']) . "'>Add to List</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    
    }
} else {
    echo "<div class='col-12'>No products found.</div>";
}

$stmt->close();
$conn->close();
?>
