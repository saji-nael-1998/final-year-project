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
                $sql = 'INSERT INTO user( FName, MName, LName, birthDate, email, pass, phoneNO, ID, `licence`,licenceexpirydate)
                 VALUES ( :FName, :MName,  :LName, :birthDate, :email, :pass, :phoneNO, :ID, :licence , :licenceexpirydate)';
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
                        ':licence' => $data['licence'],
                        ':licenceexpirydate' => $data['licenceexpirydate']
                     ]);
                echo 'Driver Added Successfully';
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
          
            // set the PDO error mode to exception
            if ($this->isDriver($data['email'], $conn)) {
                //prepare query
                $sql = 'DELETE FROM user where ID = $ID'
                $statement = $conn->prepare($sql);
                //execute query
                $statement->execute($sql);
                   
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
        {
            try {
                $conn=new DBConnection();
                $conn=$conn->connect() ;
              
                // set the PDO error mode to exception
                if ($this->isDriver($data['email'], $conn)) {
                    //prepare query
                    $sql = 'select FROM user where ID = $ID'
                    $statement = $conn->prepare($sql);
                    //execute query
                    $statement->execute($sql);
                       
                    echo 'Driver selected Successfully';
                } else {
                    //if record already exists
                    return 0;
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
    }
    public function isDriver($email, $conn)
    {
        //create connection to database
        //set query
        $query="select count(*) from `user` u , `driver` d where email ='$email' and d.userID=u.userID";
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