<?php
class Entrada {
    private $conn;
    private $table_name = "entrada";

    public $id_entrada;
    public $id_usuario;
    public $id_parqueadero;
    public $fecha_hora;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear una nueva entrada
    public function crearEntrada() {
        $query = "INSERT INTO " . $this->table_name . " SET id_usuario=:id_usuario, id_parqueadero=:id_parqueadero, fecha_hora=NOW()";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_parqueadero = htmlspecialchars(strip_tags($this->id_parqueadero));

        // Bind de cada valor
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_parqueadero', $this->id_parqueadero);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para registrar una salida
    public function crearSalida() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_entrada = :id_entrada";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->id_entrada = htmlspecialchars(strip_tags($this->id_entrada));

        // Bind de cada valor
        $stmt->bindParam(':id_entrada', $this->id_entrada);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
