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
                            <a href="add-category.php" class="btn add-btn"><i class="fa fa-plus"></i> Add Category</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Category List Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Category Code</th>
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
                                            echo "<td>" . htmlspecialchars($row['category_code']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['category_description']) . "</td>";
                                            echo "<td>Admin</td>"; // Placeholder for 'Created By'
                                            echo '<td class="text-end">
                                                        <a href="#" class="btn btn-sm btn-info edit-btn la la-edit" data-id="' . $row['category_id'] . '" data-bs-toggle="modal" data-bs-target="#edit_category"></a>
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
                <div class="modal custom-modal fade" id="edit_category" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Category</h5>
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-category-form" enctype="multipart/form-data">
                                    <input type="hidden" id="edit-category-id" name="category_id">
                                    <div class="form-group">
                                        <label for="edit-category-name">Category Name</label>
                                        <input type="text" class="form-control" id="edit-category-name" name="category_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-category-code">Category Code</label>
                                        <input type="text" class="form-control" id="edit-category-code" name="category_code" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-category-description">Category Description</label>
                                        <textarea class="form-control" id="edit-category-description" name="category_description" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-category-image">Category Image</label>
                                        <input type="file" class="form-control" id="edit-category-image" name="category_image" accept="image/*">
                                        <div class="mt-2">
                                            <img id="edit-image-preview" src="#" alt="Current Image" style="max-width: 100%; height: auto; display: none;">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
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

            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- end main wrapper-->

    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

    <script>
        // Edit modal
        document.addEventListener('DOMContentLoaded', function() {
            // Handle Edit button clicks
            const editButtons = document.querySelectorAll('.edit-btn');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    
                    // Fetch category data from the server
                    fetch('get-category.php?category_id=' + categoryId)
                        .then(response => response.json())
                        .then(data => {
                            if (data) {
                                // Populate the modal fields with fetched data
                                document.getElementById('edit-category-id').value = data.category_id;
                                document.getElementById('edit-category-name').value = data.category_name;
                                document.getElementById('edit-category-code').value = data.category_code;
                                document.getElementById('edit-category-description').value = data.category_description;

                                // Set current image preview
                                const imagePreview = document.getElementById('edit-image-preview');
                                if (data.category_image) {
                                    imagePreview.src = 'data:image/jpeg;base64,' + data.category_image;
                                    imagePreview.style.display = 'block';
                                } else {
                                    imagePreview.style.display = 'none';
                                }
                            } else {
                                console.error('No data found for the provided category ID.');
                            }
                        })
                        .catch(error => console.error('Error fetching category data:', error));
                });
            });

            // Handle form submission for editing
            document.getElementById('edit-category-form').addEventListener('submit', function(event) {
                event.preventDefault();
                
                const formData = new FormData(this);
                
                fetch('update-category.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    alert(result);
                    location.reload(); // Refresh the page to show updated data
                })
                .catch(error => console.error('Error updating category:', error));
            });

            // Handle image preview on file input change
            document.getElementById('edit-category-image').addEventListener('change', function(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('edit-image-preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        });

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

            // Handle the deletion when the confirm button is clicked
            document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');

                // Send AJAX request to delete the category
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete-category.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // If the deletion is successful, refresh the page or remove the category row
                        alert('Category deleted successfully');
                        location.reload(); // Refresh the page
                    } else {
                        alert('Error deleting category.');
                    }
                };
                xhr.send('category_id=' + categoryId); // Send the category ID to the server
            });
        });
    </script>
</body>
</html>
