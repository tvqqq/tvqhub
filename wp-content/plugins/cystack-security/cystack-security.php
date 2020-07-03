<?php

/**
 * Plugin Name: CyStack Security
 * Plugin URI: https://cloud.cystack.net
 * Description: CyStack Security constantly monitors your websites and servers to detect security issues and vulnerabilities.
 * Version: 1.0.0
 * Author: CyStack
 * Author URI: https://cystack.net
 * License: GPL v3
 * Text Domain: cystack-plugin
 * Domain Path: /languages/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('ABSPATH')) {
	exit;
}

if (file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

if ( ! defined( 'CYSTACK_PLUGIN_PATH' ) ) {
	define( 'CYSTACK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'CYSTACK_PLUGIN_URL' ) ) {
	define( 'CYSTACK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'CYSTACK_PLUGIN_VERSION' ) ) {
	define( 'CYSTACK_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'CYSTACK_BASE_URL' ) ) {
	define( 'CYSTACK_BASE_URL', 'https://cloud.cystack.net' );
}

if ( ! defined( 'CYSTACK_BASE_ID_URL' ) ) {
	define( 'CYSTACK_BASE_ID_URL', 'https://id.cystack.net' );
}

/**
 * The code that runs during plugins activation
 */
function cystack_activate_plugin() {
	CyStack\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'cystack_activate_plugin' );
/**
 * The code that runs during plugins deactivation
 */
function cystack_deactivate_plugin() {
	CyStack\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'cystack_deactivate_plugin' );

CyStack\Init::register_services();

add_action( 'wp_head', 'cystack_add_meta_tag', 1 );
function cystack_add_meta_tag() {
	$meta_key = get_option( 'cystack_meta_key' );
	$meta_value = get_option( 'cystack_meta_value' );
	if ($meta_key && $meta_value) {
		echo '<meta name="' . $meta_key . '" content="' . $meta_value .'" />';
	}
}