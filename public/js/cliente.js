/**
 * Client Dashboard Interactive Logic
 * Controls tab switching, URL hash persistence, and collapsible queries.
 */

export function initClienteDashboard() {
    const navButtons = document.querySelectorAll('.dashboard-nav-btn');
    const tabContents = document.querySelectorAll('.dashboard-tab-content');
    const queryHeaders = document.querySelectorAll('.consulta-card-header');

    // Return early if we are not on the dashboard page
    if (navButtons.length === 0) return;

    /**
     * Switch to a specific tab
     * @param {string} tabId - The ID of the tab (e.g. 'resumen', 'pedidos', 'favoritos', 'perfil')
     */
    function switchTab(tabId) {
        let tabFound = false;

        // Toggle active tab content
        tabContents.forEach(content => {
            if (content.id === `tab-${tabId}`) {
                content.classList.add('active');
                tabFound = true;
            } else {
                content.classList.remove('active');
            }
        });

        if (!tabFound) return;

        // Toggle active nav button
        navButtons.forEach(btn => {
            if (btn.getAttribute('data-tab') === tabId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Sync with hash without triggering page reload
        if (window.location.hash !== `#${tabId}`) {
            history.pushState(null, null, `#${tabId}`);
        }
    }

    // Attach click handlers to navigation buttons
    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Make switchTab available globally so inline triggers (like buttons) can use it
    window.switchTab = switchTab;

    // Load active tab from URL hash if present
    const initialHash = window.location.hash.substring(1);
    const validTabs = ['resumen', 'pedidos', 'favoritos', 'consultas', 'perfil'];
    if (initialHash && validTabs.includes(initialHash)) {
        switchTab(initialHash);
    } else {
        switchTab('resumen');
    }

    // Handle hash change events (e.g. back button)
    window.addEventListener('hashchange', () => {
        const currentHash = window.location.hash.substring(1);
        if (currentHash && validTabs.includes(currentHash)) {
            switchTab(currentHash);
        }
    });

    // Collapsible Queries toggle logic
    queryHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const card = header.closest('.consulta-card');
            if (card) {
                card.classList.toggle('open');
            }
        });
    });
}
