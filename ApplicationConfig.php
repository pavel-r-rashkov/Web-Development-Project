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
		$appManager->registerArea('Editors');
		$appManager->registerArea('Administrators');
	}

	public static function bootstrap() {

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

		// $a = new Route('asdf/{aaa}/3/{bbb}/{g}', 'SomeController', 'someAction');
		// $routingEngine->registerRoute($a);

		$b = new Route('{controller}/{action}', '{controller}', '{action}');
		$routingEngine->registerRoute($b);

		$c = new Route('{controller}/{action}/{id}', '{controller}', '{action}');
		$routingEngine->registerRoute($c);

		$routingEngine->registerRoute(new Route('editors/{controller}/{action}', '{controller}', '{action}', 'Editors'));
		$routingEngine->registerRoute(new Route('editors/{controller}/{action}/{id}', '{controller}', '{action}', 'Editors'));

		$routingEngine->registerRoute(new Route('administrators/{controller}/{action}', '{controller}', '{action}', 'Administrators'));
		$routingEngine->registerRoute(new Route('administrators/{controller}/{action}/{id}', '{controller}', '{action}', 'Administrators'));
	}

	public static function registerBindings($container) {
		#$container->bind('Contracts\IContainer', 'Core\Container', BindOptions::NONE);
		$container->bind('Core\Contracts\IRoleProvider', 'RoleProvider', BindOptions::SINGLETON);
		$container->bind('Data\Contracts\IShopData', 'Data\ShopData', BindOptions::SINGLETON);
	}
}

?>