<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/DB_cicloparqueadero.php';
require_once __DIR__ . '/../models/Usuario.php'; 
require_once __DIR__ . '/../models/Entrada.php';

class UsuarioController {
    private $db;
    private $usuario;
    private $entrada;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
        $this->entrada = new Entrada($this->db);
    }

    public function registrar() {
        if (!empty($_POST)) {
            $this->usuario->nombres = $_POST['nombres'] ?? '';
            $this->usuario->apellidos = $_POST['apellidos'] ?? '';
            $this->usuario->correo = $_POST['correo'] ?? '';
            $this->usuario->celular = $_POST['celular'] ?? '';
            $this->usuario->clave = password_hash($_POST['clave'] ?? '', PASSWORD_DEFAULT); // Asegúrate de usar hash para la clave

            if ($this->usuario->crear()) {
                $_SESSION['correo'] = $this->usuario->correo;  // Establecer la sesión
                $_SESSION['id_usuario'] = $this->usuario->id_usuario; // Establecer id_usuario en la sesión
                $_SESSION['mensaje'] = 'Usuario registrado correctamente.';
                header("Location: ../views/inc_user.php");
                exit;
            } else {
                $_SESSION['error'] = 'El correo electrónico ya está registrado.';
                header("Location: ../views/registro.php");
                exit;
            }
        }
    }

    public function iniciar() {
        if (!empty($_POST)) {
            $this->usuario->correo = $_POST['correo'] ?? '';
            $clave = $_POST['clave'] ?? '';
    
            // Depuración: Verifica los valores antes de ejecutar la consulta
            error_log("Correo: " . $this->usuario->correo);
            error_log("Clave: " . $clave);
    
            $query = "SELECT id_usuario, clave FROM usuarios WHERE correo = :correo";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':correo', $this->usuario->correo);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($clave, $usuario['clave'])) {
                    $_SESSION['correo'] = $this->usuario->correo;  // Establecer la sesión
                    $_SESSION['id_usuario'] = $usuario['id_usuario']; // Establecer id_usuario en la sesión
                    header("Location: ../views/inc_user.php");
                    exit;
                } else {
                    $_SESSION['error'] = 'Contraseña incorrecta.';
                    header("Location: ../views/inicio_seccion.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = 'Correo no encontrado.';
                header("Location: ../views/inicio_seccion.php");
                exit;
            }
        }
    }

    public function mostrarUsuarioYEntradas() {
        $query = "
            SELECT e.id_entrada, e.fecha_hora, p.sede_parqueadero
            FROM entrada e
            JOIN parqueadero p ON e.id_parqueadero = p.id_parqueadero
            WHERE e.id_usuario = :id_usuario
            ORDER BY e.fecha_hora DESC
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_usuario', $_SESSION['id_usuario']);
        $stmt->execute();
    
        $entradas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
      
        foreach ($entradas as &$entrada) {
            $date = new DateTime($entrada['fecha_hora'], new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone('America/Bogota')); // Cambiar 'America/Bogota' a la zona horaria correcta
            $entrada['fecha_hora'] = $date->format('Y-m-d H:i:s');
        }
    
        $usuario = [
            'correo' => $_SESSION['correo']
        ];
    
        return ['usuario' => $usuario, 'entradas' => $entradas];
    }
    
    
}

if (isset($_POST['registrar'])) {
    $usuarioController = new UsuarioController();
    $usuarioController->registrar();
}

if (isset($_POST['iniciar'])) {
    $usuarioController = new UsuarioController();
    $usuarioController->iniciar();
}
?>
