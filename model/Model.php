<?php
abstract class Model
{
    abstract protected function insertData($data);
    abstract protected function updateData($data);
    abstract protected function removeData($data);
    abstract protected function selectData($query);
}
?>