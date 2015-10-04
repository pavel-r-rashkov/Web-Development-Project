<?php 

namespace Core\Routing;
use Core\ApplicationManager;
use Core\Annotations\AnnotationHelper;
use Core\Annotations\AnnotationFactory;
use Core\Annotations\RouteAnnotation;
use Core\Contracts\IRoutingEngine;

class RoutingEngine implements IRoutingEngine {
	private $routes;

	public function __construct() {
		$this->routes = array();
	}

	public function registerRoute($route) {
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

	public function registerAnnotationRoutes() {
		$areas = ApplicationManager::getInstance()->getAreas();
		$controllers = array();
		foreach ($areas as $area) {
			$controllers = array_merge($controllers, $this->getClasses('Areas'. DS . $area . DS . 'Controllers'));
		}
		$controllers = array_merge($controllers, $this->getClasses('Controllers'));

		foreach ($controllers as $controller) {
			$areaName = $this->getAreaName($controller);
			$controllerName = $this->getControllerName($controller);
			$controllerName = str_replace('Controller', '', $controllerName);
			$routeAnnotations = $this->getRouteAnnotations($controller);
	
			foreach ($routeAnnotations as $annotationData) {
				$actionName = $annotationData[0];
				$routeAnnotation = $annotationData[1];
				
				$routePath = $routeAnnotation->getRoutePath();
				$route = new Route($routePath, $controllerName, $actionName, $areaName);
				$this->registerRoute($route);
			}
		}
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

	private function getClasses($folder) {
		$path = dirname(dirname(__DIR__)) . DS . $folder;
		$fqcns = array();

		$allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
		$phpFiles = new \RegexIterator($allFiles, '/\.php$/');
		foreach ($phpFiles as $phpFile) {
		    $content = file_get_contents($phpFile->getRealPath());
		    $tokens = token_get_all($content);
		    $namespace = '';
		    for ($index = 0; isset($tokens[$index]); $index++) {
		        if (!isset($tokens[$index][0])) {
		            continue;
		        }
		        if (T_NAMESPACE === $tokens[$index][0]) {
		            $index += 2; // Skip namespace keyword and whitespace
		            while (isset($tokens[$index]) && is_array($tokens[$index])) {
		                $namespace .= $tokens[$index++][1];
		            }
		        }
		        if (T_CLASS === $tokens[$index][0]) {
		            $index += 2; // Skip class keyword and whitespace
		            $fqcns[] = $namespace.'\\'.$tokens[$index][1];
		        }
		    }
		}
		return $fqcns;
	}

	private function getRouteAnnotations($controller) {
		$reflection = new \ReflectionClass($controller);
		$methods = $reflection->getMethods();
		$helper = new AnnotationHelper(new AnnotationFactory());
		$annotations = array();

		foreach ($methods as $method) {
			if ($method->isPublic() && $method->name != '__construct') {
				$actionAnnotations = $helper->extractAnnotations($controller, $method->name);
				$actionRouteAnnotations = array_filter($actionAnnotations, function($value) {
						if ($value instanceof RouteAnnotation) {
							return true;
						}
						return false;
					});
				$actionAnnotationsDictionary = array();
				foreach ($actionRouteAnnotations as $annotation) {
					$actionAnnotationsDictionary[] = array($method->name, $annotation);
				}

				$annotations = array_merge($actionAnnotationsDictionary, $annotations);
			}
		}
		return $annotations;
	}

	private function getControllerName($fullControllerName) {
		$tokens = explode("\\", $fullControllerName);
		return $tokens[count($tokens) - 1];
	}

	private function getAreaName($areaName) {
		$tokens = explode("\\", $areaName);
		if ($tokens[0] == 'Areas') {
			return $tokens[1];
		}
		return null;
	}
}

?>