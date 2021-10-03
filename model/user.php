<?php
require_once('../model/connection.php');
abstract class User
{
    protected $FName;
    protected $MName;
    protected $LName;
    protected $birthdate;
    protected $ID;
    protected $gender;
    protected $email;
    protected $phoneNO;
    protected $password;
    protected $imagePath;
    
    public abstract function login($email, $password);
    protected abstract function forgetPassword($email);
}

?>