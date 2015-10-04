<?php

namespace Core\ResultExecution\ActionResults;

abstract class BaseViewResult extends BaseActionResult {
	private $viewPath;

	public function __construct($model, $viewPath) {
		parent::__construct(array(), $model);
		$this->viewPath = $viewPath;
	}

	public function getViewPath() {
		return $this->viewPath;
	}
}

?>