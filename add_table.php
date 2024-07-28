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
$table_id = $_POST['table_id'] ?? '';
$view = $_POST['view'] ?? '';

// Validate data
if (empty($table_id) || empty($view)) {
    echo "Error: Please provide both table ID and view.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO tablelist (table_id, view) VALUES (?, ?)");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("ss", $table_id, $view);

// Execute the statement
if ($stmt->execute()) {
    echo "New table added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
