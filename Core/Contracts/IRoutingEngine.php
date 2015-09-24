<?php

namespace Core\Contracts;

interface IRoutingEngine {
	public function registerRoute($route);
	
	public function matchRoute($routePath);

	public function registerAnnotationRoutes();
}

?>