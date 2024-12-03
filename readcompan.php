<?php include("welcomeadmin.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Company Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 50px;
        }

        table {
            background-color: black!important;
            color: #fff;
        }

        th,
        td {
            border: 1px solid #fff;
        }

        th {
            background-color: #333;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Company Information</h2>

        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "jobsearch";
        $tablename = "company_info";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM $tablename";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th scop="col">Company Id</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Founder</th>
                            <th scope="col">Location</th>
                            <th scope="col">Facebook Link</th>
                            <th scope="col">Company Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' .$row["company_id"]. '</td>
                        <td>' . $row["company_name"] . '</td>
                        <td>' . $row["founder"] . '</td>
                        <td>' . $row["location"] . '</td>
                        <td>' . $row["facebook_link"] . '</td>
                        <td><img src="' . $row["company_img"] . '" alt="Company Image" style="max-width: 100px; max-height: 100px;"></td>
                        <td>
                            <form action="companyupdate.php" method="post" style="display: inline;">
                                <input type="hidden" name="company_id" value="' . $row["company_id"] . '">
                                <button type="submit" class="btn btn-warning btn-sm" name="Update">Update</button>
                            </form>
                            
                            <form action="company_delete.php" method="post" style="display: inline;">
                                <input type="hidden" name="company_id" value="' . $row["company_id"] . '">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "No records found";
        }

        $conn->close();
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
