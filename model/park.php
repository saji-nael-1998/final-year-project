<?php
$parts = explode("\\", __DIR__);
$path = "";
foreach ($parts as $part) {
    $path .= $part . "\\";
    if ($part == "final_year_project") {
        break;
    }
}
str_replace("\\", "/", $path);
include($path . "config/dp.php");
class Park
{
    function insertRecord($data)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception

            //prepare query
            $sql = 'INSERT INTO `park`(park_name,park_location)
                 VALUES ( :park_name,:park_location)';
            $statement = $conn->prepare($sql);
            //execute query
            $statement->execute([
                ':park_name' => $data['park_name'],
                ':park_location' => $data['street'] . ", " . $data['city']
            ]);
            if (isset($data['routes'])) {
                $parkname = $data['park_name'];
                $sql = $conn->prepare("SELECT park_id from `park` where park_name='$parkname'");
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                $park_id = $result[0]['park_id'];
                $this->insertRouteRecord($data['routes'], $park_id, $conn);
            }

            $DBConnection->closeConnection();
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function insertRouteRecord($routes, $park_id, $conn)
    {
        // JSON string
        $someJSON = $routes;
        // Convert JSON string to Array
        $someArray = json_decode($someJSON, true);

        foreach ($someArray as $value) {
            $sql = 'INSERT INTO `route`(park_id,src,dest)
            VALUES ( :park_id,:src,:dest)';
            $statement = $conn->prepare($sql);
            //execute query
            $statement->execute([
                ':park_id' => $park_id,
                ':src' => $value['src'],
                ':dest' => $value['dest']
            ]);
        }
    }
    public function removeRecord($park_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();


            // sql to delete a record
            $sql = "UPDATE `park`  SET record_status = 'inactive' WHERE park_id = $park_id;";
            $stmt = $conn->prepare($sql);
            // use exec() because no results are returned
            $stmt->execute();
            //close connection 
            $DBConnection->closeConnection();
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


            $sql = $conn->prepare("SELECT * FROM `park` where record_status='active'");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);


            $json_data['data'] = $result;

            return  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllOperator($park_id)
    {
        try {

            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();


            $sql = $conn->prepare("SELECT u.* FROM `park` p , `operator` o , `user` u 
            where u.record_status='active' AND o.user_id=u.user_id AND p.park_id=o.park_id AND p.park_id=5");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);


            $json_data['data'] = $result;

            echo  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllRoute($park_id)
    {
        try {

            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();


            $sql = $conn->prepare("SELECT r.* from `park` p , `route` r where p.park_id=r.park_id and p.park_id=5");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);


            $json_data['data'] = $result;

            echo  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
