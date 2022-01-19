<?php
require_once(__DIR__ . "\\..\\config\\dp.php");
class Trip
{
    

    function getCountOfTrip($park_id,$date)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();

            $sql = $conn->prepare("SELECT
            count(*)
        FROM
            `park` p,
            `taxi` t,
            `route` r,
            `trip` tr
        WHERE
            tr.taxi_id=t.taxi_id and p.park_id = r.park_id AND r.route_id = t.route_id AND p.park_id = $park_id  and tr.trip_date='$date'; ");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
           
            //close connection 
            $DBConnection->closeConnection();
            return $result[0]['count(*)'];
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function getDriverTrip($driver_id,$date)
    {
        try {
            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();

            $sql = $conn->prepare("SELECT
            *
            FROM
            `driver` d,
         
            `taxi` t,
            `trip` tr
            WHERE
            tr.taxi_id=t.taxi_id   and tr.trip_date='$date' and d.driver_id=$driver_id; ");
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
