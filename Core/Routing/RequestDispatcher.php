<?php

namespace Core\Routing;

class RequestDispatcher {
	public static function getRoute() {	
		$requestUri = $_SERVER['REQUEST_URI'];
		$requestHome = DS . ROOT_PATH;
		$route = substr($requestUri, strlen($requestHome));
		$route = explode('?', $route)[0];

		return $route;
	}	
}

?>