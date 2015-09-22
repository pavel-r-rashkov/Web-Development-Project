<?php

namespace Areas\TestArea\Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\PartialViewResult;

class AreaController extends DefaultController {
	public function someAction() {
		return new PartialViewResult(null, 'AreaView.php');
	}
}

?>