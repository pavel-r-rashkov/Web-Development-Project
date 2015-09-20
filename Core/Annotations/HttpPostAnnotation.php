<?php

class HttpPost extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::POST);
	}
}

?>