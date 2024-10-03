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
        .sort-indicator {
    font-size: 0.8em;
    margin-left: 5px;
    color: #888;
}
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
        .dropdown-item:hover{
            transition: transform 0.3s ease;
            transform: scale(1.05);
            background-color: #48c92f;
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
                            <h3 class="page-title"> Chest Exercises</h3>
                            <ul class="breadcrumb">
                                 <li class="breadcrumb-item active"> Chest Exercises</li>
                                <li class="breadcrumb-item "><a href="targeted-exercise.php"> Muscle groups</a></li>
                                
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">                   
                            <a href="" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#exerciseModal"><i class="fa fa-plus"></i>Add Exercises</a>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Targeted muscle</h4>
            <div class="row card-container">
                <div class="col card" id="upper-chest" onclick="showExercises('upper chest', this)">       
                    <img src="assets/img/c1.JPG" alt="upper-chest">
                    <div class="card-body">
                        <h5 class="card-title">Upper chest</h5> 
                    </div>
                </div>
                <div class="col card" id="middle-chest" onclick="showExercises('middle chest', this)">              
                    <img src="assets/img/c2.JPG" alt="middle-chest">
                    <div class="card-body">
                        <h5 class="card-title">Middle chest</h5> 
                    </div>
                </div>
                <div class="col card" id="lower-chest" onclick="showExercises('lower chest', this)">             
                    <img src="assets/img/c3.JPG" alt="lower-chest"> 
                    <div class="card-body">
                        <h5 class="card-title">Lower chest</h5> 
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
                                <input type="hidden" id="exercise_id" name="exercise_id" value="<?php echo htmlspecialchars($exercise_id); ?>">
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
                                        <option value="upper chest">upper chest</option>
                                        <option value="middle chest">middle chest</option>
                                        <option value="lower chest">lower chest</option>
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
                <form action="update-exercise.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="exercise_id" name="exercise_id" value="<?php echo $exercise_id; ?>">

                    <!-- Current Image Display -->
                    <div>
                        <label>Current Image:</label>
                        <img id="imagePreviewEdit" src="" alt="Current Item Image" style="max-width: 100px; max-height: 100px; display: none;">
                        <p id="noImageMessage" style="display: none;">No image available.</p>
                    </div>
                    <div>
                        <label>Upload New Image:</label>
                        <input type="file" class="form-control" id="exerciseImageEdit" name="exerciseImage" accept="image/*,video/*" onchange="previewImage(event)">
                        <small>(Leave empty to keep the current image)</small>
                    </div>

                    <!-- Exercise Name -->
                    <div class="mb-3">
                        <label for="exerciseNameEdit" class="form-label">Exercise Name</label>
                        <input type="text" class="form-control" id="exerciseNameEdit" name="exerciseName" placeholder="Enter exercise name" required>
                    </div>
                    
                    <!-- Exercise Description -->
                    <div class="mb-3">
                        <label for="exerciseDescriptionEdit" class="form-label">Description</label>
                        <textarea class="form-control" id="exerciseDescriptionEdit" name="exerciseDescription" rows="4" placeholder="Enter exercise description" required></textarea>
                    </div>
                    
                    <!-- Muscle Category -->
                    <div class="mb-3">
                        <label for="muscleCategoryEdit" class="form-label">Muscle Category</label>
                        <select class="form-select" id="muscleCategoryEdit" name="muscleCategory" required>
                            <option value="upper chest">upper chest</option>
                            <option value="middle chest">middle chest</option>
                            <option value="lower chest">lower chest</option>
                        </select>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save exercise</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                <!-- Delete exercise Modal -->
            <div class="modal custom-modal fade" id="deleteModal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Exercise</h3>
                                    <p>Are you sure you want to delete this exercise?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" id="confirmDelete" class="btn btn-primary continue-btn">Delete</a>
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
                    <h1 class="card-title" id="viewModalTitle">Exercise Name</h1>
                    <h6 class="card-subtitle mb-2 text-muted">Target Muscle: <span id="viewModalCategory"></span></h6>
                    <div style="max-height: 200px; overflow-y: auto;" id="viewModalDescriptionContainer">
                        <p class="card-text" id="viewModalDescription">
                            <?php
                                // Assuming $item['description'] holds the description
                                $description = nl2br(htmlspecialchars($item['description'])); // Convert newlines to <br> and escape HTML
                                echo $description;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
        function enableImageUpload() {
    document.getElementById('exerciseImageEdit').style.display = 'block';
    document.getElementById('uploadButton').style.display = 'none'; // Hide the button once clicked
}

// Function to preview the selected image
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('imagePreviewEdit');
        output.src = reader.result;
        output.style.display = 'block'; // Show the preview
    };
    reader.readAsDataURL(event.target.files[0]);
}


function openEditModal(me_id, me_name, me_description, muscle_category, me_image) {
    document.getElementById('exercise_id').value = me_id;
    document.getElementById('exerciseNameEdit').value = me_name;
    document.getElementById('exerciseDescriptionEdit').value = me_description;
    document.getElementById('muscleCategoryEdit').value = muscle_category;

    // Set the image source directly to the Base64 string
    if (me_image) {
        const image = 'data:image/jpeg;base64,' + me_image; 
        document.getElementById('imagePreviewEdit').src = image;
        document.getElementById('imagePreviewEdit').style.display = 'block'; // Show the image
        document.getElementById('noImageMessage').style.display = 'none'; // Hide no image message
    } else {
        document.getElementById('imagePreviewEdit').style.display = 'none'; // Hide image if no image
        document.getElementById('noImageMessage').style.display = 'block'; // Show no image message
    }

    const exerciseModal = new bootstrap.Modal(document.getElementById('exerciseModalEdit'));
    exerciseModal.show();
}


    // view modal
         let description = "This is a description.\nIt has a new line.";


        function openViewModal(id, name, description, category, image) {
            // Populate your modal with exercise details here
            document.getElementById('viewModalTitle').innerText = name;
            document.getElementById('viewModalCategory').innerText = category;

            // Use innerHTML to allow <br> tags, ensuring proper encoding
            document.getElementById('viewModalDescription').innerHTML = description.replace(/\n/g, '<br>');

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
