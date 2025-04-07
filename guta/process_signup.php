<?php
// Database connection settings
$host = 'localhost';
$dbname = 'learnhub';
$username = 'root';
$password = '';

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

// Collect additional form data
$apple_id = $_POST['apple_id'] ?? null;
$twitter_handle = $_POST['twitter_handle'] ?? null;
$instagram_handle = $_POST['instagram_handle'] ?? null;
$phone_country_code = $_POST['phone_country_code'] ?? null;
$phone_number = $_POST['phone_number'] ?? null;

// Insert new user into the database with additional fields
$sql = "INSERT INTO users (name, email, password, apple_id, twitter_handle, instagram_handle, phone_country_code, phone_number) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $name, $email, $password, $apple_id, $twitter_handle, $instagram_handle, $phone_country_code, $phone_number);

if ($stmt->execute()) {
    echo "Sign-up successful. Redirecting to login page...";
    header("refresh:2;url=login.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
