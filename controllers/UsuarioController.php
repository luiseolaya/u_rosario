<?php
session_start();
include_once '/xampp/htdocs/U_cicloparqueadero/config/DB_cicloparqueadero.php';
include_once '/xampp/htdocs/U_cicloparqueadero/models/usuario.php';

class UsuarioController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function registrar() {
        if (!empty($_POST)) {
            $this->usuario->nombres = $_POST['nombres'] ?? '';
            $this->usuario->apellidos = $_POST['apellidos'] ?? '';
            $this->usuario->correo = $_POST['correo'] ?? '';
            $this->usuario->celular = $_POST['celular'] ?? '';
            $this->usuario->clave = $_POST['clave'] ?? '';

            if ($this->usuario->crear()) {
                $_SESSION['mensaje'] = 'Usuario registrado con éxito';
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                $_SESSION['mensaje'] = 'Error al registrar el usuario';
                header("Location: ../views/error.php");
                exit;
            }
        }
    }

    public function iniciar() {
        if (!empty($_POST)) {
            $this->usuario->correo = $_POST['correo'] ?? '';
            $this->usuario->clave = $_POST['clave'] ?? '';

            if ($this->usuario->validar()) {
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                header("Location: ../views/error.php");
                exit;
            }
        }
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