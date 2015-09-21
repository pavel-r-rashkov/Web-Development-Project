<?php

namespace Annotations;

class HttpPutAnnotation extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::PUT);
	}
}

?>