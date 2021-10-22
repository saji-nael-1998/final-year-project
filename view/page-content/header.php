<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/fontawesome-free-5.15.3-web/css/all.min.css">
  <link rel="stylesheet" href="../../css/framework/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/test.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script src="../../css/framework/jquery.min.js"></script>

  <script src="../../js/sidenav.js"></script>
</head>

<body>
  <div class="container-fluid h-100" style="padding: 0;">
    <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar">
        <div class="sidebar-header">
          <h5>Admin Panel</h5>
        </div>

        <ul class="list-unstyled components">
          <div id="img-container">
            <img src="../../img/saji-nael-zeer.jpg" alt="">
            <div id="admin-details">
              <h5>Saji Nael</h5>
              <span>Administrator</span>
            </div>
          </div>
          <li>
            <a href="index.html">Dashboard</a>
          </li>
          <li>
            <a href="#operatorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Operator</a>
            <ul class="collapse list-unstyled" id="operatorSubmenu">
              <li>
                <a href="../operator_view/add-operator.php">Add Operator</a>
              </li>
              <li>
                <a href="../operator_view/operater-table.php">Operator Table</a>
              </li>

            </ul>
          </li>
          <li>
            <a href="#taxiSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Taxi</a>
            <ul class="collapse list-unstyled" id="taxiSubmenu">
              <li>
                <a href="#">Add Taxi</a>
              </li>
              <li>
                <a href="#">Taxi Table</a>
              </li>

            </ul>
          </li>
          <li>
            <a href="#driverSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Driver</a>
            <ul class="collapse list-unstyled" id="driverSubmenu">
              <li>
                <a href="#">Add Driver</a>
              </li>
              <li>
                <a href="#">Driver Table</a>
              </li>

            </ul>
          </li>
          <li>
            <a href="#parkSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Park</a>
            <ul class="collapse list-unstyled" id="parkSubmenu">
              <li>
                <a href="#">Add Park</a>
              </li>
              <li>
                <a href="#">Park Table</a>
              </li>
              <li>
                <a href="#">Manege Park</a>
              </li>

            </ul>
          </li>
        </ul>


      </nav>

      <!-- Page Content  -->
      <div id="content" style="margin: 0;padding: 0;">
      <main class="container-fluid col-lg-12 " style="height: 100%;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin: 0;">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>

            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>