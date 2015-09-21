<?php

namespace Routing;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', basename(dirname(dirname(dirname(__FILE__)))) . DS);

class RequestDispatcher {
	public static function getRoute() {		
		$requestUri = $_SERVER['REQUEST_URI'];
		$requestHome = DS . ROOT_PATH;
		$route = substr($requestUri, strlen($requestHome));
		return $route;
	}	
}

?>