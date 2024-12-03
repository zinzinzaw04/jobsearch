<?php include("header.php") ?>
<style>
    .company-container {
        margin-top:100px!important;
        display: flex;
        justify-content: space-between;
        width: 60%;
        margin: 20px auto;
        background-color: #000;
        color: white;
        border-radius: 50px;
    }

    .company-image {
        max-width: 40%;
        border-radius: 50px;
        height: 90%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .company-details {
        width: 50%;
        padding: 20px;
        /* border: 1px solid #000; */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .company-details h2 {
        color: gold;
    }

    .company-details p {
        margin-bottom: 10px;
    }

    .company-details a {
        color: gold;
        text-decoration: none;
    }

    .company-details a:hover {
        text-decoration: underline;
    }
</style>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the company ID from the URL parameter
if (isset($_GET['company_id'])) {
    $companyId = $_GET['company_id'];

    // Fetch detailed information for the selected company
    $sqlCompany = "SELECT * FROM company_info WHERE company_id = '$companyId'";
    $resultCompany = $conn->query($sqlCompany);

    if ($resultCompany->num_rows > 0) {
        $rowCompany = $resultCompany->fetch_assoc();

        // Display detailed information for the company
        echo '<div class="company-container">';
        
        // Display company image
        echo '<div class="company-image">';
        echo '<img src="' . $rowCompany['company_img'] . '" alt="Company Image" style="max-width: 90%; height:90%; border-radius:50px;">';
        echo '</div>';
        
        // Display company details
        echo '<div class="company-details">';
        echo '<h2>' . $rowCompany['company_name'] . '</h2>';
        echo '<p><strong>Founder:</strong> ' . $rowCompany['founder'] . '</p>';
        echo '<p><strong>Location:</strong> ' . $rowCompany['location'] . '</p>';
        echo '<a href="' . $rowCompany['facebook_link'] . '" target="_blank">Visit Facebook</a>';
        // Add more details as needed
        echo '</div>';
        
        echo '</div>';

        // Fetch and display job cards for the selected company
        $companyName = $rowCompany['company_name'];

        $sqlJobs = "SELECT * FROM job WHERE com_name = '$companyName'";
        $resultJobs = $conn->query($sqlJobs);

        if ($resultJobs->num_rows > 0) {
            while ($rowJob = $resultJobs->fetch_assoc()) {
                // Display job card
                echo '<a href="jobdetail.php?job_id=' . $rowJob['job_id'] . '" style="text-decoration: none; color: inherit;">';
                echo '<div style="height: 90px;"></div>';
                echo '<div style="width: 75%; margin-right: auto; margin-left: auto; border: 1px solid #000; background-color: #000; color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); height: 250px; cursor: pointer;">';

                // ... (Your existing code for job cards)

                // Display job name, company name, and job type
                echo '<div style="height: 75px; padding: 10px;">';
                echo '<h2 style="margin: 0;">' . $rowJob['job_name'] . '</h2>';
                echo '<span style="margin-right: 10px;">' . $rowJob['com_name'] . '</span>';
                echo '<span>' . $rowJob['job_type'] . '</span>';
                echo '</div>';

                // Display job description
                echo '<div style="padding: 10px;">';
                echo '<p><strong>Description:</strong> ' . $rowJob['description'] . '</p>';
                echo '</div>';

                // Display job details (industry, salary, deadline)
                echo '<div style="padding: 10px; display: flex; justify-content: space-between;">';
                echo '<div>';
                echo '<p><strong>Industry:</strong> ' . $rowJob['industry'] . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<p><strong>Salary:</strong> ' . $rowJob['salary'] . '</p>';
                echo '<p><strong>Deadline:</strong> ' . $rowJob['deadline'] . '</p>';
                echo '</div>';
                echo '</div>';

                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "No jobs found for the selected company.";
        }
    } else {
        echo "Company details not found.";
    }
} else {
    echo "Invalid request. Company ID not provided.";
}

$conn->close();
?>
