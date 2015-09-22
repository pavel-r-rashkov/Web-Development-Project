<?php

namespace Core\ResultExecution;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\ViewResult;

class ViewEngine {
	const VIEWS_ROOT_DIR = 'Views'; // from config

	public function renderViewResult($viewResult) {
		$model = $viewResult->getData();
		
		if ($viewResult instanceof ViewResult) {
			$view = ROOT . self::VIEWS_ROOT_DIR . DS . $viewResult->getViewPath();
			$template = $this->findViewLayout($view);
			include_once(ROOT . $template);
		} else if ($viewResult instanceof PartialViewResult) {
			include_once($viewResult->getViewPath());
		}
	}

	public static function modelType($model, $type) {

	}

	private function findViewLayout($viewPath) {
		$currentPath = dirname($viewPath);
		$stopper = ROOT;
		$layout;

		while($currentPath != $stopper) {
			$layoutPath = $currentPath . DS . 'LayoutConfig.php';
			if (file_exists($layoutPath)) {
				include_once($layoutPath);
				return $layout;
			}

			$currentPath = dirname($currentPath);
		}

		throw new Exception('Cannot find layout config.');
	}

	// public static function view() {
	// 	include_once($view);
	// }
}

?>