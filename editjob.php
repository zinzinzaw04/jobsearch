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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobId = $_POST['jobId'];
    $jobName = $conn->real_escape_string($_POST['jobName']);
    $jobType = $conn->real_escape_string($_POST['jobType']);
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $companyEmail = $conn->real_escape_string($_POST['email']);
    $deadline = $conn->real_escape_string($_POST['deadline']);
    $industry = $conn->real_escape_string($_POST['industry']);
    $salary = $conn->real_escape_string($_POST['salary']);
    $description = $conn->real_escape_string($_POST['description']);
    $requirements = $conn->real_escape_string($_POST['requirement']);
    $benefits = $conn->real_escape_string($_POST['benefits']);

    // Update data in the database
    $sql = "UPDATE job SET 
            job_name='$jobName', 
            job_type='$jobType', 
            com_name='$companyName', 
            description='$description', 
            requirement='$requirements', 
            benefits='$benefits',
            employ_mail='$companyEmail',
            deadline='$deadline',
            industry='$industry',
            salary='$salary'
            WHERE job_id='$jobId'";

    if ($conn->query($sql) === TRUE) {
        header("location:viewjob.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch job data for the selected job
if (isset($_GET['id'])) {
    $jobId = $_GET['id'];
    $selectSql = "SELECT * FROM job WHERE job_id='$jobId'";
    $selectResult = $conn->query($selectSql);

    if ($selectResult->num_rows > 0) {
        $row = $selectResult->fetch_assoc();
    } else {
        echo "Job not found.";
        exit;
    }
} else {
    echo "Job ID not provided.";
    exit;
}

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
    <title>Edit Job</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            width: 80%;
            margin: 0 auto;
        }
        .row{
            height: 40px!important;
        }

        textarea {
            resize: vertical;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- <h2 class="mb-4 pt-4">Edit Job</h2> -->
        <form class="bg-light p-4" method="post">
            <input type="hidden" name="jobId" value="<?php echo $row['job_id']; ?>">

            <div class="row form-group">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="jobName" name="jobName" value="<?php echo $row['job_name']; ?>" required
                        placeholder="Job Name">
                </div>
                <div class="col-md-6">
                    <select class="form-select" id="jobType" name="jobType">
                        <option value="Full Time" <?php echo ($row['job_type'] == 'Full Time') ? 'selected' : ''; ?>>Full Time
                        </option>
                        <option value="Part Time" <?php echo ($row['job_type'] == 'Part Time') ? 'selected' : ''; ?>>Part Time
                        </option>
                        <option value="Contract" <?php echo ($row['job_type'] == 'Contract') ? 'selected' : ''; ?>>Contract
                        </option>
                        <option value="Freelance" <?php echo ($row['job_type'] == 'Freelance') ? 'selected' : ''; ?>>Freelance
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo $row['com_name']; ?>"
                    placeholder="Company Name">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['employ_mail']; ?>"
                    placeholder="Email to accept Resume">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" id="deadline" name="deadline" value="<?php echo $row['deadline']; ?>"
                    placeholder="Deadline">
            </div>

            <div class="mb-3">
                <select class="form-select" id="industry" name="industry">
                    <option value="General" <?php echo ($row['industry'] == 'General') ? 'selected' : ''; ?>>General</option>
                    <option value="IT" <?php echo ($row['industry'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                    <option value="Teaching" <?php echo ($row['industry'] == 'Teaching') ? 'selected' : ''; ?>>Teaching</option>
                </select>
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $row['salary']; ?>" placeholder="Salary">
            </div>

            <div class="mb-3">
                <textarea class="form-control" id="description" rows="3" name="description"
                    placeholder="Job Description"><?php echo $row['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <textarea class="form-control" id="requirements" rows="3" name="requirement"
                    placeholder="Job Requirements"><?php echo $row['requirement']; ?></textarea>
            </div>

            <div class="mb-3">
                <textarea class="form-control" id="benefits" rows="3" name="benefits"
                    placeholder="Job Benefits"><?php echo $row['benefits']; ?></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>


