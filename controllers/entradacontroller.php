<?php
require_once('../config/DB_cicloparqueadero.php');
require_once('../models/entrada.php');

class EntradaController {
    private $db;
    private $entrada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->entrada = new Entrada($this->db);
    }

    // Método para registrar una entrada
    public function registrarEntrada() {
        if (!empty($_POST)) {
            $this->entrada->id_usuario = $_POST['id_usuario'] ?? '';
            $this->entrada->id_parqueadero = $_POST['id_parqueadero'] ?? '';

            if ($this->entrada->crearEntrada()) {
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                header("Location: ../views/error.php");
                exit;
            }
        }
    }

    // Método para registrar una salida
    public function registrarSalida() {
        if (!empty($_POST)) {
            $this->entrada->id_entrada = $_POST['id_entrada'] ?? '';

            if ($this->entrada->crearSalida()) {
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                header("Location: ../views/error.php");
                exit;
            }
        }
    }
}

// Verificar si se ha enviado el formulario de registrar entrada
if (isset($_POST['registrar_entrada'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarEntrada();
}

// Verificar si se ha enviado el formulario de registrar salida
if (isset($_POST['registrar_salida'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarSalida();
}
?>
