<?php 
include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/db-connection.php';

// Fetch subscription types and their pricing
$subscription_types_query = "
    SELECT st.subscription_type_id, st.name AS type_name, st.duration_days, p.price 
    FROM tbl_subscription_type st
    LEFT JOIN tbl_subscription_pricing p ON st.subscription_type_id = p.subscription_type_id
";
$types_result = $conn->query($subscription_types_query);

// Fetch payment methods from the database
$payment_methods_query = "SELECT * FROM tbl_subscription_payment_method";
$methods_result = $conn->query($payment_methods_query);

// Fetch existing subscriptions
$subscriptions_query = "
    SELECT ms.subscription_id, ms.name, st.name AS subscription_type, ms.duration, ms.status, ms.created_at
    FROM tbl_member_subscription ms
    JOIN tbl_subscription_type st ON ms.subscription_type_id = st.subscription_type_id
";
$subscriptions_result = $conn->query($subscriptions_query);

// Query to fetch subscription data along with type and pricing details
$subscriptions_query = "
    SELECT s.*, st.name AS subscription_type, p.price
    FROM tbl_member_subscription s
    JOIN tbl_subscription_type st ON s.subscription_type_id = st.subscription_type_id
    JOIN tbl_subscription_pricing p ON s.subscription_type_id = p.subscription_type_id
    ORDER BY s.created_at DESC
";
$subscriptions_result = $conn->query($subscriptions_query);
?>

<head>
   <title>Create Subscription - HRMS admin template</title>
   <?php include 'layouts/title-meta.php'; ?>
   <?php include 'layouts/head-css.php'; ?>
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
                     <h3 class="page-title">Create Subscription</h3>
                     <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Subscription</li>
                     </ul>
                  </div>
                  <div class="col-auto float-end ms-auto">
                     <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#create_subscription"><i
                           class="fa fa-plus"></i> Create
                        Subscription</a>
                  </div>
               </div>
            </div>
            <!-- /Page Header -->

            <!-- //*Alerts -->
            <?php if (isset($_GET['success']) && $_GET['success'] === 'added'): ?>
            <div class="alert alert-success">Subscription added successfully!</div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] === 'database_error'): ?>
            <div class="alert alert-danger">Error adding subscription. Please try again.</div>
            <?php endif; ?>

            <!-- //*Search Filter -->
            <div class="row filter-row">
               <div class="col-md-6 col-md-3">
                  <div class="form-group form-focus">
                     <input type="text" class="form-control floating">
                     <label class="focus-label">Search</label>
                  </div>
               </div>
            </div>
            <!-- Search Filter -->

            <!-- Data Table for Existing Subscriptions -->
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-striped custom-table datatable">
                        <thead>
                           <tr>
                              <th>Subscription Name</th>
                              <th>Subscription Type</th>
                              <th>Duration (in Days)</th>
                              <th>Price</th>
                              <th>Status</th>
                              <th class="text-end">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if ($subscriptions_result && $subscriptions_result->num_rows > 0): ?>
                           <?php while ($subscription = $subscriptions_result->fetch_assoc()): ?>
                           <tr>
                              <td><?php echo htmlspecialchars($subscription['name']); ?></td>
                              <td><?php echo htmlspecialchars($subscription['subscription_type']); ?>
                              </td>
                              <td><?php echo htmlspecialchars($subscription['duration']); ?></td>
                              <td><?php echo '₱' . number_format($subscription['price'], 2); ?></td>
                              <td>
                                 <div class="dropdown action-label">
                                    <a href="#" class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                       <i
                                          class="fa fa-dot-circle-o <?php echo $subscription['status'] === 'active' ? 'text-success' : 'text-danger'; ?>"></i>
                                       <?php echo ucfirst($subscription['status']); ?>
                                    </a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i>
                                          Active</a>
                                       <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i>
                                          Inactive</a>
                                    </div>
                                 </div>
                              </td>

                              <td class="text-end">
                                 <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                       <i class="material-icons">more_vert</i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <a class="dropdown-item"
                                          href="view-subscription-details.php?id=<?php echo $subscription['subscription_id']; ?>">
                                          <i class="fa fa-eye m-r-5"></i> View Details
                                       </a>
                                       <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                          data-bs-target="#archive_subscription">
                                          <i class="fa fa-archive m-r-5"></i> Archive
                                       </a>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <?php endwhile; ?>
                           <?php else: ?>
                           <tr>
                              <td colspan="6" class="text-center">No subscriptions found</td>
                           </tr>
                           <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- /Data Table -->

            <!-- Create Subscription Modal -->
            <div id="create_subscription" class="modal custom-modal fade" role="dialog">
               <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Create Subscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <form action="process-create-subscription.php" method="POST">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="col-form-label">Subscription Name <span
                                          class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="subscription_name" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="col-form-label">Subscription Type <span
                                          class="text-danger">*</span></label>
                                    <select class="form-control" id="subscriptionType" name="subscription_type_id"
                                       required onchange="updatePricingAndDuration()">
                                       <option value="" disabled selected>Select Subscription
                                          Type</option>
                                       <?php while ($type = $types_result->fetch_assoc()): ?>
                                       <option value="<?php echo $type['subscription_type_id']; ?>"
                                          data-duration="<?php echo $type['duration_days']; ?>"
                                          data-price="<?php echo $type['price']; ?>">
                                          <?php echo htmlspecialchars($type['type_name']); ?>
                                       </option>
                                       <?php endwhile; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <label class="col-form-label">Pricing</label>
                                 <div class="form-group">
                                    <div class="input-group">
                                       <span class="input-group-text bg-default-light">₱</span>
                                       <input class="form-control" type="number" step="0.01" name="pricing" readonly>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="col-form-label">Duration (in days)</label>
                                    <input class="form-control" type="number" id="duration" name="duration" readonly>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="col-form-label">Payment Method</label>
                                    <select class="form-control" name="payment_method_id" required>
                                       <option value="" disabled selected>Select Payment
                                          Method</option>
                                       <?php while ($method = $methods_result->fetch_assoc()): ?>
                                       <option value="<?php echo $method['payment_method_id']; ?>">
                                          <?php echo htmlspecialchars($method['method_name']); ?>
                                       </option>
                                       <?php endwhile; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="col-form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="submit-section">
                              <button class="btn btn-primary submit-btn" type="submit">Create</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /Create Subscription Modal -->
         </div>
         <!-- /Page Content -->
      </div>
      <!-- /Page Wrapper -->
   </div>
   <!-- end main wrapper -->

   <?php include 'layouts/customizer.php'; ?>
   <?php include 'layouts/vendor-scripts.php'; ?>

   <script>
   document.getElementById('subscriptionType').addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const durationField = document.getElementById('duration');
      const pricingField = document.getElementsByName('pricing')[0];

      if (selectedOption) {
         const durationDays = selectedOption.getAttribute('data-duration');
         const price = selectedOption.getAttribute('data-price');

         durationField.value = durationDays;
         pricingField.value = price;
      }
   });
   </script>
</body>

</html>