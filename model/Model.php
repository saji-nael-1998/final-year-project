<?php
require_once('../config/dp.php');
abstract class Model
{
    abstract protected function insertRecord($data);
    abstract protected function updateRecord($data);
    abstract protected function removeRecord($data);
    abstract protected function selectRecord($query);
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
    function generateUpdateQuery($tableName,$data){
        $newValues = array();
        
        foreach ($data as $key => $value) {
          $newValue=$key."=".$value;
          $newValues[]=$newValue;
        }
        $query = "update $tableName ".implode(",", $newValues);
        return $query;
    }
}
