<?php
include('db_connection.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encrypt password

    // Get user IP address
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Insert user into database
    $query = "INSERT INTO users (username, password, email, ip_address) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $ip_address);
    $stmt->execute();
    
    echo "Registration successful!";
}
?>
