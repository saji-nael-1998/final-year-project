<?php
include_once("Model.php");
class Route extends Model
{
    function insertRecord($data)
    {

        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception
            //prepare query

            $sql = $this->generateInsertQuery($data, "`route`");

            $statement = $conn->prepare($sql);
            $record = array_values($data);
            $statement->execute($record);
            $DBConnection->closeConnection();
            return true;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
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

    function updateRecord($data)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception
            //prepare query
            $dest = $data['dest'];

            $route_id = $data['route_id'];
            $sql = "UPDATE `route` SET dest='$dest'  where route_id=$route_id";
            $statement = $conn->prepare($sql);
            if ($statement->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function selectRecord($park_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();

            $sql = $conn->prepare("SELECT * 
            FROM `route` 
            where 
            park_id=$park_id
            and
            record_status='active'");
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
    function getDrivers($park_id)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();

            $sql = $conn->prepare("SELECT
            *
            FROM
            `user` u,
            `driver` d,
            `taxi` t,
            `route` r,
            `park` p
            WHERE
            u.user_id = d.user_id AND u.record_status = 'active' AND d.taxi_id = t.taxi_id AND t.record_status = 'active' AND t.route_id = r.route_id 
            AND r.record_status = 'active' AND p.park_id = r.park_id AND p.park_id=$park_id AND p.record_status = 'active' GROUP BY r.dest ");
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
}
