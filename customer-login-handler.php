<?php
session_start();

// Database connection parameters
$servername = "localhost";  // Replace with your MySQL server name
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password
$dbname = "gallery_cafe";   // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Prepare SQL statement with placeholders
    $sql = "SELECT * FROM users WHERE username=?";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify hashed password
        // Hash the password during registration

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (password_verify($password, $stored_password)) {
            // Login successful
            $_SESSION['username'] = $username;
            $stmt->close();
            $conn->close();
            header("Location: regilog.html"); // Redirect to logged-in page
            exit();
        } else {
            // Incorrect password
            echo '<script>alert("Incorrect password. Please try again.");</script>';
            echo '<script>window.location.href = "index.html";</script>';
            $stmt->close();
            $conn->close();
            exit();
        }
    } else {
        // User does not exist
        echo '<script>alert("User does not exist. Please try again.");</script>';
        echo '<script>window.location.href = "index.html";</script>';
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
    // Invalid request method
    echo '<script>alert("Invalid request method.");</script>';
    echo '<script>window.location.href = "index.html";</script>';
    $conn->close();
    exit();
}
?>
