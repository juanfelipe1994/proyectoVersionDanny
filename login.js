document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const formData = new FormData();
        formData.append("username", username);
        formData.append("password", password);

        fetch('http://localhost/proyectoVersionDanny/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            try {
                const jsonData = JSON.parse(data);
                if (jsonData.success) {
                    window.location.href = "registrar_huesped.html"; 
                } else {
                    errorMessage.style.display = "block";
                    console.log(jsonData.message);
                }
            } catch (error) {
                console.error("Error al parsear JSON:", error);
                errorMessage.style.display = "block";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            errorMessage.style.display = "block";
        });
    });
});
