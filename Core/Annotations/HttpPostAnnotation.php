<?php

namespace Annotations;

class HttpPostAnnotation extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::POST);
	}
}

?>