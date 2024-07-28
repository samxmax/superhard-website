<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Retrieve POST data
$user_id = $_POST['user_id'] ?? '';

// Validate data
if (empty($user_id)) {
    echo "Error: Please provide a User ID.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("s", $user_id);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "User removed successfully.";
    } else {
        echo "Error: No user found with the provided User ID.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
