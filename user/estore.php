<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>
<head>
    <title>FitZone Online Store</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="assets/css/store.css">
</head>
<?php include 'layouts/body.php'; ?>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">FitZone Online Store</h3>
                    </div>
                </div>
            </div>

            <!-- Product Display Section -->
            <div class="row">
                <?php
                // Fetch products from the database
                $sql = "SELECT product_id, product_image, product_name, product_description, product_price FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each product
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card">
                                <?php
                                // Convert the BLOB image to base64 format to display
                                $imageData = base64_encode($row['product_image']);
                                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                ?>
                                <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['product_name']); ?>" style="width:100%; height:200px; object-fit:cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['product_description']); ?></p>
                                    <p class="card-text text-success">₱<?php echo number_format($row['product_price'], 2); ?></p>
                                    <a href="product-details.php?product_id=<?php echo htmlspecialchars($row['product_id']); ?>" class="btn btn-primary">View Details</a>
                                    <button class="btn btn-success" onclick="addToCart('<?php echo $row['product_id']; ?>', '<?php echo htmlspecialchars($row['product_name']); ?>', '<?php echo $row['product_price']; ?>')">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='col-12'><p>No products found.</p></div>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->


<?php include 'layouts/vendor-scripts.php'; ?>

<script>
// Add to Cart Functionality (Client-side)
function addToCart(productId, productName, productPrice) {
    // Implement your add to cart logic here (local storage or AJAX call to add items to the cart)
    alert(`Added ${productName} to the cart at ₱${productPrice}`);
}
</script>
</body>
</html>
