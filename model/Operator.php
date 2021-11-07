<?php
include_once('../model/User.php');
class Operator extends User
{
    public function insertData($data)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception

            //prepare query
            $sql = 'INSERT INTO user( FName, MName, LName, birthDate, gender, email, pass, phoneNO, ID, `imagePath`,record_created_date)
                 VALUES ( :FName, :MName,  :LName, :birthDate, :gender, :email, :pass, :phoneNO, :ID, :imagePath,:record_created_date)';
            $statement = $conn->prepare($sql);
            //execute query
            $statement->execute([
                ':FName' => $data['FName'],
                ':MName' => $data['MName'],
                ':LName' => $data['LName'],
                ':birthDate' => $data['birthDate'],
                ':gender' => 'm',
                ':email' => $data['email'],
                ':pass' => $data['pass'],
                ':phoneNO' => $data['phoneNO'],
                ':ID' => $data['ID'],
                ':imagePath' => $data['imagePath'],
                ':record_created_date' => $data['record_created_date']
            ]);
            $email = $data['email'];
            $sql = "INSERT INTO operator(user_id)
                 VALUES ( (select user_id from user where email= '$email'))";
            $conn->exec($sql);
            $DBConnection->closeConnection();
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function updateData($data)
    {
    }
    public function removeData($user_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();

            // set the PDO error mode to exception

            // sql to delete a record
            $sql = "UPDATE `operator` SET record_status=`inactive` where user_id=$user_id";
            $statement = $conn->prepare($sql);
            // use exec() because no results are returned
            $statement->execute($sql);
            //close connection 
            $DBConnection->closeConnection();
            return 1;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function selectData($query)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();


            $sql = $conn->prepare("SELECT * FROM operator o , user u where o.userID=u.userID");
            $sql->execute();


            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllRecord()
    {
        try {

            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            $result_array = array();

            $sql = $conn->prepare("SELECT * FROM operator o , user u where o.userID=u.userID");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                foreach ($result as $row) {
                    array_push($result_array, $row);
                }
            }
            /* send a JSON encded array to client */

            echo json_encode($result_array);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function isOperator($ID, $email)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "select count(*) from `user` u , `operator` o  where u.ID =$ID and  u.user_id=o.user_id and u.record_status='active'";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        //check existence of operator
        if ($users[0]['count(*)'] == 0) {
            //if there is no record
            //set query
            $query = "select count(*) from `user` u , `operator` o  where u.email ='$email' and  u.user_id=o.user_id and u.record_status='active'";
            $statement = $conn->query($query);
            // get all data
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($users[0]['count(*)'] == 0) {
                //close connection 
                $DBConnection->closeConnection();
                return 0;
            } else {
                //close connection 
                $DBConnection->closeConnection();
                return -1;
            }
        } else {
            //close connection 
            $DBConnection->closeConnection();
            //if record already exists
            return 1;
        }
    }
    public function getOperatorID($ID)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "select u.user_id from `user` u , `operator` o  where u.ID =$ID and  u.user_id=o.user_id and u.record_status='active'";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        //close connection 
        $DBConnection->closeConnection();
        //check existence of operator
        if ($users[0]['count(*)'] == 0) {
            //if there is no record
            return false;
        } else {
            //if record already exists
            return true;
        }
    }
}
