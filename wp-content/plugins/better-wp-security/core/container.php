<?php

namespace iThemesSecurity;

use ITSEC_Lib_Upgrader;
use Pimple\Container;
use wpdb;

return static function ( Container $c ) {
	$c[ wpdb::class ] = static function () {
		return $GLOBALS['wpdb'];
	};

	$c[ ITSEC_Lib_Upgrader::class ] = static function () {
		return new ITSEC_Lib_Upgrader();
	};

	$c[ Actor\Multi_Actor_Factory::class ] = static function ( Container $c ) {
		return new Actor\Multi_Actor_Factory( ...$c['actor.factories'] );
	};

	$c['actor.factories'] = static function () {
		return [
			new Actor\User_Factory(),
			new Actor\Lockout_Module_Factory(),
		];
	};

	$c['ban-hosts.sources'] = static function () {
		return [];
	};

	$c['ban-hosts.repositories'] = static function () {
		return [];
	};

	$c[ Ban_Hosts\Multi_Repository::class ] = static function ( Container $c ) {
		return new Ban_Hosts\Multi_Repository(
			...array_map( [ $c, 'offsetGet' ], $c['ban-hosts.repositories'] )
		);
	};

	$c[ Ban_Hosts\Source::class ] = static function ( Container $c ) {
		return new Ban_Hosts\Chain_Source(
			...array_map( [ $c, 'offsetGet' ], $c['ban-hosts.repositories'] ),
			...array_map( [ $c, 'offsetGet' ], $c['ban-hosts.sources'] )
		);
	};

	$c[ Ban_Hosts\REST::class ] = static function ( Container $c ) {
		return new Ban_Hosts\REST(
			$c[ Ban_Hosts\Multi_Repository::class ],
			$c[ Actor\Multi_Actor_Factory::class ]
		);
	};

};
