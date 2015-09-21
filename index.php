<?php

require_once(__DIR__ . '/Core/Routing/RequestDispatcher.php');
require_once(__DIR__ . '/Core/Routing/RoutingEngine.php');
require_once(__DIR__ . '/Core/Routing/Route.php');
require_once(__DIR__ . '/Core/Routing/RouteMatchResult.php');
require_once(__DIR__ . '/Core/Controllers/DefaultController.php');
require_once(__DIR__ . '/Core/Controllers/ControllerFactory.php');

require_once(__DIR__ . '/Core/Annotations/BaseAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/ActionFilterAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/RouteAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/AnnotationHelper.php');
require_once(__DIR__ . '/Core/Annotations/AnnotationFactory.php');
require_once(__DIR__ . '/Core/Annotations/HttpMethod.php');
require_once(__DIR__ . '/Core/Annotations/HttpMethodAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/HttpGetAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/HttpDeleteAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/HttpPostAnnotation.php');
require_once(__DIR__ . '/Core/Annotations/HttpPutAnnotation.php');

require_once(__DIR__ . '/Core/ActionExecution/ActionInvoker.php');

require_once(__DIR__ . '/Core/ResultExecution/ActionResultHandler.php');
require_once(__DIR__ . '/Core/ResultExecution/ViewEngine.php');
require_once(__DIR__ . '/Core/ResultExecution/ActionResults/BaseActionResult.php');
require_once(__DIR__ . '/Core/ResultExecution/ActionResults/BaseViewResult.php');
require_once(__DIR__ . '/Core/ResultExecution/ActionResults/PartialViewResult.php');
require_once(__DIR__ . '/Core/ResultExecution/ActionResults/ViewResult.php');
require_once(__DIR__ . '/Core/ResultExecution/ActionResults/ContentResult.php');

use Routing\RoutingEngine;
use Routing\Route;
use Routing\RouteMatchResult;
use Routing\RequestDispatcher;

use Annotations\ActionFilterAnnotation;
use Annotations\AnnotationHelper;
use Annotations\HttpMethodAnnotation;
use Annotations\BaseAnnotation;
use Annotations\AnnotationFactory;
use Annotations\HttpMethod;
use Annotations\HttpGetAnnotation;
use Annotations\HttpDeleteAnnotation;
use Annotations\HttpPutAnnotation;
use Annotations\HttpPostAnnotation;

use ResultExecution\ActionResultHandler;
use ResultExecution\ViewEngine;


$route = RequestDispatcher::getRoute();

$a = new Route('asdf/{aaa}/3/{bbb}/{g}', 'DefaultController', 'hello', array('Controllers'));
$b = new Route('a/{aaa}/', 'gg', 'hh', array('Controllers'));
$engine = new RoutingEngine();
$engine->registerRoute($a);
$engine->registerRoute($b);

$routeResult = $engine->matchRoute($route);

$factory = new ControllerFactory();
$controller = $factory->createController('DefaultController', array('Controllers'));
$helper = new AnnotationHelper(new AnnotationFactory);
// ===================================
$invoker = new ActionInvoker(
	$controller, 
	$routeResult->extractActionName(), 
	$routeResult->extractActionParams(),
	$helper->extractAnnotations(get_class($controller), $routeResult->extractActionName()));
$actionArgs = $invoker->processBinding();
$invoker->processAnnotations();
$actionResult = $invoker->executeAction($actionArgs);
#var_dump();
$resultHandler = new ActionResultHandler(new ViewEngine());
$resultHandler->handleResult($actionResult);
// ===================================
die;


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

