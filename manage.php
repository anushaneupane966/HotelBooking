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

// Function to fetch reservations
function getReservations($conn) {
    $sql = "SELECT * FROM reservations";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Fetch reservations
$reservations = getReservations($conn);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <style>
        /* Css hala */
    </style>
</head>
<body>
    <div id="content">
        <h1>Manage Reservations</h1>
        
        <!-- Display reservations -->
        <?php if (!empty($reservations)) : ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Number of Guests</th>
                </tr>
                <?php for ($i = 0; $i < count($reservations); $i++) : ?>
                    <tr>
                        <td><?php echo $reservations[$i]['id']; ?></td>
                        <td><?php echo $reservations[$i]['name']; ?></td>
                        <td><?php echo $reservations[$i]['email']; ?></td>
                        <td><?php echo $reservations[$i]['phone']; ?></td>
                        <td><?php echo $reservations[$i]['date']; ?></td>
                        <td><?php echo $reservations[$i]['time']; ?></td>
                        <td><?php echo $reservations[$i]['num_guests']; ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
        <?php else : ?>
            <p>No reservations found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
