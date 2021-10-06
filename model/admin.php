<?php
class Admin
{
    public function login($email, $password)
    {   //create connection to database
        $DBConnection=new DBConnection();
        $conn= $DBConnection->connect();
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
    public function forgetPassword($email)
    {
    }
    public function addOperator($data)
    {
        $operator=new Operator();
        $operator->insertData($data);
    
    }
}
?>