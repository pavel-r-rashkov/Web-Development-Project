<?php

include_once('Bootstrap.php');

use Core\Routing\RoutingEngine;
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
use Core\ResultExecution\ViewEngine;

use Core\Controllers\ControllerFactory;
use Core\Contracts\IContainer;
use Core\Container;
use Core\BindOptions;
use Core\RequestPipeline;
use Core\ApplicationManager;
use Config\ApplicationConfig;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', basename(dirname(dirname(__FILE__))) . DS);
define('ROOT', dirname(dirname(__FILE__)) . DS);
define( 'ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . DS);
define('APP_ROOT_URL', ROOT_URL . ROOT_PATH);

$appManager = ApplicationManager::getInstance();

$appManager->setControllerFactory(new ControllerFactory());
$appManager->setViewEngine(new ViewEngine());
$appManager->setContainer(new Container());
$appManager->setRoutingEngine(new RoutingEngine());

ApplicationConfig::initializeComponents($appManager);
ApplicationConfig::registerAreas($appManager);
ApplicationConfig::routeConfig($appManager->getRoutingEngine());
ApplicationConfig::registerBindings($appManager->getContainer());

RequestPipeline::execute();
die;

// function getSubclassesOf($parent) {
//     $result = array();
//     foreach (get_declared_classes() as $class) {
//         if (is_subclass_of($class, $parent))
//             $result[] = $class;
//     }
//     return $result;
// }

//======================================================
// class Te {
// 	private $dep;

// 	function __construct(IContainer $dep) {
// 		$this->dep = $dep;
// 	}
// }


// $cont = new Container();
// $cont->bind('Te', 'Te', BindOptions::SINGLETON);
// $cont->bind('Contracts\IContainer', 'Core\Container', BindOptions::NONE);
// $te = $cont->resolve('Te');
// $te2 = $cont->resolve('Te');

// var_dump($cont);
// die;
// $reflection = new ReflectionClass('Te');
// $method = $reflection->getMethod('test');
// $params = $method->getParameters();
// var_dump($params[0]->getClass());
// #test('ViewEngine');


// $route = RequestDispatcher::getRoute();

// $a = new Route('asdf/{aaa}/3/{bbb}/{g}', 'DefaultController', 'hello');
// $b = new Route('a/{aaa}/', 'gg', 'hh');
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

// $resultHandler = new ActionResultHandler(new ViewEngine());
// $resultHandler->handleResult($actionResult);
//======================================================

?>