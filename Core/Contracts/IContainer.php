<?php

namespace Core\Contracts;

interface IContainer {
	public function bind($dependency, $resolveWith, $bindOptions);
	public function resolve($type);
}

?>