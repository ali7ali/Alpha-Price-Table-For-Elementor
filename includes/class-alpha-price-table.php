<?php

namespace Elementor_Alpha_Price_Table_Addon;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Alpha_Price_Table_For_Elementor class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Alpha_Price_Table_For_Elementor
{

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     * @var string Minimum Elementor version required to run the addon.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.21.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the addon.
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     * @var Alpha_Price_Table_For_Elementor The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     * @return Alpha_Price_Table_For_Elementor An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Perform some compatibility checks to make sure basic requirements are met.
     * If all compatibility checks pass, initialize the functionality.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {
        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirements.
     *
     * @since 1.0.0
     * @access public
     * @return bool True if compatible, false otherwise.
     */
    public function is_compatible()
    {
        // Check for required Elementor version.
        if (! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version.
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

    /**
     * Initialize the plugin.
     *
     * Loads translations, enqueues styles, and registers widgets.
     *
     * @since 1.0.0
     * @access public
     */
    public function init()
    {
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'frontend_styles']);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    /**
     * Admin notice for minimum Elementor version.
     *
     * Displays an admin notice if Elementor's version is below the required minimum.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {
        if (! current_user_can('update_plugins')) {
            return;
        }

        $upgrade_url = wp_nonce_url(self_admin_url('update-core.php'), 'upgrade-core');

        echo '<div class="notice notice-warning is-dismissible"><p>' . sprintf(
            /* translators: 1: Plugin name, 2: Required Elementor version */
            esc_html__('%1$s requires Elementor version %2$s or greater.', 'alpha-price-table-for-elementor'),
            '<strong>' . esc_html__('Alpha Price Table for Elementor', 'alpha-price-table-for-elementor') . '</strong>',
            esc_html(self::MINIMUM_ELEMENTOR_VERSION)
        ) . '</p><p><a href="' . esc_url($upgrade_url) . '" class="button-primary">' . esc_html__('Update Elementor', 'alpha-price-table-for-elementor') . '</a></p></div>';
    }

    /**
     * Admin notice for minimum PHP version.
     *
     * Displays an admin notice if the PHP version is below the required minimum.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {
        if (! current_user_can('update_core')) {
            return;
        }

        echo '<div class="notice notice-warning is-dismissible"><p>' . sprintf(
            /* translators: 1: Plugin name, 2: Required PHP version */
            esc_html__('%1$s requires PHP version %2$s or greater.', 'alpha-price-table-for-elementor'),
            '<strong>' . esc_html__('Alpha Price Table for Elementor', 'alpha-price-table-for-elementor') . '</strong>',
            esc_html(self::MINIMUM_PHP_VERSION)
        ) . '</p></div>';
    }

    /**
     * Enqueue frontend styles.
     *
     * Enqueues the necessary CSS files for the widget.
     *
     * @since 1.0.0
     * @access public
     */
    public function frontend_styles()
    {
        wp_enqueue_style(
            'alpha-pricetable-widget',
            ALPHAPRICETABLE_ASSETS_URL . 'css/alpha-pricetable-widget.css',
            [],
            ALPHAPRICETABLE_VERSION
        );
    }

    /**
     * Register Widgets
     *
     * Includes the widget files and registers the widget with Elementor.
     *
     * Fired by `elementor/widgets/register` action hook.
     *
     * @since 1.0.0
     * @access public
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets($widgets_manager)
    {
        // Include Widget files.
        require_once ALPHAPRICETABLE_INCLUDES_PATH . 'class-alpha-price-table-widget.php';

        // Register widget.
        $widgets_manager->register(new Alpha_Price_Table_Widget());
    }
}
