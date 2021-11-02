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
                        mkdir($target_directory);
                    } 
                    
                    $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
                    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $newfilename = $target_directory . '/' . $_POST['ID'] . '-' . $currentDate . "." . $filetype;
                    if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                        $_POST['imagePath'] = $newfilename;
                        $_POST['record_created_date'] = $currentDate;
                        $operator->insertData($_POST);
                        echo "true";
                    }
                    break;
                }
            case 1: {
                    echo 1;
                    break;
                }
        }
    }
    public function getRecords()
    {
        $operator = new Operator();
        $operator->getAllRecord();
    }
}
$operator = new OperatorController();
if (isset($_GET['getOperator'])) {
    $operator->getRecords();
    exit();
}
if (isset($_POST['operation'])) {
    if ($_POST['operation'] == 'add-operator') {
        $operator->insertRecord();
    }
}
