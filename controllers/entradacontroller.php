// controllers/EntradaController.php
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
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            $_SESSION['error'] = 'Debe iniciar sesión para registrar una entrada.';
            header("Location: ../views/registro.php");
            exit;
        }

        if (!empty($_POST)) {
            $_SESSION['entrada_temp'] = $_POST;
            header("Location: ../views/evidencia.php");
            exit;
        }
    }

    public function registrarSalida() {
        if (!empty($_POST)) {
            $this->entrada->id_entrada = filter_input(INPUT_POST, 'id_entrada', FILTER_SANITIZE_STRING);

            if ($this->entrada->crearSalida()) {
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                $_SESSION['error'] = 'Error al registrar la salida.';
                header("Location: ../views/inc_user.php");
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
