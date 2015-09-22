<?php

namespace Core\Routing;

class Route {
	private $routePath;
	private $controllerName;
	private $actionName;
	private $area;

	public function __construct($routePath, $controllerName, $actionName, $area = null) {
		$this->setRoutePath($routePath);
		$this->setControllerName($controllerName);
		$this->setActionName($actionName);
		$this->setArea($area);
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

	public function getArea() {
		return $this->area;
	}

	public function setArea($value) {
		$this->area = $value; 
	}
}

?>