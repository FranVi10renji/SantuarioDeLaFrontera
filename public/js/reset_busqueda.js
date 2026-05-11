document.addEventListener('DOMContentLoaded', () => {
    
    const btnReset = document.getElementById('btn-reset');
    const inputBusqueda = document.getElementById('input-busqueda');
    const selectEspecie = document.getElementById('select-especie');

    if (btnReset) {
        btnReset.addEventListener('click', () => {
            inputBusqueda.value = "";
            selectEspecie.selectedIndex = 0;
            console.log("Formulario de búsqueda reseteado");
        });
    }
});