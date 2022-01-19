<?php
require_once( "../model/route.php");
require_once( "../model/trip.php");
require_once( "../model/park.php");
class reportController
{

    function getDrivers()
    { 
        $routeModel = new Route();
        echo $routeModel->getDrivers($_GET['park_id']);
    }
    function getOperator()
    {
        $routeModel = new Park();
        echo $routeModel->getOperator($_GET['park_id']);
    }
     function getTripCount()
    {
        $tripModel = new Trip();
        echo $tripModel->getCountOfTrip($_GET['park_id'],date("Y-m-d"));
    }
    function getDriverTrip()
    {
        $tripModel = new Trip();
        echo $tripModel->getDriverTrip($_GET['driver_id'], $_GET['date']);
      
    }
}

$indexController = new reportController();
$operation = '';
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    unset($_GET['operation']);
} else if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
    unset($_POST['operation']);
} 
 if ($operation == 'get-drivers') {
    $indexController->getDrivers();
} else if ($operation == 'get-operator') {
    $indexController->getOperator();
} else if ($operation == 'get-driver-trip') {
    $indexController->getDriverTrip();
}
