<?php

abstract class BaseController
{
    public function render($file)
    {
        include '../' . $file . '.php';
    }
}
