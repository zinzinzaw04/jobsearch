<?php
ob_start();
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
            background: linear-gradient(to left bottom, white, gold);
        }

        form 
        {
            margin-top:90px;
            width: 50%;
            height: 530px;
            margin-right: auto;
            margin-left: auto;
            border-radius: 20px;
            background:black;
            display:flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: space-between;

        }
        .mb-3{
            width:80%;

            margin-right: auto;
            margin-left: auto;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <!-- <h2 class="mb-4">Company Information Form</h2> -->
        <form enctype="multipart/form-data" method="post" action="">
            <div class="mb-3">
                <!-- <label for="companyName" class="form-label">Company Name</label> -->
                <input type="text" class="form-control" id="companyName" placeholder="Enter company name" required name="companyName">
            </div>
            <div class="mb-3">
                <!-- <label for="companyName" class="form-label">Company Name</label> -->
                <input type="text" class="form-control" id="companyId" placeholder="Enter company Id" required name="companyId">
            </div>
            <div class="mb-3">
                <!-- <label for="companyImage" class="form-label">Company Image</label> -->
                <input type="file" class="form-control" id="companyImage" accept="image/*" required name="companyImage">
            </div>

            <div class="mb-3">
                <!-- <label for="founder" class="form-label">Founder</label> -->
                <input type="text" class="form-control" id="founder" placeholder="Enter founder's name" required name="founder">
            </div>

            <div class="mb-3">
                <!-- <label for="location" class="form-label">Location</label> -->
                <input type="text" class="form-control" id="location" placeholder="Enter company location" required name="location"> 
            </div>

            <div class="mb-3">
                <!-- <label for="facebookLink" class="form-label">Facebook Link</label> -->
                <input type="url" class="form-control" id="facebookLink" placeholder="Enter Facebook link" name="facebookLink">
            </div>

            <button type="submit" class="btn btn-warning" name="submit" style="width: 25%;margin-right:auto; margin-left:auto;">ADD COMPANY</button>
        </form>
    </div>
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";
$tablename="company_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $companyId = $_POST["companyId"];
    $companyName = $_POST["companyName"];
    $founder = $_POST["founder"];
    $location = $_POST["location"];
    $facebookLink = $_POST["facebookLink"];

    // Upload company image
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["companyImage"]["name"]);
    move_uploaded_file($_FILES["companyImage"]["tmp_name"], $targetFile);

    // Insert data into the database
    $sql = "INSERT INTO $tablename (company_id,company_name, company_img, founder, location, facebook_link) VALUES ('$companyId','$companyName', '$targetFile', '$founder', '$location', '$facebookLink')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
        header("location: readcompan.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
