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

// Query to fetch orders
$sql = "SELECT * FROM Orders";
$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    // Fetch all orders
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

// Output as JSON
header('Content-Type: application/json');
echo json_encode($orders);

$conn->close();
?>
