document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM cargado para validación de entrada");

    const form = document.getElementById("entrada-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();  // Detener el envío del formulario por defecto

        let errorMessage = "";

        const usuario_id = document.getElementById("usuario_id").value.trim();
        const placa_vehiculo = document.getElementById("placa_vehiculo").value.trim();

        if (!usuario_id || !placa_vehiculo) {
            errorMessage = "No puede haber campos vacíos.";
        } else if (!/^[a-zA-Z0-9]+$/.test(placa_vehiculo)) {
            errorMessage = "Formato de placa de vehículo no válido.";
        }

        if (errorMessage) {
            Swal.fire({
                title: '¡Error!',
                text: errorMessage,
                icon: 'error',
                timer: 3000,
                timerProgressBar: true
            });
            return false; // Detener el envío del formulario
        }

        form.submit(); // Si pasa la validación, enviar el formulario
    });
});
