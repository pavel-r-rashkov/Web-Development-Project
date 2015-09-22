<?php

namespace Core\Controllers;

class ControllerFactory {
	public function createController($controllerName, $area) {
		if (is_null($area)) {
			$class = 'Controllers\\' . $controllerName;	
		} else {
			$class = 'Areas\\' . $area . '\\Controllers\\' . $controllerName;
		}

		if(class_exists($class)) {
			return new $class();
		}
		throw new \InvalidArgumentException('No controllers matching this name are found.');
	}
}

?>