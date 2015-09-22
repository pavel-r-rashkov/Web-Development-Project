<?php

namespace Core\ResultExecution\ActionResults;

abstract class BaseViewResult extends BaseActionResult {
	private $viewPath;

	public function __construct($model, $viewPath) {
		$headers = array(
				'Content-Type: text/html'
			);
		parent::__construct($headers, $model);
		$this->viewPath = $viewPath;
	}

	public function getViewPath() {
		return $this->viewPath;
	}
}

?>