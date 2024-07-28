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
$food_id = $_POST['food_id'] ?? '';

// Validate data
if (empty($food_id)) {
    echo "Error: Please provide a Food ID.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM menu WHERE id = ?");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("s", $food_id);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Item removed successfully.";
    } else {
        echo "Error: No item found with the provided Food ID.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
