<?php

namespace Areas\TestArea\Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;

class AreaController extends DefaultController {
	public function someAction() {
		echo 'in area action !!!';
		return new ContentResult(' === result from area === ');
	}
}

?>