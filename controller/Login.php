<?php

session_start();
require_once('../model/admin.php');
class LoginContoller
{
    public function Login()
    {
        $admin = new admin();

        $permission = $admin->login($_GET['email'], $_GET['password']);
        switch ($permission) {
        //no such user
      case 0: {
          echo 0;
          break;
        }
        //correct user and password
      case 1: {
          $_SESSION['role'] = 'admin';
          $_SESSION['email'] = $_GET['email'];
        echo 1;
        break;
        }
        //wrong password
      case -1: {
          echo -1;
          break;
        }
    }
    }
    public function saveUser()
    {
      
    }
    public function ForgetPassword()
    {
      
    }
}

$login = new LoginContoller();
$login->Login();
?>