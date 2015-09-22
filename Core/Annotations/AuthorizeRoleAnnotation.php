<?php

namespace Core\Annotations;
use Core\ApplicationManager;

class AuthorizeRoleAnnotation extends AuthorizeAnnotation {
	private $allowedRoles;

	public function __construct() {
		$roles = func_get_args();
		$this->allowedRoles = $roles;
	}

	public function authorize() {
		$container = ApplicationManager::getInstance()->getContainer();
		$roleProvider = $container->resolve('Core/Contracts/IRoleProvider');
		#$userId = $_SESSION['userId'];
		$userRoles = $roleProvider->getUserRoles(5);

		if (count(array_intersect($userRoles, $this->allowedRoles)) != count($this->allowedRoles)) {
			http_response_code(401);
			die;
		}
	}
}

?>