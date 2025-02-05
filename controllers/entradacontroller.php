<?php

require_once __DIR__ . '/../config/DB_cicloparqueadero.php';
require_once __DIR__ . '/../models/Entrada.php';

class EntradaController {
    private $db;
    private $entrada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->entrada = new Entrada($this->db); 
    }

    public function registrarEntrada() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        echo "Entrando a registrarEntrada"; 
        echo "Correo en sesión: " . (isset($_SESSION['correo']) ? $_SESSION['correo'] : 'No hay correo en sesión');
        echo "Base de datos: " . ($this->db ? 'Conectado' : 'No conectado');
        echo "Entrada: " . ($this->entrada ? 'Inicializado' : 'No inicializado');

        if (!isset($_SESSION['correo'])) {
            $_SESSION['error'] = 'Debe iniciar sesión para registrar una entrada.';
            header("Location: ../views/registro.php");
            exit;
        }

        if (!empty($_POST)) {
            // Recuperar el código y color aleatorios de localStorage
            $codigo_aleatorio = $_POST['codigo_aleatorio'];
            $color_aleatorio = $_POST['color_aleatorio'];

            // Validar código, color y parqueadero
            if ($_POST['codigo'] !== $codigo_aleatorio || $_POST['color'] !== $color_aleatorio || $_POST['id_parqueadero'] == 'Seleccione el Cicloparqueadero') {
                $_SESSION['error'] = 'Revise de nuevo el código, color y parqueadero seleccionados.';
                header("Location: ../views/reg_entrada.php");
                exit;
            }

            $_SESSION['entrada_temp'] = $_POST; // Guarda la entrada temporalmente en la sesión
            header("Location: ../views/evidencia.php"); // Redirige a la vista evidencia.php
            exit;
        }
    }
}

if (isset($_POST['registrar_entrada'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarEntrada();
}
?>
