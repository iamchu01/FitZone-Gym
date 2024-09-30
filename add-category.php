<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $category_name = $_POST['category_name'];
    $category_code = $_POST['category_code'];
    $category_description = $_POST['category_description'];

    // Handle file upload
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == 0) {
        $image_name = $_FILES['category_image']['name'];
        $image_tmp = $_FILES['category_image']['tmp_name'];

        // Read the image file into a binary string
        $image_data = file_get_contents($image_tmp);
        $image_data = mysqli_real_escape_string($conn, $image_data); // Sanitize binary data for SQL insertion

        // SQL Query to insert data into the category table
        $sql = "INSERT INTO category (category_image, category_name, category_code, category_description)
        VALUES ('$image_data', '$category_name', '$category_code', '$category_description')";


        if ($conn->query($sql) === TRUE) {
            $message = "New category added successfully!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Please upload an image.";
    }
}

$conn->close();
?>

<head>
    <title>Add Category - GYYMS Admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        /* Reuse styles from the enrollment form */
        .form-section-custom {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 10px; /* Reduce the top margin to move it up */
        }

        .form-group-custom {
            margin-bottom: 10px;
        }

        .form-group-custom label {
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .form-group-custom input,
        .form-group-custom select,
        .form-group-custom textarea {
            padding: 10px;
            font-size: 0.95rem;
            width: 100%;
        }

        .form-group-custom input[type="file"] {
            padding: 5px;
        }

        .form-group-custom img {
            max-width: 100%;
            height: auto;
        }

        .custom-submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            margin-bottom: 0; /* Ensure there's no margin below the button */
        }

        .custom-submit-btn:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .custom-submit-btn {
                font-size: 1rem;
            }
        }

        /* Remove any excess padding from the container */
        .content.container-fluid {
            padding-bottom: 0 !important;
        }
    </style>
</head>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid" style="padding-top: 10px;"> <!-- Reduce padding to move form higher -->
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add New Category</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>                   
                            <li class="breadcrumb-item"><a href="category-list.php">Category List</a></li>   
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Add Category Form -->
            <div class="form-section-custom"> <!-- Reusing section format -->
                <!-- Display status message -->
                <?php if (!empty($message)): ?>
                    <div class="alert alert-info">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group-custom">
    <label for="category-image">Category Image</label>
    <input type="file" class="form-control" id="category-image" name="category_image" accept="image/*" required onchange="previewImage(event)">
</div>

<div class="form-group-custom">
    <label>Image Preview</label>
    <br>
    <img id="image-preview" src="#" alt="Image Preview" class="img-fluid d-none">
</div>

                    <div class="form-group-custom">
                        <label for="category-name">Category Name</label>
                        <input type="text" class="form-control" id="category-name" name="category_name" required>
                    </div>

                    <div class="form-group-custom">
                        <label for="category-code">Category Code</label>
                        <input type="text" class="form-control" id="category-code" name="category_code" required>
                    </div>

                    <div class="form-group-custom">
                        <label for="category-description">Category Description</label>
                        <textarea class="form-control" id="category-description" name="category_description" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary custom-submit-btn">Add Category</button>
                </form>
            </div>
            <!-- /Add Category Form -->
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
