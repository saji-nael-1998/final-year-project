<?php
include('../model/Operator.php');
class OperatorController
{
    public function insertRecord()
    {


        $operator = new Operator();
        if (!$operator->isOperator($_POST['email'])) {
            //move file to upload file
            $target_directory = "../upload/operator";
            if (!file_exists($target_directory)) {
                mkdir($target_directory);
            }
            $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
            $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newfilename = $target_directory . '/' . $_POST['ID'] . "." . $filetype;
            if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
                $_POST['imagePath'] = $newfilename;
                $operator->insertData($_POST);
                echo "true";
            }
        } else {
            echo "false";
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
