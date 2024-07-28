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
$event_id = $_POST['event_id'] ?? '';
$event_description = $_POST['event_description'] ?? '';
$event_date = $_POST['event_date'] ?? '';
$event_time = $_POST['event_time'] ?? '';

// Validate data
if (empty($event_id) || empty($event_description) || empty($event_date) || empty($event_time)) {
    echo "Error: Please fill in all fields.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO events (Event_ID, Event_Description, Date, Time) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("ssss", $event_id, $event_description, $event_date, $event_time);

// Execute the statement
if ($stmt->execute()) {
    echo "Event added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>