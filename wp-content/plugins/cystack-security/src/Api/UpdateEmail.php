<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;
use CyStack\Api\Connection;
use CyStack\Api\Request;

class UpdateEmail {
	/**
	 * Update email API constructor. Adds the ajax hooks.
	 */
	public function register() {
		add_action( 'wp_ajax_cystack_update_email_ajax', 'CyStack\Api\Middleware::validate_nonce', 1 );
		add_action( 'wp_ajax_cystack_update_email_ajax', 'CyStack\Api\Middleware::admin_only', 2 );
		add_action( 'wp_ajax_cystack_update_email_ajax', array( $this, 'run' ), 3 );
	}

	/**
	 * Update email API runner. It updates WordPress options.
	 */
	public function run() {
		$request_body  = file_get_contents( 'php://input' );
		$data          = json_decode( $request_body, true );
		$cs_user_email = $data['email'];

		if ( empty( $cs_user_email ) ) {
			Request::send_error( 'Invalid email in submission' );
		}

		Connection::update_email( $cs_user_email );

		Request::send_message( 'Success' );
	}
}