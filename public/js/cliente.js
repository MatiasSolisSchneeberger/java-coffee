/**
 * Lógica interactiva del panel de control del cliente.
 * Maneja el cambio de pestañas (tabs), persistencia del hash en la URL y el colapso de las consultas.
 */

export function initClienteDashboard() {
    const navButtons = document.querySelectorAll('.dashboard-nav-btn');
    const tabContents = document.querySelectorAll('.dashboard-tab-content');
    const queryHeaders = document.querySelectorAll('.consulta-card-header');

    console.log("[Java Coffee] initClienteDashboard: Se encontraron", navButtons.length, "botones de navegación y", tabContents.length, "pestañas.");

    // Si no estamos en la página del dashboard, salimos temprano
    if (navButtons.length === 0) return;

    /**
     * Cambia a una pestaña específica
     * @param {string} tabId - El ID de la pestaña (ej: 'resumen', 'pedidos', 'favoritos', 'perfil', 'comentarios')
     */
    function switchTab(tabId) {
        console.log("[Java Coffee] Cambiando a la pestaña:", tabId);
        let tabFound = false;

        // Alterna el contenido activo de las pestañas
        tabContents.forEach(content => {
            if (content.id === `tab-${tabId}`) {
                content.classList.add('active');
                tabFound = true;
            } else {
                content.classList.remove('active');
            }
        });

        if (!tabFound) return;

        // Alterna la clase activa en los botones de navegación
        navButtons.forEach(btn => {
            if (btn.getAttribute('data-tab') === tabId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Sincroniza con el hash de la URL sin recargar la página entera
        if (window.location.hash !== `#${tabId}`) {
            history.pushState(null, null, `#${tabId}`);
        }
    }

    // Vincula los eventos de click a los botones de navegación
    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Hace disponible switchTab de forma global para que se pueda usar desde botones en línea
    window.switchTab = switchTab;

    // Carga la pestaña activa desde el hash de la URL si existe
    const initialHash = window.location.hash.substring(1);
    const validTabs = ['resumen', 'pedidos', 'favoritos', 'consultas', 'perfil', 'comentarios'];
    if (initialHash && validTabs.includes(initialHash)) {
        switchTab(initialHash);
    } else {
        switchTab('resumen');
    }

    // Maneja los eventos de cambio de hash (por ejemplo, al volver atrás en el navegador)
    window.addEventListener('hashchange', () => {
        const currentHash = window.location.hash.substring(1);
        if (currentHash && validTabs.includes(currentHash)) {
            switchTab(currentHash);
        }
    });

    // Lógica para contraer y desplegar las consultas
    queryHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const card = header.closest('.consulta-card');
            if (card) {
                card.classList.toggle('open');
            }
        });
    });
}
