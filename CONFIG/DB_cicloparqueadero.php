<?php

class Database {
    private $host = "localhost";
    private $db_name = "db_cicloparqueadero";
    private $username = "root";
    private $password = "";
    public $conn;

    // Método para establecer la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            // Configuración de la conexión usando PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            // Establecer el modo de error de PDO a excepción
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            // Captura el error y muestra un mensaje adecuado
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
