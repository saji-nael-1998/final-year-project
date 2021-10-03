<?php
require_once('../model/user.php');
class Admin extends User{
     function login($email, $password)
     
    {   //create connection to database
         $DBConnection=new DBConnection('localhost', 'saji', 'Lewandowski9@', 'final_year_project');
        $conn= $DBConnection->createConnection();
        //set query 
        $query="select * from user where email ='$email' and type='admin'";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if ($users) {
            //check password
            if ($users[0]['password']==$password) {
                return 1;
            } else {
                return -1;
            }
        } else {
            //if there is no record 
            return 0;
        }
        
        //closs connection 
        $DBConnection->closeConnection();

    }
    function forgetPassword($email){
        
    }
    public function addOperator($data)
    {
        
    }
}
?>