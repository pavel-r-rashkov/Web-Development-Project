<?php

namespace Core\ResultExecution;

class ActionResultHandler {
	private $viewEngine;
	private $areaName;

	public function __construct($viewEngine, $areaName) {
		$this->viewEngine = $viewEngine;
		$this->areaName = $areaName;
	}

	public function handleResult($actionResult) {
		$this->populateResponseHeaders($actionResult);

		if(is_subclass_of($actionResult, 'Core\ResultExecution\ActionResults\BaseViewResult')) {
			$this->viewEngine->renderViewResult($actionResult, $this->areaName);
		} else {
			echo $actionResult->getData();
		}
	}

	private function populateResponseHeaders($actionResult) {
		foreach ($actionResult->getHeaders() as $header) {
			header($header);
		}
	}
}

?>