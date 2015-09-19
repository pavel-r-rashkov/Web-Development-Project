<?php

require_once(__DIR__ . '/Core/Routing/RoutingEngine.php');
require_once(__DIR__ . '/Core/Routing/Route.php');
require_once(__DIR__ . '/Core/Routing/RouteMatchResult.php');

$a = new Route('/asdf/{aaa}/3/{bbb}', 'aaa', 'bbb');
$b = new Route('/a/{aaa}/', 'gg', 'hh');
$engine = new RoutingEngine();
$engine->registerRoute($a);
$engine->registerRoute($b);


$routeResult = $engine->matchRoute('/asdf/yyy/3/zzz');
var_dump($routeResult);

?>