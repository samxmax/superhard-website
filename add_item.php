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

// Retrieve POST data
$id = $_POST['id'];
$food_name = $_POST['food_name'];
$food_type = $_POST['food_type'];
$price = $_POST['price'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO menu (id, food_name, food_type, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $id, $food_name, $food_type, $price);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
