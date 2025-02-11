<?php
require_once __DIR__ . '/../config/DB_cicloparqueadero.php';
require_once __DIR__ . '/../models/Entrada.php';

class EvidenciaController {
    private $db;
    private $entrada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->entrada = new Entrada($this->db);
    }

    public function subirEvidencia() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            $_SESSION['error'] = 'Debe iniciar sesión para registrar una entrada.';
            header("Location: ../views/inicio_seccion.php");
            exit;
        }

        if (isset($_SESSION['entrada_temp'])) {
            // Depuración: Verificar valores
            error_log("ID Usuario: " . $_SESSION['id_usuario']);
            error_log("ID Parqueadero: " . $_SESSION['entrada_temp']['id_parqueadero']);

            // Asignar valores al modelo
            $this->entrada->id_usuario = $_SESSION['id_usuario'];
            $this->entrada->id_parqueadero = $_SESSION['entrada_temp']['id_parqueadero'];
            $this->entrada->fecha_hora = date('Y-m-d H:i:s');

            // Intentar crear la entrada
            if ($this->entrada->crearEntrada()) {
                unset($_SESSION['entrada_temp']); // Limpiar datos temporales
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                $_SESSION['error'] = 'Error al registrar la entrada.';
                header("Location: ../views/reg_entrada.php");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Datos temporales no encontrados.';
            header("Location: ../views/reg_entrada.php");
            exit;
        }
    }
}

if (isset($_POST['subir_evidencia'])) {
    $evidenciaController = new EvidenciaController();
    $evidenciaController->subirEvidencia();
}