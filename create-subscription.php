<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Create Subscription - Gym Admin</title>

    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>

    <style>
        .form-label span {
            color: red;
        }

        .card {
            /* max-width: 90%;  */
            margin: 10px 
        }

        .card-header {
            background-color: #48c92f;
            color: #fff;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
        }

        .feature-input-group {
            display: flex;
            margin-bottom: 10px;
        }

        .feature-input-group input {
            flex: 1;
        }

.remove-feature-btn {
    margin-left: 10px;
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 10px 10px;
    border-radius: 8px; /* Moderate rounded corners for a modern look */
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease; /* Quick but subtle transitions */
    font-weight: 500;
    font-size: 14px;
}

.remove-feature-btn:hover {
    background-color: #b02a37; /* Slightly darker red, more polished feel */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Very subtle shadow to suggest elevation */
    transform: translateY(-2px); /* Button moves up slightly to suggest clickability */
}



.btn-custom-green {
    color: #fff;
    background-color: #48c92f;
    border: none;
    padding: 10px 10px;
    border-radius: 8px; /* Moderate rounded corners */
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease; /* Quick, subtle transitions */
    font-weight: 500;
    font-size: 14px;
}

.btn-custom-green:hover {
    background-color: #3a9e24; /* Slightly darker green */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transform: translateY(-2px); /* Slight upward movement */
}

.btn-custom-subscription{
    color: #fff;
    background-color: #48c92f;
    border: none;
    padding: 10px 10px;
    border-radius: 8px; /* Moderate rounded corners */
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease; /* Quick, subtle transitions */
}

.btn-custom-subscription:hover{
    background-color: #3a9e24; /* Slightly darker green */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    transform: translateY(-2px); /* Slight upward movement */
}



    </style>

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
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Create Subscription Plan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create Subscription Plan</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">New Subscription Plan Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="process-subscription.php" method="POST">
                                <div class="mb-3">
                                    <label for="planName" class="form-label">Plan Name <span>*</span></label>
                                    <input type="text" class="form-control" id="planName" name="planName" placeholder="Enter plan name (e.g., Weekly, Monthly)" required>
                                </div>

                                <div class="mb-3">
                                    <label for="planPrice" class="form-label">Plan Price (₱) <span>*</span></label>
                                    <input type="number" class="form-control" id="planPrice" name="planPrice" placeholder="Enter price (₱)" step="0.01" min="0" required>
                                </div>

                                <div class="mb-3">
                                    <label for="planType" class="form-label">Plan Type <span>*</span></label>
                                    <select class="form-select" id="planType" name="planType" required>
                                        <option value="">Select Plan Type</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="annual">Annual</option>
                                    </select>
                                </div>

                                <!-- Customizable Features Section -->
                                <div class="mb-3">
                                    <label class="form-label">Included Features <span>*</span></label>
                                    <div id="featuresContainer">
                                        <div class="feature-input-group">
                                            <input type="text" class="form-control" name="features[]" placeholder="Enter feature (e.g., Free Gym Shirt)" required>
                                            <button type="button" class=" remove-feature-btn" onclick="removeFeature(this)">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" class=" btn-custom-green" onclick="addFeature()">Add Feature</button>
                                </div>

                                <div class="mb-3">
                                    <label for="planDescription" class="form-label">Plan Description</label>
                                    <textarea class="form-control" id="planDescription" name="planDescription" rows="4" placeholder="Enter additional details about the subscription plan"></textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn-custom-subscription">Create Subscription</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
            
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script>
// JavaScript to dynamically add and remove features
function addFeature() {
    const featureGroup = document.createElement('div');
    featureGroup.classList.add('feature-input-group');

    const featureInput = document.createElement('input');
    featureInput.type = 'text';
    featureInput.name = 'features[]';
    featureInput.classList.add('form-control');
    featureInput.placeholder = 'Enter feature (e.g., Free Gym Shirt)';
    featureInput.required = true;

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.classList.add('remove-feature-btn');
    removeBtn.innerHTML = 'Remove';
    removeBtn.onclick = function() {
        removeFeature(removeBtn);
    };

    featureGroup.appendChild(featureInput);
    featureGroup.appendChild(removeBtn);

    document.getElementById('featuresContainer').appendChild(featureGroup);
}

function removeFeature(button) {
    const featureGroup = button.parentElement;
    document.getElementById('featuresContainer').removeChild(featureGroup);
}
</script>

</body>

</html>
