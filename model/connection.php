<?php

class DBConnection
{
    private $servername;
    private $username ;
    private $password ;
    private $DB;
    private $conn;
    public function __construct($servername, $username, $password, $DB)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->DB = $DB;
    }
    public function setServerName($servername)
    {
        $this->servername = $servername;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setDB($DB)
    {
        $this->DB = $DB;
    }
    public function createConnection()
    {   //create a connection
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->DB", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;
    }
    public function closeConnection()
    {
        $this->conn=null;
        return $this->conn;
    }
}
 //create connection
 