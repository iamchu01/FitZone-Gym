<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<head>
    <title>Add Product - GYYMS Admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .main-wrapper{
            width: 100%;
            height: auto;
            margin: 0%;
            flex-direction: column;
        }
    </style>
</head>

<?php include 'layouts/body.php'; ?>


<?php 
// Fetch both category_id and category_name
$sql = "SELECT category_id, category_name FROM category";
$result = $conn->query($sql);

// Initialize an empty array for storing the categories
$categories = [];

if ($result->num_rows > 0) {
    // Fetch the category names and IDs and store them in the array
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo "No categories found!";
}

$conn->close();
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
                        <h3 class="page-title">Add New Product</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Product Management</li>
                            <li class="breadcrumb-item">Add Product</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Add Product Form -->
            <div class="row">
                <div class="col-md-12">
                <form action="product-handler.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product-image">Product Image</label>
        <input type="file" class="form-control" id="product-image" name="product_image" accept="image/*" required onchange="previewImage(event)">
    </div>
    <div class="form-group">
        <label>Image Preview</label>
        <br>
        <img id="image-preview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
    </div>
    <div class="form-group">
        <label for="product-name">Product Name</label>
        <input type="text" class="form-control" id="product-name" name="product_name" required>
    </div>
    <div class="form-group">
        <label for="product-category">Product Category</label>
        <select class="form-control" id="product-category" name="product_category" required>
            <option value="" disabled selected>Select a category</option>
            <?php
            // Loop through the categories array and create an option for each category
            foreach ($categories as $category) {
                echo "<option value='" . htmlspecialchars($category['category_id']) . "'>" . htmlspecialchars($category['category_name']) . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="product-description">Product Description</label>
        <textarea class="form-control" id="product-description" name="product_description" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="product-quantity">Product Quantity</label>
        <input type="number" class="form-control" id="product-quantity" name="product_quantity" required>
    </div>
    <div class="form-group">
        <label for="product-price">Product Price</label>
        <input type="number" class="form-control" id="product-price" name="product_price" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="expire-date">Expire Date</label>
        <input type="date" class="form-control" id="expire-date" name="expire_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
</form>

                </div>
            </div>
            <!-- /Add Product Form -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->
 <!-- add success modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Product Added</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Product successfully added!</p>
                </div>
                <div class="modal-footer">
                    <a href="add-product.php" class="btn btn-primary">OK</a>
                </div>
            </div>
        </div>
    </div>

<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
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


