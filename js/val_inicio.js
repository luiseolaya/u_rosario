
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM cargado para validación de inicio de sesión");

    const form = document.getElementById("inicio-form");

    form.addEventListener("submit", (event) => {
        event.preventDefault();  // Detener el envío del formulario por defecto

        let errorMessage = "";

        const correo = document.getElementById("correo").value.trim();
        const clave = document.getElementById("clave").value.trim();

        if (!correo || !clave) {
            errorMessage = "No puede haber campos vacíos.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
            errorMessage = "Formato de correo no válido.";
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
