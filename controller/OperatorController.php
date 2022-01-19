<?php


include( "../model/Operator.php");

class OperatorController
{
    public function insertRecord()
    {


        $operator = new Operator();
        $value = $operator->isOperator($_POST['ID'], $_POST['email']);
        switch ($value) {
            case -1: {
                    echo -1;
                    break;
                }
            case 0: {
                $target_directory='../../upload/operator';
                if (!file_exists(  $target_directory)) {
                    mkdir($target_directory, 0777, true);
                }
                  
                 

                    //fetch user id
                    $user_id =  $operator->insertRecord($_POST);

                    $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
                    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $newfilename = $target_directory . '/' . $user_id . "." . $filetype;
                    //upload image to server
                    if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                        //upload imagepath to db
                        $operator->uploadImage($user_id, "/upload/operator/" . $user_id . "." . $filetype);
                        //
                        echo 0;
                    }
                    echo 12;
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
                $operator->updateRecord($_POST);
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
        echo  $operator->getAllRecord();
    }
    public function getRecord($user_id)
    {
        $operator = new Operator();
        $operator->selectRecord($user_id);
    }
    public function removeRecord($user_id)
    {
        $operator = new Operator();
        $operator->removeRecord($user_id);
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
    if ($_POST['operation'] == 'add-record') {
        unset($_POST['CPass']);
        unset($_POST['operation']);

        $operatorController->insertRecord();
    } else if ($_POST['operation'] == 'update-operator') {
        $operatorController->updateRecord();
    }
}
