<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/config/DB_cicloparqueadero.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/controllers/UsuarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/controllers/EntradaController.php';

$request = $_SERVER['REQUEST_URI'];
$request = str_replace("/U_cicloparqueadero/", "", $request);

switch ($request) {
    case '':
    case '/':
        require $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/views/registro.php';
        break;
    case 'registro':
        $controller = new UsuarioController();
        $controller->registrar();
        break;
    case 'inicio_seccion':
        require $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/views/ini_seccion.php';
        break;
    case 'inc_user':
        require $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/views/inc_user.php';
        break;
    case 'registrar_entrada':
        $controller = new EntradaController();
        $controller->registrarEntrada();
        break;
    case 'registrar_salida':
        $controller = new EntradaController();
        $controller->registrarSalida();
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
?>
