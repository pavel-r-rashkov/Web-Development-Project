<?php

namespace ResultExecution;
use ResultExecution\ActionResults\PartialViewResult;
use ResultExecution\ActionResults\ViewResult;

class ViewEngine {

	public function renderViewResult($viewResult) {
		$model = $viewResult->getData();
		
		if ($viewResult instanceof ViewResult) {
			$view = $viewResult->getViewPath();
			$template = 'Views/Layout.php';
			include_once($template);
		} else if ($viewResult instanceof PartialViewResult) {
			include_once($viewResult->getViewPath());
		}
	}

	public static function modelType($type) {

	}
}

?>