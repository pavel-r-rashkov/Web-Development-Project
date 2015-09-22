<?php

namespace Core;
use Core\Routing\RequestDispatcher;
use Core\Annotations\AnnotationHelper;
use Core\Annotations\AnnotationFactory;
use Core\ActionExecution\ActionInvoker;
use Core\ResultExecution\ActionResultHandler;

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
		$areaName = $routeResult->getMatchedRoute()->getArea();

		$controller = $controllerFactory->createController($controllerName, $areaName); 
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