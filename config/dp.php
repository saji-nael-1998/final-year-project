<?php

class DBConnection
{
    private $conn;
    public function connect()
    {
        
        include("config.php");

        try {
            //create a connection
            $this->conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function closeConnection()
    {
        $this->conn = null;
        return $this->conn;
    }
}
