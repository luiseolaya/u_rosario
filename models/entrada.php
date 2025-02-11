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

    public function crearEntrada() {
        $query = "INSERT INTO " . $this->table_name . " SET id_usuario=:id_usuario, id_parqueadero=:id_parqueadero, fecha_hora=:fecha_hora";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->id_parqueadero = htmlspecialchars(strip_tags($this->id_parqueadero));
        $this->fecha_hora = htmlspecialchars(strip_tags($this->fecha_hora));

        // Bind de cada valor
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->bindParam(':id_parqueadero', $this->id_parqueadero);
        $stmt->bindParam(':fecha_hora', $this->fecha_hora);

        // Depuración: Verificar valores antes de ejecutar
        error_log("ID Usuario (crearEntrada): " . $this->id_usuario);
        error_log("ID Parqueadero (crearEntrada): " . $this->id_parqueadero);
        error_log("Fecha y Hora (crearEntrada): " . $this->fecha_hora);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}