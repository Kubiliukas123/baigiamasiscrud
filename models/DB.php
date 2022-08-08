<?php
class DB{
    public $conn;

    public function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $db = "crud_plants";
        $this->conn = new mysqli($host, $username, $password, $db);
    }
}
?>