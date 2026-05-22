// dropdown
import { toggleDropdown } from './dropdown.js';
window.toggleDropdown = toggleDropdown;

// catalogo
import { initFiltrosToggle } from './catalogo.js';
document.addEventListener('DOMContentLoaded', initFiltrosToggle);

// cliente dashboard
import { initClienteDashboard } from './cliente.js';
document.addEventListener('DOMContentLoaded', initClienteDashboard);