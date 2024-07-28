<?php
// Database connection parameters
$servername = "localhost"; // or your server name
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "gallery_cafe"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user = $_POST['username'];
$pass = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Hash the password
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, password, email, gender) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user, $hashed_password, $email, $gender);


// Execute the statement
if ($stmt->execute()) {
    // Redirect to a success page or show a success notification
    header("Location: success.html"); // Redirect to a success page
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
