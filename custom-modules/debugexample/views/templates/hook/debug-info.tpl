<!--
    Template para mostrar información de debugging en el front office
    Archivo: custom-modules/debugexample/views/templates/hook/debug-info.tpl
-->

<div class="debug-example-info"
    style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; margin: 10px 0; border-radius: 5px;">
    <h4 style="color: #007bff; margin-top: 0;">🐛 Debug Info - Usuario Logueado</h4>
    <p><strong>¡Hola {$debug_customer_name}!</strong></p>

    <div class="debug-details"
        style="font-family: monospace; font-size: 12px; background: #e9ecef; padding: 10px; border-radius: 3px;">
        <strong>Información de Debugging:</strong><br>
        • ID Cliente: {$debug_info.customer_id}<br>
        • Cliente Logueado: {if $debug_info.customer_logged}Sí{else}No{/if}<br>
        • Productos en Carrito: {$debug_info.cart_products}<br>
        • Moneda: {$debug_info.currency_iso}<br>
        • URL Actual: {$debug_info.current_url}<br>
    </div>

    <p style="margin-bottom: 0; font-size: 11px; color: #6c757d;">
        <em>Esta información se muestra solo en modo desarrollo para practicar debugging.</em>
    </p>
</div>
