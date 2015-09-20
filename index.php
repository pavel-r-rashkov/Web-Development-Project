<?php

require_once(__DIR__ . '/Core/Routing/RoutingEngine.php');
require_once(__DIR__ . '/Core/Routing/Route.php');
require_once(__DIR__ . '/Core/Routing/RouteMatchResult.php');
require_once(__DIR__ . '/Core/Controllers/DefaultController.php');
require_once(__DIR__ . '/Core/Controllers/ControllerFactory.php');

require_once(__DIR__ . '/Core/Annotations/BaseAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/RouteAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/AnnotationHelper.php');
require_once(__DIR__ . '/Core/Annotations/AnnotationFactory.php');
require_once(__DIR__ . '/Core/ActionExecution/ActionInvoker.php');

use Routing\RoutingEngine;
use Routing\Route;
use Routing\RouteMatchResult;

$a = new Route('/asdf/{aaa}/3/{bbb}/{g}', 'DefaultController', 'hello', array('Controllers'));
$b = new Route('/a/{aaa}/', 'gg', 'hh', array('Controllers'));
$engine = new RoutingEngine();
$engine->registerRoute($a);
$engine->registerRoute($b);

$helper = new AnnotationHelper(new AnnotationFactory);
$routeResult = $engine->matchRoute('/asdf/yyy/3/zzz/4');
#var_dump($routeResult);

$factory = new ControllerFactory();
$controller = $factory->createController('DefaultController', array('Controllers'));

$invoker = new ActionInvoker(
	$controller, 
	$routeResult->extractActionName(), 
	$routeResult->extractActionParams(),
	$helper->extractAnnotations(get_class($controller), $routeResult->extractActionName()));
$actionArgs = $invoker->processBinding();
$invoker->executeAction($actionArgs);


die;



$annotations = $helper->extractAnnotations('Controllers\DefaultController', 'hello');


// function getSubclassesOf($parent) {
//     $result = array();
//     foreach (get_declared_classes() as $class) {
//         if (is_subclass_of($class, $parent))
//             $result[] = $class;
//     }
//     return $result;
// }

?>