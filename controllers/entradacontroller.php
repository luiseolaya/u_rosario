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

        if (!isset($_SESSION['correo'])) {
            $_SESSION['error'] = 'Debe iniciar sesión para registrar una entrada.';
            header("Location: ../views/registro.php");
            exit;
        }

        if (!empty($_POST)) {
            // Validación de código
            $codigo = $_POST['codigo'];
            $mensajeAleatorio = $_SESSION['mensaje_aleatorio'];

            if ($codigo !== $mensajeAleatorio) {
                $_SESSION['error'] = 'Código incorrecto';
                header("Location: ../views/reg_entrada.php");
                exit;
            }

            // Validación de color
            $color = $_POST['color'];
            $colorAleatorio = $_SESSION['color_aleatorio'];

            if ($color !== $colorAleatorio) {
                $_SESSION['error'] = 'Color incorrecto';
                header("Location: ../views/reg_entrada.php");
                exit;
            }

            // Validación de ubicación (simplificada)
            $id_parqueadero = $_POST['id_parqueadero'];

            if (!in_array($id_parqueadero, [1, 2])) {
                $_SESSION['error'] = 'Parqueadero incorrecto';
                header("Location: ../views/reg_entrada.php");
                exit;
            }

            $_SESSION['entrada_temp'] = $_POST;
            header("Location: ../views/evidencia.php");
            exit;
        }
    }
}

if (isset($_POST['registrar_entrada'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarEntrada();
}
