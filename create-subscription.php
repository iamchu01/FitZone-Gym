<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Create Subscription - Gym Admin</title>

    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>

    <style>

.form-label {
    font-size: 18px;
    font-weight: 600; 
    color: #2c3e50; 
    margin-bottom: 5px; 
    display: block;
    line-height: 1.5; 
}


.form-label span {
    color: #e74c3c; 
}


input, select, textarea {
    font-size: 16px; 
    padding: 12px; 
    border-radius: 8px; 
    border: 1px solid #ccc; 
}

input:focus, select:focus, textarea:focus {
    border-color: #5cbf6b; 
    outline: none; 
    box-shadow: 0 0 5px rgba(92, 191, 107, 0.3); 
}

.mb-3 {
    margin-bottom: 25px; 
}


.input-group-text {
    background-color: #f5f5f5; /* Subtle background color for currency symbol */
    font-weight: bold;
    border: 1px solid #ccc;
    border-radius: 0;
}


input[type="number"] {
    padding: 10px;
    font-size: 16px;
    border-radius: 0 8px 8px 0; /* Rounded corners on the right side for a modern look */
    border: 1px solid #ccc;
}

input::placeholder {
    color: #aaa; /* Subtle placeholder color */
}



.card-header {
    background: linear-gradient(90deg, #5cbf6b 0%, #4caf50 100%);
    color: #f0f0f0;
    padding: 15px;
    font-size: 24px;
    font-weight: 600; 
    text-align: center;
    border-radius: 8px 8px 0 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-bottom: 3px solid #218838;
}


.card-header .card-title-custom {
    color: #f0f0f0 !important; 
    font-size: 26px !important; 
    font-weight: bold; 
    letter-spacing: 1px; 
    margin: 0;
}

.card-header {
    border-bottom: 3px solid #218838;
}


.feature-input-group {
    display: flex;
    align-items: center; 
    margin-bottom: 10px;
}

.feature-input-group input {
    flex: 1;
    padding: 10px; 
    font-size: 16px; 
    margin-right: 10px; 
}


.remove-feature-btn {
    margin-left: 10px;
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px; 
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}

.remove-feature-btn:hover {
    background-color: #b02a37;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}


.btn-add-feature{
    color: #fff;
    background-color: #28a745;
    border: none;
    padding: 12px 20px; 
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px; 
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    font-weight: 600;
}

.btn-add-feature:hover{
    background-color: #218838;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.btn-custom-green.mt-2 {
    margin-top: 10px;
}

.btn-create-subscription {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 20px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    font-weight: 600;
}

.btn-create-subscription:hover {
    background-color: #218838;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.btn-preview-subscription {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    font-weight: bold;
}

.btn-preview-subscription:hover {
    background-color: #0056b3;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.btn-save-draft {
    background-color: #6c757d; 
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    font-weight: bold;
}

.btn-save-draft:hover {
    background-color: #5a6268;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.d-flex {
    display: flex;
    justify-content: space-between; 
    gap: 10px;
}

.btn-create-subscription, .btn-preview-subscription, .btn-save-draft {
    width: auto; 
    flex: 1; 
}


.d-grid .mt-2 {
    margin-top: 10px; 
}

textarea {
    font-size: 16px; 
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* Styling for the Pricing section label */
.pricing-section-label {
    font-size: 20px; /* Slightly larger font size for section header */
    font-weight: bold; /* Bold to emphasize the section */
    color: #2c3e50; /* Darker color for better contrast */
    display: block; /* Ensure it stays on its own line */
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
                            <h4 class="card-title card-title-custom">New Subscription Plan Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="process-subscription.php" method="POST">
                                <!-- Plan Name -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="planName" class="form-label">Plan Name <span>*</span></label>
                                        <input type="text" class="form-control" id="planName" name="planName" placeholder="Enter plan name (e.g., Weekly, Monthly)" required>
                                    </div>

                                    <!-- Plan Duration -->
                                    <div class="col-md-6 mb-4">
                                        <label for="planDuration" class="form-label">Plan Duration <span>*</span></label>
                                        <select class="form-select" id="planDuration" name="planDuration" required>
                                            <option value="">Select Plan Duration</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="halfMonth">Half Month</option>
                                        </select>
                                    </div>
                                </div>



                                <!-- Pricing Section -->
                               <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="regularPrice" class="form-label">Regular Price <span>*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" class="form-control" id="regularPrice" name="regularPrice" placeholder="Enter regular price" step="0.01" min="0" required onkeydown="preventE(event)">
                                    </div>
                                </div>

                                <!-- Student Price -->
                                <div class="col-md-6 mb-4">
                                    <label for="studentPrice" class="form-label">Student Price <span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" class="form-control" id="studentPrice" name="studentPrice" placeholder="Enter student price" step="0.01" min="0" required required onkeydown="preventE(event)">
                                    </div>
                                </div>
                            </div>


                                

                                <!-- Customizable Features Section -->
                                <div class="mb-4">
                                    <label class="form-label">Included Features <span>*</span></label>
                                    <div id="featuresContainer">
                                        <div class="feature-input-group">
                                            <input type="text" class="form-control" name="features[]" placeholder="Enter feature (e.g., Free Gym Shirt)" required>
                                            <button type="button" class="remove-feature-btn" onclick="removeFeature(this)">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-add-feature" onclick="addFeature()">Add Feature</button>
                                </div>

                                <!-- Plan Description -->
                                <div class="mb-4">
                                    <label for="planDescription" class="form-label">Plan Description</label>
                                    <textarea class="form-control" id="planDescription" name="planDescription" rows="4" placeholder="Enter additional details about the subscription plan"></textarea>
                                </div>

                                <!-- Status Toggle -->
                                <!-- <div class="mb-4">
                                    <label for="planStatus" class="form-label">Plan Status</label>
                                    <select class="form-select" id="planStatus" name="planStatus">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div> -->

                                <!-- Buttons: Submit, Preview, Save as Draft -->
                                <div class="d-flex justify-content-between mb-2">
                                    <button type="submit" class="btn-create-subscription">Create Subscription</button>
                                    <!-- <button type="button" class="btn-preview-subscription">Preview Subscription</button>
                                    <button type="button" class="btn-save-draft">Save as Draft</button> -->
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

function preventE(event) {
    if (event.key === 'e' || event.key === 'E' || event.key === '+' || event.key === '-') {
        event.preventDefault(); // Prevents these keys from being input
    }
}
</script>

</body>

</html>
