<?php

namespace Core\ResultExecution;

class ActionResultHandler {
	private $viewEngine;

	public function __construct($viewEngine) {
		$this->viewEngine = $viewEngine;
	}

	public function handleResult($actionResult) {
		$this->populateResponseHeaders($actionResult);

		if(is_subclass_of($actionResult, 'Core\ResultExecution\ActionResults\BaseViewResult')) {
			$this->viewEngine->renderViewResult($actionResult);
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