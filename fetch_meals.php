<?php
// Database configuration
$host = 'localhost'; // or your database host
$db = 'gallery_cafe'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get meal type from query parameter
$mealType = $_GET['meal'] ?? '';

// Sanitize input
$mealType = $conn->real_escape_string($mealType);

// Validate mealType against allowed values to prevent SQL injection
$allowedMealTypes = ['srilankan_meals', 'chinese_meals', 'italian_meals'];
if (!in_array($mealType, $allowedMealTypes)) {
    die("Invalid meal type.");
}

// Display the selected meal type
if ($mealType) {
    echo "<h2>" . ucfirst(str_replace('_', ' ', $mealType)) . "</h2>";

    // Query the database to get meal details
    $sql = "SELECT meal_name FROM $mealType";
    $result = $conn->query($sql);

    // Check if any results are returned
    if ($result->num_rows > 0) {
        // Output meal names
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            $meal_name = isset($row['meal_name']) ? htmlspecialchars($row['meal_name']) : 'Unknown meal';
            echo '<li>' . $meal_name . '</li>';
        }
        echo '</ul>';
    } else {
        echo "No meals found.";
    }
} else {
    echo "Please select a meal type.";
}

// Close connection
$conn->close();
?>

