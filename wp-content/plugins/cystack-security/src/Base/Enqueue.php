<?php
/**
 * @package CyStackSecurity
 */

namespace CyStack\Base;
use CyStack\Base\AdminConstants;

class Enqueue
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );
	}

	function enqueue() {
		wp_register_style( 'cystack-css', CYSTACK_PLUGIN_URL .  'assets/cystack.css', array(), CYSTACK_PLUGIN_VERSION );
		wp_enqueue_style('cystack-css');
	}

	public static function enqueue_bridge_assets() {
		wp_register_script( 'cystack-js', CYSTACK_PLUGIN_URL .  'js/dist/cystack.js', array('jquery'), CYSTACK_PLUGIN_VERSION, true );
		wp_localize_script( 'cystack-js', 'cystackConfig', AdminConstants::get_cystack_config() );
		wp_register_style(  'cystack-bridge-css', CYSTACK_PLUGIN_URL . 'assets/cystack-bridge.css', array(), CYSTACK_PLUGIN_VERSION );
		wp_enqueue_style( 'cystack-bridge-css' );
		wp_enqueue_script('cystack-js');
	}
}