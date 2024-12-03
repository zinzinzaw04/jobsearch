<?php
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

// Handle update action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $newUsername = $_POST["newUsername"];
    $newPhone = $_POST["newPhone"];
    $newEmail = $_POST["newEmail"];
    $newAboutYourself = $_POST["newAboutYourself"];

    // Check if a new certificate is provided
    if (isset($_FILES["newCertificate"]) && isset($_FILES["newCertificate"]["name"]) && $_FILES["newCertificate"]["name"] != "") {
        // Upload certificate
        $targetDir = "profiles/";
        $targetFile = $targetDir . basename($_FILES["newCertificate"]["name"]);
        move_uploaded_file($_FILES["newCertificate"]["tmp_name"], $targetFile);

        // Update data in the database, including the certificate
        $sql = "UPDATE $tablename SET username = '$newUsername', phone = '$newPhone', email = '$newEmail', aboutyourself = '$newAboutYourself', certificate = '$targetFile' WHERE user_id = $userId";
    } else {
        // Update data in the database without changing the certificate
        $sql = "UPDATE $tablename SET username = '$newUsername', phone = '$newPhone', email = '$newEmail', aboutyourself = '$newAboutYourself' WHERE user_id = $userId";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully";
        header("Location: useraccount.php?user_id=$userId");
        exit();
    } else {
        echo "Error updating data: " . $conn->error;
    }
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
    <title>Update User</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .update-container {
            background:black!important;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            margin-top: 90px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* background-color: white; */
            border-radius: 10px;
        }

        .update-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .update-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: space-evenly;
            color:gold;
            text-align: left;
            margin-bottom: 20px;
        }

        .update-form img {
            margin-right: auto!important;
            margin-left: auto!important;
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

        .btn-update {
            /* width: 100%; */
            margin-top: 10px;
            font-size: 1.1rem;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container update-container">

        <div class="update-form">
            <!-- <h2 class="mb-4">Update User</h2> -->
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $row["user_id"]; ?>">

                <?php
                // Display profile image if available
                if (!empty($row['profile'])) {
                    echo "<div class='photo'>";
                    echo '<img src="profiles/' . $row['profile'] . '" alt="Profile Image">';
                    echo '</div>';
                }
                ?>

                <div class="mb-3">
                    <label for="newUsername" class="form-label"> Username</label>
                    <input type="text" class="form-control" id="newUsername" placeholder="Enter new username" required name="newUsername" value="<?php echo $row["username"]; ?>">
                </div>

                <div class="mb-3">
                    <label for="newPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="newPhone" placeholder="Enter new phone number" required name="newPhone" value="<?php echo $row["phone"]; ?>">
                </div>

                <div class="mb-3">
                    <label for="newEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="newEmail" placeholder="Enter new email" required name="newEmail" value="<?php echo $row["email"]; ?>">
                </div>

                <div class="mb-3">
                    <label for="newAboutYourself" class="form-label">Yourself</label>
                    <textarea class="form-control" id="newAboutYourself" rows="3" placeholder="Tell us about yourself" name="newAboutYourself"><?php echo $row["aboutyourself"]; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="newCertificate" class="form-label">Upload Certificate</label>
                    <input type="file" class="form-control" id="newCertificate" accept="certificates/*" name="newCertificate">
                </div>

                <button type="submit" class="btn btn-warning btn-update" name="update" style="width: 25%;margin-right:auto; margin-left:auto;">Update</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
