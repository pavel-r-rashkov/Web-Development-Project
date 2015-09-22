<?php

namespace Core;

class ApplicationManager {
	private static $instance;
	private $controllerFactory;
	private $viewEngine;
	private $container;
	private $routingEngine;
	private $areas;

	private function __construct() {
		$this->areas = array();
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
		$this->routingEngine = $value;
	}

	public function registerArea($areaName) {
		if (in_array($areaName, $this->areas)) {
			throw new Exception('Area with this name already registered.');
		}
		array_push($this->areas, $areaName);
	}

	public function getAreas() {
		return $this->areas;
	}
}

?>