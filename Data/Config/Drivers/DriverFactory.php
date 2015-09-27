<?php

namespace Data\Config\Drivers;

class DriverFactory {
	public static function createDriver($driverName, $user, $pass, $dbName, $host) {
		$reflection = new \ReflectionClass('Data\\Config\\Drivers\\' . $driverName . 'Driver');
		$instance = $reflection->newInstanceArgs(array($user, $pass, $dbName, $host));
		return $instance;
	}
}

?>