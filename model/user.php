<?php

require_once('../config/dp.php');
require_once('Model.php');

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
