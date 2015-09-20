<?php

namespace Controllers;
use Routing\RoutingEngine;

class DefaultController {

	public function __construct() {
		
	}	

	/** 
	*@Route(gggg/bbb) 
	*@Route(daaa) 
	*/
	public function hello(BindingModel $d, $g) {
		echo 'Hello from controller! ';
		echo "\nModel\n";
		echo $d->getAaa();
		echo "\n";
		echo $d->getBbb();
	}
}

class BindingModel {
	private $aaa;
	private $bbb;

	public function getAaa() {
		return $this->aaa;
	}

	public function setAaa($value) {
		$this->aaa = $value;
	}

	public function getBbb() {
		return $this->bbb;
	}

	public function setBbb($value) {
		$this->bbb = $value;
	}
}

?>