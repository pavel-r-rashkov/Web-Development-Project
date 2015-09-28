<?php

#namespace Config;
use Core\BindOptions;
use Core\Routing\Route;
use Data\Config\Database;
use Data\Config\DatabaseConfig;

class ApplicationConfig {

	public static function initializeComponents($appManager) {
		#$appMananger->setControllerFactory(...);
		#...
	}

	public static function registerAreas($appManager) {
		$appManager->registerArea('TestArea');
	}

	public static function bootstrap() {

		// require_once(__DIR__ . DS . 'Data/Config/Drivers/DriverFactory.php');
		// require_once(__DIR__ . DS . 'Data/Config/Drivers/DriverAbstract.php');
		// require_once(__DIR__ . DS . 'Data/Config/Drivers/MySQLDriver.php');
		// require_once(__DIR__ . DS . 'Data/Config/Database.php');
		// require_once(__DIR__ . DS . 'Data/Config/DatabaseConfig.php');
		// require_once(__DIR__ . DS . 'Data/Config/Statement.php');

		Database::setInstance(
			DatabaseConfig::DB_INSTANCE,
			DatabaseConfig::DB_DRIVER,
			DatabaseConfig::DB_USER,
			DatabaseConfig::DB_PASS,
			DatabaseConfig::DB_NAME,
			DatabaseConfig::DB_HOST
		);	
	}

	public static function routeConfig($routingEngine) {
		#$routingEngine->registerRoute(new Route(...));

		$a = new Route('asdf/{aaa}/3/{bbb}/{g}', 'SomeController', 'someAction');
		$routingEngine->registerRoute($a);

		$b = new Route('{controller}/{action}', '{controller}', '{action}');
		$routingEngine->registerRoute($b);

		$c = new Route('{controller}/{action}/{id}', '{controller}', '{action}');
		$routingEngine->registerRoute($c);
	}

	public static function registerBindings($container) {
		#$container->bind('Contracts\IContainer', 'Core\Container', BindOptions::NONE);
		$container->bind('Core\Contracts\IRoleProvider', 'RoleProvider', BindOptions::SINGLETON);
		$container->bind('Data\Contracts\IShopData', 'Data\ShopData', BindOptions::SINGLETON);
	}
}

?>