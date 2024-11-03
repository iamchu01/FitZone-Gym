<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<head>
    <title>Dashboard - GYYMS admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php require_once('vincludes/load.php'); ?>
    <?php include 'layouts/head-css.php'; ?>
    <script>
    $(document).ready(function() {
        // Cache table rows for filtering
        var tableRows = $('tbody tr');

        // Click event for stock out button
        $(document).on('click', '.stock-out-action', function() {
            var productId = $(this).data('product-id');
            var productQuantity = $(this).data('quantity');
            var productName = $(this).data('name'); // Get product name
            var productBatch = $(this).data('batch'); // Get product batch
            setStockOutDetails(productId, productQuantity, productName, productBatch);
        });

        $(document).on('click', '.close, .btn-secondary', function() {
            $('#stockOutModal').modal('hide'); // Close the modal
        });

        function setStockOutDetails(id, quantity, name, batch) {
            $('#stockOutModal .modal-body').find('p').remove();

            $('#stockOutModal .namebatch').append(`<p><strong>Product Name:</strong> ${name}</p>`);
            $('#stockOutModal .namebatch').append(`<p><strong>Product Batch:</strong> ${batch}</p>`);
            $('#modalProductId').val(id);
            $('#stockOutQuantity').val(quantity);
            $('#stockOutModal').modal('show');
        }

        // Search functionality
        $('#category-search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            tableRows.filter(function() {
                $(this).toggle($(this).find('td:nth-child(3)').text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
    </script>
    <style>
        /* Add your custom styles here */
    </style>
</head>

<?php
$products = join_product_table();
$all_categories = find_all('categories');
$all_photo = find_all('media');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $reason = remove_junk($db->escape($_POST['reason']));

    if ($quantity <= 0) {
        $session->msg("d", "Quantity must be greater than zero.");
        redirect('product.php', false);
    }

    // Insert stock out record
    $query = "INSERT INTO stock_out (product_id, quantity, reason, date) VALUES ('{$product_id}', '{$quantity}', '{$reason}', NOW())";
    if ($db->query($query)) {
        $session->msg('s', "Product successfully stocked out");
        redirect('product.php', false);
    } else {
        $session->msg('d', 'Failed to stock out product');
        redirect('product.php', false);
    }
}
?>
<?php include 'layouts/menu.php'; ?>
<body>
   
<div class="page-wrapper" style="padding-top: 2%">
    <div class="content container-fluid">
        <div class="row">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Stock out</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo display_msg($msg); ?>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="col">Search Product</div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" id="category-search" class="form-control" placeholder="Type Product name...">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 30px;">#</th>
                                        <th class="text-center" style="width: 10%;">Photo</th>
                                        <th class="text-center" style="width: 50%;">Name</th>
                                        <th class="text-center" style="width: 10%;">Item Code</th>
                                        <th class="text-center" style="width: 10%;">In-Stock</th>
                                        <th class="text-center" style="width: 10%;">Buying Price</th>
                                        <th class="text-center" style="width: 10%;">Selling Price</th>
                                        <th class="text-center" style="width: 10%;">Expire Date</th>
                                        <th class="text-center" style="width: 10%;">Product Batch</th>
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td class="text-center"><?php echo count_id(); ?></td>
                                            <td>
                                                <?php if ($product['media_id'] === '0'): ?>
                                                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                                                <?php else: ?>
                                                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
                                            <td class="text-center"><?php echo remove_junk($product['item_code']); ?></td>
                                            <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
                                            <td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td>
                                            <td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td>
                                            <td class="text-center">
                        <?php 
    if (isset($product['is_perishable']) && $product['is_perishable'] == 0) {
        echo 'Non-Perishable';
    } elseif (isset($product['expiration_date']) && !empty($product['expiration_date'])) {
        // Display the expiration date
        echo htmlspecialchars($product['expiration_date']);
    } else {
        echo 'No expiration date available';
    }
?> </td>
                                            <td class="text-center"><?php echo read_date($product['date']); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm stock-out-action"  
                                                        data-product-id="<?php echo (int)$product['id']; ?>" 
                                                        data-quantity="<?php echo (int)$product['quantity']; ?>"  
                                                        data-name="<?php echo remove_junk($product['categorie']); ?>"  
                                                        data-batch="<?php echo read_date($product['date']); ?>"  
                                                        title="Stock Out">
                                                    <i class="fa fa-external-link-square"></i> Stock Out
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stock Out Modal -->
    <div class="modal" id="stockOutModal" tabindex="-1" role="dialog" aria-labelledby="stockOutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockOutModalLabel">Stock Out Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="stockOutForm" method="POST" action="stock_out.php">
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="modalProductId">
                        <div class="namebatch">

                        </div>
                        <div class="form-group">
                            <label for="stockOutQuantity">Quantity</label>
                            <input type="number" class="form-control" id="stockOutQuantity" name="quantity" required min="1">
                        </div>
                        <div class="form-group">
                            <label for="stockOutReason">Reason for Stock Out</label>
                            <textarea class="form-control" id="stockOutReason" name="reason" required placeholder="Enter reason for stock out"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Stock Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<?php include_once('vlayouts/footer.php'); ?>
<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
