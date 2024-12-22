document.addEventListener("DOMContentLoaded", function () {
    const landing = document.querySelector('.cont-landing');
    const closeButton = document.querySelector('.close-button');

    // Verificar si la landing ya se ha mostrado en la sesión actual
    if (!localStorage.getItem('landingClosed')) {
        landing.style.display = 'block';
    }

    //landing.style.display = 'block';

    // Cerrar la landing y guardar la preferencia en localStorage
    closeButton.addEventListener('click', function () {
        landing.style.display = 'none';
        localStorage.setItem('landingClosed', 'true');
    });
});
