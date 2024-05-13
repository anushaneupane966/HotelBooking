<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Us Your Feedback</title>
  <link rel="stylesheet" href="feedback.css">
</head>
<body>
    <div id="content">
        <div style="display: flex;">
        <h1><a href="customerDashboard.php" style="text-decoration:none";><</a></h1>
        <h1 style="padding-left:40px; ">Give Us Your Feedback</h1>
</div>
        <form id="feedbackForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="name" placeholder="Your Name" required><br><br>
            <input type="email" name="email" placeholder="Your Email" required><br><br>
            <textarea name="feedback" placeholder="Your Feedback" rows="5" required></textarea><br><br>
            <input type="hidden" name="submit_feedback" value="1">
            <button class="button" type="submit">Submit Feedback</button>
        </form>
    </div>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_feedback"])) {
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

        // Prepare and bind SQL statement
        $sql = "INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $feedback);

        // Set parameters and execute
        $name = $_POST["name"];
        $email = $_POST["email"];
        $feedback = $_POST["feedback"];
        
        if ($stmt->execute()) {
            // Redirect after successful submission
            echo "<script>window.location.href = 'CustomerDashboard.html';</script>";
            exit;
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
