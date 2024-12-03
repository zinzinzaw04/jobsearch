<?php include("header.php") ?>

<style>
    .container{
        width: 100%;
        height:900px!important;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
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

    .pagination-container {
        display: flex;
        justify-content: flex-end;
        /* Align to the right */
        margin-top: 20px;
    }
</style>

<div class="container" style="height:900px;">
    <!-- <h2 class="mb-5">Company Cards</h2> -->

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

        // Display data in Bootstrap cards with three rows and two columns
        $columnCount = 0;
        $rowCount = 1;

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
                $rowCount++;
                if ($rowCount > 2) {
                    break; // If you only want three rows, you can exit the loop after the third row
                }
                echo '</div><div class="row">';
            }
        }
        echo '</div>';
        ?>
    </div>
</div>

<!-- Pagination -->
<div class="pagination-container">
    <ul class="pagination">
        <!-- Add pagination items dynamically based on the number of pages -->
        <!-- For simplicity, you can replace the href values with the actual page links -->
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <!-- Add more pages as needed -->

        <!-- Previous Page and Next Page buttons -->
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->
