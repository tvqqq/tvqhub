<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;

/**
 * Contains all the middleware functions for AJAX Api's
 */
class Middleware {
	/**
	 * Middleware used to validate the nonce passed with the request body.
	 * The nonce has to be passed as a `_ajax_nonce` query parameter, and it will be checked against the `cystack-ajax` nonce.
	 */
	public static function validate_nonce() {
		$valid = check_ajax_referer( 'cystack-ajax', false, false );
		if ( ! $valid ) {
			wp_die( '{ "error": "CSRF token missing or invalid" }', 403 );
		}
	}

	/**
	 * Middleware that only allows admin.
	 */
	public static function admin_only() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( '{ "error": "Insufficient permissions" }', '', 403 );
		}
	}
}