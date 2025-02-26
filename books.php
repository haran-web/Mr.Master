<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "mr_master";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books from the database
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);

// Check if the user is an admin
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Mr. Master</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #e6f7ff; /* Light blue */
        }

        header {
            background-color: #0073e6;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .back-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #005bb5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #004494;
        }

        .book-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 books per row */
            gap: 20px;
            justify-items: center;
            margin-top: 30px;
        }

        .book-box {
            width: 200px;
            height: 250px;
            background-color: white;
            color: #0073e6;
            padding: 10px;
            border: 3px solid #0073e6;
            border-radius: 10px;
            transition: 0.3s;
        }

        .book-box:hover {
            background-color: #0073e6;
            color: white;
        }

        .add-book-form {
            display: none;
            background-color: white;
            padding: 20px;
            border: 3px solid #0073e6;
            border-radius: 10px;
            margin-top: 20px;
        }

        .add-book-form input, .add-book-form textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #0073e6;
            border-radius: 5px;
        }

        .add-book-form button {
            background-color: #0073e6;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .add-book-form button:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>

    <header>
        <h1>Books</h1>
        <a href="services.html" class="back-button">Back to Services</a>
    </header>

    <main>
        <div class="book-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-box'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>Author: " . $row['author'] . "</p>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No books available.</p>";
            }
            ?>
        </div>

        <?php if ($is_admin): ?>
            <!-- Admin Section: Add Book -->
            <div class="add-book-form" id="add-book-form">
                <h3>Add New Book</h3>
                <form action="add-book.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Book Title" required>
                    <input type="text" name="author" placeholder="Author" required>
                    <textarea name="description" placeholder="Description" required></textarea>
                    <input type="file" name="image" accept="image/*">
                    <button type="submit">Add Book</button>
                </form>
            </div>
        <?php endif; ?>

    </main>

    <footer>
        <p>&copy; 2025 Mr. Master</p>
    </footer>

    <script>
        // Show Add Book Form for Admin
        <?php if ($is_admin): ?>
            document.getElementById("add-book-form").style.display = "block";
        <?php endif; ?>
    </script>

</body>
</html>

<?php
$conn->close();
?>
