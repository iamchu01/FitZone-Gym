<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/db-connection.php'; ?>
<?php 
$_SESSION['last_accessed'] = $_SERVER['PHP_SELF'];

 ?>

 
<head>
    <title>Dashboard - GYYMS Admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .card:hover {
            transition: transform 0.3s ease;
            transform: scale(1.05);
            background-color: #bff7d3;
        }  
        .card{
            width: 200px;
            align-items: center;
            height: 300px;
            margin: 1%;
            cursor: pointer;
        }
        .card img{
            width: auto;
            height: 250px;
        }
        .card.active {
            border: 2px solid #28a745;
            background-color: #d1e7dd;
        }
        .page-wrapper{
            width: 80%;
        }
    </style>
</head>

<body>
    <?php include 'layouts/body.php'; ?>
    <div class="main-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title"> Welcome Admin!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item fa fa-chevron-left"><a href="targeted-exercise.php"> Muscle groups</a></li>
                                <li class="breadcrumb-item active"> Shoulder Exercises</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">                   
                            <a href="" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#exerciseModal"><i class="fa fa-plus"></i>Add Exercises</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card-container">
                <div class="col card" id="anterior-deltiod" onclick="showExercises('anterior deltiod', this)">       
                    <img src="assets/img/s1.JPG" alt="Anterior deltiod">
                    <div class="card-body">
                        <h5 class="card-title">Anterior deltiod</h5> 
                    </div>
                </div>
                <div class="col card" id="medial-deltiod" onclick="showExercises('medial deltiod', this)">              
                    <img src="assets/img/s2.JPG" alt="Medial deltiod">
                    <div class="card-body">
                        <h5 class="card-title">Medial deltiod</h5> 
                    </div>
                </div>
                <div class="col card" id="posterior-deltiod" onclick="showExercises('posterior deltiod', this)">             
                    <img src="assets/img/s3.JPG" alt="Posterior deltiod">
                    <div class="card-body">
                        <h5 class="card-title">Posterior deltiod</h5> 
                    </div>
                </div>
            </div>

            <div class="row" id="exercise-list">
                <!-- Exercise items will be inserted here dynamically -->
            </div>

            <!-- Add Exercise Modal -->
            <div class="modal fade" id="exerciseModal" tabindex="-1" aria-labelledby="exerciseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exerciseModalLabel">Exercise Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="save-exercise.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="exercise_id" name="exercise_id" value="">
                                <div class="mb-3 text-center">
                                    <label for="exerciseImage" class="form-label">Exercise Image/GIF</label>
                                    <input type="file" class="form-control" id="exerciseImage" name="exerciseImage" accept="image/*,video/*" required onchange="previewImage(event)">
                                </div>
                                <div class="mb-3 text-center">
                                    <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                                </div>
                                <div class="mb-3">
                                    <label for="exerciseName" class="form-label">Exercise Name</label>
                                    <input type="text" class="form-control" id="exerciseName" name="exerciseName" placeholder="Enter exercise name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exerciseDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="exerciseDescription" name="exerciseDescription" rows="4" placeholder="Enter exercise description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="muscleCategory" class="form-label">Muscle Category</label>
                                    <select class="form-select" id="muscleCategory" name="muscleCategory" required>
                                        <option value="anterior deltiod">Anterior deltiod</option>
                                        <option value="medial deltiod">Medial deltiod</option>
                                        <option value="posterior deltiod">Posterior deltiod</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create exercise</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Edit Exercise Modal -->
<div class="modal fade" id="exerciseModalEdit" tabindex="-1" aria-labelledby="exerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exerciseModalLabel">Exercise Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="save-exercise.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="exercise_id" name="exercise_id" value="">
                    <div class="mb-3 text-center">
                        <label for="exerciseImageEdit" class="form-label">Exercise Image/GIF</label>
                        <input type="file" class="form-control" id="exerciseImageEdit" name="exerciseImage" accept="image/*,video/*" required onchange="previewImage(event)">
                    </div>
                    <div class="mb-3 text-center">
                        <img id="imagePreviewEdit" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                    </div>
                    <div class="mb-3">
                        <label for="exerciseNameEdit" class="form-label">Exercise Name</label>
                        <input type="text" class="form-control" id="exerciseNameEdit" name="exerciseName" placeholder="Enter exercise name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exerciseDescriptionEdit" class="form-label">Description</label>
                        <textarea class="form-control" id="exerciseDescriptionEdit" name="exerciseDescription" rows="4" placeholder="Enter exercise description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="muscleCategoryEdit" class="form-label">Muscle Category</label>
                        <select class="form-select" id="muscleCategoryEdit" name="muscleCategory" required>
                            <option value="anterior deltiod">Anterior deltiod</option>
                            <option value="medial deltiod">Medial deltiod</option>
                            <option value="posterior deltiod">Posterior deltiod</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save exercise</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Exercise Modal -->
<div class="modal fade" id="exerciseModalEdit" tabindex="-1" aria-labelledby="exerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exerciseModalLabel">Exercise Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="save-exercise.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="exercise_id" name="exercise_id" value="">
                    <div class="mb-3 text-center">
                        <label for="exerciseImageEdit" class="form-label">Exercise Image/GIF</label>
                        <input type="file" class="form-control" id="exerciseImageEdit" name="exerciseImage" accept="image/*,video/*" required onchange="previewImage(event)">
                    </div>
                    <div class="mb-3 text-center">
                        <img id="imagePreviewEdit" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                    </div>
                    <div class="mb-3">
                        <label for="exerciseNameEdit" class="form-label">Exercise Name</label>
                        <input type="text" class="form-control" id="exerciseNameEdit" name="exerciseName" placeholder="Enter exercise name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exerciseDescriptionEdit" class="form-label">Description</label>
                        <textarea class="form-control" id="exerciseDescriptionEdit" name="exerciseDescription" rows="4" placeholder="Enter exercise description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="muscleCategoryEdit" class="form-label">Muscle Category</label>
                        <select class="form-select" id="muscleCategoryEdit" name="muscleCategory" required>
                            <option value="anterior deltiod">Anterior deltiod</option>
                            <option value="medial deltiod">Medial deltiod</option>
                            <option value="posterior deltiod">Posterior deltiod</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save exercise</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="success-icon" style="font-size: 48px; color: #28a745;">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <h5 id="successMessage">Action completed successfully.</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
         <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this exercise?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a id="confirmDelete" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <!-- Left side: Image -->
                <div class="me-3" style="flex: 1; max-width: 300px;">
                    <img id="viewModalImage" class="img-fluid" alt="Exercise Image" style="border: 1px solid #dee2e6; width: 100%;">
                </div>
                <!-- Right side: Details -->
                <div style="flex: 2; border-left: 1px solid #dee2e6; padding-left: 20px;">
                    <h5 class="card-title" id="viewModalTitle">Exercise Name</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Target Muscle: <span id="viewModalCategory"></span></h6>
                    <p class="card-text" id="viewModalDescription">Exercise Description</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


            <?php include 'layouts/customizer.php'; ?>
            <?php include 'layouts/vendor-scripts.php'; ?>
        </div>
    </div>

    <script>
        // Image preview for exercise form
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; 
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        }

        // Show exercises based on muscle group
        function showExercises(category, element) {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => card.classList.remove('active'));
            element.classList.add('active');

            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch-exercises.php?category=' + encodeURIComponent(category), true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('exercise-list').innerHTML = this.responseText;
                } else {
                    document.getElementById('exercise-list').innerHTML = '<p>No exercises found.</p>';
                }
            };
            xhr.send();
        }

        // Show success modal with custom message
        function showSuccessModal(message) {
            document.getElementById('successMessage').textContent = message;
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }

        // Display success message if set in session
        <?php
        if (isset($_SESSION['message'])) {
            echo "<script>showSuccessModal('" . addslashes($_SESSION['message']) . "');</script>";
            unset($_SESSION['message']);
        }
        
        ?>
      function openEditModal(me_id, me_name, me_description, muscle_category, me_image) {
        document.getElementById('exercise_id').value = me_id;
        document.getElementById('exerciseNameEdit').value = me_name;
        document.getElementById('exerciseDescriptionEdit').value = me_description;
        document.getElementById('muscleCategoryEdit').value = muscle_category;

        if (me_image) {
            const image = 'data:image/jpeg;base64,' + me_image; 
            document.getElementById('imagePreviewEdit').src = image;
            document.getElementById('imagePreviewEdit').style.display = 'block';
        } else {
            document.getElementById('imagePreviewEdit').style.display = 'none';
        }

        const exerciseModal = new bootstrap.Modal(document.getElementById('exerciseModalEdit'));
        exerciseModal.show();
    }
    function openViewModal(id, name, description, category, image) {
        // Populate your modal with exercise details here
        document.getElementById('viewModalTitle').innerText = name;
        document.getElementById('viewModalCategory').innerText = category;
        document.getElementById('viewModalDescription').innerText = description;
        document.getElementById('viewModalImage').src = 'data:image/jpeg;base64,' + image;

        // Show the modal (assuming you're using Bootstrap modals)
        $('#viewModal').modal('show');
    }


    // JavaScript to handle delete modal
    document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var exerciseId = button.getAttribute('data-id');
        var redirectUrl = button.getAttribute('data-url');
        
        var confirmDelete = deleteModal.querySelector('#confirmDelete');
        confirmDelete.href = 'delete-exercise.php?id=' + exerciseId + '&redirect_url=' + redirectUrl;
    });
});

        
    </script>
</body>
</html>
