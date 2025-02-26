<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.html');
    exit;
}
?>

<form action="upload-file-process.php" method="POST" enctype="multipart/form-data">
    <label for="grade">Grade:</label>
    <input type="text" id="grade" name="grade" required><br>

    <label for="file">Select Paper:</label>
    <input type="file" name="file" required><br>

    <button type="submit">Upload Paper</button>
</form>
