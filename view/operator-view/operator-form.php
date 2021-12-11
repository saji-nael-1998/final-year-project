<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Form </title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!--bootstrap cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!--fontawesome cdn-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!--js cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

</head>

<body>
    <div class="conatiner-fluid h-100">
        <div class="row m-0 h-100">
            <div id="side_nav" class="col-lg-2 h-auto p-0">
                <div class="d-flex justify-content-between align-items-center px-2" style="height: 65px;">
                    <h5 style="color: white; font-weight: bold;text-transform: uppercase;">Admin Panel</h5>
                    <button id="close-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="list-group">
                    <a href="../../index.html" class="list-group-item  list-group-item-action my-2" aria-current="true">
                        <i class="fas fa-home"></i><span class="ml-2"><strong>Dashboard</strong></span>
                    </a>
                    <a href="#" class="list-group-item  list-group-item-action my-2"> <i class="fas fa-parking"></i><span class="ml-2">Park</span></a>
                    <a href="#" class="list-group-item  list-group-item-action my-2"> <i class="fas fa-parking"></i><span class="ml-2">Operator</span></a>
                    <a href="#" class="list-group-item  list-group-item-action my-2"> <i class="fas fa-taxi"></i><span class="ml-1">Taxi</span></a>
                    <a href="#" class="list-group-item  list-group-item-action my-2"> <i class="fas fa-user"></i><span class="ml-2">Driver</span></a>

                </div>
            </div>
            <!--main section -->
            <div id="main" class="col-lg-10 p-0">
                <div class="container-fluid p-0">
                    <!--navbar section -->
                    <div id="main-header">
                        <nav id="navbar" class="navbar navbar-expand-lg ">
                            <div class="d-flex align-items-center">
                                <button id="menu-icon"> <i class="fas fa-bars"></i></button>
                                <a class="navbar-brand ml-1" href="../../index.html">Dashboard</a>
                            </div>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">

                                    <li class="nav-item dropdown">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <strong><img style="display: inline-block; border-radius: 50%;margin-right: 5px;" height="40px" src="../../img/saji-nael-zeer.jpg" alt="">Saji
                                                        Nael</strong>

                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <a href="#" class="dropdown-item">
                                                        <strong>Profile</strong>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item">
                                                        <strong>Logout</strong>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                        <div id="myModal" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Operator Tegistration </h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="model-msg"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="main-body">
                        <!--here the main content-->
                        <div id="park-table-container" class="row  m-0">
                            <div class="container-fluid">
                                <div class="row m-0">
                                    <div class="col">
                                        <h6 style="color: white;"><strong>Choose Park</strong></h6>
                                    </div>
                                </div>
                                <div class="row m-0 mt-3">
                                    <div class="col">
                                        <div class="table-responsive-lg ">
                                            <table id="example" class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Park Name</th>
                                                        <th>Street</th>
                                                        <th>City</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="../../js/operator/addOperator.js"> </script>


</body>

</html>