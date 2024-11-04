<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<?php
// Handle form submissions for adding new subscription types, payment methods, and pricing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_type'])) {
        $name = $conn->real_escape_string(trim($_POST['name']));
        $duration_days = intval($_POST['duration_days']);
        $stmt = $conn->prepare("INSERT INTO tbl_subscription_type (name, duration_days) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $duration_days);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['add_payment_method'])) {
        $method_name = $conn->real_escape_string(trim($_POST['method_name']));
        $method_description = $conn->real_escape_string(trim($_POST['method_description']));
        $method_picture = $conn->real_escape_string(trim($_POST['method_picture'])); // Assuming the image path is stored as a string
        $stmt = $conn->prepare("INSERT INTO tbl_subscription_payment_method (method_name, method_description, method_picture) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $method_name, $method_description, $method_picture);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['add_pricing'])) {
        $subscription_type_id = intval($_POST['subscription_type_id']);
        $price = floatval($_POST['price']);
        $stmt = $conn->prepare("INSERT INTO tbl_subscription_pricing (subscription_type_id, price) VALUES (?, ?)");
        $stmt->bind_param("id", $subscription_type_id, $price);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<head>
    <title>Subscription Settings - HRMS admin template</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div class="main-wrapper">
    <?php include 'layouts/topbar.php'; ?>
    <?php include 'layouts/settings-sidebar.php'; ?>
    <?php include 'layouts/two-col-sidebar.php'; ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content container-fluid">
            
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Subscription Settings</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subscription Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <!-- Card Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-light border-0">
                    <ul class="nav nav-tabs card-header-tabs" id="subscriptionSettingsTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="subscription-types-tab" data-bs-toggle="tab" href="#subscription-types" role="tab" aria-controls="subscription-types" aria-selected="true">
                                <i class="fa fa-list"></i> Subscription Types
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-methods-tab" data-bs-toggle="tab" href="#payment-methods" role="tab" aria-controls="payment-methods" aria-selected="false">
                                <i class="fa fa-credit-card"></i> Payment Methods
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">
                                <span>₱</span> Pricing
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="subscriptionSettingsTabsContent">
                        <!-- Subscription Types Tab -->
                        <div class="tab-pane fade show active" id="subscription-types" role="tabpanel" aria-labelledby="subscription-types-tab">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_subscription_type">
                                    <i class="fa fa-plus"></i> Add Subscription Type
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>Subscription Type</th>
                                            <th>Duration (in Days)</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $types_result = $conn->query("SELECT * FROM tbl_subscription_type");
                                        while ($type = $types_result->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($type['name']); ?></td>
                                            <td><?php echo htmlspecialchars($type['duration_days']); ?></td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setEditModalData('type', <?php echo $type['subscription_type_id']; ?>)">Edit</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Payment Methods Tab -->
                        <div class="tab-pane fade" id="payment-methods" role="tabpanel" aria-labelledby="payment-methods-tab">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_payment_method">
                                    <i class="fa fa-plus"></i> Add Payment Method
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                             <th>Picture</th>
                                            <th>Method Name</th>
                                            <th>Description</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $methods_result = $conn->query("SELECT * FROM tbl_subscription_payment_method");
                                        while ($method = $methods_result->fetch_assoc()):
                                        ?>
                                        <tr>
                                             <td>
                                                <?php if (!empty($method['method_picture'])): ?>
                                                    <img src="<?php echo htmlspecialchars($method['method_picture']); ?>" alt="Method Image" style="width: 50px;">
                                                <?php else: ?>
                                                    N/A
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($method['method_name']); ?></td>
                                            <td><?php echo htmlspecialchars($method['method_description']); ?></td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setEditModalData('method', <?php echo $method['payment_method_id']; ?>)">Edit</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pricing Tab -->
                        <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_pricing">
                                    <i class="fa fa-plus"></i> Add Pricing
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable">
                                    <thead>
                                        <tr>
                                            <th>Subscription Type</th>
                                            <th>Price</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $pricing_result = $conn->query("
                                            SELECT tbl_subscription_pricing.pricing_id, tbl_subscription_type.name, tbl_subscription_pricing.price
                                            FROM tbl_subscription_pricing
                                            JOIN tbl_subscription_type ON tbl_subscription_pricing.subscription_type_id = tbl_subscription_type.subscription_type_id
                                        ");
                                        while ($pricing = $pricing_result->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($pricing['name']); ?></td>
                                            <td><?php echo number_format($pricing['price'], 2); ?></td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setEditModalData('pricing', <?php echo $pricing['pricing_id']; ?>)">Edit</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->
        
        <!-- //*Modals for adding subscription type, payment methods, and pricing -->

        <!-- //*Add Subscription Type Modal -->
        <div id="add_subscription_type" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Subscription Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="subscription-settings.php">
                            <input type="hidden" name="add_type" value="1">
                            <div class="form-group">
                                <label>Type Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required placeholder="e.g., Monthly, Weekly, Half-Month">
                            </div>
                            <div class="form-group">
                                <label>Duration (in Days) <span class="text-danger">*</span></label>
                                <input type="number" name="duration_days" class="form-control" required>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- //*Add Payment Method Modal -->
        <div id="add_payment_method" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="subscription-settings.php">
                            <input type="hidden" name="add_payment_method" value="1">
                            <div class="form-group">
                                <label>Method Picture (URL)</label>
                                <input type="text" name="method_picture" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Method Name <span class="text-danger">*</span></label>
                                <input type="text" name="method_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Method Description</label>
                                <textarea name="method_description" class="form-control"></textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- //*Add Pricing Modal -->
        <div id="add_pricing" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Pricing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="subscription-settings.php">
                            <input type="hidden" name="add_pricing" value="1">
                            <div class="form-group">
                                <label>Subscription Type <span class="text-danger">*</span></label>
                                <select name="subscription_type_id" class="form-control" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <?php
                                    $types = $conn->query("SELECT * FROM tbl_subscription_type");
                                    while ($row = $types->fetch_assoc()) {
                                        echo "<option value='{$row['subscription_type_id']}'>" . htmlspecialchars($row['name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price <span class="text-danger">*</span></label>
                                <input type="number" name="price" step="0.01" class="form-control" required>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- end main wrapper -->

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

</body>
</html>
