<?php
require_once(__DIR__ . '\\..\\model\\park.php');
require_once(__DIR__ . '\\..\\model\\route.php');




class ParkOperator
{

    function insertRecord()
    {
        $park = new Park();

        if (isset($_POST['data']['route'])) {
            if (!empty($_POST['data']['route'])) {
                $routes = $_POST['data']['route'];
                //unset route
                unset($_POST['data']['route']);
                $park_id = $park->insertRecord($_POST['data']);
                $routeModel = new Route();

                foreach ($routes as $row) {
                    array_unshift($row, $park_id);

                    $routeModel->insertRecord($row);
                }
            }
        }
    }
    function deleteRecord()
    {
        if (isset($_GET)) {
            $park = new Park();
            $park->insertRecord($_POST);
            return 1;
        }
    }
    public function getRecords()
    {
        $park = new Park();
        return $park->getAllRecord();
    }
    public function getOperatorOfPark()
    {
        $park = new Park();
    }
    public function getRouteOfPark()
    {
        $park = new Park();
    }
    public function removeRecord($park_id)
    {
        $park = new Park();
        $park->removeRecord($park_id);
    }
}

$parkOperator = new ParkOperator();
if (!empty($_POST)) {
    if ($_POST['operation'] == 'add-record') {
        $parkOperator->insertRecord();
    }
}
if (!empty($_GET)) {
    if (isset($_GET['getRecord'])) {
        if ($_GET['getRecord'] == 'all') {
            echo $parkOperator->getRecords();
        } else if (is_numeric($_GET['getRecord'])) {
            // $parkOperator->getRecord($_GET['getOperator']);
        }
    }
    if (isset($_GET['getOperator'])) {
        if ($_GET['getOperator'] == 'all') {
            $parkOperator->getOperatorOfPark();
        }
    }
    if (isset($_GET['getRoute'])) {
        if ($_GET['getRoute'] == 'all') {
            $parkOperator->getRouteOfPark();
        }
    }
    if (isset($_GET['deleteRecord'])) {
        if ($_GET['deletePark'] == 'all') {
            //$operatorController->getRecords();
        } else if (is_numeric($_GET['deletePark'])) {
            $parkOperator->removeRecord($_GET['deletePark']);
            header("Location:  ../view/park_view/park-table.php");
        }
    }
}
