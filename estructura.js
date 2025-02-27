document.addEventListener('DOMContentLoaded', function() {
    const formGestionarRegistros = document.getElementById('form-gestionar-registros');
    const formBuscarRegistros = document.getElementById('form-buscar-registros');
    const resultadosRegistros = document.getElementById('resultados-registros');
    if (formGestionarRegistros) {
        formGestionarRegistros.addEventListener('submit', async function(event) {
            event.preventDefault(); 
            const formData = new FormData(formGestionarRegistros);

            try {
                const response = await fetch('http://localhost/proyectoVersionDanny/gestionar_registros.php', {
                    method: 'POST',
                    body: formData
                });
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                const result = await response.json();
                if (result.success) {
                    alert(result.success);
                } else if (result.error) {
                    alert(result.error);
                }
                resultadosRegistros.innerHTML = JSON.stringify(result, null, 2);

            } catch (error) {
                console.error('Hubo un problema con la solicitud. Verifica la consola para más detalles.');
                alert('Hubo un error al procesar la solicitud');
            }
        });
    }
    if (formBuscarRegistros) {
        formBuscarRegistros.addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(formBuscarRegistros);
            const params = new URLSearchParams(formData);

            try {
                const response = await fetch(`http://localhost/proyectoVersionDanny/gestionar_registros.php?${params.toString()}`, {
                    method: 'GET'
                });

                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                const result = await response.json();
                if (result.data) {
                    resultadosRegistros.innerHTML = JSON.stringify(result.data, null, 2);
                } else if (result.error) {
                    resultadosRegistros.innerHTML = result.error;
                }

            } catch (error) {
                console.error('Hubo un problema con la solicitud. Verifica la consola para más detalles.');
                alert('Hubo un error al procesar la solicitud');
            }
        });
    }
});

