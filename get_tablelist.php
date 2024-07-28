<?php
header('Content-Type: application/json');

$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT table_id, view FROM tablelist";
$result = $conn->query($sql);

$tablelist = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tablelist[] = $row;
    }
}

echo json_encode($tablelist);

$conn->close();
?>
