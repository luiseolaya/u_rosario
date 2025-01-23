<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../controllers/UsuarioController.php';

// Crear una instancia del controlador
$usuarioController = new UsuarioController();

// Obtener los datos del usuario y las entradas
$data = $usuarioController->mostrarUsuarioYEntradas();
$usuario = $data['usuario'];
$entradas = $data['entradas'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/U_cicloparqueadero/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/U_cicloparqueadero/js/validacionENT.js"></script>
</head>
<body>
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: '" . $_SESSION['mensaje'] . "',
                icon: 'success',
                timer: 3000,
                timerProgressBar: true
            });
            </script>";
        unset($_SESSION['mensaje']);
    }
    ?>
    <div class="container text-center">
        <div class="mb-2 border border-secondary text-center mt-5 d-flex align-items-center">
<<<<<<< HEAD
        <img src="/U_cicloparqueadero/img/LOGOU.png" alt="Logo" class="me-3 ms-4" style="width: 50px; height: auto;">
        <div>
=======
            <img src="/U_cicloparqueadero/img/LOGOU.png" alt="Logo" class="me-3 ms-4" style="width: 50px; height: auto;">
            <div>
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
                <div class="fs-2 fw-bolder ms-3">Cicloparqueadero</div>
                <div class="fs-6 fw-bolder mb-2 ms-3">Universidad del Rosario</div>
            </div>
        </div>
<<<<<<< HEAD
        <div><h5>Bienvenido juan@urosario.edu.co</h5></div>
        <div>
=======
        <div><h5>Bienvenido, <?php echo htmlspecialchars($usuario['correo']); ?></h5></div>
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
        <div>
            <form action="../controllers/LogoutController.php" method="POST">
                <button type="submit" name="logout" class="btn btn-outline-secondary">Salir</button>
            </form>
        </div>
<<<<<<< HEAD
        <a href="reg_entrada.php">
=======
<<<<<<< HEAD
        <a href="registrarENT.php">
        <div class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg ">+ Entrada</div>
=======
        <a href="RegistrarENT.html">
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb
            <div class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg">+ Entrada</div>
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
        </a>

        <div>
            <table class="table mt-4" id="tablaParqueadero">
                <thead>
                    <tr>
                        <th scope="col">&#x2611;&#xfe0f;</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Evento</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
<<<<<<< HEAD
                    <tr>
                        <th scope="row">&#x2611;&#xfe0f;</th>
                        <td>24/06/2024</td>
                        <td>Sede A</td>
                        <td>Evento A</td>
                        <td><button class="btn" onclick="eliminarFila(this)">
                            <img src="/U_cicloparqueadero/img/salida.png" width="30px" height="30px">
                        </button></td>
                    </tr>
                    <tr>
                        <th scope="row">&#x2611;&#xfe0f;</th>
                        <td>25/06/2024</td>
                        <td>Sede B</td>
                        <td>Evento B</td>
                        <td><button class="btn" onclick="eliminarFila(this)">
                            <img src="/U_cicloparqueadero/img/salida.png" width="30px" height="30px">
                        </button></td>
                    </tr>
=======
                    <?php foreach ($entradas as $entrada): ?>
                        <tr>
                            <th scope="row">&#x2611;&#xfe0f;</th>
                            <td><?php echo htmlspecialchars($entrada['fecha_hora']); ?></td>
                            <td><?php echo htmlspecialchars($entrada['id_parqueadero']); ?></td>
                            <td>Evento</td>
                            <td>
                                <form action="../controllers/EntradaController.php" method="POST">
                                    <input type="hidden" name="id_entrada" value="<?php echo htmlspecialchars($entrada['id_entrada']); ?>">
                                    <button type="submit" name="registrar_salida" class="btn">
                                        <img src="/U_cicloparqueadero/img/Salida.png" width="30px" height="30px">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
                </tbody>
            </table>
        </div>
    </div>
<<<<<<< HEAD
    <script src="../js/validacionENT.js"></script>
=======
<<<<<<< HEAD
    <script src="/U_cicloparqueadero/js/val_entrada.js"></script>
=======
    <script src="../js/val_entrada.js"></script>
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb
</body>
</html>
