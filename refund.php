<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Canceled/Refunded Reservations</title>
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
      background-image: url('reservation_bg.jpg'); /* Background image related to reservations */
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

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #4CAF50;
      color: white;
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
        <li><a href="delete_reservation.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="overlay">
        <h1>Manage Canceled/Refunded Reservations</h1>
        <div class="button-container">
          <!-- Buttons for managing reservations -->
          <button class="button" onclick="cancelReservation()">Cancel Reservation</button>
          <button class="button" onclick="refundReservation()">Refund Reservation</button>
        </div>
        <!-- Placeholder for displaying canceled/refunded reservation info -->
        <div id="reservationInfo">
          <table id="cancelReservationTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Number of Guests</th>
                <th>Status</th>
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

                // SQL to fetch canceled reservations
                $sql_fetch = "SELECT * FROM cancelReservation";
                $result_fetch = $conn->query($sql_fetch);

                if ($result_fetch->num_rows > 0) {
                    // Output data of each row
                    while($row = $result_fetch->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['date']."</td>";
                        echo "<td>".$row['time']."</td>";
                        echo "<td>".$row['num_guests']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No reservations canceled yet.</td></tr>";
                }
                $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to cancel reservation
    function cancelReservation() {
      var id = prompt("Please enter reservation ID to cancel:");
      if (id != null) {
        if (confirm("Are you sure you want to cancel this reservation?")) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("reservationInfo").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "cancelReservation.php?id=" + id, true);
          xhttp.send();
        }
      }
    }

    // Function to refund reservation
    function refundReservation() {
      var id = prompt("Please enter reservation ID to refund:");
      if (id != null) {
        if (confirm("Are you sure you want to refund this reservation?")) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("reservationInfo").innerHTML = this.responseText;
            }
          };
          xhttp.open("POST", "cancelReservation.php?id=" + id, true);
          xhttp.send();
        }
      }
    }
  </script>
</body>
</html>
