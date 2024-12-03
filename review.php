<?php include("header.php") ?>
<?php

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitReview'])) {
    // Get user input data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $reviewText = $_POST["reviewText"];

    // Insert data into the review table
    $sql = "INSERT INTO review (full_name, email, review) VALUES ('$fullName', '$email', '$reviewText')";

    if ($conn->query($sql) === TRUE) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Review</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 90px !important;
        }

        form {
            width: 60%;
            height: 500px;
            margin-right: auto;
            margin-left: auto;
            background-color: black;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: space-evenly;
        }

        form .mb-3 {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        form label {
            color: gold;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
    <?php
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Display thank-you message
            echo "<div class='alert alert-success text-center' role='alert'>
                    Thank you for your review!
                  </div>";
        }
        ?>
        <h2 class="text-center mb-4">Write a Review</h2>
        <form method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="" disabled selected>Select a rating</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Fair</option>
                    <option value="1">1 - Poor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="reviewText" class="form-label">Your Review</label>
                <textarea class="form-control" id="reviewText" name="reviewText" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="submitReview" style="width: 25%;margin-right:auto; margin-left:auto;">Submit Review</button>
        </form>
    </div>

</body>

</html>