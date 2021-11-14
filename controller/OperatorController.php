<?php
include('../model/Operator.php');
class OperatorController
{
    public function insertRecord()
    {
        $time = time();
        $currentDate = date("Y-m-d", $time);
        $operator = new Operator();
        $value = $operator->isOperator($_POST['ID'], $_POST['email']);
        switch ($value) {
            case -1: {
                    echo -1;
                    break;
                }
            case 0: {
                    //move file to upload file
                    $target_directory = "../upload/operator";
                    if (!file_exists($target_directory)) {
                        //create folder
                        mkdir($target_directory);
                    }
                    //fetch record creation date
                    $_POST['record_created_date'] = $currentDate;
                    //insert data to DB
                    $operator->insertData($_POST);
                    //fetch user id
                    $user_id = $operator->getOperatorID($_POST['ID']);

                    $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
                    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $newfilename = $target_directory . '/' . $user_id . "." . $filetype;
                    //upload image to server
                    if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                        //upload imagepath to db
                        $operator->uploadImage($user_id, "../" . $newfilename);
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

        $operator = new Operator();
        $checkID = $operator->checkID($_POST['ID'], $_POST['user_id']);
        $checkEmail = $operator->checkEmail($_POST['email'], $_POST['user_id']);
        if ($checkID != -1) {
            if ($checkEmail != -1) {
                $operator->updateData($_POST);
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
        $operator = new Operator();
        return $operator->getAllRecord();
    }
    public function getRecord($user_id)
    {
        $operator = new Operator();
        $operator->selectData($user_id);
    }
    public function removeRecord($user_id)
    {
        $operator = new Operator();
        $operator->removeData($user_id);
    }
}
$operatorController = new OperatorController();

if (isset($_GET)) {
    //fetch data from model
    if (isset($_GET['getOperator'])) {
        if ($_GET['getOperator'] == 'all') {
            $operatorController->getRecords();
        }
        if (is_numeric($_GET['getOperator'])) {
            $operatorController->getRecord($_GET['getOperator']);
        }
    }
    if (isset($_GET['deleteOperator'])) {
        if ($_GET['deleteOperator'] == 'all') {
            //$operatorController->getRecords();
        }
        if (is_numeric($_GET['deleteOperator'])) {
            $operatorController->removeRecord($_GET['deleteOperator']);
            header("Location:  ../view/operator_view/operater-table.php");
        }
    }
}


if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'add-operator') {
        $operatorController->insertRecord();
    }
    if ($_POST['operation'] == 'update-operator') {
        $operatorController->updateRecord();
       
    }
}
