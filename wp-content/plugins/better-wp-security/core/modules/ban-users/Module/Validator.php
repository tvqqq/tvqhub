<?php

namespace iThemesSecurity\Ban_Users;

use iThemesSecurity\Actor\User;
use iThemesSecurity\Ban_Users\Ban;
use iThemesSecurity\Contracts\Runnable;

class Validator extends \ITSEC_Validator implements Runnable {

	/** @var Database_Repository */
	private $repository;

	/**
	 * ITSEC_Ban_Users_Validator constructor.
	 *
	 * @param Database_Repository $repository
	 */
	public function __construct( Database_Repository $repository ) {
		$this->repository = $repository;

		parent::__construct();
	}

	public function run() {
		\ITSEC_Modules::register_validator( $this );
	}

	public function get_id() {
		return 'ban-users';
	}

	protected function sanitize_settings() {
		$this->vars_to_skip_validate_matching_fields[] = 'host_list';

		$this->sanitize_setting( 'bool', 'default', __( 'Default Ban List', 'better-wp-security' ) );
		$this->sanitize_setting( 'bool', 'enable_ban_lists', __( 'Ban Lists', 'better-wp-security' ) );
		$this->sanitize_setting( 'positive-int', 'server_config_limit', __( 'Limit Banned IPs in Server Config', 'better-wp-security' ) );

		if ( isset( $this->settings['host_list'] ) && is_array( $this->settings['host_list'] ) ) {
			$this->sanitize_setting( 'newline-separated-ips', 'host_list', __( 'Ban Hosts', 'better-wp-security' ) );
			require_once( \ITSEC_Core::get_core_dir() . '/lib/class-itsec-lib-ip-tools.php' );

			$whitelisted_hosts = array();
			$current_ip        = \ITSEC_Lib::get_ip();

			foreach ( $this->settings['host_list'] as $host ) {
				if ( is_user_logged_in() && \ITSEC_Lib_IP_Tools::intersect( $current_ip, \ITSEC_Lib_IP_Tools::ip_wild_to_ip_cidr( $host ) ) ) {
					$this->set_can_save( false );

					/* translators: 1: input name, 2: invalid host */
					$this->add_error( sprintf( __( 'The following host in %1$s matches your current IP and cannot be banned: %2$s', 'better-wp-security' ), __( 'Ban Hosts', 'better-wp-security' ), $host ) );

					continue;
				}

				if ( \ITSEC_Lib::is_ip_whitelisted( $host ) ) {
					$whitelisted_hosts[] = $host;
				}
			}

			if ( ! empty( $whitelisted_hosts ) ) {
				$this->set_can_save( false );

				/* translators: 1: input name, 2: invalid host list */
				$this->add_error( wp_sprintf( _n( 'The following IP in %1$s is on the authorized hosts list and cannot be banned: %2$l', 'The following IPs in %1$s are on the authorized hosts list and cannot be banned: %2$l', count( $whitelisted_hosts ), 'better-wp-security' ), __( 'Ban Hosts', 'better-wp-security' ), $whitelisted_hosts ) );
			}
		}

		$this->sanitize_setting( array( $this, 'sanitize_agent_list_entry' ), 'agent_list', __( 'Ban User Agents', 'better-wp-security' ) );
	}

	protected function sanitize_agent_list_entry( $entry ) {
		return trim( sanitize_text_field( $entry ) );
	}

	protected function validate_settings() {
		if ( ! $this->can_save() ) {
			return;
		}

		if ( isset( $this->settings['host_list'] ) ) {
			$this->sync_host_list( $this->settings['host_list'] );
			unset( $this->settings['host_list'] );
		}

		if ( ! \ITSEC_Core::is_interactive() ) {
			return;
		}

		$previous_settings = \ITSEC_Modules::get_settings( $this->get_id() );

		foreach ( $this->settings as $key => $val ) {
			if ( ! isset( $previous_settings[ $key ] ) || $previous_settings[ $key ] !== $val ) {
				\ITSEC_Response::regenerate_server_config();
				break;
			}
		}
	}

	/**
	 * Syncs the list of hosts to the Database Repository.
	 *
	 * @param string[] $new_hosts List of IP addresses.
	 */
	protected function sync_host_list( $new_hosts ) {
		$old_hosts = $this->repository->get_legacy_hosts();

		foreach ( $old_hosts as $id => $host ) {
			if ( in_array( $host, $new_hosts, true ) ) {
				continue;
			}

			$this->delete_host( $id );
		}

		foreach ( $new_hosts as $host ) {
			if ( in_array( $host, $old_hosts, true ) ) {
				continue;
			}

			$this->add_host( $host );
		}
	}

	protected function delete_host( $id ) {
		if ( ! $ban = $this->repository->get( (int) $id ) ) {
			return;
		}

		try {
			$this->repository->delete( $ban );
		} catch ( \iThemesSecurity\Exception\WP_Error $e ) {
			$this->add_error( $e->get_error() );
		}
	}

	protected function add_host( $host ) {
		$actor   = null;
		$comment = '';

		if ( is_user_logged_in() ) {
			$actor = new User( wp_get_current_user() );
		} elseif ( defined( 'WP_CLI' ) && WP_CLI ) {
			$comment = __( 'Added via WP CLI', 'better-wp-security' );
		}

		try {
			$this->repository->persist( new Ban( $host, $actor, $comment ) );
		} catch ( \iThemesSecurity\Exception\WP_Error $e ) {
			$this->add_error( $e->get_error() );
		}
	}
}
