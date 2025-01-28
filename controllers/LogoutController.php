<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class LogoutController {
    public function logout() {
        session_destroy(); // Destruye la sesión
        header("Location: ../views/registro.php"); // Redirige a la página de inicio de sesión
        exit;
    }
}

if (isset($_POST['logout'])) {
    $logoutController = new LogoutController();
    $logoutController->logout();
}
?>
