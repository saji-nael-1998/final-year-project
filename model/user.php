<?php
require_once('../model/connection.php');
abstract class User
{
   
    public abstract function login($email, $password);
    protected abstract function forgetPassword($email);
}

?>