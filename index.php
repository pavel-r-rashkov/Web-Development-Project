<?php

// include_once('Core/Bootstrap.php');

// use Routing\RoutingEngine;
// use Routing\Route;
// use Routing\RouteMatchResult;
// use Routing\RequestDispatcher;

// use Annotations\ActionFilterAnnotation;
// use Annotations\AnnotationHelper;
// use Annotations\HttpMethodAnnotation;
// use Annotations\BaseAnnotation;
// use Annotations\AnnotationFactory;
// use Annotations\HttpMethod;
// use Annotations\HttpGetAnnotation;
// use Annotations\HttpDeleteAnnotation;
// use Annotations\HttpPutAnnotation;
// use Annotations\HttpPostAnnotation;

// use ResultExecution\ActionResultHandler;
// use ResultExecution\ViewEngine;


// $route = RequestDispatcher::getRoute();

// $a = new Route('asdf/{aaa}/3/{bbb}/{g}', 'DefaultController', 'hello', array('Controllers'));
// $b = new Route('a/{aaa}/', 'gg', 'hh', array('Controllers'));
// $engine = new RoutingEngine();
// $engine->registerRoute($a);
// $engine->registerRoute($b);

// $routeResult = $engine->matchRoute($route);

// $factory = new ControllerFactory();
// $controller = $factory->createController('DefaultController', array('Controllers'));
// $helper = new AnnotationHelper(new AnnotationFactory);
// // ===================================
// $invoker = new ActionInvoker(
// 	$controller, 
// 	$routeResult->extractActionName(), 
// 	$routeResult->extractActionParams(),
// 	$helper->extractAnnotations(get_class($controller), $routeResult->extractActionName()));
// $actionArgs = $invoker->processBinding();
// $invoker->processAnnotations();
// $actionResult = $invoker->executeAction($actionArgs);
// #var_dump();
// $resultHandler = new ActionResultHandler(new ViewEngine());
// $resultHandler->handleResult($actionResult);
// // ===================================
// die;


// function getSubclassesOf($parent) {
//     $result = array();
//     foreach (get_declared_classes() as $class) {
//         if (is_subclass_of($class, $parent))
//             $result[] = $class;
//     }
//     return $result;
// }
// function Test() {
// 	include_once('Views/SampleView.php');
// }

?>

