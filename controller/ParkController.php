<?php
require_once('../model/park.php');
require_once('../model/route.php');
$action = "";
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
$parkModel = new Park();
if ($action == "createRecord") {
    //fetch route from POST
    $routes = $_POST['data']['park']['routes'];
    unset($_POST['data']['park']['routes']);
    //fetch park data from POST
    $park = $_POST['data']['park'];
    //insert record
    $park_id = $parkModel->insertRecord($park);
    for ($x = 0; $x < count($routes); $x++) {
        $route = array('park_id' => $park_id, 'src' =>  $_POST['data']['park']['city'], 'dest' => $routes[$x]);
        $parkModel->addRoute($route);
    }
    echo 1;
}
if ($action == "getAllRecords") {
    echo $parkModel->getAllRecord();
}
if ($action == "getRecord") {
    echo $parkModel->selectRecord($_GET['park_id']);
}
if ($action == "deleteRecord") {
    $parkModel->removeRecord($_GET['park_id']);
    header("Location: ../view/park-view/index.html");
}
if ($action == "updateRecord") {
    $parkModel->updateRecord($_POST['park']);
}
if ($action == "getAllRoutes") {
    echo $parkModel->getAllRoutes($_GET['park_id']);
}
if ($action == "deleteRoute") {
    $parkModel->deleteRoute($_GET['route_id']);
}
if ($action == "addRoute") {
    $parkModel->addRoute($_POST['data']['route']);
}
if ($action == "updateRoute") {
    $routeModel = new Route();
    $routeModel->updateRecord($_POST['data']['route']);
}
