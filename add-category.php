<?php 
include 'layouts/session.php'; 
include 'layouts/head-main.php'; 
include 'layouts/db-connection.php'; 

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_description = mysqli_real_escape_string($conn, $_POST['category_description']);

    // Handle file upload
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == 0) {
        $image_name = $_FILES['category_image']['name'];
        $image_tmp = $_FILES['category_image']['tmp_name'];
        $image_size = $_FILES['category_image']['size'];

        // Check the file size (e.g., max 2MB)
        if ($image_size > 2097152) {
            $message = "Error: Image size should not exceed 2MB.";
        } else {
            // Read the image file into a binary string
            $image_data = file_get_contents($image_tmp);
            $image_data = mysqli_real_escape_string($conn, $image_data); // Sanitize binary data for SQL insertion

            // SQL Query to insert data into the category table
            $sql = "INSERT INTO category (category_image, category_name, category_description)
                    VALUES ('$image_data', '$category_name', '$category_description')";

            if ($conn->query($sql) === TRUE) {
                $message = "New category added successfully!";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
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
        /* Additional styles omitted for brevity */
    </style>
</head>

<div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>
    
    <div class="page-wrapper">
        <div class="content container-fluid" style="padding-top: 10px;">
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

            <!-- Add Category Form -->
            <div class="form-section-custom">
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
                        <label for="category-description">Category Description</label>
                        <textarea class="form-control" id="category-description" name="category_description" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary custom-submit-btn">Add Category</button>
                </form>
            </div>

            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Category Added Successfully</h5> 
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Category successfully added!</p>
                        </div>
                        <div class="modal-footer">
                            <a href="add-category.php" class="btn btn-primary">OK</a> 
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End of content container -->

        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('image-preview');
                    output.src = reader.result;
                    output.classList.remove('d-none'); // Show the image by removing the 'd-none' class
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            $(document).ready(function() {
                <?php if ($message === "New category added successfully!"): ?>
                    $("#successModal").modal("show"); 
                <?php endif; ?>
            });
    </script>

        <?php include 'layouts/customizer.php'; ?>
        <?php include 'layouts/vendor-scripts.php'; ?>
    </div> <!-- End of page-wrapper -->
</div> <!-- End of main-wrapper -->

</body>
</html>
