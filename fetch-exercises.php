<?php
include 'layouts/db-connection.php';
session_start(); 

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $stmt = $conn->prepare("SELECT * FROM muscle_exercise WHERE muscle_category = ?");
    $stmt->bind_param("s", $category);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-bordered">';
            echo '<thead><tr><th>Illustration</th><th>Name</th><th>Muscle Category</th><th>Description</th><th>Actions</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['me_image']) . '" alt="' . htmlspecialchars($row['me_name'] . ' exercise image') . '" style="width: 100px;"></td>';
                echo '<td>' . htmlspecialchars($row['me_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['muscle_category']) . '</td>';
                echo '<td>' . htmlspecialchars($row['me_description']) . '</td>';
                echo '<td>
                        <button class="btn btn-warning btn-sm la la-edit" onclick="openEditModal(' . $row['me_id'] . ', \'' . addslashes($row['me_name']) . '\', \'' . addslashes($row['me_description']) . '\', \'' . addslashes($row['muscle_category']) . '\', \'' . base64_encode($row['me_image']) . '\')">Edit</button>
                        <a href="delete-exercise.php?id=' . $row['me_id'] . '" class="btn btn-danger btn-sm la la-trash" onclick="return confirm(\'Are you sure you want to delete this exercise?\');">Delete</a>
                      </td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No exercises found in this category.</p>';
        }
    } else {
        echo '<p>Error executing query.</p>';
    }

    $stmt->close();
}
?>