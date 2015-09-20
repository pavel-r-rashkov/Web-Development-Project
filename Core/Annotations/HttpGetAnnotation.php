<?php

class HttpGet extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::GET);
	}
}

?>