<?php

namespace Core;

class ApplicationManager {
	private static $instance;
	private $controllerFactory;
	private $viewEngine;
	private $container;
	private $routingEngine;

	private function __construct() {
	}

	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new static();
		}
		return self::$instance;
	}

	public function getControllerFactory() {
		return $this->controllerFactory;
	}

	public function setControllerFactory($value) {
		$this->controllerFactory = $value;
	}

	public function getViewEngine() {
		return $this->viewEngine;
	}

	public function setViewEngine($value) {
		$this->viewEngine = $value;
	}

	public function getContainer() {
		return $this->container;
	}

	public function setContainer($value) {
		$this->container = $value;
	}

	public function getRoutingEngine() {
		return $this->routingEngine;
	}

	public function setRoutingEngine($value) {
		$routingEngine = $value;
	}
}

?>