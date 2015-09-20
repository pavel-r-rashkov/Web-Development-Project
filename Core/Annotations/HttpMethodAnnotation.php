<?php

abstract class HttpMethodAnnotation extends BaseAnnotation {
	private $httpMethod;

	public function __construct($httpMethod) {
		$this->httpMethod = $httpMethod;
	}

	public function assertHttpMethod() {
		if ($_SERVER['REQUEST_METHOD'] == $this->httpMethod) {
			return true;
		}
		return false;
	}
}

?>