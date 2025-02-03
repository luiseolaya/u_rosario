document.getElementById("registrar").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar el envío del formulario
    obtenerUbicacion(); // Llama a la función para obtener la ubicación
});

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

    const parqueaderoSeleccionado = document.getElementById("Parqueadero").value;
    const { lat, lng } = parqueaderos[parqueaderoSeleccionado];

    const distancia = calcularDistancia(lat, lng, latB, lngB);

    if (distancia <= rangoMaximo) {
        alert('Estás dentro del rango.');
        document.getElementById('entrada-form').submit(); // Enviar el formulario
    } else {
        alert('Estás fuera del rango permitido.');
    }
}