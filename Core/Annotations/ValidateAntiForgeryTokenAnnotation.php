<?php

namespace Core\Annotations;
use Core\ApplicationManager;

class ValidateAntiForgeryTokenAnnotation extends AuthorizeAnnotation {
	public function __construct() {
	}

	public function authorize() {
		if(!isset($_REQUEST['csrfToken']) || !isset($_COOKIE['CSRF-TOKEN'])) {
			http_response_code(401);
			die;
		}

		$cookieToken = $_COOKIE['CSRF-TOKEN'];
		$formToken = $_REQUEST['csrfToken'];
		if ($cookieToken != $formToken) {
			http_response_code(401);
			die;
		}
	}
}

?>