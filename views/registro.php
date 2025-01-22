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
                <a href="/U_cicloparqueadero/views/ini_seccion.php">
                    <button type="button" class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg">Iniciar sesión</button>
                </a>
                <button type="button" class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg">Registrarse</button>
            </div>
            <form id="registro-form" autocomplete="off" action="/U_cicloparqueadero/controllers/UsuarioController.php" method="POST">
                    <input type="hidden" name="registrar" value="1">
                <div class="form-floating mb-3 ms-2">
                    <input type="text" class="form-control" id="nombre" name="nombres" placeholder="Nombres">
                    <label for="nombre">Nombres</label>
                </div>
                <div class="form-floating mb-3 ms-2">
                    <input type="text" class="form-control" id="apellido" name="apellidos" placeholder="Apellidos">
                    <label for="apellido">Apellidos</label>
                </div>
                <div class="form-floating mb-3 ms-2">
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico">
                    <label for="correo">Correo Electrónico</label>
                </div>
                <div class="form-floating mb-3 ms-2">
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular">
                    <label for="celular">Celular</label>
                </div>
                <div class="form-floating mb-3 ms-2">
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave">
                    <label for="clave">Clave</label>
                </div>
                <div class="form-floating mb-3 ms-2">
                    <input type="password" class="form-control" id="conf_clave" name="conf_clave" placeholder="Clave">
                    <label for="clave">Confirmacion clave</label>
                </div>
                <div>
                    <input type="checkbox" value="autorizo" class="mt-3" id="autorizo"> Autorizo los términos y condiciones
                </div>
                <button type="submit" class="btn btn-outline-secondary mt-2 mb-4 fs-6">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
