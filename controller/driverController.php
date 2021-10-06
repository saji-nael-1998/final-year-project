<?php
abstract class driverController
{
    public function render($file)
    {
        include '../' . $file .'.php';
    }
}
?>