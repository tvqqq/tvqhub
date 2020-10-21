<?php

final class ITSEC_Admin_User_Validator extends ITSEC_Validator {
	protected $run_validate_matching_fields = false;
	protected $run_validate_matching_types = false;

	public function get_id() {
		return 'admin-user';
	}

	protected function sanitize_settings() {
		// Only validate it if it exists
		if ( ! empty( $this->settings['new_username'] ) ) {
			$this->sanitize_setting( 'valid-username', 'new_username', __( 'New Admin Username', 'better-wp-security' ) );
		}

		// If the value wasn't sent for this, assume false (no change)
		if ( empty( $this->settings['change_id'] ) ) {
			$this->settings['change_id'] = false;
		} else {
			$this->sanitize_setting( 'bool', 'change_id', __( 'Change User ID 1', 'better-wp-security' ) );
		}
	}

	protected function validate_settings() {
		if ( ! $this->can_save() ) {
			return;
		}

		if ( empty( $this->settings['new_username'] ) || 'admin' === $this->settings['new_username'] ) {
			$this->settings['new_username'] = null;
		}

		if ( is_null( $this->settings['new_username'] ) && false === $this->settings['change_id'] ) {
			return;
		}

		$result = itsec_change_admin_user( $this->settings['new_username'], $this->settings['change_id'] );

		if ( $result ) {
			$this->add_message( __( 'The user was successfully updated.', 'better-wp-security' ) );
			ITSEC_Response::set_show_default_success_message( false );

			ITSEC_Response::force_logout();
		} else {
			$this->set_can_save( false );
			$this->add_error( new WP_Error( 'itsec-admin-user-failed-change-admin-user', __( 'The user was unable to be successfully updated. This could be due to a plugin or server configuration conflict.', 'better-wp-security' ) ) );
			ITSEC_Response::set_show_default_error_message( false );
		}
	}
}

ITSEC_Modules::register_validator( new ITSEC_Admin_User_Validator() );
