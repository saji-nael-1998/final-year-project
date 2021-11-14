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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

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
                            <a href="../../index.php">Dashboard</a>
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

                    <div class="table-responsive-lg">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>FName</th>
                                    <th>LName</th>
                                    <th>Email</th>
                                    <th>Park</th>
                                    <th>ID</th>
                                    <th>ID</th>
                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                ajax: {
                    url: '../../controller/OperatorController.php?getOperator=all',
                    dataSrc: 'data'
                },

                columns: [{
                        "data": "FName"
                    }, {
                        "data": "MName"
                    }, {
                        "data": "email"
                    }, {
                        "data": "park_id"
                    }, {
                        "data": "ID"
                    },
                    {
                        "data": "user_id",


                        render: function(data, type, row) {
                            var btn = '';
                            let link = "operator.php?getOperator=" + data;
                            btn += "<button class='btn btn-info'><a href='" + link + "'>view</a> </button>";
                            let deleteLink="../../controller/OperatorController.php?deleteOperator=" + data;
                            btn += "<button class='ml-1 btn btn-danger'><a href='" + deleteLink + "'>delete</a> </button>";
                            return btn;
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>