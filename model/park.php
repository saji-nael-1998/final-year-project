<?php
include_once("Model.php");
include_once("route.php");
class Park extends Model
{ //connect to db
    private $DBConnection;
    private $conn;
    function __construct()
    {
        $this->DBConnection = new DBConnection();
        $this->conn = $this->DBConnection->connect();
    }
    function insertRecord($data)
    {

        try {
            // set the PDO error mode to exception
            //prepare query
            $sql = $this->generateInsertQuery($data, "`park`");
            $statement = $this->conn->prepare($sql);
            $record = array_values($data);
            $statement->execute($record);
            //execute query
            $park_id = $this->conn->lastInsertId();
            $this->DBConnection->closeConnection();
            return   $park_id;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function removeRecord($park_id)
    {
        try {
            // sql to delete a record
            $sql = "UPDATE `park`  SET record_status = 'inactive' WHERE park_id = $park_id;";
            $stmt = $this->conn->prepare($sql);
            // use exec() because no results are returned
            $stmt->execute();
            //close connection 
            $this->DBConnection->closeConnection();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllRecord()
    {
        try {
            $sql = $this->conn->prepare("SELECT * FROM `park` where record_status='active'");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $json_data['data'] = $result;
            return json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function selectRecord($park_id)
    {
        try {
            $sql = $this->conn->prepare("SELECT * FROM `park` where park_id=$park_id");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            return  json_encode($result[0]);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function updateRecord($data)
    {
        try {
            // set the PDO error mode to exception
            //prepare query
            $parkName = $data['park_name'];
            $street = $data['street'];
            $park_id = $data['park_id'];
            $sql = "UPDATE `park` SET park_name='$parkName' , street= '$street' where park_id=$park_id";
            $statement = $this->conn->prepare($sql);
            if ($statement->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function addRoute($route)
    {
        try {
            $routeModel = new Route();
            $routeModel->insertRecord($route);
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function deleteRoute($route_id)
    {
        try {
           
            $sql = "UPDATE `route` SET record_status='inactive'  where route_id=$route_id";
            $statement = $this->conn->prepare($sql);
            if ($statement->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllRoutes($park_id)
    {
        try {
            $sql = $this->conn->prepare("SELECT r.src,r.dest,r.route_id FROM `route` r , `park` p  where p.park_id=r.park_id and p.park_id=$park_id and r.record_status='active'");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return  json_encode($result);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function getParkOperators($park_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();

            $sql = $conn->prepare("SELECT *
            from 
            `operator` o,
            `user` u,
            `park` p
            WHERE o.user_id=u.user_id and u.record_status='active' and o.park_id=p.park_id and p.park_id=$park_id");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $json_data['data'] = $result;
            //close connection 
            $DBConnection->closeConnection();
            return  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function getParkRoute($park_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            $sql = $conn->prepare("SELECT *
            from 
           `route` r,
           `park` p
            WHERE r.park_id=p.park_id and r.record_status='active'  and p.park_id=$park_id");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $json_data['data'] = $result;
            //close connection 
            $DBConnection->closeConnection();
            return  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getParkCount()
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            $sql = $conn->prepare("SELECT COUNT(p.park_id) as size  FROM `park` p where p.record_status='active'");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result[0]);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
