<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<head>
    <title>Product Details - FitZone Online Store</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="assets/css/store.css">
</head>
<style>
          .main-wrapper {
            width: 100%;
            height: auto;
            margin: 0%;
            flex-direction: column;
        }
        .product-image {
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
            border-radius: 5px; 
        }
        .order-image {
            height: 100%; 
            object-fit: cover; 
            border-radius: 5px; 
        }
    

    </style>
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
                        <h3 class="page-title">Product Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="store.php">Back to Store</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="row">
                <?php
                // Get the product ID from the URL
                if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
                    $product_id = $_GET['product_id'];

                    // Fetch product details from the database
                    $sql = "SELECT * FROM products WHERE product_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $product_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        ?>

                        <div class="col-lg-6">
                            <?php
                            // Convert the BLOB image to base64 format to display
                            $imageData = base64_encode($row['product_image']);
                            $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                            ?>
                            <img src="<?php echo $imageSrc; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($row['product_name']); ?>" style="width:100%; height:400px; object-fit:cover;">
                        </div>

                        <div class="col-lg-6">
                            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                            <p><?php echo htmlspecialchars($row['product_description']); ?></p>
                            <p><strong>Price: </strong>₱<?php echo number_format($row['product_price'], 2); ?></p>
                            <p><strong>Quantity Available: </strong><?php echo $row['product_quantity']; ?></p>
                            <p><strong>Expires On: </strong><?php echo htmlspecialchars($row['expire_date']); ?></p>

                            <div class="mt-4">
                                <button class="btn btn-primary" onclick="addToCart('<?php echo $row['product_id']; ?>', '<?php echo htmlspecialchars($row['product_name']); ?>', '<?php echo $row['product_price']; ?>')">Add to Cart</button>
                            </div>
                        </div>

                        <?php
                    } else {
                        echo "<div class='col-12'><p>Product not found.</p></div>";
                    }
                } else {
                    echo "<div class='col-12'><p>Invalid product ID.</p></div>";
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
