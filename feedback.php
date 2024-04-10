<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Us Your Feedback</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <div id="content">
        <h1>Give Us Your Feedback</h1>
        <div class="button-container">
            <!-- Button to open the feedback form -->
            <button class="button" id="openFeedbackForm">Provide Feedback</button>
        </div>
        
        <!-- Feedback form popup -->
        <div id="feedbackFormPopup" class="popup">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="name" placeholder="Your Name" required><br><br>
                <input type="email" name="email" placeholder="Your Email" required><br><br>
                <textarea name="feedback" placeholder="Your Feedback" rows="5" required></textarea><br><br>
                <input type="hidden" name="submit_feedback" value="1">
                <button class="button" type="submit">Submit Feedback</button>
            </form>
        </div>
    </div>
    
    <script>
        // JavaScript to handle feedback form popup
        var openFeedbackFormButton = document.getElementById("openFeedbackForm");
        var feedbackFormPopup = document.getElementById("feedbackFormPopup");

        openFeedbackFormButton.onclick = function() {
            feedbackFormPopup.style.display = "block";
        }

        window.onclick = function(event) {
            if (event.target == feedbackFormPopup) {
                feedbackFormPopup.style.display = "none";
            }
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_feedback"])) {
        // Database connection parameters
        $servername = "localhost"; // Change this to your MySQL server name
        $username = "astro"; // Change this to your MySQL username
        $password = "Serena562181"; // Change this to your MySQL password
        $database = "rdbs"; // Change this to your MySQL database name

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
            echo "<p>Thank you for your feedback!</p>";
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
