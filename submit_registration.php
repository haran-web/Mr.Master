<?php
// This is just a simple example of how to handle the registration logic.
// You will need to add more validation, sanitization, and a database connection.

session_start();

// Simulate an OTP process (You can integrate an SMS/Email OTP service here)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $otp = $_POST['otp'];  // This OTP will be compared to the sent one

    
    // Normally, you would validate the OTP here with a database or an API (e.g. Twilio for SMS)

    // Assuming OTP is correct
    $isOtpValid = true; // In real case, you'd compare with the OTP sent to the phone/email

    if ($isOtpValid) {
        // Save user details to the database
        $conn = new mysqli('localhost', 'username', 'password', 'database_name');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO users (fullname, address, phone, email, password, registration_date) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $fullname, $address, $phone, $email, $password);

        if ($stmt->execute()) {
            // Redirect to a success page
            $_SESSION['user_id'] = $stmt->insert_id;  // Save user ID in session
            $_SESSION['registration_date'] = time();  // Save registration timestamp

            // Redirect to the home page or tute/papers page
            header("Location: services.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid OTP!";
    }
}
?>
