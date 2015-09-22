<?php

namespace Core\Controllers;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\ContentResult;

class DefaultController {

	public function __construct() {
		
	}	

	/** 
	*@Route(gggg/bbb)
	*/
	public function hello(BindingModel $d, $g) {
		#return new ContentResult("Some content");
		return new ViewResult($d, 'SampleView.php');
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