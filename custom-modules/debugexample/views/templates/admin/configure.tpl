<!--
    Template de configuración del módulo en el BackOffice
    Archivo: custom-modules/debugexample/views/templates/admin/configure.tpl
-->

<div class="panel">
    <div class="panel-heading">
        <i class="icon-cogs"></i>
        Configuración del Módulo Debug Example
    </div>

    <div class="panel-body">
        <form id="configuration_form" class="defaultForm form-horizontal" method="post">

            <div class="form-group">
                <label class="control-label col-lg-3">
                    Habilitar Debug
                </label>
                <div class="col-lg-9">
                    <span class="switch prestashop-switch fixed-width-lg">
                        <input type="radio" name="DEBUG_ENABLED" id="DEBUG_ENABLED_on" value="1"
                            {if $debug_enabled}checked="checked" {/if}>
                        <label for="DEBUG_ENABLED_on">Sí</label>
                        <input type="radio" name="DEBUG_ENABLED" id="DEBUG_ENABLED_off" value="0"
                            {if !$debug_enabled}checked="checked" {/if}>
                        <label for="DEBUG_ENABLED_off">No</label>
                        <a class="slide-button btn"></a>
                    </span>
                    <p class="help-block">Habilita o deshabilita la información de debugging en el front office</p>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" value="1" id="configuration_form_submit_btn" name="submitdebugexample"
                    class="btn btn-default pull-right">
                    <i class="process-icon-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Datos de Debugging Recientes -->
<div class="panel">
    <div class="panel-heading">
        <i class="icon-list"></i>
        Datos de Debugging Recientes
    </div>

    <div class="panel-body">
        {if $debug_data && count($debug_data) > 0}
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto ID</th>
                            <th>Datos Debug</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$debug_data item=row}
                            <tr>
                                <td>{$row.id_debug}</td>
                                <td>{$row.product_id}</td>
                                <td>
                                    <code style="font-size: 11px;">
                                        {$row.debug_data|truncate:100:"..."}
                                    </code>
                                </td>
                                <td>{$row.created_at}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {else}
            <div class="alert alert-info">
                <p>No hay datos de debugging disponibles. Los datos se generan cuando los usuarios añaden productos al
                    carrito.</p>
            </div>
        {/if}
    </div>
</div>

<!-- Información para Debugging -->
<div class="panel">
    <div class="panel-heading">
        <i class="icon-question"></i>
        Guía de Debugging
    </div>

    <div class="panel-body">
        <h4>🐛 Cómo usar este módulo para practicar debugging:</h4>

        <ol>
            <li><strong>Instala la extensión PHP Debug</strong> en VS Code</li>
            <li><strong>Presiona F5</strong> para iniciar el debugging</li>
            <li><strong>Coloca breakpoints</strong> en el archivo <code>debugexample.php</code></li>
            <li><strong>Interactúa con PrestaShop</strong>:
                <ul>
                    <li>Navega por el front office (hook displayTop)</li>
                    <li>Añade productos al carrito (hook actionProductAdd)</li>
                    <li>Visita páginas de producto (hook displayHeader)</li>
                </ul>
            </li>
            <li><strong>Inspecciona variables</strong> cuando se activen los breakpoints</li>
        </ol>

        <h4>📍 Puntos de Breakpoint sugeridos:</h4>
        <ul>
            <li><strong>Línea 38:</strong> Proceso de instalación</li>
            <li><strong>Línea 89:</strong> Creación de tabla SQL</li>
            <li><strong>Línea 123:</strong> Hook displayHeader - información de controlador</li>
            <li><strong>Línea 141:</strong> Hook displayTop - datos del contexto</li>
            <li><strong>Línea 162:</strong> Hook actionProductAdd - datos del producto</li>
            <li><strong>Línea 264:</strong> Configuración del módulo</li>
        </ul>

        <div class="alert alert-warning">
            <h4>⚠️ Importante:</h4>
            <p>Este módulo está diseñado exclusivamente para fines educativos y debugging. No usar en producción.</p>
        </div>
    </div>
</div>
