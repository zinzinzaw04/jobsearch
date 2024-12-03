<?php
include('welcomeadmin.php');
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input data
    $admName = $_POST["admName"];
    $admPassword = $_POST["admPassword"];

    // Hash the admin password for better security
    // $hashedPassword = password_hash($admPassword, PASSWORD_DEFAULT);

    // Insert data into the admin_login table
    $sql = "INSERT INTO admin_login (adm_name, adm_password) VALUES ('$admName', '$admPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
        .card-body{
            background:black;
        }
        form label{
            color:gold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" style="background:black; color:gold;">
                        <h3>Create New Admin</h3>
                    </div>
                    <div class="card-body">
                        <!-- Your existing form content -->
                        <form method="post">
                            <div class="mb-3">
                                <label for="admName" class="form-label">Admin Name</label>
                                <input type="text" class="form-control" id="admName" name="admName" required>
                            </div>
                            <div class="mb-3">
                                <label for="admPassword" class="form-label">Admin Password</label>
                                <input type="password" class="form-control" id="admPassword" name="admPassword" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Create Admin</button>
                        </form>
                        <!-- End of your form -->

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
