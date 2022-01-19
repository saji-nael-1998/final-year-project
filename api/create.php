<?php
//call php
include_once("../config/dp.php");
//create connection to database
$DBConnection=new DBConnection();
$conn= $DBConnection->connect();
//generate query for insertion
function generateInsertQuery($arr, $tableName)
    {
        $col = array();
        $data = array();
        foreach ($arr as $key => $value) {
            $col[] = $key;
            $data[] = "?";
        }
        $query = "INSERT INTO $tableName ( " . implode(" , ", $col) . " ) values( " . implode(" ,", $data) . ") ";
        return $query;
    }
function generateUpdateQuery($tableName,$data,$conditions){
    $newValues = array();
    
    foreach ($data as $key => $value) {
      $newValue=$key."=".$value;
      $newValues[]=$newValue;
    }
    $query = "update $tableName ".implode(",", $newValues);
    return $query;
}
$data=array('hi' => 'Hello','name' => 'World!');;
echo generateUpdateQuery("table",$data,"");
