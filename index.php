<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/config/DB_cicloparqueadero.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/controllers/UsuarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/controllers/EntradaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/controllers/LogoutController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/controllers/EvidenciaController.php';

$request = $_SERVER['REQUEST_URI'];
$request = str_replace("/cicloparqueadero/", "", $request);
$parsed_url = parse_url($request);
$path = $parsed_url['path'];
$query = isset($parsed_url['query']) ? $parsed_url['query'] : '';
parse_str($query, $params);

if (isset($params['registrar_entrada'])) {
    $controller = new EntradaController();
    $controller->registrarEntrada();
} else {
    switch ($path) {
        case '':
        case '/':
            require $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/views/registro.php';
            break;
        case 'registro':
            $controller = new UsuarioController();
            $controller->registrar();
            break;
        case 'inicio_seccion':
            require $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/views/inicio_seccion.php';
            break;
        case 'inc_user':
            require $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/views/inc_user.php';
            break;
        case 'registrar_entrada':
            $controller = new EntradaController();
            $controller->registrarEntrada();
            break;
        case 'evidencia':
            require $_SERVER['DOCUMENT_ROOT'] . '/cicloparqueadero/views/evidencia.php';
            break;
        case 'logout':
            $controller = new LogoutController();
            $controller->logout();
            break;
        default:
            http_response_code(404);
            echo "Página no encontrada";
            break;
    }
}
?>
