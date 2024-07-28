<?php
// Database connection details
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

// Function to hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Check if admin credentials are already set
$sql_check = "SELECT * FROM admin_credentials";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // Admin credentials are already set
    echo "Admin credentials are already set. You cannot change them.";
} else {
    // Admin credentials are not set, set them
    $data = json_decode(file_get_contents('php://input'), true);
    $admin_username = $data['username'];
    $admin_password = hashPassword($data['password']); // Hash the password for security

    $sql_insert = "INSERT INTO admin_credentials (username, password) VALUES ('$admin_username', '$admin_password')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Admin credentials set successfully.";
    } else {
        echo "Error setting admin credentials: " . $conn->error;
    }
}

$conn->close();
?>
