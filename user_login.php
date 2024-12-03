<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobsearch";
$tablename = "user_register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check if user credentials are correct
    $sql = "SELECT * FROM $tablename WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        //password_verify($password, $row['password'])
        if ($password == $row['password']) {
            // Password is correct, redirect to user_account.php
            header("Location: useraccount.php?user_id=" . $row['user_id']);
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

// Close the database connection
$conn->close();
?>
<?php include("header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Login</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            /* padding-top:100px!important; */
            padding: 20px;
            margin-top: 120px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: black;
            border-radius: 50px;
        }
        form{
            width: 70%!important;
            height: 400px!important;
            margin: auto;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color:gold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color:gold;
        }

        .login-btn {
            width: 100%;
            background:gold;
            color:black;
            margin-bottom: 20px;
        }
        .login-btn:hover{
            /* background:white; */
            color:black;
            font-size: 25px;
            font-weight: 500;
        }
        .link{
            text-decoration: none;
            color:white;

        }
        .adm{
            height: 50px;
            background:black;
            margin-top: 30px;
            width: 18%;
            margin-left: 40%!important;
            font-size: 22px;
            border-radius: 30px;
            /* margin-left: auto; */
        }
    </style>
</head>

<body>

    <div class="container login-container">
        
        <form method="post" action="">
        <h2 class="mb-4">User Login</h2>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
            </div>

            <button type="submit" class="btn login-btn">Login</button>
            <a href="user_register.php" class="link">Don't you have an account?Register here</a>
        </form>
    </div>

    <button class="btn adm" ><a href="admin_login.php" class="link" style="color:gold;">Admin Login</a></button>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->
</body>

</html>
