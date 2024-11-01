<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Dashboard - GYYMS admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php require_once('vincludes/load.php'); ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .panel-box:hover{
            transition: transform 0.3s ease;
            transform: scale(1.05);
            background-color: #bff7d3;
        }
    </style>

</head> 

<?php
$c_categorie = count_by_id('categories');
$c_product = count_by_id('products');
$c_sale = count_by_id('sales');
$c_user = count_by_id('users');
$products_sold = find_highest_selling_product('10');
$recent_products = find_recent_product_added('5');
$recent_sales = find_recent_sale_added('5');
$low_stock_threshold = 5;

// Fetch all categories
$all_categories = find_all('categories');

// Array to hold low stock categories and their total quantities
$low_stock_data = [];

// Loop through each category to calculate total quantity
foreach ($all_categories as $category) {
    $categorie_id = $category['id'];

    // Get total quantity for this category
    $query = "SELECT SUM(quantity) AS total_quantity FROM products WHERE categorie_id = '{$categorie_id}'";
    $result = $db->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        $total_quantity = $row['total_quantity'] ? (int)$row['total_quantity'] : 0;

        // Check if the total quantity is less than or equal to the threshold
        if ($total_quantity <= $low_stock_threshold) {
            // Add to low stock data if the condition is met
            $low_stock_data[] = [
                'category_name' => $category['name'],
                'total_quantity' => $total_quantity,
                'categorie_id' => $categorie_id // Keep track of the category ID for linking
            ];
        }
    }
}
?>
<?php include 'layouts/menu.php'; ?> 

<div class="page-wrapper" style="padding-top:2%;">
    <div class="content container-fluid">
    <h3 class="page-title">Inventory Management</h3>
   
        <div class="row">
        
            <!-- Category Panel -->
            <div class="col-md-3">
                <a href="categorie.php" style="color:black;">
                    <div class="panel panel-box clearfix">
                        <div class="panel-icon pull-left bg-red">
                            <i class="fa fa-th-large"></i>
                        </div>
                        <div class="panel-value pull-right">
                            <h2 class="margin-top"><?php echo $c_categorie['total']; ?></h2>
                            <p class="text-muted">Products</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Product Panel -->
            <div class="col-md-3">
                <a href="product.php" style="color:black;">
                    <div class="panel panel-box clearfix">
                        <div class="panel-icon pull-left bg-blue2">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="panel-value pull-right">
                            <h2 class="margin-top"><?php echo $c_product['total']; ?></h2>
                            <p class="text-muted">In Stock Items</p>
                        </div>
                    </div>
                </a>
            </div>
       

             <!-- gym equipmentPanel -->
            <div class="col-md-3">
                    <a href="gym_equipment.php" style="color:black;">
                        <div class="panel panel-box clearfix">
                            <div class="panel-icon pull-left bg-success">
                            <i class="fa fa-cubes"></i>                            
                            </div>
                            <div class="panel-value pull-right">
                                <h2 class="margin-top"><?php echo $c_product['total']; ?></h2>
                                <p class="text-muted">Gym Equipment</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
      <div class="dropdown position-absolute top-0 end-0">
  <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Inventory management Navigation bar" data-toggle="tooltip">
    <span class="fa fa-navicon"></span>
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="admin.php"><span class="fa fa-home"></span> Inventory Overview</a></li>
    <li><a class="dropdown-item" href="categorie.php"><span class="fa fa-th"></span> Add Product</a></li>
    <li><a class="dropdown-item" href="product.php"><span class="fa fa-shopping-cart"></span> Product Stock List</a></li>
    <li><a class="dropdown-item" href="gym_equipment.php"><span class="fa fa-cubes"></span> Gym equipment</a></li>
    
    <!-- Add more links as needed -->
  </ul>
</div>

    </div>
            </div>
           
        </div>

        <div class="content container-fluid">
        <div class="row">
           <!-- Highest Selling Products -->
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-primary">
                            <strong>
                                <span class="fa fa-trophy"></span>
                                <span>Highest Selling Products</span>
                            </strong>
                        </div>
                        <div class="panel-body" style="padding: 0;">
                            <div class="table-responsive" >
                                <table class="table table-striped table-bordered table-condensed" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%;">Title</th>
                                            <th>Total Sold</th>
                                            <th>Total Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products_sold as $product_sold): ?>
                                            <tr>
                                                <td class="text-truncate" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    <?php echo remove_junk(first_character($product_sold['category_name'])); ?>
                                                </td>
                                                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                                                <td><?php echo (int)$product_sold['totalQty']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
<!-- Low Stock Panel -->
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading bg-danger">
            <strong>
                <span class="fa fa-exclamation-triangle"></span>
                <span>Low Stock</span>
            </strong>
        </div>
        <div class="panel-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Product Name</th>
                            <th style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Total Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($low_stock_data)): ?>
                            <?php foreach ($low_stock_data as $index => $data): ?>
                                <tr>
                                    <td class="text-center"><?php echo $index + 1; ?></td>
                                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <a href="categorie.php?id=<?php echo (int)$data['categorie_id']; ?>">
                                            <?php echo remove_junk(first_character($data['category_name'])); ?>
                                        </a>
                                    </td>
                                    <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo remove_junk($data['total_quantity']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No low stock products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




            <!-- Recently Added Products -->
            <div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading bg-blue">
            <strong>
                <span class="fa fa-th"></span>
                <span>Recently Added Products</span>
            </strong>
        </div>
        <div class="panel-body" style="padding: 1px;">
            <div class="list-group" style="border-color: #000;" >
                <?php foreach ($recent_products as $recent_product): ?>
                    <a class="list-group-item clearfix" href="product.php?id=<?php echo (int)$recent_product['id']; ?>">
                        <h4 class="list-group-item-heading" style="display: flex; align-items: center;">
                            <?php if ($recent_product['media_id'] === '0'): ?>
                                <img class="img-avatar img-circle" src="vuploads/products/no_image.png" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                            <?php else: ?>
                                <img class="img-avatar img-circle" src="vuploads/products/<?php echo $recent_product['image']; ?>" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                            <?php endif; ?>
                            <span style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
                            </span>
                            <span class="label label-primary pull-right" style="margin-left: auto;">
                            ₱<?php echo (int)$recent_product['sale_price']; ?>
                            </span>
                        </h4>
                        
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

  


<?php include_once('vlayouts/footer.php'); ?>
<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
