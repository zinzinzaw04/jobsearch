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
// Your existing PHP code to fetch data from the database
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

// Get the company ID from the URL parameter
if (isset($_GET['company_id'])) {
    $companyId = $_GET['company_id'];

    // Fetch detailed information for the selected company
    $sql = "SELECT * FROM company_info WHERE company_id = '$companyId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display detailed information
        echo '<div class="company-container">';
        
        // Display company image
        echo '<div class="company-image">';
        echo '<img src="' . $row['company_img'] . '" alt="Company Image" style="max-width: 90%; height:90%; border-radius:50px;">';
        echo '</div>';
        
        // Display company details
        echo '<div class="company-details">';
        echo '<h2>' . $row['company_name'] . '</h2>';
        echo '<p><strong>Founder:</strong> ' . $row['founder'] . '</p>';
        echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
        echo '<a href="' . $row['facebook_link'] . '" target="_blank">Visit Facebook</a>';
        // Add more details as needed
        echo '</div>';
        
        echo '</div>';
    } else {
        echo "Company details not found.";
    }
} else {
    echo "Invalid request. Company ID not provided.";
}

$conn->close();
?>
