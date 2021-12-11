<?php

include_once('Model.php');


/*
 * CREATE TABLE `taxi_table` (
  `taxi_id` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `capacity` int(11) NOT NULL,
  `image_path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `taxi_table`
--
ALTER TABLE `taxi_table`
  ADD PRIMARY KEY (`taxi_id`);

 */

class Taxi extends Model
{
    public function insertRecord($data)
    {
        try {

            //connect to db
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            // set the PDO error mode to exception
            //prepare query
            $sql = $this->generateInsertQuery($data, "`taxi`");
            $statement = $conn->prepare($sql);
            $record = array_values($data);
            $statement->execute($record);

            $DBConnection->closeConnection();
            return 1;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return 0;
    }

    public function updateRecord($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();

            $sql = "UPDATE taxi SET brand = :brand, `car_year` =  :car_year, capacity = :capacity, reqistration_date = :reqistration_date"
                . ($data['license_photo'] ? ", license_photo = :license_photo" : " ") . " WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $arguments = [
                ':taxi_id' => $data['taxi_id'],
                ':brand' => $data['brand'],
                ':car_year' => $data['car_year'],
                ':capacity' => $data['capacity'],
                ':reqistration_date' => $data['reqistration_date'],
            ];
            if ($data['license_photo']) {
                $arguments[':license_photo'] = $data['license_photo'];
            }
            $statement->execute($arguments);
            return 1;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function removeRecord($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $sql = "UPDATE taxi SET record_status='no_active' WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $statement->execute([':taxi_id' => $data]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die;
            return 0;
        }
    }
    public function selectRecord($query)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $sql = "SELECT * FROM {$this->TAXI_TABLE} WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $statement->execute([':taxi_id' => $query]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return 0;
        }
    }
    public function getRecords()
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();


            $sql = $conn->prepare("SELECT * FROM `taxi` t , `route` r , `park` p where t.route_id=r.route_id and r.park_id=p.park_id and t.record_status='active'");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $json_data['data'] = $result;

            return  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function getAvailableTaxi()
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();


            $sql = $conn->prepare("SELECT
            *
        FROM
            taxi t,
            route r,
            park p
        WHERE NOT
            EXISTS(
            SELECT
                *
            FROM
                driver d
            WHERE
                d.taxi_id = t.taxi_id
        ) AND 
        t.record_status = 'active'
         and 
         p.park_id = r.park_id
        AND 
        r.route_id = t.route_id");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $json_data['data'] = $result;

            return  json_encode($json_data);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
