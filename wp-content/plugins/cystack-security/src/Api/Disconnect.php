<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;
use CyStack\Api\Connection;
use CyStack\Api\Request;

/**
 * Disconnection API, used to remove WordPress option.
 */
class Disconnect {
	/**
	 * Disconnection API constructor. Adds the ajax hooks.
	 */
	public function register() {
		add_action( 'wp_ajax_cystack_disconnect_ajax', 'CyStack\Api\Middleware::validate_nonce', 1 );
		add_action( 'wp_ajax_cystack_disconnect_ajax', 'CyStack\Api\Middleware::admin_only', 2 );
		add_action( 'wp_ajax_cystack_disconnect_ajax', array( $this, 'run' ), 3 );
	}

	/**
	 * Disconnection API runner. It removes WordPress options.
	 */
	public function run() {

		Connection::disconnect();

		Request::send_message( 'Success' );
	}
}