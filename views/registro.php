<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = $_SESSION['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/U_cicloparqueadero/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/U_cicloparqueadero/js/val_registro.js"></script>
</head>
<body>
    <?php if ($error): ?>
        <script>
            Swal.fire({
                title: 'Error',
                text: '<?php echo htmlspecialchars($error); ?>',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div class="container">
        <div class="container text-center">
            <div class="mb-4 border border-secondary text-center mt-5 d-flex align-items-center">
                <img src="/U_cicloparqueadero/img/LOGOU.png" alt="Logo" class="me-3 ms-4" style="width: 50px; height: auto;">
                <div>
                    <div class="fs-2 fw-bolder ms-3">Cicloparqueadero</div>
                    <div class="fs-6 fw-bolder mb-2 ms-3">Universidad del Rosario</div>
                </div>
            </div>
            <div class="btn-group-lg mt-3">
                <button type="button" class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg" onclick="mostrarFormulario('iniciar')">Iniciar sesión</button>
                <button type="button" class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg" onclick="mostrarFormulario('registro')">Registrarse</button>
            </div>
            <div id="formulario-iniciar" style="display:none;">
                <div class="fs-2 text-start mb-3 mt-4 fw-bolder ms-2">Iniciar sesión</div>
                <form action="/U_cicloparqueadero/controllers/UsuarioController.php" method="POST">
                    <div class="form-floating mb-4 ms-2">
                        <input type="email" class="form-control" id="floatingInput" name="correo" placeholder="name@example.com" required>
                        <label for="floatingInput">Correo Electronico</label>
                    </div>
                    <div class="form-floating ms-2">
                        <input type="password" class="form-control" id="floatingPassword" name="clave" placeholder="Password" required>
                        <label for="floatingPassword">Contraseña</label>
                    </div>
                    <div class="button group btn-group-lg mt-3 d-grid gap-2 ms-2">
                        <button type="submit" name="iniciar" class="btn btn-outline-secondary mt-4 mb-4 fs-6">Entrar</button>
                    </div>
                </form>
            </div>
            <div id="formulario-registro" style="display:none;">
                <div class="fs-2 text-start mb-3 mt-4 fw-bolder ms-2">Registrarse</div>
                <form action="/U_cicloparqueadero/controllers/UsuarioController.php" method="POST">
                    <input type="hidden" name="registrar" value="1">
                    <div class="form-floating mb-3 ms-2">
                        <input type="text" class="form-control" id="nombre" name="nombres" placeholder="Nombres" required>
                        <label for="nombre">Nombres</label>
                    </div>
                    <div class="form-floating mb-3 ms-2">
                        <input type="text" class="form-control" id="apellido" name="apellidos" placeholder="Apellidos" required>
                        <label for="apellido">Apellidos</label>
                    </div>
                    <div class="form-floating mb-3 ms-2">
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" required>
                        <label for="correo">Correo Electrónico</label>
                    </div>
                    <div class="form-floating mb-3 ms-2">
                        <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" required>
                        <label for="celular">Celular</label>
                    </div>
                    <div class="form-floating mb-3 ms-2">
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave" required>
                        <label for="clave">Clave</label>
                    </div>
                    <div class="form-floating mb-3 ms-2">
                        <input type="password" class="form-control" id="conf_clave" name="conf_clave" placeholder="Confirmar clave" required>
                        <label for="conf_clave">Confirmación clave</label>
                    </div>
                    <div class="mt-3 ms-2">
                        <input type="checkbox" id="autorizo" name="autorizo" value="1" required>
                        <label for="autorizo">Autorizo los términos y condiciones</label>
                    </div>
                    <div class="button group btn-group-lg mt-3 d-grid gap-2 ms-2">
                        <button type="submit" class="btn btn-outline-secondary mt-4 mb-4 fs-6">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function mostrarFormulario(tipo) {
            document.getElementById('formulario-iniciar').style.display = 'none';
            document.getElementById('formulario-registro').style.display = 'none';

            if (tipo === 'iniciar') {
                document.getElementById('formulario-iniciar').style.display = 'block';
            } else if (tipo === 'registro') {
                document.getElementById('formulario-registro').style.display = 'block';
            }
        }
    </script>
</body>
</html>
