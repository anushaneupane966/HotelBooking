<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    $servername = "localhost";
    $username = "astro";
    $password = "Serena562181";
    $dbname = "rdbs";

    // Sanitize and validate form data
    $guest_name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $reservation_date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
    $reservation_time = isset($_POST['time']) ? htmlspecialchars($_POST['time']) : '';
    $num_guests = isset($_POST['num_guests']) ? intval($_POST['num_guests']) : 0;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO reservation_details (guest_name, reservation_date, reservation_time, num_guests) VALUES (?, ?, ?, ?)");
    
    // Check if statement preparation succeeded
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }
    
    // Bind parameters
    $stmt->bind_param("sssi", $guest_name, $reservation_date, $reservation_time, $num_guests);
    
    // Execute SQL query
    if ($stmt->execute()) {
        echo "Reservation added successfully";
    } else {
        echo "Error in execution: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?>
