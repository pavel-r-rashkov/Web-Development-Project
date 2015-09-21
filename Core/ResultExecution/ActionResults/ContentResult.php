<?php

namespace ResultExecution\ActionResults;

class ContentResult extends BaseActionResult {
	public function __construct($data) {
		$headers = array(
				'Content-Type: text/html'
			);
		parent::__construct($headers, $data);
	}
}

?>