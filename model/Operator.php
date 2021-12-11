<?php

include_once("Model.php");
class Operator extends Model
{
    public function insertRecord($data)
    {
        try {
            $park_id = $data['park_id'];
            unset($data['park_id']);
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception
            //prepare query
            $sql = $this->generateInsertQuery($data, "`user`");
            $statement = $conn->prepare($sql);
            $record = array_values($data);
            $statement->execute($record);
            //execute query
            $user_id = $conn->lastInsertId();
            $sql = "INSERT INTO `operator`( `user_id`, `park_id`) VALUES ( $user_id , $park_id)";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $DBConnection->closeConnection();
            return  $user_id;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function updateRecord($data)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception

            //prepare query
            $sql = "UPDATE `user` set  FName=:FName, MName=:MName,  LName=:LName, birthdate=:birthdate , email=:email, pass=:pass, phoneNO=:phoneNO, ID=:ID where user_id=:user_id";
            $statement = $conn->prepare($sql);
            //execute query
            $statement->execute([
                ':FName' => $data['FName'],
                ':MName' => $data['MName'],
                ':LName' => $data['LName'],
                ':birthdate' => $data['birthdate'],
                ':email' => $data['email'],
                ':pass' => $data['pass'],
                ':phoneNO' => $data['phoneNO'],
                ':ID' => $data['ID'],
                ':user_id' => $data['user_id']
            ]);
            $DBConnection->closeConnection();
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function removeRecord($user_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();



            // sql to delete a record
            $sql = "UPDATE `user`  SET record_status = 'inactive' WHERE user_id = $user_id;";
            echo $sql;
            $stmt = $conn->prepare($sql);
            // use exec() because no results are returned
            $stmt->execute();
            //close connection 
            $DBConnection->closeConnection();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function selectRecord($user_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();


            $sql = $conn->prepare("SELECT * FROM operator o , user u where o.user_id=u.user_id and o.user_id=$user_id");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result[0]);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllRecord()
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();


            $sql = $conn->prepare("SELECT * FROM user u , operator o , park p where u.user_id=o.user_id and p.park_id=o.park_id and u.record_status='active'");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $json_data['data'] = $result;

            return  json_encode($json_data);
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
        return $users[0]['user_id'];
    }
    public function checkID($id, $user_id)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "select count(*) from `user` where user_id=$user_id and id=$id and type='operator'";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        //check existence of operator
        if ($users[0]['count(*)'] == 0) {
            //if there is no record
            //set query
            $query = "select count(*) from `user` where id =$id and record_status='active' and type='operator'";
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
            //it is user's id 
            return 0;
        }
    }
    public function checkEmail($email, $user_id)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "select count(*) from `user` where user_id=$user_id and email='$email' AND type='operator'";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        //check existence of operator
        if ($users[0]['count(*)'] == 0) {
            //if there is no record
            //set query
            $query = "select count(*) from `user` where email ='$email' and record_status='active' type='operator'";
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
            //it is user's email 
            return 0;
        }
    }
    public function uploadImage($user_id, $image_path)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "UPDATE `user`
        SET imagePath = '$image_path'
        WHERE user_id = $user_id;";
        $statement = $conn->query($query);
        //close connection 
        $DBConnection->closeConnection();
        return true;
    }
}
