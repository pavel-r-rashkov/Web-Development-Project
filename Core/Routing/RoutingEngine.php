<?php 

namespace Core\Routing;
use Core\ApplicationManager;

class RoutingEngine {
	private $routes;

	public function __construct() {
		$this->routes = array();
	}

	public function registerRoute(Route $route) {
		$area = $route->getArea();
		$areas = ApplicationManager::getInstance()->getAreas();
		if (!is_null($area) && !in_array($area, $areas)) {
			throw new \Exception("Area with name {$area} is not registered");
		}
		array_push($this->routes, $route);
	}

	public function matchRoute($routePath) {
		foreach ($this->routes as $key => $route) {
			if(preg_match_all($this->createRegex($route->getRoutePath()), $routePath, $matchData)) {
				$routeParams = $this->getRouteParams($matchData);
				return new RouteMatchResult($routePath, $route, $routeParams);
			}
		}
		throw new \Exception('Route not found');
	}

	private function createRegex($routePath) {
		$patterns = array('/\//', '/{(.+?)}/');
		$replacements = array('\/', '(?P<${1}>[^\/]+?)');

		$routePattern = '/^' . preg_replace($patterns, $replacements, $routePath) . '$/i';
		return $routePattern;
	}

	private function getRouteParams($matchData) {
		$routeParams = array();

		foreach ($matchData as $key => $value) {
			if (!is_int($key)) {
				$routeParams[$key] = $value[0];
			}
		}

		return $routeParams;
	}
}

?>