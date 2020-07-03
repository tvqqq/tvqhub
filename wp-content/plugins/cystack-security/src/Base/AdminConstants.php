<?php
namespace CyStack\Base;

/**
 * Class containing all the constants used for admin script localization.
 */
class AdminConstants
{
	/**
	 * Returns cystackConfig, containing all the data needed by the cystack javascript.
	 */

	public static function get_cystack_config() {
		global $wp_version;
		$wp_user    = wp_get_current_user();
		$wp_user_id = $wp_user->ID;
		return array(
			'adminUrl'            => admin_url(),
			'ajaxUrl'             => admin_url( 'admin-ajax.php' ),
			'cystackBaseUrl'      => CYSTACK_BASE_URL,
			'locale'              => get_locale(),
			'nonce'               => wp_create_nonce( 'cystack-ajax' ),
			'phpVersion'          => PHP_VERSION ,
			'pluginPath'          => CYSTACK_PLUGIN_PATH,
			'plugins'             => get_plugins(),
			'targetId'            => get_option( 'cystack_targetId' ), // '16a690d8-a829-4fe9-8650-83d8ccd1dd87', //,
			'targetName'          => get_option( 'cystack_targetName' ),
			'targetAddress'       => get_option( 'cystack_targetAddress' ),
			'cystackEmail'        => get_user_meta( $wp_user_id, 'cystack_email', true ),
			'iframeUrl'           => self::get_iframe_src(),
			'loginUrl'            => CYSTACK_BASE_ID_URL . '/login-wordpress',
			'signupUrl'           => CYSTACK_BASE_ID_URL . '/register-wordpress',
			'theme'               => get_option( 'stylesheet' ),
			'wpVersion'           => $wp_version,
			'screen'              => get_current_screen()->id,
			'cystackFeature'      => self::get_page_id(),
			'homeUrl'             => home_url()
		);
	}

	private static function get_iframe_src() {
		$targetId = get_option( 'cystack_targetId' );
		$page_id = self::get_page_id();
//		if ( empty( $targetId ) ) {
//			$route = '/wordpress/intro';
//		} else {
//		}
//		if ($page_id === 'cystack') {
//			$route = '/wordpress/targets';
//		} else if ($page_id === 'dashboard') {
//			$route = '/wordpress/targets/' . $targetId;
//		} else {
//			$route = '/wordpress/targets/' . $targetId . '/' . $page_id;
//		}

		$route = '/wordpress/targets';

		return CYSTACK_BASE_URL . $route;
	}

	private static function get_page_id() {
		$screen_id = get_current_screen()->id;
		return preg_replace( '/^(cystack_page_cystack_|toplevel_page_)/', '', $screen_id );
	}
}
