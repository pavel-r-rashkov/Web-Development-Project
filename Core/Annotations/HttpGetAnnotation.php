<?php

namespace Annotations;

class HttpGetAnnotation extends HttpMethodAnnotation {
	public function __construct() {
		parent::__construct(HttpMethod::GET);
	}
}

?>