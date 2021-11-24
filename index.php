<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.min.css">
  <link rel="stylesheet" href="css/framework/bootstrap.min.css">
  <link rel="stylesheet" href="css/test.css">
  <script src="css/framework/jquery.min.js"></script>
  <script src="css/framework/bootstrap.min.js"></script>
  <script src="css/framework/popper.min.js"></script>
  <script src="js/sidenav.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

  <div class="container-fluid ">
    <div class="row vh-100 ">


      <div id="sidebar-container" class="col-lg-2 col-md-4 col-xs-2" style="padding: 0;">
        <nav id="sidebar">
          <div class="sidebar-header">
            <h5>Admin Panel</h5>
            <button id="closeSideBar"><i class="far fa-times-circle"></i></button>
          </div>

          <ul class="list-unstyled">
            <div id="img-container">
              <img src="img/saji-nael-zeer.jpg" alt="">
              <div id="admin-details">
                <h5>Saji Nael</h5>
                <span>Administrator</span>
              </div>
            </div>
            <li>
              <a href="index.php">Dashboard</a>
            </li>
            <li>
              <a href="#operatorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Operator</a>
              <ul class="collapse list-unstyled" id="operatorSubmenu">
                <li>
                  <a href="view/operator_view/add-operator.php">Add Operator</a>
                </li>
                <li>
                  <a href="view/operator_view/operater-table.php">Operator Table</a>
                </li>

              </ul>
            </li>
            <li>
              <a href="#taxiSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Taxi</a>
              <ul class="collapse list-unstyled" id="taxiSubmenu">
                <li>
                  <a href="view/taxi_view/taxi-form.php">Add Taxi</a>
                </li>
                <li>
                  <a href="view/taxi_view/taxi-table.php">Taxi Table</a>
                </li>

              </ul>
            </li>
            <li>
              <a href="#driverSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Driver</a>
              <ul class="collapse list-unstyled" id="driverSubmenu">
                <li>
                  <a href="view/driver_view/add-driver.php">Add Driver</a>
                </li>
                <li>
                  <a href="view/driver_view/driver-table.php">Driver Table</a>
                </li>

              </ul>
            </li>
            <li>
              <a href="#parkSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Park</a>
              <ul class="collapse list-unstyled" id="parkSubmenu">
                <li>
                  <a href="view/park_view/add-park.php">Add Park</a>
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
      </div>


      <div id="main" class="col-lg-10 col-md-8 col-xs-5" style="padding: 0;">
        <nav id="top-nav" class="navbar navbar-expand-lg navbar-light" style="background-color: #334756; ">
          <button type="button" id="sidebarCollapse" class="btn btn-info bg-dark" style="border: none;outline: none;">
            <i class="fas fa-align-left"></i>

          </button>

          <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item ">
                <a style="color: white;" class="nav-link" href="#">
                  <i class="fas fa-bell"></i> <span class="badge badge-light">0</span>
                  <span class="sr-only">unread messages</span>
                </a>
              </li>
              <li class="nav-item">
                <a style="color: white;" class="nav-link" href="#">Logout</a>
              </li>

            </ul>

          </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" style="margin: 0;padding: 0;">


          <main class="container-fluid col-lg-12 ">
            <div class="row" style="padding-top: 30px;">
              <div class="col-lg-4">
                <div style="background-color: blue;height: 175px;padding: 10px;border-radius: 10px;">
                  <h3 class="text">User</h3>
                  <div class="data-box" id="taxi-data-box"><i class="fas fa-taxi"></i> <span>0 user</span></div>
                </div>
              </div>
              <div class="col-lg-4">
                <div style="background-color: #1DAB47;height: 175px;padding: 10px;border-radius: 10px;">
                  <h3 class="text">Active Taxies</h3>
                  <div class="data-box" id="taxi-data-box"><i class="fas fa-taxi"></i> <span>0 taxi</span></div>
                </div>
              </div>
              <div class="col-lg-4 ">
                <div style="background-color: #FC413F;height: 175px;padding: 10px;border-radius: 10px;">
                  <h3 class="text">Open tickets</h3>
                  <div class="data-box" id="tickets-data-box"><i class="fas fa-flag"></i> <span>0 ticket</span></div>
                </div>
              </div>
            </div>
            <div id="card-container" class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <i style="font-size: 20px;" class="fas fa-parking"></i> <span style="font-weight: bold;margin-left: 10px;font-size: 20px;">Park</span>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <i style="font-size: 20px;" class="far fa-bell"></i> <span style="font-weight: bold;margin-left: 10px;font-size: 20px;">Notifications</span>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>



              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>


</body>

</html>