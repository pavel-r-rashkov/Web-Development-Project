<?php

namespace Config;
use Core\BindOptions;
use Core\Routing\Route;

class ApplicationConfig {

	public static function initializeComponents($appManager) {
		#$appMananger->setControllerFactory(...);
		#...
	}

	public static function registerAreas($appManager) {
		$appManager->registerArea('TestArea');
	}

	public static function routeConfig($routingEngine) {
		#$routingEngine->registerRoute(new Route(...));

		$a = new Route('asdf/{aaa}/3/{bbb}/{g}', 'SomeController', 'someAction');
		$routingEngine->registerRoute($a);

		$b = new Route('test/test/{g}', 'AreaController', 'someAction', 'TestArea');
		$routingEngine->registerRoute($b);
	}

	public static function registerBindings($container) {
		#$container->bind('Contracts\IContainer', 'Core\Container', BindOptions::NONE);
		$container->bind('Core/Contracts/IRoleProvider', 'RoleProvider', BindOptions::SINGLETON);
	}
}

?>