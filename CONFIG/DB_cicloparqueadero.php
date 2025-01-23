<?php
class Database {
    private $host = "localhost";
    private $db_name = "db_cicloparqueadero";
    private $username = "root"; // Cambia estos valores según tu configuración
    private $password = ""; // Cambia estos valores según tu configuración
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
