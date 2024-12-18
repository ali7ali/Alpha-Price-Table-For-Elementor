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
     * @var   string Minimum Elementor version required to run the addon.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.21.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var   string Minimum PHP version required to run the addon.
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instance
     *
     * @since  1.0.0
     * @access private
     * @static
     * @var    Alpha_Price_Table_For_Elementor|null The single instance of the class.
     */
    private static ?Alpha_Price_Table_For_Elementor $_instance = null;

    /**
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since  1.0.0
     * @access public
     * @static
     * @return Alpha_Price_Table_For_Elementor An instance of the class.
     */
    public static function instance(): Alpha_Price_Table_For_Elementor
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Perform compatibility checks and initialize functionality if all checks pass.
     *
     * @since  1.0.0
     * @access private
     */
    private function __construct()
    {
        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    /**
     * Compatibility Checks
     *
     * Verifies the site meets the addon's requirements.
     *
     * @since  1.0.0
     * @access private
     * @return bool True if compatible, false otherwise.
     */
    private function is_compatible(): bool
    {
        // Check for required Elementor version.
        if (!defined('ELEMENTOR_VERSION') || !version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
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
     * @since  1.0.0
     * @access public
     */
    public function init(): void
    {
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'frontend_styles']);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    /**
     * Displays an admin notice if the Elementor version is below the required minimum.
     *
     * @since  1.0.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version(): void
    {
        if (!current_user_can('update_plugins')) {
            return;
        }

        $upgrade_url = wp_nonce_url(self_admin_url('update-core.php'), 'upgrade-core');

        $message = sprintf(
        /* translators: 1: Plugin name, 2: Required Elementor version */
            __('%1$s requires Elementor version %2$s or greater.', 'alpha-price-table-for-elementor'),
            '<strong>' . __('Alpha Price Table for Elementor', 'alpha-price-table-for-elementor') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        $button = sprintf(
            '<a href="%s" class="button-primary">%s</a>',
            esc_url($upgrade_url),
            esc_html__('Update Elementor', 'alpha-price-table-for-elementor')
        );

        $allowed_html = [
            'strong' => [],
            'p' => [],
            'a' => [
                'href' => [],
                'class' => [],
            ],
            'div' => [
                'class' => [],
            ],
        ];

        printf(
            '<div class="notice notice-warning is-dismissible">%s</div>',
            wp_kses('<p>' . $message . '</p><p>' . $button . '</p>', $allowed_html)
        );
    }


    /**
     * Displays an admin notice if the PHP version is below the required minimum.
     *
     * @since  1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version(): void
    {
        if (!current_user_can('update_core')) {
            return;
        }

        $message = sprintf(
        /* translators: 1: Plugin name, 2: Required PHP version */
            __('%1$s requires PHP version %2$s or greater.', 'alpha-price-table-for-elementor'),
            '<strong>' . __('Alpha Price Table for Elementor', 'alpha-price-table-for-elementor') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        $allowed_html = [
            'strong' => [],
            'p' => [],
            'div' => [
                'class' => [],
            ],
        ];

        printf(
            '<div class="notice notice-warning is-dismissible">%s</div>',
            wp_kses('<p>' . $message . '</p>', $allowed_html)
        );
    }


    /**
     * Enqueues the necessary CSS files for the widget.
     *
     * @since  1.0.0
     * @access public
     */
    public function frontend_styles(): void
    {
        wp_enqueue_style(
            'alpha-pricetable-widget',
            ALPHAPRICETABLE_ASSETS_URL . 'css/alpha-pricetable-widget.css',
            [],
            ALPHAPRICETABLE_VERSION
        );
    }

    /**
     * Registers the widget with Elementor.
     *
     * @since  1.0.0
     * @access public
     * @param  \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets(\Elementor\Widgets_Manager $widgets_manager): void
    {
        include_once ALPHAPRICETABLE_INCLUDES_PATH . 'class-alpha-price-table-widget.php';
        $widgets_manager->register(new Alpha_Price_Table_Widget());
    }
}
