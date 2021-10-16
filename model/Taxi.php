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
    private string $TAXI_TABLE = 'taxi_table';

    public function insertData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();

            $sql = "INSERT INTO {$this->TAXI_TABLE}( taxi_id, model, `year`, capacity, end_date, image_path)
                 VALUES ( :taxi_id, :model,  :year, :capacity, :end_date, :image_path)";
            $statement = $conn->prepare($sql);
            $statement->execute([
                ':taxi_id' => $data['taxi_id'],
                ':model' => $data['model'],
                ':year' => $data['year'],
                ':capacity' => $data['capacity'],
                ':end_date' => $data['end_date'],
                ':image_path' => $data['image_path'],
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

            $sql = "UPDATE {$this->TAXI_TABLE} SET  model =  :model, `year` =  :year, capacity = :capacity, end_date = :end_date , image_path = :image_path WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $statement->execute([
                ':taxi_id' => $data['taxi_id'],
                ':model' => $data['model'],
                ':year' => $data['year'],
                ':capacity' => $data['capacity'],
                ':end_date' => $data['end_date'],
                ':image_path' => $data['image_path']
            ]);
            return 1;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function removeData($data)
    {
    }

    public function selectData($query)
    {
    }

    public function isUsedId($taxi_id)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $sql = "SELECT * FROM {$this->TAXI_TABLE} WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $statement->execute([':taxi_id' => $taxi_id]);
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

    public function deleteTaxi($taxi_id)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();
            $sql = "DELETE FROM {$this->TAXI_TABLE} WHERE taxi_id = :taxi_id";
            $statement = $conn->prepare($sql);
            $statement->execute([':taxi_id' => $taxi_id]);

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
}