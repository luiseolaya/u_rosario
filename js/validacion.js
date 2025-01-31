document.addEventListener('DOMContentLoaded', () => {
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

    const colorAleatorio = seleccionarColorAleatorio();
    const mensajeAleatorio = generarMensajeAleatorio();

    if (alerta) {
        alerta.style.backgroundColor = colorAleatorio;
        alerta.textContent = mensajeAleatorio;
        alerta.style.display = 'block';
    }

    fetch('../controllers/store_session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            color_aleatorio: colorAleatorio,
            mensaje_aleatorio: mensajeAleatorio
        })
    });
});
