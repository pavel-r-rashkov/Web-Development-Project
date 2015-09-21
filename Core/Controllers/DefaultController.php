<?php

namespace Controllers;
use ResultExecution\ActionResults\PartialViewResult;

class DefaultController {

	public function __construct() {
		
	}	

	/** 
	*@Route(gggg/bbb)
	*/
	public function hello(BindingModel $d, $g) {
		return new PartialViewResult($d, 'Views/SampleView.php');
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