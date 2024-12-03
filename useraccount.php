<?php
session_start();
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";
$tablename = "user_register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch existing data for the selected user
if (isset($_GET["user_id"])) {
    $userId = $_GET["user_id"];
    $sqlSelect = "SELECT * FROM $tablename WHERE user_id = $userId";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
    } else {
        echo "No user found with the provided ID";
        exit();
    }
} else {
    echo "User ID not provided";
    exit();
}

// Close the database connection
$conn->close();
?>
<?php include("header.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Account</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .account-container {
            max-width: 600px;
            height: 470px;
            margin: auto;
            padding: 20px;
            margin-top: 90px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: black;
            border-radius: 10px;
        }

        .account-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
            /* Bootstrap primary color */
        }

        .account-details {
            text-align: left;
            margin-bottom: 20px;
            color: white;
        }

        .account-details img {
            max-width: 95px;
            height: 85px;
            border-radius: 50%;
            margin-top: 10px;
        }

        .photo {
            display: flex;
            height: 90px;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-name {
            font-size: 1.5rem;
            margin-top: 10px;
            color: #007bff;
        }

        .btns {
            display: flex;
            justify-content: space-around;
        }

        .btn-update,
        .btn-logout {
            width: 40%;
            margin-top: 10px;
            font-size: 1.1rem;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container account-container">

        <div class="account-details">
            <?php
            // Display profile image if available
            if (!empty($row['profile'])) {
                echo "<div class='photo'>";
                echo '<img src="profiles/' . $row['profile'] . '" alt="Profile Image">';
                echo ' <h2 class="mb-4"><strong>' . $row['username'] . '</strong></h2>';
                echo '</div>';
            }
            ?>
            <!-- <p class="user-name"><strong><?php echo $row['username']; ?></strong></p> -->
            <p><strong style="color:gold;">Phone:</strong> <?php echo $row['phone']; ?></p>
            <p><strong style="color:gold;">Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong style="color:gold;">About Yourself:</strong> <?php echo $row['aboutyourself']; ?></p>
        </div>

        <div class="btns">
            <a href="user_update.php?user_id=<?php echo $userId; ?>" class="btn btn-warning btn-update">Update</a>
            <a href="logout.php" class="btn btn-light btn-logout">Logout</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<!-- <h2 class="mb-4"><strong><?php echo $row['username']; ?></strong></h2> -->