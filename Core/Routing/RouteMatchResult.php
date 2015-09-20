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

	private function setMatchedRoute(Route $value) {
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

	public function extractControllerName() {
		$controllerName = $this->getMatchedRoute()->getControllerName();
		
		if(self::strStartsWith($controllerName, '{') && self::strEndsWith($controllerName, '}')) {
			$paramKey = substr($controllerName, 1, strlen($controllerName) - 2);
			if (array_key_exists($paramKey, $this->routeParams)) {
				return $this->routeParams[$paramKey];
			} else {
				throw new Exception('Invalid route register parameter');
			}
		}
		return $controllerName;
	}

	private static function strStartsWith($haystack, $needle)
	{
	    return strpos($haystack, $needle) === 0;
	}

	private static function strEndsWith($haystack, $needle)
	{
	    return strrpos($haystack, $needle) + strlen($needle) === strlen($haystack);
	}
}

?>