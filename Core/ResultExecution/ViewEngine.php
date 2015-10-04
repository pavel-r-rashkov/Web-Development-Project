<?php

namespace Core\ResultExecution;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\Contracts\IViewEngine;

class ViewEngine implements IViewEngine {
	const VIEWS_ROOT_DIR = 'Views'; // from config

	public function renderViewResult($viewResult, $areaName) {
		$model = $viewResult->getData();
		$view = ROOT . self::VIEWS_ROOT_DIR . DS . $viewResult->getViewPath();
		if(!is_null($areaName)) {
			$view = ROOT . 'Areas' . DS . ucfirst($areaName) . DS . self::VIEWS_ROOT_DIR . DS . $viewResult->getViewPath();
		}

		if ($viewResult instanceof ViewResult) {
			$template = $this->findViewLayout($view);
			include(ROOT . $template);
		} else if ($viewResult instanceof PartialViewResult) {
			include_once($view);
		}
	}

	public static function validateModelType($model, $type) {
		if ($model != null && !($model instanceof $type)) {
			throw new \Exception("This view is expecting {$type}, but " . get_class($model) . " is given");
		}
	}

	private function findViewLayout($viewPath) {
		$currentPath = dirname($viewPath);
		$stopper = ROOT;
		$layout;

		while($currentPath != $stopper) {
			$layoutPath = $currentPath . DS . 'LayoutConfig.php';
			if (file_exists($layoutPath)) {
				include($layoutPath);
				return $layout;
			}

			$currentPath = dirname($currentPath);
		}

		throw new \Exception('Cannot find layout config.');
	}

	public function show($value) {
		echo htmlspecialchars($value);
	}

	public function trust($value) {
		echo $value;
	}
}

?>