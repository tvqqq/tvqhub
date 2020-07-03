<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Base;
use CyStack\Api\Connection;
class Deactivate
{
	public static function deactivate() {
		Connection::disconnect();
	}
}