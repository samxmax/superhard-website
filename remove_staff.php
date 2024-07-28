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
$staff_id = $_POST['staff_id'] ?? '';

// Validate data
if (empty($staff_id)) {
    echo "Error: Please provide a Staff ID.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("s", $staff_id);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Staff removed successfully.";
    } else {
        echo "Error: No staff found with the provided Staff ID.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
