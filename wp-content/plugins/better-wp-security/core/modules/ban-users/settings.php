<?php

use iThemesSecurity\Ban_Users\Database_Repository;

final class ITSEC_Ban_Users_Settings extends ITSEC_Settings {
	public function get_id() {
		return 'ban-users';
	}

	public function get( $name, $default = null ) {
		if ( $name === 'host_list' ) {
			return ITSEC_Modules::get_container()->get( Database_Repository::class )->get_legacy_hosts();
		}

		return parent::get( $name, $default );
	}

	public function get_defaults() {
		return array(
			'default'             => false,
			'enable_ban_lists'    => true,
			'agent_list'          => array(),
			'server_config_limit' => 100,
		);
	}
}

ITSEC_Modules::register_settings( new ITSEC_Ban_Users_Settings() );
