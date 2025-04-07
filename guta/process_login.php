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
$email = $_POST['email'];
$password = $_POST['password'];

// Example query to check user credentials
$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful
    echo "Login successful. Redirecting to dashboard...";
    header("refresh:2;url=dashboard.html");
} else {
    // Login failed
    echo "Invalid email or password.";
}

// Close connection
$stmt->close();
$conn->close();
?>
