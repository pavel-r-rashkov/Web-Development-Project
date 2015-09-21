<?php

namespace Core;

class RequestPipeline {
	public static function execute() {
		$manager = ApplicationManager::getInstance();
		$routingEngine = $manager->getRoutingEngine();	
		$viewEngine = $manager->getViewEngine();	
		$controllerFactory = $manager->getControllerFactory();

		$route = RequestDispatcher::getRoute();
		$routeResult = $routingEngine->matchRoute($route);

		// route result -> area 
		$controllerName = $routeResult->extractControllerName();
																				// change to area
		$controller = $controllerFactory->createController($controllerName, array('Controllers')); 
		$helper = new AnnotationHelper(new AnnotationFactory);

		$invoker = new ActionInvoker(
			$controller, 
			$routeResult->extractActionName(), 
			$routeResult->extractActionParams(),
			$helper->extractAnnotations(get_class($controller), $routeResult->extractActionName()));
		$actionArgs = $invoker->processBinding();
		$invoker->processAnnotations();
		$actionResult = $invoker->executeAction($actionArgs);

		$resultHandler = new ActionResultHandler($viewEngine);
		$resultHandler->handleResult($actionResult);
	}
}

?>