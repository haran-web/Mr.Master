<?php
session_start();
include('db_connection.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to check for the admin
    $query = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id']; // Start session
            header('Location: admin-dashboard.php'); // Redirect to dashboard
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Admin not found!";
    }
}
?>
