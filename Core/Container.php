<?php

namespace Core;
use Contracts\IContainer;

class Container implements IContainer {
	private $bindings;
	private $instanceCache;

	public function __construct() {
		$this->bindings = array();
		$this->instanceCache = array();
	}

	public function bind($dependency, $resolveWith, $bindOptions) {
		$this->bindings[$dependency] = 
			array('resolveWith' => $resolveWith,
				'options' => $bindOptions);
	}

	public function resolve($dependency) {
		if(!array_key_exists($dependency, $this->bindings)) {
			throw new \Exception("Binding for {$dependency} is not defined");
		}

		$constructorArgs = array();
		$resolver = $this->bindings[$dependency]['resolveWith'];
		$reflection = new \ReflectionClass($resolver);
		$method = $reflection->getMethod('__construct');
		$params = $method->getParameters();
		
		foreach ($params as $param) {
			$name = $param->getClass()->getName();
			$instance = $this->resolve($name);
			array_push($constructorArgs, $instance);
		}

		return $reflection->newInstanceArgs($constructorArgs);
	}
}

?>