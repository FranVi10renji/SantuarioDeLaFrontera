document.addEventListener('DOMContentLoaded', () => {

    const btn = document.querySelector('.fa-circle-half-stroke');

    const cookiebanner = document.querySelector('.cookie-banner');

    // Cargar tema guardado
    if (localStorage.getItem('theme') === 'dark') 
    {
        document.body.classList.add('dark-mode');

        if (cookiebanner)
            cookiebanner.classList.add('dark-mode');
    }

    // Cambiar tema
    if (btn) 
    {
        btn.addEventListener('click', () => {

            document.body.classList.toggle('dark-mode');

            if (cookiebanner)
                cookiebanner.classList.toggle('dark-mode');

            localStorage.setItem('theme',document.body.classList.contains('dark-mode') ? 'dark': 'light');
        });
    }
});