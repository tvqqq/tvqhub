<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Api;

class Connection {
	/**
	 * Connect target id, name, address to WordPress options and CyStack email to user meta data.
	 *
	 * @param Number $target_id     CyStack target id.
	 * @param String $target_name   CyStack target name.
	 * @param String $target_address CyStack target address.
	 * @param String $cs_user_email CyStack user email.
	 */
	public static function connect( $target_id, $target_name, $target_address, $cs_user_email, $meta_key, $meta_value ) {
		self::disconnect();

		add_option( 'cystack_targetId', $target_id );
		add_option( 'cystack_targetName', $target_name );
		add_option( 'cystack_targetAddress', $target_address );
		add_option( 'cystack_meta_key', $meta_key );
		add_option( 'cystack_meta_value', $meta_value );
		$wp_user    = wp_get_current_user();
		$wp_user_id = $wp_user->ID;
		add_user_meta( $wp_user_id, 'cystack_email', $cs_user_email );
	}

	/**
	 * Removes target id and domain from the WordPress options.
	 */
	public static function disconnect() {
		delete_option( 'cystack_targetId' );
		delete_option( 'cystack_targetName' );
		delete_option( 'cystack_targetAddress' );
		delete_option( 'cystack_meta_key' );
		delete_option( 'cystack_meta_value' );
		$users = get_users( array( 'fields' => array( 'ID' ) ) );
		foreach ( $users as $user ) {
			delete_user_meta( $user->ID, 'cystack_email' );
		}
	}

	/**
	 * Removes meta data from the WordPress options.
	 */
	public static function clear_meta() {
		delete_option( 'cystack_meta_key' );
		delete_option( 'cystack_meta_value' );
	}

	/**
	 * Update email to the WordPress options.
	 */
	public static function update_email( $cs_user_email ) {
		$wp_user    = wp_get_current_user();
		$wp_user_id = $wp_user->ID;
		add_user_meta( $wp_user_id, 'cystack_email', $cs_user_email );
	}
 }