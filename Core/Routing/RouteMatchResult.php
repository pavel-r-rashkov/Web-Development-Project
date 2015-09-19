<?php 

class RouteMatchResult {
	private $requestRoutePath;
	private $matchedRoute;
	private $routeParams;

	public function __construct($requestRoutePath, $matchedRoute, $routeParams) {
		$this->setRequestRoutePath($requestRoutePath);
		$this->setMatchedRoute($matchedRoute);
		$this->setRouteParams($routeParams);
	}

	public function getRequestRoutePath() {
		return $this->requestRoutePath;
	}

	private function setRequestRoutePath($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException('Route path must be a string');
		}
		$this->requestRoutePath = $value;
	}

	public function getMatchedRoute() {
		return $this->matchedRoute;
	}

	private function setMatchedRoute($value) {
		if (get_class($value) != 'Route') {
			throw new InvalidArgumentException('Invalid matched route');
		}
		$this->matchedRoute = $value;
	}

	public function getRouteParams() {
		return $this->routeParams;
	}

	private function setRouteParams($value) {
		if (!is_array($value)) {
			throw new InvalidArgumentException('Invalid route parameters');
		}
		$this->routeParams = $value;
	}
}

?>