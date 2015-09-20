<?php

namespace Controllers;

class DefaultController {

	public function __construct() {
		
	}	

	/** 
	*@Route(gggg/bbb) 
	*@Route(daaa) 
	*/
	public function hello() {
		echo 'Hello from controller!';
	}
}

?>