<?php
require_once(__DIR__ . '\\..\\config\\dp.php');
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
}
