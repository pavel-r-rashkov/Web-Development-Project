<?php

namespace Core\ResultExecution\ActionResults;

class PartialViewResult extends BaseViewResult {
	public function __construct($model, $viewPath) {
		parent::__construct($model, $viewPath);
	}
}

?>