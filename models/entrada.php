<?php
class Entrada {
    private $conn;
    private $table_name = "entrada";

    public $id_entrada;
    public $id_usuario;
    public $id_parqueadero;
    public $codigo;
    public $color;
    public $fecha_hora;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearEntrada() {
        $query = "INSERT INTO " . $this->table_name . " SET id_usuario=:id_usuario, id_parqueadero=:id_parqueadero, codigo=:codigo, color=:color, fecha_hora=NOW()";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_parqueadero = htmlspecialchars(strip_tags($this->id_parqueadero));
        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->color = htmlspecialchars(strip_tags($this->color));

        // Bind de cada valor
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_parqueadero', $this->id_parqueadero);
        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':color', $this->color);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
