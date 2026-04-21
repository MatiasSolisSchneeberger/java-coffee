/**
 * Filtros sidebar — toggle en mobile
 * Añade/quita la clase `is-open` en el sidebar y actualiza el botón.
 */
export function initFiltrosToggle() {
    const btn     = document.getElementById('filtros-toggle');
    const sidebar = document.getElementById('filtros-sidebar');
    const label   = btn?.querySelector('.filtros-toggle-label');

    if (!btn || !sidebar) return;

    btn.addEventListener('click', () => {
        const isOpen = sidebar.classList.toggle('is-open');
        btn.setAttribute('aria-expanded', isOpen);
        btn.classList.toggle('is-open', isOpen);
        if (label) label.textContent = isOpen ? 'Ocultar filtros' : 'Mostrar filtros';
    });
}
