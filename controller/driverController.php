<?php
include('../model/Driver.php');
class DriverController
{
    public function insertRecord()
    {
        $time = time();
        $currentDate = date("Y-m-d", $time);
        $driver = new driver();
        $value = $driver->isDriver($_POST['ID'], $_POST['email']);
        switch ($value) {
            case -1: {
                    echo -1;
                    break;
                }
            case 0: {
                    //move file to upload file
                    $target_directory = "../upload/drivers";
                    if (!file_exists($target_directory)) {
                        //create folder
                        mkdir($target_directory);
                    }
                    //fetch record creation date
                    $_POST['record_created_date'] = $currentDate;
                    //insert data to DB
                    $driver->insertData($_POST);
                    //fetch user id
                    $user_id = $driver->getDriverID($_POST['ID']);

                    $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
                    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $newfilename = $target_directory . '/' . $user_id . "." . $filetype;
                    //upload image to server
                    if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                        //upload imagepath to db
                        $driver->uploadImage($user_id, "../" . $newfilename);
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
    public function updateRecord()
    {

        $driver = new Driver();
        $checkID = $driver->checkID($_POST['ID'], $_POST['user_id']);
        $checkEmail = $driver->checkEmail($_POST['email'], $_POST['user_id']);
        if ($checkID != -1) {
            if ($checkEmail != -1) {
                $driver->updateData($_POST);
                echo 0;
            } else {
                echo -1;
            }
        } else {
            echo 1;
        }
    }
    public function getRecords()
    {
        $driver = new Driver();
        return $driver->getAllRecord();
    }
    public function getRecord($user_id)
    {
        $driver = new Driver();
        $driver->selectData($user_id);
    }
    public function removeRecord($user_id)
    {
        $driver = new Driver();
        $driver->removeData($user_id);
    }
}
$driverController = new DriverController();

if (isset($_GET)) {
    //fetch data from model
    if (isset($_GET['getDriver'])) {
        if ($_GET['getDriver'] == 'all') {
            $driverController->getRecords();
        }
        if (is_numeric($_GET['getDriver'])) {
            $driverController->getRecord($_GET['getDriver']);
        }
    }
    if (isset($_GET['deleteDriver'])) {
        if ($_GET['deleteDriver'] == 'all') {
            //$driverController->getRecords();
        }
        if (is_numeric($_GET['deleteDriver'])) {
            $driverController->removeRecord($_GET['deleteDriver']);
            header("Location:  ../view/driver_view/driver-table.php");
        }
    }
}


if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'add-driver') {
        $driverController->insertRecord();
    }
    if ($_POST['operation'] == 'update-driver') {
        $driverController->updateRecord();
       
    }
}
