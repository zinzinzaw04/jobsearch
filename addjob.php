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
    // Escape user inputs to prevent SQL injection
    $jobName = $conn->real_escape_string($_POST['jobName']);
    $jobType = $conn->real_escape_string($_POST['jobType']);
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $companyId = $conn->real_escape_string($_POST['companyId']);
    $companyEmail = $conn->real_escape_string($_POST['email']);
    $deadline = $conn->real_escape_string($_POST['deadline']);
    $industry = $conn->real_escape_string($_POST['industry']);
    $salary = $conn->real_escape_string($_POST['salary']);
    $description = $conn->real_escape_string($_POST['description']);
    $requirements = $conn->real_escape_string($_POST['requirement']);
    $benefits = $conn->real_escape_string($_POST['benefits']);

    // Insert data into the database
    $sql = "INSERT INTO job (job_name, job_type, com_name, description, requirement, benefits,employ_mail,deadline,industry,salary)
            VALUES ('$jobName', '$jobType', '$companyName', '$companyId','$description', '$requirements', '$benefits','$companyEmail','$deadline','$industry','$salary')";

    if ($conn->query($sql) === TRUE) {
        // echo "Record inserted successfully";
        session_start();
        header("location:viewjob.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<?php include("welcomeadmin.php")?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Job Application Form</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        /* body {
            width: 100%;
            height: 120vh;
            background: linear-gradient(to left bottom, white, gold);
        } */

        form {
            margin-top: 95px;
            width: 50%;
            height: 840px!important;
            background: black!important;
            margin-right: auto;
            margin-left: auto;
            border-radius: 20px;
            display:flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: space-between;


        }
        .elem{
            width: 85%;
            /* height: 40px; */
            margin-right: auto;
            margin-left: auto;

        }
        .row{
            width: 88%!important;
            height: 35px!important;
            margin-right: auto;
            margin-left: auto;
        }
        .row .col-sm-6{
            width:50%;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <form  method="post">
            <!-- <h2 class="mb-4 pt-4" align="center">Job Application Form</h2> -->
            <div class="mb-4 mt-3 row" style="height:35px">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="jobName" placeholder="Job Name" name="jobName"required>
                </div>
                <div class="col-sm-6">
                    <select class="form-select" id="jobType" name="jobType">
                        <option value="" disabled selected>Job Type</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option> elem
                        <option value="Contract">Contract</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>
            </div>
            <div class="mb-4 elem">
                <input type="text" class="form-control" id="companyName" placeholder="Company Name" name="companyName">
            </div>
            <div class="mb-4 elem">
                <input type="text" class="form-control" id="companyName" placeholder="Company ID" name="companyId">
            </div>
            <div class="mb-4 elem">
                <input type="text" class="form-control" id="companyName" placeholder="Email to accept Resume" name="email">
            </div>
            <div class="mb-4 elem">
                <input type="text" class="form-control" id="companyName" placeholder="Deadline" name="deadline">
            </div>
            <div class="mb-4 elem">
            <select class="form-select" id="industry" name="industry">
                        <option value="" disabled selected>industry</option>
                        <option value="General">General</option>
                        <option value="IT">IT</option>
                        <option value="Teaching">Teaching</option>
                        <!-- <option value="Freelance">Freelance</option> -->
                    </select>
            </div>
            <div class="mb-4 elem">
                <input type="text" class="form-control" id="salary" placeholder="salary" name="salary">
            </div>
            <div class="mb-4 elem">
                <textarea class="form-control" id="description" rows="3" placeholder="Job Description" required name="description"></textarea>
            </div>
            <div class="mb-4 elem">
                <textarea class="form-control" id="requirements" rows="3" placeholder="Job Requirements" required name="requirement"></textarea>
            </div>
            <div class="mb-4 elem">
                <textarea class="form-control" id="benefits" rows="3" placeholder="Job Benefits" required name="benefits"></textarea>
            </div>
            <button type="submit" class="btn btn-warning" style="width: 25%;margin-right:auto; margin-left:auto;"> ADD JOB</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>


</html>