<?php
/**
 * Módulo de ejemplo para demostrar debugging con Xdebug
 * Plan de Formación PrestaShop 1.7.8.x
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class DebugExample extends Module
{
    public function __construct()
    {
        $this->name = 'debugexample';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Formación PrestaShop';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Debug Example');
        $this->description = $this->l('Módulo de ejemplo para practicar debugging con Xdebug');

        $this->confirmUninstall = $this->l('¿Estás seguro de que quieres desinstalar este módulo?');
    }

    /**
     * Instalación del módulo
     */
    public function install()
    {
        // PUNTO DE BREAKPOINT 1: Coloca un breakpoint aquí para ver el proceso de instalación
        $install_result = parent::install();

        if (!$install_result) {
            return false;
        }

        // Registrar hooks
        $hooks = [
            'displayHeader',
            'displayTop',
            'actionProductAdd'
        ];

        foreach ($hooks as $hook) {
            if (!$this->registerHook($hook)) {
                return false;
            }
        }

        // Crear tabla personalizada para ejemplos
        $this->createCustomTable();

        return true;
    }

    /**
     * Desinstalación del módulo
     */
    public function uninstall()
    {
        // PUNTO DE BREAKPOINT 2: Debugging del proceso de desinstalación
        $this->dropCustomTable();

        return parent::uninstall();
    }

    /**
     * Crear tabla personalizada para ejemplos
     */
    private function createCustomTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'debug_example` (
            `id_debug` int(11) NOT NULL AUTO_INCREMENT,
            `product_id` int(11) NOT NULL,
            `debug_data` TEXT,
            `created_at` DATETIME NOT NULL,
            PRIMARY KEY (`id_debug`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        // PUNTO DE BREAKPOINT 3: Inspecciona la query SQL antes de ejecutarla
        $result = Db::getInstance()->execute($sql);

        if (!$result) {
            // PUNTO DE BREAKPOINT 4: Debugging de errores SQL
            $error = Db::getInstance()->getMsgError();
            PrestaShopLogger::addLog(
                'DebugExample: Error creating table - ' . $error,
                3,
                null,
                'DebugExample'
            );
        }

        return $result;
    }

    /**
     * Eliminar tabla personalizada
     */
    private function dropCustomTable()
    {
        $sql = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'debug_example`';
        return Db::getInstance()->execute($sql);
    }

    /**
     * Hook: displayHeader
     * Agregar CSS/JS personalizado
     */
    public function hookDisplayHeader()
    {
        // PUNTO DE BREAKPOINT 5: Ver qué página está cargando este hook
        $controller = $this->context->controller;
        $page_name = get_class($controller);

        // Solo cargar en páginas de producto
        if ($page_name === 'ProductController') {
            $this->context->controller->addCSS($this->_path . 'views/css/debug-example.css');
            $this->context->controller->addJS($this->_path . 'views/js/debug-example.js');
        }
    }

    /**
     * Hook: displayTop
     * Mostrar mensaje en la parte superior
     */
    public function hookDisplayTop()
    {
        // 🔴 BREAKPOINT FÁCIL - Línea 126: Se ejecuta en TODAS las páginas
        $customer = $this->context->customer;
        $cart = $this->context->cart;
        $currency = $this->context->currency;

        // 🔴 BREAKPOINT FÁCIL - Línea 131: Inspecciona estos datos
        $debug_info = [
            'customer_id' => $customer->id,
            'customer_logged' => $customer->isLogged(),
            'cart_products' => count($cart->getProducts()),
            'currency_iso' => $currency->iso_code,
            'current_url' => $this->context->link->getPageLink('index')
        ];

        // 🔴 BREAKPOINT FÁCIL - Línea 140: Ve si el usuario está logueado
        if ($customer->isLogged()) {
            $this->context->smarty->assign([
                'debug_customer_name' => $customer->firstname . ' ' . $customer->lastname,
                'debug_info' => $debug_info
            ]);

            return $this->display(__FILE__, 'debug-info.tpl');
        }

        return '';
    }

    /**
     * Hook: actionProductAdd
     * Se ejecuta cuando se añade un producto al carrito
     */
    public function hookActionProductAdd($params)
    {
        // PUNTO DE BREAKPOINT 8: Ver datos del producto añadido
        $product = $params['product'];
        $cart = $params['cart'];
        $quantity = $params['quantity'];

        // Logging para debugging
        $debug_data = [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity_added' => $quantity,
            'cart_total' => $cart->getOrderTotal(),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        // PUNTO DE BREAKPOINT 9: Inspecciona antes de guardar en BD
        $this->saveDebugData($product->id, json_encode($debug_data));

        // Log personalizado
        PrestaShopLogger::addLog(
            'DebugExample: Product added to cart - ' . json_encode($debug_data),
            1,
            null,
            'DebugExample'
        );
    }

    /**
     * Guardar datos de debugging en la base de datos
     */
    private function saveDebugData($product_id, $debug_data)
    {
        $sql = 'INSERT INTO `' . _DB_PREFIX_ . 'debug_example`
                (product_id, debug_data, created_at)
                VALUES (' . (int)$product_id . ', "' . pSQL($debug_data) . '", NOW())';

        // PUNTO DE BREAKPOINT 10: Ver la query final antes de ejecutar
        return Db::getInstance()->execute($sql);
    }

    /**
     * Método para obtener datos de debugging (para BackOffice)
     */
    public function getDebugData($limit = 10)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'debug_example`
                ORDER BY created_at DESC
                LIMIT ' . (int)$limit;

        // PUNTO DE BREAKPOINT 11: Debugging de consultas SELECT
        $results = Db::getInstance()->executeS($sql);

        return $results;
    }

    /**
     * Página de configuración del módulo
     */
    public function getContent()
    {
        $output = '';

        // PUNTO DE BREAKPOINT 12: Ver si se envió el formulario
        if (Tools::isSubmit('submit' . $this->name)) {
            $debug_enabled = Tools::getValue('DEBUG_ENABLED');

            // PUNTO DE BREAKPOINT 13: Ver el valor recibido del formulario
            Configuration::updateValue('DEBUG_EXAMPLE_ENABLED', $debug_enabled);

            $output .= $this->displayConfirmation($this->l('Configuración guardada'));
        }

        return $output . $this->displayForm();
    }

    /**
     * Formulario de configuración
     */
    public function displayForm()
    {
        // Obtener datos de debugging recientes
        $debug_data = $this->getDebugData(5);

        // PUNTO DE BREAKPOINT 14: Ver datos obtenidos de la BD
        $this->context->smarty->assign([
            'debug_data' => $debug_data,
            'module_dir' => $this->_path,
            'debug_enabled' => Configuration::get('DEBUG_EXAMPLE_ENABLED')
        ]);

        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }
}
