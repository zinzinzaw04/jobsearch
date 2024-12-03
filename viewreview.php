<?php
include("welcomeadmin.php");
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the review table
$sql = "SELECT * FROM review";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 90px;
        }
        .card {
            margin-bottom: 20px;
            background:black;
            color:white;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">View Reviews</h2>

        <?php
        // Check if there are reviews to display
        if ($result->num_rows > 0) {
            // Output data in card format
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Review by " . $row['full_name'] . "</h5>
                            <h6 class='card-subtitle mb-2'>Email: " . $row['email'] . "</h6>
                            <p class='card-text'>Review: " . $row['review'] . "</p>
                        </div>
                    </div>";
            }
        } else {
            echo "<p>No reviews available.</p>";
        }
        ?>

    </div>

</body>

</html>
