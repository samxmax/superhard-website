<?php
header('Content-Type: application/json');

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

$sql = "SELECT Beverage_Name, Price FROM Beverages";
$result = $conn->query($sql);

$beverages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $beverages[] = $row;
    }
}

echo json_encode($beverages);

$conn->close();
?>
