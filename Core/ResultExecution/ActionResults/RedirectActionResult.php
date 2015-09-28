<?php

namespace Core\ResultExecution\ActionResults;

class RedirectActionResult extends BaseActionResult {
	public function __construct($location) {
		parent::__construct(array('Location: ' . APP_ROOT_URL . $location), null);
	}
}

?>