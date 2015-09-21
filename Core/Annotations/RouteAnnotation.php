<?php

namespace Annotations;

class RouteAnnotation extends BaseAnnotation {
	private $routePath;

	public function __construct($routePath) {
		$this->setRoutePath($routePath);
	}

	public function getRoutePath() {
		return $this->$routePath;
	}

	private function setRoutePath($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException('Invalid route path');
		}
		$this->routePath = $value;
	}
}

?>