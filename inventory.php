<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - HRMS admin template</title>
    <?php include 'layouts/head-main.php'; ?>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <?php include 'layouts/db-connection.php'; ?>
    <?php include 'layouts/session.php'; ?>

    <!-- Ensure Bootstrap CSS and jQuery are included -->
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
 

    
</head>
<body>
    <div class="main-wrapper">
        <?php include 'layouts/menu.php'; ?>

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Product List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Inventory</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="add-product.php" class="btn add-btn"><i class="fa fa-plus"></i> Add Product</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12"> 
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Description</th>
                                        <th>Expiry Date</th>
                                        <th>Price</th>
                                        <th>Product Quantity</th>
                                        <th>Creation Date</th>
                                        <th>Actions</th> <!-- Added column for actions -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
// Fetch products along with their category name
$sql = "SELECT products.product_id, products.product_name, category.category_name, products.product_description, 
        products.expire_date, products.product_price, products.product_quantity, products.created_at, products.product_image 
        FROM products 
        INNER JOIN category ON products.category_id = category.category_id";



$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Debugging lines
        error_log("Product ID: " . $row['product_id']);
        error_log("Description: " . $row['product_description']);
        error_log("Expire Date: " . $row['expire_date']);

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['product_description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['expire_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['product_price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['product_quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";

        // Action buttons
        echo "<td>
            <button class='btn btn-info btn-sm la la-eye view-product-button' data-bs-toggle='modal' data-bs-target='#viewProductModal' data-id='" . $row['product_id'] . "'></button>
            <a href='edit-product.php?id=" . $row['product_id'] . "' class='btn btn-warning btn-sm la la-edit'></a>
            <button class='btn btn-danger btn-sm la la-trash' data-bs-toggle='modal' data-bs-target='#deleteProductModal' data-id='" . $row['product_id'] . "'></button>
        </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No products found.</td></tr>";
}


$conn->close();
?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Wrapper -->
    </div>

    <!-- View Product Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img id="productImage" src="" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h1 id="productName"></h1>
                            <p><strong>Discription:</strong> <span id="productDescription"></span></p>
                            <p><strong>Category:</strong> <span id="productCategory"></span></p>
                            <p><strong>Price:</strong> $<span id="productPrice"></span></p>
                            <p><strong>Quantity:</strong> <span id="productQuantity"></span></p>
                            <p><strong>Expiry Date:</strong> <span id="productExpiry"></span></p>
                            <p><strong>Creation Date:</strong> <span id="productCreation"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <input type="hidden" id="delete-product-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
   $(document).ready(function() {
    // View Product Modal
    $('.view-product-button').on('click', function() {
        var productId = $(this).data('id');
        $.ajax({
            url: 'fetch-product.php',
            type: 'POST',
            data: { product_id: productId },
            success: function(data) {
                var product = JSON.parse(data);
                if (product.error) {
                    console.error(product.error);
                    return;
                }
                $('#productName').text(product.product_name);
                $('#productDescription').text(product.product_description);
                $('#productCategory').text(product.category_name); // Ensure this matches the fetched data
                $('#productPrice').text(product.product_price);
                $('#productQuantity').text(product.product_quantity);
                $('#productExpiry').text(product.expire_date);
                $('#productCreation').text(product.created_at);
                $('#productImage').attr('src', product.product_image); // Ensure this path is correct
            },
            error: function(xhr, status, error) {
                console.error('Error fetching product:', error);
            }
        });
    });


    // Delete Product Modal
    $('#deleteProductModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var productId = button.data('id');
        $('#delete-product-id').val(productId);
    });

    // Handle Delete Confirmation
    $('#confirm-delete').on('click', function() {
        var productId = $('#delete-product-id').val();
        $.ajax({
            url: 'delete-product.php',
            type: 'POST',
            data: { product_id: productId },
            success: function(response) {
                if (response.trim() === 'success') {
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Failed to delete product.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting product:', error);
            }
        });
    });

    // Success Modal
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
    }

    $('#okButton').on('click', function() {
        window.location.href = 'inventory.php';
    });
});

    </script>

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>
