<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/fontawesome-free-5.15.3-web/css/all.min.css">
    <style>
    body {
        font-family: "Lato", sans-serif;
        overflow: hidden;
    }


    .sidenav {
        height: 100%;
        width: 0px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;

    }

    /* Style the sidenav links and the dropdown button */
    .option,
    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
        position: relative;
    }

    .dropdown-btn i {
        position: absolute;
        right: 20px;
        top: 0;
        transform: translate(-50%, 50%);
    }

    .option:hover,
    .dropdown-btn:hover {
        color: #cab3b3;
    }



    #main {
        transition: margin-left .5s;
        padding: 16px;
        width: 100%;
    }

    /* Add an active class to the active dropdown button */
    .active {
        background-color: #818181;
        color: white;
    }

    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
        display: none;
        background-color: #262626;
        padding-left: 8px;
    }

    #sidenav-header {
        padding: 6px 8px 6px 16px;
        display: flex;
        align-items: center;

    }

    #sidenav-header img {
        width: 50px;
        border-radius: 50%;
        border: solid 3px white;
        margin-right: 10px;
    }

    #close-nav-container {
        background-color: #242424;
        position: relative;
        height: 40px;
        padding: 10px 0;
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    #close-nav-container span {
        color: white;
        padding: 10px 0;
        font-size: 20px;
        padding-left: 20px;
        text-transform: uppercase;
    }

    .sidenav .closebtn {
        font-size: 36px;
        color: white;
        position: absolute;
        top: 6px;
        right: 10px;
        border: none;
    }

    hr {
        border-color: rgba(247, 245, 245, 0.836);
        border-width: 0.5px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
    </style>

</head>

<body>

    <div id="mySidenav" class="sidenav">
        <div id="close-nav-container">
            <span>Admin Panel</span>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        </div>

        <div id="sidenav-header">

            <img src="../img/saji-nael-zeer.jpg" alt="">
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

    <div id="main">
        <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776; open</span>
        <h2>Sidenav Push Example</h2>
        <p>Click on the element below to open the side navigation menu, and push this content to the right.</p>
        <?php
        include('./footer.php');
         ?>
    </div>




</body>

</html>