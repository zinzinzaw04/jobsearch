<?php include("header.php") ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the job ID from the URL parameter
if (isset($_GET['job_id'])) {
    $jobId = $_GET['job_id'];

    // Fetch detailed information for the selected job
    $sql = "SELECT * FROM job WHERE job_id = '$jobId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display detailed information
        echo '<div style="width: 50%; margin: 90px auto; border: 1px solid #000; background-color: #000; color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">';
        echo '<h2>' . $row['job_name'] . '</h2>';
        echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
        echo '<p><strong>Requirements:</strong> ' . $row['requirement'] . '</p>';
        echo '<p><strong>Benefits:</strong> ' . $row['benefits'] . '</p>';
        echo '<p><strong>Company:</strong> ' . $row['com_name'] . '</p>';
        echo '<p><strong>Job Type:</strong> ' . $row['job_type'] . '</p>';
        echo '<p><strong>Industry:</strong> ' . $row['industry'] . '</p>';
        echo '<p><strong>Salary:</strong> ' . $row['salary'] . '</p>';
        echo '<p><strong>Deadline:</strong> ' . $row['deadline'] . '</p>';
        echo '<p><strong>Email to accept Resume:</strong> ' . $row['employ_mail'] . '</p>';
        // Add more details as needed

        echo '</div>';
    } else {
        echo "Job details not found.";
    }
} else {
    echo "Invalid request. Job ID not provided.";
}

$conn->close();
?>
