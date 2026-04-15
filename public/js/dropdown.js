export function toggleDropdown(elemento) {
    let contenido = elemento.nextElementSibling;

    // Alternamos mostrar el menú
    contenido.classList.toggle("mostrar");

    // NUEVO: Alternamos un estado "abierto" en el botón para las animaciones
    elemento.classList.toggle("abierto");
}

window.addEventListener('click', function (evento) {
    if (!evento.target.closest('.dropdown-trigger-wrapper')) {
        // Buscamos todos los menús y botones que estén abiertos
        let menusAbiertos = document.querySelectorAll(".dropdown-content.mostrar");
        let botonesAbiertos = document.querySelectorAll(".dropdown-trigger-wrapper.abierto");

        // Los cerramos todos
        menusAbiertos.forEach(menu => menu.classList.remove('mostrar'));
        botonesAbiertos.forEach(boton => boton.classList.remove('abierto'));
    }
});