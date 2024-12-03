<?php include_once("header.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container{
            width: 100%;
            height: 800px!important;
        }
        .row{
            height:180px!important;
        }
        .company-card {
            background-color: black;
            color: white;
            max-width: 400px;
            height: 150px;
            margin: 1rem;
            display: flex;
            flex-direction: row;
            cursor: pointer;
            align-items: center;
            border-radius: 20px;
        }

        .company-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 1rem;
            border-radius: 30px;
        }

        .company-details {
            text-align: left;
            padding: 1rem;
        }

        .facebook-icon {
            color: #1877f2;
        }

        /* Pagination Styles */
        .pagination {
            justify-content: center;
            /* margin-top: 10px; */
        }

        .page-link {
            background-color: black;
            color: gold;
            border: 1px solid gold;
        }

        .page-link:hover {
            background-color: gold;
            color: black;
        }

        .page-item.active .page-link {
            background-color: gold;
            color: black;
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <h2 class="mb-2">Company Cards</h2>

        <div class="row">
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

            // Fetch data from the database
            $sql = "SELECT * FROM company_info";
            $result = $conn->query($sql);

            // Display data in Bootstrap cards with three rows and three columns
            $columnCount = 0;

            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-4">
                    <a href="displaycompany.php?company_id=' . $row['company_id'] . '" style="text-decoration: none; color: inherit;">
                        <div class="company-card">
                            <img src="' . $row['company_img'] . '" class="company-img" alt="Company Image">
                            <div class="company-details">
                                <h5 class="card-title">' . $row['company_name'] . '</h5>
                                <p><strong>Founder:</strong> ' . $row['founder'] . '</p>
                            </div>
                        </div>
                    </a>
                </div>';

                $columnCount++;
                if ($columnCount == 3) {
                    $columnCount = 0;
                    echo '</div><div class="row">';
                }
            }


            // Close the database connection
            $conn->close();
            ?>
            <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
        </nav>
        </div>

        <!-- Pagination -->
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
