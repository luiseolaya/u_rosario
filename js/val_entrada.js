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
        verificarValidaciones(colorAleatorio, mensajeAleatorio, codigo.value, EscogerColor.value);
    });
});

let verificacionFallida = false;

function verificarValidaciones(colorAleatorio, mensajeAleatorio, codigoIngresado, colorIngresado) {
    if (verificacionFallida) {
        return; // Si ya falló una verificación, no se hacen más verificaciones
    }

    // Verificación del código
    if (codigoIngresado !== mensajeAleatorio) {
        alert('Código incorrecto');
        verificacionFallida = true;  // Marca la verificación como fallida
        location.reload();
        return;
    }

    // Verificación del color
    if (colorIngresado !== colorAleatorio) {
        alert('Color incorrecto');
        verificacionFallida = true;  // Marca la verificación como fallida
        location.reload();
        return;
    }

    // Si las dos validaciones son correctas, verificar la ubicación
    verificarUbicacion();
}

// Coordenadas de referencia (Universidad del Rosario) parqueadero en el caso actual
const latA = 4.599748555538379;
const lngA = -74.0716575641109;
const rangoMaximo = 1111100; // 10 metros = 0.01 km

function calcularDistancia(lat1, lon1, lat2, lon2) {
    const radioTierra = 6371; // Radio de la Tierra en km
    const dLat = deg2rad(lat2 - lat1);
    const dLon = deg2rad(lat2 - lon1);
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return radioTierra * c; // Distancia en km
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

function mostrarUbicacion(position) {
    const latB = position.coords.latitude;
    const lngB = position.coords.longitude;

    const distancia = calcularDistancia(latA, lngA, latB, lngB);

    if (distancia <= rangoMaximo) {
        realizarAccion(true);
    } else {
        alert('Estás fuera del rango permitido.');
        realizarAccion(false);
    }
}

function realizarAccion(ubicacionValida) {
    if (ubicacionValida) {
        alert("Registrando entrada...");
        window.location.href = "/U_cicloparqueadero/views/inc_user.php"; // Cambia esta URL según lo necesario
    } else {
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
    obtenerUbicacion();
}

function eliminarFila(boton) {
    var fila = boton.closest('tr');
    fila.remove();
}
