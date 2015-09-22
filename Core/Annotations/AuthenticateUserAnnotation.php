<?php

namespace Core\Annotations;

class AuthenticateUserAnnotation extends AuthenticateAnnotation {
	public function __construct() {
	}

	public function authenticate() {
		if (!array_key_exists('userId', $_SESSION) || 
				is_null($_SESSION['userId'])) {
			http_response_code(401);
			die;
		} 
	}
}

?>