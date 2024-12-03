<?php include('header.php')?>
<?php
  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jobsearch";
  $tablename = "company_info";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch company names from the database
  $sqlSelectCompanies = "SELECT company_name FROM $tablename";
  $resultSelectCompanies = $conn->query($sqlSelectCompanies);

  // Close the database connection
  $conn->close();
  ?>
<div class="row mt-100">
    <div class="col align-self-center" style="width: 80%;">
      <div class="text">
        Your future, Your Career
      </div>
      <p>Let's build your career with us!</p>
      <form class="d-flex align-items-center" style="height: 45px; padding-left: 470px!important;" action="searchresult.php" method="post">
        <div class="me-2">
          <select class="form-select" aria-label="Search Company">
            <option selected>Select Company</option>
            <?php
            if ($resultSelectCompanies->num_rows > 0) {
              while ($rowCompany = $resultSelectCompanies->fetch_assoc()) {
                echo '<option>' . $rowCompany["company_name"] . '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="me-2">
          <input type="text" class="form-control" placeholder="Search Jobs" aria-label="Search Jobs">
        </div>
        <button class="btn btn-outline-secondary" type="button" name="search">Search</button>
      </form>
    </div>
  </div>


  <div class="row mt-100">
    <div class="col align-self-end">
      <marquee behavior="" direction="">Thank you Tr Hnin and Tr Su.</marquee>
    </div>
  </div>
<?php include('footer.php')?>