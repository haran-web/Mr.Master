<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login.php"); // Redirect to login if not admin
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "mr_master";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        $image = null;
    }

    // Insert into database
    $sql = "INSERT INTO books (title, author, description, image) VALUES ('$title', '$author', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "New book added successfully.";
        header("Location: book.php"); // Redirect back to books page after adding
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
