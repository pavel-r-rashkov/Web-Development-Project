<?php

class Route {
	private $routePath;
	private $controllerName;
	private $actionName;

	public function __construct($routePath, $controllerName, $actionName) {
		$this->setRoutePath($routePath);
		$this->setControllerName($controllerName);
		$this->setActionName($actionName);
	}

	public function getRoutePath() {
		return $this->routePath;
	}

	public function setRoutePath($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException('Invalid route path');
		}
		$this->routePath = $value;
	}

	public function getControllerName() {
		return $this->controllerName;
	}

	public function setControllerName($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException('Invalid controller name');
		}
		$this->controllerName = $value; 
	}

	public function getActionName() {
		return $this->actionName;
	}

	public function setActionName($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException('Invalid action name');
		}
		$this->actionName = $value; 
	}
}

?>