/*
 * JavaScript para el módulo Debug Example
 * Archivo: custom-modules/debugexample/views/js/debug-example.js
 */

document.addEventListener('DOMContentLoaded', function () {

    // Función para mostrar información de debugging en consola
    function logDebugInfo() {
        console.group('🐛 Debug Example Module');
        console.log('Módulo de debugging cargado');
        console.log('Timestamp:', new Date().toISOString());
        console.log('URL actual:', window.location.href);
        console.log('User Agent:', navigator.userAgent);
        console.groupEnd();
    }

    // Detectar cuando se añade un producto al carrito
    function detectCartAdd() {
        // Buscar botones de "Añadir al carrito"
        const addToCartButtons = document.querySelectorAll('[data-button-action="add-to-cart"]');

        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function (e) {
                console.group('🛒 Producto añadido al carrito - Debug Info');
                console.log('Botón clickeado:', e.target);
                console.log('Datos del producto:', {
                    id: button.dataset.idProduct || 'No disponible',
                    cantidad: button.dataset.quantity || 'No disponible'
                });
                console.log('Momento:', new Date().toISOString());
                console.groupEnd();
            });
        });
    }

    // Función para mostrar información del contexto actual
    function showContextInfo() {
        const debugInfo = {
            controller: document.body.id || 'unknown',
            page: document.title,
            language: document.documentElement.lang || 'unknown',
            viewport: {
                width: window.innerWidth,
                height: window.innerHeight
            }
        };

        console.log('📄 Información del contexto:', debugInfo);
    }

    // Ejecutar funciones de debugging
    logDebugInfo();
    detectCartAdd();
    showContextInfo();

    // Crear panel de debugging flotante (solo si está habilitado el debug)
    if (document.querySelector('.debug-example-info')) {
        createFloatingDebugPanel();
    }
});

// Función para crear panel de debugging flotante
function createFloatingDebugPanel() {
    const panel = document.createElement('div');
    panel.id = 'debug-floating-panel';
    panel.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 20px;
        font-size: 12px;
        z-index: 9999;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        transition: all 0.3s ease;
    `;
    panel.innerHTML = '🐛 Debug Active';

    // Expandir panel al hacer click
    panel.addEventListener('click', function () {
        if (this.classList.contains('expanded')) {
            this.style.width = 'auto';
            this.style.height = 'auto';
            this.innerHTML = '🐛 Debug Active';
            this.classList.remove('expanded');
        } else {
            this.style.width = '250px';
            this.style.height = '150px';
            this.innerHTML = `
                <strong>🐛 Debug Info</strong><br>
                <small>
                Controller: ${document.body.id || 'unknown'}<br>
                Viewport: ${window.innerWidth}x${window.innerHeight}<br>
                Language: ${document.documentElement.lang || 'unknown'}<br>
                <br>
                <em>Click para minimizar</em>
                </small>
            `;
            this.classList.add('expanded');
        }
    });

    document.body.appendChild(panel);
}
