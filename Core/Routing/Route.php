<?php

class Route {
	private $routePath;
	private $controllerName;
	private $actionName;
	private $namespaces;

	public function __construct($routePath, $controllerName, $actionName, $namespaces) {
		$this->setRoutePath($routePath);
		$this->setControllerName($controllerName);
		$this->setActionName($actionName);
		$this->setNamespaces($namespaces);
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

	public function getNamespaces() {
		return $this->$namespaces;
	}

	public function setNamespaces($value) {
		if (!is_array($value)) {
			throw new InvalidArgumentException('Invalid namespaces');
		}
		$this->namespaces = $value; 
	}
}

?>