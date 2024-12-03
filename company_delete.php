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

// Handle delete action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $companyId = $_POST["company_id"];

    // Delete data from the database
    $sql = "DELETE FROM $tablename WHERE company_id = $companyId";

    if ($conn->query($sql) === TRUE) {
        echo "Data deleted successfully";
    } else {
        echo "Error deleting data: " . $conn->error;
    }
}

// Fetch existing data for the selected company
if (isset($_POST["company_id"])) {
    $companyId = $_POST["company_id"];
    $sqlSelect = "SELECT * FROM $tablename WHERE company_id = $companyId";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        // You can use the fetched data to display information before confirming deletion.
    } else {
        echo "No company found with the provided ID";
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
    <title>Delete Company Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Delete Company Information</h2>

        <?php if (isset($row)) : ?>
            <p>Are you sure you want to delete the following company?</p>

            <ul>
                <li><strong>Company Name:</strong> <?php echo $row["company_name"]; ?></li>
                <li><strong>Founder:</strong> <?php echo $row["founder"]; ?></li>
                <li><strong>Location:</strong> <?php echo $row["location"]; ?></li>
                <li><strong>Facebook Link:</strong> <?php echo $row["facebook_link"]; ?></li>
            </ul>

            <form method="post" action="">
                <input type="hidden" name="company_id" value="<?php echo $row["company_id"]; ?>">
                <button type="submit" class="btn btn-danger" name="delete">Delete</button>
            </form>

            <a href="readcompan.php" class="btn btn-secondary">Cancel</a>
        <?php else : ?>
            <p>No company found with the provided ID</p>
            <a href="readcompan.php" class="btn btn-secondary">Back to Company List</a>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
