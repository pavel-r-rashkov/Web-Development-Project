<?php

namespace Core\Annotations;

class HttpDeleteAnnotation extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::DELETE);
	}
}

?>