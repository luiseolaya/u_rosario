const alerta = document.getElementById('alerta');
const colores = ['#28a745', '#dc3545', '#ffc107', '#007bff', '#6f42c1']; 

function seleccionarColorAleatorio() {
    const indiceAleatorio = Math.floor(Math.random() * colores.length);
    return colores[indiceAleatorio];
}

function generarMensajeAleatorio() {
    const numeroAleatorio = Math.floor(100000 + Math.random() * 900000);
    return `${numeroAleatorio}`; 
}

document.addEventListener('DOMContentLoaded', () => {
    const colorAleatorio = seleccionarColorAleatorio();
    const mensajeAleatorio = generarMensajeAleatorio();
    
    alerta.style.backgroundColor = colorAleatorio;
    alerta.textContent = mensajeAleatorio;
    alerta.style.display = 'block';
    
    const EscogerColor = document.getElementById('EscogerColor');
    const codigo = document.getElementById('codigo'); 
    const btn = document.getElementById('registrar');
    
    btn.addEventListener('click', () => {
        if (codigo.value !== mensajeAleatorio) {
            alert('Código incorrecto');
            return;
        }
        if (EscogerColor.value !== colorAleatorio) {
            alert('Color incorrecto');
            return;
        }
        verificarUbicacion();
    });
});


const latA = 4.601025504132103;
const lngA = -74.07303884639771;
const rangoMaximo = 0.01; // 10 metros = 0.01 km


function calcularDistancia(lat1, lon1, lat2, lon2) {
    const radioTierra = 6371; 
    const dLat = deg2rad(lat2 - lat1);
    const dLon = deg2rad(lon1 - lon2);
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return radioTierra * c; 
}

function deg2rad(deg) {
    return deg * (Math.PI / 180);
}


function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrarUbicacion, manejarError);
    } else {
        alert("La geolocalización no es soportada por este navegador.");
    }
}

// Función para mostrar la ubicación del usuario y verificar si está en el rango
function mostrarUbicacion(position) {
    const latB = position.coords.latitude;
    const lngB = position.coords.longitude;

    const distancia = calcularDistancia(latA, lngA, latB, lngB);

    // Verificar si la distancia es menor o igual a 10 metros (0.01 km)
    if (distancia <= rangoMaximo) {
        alert('Estás dentro del rango.');
        realizarAccion(true);
    } else {
        alert('Estás fuera del rango permitido.');
        realizarAccion(false);
    }
}

function realizarAccion(ubicacionValida) {
    if (ubicacionValida) {
        // Si está dentro del rango, registrar la entrada
        alert("Registrando entrada...");
        // Aquí deberías agregar la lógica para registrar la entrada en la base de datos
        // Luego redirigir a inc_user.php
        window.location.href = "inc_user.php";
    } else {
        // Si está fuera del rango, mostrar un error
        alert("Por favor, acércate al parqueadero y vuelve a intentarlo.");
        location.reload();
    }
}

function manejarError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("El usuario ha denegado el acceso a la ubicación.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("La ubicación no está disponible.");
            break;
        case error.TIMEOUT:
            alert("Se agotó el tiempo para obtener la ubicación.");
            break;
        case error.UNKNOWN_ERROR:
            alert("Ocurrió un error desconocido.");
            break;
    }
}

function verificarUbicacion() {
    obtenerUbicacion(); // Llama a la función para obtener la ubicación
}
