<?php
class ModeloEvidencia {
    private $conn;
    private $table_name = "evidencia";

    public $id_usuario;
    public $id_parqueadero;
    public $evidencia;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearEvidencia() {
        $query = "INSERT INTO " . $this->table_name . " SET id_usuario=:id_usuario, id_parqueadero=:id_parqueadero, evidencia=:evidencia, fecha_hora=NOW()";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_parqueadero = htmlspecialchars(strip_tags($this->id_parqueadero));
        $this->evidencia = htmlspecialchars(strip_tags($this->evidencia));

        // Bind de cada valor
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_parqueadero', $this->id_parqueadero);
        $stmt->bindParam(':evidencia', $this->evidencia);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
