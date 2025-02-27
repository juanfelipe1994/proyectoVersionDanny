document.addEventListener('DOMContentLoaded', function() {
    const formRegistrarHuesped = document.getElementById('form-registrar-huesped');

    if (formRegistrarHuesped) {
        formRegistrarHuesped.addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(formRegistrarHuesped);

            try {
                const response = await fetch('http://localhost/proyectoVersionDanny/registrar_huesped.php', {
                    method: 'POST',
                    body: formData
                });

                // Verificar que la respuesta es JSON
                const contentType = response.headers.get("Content-Type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error('La respuesta no es JSON. Posiblemente un error en el servidor.');
                }

                // Intentar convertir la respuesta en JSON
                const result = await response.json();

                if (result.success) {
                    console.log('Huésped registrado exitosamente:', result.message);
                } else {
                    console.error('Error en la respuesta del servidor:', result.message);
                }

                alert(result.message);
                formRegistrarHuesped.reset();

            } catch (error) {
                // Mostrar un mensaje de error en consola y alerta
                if (error.message.includes('Failed to fetch')) {
                    console.error('Error de red: No se pudo conectar al servidor. Verifique que el servidor esté en funcionamiento.');
                } else if (error.message.includes('La respuesta no es JSON')) {
                    console.error('El servidor no devolvió una respuesta JSON válida.');
                } else {
                    console.error('Error desconocido:', error);
                }

                alert('Hubo un problema con la solicitud. Verifica la consola para más detalles.');
            }
        });
    }
});
