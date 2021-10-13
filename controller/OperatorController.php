<?php
include('../model/Operator.php');
class OperatorController
{
    public function insertRecord()
    {
        $_POST['imagePath'] = $_FILES['imagePath']['name'];
        //move file to upload file
        $target_directory = "../upload/";
        $target_file = $target_directory . basename($_FILES["imagePath"]["name"]);   //name is to get the file name of uploaded file
        $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newfilename = $target_directory . $_POST['ID'] . "." . $filetype;
        if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $newfilename)) {
            $operator = new Operator();
            printf($operator->insertData($_POST));
        } else {
            echo "13";
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
}
if (isset($_POST)) {

    //$operator->insertRecord();
}
