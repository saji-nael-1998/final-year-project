<?php
include('../model/Operator.php');
class OperatorController
{
    public function insertRecord()
    {
        $_POST['imagePath'] = $_FILES['imagePath']['name'];
        $operator = new Operator();

        if ($operator->insertData($_POST)) {
              //move file to upload file
        $target_directory = "../upload/operator";
        $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
        $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newfilename = $target_directory . $_POST['ID'] . "." . $filetype;
        if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
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
