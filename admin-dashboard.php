<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.html');
    exit;
}
?>
<h1>Welcome, Admin</h1>
<a href="upload-file.php">Upload Tute/Papers</a>
