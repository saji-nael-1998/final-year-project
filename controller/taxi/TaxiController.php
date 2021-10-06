<?php

require_once ('../model/admin.php');

class TaxiController{
    public function addTaxi(){
            $admin = new Admin();
//            $admin->addTaxi($data);
    }
}

$taxiController = new TaxiController();
$taxiController->addTaxi();
