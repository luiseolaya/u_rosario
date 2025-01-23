const alerta = document.getElementById('alerta');
<<<<<<< HEAD:js/validacionENT.js
=======
<<<<<<< HEAD
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
=======


>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
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
<<<<<<< HEAD:js/validacionENT.js
=======
   
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
    const colorAleatorio = seleccionarColorAleatorio();
    const mensajeAleatorio = generarMensajeAleatorio();
    
    alerta.style.backgroundColor = colorAleatorio;
    alerta.textContent = mensajeAleatorio;
    alerta.style.display = 'block';
    
<<<<<<< HEAD:js/validacionENT.js
=======
<<<<<<< HEAD
=======
   
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
    const EscogerColor = document.getElementById('EscogerColor');
    const codigo = document.getElementById('codigo'); 
    const btn = document.getElementById('registrar');
    
    btn.addEventListener('click', () => {
<<<<<<< HEAD:js/validacionENT.js
        if (codigo.value !== mensajeAleatorio) {
            alert('Código incorrecto');
            return;
        }
        if (EscogerColor.value !== colorAleatorio) {
=======
<<<<<<< HEAD
        verificarValidaciones(colorAleatorio, mensajeAleatorio, codigo.value, EscogerColor.value);
=======
        if (codigo.value === mensajeAleatorio) {
            codigo=true;
        } else {
            alert('Codigo incorrecto');
        }
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
    });
    btn.addEventListener('click', () => {
        if (EscogerColor.value === colorAleatorio) {
            EscogerColor=true;
        } else {
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
            alert('Color incorrecto');
            return;
        }
        verificarUbicacion();
    });
});
<<<<<<< HEAD:js/validacionENT.js


=======
<<<<<<< HEAD

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
=======
// Coordenadas de referencia (Universidad del Rosario) parqueadero en el caso actual
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
const latA = 4.601025504132103;
const lngA = -74.07303884639771;
const rangoMaximo = 0.01; // 10 metros = 0.01 km


function calcularDistancia(lat1, lon1, lat2, lon2) {
    const radioTierra = 6371; 
    const dLat = deg2rad(lat2 - lat1);
<<<<<<< HEAD:js/validacionENT.js
    const dLon = deg2rad(lon1 - lon2);
=======
    const dLon = deg2rad(lon2 - lon1);
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return radioTierra * c; 
}

function deg2rad(deg) {
    return deg * (Math.PI / 180);
}

<<<<<<< HEAD
=======

<<<<<<< HEAD:js/validacionENT.js
=======
// Función para obtener la ubicación del usuario
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrarUbicacion, manejarError);
    } else {
        alert("La geolocalización no es soportada por este navegador.");
    }
}

<<<<<<< HEAD
=======
// Función para mostrar la ubicación del usuario y verificar si está en el rango
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
function mostrarUbicacion(position) {
    const latB = position.coords.latitude;
    const lngB = position.coords.longitude;

    const distancia = calcularDistancia(latA, lngA, latB, lngB);

<<<<<<< HEAD
    if (distancia <= rangoMaximo) {
=======
    // Verificar si la distancia es menor o igual a 10 metros (0.01 km)
    if (distancia <= rangoMaximo) {
        alert('Estás dentro del rango.');
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
        realizarAccion(true);
    } else {
        alert('Estás fuera del rango permitido.');
        realizarAccion(false);
    }
}

function realizarAccion(ubicacionValida) {
    if (ubicacionValida) {
<<<<<<< HEAD:js/validacionENT.js
        // Si está dentro del rango, registrar la entrada
=======
<<<<<<< HEAD
        alert("Registrando entrada...");
        window.location.href = "/U_cicloparqueadero/views/inc_user.php"; // Cambia esta URL según lo necesario
    } else {
        alert("Por favor, acércate al parqueadero y vuelve a intentarlo.");
=======
        // Si está dentro del rango, registrar la entrada o redirigir
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
        alert("Registrando entrada...");
        // Aquí deberías agregar la lógica para registrar la entrada en la base de datos
        // Luego redirigir a inc_user.php
        window.location.href = "inc_user.php";
    } else {
        // Si está fuera del rango, mostrar un error
<<<<<<< HEAD:js/validacionENT.js
        alert("Por favor, acércate al parqueadero y vuelve a intentarlo.");
=======
        alert("Por favor, acércate a el parqueadero y vuelve a intentarlo.");
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
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
<<<<<<< HEAD
    obtenerUbicacion();
}

function eliminarFila(boton) {
    var fila = boton.closest('tr');
    fila.remove();
}
=======
    obtenerUbicacion(); // Llama a la función para obtener la ubicación
<<<<<<< HEAD:js/validacionENT.js
}
=======
} 


function eliminarFila(boton) {
    // Obtener la fila completa (el <tr>) en la que está el botón
    var fila = boton.closest('tr');
    
    // Eliminar la fila de la tabla
    fila.remove();
}
>>>>>>> aa77dc5f72a0bcc70357c177a16d92c44abb99ca
>>>>>>> b015d22926773dd651c376d9c85d255f736a8eeb:js/val_entrada.js
