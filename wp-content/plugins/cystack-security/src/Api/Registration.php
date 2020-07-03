<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;
use CyStack\Api\Connection;
use CyStack\Api\Request;

/**
 * Registration API, used to store the target id and the info as a WordPress option.
 */
class Registration {
	/**
	 * Registration API constructor. Adds the ajax hooks.
	 */
	public function register() {
		add_action( 'wp_ajax_cystack_registration_ajax', 'CyStack\Api\Middleware::validate_nonce', 1 );
		add_action( 'wp_ajax_cystack_registration_ajax', 'CyStack\Api\Middleware::admin_only', 2 );
		add_action( 'wp_ajax_cystack_registration_ajax', array( $this, 'run' ), 3 );
	}

	/**
	 * Registration API runner. It validates the target id and domain and stores them as WordPress options.
	 */
	public function run() {
		$request_body  = file_get_contents( 'php://input' );
		$data          = json_decode( $request_body, true );
		$target_id     = $data['id'];
		$target_name   = $data['name'];
		$target_address = $data['address'];
		$cs_user_email = $data['email'];
		$meta_key = $data['meta_key'];
		$meta_value = $data['meta_value'];

		if ( empty( $target_id ) ) {
			Request::send_error( 'Registration missing required fields' );
		}

		if ( empty( $target_address ) ) {
			Request::send_error( 'Invalid domain in submission' );
		}

		Connection::connect( $target_id, $target_name, $target_address, $cs_user_email, $meta_key, $meta_value );

		Request::send_message( 'Success' );
	}
}