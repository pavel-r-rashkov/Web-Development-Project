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

$a = new Route('/asdf/{aaa}/3/{bbb}', '{aaa}', '{bbb}', array('Controllers'));
$b = new Route('/a/{aaa}/', 'gg', 'hh', array('Controllers'));
$engine = new RoutingEngine();
$engine->registerRoute($a);
$engine->registerRoute($b);


$routeResult = $engine->matchRoute('/asdf/yyy/3/zzz');
#var_dump($routeResult);


$factory = new ControllerFactory();

#$controller = $factory->createController('DefaultController', array('Controllers'));



$helper = new AnnotationHelper(new AnnotationFactory);
$annotations = $helper->ExtractAnnotations('Controllers\DefaultController', 'hello');
var_dump($annotations);


// function getSubclassesOf($parent) {
//     $result = array();
//     foreach (get_declared_classes() as $class) {
//         if (is_subclass_of($class, $parent))
//             $result[] = $class;
//     }
//     return $result;
// }

?>