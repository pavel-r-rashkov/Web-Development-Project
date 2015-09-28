<?php

namespace Core\Controllers;
use Core\ApplicationManager;
use Core\Contracts\IControllerFactory;

class ControllerFactory implements IControllerFactory {
	public function createController($controllerName, $area) {
		if (is_null($area)) {
			$class = 'Controllers\\' . ucfirst($controllerName) . 'Controller';	
		} else {
			$class = 'Areas\\' . $area . '\\Controllers\\' . $controllerName;
		}

		if (class_exists($class)) {
			$container = ApplicationManager::getInstance()->getContainer();
			return $container->resolve($class);
			// $reflection = new \ReflectionClass($class);
			// $constructor = $reflection->getMethod('__construct');
			// $constructorParams = $constructor->getParameters();
			
			// $constructorArgs = array();
			// foreach ($constructorParams as $param) {
			// 	$paramInstance = $container->resolve($param->getClass()->name);
			// 	array_push($constructorArgs, $paramInstance);
			// }

			// return $reflection->newInstanceArgs($constructorArgs);
		}
		throw new \InvalidArgumentException('No controllers matching this name are found.');
	}
}

?>