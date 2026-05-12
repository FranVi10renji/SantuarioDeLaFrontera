document.addEventListener('DOMContentLoaded', () => {

    const btn = document.querySelector('.fa-circle-half-stroke');

    if (localStorage.getItem('theme') === 'dark')
        document.body.classList.add('dark-mode');

    btn.addEventListener('click', () => {

        document.body.classList.toggle('dark-mode');

        localStorage.setItem(
            'theme',
            document.body.classList.contains('dark-mode') ? 'dark' : 'light'
        );
    });
});