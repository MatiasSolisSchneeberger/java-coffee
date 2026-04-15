// 1. Agregamos "export" para que otro archivo pueda llamarla
export function toggleDropdown(elemento) {
    let contenido = elemento.nextElementSibling;
    contenido.classList.toggle("mostrar");
}

// 2. El código del window.onclick lo cambiamos ligeramente por un event listener 
// (Es mejor práctica en módulos y se ejecutará solito al importar el archivo)
window.addEventListener('click', function (evento) {
    if (!evento.target.closest('.dropdown-trigger-wrapper')) {
        let dropdowns = document.getElementsByClassName("dropdown-content");

        for (let i = 0; i < dropdowns.length; i++) {
            let menuAbierto = dropdowns[i];
            if (menuAbierto.classList.contains('mostrar')) {
                menuAbierto.classList.remove('mostrar');
            }
        }
    }
});