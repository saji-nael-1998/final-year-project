<?php
require_once( "../model/driver.php");
require_once( "../model/taxi.php");
require_once( "../model/park.php");
require_once( "../model/operator.php");
class indexController
{
    public function getDriverSize()
    {
        $driverModel = new Driver();
        $driverModel->getDriverCount();
    }
    public function getTaxiSize()
    {
        $driverModel = new Taxi();
        $driverModel->getTaxiCount();
    }
    public function getParkSize()
    {
        $driverModel = new Park();
        $driverModel->getParkCount();
    } public function getOperatorSize()
    {
        $driverModel = new Operator();
        $driverModel->getOperatorCount();
    }
}

$indexController = new indexController();
$operation = '';
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    unset($_GET['operation']);
} else if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
    unset($_POST['operation']);
}
if ($operation == "get-driver-count") {
    $indexController->getDriverSize();
}else if ($operation == "get-taxi-count") {
    $indexController->getTaxiSize();
}else if ($operation == "get-park-count") {
    $indexController->getParkSize();
}else if ($operation == "get-operator-count") {
    $indexController->getOperatorSize();
}
