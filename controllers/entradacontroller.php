<?php
require_once('C:\xampp\htdocs\U_cicloparqueadero\CONFIG\DB_cicloparqueadero.php');
require_once('C:\xampp\htdocs\U_cicloparqueadero\models\entrada.php');

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
            $this->entrada->usuario_id = $_POST['usuario_id'] ?? '';
            $this->entrada->placa_vehiculo = $_POST['placa_vehiculo'] ?? '';

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
            $this->entrada->id = $_POST['entrada_id'] ?? '';

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
