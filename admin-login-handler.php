<?php
session_start();


$servername = "localhost";    
$username = "root";           
$password = "";               
$dbname = "gallery_cafe";    


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = $_POST['adminUsername'];
    $adminPassword = $_POST['adminPassword'];


    $adminUsername = mysqli_real_escape_string($conn, $adminUsername);
    $adminPassword = mysqli_real_escape_string($conn, $adminPassword);

    
    $sql = "SELECT * FROM admin_credentials WHERE username=?";

  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $adminUsername);

    
    $stmt->execute();

   
    $result = $stmt->get_result();

   
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        
        if (password_verify($adminPassword, $storedPassword)) {
           
            $_SESSION['adminUsername'] = $adminUsername;
            $stmt->close();
            $conn->close();
            header("Location: adminlog.html"); 
            exit();
        } else {
            
            echo '<script>alert("Incorrect password. Please try again.");</script>';
            echo '<script>window.location.href = "index.html";</script>';
            $stmt->close();
            $conn->close();
            exit();
        }
    } else {
        
        echo '<script>alert("Admin does not exist. Please try again.");</script>';
        echo '<script>window.location.href = "index.html";</script>';
        $stmt->close();
        $conn->close();
        exit();
    }
} else {
    
    echo '<script>alert("Invalid request method.");</script>';
    echo '<script>window.location.href = "index.html";</script>';
    $conn->close();
    exit();
}
?>
