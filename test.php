<?php include("header.php") ?>

<style>
    .company-card {
        background-color: black;
        color: white;
        max-width: 400px;
        height: 130px;
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


    .job-card {
        background-color: #f8f9fa;
        color: #343a40;
        margin-top: 1rem;
        padding: 1rem;
        border-radius: 0 0 20px 20px;
    }

    .job-card h5 {
        margin-bottom: 1rem;
    }


    .pagination-container {
        display: flex;
        justify-content: flex-end;
        /* Align to the right */
        margin-top: 20px;
    }
</style>

<div class="container mt-20">
    <h2 class="mb-5">Company Cards</h2>

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

        // Display data in Bootstrap cards
        while ($row = $result->fetch_assoc()) {
            echo '

            <div class="col-md-4">
                <div class="company-card" data-bs-toggle="modal" data-bs-target="#companyModal' . $row['company_id'] . '">
                    <img src="' . $row['company_img'] . '" class="company-img" alt="Company Image">
                    <div class="company-details">
                        <h5 class="card-title">' . $row['company_name'] . '</h5>
                        <p><strong></strong> ' . $row['founder'] . '</p>
                    </div>
                </div>
            </div>';

            echo '
            <div class="modal fade" id="companyModal' . $row['company_id'] . '" tabindex="-1" aria-labelledby="companyModalLabel' . $row['company_id'] . '" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="background:linear-gradient(45deg,gold,white);">
                    <div class="modal-content" style="background:black; color:gold;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="companyModalLabel' . $row['company_id'] . '">' . $row['company_name'] . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="height:200px;">
                            <div class="row">
                                <div class="col-md-6" style="width:200px; height:150px; border-radius:30px;">
                                    <img src="' . $row['company_img'] . '" class="img-fluid mb-3" alt="Company Image">
                                </div>
                                <div class="col-md-6">
                                    <p> ' . $row['founder'] . '</p>
                                    <p>' . $row['location'] . '</p>
                                    <p> <a href="' . $row['facebook_link'] . '">' . $row['facebook_link'] . '</a></p>
                                    <!-- Add more details as needed -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>';

        }
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
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!--  -->
<?php
            // Check if a new company image is provided
            if (isset($_FILES["companyImage"]) && isset($_FILES["companyImage"]["name"]) && $_FILES["companyImage"]["name"] != "") {
                // Upload company image
                $targetDir = "uploads/";
                $targetFile = $targetDir . basename($_FILES["companyImage"]["name"]);
                move_uploaded_file($_FILES["companyImage"]["tmp_name"], $targetFile);

                // Update data in the database, including company_img
                $sql = "UPDATE $tablename SET company_name = '$companyName', founder = '$founder', location = '$location', facebook_link = '$facebookLink', company_img = '$targetFile' WHERE company_id = $companyId";
            } else {
                // Update data in the database without changing company_img
                $sql = "UPDATE $tablename SET company_name = '$companyName', founder = '$founder', location = '$location', facebook_link = '$facebookLink' WHERE company_id = $companyId";
            }

            if ($conn->query($sql) === TRUE) {
                echo "Data updated successfully";
                header("location:readcompan.php");
            } else {
                echo "Error updating data: " . $conn->error;
            }
        ?> 