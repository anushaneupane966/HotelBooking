<?php
// Assuming you have already established a connection to your database
// Database connection parameters
$host = 'localhost'; // Change this to your database host if different
$username = "astro"; 
      $password = "Serena562181"; 
$database = 'rdbs'; // Change this to your database name

// Establishing a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// Fetch total number of users
$userQuery = "SELECT COUNT(*) AS totalUsers FROM signup";
$userResult = mysqli_query($connection, $userQuery);
$userData = mysqli_fetch_assoc($userResult);
$totalUsers = $userData['totalUsers'];

// Fetch total number of admins
$adminQuery = "SELECT COUNT(*) AS totalAdmins FROM admin";
$adminResult = mysqli_query($connection, $adminQuery);
$adminData = mysqli_fetch_assoc($adminResult);
$totalAdmins = $adminData['totalAdmins'];

// Fetch total number of staff
$staffQuery = "SELECT COUNT(*) AS totalStaff FROM staff";
$staffResult = mysqli_query($connection, $staffQuery);
$staffData = mysqli_fetch_assoc($staffResult);
$totalStaff = $staffData['totalStaff'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard</title>
  <link rel="stylesheet" href="customerDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Add CSS styles for the statistics box */
    .statistics {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 20px;
      
    }
    .statistics h3 {
      margin-top: 0;
    }
    .statistics ul {
      list-style: none;
      padding: 0;
    }
    .statistics li {
      margin-bottom: 5px;
    }
    .statistics-box {
      background-color: #f3f3f3;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
    }
   
    .main-content{
      display: flex;
    }

    
  </style>
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <h3>Dashboard</h3>
    <ul class="sidebar-menu">

      <li><a href="customerDashboard.html"><i class="fas fa-tachometer-alt" aria-hidden="true"></i>Dashboard</a></li>
      <li><a href="Menu.html"><i class="fas fa-utensils" aria-hidden="true"></i>Menu</a></li>
      <li><a href="Gallery.html"><i class="fas fa-images" aria-hidden="true"></i></i>Gallery</a></li>
      <li><a href="My_bookings.html"><i class="fas fa-calendar-alt"></i>My bookings</a></li>
      <li><a href="Contact.html"><i class="fas fa-envelope"></i>Contact US</a></li>
      <li><a href="aboutUs.html"><i class="fas fa-info-circle"></i>About Us</a></li>
      <!-- Add more menu items based on the provided content -->
    </ul>
  </div>
  <div class="animated-text">
    <h6>Restaurant Booking Dine-in system</h6>
  </div>
  
  <div class="main-content">
    <div class="up">

    
  <div class="statistics">
    
        <h3>Total Users: <?php echo $totalUsers; ?></h3>

    </div>

    <div class="statistics">
     
        
        <h3>Total Admins: <?php echo $totalAdmins; ?></h3>
        
    </div>

    <div class="statistics">
      
       
        <h3>Total Staff: <?php echo $totalStaff; ?></h3>
      
    </div>
    <div class="overlay">
      <div class="button-container">
        <a class="button" href="bookTable.php">Book a table</a>
        <a class="button" href="feedback.php">Give feedback</a>
      </div>
      <!-- Add popup forms for reservation actions -->
      <div id="addReservationFormPopup" class="popup"></div>
      <div id="deleteReservationConfirmation" class="popup"></div>
    </div>
  </div>
</div>
</body>
</html>
