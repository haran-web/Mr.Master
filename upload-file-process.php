<?php
session_start();
include('db_connection.php');

if ($_SESSION['admin_id']) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $grade = $_POST['grade'];
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
        // Check for valid file types
        if (in_array($file_ext, ['pdf', 'doc', 'docx'])) {
            $upload_path = 'uploads/' . $grade . '/' . $file_name;
            move_uploaded_file($file_tmp, $upload_path);
            
            // Save file details in database
            $query = "INSERT INTO papers (grade, file_name, file_size, file_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssis", $grade, $file_name, $_FILES['file']['size'], $upload_path);
            $stmt->execute();
            
            echo "File uploaded successfully!";
        } else {
            echo "Invalid file type!";
        }
    }
} else {
    echo "You must be logged in as admin!";
}
?>
