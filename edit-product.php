<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<head>
    <title>Edit Product - GYYMS Admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
</head>
<style>
    .main-wrapper {
        width: 100%;
        height: auto;
        margin: 0%;
        flex-direction: column;
    }
</style>

<?php include 'layouts/body.php'; ?>

<?php 
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Product ID is missing.");
}


$product_id = $_GET['id'];

// Fetch product details with category join
$sql = "SELECT p.product_name, p.category_id, p.product_description, p.product_quantity, p.product_price, p.expire_date, p.product_image, c.category_name 
        FROM products p 
        LEFT JOIN category c ON p.category_id = c.category_id 
        WHERE p.product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();
$expire_date = isset($product['expire_date']) ? $product['expire_date'] : null;
$formatted_date = $expire_date ? date('Y-m-d', strtotime($expire_date)) : ''; // Ensures the date is in the correct format
// Fetch categories with IDs
$sql = "SELECT category_id, category_name FROM category";
$result = $conn->query($sql);

// Initialize an empty array for storing the categories
$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row; // store both ID and name
    }
} else {
    echo "No categories found!";
}

$conn->close();

// Prepare base64-encoded image if it exists
$product_image_base64 = "";
if (!empty($product['product_image'])) {
    $product_image_base64 = 'data:image/jpeg;base64,' . base64_encode($product['product_image']);
}
?>

<!-- Main Wrapper -->
<div class="main-wrapper w-100 p-3">
    <?php include 'layouts/menu.php'; ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content container-fluid row align-items-start">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Product</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="inventory.php">Product List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Edit Product Form -->
            <div class="row">
                <div class="col-md-12">
                <form action="update-product.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">

                    <div class="form-group">
                        <label for="product-image">Product Image</label>
                        <input type="file" class="form-control" id="product-image" name="product_image" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="form-group">
                        <label>Image Preview</label>
                        <br>
                        <img id="image-preview" src="<?php echo htmlspecialchars($product_image_base64); ?>" alt="Image Preview" style="max-width: 300px; height: auto; <?php echo !empty($product_image_base64) ? 'display: block;' : 'display: none;'; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input type="text" class="form-control" id="product-name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="product-category">Product Category</label>
                        <select class="form-control" id="product-category" name="product_category" required>
                            <option value="" disabled>Select a category</option>
                            <?php
                            foreach ($categories as $category) {
                                $selected = ($category['category_id'] == $product['category_id']) ? 'selected' : '';
                                echo "<option value='" . htmlspecialchars($category['category_id']) . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product-description">Product Description</label>
                        <textarea class="form-control" id="product-description" name="product_description" rows="4" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="product-quantity">Product Quantity</label>
                        <input type="number" class="form-control" id="product-quantity" name="product_quantity" value="<?php echo htmlspecialchars($product['product_quantity']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="product-price">Product Price</label>
                        <input type="number" class="form-control" id="product-price" name="product_price" step="0.01" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="expire-date">Expire Date</label>
                        <input type="date" class="form-control" id="expire-date" name="expire_date" value="<?php echo htmlspecialchars($formatted_date); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
                </div>
            </div>
            <!-- /Edit Product Form -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Product Updated</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Product successfully updated!</p>
            </div>
            <div class="modal-footer">
                <a href="edit-product.php?id=<?php echo htmlspecialchars($product_id); ?>" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        }
    });
</script>

</body>
</html>
