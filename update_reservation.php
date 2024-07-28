<?php
$servername = "localhost"; // Replace with your server details
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$dbname = "gallery_cafe"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$table_id = $_POST['table_id'];
$situation = $_POST['situation'];
$datetime = $_POST['datetime']; // Date and time of reservation

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO reservation (table_id, situation, datetime) 
                         VALUES (?, ?, ?)
                         ON DUPLICATE KEY UPDATE situation = VALUES(situation), datetime = VALUES(datetime)");
$stmt->bind_param("iss", $table_id, $situation, $datetime);

// Execute the statement
if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
