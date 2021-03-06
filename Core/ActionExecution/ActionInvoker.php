<?php

namespace Core\ActionExecution;

class ActionInvoker {
	private $controller;
	private $actionName;
	private $actionParams;

	public function __construct($controller, $actionName, $actionParams) {
		$this->controller = $controller;
		$this->actionName = $actionName;
		$this->actionParams = $actionParams;
	}

	public function processBinding() {
		$reflection = new \ReflectionClass($this->controller);
		$action = $reflection->getMethod($this->actionName);
		$params = $action->getParameters();
		$actionArgs = array();

		foreach ($params as $param) {
			$paramName = $param->name;

			if($param->getClass() != null) {
				$bindingModel = $this->populateBindingModel($param->getClass()->name);
				array_push($actionArgs, $bindingModel);
			} else if(array_key_exists($paramName, $this->actionParams)) {
				array_push($actionArgs, $this->actionParams[$paramName]);
				unset($this->actionParams[$paramName]);
			} else if (array_key_exists($paramName, $_REQUEST)) {
				array_push($actionArgs, $_REQUEST[$paramName]);
				unset($_REQUEST[$paramName]);
			} else {
				array_push($actionArgs, null);
			}
		}

		return $actionArgs;
	}

	private function populateBindingModel($paramClass) {
		$bindingModelInstance = new $paramClass();
		$reflection = new \ReflectionClass($bindingModelInstance);

		$properties = $reflection->getMethods();

		foreach ($properties as $property) {
			if(self::strStartsWith($property->name, 'set') &&
				$property->isPublic()) {

				$paramName = lcfirst(substr($property->name, 3));
				if(array_key_exists($paramName, $this->actionParams)) {
					$bindingModelInstance->{$property->name}($this->actionParams[$paramName]);
					unset($this->actionParams[$paramName]);
				} else if (array_key_exists($paramName, $_REQUEST)) {
					$bindingModelInstance->{$property->name}($_REQUEST[$paramName]);
					unset($_REQUEST[$paramName]);
				} else {
					$bindingModelInstance->{$property->name}(null);
				}
			}
		}

		return $bindingModelInstance;
	}

	public function executeAction($actionArgs) {
		$reflection = new \ReflectionClass($this->controller);
		$action = $reflection->getMethod($this->actionName);
		$actionResult = $action->invokeArgs($this->controller, $actionArgs);
		return $actionResult;
	}

	private static function strStartsWith($haystack, $needle)
	{
	    return strpos($haystack, $needle) === 0;
	}
}

?>