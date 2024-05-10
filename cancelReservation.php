<?php
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

    // Check if ID is provided
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // SQL to delete reservation with provided ID
        $sql_delete = "DELETE FROM cancelReservation WHERE id = $id";

        if ($conn->query($sql_delete) === TRUE) {
            echo "Reservation with ID $id has been canceled successfully.";
        } else {
            echo "Error canceling reservation: " . $conn->error;
        }
    } else {
        echo "No reservation ID provided.";
    }

    $conn->close();
?>
