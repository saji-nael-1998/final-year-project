<?php

class Operator extends User
{
    public function insertData($data)
    {
        $DBConnection=new DBConnection();
        $conn=$DBConnection->connect();
        
    }
    public function updateData($data)
    {
    }
    public function removeData($data)
    {
    }
   
    public function selectData($query)
    {
    }
}
?>