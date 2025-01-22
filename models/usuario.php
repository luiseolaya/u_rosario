<?php
class Usuario {
    private $conn;
    private $table_name = "usuario";

    public $id;
    public $nombres;
    public $apellidos;
    public $correo;
    public $celular;
    public $clave;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un nuevo usuario
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombres=:nombres, apellidos=:apellidos, correo=:correo, celular=:celular, clave=:clave";
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->nombres = htmlspecialchars(strip_tags($this->nombres));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->celular = htmlspecialchars(strip_tags($this->celular));
        $this->clave = htmlspecialchars(strip_tags($this->clave));

        // Hash de la clave
        $this->clave = password_hash($this->clave, PASSWORD_BCRYPT);

        // Bind de cada valor
        $stmt->bindParam(':nombres', $this->nombres);
        $stmt->bindParam(':apellidos', $this->apellidos);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':celular', $this->celular);
        $stmt->bindParam(':clave', $this->clave);

        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
        }

        return false;
    }

    // Método para validar el inicio de sesión
    public function validar() {
        $query = "SELECT id_usuario, nombres, apellidos, correo, celular, clave FROM " . $this->table_name . " WHERE correo = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->correo);
        $stmt->execute();

        // Obtenemos la fila de la base de datos
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Comparamos la clave ingresada con la clave almacenada en la base de datos
            if (password_verify($this->clave, $row['clave'])) {
                // Si coinciden, establecemos las propiedades del objeto
                $this->id = $row['id_usuario'];
                $this->nombres = $row['nombres'];
                $this->apellidos = $row['apellidos'];
                $this->correo = $row['correo'];
                $this->celular = $row['celular'];
                return true;
            }
        }

        return false;
    }
}
?>