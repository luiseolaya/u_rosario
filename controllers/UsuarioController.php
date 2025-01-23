<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../config/DB_cicloparqueadero.php';
include_once __DIR__ . '/../models/usuario.php';
include_once __DIR__ . '/../models/entrada.php';

class UsuarioController {
    private $db;
    private $usuario;
    private $entrada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
        $this->entrada = new Entrada($this->db);
    }

    public function registrar() {
        if (!empty($_POST)) {
            $this->usuario->nombres = $_POST['nombres'] ?? '';
            $this->usuario->apellidos = $_POST['apellidos'] ?? '';
            $this->usuario->correo = $_POST['correo'] ?? '';
            $this->usuario->celular = $_POST['celular'] ?? '';
            $this->usuario->clave = $_POST['clave'] ?? '';

            if ($this->usuario->crear()) {
                $_SESSION['correo'] = $this->usuario->correo;  // Establecer la sesión
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                $_SESSION['error'] = 'El correo electrónico ya está registrado.';
                header("Location: ../views/registro.php");
                exit;
            }
        }
    }

    public function iniciar() {
        if (!empty($_POST)) {
            $this->usuario->correo = $_POST['correo'] ?? '';
            $this->usuario->clave = $_POST['clave'] ?? '';

            if ($this->usuario->validar()) {
                $_SESSION['correo'] = $this->usuario->correo;  // Establecer la sesión
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                header("Location: ../views/error.php");
                exit;
            }
        }
    }

    public function mostrarUsuarioYEntradas() {
        if (!isset($_SESSION['correo'])) {
            header("Location: ../views/inicio_seccion.php");
            exit;
        }

        // Obtener la información del usuario
        $query = "SELECT id_usuario, nombres, apellidos, correo FROM usuarios WHERE correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':correo', $_SESSION['correo']);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Obtener las entradas del usuario
        $queryEntradas = "SELECT * FROM entrada WHERE id_usuario = :id_usuario";
        $stmtEntradas = $this->db->prepare($queryEntradas);
        $stmtEntradas->bindParam(':id_usuario', $usuario['id_usuario']);
        $stmtEntradas->execute();
        $entradas = $stmtEntradas->fetchAll(PDO::FETCH_ASSOC);

        return ['usuario' => $usuario, 'entradas' => $entradas];
    }
}

if (isset($_POST['registrar'])) {
    $usuarioController = new UsuarioController();
    $usuarioController->registrar();
}

if (isset($_POST['iniciar'])) {
    $usuarioController = new UsuarioController();
    $usuarioController->iniciar();
}
?>
