<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;
use Core\ResultExecution\ActionResults\ViewResult;

class SomeController extends DefaultController {

	/**
	*@AuthorizeRole(SecondRole, FirstRole)
	*/
	public function someAction() {
		return new ViewResult(null, 'SampleView.php');
	}
}

?>