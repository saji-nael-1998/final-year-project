<?php
require_once('../model/park.php');
class ParkOperator
{
    function insertRecord()
    {
        if (isset($_POST)) {
            $park = new Park();
            $park->insertRecord($_POST);
            return 1;
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
        return $park->getAllOperator($_GET['park_id']);
    }
    public function getRouteOfPark()
    {
        $park = new Park();
        return $park->getAllRoute($_GET['park_id']);
    }
    public function removeRecord($park_id)
    {
        $park = new Park();
        $park->removeRecord($park_id);
    }
}

$parkOperator = new ParkOperator();

if (!empty($_POST)) {
    if ($_POST['operation'] == 'add-park') {
        echo $parkOperator->insertRecord();
    }
}  
if(!empty($_GET)){
    if (isset($_GET['getPark'])) {
        if ($_GET['getPark'] == 'all') {
           $parkOperator->getRecords();
        }
        if (is_numeric($_GET['getPark'])) {
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
    if (isset($_GET['deletePark'])) {
        if ($_GET['deletePark'] == 'all') {
            //$operatorController->getRecords();
        }
        if (is_numeric($_GET['deletePark'])) {
            $parkOperator->removeRecord($_GET['deletePark']);
            header("Location:  ../view/park_view/park-table.php");
        }
    }
}


