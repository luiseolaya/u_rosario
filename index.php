<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/config/DB_cicloparqueadero.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/controllers/UsuarioController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/controllers/EntradaController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/controllers/LogoutController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/controllers/EvidenciaController.php';

$request = $_SERVER['REQUEST_URI'];
$request = str_replace("/U_cicloparqueadero/", "", $request);
$parsed_url = parse_url($request);
$path = $parsed_url['path'];
$query = isset($parsed_url['query']) ? $parsed_url['query'] : '';
parse_str($query, $params);

echo "Request Path: " . $path . "<br>";
echo "Request Query: " . $query . "<br>";

if (isset($params['registrar_entrada'])) {
    $controller = new EntradaController();
    $controller->registrarEntrada();
} else {
    switch ($path) {
        case '':
        case '/':
            require $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/views/registro.php';
            break;
        case 'registro':
            $controller = new UsuarioController();
            $controller->registrar();
            break;
        case 'inicio_seccion':
            require $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/views/inicio_seccion.php';
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
        case 'evidencia':
            require $_SERVER['DOCUMENT_ROOT'] . '/U_cicloparqueadero/views/evidencia.php';
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