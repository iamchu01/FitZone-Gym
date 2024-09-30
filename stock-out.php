<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Add Product - GYYMS Admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content container-fluid row align-items-start">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Stock Out</h3>
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
                    <form action="path-to-your-product-handler.php" method="POST" enctype="multipart/form-data">
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
                            <label for="product-description">Product Description</label>
                            <textarea class="form-control" id="product-description" name="product_description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product-price">Product Quantity</label>
                            <input type="number" class="form-control" id="product-price" name="product_price" required>
                        </div>
                        <div class="form-group">
                            <label for="product-price">Product Price</label>
                            <input type="number" class="form-control" id="product-price" name="product_price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="product-price">Expire date</label>
                            <input type="date" class="form-control" id="product-price" name="product_price" step="0.01" required>
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
</script>

</body>

</html>
