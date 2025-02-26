<?php
// Example PHP code for downloading papers
if (isset($_GET['id'])) {
    $paper_id = $_GET['id'];

    // Connect to the database
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "mr_master";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch paper details
    $sql = "SELECT * FROM pass_papers WHERE id = '$paper_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path']; // Assuming the paper's file path is stored in the database

        if (file_exists($file_path)) {
            // Simulate payment system here
            // You can integrate payment logic with a payment gateway

            // Allow the file to be downloaded
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            readfile($file_path);
            exit;
        } else {
            echo "File not found!";
        }
    } else {
        echo "Paper not found!";
    }

    $conn->close();
}
?>
