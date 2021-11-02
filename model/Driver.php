<?php
include_once('../model/User.php');
class Driver extends User
{
    public function insertData($data)
    {
        try {
            $conn=new DBConnection();
            $conn=$conn->connect() ;
          
            // set the PDO error mode to exception
            if ($this->isDriver($data['email'], $conn)) {
                //prepare query
                $sql = 'INSERT INTO user( FName, MName, LName, birthDate, email, pass, phoneNO, ID, licenceExpiryDate)
                 VALUES ( :FName, :MName,  :LName, :birthDate, :email, :pass, :phoneNO, :ID,  :licenceExpiryDate)';
                $statement = $conn->prepare($sql);
                //execute query
                $statement->execute([
                         ':FName' => $data['FName'],
                         ':MName' => $data['MName'],
                         ':LName' => $data['LName'],
                         ':birthDate' => $data['birthDate'],
                        ':email' => $data['email'],
                        ':pass' => $data['pass'],
                        ':phoneNO' => $data['phoneNO'],
                        ':ID' => $data['ID'],
                        ':licenceExpiryDate' => $data['licenceExpiryDate']
                     ]);
                echo 'Driver Added Successfully';
                $email = $data['email'];
                $sql = "INSERT INTO driver( user_id)
                 VALUES ( (select user_id from user where email= '$email'))";
                $conn->exec($sql);
                return "1";
            } else {
                //if record already exists
                return 0;
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
            $conn=new DBConnection();
            $conn=$conn->connect() ;
            $email = $data['email'];
            // set the PDO error mode to exception
            if ($this->isDriver($email, $conn)) {
                //prepare query
                $sql = "DELETE FROM driver where user_id = (SELECT user_id from `user` WHERE email='$email')";
                // use exec() because no results are returned
                $conn->exec($sql);
                
                   
                echo 'Driver removed Successfully';
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


            $sql = $conn->prepare("SELECT * FROM driver d , user u where d.user_id=u.user_id");
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

            $sql = $conn->prepare("SELECT * FROM driver d, user u where d.user_id=u.user_id");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            if ($result ) {
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

    public function isDriver($email, $conn)
    {
        //create connection to database
        //set query
        $query="select count(*) from `user` u , `driver` d where email ='$email' and d.user_id=u.user_id";
        $statement = $conn->query($query);
        // get all data
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        //check existence of driver
        if ($users == 0) {
            return false;
        } else {
            //if there is no record
            return true;
        }
    }
}
?>