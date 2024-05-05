<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Management</title>
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
      background-image: url('1.jpg'); /* Background image related to staff */
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
      color: white;
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
p{
  color: white;
}
  </style>
</head>
<body>
  
  <div class="wrapper">
    <div class="sidebar">
      <h3>Staff Management</h3>
      <ul class="sidebar-menu">
        <li><a href="AdminDashboard.html"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
        <li><a href="view_reservation_list.php"><i class="fas fa-calendar-alt"></i> View Reservation List</a></li>
        <li><a href="access_feedback.html"><i class="fas fa-comment-alt"></i> Access Feedback</a></li>
        <li><a href="delete_reservation.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="overlay">
        <h1>Staff Management</h1>
        <div class="button-container">
          <!-- Buttons for managing staff -->
          <button class="button" onclick="subtractStaff()">Subtract Staff</button>
          <button class="button" onclick="addStaff()">Add Staff</button>
        </div>
        <!-- Placeholder for displaying current staff count -->
        <div id="staffCount">
          <p>Current Staff Count: <span id="currentStaff">10</span></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to subtract staff
    function subtractStaff() {
      var currentStaffElement = document.getElementById("currentStaff");
      var currentStaffCount = parseInt(currentStaffElement.innerText);
      if (currentStaffCount > 0) {
        currentStaffElement.innerText = currentStaffCount - 1;
      }
    }

    // Function to add staff
    function addStaff() {
      var currentStaffElement = document.getElementById("currentStaff");
      var currentStaffCount = parseInt(currentStaffElement.innerText);
      currentStaffElement.innerText = currentStaffCount + 1;
    }
  </script>
</body>
</html>
