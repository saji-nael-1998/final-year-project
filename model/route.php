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
            $sql = "INSERT INTO `route`(`park_id`, `src`, `dest`) VALUES (?,?,?)";
            $statement = $conn->prepare($sql);

            $record = array_values($data);
            print_r($record);
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
}
