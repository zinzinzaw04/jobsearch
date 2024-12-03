<?php include("header.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Beautiful Login Form</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 500px;
            height: 600px;
            margin: auto;
            padding: 20px;
            margin-top: 100px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            background-color: black;
            border-radius: 50px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color:gold;
        }

        .form-group {
            margin-bottom: 22px;
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }

        .form-group label {
            font-weight: bold;
            color:gold;
        }

        .form-group input[type="file"] {
            display: none;
        }

        .custom-file-label::after {
            content: "Browse";
        }

        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Browse";
        }

        .custom-file-input:lang(en)::before {
            content: "Choose file";
        }

        .custom-file-input {
            padding: 0.375rem 0.75rem;
        }

        .login-btn {
            width: 100%;
            font-weight: 500;
        }
        .login-btn:hover{
            background:yellow;
            color:black;
            font-size: 22px;
            font-weight: 400;
        }
    </style>
</head>

<body>

    <div class="container login-container">
        <h2 class="mb-4 mt-3">Registeration Form</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">

                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter your username" required name="username">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required name="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" required name="password">
            </div>

            <div class="form-group">
                <label for="profile">Profile Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="profile" accept="image/*" required name="profile">
                    <label class="custom-file-label" for="profile">Choose file</label>
                </div>
            </div>

            <button type="submit" class="btn btn-warning login-btn">Register</button>
        </form>
    </div>

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

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs to prevent SQL injection
        $username = $conn->real_escape_string($_POST['username']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $email = $conn->real_escape_string($_POST['email']);
        //$password = $conn->real_escape_string(password_hash($_POST['password'], PASSWORD_DEFAULT)); // Hash the password
        $password = $conn->real_escape_string($_POST['password']);
        $profile = $conn->real_escape_string($_FILES['profile']['name']);

        // Upload profile image
        $targetDir = "profiles/";
        $targetFile = $targetDir . basename($profile);
        move_uploaded_file($_FILES['profile']['tmp_name'], $targetFile);

        // Insert data into the database
        $sql = "INSERT INTO $tablename (username, phone, email, password, profile)
            VALUES ('$username', '$phone', '$email', '$password', '$profile')";

        if ($conn->query($sql) === TRUE) {
            header("location:useraccount.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>