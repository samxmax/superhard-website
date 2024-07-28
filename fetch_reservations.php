<?php
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

// Query to fetch reservations
$sql = "SELECT * FROM reservation";
$result = $conn->query($sql);

$reservations = [];
if ($result->num_rows > 0) {
    // Fetch all reservations
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

// Output as JSON
header('Content-Type: application/json');
echo json_encode($reservations);

$conn->close();
?>
