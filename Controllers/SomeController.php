<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;
use Core\ResultExecution\ActionResults\ViewResult;

class SomeController extends DefaultController {
	public function someAction() {
		//echo 'in some action ';
		return new ViewResult(null, 'SampleView.php');
	}
}

?>