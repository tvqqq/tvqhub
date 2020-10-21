<?php

class ITSEC_Lib_REST {
	const LINK_REL = 'https://s.api.ithemes.com/l/ithemes-security/';
	const DATE_FORMAT = 'Y-m-d\TH:i:sP';

	/**
	 * Get the URI for an iThemes Security link relation.
	 *
	 * @param string $relation
	 *
	 * @return string
	 */
	public static function get_link_relation( $relation ) {
		return self::LINK_REL . $relation;
	}

	/**
	 * Converts an error to a response object.
	 *
	 * This iterates over all error codes and messages to change it into a flat
	 * array. This enables simpler client behaviour, as it is represented as a
	 * list in JSON rather than an object/map.
	 *
	 * {@see WP_REST_Server::error_to_response()}
	 *
	 * @param WP_Error $error WP_Error instance.
	 *
	 * @return WP_REST_Response List of associative arrays with code and message keys.
	 */
	public static function error_to_response( WP_Error $error ) {
		$error_data = $error->get_error_data();

		if ( is_array( $error_data ) && isset( $error_data['status'] ) ) {
			$status = $error_data['status'];
		} else {
			$status = 500;
		}

		$errors = array();

		foreach ( (array) $error->errors as $code => $messages ) {
			foreach ( (array) $messages as $message ) {
				$errors[] = array(
					'code'    => $code,
					'message' => $message,
					'data'    => $error->get_error_data( $code ),
				);
			}
		}

		$data = $errors[0];
		if ( count( $errors ) > 1 ) {
			// Remove the primary error.
			array_shift( $errors );
			$data['additional_errors'] = $errors;
		}

		return new WP_REST_Response( $data, $status );
	}

	/**
	 * Get the status code to send from the list of statuses.
	 *
	 * @param int ...$statuses
	 *
	 * @return int
	 */
	public static function get_status( ...$statuses ) {
		if ( ! $statuses ) {
			return 200;
		}

		$prev = $statuses[0];

		foreach ( $statuses as $status ) {
			if ( $prev !== $status ) {
				return WP_Http::MULTI_STATUS;
			}

			$prev = $status;
		}

		return $prev;
	}

	/**
	 * Gets a Bearer token from the Authorization header.
	 *
	 * @param string $header
	 *
	 * @return string
	 */
	public static function get_token_from_auth_header( $header ) {
		$prefix = 'Bearer ';

		if ( 0 !== strpos( $header, $prefix ) ) {
			return '';
		}

		return trim( substr( $header, strlen( $prefix ) ) );
	}

	/**
	 * Gets the authorization status code to use.
	 *
	 * @param WP_User|null $user
	 *
	 * @return int
	 */
	public static function auth_code_required( $user = null ) {
		if ( func_num_args() === 0 ) {
			return rest_authorization_required_code();
		}

		return $user instanceof WP_User && $user->exists() ? 403 : 401;
	}

	/**
	 * Validates an IP address.
	 *
	 * @param string          $ip      The IP address.
	 * @param WP_REST_Request $request The request object.
	 * @param string          $param   The parameter name.
	 *
	 * @return true|WP_Error
	 */
	public static function validate_ip( $ip, $request, $param ) {
		if ( ! is_string( $ip ) || ! ITSEC_Lib_IP_Tools::ip_wild_to_ip_cidr( $ip ) ) {
			/* translators: %s: Parameter name. */
			return new WP_Error( 'rest_invalid_param', sprintf( __( '%s is not a valid IP address.' ), $param ) );
		}

		return true;
	}

	/**
	 * Sanitizes an IP address.
	 *
	 * @param string $ip The IP address.
	 *
	 * @return string|false
	 */
	public static function sanitize_ip( $ip ) {
		return ITSEC_Lib_IP_Tools::ip_wild_to_ip_cidr( $ip );
	}

	/**
	 * Retrieves an array of endpoint arguments from the item schema for the controller.
	 *
	 * @param array  $schema The JSON schema to use.
	 * @param string $method Optional. HTTP method of the request. The arguments for `CREATABLE` requests are
	 *                       checked for required values and may fall-back to a given default, this is not done
	 *                       on `EDITABLE` requests. Default WP_REST_Server::CREATABLE.
	 *
	 * @return array Endpoint arguments.
	 */
	public static function get_endpoint_args_for_schema( $schema, $method = WP_REST_Server::CREATABLE ) {
		$schema_properties       = ! empty( $schema['properties'] ) ? $schema['properties'] : array();
		$endpoint_args           = array();
		$valid_schema_properties = array(
			'title',
			'description',
			'type',
			'format',
			'enum',
			'items',
			'properties',
			'additionalProperties',
			'minimum',
			'maximum',
			'exclusiveMinimum',
			'exclusiveMaximum',
			'minLength',
			'maxLength',
			'pattern',
			'minItems',
			'maxItems',
			'uniqueItems',
		);

		foreach ( $schema_properties as $field_id => $params ) {

			// Arguments specified as `readonly` are not allowed to be set.
			if ( ! empty( $params['readonly'] ) ) {
				continue;
			}

			$endpoint_args[ $field_id ] = [
				'validate_callback' => 'rest_validate_request_arg',
				'sanitize_callback' => 'rest_sanitize_request_arg',
			];

			if ( WP_REST_Server::CREATABLE === $method && isset( $params['default'] ) ) {
				$endpoint_args[ $field_id ]['default'] = $params['default'];
			}

			if ( WP_REST_Server::CREATABLE === $method && ! empty( $params['required'] ) ) {
				$endpoint_args[ $field_id ]['required'] = $params['required'];
			}

			foreach ( $valid_schema_properties as $schema_prop ) {
				if ( isset( $params[ $schema_prop ] ) ) {
					$endpoint_args[ $field_id ][ $schema_prop ] = $params[ $schema_prop ];
				}
			}

			// Merge in any options provided by the schema property.
			if ( isset( $params['arg_options'] ) ) {

				// Only use required / default from arg_options on CREATABLE endpoints.
				if ( WP_REST_Server::CREATABLE !== $method ) {
					$params['arg_options'] = array_diff_key(
						$params['arg_options'],
						array(
							'required' => '',
							'default'  => '',
						)
					);
				}

				$endpoint_args[ $field_id ] = array_merge( $endpoint_args[ $field_id ], $params['arg_options'] );
			}
		}

		return $endpoint_args;
	}

	/**
	 * Retrieves an array of endpoint arguments from the item schema for the controller.
	 *
	 * @param array  $schema The JSON schema to use.
	 * @param string $method Optional. HTTP method of the request. The arguments for `CREATABLE` requests are
	 *                       checked for required values and may fall-back to a given default, this is not done
	 *                       on `EDITABLE` requests. Default WP_REST_Server::CREATABLE.
	 *
	 * @return array The sanitized schema.
	 */
	public static function sanitize_schema_for_output( $schema, $method = WP_REST_Server::CREATABLE ) {
		$args = static::get_endpoint_args_for_schema( $schema, $method );

		foreach ( $args as $arg => $arg_schema ) {
			unset( $arg_schema['validate_callback'], $arg_schema['sanitize_callback'] );

			$schema['properties'][ $arg ] = $arg_schema;
		}

		return $schema;
	}

	/**
	 * Gets the HTTP method used with the REST API.
	 *
	 * @return string
	 */
	public static function get_http_method() {
		if ( isset( $_GET['_method'] ) ) {
			return strtoupper( $_GET['_method'] );
		}

		if ( isset( $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ) ) {
			return strtoupper( $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] );
		}

		return strtoupper( $_SERVER['REQUEST_METHOD'] );
	}
}
