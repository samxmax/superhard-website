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

// Validate data
if (empty($table_id)) {
    echo "Error: Table ID is required.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM reservation WHERE table_id = ?");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("s", $table_id);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Reservation removed successfully.";
    } else {
        echo "No reservation found with the provided Table ID.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
