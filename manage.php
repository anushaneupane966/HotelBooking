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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        #sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 200px;
            height: 100%;
            background-color: #614f4f;
            padding-top: 100px;
            color: #fff;
        }
        #sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #sidebar ul li {
            padding: 10px;
            border-bottom: 1px solid #000000;
        }
        #sidebar ul li a{
            color: black;
            size: 40px;
            font-size: larger;
            
        }
        #sidebar ul li:hover {
            background-color: #c8b6b6;
        }
        #content {
            margin-left: 220px;
            padding: 20px;
        }
        h1 {
            color: #000000;
        }
        .button-container {
            text-align: center;
            margin-top: 50px;
        }
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <ul>
            <li><a href="#">Admins</a></li>
            <li><a href="manage.php">Manage Reservations</a></li>
            <li><a href="#">View Reservations</a></li>
            <li><a href="#">Edit Reservation</a></li>
            <li><a href="#">User Feedbacks</a></li>
        </ul>
    </div>
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
        
        <!-- Button to return back to the dashboard -->
        <div class="button-container">
            <a href="dashboard.html" class="button">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
