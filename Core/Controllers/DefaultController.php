<?php

namespace Controllers;
use ResultExecution\ActionResults\PartialViewResult;
use ResultExecution\ActionResults\ViewResult;
use ResultExecution\ActionResults\ContentResult;

class DefaultController {

	public function __construct() {
		
	}	

	/** 
	*@Route(gggg/bbb)
	*/
	public function hello(BindingModel $d, $g) {
		#return new ContentResult("Some content");
		return new ViewResult($d, 'Views/SampleView.php');
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