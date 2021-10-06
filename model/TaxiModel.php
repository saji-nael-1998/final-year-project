<?php

include_once('Model.php');

class TaxiModel extends Model
{
    private string $TAXI_TABLE = 'taxi';

    public function insertData($data)
    {
        try {
            $conn = new DBConnection();
            $conn = $conn->connect();

            // set the PDO error mode to exception
            //prepare query
            $sql = "INSERT INTO {$this->TAXI_TABLE}( taxi_id, model, year, driver_name, start_date, end_date, road)
                 VALUES ( :taxi_id, :model,  :LName, :year, :driver_name, :start_date, :end_date, :road)";
            $statement = $conn->prepare($sql);
            //execute query
            $statement->execute([
                                    ':taxi_id' => $data['taxi_id'],
                                    ':model' => $data['model'],
                                    ':year' => $data['year'],
                                    ':driver_name' => $data['driver_name'],
                                    ':start_date' => $data['start_date'],
                                    ':end_date' => $data['end_date'],
                                    ':road' => $data['road']
                                ]);
            echo 'Taxi Added Successfully';
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function updateData($data)
    {
    }

    public function removeData($data)
    {
    }

    public function selectData($query)
    {
    }
}