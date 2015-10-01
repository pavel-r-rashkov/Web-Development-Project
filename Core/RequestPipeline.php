<?php

namespace Core;
use Core\Routing\RequestDispatcher;
use Core\Annotations\AnnotationHelper;
use Core\Annotations\AnnotationFactory;
use Core\ActionExecution\ActionInvoker;
use Core\ActionExecution\AnnotationProcessor;
use Core\ResultExecution\ActionResultHandler;

class RequestPipeline {
	public static function execute() {
		$manager = ApplicationManager::getInstance();
		$routingEngine = $manager->getRoutingEngine();		
		
		$route = RequestDispatcher::getRoute();
		$routeResult = $routingEngine->matchRoute($route);

		$actionParams = $routeResult->extractActionParams();
		$actionName = $routeResult->extractActionName();
		$controllerName = $routeResult->extractControllerName();
		$areaName = $routeResult->getMatchedRoute()->getArea();

		self::executeAction($controllerName, $actionName, $actionParams, $areaName);
	}

	public static function executeAction($controllerName, $actionName, $actionParams, $areaName) {
		$manager = ApplicationManager::getInstance();
		$controllerFactory = $manager->getControllerFactory();
		$viewEngine = $manager->getViewEngine();

		$controller = $controllerFactory->createController($controllerName, $areaName); 
		$helper = new AnnotationHelper(new AnnotationFactory);
		$controllerAnnotations = $helper->extractAnnotations(get_class($controller));
		$actionAnnotations = $helper->extractAnnotations(get_class($controller), $actionName);

		$annotationProcessor = new AnnotationProcessor();
		$annotationProcessor->processAnnotations($controllerAnnotations);
		$annotationProcessor->processAnnotations($actionAnnotations);

		$invoker = new ActionInvoker(
			$controller, 
			$actionName, 
			$actionParams);
		$actionArgs = $invoker->processBinding();
		$actionResult = $invoker->executeAction($actionArgs);

		$resultHandler = new ActionResultHandler($viewEngine, $areaName);
		$resultHandler->handleResult($actionResult);
	}
}

?>