<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<head>
    <title>Dashboard - GYYMS admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php require_once('vincludes/load.php'); ?>
    <?php include 'layouts/head-css.php'; ?>
</head> 
<?php
  $all_categories = find_all('categories');
// Handle category deletion via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_cat'])) {
  $categorie_id = (int)$_POST['id'];
  $categorie = find_by_id('categories', $categorie_id);
  
  if (!$categorie) {
      $session->msg("d", "Missing category id.");
      redirect('categorie.php');
  }

  // Check if the category is used in any products and get total quantity
  $query = "SELECT SUM(quantity) AS total_quantity FROM products WHERE categorie_id = '{$categorie_id}'";
  $result = $db->query($query);
  
  if ($result && $row = $result->fetch_assoc()) {
      $total_quantity = $row['total_quantity'] ? $row['total_quantity'] : 0;

      if ($total_quantity > 0) {
          // If there are products linked to this category, do not delete it
          $session->msg("d", "Cannot delete Product '{$categorie['name']}' as it hasa total quantity of {$total_quantity}.");
          redirect('categorie.php');
      }
  }
  
  // Proceed with deletion if there are no products linked to this category
  $delete_id = delete_by_id('categories', $categorie_id);
  if ($delete_id) {
      $session->msg("s", "Category deleted.");
      redirect('categorie.php');
  } else {
      $session->msg("d", "Category deletion failed.");
      redirect('categorie.php');
  }
}


?>
<?php
if (isset($_POST['add_cat'])) {
    $req_field = array('categorie-name');
    validate_fields($req_field);
    $cat_name = remove_junk($db->escape($_POST['categorie-name']));
    
    // Check for duplicate category name
    $query = "SELECT * FROM categories WHERE name = '{$cat_name}' LIMIT 1";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
        $session->msg("d", "Product '{$cat_name}' already exists.");
        redirect('categorie.php', false);
    }
    
    if (empty($errors)) {
        $sql  = "INSERT INTO categories (name)";
        $sql .= " VALUES ('{$cat_name}')";
        if ($db->query($sql)) {
            $session->msg("s", "Successfully Added New Product");
            redirect('categorie.php', false);
        } else {
            $session->msg("d", "Sorry Failed to insert.");
            redirect('categorie.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('categorie.php', false);
    }
}
?>


<?php include 'layouts/menu.php'; ?> 
<div class="page-wrapper" style="padding-top:2%;">
    <div class="content container-fluid">
        <h3 class="page-title">Products</h3>
        <div class="row">
            <div class="col-md-12">
                <?php echo display_msg($msg); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="fa fa-th"></span>
                            <span>Add New Product</span>
                        </strong>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="categorie.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="categorie-name" placeholder="Product Name" required>
                            </div>
                            <button type="submit" name="add_cat" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default">
                <a href="product.php">
                      <div class="panel-heading">
                        <strong>
                            <span class="fa fa-eye"></span>
                            <span>view all items</span>
                        </strong>
                    </div>
                      </a>
                    <div class="panel-body">
                      
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Products List</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_categories as $cat): ?>
                                    <tr>
                                        <td class="text-center"><?php echo count_id(); ?></td>
                                        <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="edit_categorie.php?id=<?php echo (int)$cat['id']; ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                                <form action="categorie.php" method="post" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo (int)$cat['id']; ?>">
                                                    <button type="submit" name="delete_cat" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure you want to delete this category?');">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </div>
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

<?php include_once('vlayouts/footer.php'); ?>
<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
