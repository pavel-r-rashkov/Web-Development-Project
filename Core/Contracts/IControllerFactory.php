<?php

namespace Core\Contracts;

interface IControllerFactory {
	public function createController($controllerName, $area);
}

?>