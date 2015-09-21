<?php

namespace Config;
use Core\BindOptions;

class ApplicationConfig {

	public static function initializeComponents($appMananger) {
		#$appMananger->setControllerFactory(...);
		#...
	}

	public static function routeConfig($routingEngine) {
		#$routingEngine->registerRoute(new Route(...));
	}

	public static function registerBindings($container) {
		#$container->bind('Contracts\IContainer', 'Core\Container', BindOptions::NONE);
	}
}

?>