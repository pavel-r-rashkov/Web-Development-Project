<?php

namespace Annotations;

abstract class HttpMethodAnnotation extends ActionFilterAnnotation {
	private $httpMethod;

	public function __construct($httpMethod) {
		$this->httpMethod = $httpMethod;
	}

	public function filterAction() {
		if ($_SERVER['REQUEST_METHOD'] != $this->httpMethod) {
			throw new \Exception('This action cannot be called with this http method');
		}
	}
}

?>