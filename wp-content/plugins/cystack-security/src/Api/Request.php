<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;

/**
 * Static class containing methods used on ajax requests handling.
 */
class Request {
	/**
	 * Send JSON response with message.
	 *
	 * @param Array  $body response to send as JSON.
	 * @param Number $code http code to return.
	 */
	public static function send( $body, $code ) {
		wp_die( json_encode( $body ), '', intval( $code ) );
	}

	/**
	 * Send error response with message
	 *
	 * @param String $error Message to be sent on te JSON.
	 */
	public static function send_error( $error ) {
		self::send(
			array(
				'error' => $error,
			),
			400
		);
	}

	/**
	 * Send JSON response with a message key.
	 *
	 * @param String $message Message to be sent on te JSON.
	 */
	public static function send_message( $message ) {
		self::send(
			array(
				'message' => $message,
			),
			200
		);
	}
}