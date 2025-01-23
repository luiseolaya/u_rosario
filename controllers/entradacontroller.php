<?php
require_once __DIR__ . '/../config/DB_cicloparqueadero.php';
require_once __DIR__ . '/../models/entrada.php';

class EntradaController {
    private $db;
    private $entrada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->entrada = new Entrada($this->db);
    }

   
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


if (isset($_POST['registrar_entrada'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarEntrada();
}


if (isset($_POST['registrar_salida'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarSalida();
}
?>
