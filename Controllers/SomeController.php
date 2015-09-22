<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;

class SomeController extends DefaultController {
	public function someAction() {
		echo 'in some action ';
		return new ContentResult(' some content ');
	}
}

?>