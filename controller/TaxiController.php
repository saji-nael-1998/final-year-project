<?php

require_once('../model/route.php');
require_once( '../model/taxi.php');
require_once( '../model/park.php');
class TaxiController
{
    function insertRecord()
    {
        $taxiModel = new Taxi();
        echo $taxiModel->insertRecord($_POST);
    }
    function getParkRoutes()
    {
        $park_id = $_GET['park_id'];
        $routeModel = new Route();
        echo $routeModel->selectRecord($park_id);
    }

    function getParks()
    {
        $parkodel = new Park();
        echo $parkodel->getAllRecord();
    }
    function getTaxiRecords()
    {
        $taxiModel = new Taxi();
        echo $taxiModel->getRecords();
    }
}

$taxiController = new TaxiController();

$operation = '';
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    unset($_GET['operation']);
} else if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
    unset($_POST['operation']);
}
if ($operation == 'park-routes') {
    $taxiController->getParkRoutes();
} else if ($operation == 'get-parks') {
    $taxiController->getParks();
} else if ($operation == 'add-record') {
    $taxiController->insertRecord();
} else if ($operation == 'get-records') {
    $taxiController->getTaxiRecords();
}
