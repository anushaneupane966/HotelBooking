<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Reservation List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* General styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f2f5;
    }

    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar styles */
    .sidebar {
      width: 250px;
      background-color: #2c3e50; /* Dark blue */
      color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Adding a subtle shadow */
      border-radius: 10px; /* Rounded corners */
    }

    .sidebar h3 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px; /* Increase font size */
      color: #fff; /* White text color */
    }

    .sidebar-menu {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-menu li {
      padding: 15px 0;
      border-bottom: 1px solid #46637f; /* Darker blue */
    }

    .sidebar-menu li a {
      color: #fff;
      text-decoration: none;
      display: flex;
      align-items: center;
      font-size: 18px; /* Adjust font size */
      transition: color 0.3s; /* Smooth color transition */
    }

    .sidebar-menu li a i {
      margin-right: 10px;
      font-size: 20px; /* Adjust icon size */
    }

    .sidebar-menu li:hover {
      background-color: #46637f; /* Darker blue on hover */
    }

    .sidebar-menu li:hover a {
      color: #00bcd4; /* Cyan text color on hover */
    }

    .sidebar-menu li:last-child {
      border-bottom: none; /* Remove border from last item */
    }

    /* Main content styles */
    .main-content {
      flex: 1;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .content-container {
      max-width: 800px; /* Adjusted for wider content */
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .content-container h1 {
      margin-bottom: 20px;
      text-align: center;
    }

    /* Table styles */
    .reservation-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .reservation-table th, .reservation-table td {
      border-bottom: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }

    .reservation-table th {
      background-color: #f2f2f2;
      color: #333;
    }

    .reservation-table td {
      color: #666;
    }

    .reservation-table td:first-child {
      width: 10%;
    }

    .reservation-table td:not(:first-child) {
      width: 20%;
    }
    
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="sidebar">
      <h3>Admin Dashboard</h3>
      <ul class="sidebar-menu">
        <li><a href="AdminDashboard.html"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
        <li><a href="view_reservation_list.php"><i class="fas fa-calendar-alt"></i> View Reservation List</a></li>
        <li><a href="access_feedback.html"><i class="fas fa-comment-alt"></i> Access Feedback</a></li>
        <div class="Logout">
        <li><a href="delete_reservation.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </div>
        <!-- Add more menu items based on the provided content -->
      </ul>
    </div>
    <div class="main-content">
      <div class="content-container">
        <h1>View Reservation List Page</h1>
        <table class="reservation-table">
          <thead>
            <tr>
              <th>Reservation ID</th>
              <th>Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Guests</th>
            </tr>
          </thead>
          <tbody>
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
            
            // Fetch reservation data from database where number of guests is more than 10
            $sql = "SELECT id, guest_name, reservation_date, reservation_time, num_guests 
                    FROM reservations_details 
                    WHERE num_guests > 10";
            $result = $conn->query($sql);
            
            // Check if there are any reservations
            if ($result !== false && $result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["guest_name"] . "</td>";
                    echo "<td>" . $row["reservation_date"] . "</td>";
                    echo "<td>" . $row["reservation_time"] . "</td>";
                    echo "<td>" . $row["num_guests"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No reservations found with more than 10 guests</td></tr>";
            }
            
            // Close connection
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
