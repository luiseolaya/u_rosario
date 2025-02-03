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

           // Validación de ubicación
               //if (!isset($_POST['latitud']) || !isset($_POST['longitud'])) {
                 //$_SESSION['error'] = 'Ubicación no proporcionada.';
                 //header("Location: ../views/reg_entrada.php");
                //exit;
                 //}

            $latB = $_POST['latitud'];
            $lngB = $_POST['longitud'];
            $id_parqueadero = $_POST['id_parqueadero'];

            // Coordenadas de los parqueaderos
            $parqueaderos = [
                1 => ['lat' => 4.601025504132103, 'lng' => -74.07303884639771], // Parqueadero A
                2 => ['lat' => 4.602025504132103, 'lng' => -74.07403884639771]  // Parqueadero B
            ];

            if (!array_key_exists($id_parqueadero, $parqueaderos)) {
                $_SESSION['error'] = 'Parqueadero incorrecto';
                header("Location: ../views/reg_entrada.php");
                exit;
            }

            $parqueadero = $parqueaderos[$id_parqueadero];
            $distancia = $this->calcularDistancia($parqueadero['lat'], $parqueadero['lng'], $latB, $lngB);

            if ($distancia > 100000000000000000000000) { // 10 metros en km
                $_SESSION['error'] = 'Estás fuera del rango permitido.';
                header("Location: ../views/reg_entrada.php");
                exit;
            }

            // Si todo está bien, guardar la entrada temporal y redirigir
            $_SESSION['entrada_temp'] = $_POST;
            header("Location: ../views/evidencia.php");
            exit;
        }
    }

    private function calcularDistancia($lat1, $lon1, $lat2, $lon2) {
        $radioTierra = 6371; // Radio de la Tierra en km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $radioTierra * $c; // Distancia en km
    }
}

if (isset($_POST['registrar_entrada'])) {
    $entradaController = new EntradaController();
    $entradaController->registrarEntrada();
}