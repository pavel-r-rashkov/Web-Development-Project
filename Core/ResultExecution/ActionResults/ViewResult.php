<?php

namespace Core\ResultExecution\ActionResults;

class ViewResult extends BaseViewResult {
	public function __construct($model, $viewPath) {
		parent::__construct($model, $viewPath);
	}
}

?>