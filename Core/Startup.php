<?php

include_once('Bootstrap.php');

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

use Contracts\IContainer;
use Core\Container;
use Core\BindOptions;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', basename(dirname(dirname(__FILE__))) . DS);
define('ROOT', dirname(dirname(__FILE__)) . DS);


// class Te {
// 	private $dep;

// 	function __construct(IContainer $dep) {
// 		$this->dep = $dep;
// 	}
// }


// $cont = new Container();
// $cont->bind('Te', 'Te', BindOptions::NONE);
// $cont->bind('Contracts\IContainer', 'Core\Container', BindOptions::NONE);
// $te = $cont->resolve('Te');
// var_dump($te);

// $reflection = new ReflectionClass('Te');
// $method = $reflection->getMethod('test');
// $params = $method->getParameters();
// var_dump($params[0]->getClass());
// #test('ViewEngine');


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

?>