<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Core\ResultExecution\ActionResults\ContentResult;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\Contracts\IRoleProvider;
use Data\Config\Database;
use Data\Config\DatabaseConfig;

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
		$db = Database::getInstance(DatabaseConfig::DB_INSTANCE);

		$result = $db->prepare('SELECT title FROM posts WHERE id = ? OR id = ?');
		$result->execute([ '7', '33' ]);
		$data = $result->fetchAll();

		return new ViewResult(new MyModel(), 'SampleView.php');
	}
}

class MyModel {

}

?>