<?php
include_once('../model/User.php');
class Operator extends User
{
    public function insertData($data)
    {
        try {
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception

            //prepare query
            $sql = 'INSERT INTO user( FName, MName, LName, birthDate, gender, email, pass, phoneNO, ID, `imagePath`)
                 VALUES ( :FName, :MName,  :LName, :birthDate, :gender, :email, :pass, :phoneNO, :ID, :imagePath)';
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
    public function removeData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $email = $data['email'];
            // set the PDO error mode to exception
            if ($this->isOperator($email, $conn)) {
                // sql to delete a record
                $sql = "DELETE FROM `operator` WHERE userID = (SELECT userID from `user` WHERE email='$email')";
                $statement = $conn->prepare($sql);
                // use exec() because no results are returned
                $statement->execute($sql);
            } else {
                //if record already exists
                return 0;
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function selectData($query)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();


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

            $conn = new DBConnection();
            $conn = $conn->connect();
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
    public function isOperator($email)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "select count(*) from `user`  where email ='$email' ";
        $statement = $conn->query($query);

        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
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
