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

// Pagination
$jobsPerPage = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $jobsPerPage;

// Fetch job data with pagination from the database
$sql = "SELECT * FROM job LIMIT $offset, $jobsPerPage";
$result = $conn->query($sql);

// Fetch total number of jobs for pagination
$totalJobsSql = "SELECT COUNT(*) as total FROM job";
$totalResult = $conn->query($totalJobsSql);
$totalJobs = $totalResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalJobs / $jobsPerPage);

// Close the database connection
$conn->close();
?>
<?php include("welcomeadmin.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Job Listings</title>
    <style>
        body {
            width: 100%;
            height: 100vh;
            background: linear-gradient(to left bottom, white, gold);
        }

        .container {
            margin-top: 50px;
        }
        tr,td{
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- <h2 class="mb-4 pt-4" align="center">Job Listings</h2> -->
        <table class="table table-striped mb-4 pt-4">
            <thead>
                <tr>
                    <th scope="col">Job Name</th>
                    <th scope="col">Job Type</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Industry</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Description</th>
                    <th scope="col">Requirements</th>
                    <th scope="col">Benefits</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['job_name'] . "</td>";
                        echo "<td>" . $row['job_type'] . "</td>";
                        echo "<td>" . $row['com_name'] . "</td>";
                        echo "<td>" . $row['employ_mail'] . "</td>";
                        echo "<td>" . $row['deadline'] . "</td>";
                        echo "<td>" . $row['industry'] . "</td>";
                        echo "<td>" . $row['salary'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['requirement'] . "</td>";
                        echo "<td>" . $row['benefits'] . "</td>";
                        echo "<td>
                            <a href='editjob.php?id=" . $row['job_id'] . "' class='btn btn-warning btn-sm'>Update</a>
                            <a href='deletejob.php?id=" . $row['job_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No jobs found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='viewjob.php?page=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
