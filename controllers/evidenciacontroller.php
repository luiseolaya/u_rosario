<?php
require_once __DIR__ . '/../config/DB_cicloparqueadero.php';
require_once __DIR__ . '/../models/ModeloEvidencia.php';
class EvidenciaController {
    private $db;
    private $evidencia;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->evidencia = new ModeloEvidencia($this->db);
    }
    public function subirEvidencia() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            $_SESSION['error'] = 'Debe iniciar sesión para registrar una entrada.';
            header("Location: ../views/login.php");
            exit;
        }
        if (isset($_SESSION['entrada_temp'])) {
            $this->evidencia->id_usuario = $_SESSION['id_usuario'];
            $this->evidencia->id_parqueadero = $_SESSION['entrada_temp']['id_parqueadero'];
            $this->evidencia->codigo = $_SESSION['entrada_temp']['codigo'];
            $this->evidencia->color = $_SESSION['entrada_temp']['color'];
            $this->evidencia->evidencia = $_POST['evidencia'] ?? null;
            if ($this->evidencia->crearEvidencia()) {
                unset($_SESSION['entrada_temp']);
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                $_SESSION['error'] = 'Error al registrar la evidencia.';
                header("Location: ../views/reg_entrada.php");
                exit;
            }
        }
    }
}
if (isset($_POST['subir_evidencia'])) {
    $evidenciaController = new EvidenciaController();
    $evidenciaController->subirEvidencia();
}
?>