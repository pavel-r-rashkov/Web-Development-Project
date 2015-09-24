<?php

include_once('Bootstrap.php');

use Core\Routing\RoutingEngine;
use Core\ResultExecution\ViewEngine;
use Core\Controllers\ControllerFactory;
use Core\Container;
use Core\RequestPipeline;
use Core\ApplicationManager;
use Config\ApplicationConfig;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', basename(dirname(dirname(__FILE__))) . DS);
define('ROOT', dirname(dirname(__FILE__)) . DS);
define( 'ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] . DS);
define('APP_ROOT_URL', ROOT_URL . ROOT_PATH);

session_start();

$appManager = ApplicationManager::getInstance();

$appManager->setControllerFactory(new ControllerFactory());
$appManager->setViewEngine(new ViewEngine());
$appManager->setContainer(new Container());
$appManager->setRoutingEngine(new RoutingEngine());

ApplicationConfig::initializeComponents($appManager);
ApplicationConfig::registerAreas($appManager);
ApplicationConfig::bootstrap();
$routingEngine = $appManager->getRoutingEngine();
$routingEngine->registerAnnotationRoutes();
ApplicationConfig::routeConfig($appManager->getRoutingEngine());
ApplicationConfig::registerBindings($appManager->getContainer());

RequestPipeline::execute();
die;

?>