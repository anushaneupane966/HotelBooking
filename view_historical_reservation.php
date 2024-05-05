<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Historical Booking Records</title>
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

    /* Updated styles for the sidebar */
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

    .main-content {
      flex: 1;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('bbg.jpg'); /* Background image related to restaurant */
      background-size: cover;
      background-position: center;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 20px;
      border-radius: 10px;
      text-align: center;
    }

    .overlay h1 {
      margin-bottom: 20px;
      color: #fff;
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
    }

    .button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      margin: 5px;
    }

    .button:hover {
      background-color: #45a049;
    }

    .reservation-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .reservation-table th, .reservation-table td {
      border-bottom: 1px solid #ddd;
      padding: 12px;
      text-align: left;
      color: #fff;
    }

    .reservation-table th {
      background-color: #4CAF50; /* Dark green */
    }

    .reservation-table td {
      color: white; /* Updated to white */
    }

    .reservation-table td:first-child {
      width: 10%;
    }

    .reservation-table td:not(:first-child) {
      width: 20%;
    }

    .reservation-table tbody tr:nth-child(odd) {
      background-color: rgba(255, 255, 255, 0.1); /* Light background color for odd rows */
    }

    .bookings {
      color: white;
      padding-top: 10px;
    }

    .bookings li {
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      padding-bottom: 10px;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .wrapper {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .main-content {
        padding: 20px 0;
      }
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
          <li><a href="#" id="logoutButton"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </div>
        <!-- Add more menu items based on the provided content -->
      </ul>
    </div>
    <div class="main-content">
      <div class="overlay">
        <h1>View Historical Booking Records</h1>
        <div class="button-container">
          <!-- Button to view historical booking records -->
          <a class="button" href="view_historical_reservation.php">View Historical Booking Records</a>
        </div>
        <div id="historicalBookings" class="bookings">
          <!-- Historical booking records displayed in a table -->
          <table class="reservation-table">
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number of Guests</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Database connection parameters
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

              // Query to retrieve historical bookings
              $sql = "SELECT * FROM reservations WHERE date < CURDATE() ORDER BY date DESC";
              $result = $conn->query($sql);

              // Check if there are any historical bookings
              if ($result->num_rows > 0) {
                  // Output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['id'] . "</td>";
                      echo "<td>" . $row['name'] . "</td>";
                      echo "<td>" . date('F j, Y', strtotime($row['date'])) . "</td>";
                      echo "<td>" . date('g:i A', strtotime($row['time'])) . "</td>";
                      echo "<td>" . $row['num_guests'] . "</td>";
                      echo "<td>Done</td>"; // Updated status
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6'>No historical bookings found.</td></tr>";
              }

              // Close connection
              $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const logoutButton = document.getElementById("logoutButton");
      logoutButton.addEventListener("click", function (event) {
        event.preventDefault();
        const logoutConfirmed = confirm("Are you sure you want to logout?");
        if (logoutConfirmed) {
          window.location.href = "admin.html";
        }
      });
    });
  </script>
</body>
</html>
