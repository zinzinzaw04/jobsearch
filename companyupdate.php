<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";
$tablename = "company_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $row
$row = array();

// Fetch existing data for the selected company
if (isset($_POST["company_id"])) {
    $companyId = $conn->real_escape_string($_POST["company_id"]); // Sanitize the input
    $sqlSelect = "SELECT * FROM $tablename WHERE company_id = '$companyId'";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        // You can use the fetched data to pre-fill the form for the update.
    } else {
        echo "No company found with the provided ID";
    }
}

// Handle update action


// Handle update action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $companyId = $conn->real_escape_string($_POST["company_id"]);
    $companyName = $conn->real_escape_string($_POST["companyName"]);
    $founder = $conn->real_escape_string($_POST["founder"]);
    $location = $conn->real_escape_string($_POST["location"]);
    $facebookLink = $conn->real_escape_string($_POST["facebookLink"]);

    // Check if a new company image is provided
    if (isset($_FILES["companyImage"]) && isset($_FILES["companyImage"]["name"]) && $_FILES["companyImage"]["name"] != "") {
        // Sanitize the company_id for the file name
        $sanitizedCompanyId = preg_replace("/[^a-zA-Z0-9]/", "", $companyId);
        
        // Generate a unique filename based on sanitized company ID
        $targetDir = "uploads/";
        $targetFile = $targetDir . $sanitizedCompanyId . '_' . basename($_FILES["companyImage"]["name"]);
        move_uploaded_file($_FILES["companyImage"]["tmp_name"], $targetFile);

        // Update company_img in the database
        $sqlImage = "UPDATE $tablename SET company_img = ? WHERE company_id = ?";
        $stmtImage = $conn->prepare($sqlImage);
        $stmtImage->bind_param("ss", $targetFile, $companyId);
        $stmtImage->execute();
    }

    // Update other company information
    $sql = "UPDATE $tablename SET company_name = ?, founder = ?, location = ?, facebook_link = ? WHERE company_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $companyName, $founder, $location, $facebookLink, $companyId);

    // Execute the query
    if ($stmt->execute()) {
        echo "Data updated successfully";
        header("location: readcompan.php");
    } else {
        echo "Error updating data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<?php include("welcomeadmin.php") ?>

<!DOCTYPE html>
<!-- The rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<!-- The rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Company Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        form {
            background: black;
            height: 520px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: space-between;
        }

        form .mb-3 {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
            color: gold;
        }

        .row {
            margin-top: 90px !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="mb-9 mt-20">-</h2>

        <div class="row">
            <!-- Display current company image -->
            <div class="col-md-6 mb-3">
                <img src="<?php echo $row['company_img']; ?>" alt="Current Company Image" class="img-thumbnail" style="width:85%; height:300px; border-radius:30px;">
            </div>

            <!-- Company information form -->
            <div class="col-md-6">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="company_id" value="<?php echo $row["company_id"]; ?>">

                    <div class="mb-3">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" placeholder="Enter company name" required name="companyName" value="<?php echo $row["company_name"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="founder" class="form-label">Founder</label>
                        <input type="text" class="form-control" id="founder" placeholder="Enter founder's name" required name="founder" value="<?php echo $row["founder"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" placeholder="Enter company location" required name="location" value="<?php echo $row["location"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="facebookLink" class="form-label">Facebook Link</label>
                        <input type="url" class="form-control" id="facebookLink" placeholder="Enter Facebook link" name="facebookLink" value="<?php echo $row["facebook_link"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="companyImage" class="form-label">Update Company Image</label>
                        <input type="file" class="form-control" id="companyImage" accept="uploads/*" name="companyImage">
                    </div>

                    <button type="submit" class="btn btn-warning" name="update" style="width: 25%;margin-right:auto; margin-left:auto;">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
