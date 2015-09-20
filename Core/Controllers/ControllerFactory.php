<?php

class ControllerFactory {
	public function createController($controllerName, $namespaces) {
		$class = $namespaces[0] . '\\' . $controllerName;
		
		foreach ($namespaces as $namespace) {
			if(class_exists($class)) {
				return new $class();
			}	
		}

		throw new InvalidArgumentException('No controllers matching this name are found.');
	}
}

?>