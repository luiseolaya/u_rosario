<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center">
        <div class="mb-2 border border-secondary text-center mt-5 d-flex align-items-center">
            <img src="image/LOGOU.png" alt="Logo" class="me-3 ms-4" style="width: 50px; height: auto;">
            <div>
                <div class="fs-2 fw-bolder ms-3">Cicloparqueadero</div>
                <div class="fs-6 fw-bolder mb-2 ms-3">Universidad del Rosario</div>
            </div>
        </div>
        <div><h5>Bienvenido juan@urosario.edu.co</h5></div>
        <div>
            <a href="logout.html">
                <p class="text-end me-5">Salir</p>
            </a>
        </div>
        <video id="video" width="320" height="240" autoplay></video>
        <button id="startbutton">Tomar foto</button>
        <canvas id="canvas" style="display:none;"></canvas>
        <img src="http://placekitten.com/g/320/261" id="photo" alt="Foto tomada" />
    </div>
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const startbutton = document.getElementById('startbutton');

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
        });
    </script>
</body>
</html>