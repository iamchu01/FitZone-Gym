<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<head>
    <title>Dashboard - GYYMS admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php require_once('vincludes/load.php'); ?>
    <?php include 'layouts/head-css.php'; ?>
    <script>
$(document).ready(function() {
    $('#addProductModal').on('show.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-body').load('add_product.php');
    });

    $('#perishable-select').on('change', function() {
        if ($(this).val() === 'perishable') {
            $('#expiration-date-group').show(); // Show expiration date group
        } else {
            $('#expiration-date-group').hide(); // Hide expiration date group
            $('#expiration-date').val(''); // Clear the expiration date if non-perishable
        }
    });

    // Optional: Initialize visibility when the modal is shown
    $('#addProductModal').on('show.bs.modal', function() {
        $('#perishable-select').trigger('change'); // Trigger change to set initial visibility
    });
});


    $('#category-search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('tbody tr').filter(function() {
            $(this).toggle($(this).find('td:nth-child(3)').text().toLowerCase().indexOf(value) > -1);
        });
    });
    // Optional: Initialize visibility when the modal is shown
    $('#addProductModal').on('show.bs.modal', function() {
        $('#perishable-select').trigger('change'); // Trigger change to set initial visibility
    });

  </script>
  <style>
    .modal-content {
    width: 100%;
    max-width: 100%;
}
    .modal-body {
    max-height: calc(100vh - 200px); /* Adjust based on your header/footer heights */
    overflow-y: auto; /* Enable scrolling if content exceeds height */
}
  </style>
</head> 
<?php

  $products = join_product_table();
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $min_expiration_date = date('Y-m-d', strtotime('+5 months'));
  if (isset($_POST['add_product'])) {
    $req_fields = array('product-categorie', 'product-quantity', 'buying-price', 'saleing-price');
    validate_fields($req_fields);

    if (empty($errors)) {
        $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
        $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
        $p_buy   = remove_junk($db->escape($_POST['buying-price']));
        $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
        $is_perishable = isset($_POST['is-perishable']) ? 1 : 0;

        // Initialize the expiration date
        $expiration_date = NULL; // Default to NULL for non-perishable
        if ($is_perishable) {
            $expiration_date = remove_junk($db->escape($_POST['expiration-date'])); // Get expiration date from POST
        }

        // Handle media id
        $media_id = !empty($_POST['product-photo']) ? remove_junk($db->escape($_POST['product-photo'])) : '0';

        $date = make_date(); // Current date

        // Prepare the insert query
        $query  = "INSERT INTO products (quantity, buy_price, sale_price, categorie_id, media_id, date, expiration_date, is_perishable) VALUES (";
        $query .= "'{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}', ";
        $query .= $is_perishable ? "'{$expiration_date}', 1" : "NULL, 0"; // Ensure correct handling of NULL
        $query .= ")";

        // Execute the query
        if ($db->query($query)) {
            $session->msg('s', "Product added ");
            redirect('product.php', false);
        } else {
            $session->msg('d', ' Sorry failed to add!');
            redirect('product.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('product.php', false);
    }
}

?>
<?php include 'layouts/menu.php'; ?> 
<div class="page-wrapper">
  <div class="content container-fluid">
  <div class="row">

     <div class="row">
      <div class="col"> <h3 class="page-title">Product Stock List </h3>
    </div>
    <div class="col">
      <div class="dropdown position-absolute top-0 end-0">
  <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Inventory management Navigation bar" data-toggle="tooltip">
    <span class="fa fa-navicon"></span>
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="admin.php"><span class="fa fa-home"></span> Inventory Overview</a></li>
    <li><a class="dropdown-item" href="categorie.php"><span class="fa fa-th"></span> Add Product</a></li>
    <li><a class="dropdown-item" href="product.php"><span class="fa fa-th-large"></span> Product Stock List</a></li>
    <li><a class="dropdown-item" href="gym_equipment.php"><span class="fa fa-shopping-cart"></span> Store Products</a></li>
    <li><a class="dropdown-item" href="gym_equipment.php"><span class="fa fa-cubes"></span> Gym equipment</a></li>
    
    <!-- Add more links as needed -->
  </ul>
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
            <div class="pull-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Stock in</a>
            </div>
        </div>
        <div class="panel-body">
        <div class="table-responsive">
            <table class="table custom-table datatable">
            <thead >
              <tr>
                <th class="text-canter" style="width: 50px;">#</th>
                <th class="text-canter" style="width: 10%;"> Photo</th>
                <th class="text-canter" style="width: 50%;"> Name </th>
                <th class="text-canter" style="width: 10%;"> In-Stock </th>
                <th class="text-canter" style="width: 10%;"> Buying Price </th>
                <th class="text-canter" style="width: 10%;"> Selling Price </th>
                <th class="text-canter" style="width: 10%;"> Expire Date </th>
                <th class="text-canter" style="width: 10%;"> Product Batch </th>
                <th class="text-canter" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
    <?php foreach ($products as $product): ?>
        <tr class="<?php 
    echo ($product['quantity'] == 0) ? 'bg-danger' : 
         (($product['quantity'] < 5) ? 'bg-red' : ''); 
                                                        ?>">
            <td class="text-center"><?php echo count_id(); ?></td>
            <td>
                <?php if ($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
            </td>
            <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
            <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td>
            <td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td>
            <td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td>
            <td class="text-center">
                <?php echo isset($product['is_perishable']) && $product['is_perishable'] ? read_date($product['expiration_date']) : 'Non-Perishable'; ?>
            </td>
            <td class="text-center"><?php echo read_date($product['date']); ?></td>
            <td class="text-center">
                <div class="btn-group">
                    <div class="dropdown action-label">
                    <a href="#" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-dot-circle-o text-primary"></i> Actions
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="btn btn-info btn-xs btn-edit" title="Edit" data-toggle="tooltip" data-id="<?php echo (int)$product['id']; ?>">
                    <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                    <i class="fa fa-trash"></i> Delete
                    </a>
                            </div>
                    </div>
                    
                    
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

          </tabel>
            </div>
          
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<!-- Add New Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel"></h5>
                <button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin: 1px;">
                <div class="row no-gutters"> <!-- Add no-gutters for no margin between columns -->
                    <div class="col-12"> <!-- Use col-12 for full width -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="fa fa-th-large"></span>
                                    <span>Add New Product</span>
                                </strong>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="" class="clearfix">
                                    <!-- <div class="form-group " style="display: none;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                            <input type="text" class="form-control" name="product-title" placeholder="Product Title" >
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control" name="product-categorie" required>
                                                    
                                                    <option value="">Select Product</option>
                                                    <?php foreach ($all_categories as $cat): ?>
                                                        <option value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="product-photo">
                                                    <option value="">Select Product Photo</option>
                                                    <?php foreach ($all_photo as $photo): ?>
                                                        <option value="<?php echo (int)$photo['id'] ?>"><?php echo $photo['file_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>
                                                    <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                    <input type="number" class="form-control" name="buying-price" placeholder="Buying Price" required>
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                    <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price" required>
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="perishable-select">Select Product Type:</label>
                                        <select id="perishable-select" class="form-control">
                                            <option value="non-perishable">Non-Perishable</option>
                                            <option value="perishable">Perishable</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="expiration-date-group" style="display: none;">
                                        <label for="expiration-date">Expiration Date</label>
                                        <input type="date" class="form-control" name="expiration-date" id="expiration-date" min="<?php echo $min_expiration_date; ?>">
                                    </div>

                                    <button type="submit" name="add_product" class="btn btn-primary">Add product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin: 1px;">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form method="post" action="edit_product.php" id="editProductForm" class="clearfix">
                                    <input type="hidden" name="product-id" id="edit-product-id" value="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                            <input type="text" class="form-control" name="product-title" id="edit-product-title" placeholder="Product Title" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control" name="product-categorie" id="edit-product-categorie" required>
                                                    <option value="">Select Product Category</option>
                                                    <?php foreach ($all_categories as $cat): ?>
                                                        <option value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="product-photo" id="edit-product-photo">
                                                    <option value="">Select Product Photo</option>
                                                    <?php foreach ($all_photo as $photo): ?>
                                                        <option value="<?php echo (int)$photo['id'] ?>"><?php echo $photo['file_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-shopping-cart"></i></span>
                                                    <input type="number" class="form-control" name="product-quantity" id="edit-product-quantity" placeholder="Product Quantity" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                    <input type="number" class="form-control" name="buying-price" id="edit-buying-price" placeholder="Buying Price" required>
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                    <input type="number" class="form-control" name="saleing-price" id="edit-selling-price" placeholder="Selling Price" required>
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" id="edit-is-perishable" name="is-perishable"> Is this product perishable?
                                        </label>
                                    </div>

                                    <div class="form-group" id="edit-expiration-date-group" style="display: none;">
                                        <label for="edit-expiration-date">Expiration Date</label>
                                        <input type="date" class="form-control" name="expiration-date" id="edit-expiration-date" min="<?php echo $min_expiration_date; ?>">
                                    </div>

                                    <button type="submit" name="edit_product" class="btn btn-primary">Update Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('vlayouts/footer.php'); ?>
<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
