<?php

namespace Core\ResultExecution\ActionResults;

abstract class BaseActionResult {
	private $headers;
	private $data;

	public function __construct($headers, $data) {
		$this->headers = $headers;
		$this->data = $data;
	}

	public function getHeaders() {
		return $this->headers;
	}

	public function getData() {
		return $this->data;
	}
}

?>