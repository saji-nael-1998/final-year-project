<?php
include_once('../model/User.php');
class Operator extends User
{
    public function insertData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            // set the PDO error mode to exception
            if ($this->isOperator($data['email'], $conn)) {
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
                $sql = "INSERT INTO operator( userID)
                 VALUES ( (select userID from user where email= '$email'))";
                $conn->exec($sql);
                return "1";
            } else {
                //if record already exists
                return "0";
            }
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
                // use exec() because no results are returned
                $conn->exec($sql);
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
    public function isOperator($email, $conn)
    {
        //create connection to database
        //set query
        $query = "select count(*) from `user` u , `operator` o where email ='$email' and o.userID=u.userID";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        //check existence of operator
        if ($users == 0) {
            return false;
        } else {
            //if there is no record
            return true;
        }
    }
}
