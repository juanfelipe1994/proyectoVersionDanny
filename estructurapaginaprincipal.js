document.getElementById('reserva-button').addEventListener('click', function() {
    const reservationInfo = document.getElementById('reservation-info');

    reservationInfo.innerHTML = `
        <p>Nombre del Asesor: Juan Felipe</p>
        <p>Número de Celular: 3218532965</p>
    `;
    reservationInfo.classList.toggle('hidden');
});

document.getElementById('salir-button').addEventListener('click',function(){
window.location.href = 'gestionar_registros.html';
});

