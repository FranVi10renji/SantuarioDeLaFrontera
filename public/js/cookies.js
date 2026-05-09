// Conecta con CookieController.php
document.addEventListener('DOMContentLoaded', () => {

    const banner = document.querySelector('.cookie-banner');
    const aceptar = document.getElementById('cookies-aceptar');
    const rechazar = document.getElementById('cookies-rechazar');

    // Mostrar banner con animación
    if (banner) 
    {
        setTimeout(() => {
            banner.classList.add('show');
        }, 300);
    }

    // ACEPTAR
    if (aceptar) 
    {
        aceptar.addEventListener('click', () => {

            banner.classList.remove('show');

            setTimeout(() => {

                fetch('/aceptar-cookies', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    location.reload();
                });

            }, 400);
        });
    }

    // RECHAZAR
    if (rechazar) 
    {
        rechazar.addEventListener('click', () => {

            banner.classList.remove('show');

            setTimeout(() => {

                fetch('/rechazar-cookies', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    location.reload();
                });

            }, 400);
        });
    }
});