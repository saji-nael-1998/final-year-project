<?php
include_once('../model/Model.php');
include_once('../config/dp.php');
abstract class User extends Model
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
}

?>