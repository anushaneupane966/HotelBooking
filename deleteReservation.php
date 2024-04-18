<?php
// Check if reservation ID is provided
if (!isset($_GET['id'])) {
    header("Location: My_bookings.html");
    exit();
}

// Database configuration
$servername = "localhost";
$username = "astro";
$password = "Serena562181";
$database = "rdbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reservation ID from GET parameters
$id = $_GET['id'];

// SQL to delete the reservation
$sql = "DELETE FROM reservations WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // If deletion is successful, redirect to My_bookings.html
    header("Location: My_bookings.html");
    exit();
} else {
    // If there's an error, display the error message
    echo "Error deleting reservation: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
