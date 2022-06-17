<?php
/**
 * Plugin Name: Alpha Price Table For Elementor
 * Description: Premium Price Table for WordPress.
 * Author:      Ali Ali
 * Author URI:  https://github.com/Ali7Ali
 * Version:     1.0.1
 * Text Domain: alpha-price-table-for-elementor
 * License: GPLv3
 * 
 * WC tested up to: 6.4.1
 * Elementor tested up to: 3.6.4
 * Elementor Pro tested up to: 3.6.5
*/

/* Copyright 2021 Ali Ali (email : ali.abdalhadi.ali@gmail.com) 
   
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ALPHAPRICETABLE_VERSION', '1.0.1' );
define( 'ALPHAPRICETABLE_ADDONS_PL_ROOT', __FILE__ );
define( 'ALPHAPRICETABLE_PL_URL', plugins_url( '/', ALPHAPRICETABLE_ADDONS_PL_ROOT ) );
define( 'ALPHAPRICETABLE_PL_PATH', plugin_dir_path( ALPHAPRICETABLE_ADDONS_PL_ROOT ) );
define( 'ALPHAPRICETABLE_PL_ASSETS', trailingslashit( ALPHAPRICETABLE_PL_URL.'assets' ) );
define( 'ALPHAPRICETABLE_PL_INCLUDE', trailingslashit( ALPHAPRICETABLE_PL_PATH .'include' ));
define( 'ALPHAPRICETABLE_PLUGIN_BASE', plugin_basename( ALPHAPRICETABLE_ADDONS_PL_ROOT ) );
// Required File
include( ALPHAPRICETABLE_PL_INCLUDE.'/alpha-pricetable.php' );
