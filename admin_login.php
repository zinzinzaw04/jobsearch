<?php
ob_start();
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>adminlogin</title>
    <link rel="stylesheet" href="./admlog.css">
</head>

<body>
    <section class="login">
        <div class="container mt-5">
            <div class="row g-0 mt-5">
                <div class="col-lg-5">
                    <img src="./img/admin_log.jpg" alt="adminlog">
                </div>
                <div class="col-lg-7 text-center py-5">
                    <h1>Welcome Admin</h1>

                    <form action="" method="post">
                        <div class="form-row py-3 pt-5">
                            <div class="offset-1 col-lg-10">
                                <input type="text" class="inp px-3" placeholder="Admin name" name="adn_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="offset-1 col-lg-10">
                                <input type="password" class="inp px-3" placeholder="Admin Password" name="adm_password">
                            </div>
                        </div>

                        <div class="form-row pt-3">
                            <div class="offset-1 col-lg-10">
                                <button class="btn1" type="submit" name="submit">Login </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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

    // Function to sanitize user input
    function sanitizeInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Check if the login form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Sanitize inputs
        $adminName = sanitizeInput($_POST["adn_name"]);
        $adminPassword = sanitizeInput($_POST["adm_password"]);

        // Validate inputs (you may add more validation if needed)
        if (empty($adminName) || empty($adminPassword)) {
            echo "Please enter both admin name and password.";
        } else {
            $query = mysqli_query($conn, "SELECT * FROM admin_login WHERE adm_name='" . $adminName . "' AND adm_password='" . $adminPassword . "' ");
            $numrows = mysqli_num_rows($query);
            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbusername = $row['adm_name'];
                    $dbpassword = $row['adm_password'];
                }
                if ($adminName == $dbusername && $adminPassword == $dbpassword) {
                    // session_start();
                    // $_SESSION['sess_user'] = $user;
                    header("Location:welcomeadmin.php");
                    exit();
                }
            } else {
                echo "Invalid username or password!";
            }
            // Hash the password (you should use a more secure hashing method in production)
            // $hashedPassword = md5($adminPassword);

            // Check admin credentials in the database
            // $sql = "SELECT * FROM admin_login WHERE adm_name = '$adminName' AND adm_password = '$hashedPassword'";
            // $result = $conn->query($sql);

            // if ($result->num_rows==1) {
            // Admin login successful
            // Redirect to adminWelcome.php
            // header("Location: welcomeadmin.php");
            // exit();
            // } else {
            // Admin login failed
            // echo "Invalid admin name or password.";
            // }
        }
    }
    // $result->num_rows == 1

    // Close the database connection
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>