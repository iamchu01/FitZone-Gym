<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>

<head>
    <title>Product Category List - GYYMS Admin</title>
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
                            <h3 class="page-title">Product Category List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin-dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Category List</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    Add Category
</button>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCategoryForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Category Form Fields -->
                    <div class="form-group">
                        <label>Image Preview</label>
                        <img id="image-preview" src="#" alt="Image Preview" class="img-fluid d-none">
                    </div>
                    <div class="form-group">
                        <label for="category_image">Category Image</label>
                        <input type="file" id="category_image" name="category_image" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    </div>
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_description">Category Description</label>
                        <textarea id="category_description" name="category_description" class="form-control" required></textarea>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
                <!-- Category List Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    // Query to retrieve categories from the database
                                    $sql = "SELECT * FROM category";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Loop through each category and display it
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['category_description']) . "</td>";
                                            echo "<td>Admin</td>"; // Placeholder for 'Created By'
                                            echo '<td class="text-end">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-info edit-btn la la-edit" data-id="' . $row['category_id'] . '" onclick="openEditModal(' . $row['category_id'] . ')"></a>
                                                    <a href="#" class="btn btn-sm btn-danger delete-btn la la-trash" data-id="' . $row['category_id'] . '" data-bs-toggle="modal" data-bs-target="#delete_estimate"></a>
                                                </td>';
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No categories found.</td></tr>";
                                    }

                                    // Close the database connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Category List Table -->

                <!-- Edit Category Modal -->
                    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editCategoryForm">
                                        <input type="hidden" id="category_id" name="category_id">
                                        <div class="form-group">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_code">Category Code</label>
                                            <input type="text" class="form-control" id="category_code" name="category_code" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_description">Description</label>
                                            <textarea class="form-control" id="category_description" name="category_description" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_image">Category Image</label>
                                            <input type="file" class="form-control" id="category_image" name="category_image">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="saveCategoryButton">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- /Edit Category Modal -->

                <!-- Delete Category Modal -->
                <div class="modal custom-modal fade" id="delete_estimate" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Category</h3>
                                    <p>Are you sure you want to delete this category?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" id="confirm-delete-btn" class="btn btn-primary continue-btn">Delete</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Delete Category Modal -->
                 <!-- Delete Success Modal -->
                <div class="modal custom-modal fade" id="delete-success-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Category Deleted</h5>
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Category has been deleted successfully.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
<!-- /Delete Success Modal -->


            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- end main wrapper-->

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

    <script>
       // Function to open the edit modal and populate the data
function openEditModal(categoryId) {
    fetch(`update-category.php?id=${categoryId}`) // Fetch category data using an AJAX call
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Populate the modal fields with fetched data
                document.getElementById('category_id').value = data.category.category_id;
                document.getElementById('category_name').value = data.category.category_name;
                document.getElementById('category_code').value = data.category.category_code;
                document.getElementById('category_description').value = data.category.category_description;
                // Show the modal
                $('#editCategoryModal').modal('show');
            } else {
                alert(data.message); // Handle error
            }
        })
        .catch(error => console.error('Error:', error));
}


       // Delete modal
document.addEventListener('DOMContentLoaded', function() {
    // Get all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the category ID from the button's data-id attribute
            const categoryId = this.getAttribute('data-id');
            
            // Set the category ID in the modal
            document.getElementById('confirm-delete-btn').setAttribute('data-id', categoryId);
        });
    });

    document.getElementById('confirm-delete-btn').addEventListener('click', function() {
        const categoryId = this.getAttribute('data-id');

        // Send AJAX request to delete the category
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete-category.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            const response = JSON.parse(xhr.responseText); // Parse the JSON response
            if (response.status === 'success') {
                // Show the delete success modal
                $('#delete-success-modal').modal('show'); // Use Bootstrap's modal method
                setTimeout(function() {
                    location.reload(); // Refresh the page
                }, 2000); // Delay for 2 seconds before reload
            } else {
                // Show an alert with the error message
                alert(response.message); // Display error message from server
            }
        };
        xhr.send('category_id=' + categoryId); // Send the category ID to the server
    });
});

// Image preview function
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.classList.remove('d-none'); // Show the image
    };
    reader.readAsDataURL(event.target.files[0]);
}

// AJAX form submission
$(document).ready(function() {
    $('#addCategoryForm').submit(function(e) {
        e.preventDefault();
        
        // Prepare form data
        var formData = new FormData(this);

        $.ajax({
            url: 'add-category.php', // PHP script for handling insertion
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Show success message or handle response
                alert("Category added successfully!");
                $('#addCategoryModal').modal('hide'); // Hide the modal on success
                location.reload(); // Reload to see the new category in the list
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });
});


    </script>
</body>
</html>
