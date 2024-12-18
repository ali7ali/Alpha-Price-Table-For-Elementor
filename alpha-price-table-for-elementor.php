<?php

/**
 * Plugin Name: Alpha Price Table For Elementor
 * Plugin URI:  https://ali-ali.org/
 * Description: Premium Price Table for WordPress.
 * Version:     1.0.8
 * Author:      Ali Ali
 * Author URI:  https://github.com/Ali7Ali
 * Text Domain: alpha-price-table-for-elementor
 * Domain Path: /languages
 * License:     GPLv3
 */

/*
Copyright 2021 Ali Ali

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License version 3 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License version 3 for more details.

You should have received a copy of the GNU General Public License version 3
along with this program. If not, see <https://www.gnu.org/licenses/>.
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('ALPHAPRICETABLE_VERSION', '1.0.8');
define('ALPHAPRICETABLE_PLUGIN_FILE', __FILE__);
define('ALPHAPRICETABLE_PLUGIN_URL', plugin_dir_url(ALPHAPRICETABLE_PLUGIN_FILE));
define('ALPHAPRICETABLE_PLUGIN_PATH', plugin_dir_path(ALPHAPRICETABLE_PLUGIN_FILE));
define('ALPHAPRICETABLE_ASSETS_URL', trailingslashit(ALPHAPRICETABLE_PLUGIN_URL . 'assets'));
define('ALPHAPRICETABLE_INCLUDES_PATH', trailingslashit(ALPHAPRICETABLE_PLUGIN_PATH . 'includes'));
define('ALPHAPRICETABLE_LANGUAGES_PATH', trailingslashit(ALPHAPRICETABLE_PLUGIN_PATH . 'languages'));
define('ALPHAPRICETABLE_PLUGIN_BASENAME', plugin_basename(ALPHAPRICETABLE_PLUGIN_FILE));

/**
 * Initialize the Alpha Price Table plugin.
 *
 * Loads the main plugin class and initializes the plugin.
 *
 * @since 1.0.6
 */
function alpha_price_table_addon_init()
{
    // Check if Elementor is installed and activated.
    if (! did_action('elementor/loaded')) {
        add_action('admin_notices', 'alpha_price_table_missing_elementor_notice');
        return;
    }

    // Load plugin text domain for translations.
    load_plugin_textdomain('alpha-price-table-for-elementor', false, ALPHAPRICETABLE_PLUGIN_BASENAME . '/languages');

    // Include the main plugin class.
    include_once ALPHAPRICETABLE_INCLUDES_PATH . 'class-alpha-price-table.php';

    // Initialize the plugin.
    \Elementor_Alpha_Price_Table_Addon\Alpha_Price_Table_For_Elementor::instance();
}
add_action('plugins_loaded', 'alpha_price_table_addon_init');



/**
 * Display an admin notice if Elementor is not installed or activated.
 *
 * @since 1.0.6
 */
function alpha_price_table_missing_elementor_notice()
{
    if (!current_user_can('activate_plugins')) {
        return;
    }

    $plugin = 'elementor/elementor.php';
    $is_elementor_installed = file_exists(WP_PLUGIN_DIR . '/' . $plugin);

    if ($is_elementor_installed) {
        $action_url = wp_nonce_url(
            self_admin_url('plugins.php?action=activate&plugin=' . $plugin),
            'activate-plugin_' . $plugin
        );
        $action_text = __('Activate Elementor Now', 'alpha-price-table-for-elementor');
        /* translators: %1$s: Plugin name, %2$s: Action link */
        $message_template = __('%1$s requires Elementor to be activated. %2$s', 'alpha-price-table-for-elementor');
    } else {
        $action_url = wp_nonce_url(
            self_admin_url('update.php?action=install-plugin&plugin=elementor'),
            'install-plugin_elementor'
        );
        $action_text = __('Install Elementor Now', 'alpha-price-table-for-elementor');
        /* translators: %1$s: Plugin name, %2$s: Action link */
        $message_template = __('%1$s requires Elementor to be installed and activated. %2$s', 'alpha-price-table-for-elementor');
    }

    // Safely construct the plugin name and action link.
    $plugin_name = '<strong>' . esc_html__('Alpha Price Table For Elementor', 'alpha-price-table-for-elementor') . '</strong>';
    $action_link = '<a href="' . esc_url($action_url) . '" class="button-primary">' . esc_html($action_text) . '</a>';

    // Combine message template with placeholders.
    $message = sprintf(
        $message_template,
        $plugin_name,
        $action_link
    );

    // Output the notice with the allowed HTML tags.
    $allowed_html = [
        'strong' => [],
        'a' => [
            'href' => [],
            'class' => [],
        ],
        'div' => [
            'class' => [],
        ],
        'p' => [],
    ];

    printf(
        '<div class="notice notice-warning is-dismissible">%s</div>',
        wp_kses('<p>' . $message . '</p>', $allowed_html)
    );
}

