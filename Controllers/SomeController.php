<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\Contracts\IRoleProvider;

class SomeController extends DefaultController {
	private $provider;

	public function __construct(IRoleProvider $provider) {
		$this->provider = $provider;
	}
	/**
	*@AuthorizeRole(SecondRole, FirstRole)
	*@Route(pesho/gosho)
	*/
	public function someAction() {
		return new ViewResult(new MyModel(), 'SampleView.php');
	}
}

class MyModel {

}

?>