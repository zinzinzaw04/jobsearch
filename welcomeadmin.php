<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOme</title>
  <link rel="stylesheet" href="header.css" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Tektur&display=swap');
    .container{
      /* margin-top: 90px!important; */
      font-family:'Tektur', sans-serif!important;;
    }
  </style>
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <h1 class="navbar-brand me-auto" href="#">Golden Future</h1>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Golden Future</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
          <li class="nav-item">
              <a class="nav-link  mx-lg-2 " aria-current="page" href="newadmin.php">Add Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  mx-lg-2 " aria-current="page" href="addcompany.php">Add company</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  mx-lg-2" href="addjob.php">Add job</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link  mx-lg-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Jobs
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="ittest.php">IT</a></li>
                <li><a class="dropdown-item" href="Teaching.php">Teaching</a></li>
                <li><a class="dropdown-item" href="General.php">General</a></li>
              </ul>
            </li> -->
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="readcompan.php">View Company</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="viewjob.php">View job</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  mx-lg-2 " aria-current="page" href="viewreview.php">View review</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="user_login.php" class="login-button">Login</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <div class="container">
    <!-- <h1 align="center" style="font-weight:600!important; font-size:4rem!important;">Welcome to the team, Admin.</h1> -->
  </div>
</body>
</html>
