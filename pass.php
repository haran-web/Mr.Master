<?php
// Example PHP code for the Pass Papers Page
// Connect to the database (make sure to replace with your actual database credentials)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "mr_master";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching papers by year from the database
$year = isset($_GET['year']) ? $_GET['year'] : '2020';  // Default to 2020 if no year is selected
$sql = "SELECT * FROM pass_papers WHERE year = '$year'";
$result = $conn->query($sql);
?>
