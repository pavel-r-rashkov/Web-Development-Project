<?php

class HttpDelete extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::DELETE);
	}
}

?>