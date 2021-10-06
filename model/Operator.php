<?php
include_once('../model/User.php');
class Operator extends User
{
    public function insertData($data)
    {
        try {
            $conn=new DBConnection();
            $conn=$conn->connect() ;
          
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
                         ':gender' => $data['gender'],
                        ':email' => $data['email'],
                        ':pass' => $data['pass'],
                        ':phoneNO' => $data['phoneNO'],
                        ':ID' => $data['ID'],
                        ':imagePath' => $data['imagePath'],
                     ]);
                echo 'yes';
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
            $email=$data['email'];
            // set the PDO error mode to exception
            if ($this->isOperator($email, $conn)) {
                // sql to delete a record
                $sql = "DELETE FROM `operator` WHERE userID= (SELECT userID from `user` WHERE email='$email')";
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
    }
    public function isOperator($email, $conn)
    {
        //create connection to database
        //set query
        $query="select count(*) from `user` u , `operator` o where email ='$email' and o.userID=u.userID";
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
}/*$operator=new Operator();

$data =array(

        'FName' => 'saji',
        'MName' => 'nael',
        'LName' => 'zeer',
        'birthDate' => '2021-06-21',
        'gender' => 'm',
       'email' => 'saji@s.com',
       'pass' => 'ssssssssssssss',
       'phoneNO' => 599714454,
       'ID' => 123456789,
       'imagePath' => 'asdsda',

);
$operator->insertData($data);*/