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

// SQL to fetch reservation details
$sql_fetch = "SELECT * FROM reservations WHERE id = $id";
$result_fetch = $conn->query($sql_fetch);

if ($result_fetch->num_rows > 0) {
    // Fetch reservation details
    $row = $result_fetch->fetch_assoc();
    
    // SQL to insert canceled reservation details into cancelReservation table
    $sql_insert = "INSERT INTO cancelReservation (id, name, date, time, num_guests, status) 
                   VALUES ('".$row['id']."', '".$row['name']."', '".$row['date']."', '".$row['time']."', '".$row['num_guests']."', 'Canceled')";

    if ($conn->query($sql_insert) === TRUE) {
        // SQL to delete the reservation
        $sql_delete = "DELETE FROM reservations WHERE id = $id";
        
        if ($conn->query($sql_delete) === TRUE) {
            // If deletion is successful, redirect to My_bookings.html
            header("Location: My_bookings.html");
            exit();
        } else {
            // If there's an error, display the error message
            echo "Error deleting reservation: " . $conn->error;
        }
    } else {
        echo "Error inserting canceled reservation: " . $conn->error;
    }
} else {
    echo "Reservation not found.";
}

// Close the database connection
$conn->close();
?>
