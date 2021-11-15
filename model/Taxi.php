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
    private string $TAXI_TABLE = 'taxi';

    public function insertData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();

            $sql = "INSERT INTO {$this->TAXI_TABLE}( plate_no, brand, car_year, capacity, reqistration_date)
                 VALUES ( :plate_no, :brand,  :car_year, :capacity, :reqistration_date)";
            $statement = $conn->prepare($sql);
            $statement->execute([
                ':plate_no' => $data['plate_no'],
                ':brand' => $data['brand'],
                ':car_year' => $data['car_year'],
                ':capacity' => $data['capacity'],
                ':reqistration_date' => $data['reqistration_date']

            ]);
            return 1;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return 0;
    }

    public function updateData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();

            $sql = "UPDATE {$this->TAXI_TABLE} SET model = :model, `year` =  :year, capacity = :capacity, end_date = :end_date "
                . ($data['image_path'] ? ", image_path = :image_path" : " ") . " WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $arguments = [
                ':taxi_id' => $data['taxi_id'],
                ':model' => $data['model'],
                ':year' => $data['year'],
                ':capacity' => $data['capacity'],
                ':end_date' => $data['end_date'],
            ];
            if ($data['image_path']) {
                $arguments[':image_path'] = $data['image_path'];
            }
            $statement->execute($arguments);
            return 1;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function removeData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $sql = "DELETE FROM {$this->TAXI_TABLE} WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $statement->execute([':taxi_id' => $data]);
        } catch (PDOException $e) {
            return 0;
        }
    }
    public function selectData($data)
    {
    }
    public function checkPlateNO($plate_no)
    {
        try {
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            //create connection to database
            //set query
            $query = "select count(*) from taxi where plate_no=$plate_no and record_status='active'";
            $statement = $conn->query($query);
            // get all data
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $DBConnection->closeConnection();
            //check existence of operator
            if ($result[0]['count(*)'] == 0) {
                return 0;
            } else {

                return 1;
            }
        } catch (PDOException $e) {
            return 0;
        }
    }
    public function getTaxiID($plate_no)
    {
        try {
            $DBConnection = new DBConnection();
            $conn = $DBConnection->connect();
            //create connection to database
            //set query
            $query = "select taxi_id from taxi where plate_no=$plate_no and record_status='active'";
            $statement = $conn->query($query);
            // get all data
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $DBConnection->closeConnection();
            //check existence of operator
            return $result[0]['taxi_id'];
        } catch (PDOException $e) {
            return 0;
        }
    }
    public function getAllRecord()
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $result_array = array();

            $sql = $conn->prepare("SELECT * FROM {$this->TAXI_TABLE}");
            $sql->execute();

            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
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
    public function uploadImage($taxi_id, $license_photo)
    {
        $DBConnection = new DBConnection();
        $conn = $DBConnection->connect();
        //create connection to database
        //set query
        $query = "UPDATE `taxi`
        SET license_photo = '$license_photo'
        WHERE taxi_id = $taxi_id;";
        $statement = $conn->query($query);
        //close connection 
        $DBConnection->closeConnection();
        return true;
    }
}
