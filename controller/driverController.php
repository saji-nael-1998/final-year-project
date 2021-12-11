<?php
include_once(__DIR__ . '\\..\\model\\Taxi.php');
include_once(__DIR__ . '\\..\\model\\Driver.php');

class DriverController
{
    public function insertRecord()
    {


        $driverModel = new Driver();
        $value = $driverModel->isDriver($_POST['ID'], $_POST['email']);
        switch ($value) {
            case -1: {
                    echo -1;
                    break;
                }
            case 0: {
                    //move file to upload file
                    $target_directory = "../upload/driver";
                    if (!file_exists($target_directory)) {
                        //create folder
                        mkdir($target_directory);
                    }



                    //fetch user id
                    $user_id =  $driverModel->insertRecord($_POST);

                    $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
                    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $newfilename = $target_directory . '/' . $user_id . "." . $filetype;
                    //upload image to server
                    if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                        //upload imagepath to db
                        $driverModel->uploadImage($user_id, "/upload/driver/" . $user_id . "." . $filetype);
                        //
                        echo 0;
                    }
                    break;
                }
            case 1: {
                    echo 1;
                    break;
                }
        }
    }
    function getTaxiRecords()
    {
        $taxiModel = new Taxi();
        echo $taxiModel->getAvailableTaxi();
    }
}
$driverController = new DriverController();
$operation = '';
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    unset($_GET['operation']);
} else if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
    unset($_POST['operation']);
}
if ($operation == 'get-records') {
} else if ($operation == 'get-taxi') {
    $driverController->getTaxiRecords();
}else if ($operation == 'add-record') {
    unset($_POST['CPass']);
    $driverController->insertRecord();
}

