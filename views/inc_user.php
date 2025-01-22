<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/U_cicloparqueadero/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/U_cicloparqueadero/js/val_entrada.js"></script>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['mensaje'])) {
        echo "<script>
            Swal.fire({
                title: 'Registro Exitoso',
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
        <img src="/U_cicloparqueadero/img/LOGOU.png" alt="Logo" class="me-3 ms-4" style="width: 50px; height: auto;">
            <div>
                <div class="fs-2 fw-bolder ms-3">Cicloparqueadero</div>
                <div class="fs-6 fw-bolder mb-2 ms-3">Universidad del Rosario</div>
            </div>
        </div>
        <div><h5></h5></div>
        <div>
            <a href="">
                <p class="text-end me-5">Salir</p>
            </a>
        </div>
        <a href="RegistrarENT.html">
        <div class="btn btn-outline-secondary mt-3 mb-4 me-4 btn-lg ">+ Entrada</div>
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
                    <tr>
                        <th scope="row">&#x2611;&#xfe0f;</th>
                        <td>24/06/2024</td>
                        <td>Sede A</td>
                        <td>Evento A</td>
                        <td><button class="btn" onclick="eliminarFila(this)">
                            <img src="image/Salida.png" width="30px" height="30px">
                        </button></td>
                    </tr>
                    <tr>
                        <th scope="row">&#x2611;&#xfe0f;</th>
                        <td>25/06/2024</td>
                        <td>Sede B</td>
                        <td>Evento B</td>
                        <td><button class="btn" onclick="eliminarFila(this)">
                            <img src="image/Salida.png" width="30px" height="30px">
                        </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/validacionENT.js"></script>
</body>
</html>
