<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$industry = "IT"; // Change this to General or Teaching as needed

// Include the header file
include 'header.php';

// Pagination configuration
$results_per_page = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

$sql = "SELECT * FROM job WHERE industry = '$industry' LIMIT $offset, $results_per_page";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<a href="jobdetail.php?job_id=' . $row['job_id'] . '" style="text-decoration: none; color: inherit;">';
        echo '<div style="height: 90px;"></div>';
        echo '<div style="width: 75%; margin-right: auto; margin-left: auto; border: 1px solid #000; background-color: #000; color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); height: 250px; cursor: pointer;">';

        // ... (Your existing code)

        // Card Header
        echo '<div style="height: 75px; padding: 10px;">';

        // Block-level element for Job Name
        echo '<h2 style="margin: 0;">' . $row['job_name'] . '</h2>';

        // Inline-level elements for Company Name and Job Type
        echo '<span style="margin-right: 10px;">' . $row['com_name'] . '</span>';
        echo '<span>' . $row['job_type'] . '</span>';

        echo '</div>';

        // Card Body
        echo '<div style="padding: 10px;">';
        echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
        echo '</div>';

        // Card Footer
        echo '<div style="padding: 10px; display: flex; justify-content: space-between;">';
        echo '<div>';
        echo '<p><strong>Industry:</strong> ' . $row['industry'] . '</p>';
        echo '</div>';

        // Inline-level elements for Salary and Deadline
        echo '<div>';
        echo '<p><strong>Salary:</strong> ' . $row['salary'] . '</p>';
        echo '<p><strong>Deadline:</strong> ' . $row['deadline'] . '</p>';
        echo '</div>';

        echo '</div>';

        echo '</div>';
        echo '</a>';
    }

    // Pagination links with white and gold colors
    $sql_count = "SELECT COUNT(*) as count FROM job WHERE industry = '$industry'";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $total_pages = ceil($row_count['count'] / $results_per_page);

    echo '<div style="margin-top: 20px; text-align: center;">';
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<a style="margin: 5px; padding: 5px 10px; background-color: black; color: gold; text-decoration: none; border-radius: 3px;" href="?page=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
} else {
    echo "No jobs found for the selected industry.";
}

$conn->close();
