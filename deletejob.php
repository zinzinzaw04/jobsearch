<?php
// Database connection details
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

// Check if job_id parameter is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $jobId = $_GET['id'];

    // Delete job from the database
    $sql = "DELETE FROM job WHERE job_id = $jobId";

    if ($conn->query($sql) === TRUE) {
        echo "Job deleted successfully";
        header("location:viewjob.php");
    } else {
        echo "Error deleting job: " . $conn->error;
    }
} else {
    echo "Invalid job ID";
}

// Close the database connection
$conn->close();
?>
