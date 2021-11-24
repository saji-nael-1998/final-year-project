<?php

class DBConnection
{
    private $conn;
    public function connect()
    {
        $parts = explode("\\", __DIR__);
        $path = "";
        foreach ($parts as $part) {
            $path .= $part . "\\";
            if ($part == "final_year_project") {
                break;
            }
        }
        str_replace("\\", "/", $path);
        include($path . "config/config.php");

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
