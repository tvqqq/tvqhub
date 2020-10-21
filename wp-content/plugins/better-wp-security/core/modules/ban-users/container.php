<?php

namespace iThemesSecurity\Ban_Users;

use iThemesSecurity\Actor\Multi_Actor_Factory;
use Pimple\Container;
use Pimple\Exception\FrozenServiceException;

return static function ( Container $c ) {
	$c['module.ban-users.files'] = [
		'validator.php' => Validator::class,
	];

	try {
		$c->extend( 'ban-hosts.repositories', static function ( $repositories ) {
			if ( \ITSEC_Modules::get_setting( 'ban-users', 'enable_ban_lists' ) ) {
				$repositories[] = Database_Repository::class;
			}

			return $repositories;
		} );
	} catch ( FrozenServiceException $e ) {

	}

	$c[ Validator::class ] = static function ( Container $c ) {
		return new Validator( $c[ Database_Repository::class ] );
	};

	$c[ Database_Repository::class ] = static function ( Container $c ) {
		return new Database_Repository(
			$c[ Multi_Actor_Factory::class ],
			$c[ \wpdb::class ]
		);
	};

};
