<?php
include('../model/Driver.php');
class DriverController
{
    public function insertRecord()
    {


        $driver = new Driver();
        if (!$driver->isDriver($_POST['email'])) {
            //move file to upload file
            $target_directory = "../upload/drivers";
            if (!file_exists($target_directory)) {
                mkdir($target_directory);
            }
            $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newfilename = $target_directory . '/' . $_POST['ID'] . "." . $filetype;
            if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                $_POST['imagePath'] = $newfilename;
                $driver->insertData($_POST);
                echo "true";
            }
        } else {
            echo "false";
        }
    }
    public function getRecords()
    {
        $driver = new Driver();
        $driver->getAllRecord();
    }
}
$driver = new DriverController();
if (isset($_GET['getDriver'])) {
    $driver->getRecords();
    exit();
}
if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'add-driver') {
        $driver->insertRecord();
    }
}
