<?php

namespace Core;
use Core\Contracts\IContainer;

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
		$reflection = new \ReflectionClass($dependency);
		$constructor = $reflection->getMethod('__construct');
		$constructorParams = $constructor->getParameters();
		
		$constructorArgs = array();
		foreach ($constructorParams as $param) {
			$paramInstance = $this->get($param->getClass()->name);
			array_push($constructorArgs, $paramInstance);
		}

		return $reflection->newInstanceArgs($constructorArgs);
	}

	private function get($dependency) {
		if(!array_key_exists($dependency, $this->bindings)) {
			throw new \Exception("Binding for {$dependency} is not defined");
		}

		$resolver = $this->bindings[$dependency]['resolveWith'];
		$bindOptions = $this->bindings[$dependency]['options'];
		if($bindOptions == BindOptions::SINGLETON &&
			array_key_exists($resolver, $this->instanceCache)) {
			return $this->instanceCache[$resolver];
		}

		$reflection = new \ReflectionClass($resolver);
		$method = $reflection->getMethod('__construct');
		$params = $method->getParameters();
		$constructorArgs = array();
		
		foreach ($params as $param) {
			$name = $param->getClass()->getName();
			$instance = $this->get($name);
			array_push($constructorArgs, $instance);
		}

		$instance = $reflection->newInstanceArgs($constructorArgs);
		if($bindOptions == BindOptions::SINGLETON &&
			!array_key_exists($resolver, $this->instanceCache)) {
			$this->instanceCache[$resolver] = $instance;
		}

		return $instance; 
	}
}

?>