<?php

class Database {
    public $hostname;
    public $database;
    public $username;
    public $password;
    public $conn;
        public function getConnection() {

        include_once 'conexionarranque.php';
        $conexion = new conexion();
        $this->conn = $conexion->conn;
        $this->hostname = $conexion->hostname;
        $this->database =  $conexion->database;
        $this->username = $conexion->username;
        $this->password = $conexion->password;
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>
