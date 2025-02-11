<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Evidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/cicloparqueadero/css/style.css">
</head>
<body>
<div class="container text-center">
    <?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header("Location: registro.php");
        exit;
    }
    ?>
    <div class="mb-4 border border-secondary text-center mt-5 d-flex align-items-center">
        <img src="/cicloparqueadero/img/LOGOU.png" alt="Logo" class="me-3 ms-4" style="width: 50px; height: auto;">
        <div>
            <div class="fs-2 fw-bolder ms-3">Cicloparqueadero</div>
            <div class="fs-6 fw-bolder mb-2 ms-3">Universidad del Rosario</div>
        </div>
    </div>
    <div><h5>Bienvenido, <?php echo htmlspecialchars($_SESSION['correo']); ?></h5></div>
    
    <video id="video" width="320" height="240" autoplay></video>
    <div class="d-flex justify-content-center">
        <img src="/cicloparqueadero/img/camara.png" id="startbutton" alt="Tomar foto" style="cursor: pointer; width: 50px; height: auto;">
    </div>
    <canvas id="canvas" style="display:none;"></canvas>
    <img src="http://placekitten.com/g/320/261" id="photo" alt="Foto tomada" />
    
    <form action="../controllers/EvidenciaController.php" method="POST">
        <input type="hidden" name="evidencia" id="evidencia">
        <button type="submit" name="subir_evidencia" class="btn btn-outline-secondary mt-2 mb-4 fs-6">Subir foto</button>
    </form>
</div>
<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photo = document.getElementById('photo');
    const startbutton = document.getElementById('startbutton');
    const evidencia = document.getElementById('evidencia');
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            video.play();
        })
        .catch(err => {
            console.error("Error al acceder a la cámara: ", err);
        });
    startbutton.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
        evidencia.value = data; 
    });
</script>
</body>
</html>