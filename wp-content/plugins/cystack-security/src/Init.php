<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services()
	{
		return [
			Base\Enqueue::class,
			Base\BuildMenu::class,
			Api\Registration::class,
			Api\Disconnect::class,
			Api\ClearMeta::class,
			Api\UpdateEmail::class,
		];
	}

	/**
	 * Loop through the class, initialize theme
	 * and call the register() method if it exists
	 * @return void
	 */
	public static function register_services()
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param class $class class from services array
	 * @return class instance new instance of the class
	 */
	private static function instantiate( $class )
	{
		return new $class();
	}
}