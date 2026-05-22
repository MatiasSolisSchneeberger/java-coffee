// dropdown
import { toggleDropdown } from './dropdown.js';
window.toggleDropdown = toggleDropdown;

// catalogo
import { initFiltrosToggle } from './catalogo.js';
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFiltrosToggle);
} else {
    initFiltrosToggle();
}

// cliente dashboard
import { initClienteDashboard } from './cliente.js';
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initClienteDashboard);
} else {
    initClienteDashboard();
}