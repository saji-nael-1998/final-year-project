<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/framework/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/test.css">
    <script src="../../css/framework/jquery.min.js"></script>
    <script src="../../css/framework/bootstrap.min.js"></script>
    <script src="../../css/framework/popper.min.js"></script>
    <script src="../../js/sidenav.js"></script>
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
                                    <a href="../taxi/taxi-form.php">Add Taxi</a>
                                </li>
                                <li>
                                    <a href="../taxi/taxi-table.php">Taxi Table</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="#driverSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Driver</a>
                            <ul class="collapse list-unstyled" id="driverSubmenu">
                                <li>
                                    <a href="../driver_view/add-driver.php">Add Driver</a>
                                </li>
                                <li>
                                    <a href="../driver_view/driver-table.php">Driver Table</a>
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
                                    <i class="fas fa-bell"></i> <span class="badge badge-light">9</span>
                                    <span class="sr-only">unread messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="color: white;" class="nav-link" href="#">Logout</a>
                            </li>

                        </ul>

                    </div>
                </nav>
                <div id="content">
                    <div>
                        <form id="search-form">
                            <div class="row">
                                <div class="col-lg-3 col-md-5 col-sx-3 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="width: 75px;">show</div>
                                        </div>
                                        <select class="custom-select" id="inlineFormCustomSelectPref">
                                            <option selected>Choose...</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row col-lg-9 col-md-12 col-sx-5">
                                    <div class="input-group col-md-4  col-lg-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="width: 75px;">Sort</div>
                                        </div>
                                        <select class="custom-select" id="inlineFormCustomSelectPref">
                                            <option selected>Choose...</option>
                                        </select>
                                    </div>
                                    <div class="input-group col-lg-6 col-md-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="width: 75px;">Name</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="name">
                                        <button style="margin-left: 10px;" type="submit" class="btn btn-primary ">search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive-lg">
                        <table class="table table-striped table-dark">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Park</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col" style="padding-left: 25px;">
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>

                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>













        </div>




    </div>
    <script>
        $(function() {

            /*  $.ajax({
                  method: "GET",
                  url: "../../controller/OperatorController.php?getOperator",
              }).done(function(data) {
                  var result = JSON.parse(data);
                  console.log(result[0].operatorID);
                  for (var counter = 0; counter < result.length; counter++) {
                      var details = "";
                      details += "<td>" + (counter + 1) + "</td>";
                      details += "<td>" + result[counter].FName + "</td>";
                      details += "<td>" + result[counter].LName + "</td>";
                      details += "<td>" + result[counter].birthDate + "</td>";
                      details += "<td>" + result[counter].ID + "</td>";
                      details += "<td>" + result[counter].phoneNO + "</td>";
                      details += "<td>" + '<button type="button" class="btn btn-primary">View</button>' + "</td>";
                      $("tbody").append("<tr></tr>").append(details);

                  }

              });*/

        });
    </script>
</body>


</html>