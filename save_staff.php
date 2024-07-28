<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare data for insertion
$name = $_POST['name'];
$position = $_POST['position'];
$password = $_POST['password'];

// Hash the password (for security)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL query to insert data
$sql = "INSERT INTO staff (name, position, password) VALUES ('$name', '$position', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
