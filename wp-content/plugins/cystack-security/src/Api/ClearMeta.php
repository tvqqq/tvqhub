<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;
use CyStack\Api\Connection;
use CyStack\Api\Request;

class ClearMeta {
	/**
	 * Clear meta tag API constructor. Adds the ajax hooks.
	 */
	public function register() {
		add_action( 'wp_ajax_cystack_clear_meta_ajax', 'CyStack\Api\Middleware::validate_nonce', 1 );
		add_action( 'wp_ajax_cystack_clear_meta_ajax', 'CyStack\Api\Middleware::admin_only', 2 );
		add_action( 'wp_ajax_cystack_clear_meta_ajax', array( $this, 'run' ), 3 );
	}

	/**
	 * Clear meta tag API runner. It removes WordPress options.
	 */
	public function run() {

		Connection::clear_meta();

		Request::send_message( 'Success' );
	}
}