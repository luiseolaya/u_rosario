<?php
class Entrada {
    private $conn;
    private $table_name = "parqueadero_entrada";

    public $id;
    public $usuario_id;
    public $fecha_entrada;
    public $fecha_salida;
    public $placa_vehiculo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar una nueva entrada
    public function crearEntrada() {
        $query = "INSERT INTO " . $this->table_name . " SET usuario_id=:usuario_id, placa_vehiculo=:placa_vehiculo, fecha_entrada=NOW()";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->usuario_id = htmlspecialchars(strip_tags($this->usuario_id));
        $this->placa_vehiculo = htmlspecialchars(strip_tags($this->placa_vehiculo));

        // Bind de cada valor
        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':placa_vehiculo', $this->placa_vehiculo);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para registrar una nueva salida
    public function crearSalida() {
        $query = "UPDATE " . $this->table_name . " SET fecha_salida=NOW() WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind del valor
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
