<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/framework/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        
    </style>

</head>

<body>

    <header>
        <div id="mySidenav" class="sidenav">
            <div id="close-nav-container">
                <span>Admin Panel</span>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            </div>

            <div id="sidenav-header">

                <img src="../../img/saji-nael-zeer.jpg" alt="">
                <div>
                    <span style="color: white; font-size:20px;">Saji Nael</span>
                    <span style="color: rgba(255, 255, 255, 0.678);display:block; margin-top: 5px;">Administrator</span>
                </div>
            </div>

            <h4 style="color: #4E4F50;">
                General
            </h4>
            <a class="option" href="#">Dashboard</a>
            <h4 style="color: #4E4F50;">
                Management
            </h4>
            <button class="dropdown-btn">Operator
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a style="font-size: 16px;" class="option" href="./operator_view/add-operator.php">Add Operator</a>
                <a style="font-size: 16px;" class="option" href="./operator_view/operater-table.html">List View</a>
                <a style="font-size: 16px;" class="option" href="#">Search</a>
            </div>
            <button class="dropdown-btn">Driver
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a style="font-size: 16px;" class="option" href="#">Link 1</a>
                <a style="font-size: 16px;" class="option" href="#">Link 2</a>
                <a style="font-size: 16px;" class="option" href="#">Link 3</a>
            </div>
            <button class="dropdown-btn">Taxi
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a style="font-size: 16px;" class="option" href="#">Link 1</a>
                <a style="font-size: 16px;" class="option" href="#">Link 2</a>
                <a style="font-size: 16px;" class="option" href="#">Link 3</a>
            </div>
            <button class="dropdown-btn">Park
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a style="font-size: 16px;" class="option" href="#">Link 1</a>
                <a style="font-size: 16px;" class="option" href="#">Link 2</a>
                <a style="font-size: 16px;" class="option" href="#">Link 3</a>
            </div>
        </div>
    </header>

    <div id="main">
        <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776; open</span>
        



</body>

</html>